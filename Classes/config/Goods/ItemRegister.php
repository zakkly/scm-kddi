<?php
$title = "商品登録";
$target = "ItemRegister";
$table = "ItemRegister";
$detailTabel = "ItemValue";
$SerachdetailTabelTargetId = "item_id";
$form = array(
  "code" => array(
    "type" => "hidden",
    "data_type" => "integer",
   ),
  "user" => array(
    "type" => "hidden",
    "data_type" => "text",
    "key"  => 1,
   ),
  "name" => array(
    "name" => "商品名",
    "type" => "text",
    "data_type" => "text",
    "view" => 1,
    "need" => 1,
    "cls"  => "name",
    "key"  => 1,
   ),
  "ItemNum" => array(
    "name" => "商品番号",
    "type" => "text",
    "data_type" => "text",
    "view" => 1,
    "need" => 1,
   ),
  "GroupIdList" => array(
    "name" => "属性・カテゴリ",
    "type" => "rendered",
    "item" => "Company",
    "data_type" => "integer",
    "group" =>[
      
    ],
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
  "unit" => array(
    "name" => "単位",
    "type" => "select",
    "data_type" => "text",/*
    "item" => array(
      "キロ","箱","個","グラム","つ"
    ),*/
    "item" => "unit",
    "where" => "",
    "need" => 1,
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
    "name" => "商品イメージ",
    "type" => "image",
    "data_type" => "image",
   ),
   
  "comment" => array(
    "name" => "商品説明",
    "type" => "textarea",
    "data_type" => "text",
    "need" => 1,
   ),
   
  "stock3" => array(
    "name" => "関東在庫数",
    "type" => "text",
    "data_type" => "num",
    "textType" => "num",
    "edit" => "disabled",
    "need" => 1,
   ),
   
  "stock2" => array(
    "name" => "東北在庫数",
    "type" => "text",
    "data_type" => "num",
    "textType" => "num",
    "edit" => "disabled",
    "need" => 1,
   ),
   
  "stock" => array(
    "name" => "北海道在庫数",
    "type" => "text",
    "data_type" => "num",
    "textType" => "num",
    "edit" => "disabled",
    "need" => 1,
   ),
   
  "stock4" => array(
    "name" => "中部在庫数",
    "type" => "text",
    "data_type" => "num",
    "textType" => "num",
    "edit" => "disabled",
    "need" => 1,
   ),
   
  "minimum" => array(
    "name" => "最低在庫数",
    "type" => "text",
    "data_type" => "num",
    "textType" => "num",
    "need" => 1,
   ),
   /*
  "damaged" => array(
    "name" => "損傷数",
    "type" => "text",
    "data_type" => "num",
    "textType" => "num",
    "need" => 1,
   ),
   
  "lost" => array(
    "name" => "紛失・不明数",
    "type" => "text",
    "data_type" => "num",
    "textType" => "num",
    "need" => 1,
   ),*/
   
  "view" => array(
    "name" => "表示・非表示",
    "type" => "checkbox",
    "data_type" => "text",
    "item" => array(
      "1" => "非表示"
    ),
    "need" => 1,
   ),
  "returns" => array(
    "name" => "要返却",
    "type" => "checkbox",
    "data_type" => "text",
    "item" => array(
      "1" => "要返却"
    ),
    "need" => 1,
   ),
   "token"=> array(
    "type" => "hidden",
    "data_type" => "text",
    "value" => "session:token",
    "need" => 1,
   ),
);