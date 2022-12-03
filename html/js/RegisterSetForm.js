$(function(){
  var e = document.createElement("link");
  e.href = BaseUrls+"/css/RegisterSetForm.css";
  e.rel  = "stylesheet";
  $("head").append(e);
  
  var urls = location.href;
  console.log(urls);
  var nowPos = 0;
  
  $(document).on("submit","fieldset#search",function(){
    var $form = $('#searchForm');
    var query = $form.serialize();
    var param = $form.serializeArray();
    //最大件数
    var num_rows = 20;
    var urls = location.href+"?mode=search&"+query+"&num_rows="+num_rows+"&start="+nowPos*num_rows;
    var urls = BaseUrls+"/Search?action="+$("input[name=action]").val()+"&mode=search&"+query+"&num_rows="+num_rows+"&start="+nowPos*num_rows;
    
    console.log(urls);
    //DummyLoadingSet();
    
    
    var numArr = [];
    $.getJSON(urls,function(d){
      //console.log(d);
      $("#searchResult").html("");
      $(d).each(function(i){
        var str = "";
        str += '<div class="items">'
        if(d[i]["img"]){
          img = '<img src="'+ImgDir+"/"+d[i]["img"]+'">';
        }else{
          img = '<img src="'+ImgDir+'/nowprinting.jpg">';
        }
        str += '<div class="img">'+img+'</div>';
        str += '<div class="name">'+d[i]["name"]+'</div>';
        str += '<div class="stock">';
        str += '  <div class="num"><span>関東</span>'+d[i]["stock3"]+'</div>';
        str += '  <div class="num"><span>東北</span>'+d[i]["stock2"]+'</div>';
        str += '  <div class="num"><span>北海道</span>'+d[i]["stock"]+'</div>';
        str += '  <div class="num"><span>中部</span>'+d[i]["stock4"]+'</div>';
        str += '</div>';
        str += '<div class="comment">'+d[i]["comment"]+'</div>';
        str += '<div class="number"><input type="number" name="order_____'+d[i]["code"]+'" data-max="'+d[i]["stock"]+'"></div>';
        str += '<div class="day check"><input type="checkbox" name="day_____'+d[i]["code"]+'" value=1>日数</div>';
        str += '<div class="person check"><input type="checkbox" name="person_____'+d[i]["code"]+'" value=1>人数</div>';

        str += '<div class="delete"><button type="button" class="btn btn-outline btn-circle dark btn-sm black"><i class="fa fa-trash-o"></i> 削除 </button></div>';
        str += '<input type="hidden" name="items[]" value="'+d[i]["code"]+'" class="hidden">'
        str += '</div>';
        
        $("#searchResult").append(str);
      })
    });
    $("#dummLoad").fadeOut("fast",function(){
      $("#dummLoad").remove();
      $("input[type='number']").each(function(){
        var maxNum = $(this).data("max");
        $($(this)).TouchSpin({
            min: 0,
            max: maxNum,
            step: 1,
            boostat: 5,
            maxboostedstep: 10,
        });
      });
    });
    return false;
  });
  
  if($("#EditValue").size()){
    $("#EditValue .items").each(function(){
      var d = {};
      $(this).find("input").each(function(){
        d[$(this).attr("name")] = $(this).val();
      });
      
      var str = "";
      str += '<div class="items">'
      if(d["img"]){
        img = '<img src="'+ImgDir+"/"+d["img"]+'">';
      }else{
        img = '<img src="'+ImgDir+'/nowprinting.jpg">';
      }
      str += '<div class="img">'+img+'</div>';
      str += '<div class="name">'+d["name"]+'</div>';
      str += '<div class="num"><span>在庫数</span>'+d["stock"]+'</div>';
      str += '<div class="comment">'+d["comment"]+'</div>';
      str += '<div class="number"><input type="number" name="order____'+d["code"]+'" value="'+d["order"]+'" data-max="'+d["stock"]+'"></div>';
      var cls = chk = "";
      if(d["day"] == 1){
        cls = " on";
        chk = " checked";
      }
      str += '<div class="day check'+cls+'"><input type="checkbox" name="day____'+d["code"]+'" value=1'+chk+'>日数</div>';
      var cls = chk = "";
      if(d["person"]){
        cls = " on";
        chk = " checked";
      }
      str += '<div class="person check'+cls+'"><input type="checkbox" name="person____'+d["code"]+'" value=1'+chk+'>人数</div>';
      str += '<div class="delete"><button type="button" class="btn btn-outline btn-circle dark btn-sm black"><i class="fa fa-trash-o"></i> 削除 </button></div>';
      str += '<input type="hidden" name="items[]" value="'+d["code"]+'" class="hidden">'
      str += '</div>';
      console.log(d);
      $("#ItemsSet").append(str);
    });
    $("#ItemsSet").append("<input type='hidden' name='mode' value='editRegister'>");
    //$("#ItemsSet").append(str);
  }
  
  //fa-check-circle
  $(document).on("click","#searchResult .items",function(){
    $(this).addClass("on");
    $(this).prepend('<i class="fa fa-check-circle"></i>');
  });
  
  $(document).on("click",".modal .submit button",function(){
    $("#searchResult .items").each(function(){
      if($(this).hasClass("on")){
        $("#ItemsSet").append($(this));
      }
    });
    $('.modal').modal('hide');
  });
  
  $(document).on("click","#ItemsSet .check",function(){
    if($(this).hasClass("on")){
      $(this).removeClass("on");
      $(this).find("input[type=checkbox]").prop("checked",false);
    }else{
      $(this).addClass("on");
      $(this).find("input[type=checkbox]").prop("checked",true);
    }
  });
  
  $("#search button[type=submit]").click();
})