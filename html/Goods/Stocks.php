<?php
require __DIR__."/../../vendor/autoload.php";
use Goods\Goods;
$mng = new Goods;


require __DIR__."/../../Classes/config/Goods/Index.php";
$smarty  = new Smarty;
$smarty->template_dir = dirname( __FILE__ ).'/../../templates';
$smarty->compile_dir  = dirname( __FILE__ ).'/../../templates_c';


$smarty->assign("css",array("bootstrap","bootstrap-responsive.min","style","basic","Goods"));


$sql = "select * from $table order by code DESC";
$data = $mng->GetResult($sql);
if($data){
  $data = $mng->DecodeData($data);
}



$smarty->assign("action", $_SERVER["PHP_SELF"]);
$smarty->assign("form", $form);
$smarty->assign("post", $post);
$smarty->assign("title", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("DESCRIPTION", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("KEYWORDS", "{$title} ｜".BASE_ADMIN_TITLE."");
$smarty->assign("errorMsg", isset($errorMsg) ? $errorMsg : null);
$smarty->assign("adminData", isset($adminData) ? $errorMsg : null);
$smarty->assign("nav", nav);
$smarty->assign("actionVal",$mng->tmpl);

$smarty->display("{$mng->tmpl}.tpl");


