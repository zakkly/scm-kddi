<?php
/* Smarty version 3.1.44, created on 2022-11-21 02:24:57
  from '/Users/doi/Dropbox/Sites/scm-kddi/templates/Goods/Index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_637a62e99dc753_96895261',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4d200ed069ba340dcfa9e5d0d81ec3b43990224c' => 
    array (
      0 => '/Users/doi/Dropbox/Sites/scm-kddi/templates/Goods/Index.tpl',
      1 => 1668965088,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:head.tpl' => 1,
    'file:header.tpl' => 1,
    'file:nav.tpl' => 1,
    'file:search.tpl' => 1,
    'file:foot.tpl' => 1,
  ),
),false)) {
function content_637a62e99dc753_96895261 (Smarty_Internal_Template $_smarty_tpl) {
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
<?php $_smarty_tpl->_subTemplateRender("file:search.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
      <table id="SearchResult">
        <thead>
          <tr>
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['itemForm']->value, 'v', false, 'k');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
        <th><?php echo $_smarty_tpl->tpl_vars['v']->value["name"];?>
</th>
      <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
      
      <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>
">
    </div>
  </div>
</div>

<?php echo '<script'; ?>
>
  var InsertSetUrls = '<?php echo _BASE_URL_;?>
/Goods/ItemRegister';
  var templ = "ItemTable";
  var ResultTarget = "table tbody";
  var nowPos;
<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="<?php echo _BASE_URL_;?>
/js/Goods.Index.js"><?php echo '</script'; ?>
>

<?php $_smarty_tpl->_subTemplateRender("file:foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
