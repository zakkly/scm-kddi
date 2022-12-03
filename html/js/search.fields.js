$(function(){
  //var nowPos = 0;
  if(typeof nowPos === "undefined"){
    nowPos = 0;
  }
  
  $(document).on("submit","fieldset#search",function(){
    var $form = $('#searchForm');
    var query = $form.serialize();
    var param = $form.serializeArray();
    //最大件数
    var num_rows = $("select[name=num_rows]").val();
    var urls = BaseUrls+"/Search?action="+$("input[name=action]").val()+"&mode=search&"+query+"&num_rows="+num_rows+"&start="+nowPos*num_rows;
    console.log(urls);
    console.log(nowPos);
    //return false;
    
    $.getJSON(urls,function(d){
      //console.log(d);
      //console.log(urls);
      $("table tbody").html("");
      $(d).each(function(i){
        var str = "";
        str += '<tr class="dataObj" data-code="'+d[i]["id"]+'">';
        str += '  <td>'+d[i]["GroupIdListName"]+'</td>';
        str += '  <td>'+d[i]["email"]+'</td>';
        str += '  <td>'+d[i]["Department"]+'</td>';
        str += '  <td>'+d[i]["last_name"]+'</td>';
        str += '  <td>'+d[i]["first_name"]+'</td>';
        str += '  <td>'+d[i]["tel"]+'</td>';
        str += '  <td>'+d[i]["mobile"]+'</td>';
        str += '  <td class="td-actions"><a href="javascript:;" class="btn btn-small btn-success" title="編集する" data-toggle="modal" data-target="#groupEditFormModal"><i class="btn-icon-only fa-pencil fa"> </i></a><a href="javascript:;" class="btn btn-danger btn-small" title="削除する"><i class="btn-icon-only fa fa-trash"> </i></a><input type="hidden" name="code" value="'+d[i]["id"]+'">';
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
        //console.log(urls);
        //console.log(d);
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
});