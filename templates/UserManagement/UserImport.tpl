{include file="head.tpl"}
{include file="header.tpl"}
{include file="nav.tpl"}
<div id="body">
  <div class="inner">
    <header>
      <h2><i class="fa fa-heart"></i>{$title}</h2>
    </header>
    <div class="widget-content">
      <p class="download btn btn-warning"><a href="{_BASE_URL_}/UserManagement/GetTemplate"><i class="fa fa-cloud"></i>CSVファイルをダウンロード</a></p>

                
      <div class="comment">
      </div>
      <div id="FormArea">
        <div class="alert alert-danger display-hide" style="display: none">
            <button class="close" data-close="alert"></button><p>{$errorMsg}</p>
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
          <progress value="0" id="prog" max=100></progress>(<span id="pv">0</span>%)
        </div>
        <div class="log"></div>
        <div id="files" class="files"></div>
<input type="hidden" name="target" value="users">
<input type="hidden" name="time" value="{$smarty.now}">
<input type="hidden" name="chk" value="">
<input type="hidden" name="token" value="{$smarty.session.token}">
<input type="hidden" name="action" value="up">
<input type="hidden" name="mode" value="new">
      </div>
    </div>
  </div>
</div>

<link rel="stylesheet" href="{_BASE_URL_}/css/UserImport.css">
<script src="{_BASE_URL_}/js/upload.files.js?{$t}"></script>
<script>
  $("#FormArea").show();
</script>
{include file="footer.tpl"}
{include file="foot.tpl"}