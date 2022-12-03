<?php
/* Smarty version 3.1.44, created on 2022-04-18 02:22:24
  from '/Users/doi/Dropbox/Sites/scm-kddi/templates/Goods/ItemWarehouse.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_625c4cd074c920_68251156',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '78b11722a07bec0c2beecafaf1521c2c043c3d12' => 
    array (
      0 => '/Users/doi/Dropbox/Sites/scm-kddi/templates/Goods/ItemWarehouse.tpl',
      1 => 1650216143,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:head.tpl' => 1,
    'file:header.tpl' => 1,
    'file:nav.tpl' => 1,
    'file:search.tpl' => 1,
    'file:foot.tpl' => 1,
  ),
),false)) {
function content_625c4cd074c920_68251156 (Smarty_Internal_Template $_smarty_tpl) {
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
      <h2><i class="fa fa-gift"></i><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</h2>
    </header>
    <div id="SectionBody">
<?php $_smarty_tpl->_subTemplateRender("file:search.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

      
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['itemForm']->value, 'v', false, 'k');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
        <th><?php echo $_smarty_tpl->tpl_vars['v']->value["name"];?>
</th>
      <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
      <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>
">
      <ul class="pagination">
        <li class="prev"><a href="#" title="First"><i class="fa fa-angle-double-left"></i></a></li>
        <li class="next"><a href="#" title="Last"><i class="fa fa-angle-double-right"></i></a></li>
      </ul>
    </div>
  </div>
</div>
<div class="modal modal-info fade" id="groupEditFormModal" role="dialog">
  <div class="modal-dialog margin-md-top">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">入庫する</h4>
      </div>
    </div>
    <div class="modal-body">
      <form class="register" action="<?php echo _BASE_URL_;?>
/<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" method="post">
        <p style="float: left;  margin-right:15px;"><img src="" width="150px;"></p>
        <div class="field tex name">
          <label for="email">商品名:</label>
          <span style="font-weight: bold;"></span>
        </div>
        <div class="field text stock">
          <label for="email">現在の在庫数:</label>
          <span style="font-weight: bold;"></span>
        </div>
        <div class="field text">
          <label for="email">入庫数:</label>
          <input type="number" id="stock" name="stock" value="" placeholder="入個数" class="login" required="required">
        </div>
        <input type="hidden" name="mode" value="">
        <input type="hidden" name="code" value="">
        <input type="hidden" name="action" value="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
">
        <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>
">
  			<div class="login-actions submit">
  				<button class="button btn btn-primary btn-large">保存する</button>
  			</div> <!-- .actions -->
      </form>
    </div>
  </div>
</div>


<?php echo '<script'; ?>
>
  var InsertSetUrls = 'https://new.backslogistic.com/Goods/ItemRegister';
  var templ = "ItemTable";
  var ResultTarget = "table tbody";
  var nowPos;
  
  $(document).on("click",".pencil",function(){
    var fieldset = $(this).parent().find("fieldset");
    var __code = fieldset.find("input[name=code]").val();
    var __name = fieldset.find("input[name=name]").val();
    var __stock = fieldset.find("input[name=stock]").val();
    var __img = fieldset.find("input[name=img]").val();
    if(!__img){
      __img = "nowprinting.jpg";
    }
    $(".modal-body").find(".name span").html(__name);
    $(".modal-body").find(".stock span").html(__stock);
    $(".modal-body").find("input[name=code]").val(__code);
    $(".modal-body").find("input[name=mode]").val("Warehouse");
    $(".modal-body").find("input[name=action]").val("<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
");
    $(".modal-body").find("img").attr("src",ImgDir+__img);
  });
<?php echo '</script'; ?>
>
<?php }
$_smarty_tpl->_subTemplateRender("file:foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
