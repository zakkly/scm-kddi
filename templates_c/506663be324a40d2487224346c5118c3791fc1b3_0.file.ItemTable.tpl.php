<?php
/* Smarty version 3.1.44, created on 2022-11-21 02:24:58
  from '/Users/doi/Dropbox/Sites/scm-kddi/templates/Admin/Insert/ItemTable.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_637a62ea1543f1_39267083',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '506663be324a40d2487224346c5118c3791fc1b3' => 
    array (
      0 => '/Users/doi/Dropbox/Sites/scm-kddi/templates/Admin/Insert/ItemTable.tpl',
      1 => 1668965092,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_637a62ea1543f1_39267083 (Smarty_Internal_Template $_smarty_tpl) {
if (!empty($_smarty_tpl->tpl_vars['r']->value)) {?>
  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['r']->value, 'v', false, 'k');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
  <tr class="dataObj" data-code="<?php echo $_smarty_tpl->tpl_vars['v']->value["code"];?>
">
    <td class="num"><?php echo $_smarty_tpl->tpl_vars['k']->value+1;?>
</td>
    <td class="code"><?php echo $_smarty_tpl->tpl_vars['v']->value["code"];?>
</td>
    <td class="img"><img src="<?php echo _IMG_;
if (!empty($_smarty_tpl->tpl_vars['v']->value["img"])) {
echo $_smarty_tpl->tpl_vars['v']->value["img"];
} else { ?>nowprinting.jpg<?php }?>"></td>
    <td class="name"><?php echo $_smarty_tpl->tpl_vars['v']->value["name"];?>
</td>
    <td class="stocktotal num"><?php echo $_smarty_tpl->tpl_vars['v']->value["stock"]+$_smarty_tpl->tpl_vars['v']->value["stock2"]+$_smarty_tpl->tpl_vars['v']->value["stock3"]+$_smarty_tpl->tpl_vars['v']->value["stock4"];?>
</td>
    <td class="stock3 num"><?php echo $_smarty_tpl->tpl_vars['v']->value["stock3"];?>
</td>
    <td class="stock2 num"><?php echo $_smarty_tpl->tpl_vars['v']->value["stock2"];?>
</td>
    <td class="stock1 num"><?php echo $_smarty_tpl->tpl_vars['v']->value["stock"];?>
</td>
    <td class="stock4 num"><?php echo $_smarty_tpl->tpl_vars['v']->value["stock4"];?>
</td>
    <td class="GroupIdList">
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['v']->value["GroupIdList"], 'val', false, 'key');
$_smarty_tpl->tpl_vars['val']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->do_else = false;
?>
      <span class="viewBtn"><?php echo $_smarty_tpl->tpl_vars['val']->value;?>
</span>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </td>
    <td class="category">
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['v']->value["category"], 'val', false, 'key');
$_smarty_tpl->tpl_vars['val']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->do_else = false;
?>
      <span class="viewBtn"><?php echo $_smarty_tpl->tpl_vars['val']->value;?>
</span>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </td>
    <td class="sub_category">
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['v']->value["sub_category"], 'val', false, 'key');
$_smarty_tpl->tpl_vars['val']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->do_else = false;
?>
      <span class="viewBtn"><?php echo $_smarty_tpl->tpl_vars['val']->value;?>
</span>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </td>
    <td class="td-actions">
      <a href="javascript:;" class="btn btn-success pencil" title="編集する" data-code="<?php echo $_smarty_tpl->tpl_vars['v']->value["code"];?>
" data-toggle="modal" data-target="#groupEditFormModal"><i class="btn-icon-only fa-pencil fa"> </i></a>
      <a href="javascript:;" class="btn btn-danger btn-small" title="削除する"><i class="btn-icon-only fa fa-trash"> </i></a>
      <input type="hidden" name="code" value="<?php echo $_smarty_tpl->tpl_vars['v']->value["code"];?>
">
      
        <fieldset>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['v']->value, 'val', false, 'key');
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
    </td>
  </tr>
  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
}
