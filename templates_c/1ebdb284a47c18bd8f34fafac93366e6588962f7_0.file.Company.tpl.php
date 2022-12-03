<?php
/* Smarty version 3.1.44, created on 2022-02-11 04:31:51
  from '/Users/doi/Dropbox/Sites/scm-kddi/templates/UserManagement/Company.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_6205682780ce42_03714523',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1ebdb284a47c18bd8f34fafac93366e6588962f7' => 
    array (
      0 => '/Users/doi/Dropbox/Sites/scm-kddi/templates/UserManagement/Company.tpl',
      1 => 1644521509,
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
function content_6205682780ce42_03714523 (Smarty_Internal_Template $_smarty_tpl) {
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
      <div class="btnBox">
        <button class="btn green" id="groupSave" data-toggle="modal" data-target="#groupEditFormModal"><i class="fa fa-check"></i>新規登録</button>
        <button class="btn btn-warning reload" data-toggle="#FormArea" id="showCSV">CSVで登録する</button>
      </div>

      <div id="FormArea">
        <p class="btn download"><a href="<?php echo _BASE_URL_;?>
/UserManagement/Company?mode=download"><i class="fa fa-cloud"></i>CSVファイルをダウンロード</a></p>
        <div class="alert alert-danger display-hide" style="display: none">
            <button class="close" data-close="alert"></button><p></p>
        </div>
        <div class="alert alert-success display-hide" style="display: none">
            <button class="close" data-close="alert"></button> 登録が成功しました
        </div>
        <div id="drag-area" class="">
          アップロードするファイルをドロップ
        </div>
        <a href="#" onclick="location.reload();return false;" class="btn btn-warning reload">Cancel</a>
        
        <div id="progress" class="progress">
          ファイルアップロード
          <progress value="0" id="prog" max="100"></progress>(<span id="pv">0</span>%)
        </div>
        <div class="log"></div>
        <div id="files" class="files"></div>
<input type="hidden" name="target" value="Company">
<input type="hidden" name="time" value="<?php echo $_smarty_tpl->tpl_vars['time']->value;?>
">
<input type="hidden" name="chk" value="">
<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>
">
<input type="hidden" name="action" value="up">
<input type="hidden" name="mode" value="new">
      </div>
  
  
  
  
      <div class="widget-table action-table">
<?php if ($_smarty_tpl->tpl_vars['data']->value) {?>
      <table class="table table-striped table-bordered">
        <tr>
          <th>会社コード</th>
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
              <td><?php echo $_smarty_tpl->tpl_vars['v']->value["code"];?>
</td>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['v']->value, 'val', false, 'key');
$_smarty_tpl->tpl_vars['val']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->do_else = false;
?>
            <?php if ($_smarty_tpl->tpl_vars['form']->value[$_smarty_tpl->tpl_vars['key']->value]["need"] == 1) {?>
              <td><?php echo $_smarty_tpl->tpl_vars['val']->value;?>
</td>
            <?php }?>
          <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          <td class="td-actions">
            <a href="javascript:;" class="btn btn-small btn-success" title="編集する" data-toggle="modal" data-target="#groupEditFormModal"><i class="btn-icon-only fa-pencil fa"> </i></a><a href="javascript:;" class="btn btn-danger btn-small" title="削除する"><i class="btn-icon-only fa fa-trash"> </i></a>
            <input  type="hidden" name="code" value="<?php echo $_smarty_tpl->tpl_vars['v']->value["code"];?>
">
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
          <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>
">
      </form>
    </div>
  </div>
</div>

<?php echo '<script'; ?>
 src="<?php echo _BASE_URL_;?>
/js/OrderAdress.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo _BASE_URL_;?>
/js/upload.files.js"><?php echo '</script'; ?>
>

<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
