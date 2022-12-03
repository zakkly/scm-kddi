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
        {foreach from=$form key=k item=v}
          {$params = array($k,$v)}
          {FormModeSwitch v=$v k=$k d=$data[0]}
        {/foreach}
        </div>
  			<div class="login-actions submit">
  				<p class="button btn btn-danger btn-large" data-toggle="modal" data-target="#groupEditFormModal">商品検索</p>
  			</div> <!-- .actions -->
  			<div id="ItemsSet">
    			
  			</div>
  			<div class="login-actions submit">
  				<button class="button btn btn-primary btn-large">登録する</button>
  			</div> <!-- .actions -->
        <input type="hidden" name="action" value="{$actionVal}">
        <input type="hidden" name="user" value="{$smarty.session.user}">
        <input type="hidden" name="token" value="{$smarty.session.token}">
      </form>
    </div>
  </div>
</div>


<div class="modal modal-info fade" id="groupEditFormModal" role="dialog">
  <div class="modal-dialog margin-md-top">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">商品検索</h4>
      </div>
    </div>
    <div class="modal-body">
      <fieldset id="search" class="search">
        <legend><i class="fa fa-search"></i>検索</legend>
        <form id="searchForm" class="clearfix">
          {foreach from=$searchForm key=k item=v}
            {$params = array($k,$v)}
            {FormModeSwitch v=$v k=$k prefix="search"}
          {/foreach}
          <input type="hidden" name="target" value="Items">
          <input type="hidden" name="action" value="Goods/Index">
          <button type="submit" class="btn green filterSearchBtn"><i class="fa fa-search"></i>検索</button>
        </form>
      </fieldset>
        
      <div id="searchResult" class="ItemSearch">
      </div>
			<div class="login-actions submit">
				<button class="button btn btn-primary btn-large">登録する</button>
			</div>
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
      {if !empty($val[0]["name"])}
      <fieldset class="items">
        {foreach $val[0] key=keys item=vals}
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

<script src="{_BASE_URL_}/js/RegisterSetForm.js"></script>
{include file="footer.tpl"}
{include file="foot.tpl"}