{if !empty($r)}
  {foreach from=$r key=k item=v}
  <tr class="dataObj" data-code="{$v["code"]}">
    <td class="num">{$k+1}</td>
    <td class="code">{$v["code"]}</td>
    <td class="ItemNum">{$v["ItemNum"]}</td>
    <td class="img"><img src="{_IMG_}{if !empty($v["img"])}{$v["img"]}{else}nowprinting.jpg{/if}"></td>
    <td class="name">{$v["name"]}</td>
    <td class="stock">{$v["stock"]}</td>
    <td class="GroupIdList">
    {foreach from=$v["GroupIdList"] key=key item=val}
      <span class="viewBtn">{$val}</span>
    {/foreach}
    </td>
    <td class="category">
    {foreach from=$v["category"] key=key item=val}
      <span class="viewBtn">{$val}</span>
    {/foreach}
    </td>
    <td class="sub_category">
    {foreach from=$v["sub_category"] key=key item=val}
      <span class="viewBtn">{$val}</span>
    {/foreach}
    </td>
    <td class="td-actions">
      <a href="javascript:;" class="btn btn-success pencil" title="編集する" data-code="{$v["code"]}" data-toggle="modal" data-target="#groupEditFormModal"><i class="btn-icon-only fa-pencil fa"> </i></a>
      <a href="javascript:;" class="btn btn-danger btn-small" title="削除する"><i class="btn-icon-only fa fa-trash"> </i></a>
      <input type="hidden" name="code" value="{$v["code"]}">
      
        <fieldset>
          {foreach from=$v key=key item=val}
          {if $key != "token"}
            <input type="hidden" name="{$key}" value="{$val}">
          {/if}
          {/foreach}
        </fieldset>
    </td>
  </tr>
  {/foreach}
{/if}