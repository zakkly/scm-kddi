<?php
require __DIR__."/../../vendor/autoload.php";
use Manage\manage;
$mng = new manage;


require __DIR__."/../../Classes/config/{$mng->tmpl}.php";
$smarty  = new Smarty;
$smarty->template_dir = dirname( __FILE__ ).'/../../templates';
$smarty->compile_dir  = dirname( __FILE__ ).'/../../templates_c';


$smarty->assign("css",array("bootstrap.min","bootstrap-responsive.min","style","basic","Goods"));

if(!empty($_POST)){
  if(!(hash_equals($_POST["token"], $_SESSION['token']) && !empty($_POST["token"])) && $_POST["type"] != "ajax") {
    $errorMsg =  "起動方法が不正です";
  }else{
    if(empty($_POST["code"])){
      $_POST["mode"] = "new";
    }
    if(!empty($_POST["Company"])){
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


//登録データ取得
$sql = "select * from $table order by code ASC";
$data = $mng->GetResult($sql);
if(!empty($data->num_rows)){
  $data = $mng->DecodeData($data);
  $d = array();
  foreach($data as $k => $v){
    if(empty($v["parent"])){
      $v["item"] = array();
      $d[$v["code"]] = $v;
      
      $sql = "select * from $detailTabel WHERE c_category={$v['code']}";
      $r = $mng->GetResult($sql);
      if($r){
        $r = $mng->DecodeData($r);
        if(!empty($r)){
          foreach($r as $key => $val){
            $d[$v["code"]]["Company"][] = $val["c_company"];
          }
        }
      }
    }else{
      if(is_array($d[$v["parent"]])){
        $d[$v["parent"]]["item"][] = $v;
      }
    }
  }
  krsort($d);
  #print_r($d);
}


$sql = "select * from Company order by code ASC";
$data = $mng->GetResult($sql);
if(!empty($data->num_rows)){
  $data = $mng->DecodeData($data);
  $Company = array();
  foreach($data as $k => $v){
    if(empty($v["parent"])){
      $v["item"] = array();
      $Company[$v["code"]] = $v;
    }else{
      if(is_array($d[$v["parent"]])){
        $Company[$v["parent"]]["item"][] = $v;
      }
    }
  }
  if(is_array($Company) && !empty($Company)){
    krsort($Company);
  }
  #print_r($Company);
}


//formの中にDB連動ものがあるかどうか
$form = $mng->SetDecodeFormItems($form);



$smarty->assign("action", $_SERVER["PHP_SELF"]);
$smarty->assign("nav", nav);
$smarty->assign("form", $form);
$smarty->assign("data", $d);
$smarty->assign("Company", $Company);
$smarty->assign("actionVal","{$mng->tmpl}");
$smarty->assign("title", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("DESCRIPTION", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("KEYWORDS", "{$title} ｜".BASE_ADMIN_TITLE."");
$smarty->assign("errorMsg", isset($errorMsg) ? $errorMsg : null);
$smarty->assign("success", isset($success) ? $success : null);
$smarty->assign("adminData", isset($adminData) ? $errorMsg : null);
$smarty->display("{$mng->tmpl}.tpl");