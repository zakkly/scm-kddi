<?php
/* Smarty version 3.1.44, created on 2022-11-21 09:28:55
  from '/home/d-connect/www/scm-kddi/templates/Admin/Insert/Goods.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_637ac647c2e231_79895828',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e3094dedd6df6e18abf23cbdf59a09996e758e25' => 
    array (
      0 => '/home/d-connect/www/scm-kddi/templates/Admin/Insert/Goods.tpl',
      1 => 1668990054,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_637ac647c2e231_79895828 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/d-connect/www/scm-kddi/vendor/smarty/smarty/libs/plugins/function.FormModeSwitch.php','function'=>'smarty_function_FormModeSwitch',),));
?>
  <ul class="tab">
    <li>商品検索</li>
    <li>セット商品検索</li>
  </ul>
  <div id="SearchSection">
    <section id="ItemSearch" class="search clearfix">
      <form name="ItemSearch" class="searchField item" action="#">
        <div class="SearchFiledBody">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['itemForm']->value, 'v', false, 'k');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
          <?php $_smarty_tpl->_assignInScope('params', array($_smarty_tpl->tpl_vars['k']->value,$_smarty_tpl->tpl_vars['v']->value));?>
          <?php if (!empty($_smarty_tpl->tpl_vars['v']->value["search"])) {?>
          <?php echo smarty_function_FormModeSwitch(array('v'=>$_smarty_tpl->tpl_vars['v']->value,'k'=>$_smarty_tpl->tpl_vars['k']->value,'prefix'=>"search"),$_smarty_tpl);?>

          <?php }?>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        <input type="hidden" name="table" value="items">
        <input type="hidden" name="action" value="Goods/Index">
        <input type="hidden" name="target" value="Items">
        <button type="submit" class="btn green filterSearchBtn"><i class="fa fa-search"></i>検索</button>
        </div>
      </form>
    </section>
    <section id="SetSearch" class="search clearfix">
      <form name="SetSearch" class="searchField set" action="#">
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
        <input type="hidden" name="set" value="set">
        <input type="hidden" name="table" value="items">
        <input type="hidden" name="target" value="Sets">
        <input type="hidden" name="action" value="Goods/ItemSet">
        <button type="submit" class="btn green filterSearchBtn"><i class="fa fa-search"></i>検索</button>
      </form>
    </section>
    
        
    <div class="num_rows">
      <select name="num_rows">
        <option value="10">10</option>
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="100">100</option>
        <option value="500">500</option>
        <option value="1000">1000</option>
      </select>件表示
    </div>
  </div>
  
  <div class="tabForm">
    <div class="SetType">
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['form']->value, 'v', false, 'k');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
      <?php $_smarty_tpl->_assignInScope('params', array($_smarty_tpl->tpl_vars['k']->value,$_smarty_tpl->tpl_vars['v']->value));?>
      <?php if ($_SESSION['role'] != "admin" && $_smarty_tpl->tpl_vars['k']->value == "GroupIdList") {?>
      <input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" value="<?php echo $_SESSION['role'];?>
">
      <?php } else { ?>
      <?php echo smarty_function_FormModeSwitch(array('v'=>$_smarty_tpl->tpl_vars['v']->value,'k'=>$_smarty_tpl->tpl_vars['k']->value),$_smarty_tpl);?>

      <?php }?>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>
    <input type="hidden" name="user" value="<?php echo $_SESSION['user'];?>
">
    <input type="hidden" name="action" value="<?php echo $_SESSION['token'];?>
">
    <input type="hidden" name="mode" value="order">
    <div id="SearchResult"></div>
    <div class="login-actions submit">
			<button class="button btn btn-primary btn-large">次へ</button>
    </div>
  </div>

<?php echo '<script'; ?>
>
$(function(){
  NowTabPos=0;
  //初期設定は最初のタブを表示
  $("ul.tab li").eq(0).addClass("on");
  $("#SearchSection .search").eq(0).addClass("on");
  
  if(typeof GroupId != "undefined"){
    $("select[name=search_GroupIdList]").val(GroupId);
    $("select[name=search_GroupIdList]").prop("disabled",true);
  }
});
  var templ = "Items";
  var ResultTarget = "#SearchResult";
<?php echo '</script'; ?>
><?php }
}
