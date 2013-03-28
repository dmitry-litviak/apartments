create = 
  template       : JST["apartments/create_thumb"]
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
    #not map:
    @type_switcher = $("#type_switcher") 
    @type          = $("#type") 
    @form_create   = $("#form_create")
    @form_edit     = $("#form_edit")
    @fileupload    = $("#fileupload")
    @th_container  = $(".thumbnails")
    @image_counter = 0
    @images        = $(".t-images") 
    
  bind_events: ->
    do @gmaps_init
    do @autocomplete_init
    #not map:
    do @init_type_switcher
    do @prevent_enter
    do @init_validate
    do @init_uploader
    do @init_fancybox
  
  # move the marker to a new position, and center the map on it
  # initialise the google maps objects, and add listeners
  gmaps_init: ->
    # center of the universe
    if @lat_input.val() == "" and @lng_input.val() == ""
      latlng = new google.maps.LatLng(54.66102679999999, -107.2491508)
    else
      latlng = new google.maps.LatLng(@lat_input.val(), @lng_input.val())
    options =
      zoom: 3
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
    
    if @lat_input.val() != "" and @lng_input.val() != ""
      @marker.setPosition latlng
      @geocode_lookup "latLng", latlng

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
    @type_switcher.children().click (e) =>
      el = $(e.currentTarget)
      @type.val el.data("id")
      
  prevent_enter: ->
    $(window).keydown (event) ->
      if event.keyCode is 13
        event.preventDefault()
        false
        
  init_validate: ->
    form = null
    if @form_edit.length
      form = @form_edit
    else
      form = @form_create
    form.validate
      rules:
        title:
          minlength: 2
          required: true

        descr:
          minlength: 2
          required: true

        cost:
          required: true
          number: true

        address:
          required: true

        highlight: (label) ->
          $(label).closest(".control-group").addClass "error"

        success: (label) ->
          label.text("OK!").addClass("valid").closest(".control-group").addClass "success"
  
  remove_click: (object) ->
    el = $(object)
    $.ajax
      url: SYS.baseUrl + 'uploader/remove'
      data: $.param({url : el.parents("div.caption").prev().val()})
      type: 'POST'
      dataType: 'json'
      success: (res) =>
        if res.text == "success"
          el.parents('li').remove()
          
          
  remove_direct: (url) ->
    $.ajax
      url: SYS.baseUrl + 'uploader/remove'
      data: $.param({url : url})
      type: 'POST'
      dataType: 'json'
      success: (res) =>
        if res.text == "success"
          console.log(res.text)
           
  remove_click_existed: (object) ->
    el = $(object)
    $.ajax
      url: SYS.baseUrl + 'uploader/remove_existed'
      data: $.param({id : el.data('id')})
      type: 'POST'
      dataType: 'json'
      success: (res) =>
        if res.text == "success"
          el.parents('li').remove()
  
  init_fancybox: ->
    if @images.length != 0
      @images.fancybox
        transitionIn: "none"
        transitionOut: "none"
  
  init_uploader: ->
    me = @
    @fileupload.fileupload
      acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
      dataType: "json"
      fail: (e, data) ->
        alert("Only gif, jpeg and png are allowed")
      dataType: "json"
      done: (e, data) ->
        if data.result.text is 'success'
          me.image_counter++
          if me.image_counter > 1
            alert("Only 10 images allowed")
            me.remove_direct(data.result.url)
          else 
            tem = me.template({item: data.result, url: SYS.baseUrl})
            me.th_container.append tem
        else
          alert("Only gif, jpeg and png are allowed")

     
$(document).ready ->
  do create.init