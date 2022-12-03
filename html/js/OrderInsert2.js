
var nowPos = 0;
$(function(){
  var e = document.createElement("link");
  e.href = BaseUrls+"/css/OrderInsert.css?"+t;
  e.rel  = "stylesheet";
  //$("body").append(e);
  
  
  var NowTabPos = 1;
  var Per = 100/$(".steps li").length;
  $(".progress-bar-success").width(NowTabPos*Per+"%");
  $(".tab-page").eq(0).fadeIn(300);
  ScreenTransition();
  
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

  
  
  $(document).on("submit",".search",function(){
    var $form = $(this).find('form');
    //console.log($form);
    //console.log($form.attr("class"));
    var query = $form.serialize();
    var param = [];
    $.each($form.serializeArray(), function() {
      param[this.name] = this.value;
    });
    //最大件数
    var num_rows = 20;
    var urls = "mode=search&"+query+"&num_rows="+num_rows+"&start="+nowPos*num_rows;
    DummyLoadingSet();
    console.log(urls);
    
    f = BaseUrls+"/static/Order/Order.php";
    var obj = {};
    obj["templ"] = "items";
    obj["search"] =  urls;
    console.log(f);
    $.ajax(f,{
      type: 'post',
      data: obj,
      dataType: 'html'
    })
    .done(function(d){
      $("#SearchResult").html(d);
        
      $("#dummLoad").fadeOut("fast",function(){
        $("#dummLoad").remove();
      });
    })
    .always(function(d){
    });
    
    
    return false;
  });
});
  
function ScreenTransition(){
  if(Templ){
    var temp = Templ[nowPos];
    f = BaseUrls+"/static/Order/Order.php";
    console.log(f);
    var obj = {};
    obj["templ"] = temp[1];
    $.ajax(f,{
      type: 'post',
      data: obj,
      dataType: 'html'
    })
    .done(function(d){
      $(".tab-page").html(d);
    });
  }
}