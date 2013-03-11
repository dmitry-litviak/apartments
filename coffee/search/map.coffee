map = 
  init: ->
    do @detect_elements
    do @bind_events
  
  detect_elements: ->  
    @gmap_input     = $("#gmaps-input-address")
    @gmap_error     = $("#gmaps-error")
    @search_options = 
      lat     : $("#lat").val()
      lng     : $("#lng").val()
      to      : $("#to").val()
      from    : $("#from").val()
      type_id : $("#type_id").val()
    @map_name       = "gmaps-canvas"
    @jmap           = $("#gmaps-canvas")
    @map_options =
      zoom: 10
      maxZoom: 18
      minZoom: 10
      center: new google.maps.LatLng(54.66102679999999, -107.2491508)
      mapTypeId: google.maps.MapTypeId.ROADMAP
    
    @geocoder      = undefined
    @map           = undefined
    @markers       = []
    
      
  bind_events: ->
    do @initialize_map
    
  initialize_map: ->
    @jmap.css('height', innerHeight/1.6)
    unless @search_options.lat == "" and @search_options.lng == ""
      @map_options.center = new google.maps.LatLng(@search_options.lat, @search_options.lng)  
    map = document.getElementById(@map_name)
    @map = new google.maps.Map(map, @map_options)
    do @get_markers
    
  get_markers: ->
    me = @
    $.ajax
      url: SYS.baseUrl + 'search/get_markers'
      data: $.param({options : me.search_options})
      type: 'POST'
      dataType: 'json'
      success: (res) =>
        if res.text = "success"
          console.log res
          $.each res.data, (i, item) ->
            me.markers.push(new google.maps.Marker(position: new google.maps.LatLng(item.lat, item.lng)));
          markerClusterer = new MarkerClusterer(me.map, me.markers,
            maxZoom: 15
            gridSize: 50
            styles: null
          )

  
        
 
$(document).ready ->
  do map.init