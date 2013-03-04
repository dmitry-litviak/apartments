user =
  init: ->
    do @detectElements
    do @bindEvents
    
  detectElements: ->    
    @form = $('.form-actions')
  
  bindEvents: ->
    do @initUploader
    do @initValidation
    picker = $('.date').datepicker()
    picker.on 'changeDate', (ev) ->
      picker.datepicker "hide"
  
  
  initValidation: ->
    @form.validate
      rules:
        first_name:
          minlength: 2
          required: true
          
        last_name:
          minlength: 2
          required: true
          
        email:
          required: true
          email: true

      highlight: (label) ->
        $(label).closest(".control-group").addClass "error"

  initUploader: ->
    new uploader 
      selector    : $('input[type=file]')
      addCallback: (e, data) =>
        $('#avatar-img').attr 'src', SYS.spinerUrl
        
      doneCallback: (e, data) =>
        $('#avatar-img').attr 'src', SYS.baseUrl + data.result.data
        $('#avatar').val data.result.data

      progressCallback: (progress) =>
        $(".upload-progress").text "uploading... #{progress}%"
      

$(document).ready ->
  do user.init