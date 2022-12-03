<?php
require __DIR__."/../../vendor/autoload.php";
use Order\Order;
$mng = new Order;


require __DIR__."/../../Classes/config/{$mng->tmpl}.php";

$smarty  = new Smarty;
$smarty->template_dir = dirname( __FILE__ ).'/../../templates';
$smarty->compile_dir  = dirname( __FILE__ ).'/../../templates_c';
$smarty->assign("css",array("bootstrap.min","bootstrap-responsive.min","style","basic","Search","Order"));


if(!empty($_POST)){
  if(!empty($_POST["token"]) && !(hash_equals($_POST["token"], $_SESSION['token'])) && $_POST["type"] != "ajax") {
    $errorMsg =  "起動方法が不正です";   
    echo $_POST["token"]."<br>";
    echo $_SESSION["token"];
    echo $errorMsg;
    exit;
  }elseif($_POST["mode"] == "search"){
    $mng->SerachItems($form,$SerachTable,$SerachdetailTabel);
    exit;
  }elseif($_POST["mode"] == "OrderSheet"){
    $data = $mng->SerachItems($form,$SerachTable,$SerachdetailTabel,[],1);
    #print_r($data);
    #exit;
    $data = $mng->MakeOrderDataValue($OrderView,$data);
    if(!empty($_POST["code"])){
      $data = [$data];
    }
    #print_r($data);
    $mng->OrderTime = $OrderTime;
    $mng->ExcelDownload($data,$OrderTable);
    #print_r($_POST);
    exit;
  }elseif($_POST["mode"] == "OrderUpdate"){
    #print_r($_POST);
    if(!empty($_POST["code"])){
      foreach($_POST as $k => $v){
        switch($k){
          case "mode":
          case "code":
            break;
          default:
            $sql = "delete from OrderValue WHERE item_id={$_POST['code']} AND item_title='$k'";
            $mng->GetResult($sql);
            #echo $sql."\n";
            $sql = "INSERT INTO OrderValue (item_id,item_title,item_value) VALUES({$_POST['code']},'$k', '{$v}')";
            #echo $sql."\n";
            $mng->GetResult($sql);
        }
      }
    }
    exit;
  }elseif($_POST["mode"] == "statusChange"){
    if(!empty($_POST["status"])){
      //ステータスごとに処理をする
      $err = $mng->StatusChange($form,$SerachTable,$SerachdetailTabel,$OrderTable);
      if(!empty($err)){
        echo $err;
        exit;
      }
      //一旦既存のステータスレコードを消す
      $sql = "delete from OrderValue WHERE item_id={$_POST['code']} AND item_title='status'";
      $mng->GetResult($sql);
      //新規にステータスを挿入
      $sql = "INSERT INTO OrderValue (item_id,item_title,item_value) VALUES({$_POST['code']},'status', {$_POST['status']})";
      $mng->GetResult($sql);
    }
    exit;
  }elseif($_POST["mode"] == "modal"){
    $data = $mng->SerachItems($form,$SerachTable,$SerachdetailTabel,[],1);
    $_POST["d"] = $mng->MakeOrderDataValue($OrderTable,$data);
    #print_r($_POST);
    $smarty->assign("OrderTime",$OrderTime);
    $smarty->assign("OrderTable", $OrderTable);
    $smarty->assign("OrderView", $OrderView);
    $smarty->assign("r", $_POST["d"]);
    $smarty->display("{$_POST['templ']}.tpl");
    exit;
  }elseif($_POST["mode"] == "MasterDownLoad"){
    #print_r($_POST);
    $f = file_get_contents($_POST["urls"]);
    $d = json_decode($f,true);
    $arr = $header = [];
    foreach($OrderView as $k => $v){
      if($v["view"] == 1){
        $header[] = $v["name"];
      }
    }
    $arr[] = $header;
    
    foreach($d as $k => $v){
      $arr[] = $mng->OrderListOutPut($v,$OrderTable,$OrderView);
    }
    
    //デバック用
    $fp = fopen(__DIR__."/../../".time().".csv", 'w');
    stream_filter_prepend($fp,'convert.iconv.utf-8/cp932');
    
    foreach($arr as $row){
      fputcsv($fp,$row);
    }
    fclose($fp);
    
    
    
    $fp = fopen('php://output', 'w');
    stream_filter_prepend($fp,'convert.iconv.utf-8/cp932');

    #header('Content-Type: application/octet-stream; charset=Shift_JIS');
    #header("Content-Disposition: attachment; filename=".time().".csv");
    #header('Content-Transfer-Encoding: binary');
    
    foreach($arr as $row){
      fputcsv($fp,$row);
    }
    fclose($fp);
    
    #header("Content-Type: application/json; charset=utf-8");
    #echo json_encode($data);
    exit;
  }
}



#print_r($_SESSION);
$smarty->assign("OrderTime",$OrderTime);
$smarty->assign("OrderTable", $OrderTable);
$smarty->assign("OrderView", $OrderView);
$smarty->assign("SearchForm", $SearchForm);
$smarty->assign("title", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("DESCRIPTION", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("KEYWORDS", "{$title} ｜".BASE_ADMIN_TITLE."");
$smarty->assign("errorMsg", isset($errorMsg) ? $errorMsg : null);
$smarty->assign("adminData", isset($adminData) ? $errorMsg : null);
$smarty->assign("nav", nav);
$smarty->assign("actionVal", $mng->tmpl);

$smarty->assign("target","Order");
$smarty->assign("itemForm",$SearchForm);

$smarty->display("{$mng->tmpl}.tpl");


