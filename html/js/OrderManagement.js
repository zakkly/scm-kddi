$(function(){
  nowPos = 0;  
  
  //モーダルオープン時の処理
  $(document).on("click",".modalOpen",function(){
    var code = $(this).data("code");
    var urls = location.href;
    console.log(code+"//"+urls);
    var obj = {};
    obj["mode"] = "modal";
    obj["code"] = code;
    obj["templ"] = "Admin/OrderDetail";
    console.log(obj);
    $.ajax({
      url: urls,
      type: 'post',
      data:obj,
      timeout:10000,
      dataType:"html",
    })
    .done(function(d){
      console.log("success");
      $(".modal .form-body").html("");
      $(".modal .form-body").prepend(d);
    })
    .fail(function(d){
      console.log("fail");
    });
    
  });
  
  $(document).on("click",".modal .status",function(){
    console.log($(this).attr("class"));
    var val = $(this).attr("class").split("status");
    console.log(val[3]);
    var urls = location.href;
    //console.log(code+"//"+urls);
    var obj = {};
    obj["mode"] = "statusChange";
    obj["code"] = $("#OrderDetails").data("code");
    obj["status"] = val[2];
    console.log(obj);
    $.ajax({
      url: urls,
      type: 'post',
      data:obj,
      timeout:10000,
      dataType:"html",
    })
    .done(function(d){
      console.log("success");
      if(d){
        window.alert(d);
        console.log(d);
      }else{
        $(".modal-backdrop").click();
        $(".search button[type=submit]").click();
      }
    })
  });
  
  $(document).on("click",".modal .btn-primary",function(){
    var urls = location.href;
    //console.log(code+"//"+urls);
    var obj = {};
    obj["mode"] = "OrderUpdate";
    obj["code"] = $("#OrderDetails").data("code");
    $(".modal input").each(function(){
      var name = $(this).attr("name");
      var val = $(this).val();
      obj[name] = val;
    });
    $(".modal select").each(function(){
      var name = $(this).attr("name");
      var val = $(this).val();
      obj[name] = val;
    });
    
    //console.log(obj);
    //console.log(urls);
    
    $.ajax({
      url: urls,
      type: 'post',
      data:obj,
      timeout:10000,
      dataType:"html",
    })
    .done(function(d){
      console.log("success");
      console.log(d);
      $(".modal-backdrop").click();
      location.reload();
    })
    return false;
  });
  
  
  $(document).on("click",".OrderSheet",function(){
    var obj = {};
    var urls = location.href;
    obj["mode"] = "OrderSheet";
    obj["code"] = $("#OrderDetails").data("code");
    
    urls += "?mode="+obj["mode"]+"&code="+obj["code"];
    console.log(urls);
    
    var filename ="download.xlsx";
    var link = document.createElement("a");
    link.href = urls;
    //link.download = filename;
    link.click();
    
    return false;
    $.ajax({
      url: urls,
      type: 'post',
      data:obj,
      timeout:10000,
      beforeSend: function(xhr){
        xhr.overrideMimeType("text/csv; charset=Shift_JIS");//文字化けしないようにMIMEタイプをオーバーライドする
      },
    })
     .done(function( data, textStatus, jqXHR ) {
      var bom = new Uint8Array([0xEF, 0xBB, 0xBF]);
      var downloadData = new Blob([bom,data], {type: 'application/octet-stream'});
      var filename ="download.xlsx";
      if(window.navigator.msSaveBlob){ // for IE
        console.log("aaa")
        window.navigator.msSaveBlob(downloadData, filename);
      }else{
        console.log("bbb")
        var downloadUrl  = (window.URL || window.webkitURL).createObjectURL(downloadData);
        var link = document.createElement("a");
        link.href = downloadUrl;
        link.download = filename;
        link.click();
        (window.URL || window.webkitURL).revokeObjectURL(downloadUrl);
      }
       /*
       var downloadData = data;
       window.navigator.msSaveBlob(downloadData, "sample.xlsx");
      console.log("success");
      console.log(d);}*/
    })
  });
  
  $("#search_status").change(function(){
    var fom = $(this).parent().parent().parent().find("form.searchField");
    //console.log(fom.html());
    if(!fom.find("input[name=statusChange]").val()){
      var e = document.createElement("input");
      e.type = "hidden";
      e.name = "statusChange";
      e.value = 1;
      fom.append(e);
    }else if($(this).val() == ""){
      $("input[name=statusChange]").remove();
    }
  });
  
  
  $(document).on("click","#MasterDownLoad",function(){
    var urls = $("#SearchUrl").val();
    urls = urls.split("?");
    var _obj = urls[1].split("&");
    var _arr = [];
    $(_obj).each(function(i){
      var _tmp = _obj[i].split("=");
      if(_tmp[0] != "num_rows"){
        _arr.push(_obj[i]);
      }
    });
    
    urls = urls[0]+"?"+_arr.join("&");
    
    var obj = {};
    obj["mode"] = "MasterDownLoad";
    obj["urls"] = urls;
    
    console.log(obj);
    
    var urls = location.href;
    
    $.ajax({
      url: urls,
      type: 'post',
      data:obj,
      timeout:10000,
//      dataType :"json",
      beforeSend: function(xhr){
        xhr.overrideMimeType("text/csv; charset=Shift_JIS");//文字化けしないようにMIMEタイプをオーバーライドする
      },
    })
    .done(function( data, textStatus ,jqXHR) {
      console.log(data);
      var bom = new Uint8Array([0xEF, 0xBB, 0xBF]);
      var downloadData = new Blob([bom,data], {type: "text/csv"});
      var filename ="download.csv";
      if(window.navigator.msSaveBlob){ // for IE
        window.navigator.msSaveBlob(downloadData, filename);
      }else{
        var downloadUrl  = (window.URL || window.webkitURL).createObjectURL(downloadData);
        var link = document.createElement("a");
        link.href = downloadUrl;
        link.download = filename;
        link.click();
        (window.URL || window.webkitURL).revokeObjectURL(downloadUrl);
      }

    })
    .fail(function(d){
      console.log(d);
    });
    
  });
  

  //$("#Search button[type=submit]").click();
});