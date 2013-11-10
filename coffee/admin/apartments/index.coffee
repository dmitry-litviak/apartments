index = 
  init: ->
    do @detect_elements
    do @bind_events
  
  detect_elements: ->
    @modal          = $('#myModal')
    @table          = $("table")
      
  bind_events: ->
    do @init_table
#    do @fin_delete_clicker
#    do @delete_clicker
  
  reinit_stuff: ->
    do index.fin_delete_clicker
    do index.delete_clicker
    do index.status_buttons_clicker
  
  delete_clicker: ->
    @delete_button = $('.delete')
    @delete_button.click (e) =>
      el = $(e.currentTarget)
      @fin_delete_btn.attr 'data-id', el.data('id')
      @modal.modal()
      
  init_table: ->
    @oTable = @table.dataTable
      sPaginationType: "bootstrap"
      bProcessing    : true
      bServerSide    : true
      iDisplayLength : 10
      bRetrieve      : true
      sAjaxSource    : SYS.baseUrl + "admin/apartments/getAjaxData"
      fnDrawCallback : index.reinit_stuff
  
  status_buttons_clicker: ->
    @status_buttons = $(".status")
    @status_buttons.click (e) =>
      el = $(e.currentTarget)
      text_status = el.html()
      $.ajax
        url: SYS.baseUrl + 'admin/apartments/change_status'
        data: $.param({id : el.data('id')})
        type: 'POST'
        dataType: 'json'
        success: (res) =>
          if res.text = "success"
            if text_status == "OK"
              el.removeClass("label-success").addClass("label-important")
              el.html "Pending"
            else
              el.removeClass("label-important").addClass("label-success")
              el.html "OK"
  
  fin_delete_clicker: ->
    @fin_delete_btn = $('#final_delete')
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
            @oTable.fnDeleteRow $(el).parents('tr')[0]

        
 
$(document).ready ->
  do index.init