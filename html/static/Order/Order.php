<?php
if(empty($_POST)){
  return false;
}
#print_r($_POST);

require __DIR__."/../../../vendor/autoload.php";
require __DIR__."/../../../Classes/config/Order/Management.php";
require __DIR__."/../../../Classes/config//Order/Insert.php";
use Order\Order;
$mng = new Order;
//print_r($AdressForm);

if(!empty($_POST["search"])){
  $val = explode("&", $_POST["search"]);
  foreach($val as $k => $v){
    list($key,$value) = explode("=",$v);
    $_POST[$key] = $value;
  }
}

#print_r($itemForm);


//formの中にDB連動ものがあるかどうか
$form = $mng->SetDecodeFormItems($form);
$itemForm = $mng->SetDecodeFormItems($itemForm);
$searchForm = $mng->SetDecodeFormItems($searchForm);
if($_POST["mode"] == "search"){
  #print_r($_POST);
  $mng->SerachdetailTabelTargetId = $SerachdetailTabelTargetId;
  if(!empty($_POST["set"])){
    $r = $mng->SerachItems($form,$SetTable,$SetDetailTabel,[$SerachTable,$SerachdetailTabel],1);
  }else{
    $r = $mng->SerachItems($form,$SerachTable,$SerachdetailTabel,[],1);
  }
  #print_r($r);
}elseif($_POST["mode"] == "NumsetDetail" || $_POST["mode"] == "OtherDetail"){
  $r = [];
  foreach($_POST as $k => $v){
    switch($k){
      case "mode":
      case "templ":
      case "GroupIdList":
        break;
        
      case "sets":
      case "items":
        $_POST["mode"] = "EditMode";
        foreach($v as $ks => $vs){
          $_POST["code"] = $vs;
          if($k == "items"){
            $r[$k][] = $mng->SerachItems($form,$SerachTable,$SerachdetailTabel,[],1);
          }elseif($k == "sets"){
            $r[$k][] = $mng->SerachItems($form,$SetTable,$SetDetailTabel,[$SerachTable,$SerachdetailTabel],1);
          }
        }
        break;
        
      case "adress":
        $add = implode(",", $_POST["adress"]);
        $sql = "SELECT * from Adress as AD,leadTime as LT WHERE REPLACE(AD.zip,'-','')=LT.zip AND AD.code IN ($add)";
        #echo $sql;
        $res = $mng->GetResult($sql);
        if($res){
          $r[$k] = $mng->DecodeData($res);
        }
        break;
    }
  }
  #print_r($_POST);
  #print_r($r);
}

$smarty  = new Smarty;
$smarty->template_dir = dirname( __FILE__ ).'/../../../templates';
$smarty->compile_dir  = dirname( __FILE__ ).'/../../../templates_c';

#print_r($_POST);


$smarty->assign("r", $r);
$smarty->assign("OrderView", $OrderView);
$smarty->assign("form", $form);
$smarty->assign("itemForm", $itemForm);
$smarty->assign("searchForm", $searchForm);
$smarty->assign("AdressForm", $AdressForm);
$smarty->display("Admin/Insert/{$_POST['templ']}.tpl");