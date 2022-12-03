<div id="Other">
</div>

<div class="login-actions submit">
	<button class="button btn btn-danger btn-large back">戻る</button>
	<button class="button btn btn-primary btn-large">発注する</button>
</div>

<script>
var ResultTarget = "#Other";
$(function(){
  var form = $("form[name=OrderInsert]");
  var obj = {};
  $(form).find("input").each(function(){
    var name = $(this).attr("name");
    if(name.match(/\[\]/)){
      name = name.split("[]");
      name = name[0];
      if(!obj[name]){
        obj[name] = [];
      }
      obj[name].push($(this).val());
    }else if(name=="demo"){
      obj[name] = ($(this).val());
    }
    //console.log(name);
  });
  console.log(obj);
  
  f = BaseUrls+"/static/Order/Order.php";
  obj["templ"] = "OtherDetail";
  obj["mode"] = "OtherDetail";
  $.ajax(f,{
    type: 'post',
    data: obj,
    dataType: 'html'
  })
  .done(function(d){
    //console.log(d);
    $(ResultTarget).append(d);
  });
});
</script>