<?php
$title = "配送先住所登録";
$table = "Adress";
$form = array(
  "code" => array(
    "type" => "hidden",
    "data_type" => "integer",
   ),
  "Company" => array(
     "name" => "企業属性",
     "type" => "select",
     "item" => "Company",
     "data_type" => "integer",
     "need" => 1,
     "view" => 1,
     "search" =>1,
   ),
   "Adress_Code" =>[
     "name" => "拠点コード",
     "type" => "text",
     "data_type" => "text",
     "need" => 1,
     "view" => 1,
     "search" =>1,
     "SearchSwitch" => "like"
   ],
   "destination" => array(
     "name" => "宛先",
     "type" => "text",
     "data_type" => "text",
     "need" => 1,
     "view" => 1,
     "search" =>1,
     "SearchSwitch" => "like"
   ),
   "zip" => array(
     "name" => "郵便番号",
     "type" => "text",
     "data_type" => "text",
     "need" => 1,
     "onKeyUp" => "AjaxZip3.zip2addr(this,'','pref','add1');",
     "view" => 1,
     "search" =>1,
     "SearchSwitch" => "-"
   ),
   "pref" => array(
     "name" => "都道府県",
     "type" => "text",
     "data_type" => "text",
     "need" => 1,
     "disabled" => 1,
     "view" => 1,
   ),
   "add1" => array(
     "name" => "住所1",
     "type" => "text",
     "data_type" => "text",
     "need" => 1,
     "disabled" => 1,
     "view" => 1,
   ),
   "add2" => array(
     "name" => "住所2",
     "type" => "text",
     "data_type" => "text",
     "need" => 1,
     "view" => 1,
   ),
   "tel" => array(
     "name" => "電話",
     "type" => "tel",
     "data_type" => "tel",
     "cls" => "tel",
     "need" => 1,
     "view" => 1,
     "search" =>1,
   ),
   "token"=> array(
     "type" => "hidden",
     "data_type" => "text",
     "value" => "session:token",
     "need" => 1,
   ),
);


$SearchTargetForm = [];
foreach($form as $k => $v){
  if(!empty($v["search"])){
    $SearchTargetForm[$k] = $v;
  }
}