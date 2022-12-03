
var nowPos = 0;
$(function(){
  //css読み込み
  var e = document.createElement("link");
  e.href = BaseUrls+"/css/OrderInsert.css?"+t;
  e.rel  = "stylesheet";
  $("body").append(e);
  var e = document.createElement("form");
  e.name = "OrderInsert";
  e.action = BaseUrls+"/Admin/OrderInsert";
  $("body").append(e);
  
  
  //step設定
  var NowTabPos = 1;
  var Per = 100/$(".steps li").length;
  $(".progress-bar-success").width(NowTabPos*Per+"%");
  $(".tab-page").eq(0).fadeIn(300);
  
  
  $(document).on("click",".steps li a",function(){
    return false;
  });
  ScreenTransition(Templates);
  
  $(document).on("focus","input",function(e){
    if($(this).hasClass("danger")){
      $(this).removeClass("danger");
    }
  });
  
  $(document).on("focus","select",function(e){
    if($(this).hasClass("danger")){
      $(this).removeClass("danger");
    }
  });
  
  
  //検索タブ
  $(document).on("click","ul.tab li",function(){
    $("ul.tab li").removeClass("on");
    $("#SearchSection .search").removeClass("on");
    $(this).addClass("on");
    $("#SearchSection .search").eq($("ul.tab li").index(this)).addClass("on");
  });
  
  //fa-check-circle
  $(document).on("click","#SearchResult .items",function(){
    if($(this).hasClass("on")){
      $(this).removeClass("on");
      $(this).find("i").remove();
      $(this).find("input[type=checkbox]").prop("checked",false);
      
    }else{
      $(this).addClass("on");
      $(this).prepend('<i class="fa fa-check-circle"></i>');
      $(this).find("input[type=checkbox]").prop("checked",true);
    }
  });
  
  //複数選択可
  $(document).on("click",".widget-table td",function(){
    if($(this).parent().hasClass("on")){
      $(this).parent().removeClass("on");
      $(this).parent().find("input[type=checkbox]").prop("checked",false);
    }else{
      $(this).parent().addClass("on");
      $(this).parent().find("input[type=checkbox]").prop("checked",true);
    }
  });
  
  
  $(document).on("click",".button",function(){
    //戻る処理
    if($(this).hasClass("back")){
      console.log(NowTabPos);
      if(NowTabPos == 1){
        return false;
      }
      
      $("#calView").fadeOut("fast",function(){
        $("#calView").remove();
      });
      $(".steps li").eq(nowPos).removeClass("on");
      console.log(nowPos);
      $(".steps li").eq((nowPos-1)).removeClass("done");
      $(".steps li").eq(nowPos-1).addClass("on");
      
      NowTabPos--;
      nowPos--;
      
      $(".progress-bar-success").width(NowTabPos*Per+"%");
      
      $(this).parents().parent(".tab-page").fadeOut(300,function(){
        var str = $("#Hide"+NowTabPos).html();
        ResultTarget = $("#Hide"+NowTabPos).data("target");
        //console.log(ResultTarget);
        $(this).html(str);
        $(this).fadeIn();
      });
      return false;
    }
    
    //console.log(templ);
    if(nowPos == 0){
      $("#SearchResult .items").each(function(){
        if($(this).hasClass("on")){
          $(this).find("input[type=checkbox]").prop("checked",true);
        }
      });
      chk=[];
      $(this).parent().parent(".tabForm").find("input[name='items[]']:checked").each(function(){
        chk.push($(this).val());
        var e = document.createElement("input");
        e.name = $(this).attr("name");
        e.value = $(this).val();
        e.type = "hidden";
        $("#tab-" + NowTabPos).append(e);
      });
      $(this).parent().parent(".tabForm").find("input[name='sets[]']:checked").each(function(){
        chk.push($(this).val());
        var e = document.createElement("input");
        e.name = $(this).attr("name");
        e.type = "hidden";
        e.value = $(this).val();
        $("#tab-" + NowTabPos).append(e);
      });
      
      $(this).parent().parent(".tabForm").find("input[type=hidden]").each(function(){
        var e = document.createElement("input");
        e.name = $(this).attr("name");
        e.type = "hidden";
        e.value = $(this).val();
        $("#tab-" + NowTabPos).append(e);
      });
      
      var err;
      $(this).parent().parent(".tabForm").find("select").each(function(){
        //console.log($(this));
        if($(this).prop('required',true) && !$(this).val()){
          $(this).addClass("danger");
          err = 1;
        }else{
          var e = document.createElement("input");
          e.name = $(this).attr("name");
          e.value = $(this).val();
          e.type = "hidden";
          $("#tab-" + NowTabPos).append(e);
        }
      });
      if(!chk.length){
        window.alert("商品がなにも選択されていません");
        return false;
      }else if(err==1){
        window.alert("必須項目が選択されていません");
        return false;
      }
      
    }else if(nowPos == 1){
      $("table tbody").find("tr").each(function(){
        if($(this).hasClass("on")){
          $(this).find("td").eq(0).find("input").prop("checked",true);
        }
      });
      
      var chk =false;
      $("table tbody").find("input").each(function(){
        if($(this).is(':checked')){
          //console.log($(this).val());
          chk = true;
        }else if($(this).prop("checked")){
          //console.log($(this).val());
          chk = true;
        }else if($(this).parent("tr").hasClass("on")){
          //console.log($(this).html());
          chk = true;
        }
      });
      
      if(!chk){
        window.alert("配送先が1つも選択されていません");
        return false;
      }
    }else if(nowPos == 2){
      var chk = false;
      $("#NumhResult").find("input[type=number]").each(function(){
        if(!$(this).val()){
          $(this).addClass("danger");
          chk = true;
        }else{
          $(this).removeClass("danger");
        }
      });
      
      if(chk){
        window.alert("発注数を入力してください");
        return false;
      }
      
      var numChk = false;
      $(".append").remove();
      $(".alert-danger").removeClass("alert-danger");
      $(".stock-chk").each(function(){
        if($(this).hasClass("item")){
          if($(this).val() > $(this).data("stock")){
            $(this).parent().prev(".stock").addClass("alert-danger");
            $(this).parent().prev(".stock").append("<span style='color' class='append'>在庫数を超えています</span>");
            numChk = true;
          }
        }else if($(this).hasClass("sets")){
          var val = $(this).val()
          //console.log($(this).parents(".items.sets").html());
          $(this).parents(".items.sets").find(".stock-chk-item .title").each(function(){
            console.log(val);
            if(val > $(this).data("stock")){
              $(this).addClass("alert-danger");
              $(this).append("<span style='color' class='append'>在庫数を超えています</span>");
              numChk = true;
            }
          });
        }
      });
      if(numChk){
        //window.alert("発注数を入力してください");
        return false;
      }
      
    }
    
    //画面遷移ギミック
    $(this).parents().parent(".tab-page").fadeOut(300,function(){
      //if($(this).next(".tab-page").size()){
      if(Templates[nowPos]){
        $(".steps li").each(function(){
          if($(this).hasClass("on")){
            $(this).removeClass("on");
            $(this).addClass("done");
          }
        });
        
        
        //格納用fieldset
        if($("fieldset#form"+NowTabPos).size()){
          $("fieldset#form"+NowTabPos).remove();
        }
        
        var e = document.createElement("fieldset");
        e.id = "form"+NowTabPos;
        $("form[name=OrderInsert]").append(e);
        
        if(nowPos == 0){
          var __target = ".tab-page .tabForm";
        }else{
          var __target = ".tab-page";
        }
        //console.log(__target);
        $(__target).find("input").each(function(){
          var type = $(this).attr("type");
          var name = $(this).attr("name");
          var value = $(this).val();
          if($(this).parent().parent().parent().attr("class") == "hide"){
            return true;
          }
          //console.log(type+":::"+name+":::"+value);
          if(type == "checkbox"){
            if($(this).is(':checked')){
              var e = document.createElement("input");
              e.type = "hidden";
              e.name = name;
              e.value = value;
              $("#form"+NowTabPos).append(e);
            }
          }else{
            var e = document.createElement("input");
            e.type = "hidden";
            e.name = name;
            e.value = value;
            $("#form"+NowTabPos).append(e);
          }
        });
        
        $(__target).find("select").each(function(){
          var name = $(this).attr("name");
          var value = $(this).val();
          //console.log(name+"///"+value);
          if($(this).parent().parent().parent().attr("class") == "hide"){
            return true;
          }
          var e = document.createElement("input");
          e.type = "hidden";
          e.name = name;
          e.value = value;
          $("#form"+NowTabPos).append(e);
        });
        
        
        
        //戻る操作に備えてhtmlの中身をコピー
        if(!$("#Hide"+NowTabPos).size()){
          //console.log(ResultTarget);
          var e = document.createElement("div");
          e.id = "Hide"+NowTabPos;
          e.className = "hide";
          e.dataset.target = ResultTarget;
          $("body").append(e);
        }
        $("#Hide"+NowTabPos).html($(this).html());
        
        NowTabPos++;
        nowPos++
        
        
        $(".progress-bar-success").width(NowTabPos*Per+"%");
        ScreenTransition(Templates);
      }
    });
  });

});
  
function ScreenTransition(Templates){
  console.log(nowPos);
  if(Templates){
    var Templates = Templates[nowPos];
    f = BaseUrls+"/static/Order/Order.php";
    console.log(f);
    var obj = {};
    obj["templ"] = Templates[1];
    //console.log(obj);
    $.ajax(f,{
      type: 'post',
      data: obj,
      dataType: 'html'
    })
    .done(function(d){
      $(".tab-page").html("");
      $(".tab-page").html(d);
      $(".tab-page").fadeIn();
      $(".steps li").eq(nowPos).addClass("on");
      if(nowPos-1>0){
        $(".steps li").eq((nowPos-1)).addClass("done");
      }
      if(nowPos==4){
        $(".steps li").removeClass("on");
        $(".steps li").addClass("done");
      }
    })
    .fail(function(d){
      console.log(d);
    });
  }
}