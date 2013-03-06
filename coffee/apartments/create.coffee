create = 
  init: ->
    do @detect_elements
    do @bind_events
  
  detect_elements: ->  
    @geocomplete  = $("#geocomplete")
    @lat          = $("input[name=lat]")
    @lng          = $("input[name=lng]")
    @reset_button = $("#reset")
    @find_button  = $("#find")
    
  bind_events: ->
    do @init_geocomplete
#    do @init_draggable
#    do @reset
    do @find_press
    
  init_geocomplete: ->
    @geocomplete.geocomplete
      map: ".map_canvas"
#      details: "form "
#      markerOptions:
#        draggable: true
  
#  init_draggable: ->
#    @geocomplete.bind "geocode:dragged", (event, latLng) =>
#      console.log latLng
#      @lat.val latLng.lat()
#      @lng.val latLng.lng()
#      @reset_button.show()
#  
  reset: ->
    @reset_button.click =>
      @geocomplete.geocomplete "resetMarker"
      @reset_button.hide()
      false

  find_press: ->
    $("#find").click(=>
      @geocomplete.trigger "geocode"
    ).click()
 
$(document).ready ->
  do create.init