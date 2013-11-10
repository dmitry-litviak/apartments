register =
  init: ->
    do @detectElements
    do @bindEvents
    
  detectElements: ->    
    @form          = $('.form-actions')
    @type_switcher = $("#type_switcher") 
    @type          = $("#type") 
  
  bindEvents: ->
    do @initValidation
    do @init_type_switcher

  init_type_switcher: ->
    @type_switcher.children().click (e) =>
      el = $(e.currentTarget)
      @type.val el.data("id")
  
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
        
        password:
          minlength: 6
          required: true

      highlight: (label) ->
        $(label).closest(".control-group").addClass "error"
      success: (label) ->
        $(label).text("OK!").addClass("valid").closest(".control-group").addClass "success"
      

$(document).ready ->
  do register.init