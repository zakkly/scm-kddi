$ ->
  Dropzone.autoDiscover = false
  Dropzone.options.myAwesomeDropzone = {
    paramName : "file"
    parallelUploads: 1
    acceptedFiles: 'image/*'
    maxFiles: 10
    maxFilesize: 0.5
    dictFileTooBig: "uploaded file is too large({{filesize}}MiB). limit: {{maxFilesize}}MiB."
    dictInvalidFileType: "Image file only"
    dictMaxFilesExceeded: "10 files limit"
  }

  myDropzone = new Dropzone ".drag-and-drop-area", {url:"/images/async_upload"}

  $('.drag-and-drop-area').on {
    click: (e)->
      $('#file_input').click()
    mouseover: (e)->
      $(this).removeClass('drag-and-drop-area-out')
      $(this).addClass('drag-and-drop-area-over')
    mouseout: (e)->
      $(this).removeClass('drag-and-drop-area-over')
      $(this).addClass('drag-and-drop-area-out')
    dragover: (e)->
      $(this).removeClass('drag-and-drop-area-out')
      $(this).addClass('drag-and-drop-area-over')
    dragleave: (e)->
      $(this).removeClass('drag-and-drop-area-over')
      $(this).addClass('drag-and-drop-area-out')
  }
