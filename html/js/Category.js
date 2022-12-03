$(function(){
  
  $(document).on("click",".btn.btn-small",function(){
    $("#CatgoryCompany input[name=code]").val($(this).data("code"));
    $(this).next().find("input").each(function(){
      if($(this).attr("name") == "Company"){
        console.log($(this).val());
        $("#CatgoryCompany input[value="+$(this).val()+"]").prop("checked",true);
      }
    });
    //console.log(s);
  });
});