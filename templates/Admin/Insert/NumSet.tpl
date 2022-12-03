<div id="NumhResult">
</div>
<div class="login-actions submit">
	<button class="button btn btn-danger btn-large back">戻る</button>
	<button class="button btn btn-primary btn-large">次へ</button>
</div>

<script>
var ResultTarget = "#NumhResult";
console.log(ResultTarget);
$(function(){
  var form = $("form[name=OrderInsert]");
  var obj = {};
  var urls_item = [];
  var urls_sets = [];
  $(form).find("input").each(function(){
    var name = $(this).attr("name");
    if(name.match(/\[\]/)){
      name = name.split("[]");
      name = name[0];
      if(!obj[name]){
        obj[name] = [];
      }
      obj[name].push($(this).val());
    }
    //console.log(name);
  });
  console.log(obj);
  
  f = BaseUrls+"/static/Order/Order.php";
  //console.log(f);
  obj["templ"] = "NumsetDetail";
  obj["mode"] = "NumsetDetail";
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
