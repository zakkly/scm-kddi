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
      <div class="calOut">
        {$cal}
      </div>
    </div>
  </div>
</div>
<script src="{_BASE_URL_}/js/Holiday.js"></script>
{/if}
{include file="footer.tpl"}
{include file="foot.tpl"}