<?php
require __DIR__."/../../vendor/autoload.php";
require __DIR__."/../../Classes/config/Admin/OrderManagement.php";
use Manage\manage;
$mng = new manage;
$_GET["search_status"] = 1;
#echo $SerachdetailTabel;
#print_r($SearchForm);
$mng->form = $form;
$data = $mng->Search__ManagementOrder($SearchTargetForm,$table,$detailTabel,$SearchForm);
$_POST["d"] = $mng->MakeOrderDataValue($OrderTable,$data);
#print_r($_POST["d"]);
$d = [];
$c = [];
foreach($csv_arr as $k => $v){
  $c[] = $SearchForm[$v]["name"];
}
$d[] = $c;
if(!empty($_POST["d"])){
  foreach($_POST["d"] as $k => $v){
    $c = [];
    foreach($csv_arr as $key => $val){
      $c[] = $v[$val];
    }
    $d[] = $c;
  }
}


#print_r($d);
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=OrderRegister.csv");
header("Content-Transfer-Encoding: binary");
$fp = fopen('php://output', 'w');
stream_filter_prepend($fp,'convert.iconv.utf-8/cp932');
foreach($d as $k => $v){
  fputcsv($fp,$v);
}
fclose($fp);

