{include file="head.tpl"}
{include file="header.tpl"}
{include file="User/nav.tpl"}


<div id="body">
  <div class="inner">
    <header>
      <h2><i class="fa fa-gift"></i>{$title}</h2>
    </header>
    <div id="SectionBody">
      <div class="widget-content" id="faq">
        {if !empty($faq)}
          {foreach from=$faq key=k item=v}
          <div class="box inner">
            <h3><i class="fa {$v["icon"]} icon"></i><span>{$v["title"]}</span><i class="fa fa-angle-down arrow" aria-hidden="true"></i></h3>
            <div class="cont">
              {foreach from=$v["item"] key=key item=val}
              <article>
                <h4><span>{$val["title"]}</span></h4>
                <p>{$val["contents"]}</p>
              </article>
              {/foreach}
            </div>

          </div>
          {/foreach}
        {/if}
      </div>
    </div>
  </div>
</div>

{include file="foot.tpl"}