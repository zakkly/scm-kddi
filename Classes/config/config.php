<?php

//共通タイトル
define("BASE_ADMIN_TITLE", "SCM-KDDI");


//BaseURL
#define("_BASE_URL_", "http://localhost/scm-kddi/html");
define("_BASE_URL_", "https://scm-kddi.d-connect-inc.com");
/*
//DBサーバ
define("_SERVER_","localhost");
//DBユーザ名
define("_USER_","root");
//DBパスワード
define("_PASS_","root");
//DB名
define("_DB_","scm-kddi");*/
//DBサーバ
define("_SERVER_","mysql57.d-connect.sakura.ne.jp");
//DBユーザ名
define("_USER_","d-connect");
//DBパスワード
define("_PASS_","9asdP3d7");
//DB名
define("_DB_","d-connect_scm_kddi");

//popサーバ
define("_MAIL_POP_","pop3.lolipop.jp"); 
//smtpサーバ
define("_MAIL_SMTP_","smtp.lolipop.jp"); 
//メールユーザ
define("_MAIL_USR_","202006@d-connect.jp"); 
//メールパスワード
define("_MAIL_PWD_","LBhFR8hEjzQYx-Z"); 
//メールポート
define("_MAIL_PORT_",465); 

define("FCPATH","/home/d-connect/www/scm-kddi/Classes");
#define("FCPATH","/Users/doi/Dropbox/Sites/scm-kddi/Classes");
define("_IMG_", _BASE_URL_."/images/");


//メニュー
define("nav", [
  "home" => [
    "icon" => "fa-home",
    "name" => "ホーム",
    "link" => "/",
  ],
  "Goods" =>[
    "icon" => "fa-gift",
    "name" => "商品一覧",
    "link" => "/Goods/Index",
    "item" => [
      ["name" => "商品マスター","link" => "/Goods/Index"],
      ["name" => "商品登録","link" => "/Goods/ItemRegister"],
      ["name" => "カテゴリ登録","link" => "/Goods/Category"],
      ["name" => "商品CSV登録","link" => "/Goods/ItemImport"],
      ["name" => "セット商品登録","link" => "/Goods/ItemSet"],
#      ["name" => "在庫一覧","link" => "/Goods/Stocks"],
      ["name" => "入庫処理","link" => "/Goods/ItemWarehouse"],
    ],
  ],
  "Order" =>[
    "icon" => "fa-heart",
    "name" => "受注",
    "link" => "/Order/Index",
    "item" => [
      ["name" => "受注マスター","link" => "/Order/Index"],
      ["name" => "受注登録","link" => "/Order/Insert"],
      ["name" => "配送先住所登録","link" => "/Order/OrderAdress"],
      ["name" => "伝票番号CSV登録","link" => "/Order/ItemImport"],
      ["name" => "発注履歴一覧ダウンロード","link" => "/Order/OrderDownload"],
    ],
  ],
  "UserManagement" =>[
    "icon" => "fa-user-circle",
    "name" => "ユーザ",
    "link" => "/UserManagement/Index",
    "item" => [
      ["name" => "使用者一覧","link" => "/UserManagement/Index"],
      ["name" => "管理グループ","link" => "/UserManagement/Company"],
      ["name" => "ユーザCSV登録","link" => "/UserManagement/UserImport"],
    ],
  ],
  "Settings" =>[
    "icon" => "fa-gear",
    "name" => "設定",
    "link" => "/Settings/Index",
    "item" => [
      ["name" => "お知らせ登録","link" => "/Settings/Infomation"],
      ["name" => "単位設定","link" => "/Settings/Unit"],
      ["name" => "休業日設定","link" => "/Settings/Holiday"],
      ["name" => "よくある質問カテゴリ","link" => "/Settings/FaqCategory"],
      ["name" => "よくある質問","link" => "/Settings/Faq"],
    ],
  ],
]);



//メニュー
define("UserNav", [
  "home" => [
    "icon" => "fa-home",
    "name" => "ホーム",
    "link" => "/",
  ],
  "Order" => [
    "icon" => "fa-gift",
    "name" => "発注",
    "link" => "/User/Order",
  ],
  "OrderDeliveryList" => [
    "icon" => "fa-plane",
    "name" => "発送先情報",
    "link" => "/User/OrderDeliveryList",
  ],
  "OrderHistory" => [
    "icon" => "fa-calendar",
    "name" => "発注履歴",
    "link" => "/User/OrderHistory",
  ],
  "UserManagement" => [
    "icon" => "fa-user-circle",
    "name" => "ユーザ情報編集",
    "link" => "/User/UserManagement",
  ],
  "faq" => [
    "icon" => "fa-pie-chart",
    "name" => "FAQ",
    "link" => "/User/Faq",
  ],
]);
