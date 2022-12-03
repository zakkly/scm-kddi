{include file="head.tpl"}
{include file="header.tpl"}
{include file="nav.tpl"}
<div id="body">
  <div class="inner">
    <header>
      <h2><i class="fa fa-heart"></i>ダッシュボード</h2>
    </header>

    <div class="widget ">
      <ul id="statusView">
      {foreach from=$status key=k item=v}
        <li><span>{$v}</span><span class="num"><em>件</em></span></li>
      {/foreach}
      </ul>
    </div>
    <div class="widget ">
      <div class="widget-header"> 
        <h3><i class="fa fa-user-circle"></i>お知らせ</h3>
      </div>
      <div class="widget-content">
        {if !empty($news)}
          <ul id="news">
          {foreach from=$news key=k item=v}
            <li><a href="javascript:void(0);" data-toggle="modal" data-target="#groupEditFormModal" data-code="{$v["code"]}"><strong>{$v["date"]}</strong><span>{$v["title"]}</span><em>{$v["contents"]}</em></a></li>
          {/foreach}
          </ul>
        {/if}
      </div>
    </div>
  </div>
</div>
{include file="foot.tpl"}