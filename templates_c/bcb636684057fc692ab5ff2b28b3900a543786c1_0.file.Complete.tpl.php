<?php
/* Smarty version 3.1.44, created on 2022-11-21 10:18:35
  from '/home/d-connect/www/scm-kddi/templates/Admin/Insert/Complete.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_637ad1ebbe1dc4_09661875',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bcb636684057fc692ab5ff2b28b3900a543786c1' => 
    array (
      0 => '/home/d-connect/www/scm-kddi/templates/Admin/Insert/Complete.tpl',
      1 => 1668990054,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_637ad1ebbe1dc4_09661875 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="comfirm">
  <i class="fa fa-shopping-cart"></i>
  <p>発注が完了しました</p>
	<button class="button btn btn-danger btn-large back" style="display: block;">戻る</button>
</div>
<?php echo '<script'; ?>
>
$(function(){
  DummyLoadingSet();
  var urls = location.href;
  var obj = {};
  obj["mode"] = "order";
  console.log(obj);
  
  //まず送付先だけ
  $("form[name=OrderInsert] input").each(function(){
    var name = $(this).attr("name");
    //console.log(name);
    if(name.match(/\[\]/)){
      name = name.split("[]");
      name = name[0];
      if(name == "adress"){
        if(!obj[name]){
          obj[name] = [];
        }
        obj[name].push($(this).val());
      }
    }
  });
  console.log(obj);
  
  
  obj["action"] = "/Order/Insert";
  var post = {};
  $(obj["adress"]).each(function(i){
    var add = obj["adress"][i];
    //メインキーを送付先住所にする
    post[add] = {};
    post[add]["adress"] = add;
    //再びループ
    
    $("form[name=OrderInsert] input").each(function(){
      var name = $(this).attr("name");
      if(name.match(/\[\]/)){
        name = name.split("[]");
        name = name[0];
        if(name == "adress"){
          return true;
        }
        if(!post[add][name]){
          post[add][name] = [];
        }
        post[add][name].push($(this).val());
      }else if(name.match(/____(.+?)____/)){
        var _name = name.split("____");  //key,itemcode,adress,item0Rsetの順
        var __tag = _name[0]+"____"+_name[1]+"____"+_name[3];
        post[_name[2]][__tag] = $(this).val();
      }else if(name.match(/____/)){
        var _name = name.split("____");  //key,adressの順
        if(!post[_name[1]]){
          post[_name[1]] = [];
        }
        post[_name[1]][_name[0]] = $(this).val();
      }else{
        post[add][name] = $(this).val();
      }
    });
    
  });
  //console.log(post);
  for(let key in post) {
    console.log(post[key]);
    
    if(!post[key]){
      return true;
    }
    post[key]["mode"] = "order";
    post[key]["action"] = "Order/Insert";
    //console.log(urls);
    //console.log(post[key]);
    $.ajax({
      url: urls,
      type: 'post',
      data:post[key],
      timeout:10000,
    })
    .done(function(d){
      console.log("success");
      console.log(d);
      var datas = {};
      datas["mode"] = "Complete";
      console.log(datas);
		  $.ajax({
		    url: urls,
		    type: 'post',
	      data:datas,
		    timeout:10000,
		  });
      $("#dummLoad").fadeOut("fast",function(){
        $("#dummLoad").remove();
      });
    })
    .fail(function(d){
      console.log("aaaa");
      console.log(d);
    })
    .always(function(d){
      console.log("always");
      console.log(data);
      $("#dummLoad").fadeOut("fast",function(){
        $("#dummLoad").remove();
      });
      
    });
  }
  
  return false;

});
<?php echo '</script'; ?>
><?php }
}
