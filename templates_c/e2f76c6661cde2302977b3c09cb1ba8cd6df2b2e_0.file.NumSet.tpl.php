<?php
/* Smarty version 3.1.44, created on 2022-02-14 22:24:09
  from '/Users/doi/Dropbox/Sites/scm-kddi/templates/Admin/Insert/NumSet.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_620a57f9ee20a5_93931215',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e2f76c6661cde2302977b3c09cb1ba8cd6df2b2e' => 
    array (
      0 => '/Users/doi/Dropbox/Sites/scm-kddi/templates/Admin/Insert/NumSet.tpl',
      1 => 1644844184,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_620a57f9ee20a5_93931215 (Smarty_Internal_Template $_smarty_tpl) {
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
