var t = new Date().getTime();
var nowPos;

$(function(){
  var now = "/"+location.href+"/";
  //グローバルナビゲーション
  $(".mainnav li").each(function(){
    $(this).removeClass("active");
    var anc = $(this).find("a").attr("href");
    if(anc.match(now)){
      $(this).addClass("active");
    }
  });
  
  $("#news li a").click(function(){
    var code = $(this).data("code");
    var title = $(this).find("span").html();
    var text = $(this).find("em").html();
    $(".modal-header").html(title);
    $(".modal-body").html(text);
    console.log(code);
  });
  
  
  
  var target = "";
  
  //カレンダー処理
  $(document).on("focus","input.date",function(e){
    if(!$("#calView").size()){
      var e = document.createElement("div");
      e.id = "calView";
      e.className = "arrow_box";
      if($(this).hasClass("modalInner")){
        $("#OrderDetails").append(e);
        pospos = 1;
      }else{
        $("body").append(e);
      }
    }
    var topOffset =  $(this).offset().top+$(this).height()+20;
    if($(this).hasClass("modalInner")){
      var leftOffset = $("#OrderDetails").offset().left;
    }else{
      var leftOffset = $(this).offset().left;
    }
    
    var leadtime = $(this).parents(".body").find("input[name=leadtime]").val();
    console.log(leadtime);
    
    var f = BaseUrls+"/static/Cal.php?leadtime="+leadtime;
    console.log(f);
    $.ajax(f,{
      type: 'get',
      dataType: 'html'
    })
    .done(function(d){
      $("#calView").html(d);
      $("#calView").css({"top":topOffset+"px","left":leftOffset+"px"})
    });
    
    target = $(this).attr("id");
  
	  $(document).on("click","body",function(){
		    /*$("#calView").fadeOut("fast",function(){
		      $("#calView").remove();
		    });*/
	  });
  });

  //カレンダーエラー処理
  $(document).on("click","#calView dl",function(){
    if($(this).hasClass("past")){
      window.alert("過去の日付は選択できません");
      return false;
    }
    if($(this).hasClass("out")){
      window.alert("選択できない日付です");
      return false;
    }
    var date = $(this).data("date");
    $("#"+target).val(date);
    $("#calView").fadeOut("fast",function(){
      $("#calView").remove();
    });
  });
  
  //カレンダー 翌月遷移処理
  $(document).on("click","#calView li",function(){
    var ymd = $(this).data("ymd");
    var f = BaseUrls+"/static/Cal.php?ymd="+ymd;
    $.ajax(f,{
      type: 'get',
      dataType: 'html'
    })
    .done(function(d){
      $("#calView").html(d);
    });
  });
  
  //ステータス管理
  if($("#statusView").size()){
    urls = BaseUrls+"/static/Order/Index.php";
    //非同期通信実行
    $.ajax({
      url: urls,
      timeout:10000,
    })
    .done(function(d){
      $(d).each(function(i){
        $("#statusView li").eq(i).find("span.num").prepend(d[i]);
      });
    });
  }
  
  $(document).on("click","#statusView li",function(){
    console.log($('#statusView li').index(this));
    //フォームを作る
    var e = document.createElement("form");
    e.name = "search";
    e.method = "post";
    e.action = BaseUrls+"/Order/Index";
    $("body").append(e);
    var e = document.createElement("input");
    e.name = "status";
    e.type = "hidden";
    e.value = $('#statusView li').index(this);
    $("form[name=search]").append(e);
    $("form[name=search]").submit();
  });
  
  //モーダルウインドウCLOSE時はデータを空にする
  $(".modal").on('hide.bs.modal',function (){
    $(this).find("input").each(function(){
      var name = $(this).attr("name");
      if($(this).attr("type") == "checkbox"){
        var n = $(this).attr("name").split("[]");
        $(this).attr("name",n[0]);
        $(this).prop("checked",false);
      }else{
        if(name != "token"){
          $(this).val("");
        }
      }
    });
    if($(this).find(".insertImg")){
      $(this).find(".insertImg").remove();
    }
	});
  
  $(document).on("click",".btn.btn-small",function(){
    if($(this).data("target") == "#CatgoryCompany"){
      return false;
    }
    var code = $(this).parent().find("input[type=hidden]").val();
    var urls = location.href;
    //console.log(urls);
    if($(this).hasClass("btn-success")){
      //console.log($(this).attr("class"));
      //編集ルート
      if($(this).parent().find("fieldset")){
        $($(this).parent().find("fieldset input")).each(function(){
          //チェックボックス対策
          var chkname = $(this).attr("name");
          var chkval = $(this).val();
          console.log(chkname);
          
          $(".modal form").find("input").each(function(){
            if($(this).attr("type") == "checkbox"){
              //console.log(chkval+"//"+$(this).val());
              if($(this).val() == chkval){
                $(this).prop('checked',true);
              }
            }else if($(this).attr("type") == "radio"){
               //$('input:radio[name="'+chkname+'"]:checked').val([chkval]);
               if($(this).attr("name") == chkname && $(this).val() == chkval){
                 console.log(chkval);
                 console.log(chkname);
                 $(this).prop("checked",true);
               }
            }else{
              if(chkname == $(this).attr("name")){
                $(this).val(chkval);
              }
            }
          });
          $(".modal form").find("select").each(function(){
            //console.log("disabled");
            if(typeof GroupId != "undefined" && $(this).prop('disabled')){
              $(this).prop("disabled","false");
              disabled_chk = 1;
              //console.log("disabled");
            }
            if(chkname == $(this).attr("name")){
              $(this).val(chkval);
            }else if($(this).attr("id") == chkname){
              $(this).val(chkval);
              if(chkname == "GroupIdList"){
                GroupIdListChange(chkval);
              }
            }
          });
          $(".modal form").find("radio").each(function(){
            console.log(chkval);
            console.log(chkname);
          });
          $(".modal form").find("textarea").each(function(){
            if(chkname == $(this).attr("name")){
              console.log(chkval);
              chkval = chkval.replace(/<br \/>/g, "\n");
              $(this).val(chkval);
            }
          });
          $(".modal form").find(".field.image label").each(function(){
            if(chkval){
              img = '<img src="'+ImgDir+"/"+chkval+'" style="width:100px;display:inline-block;" class="insertImg">';
            }else{
              img = '<img src="'+ImgDir+'/nowprinting.jpg" style="width:100px;display:inline-block;" class="insertImg">';
            }
            if(chkname == $(this).attr("for")){
              $(this).after(img);
              var e = document.createElement("input");
              e.type = "hidden";
              e.name = "img";
              e.value = chkval;
              $(this).after(e);
            }
          });
          
          if(chkname == "items"){
          
          }
        });
        var e = document.createElement("input");
        e.type = "hidden";
        e.name = "mode";
        e.value = "edit";
        $(".modal form").append(e);
        $(".modal form").find("input[type=checkbox]").each(function(){
          $(this).attr("name",$(this).attr("name")+"[]");
        });
      }
      
    }else if($(this).hasClass("btn-edit")){
      var e = document.createElement("input");
      e.type = "hidden";
      e.name = "parent";
      e.value = code;
      $(".modal form").append(e);
      
    }else if($(this).hasClass("btn-danger")){
      //削除ルート
      console.log(code);
      var obj = {
        "mode" : "delete",
        "type" : "ajax",
        "code" : code,
        "ids" : $(this).data("code"),
        "action": $(document).find("input[name=action]").val(),
        "token": $(document).find("input[name=token]").val(),
      };
      console.log(urls);
      console.log(obj);
    
    
      //非同期通信実行
      $.ajax({
        url: urls,
        type:"post",
        data:obj,
        timeout:10000,
      })
      .done(function(d){
        console.log("success");
        console.log(obj);
        console.log(d);
        if(obj["mode"] == "delete"){
          $(".dataObj").each(function(){
            if($(this).data("code") == obj["code"]){
              $(this).fadeOut();
            }
          });
        }
      })
      .fail(function(d){
        console.log("faiol");
        console.log(d);
      });
    }
    
    //console.log(obj);
  });
  
  
  
  $("#GroupIdList").change(function(){
    if($(this).val()){
      GroupIdListChange($(this).val(),"category");
    }
  });
  $("#search_GroupIdList").change(function(){
    if($(this).val()){
      GroupIdListChange("search_"+$(this).val(),"search_category");
    }
  });
  
  $("#category").change(function(){
    if($(this).val()){
      categoryChange($(this).val(),"sub_category");
    }
  });
  
  //編集など初期時に実行
  $(".register select.rendered").each(function(){
    var ids = $(this).attr("id");
    if($(this).val()){
      if(ids == "GroupIdList"){
        GroupIdListChange($(this).val(),"category");
      }else if(ids == "category"){
        GroupIdListChange($(this).val(),"sub_category");
      }
    }
  });
  
	//ページネーション処理
  $(document).on("click",".pagination a",function(){
    nowPos = $(this).data("pos");
    console.log(nowPos);
    $(".search button[type=submit]").click();
    return false;
  });
  
  
  
  //検索ボタンを押したら処理に入る
  $(document).on("submit",".search",function(){
    if(typeof ResultTarget == "undefined"){
      return false;
    }
//    console.log(ResultTarget);
    
    //disabledの処理
    if(typeof GroupId != "undefined"){
      $("select[name=search_GroupIdList]").each(function(){
        $(this).prop("disabled",false);
      });
      $("select[name=Company]").prop("disabled",false);
    }
    //初期化
    var $form = $(this).find('form');
    //return false;
    var query = $form.serialize();
    var param = [];
    $.each($form.serializeArray(), function() {
      param[this.name] = this.value;
    });
    //最大件数
    var num_rows = $("select[name=num_rows]").val();
    if(!nowPos){
      nowPos = 0;
    }
    if(typeof GroupId != "undefined"){
      $("select[name=search_GroupIdList]").each(function(){
        $(this).prop("disabled",true);
      })
      $("select[name=Company]").prop("disabled",true);
      $(".disabled").prop("disabled",true);
    }
    
    
    //getで渡す
    var urls = BaseUrls+"/Search?action="+$("input[name=action]").val()+"&mode=search&"+query+"&num_rows="+num_rows+"&start="+nowPos*num_rows;
    console.log(urls);
    DummyLoadingSet();
    if($(ResultTarget+" ."+param["table"]).length){
      $(ResultTarget+" ."+param["table"]).each(function(){
        if(!$(this).hasClass("on")){
          $(this).remove();
        }
      });
    }else{
      $(ResultTarget).html("");
    }
    
    f = BaseUrls+"/static/Order/Order.php";
//    console.log(urls);
    var obj = {};
    obj["templ"] = templ;
    //obj["search"] =  urls;
    var _urls = urls.split("?");
    var __urls = _urls[1].split("&");
    //console.log(obj);
    $(__urls).each(function(i){
      var __vals = __urls[i].split("=");
      obj[__vals[0]] = __vals[1];
    });
    
    if(obj["target"] == "Items" || obj["target"] == "Sets"){
//      console.log(urls);
      var obj = {};
      obj["templ"] = templ;
      
      $.ajax(urls,{
        type: 'post',
        data: obj,
        dataType: 'json',
        timeout: 1000000
      })
      .done(function(d){
        console.log(d);
        $(d).each(function(i){
          if(!obj["d"]){
            obj["d"] = [];
          }
          obj["d"].push(d[i]);
        })
        console.log(obj);
        f = BaseUrls+"/static/Order/SearchOrder.php";
        //console.log(f);
        $.ajax(f,{
          type: 'post',
          data: obj,
          dataType: 'html',
          timeout: 1000000
        })
        .done(function(d){
          //console.log(d);
        })
        .always(function(d){
          $(document).find(ResultTarget).append(d);
          $("#dummLoad").fadeOut("fast",function(){
            $("#dummLoad").remove();
          });
          
          urls = urls+"&count=1"
          $.getJSON(urls,function(d){
            var num = Math.ceil(d["count"]/num_rows);
            console.log(urls);
//            console.log(d);
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

      })
      .fail(function(d){
        $("#dummLoad").fadeOut("fast",function(){
          $("#dummLoad").remove();
        });
      });
      
    }else if(obj["target"] == "Order"){
//      console.log(urls);
  
      $.ajax(urls,{
        type: 'post',
        data: obj,
        dataType: 'json'
      })
      .done(function(d){
        console.log(d);
        $(".widget-table tbody").html("");
        $(d).each(function(i){
          f = BaseUrls+"/static/Order/Management.php";
          var obj = {};
          obj["templ"] = "Order";
          obj["search"] =  urls;
          obj["d"] = d[i];
//          console.log(f);
          $.ajax(f,{
            type: 'post',
            data: obj,
            dataType: 'text'
          })
          .done(function(d){
            //$("#SearchResult").html(d);
            //console.log(d);
            $(".widget-table tbody").append(d);
            $("#dummLoad").fadeOut("fast",function(){
              $("#dummLoad").remove();
            });
          });
        });
        //console.log(d);
      })
      .always(function(d){
        $("#dummLoad").fadeOut("fast",function(){
          $("#dummLoad").remove();
        });
      })
    }else if(obj["target"] == "Adress"){
      console.log(urls);
      console.log(obj);
      $.ajax(urls,{
        type: 'get',
        data: obj,
        dataType: 'json'
      })
      .done(function(d){
        console.log(d);
        $(".widget-table tbody").html("");
        $(d).each(function(i){
          f = BaseUrls+"/static/Order/Adress.php";
          console.log(f);
          var obj = {};
          obj["templ"] = "TableAdress";
          obj["search"] =  urls;
          obj["d"] = d[i];
          $.ajax(f,{
            type: 'post',
            data: obj,
            dataType: 'text'
          })
          .done(function(d){
            $(ResultTarget).append(d);
          });
        });

      })
      .always(function(d){
        console.log(d);
        $("#dummLoad").fadeOut("fast",function(){
          $("#dummLoad").remove();
        });
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

    }else{
      
      $.ajax(f,{
        type: 'post',
        data: obj,
        dataType: 'html'
      })
      .done(function(d){
        $(document).find(ResultTarget).append(d);
        $("#dummLoad").fadeOut("fast",function(){
          $("#dummLoad").remove();
        });
      })
      .always(function(d){
        $("#dummLoad").fadeOut("fast",function(){
          $("#dummLoad").remove();
        });
      });
    }
    
    if(!$("#SearchUrl").val()){
      var e = document.createElement("input");
      e.id = "SearchUrl";
      e.type = "hidden";
      $("body").append(e);
    }
    
    $("#SearchUrl").val(urls);
    
    return false;
  });
  
  
  
  //検索フォームがあれば検索ボタンを押す
  if($(".search button[type=submit]").size()){
    if($(".search button[type=submit]").hasClass("ItemSet")){
      return false;
    }
    console.log("aaaaa");
    $(".search button[type=submit]").click()
  }
  
});

  
function GroupIdListChange(val,targetItem){
  if(val){
    //console.log(val);
    obj = {
      "mode":"searchCompany",
      "target":"GroupIdList",
      "val":val,
      "clm":"parent",
      "action": $(document).find("input[name=action]").val(),
      "token": $(document).find("input[name=token]").val(),
      "type":"ajax"
    };
    //console.log(obj);
    //console.log(BaseUrls+"/"+$(document).find("input[name=action]").val());
    var SelectedArr = [];
    if($("#EditValue").size()){
      $("#EditValue").children("input").each(function(){
        if($(this).attr("name") == "category"){
          SelectedArr.push($(this).val());
        }
      });
    }
    if(category.length){
      $(category).each(function(i){
        //$("#category").val(category[i]);
//        console.log(category[i]);
        SelectedArr.push(category[i]);
      });
    }
    
    $.ajax({
      url:BaseUrls+"/"+$(document).find("input[name=action]").val(),
      type:"post",
      data:obj,
      timeout:10000,
      //dataType:"html",
      dataType:"json",
    })
    .done(function(d){
      if(d){
//        console.log(d);
//        console.log(targetItem);
        $("#"+targetItem+" option").remove();
        val = [];
        $(d).each(function(i){
          var e = document.createElement("option");
          e.value = d[i]["code"];
          e.text = d[i].name;
          if(inArray(d[i].name,SelectedArr) !== -1){
            e.selected = "selected";
            val.push(d[i]["code"]);
          }
          $("#"+targetItem).append(e);
        });
        
  
        $("#"+targetItem).prop('disabled', false);
        if(SelectedArr.length){
          categoryChange(val,"sub_category");
        }
      }else{
        $("#"+targetItem+" option").remove();
        $("#"+targetItem).prop('disabled', true);
      }
    })
    .fail(function(d){
      console.log(d);
    });
  }
}

function categoryChange(val,targetItem){
  if(val){
    //console.log(val);
    obj = {
      "mode":"searchCompany",
      "target":"Category",
      "val":val,
      "clm":"parent",
      "action": $(document).find("input[name=action]").val(),
      "token": $(document).find("input[name=token]").val(),
      "type":"ajax"
    };
    
    var SelectedArr = [];
    if($("#EditValue").size()){
      $("#EditValue").children("input").each(function(){
        if($(this).attr("name") == "sub_category"){
          SelectedArr.push($(this).val());
        }
      });
    }
    
    if(sub_category.length){
      $(sub_category).each(function(i){
        //$("#category").val(category[i]);
//        console.log(sub_category[i]);
        SelectedArr.push(sub_category[i]);
      });
    }
    
    //console.log(SelectedArr);
    $.ajax({
      url:BaseUrls+"/"+$(document).find("input[name=action]").val(),
      type:"post",
      data:obj,
      timeout:10000,
      //dataType:"json",
    })
    .done(function(d){
      if(d){
        //console.log(d);
        $("#"+targetItem+" option").remove();
        $(d).each(function(i){
          var e = document.createElement("option");
          e.value = d[i]["code"];
          e.text = d[i].name;
          $("#"+targetItem).append(e);
          if(inArray(d[i].name,SelectedArr) !== -1){
            e.selected = "selected";
            val.push(d[i]["code"]);
          }
        });
        $("#"+targetItem).prop('disabled', false);
      }
    })
    .fail(function(d){
      console.log(d);
    });
    
  }
}


function DummyLoadingSet(){
  //ダミー用ローディングセット
  var e = document.createElement("div");
  e.id = "dummLoad";
  $("body").append(e);
  var e = document.createElement("div");
  e.id = "dummLoadInner";
  $("#dummLoad").append(e);
  var img = "<img src='"+BaseUrls+"/static/img/load.gif'><span>LOADING</span>";
  $("#dummLoadInner").html(img);
}

function inArray(value, array) {
  return [].indexOf.call(array, value);
}
