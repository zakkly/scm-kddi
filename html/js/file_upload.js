/*
 * decaffeinate suggestions:
 * DS102: Remove unnecessary code created because of implicit returns
 * Full docs: https://github.com/decaffeinate/decaffeinate/blob/master/docs/suggestions.md
 */
$(function() {
  Dropzone.autoDiscover = false;
  Dropzone.options.myAwesomeDropzone = {
    paramName : "file",
    parallelUploads: 1,
    acceptedFiles: ".png,.jpg,.jpeg",
    maxFiles: 1,
    maxFilesize: 0.5,
    dictFileTooBig: "アップロードするファイルをここへドロップしてください.",
    dictInvalidFileType: "アップロードできるファイルは画像のみです",
    dictMaxFilesExceeded: "アップロードできるファイルは1枚までです"
  };
  
  if($(".drag-and-drop-area").size()){
    const myDropzone = new Dropzone(".drag-and-drop-area", {
      url:BaseUrls+"/images/async_upload.php", 
       init:function(){
          this.on("success", function (index, response) {
              console.log(response);
              //var res = JSON.parse(response);
              var res = response;
              console.log(response);
              fileList = res.images;
              for (i = 0; i < fileList.length; i++) {
                var imgname = fileList[i];
                $(".dz-remove").eq(index).attr('data-url',imgname);
                var e = document.createElement("input");
                e.type = "hidden";
                e.name = "img";
                e.value = imgname;
                $(".dz-image").append(e);
             }
            $('.dz-success-mark').show();
          });
       }
    });
    
    if($(".drag-and-drop-area").data("img")){
      var mockFile = { name: $(".drag-and-drop-area").data("img"), size:  $(".drag-and-drop-area").data("size")};
      myDropzone.options.addedfile.call(myDropzone, mockFile);
      myDropzone.options.thumbnail.call(myDropzone, mockFile, BaseUrls+"/images/"+$(".drag-and-drop-area").data("img"));
      $(".drag-and-drop-area").append("<input type='hidden' name='img' value='"+$(".drag-and-drop-area").data("img")+"'>")
    }
  }
  
  

  return $('.drag-and-drop-area').on({
    click(e){
      return $('#file_input').click();
    },
    mouseover(e){
      $(this).removeClass('drag-and-drop-area-out');
      return $(this).addClass('drag-and-drop-area-over');
    },
    mouseout(e){
      $(this).removeClass('drag-and-drop-area-over');
      return $(this).addClass('drag-and-drop-area-out');
    },
    dragover(e){
      $(this).removeClass('drag-and-drop-area-out');
      return $(this).addClass('drag-and-drop-area-over');
    },
    dragleave(e){
      $(this).removeClass('drag-and-drop-area-over');
      return $(this).addClass('drag-and-drop-area-out');
    }
  });});
