$(function(){
  /*
  var e = document.createElement("link");
  e.href = BaseUrls+"/css/RegisterSetForm.css";
  e.rel  = "stylesheet";
  $("head").append(e);*/
  
  var urls = location.href;
  console.log(urls);
  $(document).on("submit","fieldset#search",function(){
    var $form = $('#searchForm');
    var query = $form.serialize();
    var param = $form.serializeArray();
    //最大件数
    var num_rows = $("select[name=num_rows]").val();
    if(!nowPos){
      nowPos = 0;
    }
    var urls = BaseUrls+"/Search?action="+$("input[name=action]").val()+"&mode=search&"+query+"&num_rows="+num_rows+"&start="+nowPos*num_rows;
    console.log(urls);
    
    //ダミー用ローディングセット
    DummyLoadingSet();
    
    $.getJSON(urls,function(d){
      console.log(d);
      $("table tbody").html("");
      $(d).each(function(i){
        //console.log(d[i]);
        var str = "";
        str += '<tr class="dataObj" data-code="'+d[i]["code"]+'">';
        str += '  <td>'+(i+1)+'</td>';
        str += '  <td>'+d[i]["title"]+'</td>';
        if(d[i]["img"]){
          img = '<img src="'+ImgDir+"/"+d[i]["img"]+'">';
        }else{
          img = '<img src="'+ImgDir+'/nowprinting.jpg">';
        }
        str += '  <td class="img">'+img+'</td>';
        str += '  <td class="td-actions">';
        str += '    <a href="javascript:;" class="btn btn-success btn-small" title="編集する" data-code="'+d[i]["code"]+'"><i class="btn-icon-only fa-pencil fa"> </i></a><a href="javascript:;" class="btn btn-danger btn-small" title="削除する"><i class="btn-icon-only fa fa-trash"> </i></a><input type="hidden" name="code" value="'+d[i]["code"]+'">';
        str += '<fieldset>';
        $.each(d[i],function(k,v){
          if(k == "token"){
            return true;
          }
          str += '<input type="hidden" name="'+k+'" value="'+v+'">';
        });
        str += '</fieldset>';
        str += '</td>';

        
        $("tbody").append(str);
      });
      
      urls = urls+"&count=1"
      $.getJSON(urls,function(d){
        var num = Math.ceil(d["count"]/num_rows);
        console.log(urls);
        console.log(d);
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

    });
      
    $("#dummLoad").fadeOut("fast",function(){
      $("#dummLoad").remove();
    });
    return false;
  });

  
  $("#search button[type=submit]").click();
  
  $(document).on("click",".btn-success",function(){
    var code = $(this).data("code");
    //$.post( InsertSetUrls, 'data='+code );
    
    var e = document.createElement("form");
    e.action = InsertSetUrls;
    e.method = "post";
    e.id = "DummyForm";
    $("body").append(e);
    
    e = document.createElement("input");
    e.type = "hidden";
    e.name = "code";
    e.value = code;
    $("#DummyForm").append(e);
    
    e = document.createElement("input");
    e.type = "hidden";
    e.name = "token";
    e.value = $(document).find("input[name=token]").val();
    $("#DummyForm").append(e);
    
    e = document.createElement("input");
    e.type = "hidden";
    e.name = "mode";
    e.value = "edit";
    $("#DummyForm").append(e);
    
    console.log(InsertSetUrls);
    $("#DummyForm").append(e);
    $("#DummyForm").submit();
    return false;
  });
  
  
})