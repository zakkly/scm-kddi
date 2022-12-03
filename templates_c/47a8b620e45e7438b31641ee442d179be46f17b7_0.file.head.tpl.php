<?php
/* Smarty version 3.1.44, created on 2022-04-18 03:20:42
  from '/Users/doi/Dropbox/Sites/scm-kddi/templates/head.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_625c5a7a7c1fb9_27611098',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '47a8b620e45e7438b31641ee442d179be46f17b7' => 
    array (
      0 => '/Users/doi/Dropbox/Sites/scm-kddi/templates/head.tpl',
      1 => 1650219607,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_625c5a7a7c1fb9_27611098 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="author" content="smronju">
<meta name="robots" content="noindex">
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>

<?php if (!empty($_smarty_tpl->tpl_vars['css']->value)) {?>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['css']->value, 'v', false, 'k');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
<link href="<?php echo _BASE_URL_;?>
/css/<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
.css?<?php echo time();?>
" rel="stylesheet">
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?>

<?php if ($_SESSION['role'] != "admin") {?>
<link href="<?php echo _BASE_URL_;?>
/css/User.css?<?php echo time();?>
" rel="stylesheet">
<?php }?>
<link href="//fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
<link href="//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="//cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/basic.min.css" rel="stylesheet">
<link href="//cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.css" rel="stylesheet">
<link href="//cdn.jsdelivr.net/npm/bootstrap-touchspin@4.3.0/dist/jquery.bootstrap-touchspin.css" rel="stylesheet">
<link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.min.css" rel="stylesheet">
<?php if ($_SESSION['role'] != "admin") {
}
echo '<script'; ?>
 type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"><?php echo '</script'; ?>
>
<base href="<?php echo _BASE_URL_;?>
" target="_self">

<?php if (!empty($_smarty_tpl->tpl_vars['js']->value)) {?>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['js']->value, 'v', false, 'k');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
echo '<script'; ?>
 src="<?php echo _BASE_URL_;?>
/js/<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
.js?<?php echo time();?>
" type="text/javascript"><?php echo '</script'; ?>
>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
if ($_SESSION['role'] != "admin") {
echo '<script'; ?>
 src="<?php echo _BASE_URL_;?>
/js/User/user.js?<?php echo time();?>
" type="text/javascript"><?php echo '</script'; ?>
>
<?php }?>

</head>

<body>
<?php }
}
