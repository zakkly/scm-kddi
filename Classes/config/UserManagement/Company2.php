<?php
$title = "会社登録";
$target = "Company";
$table = "Company";
$form = array(
  "code" => array(
    "type" => "hidden",
    "data_type" => "integer",
   ),
  "name" => array(
    "name" => "会社名",
    "type" => "text",
    "data_type" => "text",
    "view" => 1,
    "need" => 1,
   ),
  "address" => array(
    "name" => "住所",
    "type" => "text",
    "data_type" => "text",
    "view" => 1,
    "need" => 1,
   ),
  "tel" => array(
    "name" => "TEL",
    "type" => "text",
    "data_type" => "text",
    "view" => 1,
    "need" => 1,
   ),
  "url" => array(
    "name" => "URL",
    "type" => "text",
    "data_type" => "text",
    "view" => 1,
   ),
  "comment" => array(
    "name" => "説明",
    "type" => "textarea",
    "data_type" => "text",
    "view" => 1,
   ),
);