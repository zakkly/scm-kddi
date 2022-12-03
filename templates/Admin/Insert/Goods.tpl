  <ul class="tab">
    <li>商品検索</li>
    <li>セット商品検索</li>
  </ul>
  <div id="SearchSection">
    <section id="ItemSearch" class="search clearfix">
      <form name="ItemSearch" class="searchField item" action="#">
        <div class="SearchFiledBody">
        {foreach from=$itemForm key=k item=v}
          {$params = array($k,$v)}
          {if !empty($v["search"])}
          {FormModeSwitch v=$v k=$k prefix="search"}
          {/if}
        {/foreach}
        <input type="hidden" name="table" value="items">
        <input type="hidden" name="action" value="Goods/Index">
        <input type="hidden" name="target" value="Items">
        <button type="submit" class="btn green filterSearchBtn"><i class="fa fa-search"></i>検索</button>
        </div>
      </form>
    </section>
    <section id="SetSearch" class="search clearfix">
      <form name="SetSearch" class="searchField set" action="#">
        {foreach from=$searchForm key=k item=v}
          {$params = array($k,$v)}
          {FormModeSwitch v=$v k=$k prefix="search"}
        {/foreach}
        <input type="hidden" name="set" value="set">
        <input type="hidden" name="table" value="items">
        <input type="hidden" name="target" value="Sets">
        <input type="hidden" name="action" value="Goods/ItemSet">
        <button type="submit" class="btn green filterSearchBtn"><i class="fa fa-search"></i>検索</button>
      </form>
    </section>
    
        
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
  </div>
  
  <div class="tabForm">
    <div class="SetType">
    {foreach from=$form key=k item=v}
      {$params = array($k,$v)}
      {if $smarty.session.role != "admin" && $k=="GroupIdList"}
      <input type="hidden" name="{$k}" value="{$smarty.session.role}">
      {else}
      {FormModeSwitch v=$v k=$k}
      {/if}
    {/foreach}
    </div>
    <input type="hidden" name="user" value="{$smarty.session.user}">
    <input type="hidden" name="action" value="{$smarty.session.token}">
    <input type="hidden" name="mode" value="order">
    <div id="SearchResult"></div>
    <div class="login-actions submit">
			<button class="button btn btn-primary btn-large">次へ</button>
    </div>
  </div>

<script>
$(function(){
  NowTabPos=0;
  //初期設定は最初のタブを表示
  $("ul.tab li").eq(0).addClass("on");
  $("#SearchSection .search").eq(0).addClass("on");
  
  if(typeof GroupId != "undefined"){
    $("select[name=search_GroupIdList]").val(GroupId);
    $("select[name=search_GroupIdList]").prop("disabled",true);
  }
});
  var templ = "Items";
  var ResultTarget = "#SearchResult";
</script>