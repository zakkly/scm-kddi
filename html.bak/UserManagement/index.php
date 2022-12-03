<?php
require __DIR__."/../../vendor/autoload.php";
require __DIR__."/../../Classes/config/UserManagement/Index.php";
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
$mng = new manage;


if(!empty($_POST)){
  if($_POST["mode"] == "search"){
  }elseif($_POST["mode"] == "delete"){
    $r = $mng->DeleteUserData();
    $errorMsg = $r;
    exit;
  }else{
    if(empty($_POST["code"])){
      $_POST["mode"] = "new";
    }
    $r = $mng->RecordUserData();
    if(!empty($r)){
      $errorMsg = $r;
    }else{
      $_POST = array();
    }
  }
}



$sql = "select *,C.name as GroupIdList from $table as U,$detailTabel as T,Company as C where U.id=T.user_id AND C.code=T.GroupIdList order by T.code DESC";
$data = $mng->GetResult($sql);
if($data){
  $data = $mng->DecodeData($data);
}

#echo $sql;
#print_r($data);

//formの中にDB連動ものがあるかどうか
$form = $mng->SetDecodeFormItems($form);

$smarty->assign("action", $_SERVER["PHP_SELF"]);
$smarty->assign("form", $form);
$smarty->assign("data", $data);
$smarty->assign("mng", $mng);
$smarty->assign("actionVal","UserManagement/Index");
$smarty->assign("title", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("DESCRIPTION", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("KEYWORDS", "{$title} ｜".BASE_ADMIN_TITLE."");
$smarty->assign("errorMsg", isset($errorMsg) ? $errorMsg : null);
$smarty->assign("adminData", isset($adminData) ? $errorMsg : null);
$smarty->display('UserManagement/index.tpl');