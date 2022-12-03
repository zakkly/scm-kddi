{include file="head.tpl"}
{include file="header.tpl"}
{include file="nav.tpl"}
<div id="body">
  <div class="inner">
    <header>
      <h2><i class="fa fa-gift"></i>{$title}</h2>
    </header>
    <div id="SectionBody">
      <form class="register dropzone" action="{$action}" method="post" enctype="multipart/form-data">
        <div class="form-body">
        {foreach from=$form key=$k item=$v}
          {$params = array($k,$v)}
          {FormModeSwitch v=$v k=$k d=$post[0]}
        {/foreach}
        </div>
  			<div class="login-actions submit">
  				<button class="button btn btn-primary btn-large">保存する</button>
  			</div> <!-- .actions -->
        <input type="hidden" name="token" value="{$smarty.session.token}">
        <input type="hidden" name="action" value="{$actionVal}">
        <input type="hidden" name="user" value="{$smarty.session.user}">
        <input type="hidden" name="mode" value="{if !empty($post[0]["code"])}edit{/if}">
      </form>
    </div>
  </div>
</div>


{if !empty($data)}
<fieldset id="EditValue">
{foreach $smarty.post key=k item=v}
  {if !is_array($v)}
    <input type="hidden" name="{$k}" value="{$v}">
  {elseif $k == "items"}
    {foreach $v key=key item=val}
      {if !empty($val["name"])}
      <fieldset class="items">
        {foreach $val key=keys item=vals}
          <input type="hidden" name="{$keys}" value="{$vals}">
        {/foreach}
      </fieldset>
      {/if}
    {/foreach}
  {else}
    {foreach $v key=key item=val}
    <input type="hidden" name="{$k}" value="{$val}" data-key="{$key}" />
    {/foreach}
  {/if}
{/foreach}
</fieldset>
{/if}

<script>
{foreach $post[0] key=k item=v}
  {if in_array($k,["category","GroupIdList","sub_category","category_code","GroupIdList_code","sub_category_code"])}
    var {$k} = ['{implode("','",$v)}'];
  {/if}
{/foreach}
</script>
<script src="{_BASE_URL_}/js/ItemRegister.js"></script>
{include file="footer.tpl"}
{include file="foot.tpl"}