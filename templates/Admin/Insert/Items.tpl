
{if !empty($r)}
  {foreach from=$r key=k item=v}
<div class="items">
  <div class="img"><img src="{_IMG_}{if !empty($v["img"])}{$v["img"]}{else}nowprinting.jpg{/if}"></div>
  <div class="name">{$v["title"]}</div>

{if is_array($v["items"])}
  <div class="ttl">SET</div>
  <div class="title">{$v["title"]}</div>
  <div class="demo type{$v["demo"]}">{$form["demo"]["item"][$v["demo"]]}</div>
  <input type="checkbox" name="sets[]" value="{$v["code"]}" class="hidden">
{else}
  <div class="ttl">単品商品</div>
  <div class="title">{$v["name"]}</div>
  <div class="num">数量:{$v["stock"]}{$form["unit"]["item"][$v["unit"]]}</div>
  <div class="demo type{$v["demo"]}">{$form["demo"]["item"][$v["demo"]]}</div>
  <input type="checkbox" name="items[]" value="{$v["code"]}" class="hidden">
{/if}
  <div class="comment">{$v["comment"]}</div>
</div>
  {/foreach}
{/if}