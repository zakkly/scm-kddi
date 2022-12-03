<?php
require __DIR__."/../../vendor/autoload.php";
require __DIR__."/../../Classes/config/Settings/Faq.php";
use Manage\manage;
$mng = new manage;


require __DIR__."/../../Classes/config/{$mng->tmpl}.php";

$smarty  = new Smarty;
$smarty->template_dir = dirname( __FILE__ ).'/../../templates';
$smarty->compile_dir  = dirname( __FILE__ ).'/../../templates_c';
$smarty->assign("css",array("bootstrap.min","bootstrap-responsive.min","style","basic"));


if(!empty($_POST)){
  if($_POST["mode"] == "search"){
    $query = [];
    #print_r($_POST);
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
    $sql = "SELECT * from $table WHERE title != ''";
    #echo $sql."\n";
    
    $cat = $mng->GetResult("SELECT code,title from faq_category");
    if($cat){
      $cat = $mng->DecodeData($cat,"code");
    }
    
    $data = $mng->GetResult($sql);
    if($data){
      if(!empty($_POST["count"])){
        $data = $mng->DecodeData($data);
        $data = ["count" => count($data)];
      }else{
        $data = $mng->DecodeData($data);
      }
      #print_r($data);
      $d = [];
      foreach($data as $k => $v){
        $d[$v["code"]]["title"] = $v["title"];
        $d[$v["code"]]["category"] = $v["category"];
        $d[$v["code"]]["contents"] = str_replace("<br>","\n",$v["contents"]);
        $d[$v["code"]]["category_view"] = $cat[$v["category"]]["title"];
        $d[$v["code"]]["code"] = $v["code"];
      }
      if(!empty($_POST["count"])){
        $d = ["count" => count($d)];
      }
      $d = array_values($d);
      header("Content-Type: application/json; charset=utf-8");
      echo json_encode($d);
      
    }
    exit;
  }else{
    if(empty($_POST["code"])){
      $_POST["mode"] = "new";
    }
    if(is_array($_POST["Company"])){
      $r = $mng->RecordCheckboxData();
    }else{
      $r = $mng->RecordData();
    }
    
    if(!empty($r)){
      $errorMsg = $r;
    }else{
      $_POST = array();
      $_SESSION["result"] = 1;
      $success = 1;
    }
  }
}

print_r($data);


$smarty->assign("form", $form);
$smarty->assign("data", $data);
$smarty->assign("itemForm", $itemForm);
$smarty->assign("action", $_SERVER["PHP_SELF"]);
$smarty->assign("title", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("titleIn", "{$title}");
$smarty->assign("DESCRIPTION", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("KEYWORDS", "{$title} ｜".BASE_ADMIN_TITLE."");
$smarty->assign("errorMsg", isset($errorMsg) ? $errorMsg : null);
$smarty->assign("adminData", isset($adminData) ? $errorMsg : null);
$smarty->assign("nav", nav);
$smarty->assign("actionVal", $mng->tmpl);

$smarty->display("{$mng->tmpl}.tpl");