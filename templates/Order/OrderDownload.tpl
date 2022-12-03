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
      <div id="SearchSection">
        <legend><i class="fa fa-search"></i>検索</legend>
        <fieldset id="search" class="search">
          <form name="Search" class="searchField item" action="#">
            {foreach from=$SearchForm key=k item=v}
              {$params = array($k,$v)}
              {FormModeSwitch v=$v k=$k  prefix="search" d=$smarty.post}
            {/foreach}
            {if !empty($smarty.post.status) || $smarty.post.status==9}
            <input type="hidden" name="statusChange" value="1">
            {/if}
            <input type="hidden" name="target" value="Order">
            <input type="hidden" name="action" value="Order/OrderDownload">
            <div style="clear: both; text-align: center;">
              <button type="submit" class="btn green filterSearchBtn"><i class="fa fa-search"></i>検索</button>
            </div>
          </form>
        </fieldset>
        <div class="num_rows">
          <select name="num_rows">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="500">500</option>
            <option value="1000">1000</option>
          </select>件表示
          
          <span class="btn btn-warning" id="MasterDownLoad">受注マスタCSVダウンロード</span>
        </div>
      </div>
      <div class="widget-table action-table scroll-table">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
        {foreach from=$OrderView key=k item=v}
            {if $v["view"] == 1}
              <th class="{$k}">{$v["name"]}</th>
            {/if}
        {/foreach}
              <th></th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>


  </div>
</div>


<div class="modal modal-info fade" id="groupEditFormModal" role="dialog">
  <div class="modal-dialog margin-md-top">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">受注情報を編集する</h4>
      </div>
    </div>
    <div class="modal-body">
      <form class="register" action="{$action}" method="post">
        <div class="form-body">
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  var ResultTarget = "table tbody";
  var templ = "Order";
</script>
<style>
#search{
display: none;
}
</style>
{$t = time()}
<script src="{_BASE_URL_}/js/OrderManagement.js?{$t}"></script>
<link rel="stylesheet" href="{_BASE_URL_}/css/OrderManagement.css?{$t}">
{/if}
{include file="footer.tpl"}
{include file="foot.tpl"}