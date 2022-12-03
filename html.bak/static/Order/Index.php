<?php
require __DIR__."/../../../vendor/autoload.php";
require __DIR__."/../../../Classes/config/Admin/OrderManagement.php";
use Manage\manage;
$mng = new manage;


$r = $mng->SerachItems($form,$SerachTable,$SerachdetailTabel,[],1);
#sprint_r($r);

$d = [];
foreach($OrderTable["status"]["item"] as $k => $v){
  $d[$k] = 0;
}
if(!empty($r)){
  foreach($r as $k => $v){
    $d[$v["status"]]++;
  }
}

header("Content-Type: application/json; charset=utf-8");
echo json_encode($d);
#print_r($d);