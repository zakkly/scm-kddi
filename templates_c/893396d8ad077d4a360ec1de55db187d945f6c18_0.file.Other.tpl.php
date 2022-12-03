<?php
/* Smarty version 3.1.44, created on 2022-02-15 01:12:39
  from '/Users/doi/Dropbox/Sites/scm-kddi/templates/Admin/Insert/Other.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_620a7f775e5a54_94447267',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '893396d8ad077d4a360ec1de55db187d945f6c18' => 
    array (
      0 => '/Users/doi/Dropbox/Sites/scm-kddi/templates/Admin/Insert/Other.tpl',
      1 => 1644844187,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_620a7f775e5a54_94447267 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="Other">
</div>

<div class="login-actions submit">
	<button class="button btn btn-danger btn-large back">戻る</button>
	<button class="button btn btn-primary btn-large">発注する</button>
</div>

<?php echo '<script'; ?>
>
var ResultTarget = "#Other";
$(function(){
  var form = $("form[name=OrderInsert]");
  var obj = {};
  $(form).find("input").each(function(){
    var name = $(this).attr("name");
    if(name.match(/\[\]/)){
      name = name.split("[]");
      name = name[0];
      if(!obj[name]){
        obj[name] = [];
      }
      obj[name].push($(this).val());
    }else if(name=="demo"){
      obj[name] = ($(this).val());
    }
    //console.log(name);
  });
  console.log(obj);
  
  f = BaseUrls+"/static/Order/Order.php";
  obj["templ"] = "OtherDetail";
  obj["mode"] = "OtherDetail";
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
><?php }
}
