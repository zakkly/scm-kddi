<?php
$title = "お知らせ";


$target = "Infomation";
$table = "Infomation";


$form = array(
  "code" => array(
    "type" => "hidden",
    "data_type" => "integer",
   ),
  "title" => array(
    "name" => "タイトル",
    "type" => "text",
    "data_type" => "text",
    "view" => 1,
    "need" => 1,
   ),
  "contents" => array(
    "name" => "記事",
    "type" => "textarea",
    "data_type" => "text",
    "need" => 1,
   ),
  "sort" => array(
    "type" => "sort",
    "data_type" => "integer",
   ),
);