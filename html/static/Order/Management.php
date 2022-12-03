<?php
if(empty($_POST)){
  return false;
}

require __DIR__."/../../../vendor/autoload.php";
require __DIR__."/../../../Classes/config/Order/Index.php";
#require __DIR__."/../../../Classes/config/Admin/OrderManagement.php";
use Manage\manage;
$mng = new manage;

$smarty  = new Smarty;
$smarty->template_dir = dirname( __FILE__ ).'/../../../templates';
$smarty->compile_dir  = dirname( __FILE__ ).'/../../../templates_c';

if(!empty($_POST["search"])){
  $val = explode("&", $_POST["search"]);
  foreach($val as $k => $v){
    list($key,$value) = explode("=",$v);
    $_POST[$key] = $value;
  }
}
$d = [];
#print_r($_POST);
foreach($OrderTable as $k => $v){
  switch($v["type"]){
    case "adress":
      $sql = "select * from Adress WHERE code={$_POST['d'][$v['type']]}";
      #echo $sql."\n";
      if(empty($add)){
        $add = $mng->GetResult($sql);
        if($add){
          $add = $mng->DecodeData($add);
          #print_r($add);
        }
      }
      #echo $k.$v["target"]."\n";
      if(!is_array($v["target"])){
        $_POST["d"][$k] = $add[0][$v["target"]];
      }else{
        foreach($v["target"] as $ks => $vs){
          $_POST["d"][$k] .= $add[0][$vs];
        }
      }
      break;
      
    case "GroupIdList":
      $sql = "select * from Company WHERE code={$_POST['d'][$v['type']]}";
      #echo $sql."\n";
      $com = $mng->GetResult($sql);
      if($com){
        $com = $mng->DecodeData($com);
        $_POST["d"][$k] = $com[0]["name"];
        #$print_r($com);
      }
      break;
      
    case "select":
      $_POST["d"][$k."_type"] = $_POST["d"][$k];
      $_POST["d"][$k] = $v["item"][$_POST["d"][$k]];
      break;
      
    default:
      $_POST["d"][$k] = $_POST["d"][$k];
  }
}
#$_POST["d"] = $d;
#print_r($_POST);


//formの中にDB連動ものがあるかどうか
$form = $mng->SetDecodeFormItems($form);
$itemForm = $mng->SetDecodeFormItems($itemForm);
$searchForm = $mng->SetDecodeFormItems($searchForm);

if($_POST["mode"] == "search"){
  #print_r($_POST);
  if(!empty($_POST["set"])){
    $r = $mng->SerachItems($form,$SetTable,$SetDetailTabel,[$SerachTable,$SerachdetailTabel],1);
  }else{
    $r = $mng->SerachItems($form,$SerachTable,$SerachdetailTabel,[],1);
  }
  #print_r($r);
}


$smarty->assign("OrderView", $OrderView);
$smarty->assign("OrderTable", $OrderTable);
$smarty->assign("r", $r);
$smarty->assign("form", $form);
$smarty->assign("itemForm", $itemForm);
$smarty->assign("searchForm", $searchForm);
$smarty->assign("AdressForm", $AdressForm);
$smarty->display("Admin/Insert/{$_POST['templ']}.tpl");