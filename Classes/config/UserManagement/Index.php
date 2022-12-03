<?php
$title = "使用者一覧";
$target = "User";
$table = "users";
$detailTabel = "UserManagement";
$form = array(
  "code" => array(
    "type" => "hidden",
    "data_type" => "integer",
   ),
  "user_id" => array(
    "type" => "hidden",
    "data_type" => "integer",
   ),
  "GroupIdList" => array(
    "name" => "企業属性",
    "type" => "select",
    "item" => "Company",
    "data_type" => "integer",
    "view" => 1,
    "need" => 1,
    "search" => 1,
    "caution" => "企業コードで指定"
   ),
  "email" => array(
    "name" => "Eメール",
    "type" => "text",
    "data_type" => "text",
    "view" => 1,
    "need" => 1,
    "table" => $table,
    "search" => 1,
    "SearchSwitch" => "like",
   ),
  "password" => array(
    "name" => "パスワード",
    "type" => "password",
    "data_type" => "text",
    "need" => 1,
    "table" => $table,
   ),
   "Department"=> array(
    "name" => "部署・部門",
    "type" => "text",
    "data_type" => "text",
    "view" => 1,
    "need" => 1,
   ),
   /*
  "user_name" => array(
    "name" => "ユーザ名",
    "type" => "text",
    "data_type" => "text",
    "view" => 1,
    "need" => 1,
  ),*/
  "last_name" => array(
    "name" => "姓",
    "type" => "text",
    "data_type" => "text",
    "view" => 1,
    "need" => 1,
    "table" => $table,
    "search" => 1,
    "SearchSwitch" => "like",
   ),
  "first_name" => array(
    "name" => "名前",
    "type" => "text",
    "data_type" => "text",
    "view" => 1,
    "need" => 1,
    "table" => $table,
    "search" => 1,
    "search" => 1,
    "SearchSwitch" => "like",
   ),
   "tel"=> array(
    "name" => "固定電話",
    "type" => "text",
    "data_type" => "text",
    "view" => 1,
    "need" => 1,
    "search" => 1,
    "SearchSwitch" => "-",
    "SearckKey" => "T.tel",
   ),
   "mobile"=> array(
    "name" => "携帯電話",
    "type" => "text",
    "data_type" => "text",
    "view" => 1,
    "search" => 1,
    "SearchSwitch" => "-",
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