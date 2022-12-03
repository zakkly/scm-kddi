$(function(){
  var obj = {};
  $(document).on("submit","form.reminder",function(){
    //エラーを一回初期化
    $(".alert-danger").hide();
    $(".alert-danger p").html("");
    DummyLoadingSet();
    if($("#username").val() == ""){
      //メールアドレス未入力処理
      $(".alert-danger p").html("メールアドレスが入力されていません");
      $(".alert-danger").fadeIn();
    }else{
      obj["mode"] = "search";
      obj["email"] = $("#username").val();
      f = location.href;
      $.ajax(f,{
        type: 'post',
        data: obj,
        dataType: 'text'
      })
      .done(function(d){
        //php側から出力があればエラー
        if(d){
          $(".alert-danger p").html(d);
          $(".alert-danger").fadeIn();
        }else{
          console.log(obj);
          var obj = {};
          obj["mode"] = "reminder";
          obj["email"] = $("#username").val();
          f = location.href;
          $.ajax(f,{
            type: 'post',
            data: obj,
            dataType: 'text'
          })
          .done(function(d){
            if(d){
              $(".alert-danger p").html(d);
              $(".alert-danger").fadeIn();
            }else{
              $(".alert-success").fadeIn();
            }
          });
        }
      });
    }
    $("#dummLoad").fadeOut("fast",function(){
      $("#dummLoad").remove();
    });
    return false;
  });
  
  
  $(document).on("submit","form.reset",function(){
    //エラーを一回初期化
    $(".alert-danger").hide();
    $(".alert-danger p").html("");
    DummyLoadingSet();
    if($("#password").val() == ""){
      //メールアドレス未入力処理
      $(".alert-danger p").html("パスワードが入力されていません");
      $(".alert-danger").fadeIn();
    }else{
      obj["mode"] = "reset";
      obj["password"] = $("#password").val();
      f = location.href;
      $.ajax(f,{
        type: 'post',
        data: obj,
        dataType: 'text'
      })
      .done(function(d){
        if(d){
          $(".alert-danger p").html(d);
          $(".alert-danger").fadeIn();
        }else{
          $(".alert-success").fadeIn();
        }
      });
    }
    $("#dummLoad").fadeOut("fast",function(){
      $("#dummLoad").remove();
    });
    return false;
  });
});