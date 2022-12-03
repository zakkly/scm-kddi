<?php
/* Smarty version 3.1.44, created on 2022-02-14 22:12:59
  from '/Users/doi/Dropbox/Sites/scm-kddi/templates/Admin/Insert/Adress.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_620a555bbc3988_81770575',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a69702c790d58102571c19628ea8fcefd49df0b2' => 
    array (
      0 => '/Users/doi/Dropbox/Sites/scm-kddi/templates/Admin/Insert/Adress.tpl',
      1 => 1644844149,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_620a555bbc3988_81770575 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="widget-table action-table">
  <table class="table table-striped table-bordered ">
    <thead>
      <tr>
  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['AdressForm']->value, 'v', false, 'k');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
      <?php if ($_smarty_tpl->tpl_vars['v']->value["view"] == 1) {?>
        <th><?php echo $_smarty_tpl->tpl_vars['v']->value["name"];?>
</th>
      <?php }?>
  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        <th></th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>
  <div class="login-actions submit">
	<button class="button btn btn-danger btn-large back">戻る</button>
		<button class="button btn btn-primary btn-large">次へ</button>
  </div>
</div>


<?php echo '<script'; ?>
>
var templ = "TableAddress";
var ResultTarget = "table tbody";
//console.log(ResultTarget);

if($("form[name=OrderInsert]").size()){
  var add = [];
  var adress = $("form[name=OrderInsert]").find("input[name='GroupIdList[]']").val();
  if(!adress){
    var adress = $("form[name=OrderInsert]").find("input[name='GroupIdList']").val();
  }
  if(adress.match(/,/)){
    add = adress.split(",");
  }else{
    add.push(adress);
  }
  
  var urls = location.href;
  var obj = {};
  obj["mode"] = "Adress";
  obj["Company"] = [];
  if(add.length){
    $(add).each(function(i){
      obj["Company"].push(add[i]);
    });
  }
  console.log(urls);
  console.log(obj);
  $.ajax(urls,{
    type: 'post',
    data: obj,
    dataType: 'json'
  })
  .done(function(d){
    //console.log(d);
    $(d).each(function(i){
      f = BaseUrls+"/static/Order/Order.php";
      var obj = {};
      obj["templ"] = "TableAddress";
      obj["d"] = d[i];
      $.ajax(f,{
        type: 'post',
        data: obj,
        dataType: 'html'
      })
      .done(function(d){
        //console.log(d);
        $(ResultTarget).append(d);
      })
      .fail(function(d){
        console.log(d);
      })
      .always(function(d){
        //console.log(d);
      })
    });
  });
}

  
  
<?php echo '</script'; ?>
>
<?php }
}
