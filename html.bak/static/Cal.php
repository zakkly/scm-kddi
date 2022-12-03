<?php
require __DIR__."/../../vendor/autoload.php";
require __DIR__."/../../Classes/config/Settings/Holiday.php";
use Manage\manage;
$mng = new manage;

if(empty($_GET["ymd"])){
  $_GET["ymd"] = date("Y-m")."-1";
}

list($y,$m,$d) = explode("-",$_GET["ymd"]);

$prev = date('Y-m-1', mktime(0, 0, 0, $m - 1, 1, $y));
$next = date('Y-m-1', mktime(0, 0, 0, $m + 1, 1, $y));

echo $mng->DispCalendar($_GET["ymd"]);
?>
<ul>
  <li data-ymd="<?=$prev;?>">前月</li>
  <li data-ymd="<?=$next;?>">次月</li>
</ul>