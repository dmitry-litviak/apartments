index = 
  init: ->
    do @detect_elements
    do @bind_events
  
  detect_elements: ->
    @delete_button  = $(".delete")
    @modal          = $('#myModal')
    @title_modal    = $('#title-modal')
    @fin_delete_btn = $('#final_delete')
      
  bind_events: ->
    do @delete_clicker
    do @fin_delete_clicker
    
  delete_clicker: ->
    @delete_button.click (e) =>
      el = $(e.currentTarget)
      @title_modal.html $('.media#' + el.data('id') + ' .media-heading').html()
      @fin_delete_btn.attr 'data-id', el.data('id')
      @modal.modal()
  
  fin_delete_clicker: ->
    @fin_delete_btn.click (e) =>
      el = $(e.currentTarget)
      @modal.modal('hide')
      $.ajax
        url: SYS.baseUrl + 'admin/apartments/delete'
        data: $.param({id : el.data('id')})
        type: 'POST'
        dataType: 'json'
        success: (res) =>
          if res.text = "success"
            $('.media#' + el.data('id')).remove()

        
 
$(document).ready ->
  do index.init