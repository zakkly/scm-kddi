<?php
/* Smarty version 3.1.44, created on 2022-11-21 09:29:02
  from '/home/d-connect/www/scm-kddi/templates/Order/OrderDownload.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_637ac64edb1337_16986421',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd453195f2df55cc15c512200642f10fe15befb30' => 
    array (
      0 => '/home/d-connect/www/scm-kddi/templates/Order/OrderDownload.tpl',
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
function content_637ac64edb1337_16986421 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/d-connect/www/scm-kddi/vendor/smarty/smarty/libs/plugins/function.FormModeSwitch.php','function'=>'smarty_function_FormModeSwitch',),));
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
      <div id="SearchSection">
        <legend><i class="fa fa-search"></i>検索</legend>
        <fieldset id="search" class="search">
          <form name="Search" class="searchField item" action="#">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['SearchForm']->value, 'v', false, 'k');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
              <?php $_smarty_tpl->_assignInScope('params', array($_smarty_tpl->tpl_vars['k']->value,$_smarty_tpl->tpl_vars['v']->value));?>
              <?php echo smarty_function_FormModeSwitch(array('v'=>$_smarty_tpl->tpl_vars['v']->value,'k'=>$_smarty_tpl->tpl_vars['k']->value,'prefix'=>"search",'d'=>$_POST),$_smarty_tpl);?>

            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <?php if (!empty($_POST['status']) || $_POST['status'] == 9) {?>
            <input type="hidden" name="statusChange" value="1">
            <?php }?>
            <input type="hidden" name="target" value="Order">
            <input type="hidden" name="action" value="Order/OrderDownload">
            <div style="clear: both; text-align: center;">
              <button type="submit" class="btn green filterSearchBtn"><i class="fa fa-search"></i>検索</button>
            </div>
          </form>
        </fieldset>
        <div class="num_rows">
          <select name="num_rows">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="500">500</option>
            <option value="1000">1000</option>
          </select>件表示
          
          <span class="btn btn-warning" id="MasterDownLoad">受注マスタCSVダウンロード</span>
        </div>
      </div>
      <div class="widget-table action-table scroll-table">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['OrderView']->value, 'v', false, 'k');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
            <?php if ($_smarty_tpl->tpl_vars['v']->value["view"] == 1) {?>
              <th class="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value["name"];?>
</th>
            <?php }?>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              <th></th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>


  </div>
</div>


<div class="modal modal-info fade" id="groupEditFormModal" role="dialog">
  <div class="modal-dialog margin-md-top">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">受注情報を編集する</h4>
      </div>
    </div>
    <div class="modal-body">
      <form class="register" action="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" method="post">
        <div class="form-body">
        </div>
      </form>
    </div>
  </div>
</div>

<?php echo '<script'; ?>
>
  var ResultTarget = "table tbody";
  var templ = "Order";
<?php echo '</script'; ?>
>
<style>
#search{
display: none;
}
</style>
<?php $_smarty_tpl->_assignInScope('t', time());
echo '<script'; ?>
 src="<?php echo _BASE_URL_;?>
/js/OrderManagement.js?<?php echo $_smarty_tpl->tpl_vars['t']->value;?>
"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="<?php echo _BASE_URL_;?>
/css/OrderManagement.css?<?php echo $_smarty_tpl->tpl_vars['t']->value;?>
">
<?php }
$_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
