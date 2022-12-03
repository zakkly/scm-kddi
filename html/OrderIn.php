<?php
require __DIR__."/../vendor/autoload.php";
use Order\Order;
$mng = new Order;

require __DIR__."/../Classes/config/Order/Insert.php";

switch($_GET["t"]){
  case "h":
    $f = file("./h.txt");
    $OrderOther = 100;
    $GroupIdList = 7;
    break;
    
  case "th":
    $f = file("./th.txt");
    $OrderOther = 99;
    $GroupIdList = 9;
    break;
    
  case "kt":
    $f = file("./kt.txt");
    $OrderOther = 102;
    $GroupIdList = 10;
    break;
  
  case "":
    return false;
  
    
}

$t = [];
$novel = [
  "au(500個/箱）",
  "UQ(500個/箱）",
  "風船+ｽﾃｨｯｸ",
  "Aパック(80）目標～10",
  "Bパック（170）目標11～19",
  "Cパック（250）目標20～39",
  "Dパック（400）目標40～69",
  "Eパック（500）目標70～"
];
foreach($f as $k => $v){
  $v = str_replace("\n", "", $v);
  #print_r($v);
  $v = explode("<>",$v);
  if($k == 0){
    $t = $v;
    $n =0;
    /*
    for($i=83;$i<=92;$i++){
      $t[$i] = $novel[$n]; 
      $n++;
    }*/
    print_r($t);
  }else{
    $items = [];
    #print_r($v);
    foreach($v as $ks => $vs){
      if($ks == 0){continue;}
      if($t[$ks] == "セット数"){continue;}
      if(preg_match("/パック/", $t[$ks])){continue;}
      if(preg_match("/ノベルティ/", $t[$ks])){continue;}
      if(is_numeric($vs) && $vs > 0){
        $items[$ks]["name"] = $t[$ks];
        $items[$ks]["num"] += $vs;
      }elseif($ks == 1){
        #echo $vs."\n";
        $sql = "select a.*,p.pname as pref from Adress as a,Pref as p WHERE Adress_Code='{$vs}' AND p.pcode=a.pref";
        $r = $mng->GetResult($sql);
        if(!empty($r->num_rows)){
          $r = $mng->DecodeData($r);
          #print_r($r);
          $address = $r[0]["code"];
        }
      }
    }
    #print_r($items);
    $_items = [];
    foreach($items as $ks => $vs){
      $_items[$vs["name"]]["name"] = $vs["name"];
      $_items[$vs["name"]]["num"] += $vs["num"];
    }
    $items = $_items;
    #print_r($items);
    $v[3] = str_replace("/","-",preg_replace("/\((.+?)\)/","",$v[3]));
    $v[5] = str_replace("/","-",preg_replace("/\((.+?)\)/","",$v[5]));
    
    $data = [
      "adress" => $address,
      "title" => "1471117636-638587e247bf2",
      "user" => "admin@admin.com",
      "token" => $_SESSION["token"],
      "action" => "Order/Insert",
      "mode" => "order",
      "GroupIdList" => [$GroupIdList],
      "items" => [],
      "leadtime" => "2",
      "OrderDate" => $v[3],
      "OrderImplementation" => $v[3],
      "OrderImplementationEnd" => $v[5],
      "OrderImplementationCollect" => $v[5],
      "OrderOther" => $v[$OrderOther],
      "OrderImplementationTime" => "",
      "OrderImplementationCollectTime" => 0
    ];
    
    foreach($items as $k => $v){
      $v['name'] = ltrim($v['name'], '0');
      // まずは商品IDで検索
      $sql = "SELECT * FROM ItemValue as v, ItemRegister as r WHERE r.code=v.item_id AND v.item_title='ItemNum' AND v.item_value='{$v['name']}'";
      $r = $mng->GetResult($sql);
      if(!empty($r->num_rows)){
        $r = $mng->DecodeData($r);
        #print_r($r);
        $data["items"][] = $r[0]["item_id"];
        $data["number____{$r[0]['item_id']}____items"] = $v["num"];
        #$address = $r[0]["code"];
      }else{
        $sql = "SELECT * FROM  ItemRegister  WHERE name='{$v['name']}'";
        $r = $mng->GetResult($sql);
        if(!empty($r->num_rows)){
          $r = $mng->DecodeData($r);
          #print_r($r);
          $data["items"][] = $r[0]["code"];
          $data["number____{$r[0]['code']}____items"] = $v["num"];
        }else{
          echo $k."　".$v["name"]."がないよ\n";
        }
      }
      #echo $sql."\n";
    }
    print_r($data);
    $_POST = $data;
    print_r($_POST);
    $_POST["mode"] = "new";
    $r = $mng->RecordSeparateData();
    
    
  }
  
  
  
}