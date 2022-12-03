<?php
require __DIR__."/../../vendor/autoload.php";
use Manage\manage;
$mng = new manage;

require __DIR__."/../../Classes/config/{$mng->tmpl}.php";

$smarty  = new Smarty;
$smarty->template_dir = dirname( __FILE__ ).'/../../templates';
$smarty->compile_dir  = dirname( __FILE__ ).'/../../templates_c';
$smarty->assign("css",array("bootstrap.min","bootstrap-responsive.min","style","basic","Search","Order"));



$headers = getallheaders();
#print_r($headers);
if(!empty($headers["file-key"])){
  $mng->config = __DIR__."/../../Classes/config/Order/OrderAdress.php";
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

#print_r($form);



$smarty->assign("target", "Adress");
$smarty->assign("action", $_SERVER["PHP_SELF"]);
$smarty->assign("itemForm", $form);
$smarty->assign("form", $form);
$smarty->assign("data", $data);
$smarty->assign("mng", $mng);
$smarty->assign("time", time());

$smarty->assign("title", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("DESCRIPTION", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("KEYWORDS", "{$title} ｜".BASE_ADMIN_TITLE."");
$smarty->assign("errorMsg", isset($errorMsg) ? $errorMsg : null);
$smarty->assign("adminData", isset($adminData) ? $errorMsg : null);
$smarty->assign("nav", nav);
$smarty->assign("actionVal", $mng->tmpl);

$smarty->display("{$mng->tmpl}.tpl");


