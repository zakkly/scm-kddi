<?php
require __DIR__."/../../vendor/autoload.php";
use Manage\manage;
$mng = new manage;


require __DIR__."/../../Classes/config/{$mng->tmpl}.php";

$smarty  = new Smarty;
$smarty->template_dir = dirname( __FILE__ ).'/../../templates';
$smarty->compile_dir  = dirname( __FILE__ ).'/../../templates_c';


$smarty->assign("css",array("bootstrap.min","bootstrap-responsive","style","basic"));


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
    $sql = "SELECT code,name from $table";
    #echo $sql."\n";
    
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
        $d[$v["code"]]["name"] = $v["name"];
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




$smarty->assign("form", $form);
$smarty->assign("data", $data);
$smarty->assign("itemForm", $itemForm);
$smarty->assign("action", $_SERVER["PHP_SELF"]);
$smarty->assign("actionVal", "Settings/unit");
$smarty->assign("title", "{$title}???".BASE_ADMIN_TITLE."");
$smarty->assign("DESCRIPTION", "{$title}???".BASE_ADMIN_TITLE."");
$smarty->assign("KEYWORDS", "{$title} ???".BASE_ADMIN_TITLE."");
$smarty->assign("errorMsg", isset($errorMsg) ? $errorMsg : null);
$smarty->assign("adminData", isset($adminData) ? $errorMsg : null);
$smarty->assign("nav", nav);
$smarty->assign("actionVal", $mng->tmpl);

$smarty->display("{$mng->tmpl}.tpl");

