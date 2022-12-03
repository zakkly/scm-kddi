<?php
/* Smarty version 3.1.44, created on 2022-04-17 23:02:57
  from '/Users/doi/Dropbox/Sites/scm-kddi/templates/Settings/Holiday.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_625c1e11a9e3e0_16944120',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b0d759fc8d6d89d3026c1cb0cc86c1fb1346581f' => 
    array (
      0 => '/Users/doi/Dropbox/Sites/scm-kddi/templates/Settings/Holiday.tpl',
      1 => 1650204176,
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
function content_625c1e11a9e3e0_16944120 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
if ($_SESSION['role'] != "admin") {?>
表示権限がありません
<?php } else {
$_smarty_tpl->_subTemplateRender("file:nav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div id="body">
  <div class="inner">
    <header>
      <h2><i class="fa fa-heart"></i><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</h2>
    </header>
    <div class="widget-content">
      <div class="calOut">
        <?php echo $_smarty_tpl->tpl_vars['cal']->value;?>

      </div>
    </div>
  </div>
</div>
<?php echo '<script'; ?>
 src="<?php echo _BASE_URL_;?>
/js/Holiday.js"><?php echo '</script'; ?>
>
<?php }
$_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
