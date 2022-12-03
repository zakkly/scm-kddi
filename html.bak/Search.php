<?php
if(empty($_GET)){return false;}
if(empty($_GET["target"])){return false;}
if(empty($_GET["action"])){return false;}
require __DIR__."/../vendor/autoload.php";
foreach($_GET as $k => $v){
  $_GET[$k] = urldecode($v);
}
foreach($_GET as $k => $v){
  $_POST[$k] = urldecode($v);
}
require __DIR__."/../Classes/config/{$_GET['action']}.php";
use Manage\manage;
$mng = new manage;
$mng->form = $form;
#echo $detailTabel;
#print_r($_POST);
#print_r($SearchForm);
if(!empty($SearchTargetForm)){
  //クエリを整形
  #$query = $mng->Search__SetQuerty($SearchTargetForm); 
  
  switch($_GET["target"]){
    case "users":
      $data = $mng->Search__ManagementUser($SearchTargetForm,$table,$detailTabel);
      break;
      
    case "Adress":
      $data = $mng->Search__ManagementAdress($SearchTargetForm,$table,"Company");
      break;
    
    case "Order":
      $data = $mng->Search__ManagementOrder($SearchTargetForm,$table,$detailTabel,$SearchForm);
      break;
      
    case "Sets":
      $data = $mng->Search__ManagementSets($SearchTargetForm,$SearchTable,$SearchdetailTabel,$SearchForm);
      break;
      
    case "Items":
      $data = $mng->Search__ManagementItems($SearchTargetForm,$table,$detailTabel,$SearchForm);
      break;
  }
  #print_r($data);
  header("Content-Type: application/json; charset=utf-8");
  echo json_encode($data);
}