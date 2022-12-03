<?php
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=ItemRegister.csv");
header("Content-Transfer-Encoding: binary");
require __DIR__."/../../Classes/config/Goods/ItemRegister.php";
#print_r($form);
$c = [];
foreach($form as $k => $v){
  if(empty($v["name"])){
    continue;
  }
  $c[] = $v["name"];
}
#print_r($c);

$fp = fopen('php://output', 'w');
stream_filter_prepend($fp,'convert.iconv.utf-8/cp932');
fputcsv($fp,$c);
fclose($fp);

