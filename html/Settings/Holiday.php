<?php
require __DIR__."/../../vendor/autoload.php";
require __DIR__."/../../Classes/config/Settings/Holiday.php";
use Manage\manage;
$mng = new manage;


require __DIR__."/../../Classes/config/{$mng->tmpl}.php";

$smarty  = new Smarty;
$smarty->template_dir = dirname( __FILE__ ).'/../../templates';
$smarty->compile_dir  = dirname( __FILE__ ).'/../../templates_c';


$smarty->assign("css",array("bootstrap","bootstrap-responsive","style","basic"));


if(!empty($_POST)){
  #print_r($_POST);
  if($_POST["mode"] == "insert"){
    $sql = "INSERT INTO closing (date) VALUES('".$_POST["date"]."')";
  }elseif($_POST["mode"] == "delete"){
    $sql = "DELETE FROM closing WHERE date='".$_POST["date"]."'";
  }
  #echo $sql;
  $mng->GetResult($sql);
  exit;
}

for($i=0;$i<12;$i++){
  #echo $mng->time;
  list($y,$m) = explode("-",date('Y-m-01', mktime(0, 0, 0, date('n') + $i, 1, date('Y')))); // 2017-10-01
  #echo "\n<br>$y-$m-1";
  #echo "\n<br>$y-$m-1";
  $cal .= $mng->DispCalendar("{$y}-{$m}-1");
}


$smarty->assign("form", $form);
$smarty->assign("data", $data);
$smarty->assign("itemForm", $itemForm);
$smarty->assign("cal", $cal);
$smarty->assign("title", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("DESCRIPTION", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("KEYWORDS", "{$title} ｜".BASE_ADMIN_TITLE."");
$smarty->assign("errorMsg", isset($errorMsg) ? $errorMsg : null);
$smarty->assign("adminData", isset($adminData) ? $errorMsg : null);
$smarty->assign("nav", nav);
$smarty->assign("actionVal", $mng->tmpl);

$smarty->display("{$mng->tmpl}.tpl");