<?php
require __DIR__."/../../vendor/autoload.php";
require __DIR__."/../../Classes/config/Admin/OrderAdress.php";
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




$headers = getallheaders();
#print_r($headers);
if(!empty($headers["file-key"])){
  $mng->config = __DIR__."/../../Classes/config/Admin/OrderAdress.php";
  $mng->action = "Admin/OrderAdress";
  $mng->upload_files();
  exit;
}



if($_POST){
  if($_POST["mode"] == "download"){
    $c = [];
    foreach($form as $k => $v){
      if(empty($v["name"])){
        continue;
      }elseif($v["type"] == "tel"){
        for($i=1;$i<=3;$i++){
          $c[] = $v["name"].$i;
        }
      }else{
        $c[] = $v["name"];
      }
    }
    
    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=AdressTemplate.csv");
    header("Content-Transfer-Encoding: binary");
    
    $fp = fopen('php://output', 'w');
    stream_filter_prepend($fp,'convert.iconv.utf-8/cp932');
    fputcsv($fp,$c);
    fclose($fp);

    exit;
    
  }elseif($_POST["mode"] == "search"){
    $mng->SerachAdress($table,$detailTabel);
    exit;

  }else{
    if(empty($_POST["mode"])){
      $_POST["mode"] = "new";
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



//formの中にDB連動ものがあるかどうか
$form = $mng->SetDecodeFormItems($form);



$smarty->assign("action", $_SERVER["PHP_SELF"]);
$smarty->assign("form", $form);
$smarty->assign("data", $data);
$smarty->assign("mng", $mng);
$smarty->assign("time", time());
$smarty->assign("actionVal","Admin/OrderAdress");

$smarty->assign("title", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("DESCRIPTION", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("KEYWORDS", "{$title} ｜".BASE_ADMIN_TITLE."");
$smarty->assign("errorMsg", isset($errorMsg) ? $errorMsg : null);
$smarty->assign("adminData", isset($adminData) ? $errorMsg : null);
$smarty->display('Admin/OrderAdress.tpl');