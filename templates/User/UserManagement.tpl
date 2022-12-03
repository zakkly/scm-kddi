{include file="head.tpl"}
{include file="header.tpl"}
{include file="User/nav.tpl"}


<div id="body">
  <div class="inner">
    <header>
      <h2><i class="fa fa-gift"></i>{$title}</h2>
    </header>
    <div id="SectionBody">
  
      <div class="widget-content">
        <form class="register" action="{$action}" method="post">
          {foreach from=$form key=k item=v }
              {FormModeSwitch v=$v k=$k d=$data}
          {/foreach}
          <input type="hidden" name="mode" value="edit">
          <input type="hidden" name="action" value="{$actionVal}">
          <input type="hidden" name="token" value="{$smarty.session.token}">
    			<div class="login-actions" style="clear: both; text-align: center;">
    				<button class="button btn btn-primary btn-large">保存する</button>
    			</div> <!-- .actions -->
        </form>
      </div>
    </div>
  </div>
</div>

  
<script>
  var GroupId = {$data.code};
  if(typeof GroupId != "undefined"){
    $("select[name=GroupIdList]").prop("disabled",false);
    //console.log(GroupId);
    $("select[name=GroupIdList]").val(GroupId);
    $("select[name=GroupIdList]").prop("disabled",true);
  }
  
  $(document).on("submit","form.register",function(){
    $("input").each(function(){
      if($(this).prop("disabled")){
        $(this).prop("disabled",false);
      }
    });
    $("select").each(function(){
      if($(this).prop("disabled")){
        $(this).prop("disabled",false);
      }
    });
    
    $("#search input").each(function(){
      if($(this).prop("disabled")){
        $(this).prop("disabled",false);
      }
    });
  });
</script>
{include file="foot.tpl"}