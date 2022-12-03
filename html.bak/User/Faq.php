<?php
$f = explode(".", basename(__FILE__));
$f = $f[0];

require __DIR__."/../../vendor/autoload.php";
require __DIR__."/../../Classes/config/User/{$f}.php";
use Manage\manage;
$mng = new manage;

if(empty($_SESSION["login"])){
  header("Location:"._BASE_URL_."/login.php");
}


$smarty  = new Smarty;
$smarty->template_dir = dirname( __FILE__ ).'/../../templates';
$smarty->compile_dir  = dirname( __FILE__ ).'/../../templates_c';

$faq = $mng->GetFaq($cat,$cont);

$smarty->assign("status", $OrderTable["status"]["item"]);
$smarty->assign("title", "{$_title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("DESCRIPTION", "ダッシュボード｜".BASE_ADMIN_TITLE."");
$smarty->assign("KEYWORDS", "ダッシュボード ｜".BASE_ADMIN_TITLE."");
$smarty->assign("faq", isset($faq) ? $faq : null);
$smarty->assign("errorMsg", isset($errorMsg) ? $errorMsg : null);
$smarty->assign("adminData", isset($adminData) ? $errorMsg : null);
$smarty->display("User/User/{$f}.tpl");