<div class="widget-table action-table">
  <table class="table table-striped table-bordered ">
    <thead>
      <tr>
  {foreach from=$AdressForm key=k item=v}
      {if $v["view"] == 1}
        <th>{$v["name"]}</th>
      {/if}
  {/foreach}
        <th></th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>
  <div class="login-actions submit">
	<button class="button btn btn-danger btn-large back">戻る</button>
		<button class="button btn btn-primary btn-large">次へ</button>
  </div>
</div>


<script>
var templ = "TableAddress";
var ResultTarget = "table tbody";
//console.log(ResultTarget);

if($("form[name=OrderInsert]").size()){
  var add = [];
  var adress = $("form[name=OrderInsert]").find("input[name='GroupIdList[]']").val();
  if(!adress){
    var adress = $("form[name=OrderInsert]").find("input[name='GroupIdList']").val();
  }
  if(adress.match(/,/)){
    add = adress.split(",");
  }else{
    add.push(adress);
  }
  
  var urls = location.href;
  var obj = {};
  obj["mode"] = "Adress";
  obj["Company"] = [];
  if(add.length){
    $(add).each(function(i){
      obj["Company"].push(add[i]);
    });
  }
  console.log(urls);
  console.log(obj);
  $.ajax(urls,{
    type: 'post',
    data: obj,
    dataType: 'json'
  })
  .done(function(d){
    //console.log(d);
    $(d).each(function(i){
      f = BaseUrls+"/static/Order/Order.php";
      var obj = {};
      obj["templ"] = "TableAddress";
      obj["d"] = d[i];
      $.ajax(f,{
        type: 'post',
        data: obj,
        dataType: 'html'
      })
      .done(function(d){
        //console.log(d);
        $(ResultTarget).append(d);
      })
      .fail(function(d){
        console.log(d);
      })
      .always(function(d){
        //console.log(d);
      })
    });
  });
}

  
  
</script>
