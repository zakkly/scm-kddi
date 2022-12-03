<?php
$title = "よくある質問";
$target = "faq";
$table = "faq";
$form = array(
  "code" => array(
    "type" => "hidden",
    "data_type" => "integer",
   ),
  "category" => array(
    "name" => "表示カテゴリ",
    "type" => "select",
    "item_type" => "table",
    "item" => "faq_category",
    "data_type" => "integer",
    "c_view" => 1,
    "view" => 1,
    "need" => 1,
   ),
  "title" => array(
    "name" => "質問",
    "type" => "text",
    "data_type" => "text",
    "view" => 1,
    "need" => 1,
   ),
  "contents" => array(
    "name" => "回答",
    "type" => "textarea",
    "data_type" => "text",
    "need" => 1,
   ),
  "sort" => array(
    "type" => "sort",
    "data_type" => "integer",
   ),
);