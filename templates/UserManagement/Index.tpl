{include file="head.tpl"}
{include file="header.tpl"}
{include file="nav.tpl"}
<div id="body">
  <div class="inner">
    <header>
      <h2><i class="fa fa-heart"></i>{$title}</h2>
    </header>
    <div id="SectionBody">
{include file="Search.tpl"}


{if $errorMsg!=""}
      <div class="alert alert-danger display-hide">
          <button class="close" data-close="alert"></button> {$errorMsg}
      </div>
{elseif !empty($_SESSION["result"])}
      <div class="alert alert-success display-hide">
          <button class="close" data-close="alert"></button> 編集が成功しました
      </div>
{/if}


      <button class="btn green" id="groupSave" data-toggle="modal" data-target="#groupEditFormModal"><i class="fa fa-check"></i>新規登録</button>

      <div class="widget-table action-table">
{if $data}
        <table class="table table-striped table-bordered">
          <thead>
          <tr>
        {foreach from=$form key=k item=v}
            {if $v["view"] == 1}
            <th>{$v["name"]}</th>
            {/if}
        {/foreach}
            <th></th>
          </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
{/if}
        <ul class="pagination">
          <li class="prev"><a href="#" title="First"><i class="fa fa-angle-double-left"></i></a></li>
          <li class="next"><a href="#" title="Last"><i class="fa fa-angle-double-right"></i></a></li>
        </ul>
      </div>

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
      </form>
    </div>
  </div>
</div>


<script src="{_BASE_URL_}/js/search.fields.js"></script>
{include file="footer.tpl"}
{include file="foot.tpl"}