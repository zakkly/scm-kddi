{include file="head.tpl"}
{include file="header.tpl"}
{include file="nav.tpl"}
<div id="body">
  <div class="inner">
    <header>
      <h2><i class="fa fa-gift"></i>{$title}</h2>
    </header>
    <div id="SectionBody">
{include file="Search.tpl"}
      <table id="SearchResult">
        <thead>
          <tr>
      {foreach from=$itemForm key=k item=v}
        <th>{$v["name"]}</th>
      {/foreach}
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
      
      <input type="hidden" name="token" value="{$smarty.session.token}">
    </div>
  </div>
</div>

<script>
  var InsertSetUrls = '{_BASE_URL_}/Goods/ItemRegister';
  var templ = "ItemTable";
  var ResultTarget = "table tbody";
  var nowPos;
</script>

<script src="{_BASE_URL_}/js/Goods.Index.js"></script>

{include file="foot.tpl"}