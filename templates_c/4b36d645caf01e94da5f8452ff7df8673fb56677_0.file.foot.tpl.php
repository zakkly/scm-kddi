<?php
/* Smarty version 3.1.44, created on 2022-02-14 03:08:24
  from '/Users/doi/Dropbox/Sites/scm-kddi/templates/foot.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_6209491877ed89_11924035',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4b36d645caf01e94da5f8452ff7df8673fb56677' => 
    array (
      0 => '/Users/doi/Dropbox/Sites/scm-kddi/templates/foot.tpl',
      1 => 1644775702,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6209491877ed89_11924035 (Smarty_Internal_Template $_smarty_tpl) {
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
