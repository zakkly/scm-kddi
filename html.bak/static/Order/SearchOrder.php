<?php
if(empty($_POST)){
  return false;
}

require __DIR__."/../../../vendor/autoload.php";
require __DIR__."/../../../Classes/config/Admin/OrderManagement.php";
require __DIR__."/../../../Classes/config/Admin/OrderInsert.php";
use Manage\manage;
$mng = new manage;
//print_r($AdressForm);
$smarty  = new Smarty;
$smarty->template_dir = dirname( __FILE__ ).'/../../../templates';
$smarty->compile_dir  = dirname( __FILE__ ).'/../../../templates_c';


#print_r($_POST["d"]);
$smarty->assign("r", $_POST["d"]);
$smarty->assign("OrderView", $OrderView);
$smarty->assign("form", $form);
$smarty->assign("itemForm", $itemForm);
$smarty->assign("searchForm", $searchForm);
$smarty->assign("AdressForm", $AdressForm);
$smarty->display("Admin/Insert/{$_POST['templ']}.tpl");