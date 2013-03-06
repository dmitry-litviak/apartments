user =
  init: ->
    do @detectElements
    do @bindEvents
    
  detectElements: ->    
    @form = $('.form-actions')
  
  bindEvents: ->
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
      

$(document).ready ->
  do user.init