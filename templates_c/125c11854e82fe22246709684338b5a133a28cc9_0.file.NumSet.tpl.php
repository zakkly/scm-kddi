<?php
/* Smarty version 3.1.44, created on 2022-11-21 10:12:34
  from '/home/d-connect/www/scm-kddi/templates/Admin/Insert/NumSet.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_637ad0824c3121_55906498',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '125c11854e82fe22246709684338b5a133a28cc9' => 
    array (
      0 => '/home/d-connect/www/scm-kddi/templates/Admin/Insert/NumSet.tpl',
      1 => 1668990054,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_637ad0824c3121_55906498 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="NumhResult">
</div>
<div class="login-actions submit">
	<button class="button btn btn-danger btn-large back">戻る</button>
	<button class="button btn btn-primary btn-large">次へ</button>
</div>

<?php echo '<script'; ?>
>
var ResultTarget = "#NumhResult";
console.log(ResultTarget);
$(function(){
  var form = $("form[name=OrderInsert]");
  var obj = {};
  var urls_item = [];
  var urls_sets = [];
  $(form).find("input").each(function(){
    var name = $(this).attr("name");
    if(name.match(/\[\]/)){
      name = name.split("[]");
      name = name[0];
      if(!obj[name]){
        obj[name] = [];
      }
      obj[name].push($(this).val());
    }
    //console.log(name);
  });
  console.log(obj);
  
  f = BaseUrls+"/static/Order/Order.php";
  //console.log(f);
  obj["templ"] = "NumsetDetail";
  obj["mode"] = "NumsetDetail";
  $.ajax(f,{
    type: 'post',
    data: obj,
    dataType: 'html'
  })
  .done(function(d){
    //console.log(d);
    $(ResultTarget).append(d);
  });
});

<?php echo '</script'; ?>
>
<?php }
}
