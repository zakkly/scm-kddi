<?php
/* Smarty version 3.1.44, created on 2022-11-21 09:32:32
  from '/home/d-connect/www/scm-kddi/templates/Goods/ItemSet.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_637ac720c82b28_92377686',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ee6c38dff513a67b7a6a88fb86f3e3185eb8fb44' => 
    array (
      0 => '/home/d-connect/www/scm-kddi/templates/Goods/ItemSet.tpl',
      1 => 1668990752,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:head.tpl' => 1,
    'file:header.tpl' => 1,
    'file:nav.tpl' => 1,
    'file:Search.tpl' => 1,
    'file:footer.tpl' => 1,
    'file:foot.tpl' => 1,
  ),
),false)) {
function content_637ac720c82b28_92377686 (Smarty_Internal_Template $_smarty_tpl) {
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
<?php $_smarty_tpl->_subTemplateRender("file:Search.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <button class="btn green" id="" onclick="location.href='<?php echo _BASE_URL_;?>
/Goods/SetRegister'"><i class="fa fa-check"></i>新規登録</button>
    <div id="SearchResult" class="widget-table action-table">
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>No.</th>
            <th>セット商品名</th>
            <th>画像</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
      <ul class="pagination">
        <li class="prev"><a href="#" title="First"><i class="fa fa-angle-double-left"></i></a></li>
        <li class="next"><a href="#" title="Last"><i class="fa fa-angle-double-right"></i></a></li>
      </ul>
    </div>

    </div>
  </div>
</div>


<style>
.modal{
width: 80%;
left: 10%;
margin-left: 0;
}

.login-fields{
display: flex;
flex-wrap: wrap;
}

.login-fields .field{
width: 30%;
}

.login-fields .field.text,
.login-fields .field.image,
.login-fields .field.textarea{
width: 100%;
}

.login-fields .field.textarea textarea{
height: 100px;
}
</style>

<?php echo '<script'; ?>
>
  var InsertSetUrls = '<?php echo _BASE_URL_;?>
/Goods/SetRegister';
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo _BASE_URL_;?>
/js/SetItemForm.js"><?php echo '</script'; ?>
>
<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
