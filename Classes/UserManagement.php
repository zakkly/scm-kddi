<?php
namespace UserManagement;
require_once(__DIR__."/manage.php");
use Manage\manage;

use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Cartalyst\Sentinel\Reminders\EloquentReminder as Reminder;
use Illuminate\Database\Capsule\Manager as Capsule;

class UserManagement extends manage{
  function __construct(){
    parent::__construct();
    
    
    $this->capsule = new Capsule;
    $this->capsule->addConnection([
        'driver'    => 'mysql',
        'host'      => _SERVER_,
        'database'  => _DB_,      // データベース名を変更していたら合わせて変更
        'username'  => _USER_,          // xxxxを、データベースのユーザー名に変更
        'password'  => _PASS_,        // xxxxxxを、データベースのパスワードに変更
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ]);
    $this->capsule->bootEloquent();
  }
  
  
  function UserDataChk(){
    $capsule = $this->capsule;
    
    $_credentials = [
      'email' => "{$_POST['email']}",
      'password' => "{$_POST['password']}"
    ];
    $credentials = $_credentials;
    
    if(!empty($_POST['first_name'])){
      $credentials["first_name"] = "{$_POST['first_name']}";
    }
    if(!empty($_POST['last_name'])){
      $credentials["last_name"] = "{$_POST['last_name']}";
    }
    
    #$user = ;
    $arr = array(Sentinel::getUserRepository()->findByCredentials($_credentials),$credentials);
    return $arr;
  }
  
  function DeleteUserData(){
	  #print_r($_POST);
	  $sql = [];
	  $sql[] = "delete from UserManagement WHERE user_id={$_POST['code']}";
	  $sql[] = "delete from role_users WHERE user_id={$_POST['code']}";
	  $sql[] = "delete from activations WHERE user_id={$_POST['code']}";
	  $sql[] = "delete from users WHERE id={$_POST['code']}";
	  
	  foreach($sql as $k => $v){
		  $r = $this->GetResult($v);
		  echo $v."\n";
	  }
    
    #$user = Sentinel::registerAndActivate($credentials);
  }
  

  
  function RecordUserData(){
    $capsule = $this->capsule;
    #print_r($_POST);
    #exit;
    //登録前のエラーチェック
    $err = [];
    
    // メールアドレスが登録済みかを確認
    $user = $this->UserDataChk();
    $credentials = $user[1];
    $user = $user[0];
    
    //新規登録時にデータが登録されているかチェック
    if(empty($_POST['email'])){
      $err[] = "メールアドレスが未入力です";
    }
    if(!is_null($user) && $_POST["mode"] == "new"){
      $err[] = "<strong>{$_POST['email']}</strong> : 「{$_POST['email']}」はすでに登録されています";
    }
    if(!is_numeric($_POST["GroupIdList"])){
      $err[] = "<strong>{$_POST['email']}</strong> : 「企業属性」は「企業コード」で登録してください";
    }
    //企業属性の存在チェック
    $sql = "SELECT * FROM Company WHERE code={$_POST['GroupIdList']} limit 1";
    $r = $this->Getresult($sql);
    if(empty($r->num_rows)){
      $err[] = "<strong>{$_POST['email']}</strong> : 企業属性「{$_POST['GroupIdList']}」は登録されていません";
    }
    
    #echo $sql;
    
    //エラーがあれば強制終了
    if(count($err)){
      echo implode("<br>\n", $err)."<br>";
      return false;
    }
    
    
    
    
    if(is_null($user)){
      //登録がなければ登録＆アクティベート
    #print_r($user);
    #print_r($credentials);
    #exit;
      $user = Sentinel::registerAndActivate($credentials);
      //会社情報取得
      $sql = "SELECT * from Company WHERE code={$_POST['GroupIdList']}";
      #echo $sql;
      $r = $this->GetResult($sql);
      if(!empty($r->num_rows)){
        $r = $this->DecodeData($r);
        //role取得
        $role = Sentinel::findRoleByName($r[0]["name"]);
        if(is_null($role)){
          //roleがなければroleを作る
          $role = Sentinel::getRoleRepository()->createModel()->create(['name' => $r[0]["name"],'slug' => $_POST['GroupIdList']]);
        }
        //USER情報取得
        $user = Sentinel::getUserRepository()->findByCredentials($credentials);
        //role設定
        $role->users()->attach($user);
        
        $sql = "SELECT id from users WHERE email='$_POST[email]'";
        #echo $sql."\n";
        $user = $this->GetResult($sql);
        #print_r($user);
        if($user->num_rows){
          //設定ファイル読み込み
          require(dirname(__FILE__)."/config/UserManagement/Index.php");
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
          
          $sql = "INSERT INTO UserManagement ($column) VALUES($values)";
          $this->GetResult($sql);
        }
      }
    }else{
      #print_r($_POST);
      //基本情報をupdate
      $user = Sentinel::update($user, $credentials);
      //user id取得
      $sql = "SELECT id from users WHERE email='$_POST[email]'";
      $user = $this->GetResult($sql);
      if($user->num_rows){
        //設定ファイル読み込み
        require(dirname(__FILE__)."/config/UserManagement/Index.php");
        $user = $this->DecodeData($user);
        //user id定義
        $_POST["user_id"] = $user[0]["id"];
        $column = $values = [];
          
        foreach($form as $k => $v){
          if($k == "code"){continue;}
          if($v["table"] != $table){
            $column[] = $k;
            switch($v["data_type"]){
              case "text":
                $values[] = "$k = '{$_POST[$k]}'";
                break;
              case "integer":
                $values[] = "$k=".$_POST[$k];
                break;
            }
          }
        }
        $values = implode(",",$values);
        $sql = "UPDATE UserManagement SET $values WHERE user_id={$_POST['user_id']}";
        $this->GetResult($sql);
        
      }
    }
    
  }
  

}