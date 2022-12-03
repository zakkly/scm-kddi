<?php
require __DIR__."/../../vendor/autoload.php";
use Goods\Goods;
$mng = new Goods;


require __DIR__."/../../Classes/config/{$mng->tmpl}.php";
$smarty  = new Smarty;
$smarty->template_dir = dirname( __FILE__ ).'/../../templates';
$smarty->compile_dir  = dirname( __FILE__ ).'/../../templates_c';

$smarty->assign("css",array("bootstrap.min","style","basic","Search","Goods"));
#$smarty->assign("js",array("js"));


if(!empty($_POST)){
  if($_POST["mode"] == "searchCompany"){
    $mng->GetDataJson();
    exit;
  }elseif($_POST["mode"] == "delete"){
    $mng->DeleteItemSetData("item");
    exit;
  }
}



$itemForm = $mng->SetDecodeFormItems($itemForm);


$smarty->assign("form", $form);
$smarty->assign("data", $data);
$smarty->assign("itemForm", $itemForm);
$smarty->assign("title", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("DESCRIPTION", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("KEYWORDS", "{$title} ｜".BASE_ADMIN_TITLE."");
$smarty->assign("errorMsg", isset($errorMsg) ? $errorMsg : null);
$smarty->assign("adminData", isset($adminData) ? $errorMsg : null);
$smarty->assign("nav", nav);
$smarty->assign("target", "Items");
$smarty->assign("actionVal", $mng->tmpl);
$smarty->display($mng->tmpl.'.tpl');