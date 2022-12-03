<?php
require __DIR__."/../../vendor/autoload.php";
require __DIR__."/../../Classes/config/Goods/Index.php";
use Manage\manage;
$mng = new manage;

if(empty($_SESSION["login"])){
  header("Location:"._BASE_URL_."/login.php");
}

foreach($_GET as $k => $v){
  $_POST[$k] = $v;
}

//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');
// トークン生成
if (!isset($_SESSION['token'])) {
  $_SESSION['token'] = sha1(random_bytes(30));
}


if(!empty($_POST)){
  if($_POST["mode"] == "searchCompany"){
    $mng->GetDataJson();
    exit;
  }elseif($_POST["mode"] == "delete"){
    $mng->DeleteItemSetData("item");
    exit;
  }
}

$smarty  = new Smarty;
$smarty->template_dir = dirname( __FILE__ ).'/../../templates';
$smarty->compile_dir  = dirname( __FILE__ ).'/../../templates_c';




$itemForm = $mng->SetDecodeFormItems($itemForm);


$smarty->assign("form", $form);
$smarty->assign("data", $data);
$smarty->assign("itemForm", $itemForm);
$smarty->assign("title", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("DESCRIPTION", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("KEYWORDS", "{$title} ｜".BASE_ADMIN_TITLE."");
$smarty->assign("errorMsg", isset($errorMsg) ? $errorMsg : null);
$smarty->assign("adminData", isset($adminData) ? $errorMsg : null);
$smarty->display('Goods/Index.tpl');