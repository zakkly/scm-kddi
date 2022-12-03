<?php
/* Smarty version 3.1.44, created on 2022-02-15 01:12:34
  from '/Users/doi/Dropbox/Sites/scm-kddi/templates/Admin/Insert/NumsetDetail.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_620a7f72d32019_38872147',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2411118b5211fa66a67fd33d31c515c0bf95f4f4' => 
    array (
      0 => '/Users/doi/Dropbox/Sites/scm-kddi/templates/Admin/Insert/NumsetDetail.tpl',
      1 => 1644853701,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_620a7f72d32019_38872147 (Smarty_Internal_Template $_smarty_tpl) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['r']->value["adress"], 'v', false, 'k');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
<article>
  <header class="h">
    <h1><span>送付先</span><em><?php echo $_smarty_tpl->tpl_vars['v']->value["destination"];?>
</em></h1>
    <ul>
      <li><?php echo $_smarty_tpl->tpl_vars['v']->value["pref"];
echo $_smarty_tpl->tpl_vars['v']->value["add1"];
echo $_smarty_tpl->tpl_vars['v']->value["add2"];?>
</li>
      <li>リードタイム<?php echo $_smarty_tpl->tpl_vars['v']->value["leadtime"];?>
日<input type="hidden" name="LeadTime____<?php echo $_smarty_tpl->tpl_vars['v']->value["code"];?>
" value="<?php echo $_smarty_tpl->tpl_vars['v']->value["leadtime"];?>
"></li>
    </ul>
  </header>
  <div class="body">
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['r']->value["sets"], 'vs', false, 'ks');
$_smarty_tpl->tpl_vars['vs']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ks']->value => $_smarty_tpl->tpl_vars['vs']->value) {
$_smarty_tpl->tpl_vars['vs']->do_else = false;
?>
      <?php if (!empty($_smarty_tpl->tpl_vars['vs']->value[0]["title"])) {?>
      <div class="items sets">
        <header>
          <h2>
            <span class="ttl">SET</span>
            <span class="img"><img src="<?php echo _IMG_;
if (!empty($_smarty_tpl->tpl_vars['vs']->value[0]["img"])) {
echo $_smarty_tpl->tpl_vars['vs']->value[0]["img"];
} else { ?>nowprinting.jpg<?php }?>"></span><?php echo $_smarty_tpl->tpl_vars['vs']->value[0]["title"];?>

            <span class="number"><span>発注数</span><input type="number" name="number____<?php echo $_smarty_tpl->tpl_vars['vs']->value[0]["code"];?>
____<?php echo $_smarty_tpl->tpl_vars['v']->value["code"];?>
____sets" value="<?php echo $_smarty_tpl->tpl_vars['vs']->value[0]["order"];?>
" class="stock-chk sets">SET</span>
          </h2>
        </header>
        <ul class="cont">
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['vs']->value[0]["items"], 'val', false, 'key');
$_smarty_tpl->tpl_vars['val']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->do_else = false;
?>
            <?php if (!empty($_smarty_tpl->tpl_vars['val']->value[0]["name"])) {?>
          <li class="stock-chk-item">
            <strong><span class="img"><img src="<?php echo _IMG_;
if (!empty($_smarty_tpl->tpl_vars['val']->value["img"])) {
echo $_smarty_tpl->tpl_vars['val']->value["img"];
} else { ?>nowprinting.jpg<?php }?>"></span><?php echo $_smarty_tpl->tpl_vars['val']->value[0]["name"];?>
</strong>
            <ul class="detail">
              <li class="order"><span><?php echo $_smarty_tpl->tpl_vars['val']->value[0]["order"];?>
</span><?php echo $_smarty_tpl->tpl_vars['val']->value["order"];
echo $_smarty_tpl->tpl_vars['form']->value["unit"]["item"][$_smarty_tpl->tpl_vars['val']->value[0]["unit"]];?>
 </li>
              <?php if (!empty($_smarty_tpl->tpl_vars['val']->value[0]["day"])) {?>
                <li class="day check on">日数</li>
              <?php }?>
              <?php if (!empty($_smarty_tpl->tpl_vars['val']->value[0]["person"])) {?>
              <li class="person check on">人数</li>
              <?php }?>
              <span class="title" data-stock="<?php echo $_smarty_tpl->tpl_vars['val']->value[0]["stock"];?>
"><span class="stock">在庫数</span><?php echo $_smarty_tpl->tpl_vars['val']->value[0]["stock"];?>
</span>
            </ul>
          </li>
            <?php }?>
          <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
      </div>
      <?php }?>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['r']->value["items"], 'vs', false, 'ks');
$_smarty_tpl->tpl_vars['vs']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ks']->value => $_smarty_tpl->tpl_vars['vs']->value) {
$_smarty_tpl->tpl_vars['vs']->do_else = false;
?>
      <div class="items">
        <header>
          <h2>
            <span class="ttl">単品商品</span>
            <span class="img"><img src="<?php echo _IMG_;
if (!empty($_smarty_tpl->tpl_vars['vs']->value[0]["img"])) {
echo $_smarty_tpl->tpl_vars['vs']->value[0]["img"];
} else { ?>nowprinting.jpg<?php }?>"></span>
            <span class="title"><?php echo $_smarty_tpl->tpl_vars['vs']->value[0]["name"];?>
</span>
            <span class="stock">在庫数<?php echo $_smarty_tpl->tpl_vars['vs']->value[0]["stock"];?>
</span>
            <?php echo $_smarty_tpl->tpl_vars['vs']->value[0]["title"];?>

            <span class="number"><span>発注数</span><input type="number" name="number____<?php echo $_smarty_tpl->tpl_vars['vs']->value[0]["code"];?>
____<?php echo $_smarty_tpl->tpl_vars['v']->value["code"];?>
____items" value="<?php echo $_smarty_tpl->tpl_vars['vs']->value[0]["order"];?>
" data-stock="<?php echo $_smarty_tpl->tpl_vars['vs']->value[0]["stock"];?>
" class="stock-chk item"><?php echo $_smarty_tpl->tpl_vars['form']->value["unit"]["item"][$_smarty_tpl->tpl_vars['vs']->value[0]["unit"]];?>
</span>
          </h2>
        </header>
      </div>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
  </div>
</article>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

<?php echo '<script'; ?>
>
$(function(){
});
<?php echo '</script'; ?>
><?php }
}
