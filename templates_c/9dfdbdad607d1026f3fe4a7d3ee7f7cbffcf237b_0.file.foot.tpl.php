<?php
/* Smarty version 3.1.44, created on 2022-11-21 09:23:30
  from '/home/d-connect/www/scm-kddi/templates/foot.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_637ac50298d7d6_50619692',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9dfdbdad607d1026f3fe4a7d3ee7f7cbffcf237b' => 
    array (
      0 => '/home/d-connect/www/scm-kddi/templates/foot.tpl',
      1 => 1668990054,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_637ac50298d7d6_50619692 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
>
  var BaseUrls = '<?php echo _BASE_URL_;?>
';
  var ImgDir = '<?php echo _BASE_URL_;?>
/images/';
<?php echo '</script'; ?>
>

<?php $_smarty_tpl->_assignInScope('t', time());
echo '<script'; ?>
 src="<?php echo _BASE_URL_;?>
/static/js/excanvas.min.js"><?php echo '</script'; ?>
> 
<?php echo '<script'; ?>
 src="<?php echo _BASE_URL_;?>
/static/js/chart.min.js" type="text/javascript"><?php echo '</script'; ?>
> 
<?php echo '<script'; ?>
 src="<?php echo _BASE_URL_;?>
/static/js/bootstrap.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 language="javascript" type="text/javascript" src="<?php echo _BASE_URL_;?>
/static/js/full-calendar/fullcalendar.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="//cdn.jsdelivr.net/npm/bootstrap-touchspin@4.3.0/dist/jquery.bootstrap-touchspin.min.js"><?php echo '</script'; ?>
> 
<?php echo '<script'; ?>
 src="<?php echo _BASE_URL_;?>
/static/js/base.js"><?php echo '</script'; ?>
> 
<?php echo '<script'; ?>
 type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo _BASE_URL_;?>
/js/js.js?<?php echo $_smarty_tpl->tpl_vars['t']->value;?>
"><?php echo '</script'; ?>
> 
<?php echo '<script'; ?>
 src="<?php echo _BASE_URL_;?>
/js/file_upload.js"><?php echo '</script'; ?>
> 

</bogy>
</html><?php }
}
