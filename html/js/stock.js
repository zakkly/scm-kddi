$(function(){
  function GetItemStock(item_id=""){
    if(!item_id){
      item_id = 37;
    }
    
    var obj = {};
    obj["mode"] = "GetItemStock";
    obj["item_id"] = item_id;
    
    $.post(f,obj)
    .done(function(d){
      return d;
    }
  }
});