<?php
/* Smarty version 3.1.44, created on 2022-11-21 03:10:34
  from '/Users/doi/Dropbox/Sites/scm-kddi/templates/Admin/Insert/TableAddress.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_637a6d9a499e35_65620180',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '23c3ff07ef1ce6bd93cea354d9e1b61e8b335742' => 
    array (
      0 => '/Users/doi/Dropbox/Sites/scm-kddi/templates/Admin/Insert/TableAddress.tpl',
      1 => 1668967831,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_637a6d9a499e35_65620180 (Smarty_Internal_Template $_smarty_tpl) {
?>
      <tr data-add="<?php echo $_POST['d']["destination"];?>
 [<?php echo $_POST['d']["pref"];?>
+<?php echo $_POST['d']["add1"];
echo $_POST['d']["add2"];?>
]" data-code='<?php echo $_POST['d']["code"];?>
' class="dataObj">
        <td style="display:none;"><input type="checkbox" name="adress[]" value='<?php echo $_POST['d']["code"];?>
'></td>
        <td><?php echo $_POST['d']["CompanyName"];?>
</td>
        <td><?php echo $_POST['d']["Adress_Code"];?>
</td>
        <td><?php echo $_POST['d']["destination"];?>
</td>
        <td><?php echo $_POST['d']["zip"];?>
</td>
        <td><?php echo $_POST['d']["pref"];?>
</td>
        <td><?php echo $_POST['d']["add1"];?>
</td>
        <td><?php echo $_POST['d']["add2"];?>
</td>
        <td>
          <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 3+1 - (1) : 1-(3)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration === 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;?>
            <?php $_smarty_tpl->_assignInScope('key', "tel".((string)$_smarty_tpl->tpl_vars['i']->value));?>
            <?php echo $_POST['d'][$_smarty_tpl->tpl_vars['key']->value];?>

            <?php if ($_smarty_tpl->tpl_vars['i']->value < 3) {?>
              -
            <?php }?>
          <?php }
}
?>
        </td>
        <td>
          <?php if (!empty($_POST['search'])) {?>
      <a href="javascript:;" class="btn btn-success btn-small" title="編集する" data-code="<?php echo $_POST['d']["code"];?>
" data-toggle="modal" data-target="#groupEditFormModal"><i class="btn-icon-only fa-pencil fa"> </i></a>
      <a href="javascript:;" class="btn btn-danger btn-small" title="削除する"><i class="btn-icon-only fa fa-trash"> </i></a><input type="hidden" name="code" value="<?php echo $_POST['d']["code"];?>
">
      
        <fieldset>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_POST['d'], 'val', false, 'key');
$_smarty_tpl->tpl_vars['val']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->do_else = false;
?>
          <?php if ($_smarty_tpl->tpl_vars['key']->value != "token") {?>
            <input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['val']->value;?>
">
          <?php }?>
          <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </fieldset>

          <?php }?>
        </td>
      </tr><?php }
}
