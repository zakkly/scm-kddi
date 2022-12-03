<?php
require __DIR__."/../../vendor/autoload.php";
require __DIR__."/../../Classes/config/Goods/ItemRegister.php";
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


//単位
if(is_array($form["unit"])){
  #$form["unit"]["items"] = $mng->SetUnitType();
}

$smarty  = new Smarty;
$smarty->template_dir = dirname( __FILE__ ).'/../../templates';
$smarty->compile_dir  = dirname( __FILE__ ).'/../../templates_c';


if(!empty($_POST)){
  #print_r($_POST);
  if(!(hash_equals($_POST["token"], $_SESSION['token']) && !empty($_POST["token"])) && $_POST["type"] != "ajax") {
    $errorMsg =  "起動方法が不正です";
  }else{
    if(empty($_POST["mode"])){
      $_POST["mode"] = "new";
    }
    switch($_POST["mode"]){
      case "search":
        $mng->GetDataJson();
        exit;
        break;
      case "searchCompany":
        $mng->GetDataJson();
        exit;
        break;
      case "EditMode":
        $r = $mng->SerachItems($form,$table,$detailTabel,[],1);
        if(is_array($r[0])){
          foreach($r[0] as $k => $v){
            $_POST[$k] =$v;
          }
        }
        $post = $r;
        break;
      default:
        #print_r($_POST);
        #exit;
        $r = $mng->RecordSeparateData();
        if(!empty($r) && $r!=1){
          $errorMsg = $r;
        }else{
          $_POST = array();
          header("Location:"._BASE_URL_."/Goods/Index");
        }
    }
  }
}


//formの中にDB連動ものがあるかどうか
$form = $mng->SetDecodeFormItems($form);
#print_r($form);



$sql = "select * from $table order by code DESC";
$data = $mng->GetResult($sql);
if($data){
  $data = $mng->DecodeData($data);
}




$smarty->assign("action", $_SERVER["PHP_SELF"]);
$smarty->assign("form", $form);
$smarty->assign("post", $post);
$smarty->assign("actionVal","Goods/ItemRegister");
$smarty->assign("title", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("DESCRIPTION", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("KEYWORDS", "{$title} ｜".BASE_ADMIN_TITLE."");
$smarty->assign("errorMsg", isset($errorMsg) ? $errorMsg : null);
$smarty->assign("adminData", isset($adminData) ? $errorMsg : null);
$smarty->display('Goods/ItemRegister.tpl');