<?php
/* Smarty version 3.1.44, created on 2022-02-14 14:13:03
  from '/Users/doi/Dropbox/Sites/scm-kddi/templates/Admin/Insert/Items.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_6209e4dfcc0194_08732717',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '227f0d6bf56337de245bd6e0a9596533fb1154bc' => 
    array (
      0 => '/Users/doi/Dropbox/Sites/scm-kddi/templates/Admin/Insert/Items.tpl',
      1 => 1644815502,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6209e4dfcc0194_08732717 (Smarty_Internal_Template $_smarty_tpl) {
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
