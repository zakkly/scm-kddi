<?php
$title = "セット商品登録";
$table = "SetItemRegister";
$detailTabel = "SetItemValue";
$SearchTable = "ItemRegister";
$SearchdetailTabel= "ItemValue";
$SerachdetailTabelTargetId = "item_id";

$form = array(
  "code" => array(
    "type" => "hidden",
    "data_type" => "integer",
  ),
  "title" => array(
    "name" => "セット商品名",
    "type" => "text",
    "data_type" => "text",
    "need" => 1,
    "key"  => 1,
  ),
  "user" => array(
    "type" => "hidden",
    "data_type" => "text",
    "key"  => 1,
  ),
  "GroupIdList" => array(
    "name" => "企業属性",
    "type" => "rendered",
    "item" => "Company",
    "data_type" => "integer",
    "view" => 1,
    "need" => 1,
   ),
  "category" => array(
    "name" => "商品カテゴリ",
    "type" => "rendered",
    "item" => array("選択"),
    "data_type" => "integer",
    "view" => 1,
    "need" => 1,
    "disabled" => 1,
   ),
  "sub_category" => array(
    "name" => "商品サブカテゴリ",
    "type" => "rendered",
    "item" => array("選択"),
    "data_type" => "integer",
    "view" => 1,
    "disabled" => 1,
   ),
  "genre" => array(
    "name" => "au/uq",
    "type" => "select",
    "data_type" => "text",
    "item" => array(
      "共通","au専用","UQ専用"
    ),
    "need" => 1,
   ),
  "img" => array(
    "name" => "セット商品イメージ",
    "type" => "image",
    "data_type" => "text",
   ),
   
   "items" => array(
     "notview" => 1,
     "type" => "items",
   ),
   
   "order" => array(
     "notview" => 1,
     "type" => "ItemSetArr",
   ),
   "day" => array(
     "notview" => 1,
     "type" => "ItemSetArr",
   ),
   "person" => array(
     "notview" => 1,
     "type" => "ItemSetArr",
   ),
   
  "comment" => array(
    "name" => "セット商品説明",
    "type" => "textarea",
    "data_type" => "text",
    "need" => 1,
   ),
   "token"=> array(
    "type" => "hidden",
    "data_type" => "text",
    "value" => "session:token",
    "need" => 1,
   ),
);

$searchForm = array(
  "name" => array(
    "name" => "商品名",
    "type" => "text",
    "data_type" => "text",
    "search" => 1,
  ),
  "GroupIdList" => array(
    "name" => "企業属性",
    "type" => "select",
    "item" => "Company",
    "data_type" => "integer",
    "search" => 1,
   ),
);

$SearchTargetForm = $searchForm;