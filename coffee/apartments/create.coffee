create = 
  init: ->
    do @detect_elements
    do @bind_events
  
  detect_elements: ->  
    @gmap_input    = $("#gmaps-input-address")
    @gmap_error    = $("#gmaps-error")
    @lat_input     = $("#lat")
    @lng_input     = $("#lng")
    @geocoder      = undefined
    @map           = undefined
    @marker        = undefined
    @type_switcher = $("#type_switcher") 
    
  bind_events: ->
    do @gmaps_init
    do @autocomplete_init
    do @init_type_switcher
  
  # move the marker to a new position, and center the map on it
  # initialise the google maps objects, and add listeners
  gmaps_init: ->
    # center of the universe
    latlng = new google.maps.LatLng(51.751724, -1.255284)
    options =
      zoom: 2
      center: latlng
      mapTypeId: google.maps.MapTypeId.ROADMAP
    me = @

    # create our map object
    @map = new google.maps.Map(document.getElementById("gmaps-canvas"), options)

    # the geocoder object allows us to do latlng lookup based on address
    @geocoder = new google.maps.Geocoder()

    # the marker shows us the position of the latest address
    @marker = new google.maps.Marker(
      map: me.map
      draggable: true
    )

    # event triggered when marker is dragged and dropped
    google.maps.event.addListener @marker, "dragend", ->
      me.geocode_lookup "latLng", me.marker.getPosition()


    # event triggered when map is clicked
    google.maps.event.addListener @map, "click", (event) ->
      me.marker.setPosition event.latLng
      me.geocode_lookup "latLng", event.latLng

    @gmap_error.hide()
  
  update_map: (geometry) ->
    @map.fitBounds geometry.viewport
    @marker.setPosition geometry.location
  
  update_ui: (address, latLng) ->
    @gmap_input.autocomplete "close"
    @gmap_input.val address
    @lat_input.val latLng.lat()
    @lng_input.val latLng.lng()
  
  # Query the Google geocode object
  #
  # type: 'address' for search by address
  #       'latLng'  for search by latLng (reverse lookup)
  #
  # value: search query
  #
  # update: should we update the map (center map and position marker)?
  geocode_lookup: (type, value, update) ->
    me = @
    # default value: update = false
    update = (if typeof update isnt "undefined" then update else false)
    request = {}
    request[type] = value
    @geocoder.geocode request, (results, status) ->
      me.gmap_error.html ""
      me.gmap_error.hide()
      if status is google.maps.GeocoderStatus.OK
        # Google geocoding has succeeded!
        if results[0]
          # Always update the UI elements with new location data
          me.update_ui results[0].formatted_address, results[0].geometry.location
          # Only update the map (position marker and center map) if requested
          me.update_map results[0].geometry  if update
        else
          # Geocoder status ok but no results!?
          me.gmap_error.html "Sorry, something went wrong. Try again!"
          me.gmap_error.show()
      else
        # Google Geocoding has failed. Two common reasons:
        #   * Address not recognised (e.g. search for 'zxxzcxczxcx')
        #   * Location doesn't map to address (e.g. click in middle of Atlantic)
        if type is "address"
          # User has typed in an address which we can't geocode to a location
          me.gmap_error.html "Sorry! We couldn't find " + value + ". Try a different search term, or click the map."
          me.gmap_error.show()
        else
          # User has clicked or dragged marker to somewhere that Google can't do a reverse lookup for
          # In this case we display a warning, clear the address box, but fill in LatLng
          me.gmap_error.html "Woah... that's pretty remote! You're going to have to manually enter a place name."
          me.gmap_error.show()
          me.update_ui "", value

  
  
# initialise the jqueryUI autocomplete element
  autocomplete_init: ->
    me = @
    @gmap_input.autocomplete
      # source is the list of input options shown in the autocomplete dropdown.
      # see documentation: http://jqueryui.com/demos/autocomplete/
      source: (request, response) ->
        # the geocode method takes an address or LatLng to search for
        # and a callback function which should process the results into
        # a format accepted by jqueryUI autocomplete
        me.geocoder.geocode
          address: request.term
        , (results, status) ->
          response $.map(results, (item) ->
            label: item.formatted_address # appears in dropdown box
            value: item.formatted_address # inserted into input element when selected
            geocode: item # all geocode data: used in select callback event
          )
      # event triggered when drop-down option selected
      select: (event, ui) ->
        me.update_ui ui.item.value, ui.item.geocode.geometry.location
        me.update_map ui.item.geocode.geometry
    # triggered when user presses a key in the address box
    @gmap_input.bind "keydown", (event) =>
      if event.keyCode is 13
        @geocode_lookup "address", @gmap_input.val(), true
        # ensures dropdown disappears when enter is pressed
        @gmap_input.autocomplete "disable"
      else
        # re-enable if previously disabled above
        @gmap_input.autocomplete "enable"
    
    
  #not map code
    init_type_switcher: ->
      console.log @type_switcher.children()
#      @remove_buttons.click (e) =>
#        el = $(e.currentTarget)
      
 
$(document).ready ->
  do create.init