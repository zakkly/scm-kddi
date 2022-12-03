<?php
require __DIR__."/../vendor/autoload.php";
require __DIR__."/../Classes/config/Admin/OrderManagement.php";
use Manage\manage;
$mng = new manage;

if(empty($_SESSION["login"])){
  header("Location:"._BASE_URL_."/login.php");
}

$smarty  = new Smarty;
$smarty->template_dir = dirname( __FILE__ ).'/../templates';
$smarty->compile_dir  = dirname( __FILE__ ).'/../templates_c';

#print_r($OrderTable);
#print_r($_SESSION);
$news = $mng->GetInfomation();

$smarty->assign("status", $OrderTable["status"]["item"]);
$smarty->assign("title", "ダッシュボード｜".BASE_ADMIN_TITLE."");
$smarty->assign("DESCRIPTION", "ダッシュボード｜".BASE_ADMIN_TITLE."");
$smarty->assign("KEYWORDS", "ダッシュボード ｜".BASE_ADMIN_TITLE."");
$smarty->assign("news", isset($news) ? $news : null);
$smarty->assign("errorMsg", isset($errorMsg) ? $errorMsg : null);
$smarty->assign("adminData", isset($adminData) ? $errorMsg : null);
if($_SESSION["role"] == "admin"){
  $smarty->display('dashboard.tpl');
}else{
  $smarty->display('User/dashboard.tpl');
}