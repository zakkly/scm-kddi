
<tr data-code="{$smarty.post.d.code}" data-toggle="modal" data-target="#groupEditFormModal" class="modalOpen">
{foreach from=$OrderView key=k item=v}
  {if $k=="status"}
    <td><span class="status status{$smarty.post.d.status_type}">{$smarty.post.d.$k}</span></td></td>
  {elseif !empty($v["targetKey"])}
    {$val = $v["targetKey"]}
    <td>{$smarty.post.d.$val}</td>
  {else}
    <td>{$smarty.post.d.$k}</td>
  {/if}
{/foreach}
</tr>