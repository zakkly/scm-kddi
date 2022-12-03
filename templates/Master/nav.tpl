




<nav>
  <div class="inner">
    <ul class="mainnav">
{if !empty($nav)}
  {foreach $nav key=$k item=$v}
      <li class="nav {$k}">
        {if !empty($v["link"])}<a href="{_BASE_URL_}{$v["link"]}">{/if}<i class="fa {$v["icon"]}"></i>{$v["name"]}{if !empty($v["link"])}</a>{/if}
        {if !empty($v["item"])}
          <ul class="submenu">
          {foreach $v["item"] key=$ks item=$vs}
            <li class="nav-item">{if !empty($v["link"])}<a href="{_BASE_URL_}{$vs["link"]}">{/if}{$vs["name"]}{if !empty($v["link"])}</a>{/if}</li>
          {/foreach}
          </ul>
        {/if}
      </li>
      
  {/foreach}
{/if}
    </ul>
  </div>
</nav>
