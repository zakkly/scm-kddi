$(function(){
  var nowPos = 0;
  
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
    e.name = "action";
    e.value = $(document).find("input[name=action]").val();
    $("#DummyForm").append(e);
    
    e = document.createElement("input");
    e.type = "hidden";
    e.name = "mode";
    e.value = "EditMode";
    $("#DummyForm").append(e);
    
    console.log(InsertSetUrls);
    //$("#DummyForm").append(e);
    $("#DummyForm").submit();
    return false;
  });

});