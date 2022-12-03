$(function(){
  var e = document.createElement("link");
  e.href = BaseUrls+"/css/Holiday.css";
  e.rel = "stylesheet";
  $("body").append(e);
  
  $(".week dl").click(function(){
    var obj = {};
    var urls = location.href;
    var date = $(this).data("date");
    obj["date"] = date;
    if($(this).hasClass("closing")){
      $(this).removeClass("closing");
      obj["mode"] = "delete";
    }else{
      $(this).addClass("closing");
      obj["mode"] = "insert";
    }
    
    $.ajax({
      url: urls,
      type:"post",
      data:obj,
      timeout:10000,
    })
    .done((d) =>{
      console.log("success");
      console.log(d);
    })
    .fail((d) =>{
      alert("データ登録に失敗しました");
    });
  });
});