map = 
  init: ->
    do @detect_elements
    do @bind_events
  
  detect_elements: ->  
    @map = document.getElementById("map_canvas")
    @map_options = 
      zoom: 8
      center: new google.maps.LatLng(-34.397, 150.644)
      mapTypeId: google.maps.MapTypeId.ROADMAP
      
  bind_events: ->
    do @initialize_map
    
  initialize_map: ->
    map = new google.maps.Map(@map, @map_options)
    contentString = "<div id=\"content\">Тут всё то про что должно быть рассказано</div>"
    infowindow = new google.maps.InfoWindow(content: contentString)
    marker = new google.maps.Marker(
      position: new google.maps.LatLng(-34.397, 150.644)
      map: map
      title: "Uluru (Ayers Rock)"
    )
    google.maps.event.addListener marker, "click", ->
      infowindow.open map, marker
        
 
$(document).ready ->
  do map.init