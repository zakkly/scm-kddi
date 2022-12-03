<?php
/* Smarty version 3.1.44, created on 2022-02-15 01:12:39
  from '/Users/doi/Dropbox/Sites/scm-kddi/templates/Admin/Insert/OtherDetail.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_620a7f7793aae5_67651886',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fc53979fc55eb90f85004fbe5550527accaae8c5' => 
    array (
      0 => '/Users/doi/Dropbox/Sites/scm-kddi/templates/Admin/Insert/OtherDetail.tpl',
      1 => 1644844187,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_620a7f7793aae5_67651886 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/Users/doi/Dropbox/Sites/scm-kddi/vendor/smarty/smarty/libs/plugins/function.FormModeSwitch.php','function'=>'smarty_function_FormModeSwitch',),));
?>

  <!-- 
  <?php echo print_r($_smarty_tpl->tpl_vars['r']->value);?>

  -->
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['r']->value["adress"], 'vs', false, 'ks');
$_smarty_tpl->tpl_vars['vs']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ks']->value => $_smarty_tpl->tpl_vars['vs']->value) {
$_smarty_tpl->tpl_vars['vs']->do_else = false;
?>
<div class="OtherDetail">
  <article>
    <header class="h">
      <h1><?php echo $_smarty_tpl->tpl_vars['vs']->value["destination"];?>
</h1>
    <ul>
      <li><?php echo $_smarty_tpl->tpl_vars['vs']->value["pref"];
echo $_smarty_tpl->tpl_vars['vs']->value["add1"];
echo $_smarty_tpl->tpl_vars['vs']->value["add2"];?>
</li>
      <!--li>リードタイム<?php echo $_smarty_tpl->tpl_vars['vs']->value["leadtime"];?>
日</li -->
    </ul>
    </header>
    <div class="body">
	    <input type="hidden" name="leadtime" value="<?php echo $_smarty_tpl->tpl_vars['vs']->value["leadtime"];?>
">
  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['OrderView']->value, 'v', false, 'k');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
    <?php if (!empty($_smarty_tpl->tpl_vars['v']->value["order"])) {?>
      <?php $_smarty_tpl->_assignInScope('key', ((string)$_smarty_tpl->tpl_vars['k']->value)."____".((string)$_smarty_tpl->tpl_vars['vs']->value['code']));?>
      <?php $_smarty_tpl->_assignInScope('params', array($_smarty_tpl->tpl_vars['key']->value,$_smarty_tpl->tpl_vars['v']->value));?>
      <?php if ($_POST['demo'] == 1) {?>
        <?php if (empty($_smarty_tpl->tpl_vars['v']->value["demo"])) {?>
        <?php echo smarty_function_FormModeSwitch(array('v'=>$_smarty_tpl->tpl_vars['v']->value,'k'=>$_smarty_tpl->tpl_vars['key']->value),$_smarty_tpl);?>

        <?php }?>
      <?php } else { ?>
        <?php echo smarty_function_FormModeSwitch(array('v'=>$_smarty_tpl->tpl_vars['v']->value,'k'=>$_smarty_tpl->tpl_vars['key']->value),$_smarty_tpl);?>

      <?php }?>
    <?php }?>
  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>
  </article>
</div>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
