index = 
  init: ->
    do @detect_elements
    do @bind_events
  
  detect_elements: ->  
    @gmap_input    = $("#search")
    @gmap_error    = $("#gmaps-error")
    @lat_input     = $("#lat")
    @lng_input     = $("#lng")
    @geocoder      = undefined
    @map           = undefined
    @marker        = undefined
    #not map:
    @type_switcher = $("#type_switcher") 
    @type          = $("#type") 
    @form_search   = $("#form-search")
    @body          = $("body")
    $(".main").addClass("center-parent").height(window.innerHeight/1.5)
    
  bind_events: ->
#    do @gmaps_init
    do @body_bkg
    do @autocomplete_init
    #not map:
    do @form_submiter
    do @prevent_enter
    do @init_validate
#    do @init_type_switcher
  
  body_bkg: ->
    @body.addClass("bkg")
  
  update_ui: (address, latLng) ->
    @gmap_input.autocomplete "close"
    @gmap_input.val address
    @lat_input.val latLng.lat()
    @lng_input.val latLng.lng()
  
  geocode_lookup: (type, value, update) ->
    me = @
    update = (if typeof update isnt "undefined" then update else false)
    request = {}
    request[type] = value
    @geocoder.geocode request, (results, status) ->
      me.gmap_error.html ""
      me.gmap_error.hide()
      if status is google.maps.GeocoderStatus.OK
        if results[0]
          me.update_ui results[0].formatted_address, results[0].geometry.location
        else
          me.gmap_error.html "Sorry, something went wrong. Try again!"
          me.gmap_error.show()
      else
        if type is "address"
          me.gmap_error.html "Sorry! We couldn't find " + value + ". Try a different search term."
          me.gmap_error.show()
        else
          me.gmap_error.html "Woah... that's pretty remote! You're going to have to manually enter a place name."
          me.gmap_error.show()
          me.update_ui "", value

  
  
# initialise the jqueryUI autocomplete element
  autocomplete_init: ->
    me = @
    @geocoder = new google.maps.Geocoder()
    @gmap_input.autocomplete
      source: (request, response) ->
        me.geocoder.geocode
          address: request.term
        , (results, status) ->
          response $.map(results, (item) ->
            label: item.formatted_address
            value: item.formatted_address
            geocode: item
          )
      select: (event, ui) ->
        me.update_ui ui.item.value, ui.item.geocode.geometry.location
    @gmap_input.bind "keydown", (event) =>
      if event.keyCode is 13
        @geocode_lookup "address", @gmap_input.val(), true
        @gmap_input.autocomplete "disable"
      else
        @gmap_input.autocomplete "enable"
        
    
  #not map code
#  init_type_switcher: ->
#    @type_switcher.children().click (e) =>
#      console.log $(".btn-group .btn.active")
      
  form_submiter: ->
    me = @
    @form_search.submit =>
      if @form_search.valid()
        $(".btn-group .btn.active").each ->
          input = document.createElement("input")
          input.setAttribute "type", "hidden"
          input.setAttribute "name", "type_id[]"
          input.setAttribute "value", @value
          me.form_search.append input
      
  prevent_enter: ->
    $(window).keydown (event) ->
      if event.keyCode is 13
        event.preventDefault()
        false
        
  init_validate: ->
    @form_search.validate
      rules:
        search:
          required: true

        highlight: (label) ->
          $(label).closest(".control-group").addClass "error"

        success: (label) ->
          label.text("OK!").addClass("valid").closest(".control-group").addClass "success"
   

     
$(document).ready ->
  do index.init