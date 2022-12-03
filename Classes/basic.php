<?php
namespace Base;
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
require_once(__DIR__."/config/config.php");
date_default_timezone_set('Asia/Tokyo');

require_once(__DIR__."/HolidayDateTime.php");
use HolidayDateTime\HolidayDateTime;

class base{
  function __construct(){
    //ユーザーエージェント
#    $this->agent = new agent;
    
    
    //日付設定
    $this->time = time();
    $this->date = date("Y-n-d-h-i-s-w");
    list($this->Y,$this->M,$this->D,$this->H,$this->Mi,$this->s,$this->W) = explode("-", $this->date);
    
    
    //曜日
    $this->Wday = array("日","月","火","水","木","金","土");
  }
  //英数乱数生成
  function makeRandStr($length) {
    $str = array_merge(range('a', 'z'), range('0', '9'), range('A', 'Z'));
    $r_str = null;
    for ($i = 0; $i < $length; $i++) {
      $r_str .= $str[rand(0, count($str))];
    }
    return $r_str;
  }
  
  function DBManage($table =''){
  }
  
  /* 汎用関数 */
  function GetResult($query){
    $this->DBManage();
    /* 接続 */
    
    $MyLink = mysqli_connect(_SERVER_, _USER_, _PASS_);
    mysqli_set_charset($MyLink,"utf8");
    /* DB */
    $tmp = mysqli_select_db($MyLink,_DB_);
    /* クエリー */
    if(empty($query)){
      return false;
    }
    $MyResult = mysqli_query($MyLink,$query);
    $this->last_id = mysqli_insert_id($MyLink);
    /* 切断 */
    mysqli_close($MyLink);
    /* Return */
    return $MyResult;
  }
  
  //AUTO_INCREMENTを返す
  function GetIncrementCode($table){
    $sql = "select code from $table order by code DESC limit 0,1";
    $code = $this->GetResult($sql);
    $code = $this->DecodeData($code);
    return $code[0][code];
  }
  
  function GetData($field,$target){
    $query = "SELECT * FROM $this->table WHERE `$field` = $target";
    return($this->GetResult($query));
  }
  
  function DeleteData($field,$target){
    $query = "DELETE FROM $this->table WHERE `$field` = $target";
    return($this->GetResult($query));
  }
  
  //データ成形関数
  //第一引数：mysql結果
  //第二引数：成形用キーの名前
  function DecodeData($result,$key=''){
    if(!$result){
      $this->Error("データが存在しません");
      return false;
    }
    
    while ($row = mysqli_fetch_assoc($result)) {
      if(empty($key)){
        $data[] = $row;
      }else{
        $data[$row[$key]] = $row;
      }
    }
    
    return $data;
  }


  
  //フォーム出力関数群
  
  //カレンダー関連
  
  function OutputCalendarView($key,$val){
    if(preg_match("/calendar/",$_GET[reff])){
      echo '<script type="text/javascript" src="/js/calendar.js"></script>'."\n";
    }else{
      echo '<script type="text/javascript" src="/js/calendar_edit.js"></script>'."\n";
    }
    $cls[] = (empty($v[cls])) ? "txt" : $val[cls];
    if(!empty($val[need])){
      $cls[] = "need";
      $need = "<span class=\"need\">※必須</span>";
    }
    $cls = " class=\"".implode(" ",$cls)."\"";
    
    if(!empty($val[month])){
      echo "<tr><th>{$val[name]}$need</th>";
      echo "<td>\n";
      for($i=0;$i<$val[month];$i++){
        $m = date("n")+$i;
        $y = date("Y");
        echo $this->DispCalendar($y,$m,"edit");
      }
      #$this->OutputSelectMenuMain($key,$val);
      echo "</td></tr>\n";
    }
  }
  
  //カレンダーコア部分
  function DispCalendar($ymd=""){
    if(empty($ymd)){
      echo "<p class=\"caution\">年月が指定されていません</p>\n";
      return false;
    }
    //開始日のタイムスタンプ
    $s = strtotime($ymd);
    //日付リストを作る
    $data = array();
    for ($t = $s; date('m', $t) == date('m', $s); $t += 60*60*24) {
      $data[] = $t;
    }
    //先頭の日の曜日を見て前に余白を追加
    if (date('w', $data[0]) > 0) {
      $data = array_merge(array_fill(0, date('w', $data[0]), ''), $data);
    }
    //末尾の日の曜日を見て後ろに余白を追加
    if (date('w', end($data)) < 6) {
      $data = array_merge($data, array_fill(0, 6 - date('w', end($data)), ''));
    }
    //7で割る
    $data = array_chunk($data, 7);
    //以上でデータは出来上がった
    
    //引き続き保存されているデータを取得
    #$t1 = strtotime('2018-01-31 00:00:00');
    $enddate = date("Y-m-d",strtotime('+1 month', strtotime($ymd)));

    $sql = "SELECT date FROM closing WHERE date>='$ymd' AND date<'$enddate'";
    $r = $this->GetResult($sql);
    if($r){
      $r = $this->DecodeData($r,"date");
    }
    
    $today = time()+(86400*$_GET["leadtime"]);
    $str .= '<div class="calbox">';
    $str .= "<h2>".date('Y年m月', $s)."</h2>";
    $str .= '<div class="cal">';
    
    $dateFlg = FALSE;
    foreach ($data as $week) {
        $str .= '<div class="week">';
        //週の中の日のループ
        $i = 0;
        foreach ($week as $date) {
            #$target = date('Y-m', $s)."-".date('d', $date);
            $cls = [];
            if($i==0){
              $cls[] = "sun";
              $cls[] = "closing";
            }elseif($i==6){
              $cls[] = "sat";
              $cls[] = "closing";
            }
            
            if ($date) {
              $hol = date("Y-m-d",$date);
              #echo $hol;
              $this->datetime = new HolidayDateTime($hol);
              $hol = $this->datetime->holiday($hol);
              if(!empty($hol)){
                $cls[] = "hol";
              }
              $_date = date('Y-m-d', $date);
              if(!empty($r[$_date])){
                $cls[] = "closing";
              }
              
              if($date < $today){
                $cls[] = "past";
              }elseif(in_array("closing", $cls) && empty($dateFlg)){
	              $cls[] = "out";
              }else{
	              $dateFlg = TRUE;
              }
              
              $cls = implode(" ", $cls);
              $str .= '<dl class="'.$cls.'" data-date="'.$_date.'"><dt>' . date('j', $date) .'</dt>';
              $str .= '<dd>';
              #$str .= $game;
              $str .= '</dd></dl>';
            } else {
        	    $str .= '<dl class="sp"><dt>&nbsp;</dt><dd></dd></dl>';
            }
            $i++;
        }
        $str .= '</div>';
    }
    $str .= '</div>';
    $str .= '</div>';
    
    return $str;
    
  }

  
}