<?php
require(__DIR__."/ItemRegister.php");
$title = "商品マスター";

$itemForm = array(
  "no" => array(
    "name" => "No.",
  ),
  "code" => array(
    "name" => "商品ID",
    "type" => "text",
    "data_type" => "integer",
    "search" => 1,
    "parentKey" => 1,
  ),
  "ItemNum" =>[
    "name" => "商品番号",
    "type" => "text",
    "data_type" => "text",
    "search" => 1,
  ],
  "img" => array(
    "name" => "商品イメージ",
  ),
  "name" => array(
    "name" => "商品名",
    "type" => "text",
    "data_type" => "text",
    "search" => 1,
    "SearchSwitch" => "like",
    "parentKey" => 1,
  ),
  "stock_total" => array(
    "name" => "総在庫",
  ),
  "stock3" => array(
    "name" => "関東",
  ),
  "stock2" => array(
    "name" => "関東",
  ),
  "stock" => array(
    "name" => "北海道",
  ),
  "stock4" => array(
    "name" => "中部",
  ),
  "GroupIdList" => array(
    "name" => "企業属性",
    "type" => "select",
    "item" => "Company",
    "data_type" => "integer",
    "search" => 1,
  ),
  "category" => array(
    "name" => "カテゴリー",
    "type" => "select",
    "item" => array(""),
    "data_type" => "integer",
  ),
  "sub_category" => array(
    "name" => "サブカテゴリー",
    "type" => "text",
    "data_type" => "integer",
  ),
  "edit" => array(
    "name" => "操作",
  ),
);



$SearchTargetForm = [];
foreach($itemForm as $k => $v){
  if(!empty($v["search"])){
    $SearchTargetForm[$k] = $v;
  }
}