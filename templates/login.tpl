{include file="head.tpl"}
<div id="wrap">
  <article>
    <header>
      <h1><img src="{_BASE_URL_}/images/logo.png"></h1>
    </header>
    <div class="body">
      {if !empty($smarty.session.errorMsg)}
			<span style="font-size: 120%;color: #c00;font-weight: bold; display: block;text-align: center; background: #fff; padding: 10px 10px;border-radius: 40px; margin-bottom: 20px;">{$smarty.session.errorMsg}</span>
			{/if}
      <form action="{_BASE_URL_}/login" method="post">
        <dl>
          <dt>ログインID</dt>
          <dd><input autofocus="autofocus" class="span12 sign_in_form" id="user_login_code" maxlength="50" name="username" type="text" placeholder="ログインID" /></dd>
        </dl>
        <dl>
          <dt>ログインパスワード</dt>
          <dd><input autofocus="autofocus" class="span12 sign_in_form" id="user_login_code" maxlength="50" name="password" type="password" placeholder="パスワード" /></dd>
        </dl>
        <p>	<input class="btn btn-primary btn-large span12" name="commit" type="submit" value="ログイン" /></p>
        <input type="hidden" name="authenticity_token" value="{sha1(random_bytes(30))}">
        <input type="hidden" name="utf8" value="&#x2713;">
      </form>
    </div>
  </article>
</div>
{include file="foot.tpl"}