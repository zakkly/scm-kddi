<?php
/* Smarty version 3.1.44, created on 2022-11-21 09:31:42
  from '/home/d-connect/www/scm-kddi/templates/Goods/ItemRegister.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_637ac6eea132e8_18236066',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '561d24cbecf33d446f52d568375114de456d703e' => 
    array (
      0 => '/home/d-connect/www/scm-kddi/templates/Goods/ItemRegister.tpl',
      1 => 1668990055,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:head.tpl' => 1,
    'file:header.tpl' => 1,
    'file:nav.tpl' => 1,
    'file:footer.tpl' => 1,
    'file:foot.tpl' => 1,
  ),
),false)) {
function content_637ac6eea132e8_18236066 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/d-connect/www/scm-kddi/vendor/smarty/smarty/libs/plugins/function.FormModeSwitch.php','function'=>'smarty_function_FormModeSwitch',),));
$_smarty_tpl->_subTemplateRender("file:head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:nav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div id="body">
  <div class="inner">
    <header>
      <h2><i class="fa fa-gift"></i><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</h2>
    </header>
    <div id="SectionBody">
      <form class="register dropzone" action="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" method="post" enctype="multipart/form-data">
        <div class="form-body">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['form']->value, 'v', false, 'k');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
          <?php $_smarty_tpl->_assignInScope('params', array($_smarty_tpl->tpl_vars['k']->value,$_smarty_tpl->tpl_vars['v']->value));?>
          <?php echo smarty_function_FormModeSwitch(array('v'=>$_smarty_tpl->tpl_vars['v']->value,'k'=>$_smarty_tpl->tpl_vars['k']->value,'d'=>$_smarty_tpl->tpl_vars['post']->value[0]),$_smarty_tpl);?>

        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </div>
  			<div class="login-actions submit">
  				<button class="button btn btn-primary btn-large">保存する</button>
  			</div> <!-- .actions -->
        <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>
">
        <input type="hidden" name="action" value="<?php echo $_smarty_tpl->tpl_vars['actionVal']->value;?>
">
        <input type="hidden" name="user" value="<?php echo $_SESSION['user'];?>
">
        <input type="hidden" name="mode" value="<?php if (!empty($_smarty_tpl->tpl_vars['post']->value[0]["code"])) {?>edit<?php }?>">
      </form>
    </div>
  </div>
</div>


<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)) {?>
<fieldset id="EditValue">
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_POST, 'v', false, 'k');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
  <?php if (!is_array($_smarty_tpl->tpl_vars['v']->value)) {?>
    <input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
">
  <?php } elseif ($_smarty_tpl->tpl_vars['k']->value == "items") {?>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['v']->value, 'val', false, 'key');
$_smarty_tpl->tpl_vars['val']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->do_else = false;
?>
      <?php if (!empty($_smarty_tpl->tpl_vars['val']->value["name"])) {?>
      <fieldset class="items">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['val']->value, 'vals', false, 'keys');
$_smarty_tpl->tpl_vars['vals']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['keys']->value => $_smarty_tpl->tpl_vars['vals']->value) {
$_smarty_tpl->tpl_vars['vals']->do_else = false;
?>
          <input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['keys']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['vals']->value;?>
">
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
      </fieldset>
      <?php }?>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
  <?php } else { ?>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['v']->value, 'val', false, 'key');
$_smarty_tpl->tpl_vars['val']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->do_else = false;
?>
    <input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['val']->value;?>
" data-key="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" />
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
  <?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</fieldset>
<?php }?>

<?php echo '<script'; ?>
>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['post']->value[0], 'v', false, 'k');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
  <?php if (in_array($_smarty_tpl->tpl_vars['k']->value,array("category","GroupIdList","sub_category","category_code","GroupIdList_code","sub_category_code"))) {?>
    var <?php echo $_smarty_tpl->tpl_vars['k']->value;?>
 = ['<?php echo implode("','",$_smarty_tpl->tpl_vars['v']->value);?>
'];
  <?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo _BASE_URL_;?>
/js/ItemRegister.js"><?php echo '</script'; ?>
>
<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}