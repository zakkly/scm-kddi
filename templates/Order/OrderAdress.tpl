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

      <div class="btnBox">
        <button class="btn green" id="groupSave" data-toggle="modal" data-target="#groupEditFormModal"><i class="fa fa-check"></i>新規登録</button>
        <button class="btn btn-warning reload" data-toggle="#FormArea" id="showCSV">CSVで登録する</button>
        <p class="btn download"><a href="{_BASE_URL_}/Order/OrderAdress?mode=download"><i class="fa fa-cloud"></i>CSVファイルをダウンロード</a></p>

      </div>
  
      <div id="FormArea">
        <p class="btn download"><a href="{_BASE_URL_}/Order/OrderAdress?mode=download"><i class="fa fa-cloud"></i>CSVファイルをダウンロード</a></p>
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
<input type="hidden" name="target" value="Address">
<input type="hidden" name="time" value="{$time}">
<input type="hidden" name="chk" value="">
<input type="hidden" name="token" value="{$smarty.session.token}">
<input type="hidden" name="action" value="up">
<input type="hidden" name="mode" value="new">
      </div>
  
  
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
        <tbody></tbody>
      </table>

      <ul class="pagination">
        <li class="prev"><a href="#" title="First"><i class="fa fa-angle-double-left"></i></a></li>
        <li class="next"><a href="#" title="Last"><i class="fa fa-angle-double-right"></i></a></li>
      </ul>
    </div>
  </div>
</div>



            
<div class="modal modal-info fade" id="groupEditFormModal" role="dialog">
  <div class="modal-dialog margin-md-top">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">配送先住所を編集する</h4>
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


<script>
  var ResultTarget = "table tbody";
  var templ = "TableAddress";
</script>
<script>
  $(function(){
    $(document).on("submit","form.register",function(){
      $("input").each(function(){
        if($(this).prop("disabled")){
          $(this).prop("disabled",false);
        }
      });
    });
    
    $("#search input").each(function(){
      if($(this).prop("disabled")){
        $(this).prop("disabled",false);
      }
    });
  });
</script>

<script src="//ajaxzip3.github.io/ajaxzip3.js"></script>
<script src="{_BASE_URL_}/js/OrderAdress.js"></script>
<script src="{_BASE_URL_}/js/upload.files.js"></script>
{include file="footer.tpl"}
{include file="foot.tpl"}