$(function(){
  var e = document.createElement("link");
  e.href = BaseUrls+"/css/ItemRegister.css";
  e.rel = "stylesheet";
  $("body").append(e);
  
  $("#GroupIdList").change(function(){
    GroupIdListChange($(this).val(),"category"); 
  });
  
  
  $("#category").change(function(){
    categoryChange($(this).val(),"sub_category");
  });
  
  
});