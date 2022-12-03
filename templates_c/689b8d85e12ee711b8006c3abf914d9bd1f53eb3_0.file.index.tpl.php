<?php
/* Smarty version 3.1.44, created on 2022-11-21 09:28:22
  from '/home/d-connect/www/scm-kddi/templates/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_637ac626798a20_67433561',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '689b8d85e12ee711b8006c3abf914d9bd1f53eb3' => 
    array (
      0 => '/home/d-connect/www/scm-kddi/templates/index.tpl',
      1 => 1668990055,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:head.tpl' => 1,
    'file:header.tpl' => 1,
    'file:nav.tpl' => 1,
    'file:foot.tpl' => 1,
  ),
),false)) {
function content_637ac626798a20_67433561 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:nav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div id="body">
  <div class="inner">
    <header>
      <h2><i class="fa fa-heart"></i>ダッシュボード</h2>
    </header>

    <div class="widget ">
      <ul id="statusView">
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['status']->value, 'v', false, 'k');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
        <li><span><?php echo $_smarty_tpl->tpl_vars['v']->value;?>
</span><span class="num"><em>件</em></span></li>
      <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
      </ul>
    </div>
    <div class="widget ">
      <div class="widget-header"> 
        <h3><i class="fa fa-user-circle"></i>お知らせ</h3>
      </div>
      <div class="widget-content">
        <?php if (!empty($_smarty_tpl->tpl_vars['news']->value)) {?>
          <ul id="news">
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['news']->value, 'v', false, 'k');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
            <li><a href="javascript:void(0);" data-toggle="modal" data-target="#groupEditFormModal" data-code="<?php echo $_smarty_tpl->tpl_vars['v']->value["code"];?>
"><strong><?php echo $_smarty_tpl->tpl_vars['v']->value["date"];?>
</strong><span><?php echo $_smarty_tpl->tpl_vars['v']->value["title"];?>
</span><em><?php echo $_smarty_tpl->tpl_vars['v']->value["contents"];?>
</em></a></li>
          <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          </ul>
        <?php }?>
      </div>
    </div>
  </div>
</div>
<?php $_smarty_tpl->_subTemplateRender("file:foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
