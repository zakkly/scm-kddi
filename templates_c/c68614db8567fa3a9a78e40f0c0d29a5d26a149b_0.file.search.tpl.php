<?php
/* Smarty version 3.1.44, created on 2022-11-21 05:04:07
  from '/Users/doi/Dropbox/Sites/scm-kddi/templates/search.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_637a88376c99c0_05408598',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c68614db8567fa3a9a78e40f0c0d29a5d26a149b' => 
    array (
      0 => '/Users/doi/Dropbox/Sites/scm-kddi/templates/search.tpl',
      1 => 1668974570,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_637a88376c99c0_05408598 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/Users/doi/Dropbox/Sites/scm-kddi/vendor/smarty/smarty/libs/plugins/function.FormModeSwitch.php','function'=>'smarty_function_FormModeSwitch',),));
?>


<div class="widget-content">
  <fieldset id="search" class="search">
    <legend><i class="fa fa-search"></i>検索</legend>
    <form id="searchForm" class="clearfix">
      <div class="SearchFiledBody">
      
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['itemForm']->value, 'v', false, 'k');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
  <?php if ($_smarty_tpl->tpl_vars['v']->value["search"] == 1) {
echo smarty_function_FormModeSwitch(array('v'=>$_smarty_tpl->tpl_vars['v']->value,'k'=>$_smarty_tpl->tpl_vars['k']->value,'prefix'=>"search"),$_smarty_tpl);?>

  <?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
      </div>
    <input type="hidden" name="target" value="<?php echo $_smarty_tpl->tpl_vars['target']->value;?>
">
    <input type="hidden" name="action" value="<?php echo $_smarty_tpl->tpl_vars['actionVal']->value;?>
">
    <button type="submit" class="btn green filterSearchBtn"><i class="fa fa-search"></i>検索</button>
    </form>
  </fieldset>
</div>
              


<div class="num_rows">
  <select name="num_rows">
    <option value="10">10</option>
    <option value="25">25</option>
    <option value="50">50</option>
    <option value="100">100</option>
    <option value="500">500</option>
    <option value="1000">1000</option>
  </select>件表示
</div><?php }
}
