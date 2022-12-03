
  <!-- 
  {print_r($r)}
  -->
{foreach from=$r["adress"] key=ks item=vs}
<div class="OtherDetail">
  <article>
    <header class="h">
      <h1>{$vs["destination"]}</h1>
    <ul>
      <li>{$vs["pref"]}{$vs["add1"]}{$vs["add2"]}</li>
      <!--li>リードタイム{$vs["leadtime"]}日</li -->
    </ul>
    </header>
    <div class="body">
	    <input type="hidden" name="leadtime" value="{$vs["leadtime"]}">
  {foreach from=$OrderView key=k item=v}
    {if !empty($v["order"])}
      {assign var="key" value="`$k`____`$vs['code']`"}
      {$params = array($key,$v)}
      {if $smarty.post.demo ==1 }
        {if empty($v["demo"])}
        {FormModeSwitch v=$v k=$key}
        {/if}
      {else}
        {FormModeSwitch v=$v k=$key}
      {/if}
    {/if}
  {/foreach}
    </div>
  </article>
</div>
{/foreach}
