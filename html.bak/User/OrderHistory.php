<?php
$f = explode(".", basename(__FILE__));
$f = $f[0];

require __DIR__."/../../vendor/autoload.php";
require __DIR__."/../../Classes/config/User/{$f}.php";
require __DIR__."/../../Classes/config/Admin/OrderManagement.php";
use Manage\manage;
$mng = new manage;

if(empty($_SESSION["login"])){
  header("Location:"._BASE_URL_."/login.php");
}

foreach($_GET as $k => $v){
  $_POST[$k] = $v;
}

$smarty  = new Smarty;
$smarty->template_dir = dirname( __FILE__ ).'/../../templates';
$smarty->compile_dir  = dirname( __FILE__ ).'/../../templates_c';

if(!empty($_POST)){
  if(!empty($_POST["token"]) && !(hash_equals($_POST["token"], $_SESSION['token'])) && $_POST["type"] != "ajax") {
    $errorMsg =  "起動方法が不正です";
    echo $_POST["token"]."<br>";
    echo $_SESSION["token"];
    echo $errorMsg;
    exit;
  }elseif($_POST["mode"] == "search"){
    $mng->SerachItems($form,$SerachTable,$SerachdetailTabel);
    exit;
  }elseif($_POST["mode"] == "modal"){
    $data = $mng->SerachItems($form,$SerachTable,$SerachdetailTabel,[],1);
    $_POST["d"] = $mng->MakeOrderDataValue($OrderTable,$data);
    #print_r($_POST);
    $smarty->assign("OrderTime",$OrderTime);
    $smarty->assign("OrderTable", $OrderTable);
    $smarty->assign("OrderView", $OrderView);
    $smarty->assign("unit", $__unit);
    $smarty->assign("r", $_POST["d"]);
    $smarty->display("{$_POST['templ']}.tpl");
    exit;
  }elseif($_POST["mode"] == "statusChange"){
    if(!empty($_POST["status"])){
      //ステータスごとに処理をする
      $err = $mng->StatusChange($form,$SerachTable,$SerachdetailTabel,$OrderTable);
      if(!empty($err)){
        echo $err;
        exit;
      }
      //一旦既存のステータスレコードを消す
      $sql = "delete from OrderValue WHERE item_id={$_POST['code']} AND item_title='status'";
      $mng->GetResult($sql);
      //新規にステータスを挿入
      $sql = "INSERT INTO OrderValue (item_id,item_title,item_value) VALUES({$_POST['code']},'status', {$_POST['status']})";
      $mng->GetResult($sql);
    }
    exit;
  }
}



$smarty->assign("status", $OrderTable["status"]["item"]);
$smarty->assign("SearchForm",$SearchForm);
$smarty->assign("OrderTime",$OrderTime);
$smarty->assign("OrderTable", $OrderTable);
$smarty->assign("OrderView", $OrderView);
$smarty->assign("t", time());
$smarty->assign("title", "{$_title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("DESCRIPTION", "ダッシュボード｜".BASE_ADMIN_TITLE."");
$smarty->assign("KEYWORDS", "ダッシュボード ｜".BASE_ADMIN_TITLE."");
$smarty->assign("news", isset($news) ? $news : null);
$smarty->assign("errorMsg", isset($errorMsg) ? $errorMsg : null);
$smarty->assign("adminData", isset($adminData) ? $errorMsg : null);
$smarty->display("User/User/{$f}.tpl");