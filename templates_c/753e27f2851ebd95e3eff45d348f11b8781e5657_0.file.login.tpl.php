<?php
/* Smarty version 3.1.44, created on 2022-02-04 11:37:42
  from '/Users/doi/Dropbox/Sites/scm-kddi/templates/login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.44',
  'unifunc' => 'content_61fc91760cc953_79945108',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '753e27f2851ebd95e3eff45d348f11b8781e5657' => 
    array (
      0 => '/Users/doi/Dropbox/Sites/scm-kddi/templates/login.tpl',
      1 => 1643942260,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:head.tpl' => 1,
    'file:foot.tpl' => 1,
  ),
),false)) {
function content_61fc91760cc953_79945108 (Smarty_Internal_Template $_smarty_tpl) {
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
