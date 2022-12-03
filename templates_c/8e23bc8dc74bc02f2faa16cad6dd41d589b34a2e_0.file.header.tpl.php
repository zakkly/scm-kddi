<?php
/* Smarty version 3.1.44, created on 2022-11-21 09:23:30
  from '/home/d-connect/www/scm-kddi/templates/header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_637ac50296c231_77497349',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8e23bc8dc74bc02f2faa16cad6dd41d589b34a2e' => 
    array (
      0 => '/home/d-connect/www/scm-kddi/templates/header.tpl',
      1 => 1668990055,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_637ac50296c231_77497349 (Smarty_Internal_Template $_smarty_tpl) {
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
