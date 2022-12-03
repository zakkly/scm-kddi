<?php
require __DIR__."/../../vendor/autoload.php";
use Order\Order;
$mng = new Order;


require __DIR__."/../../Classes/config/{$mng->tmpl}.php";
$SetForm = $form;

$smarty  = new Smarty;
$smarty->template_dir = dirname( __FILE__ ).'/../../templates';
$smarty->compile_dir  = dirname( __FILE__ ).'/../../templates_c';

$smarty->assign("css",array("bootstrap","bootstrap-responsive","style","basic","Search","Goods"));

if(!empty($_POST)){
  if(!empty($_POST["token"]) && !(hash_equals($_POST["token"], $_SESSION['token'])) && $_POST["type"] != "ajax") {
    $errorMsg =  "起動方法が不正です";
    echo $_POST["token"]."<br>";
    echo $_SESSION["token"];
    echo $errorMsg;
  }elseif($_POST["mode"] == "delete"){
    $mng->DeleteItemSetData("set");
    exit;
  }elseif($_POST["mode"] == "search"){
    $query = [];
    #echo $SearchTable;
    foreach($_POST as $k => $v){
      switch($k){
        case "mode":
        case "target":
        case "num_rows":
        case "count":
        case "start":
          break;
        default:
          if(!empty($v)){
            $query[] = "$k='$v'";
          }
      }
    }
    if(!empty($query)){
      $query = " AND ".implode(" AND ", $query);
    }else{
      $query = "";
    }
    #echo $query;
    $sql = "SELECT * from $SearchTable as i,$SearchdetailTabel as v where i.code=v.item_id";
    #echo $sql;
    $data = $mng->GetResult($sql);
    if($data){
      if(!empty($_POST["count"])){
        $data = $mng->DecodeData($data);
        $data = ["count" => count($data)];
      }else{
        $data = $mng->DecodeData($data);
      }
      $d = [];
      foreach($data as $k => $v){
        $d[$v["code"]]["title"] = $v["title"];
        $d[$v["code"]]["code"] = $v["code"];
        switch($form[$v["item_title"]]["type"]){
          case "rendered":
            switch($v["item_title"]){
              case "category":
              case "sub_category":
                $sql = "SELECT name from Category WHERE code={$v['item_value']}";
                break;
              default:
                $sql = "SELECT name from {$form[$v['item_title']]['item']} WHERE code={$v['item_value']}";
            }
            
            $r = $mng->GetResult($sql);
            if($r){
              $r = $mng->DecodeData($r);
              $d[$v["code"]][$v["item_title"]][] = $r[0]["name"];
            }
            break;
          case "checkbox":
            $d[$v["code"]][$v["item_title"]][] = $form[$v["item_title"]]["item"][$v["item_value"]];
            break;
          default:
            if($v["item_title"] == "items"){
              $d[$v["code"]][$v["item_title"]][] = $v["item_value"];
            }else{
              $d[$v["code"]][$v["item_title"]] = $v["item_value"];
            }
        }

      }
      if(!empty($_POST["count"])){
        $d = ["count" => count($d)];
      }
      #print_r($d);
      ksort($d);
      $d = array_values($d);
      header("Content-Type: application/json; charset=utf-8");
      echo json_encode($d);
      
    }
    exit;
  }elseif($_POST["mode"] == "searchCompany"){
#    print_r($_POST);
    $mng->GetDataJson();
    exit;
  }else{
    if(empty($_POST["mode"])){
      $_POST["mode"] = "new";
    }
    print_r($_POST);
    $r = $mng->RecordSeparateData();
    if(!empty($r) && $r!=1){
      $errorMsg = $r;
    }else{
      $_POST = array();
    }
  }
}



//formの中にDB連動ものがあるかどうか
$searchForm = $mng->SetDecodeFormItems($searchForm);
$SetForm = $mng->SetDecodeFormItems($SetForm);


$smarty->assign("action", $_SERVER["PHP_SELF"]);
$smarty->assign("form", $form);
$smarty->assign("SetForm", $SetForm);
$smarty->assign("itemForm", $searchForm);
$smarty->assign("actionVal", $mng->tmpl); 

$smarty->assign("target", "Sets");

$smarty->assign("title", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("DESCRIPTION", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("KEYWORDS", "{$title} ｜".BASE_ADMIN_TITLE."");
$smarty->assign("errorMsg", isset($errorMsg) ? $errorMsg : null);
$smarty->assign("adminData", isset($adminData) ? $errorMsg : null);
$smarty->assign("nav", nav);
$smarty->assign("actionVal", $mng->tmpl);

$smarty->display("{$mng->tmpl}.tpl");