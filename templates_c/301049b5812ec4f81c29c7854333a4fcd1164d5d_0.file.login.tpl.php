<?php
/* Smarty version 3.1.44, created on 2022-11-21 09:27:20
  from '/home/d-connect/www/scm-kddi/templates/login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_637ac5e80cd5e1_84561549',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '301049b5812ec4f81c29c7854333a4fcd1164d5d' => 
    array (
      0 => '/home/d-connect/www/scm-kddi/templates/login.tpl',
      1 => 1668990055,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:head.tpl' => 1,
    'file:foot.tpl' => 1,
  ),
),false)) {
function content_637ac5e80cd5e1_84561549 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div id="wrap">
  <article>
    <header>
      <h1><img src="<?php echo _BASE_URL_;?>
/images/logo.png"></h1>
    </header>
    <div class="body">
      <?php if (!empty($_SESSION['errorMsg'])) {?>
			<span style="font-size: 120%;color: #c00;font-weight: bold; display: block;text-align: center; background: #fff; padding: 10px 10px;border-radius: 40px; margin-bottom: 20px;"><?php echo $_SESSION['errorMsg'];?>
</span>
			<?php }?>
      <form action="<?php echo _BASE_URL_;?>
/login" method="post">
        <dl>
          <dt>ログインID</dt>
          <dd><input autofocus="autofocus" class="span12 sign_in_form" id="user_login_code" maxlength="50" name="username" type="text" placeholder="ログインID" /></dd>
        </dl>
        <dl>
          <dt>ログインパスワード</dt>
          <dd><input autofocus="autofocus" class="span12 sign_in_form" id="user_login_code" maxlength="50" name="password" type="password" placeholder="パスワード" /></dd>
        </dl>
        <p>	<input class="btn btn-primary btn-large span12" name="commit" type="submit" value="ログイン" /></p>
        <input type="hidden" name="authenticity_token" value="<?php echo sha1(random_bytes(30));?>
">
        <input type="hidden" name="utf8" value="&#x2713;">
      </form>
    </div>
  </article>
</div>
<?php $_smarty_tpl->_subTemplateRender("file:foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
