<?php
if(empty($_GET)){return false;}
foreach($_GET as $k => $v){
  if(preg_match("/search_/", $k)){
    $_k = str_replace("search_", "", $k);
    $_GET[$_k] = $v;
  }
}
#print_r($_GET);
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
use Search\Search;
$mng = new Search;
$mng->form = $form;

#print_r($SearchTargetForm);

if(!empty($SearchTargetForm)){
  
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
      $data = $mng->Search__ManagementSets($SearchTargetForm,$table,$detailTabel,$SearchForm);
      break;
      
    case "Items":
      $data = $mng->Search__ManagementItems($SearchTargetForm,$table,$detailTabel,$SearchForm);
      break;
  }
  #print_r($data);
  header("Content-Type: application/json; charset=utf-8");
  echo json_encode($data);
}
