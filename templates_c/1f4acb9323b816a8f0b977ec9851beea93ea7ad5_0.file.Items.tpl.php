<?php
/* Smarty version 3.1.44, created on 2022-11-21 09:28:58
  from '/home/d-connect/www/scm-kddi/templates/Admin/Insert/Items.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_637ac64a61e676_94702993',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1f4acb9323b816a8f0b977ec9851beea93ea7ad5' => 
    array (
      0 => '/home/d-connect/www/scm-kddi/templates/Admin/Insert/Items.tpl',
      1 => 1668990054,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_637ac64a61e676_94702993 (Smarty_Internal_Template $_smarty_tpl) {
if (!empty($_smarty_tpl->tpl_vars['r']->value)) {?>
  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['r']->value, 'v', false, 'k');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
<div class="items">
  <div class="img"><img src="<?php echo _IMG_;
if (!empty($_smarty_tpl->tpl_vars['v']->value["img"])) {
echo $_smarty_tpl->tpl_vars['v']->value["img"];
} else { ?>nowprinting.jpg<?php }?>"></div>
  <div class="name"><?php echo $_smarty_tpl->tpl_vars['v']->value["title"];?>
</div>

<?php if (is_array($_smarty_tpl->tpl_vars['v']->value["items"])) {?>
  <div class="ttl">SET</div>
  <div class="title"><?php echo $_smarty_tpl->tpl_vars['v']->value["title"];?>
</div>
  <div class="demo type<?php echo $_smarty_tpl->tpl_vars['v']->value["demo"];?>
"><?php echo $_smarty_tpl->tpl_vars['form']->value["demo"]["item"][$_smarty_tpl->tpl_vars['v']->value["demo"]];?>
</div>
  <input type="checkbox" name="sets[]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value["code"];?>
" class="hidden">
<?php } else { ?>
  <div class="ttl">単品商品</div>
  <div class="title"><?php echo $_smarty_tpl->tpl_vars['v']->value["name"];?>
</div>
  <div class="num">数量:<?php echo $_smarty_tpl->tpl_vars['v']->value["stock"];
echo $_smarty_tpl->tpl_vars['form']->value["unit"]["item"][$_smarty_tpl->tpl_vars['v']->value["unit"]];?>
</div>
  <div class="demo type<?php echo $_smarty_tpl->tpl_vars['v']->value["demo"];?>
"><?php echo $_smarty_tpl->tpl_vars['form']->value["demo"]["item"][$_smarty_tpl->tpl_vars['v']->value["demo"]];?>
</div>
  <input type="checkbox" name="items[]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value["code"];?>
" class="hidden">
<?php }?>
  <div class="comment"><?php echo $_smarty_tpl->tpl_vars['v']->value["comment"];?>
</div>
</div>
  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
}
