{include file="head.tpl"}
{include file="header.tpl"}
{include file="User/nav.tpl"}


<div id="body">
  <div class="inner">
    <header>
      <h2><i class="fa fa-gift"></i>{$title}</h2>
    </header>
    <div id="SectionBody">
{include file="Search.tpl"}

      <div class="btnBox">
        <button class="btn green" id="groupSave" data-toggle="modal" data-target="#groupEditFormModal"><i class="fa fa-check"></i>新規登録</button>
      </div>

      <div class="widget-table action-table">
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
      </div>
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
      			{if $smarty.session.role != "admin"}
      			{$_POST["Company"] = $smarty.session.Company}
      			{/if}
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
  var GroupId = {$smarty.session.role};
  $(function(){
    
  
    $(document).on("submit","form#searchForm",function(){
      $("input").each(function(){
        if($(this).prop("disabled")){
          $(this).prop("disabled",false);
          $(this).addClass("disabled");
        }
      });
      $("select").each(function(){
        if($(this).prop("disabled")){
          $(this).prop("disabled",false);
          $(this).addClass("disabled");
        }
      });
    });
  });

  $(document).on("submit","form.register",function(){
    $(this).find("input").prop("disabled",false);
    $("select").prop("disabled",false);
  });

  
  
  if(typeof GroupId != "undefined"){
    $("select[name=search_Company]").val(GroupId);
    $("select[name=search_Company]").prop("disabled",true);
    
    $("select[name=Company]").val(GroupId);
    $("select[name=Company]").prop("disabled",true);
  }
</script>

<script>
  var ResultTarget = "table tbody";
  var templ = "TableAddress";
</script>
<script src="//ajaxzip3.github.io/ajaxzip3.js"></script>
<script src="{_BASE_URL_}/js/OrderAdress.js"></script>
<script src="{_BASE_URL_}/js/upload.files.js"></script>

{include file="foot.tpl"}
{include file="footer.tpl"}