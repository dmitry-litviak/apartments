user =
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
        name:
          minlength: 2
          required: true
        email:
          required: true
          email: true
        phone:
          required: true
          minlength: 6
        cur_addr:
          required: true
          minlength: 6
        cur_city_prov:
          required: true
          minlength: 6
        cur_time:
          required: true
          minlength: 6
        cur_post:
          required: true
          minlength: 5
        source:
          required: true
          minlength: 6
      highlight: (label) ->
        $(label).closest(".control-group").addClass "error"
      

$(document).ready ->
  do user.init