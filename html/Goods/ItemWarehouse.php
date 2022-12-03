<?php
require __DIR__."/../../vendor/autoload.php";
use Manage\manage;
$mng = new manage;


require __DIR__."/../../Classes/config/{$mng->tmpl}.php";
$smarty  = new Smarty;
$smarty->template_dir = dirname( __FILE__ ).'/../../templates';
$smarty->compile_dir  = dirname( __FILE__ ).'/../../templates_c';

$smarty->assign("css",array("bootstrap.min","bootstrap-responsive.min","style","basic","Search","Goods"));
$smarty->assign("js",array("js"));


if(!empty($_POST)){
  if($_POST["mode"] == "searchCompany"){
    $mng->GetDataJson();
    exit;
  }elseif($_POST["mode"] == "Warehouse"){
    if(empty($_POST["code"])){return false;}
    if(empty($_POST["stock"])){return false;}
    #print_r($_POST);
    //現在の在庫数取得
    $sql = "SELECT item_value FROM ItemValue WHERE item_id={$_POST['code']} AND item_title='stock'";
    #echo $sql;
    $r = $mng->GetResult($sql);
    if($r){
      $r = $mng->DecodeData($r);
      #print_r($r);
      $num = $r[0]["item_value"];
      $sql = "UPDATE ItemValue SET item_value=".($num+$_POST["stock"])." WHERE item_id={$_POST['code']} AND item_title='stock'";
      $mng->GetResult($sql);
    }
    #exit;
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
$smarty->assign("action", $mng->tmpl);
$smarty->assign("actionVal", $mng->tmpl);
$smarty->display($mng->tmpl.'.tpl');