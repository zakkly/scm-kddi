<?php
require __DIR__."/../../vendor/autoload.php";
use UserManagement\UserManagement;
$mng = new UserManagement;

require __DIR__."/../../Classes/config/{$mng->tmpl}.php";
$smarty  = new Smarty;
$smarty->template_dir = dirname( __FILE__ ).'/../../templates';
$smarty->compile_dir  = dirname( __FILE__ ).'/../../templates_c';
$smarty->assign("css",array("bootstrap.min","bootstrap-responsive.min","style","basic","Search","UserManagement"));


if(!empty($_POST)){
  if($_POST["mode"] == "search"){
  }elseif($_POST["mode"] == "delete"){
    $r = $mng->DeleteUserData();
    $errorMsg = $r;
    exit;
  }else{
    if(empty($_POST["code"])){
      $_POST["mode"] = "new";
    }
    $r = $mng->RecordUserData();
    if(!empty($r)){
      $errorMsg = $r;
    }else{
      $_POST = array();
    }
  }
}



$sql = "select *,C.name as GroupIdList from $table as U,$detailTabel as T,Company as C where U.id=T.user_id AND C.code=T.GroupIdList order by T.code DESC";
$data = $mng->GetResult($sql);
if($data){
  $data = $mng->DecodeData($data);
}

#echo $sql;
#print_r($data);

//formの中にDB連動ものがあるかどうか
$form = $mng->SetDecodeFormItems($form);

$smarty->assign("action", $_SERVER["PHP_SELF"]);
$smarty->assign("form", $form);
$smarty->assign("data", $data);
$smarty->assign("itemForm", $form);
$smarty->assign("mng", $mng);
$smarty->assign("title", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("DESCRIPTION", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("KEYWORDS", "{$title} ｜".BASE_ADMIN_TITLE."");
$smarty->assign("errorMsg", isset($errorMsg) ? $errorMsg : null);
$smarty->assign("adminData", isset($adminData) ? $errorMsg : null);
$smarty->assign("nav", nav);
$smarty->assign("actionVal",$mng->tmpl);
$smarty->assign("target","users");

$smarty->display("{$mng->tmpl}.tpl");


