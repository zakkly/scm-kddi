

<div class="widget-content">
  <fieldset id="search" class="search">
    <legend><i class="fa fa-search"></i>検索</legend>
    <form id="searchForm" class="clearfix">
      <div class="SearchFiledBody">
      
{foreach from=$itemForm key=k item=v}
  {if $v["search"] == 1 }
{FormModeSwitch v=$v k=$k prefix="search"}
  {/if}
{/foreach}
      </div>
    <input type="hidden" name="target" value="{$target}">
    <input type="hidden" name="action" value="{$actionVal}">
    <button type="submit" class="btn green filterSearchBtn"><i class="fa fa-search"></i>検索</button>
    </form>
  </fieldset>
</div>
              


<div class="num_rows">
  <select name="num_rows">
    <option value="10">10</option>
    <option value="25">25</option>
    <option value="50">50</option>
    <option value="100">100</option>
    <option value="500">500</option>
    <option value="1000">1000</option>
  </select>件表示
</div>