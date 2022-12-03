<?php
$title = "発注履歴一覧ダウンロード";

require(__DIR__."/../Goods/Index.php");
require(__DIR__."/../Group/RegisterSetForm.php");

$SetTable = $table;
$SetDetailTabel = $detailTabel;

require(__DIR__."/../Order/OrderAdress.php");
$AdressTable = $table;
$AdressDetailTable = $detailTabel;
$AdressForm = $form;

$table = "OrderRegister";
$detailTabel = "OrderValue";
$title = "受注マスター";


$SerachTable = "OrderRegister";
$SerachdetailTabel= "OrderValue";
$SerachdetailTabelTargetId = "item_id";

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
    "val" => "uniq",
  ),
  "upd" => array(
    "type" => "hidden",
    "data_type" => "text",
    "key" => 1,
    "val" => "uniq",
  ),
  "items" => array(
    "type" => "items",
  ),
  "sets" => array(
    "type" => "sets",
  ),
  /*
  "status" => array(
    "type" => "hidden",
    "data_type" => "integer",
  ),*/
);

$SearchForm =[
  "regist_start" => [
    "name" => "発注日",
    "type" => "dates",
    "item" => array(
      "start","end"
    ),
    "search" =>1,
    "data_type" => "text",
    "view" => 1
  ],
  "code" => [
    "name" => "発注番号",
    "type" => "text",
    "search" =>1,
    "data_type" => "text",
    "view" => 1,
    "parentKey" => 1
  ],
  "title" => [
    "name" => "発注名",
    "type" => "text",
    "search" =>1,
    "data_type" => "text",
    "SearchSwitch" => "like",
    "parentKey" => 1,
    "view" => 1
  ],
  "user" => [
    "name" => "ユーザー名",
    "type" => "text",
    "parentKey" => 1,
    "search" =>1,
    "view" => 1,
    "data_type" => "text",
    "user" => 1,
  ],
  "OrderSlip" => [
    "name" => "伝票番号",
    "type" => "text",
    "search" =>1,
    "data_type" => "text",
    "view" => 1
  ],
  "AdressName" => [
    "name" => "配送先番号",
    "type" => "text",
    "search" =>1,
    "data_type" => "text",
    "view" => 1
  ],
  "adress" => [
    "name" => "配送先住所",
    "type" => "text",
    "search" =>1,
    "data_type" => "text",
    "SearchSwitch" => "like",
    "view" => 1
  ],
  "status" => [
    "name" => "ステータス",
     "type" => "select",
     "data_type" => "text",
     "search" =>1,
      "item" => array(
        "新規受注","受注確定","発送完了","到着確認","資材回収","キャンセル"
      ),
    "view" => 1
  ],
  "demo" =>[
    "name" =>"デモ 有or無",
    "type" => "select",
    "data_type" => "text",
    "search" =>1,
    "item" => array(
      "デモ","販促品","デモまたは販促品"
    ),
  ],
   "OrderDate" => array(
     "name" => "配送指定日",
     "order" => 1,
     "type" => "date",
     "view" => 1,
   ),
];


$OrderTable = [
   "status" => array(
     "name" => "ステータス",
     "type" => "select",
     "data_type" => "text",
      "item" => array(
        "新規受注","受注確定","発送完了","到着確認","資材回収","キャンセル"
      ),
     "need" => 1,
     "view" => 1,
     "search" =>1,
   ),
   "code" => array(
     "name" => "発注番号",
     "type" => "text",
     "data_type" => "text",
     "need" => 1,
     "view" => 1,
     "search" =>1,
   ),
   "Order" => array(
     "name" => "注文者",
     "type" => "text",
     "data_type" => "text",
     "need" => 1,
     "view" => 1,
     "search" =>1,
   ),
   "Order" => array(
     "name" => "注文者",
     "type" => "text",
     "data_type" => "text",
     "need" => 1,
     "view" => 1,
     "search" =>1,
   ),
   "OrderDate" => array(
     "name" => "受注日",
     "type" => "text",
     "data_type" => "text",
     "need" => 1,
     "view" => 1,
     "search" =>1,
   ),
   "adressName" => array(
     "name" => "送付先",
     "type" => "adress",
     "data_type" => "text",
     "target" => "destination",
     "need" => 1,
     "view" => 1,
     "search" =>1,
   ),
   "adress" => array(
     "name" => "送付先住所",
     "type" => "adress",
     "data_type" => "text",
     "target" => array("pref","add1","add2"),
     "need" => 1,
     "view" => 1,
     "search" =>1,
   ),
   "adressTel" => array(
     "name" => "送付先TEL",
     "type" => "adress",
     "data_type" => "text",
     "target" => array("tel1","tel2","tel3"),
     "need" => 1,
     "view" => 1,
     "search" =>1,
   ),
  "demo" => array(
    "name" => "デモ 有or無",
    "type" => "select",
    "data_type" => "text",
    "item" => array(
      "デモ","販促品","デモまたは販促品"
    ),
    "need" => 1,
   ),
   "Company" => array(
     "type" => "GroupIdList"
   ),
#   "User" => array(
#     "type" => "user"
#   ),
   "token"=> array(
    "type" => "hidden",
    "data_type" => "text",
    "value" => "session:token",
    "need" => 1,
   ),
 ];
 
$OrderView = [
   "status" => array(
     "name" => "ステータス",
     "order" => 0,
     "type" => "status",
     "view" => 1,
   ),
   "OrderNum" => array(
     "name" => "発注NO",
     "order" => 0,
     "type" => "text",
     "view" => 1,
     "targetKey" => "code",
   ),
  "regist" => [
    "name" => "発注日",
    "type" => "text",
    "view" => 1
  ],
   "OrderID" => array(
     "name" => "注文ID",
     "order" => 0,
     "type" => "text",
     "view" => 1,
     "targetKey" => "title",
   ),
   "OrderName" => array(
     "name" => "発注名",
     "type" => "text",
     "view" => 1,
     "targetKey" => "demo",
   ),
   "OrderDate" => array(
     "name" => "受注日",
     "type" => "text",
     "view" => 1,
   ),
   "OrderUser" => array(
     "name" => "ユーザー名",
     "order" => 0,
     "type" => "text",
     "view" => 1,
     "targetKey" => "user",
     "parentKey" => 1
   ),
   "OrderCompany" => array(
     "name" => "企業名",
     "order" => 0,
     "type" => "text",
     "view" => 1,
     "targetKey" => "Company",
   ),
   "OrderDestination" => array(
     "name" => "配送先名",
     "order" => 0,
     "type" => "text",
     "view" => 1,
     "targetKey" => "adressName",
   ),
   "OrderAdress" => array(
     "name" => "配送先住所",
     "order" => 0,
     "type" => "text",
     "view" => 1,
     "targetKey" => "adress",
   ),
   "OrderTel" => array(
     "name" => "配送先TEL",
     "order" => 0,
     "type" => "text",
     "view" => 1,
     "targetKey" => "adressTel",
   ),
   "OrderDate" => array(
     "name" => "配送指定日",
     "order" => 1,
     "type" => "date",
     "view" => 1,
   ),
   "OrderTime" => array(
     "name" => "配送指定時間",
     "order" => 0,
     "view" => 1,
   ),
   "OrderSlip" => array(
     "name" => "配送伝票番号",
     "order" => 0,
     "view" => 1,
   ),
   "OrderSlip" => array(
     "name" => "配送伝票番号",
     "order" => 0,
     "view" => 1,
   ),
   "SetsName" => array(
     "name" => "セット名",
     "order" => 0,
     "view" => 1,
   ),
   "OrderImplementation" => array(
     "name" => "デモ実施日",
     "demo" => 1,
     "order" => 1,
     "demo"  => 1, //販促品のときは表示しない
     "type" => "date",
     "view" => 1,
   ),
   "OrderPerson" => array(
     "name" => "人数",
     "demo" => 1,
     "order" => 1,
     "demo"  => 1, //販促品のときは表示しない
     "type" => "number",
     "view" => 1,
   ),
   "OrderDates" => array(
     "name" => "日数",
     "demo" => 1,
     "order" => 1,
     "demo"  => 1, //販促品のときは表示しない
     "type" => "number",
     "view" => 1,
   ),
   "OrderTime" => array(
     "name" => "実施時間",
     "demo" => 1,
     "type" => "time",
     "demo"  => 1, //販促品のときは表示しない
     "order" => 1,
     "view" => 1,
   ),
   "OrderPlace" => array(
     "name" => "実施場所",
     "demo" => 1,
     "type" => "text",
     "demo"  => 1, //販促品のときは表示しない
     "order" => 1,
     "view" => 1,
   ),
   "OrderStool" => array(
     "name" => "検便",
     "demo" => 1,
     "type" => "select",
     "demo"  => 1, //販促品のときは表示しない
     "item" => [
       "あり" => "あり",
       "なし" => "なし",
     ],
     "order" => 1,
     "view" => 1,
   ),
   "OrderEnter" => array(
     "name" => "入店方法",
     "demo" => 1,
     "type" => "text",
     "demo"  => 1, //販促品のときは表示しない
     "order" => 1,
     "view" => 1,
   ),
   "OrderOther" => array(
     "name" => "その他要望（デモ）",
     "demo" => 1,
     "type" => "textarea",
     "view" => 1,
   ),
 ];
 
 $OrderTime = [
   "指定なし","午前中（8時〜12時）","12時〜14時","14時〜16時","16時〜18時","18時〜20時","18時〜21時",
 ];
 
 $csv_arr = [
   "code","title","OrderSlip"
 ];
 
$SearchTargetForm = [];
foreach($SearchForm as $k => $v){
  if(!empty($v["search"])){
    $SearchTargetForm[$k] = $v;
  }
}