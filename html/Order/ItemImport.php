<?php
require __DIR__."/../../vendor/autoload.php";
use Manage\manage;
$mng = new manage;

require __DIR__."/../../Classes/config/{$mng->tmpl}.php";
$smarty  = new Smarty;
$smarty->template_dir = dirname( __FILE__ ).'/../../templates';
$smarty->compile_dir  = dirname( __FILE__ ).'/../../templates_c';
$smarty->assign("css",array("bootstrap","bootstrap-responsive","style","basic","Order"));





$headers = getallheaders();
#print_r($headers);
if(!empty($headers["File-Key"])){
  $mng->config = __DIR__."/../../Classes/config/Admin/ItemRegister.php";
  $mng->action = $mng->tmpl;
  $mng->upload_files();
  exit;
}


$smarty->assign("title", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("DESCRIPTION", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("KEYWORDS", "{$title} ｜".BASE_ADMIN_TITLE."");
$smarty->assign("errorMsg", isset($errorMsg) ? $errorMsg : null);
$smarty->assign("adminData", isset($adminData) ? $errorMsg : null);
$smarty->assign("nav", nav);
$smarty->assign("actionVal", $mng->tmpl);

$smarty->display("{$mng->tmpl}.tpl");


