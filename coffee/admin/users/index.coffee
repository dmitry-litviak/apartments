index =
  init: ->
    do @detectElements
    do @bindEvents
    
  detectElements: ->    
    @table = $("table")
  
  bindEvents: ->
    do @initTable
  
  remove: (id, el) ->
    if confirm "Remove this user?"
      $.ajax
        url: SYS.baseUrl + "admin/users/delete"
        type: "POST"
        dataType: "JSON"
        data: $.param
          id: id
        success: (res) =>  
          @oTable.fnDeleteRow $(el).parents('tr')[0]
          
          
  
  initTable: ->
    @oTable = @table.dataTable
      sPaginationType: "bootstrap"
      bProcessing    : true
      bServerSide    : true
      iDisplayLength : 10
      bRetrieve      : true
      sAjaxSource    : SYS.baseUrl + "admin/apartments/getAjaxData"

$(document).ready ->
  do index.init