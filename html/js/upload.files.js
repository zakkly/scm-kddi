$(function(){
    var i =0;
    console.log(location.href);
    
    // フォームデータのアップロード処理
    var uploadBlobData = function(fileNmae, fileKey, totalBytes, binaryData, tasks, chunkCount) {
        
      $(".alert").hide();
      $(".alert-danger p").html("");
          
      $('#prog').val(0);
      $('#pv').html(0);
      
      
      // アップロードの進捗表示
      var xhr_func = function(){
        var XHR = $.ajaxSettings.xhr();
        XHR.upload.addEventListener('progress',function(e){
          tasks[chunkCount] = e.loaded;
          
          var upload = 0;
          tasks.forEach(function(bytes) {
            upload += bytes;
          });
          
          var progre = parseInt(upload/totalBytes * 100);
          
          $('#prog').val(progre);
          $('#pv').html(progre);
        });
        return XHR;
      };
      
      var targetMode;
 
      var shop = $("#FormArea input[name=shop]").val();
      var time = $("#FormArea input[name=time]").val();
      if($("#FormArea select[name=targetMode]").size()){
        targetMode = $("#FormArea select[name=targetMode]").val();
      }
      
      console.log(targetMode);
      // Ajaxでアップロード処理をするファイルへ内容渡す
      $.ajax({
          url: location.href,
          //url: './up2.php', //デバック用headers中身を見るだけ。
          type: 'POST',
          data: binaryData,
          processData: false,
          contentType: 'application/octet-stream',
          headers: {
              'File-Name': fileNmae,
              'File-Key': fileKey,
              'Chunk-Index': chunkCount,
              'Chunk-Total': tasks.length,
              'target': $("#FormArea input[name=target]").val(),
              'user': $("#FormArea input[name=user]").val(),
              'time': time,
              "token":$("#FormArea input[name=token]").val(),
              'targetMode' : targetMode
          },
          xhr : xhr_func
          
      }).done(function(data) {
        if(data){
          console.log(data);
          d = data-i;
//          console.log(data+":"+i+":"+d);
          num = Math.ceil(data/1000);
          
          if($("#DLbtn").size()){
            $("#DLbtn").find("a").attr("href","/csv/"+shop+"_"+time+".csv");
            $("#DLbtn").show();
          }
          //console.log(num);
          if(data){
            $(".alert-danger p").html(data);
            $(".alert-danger").show();
          }
        }else{
          $(".alert-success").show();
        }
          
      }).fail(function(data) {
          //console.log(data.responseText);
          console.log(fileKey);
          //失敗したらもう一回。
          uploadBlobData(fileNmae, fileKey, totalBytes, binaryData, tasks, chunkCount);
      });
      
    };
    
    
    // https://gist.github.com/jcxplorer/823878
    var createUuid = function() {
        var uuid = "", i, random;
        for (i = 0; i < 32; i++) {
            random = Math.random() * 16 | 0;
            if (i == 8 || i == 12 || i == 16 || i == 20) {
                uuid += "-"
            }
            uuid += (i == 12 ? 4 : (i == 16 ? (random & 3 | 8) : random)).toString(16);
        }
        return uuid;
    };
  
    
    // ファイルのアップロード処理
    var uploadFile = function(file) {
        
        $('#prog').val(0);
        $('#pv').html('0');
        
        /*
        $('#prog2').val(0);
        $('#pv2').html('0');*/
        
        // 分割するサイズ(byte)
        var chunkSize = 0.1 * 1024 * 1024;
        // 選択されたファイルの総容量を取得
        var totalBytes = file.size;
        // ファイル名
        var fileNmae = file.name;
        
        // チャンク分割数
        var chunkCount = Math.ceil(totalBytes / chunkSize);
        // 識別キー
        var fileKey = createUuid();
        
        var readBytes = 0;
        var tasks = [];
        for (var i = 0; i < chunkCount; i++) {
            tasks.push(0);
        }
        
        // チャンクサイズごとにスライスしながら読み込み
        $.each(tasks, function(index) {
            
            // stopをオーバーして指定した場合は自動的に切り詰められる
            var blob = file.slice(readBytes, readBytes + chunkSize);
            readBytes += chunkSize
            
            var reader = new FileReader();
            reader.onloadend = function(evt) {
              // 読み取り完了のイベントだけキャッチ
              if (evt.target.readyState != FileReader.DONE) {
                  return;
              }
              
              // 読み取ったデータを取り出し
              var binaryData = evt.target.result;
              uploadBlobData(fileNmae, fileKey, totalBytes, binaryData, tasks, index);
            };
            reader.readAsArrayBuffer(blob);
            
        });
    };
    
    // ファイルドロップ時の処理
    $('#drag-area').on('drop', function(e){
        // デフォルトの挙動を停止
        e.preventDefault();
        
        // ファイル情報を取得
        var files = e.originalEvent.dataTransfer.files;
        uploadFile(files[0]);
    
    }).on('dragend', function(){
        $(this).removeClass("dragOver");
    }).on('dragleave', function(){
        $(this).removeClass("dragOver");
    
    // デフォルトの挙動を停止　これがないと、ブラウザーによりファイルが開かれる
    }).on('dragenter', function(){
        $(this).addClass("dragOver");
        return false;
    }).on('dragover', function(){
        $(this).addClass("dragOver");
        return false;
    });
    
    
    // ボタンを押した時の処理
    $('#btn').on('click', function() {
        // ダミーボタンとinput[type="file"]を連動
        $('#file_selecter').click();
    });
 
    $('#file_selecter').on('change', function(){
        // ファイル情報を取得
        uploadFile(this.files[0]);
    });
});