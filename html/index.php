<?php
#session_destroy();
require __DIR__."/../vendor/autoload.php";
require __DIR__."/../Classes/config/Order/Management.php";
use Manage\manage;
$mng = new manage;

$smarty  = new Smarty;
$smarty->template_dir = dirname( __FILE__ ).'/../templates';
$smarty->compile_dir  = dirname( __FILE__ ).'/../templates_c';


#print_r($_SESSION);

 

$smarty->assign("css",array("bootstrap.min","bootstrap-responsive.min","style","basic"));
$smarty->assign("js",array("basic"));
$title = "";


$smarty->assign("status", $OrderTable["status"]["item"]);
$smarty->assign("title", "$title｜".BASE_ADMIN_TITLE."");
$smarty->assign("DESCRIPTION", "$title｜".BASE_ADMIN_TITLE."");
$smarty->assign("KEYWORDS", "$title｜".BASE_ADMIN_TITLE."");
$smarty->assign("errorMsg", isset($errorMsg) ? $mng->errorMsg : null);
$smarty->assign("adminData", isset($adminData) ? $errorMsg : null);
if($_SESSION["role"] == "admin"){
  $smarty->assign("nav",nav);
  $smarty->display('index.tpl');
}elseif($_SESSION["role"] == "master"){
  $smarty->assign("nav",nav);
  $smarty->display('Master/index.tpl');
}else{
  $smarty->assign("nav",UserNav);
  $smarty->display('User/index.tpl');
}