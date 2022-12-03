$(function(){
  var e = document.createElement("link");
  e.href = BaseUrls+"/css/OrderInsert.css?"+t;
  e.rel  = "stylesheet";
  //$("body").append(e);
  
  
  var nowPos = 0;
  
  
  //初期設定は最初のタブを表示
  $("ul.tab li").eq(0).addClass("on");
  $("#SearchSection .search").eq(0).addClass("on");
  
  $("ul.tab li").click(function(){
    $("ul.tab li").removeClass("on");
    $("#SearchSection .search").removeClass("on");
    $(this).addClass("on");
    $("#SearchSection .search").eq($("ul.tab li").index(this)).addClass("on");
  });
  
  
  $(document).on("change","#Company",function(){
    GroupIdListChange($(this).val(),"category");
  });
  
  
  var NowTabPos = 1;
  var Per = 100/$(".steps li").length;
  $(".progress-bar-success").width(NowTabPos*Per+"%");
  $(".tab-page").eq(0).fadeIn(300);
  
  
  $(".button").click(function(){
    if($(this).hasClass("back")){
      console.log(NowTabPos);
      if(NowTabPos == 1){
        return false;
      }
      $(this).parents().parent(".tab-page").fadeOut(300,function(){
        if($(this).prev(".tab-page").size()){
          $(this).prev(".tab-page").fadeIn(300);
          NowTabPos--;
          $("#tab-"+NowTabPos+" input").each(function(){
            $(this).remove();
          });
          $(".progress-bar-success").width(NowTabPos*Per+"%");
        }
      });
      
    }else{
      //格納用fieldset生成
      if(!$("#tab-" + NowTabPos).size()){
        var e = document.createElement("fieldset");
        e.id = "tab-" + NowTabPos;
        $("form.register").append(e);
      }
      
      //初期画面から遷移するときは商品を選択しているかチェックする
      if(NowTabPos == 1){
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
      }else if(NowTabPos == 2){
        var chk;
        $(".widget-table").find("input").each(function(){
          if($(this).is(':checked')){
            var e = document.createElement("input");
            e.name = $(this).attr("name");
            e.value = $(this).val();
            e.type = "hidden";
            $("#tab-" + NowTabPos).append(e);
            chk = 1;
          }
        });
        if(!chk){
          window.alert("送付先住所が選択されていません");
          return false;
        }
      }else if(NowTabPos == 3){
        chkArr = chk = 0;
        $(".tab-page").eq(2).find("input").each(function(){
          $(this).removeClass("danger");
          chkArr++;
          if($(this).val()){
            var e = document.createElement("input");
            e.name = $(this).attr("name");
            e.value = $(this).val();
            e.type = "hidden";
            $("#tab-" + NowTabPos).append(e);
            chk++;
          }else{
            $(this).addClass("danger");
          }
        });
        console.log(chk+"//"+chkArr);
        if(chk != chkArr){
          window.alert("必須項目が入力されていません");
          return false;
        }
      }
      //画面遷移ギミック
      $(this).parents().parent(".tab-page").fadeOut(300,function(){
        if($(this).next(".tab-page").size()){
          $(".steps li").each(function(){
            if($(this).hasClass("on")){
              $(this).removeClass("on");
              $(this).addClass("done");
            }
          });
          NowTabPos++;
          $(".progress-bar-success").width(NowTabPos*Per+"%");
          if(NowTabPos == 2){
            var add = $("#tab-1").find("input[name='GroupIdList[]']").val();
            var urls = location.href+"?mode=Adress&Company="+add;
            console.log(urls);
            $.getJSON(urls,function(d){
              //console.log(d);
              $("table tbody").html("");
              $(d).each(function(i){
                var str = "";
                str += "<tr data-add='"+d[i]["destination"]+" ["+d[i]["pref"]+d[i]["add1"]+d[i]["add2"]+"]"+"' data-code='"+d[i]["code"]+"'>";
                str += "  <td style=\"display:none;\"><input type=\"checkbox\" name=\"adress[]\" value='"+d[i]["code"]+"'></td>";
                str += "  <td>"+d[i]["CompanyName"]+"</td>";
                str += "  <td>"+d[i]["destination"]+"</td>";
                str += "  <td>"+d[i]["zip"]+"</td>";
                str += "  <td>"+d[i]["pref"]+"</td>";
                str += "  <td>"+d[i]["add1"]+"</td>";
                str += "  <td>"+d[i]["add2"]+"</td>";
                str += "  <td>";
                for(n=1;n<=3;n++){
                  var key = "tel"+n;
                  str += d[i][key];
                  if(n<3){
                    str += "-";
                  }
                }
                str += "  </td>";
                str += "</tr>";
                $(".widget-table tbody").append(str);
              })
            });
          }else if(NowTabPos == 3){
            var obj = {};
            var urls_item = [];
            var urls_sets = [];
            $(".register input").each(function(){
              var name = $(this).attr("name");
              if(name.match(/\[\]/)){
                name = name.split("[]");
                name = name[0];
                if(!obj[name]){
                  obj[name] = [];
                }
                obj[name].push($(this).val());
              }
            });
            
            $(obj["items"]).each(function(i){
              if(inArray(location.href+"?mode=search&code="+obj["items"][i],urls_item)  === -1){
                urls_item.push(location.href+"?mode=search&code="+obj["items"][i]);
              }
            });
            
            $(obj["sets"]).each(function(i){
              if(inArray(location.href+"?mode=search&set=set&json=1&code="+obj["sets"][i],urls_sets)  === -1){
                urls_sets.push(location.href+"?mode=search&json=1&set=set&code="+obj["sets"][i]);
              }
            });
            
            if(obj["adress"].length){
              console.log(obj["adress"]);
              $(".tab-page").eq(2).find("article").each(function(i){
                console.log("article"+i)
                $(this).remove();
              });
              $(obj["adress"]).each(function(i){
                var add;
                $(".tab-page tr").each(function(n){
                  if($(this).data("code") == obj["adress"][i]){
                    add = $(this).data("add");
                  }
                });
                
                var str = "";
                str += "<article>";
                str += "  <header>";
                str += "    <h1><span>送付先</span>"+add+"</h1>\n";
                str += '    <div class="form-group">\n';
                str += '      <label>配送希望日</label>\n';
                str += '      <input type="date" name="date____'+obj["adress"][i]+'" class="" />\n';
                str += '    </div>\n';
                str += "  </header>";
                str += "  <div class=\"itemsBody\"></div>";
                str += "</article>";
                $(".tab-page").eq(2).find(".login-actions").before(str);
                
              });
              
              //getJsonの中からstrに格納する方法がないので外に出す。
              $(urls_item).each(function(i){
                urls = urls_item[i];
                $.getJSON(urls,function(d){
                  $(d).each(function(n){
                    var str = "";
                    str += "<div class=\"itemsNum box\">\n";
                    if(d[n]["img"]){
                      img = '<img src="'+ImgDir+"/"+d[n]["img"]+'">';
                    }else{
                      img = '<img src="'+ImgDir+'/nowprinting.jpg">';
                    }
                    str += "<div class=\"titleName\">個別商品</div>\n";
                    str += "<div class=\"itemBox\"><span class='img'>"+img+"</span><span class='name'>"+d[n]["name"]+"</span>";
                    str += '<span class="number"><span>発注数</span><input type="number" name="number____'+d[n]["code"]+'____'+obj["adress"][i]+'" value="'+d[n]["order"]+'" data-max="'+d[n]["stock"]+'"></span>';
                    str += "<span class='input'>";
                    //str += "  <input type='number' name='number_"+obj["items"][i]+"' oninput=\"javascript: if (this.value > "+d[n]["stock"]+") this.value = "+d[n]["stock"]+";\">";
                    str += "</span></div>";
                    str += '</div>';
                    $(".tab-page").eq(2).find("article").each(function(){
                      $(this).append(str);
                    });
                    //(".tab-page").eq(2).find(".itemsNum").append(str);
                  });
                });
              });
              
              console.log(urls_sets);
              
              $(urls_sets).each(function(i){
                urls = urls_sets[i];
                console.log(urls);
                $.getJSON(urls,function(d){
                  //console.log(d);
                  var str = "";
                  str += "<div class=\"setsNum box\">\n";
                  $(d).each(function(n){
                    console.log(d[n]["items"]);
                    if(d[n]["img"]){
                      img = '<img src="'+ImgDir+"/"+d[n]["img"]+'">';
                    }else{
                      img = '<img src="'+ImgDir+'/nowprinting.jpg">';
                    }
                    str += "<div class=\"titleName\">セット商品</div>\n";
                    str += "<div class=\"itemBox\"><span class='img'>"+img+"</span><span class='name'>"+d[n]["title"]+"</span>";
                    str += '<span class="number"><input type="number" name="number____'+d[n]["code"]+'____'+obj["adress"][i]+''+'" value="'+d[n]["order"]+'" data-max="'+d[n]["stock"]+'"></span>';
                    str += '<ul>';
                    $.each(d[n]["items"],function(j,v){
                      //console.log($(this));
                      if(d[n]["items"][j]["img"]){
                        img = '<img src="'+ImgDir+"/"+d[n]["items"][j]["img"]+'">';
                      }else{
                        img = '<img src="'+ImgDir+'/nowprinting.jpg">';
                      }
                      str += "<li><span class='img'>"+img+"</span><span class='name'>"+d[n]["items"][j]["name"]+"</span>";
                      str += "<span class='input'>"+d[n]["items"][j]["order"]+"</span>";
                      if(d[n]["items"][j]["day"]){
                        str += "<span class='day icon'>日数</span></li>";
                      }
                      if(d[n]["items"][j]["person"]){
                        str += "<span class='person icon'>人数</span></li>";
                      }
                    });
                    str += "</ul>";
                    //str += "  <input type='number' name='number_"+"' oninput=\"javascript: if (this.value > "+d[n]["stock"]+") this.value = "+d[n]["stock"]+";\">";
                    str += "</div>";
                    str += '</div>';
                    $(".tab-page").eq(2).find("article").each(function(){
                      $(this).append(str);
                    });
                  });
                });
              });
              
              $("input[type='number']").each(function(){
                var maxNum = $(this).data("max");
                console.log(maxNum);
                $($(this)).TouchSpin({
                    min: 0,
                    max: maxNum,
                    step: 1,
                    boostat: 5,
                    maxboostedstep: 10,
                });
              });

            }

          }else if(NowTabPos == 4){
            var urls = location.href;
            var obj = {};
            obj["mode"] = "order";
            $(".register input").each(function(){
              var name = $(this).attr("name");
              if(name.match(/\[\]/)){
                name = name.split("[]");
                name = name[0];
                if(!obj[name]){
                  obj[name] = [];
                }
                obj[name].push($(this).val());
              }else{
                obj[name] = $(this).val();
              }
            });
            console.log(obj);
                    
            $.ajax({
              url: urls,
              type: 'post',
              data:obj,
              timeout:10000,
            })
            .done((d) => function(){
              console.log("success");
              console.log(d);
            })
            .fail((d) => function(){
              console.log("aaaa");
              console.log(d);
            })
            .always( (data) => {
              console.log(data);
            });
            
          }
          $(this).next(".tab-page").fadeIn(300);
        }
      });
    }
  });
  
  
  $(document).on("submit",".search",function(){
    var $form = $(this).find('form');
    console.log($form);
    //console.log($form.attr("class"));
    var query = $form.serialize();
    var param = [];
    $.each($form.serializeArray(), function() {
      param[this.name] = this.value;
    });
    //最大件数
    var num_rows = 20;
    var urls = location.href+"?mode=search&"+query+"&num_rows="+num_rows+"&start="+nowPos*num_rows;
    
    DummyLoadingSet();
    //console.log(urls);
    //console.log(param);
    
    $.getJSON(urls,function(d){
      console.log(d);
      $("#SearchResult .items").each(function(){
        if(!$(this).hasClass("on")){
          $(this).remove();
        }
      });
      $(d).each(function(i){
        var str = "";
        str += '<div class="items">'
        if(d[i]["img"]){
          img = '<img src="'+ImgDir+"/"+d[i]["img"]+'">';
        }else{
          img = '<img src="'+ImgDir+'/nowprinting.jpg">';
        }
        if(!d[i]["name"]){
          d[i]["name"] = d[i]["title"];
        }
        str += '<div class="img">'+img+'</div>';
        str += '<div class="name">'+d[i]["name"]+'</div>';
        if(param["set"] == "set"){
          str += '<div class="demo">'+Demo[d[i]["demo"]]+'</div>';
          str += '<input type="checkbox" name="sets[]" value="'+d[i]["code"]+'" class="hidden">'
        }else{
          str += '<div class="num">数量:'+d[i]["stock"]+'</div>';
          str += '<input type="checkbox" name="items[]" value="'+d[i]["code"]+'" class="hidden">'
        }
        str += '<div class="comment">'+d[i]["comment"]+'</div>';
        str += '</div>';
        
        $("#SearchResult").append(str);
      })
    });
      
    $("#dummLoad").fadeOut("fast",function(){
      $("#dummLoad").remove();
    });
    return false;
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
    //$(".widget-table tr").removeClass("on");
    //$(".widget-table tr").find("input[type=checkbox]").prop("checked",false);
    $(this).parent().addClass("on");
    $(this).parent().find("input[type=checkbox]").prop("checked",true);
  });
  
});