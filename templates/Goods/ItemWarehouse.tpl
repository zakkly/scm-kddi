{include file="head.tpl"}
{include file="header.tpl"}
{if $smarty.session.role != "admin"}
表示権限がありません
{else}
{include file="nav.tpl"}
<div id="body">
  <div class="inner">
    <header>
      <h2><i class="fa fa-gift"></i>{$title}</h2>
    </header>
    <div id="SectionBody">
{include file="Search.tpl"}

      
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
      {foreach from=$itemForm key=k item=v}
        <th>{$v["name"]}</th>
      {/foreach}
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
      <input type="hidden" name="token" value="{$smarty.session.token}">
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
        <h4 class="modal-title">入庫する</h4>
      </div>
    </div>
    <div class="modal-body">
      <form class="register" action="{_BASE_URL_}/{$action}" method="post">
        <p style="float: left;  margin-right:15px;"><img src="" width="150px;"></p>
        <div class="field tex name">
          <label for="email">商品名:</label>
          <span style="font-weight: bold;"></span>
        </div>
        <div class="field text stock">
          <label for="email">現在の在庫数:</label>
          <span style="font-weight: bold;"></span>
        </div>
        <div class="field text">
          <label for="email">入庫数:</label>
          <input type="number" id="stock" name="stock" value="" placeholder="入個数" class="login" required="required">
        </div>
        <input type="hidden" name="mode" value="">
        <input type="hidden" name="code" value="">
        <input type="hidden" name="action" value="{$action}">
        <input type="hidden" name="token" value="{$smarty.session.token}">
  			<div class="login-actions submit">
  				<button class="button btn btn-primary btn-large">保存する</button>
  			</div> <!-- .actions -->
      </form>
    </div>
  </div>
</div>


<script>
  var InsertSetUrls = 'https://new.backslogistic.com/Goods/ItemRegister';
  var templ = "ItemTable";
  var ResultTarget = "table tbody";
  var nowPos;
  
  $(document).on("click",".pencil",function(){
    var fieldset = $(this).parent().find("fieldset");
    var __code = fieldset.find("input[name=code]").val();
    var __name = fieldset.find("input[name=name]").val();
    var __stock = fieldset.find("input[name=stock]").val();
    var __img = fieldset.find("input[name=img]").val();
    if(!__img){
      __img = "nowprinting.jpg";
    }
    $(".modal-body").find(".name span").html(__name);
    $(".modal-body").find(".stock span").html(__stock);
    $(".modal-body").find("input[name=code]").val(__code);
    $(".modal-body").find("input[name=mode]").val("Warehouse");
    $(".modal-body").find("input[name=action]").val("{$action}");
    $(".modal-body").find("img").attr("src",ImgDir+__img);
  });
</script>
{/if}
{include file="foot.tpl"}