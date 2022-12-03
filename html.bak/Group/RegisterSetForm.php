<?php
require __DIR__."/../../vendor/autoload.php";
require __DIR__."/../../Classes/config/Group/RegisterSetForm.php";
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

$smarty  = new Smarty;
$smarty->template_dir = dirname( __FILE__ ).'/../../templates';
$smarty->compile_dir  = dirname( __FILE__ ).'/../../templates_c';
#print_r($_POST);

if(!empty($_POST)){
  if($_POST["mode"] == "search"){
    $mng->SerachItems($form,$SerachTable,$SerachdetailTabel);
    exit;
  }elseif($_POST["mode"] == "searchCompany"){
    $mng->GetDataJson();
    exit;
  }elseif($_POST["mode"] == "edit"){
    #print_r($_POST);
    $_POST["mode"] = "EditMode"; 
    $data = $mng->SerachItems($form,$table,$detailTabel,[$SerachTable,$SerachdetailTabel],1);
    #print_r($data);
    if($data){
      foreach($data[0] as $k => $v){
        $_POST[$k] = $v;
      }
      #print_r($_POST);
    }
    #exit;
  }else{
    #print_r($_POST);
    if(empty($_POST["mode"])){
      $_POST["mode"] = "new";
    }elseif($_POST["mode"] == "editRegister"){
      $_POST["mode"] = "edit";
    }
    #print_r($_POST);
    $r = $mng->RecordSeparateData();
    #exit;
    if(!empty($r) && $r!=1){
      $errorMsg = $r;
      echo $errorMsg;
    }else{
      $_POST = array();
      header("Location:"._BASE_URL_."/ItemSet/Index");
    }
  }
}



//formの中にDB連動ものがあるかどうか
$form = $mng->SetDecodeFormItems($form);
$searchForm = $mng->SetDecodeFormItems($searchForm);

$smarty->assign("action", $_SERVER["PHP_SELF"]);
$smarty->assign("form", $form);
$smarty->assign("searchForm", $searchForm);
$smarty->assign("data", $data);
$smarty->assign("actionVal","Group/RegisterSetForm");

$smarty->assign("title", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("DESCRIPTION", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("KEYWORDS", "{$title} ｜".BASE_ADMIN_TITLE."");
$smarty->assign("errorMsg", isset($errorMsg) ? $errorMsg : null);
$smarty->assign("adminData", isset($adminData) ? $errorMsg : null);
$smarty->display('Group/RegisterSetForm.tpl');