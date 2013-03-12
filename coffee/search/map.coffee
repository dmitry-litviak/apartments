map = 
  template       : JST["apartment"]
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
    @map_name    = "gmaps-canvas"
    @jmap        = $("#gmaps-canvas")
    @map_options =
      zoom: 10
      maxZoom: 18
      minZoom: 10
      center: new google.maps.LatLng(54.66102679999999, -107.2491508)
      mapTypeId: google.maps.MapTypeId.ROADMAP
    
    @geocoder      = undefined
    @map           = undefined
    @markers       = []
    
    @image  = new google.maps.MarkerImage("../img/marker-images/image.png", new google.maps.Size(18, 17), new google.maps.Point(0, 0), new google.maps.Point(9, 17))
    @shadow = new google.maps.MarkerImage("../img/marker-images/shadow.png", new google.maps.Size(30, 17), new google.maps.Point(0, 0), new google.maps.Point(9, 17))
    @shape =
      coord: [10, 0, 11, 1, 12, 2, 13, 3, 14, 4, 15, 5, 16, 6, 17, 7, 14, 8, 15, 9, 15, 10, 15, 11, 15, 12, 15, 13, 15, 14, 15, 15, 14, 16, 3, 16, 2, 15, 2, 14, 2, 13, 2, 12, 2, 11, 2, 10, 2, 9, 3, 8, 0, 7, 1, 6, 2, 5, 3, 4, 4, 3, 3, 2, 3, 1, 3, 0, 10, 0]
      type: "poly"
      
  bind_events: ->
    do @initialize_map
    
  initialize_map: ->
    @jmap.css('height', innerHeight/1.35)
    unless @search_options.lat == "" and @search_options.lng == ""
      @map_options.center = new google.maps.LatLng(@search_options.lat, @search_options.lng)  
    gmap = document.getElementById(@map_name)
    @map = new google.maps.Map(gmap, @map_options)
    do @get_markers
  
  add_to_favorite: (id, element, user_id) ->
      if !$(element).hasClass 'disabled'
        $.ajax
          url: SYS.baseUrl + 'search/set_favorite'
          data: $.param({id : id, user_id : user_id})
          type: 'POST'
          dataType: 'json'
          success: (res) =>
            if res.text = "success"
              $(element).addClass("disabled").html "In Favorites"
    
  
  get_markers: ->
    me = @
    $.ajax
      url: SYS.baseUrl + 'search/get_markers'
      data: $.param({options : me.search_options})
      type: 'POST'
      dataType: 'json'
      success: (res) =>
        if res.text = "success"
          $.each res.data, (i, item) ->
            marker     = new google.maps.Marker(
              position: new google.maps.LatLng(item.lat, item.lng)
              icon    : me.image
              shadow  : me.shadow
              shape   : me.shape
            )
            infowindow = new google.maps.InfoWindow(content: "")
            google.maps.event.addListener marker, "click", ->
              $.ajax
                url: SYS.baseUrl + 'search/get_apartment'
                data: $.param({id : item.id})
                type: 'POST'
                dataType: 'json'
                success: (res) =>
                  if res.text = "success"
                    infowindow.content = me.template({item: res.data})
                    infowindow.open me.map, marker
            me.markers.push(marker);
          markerClusterer = new MarkerClusterer(me.map, me.markers,
            maxZoom: 15
            gridSize: 50
            styles: null
          )      
 
$(document).ready ->
  do map.init