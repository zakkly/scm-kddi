<?php
require __DIR__."/../../vendor/autoload.php";
use Order\Order;
$mng = new Order;
require __DIR__."/../../Classes/config/{$mng->tmpl}.php";


$smarty  = new Smarty;
$smarty->template_dir = dirname( __FILE__ ).'/../../templates';
$smarty->compile_dir  = dirname( __FILE__ ).'/../../templates_c';
$smarty->assign("css",array("bootstrap.min","bootstrap-responsive.min","style","basic","Search","Order"));




$form = $mng->SetDecodeFormItems($form);
#print_r($form);

$smarty->assign("form", $form);
$smarty->assign("itemForm", $form);
$smarty->assign("target", "Adress");
$smarty->assign("r", $r);
$smarty->assign("actionVal","Order/OrderAdress");
$smarty->assign("status", $OrderTable["status"]["item"]);
$smarty->assign("title", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("DESCRIPTION", "ダッシュボード｜".BASE_ADMIN_TITLE."");
$smarty->assign("KEYWORDS", "ダッシュボード ｜".BASE_ADMIN_TITLE."");
$smarty->assign("news", isset($news) ? $news : null);
$smarty->assign("errorMsg", isset($errorMsg) ? $errorMsg : null);
$smarty->assign("adminData", isset($adminData) ? $errorMsg : null);

if($_SESSION["role"] == "admin"){
  $smarty->assign("nav",nav);
}else{
  $smarty->assign("nav",UserNav);
}
$smarty->display("{$mng->tmpl}.tpl");