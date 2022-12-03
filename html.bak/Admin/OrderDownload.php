<?php
require __DIR__."/../../vendor/autoload.php";
require __DIR__."/../../Classes/config/Admin/OrderManagement.php";
use Manage\manage;
$mng = new manage;


if(empty($_SESSION["login"])){
  header("Location:"._BASE_URL_."/login.php");
}

$smarty  = new Smarty;
$smarty->template_dir = dirname( __FILE__ ).'/../../templates';
$smarty->compile_dir  = dirname( __FILE__ ).'/../../templates_c';




$smarty->assign("title", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("DESCRIPTION", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("KEYWORDS", "{$title} ｜".BASE_ADMIN_TITLE."");
$smarty->assign("errorMsg", isset($errorMsg) ? $errorMsg : null);
$smarty->assign("adminData", isset($adminData) ? $errorMsg : null);
$smarty->display('Admin/OrderManagement.tpl');