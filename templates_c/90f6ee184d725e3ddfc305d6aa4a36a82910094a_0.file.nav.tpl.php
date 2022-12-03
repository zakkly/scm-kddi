<?php
/* Smarty version 3.1.44, created on 2022-04-18 02:43:20
  from '/Users/doi/Dropbox/Sites/scm-kddi/templates/User/nav.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_625c51b8aa9a96_65483917',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '90f6ee184d725e3ddfc305d6aa4a36a82910094a' => 
    array (
      0 => '/Users/doi/Dropbox/Sites/scm-kddi/templates/User/nav.tpl',
      1 => 1650217376,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_625c51b8aa9a96_65483917 (Smarty_Internal_Template $_smarty_tpl) {
?>




<nav>
  <div class="inner">
    <ul class="mainnav">
<?php if (!empty($_smarty_tpl->tpl_vars['nav']->value)) {?>
  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['nav']->value, 'v', false, 'k');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
      <li class="nav <?php echo $_smarty_tpl->tpl_vars['k']->value;?>
">
        <?php if (!empty($_smarty_tpl->tpl_vars['v']->value["link"])) {?><a href="<?php echo _BASE_URL_;
echo $_smarty_tpl->tpl_vars['v']->value["link"];?>
"><?php }?><i class="fa <?php echo $_smarty_tpl->tpl_vars['v']->value["icon"];?>
"></i><?php echo $_smarty_tpl->tpl_vars['v']->value["name"];
if (!empty($_smarty_tpl->tpl_vars['v']->value["link"])) {?></a><?php }?>
        <?php if (!empty($_smarty_tpl->tpl_vars['v']->value["item"])) {?>
          <ul class="submenu">
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['v']->value["item"], 'vs', false, 'ks');
$_smarty_tpl->tpl_vars['vs']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ks']->value => $_smarty_tpl->tpl_vars['vs']->value) {
$_smarty_tpl->tpl_vars['vs']->do_else = false;
?>
            <li class="nav-item"><?php if (!empty($_smarty_tpl->tpl_vars['v']->value["link"])) {?><a href="<?php echo _BASE_URL_;
echo $_smarty_tpl->tpl_vars['vs']->value["link"];?>
"><?php }
echo $_smarty_tpl->tpl_vars['vs']->value["name"];
if (!empty($_smarty_tpl->tpl_vars['v']->value["link"])) {?></a><?php }?></li>
          <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          </ul>
        <?php }?>
      </li>
      
  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?>
    </ul>
  </div>
</nav>
<?php }
}
