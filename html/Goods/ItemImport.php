<?php
require __DIR__."/../../vendor/autoload.php";
use Goods\Goods;
$mng = new Goods;


require __DIR__."/../../Classes/config/{$mng->tmpl}.php";

$smarty  = new Smarty;
$smarty->template_dir = dirname( __FILE__ ).'/../../templates';
$smarty->compile_dir  = dirname( __FILE__ ).'/../../templates_c';
$smarty->assign("css",array("bootstrap","bootstrap-responsive","style","basic","Goods"));


$headers = getallheaders();
#print_r($headers);
#exit;
if(!empty($headers["file-key"])){
  $mng->config = __DIR__."/../../Classes/config/".$mng->tmpl.".php";
  $mng->action = $mng->tmpl;
  $mng->upload_files();
  exit;
}


#print_r($form);



$smarty->assign("title", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("DESCRIPTION", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("KEYWORDS", "{$title} ｜".BASE_ADMIN_TITLE."");
$smarty->assign("errorMsg", isset($errorMsg) ? $errorMsg : null);
$smarty->assign("adminData", isset($adminData) ? $errorMsg : null);
$smarty->assign("nav", nav);
$smarty->assign("actionVal", $mng->tmpl);

$smarty->display("{$mng->tmpl}.tpl");