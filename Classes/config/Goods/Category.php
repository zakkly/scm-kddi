<?php
$title = "カテゴリ登録";
$target = "Category";
$table = "Category";
$detailTabel = "CategoryCompany";
$form = array(
  "code" => array(
    "type" => "hidden",
    "data_type" => "integer",
   ),
  "name" => array(
    "name" => "カテゴリ名",
    "type" => "text",
    "data_type" => "text",
    "view" => 1,
    "need" => 1,
   ),
   /*
  "Company" => array(
    "name" => "企業",
    "type" => "rendered",
    "item" => "Company",
    "data_type" => "text",
    "table" => $table,
    "need" => 1,
   ),*/
  "parent" => array(
    "name" => "カテゴリ名",
    "type" => "hidden",
    "data_type" => "int",
   )
);