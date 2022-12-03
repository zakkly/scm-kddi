<?php
$title = "単位設定";

$target = "unit";
$table = "unit";
$form = array(
  "code" => array(
    "type" => "hidden",
    "data_type" => "integer",
   ),
  "name" => array(
    "name" => "単位名",
    "type" => "text",
    "data_type" => "text",
    "view" => 1,
    "c_view" => 1,
    "need" => 1,
    "search" => 1,
   ),
);
