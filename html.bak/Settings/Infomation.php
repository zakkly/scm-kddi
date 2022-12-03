<?php
require __DIR__."/../../vendor/autoload.php";
require __DIR__."/../../Classes/config/Settings/Infomation.php";
use Manage\manage;
$mng = new manage;

if(empty($_SESSION["login"])){
  header("Location:"._BASE_URL_."/login.php");
}

foreach($_GET as $k => $v){
  $_POST[$k] = $v;
}

//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');
// トークン生成
if (!isset($_SESSION['token'])) {
  $_SESSION['token'] = sha1(random_bytes(30));
}

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
    $sql = "SELECT * from $table";
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
        $d[$v["code"]]["contents"] = str_replace("<br>","\n",$v["contents"]);
        $d[$v["code"]]["code"] = $v["code"];
      }
      if(!empty($_POST["count"])){
        $d = ["count" => count($d)];
      }
      $d = array_values($d);
      rsort($d);
      #print_r($d);
      header("Content-Type: application/json; charset=utf-8");
      echo json_encode($d);
      
    }
    exit;
  }else{
    if(empty($_POST["code"])){
      $_POST["mode"] = "new";
    }
    #print_r($_POST);
    
    if(is_array($_POST["Company"])){
      $r = $mng->RecordCheckboxData();
    }else{
      $r = $mng->RecordData();
      #exit;
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

$smarty  = new Smarty;
$smarty->template_dir = dirname( __FILE__ ).'/../../templates';
$smarty->compile_dir  = dirname( __FILE__ ).'/../../templates_c';




$smarty->assign("form", $form);
$smarty->assign("data", $data);
$smarty->assign("itemForm", $itemForm);
$smarty->assign("action", $_SERVER["PHP_SELF"]);
$smarty->assign("actionVal", "Settings/Infomation");
$smarty->assign("title", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("titleIn", "{$title}");
$smarty->assign("DESCRIPTION", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("KEYWORDS", "{$title} ｜".BASE_ADMIN_TITLE."");
$smarty->assign("errorMsg", isset($errorMsg) ? $errorMsg : null);
$smarty->assign("adminData", isset($adminData) ? $errorMsg : null);
$smarty->display('Settings/Infomation.tpl');