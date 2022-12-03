<?php
use Manage\manage;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Database\Capsule\Manager as Capsule;

require __DIR__."/../vendor/autoload.php";

$mng = new manage;
$smarty  = new Smarty;
$smarty->template_dir = dirname( __FILE__ ).'/../templates';
$smarty->compile_dir  = dirname( __FILE__ ).'/../templates_c';

#echo _BASE_URL_;
/*
if(!empty($_SESSION["login"])){
  header("Location:"._BASE_URL_);
}elseif($_SESSION["errorMsg"]){
  $mng->errorMsg = $_SESSION["errorMsg"];
}*/

/*
print_r($_SESSION);
session_destroy();
print_r($_SESSION);
exit;*/

if(!empty($_POST["username"]) && !empty($_POST["password"])){
  #Sentinel::logout();
  
  $request = [
    "email" => $_POST["username"],
    "password" => $_POST["password"],
    "remember" => $_POST["remember"]
  ];
  $credentials = [  
    'email'  => $_POST["username"],  
    'password' => $_POST["password"]
  ];
  
  $capsule = new Capsule;
  $capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => _SERVER_,
    'database'  => _DB_,      // データベース名を変更していたら合わせて変更
    'username'  => _USER_,          // xxxxを、データベースのユーザー名に変更
    'password'  => _PASS_,        // xxxxxxを、データベースのパスワードに変更
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
  ]);
  
  
  $capsule->bootEloquent();

  $_SESSION["errorMsg"] = "";
  try {
    $capsule->userInterface = Sentinel::authenticate($request);
  } catch (NotActivatedException $notactivated) {
    #return view('auth.login', [        'resend_code' => $_POST['email']    ])->withErrors([trans('sentinel.not_activation')]);
    $_SESSION["errorMsg"] = "アクティベートされていません";
    header("Location:"._BASE_URL_."/login.php");
    return false;
  } catch (ThrottlingException $throttling) {
    #return view('auth.login')->withErrors([trans('sentinel.login_throttling')."[あと".$throttling->getDelay()."秒]"]);
    $_SESSION["errorMsg"] = "規定回数以上のログインが試みられました";
    header("Location:"._BASE_URL_."/login.php");
    return false;
  }
  if (!$capsule->userInterface) {
    // エラー
    //return view('auth.login')->withErrors([trans('sentinel.login_failed')]);
    $_SESSION["errorMsg"] = "ログイン情報が間違っています";
    #print_r($_SESSION);
    header("Location:"._BASE_URL_."/login.php");
    return false;
  }
  
  
  //正規ルート
  $_SESSION["login"] = true;
  $_SESSION["user"] = $_POST["username"];
  $sql = "SELECT *,U.id as uid,R.id as rid from users as U,roles as R,role_users as RU where U.email='".$_POST["username"]."' AND U.id=RU.user_id AND R.id=RU.role_id";
  #echo $sql;
  #exit;
  $r = $mng->GetResult($sql);
  if($r){
    #print_r($r);
    $r = $mng->DecodeData($r);
    #print_r($r);
    $_SESSION["user_name"] = $r[0]["first_name"]." ".$r[0]["last_name"];
    $_SESSION["user_code"] = $r[0]["uid"];
    $_SESSION["role"] = $r[0]["slug"];
    $_SESSION["role_name"] = $r[0]["name"];

  }
  
  header("Location:"._BASE_URL_);
  exit;
}

/*
*/
 
 
 
 
 
 

$smarty->assign("css",array("bootstrap","bootstrap-responsive","style","login"));
$smarty->assign("js",array("basic"));
$title = "ログイン";



$smarty->assign("title", "$title｜".BASE_ADMIN_TITLE."");
$smarty->assign("DESCRIPTION", "$title｜".BASE_ADMIN_TITLE."");
$smarty->assign("KEYWORDS", "$title｜".BASE_ADMIN_TITLE."");
$smarty->assign("errorMsg", isset($errorMsg) ? $mng->errorMsg : null);
$smarty->assign("adminData", isset($adminData) ? $errorMsg : null);
$smarty->display('login.tpl');

