<?php
namespace Search;
require_once(__DIR__."/manage.php");
use Manage\manage;


class Search extends manage{
  function __construct(){
    parent::__construct();
  }
  
/*
====================================================

/html/Search.phpで使う関数群

====================================================
*/
  //クエリを整形
  function Search__SetQuerty($SearchTargetForm="",$w=""){
    if(empty($SearchTargetForm)){return false;}
    $_where = [];
    foreach($SearchTargetForm as $k => $v){
      $_search = "search_".$k;
      if(!empty($v["SearckKey"])){
        $k = $v["SearckKey"];
      }
      if(!empty($_GET["statusChange"]) && $_search == "search_status"){
        
      }elseif(empty($_GET[$_search])){
        continue;
      }
      switch($v["data_type"]){
        case "integer":
          $_where[] = "$k=$_GET[$_search]";
          break;
        case "text":
          switch($v["SearchSwitch"]){
            case "-":
            case "like":
              if($v["SearchSwitch"] == "-"){
                $v = str_replace("-", "", $_GET[$_search]);
              }
              $_where[] = "$k like '%{$_GET[$_search]}%'";
              break;
            default:
              $_where[] = "$k='{$_GET[$_search]}'"; 
          }
          break;
      }
    }
    #print_r($_GET);
    if(!empty($_where)){
      $query = " AND ".implode(" AND ", $_where);
    }else{
      $query = "";
    }
    #echo $query;
    if(empty($w)){
      return $query;
    }else{
      return [$query,$_where];
    }
    
  }
  
  //ユーザ関連
  function Search__ManagementUser($SearchTargetForm,$table,$detailTabel){
    $query = $this->Search__SetQuerty($SearchTargetForm);
    if(!empty($_GET["count"])){
      $sql = "select T.user_id from $table as U,$detailTabel as T,Company as C where U.id=T.user_id AND C.code=T.GroupIdList$query";
    }else{
      $sql = "select *,C.name as GroupIdListName,C.tel as CompnayTel,T.tel as tel from $table as U,$detailTabel as T,Company as C where U.id=T.user_id AND C.code=T.GroupIdList$query order by T.code DESC LIMIT {$_GET['start']},{$_GET['num_rows']}";
    }
    #echo $sql."\n\n";
    $data = $this->GetResult($sql);
    if($data){
      if(!empty($_GET["count"])){
        $data = $this->DecodeData($data);
        $data = ["count" => count($data)];
      }else{
        $data = $this->DecodeData($data);
      }
    }
    
    return $data;
  }
  
  //住所・会社情報関連
  function Search__ManagementAdress($SearchTargetForm,$table,$detailTabel){
    $query = $this->Search__SetQuerty($SearchTargetForm);
    if(empty($query)){
      $d = $this->SerachAdress($table,$detailTabel,1);
      #echo $$detailTabel;
    }else{
      $sql = "select address.*,c.name as CompanyName from $table as address,Company as c WHERE c.code=address.Company $query order by address.code DESC ";
      #echo $sql."\n\n";
      $d = $this->GetResult($sql);
      if($d){
        $d = $this->DecodeData($d);
      }
      #echo $sql;
    }
    #print_r($d);
    if(!empty($_GET["count"])){
      $data = ["count" => count($d)];
    }else{
      foreach($d as $k => $v){
        $num++;
        if($num<=$_GET["start"]){continue;}
        if($num>($_GET["num_rows"]+$_GET["start"])){continue;}
        $data[] = $v;
      }
    }
    
    return $data;
  }
  
  //オーダー情報関連
  function Search__ManagementOrder($SearchTargetForm,$table,$detailTabel,$SearchForm){
    $q = $this->Search__SetQuerty($SearchTargetForm,1);
    $query = $q[0];
    $_where = $q[1];
    
    foreach($_GET as $k => $v){
      $_POST[$k] = $v;
    }
    $this->OrderSearchForm = $SearchForm;
    #echo $query;
    #print_r($_POST);
    #print_r($_where);
    
    if(!empty($query)){
      //サブクエリ検索格納用配列
      $_code = [];
      foreach($_where as $k => $v){
        //クエリを分割
        if(preg_match("/ like /", $v)){
          list($keys,$vals) = explode(" like ",$v);
        }else{
          list($keys,$vals) = explode("=",$v);
        }
        if(!empty($SearchTargetForm[$keys]["parentKey"])){
          if($keys == "id"){
            $keys == "code";
          }
          if(preg_match("/ like /", $v)){
            $sql = "SELECT code from $table WHERE $keys like $vals";
          }else{
            $sql = "SELECT code from $table WHERE $keys=$vals";
          }
          #echo $sql."\n\n";
          $r = $this->GetResult($sql);
          if(!empty($r->num_rows)){
            $r = $this->DecodeData($r);
            //返ってきた値を格納用配列に入れる
            foreach($r as $ks => $vs){
              $_code[] = $vs["code"];
            }
          }
          #print_r($_code);
        }else{
          //sql文整形
          if(preg_match("/ like /", $v)){
            $sql = "SELECT item_id from $detailTabel WHERE item_title='$keys' AND item_value like $vals";
          }else{
            $sql = "SELECT item_id from $detailTabel WHERE item_title='$keys' AND item_value=$vals";
          }
          #echo $sql."\n\n";
          //実行
          $r = $this->GetResult($sql);
          if(!empty($r->num_rows)){
            $r = $this->DecodeData($r);
            #print_r($r);
            if(!empty($r)){
              //返ってきた値を格納用配列に入れる
              foreach($r as $ks => $vs){
                $_code[] = $vs["item_id"];
              }
            }
          }
        }
      }
      $_code =implode(",", $_code);
      $sql = "SELECT * from $table as i,$detailTabel as v where i.code=v.item_id AND v.item_id IN ($_code) order by i.code DESC ";
    }else{
      $sql = "SELECT * from $table as i,$detailTabel as v where i.code=v.item_id$query order by i.code DESC	";
    }
    
    #echo $sql;
    
    $data = $this->GetResult($sql);
    if($data){
      if(!empty($_POST["count"])){
        $data = $this->DecodeData($data);
        $data = ["count" => count($data)];
      }else{
        $data = $this->DecodeData($data);
      }
      #print_r($data);
      $d = [];
      foreach($data as $k => $v){
        $d[$v["code"]]["title"] = $v["title"];
        $d[$v["code"]]["code"] = $v["code"];
        $d[$v["code"]]["regist"] = $v["regist"];
        $d[$v["code"]]["user"] = $v["user"];
        switch($this->form[$v["item_title"]]["type"]){
          case "rendered":
            switch($v["item_title"]){
              case "category":
              case "sub_category":
                $sql = "SELECT name from Category WHERE code={$v['item_value']}";
                break;
              default:
                $sql = "SELECT name from {$form[$v['item_title']]['item']} WHERE code={$v['item_value']}";
            }
            
            $r = $this->GetResult($sql);
            if(!empty($r->num_rows)){
              $r = $this->DecodeData($r);
              $d[$v["code"]][$v["item_title"]][] = $r[0]["name"];
            }
            break;
          case "items":
          case "sets":
            if(empty($Items)){
              $flg = 1;
              if($this->form[$v["item_title"]]["type"] == "sets"){
                $Items = ["SetItemRegister","SetItemValue"];
                $_Items = ["ItemRegister","ItemValue"];
              }elseif($this->form[$v["item_title"]]["type"] == "items"){
                $Items = ["ItemRegister","ItemValue"];
              }
            }
            #print_r($Items);
            $sql = "SELECT * from {$Items[0]} as i,{$Items[1]} as v WHERE i.code=v.item_id AND code={$v['item_value']}";
            #echo $sql."\n";
            $r = $this->GetResult($sql);
            if(!empty($r->num_rows)){
              $r = $this->DecodeData($r);
              $_data = [];
              $_data["name"] = $r[0]["name"];
              $_data["title"] = $r[0]["title"];
              $_data["code"] = $r[0]["code"];
              foreach($r as $key => $val){
                if($val["item_title"] == "items"){
                  $_data[$val["item_title"]][$val["item_value"]] = $val["item_value"];
                }else{
                  $_data[$val["item_title"]] = $val["item_value"];
                }
              }
              $d[$v["code"]][$v["item_title"]][$v['item_value']][] = $_data;
            }
            if($this->form[$v["item_title"]]["type"] == "sets"){
              $sql = "SELECT * from {$_Items[0]} as i,{$_Items[1]} as v WHERE i.code=v.item_id AND v.item_id IN ({$v['item_value']})";
              #echo $sql."\n";
              #exit;
              $r = $this->GetResult($sql);
              if(!empty($r->num_rows)){
                $r = $this->DecodeData($r);
                $d[$v["code"]]["SetsName"] = $r[0]["title"];
              }
            }
            if(!empty($flg)){
              $Items = [];
            }
            #print_r($_data);
            break;
            
          case "checkbox":
            $d[$v["code"]][$v["item_title"]][] = $form[$v["item_title"]]["item"][$v["item_value"]];
            break;
            
          default:
            if(preg_match("/____(.+?)____/",$v["item_title"])){
              list($_title,$_num,$_tag)= explode("____",$v["item_title"]);
              #echo ("$_title,$_num,$_tag");
              #print_r($d);
              $d[$v["code"]][$_tag][$_num][$_title] = $v["item_value"];
            }elseif(preg_match("/____/",$v["item_title"])){
              list($_ttl,$_value)= explode("____",$v["item_title"]);
              $d[$v["code"]]["items"][$_value][0][$_ttl] = $v["item_value"];
            }else{
              if($v["item_title"] == "items"){
                $d[$v["code"]][$v["item_title"]][] = $v["item_value"];
              }else{
                $d[$v["code"]][$v["item_title"]] = $v["item_value"];
              }
            }
        }
        if(empty($d[$v["code"]]["status"])){
          $d[$v["code"]]["status"] =0;
        }

      }
      #print_r($d);
      krsort($d);
      $d = array_values($d);
      $data = [];
      if(!empty($_GET["count"])){
        $data = ["count" => count($d)];
      }else{
        foreach($d as $k => $v){
          $num++;
          if($num<=$_GET["start"]){continue;}
          if($num>($_GET["num_rows"]+$_GET["start"])){continue;}
          $data[] = $v;
        }
      }
    }
    

    if(empty($data)){
      return  $d;
    }else{
      return $data;
    }
    
  }
  
  //セット商品関連
  function Search__ManagementSets($SearchTargetForm,$table,$detailTabel){
    #echo $table;
    $q = $this->Search__SetQuerty($SearchTargetForm,1);
    $query = $q[0];
    $_where = $q[1];
    
    if(!empty($query)){
      //サブクエリ検索格納用配列
      $_code = [];
      foreach($_where as $k => $v){
        //クエリを分割
        if(preg_match("/ like /", $v)){
          list($keys,$vals) = explode(" like ",$v);
        }else{
          list($keys,$vals) = explode("=",$v);
        }
        if(!empty($SearchTargetForm[$keys]["parentKey"])){
          if($keys == "id"){
            $keys == "code";
          }
          if(preg_match("/ like /", $v)){
            $sql = "SELECT code from $table WHERE $keys like $vals";
          }else{
            $sql = "SELECT code from $table WHERE $keys=$vals";
          }
          $r = $this->GetResult($sql);
          if(!empty($r->num_rows)){
            $r = $this->DecodeData($r);
            //返ってきた値を格納用配列に入れる
            foreach($r as $ks => $vs){
              $_code[] = $vs["code"];
            }
          }
          #print_r($_code);
        }else{
          //sql文整形
          if(preg_match("/ like /", $v)){
            $sql = "SELECT item_id from $detailTabel WHERE item_title='$keys' AND item_value like $vals";
          }else{
            $sql = "SELECT item_id from $detailTabel WHERE item_title='$keys' AND item_value=$vals";
          }
          $r = $this->GetResult($sql);
          if(!empty($r->num_rows)){
            $r = $this->DecodeData($r);
            #print_r($r);
            if(!empty($r)){
              //返ってきた値を格納用配列に入れる
              foreach($r as $ks => $vs){
                $_code[] = $vs["item_id"];
              }
            }
          }
        }
      }
      $_code =implode(",", $_code);
      $sql = "SELECT * from $table as i,$detailTabel as v where i.code=v.item_id AND v.item_id IN ($_code) order by i.code DESC ";
    }else{
      $sql = "SELECT * from $table as i,$detailTabel as v where i.code=v.item_id$query order by i.code DESC	";
    }
    #echo $sql."\n\n";

    $data = $this->GetResult($sql);
    if($data){
      if(!empty($_POST["count"])){
        $data = $this->DecodeData($data);
        $data = ["count" => count($data)];
      }else{
        $data = $this->DecodeData($data);
      }
      #print_r($data);
      $d = [];
      foreach($data as $k => $v){
        $d[$v["code"]]["title"] = $v["title"];
        $d[$v["code"]]["code"] = $v["code"];
        switch($this->form[$v["item_title"]]["type"]){
          case "rendered":
            switch($v["item_title"]){
              case "category":
              case "sub_category":
                $sql = "SELECT name from Category WHERE code={$v['item_value']}";
                break;
              default:
                $sql = "SELECT name from {$this->form[$v['item_title']]['item']} WHERE code={$v['item_value']}";
            }
            
            $r = $this->GetResult($sql);
            if(!empty($r->num_rows)){
              $r = $this->DecodeData($r);
              $d[$v["code"]][$v["item_title"]][] = $r[0]["name"];
            }
            break;
          case "checkbox":
            $d[$v["code"]][$v["item_title"]][] = $form[$v["item_title"]]["item"][$v["item_value"]];
            break;
          default:
            if($v["item_title"] == "items"){
              $d[$v["code"]][$v["item_title"]][] = $v["item_value"];
            }else{
              $d[$v["code"]][$v["item_title"]] = $v["item_value"];
            }
        }

      }
      #print_r($d);
      krsort($d);
      $d = array_values($d);
      $data = [];
      if(!empty($_GET["count"])){
        $data = ["count" => count($d)];
      }else{
        foreach($d as $k => $v){
          $num++;
          if($num<=$_GET["start"]){continue;}
          if($num>($_GET["num_rows"]+$_GET["start"])){continue;}
          $data[] = $v;
        }
      }

      #print_r($data);
    }
    return $data;
  }
  
  //単品商品関連
  function Search__ManagementItems($SearchTargetForm,$table,$detailTabel,$SearchForm){
    $q = $this->Search__SetQuerty($SearchTargetForm,1);
    $query = $q[0];
    $_where = $q[1];
    
    if(!empty($query)){
      //サブクエリ検索格納用配列
      $_code = [];
      #echo $query;
      #print_r($_where);
      
      #$_where = implode(" AND ", $_where);
      #$sql = "SELECT * from $table as i,$detailTabel as v where $_where";
      #echo $sql;
      #exit;
      
      foreach($_where as $k => $v){
        //クエリを分割
        if(preg_match("/ like /", $v)){
          list($keys,$vals) = explode(" like ",$v);
        }else{
          list($keys,$vals) = explode("=",$v);
        }
        $__code = "";
        if(!empty($_code)){
          $__code = " AND  item_id IN (".implode(",",$_code).")";
        }
        if(!empty($SearchTargetForm[$keys]["parentKey"])){
          if($keys == "id"){
            $keys == "code";
          }
          
          if(preg_match("/ like /", $v)){
            $sql = "SELECT code from $table WHERE $keys like $vals$__code";
          }else{
            $sql = "SELECT code from $table WHERE $keys=$vals$__code";
          }
          
          #echo $sql."\n\n";
          $r = $this->GetResult($sql);
          if(!empty($r->num_rows)){
            $r = $this->DecodeData($r);
            //返ってきた値を格納用配列に入れる
            foreach($r as $ks => $vs){
              $_code[] = $vs["code"];
            }
          }
          #print_r($_code);
        }else{
          //sql文整形
          if(preg_match("/ like /", $v)){
            $sql = "SELECT item_id from $detailTabel WHERE item_title='$keys' AND item_value like $vals$__code";
          }else{
            $sql = "SELECT item_id from $detailTabel WHERE item_title='$keys' AND item_value=$vals$__code";
          }
          #echo $sql."\n\n";
          //実行
          $r = $this->GetResult($sql);
          if(!empty($r->num_rows)){
            $r = $this->DecodeData($r);
            #print_r($r);
            if(!empty($r)){
              //返ってきた値を格納用配列に入れる
              foreach($r as $ks => $vs){
                $_code[] = $vs["item_id"];
              }
            }
          }
        }
      }
      #print_r($_code);
      $_code =implode(",", array_unique($_code));
      
      $sql = "SELECT * from $table as i,$detailTabel as v where i.code=v.item_id AND v.item_id IN ($_code) order by i.code DESC ";
      #print_r($_code);
    }else{
      $sql = "SELECT * from $table as i,$detailTabel as v where i.code=v.item_id$query order by i.code DESC	";
    }
    #echo $sql."\n\n";
    #exit;
    $data = $this->GetResult($sql);
    if($data){
      $data = $this->DecodeData($data);
    }
    if(!empty($data)){
      $d = [];
      foreach($data as $k => $v){
        $d[$v["code"]]["name"] = $v["name"];
        $d[$v["code"]]["code"] = $v["code"];
        switch($this->form[$v["item_title"]]["type"]){
          case "rendered":
            switch($v["item_title"]){
              case "category":
              case "sub_category":
                $sql = "SELECT name from Category WHERE code={$v['item_value']}";
                break;
              default:
                $sql = "SELECT name from {$this->form[$v['item_title']]['item']} WHERE code={$v['item_value']}";
            }
            
            $r = $this->GetResult($sql);
            if(!empty($r->num_rows)){
              $r = $this->DecodeData($r);
              $d[$v["code"]][$v["item_title"]][] = $r[0]["name"];
            }
            break;
          case "checkbox":
            $d[$v["code"]][$v["item_title"]][] = $form[$v["item_title"]]["item"][$v["item_value"]];
            break;
          default:
            $d[$v["code"]][$v["item_title"]] = $v["item_value"];
        }
      }
      
      $num=0;
      $data = [];
      #print_r($data);
      if(!empty($_GET["count"])){
        $data = ["count" => count($d)];
      }else{
        foreach($d as $k => $v){
          $num++;
          if($num<=$_GET["start"]){continue;}
          if($num>($_GET["num_rows"]+$_GET["start"])){continue;}
          $data[] = $v;
        }
      }
      #$data = $d;
      #print_r($data);
    }
    
    foreach($data as $k => $v){
      if(is_array($v["category"])){
        $data[$k]["category"] = array_unique($v["category"]);
      }
      if(is_array($v["GroupIdList"])){
        $data[$k]["GroupIdList"] = array_unique($v["GroupIdList"]);
      }
      if(is_array($v["sub_category"])){
        $data[$k]["sub_category"] = array_unique($v["sub_category"]);
      }
      foreach($v as $ks => $vs){
        if(preg_match("/stock/",$ks) && empty($vs)){
          $data[$k][$ks] = 0;
        }
      }
    }
    #print_r($data);
    #exit;
    
    return $data;

  }
  
  
  function OrderListOutPut($d,$OrderTable="",$OrderView=""){
      
    foreach($OrderTable as $k => $v){
      switch($v["type"]){
        case "adress":
          $sql = "select * from Adress WHERE code={$d[$v['type']]}";
          #echo $sql."\n";
          if(empty($add)){
            $add = $this->GetResult($sql);
            if($add){
              $add = $this->DecodeData($add);
              #print_r($add);
            }
          }
          #echo $k.$v["target"]."\n";
          if(!is_array($v["target"])){
            $d[$k] = $add[0][$v["target"]];
          }else{
            foreach($v["target"] as $ks => $vs){
              $d[$k] .= $add[0][$vs];
            }
          }
          break;
          
        case "GroupIdList":
          $sql = "select * from Company WHERE code={$d[$v['type']]}";
          #echo $sql."\n";
          $com = $this->GetResult($sql);
          if($com){
            $com = $this->DecodeData($com);
            $d[$k] = $com[0]["name"];
            #$print_r($com);
          }
          break;
          
        case "select":
          $d[$k."_type"] = $d[$k];
          $d[$k] = $v["item"][$d[$k]];
          break;
          
        default:
          $d[$k] = $d->$k;
      }
    }
    #$_POST["d"] = $d;
    #print_r($d);
    
    
    //formの中にDB連動ものがあるかどうか
    #$form = $this->SetDecodeFormItems($form);
    #$itemForm = $this->SetDecodeFormItems($itemForm);
    #$searchForm = $this->SetDecodeFormItems($searchForm);
    
    $arr = [];
    foreach($OrderView as $k => $v){
      if(!empty($v["targetKey"])){
        $val = $v["targetKey"];
        $arr[] = $d[$val];
      }else{
        $arr[] = $d[$k];
      }
    }
    
    #print_r($arr);
    return $arr;
    
  }
  
  //住所検索系
  function SerachAdress($table="",$detailTabel="",$r=""){
    $query = [];
    #print_r($_POST);
    foreach($_POST as $k => $v){
      switch($k){
        case "mode":
        case "target":
        case "num_rows":
        case "count":
        case "start":
        case "action":
        case "templ":
          break;
        default:
          if(!empty($v)){
            if(is_array($v)){
              $query[] = "(address.$k='".implode("' OR address.$k='",$v)."')";
            }else{
              $query[] = "address.$k='$v'";
            }
          }
      }
    }
    if(!empty($query)){
      $query = " AND ".implode(" AND ", $query);
    }else{
      $query = "";
    }
    
    if(!empty($_POST["count"])){
      $sql = "select T.user_id from $table as U,$detailTabel as T,Company as C where U.id=T.user_id AND C.code=T.GroupIdList$query";
    }else{
      $limit = (!empty($_POST["start"]) && $_POST["num_rows"]) ? " LIMIT {$_POST['start']},{$_POST['num_rows']}" : "";
      $sql = "select address.*,c.name as CompanyName from $table as address,Company as c WHERE c.code=address.Company $query order by address.code DESC$limit ";
    }
    #echo $sql;
    $data = $this->GetResult($sql);
    if(!empty($data->num_rows)){
      if(!empty($_POST["count"])){
        $data = $this->DecodeData($data);
        $data = ["count" => count($data)];
      }else{
        $data = $this->DecodeData($data);
      }
      
      if(empty($r)){
        header("Content-Type: application/json; charset=utf-8");
        echo json_encode($data);
      }else{
        return $data;
      }
    }

  }

}