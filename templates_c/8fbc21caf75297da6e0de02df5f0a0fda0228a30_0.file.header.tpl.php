<?php
/* Smarty version 3.1.44, created on 2022-02-15 15:30:57
  from '/Users/doi/Dropbox/Sites/scm-kddi/templates/header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_620b48a19d5209_59909827',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8fbc21caf75297da6e0de02df5f0a0fda0228a30' => 
    array (
      0 => '/Users/doi/Dropbox/Sites/scm-kddi/templates/header.tpl',
      1 => 1644906622,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_620b48a19d5209_59909827 (Smarty_Internal_Template $_smarty_tpl) {
?>
  <header id="g-header">
    <div class="inner">
      <h1><img src="<?php echo _BASE_URL_;?>
/images/logo-1.png"></h1>
    </div>
    
    <ul class="nav pull-right">
      <li class=""><a href="<?php echo _BASE_URL_;?>
/logout" class="">ログアウト</a></li>
      <li class=""><a href="<?php echo _BASE_URL_;?>
" class=""><i class="fa fa-user-circle"></i><?php echo $_SESSION['user_name'];?>
</a></li>
  </header><?php }
}
