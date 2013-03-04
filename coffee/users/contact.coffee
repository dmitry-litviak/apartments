contact = 
  init: ->
    do @detectElements
    do @bindEvents
  
  detectElements: ->  
    @buttons =
      request_callback    : $('#request_callback')
      send_secure_message : $('#send_secure_message')
      
  bindEvents: ->
    @buttons.request_callback.on 'click', => do @requestCallback
    
  requestCallback: (e) ->
    $.ajax
      url: SYS.baseUrl + 'user/request_callback'
      dataType: 'json'
      beforeSend:    => $("#request-btn").addClass("disabled").removeAttr('data-toggle').attr('href', 'javscript:void(0)')
      success: (res) =>
        (new Alert).setLayout('main').setStatus('success').setMessage('Request was send').render()
        
 
$(document).ready ->
  do contact.init