<?php
/* Smarty version 3.1.44, created on 2022-11-21 09:29:01
  from '/home/d-connect/www/scm-kddi/templates/Order/ItemImport.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_637ac64de519e3_51941694',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e887e20bf40f08823de6ad35e925047767ef280d' => 
    array (
      0 => '/home/d-connect/www/scm-kddi/templates/Order/ItemImport.tpl',
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
function content_637ac64de519e3_51941694 (Smarty_Internal_Template $_smarty_tpl) {
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
      <p class="alert alert-danger">オーダーステータスが「受注確定」のもののみ登録できます</p>
      <p class="download btn"><a href="<?php echo _BASE_URL_;?>
/Admin/GetTemplate"><i class="fa fa-cloud"></i>CSVファイルをダウンロード</a></p>
      <div class="comment">
      </div>

      <div id="FormArea">
        <div class="alert alert-danger display-hide" style="display: none">
            <button class="close" data-close="alert"></button><p><?php echo $_smarty_tpl->tpl_vars['errorMsg']->value;?>
</p>
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
          <progress value="0" id="prog" max=100></progress>(<span id="pv">0</span>%)
        </div>
        <div class="log"></div>
        <div id="files" class="files"></div>
<input type="hidden" name="target" value="order">
<input type="hidden" name="time" value="<?php echo time();?>
">
<input type="hidden" name="chk" value="">
<input type="hidden" name="user" value="<?php echo $_SESSION['user'];?>
">
<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>
">
<input type="hidden" name="action" value="up">
<input type="hidden" name="mode" value="new">
      </div>

    </div>
  </div>
</div>
<?php echo '<script'; ?>
>
$(function(){
  $("#FormArea").show();
});
<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="<?php echo _BASE_URL_;?>
/js/upload.files.js"><?php echo '</script'; ?>
>
<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
