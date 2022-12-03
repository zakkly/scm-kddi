$(function(){
  var t = new Date().getTime();
  
  var e = document.createElement("link");
  e.href = BaseUrls+"/css/OrderAdress.css?"+t;
  e.rel = "stylesheet";
  $("body").append(e);
  var nowPos = 0;
  
  
  //fa-check-circle
  $(document).on("click","#searchResult .items",function(){
    $(this).addClass("on");
    $(this).prepend('<i class="fa fa-check-circle"></i>');
    $(this).find("input[type=checkbox]").prop("checked",true);
  });
  
  //$("#search button[type=submit]").click();
  
  $(document).on("click","#showCSV",function(){
    $("#FormArea").slideToggle("fast");
  });

});