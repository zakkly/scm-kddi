$(function(){
  $("#faq article h4").click(function(){
    $(this).next("p").slideToggle();
  });
  $("#faq .box h3").click(function(){
    $(this).next(".cont").slideToggle();
    
    if($("#faq .box h3 i.arrow").hasClass("fa-angle-down")){
      $("#faq .box h3 i.arrow").removeClass("fa-angle-down");
      $("#faq .box h3 i.arrow").addClass("fa-angle-up");
    }else{
      $("#faq .box h3 i.arrow").removeClass("fa-angle-up");
      $("#faq .box h3 i.arrow").addClass("fa-angle-down");
    }
  });
  
  
});
