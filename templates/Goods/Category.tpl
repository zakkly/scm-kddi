{include file="head.tpl"}
{include file="header.tpl"}
{include file="nav.tpl"}
<div id="body">
  <div class="inner">
    <header>
      <h2><i class="fa fa-gift"></i>{$title}</h2>
    </header>
    <div id="SectionBody">
        <div class="insert">
          <button class="btn green btn-success btn-small" id="groupSave" data-toggle="modal" data-target="#groupEditFormModal"><i class="fa fa-check"></i>新規登録</button>
          <fieldset>
            <input  type="hidden" name="name" value="">
            <input type="hidden" name="action" value="{$actionVal}">
            <input type="hidden" name="token" value="{$smarty.session.token}">
          </fieldset>
        </div>
        
        <div class="widget-table action-table">
{if $data}
          <table class="table table-striped table-bordered">
            <tr>
          {foreach from=$form key=k item=v}
              {if $v["need"] == 1}
              <th>{$v["name"]}</th>
              {/if}
          {/foreach}
              <th></th>
            </tr>
          {foreach from=$data key=k item=v}
            <tr class="dataObj" data-code="{$v["code"]}">
              {foreach from=$v key=key item=val}
                {if $form[$key]["need"] == 1}
                  <td>
                    <strong>{$val}
                      <span class="">
                        <span class="fc-event-skin btn-success btn btn-small" data-code="{$v["code"]}" data-toggle="modal" data-target="#CatgoryCompany">
                          対象企業を編集する
                        </span>
                        <fieldset>
                          {if !empty($v["Company"])}
                            {foreach from=$v["Company"] key=ks item=vs}
                            <input  type="hidden" name="Company" value="{$vs}">
                            {/foreach}
                          {/if}
                          <input  type="hidden" name="code" value="{$v["code"]}">
                          <input type="hidden" name="action" value="{$actionVal}">
                          <input type="hidden" name="token" value="{$smarty.session.token}">
                        </fieldset>
                      </span>
                    </strong>
                    {if !empty($v["item"])}
                      {foreach from=$v["item"] key=ks item=vs}
                        <span class="sub dataObj" data-code="{$vs["code"]}">
                          {$vs["name"]}　
                          <a href="javascript:;" class="btn btn-danger btn-small" title="削除する"><i class="btn-icon-only fa fa-trash"></i></a>
                          <input  type="hidden" name="code" value="{$vs["code"]}">
                        </span>
                      {/foreach}
                    {/if}
                  </td>
                {/if}
              {/foreach}
              <td class="td-actions">
                <a href="javascript:;" class="btn btn-small btn-success" title="編集する" data-toggle="modal" data-target="#groupEditFormModal"><i class="btn-icon-only fa-pencil fa"> </i></a>
                <a href="javascript:;" class="btn btn-danger btn-small" title="削除する"><i class="btn-icon-only fa fa-trash"></i></a>
                <a href="javascript:;" class="btn btn-edit btn-small" title="サブカテゴリ追加" data-toggle="modal" data-target="#groupEditFormModal"><i class="btn-icon-only fa fa-plus"></i></a>
                <fieldset>
                  {foreach from=$v key=key item=val}
                      <input type="hidden" name="{$key}" value="{$val}">
                  {/foreach}
                  <input type="hidden" name="action" value="{$actionVal}">
                  <input type="hidden" name="token" value="{$smarty.session.token}">
                </fieldset>
              </td>
            </tr>
          {/foreach}
          </table>
{/if}

        </div>
    </div>
  </div>
</div>


<div class="modal modal-info fade" id="CatgoryCompany" role="dialog">
  <div class="modal-dialog margin-md-top">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">企業を追加編集する</h4>
      </div>
      <div class="modal-body">
        <form class="register" action="{$action}" method="post">
          <div class="form-body">
      			<div class="login-fields">
        			{foreach from=$Company key=k item=v}
          			<label class="checkbox"><input type="checkbox" name="Company[]" value="{$v["code"]}">{$v["name"]}</label>
        			{/foreach}
      			</div>
            <input type="hidden" name="code" value="">
            <input type="hidden" name="action" value="{$actionVal}">
            <input type="hidden" name="token" value="{$smarty.session.token}">
      			<div class="login-actions">
      									
      				<button class="button btn btn-primary btn-large">保存する</button>
      				
      			</div> <!-- .actions -->
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

            
<div class="modal modal-info fade" id="groupEditFormModal" role="dialog">
  <div class="modal-dialog margin-md-top">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">{$title}を編集する</h4>
      </div>
      <div class="modal-body">
        <form class="register" action="{$action}" method="post">
          <div class="form-body">
      			<div class="login-fields">
            {foreach from=$form key=k item=v}
              {$params = array($k,$v)}
              {FormModeSwitch v=$v k=$k}
            {/foreach}
      			</div>
      			<div class="login-actions">
      									
      				<button class="button btn btn-primary btn-large">保存する</button>
      				
      			</div> <!-- .actions -->
    
          </div>
          <input type="hidden" name="code" value="">
          <input type="hidden" name="action" value="{$actionVal}">
          <input type="hidden" name="token" value="{$smarty.session.token}">
        </form>
      </div>
    </div>
  </div>
</div>


<script>
</script>
<script src="{_BASE_URL_}/js/Category.js?{$smarty.now|date_format:"%Y%m%d%H%M%S"}"></script>

{include file="footer.tpl"}
{include file="foot.tpl"}