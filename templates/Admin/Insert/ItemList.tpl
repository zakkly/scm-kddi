{if !empty($r)}
  {foreach from=$r key=k item=v}
    <article>
      <header>
        <h1><img src="{_IMG_}{if !empty($v["img"])}{$v["img"]}{else}nowprinting.jpg{/if}"></h1>
      </header>
      <div class="body">
        <h2>{$v["name"]}</h2>
        <div class="section-body">
          <ul>
          </ul>
        </div>
      </div>
      
      <input type="hidden" name="code" value="{$v["code"]}">
      <fieldset>
        {foreach from=$v key=key item=val}
        {if $key != "token"}
          <input type="hidden" name="{$key}" value="{$val}">
        {/if}
        {/foreach}
      </fieldset>
    </article>
  {/foreach}
{/if}