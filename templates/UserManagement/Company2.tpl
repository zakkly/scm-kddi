{include file="head.tpl"}
{include file="header.tpl"}
{include file="nav.tpl"}
<div id="body">
  <div class="inner">
    <header>
      <h2><i class="fa fa-heart"></i>{$title}</h2>
    </header>
  
    <div id="SectionBody">
      <div class="btnBox">
        <button class="btn green" id="groupSave" data-toggle="modal" data-target="#groupEditFormModal"><i class="fa fa-check"></i>新規登録</button>
        <button class="btn btn-warning reload" data-toggle="#FormArea" id="showCSV">CSVで登録する</button>
      </div>

      <div id="FormArea">
        <p class="btn download"><a href="{_BASE_URL_}/UserManagement/Company?mode=download"><i class="fa fa-cloud"></i>CSVファイルをダウンロード</a></p>
        <div class="alert alert-danger display-hide" style="display: none">
            <button class="close" data-close="alert"></button><p></p>
        </div>
        <div class="alert alert-success display-hide" style="display: none">
            <button class="close" data-close="alert"></button> 登録が成功しました
        </div>
        <div id="drag-area" class="">
          アップロードするファイルをドロップ
        </div>
        <a href="#" onclick="location.reload();return false;" class="btn btn-warning reload">Cancel</a>
        
        <div id="progress" class="progress">
          ファイルアップロード
          <progress value="0" id="prog" max="100"></progress>(<span id="pv">0</span>%)
        </div>
        <div class="log"></div>
        <div id="files" class="files"></div>
<input type="hidden" name="target" value="Company">
<input type="hidden" name="time" value="{$time}">
<input type="hidden" name="chk" value="">
<input type="hidden" name="token" value="{$smarty.session.token}">
<input type="hidden" name="action" value="up">
<input type="hidden" name="mode" value="new">
      </div>
  
  
  
  
      <div class="widget-table action-table">
{if $data}
      <table class="table table-striped table-bordered">
        <tr>
          <th>会社コード</th>
      {foreach from=$form key=k item=v}
          {if $v["need"] == 1}
          <th>{$v["name"]}</th>
          {/if}
      {/foreach}
          <th></th>
        </tr>
      {foreach from=$data key=k item=v}
        <tr class="dataObj" data-code="{$v["code"]}">
              <td>{$v["code"]}</td>
          {foreach from=$v key=key item=val}
            {if $form[$key]["need"] == 1}
              <td>{$val}</td>
            {/if}
          {/foreach}
          <td class="td-actions">
            <a href="javascript:;" class="btn btn-small btn-success" title="編集する" data-toggle="modal" data-target="#groupEditFormModal"><i class="btn-icon-only fa-pencil fa"> </i></a><a href="javascript:;" class="btn btn-danger btn-small" title="削除する"><i class="btn-icon-only fa fa-trash"> </i></a>
            <input  type="hidden" name="code" value="{$v["code"]}">
            <fieldset>
              {foreach from=$v key=key item=val}
                  <input type="hidden" name="{$key}" value="{$val}">
              {/foreach}
            </fieldset>
          </td>
        </tr>
      {/foreach}
      </table>
{/if}


    </div>
  </div>
</div>

<div class="modal modal-info fade" id="groupEditFormModal" role="dialog">
  <div class="modal-dialog margin-md-top">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">編集する</h4>
      </div>
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

<script src="{_BASE_URL_}/js/OrderAdress.js"></script>
<script src="{_BASE_URL_}/js/upload.files.js"></script>

{include file="footer.tpl"}
{include file="foot.tpl"}