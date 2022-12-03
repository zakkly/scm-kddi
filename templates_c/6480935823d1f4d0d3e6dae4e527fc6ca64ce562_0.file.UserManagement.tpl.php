<?php
/* Smarty version 3.1.44, created on 2022-04-18 03:26:06
  from '/Users/doi/Dropbox/Sites/scm-kddi/templates/User/UserManagement.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_625c5bbed79441_12682928',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6480935823d1f4d0d3e6dae4e527fc6ca64ce562' => 
    array (
      0 => '/Users/doi/Dropbox/Sites/scm-kddi/templates/User/UserManagement.tpl',
      1 => 1650219965,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:head.tpl' => 1,
    'file:header.tpl' => 1,
    'file:User/nav.tpl' => 1,
    'file:foot.tpl' => 1,
  ),
),false)) {
function content_625c5bbed79441_12682928 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/Users/doi/Dropbox/Sites/scm-kddi/vendor/smarty/smarty/libs/plugins/function.FormModeSwitch.php','function'=>'smarty_function_FormModeSwitch',),));
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
  
      <div class="widget-content">
        <form class="register" action="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" method="post">
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['form']->value, 'v', false, 'k');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
              <?php echo smarty_function_FormModeSwitch(array('v'=>$_smarty_tpl->tpl_vars['v']->value,'k'=>$_smarty_tpl->tpl_vars['k']->value,'d'=>$_smarty_tpl->tpl_vars['data']->value),$_smarty_tpl);?>

          <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          <input type="hidden" name="mode" value="edit">
          <input type="hidden" name="action" value="<?php echo $_smarty_tpl->tpl_vars['actionVal']->value;?>
">
          <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>
">
    			<div class="login-actions" style="clear: both; text-align: center;">
    				<button class="button btn btn-primary btn-large">保存する</button>
    			</div> <!-- .actions -->
        </form>
      </div>
    </div>
  </div>
</div>

  
<?php echo '<script'; ?>
>
  var GroupId = <?php echo $_smarty_tpl->tpl_vars['data']->value['code'];?>
;
  if(typeof GroupId != "undefined"){
    $("select[name=GroupIdList]").prop("disabled",false);
    //console.log(GroupId);
    $("select[name=GroupIdList]").val(GroupId);
    $("select[name=GroupIdList]").prop("disabled",true);
  }
  
  $(document).on("submit","form.register",function(){
    $("input").each(function(){
      if($(this).prop("disabled")){
        $(this).prop("disabled",false);
      }
    });
    $("select").each(function(){
      if($(this).prop("disabled")){
        $(this).prop("disabled",false);
      }
    });
    
    $("#search input").each(function(){
      if($(this).prop("disabled")){
        $(this).prop("disabled",false);
      }
    });
  });
<?php echo '</script'; ?>
>
<?php $_smarty_tpl->_subTemplateRender("file:foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
