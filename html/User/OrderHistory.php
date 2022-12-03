<?php
require __DIR__."/../../vendor/autoload.php";
use Order\Order;
$mng = new Order;

require __DIR__."/../../Classes/config/{$mng->tmpl}.php";
$smarty  = new Smarty;
$smarty->template_dir = dirname( __FILE__ ).'/../../templates';
$smarty->compile_dir  = dirname( __FILE__ ).'/../../templates_c';
$smarty->assign("css",array("bootstrap.min","bootstrap-responsive.min","style","basic","Search","Order"));
#$smarty->assign("js",array("js"));


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
  }
}

#print_r($_SESSION);
#echo $_SESSION["user"];
$_POST["user"] = $_SESSION["user"];
$smarty->assign("status", $OrderTable["status"]["item"]);
$smarty->assign("SearchForm",$SearchForm);
$smarty->assign("OrderTime",$OrderTime);
$smarty->assign("OrderTable", $OrderTable);
$smarty->assign("OrderView", $OrderView);
$smarty->assign("search_user", $_SESSION["user"]);
$smarty->assign("t", time());
$smarty->assign("title", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("DESCRIPTION", "ダッシュボード｜".BASE_ADMIN_TITLE."");
$smarty->assign("KEYWORDS", "ダッシュボード ｜".BASE_ADMIN_TITLE."");
$smarty->assign("news", isset($news) ? $news : null);
$smarty->assign("errorMsg", isset($errorMsg) ? $errorMsg : null);
$smarty->assign("adminData", isset($adminData) ? $errorMsg : null);
$smarty->assign("actionVal", "Order/Index");
#print_r($_POST);



$smarty->assign("target","Order");
$smarty->assign("itemForm",$SearchForm);

if($_SESSION["role"] == "admin"){
  $smarty->assign("nav",nav);
}else{
  $smarty->assign("nav",UserNav);
}
$smarty->display("{$mng->tmpl}.tpl");
