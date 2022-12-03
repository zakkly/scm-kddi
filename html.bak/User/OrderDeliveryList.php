<?php
$f = explode(".", basename(__FILE__));
$f = $f[0];

require __DIR__."/../../vendor/autoload.php";
require __DIR__."/../../Classes/config/User/{$f}.php";
require __DIR__."/../../Classes/config/Admin/OrderAdress.php";
use Manage\manage;
$mng = new manage;

if(empty($_SESSION["login"])){
  header("Location:"._BASE_URL_."/login.php");
}
if(!empty($_POST)){
  #print_r($_POST);
  if($_POST["mode"] == "search"){
    $_POST["Company"] = $_SESSION["role"];
    $mng->SerachAdress($table,$detailTabel);
    exit;
  }else{
    #print_r($_POST);
    if(empty($_POST["mode"])){
      $_POST["mode"] = "new";
    }
    
    if(empty($_POST["action"])){
      $_POST["action"] = "Admin/OrderAdress";
    }
    #print_r($_POST);
    $r = $mng->RecordData();
    if(!empty($r)){
      $errorMsg = $r;
    }else{
      $_POST = array();
    }
  }
}


$smarty  = new Smarty;
$smarty->template_dir = dirname( __FILE__ ).'/../../templates';
$smarty->compile_dir  = dirname( __FILE__ ).'/../../templates_c';


#print_r($_SESSION);
//formの中にDB連動ものがあるかどうか
$form = $mng->SetDecodeFormItems($form);

$smarty->assign("form", $form);
$smarty->assign("r", $r);
$smarty->assign("actionVal","Admin/OrderAdress");
$smarty->assign("status", $OrderTable["status"]["item"]);
$smarty->assign("title", "{$_title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("DESCRIPTION", "ダッシュボード｜".BASE_ADMIN_TITLE."");
$smarty->assign("KEYWORDS", "ダッシュボード ｜".BASE_ADMIN_TITLE."");
$smarty->assign("news", isset($news) ? $news : null);
$smarty->assign("errorMsg", isset($errorMsg) ? $errorMsg : null);
$smarty->assign("adminData", isset($adminData) ? $errorMsg : null);
$smarty->display("User/User/{$f}.tpl");