<?php
/* Smarty version 3.1.44, created on 2022-11-21 10:26:58
  from '/home/d-connect/www/scm-kddi/templates/User/Order.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_637ad3e20575b4_97267404',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '597df783f1bb4155d9ccde922319973c85877438' => 
    array (
      0 => '/home/d-connect/www/scm-kddi/templates/User/Order.tpl',
      1 => 1668990055,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:head.tpl' => 1,
    'file:header.tpl' => 1,
    'file:User/nav.tpl' => 1,
    'file:foot.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_637ad3e20575b4_97267404 (Smarty_Internal_Template $_smarty_tpl) {
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
        <ul class="nav nav-pills nav-justified steps">
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['steps']->value, 'v', false, 'k');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
          <?php $_smarty_tpl->_assignInScope('n', $_smarty_tpl->tpl_vars['k']->value+1);?>
          <li class="step_tab<?php echo $_smarty_tpl->tpl_vars['n']->value;?>
">
            <a href="#tab<?php echo $_smarty_tpl->tpl_vars['n']->value;?>
" data-toggle="tab" class="step">
              <span class="number"> <?php echo $_smarty_tpl->tpl_vars['n']->value;?>
 </span>
              <span class="desc"><?php echo $_smarty_tpl->tpl_vars['v']->value["title"];?>
</span>
            </a>
          </li>
          <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
      </ul>

      <div id="bar" class="progress progress-striped" role="progressbar">
        <div class="progress-bar progress-bar-success"> </div>
      </div>
      
      <div class="tab-page">
      </div>
      <!--
      -->
        <form class="register">
          <input type="hidden" name="title" value="<?php echo uniqid();?>
">
          <input type="hidden" name="action" value="<?php echo $_SESSION['token'];?>
">
          <input type="hidden" name="user" value="<?php echo $_SESSION['user'];?>
">
          <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>
">
        </form>
      </div>
    </div>
  </div>
</div>



<?php echo '<script'; ?>
>
  var Demo =[ 
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['form']->value["demo"]["item"], 'v', false, 'k');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
  '<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
',
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
  ];  
  var Templates =[ 
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['steps']->value, 'v', false, 'k');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
$_smarty_tpl->_assignInScope('arr', implode("','",$_smarty_tpl->tpl_vars['v']->value));?>
  ['<?php echo $_smarty_tpl->tpl_vars['arr']->value;?>
'],
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
  ];
  //var templ = "items";
  //var ResultTarget = "SearchResult";
  var Unit =[ 
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['form']->value["unit"]["item"], 'v', false, 'k');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
  '<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
',
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
  ];
  var GroupId = <?php echo $_SESSION['role'];?>
;
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo _BASE_URL_;?>
/js/User/user.js?<?php echo $_smarty_tpl->tpl_vars['t']->value;?>
"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo _BASE_URL_;?>
/js/OrderInsert.js?<?php echo $_smarty_tpl->tpl_vars['t']->value;?>
"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="<?php echo _BASE_URL_;?>
/css/OrderInsert.css">

<?php $_smarty_tpl->_subTemplateRender("file:foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
