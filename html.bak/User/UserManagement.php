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


if(!empty($_POST)){
  if($_POST["mode"] == "edit"){
    $mng->RecordUserData();
    header("Location:"._BASE_URL_."/User/UserManagement");
  }
}

$smarty  = new Smarty;
$smarty->template_dir = dirname( __FILE__ ).'/../../templates';
$smarty->compile_dir  = dirname( __FILE__ ).'/../../templates_c';

$sql = "select *,C.name as GroupIdList from $table as U,$detailTabel as T,Company as C where U.id=T.user_id AND C.code=T.GroupIdList AND U.email='".$_SESSION["user"]."' order by T.code DESC";
#echo $sql;
$data = $mng->GetResult($sql);
if($data){
  $data = $mng->DecodeData($data);
  $data = $data[0];
}
$form = $mng->SetDecodeFormItems($form);


$smarty->assign("data", $data);
$smarty->assign("form", $form);
$smarty->assign("actionVal","UserManagement/Index");
$smarty->assign("title", "{$_title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("DESCRIPTION", "ダッシュボード｜".BASE_ADMIN_TITLE."");
$smarty->assign("KEYWORDS", "ダッシュボード ｜".BASE_ADMIN_TITLE."");
$smarty->assign("news", isset($news) ? $news : null);
$smarty->assign("errorMsg", isset($errorMsg) ? $errorMsg : null);
$smarty->assign("adminData", isset($adminData) ? $errorMsg : null);
$smarty->display("User/User/{$f}.tpl");