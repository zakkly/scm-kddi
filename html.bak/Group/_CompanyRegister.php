<?php
require __DIR__."/../../vendor/autoload.php";
require __DIR__."/../../Classes/config/Group/CompanyRegister.php";
use Manage\manage;
$mng = new manage;


if(empty($_SESSION["login"])){
  header("Location:"._BASE_URL_."/login.php");
}


$smarty  = new Smarty;
$smarty->template_dir = dirname( __FILE__ ).'/../../templates';
$smarty->compile_dir  = dirname( __FILE__ ).'/../../templates_c';
$mng = new manage;




$headers = getallheaders();
#print_r($headers);
#print_r($_POST);
if(!empty($headers["file-key"])){
  $mng->config = __DIR__."/../../Classes/config/Group/CompanyRegister.php";
  $mng->action = "Group/CompanyRegister";
  $mng->upload_files();
  exit;
}


if(!empty($_POST)){
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
    header("Content-Disposition: attachment; filename=CompanyRegister.csv");
    header("Content-Transfer-Encoding: binary");
    
    $fp = fopen('php://output', 'w');
    stream_filter_prepend($fp,'convert.iconv.utf-8/cp932');
    fputcsv($fp,$c);
    fclose($fp);

    exit;
  }else{
    if(empty($_POST["code"])){
      $_POST["mode"] = "new";
    }
    $r = $mng->RecordData();
    if(!empty($r)){
      $errorMsg = $r;
    }else{
      $success = 1;
    }
    exit;
  }
}elseif(!empty($headers["File-Name"])){
  if(empty($_POST["code"])){
    $_POST["mode"] = "new";
  }
  $r = $mng->RecordData();
  if(!empty($r)){
    $errorMsg = $r;
  }else{
    $success = 1;
  }
  exit;
}


$sql = "select * from $table order by code DESC";
$data = $mng->GetResult($sql);
if($data){
  $data = $mng->DecodeData($data);
}




$smarty->assign("action", $_SERVER["PHP_SELF"]);
$smarty->assign("form", $form);
$smarty->assign("data", $data);
$smarty->assign("actionVal","Group/CompanyRegister");
$smarty->assign("title", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("DESCRIPTION", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("KEYWORDS", "{$title} ｜".BASE_ADMIN_TITLE."");
$smarty->assign("errorMsg", isset($errorMsg) ? $errorMsg : null);
$smarty->assign("success", isset($success) ? $success : null);
$smarty->assign("adminData", isset($adminData) ? $errorMsg : null);
$smarty->display('Group/CompanyRegister.tpl');