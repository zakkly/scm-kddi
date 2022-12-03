<?php
/* Smarty version 3.1.44, created on 2022-11-21 04:30:32
  from '/Users/doi/Dropbox/Sites/scm-kddi/templates/User/OrderHistory.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_637a8058441c30_49476021',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2375f79af161d93a580907cb533450b60a83afb9' => 
    array (
      0 => '/Users/doi/Dropbox/Sites/scm-kddi/templates/User/OrderHistory.tpl',
      1 => 1668972584,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:head.tpl' => 1,
    'file:header.tpl' => 1,
    'file:User/nav.tpl' => 1,
    'file:Search.tpl' => 1,
    'file:foot.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_637a8058441c30_49476021 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:User/nav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<div id="body">
  <div class="inner">
    <header>
      <h2><i class="fa fa-gift"></i><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</h2>
    </header>
    <div id="SectionBody">
<?php $_smarty_tpl->_subTemplateRender("file:Search.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


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
        <h4 class="modal-title"></h4>
      </div>
    </div>
    <div class="modal-body">
      <div class="form-body">
      </div>
    </div>
  </div>
</div>
<?php $_smarty_tpl->_assignInScope('t', time());
echo '<script'; ?>
>
  var ResultTarget = "table tbody";
  var templ = "Order";
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo _BASE_URL_;?>
/js/OrderManagement.js?<?php echo $_smarty_tpl->tpl_vars['t']->value;?>
"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="<?php echo _BASE_URL_;?>
/css/Order/Management.css?<?php echo $_smarty_tpl->tpl_vars['t']->value;?>
">

<?php $_smarty_tpl->_subTemplateRender("file:foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
