{include file="head.tpl"}
{include file="header.tpl"}
{include file="nav.tpl"}
<div id="body">
  <div class="inner">
    <header>
      <h2><i class="fa fa-heart"></i>{$title}</h2>
    </header>
    <div id="SectionBody">

      <fieldset id="search" class="search">
        <legend><i class="fa fa-search"></i>検索</legend>
        <form id="searchForm" class="clearfix">
        {foreach from=$itemForm key=k item=v}
          {if $v["search"] == 1 }
            {FormModeSwitch v=$v k=$k prefix="search"}
          {/if}
        {/foreach}
        <input type="hidden" name="target" value="Items">
        <button type="submit" class="btn green filterSearchBtn"><i class="fa fa-search"></i>検索</button>
        </form>
      </fieldset>

      <button class="btn green" id="groupSave" data-toggle="modal" data-target="#groupEditFormModal"><i class="fa fa-check"></i>新規登録</button>
      
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
      <input type="hidden" name="token" value="{$smarty.session.token}">
      <input type="hidden" name="action" value="{$actionVal}">
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

<script>
$(function(){
  var nowPos = 0;
  $(document).on("submit","fieldset#search",function(){
    var $form = $('#searchForm');
    var query = $form.serialize();
    var param = $form.serializeArray();
    //最大件数
    var num_rows = $("select[name=num_rows]").val();
    var urls = location.href+"?mode=search&"+query+"&num_rows="+num_rows+"&start="+nowPos*num_rows;
    
    $.getJSON(urls,function(d){
      console.log(d);
      $("table tbody").html("");
      $(d).each(function(i){
        var str = "";
        str += '<tr class="dataObj" data-code="'+d[i].code+'">';
        str += '  <td>'+d[i].name+'</td>';
        str += '  <td class="td-actions"><a href="javascript:;" class="btn btn-small btn-success" title="編集する" data-toggle="modal" data-target="#groupEditFormModal"><i class="btn-icon-only fa-pencil fa"> </i></a><a href="javascript:;" class="btn btn-danger btn-small" title="削除する"><i class="btn-icon-only fa fa-trash"> </i></a><input type="hidden" name="code" value="'+d[i]["code"]+'">';

        str += '  <fieldset>';
        $.each(d[i],function(k,v){
          str += '<input type="hidden" name="'+k+'" value="'+v+'">';
        });
        str += '  </fieldset>';
        str += '</td>'
        str += '</tr>';
        
        $("table tbody").append(str);
      });
      
      urls = urls+"&count=1"
      $.getJSON(urls,function(d){
        var num = Math.ceil(d["count"]/num_rows);
        $(".pagination li").each(function(){
          if(!$(this).hasClass("prev") && !$(this).hasClass("next")){
            $(this).remove();
          }
        });
        for(i=0;i<num;i++){
          var cls = "";
          if(nowPos == i){
            cls = " class='active'";
          }
          var html = "<li"+cls+"><a href='#' data-pos='"+i+"'>"+(i+1)+"</a></li>";
          var l = $(".pagination li").length -1;
          $(".pagination li").eq(l).before(html);
        }
      });
      
      
      $("#dummLoad").fadeOut("fast",function(){
        $("#dummLoad").remove();
      });

    });
    
    
    return false;
  });
  
  $("#search button[type=submit]").click();
  $(document).on("click",".pagination a",function(){
    nowPos = $(this).data("pos");
    $("#search button[type=submit]").click();
    return false;
  });
});
</script>

<style>
  #search{
    display: none;
  }
</style>

{include file="footer.tpl"}
{include file="foot.tpl"}