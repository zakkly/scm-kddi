<?php
require __DIR__."/../../vendor/autoload.php";

if(empty($_SESSION["login"])){
  header("Location:"._BASE_URL_."/login.php");
}

$smarty  = new Smarty;
$smarty->template_dir = dirname( __FILE__ ).'/../../templates';
$smarty->compile_dir  = dirname( __FILE__ ).'/../../templates_c';





$smarty->assign("title", "商品マスター｜".BASE_ADMIN_TITLE."");
$smarty->assign("DESCRIPTION", "商品マスター｜".BASE_ADMIN_TITLE."");
$smarty->assign("KEYWORDS", "商品マスター ｜".BASE_ADMIN_TITLE."");
$smarty->assign("errorMsg", isset($errorMsg) ? $errorMsg : null);
$smarty->assign("adminData", isset($adminData) ? $errorMsg : null);
$smarty->display('dashboard.tpl');