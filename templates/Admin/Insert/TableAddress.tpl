
      <tr data-add="{$smarty.post.d["destination"]} [{$smarty.post.d["pref"]}+{$smarty.post.d["add1"]}{$smarty.post.d["add2"]}]" data-code='{$smarty.post.d["code"]}' class="dataObj">
        <td style="display:none;"><input type="checkbox" name="adress[]" value='{$smarty.post.d["code"]}'></td>
        <td>{$smarty.post.d["CompanyName"]}</td>
        <td>{$smarty.post.d["Adress_Code"]}</td>
        <td>{$smarty.post.d["destination"]}</td>
        <td>{$smarty.post.d["zip"]}</td>
        <td>{$smarty.post.d["pref"]}</td>
        <td>{$smarty.post.d["add1"]}</td>
        <td>{$smarty.post.d["add2"]}</td>
        <td>
          {for $i=1 to 3}
            {$key = "tel$i"}
            {$smarty.post.d[$key]}
            {if $i<3}
              -
            {/if}
          {/for}
        </td>
        <td>
          {if !empty($smarty.post.search)}
      <a href="javascript:;" class="btn btn-success btn-small" title="編集する" data-code="{$smarty.post.d["code"]}" data-toggle="modal" data-target="#groupEditFormModal"><i class="btn-icon-only fa-pencil fa"> </i></a>
      <a href="javascript:;" class="btn btn-danger btn-small" title="削除する"><i class="btn-icon-only fa fa-trash"> </i></a><input type="hidden" name="code" value="{$smarty.post.d["code"]}">
      
        <fieldset>
          {foreach from=$smarty.post.d key=key item=val}
          {if $key != "token"}
            <input type="hidden" name="{$key}" value="{$val}">
          {/if}
          {/foreach}
        </fieldset>

          {/if}
        </td>
      </tr>