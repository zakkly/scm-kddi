{foreach from=$r["adress"] key=k item=v}
<article>
  <header class="h">
    <h1><span>送付先</span><em>{$v["destination"]}</em></h1>
    <ul>
      <li>{$v["pref"]}{$v["add1"]}{$v["add2"]}</li>
      <li>リードタイム{$v["leadtime"]}日<input type="hidden" name="LeadTime____{$v["code"]}" value="{$v["leadtime"]}"></li>
    </ul>
  </header>
  <div class="body">
    {foreach from=$r["sets"] key=ks item=vs}
      {if !empty($vs[0]["title"])}
      <div class="items sets">
        <header>
          <h2>
            <span class="ttl">SET</span>
            <span class="img"><img src="{_IMG_}{if !empty($vs[0]["img"])}{$vs[0]["img"]}{else}nowprinting.jpg{/if}"></span>{$vs[0]["title"]}
            <span class="number"><span>発注数</span><input type="number" name="number____{$vs[0]["code"]}____{$v["code"]}____sets" value="{$vs[0]["order"]}" class="stock-chk sets">SET</span>
          </h2>
        </header>
        <ul class="cont">
          {foreach from=$vs[0]["items"] key=key item=val}
            {if !empty($val[0]["name"])}
          <li class="stock-chk-item">
            <strong><span class="img"><img src="{_IMG_}{if !empty($val["img"])}{$val["img"]}{else}nowprinting.jpg{/if}"></span>{$val[0]["name"]}</strong>
            <ul class="detail">
              <li class="order"><span>{$val[0]["order"]}</span>{$val["order"]}{$form["unit"]["item"][$val[0]["unit"]]} </li>
              {if !empty($val[0]["day"])}
                <li class="day check on">日数</li>
              {/if}
              {if !empty($val[0]["person"])}
              <li class="person check on">人数</li>
              {/if}
              <span class="title" data-stock="{$val[0]["stock"]}"><span class="stock">在庫数</span>{$val[0]["stock"]}</span>
            </ul>
          </li>
            {/if}
          {/foreach}
        </ul>
      </div>
      {/if}
    {/foreach}
    {foreach from=$r["items"] key=ks item=vs}
      <div class="items">
        <header>
          <h2>
            <span class="ttl">単品商品</span>
            <span class="img"><img src="{_IMG_}{if !empty($vs[0]["img"])}{$vs[0]["img"]}{else}nowprinting.jpg{/if}"></span>
            <span class="title">{$vs[0]["name"]}</span>
            <span class="stock">在庫数{$vs[0]["stock"]}</span>
            {$vs[0]["title"]}
            <span class="number"><span>発注数</span><input type="number" name="number____{$vs[0]["code"]}____{$v["code"]}____items" value="{$vs[0]["order"]}" data-stock="{$vs[0]["stock"]}" class="stock-chk item">{$form["unit"]["item"][$vs[0]["unit"]]}</span>
          </h2>
        </header>
      </div>
    {/foreach}
  </div>
</article>
{/foreach}

<script>
$(function(){
});
</script>