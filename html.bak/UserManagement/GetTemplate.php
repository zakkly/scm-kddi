<?php

header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=UserTemplate.csv");
header("Content-Transfer-Encoding: binary");
require __DIR__."/../../Classes/config/UserManagement/Index.php";
#print_r($form);
$c = [];
foreach($form as $k => $v){
  if(empty($v["name"])){
    continue;
  }
  if(!empty($v["caution"])){
    $c[] = $v["name"]."\n(".$v["caution"].")";
  }else{
    $c[] = $v["name"];
  }
}
#print_r($c);

$fp = fopen('php://output', 'w');
stream_filter_prepend($fp,'convert.iconv.utf-8/cp932');
fputcsv($fp,$c);
fclose($fp);

