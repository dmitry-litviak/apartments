map = 
  init: ->
    do @detect_elements
    do @bind_events
  
  detect_elements: ->  
    @gmap_input    = $("#gmaps-input-address")
    @gmap_error    = $("#gmaps-error")
    @lat_input     = $("#lat")
    @lng_input     = $("#lng")
    @map_name      = "gmaps-canvas"
    @map_options = 
      zoom: 8
      center: new google.maps.LatLng(54.66102679999999, -107.2491508)
      mapTypeId: google.maps.MapTypeId.ROADMAP
    
    @geocoder      = undefined
    @map           = undefined
    @marker        = undefined
    
      
  bind_events: ->
    do @initialize_map
    
  initialize_map: ->
    $(@map).css('height', innerHeight/2)
    unless @lat_input.val() == "" and @lng_input.val() == ""
      @map_options.center = new google.maps.LatLng(@lat_input.val(), @lng_input.val())  
    console.log @map_options
    @map = document.getElementById(@map_name)
    map = new google.maps.Map(@map, @map_options)
    
  get_markers: ->
    $.ajax
      url: SYS.baseUrl + 'search/get_markers'
      data: $.param({id : el.data('id')})
      type: 'POST'
      dataType: 'json'
      success: (res) =>
        if res.text = "success"
          $('.media#' + el.data('id')).remove()

  
        
 
$(document).ready ->
  do map.init