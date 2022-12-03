<?php
$title = "よくある質問カテゴリ";

$target = "faq_category";
$table = "faq_category";
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
    "c_view" => 1,
    "need" => 1,
    "search" => 1,
   ),
  "icon" => array(
    "name" => "アイコン",
    "type" => "icon",
    "data_type" => "text",
    "view" => 1,
   ),
);
