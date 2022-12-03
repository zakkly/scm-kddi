<?php
/* Smarty version 3.1.44, created on 2022-02-13 20:18:44
  from '/Users/doi/Dropbox/Sites/scm-kddi/templates/Goods/Category.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_6208e914bbbd09_02784119',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1b67b0385ce78fe381bf7aed6669266bac48b0ea' => 
    array (
      0 => '/Users/doi/Dropbox/Sites/scm-kddi/templates/Goods/Category.tpl',
      1 => 1644751118,
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
function content_6208e914bbbd09_02784119 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/Users/doi/Dropbox/Sites/scm-kddi/vendor/smarty/smarty/libs/plugins/function.FormModeSwitch.php','function'=>'smarty_function_FormModeSwitch',),1=>array('file'=>'/Users/doi/Dropbox/Sites/scm-kddi/vendor/smarty/smarty/libs/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
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
        <div class="insert">
          <button class="btn green btn-success btn-small" id="groupSave" data-toggle="modal" data-target="#groupEditFormModal"><i class="fa fa-check"></i>新規登録</button>
          <fieldset>
            <input  type="hidden" name="name" value="">
            <input type="hidden" name="action" value="<?php echo $_smarty_tpl->tpl_vars['actionVal']->value;?>
">
            <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>
">
          </fieldset>
        </div>
        
        <div class="widget-table action-table">
<?php if ($_smarty_tpl->tpl_vars['data']->value) {?>
          <table class="table table-striped table-bordered">
            <tr>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['form']->value, 'v', false, 'k');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
              <?php if ($_smarty_tpl->tpl_vars['v']->value["need"] == 1) {?>
              <th><?php echo $_smarty_tpl->tpl_vars['v']->value["name"];?>
</th>
              <?php }?>
          <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              <th></th>
            </tr>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value, 'v', false, 'k');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
            <tr class="dataObj" data-code="<?php echo $_smarty_tpl->tpl_vars['v']->value["code"];?>
">
              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['v']->value, 'val', false, 'key');
$_smarty_tpl->tpl_vars['val']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->do_else = false;
?>
                <?php if ($_smarty_tpl->tpl_vars['form']->value[$_smarty_tpl->tpl_vars['key']->value]["need"] == 1) {?>
                  <td>
                    <strong><?php echo $_smarty_tpl->tpl_vars['val']->value;?>

                      <span class="">
                        <span class="fc-event-skin btn-success btn btn-small" data-code="<?php echo $_smarty_tpl->tpl_vars['v']->value["code"];?>
" data-toggle="modal" data-target="#CatgoryCompany">
                          対象企業を編集する
                        </span>
                        <fieldset>
                          <?php if (!empty($_smarty_tpl->tpl_vars['v']->value["Company"])) {?>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['v']->value["Company"], 'vs', false, 'ks');
$_smarty_tpl->tpl_vars['vs']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ks']->value => $_smarty_tpl->tpl_vars['vs']->value) {
$_smarty_tpl->tpl_vars['vs']->do_else = false;
?>
                            <input  type="hidden" name="Company" value="<?php echo $_smarty_tpl->tpl_vars['vs']->value;?>
">
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                          <?php }?>
                          <input  type="hidden" name="code" value="<?php echo $_smarty_tpl->tpl_vars['v']->value["code"];?>
">
                          <input type="hidden" name="action" value="<?php echo $_smarty_tpl->tpl_vars['actionVal']->value;?>
">
                          <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>
">
                        </fieldset>
                      </span>
                    </strong>
                    <?php if (!empty($_smarty_tpl->tpl_vars['v']->value["item"])) {?>
                      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['v']->value["item"], 'vs', false, 'ks');
$_smarty_tpl->tpl_vars['vs']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ks']->value => $_smarty_tpl->tpl_vars['vs']->value) {
$_smarty_tpl->tpl_vars['vs']->do_else = false;
?>
                        <span class="sub dataObj" data-code="<?php echo $_smarty_tpl->tpl_vars['vs']->value["code"];?>
">
                          <?php echo $_smarty_tpl->tpl_vars['vs']->value["name"];?>
　
                          <a href="javascript:;" class="btn btn-danger btn-small" title="削除する"><i class="btn-icon-only fa fa-trash"></i></a>
                          <input  type="hidden" name="code" value="<?php echo $_smarty_tpl->tpl_vars['vs']->value["code"];?>
">
                        </span>
                      <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <?php }?>
                  </td>
                <?php }?>
              <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              <td class="td-actions">
                <a href="javascript:;" class="btn btn-small btn-success" title="編集する" data-toggle="modal" data-target="#groupEditFormModal"><i class="btn-icon-only fa-pencil fa"> </i></a>
                <a href="javascript:;" class="btn btn-danger btn-small" title="削除する"><i class="btn-icon-only fa fa-trash"></i></a>
                <a href="javascript:;" class="btn btn-edit btn-small" title="サブカテゴリ追加" data-toggle="modal" data-target="#groupEditFormModal"><i class="btn-icon-only fa fa-plus"></i></a>
                <fieldset>
                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['v']->value, 'val', false, 'key');
$_smarty_tpl->tpl_vars['val']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->do_else = false;
?>
                      <input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['val']->value;?>
">
                  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                  <input type="hidden" name="action" value="<?php echo $_smarty_tpl->tpl_vars['actionVal']->value;?>
">
                  <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>
">
                </fieldset>
              </td>
            </tr>
          <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          </table>
<?php }?>

        </div>
    </div>
  </div>
</div>


<div class="modal modal-info fade" id="CatgoryCompany" role="dialog">
  <div class="modal-dialog margin-md-top">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">企業を追加編集する</h4>
      </div>
      <div class="modal-body">
        <form class="register" action="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" method="post">
          <div class="form-body">
      			<div class="login-fields">
        			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['Company']->value, 'v', false, 'k');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
          			<label class="checkbox"><input type="checkbox" name="Company[]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value["code"];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value["name"];?>
</label>
        			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
      			</div>
            <input type="hidden" name="code" value="">
            <input type="hidden" name="action" value="<?php echo $_smarty_tpl->tpl_vars['actionVal']->value;?>
">
            <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>
">
      			<div class="login-actions">
      									
      				<button class="button btn btn-primary btn-large">保存する</button>
      				
      			</div> <!-- .actions -->
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

            
<div class="modal modal-info fade" id="groupEditFormModal" role="dialog">
  <div class="modal-dialog margin-md-top">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
を編集する</h4>
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
          <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>
">
        </form>
      </div>
    </div>
  </div>
</div>


<?php echo '<script'; ?>
>
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo _BASE_URL_;?>
/js/Category.js?<?php echo smarty_modifier_date_format(time(),"%Y%m%d%H%M%S");?>
"><?php echo '</script'; ?>
>

<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
