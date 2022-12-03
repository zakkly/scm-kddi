<?php
require __DIR__."/../../vendor/autoload.php";
use Order\Order;
$mng = new Order;
require __DIR__."/../../Classes/config/{$mng->tmpl}.php";


$smarty  = new Smarty;
$smarty->template_dir = dirname( __FILE__ ).'/../../templates';
$smarty->compile_dir  = dirname( __FILE__ ).'/../../templates_c';
$smarty->assign("css",array("bootstrap.min","bootstrap-responsive.min","style","basic","Search","Order"));



if(!empty($_POST)){
  if(!empty($_POST["token"]) && !(hash_equals($_POST["token"], $_SESSION['token'])) && $_POST["type"] != "ajax") {
    $errorMsg =  "起動方法が不正です";
    echo $_POST["token"]."<br>";
    echo $_SESSION["token"];
    echo $errorMsg;
    exit;
  }elseif($_POST["mode"] == "Adress"){
    #print_r($_POST);
    $mng->SerachAdress($AdressTable,$AdressDetailTable);
    exit;
  }elseif($_POST["mode"] == "order"){
    print_r($_POST);
    $_POST["mode"] = "new";
    $r = $mng->RecordSeparateData();
    exit;
  }elseif($_POST["mode"] == "search"){
    #print_r($_POST);
    if(!empty($_POST["set"])){
      $r = $mng->SerachItems($form,$SetTable,$SetDetailTabel,[$SerachTable,$SerachdetailTabel],1);
    }else{
      $r = $mng->SerachItems($form,$SerachTable,$SerachdetailTabel,[],1);
    }
    exit;
  }elseif($_POST["mode"] == "searchCompany"){
    $mng->GetDataJson();
    exit;
  }elseif($_POST["mode"] == "Complete"){
		$mng->OrderMail();
		exit;
  }else{
    print_r($_POST);
    exit;
  }
}

//formの中にDB連動ものがあるかどうか
$form = $mng->SetDecodeFormItems($form);
$itemForm = $SearchTargetForm;
$searchForm = $mng->SetDecodeFormItems($searchForm);
#print_r($itemForm);


$smarty->assign("steps", $steps);
$smarty->assign("form", $form);
$smarty->assign("t", time());
$smarty->assign("itemForm", $itemForm);
$smarty->assign("searchForm", $searchForm);
$smarty->assign("AdressForm", $AdressForm);
$smarty->assign("title", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("DESCRIPTION", "{$title}｜".BASE_ADMIN_TITLE."");
$smarty->assign("KEYWORDS", "{$title} ｜".BASE_ADMIN_TITLE."");
$smarty->assign("errorMsg", isset($errorMsg) ? $errorMsg : null);
$smarty->assign("adminData", isset($adminData) ? $errorMsg : null);
$smarty->assign("actionVal", $mng->tmpl);


if($_SESSION["role"] == "admin"){
  $smarty->assign("nav",nav);
}else{
  $smarty->assign("nav",UserNav);
}
$smarty->display("{$mng->tmpl}.tpl");