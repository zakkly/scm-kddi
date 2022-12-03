<?php

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.FormModeSwitch.php
 * Type:     function
 * Name:     FormModeSwitch
 * Purpose:  ランダムに回答を出力する
 * -------------------------------------------------------------
 */
 
use Manage\manage;
$mng = new manage;
function smarty_function_FormModeSwitch($params, &$smarty){
 global $mng;
 #var_dump($params["v"]);
 #var_dump($params["v"]);
 $str = "";
 if(!empty($params["v"]["need"])){
   $required = ' required="required"';
 }
 if(!empty($params["prefix"])){
   $pre = $params["prefix"]."_";
   $required = '';
 }
 
 if(!empty($params["v"]["cls"])){
   if(is_array($params["v"]["cls"])){
     $params["v"]["cls"] = ' '.implode(" ", $params["v"]["cls"]).' ';
   }else{
     $params["v"]["cls"] = ' '.$params["v"]["cls"].' ';
   }
 }else{
   #$params["v"]["cls"] = "";
 }
 
 if($params["v"]["notview"]){
   return false;
 }
 if($params["v"]["disabled"]){
   $disabled = " disabled='disabled'";
 }
 
 switch($params["v"]["type"]){
   case "group":
     foreach($params["v"]["item"] as $k => $v){
       #$str .= $k;
       #print_r($v);
       $p["k"] = $k;
       $p["v"] = $v;
       $str .= renderedView($p);
     }
     break;
   case "discount_span":
     require(FCPATH."/Views/DisCountView.php");
     break;
   case "startend":
     require(FCPATH."/Views/StartEnd.php");
     break;
   
   case "image":
     $str .= '<div class="field '.$params["v"]["type"].$params["v"]["cls"].' '.$params["k"].'">'."\n";
     $str .= '  <label class="header_label" for="'.$params["k"].'">'.$params["v"]["name"].'</label>'."\n";
     $str .= '  <span class="form_parts_body">';
     if(!empty($params["d"][$params["k"]])){
       if(is_file(FCPATH."/../html/images/".$params["d"][$params["k"]])){
         $img = _IMG_.'/'.$params["d"][$params["k"]];
         $imgName = $params["d"][$params["k"]];
         $file_size = filesize(FCPATH."/../html/images/".$params["d"][$params["k"]]);
       }
     }
     $str .= <<<_HTML_
<div class="drag-and-drop-area drag-and-drop-area-out" data-img="{$imgName}" data-size="{$file_size}">
<span>
  <i class="fa fa-image"></i>
  画像をドラッグ&ドロップ
</span>
</div>

_HTML_;
     $str .= '  </span>';
     $str .= '</div> <!-- /field -->';
    break;

     
   case "rendered":
     $str .= renderedView($params);
     break;
     
   case "radio":
     if($params["v"]["disabled"]){
       $disabled = " disabled='disabled'";
     }
     $str .= '<div class="field '.$params["v"]["type"].$params["v"]["cls"].' '.$params["k"].'">'."\n";
     $str .= '  <label class="header_label" for="'.$params["k"].'">'.$params["v"]["name"].'</label>'."\n";
     $str .= '  <div class="radiobox form_parts_body">'."\n";
     if(!empty($params["v"]["item"])){
       foreach($params["v"]["item"] as $k => $v){
         $selected = ($k == $_POST[$params["k"]]) ? " checked='checked'" : "";
         $str .= '      <label class="radio"><input type="radio" name="'.$params["k"].'" value="'.$k.'"'.$selected.'>'.$v.''."</label>\n";
       }
     }
     $str .= '  </div> <!-- /field -->';
     $str .= '</div> <!-- /field -->';
     #print_r($_POST);
     break;

     
   case "icon":
     $params["v"]["item"] = file(FCPATH."fontawesome4.dat");
     
     $str .= '<div class="field form_'.$params["v"]["type"].$params["v"]["cls"].' '.$params["k"].'">'."\n";
     $str .= '  <label class="header_label" for="'.$params["k"].'">'.$params["v"]["name"].'</label>'."\n";
     $str .= '    <option value="">選択</option>'."\n";
     foreach($params["v"]["item"] as $k => $v){
       $v = str_replace("\n", "", $v);
       if(is_array($params["d"][$params["k"]])){
         $selected = (in_array($v, $params["d"][$params["k"]])) ? " selected" : "";
       }else{
         $selected = ($k == $params["d"][$params["k"]]) ? " selected" : "";
       }
       $str .= '    <label class="icon"><input type="radio" name="'.$params["k"].'" value="'.$v.'"'.$selected.'><i class="fa '.$v.'"></i></label>'."\n";
     }
     $str .= '</div> <!-- /field -->';
     break;
     
     
   case "select":
     if(empty($params["v"]["item"])){
       return false;
     }

     $str .= '<div class="field '.$params["v"]["type"].$params["v"]["cls"].' '.$params["k"].'">'."\n";
     $str .= '  <label class="header_label" for="'.$params["k"].'">'.$params["v"]["name"].'</label>'."\n";
     $str .= '  <span class="form_parts_body">';
     $str .= '  <select id="'.$pre.$params["k"].'" name="'.$pre.$params["k"].'"  class=""'.$required.'>'."\n";
     $str .= '    <option value="">選択</option>'."\n";
     
     if(!empty($params["v"]["item_type"])){
       switch($params["v"]["item_type"]){
         case "table":
         case "banaCategory":
           $item = ($params["v"]["item_type"] == "banaCategory") ? "banaCategory" : $params["v"]["item"];
           $sql = "select code,title from {$params['v']['item']} order by code";
           #echo $sql;
           //DB接続
           $data = $mng->GetResult($sql);
           //データ成形
           $data = $mng->DecodeData($data);
           
           foreach($data as $k => $v){
             $checked = ($v["code"] == $_POST[$key]) ? " selected='selected'" : "";
             $str .=  "  <option value=\"{$v['code']}\"$checked>{$v['title']}</option>\n";
           }
           break;
       }
     }elseif(!is_array($params["v"]["item"]) && preg_match("/\.\.\./",$params["v"]["item"])){
	      list($start,$end) = explode("...", $params["v"]["item"]);
	      while($start<=$end){
	        $checked = ($start == $params["d"][$params["k"]]) ? " selected" : "";
#		        $checked = ($start == $params["d"][$params["k"]]) ? " selected" : "";
	        $str .= "  <option value=\"$start\"{$checked}>$start</option>\n";
	        $start++;
	      }
	      if(!empty($val["over"])){
	        $str .= "  <option value=\"$start\">{$start}以上</option>\n";
	      }
     }else{
       
       if(empty($params["v"]["item"])){
         return false;
       }
       foreach($params["v"]["item"] as $k => $v){
         if(is_array($params["d"][$params["k"]])){
           $selected = (in_array($v, $params["d"][$params["k"]])) ? " selected='aselected'" : "";
         }elseif($params["k"] == "status"){
           $selected = ($k == $params["d"][$params["k"]]) ? " selected='selected'" : "";
         }else{
           $selected = ($k == $params["d"][$params["k"]]) ? " selected='selected'" : "";
         }
         $str .= '    <option value="'.$k.'"'.$selected.'>'.$v.'</option>'."\n";
       }
     }
     $str .= '  </select>'."\n";
     $str .= '</span> <!-- /field -->';
     $str .= '</div> <!-- /field -->';
     break;
    
   case "checkbox":
     $str .= '<div class="field form_'.$params["v"]["type"].$params["v"]["cls"].' '.$params["k"].'">'."\n";
     $str .= '  <label class="header_label" for="'.$params["k"].'">'.$params["v"]["name"].'</label>'."\n";
     $str .= '  <span class="form_parts_body">';
     if(!empty($params["v"]["item"])){
       foreach($params["v"]["item"] as $k => $v){
         if(is_array($params["d"][$params["k"]])){
           $checked = (in_array($v, $params["d"][$params["k"]])) ? " checked" : "";
         }else{
           $checked = ($k == $params["d"][$params["k"]]) ? " checked" : "";
         }
         $str .= "  <label><input type=\"".$params["v"]["type"]."\" name=\"{$params['k']}[]\" value=\"{$k}\"$checked>{$v}</label>\n";
       }
     }
     #print_r($params["d"][$params["k"]]);
     $str .= '</span> <!-- /field -->';
     $str .= '</div> <!-- /field -->';
     break;
    
   case "textarea":
     $str .= '<div class="field '.$params["v"]["type"].$params["v"]["cls"].' '.$params["k"].'">'."\n";
     $str .= '  <label class="header_label" for="'.$params["k"].'">'.$params["v"]["name"].'</label>'."\n";
     $str .= '  <span class="form_parts_body">';
     $str .= '  <textarea id="'.$pre.$params["k"].'" name="'.$pre.$params["k"].'" value="" placeholder="'.$params["v"]["name"].'" class="" />'.$params["d"][$params["k"]].'</textarea>'."\n";
     $str .= '</span> <!-- /field -->';
     $str .= '</div> <!-- /field -->';
     break;
     
   case "tel":
     $str .= '<div class="field '.$params["v"]["type"].$params["v"]["cls"].' '.$params["k"].'">'."\n";
     $str .= '  <label class="header_label" for="'.$params["k"].'">'.$params["v"]["name"].'</label>'."\n";
     $str .= '  <span class="form_parts_body">';
     $tel = [];
     for($i=0;$i<3;$i++){
       $tel[] = '<input type="text" name="tel'.($i+1).'" value="'.$params["d"][$params["k"]].'" class="tel">';
     }
     $str .= implode("ー", $tel);
     $str .= '</span> <!-- /field -->';
     $str .= '</div> <!-- /field -->';
     break;
     
   case "date":
     $str .= '<div class="field '.$params["v"]["type"].$params["v"]["cls"].' '.$params["k"].'">'."\n";
     $str .= '  <label class="header_label" for="'.$params["k"].'">'.$params["v"]["name"].'</label>'."\n";
     $str .= '  <span class="form_parts_body">';
     #$str .= '  <input type="text" id="'.$pre.$params["k"].'" name="'.$pre.$params["k"].'" value="'.$params["d"][$params["k"]].'" placeholder="'.$params["v"]["name"].'" class="date login"'.$required.$disabled.$keyup.' />'."\n";
     $str .= '  <input type="date" name="'.$params["k"].'" value="'.$params["d"][$params["k"]].'">';
     $str .= '</span> <!-- /field -->';
     $str .= '</div> <!-- /field -->';
     break;
   
   case "text":
   case "number":
   case "time":
   
     #print_r($params["d"]);
     #print_r($params["v"]);
     if($params["d"]["mode"] == "edit" && $params["v"]["edit"] == "disabled"){
       $disabled = " disabled='disabled'";
     }
     $keyup = ($params["v"]["onKeyUp"]) ? ' onKeyUp="'.$params["v"]["onKeyUp"].'"' : "";
     $str .= '<div class="field '.$params["v"]["type"].$params["v"]["cls"].' '.$params["k"].'">'."\n";
     switch($params["v"]["textType"]){
       case "num":
          $type = "number";
          break;
       case "time":
          $type = "time";
           break;
        default:
          $type = "text";
     }
     #print_r($params["d"][$k]);
     $str .= '  <label class="header_label" for="'.$params["k"].'">'.$params["v"]["name"].'</label>'."\n";
     $str .= '  <span class="form_parts_body">';
     $str .= '  <input type="'.$type.'" id="'.$pre.$params["k"].'" name="'.$pre.$params["k"].'" value="'.$params["d"][$params["k"]].'" placeholder="'.$params["v"]["name"].'" class=""'.$required.$disabled.$keyup.' />'.$params["v"]["ext"]."\n";
     $str .= '</span> <!-- /field -->';
     $str .= '</div> <!-- /field -->';
     break;
   
   case "password":
     $str .= '<div class="field '.$params["v"]["type"].$params["v"]["cls"].' '.$params["k"].'">'."\n";
     $str .= '  <label class="header_label" for="'.$params["k"].'">'.$params["v"]["name"].'</label>'."\n";
     $str .= '  <span class="form_parts_body">';
     $str .= '  <input type="password" id="'.$pre.$params["k"].'" name="'.$pre.$params["k"].'" value="'.$val.'" placeholder="'.$params["v"]["name"].'" class=""'.$required.' />'."\n";
     $str .= '</span> <!-- /field -->';
     $str .= '</div> <!-- /field -->';
     break;
   
   case "hidden":
     if(!empty($params["v"]["value"])){
       list($key,$val) = explode(":",$params["v"]["value"]);
       #echo $key;
       #$val = $smarty.session.token;
       $val = $_SESSION[$val];
     }elseif($params["v"]["val"] == "uniq"){
       $val = uniqid(rand().'-');
     }elseif(!empty($params["d"][$params["k"]])){
       $val = $params["d"][$params["k"]];
       #echo $val;
       #print_r($params["d"]);
     }elseif($_POST[$params["k"]]){
       $val = $_POST[$params["k"]];
     }
     #print_r($params);
     #echo $key;
     $str .= '  <input type="hidden" id="'.$pre.$params["k"].'" name="'.$pre.$params["k"].'" value="'.$val.'" placeholder="'.$params["v"]["name"].'" class="login"'.$required.' />'."\n";
 }
 
 return $str;
}

function renderedView($params){
   global $mng;
   if($params["v"]["disabled"]){
     $disabled = " disabled='disabled'";
   }
   $str .= '<div class="field '.$params["v"]["type"].$params["v"]["cls"].' '.$params["k"].'">'."\n";
   $str .= '  <label class="header_label" for="'.$params["k"].'">'.$params["v"]["name"].'</label>'."\n";
   $str .= '  <span class="form_parts_body">';
   $str .= '  <select id="'.$pre.$params["k"].'" name="'.$pre.$params["k"].'[]"  class="login rendered"'.$required.' multiple="multiple"'.$disabled.'>'."\n";
   if(!empty($params["v"]["item"])){
     foreach($params["v"]["item"] as $k => $v){
       if(is_array($params["d"][$params["k"]])){
         $selected = (in_array($v, $params["d"][$params["k"]])) ? " selected" : "";
       }
       $str .= '    <option value="'.$k.'"'.$selected.'>'.$v.'</option>'."\n";
     }
   }
   $str .= '  </select>'."\n";
   $str .= '  </span>';
   
   if(!empty($params["v"]["group"]) && is_array($params["v"]["group"])){
     foreach($params["v"]["group"] as $k => $v){
       $p = [
         "k" => $k,
         "v" => $v,
       ];
       $str .= renderedView($p);
     }
   }
   
   $str .= '</div> <!-- /field -->';
   
   return $str;
  
}