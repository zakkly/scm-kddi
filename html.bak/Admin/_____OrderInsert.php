<?php
require __DIR__."/../../vendor/autoload.php";
require __DIR__."/../../Classes/config/Admin/OrderInsert.php";
use Manage\manage;
$mng = new manage;


if(empty($_SESSION["login"])){
  header("Location:"._BASE_URL_."/login.php");
}
//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');
// トークン生成
if (!isset($_SESSION['token'])) {
  $_SESSION['token'] = sha1(random_bytes(30));
}

foreach($_GET as $k => $v){
  $_POST[$k] = $v;
}

$smarty  = new Smarty;
$smarty->template_dir = dirname( __FILE__ ).'/../../templates';
$smarty->compile_dir  = dirname( __FILE__ ).'/../../templates_c';
if(!empty($_POST)){
  if(!empty($_POST["token"]) && !(hash_equals($_POST["token"], $_SESSION['token'])) && $_POST["type"] != "ajax") {
    $errorMsg =  "起動方法が不正です";
    echo $_POST["token"]."<br>";
    echo $_SESSION["token"];
    echo $errorMsg;
    exit;
  }elseif($_POST["mode"] == "Adress"){
    #print_r($_POST);
    $mng->SerachAdress($AdressTable,$AdressDetailTable);
    exit;
  }elseif($_POST["mode"] == "order"){
    print_r($_POST);
    $_POST["mode"] = "new";
    $r = $mng->RecordSeparateData();
    exit;
  }elseif($_POST["mode"] == "search"){
    #print_r($_POST);
    if(!empty($_POST["set"])){
      $mng->SerachItems($form,$SetTable,$SetDetailTabel,[$SerachTable,$SerachdetailTabel]);
    }else{
      $mng->SerachItems($form,$SerachTable,$SerachdetailTabel);
    }
    exit;
  }elseif($_POST["mode"] == "searchCompany"){
    $mng->GetDataJson();
    exit;
  }else{
  }
}

//formの中にDB連動ものがあるかどうか
$form = $mng->SetDecodeFormItems($form);
$itemForm = $mng->SetDecodeFormItems($itemForm);
$searchForm = $mng->SetDecodeFormItems($searchForm);

#print_r($itemForm);

$smarty->assign("actionVal","Admin/OrderInsert");
$smarty->assign("form", $form);
$smarty->assign("itemForm", $itemForm);
$smarty->assign("searchForm", $searchForm);
$smarty->assign("AdressForm", $AdressForm);
$smarty->assign("title", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("DESCRIPTION", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("KEYWORDS", "{$title} ｜".BASE_ADMIN_TITLE."");
$smarty->assign("errorMsg", isset($errorMsg) ? $errorMsg : null);
$smarty->assign("adminData", isset($adminData) ? $errorMsg : null);
$smarty->display('Admin/OrderInsert.tpl');