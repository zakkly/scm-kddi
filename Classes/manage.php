<?php
namespace Manage;
require_once(__DIR__."/basic.php");
session_start();


use Base\base;
use \Verot\Upload\Upload;

use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Cartalyst\Sentinel\Reminders\EloquentReminder as Reminder;
use Illuminate\Database\Capsule\Manager as Capsule;



class manage extends base{
  function __construct(){
    parent::__construct();
    
    if($_GET["mode"]){
      $_POST["mode"] = $_GET["mode"];
    }
    
    $this->SetTeml();
    $this->LoginCheck();
    
    
    
    
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
  
  function LoginCheck(){
    if($this->tmpl == "login"){
      return false;
    }
    
    if(empty($_SESSION["login"])){
      header("Location:"._BASE_URL_."/login.php");
    }
    
    foreach($_GET as $k => $v){
      $_POST[$k] = $v;
    }
    
    //クリックジャッキング対策
    header('X-FRAME-OPTIONS: SAMEORIGIN');
    // トークン生成
    if (!isset($_SESSION['token'])) {
      $_SESSION['token'] = sha1(random_bytes(30));
    }
  }
  
  function SetTeml(){
    $url =  (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $url = explode(_BASE_URL_."/",$url);
    $url = explode(".php",$url[1]);
    $file = explode("?",$url[0]);
    $file = $file[0];
    
    $this->tmpl = $file;
  }
  
  
  function SetUnitType(){
    $sql = "SELECT * FROM unit where views IS  NULL ORDER BY code ASC";
    #echo $sql."\n";
    $r = $this->GetResult($sql);
    if(!empty($r->num_rows)){
      $r = $this->DecodeData($r);
      $data = [];
      foreach($r as $k => $v){
        $data[$v["code"]] = $v;
      }
      return $data;
    }
  }
  
  
  
  //検索用配列作成
  function SetDecodeFormItems($form=array()){
    if(empty($form)){return false;}
    
    //formの中にDB連動ものがあるかどうか
    foreach($form as $k => $v){
      //item値が配列じゃなかったら処理開始
      if(!empty($v["item"]) && !is_array($v["item"])){
        //where句は設定依存
        $where = (empty($v["where"])) ? "" : " where".$v["where"];
        //sql成形
        $sql = "select * from {$v['item']}$where order by code desc";
        //sql実行
        $r = $this->GetResult($sql);
        if(!empty($r->num_rows)){
          //デコード
          $data = $this->DecodeData($r);
          //配列に書き換え
          $form[$k]["item"] = array();
          foreach($data as $key => $val){
            $form[$k]["item"][$val["code"]] = $val["name"];
          }
        }
      }
    }
    
    return $form;
  }

  
  function GetDataJson(){
    //主要データがなければ強制終了
    if(empty($_POST["target"]) || empty($_POST["val"])){
      return false;
    }
    if($_POST["target"] == "GroupIdList"){
      if(is_array($_POST["val"])){
        $val = " AND (cc.c_company=".implode(" OR cc.c_company=", $_POST["val"]).")";
      }
      $sql = "select * from Category as c, CategoryCompany as cc WHERE (c.parent IS NULL OR c.parent=0) AND cc.c_category = c.code$val";
      #echo $sql."\n";
    }else{
      if(is_array($_POST["val"])){
        $_POST["val"] = " (c.parent=".implode(" OR c.parent=", $_POST["val"]).")";
      }
      $sql = "select * from {$_POST['target']} as c WHERE{$_POST['val']} order by code";
    }
    #echo $sql;
    #file_put_contents("sql.txt", $sql);
    $r = $this->GetResult($sql);
    if(!empty($r->num_rows)){
      $r = $this->DecodeData($r,"code");
      $r = array_values($r);
      #print_r($r);
      header("Content-Type: application/json; charset=utf-8");
      echo json_encode($r);
    }
    
  }

  
  function CheckToken(){
    if(!(hash_equals($_POST["token"], $_SESSION['token']) && !empty($_POST["token"]))) {
      return "起動方法が不正です";
    }
  }

  function RecordCheckboxData(){
    if(empty($_POST)){return false;}
    if(!empty($this->CheckToken())){
      die("起動方法が不正です");
      return false;
    }
    if(!is_file(dirname(__FILE__)."/config/{$_POST['action']}.php")){
      echo dirname(__FILE__)."/config/{$_POST['action']}.php";
      echo "設定ファイルが見つかりません";
      return false;
    }
    //設定ファイル読み込み
    require(dirname(__FILE__)."/config/{$_POST['action']}.php");
    #echo "aaa";
    #print_r($_POST);
    
    foreach($_POST as $key => $val){
      if(is_array($val)){
        $sql = "delete from $detailTabel where c_company={$_POST['code']}";
        #echo $sql."\n";
        $this->GetResult($sql);
        foreach($val as $k => $v){
          $sql = "Insert Into $detailTabel (c_category,c_company) values($_POST[code],$v)";
          #echo $sql."\n";
          $this->GetResult($sql);
        }
      }
    }
  }
  
  //複数テーブルにまたぐデータを件s区
  function SerachItems($form="",$SerachTable="",$SerachdetailTabel="",$Items=[],$json=""){
    if(empty($form)){return false;}
    if(empty($SerachTable)){return false;}
    if(empty($SerachdetailTabel)){return false;}
    //クエリ配列初期化
    $query = [];
    //不必要なものはクエリに入れない
    foreach($_POST as $k => $v){
      switch($k){
        case "mode":
        case "target":
        case "token":
        case "num_rows":
        case "count":
        case "start":
        case "set":
        case "action":
        case "json":
        case "templ":
        case "table":
          break;
        default:
          if(!empty($v)){
            if(!empty($this->OrderSearchForm) && !empty($this->OrderSearchForm[$k]["parentkey"])){
              $query[] = "$k='$v'";
            }else{
              $query[] = "(item_title='$k' AND item_value='$v')";
            }
          }
      }
    }
    #print_r($_POST);
    //クエリモード切り替え
    if(!empty($query) && $_POST["mode"] == "search"){
      #$query = implode(" OR ", $query);
      $ids = [];
      foreach($query as $k => $v){
        $where = "";
        if(!empty($ids)){
          $where = " AND $this->SerachdetailTabelTargetId IN (".implode(",", $ids).")";
          $ids = [];
        }
        if(!empty($this->OrderSearchForm) && !preg_match("/ AND /",$v)){
          $this->SerachdetailTabelTargetId = "code";
          $sql = "SELECT $this->SerachdetailTabelTargetId from $SerachTable WHERE $v$where";
        }else{
          $sql = "SELECT $this->SerachdetailTabelTargetId from $SerachdetailTabel WHERE $v$where";
        }
        $d = $this->GetResult($sql);
        if($d){
          $d = $this->DecodeData($d);
          $q = [];
          if(empty($d)){return false;}
          foreach($d as $k => $v){
            $ids[] = $v[$this->SerachdetailTabelTargetId];
          }
        }
        #print_r($ids);
        #echo $sql."\n";
      }
      #echo $sql;
      $d = $this->GetResult($sql);
      if($d){
        $d = $this->DecodeData($d);
        $q = [];
        if(empty($d)){return false;}
        foreach($d as $k => $v){
          $q[] = $v[$this->SerachdetailTabelTargetId];
        }
        $q = implode(" , ", $q);
        #echo $q;
        $sql = "SELECT * from $SerachTable as i,$SerachdetailTabel as v WHERE i.code=v.item_id AND v.$this->SerachdetailTabelTargetId IN ($q)";
        #print_r($d);
      }
      #echo $sql;
      #exit;
    }elseif($_POST["mode"] == "EditMode"){
      $sql = "SELECT * from $SerachTable as i,$SerachdetailTabel as v where i.code=v.item_id AND i.code={$_POST['code']}";
    }elseif($_POST["mode"] == "modal"){
      $sql = "SELECT * from $SerachTable as i,$SerachdetailTabel as v where i.code=v.item_id AND i.code={$_POST['code']}";
    }else{
      $query = "";
      if(!empty($_POST["code"])){
        $query = " AND code=".$_POST["code"];
      }
      //sql文成形
      $sql = "SELECT * from $SerachTable as i,$SerachdetailTabel as v where i.code=v.item_id$query";
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
      #print_r($data);
      //配列初期化
      $d = [];
      //データ成形
      if(empty($data)){return false;}
      foreach($data as $k => $v){
        $d[$v["code"]]["name"] = $v["name"];
        $d[$v["code"]]["title"] = $v["title"];
        $d[$v["code"]]["code"] = $v["code"];
        #$d[$v["code"]]["status"] = $v["status"];
        $d[$v["code"]]["user"] = $v["user"];
        if(!empty($v["user"])){
          $sql = "SELECT * FROM users WHERE email='".$v["user"]."'";
          $u = $this->GetResult($sql);
          if($u){
            $u = $this->DecodeData($u);
            $d[$v["code"]]["user"] = $u[0]["first_name"]." ".$u[0]["last_name"];
          }
        }
        $d[$v["code"]]["regist"] = $v["regist"];
        if(preg_match("/____(.+?)____/",$v["item_title"])){
          list($_title,$_num,$_tag)= explode("____",$v["item_title"]);
          $d[$v["code"]][$_tag][$_num][0][$_title] = $v["item_value"];
        }elseif(preg_match("/____/",$v["item_title"])){
          list($_ttl,$_value)= explode("____",$v["item_title"]);
          $d[$v["code"]]["items"][$_value][0][$_ttl] = $v["item_value"];
        }
        switch($form[$v["item_title"]]["type"]){
          case "rendered":
            switch($v["item_title"]){
              case "category":
              case "sub_category":
                $sql = "SELECT name,code from Category WHERE code={$v['item_value']}";
                break;
              default:
                $sql = "SELECT name,code from {$form[$v['item_title']]['item']} WHERE code={$v['item_value']}";
            }
            $r = $this->GetResult($sql);
            if(!empty($r->num_rows)){
              $r = $this->DecodeData($r);
              if(is_array($d[$v["code"]][$v["item_title"]])){
                if(!in_array($r[0]["name"], $d[$v["code"]][$v["item_title"]])){
                  $d[$v["code"]][$v["item_title"]][] = $r[0]["name"];
                }
              }else{
                $d[$v["code"]][$v["item_title"]][] = $r[0]["name"];
              }
              if(is_array($d[$v["code"]][$v["item_title"]."_code"])){
                if(!in_array($r[0]["code"], $d[$v["code"]][$v["item_title"]."_code"])){
                  $d[$v["code"]][$v["item_title"]."_code"][] = $r[0]["code"];
                }
              }else{
                $d[$v["code"]][$v["item_title"]."_code"][] = $r[0]["code"];
              }
            }
            break;
          case "checkbox":
            $d[$v["code"]][$v["item_title"]][] = $form[$v["item_title"]]["item"][$v["item_value"]];
            break;
          case "ItemSetArr":
            #print_r($v);
            #echo $_value."\n\n";
            if(!empty($v["item_value"])){
              $d[$v["code"]]["items"][$_value][$v["item_title"]] = $v["item_value"];
            }
            break;
          case "sets":
          case "items":
            #print_r($v);
            if(empty($Items)){
              $flg = 1;
              if($form[$v["item_title"]]["type"] == "sets"){
                $Items = ["SetItemRegister","SetItemValue"];
                $_Items = ["ItemRegister","ItemValue"];
              }elseif($form[$v["item_title"]]["type"] == "items"){
                $Items = ["ItemRegister","ItemValue"];
              }
            }
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
            if($form[$v["item_title"]]["type"] == "sets"){
              $sql = "SELECT * from {$_Items[0]} as i,{$_Items[1]} as v WHERE i.code=v.item_id AND v.item_id IN ({$v['item_value']})";
              #echo $sql."\n";
            }
            if(!empty($flg)){
              $Items = [];
            }
            break;
          
          default:
            $d[$v["code"]][$v["item_title"]] = str_replace(array("<br>"),array("\n"),$v["item_value"]);
        }
        if(empty($d[$v["code"]]["status"])){
          $d[$v["code"]]["status"] =0;
        }
      }
      if(!empty($_POST["count"])){
        $d = ["count" => count($d)];
      }
      #print_r($d);
      $d = array_values($d);
      if(empty($json)){
        header("Content-Type: application/json; charset=utf-8");
        echo json_encode($d);
      }else{
        return $d;
      }
    }

  }


  function RecordData(){
    if(!is_file(dirname(__FILE__)."/config/{$_POST['action']}.php")){
      echo dirname(__FILE__)."/config/{$_POST['action']}.php";
      echo "設定ファイルが見つかりません";
      return false;
    }
    #print_r($_POST);
    #exit;
    //設定ファイル読み込み
    require(dirname(__FILE__)."/config/{$_POST['action']}.php");
    
    foreach($_POST as $k => $v){
      if(!is_array($v)){
        $_POST[$k] = htmlspecialchars($_POST[$k]);
        $_POST[$k] = str_replace(array("\r\n", "\r", "\n"), "<br />", $_POST[$k]);
      }
    }
    
    #print_r($_POST);
    if(!empty($_POST['delete'])){
      $_POST["mode"] = "delete";
    }
    //日付対策
    foreach($form as $k => $v){
      if($v["type"] == "date"){
        $tmp = array();
        foreach($v["item"] as $ks => $vs){
          $str = $k."_".$vs;
          $tmp[$vs] = (!empty($_POST[$str])) ? $_POST[$str] : 0;
        }
        $_POST[$k] = date("Y-m-d H:i:s",mktime($tmp["hour"],$tmp["minute"],$tmp["secound"],$tmp["month"],$tmp["date"],$tmp["year"]));
      }
    }
    #print_r($_POST);
    switch($_POST["mode"]){
      case "new":
        foreach($form as $k => $v){
          if($k == "code"){continue;}
          
          switch($v["data_type"]){
            case "text":
            case "date":
              $column[] = $k;
              $values[] = "'".$_POST[$k]."'";
              break;
            case "tel":
               for($i=0;$i<3;$i++){
                 $key = "tel".($i+1);
                 $column[] = $key;
                 $values[] = "'{$_POST[$key]}'";
               }
              break;
              
            default:
              $column[] = $k;
              $_POST[$k] = empty($_POST[$k]) ? 0:$_POST[$k];
              $values[] = $_POST[$k];
              break;
          }
        }
        $column = implode(",",$column);
        $values = implode(",",$values);
        #print_r($_POST);
        
        $sql = "insert into {$table} ($column) values($values)";
        #echo $sql."\n";
        #exit;
        $result = $this->GetResult($sql);
        #var_dump($result);
        if($result != 1){
          return  "新規登録時になんらかの実行エラーが発生しました。クエリを実行できません<!-- $sql -->";
        }
        
        //insertしたautoincrement値を取得
        $sql = "select code from {$table} order by code DESC limit 0,1";
        #echo $sql."\n";
        $result = $this->GetResult($sql);
        if($result != 1){
          $result = $this->DecodeData($result);
          $this->target_code = $result[0]["code"];
        }
        
        break;
      
      case "edit":
        foreach($form as $k => $v){
          if($k == "code"){continue;}
          switch($v["data_type"]){
            case "text":
            case "image":
            case "date":
              $values[] = "$k = '".$_POST[$k]."'";
              break;
              
            case "tel":
               for($i=0;$i<3;$i++){
                 $key = "tel".($i+1);
                 $values[] = "$key='{$_POST[$key]}'";
               }
              break;
              
            default:
              $_POST[$k] = empty($_POST[$k]) ? 0:$_POST[$k];
              $values[] = "$k = ".$_POST[$k];
              break;
          }
        }
        $values = implode(",", $values);
        $sql = "update $table set $values where code={$_POST['code']}";
        #echo $sql."\n";
        $result = $this->GetResult($sql);
        if($result != 1){
          #echo $sql."\n";
          return "編集登録時になんらかの実行エラーが発生しました。クエリを実行できません。<!-- $sql -->";
        }
        break;
        
      case "delete":
        $sql = "delete from $table where code={$_POST[code]}";
        $result = $this->GetResult($sql);
        if($result != 1){
          return "なんらかの実行エラーが発生しました2";
        }
        break;
    }
    
  }

  
  // HTML特殊文字をエスケープする関数
  function escape($str) {
    return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
  }
  
  function upload_files(){
    //リクエストヘッダを取得
    $headers = getallheaders();
    //仮ファイルの名前を定義
    $tmp_file = sprintf("%stmp/%s-%010d", FCPATH."/../", $headers['File-Key'], $headers['Chunk-Index']);
    //リクエストボディを変数に格納
    $body = file_get_contents('php://input');
    //画像を保存
    file_put_contents($tmp_file, $body);
    #echo $tmp_file;
    
    if(!is_dir(FCPATH.'/../csv/')){
      mkdir(FCPATH.'/../csv/',0777);
    }
    
    if(!is_dir(FCPATH.'/../tmp')){
      mkdir(FCPATH.'/../tmp',0777);
    }
    
    
    // ファイルが揃っているかチェック
    $chunk_list = array_filter(glob( FCPATH.'/../tmp/'.$headers['File-Key'].'*'), 'is_file');  //ディレクトリは除外
    $chunk_count = count($chunk_list);
    
    // 他のチャックがアップロードされるのを待つ
    if ($chunk_count < $headers['Chunk-Total']) {
      return;
    }
    // チャンクが揃ったら結合する
    // 結合用の同名ファイルが存在したら消しておく
    $file_path = FCPATH."/../csv/_".$headers["time"].'.csv';
    if (file_exists($file_path)) {
      unlink($file_path);
    }
    
    // 順番に結合
    foreach($chunk_list as $chunk_path) {
      $chunk = file_get_contents($chunk_path);
      file_put_contents($file_path, $chunk, FILE_APPEND);
      #echo $chunk_path."\n";
      unlink($chunk_path);
    }
    
    #print_r($chunk_list);
    
    $fp = file($file_path);
    #print_r($headers);
    $this->RecordCsvData($file_path,$headers);
  }
  
  function RecordCsvData($file_path="",$headers){
    if(empty($file_path)){return false;}
    if(!is_file($file_path)){return false;}
    #echo $file_path."\n";
    #print_r($headers);
    
    
    //リクエストヘッダを取得
    $headers = getallheaders();
    //cSVファイル読み込み
    $csv = file($file_path);
    // ヘッダーを切り取る.
    $csv_header = $csv[0];
    //ぼでぃ 
    $csv_body = array_splice($csv, 1);
    #print_r($headers);
    switch($headers["target"]){
      case "users":
        //設定ファイル読み込み
        require $this->config;
        foreach ($csv_body as $key => $row) {
          if($key == 0){
            continue;
          }
          $row_array = explode(',', $row);
          $i=0;
          foreach($form as $k => $v){
            if(empty($v["name"])){continue;}
            //文字コードを治す
            $_POST[$k] = str_replace(array("\n","\r","\n\r"),"",mb_convert_encoding($row_array[$i],"UTF8","SJIS-win"));
            $i++;
          }
          $_POST["mode"] = "new";
          $_POST["token"] = $headers["token"];
          $_POST["user"] = $headers["user"];
          $_POST['action'] = $this->action;
          $this->RecordUserData();
        }
        #echo "登録が完了しました";
        #exit;
        break;
        
      case "items":
        // 各行を配列に直す.
        //設定ファイル読み込み
        require $this->config;
        foreach ($csv_body as $i => $row) {
          $row_array = explode(',', $row);
          $i=0;
          echo $this->config;
          print_r($form);
          foreach($form as $k => $v){
            if(empty($v["name"])){continue;}
            //文字コードを治す
            $_POST[$k] = str_replace(array("\n","\r","\n\r"),"",mb_convert_encoding($row_array[$i],"UTF8","SJIS-win"));
            $i++;
          }
          $_POST["mode"] = "new";
          $_POST["token"] = $headers["token"];
          $_POST["user"] = $headers["user"];
          $_POST['action'] = $this->action;
          #print_r($_POST);
          $this->RecordSeparateData();
          if($i==2){
            exit;
          }
        }
        
        echo "登録が完了しました";
        break;
        
      case "Address":
      case "Company":
        #print_r($headers);
        //設定ファイル読み込み
        require $this->config;
        foreach ($csv_body as $i => $row) {
          $row_array = explode(',', $row);
          $i=0;
          foreach($form as $k => $v){
            if(empty($v["name"])){continue;}
            if($k == "tel"){
              for($n=1;$n<=3;$n++){
                $key = $k.$n;
                $cnt = $i+$n-1;
                $_POST[$key] = str_replace(array("\n","\r","\n\r"),"",mb_convert_encoding($row_array[$cnt],"UTF8","SJIS-win"));
              }
            }else{
              $_POST[$k] = str_replace(array("\n","\r","\n\r"),"",mb_convert_encoding($row_array[$i],"UTF8","SJIS-win"));
            }
            $i++;
          }
          $_POST["mode"] = "new";
          $_POST["token"] = $headers["token"];
          $_POST['action'] = $this->action;
          #print_r($_POST);
          $this->RecordData();
        }
        echo "登録が完了しました";
        break;
        
      case "order":
        foreach ($csv_body as $i => $row) {
          $row_array = explode(',', $row);
          $i=0;
          #print_r($row_array);
          //伝票番号を登録
          $sql = "DELETE FROM OrderValue WHERE item_id=$row_array[0] AND item_title='SlipNumber'";
          $this->GetResult($sql);
          #echo $sql."\n";
          $sql = "INSERT INTO OrderValue (item_id,item_title,item_value) VALUES($row_array[0],'SlipNumber','$row_array[2]')";
          $this->GetResult($sql);
          #echo $sql."\n";
          $sql = "UPDATE OrderValue SET item_value=2 WHERE item_id=$row_array[0] AND item_title='status'";
          $this->GetResult($sql);
          #echo $sql."\n";
        }
        echo "登録が完了しました";
        break;
      
    }
    #echo $file_path;
    unlink($file_path);
    
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
  
  

  
  function UserPasswordReset(){
    $capsule = $this->capsule;
    if(empty($_POST["key"])){return false;}
    $sql = "SELECT * FROM reminders as r,users as u WHERE u.id=r.user_id AND r.code='".$_POST["key"]."'";
    #echo $sql;
    $r = $this->Getresult($sql);
    #print_r($r);
    if(!empty($r->num_rows)){
      $r = $this->DecodeData($r);
      #print_r($r);
      $_POST["email"] = $r[0]["email"];
      $user = $this->UserDataChk();
      $user = Sentinel::update($user[0], $user[1]);
      $sql = "DELETE FROM reminders code='".$_POST["key"]."'";
      $this->GetResult($sql);
    }else{
      echo "URLが無効です";
    }
    
  }
  
  function ReminderUserMail($user=''){
    $user[0] = json_decode(json_encode($user[0]), true);
    //ライブラリがnativeに対応してないので自作することにする。
    $reminder_code = $this->random(32);
    $sql = "Insert INTO reminders (user_id,code) VALUES({$user[0]['id']},'".$reminder_code."')";
    $this->GetResult($sql);
    
    $title = _SITE_TITLE_;
    $url   = _BASE_URL_."/reminders?key=$reminder_code";
    $contnents = <<<_HTML_
〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓

　　　　　　　　　　　パスワード再設定について

〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓

{$user[0]["last_name"]} {$user[0]["first_name"]} 様

平素は大変お世話になっております。
{$title}事務局です。

パスワードの再設定をおこないますので、下記のURLからパスワードを再設定してください。
$url

※有効時間は30分です

ご不明な点がございましたら、お手数ではありますが{$title}事務局にお問い合わせください。

_HTML_;
    $contnents = str_replace(array("\n"), array("<br>"), $contnents);
    //メール送信
    $this->MialSender("reminder@"._DOMAIN_,$user[0]["email"],"パスワード再設定手続きのご案内",$contnents);
  }
  
  function OrderMail(){
	  $sql = "SELECT id,name,mail from OrderMail WHERE view!=1";
    $r = $this->GetResult($sql);
    if(!empty($r->num_rows)){
	    $r = $this->DecodeData($r);
	  }else{
		  return false;
	  }
    #print_r($r);
    
    $title = _SITE_TITLE_;
    $url   = _BASE_URL_."/Admin/OrderManagement";
    foreach($r as $k => $v){
		  $contnents = <<<_HTML_
〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓

　　　　　　　　　　　　新規発注がありました

〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓

{$v["name"]} 様

平素は大変お世話になっております。
{$title}事務局です。

新規発注がありましたので以下URLよりご確認ください
$url


ご不明な点がございましたら、お手数ではありますが{$title}事務局にお問い合わせください。

_HTML_;
	    $contnents = str_replace(array("\n"), array("<br>"), $contnents);
	    //メール送信
	    $this->MialSender("order@"._DOMAIN_,$v["mail"],"[$title]新規発注がありました",$contnents);
	    $fp = $v["mail"]."\n\n".$contnents;
	    file_put_contents(__DIR__."/../html/static/Log/".time(), $fp);
    }

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
    #$arr = array(Sentinel::getUserRepository()->findByCredentials($_credentials),$credentials);
    
    $arr = [Sentinel::findByCredentials($credentials),$credentials];
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

  
  Function RecordUserData(){
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
    
    
    
    #exit;
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
          #echo $sql;
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


/*
====================================================

これ以下ユーザ領域

====================================================
*/
  //FAQデータ取得
  function GetFaq($cat="",$cont=""){
    if(empty($cat)){return false;}
    if(empty($cont)){return false;}
    
    $sql = "SELECT * from $cat Order BY code";
    $cat = $this->GetResult($sql);
    if($cat){
      $cat = $this->DecodeData($cat,"code");
      foreach($cat as $k => $v){
        $sql = "SELECT * FROM $cont WHERE category={$v['code']} ORDER BY code ASC";
        #echo $sql."\n";
        $contents = $this->GetResult($sql);
        if($contents){
          $contents = $this->DecodeData($contents,"code");
          if($contents){
            foreach($contents as $key => $val){
              $contents[$key]["contents"] = str_replace(array("&lt;","&gt;"), array("<",">"), $val["contents"]);
            }
            $cat[$k]["item"] = $contents;
          }
        }
      }
    }
    return $cat;
  }



}
