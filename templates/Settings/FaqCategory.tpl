{include file="head.tpl"}
{include file="header.tpl"}
{if $smarty.session.role != "admin"}
表示権限がありません
{else}
{include file="nav.tpl"}
<div id="body">
  <div class="inner">
    <header>
      <h2><i class="fa fa-heart"></i>{$title}</h2>
    </header>

    <div class="widget-content">
      <fieldset id="search" class="search">
        <legend><i class="fa fa-search"></i>検索</legend>
        <form id="searchForm" class="clearfix">
        {foreach from=$itemForm key=k item=v}
          {if $v["search"] == 1 }
            {FormModeSwitch v=$v k=$k prefix="search"}
          {/if}
        {/foreach}
        <input type="hidden" name="target" value="Items">
        <button type="submit" class="btn green filterSearchBtn"><i class="fa fa-search"></i>検索</button>
        </form>
      </fieldset>
      <button class="btn green" id="groupSave" data-toggle="modal" data-target="#groupEditFormModal"><i class="fa fa-check"></i>新規登録</button>

      <div class="widget-table action-table">
        <table class="table table-striped table-bordered">
          <thead>
          <tr>
        {foreach from=$form key=k item=v}
            {if $v["view"] == 1}
            <th>{$v["name"]}</th>
            {/if}
        {/foreach}
            <th></th>
          </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
      <input type="hidden" name="token" value="{$smarty.session.token}">
      <input type="hidden" name="action" value="{$actionVal}">
      <ul class="pagination">
        <li class="prev"><a href="#" title="First"><i class="fa fa-angle-double-left"></i></a></li>
        <li class="next"><a href="#" title="Last"><i class="fa fa-angle-double-right"></i></a></li>
      </ul>
    </div>
  </div>
</div>

<div class="modal modal-info fade" id="groupEditFormModal" role="dialog">
  <div class="modal-dialog margin-md-top">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">カテゴリを編集する</h4>
      </div>
    </div>
    <div class="modal-body">
      <form class="register" action="{$action}" method="post">
        <div class="form-body">
    			<div class="login-fields">
            {foreach from=$form key=k item=v}
              {$params = array($k,$v)}
              {FormModeSwitch v=$v k=$k}
            {/foreach}
    			</div>
    			<div class="login-actions">
    				<button class="button btn btn-primary btn-large">保存する</button>
    			</div> <!-- .actions -->
        </div>
        <input type="hidden" name="code" value="">
        <input type="hidden" name="action" value="{$actionVal}">
      </form>
    </div>
  </div>
</div>

<script src="{_BASE_URL_}/js/FaqCate.js"></script>
<style>
#search{
display: none;
}
</style>
{/if}
{include file="footer.tpl"}
{include file="foot.tpl"}