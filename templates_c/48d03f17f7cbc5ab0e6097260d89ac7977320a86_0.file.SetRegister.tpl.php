<?php
/* Smarty version 3.1.44, created on 2022-11-21 10:09:52
  from '/home/d-connect/www/scm-kddi/templates/Goods/SetRegister.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_637acfe0ead2a2_98132557',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '48d03f17f7cbc5ab0e6097260d89ac7977320a86' => 
    array (
      0 => '/home/d-connect/www/scm-kddi/templates/Goods/SetRegister.tpl',
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
function content_637acfe0ead2a2_98132557 (Smarty_Internal_Template $_smarty_tpl) {
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
          <?php echo smarty_function_FormModeSwitch(array('v'=>$_smarty_tpl->tpl_vars['v']->value,'k'=>$_smarty_tpl->tpl_vars['k']->value,'d'=>$_smarty_tpl->tpl_vars['data']->value[0]),$_smarty_tpl);?>

        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </div>
  			<div class="login-actions submit">
  				<p class="button btn btn-danger btn-large" data-toggle="modal" data-target="#groupEditFormModal">商品検索</p>
  			</div> <!-- .actions -->
  			<div id="ItemsSet">
    			
  			</div>
  			<div class="login-actions submit">
  				<button class="button btn btn-primary btn-large">登録する</button>
  			</div> <!-- .actions -->
        <input type="hidden" name="action" value="<?php echo $_smarty_tpl->tpl_vars['actionVal']->value;?>
">
        <input type="hidden" name="user" value="<?php echo $_SESSION['user'];?>
">
        <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>
">
      </form>
    </div>
  </div>
</div>


<div class="modal modal-info fade" id="groupEditFormModal" role="dialog">
  <div class="modal-dialog margin-md-top">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">商品検索</h4>
      </div>
    </div>
    <div class="modal-body">
      <fieldset id="search" class="search">
        <legend><i class="fa fa-search"></i>検索</legend>
        <form id="searchForm" class="clearfix">
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['searchForm']->value, 'v', false, 'k');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
            <?php $_smarty_tpl->_assignInScope('params', array($_smarty_tpl->tpl_vars['k']->value,$_smarty_tpl->tpl_vars['v']->value));?>
            <?php echo smarty_function_FormModeSwitch(array('v'=>$_smarty_tpl->tpl_vars['v']->value,'k'=>$_smarty_tpl->tpl_vars['k']->value,'prefix'=>"search"),$_smarty_tpl);?>

          <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          <input type="hidden" name="target" value="Items">
          <input type="hidden" name="action" value="Goods/Index">
          <button type="submit" class="btn green filterSearchBtn"><i class="fa fa-search"></i>検索</button>
        </form>
      </fieldset>
        
      <div id="searchResult" class="ItemSearch">
      </div>
			<div class="login-actions submit">
				<button class="button btn btn-primary btn-large">登録する</button>
			</div>
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
      <?php if (!empty($_smarty_tpl->tpl_vars['val']->value[0]["name"])) {?>
      <fieldset class="items">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['val']->value[0], 'vals', false, 'keys');
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
 src="<?php echo _BASE_URL_;?>
/js/RegisterSetForm.js"><?php echo '</script'; ?>
>
<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
