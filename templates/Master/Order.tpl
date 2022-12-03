{include file="head.tpl"}
{include file="header.tpl"}
{include file="User/nav.tpl"}


<div id="body">
  <div class="inner">
    <header>
      <h2><i class="fa fa-gift"></i>{$title}</h2>
    </header>
    <div id="SectionBody">
      <div class="widget-content">
        <ul class="nav nav-pills nav-justified steps">
          {foreach from=$steps key=k item=v}
          {$n = $k+1}
          <li class="step_tab{$n}">
            <a href="#tab{$n}" data-toggle="tab" class="step">
              <span class="number"> {$n} </span>
              <span class="desc">{$v["title"]}</span>
            </a>
          </li>
          {/foreach}
      </ul>

      <div id="bar" class="progress progress-striped" role="progressbar">
          <div class="progress-bar progress-bar-success"> </div>
      </div>
      
      <div class="tab-page">
      </div>
      <!--
      -->
        <form class="register">
          <input type="hidden" name="title" value="{uniqid()}">
          <input type="hidden" name="action" value="{$smarty.session.token}">
          <input type="hidden" name="user" value="{$smarty.session.user}">
          <input type="hidden" name="token" value="{$smarty.session.token}">
        </form>
      </div>
    </div>
  </div>
</div>



<script>
  var Demo =[ 
{foreach from=$form["demo"]["item"] key=k item=v}
  '{$v}',
{/foreach}
  ];  
  var Templates =[ 
{foreach from=$steps key=k item=v}
{$arr = implode("','",$v)}
  ['{$arr}'],
{/foreach}
  ];
  //var templ = "items";
  //var ResultTarget = "SearchResult";
  var Unit =[ 
{foreach from=$form["unit"]["item"] key=k item=v}
  '{$v}',
{/foreach}
  ];
  var GroupId = {$smarty.session.role};
</script>
<script src="{_BASE_URL_}/js/User/user.js?{$t}"></script>
<script src="{_BASE_URL_}/js/OrderInsert.js?{$t}"></script>
<link rel="stylesheet" href="{_BASE_URL_}/css/OrderInsert.css">

{include file="foot.tpl"}
{include file="footer.tpl"}