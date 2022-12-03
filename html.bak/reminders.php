<?php
use Manage\manage;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Database\Capsule\Manager as Capsule;
require __DIR__."/../vendor/autoload.php";
$mng = new manage;
$smarty  = new Smarty;
$smarty->template_dir = dirname( __FILE__ ).'/../templates';
$smarty->compile_dir  = dirname( __FILE__ ).'/../templates_c';

foreach($_GET as $k => $v){
  $_POST[$k] = $v;
}

if(!empty($_POST)){
  switch($_POST["mode"]){
    case "search":
      $user = $mng->UserDataChk();
      if(is_null($user[0])){
        echo "メールアドレス「{$_POST['email']}」は登録されていません";
      }
      exit;
      break;
    
    case "reminder":
      $user = $mng->UserDataChk();
      $mng->ReminderUserMail($user);
      #print_r($user);
      exit;
      break;
    
    case "reset":
      #print_r($_POST);
      $mng->UserPasswordReset();
      exit;
      break;
  }
  
}





$smarty->assign("title", "メールアドレス再送｜".BASE_ADMIN_TITLE."");
$smarty->assign("DESCRIPTION", "メールアドレス再送｜".BASE_ADMIN_TITLE."");
$smarty->assign("KEYWORDS", "メールアドレス再送｜".BASE_ADMIN_TITLE."");
$smarty->assign("errorMsg", isset($errorMsg) ? $mng->errorMsg : null);
$smarty->assign("t", time());
$smarty->assign("adminData", isset($adminData) ? $errorMsg : null);
$smarty->display('reminders.tpl');