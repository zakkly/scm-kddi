<?php
/* Smarty version 3.1.44, created on 2022-02-11 01:38:00
  from '/Users/doi/Dropbox/Sites/scm-kddi/templates/UserManagement/Index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_62053f68450ff1_55825547',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f08820b215f37e11b1c75c08cc5d174e219271a6' => 
    array (
      0 => '/Users/doi/Dropbox/Sites/scm-kddi/templates/UserManagement/Index.tpl',
      1 => 1644511079,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:head.tpl' => 1,
    'file:header.tpl' => 1,
    'file:nav.tpl' => 1,
    'file:search.tpl' => 1,
    'file:footer.tpl' => 1,
    'file:foot.tpl' => 1,
  ),
),false)) {
function content_62053f68450ff1_55825547 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/Users/doi/Dropbox/Sites/scm-kddi/vendor/smarty/smarty/libs/plugins/function.FormModeSwitch.php','function'=>'smarty_function_FormModeSwitch',),));
$_smarty_tpl->_subTemplateRender("file:head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:nav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div id="body">
  <div class="inner">
    <header>
      <h2><i class="fa fa-heart"></i><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</h2>
    </header>
    <div id="SectionBody">
<?php $_smarty_tpl->_subTemplateRender("file:search.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<?php if ($_smarty_tpl->tpl_vars['errorMsg']->value != '') {?>
      <div class="alert alert-danger display-hide">
          <button class="close" data-close="alert"></button> <?php echo $_smarty_tpl->tpl_vars['errorMsg']->value;?>

      </div>
<?php } elseif (!empty($_smarty_tpl->tpl_vars['_SESSION']->value["result"])) {?>
      <div class="alert alert-success display-hide">
          <button class="close" data-close="alert"></button> 編集が成功しました
      </div>
<?php }?>


      <button class="btn green" id="groupSave" data-toggle="modal" data-target="#groupEditFormModal"><i class="fa fa-check"></i>新規登録</button>

      <div class="widget-table action-table">
<?php if ($_smarty_tpl->tpl_vars['data']->value) {?>
        <table class="table table-striped table-bordered">
          <thead>
          <tr>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['form']->value, 'v', false, 'k');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
            <?php if ($_smarty_tpl->tpl_vars['v']->value["view"] == 1) {?>
            <th><?php echo $_smarty_tpl->tpl_vars['v']->value["name"];?>
</th>
            <?php }?>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <th></th>
          </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
<?php }?>
        <ul class="pagination">
          <li class="prev"><a href="#" title="First"><i class="fa fa-angle-double-left"></i></a></li>
          <li class="next"><a href="#" title="Last"><i class="fa fa-angle-double-right"></i></a></li>
        </ul>
      </div>

    </div>
  </div>
</div>


            
<div class="modal modal-info fade" id="groupEditFormModal" role="dialog">
  <div class="modal-dialog margin-md-top">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">編集する</h4>
      </div>
    </div>
    <div class="modal-body">
      <form class="register" action="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" method="post">
        <div class="form-body">
    			<div class="login-fields">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['form']->value, 'v', false, 'k');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
              <?php $_smarty_tpl->_assignInScope('params', array($_smarty_tpl->tpl_vars['k']->value,$_smarty_tpl->tpl_vars['v']->value));?>
              <?php echo smarty_function_FormModeSwitch(array('v'=>$_smarty_tpl->tpl_vars['v']->value,'k'=>$_smarty_tpl->tpl_vars['k']->value),$_smarty_tpl);?>

            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    			</div>
    			<div class="login-actions">
    				<button class="button btn btn-primary btn-large">保存する</button>
    			</div> <!-- .actions -->
        </div>
        <input type="hidden" name="code" value="">
        <input type="hidden" name="action" value="<?php echo $_smarty_tpl->tpl_vars['actionVal']->value;?>
">
      </form>
    </div>
  </div>
</div>


<?php echo '<script'; ?>
 src="<?php echo _BASE_URL_;?>
/js/search.fields.js"><?php echo '</script'; ?>
>
<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
