<?php
require(__DIR__."/../Goods/Index.php");
require(__DIR__."/../Group/RegisterSetForm.php");

$SetTable = $table;
$SetDetailTabel = $detailTabel;

require(__DIR__."/../Order/OrderAdress.php");
$AdressTable = $table;
$AdressDetailTable = $detailTabel;
$AdressForm = $form;

$title = "受注登録";
$table = "OrderRegister";
$detailTabel = "OrderValue";

$form = array(
  "code" => array(
    "type" => "hidden",
    "data_type" => "integer",
   ),
  "title" => array(
    "type" => "hidden",
    "data_type" => "integer",
    "key" => 1,
    "val" => "uniq",
  ),
  "user" => array(
    "type" => "hidden",
    "data_type" => "text",
    "key" => 1,
    "val" => "session:user",
  ),
  "GroupIdList" => array(
    "name" => "企業属性",
    "type" => "rendered",
    "item" => "Company",
    "data_type" => "integer",
    "view" => 1,
    "need" => 1,
   ),
   /*
  "demo" => array(
    "name" => "デモ 有or無",
    "type" => "select",
    "data_type" => "text",
    "item" => array(
      "デモ","販促品","デモまたは販促品"
    ),
    "need" => 1,
   ),*/
   "token"=> array(
    "type" => "hidden",
    "data_type" => "text",
    "value" => "session:token",
    "need" => 1,
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
  "unit" => array(
    "name" => "単位",
     "notview" => 1,
    "type" => "select",
    "data_type" => "text",
    "item" => array(
      "キロ","箱","個","グラム","つ"
    ),
    "need" => 1,
   ),
);


$SerachTable = "ItemRegister";
$SerachdetailTabel= "ItemValue";
$SerachdetailTabelTargetId = "item_id";
#print_r($itemForm);



$steps = [
  [
    "title" =>"商品選択",
    "templ" => "Goods",
  ],
  [
    "title" =>"配送先",
    "templ" => "Adress",
  ],
  [
    "title" =>"数量入力",
    "templ" => "NumSet",
  ],
  [
    "title" =>"その他",
    "templ" => "Other",
  ],
  [
    "title" =>"完了",
    "templ" => "Complete",
  ],
];