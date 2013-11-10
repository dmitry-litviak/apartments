login =
  init: ->
    do @detectElements
    do @bindEvents
    
  detectElements: ->    
    @form = $('.form-actions')
  
  bindEvents: ->
    do @initValidation
  
  initValidation: ->
    @form.validate
      rules:
        email:
          required: true
          email: true
        
        password:
          minlength: 6
          required: true

      highlight: (label) ->
        $(label).closest(".control-group").addClass "error"
      success: (label) ->
        $(label).text("OK!").addClass("valid").closest(".control-group").addClass "success"
      

$(document).ready ->
  do login.init