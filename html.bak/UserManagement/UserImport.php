<?php
require __DIR__."/../../vendor/autoload.php";
require __DIR__."/../../Classes/config/UserManagement/UserImport.php";
use Manage\manage;
$mng = new manage;

if(empty($_SESSION["login"])){
  header("Location:"._BASE_URL_."/login.php");
}




//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');
// トークン生成
if (!isset($_SESSION['token'])) {
  $_SESSION['token'] = sha1(random_bytes(30));
}

$smarty  = new Smarty;
$smarty->template_dir = dirname( __FILE__ ).'/../../templates';
$smarty->compile_dir  = dirname( __FILE__ ).'/../../templates_c';
$mng = new manage;


$headers = getallheaders();
#print_r($headers);
if(!empty($headers["file-key"])){
  $mng->config = __DIR__."/../../Classes/config/UserManagement/index.php";
  $mng->action = "UserManagement/index";
  $mng->upload_files();
  exit;
}


$smarty->assign("action", $_SERVER["PHP_SELF"]);
$smarty->assign("form", $form);
$smarty->assign("data", $data);
$smarty->assign("mng", $mng);
$smarty->assign("t", time());
$smarty->assign("actionVal","UserManagement/Index");
$smarty->assign("title", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("DESCRIPTION", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("KEYWORDS", "{$title} ｜".BASE_ADMIN_TITLE."");
$smarty->assign("errorMsg", isset($errorMsg) ? $errorMsg : null);
$smarty->assign("adminData", isset($adminData) ? $errorMsg : null);
$smarty->display('UserManagement/UserImport.tpl');