<?php
namespace Goods;
require_once(__DIR__."/manage.php");
use Manage\manage;


class Goods extends manage{
  function __construct(){
    parent::__construct();
  }
  
  //データ削除処理
  function DeleteItemSetData($mode=""){
    if(empty($mode)){return false;}
    switch($mode){
      case "item":
        $sql = "DELETE FROM ItemValue WHERE item_id={$_POST['code']}";
        $this->GetResult($sql);
        $sql = "DELETE FROM ItemRegister WHERE code={$_POST['code']}";
        $this->GetResult($sql);
        break;
      case "set":
        $sql = "DELETE FROM SetItemValue WHERE item_id={$_POST['code']}";
        $this->GetResult($sql);
        echo $sql."\n";
        $sql = "DELETE FROM SetItemRegister WHERE code={$_POST['code']}";
        $this->GetResult($sql);
        break;
    }
  }

  //複数テーブルにまたがるデータを保存する
  function RecordSeparateData(){
    if(empty($_POST)){return false;}
    if(!empty($this->CheckToken())){
      die("起動方法が不正です");
      return false;
    }
    if(!is_file(dirname(__FILE__)."/config/{$_POST['action']}.php")){
      echo dirname(__FILE__)."/config/{$_POST['action']}.php\n";
      echo "設定ファイルが見つかりません";
      return false;
    }
    //設定ファイル読み込み
    require(dirname(__FILE__)."/config/{$_POST['action']}.php");
    if(!empty($extendsForm)){
      require(dirname(__FILE__)."/config/{$extendsForm}.php");
    }
    
    foreach($_POST as $k => $v){
      if(!is_array($v)){
        $_POST[$k] = htmlspecialchars($_POST[$k]);
        $_POST[$k] = preg_replace("/\r\n|\r|\n/","<br>",$_POST[$k]);
      }
    }
    
    
    //編集モードのときは既存データを全部消して新規登録
    if($_POST["mode"] == "edit"){
      if($table == "users"){
        $sql = "delete from $table WHERE id={$_POST['user_id']}";
      }else{
        $column = $values = array();
        #print_r($form);
        foreach($form as $k => $v){
            #echo $k;
          if(!empty($v["key"])){
            $values[] = "$k='$_POST[$k]'";
          }
        }
        $values = implode(",", $values);
        $sql = "update $table set $values WHERE code={$_POST['code']}";
        #echo $sql;
      }
      $this->GetResult($sql);
      if($table == "users"){
        $sql = "delete from $detailTabel WHERE user_id={$_POST['user_id']}";
      }else{
        #$sql = "delete from $detailTabel WHERE $SerachdetailTabelTargetId={$_POST['code']}";
      }
#      echo $sql;
      $this->GetResult($sql);
    }
    #print_r($_POST);
    #echo $table;
    #exit;
    
    
    switch($_POST["mode"]){
      case "new":
      case "edit":
        if($table == "users"){
          $credentials = [];
          foreach($form as $k => $v){
            if(!empty($v["table"]) && $v["table"] == $table){
              $credentials[$k] = $_POST[$k];
            }
          }
          $r = $this->UseSentinel("insert",$credentials);
          if($r!=1){
            #echo $r;
          }else{
            $user = $this->GetResult("SELECT id from $table WHERE email='$_POST[email]'");
            if($user->num_rows){
              $user = $this->DecodeData($user);
              $_POST["user_id"] = $user[0]["id"];
              $column = $values = [];
              
              foreach($form as $k => $v){
                if($k == "code"){continue;}
                if($v["table"] != $table){
                  $column[] = $k;
                  switch($v["data_type"]){
                    case "text":
                      $values[] = "'{$_POST[$k]}'";
                      break;
                    case "integer":
                      $values[] = $_POST[$k];
                      break;
                  }
                }
              }
              
              $column = implode(",", $column);
              $values = implode(",", $values);
              
              $sql = "INSERT INTO $detailTabel ($column) VALUES($values)";
              $this->GetResult($sql);
            }
          }
        }elseif($table == "ItemRegister" || $table == "SetItemRegister"){
          #print_r($_POST);
          
          if($_POST["mode"] == "new"){
            $column = $values = array();
            foreach($form as $k => $v){
              if(!empty($v["key"])){
                $column[] = $k;
                $values[] = "'{$_POST[$k]}'";
              }
            }
            $column = implode(",", $column);
            $values = implode(",", $values);
            $sql = "INSERT INTO $table ($column) VALUES($values)";
            #echo $sql."\n";
            $this->GetResult($sql);
            $item_id = $this->last_id;
          }else{
            $item_id = $_POST["code"];
          }
          #exit;
#          echo $this->last_id;
#          print_r($_POST);
          if(!empty($item_id)){
            $chkArr = [];
            foreach($form as $k => $v){
              $chkArr[] = $k;
              if(!empty($v["key"])){continue;}
              if(!empty($k== "code")){continue;}
              if(is_array($_POST[$k])){
                #echo $k;
                foreach($_POST[$k] as $key => $val){
                  $sql = "INSERT INTO $detailTabel (item_id,item_title,item_value) VALUES($item_id,'$k','{$val}')";
                  #echo $sql."\n";
                  $r = $this->GetResult($sql);
                }
              }else{
                $sql = "INSERT INTO $detailTabel (item_id,item_title,item_value) VALUES($item_id,'$k','{$_POST[$k]}')";
                #echo $sql."\n";
                $r = $this->GetResult($sql);
              }
              
            }
            #exit;
              
            //ポストデータ
            foreach($_POST as $k => $v){
              if(!in_array($k, $chkArr)){
                $sql = "INSERT INTO $detailTabel (item_id,item_title,item_value) VALUES($item_id,'$k','{$v}')";
                $r = $this->GetResult($sql);
              }
            }
            
            return $r;
          }
        }elseif($table == "OrderRegister" || $table == "OrderValue"){
          #print_r($_POST);
          $chk = [];
          if($_POST["mode"] == "new"){
            $column = $values = array();
            foreach($form as $k => $v){
              if(!empty($v["key"])){
                $column[] = $k;
                if($k == "title"){
                  if(!is_dir(FCPATH."/../tmp/Order")){
                    mkdir(FCPATH."/../tmp/Order",0777);
                  }
                  $name = tempnam(FCPATH."/../tmp/Order","");
                  $name = explode("/",$name);
                  $name = $name[count($name)-1];
                  $values[] = "'$name'";
                }else{
                  $values[] = "'{$_POST[$k]}'";
                }
                $chk[] = $k;
              }
            }
            $column = implode(",", $column);
            $values = implode(",", $values);
            $sql = "INSERT INTO $table ($column) VALUES($values)";
            $this->GetResult($sql);
            $item_id = $this->last_id;
            #echo $item_id."\n";
          }else{
            $item_id = $_POST["code"];
          }
          if(!empty($item_id)){
            foreach($_POST as $k => $v){
              if(in_array($k, $chk)){continue;}
              if(!empty($k== "code")){continue;}
              if(is_array($v)){
                #echo $k;
                foreach($v as $key => $val){
                  $sql = "INSERT INTO $detailTabel (item_id,item_title,item_value) VALUES($item_id,'$k','{$val}')";
                  #echo $sql."\n";
                  $r = $this->GetResult($sql);
                }
              }else{
                $sql = "INSERT INTO $detailTabel (item_id,item_title,item_value) VALUES($item_id,'$k','{$v}')";
                #echo $sql."\n";
                $r = $this->GetResult($sql);
              }
            }
            return $r;
          }
          
        }
        break;
    }
  }

  
}