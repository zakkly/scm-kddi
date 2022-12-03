<?php
/* Smarty version 3.1.44, created on 2022-11-21 09:28:51
  from '/home/d-connect/www/scm-kddi/templates/Admin/Insert/Order.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_637ac643ce02e9_03238388',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '22407a9821f842b5e8b6fb8b923b3703419c509b' => 
    array (
      0 => '/home/d-connect/www/scm-kddi/templates/Admin/Insert/Order.tpl',
      1 => 1668990054,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_637ac643ce02e9_03238388 (Smarty_Internal_Template $_smarty_tpl) {
?>
<tr data-code="<?php echo $_POST['d']['code'];?>
" data-toggle="modal" data-target="#groupEditFormModal" class="modalOpen">
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['OrderView']->value, 'v', false, 'k');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
  <?php if ($_smarty_tpl->tpl_vars['k']->value == "status") {?>
    <td><span class="status status<?php echo $_POST['d']['status_type'];?>
"><?php echo $_POST['d'][$_smarty_tpl->tpl_vars['k']->value];?>
</span></td></td>
  <?php } elseif (!empty($_smarty_tpl->tpl_vars['v']->value["targetKey"])) {?>
    <?php $_smarty_tpl->_assignInScope('val', $_smarty_tpl->tpl_vars['v']->value["targetKey"]);?>
    <td><?php echo $_POST['d'][$_smarty_tpl->tpl_vars['val']->value];?>
</td>
  <?php } else { ?>
    <td><?php echo $_POST['d'][$_smarty_tpl->tpl_vars['k']->value];?>
</td>
  <?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</tr><?php }
}
