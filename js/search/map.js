// Generated by CoffeeScript 1.4.0
var map;

map = {
  template: JST["apartment"],
  init: function() {
    this.detect_elements();
    return this.bind_events();
  },
  detect_elements: function() {
    this.gmap_input = $("#gmaps-input-address");
    this.gmap_error = $("#gmaps-error");
    this.search_options = {
      lat: $("#lat").val(),
      lng: $("#lng").val(),
      to: $("#to").val(),
      from: $("#from").val(),
      type_id: $("#type_id").val()
    };
    this.map_name = "gmaps-canvas";
    $("#" + this.map_name).show();
    this.jmap = $("#gmaps-canvas");
    this.map_options = {
      zoom: 7,
      maxZoom: 18,
      minZoom: 7,
      center: new google.maps.LatLng(54.66102679999999, -107.2491508),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    this.geocoder = void 0;
    this.map = void 0;
    this.markers = [];
    this.image = new google.maps.MarkerImage("../img/marker-images/image.png", new google.maps.Size(18, 17), new google.maps.Point(0, 0), new google.maps.Point(9, 17));
    this.shadow = new google.maps.MarkerImage("../img/marker-images/shadow.png", new google.maps.Size(30, 17), new google.maps.Point(0, 0), new google.maps.Point(9, 17));
    return this.shape = {
      coord: [10, 0, 11, 1, 12, 2, 13, 3, 14, 4, 15, 5, 16, 6, 17, 7, 14, 8, 15, 9, 15, 10, 15, 11, 15, 12, 15, 13, 15, 14, 15, 15, 14, 16, 3, 16, 2, 15, 2, 14, 2, 13, 2, 12, 2, 11, 2, 10, 2, 9, 3, 8, 0, 7, 1, 6, 2, 5, 3, 4, 4, 3, 3, 2, 3, 1, 3, 0, 10, 0],
      type: "poly"
    };
  },
  bind_events: function() {
    return this.initialize_map();
  },
  initialize_map: function() {
    var gmap;
    this.jmap.css('height', innerHeight / 1.35);
    if (!(this.search_options.lat === "" && this.search_options.lng === "")) {
      this.map_options.center = new google.maps.LatLng(this.search_options.lat, this.search_options.lng);
    }
    gmap = document.getElementById(this.map_name);
    this.map = new google.maps.Map(gmap, this.map_options);
    return this.get_markers();
  },
  add_to_favorite: function(id, element, user_id) {
    var _this = this;
    if (!$(element).hasClass('disabled')) {
      return $.ajax({
        url: SYS.baseUrl + 'search/set_favorite',
        data: $.param({
          id: id,
          user_id: user_id
        }),
        type: 'POST',
        dataType: 'json',
        success: function(res) {
          if (res.text = "success") {
            return $(element).addClass("disabled").html("In Favorites");
          }
        }
      });
    }
  },
  get_markers: function() {
    var me,
      _this = this;
    me = this;
    return $.ajax({
      url: SYS.baseUrl + 'search/get_markers',
      data: $.param({
        options: me.search_options
      }),
      type: 'POST',
      dataType: 'json',
      success: function(res) {
        var markerClusterer;
        if (res.text = "success") {
          $.each(res.data, function(i, item) {
            var infowindow, marker;
            marker = new google.maps.Marker({
              position: new google.maps.LatLng(item.lat, item.lng),
              icon: me.image,
              shadow: me.shadow,
              shape: me.shape
            });
            infowindow = new google.maps.InfoWindow({
              content: ""
            });
            google.maps.event.addListener(marker, "click", function() {
              var _this = this;
              return $.ajax({
                url: SYS.baseUrl + 'search/get_apartment',
                data: $.param({
                  id: item.id
                }),
                type: 'POST',
                dataType: 'json',
                success: function(res) {
                  if (res.text = "success") {
                    infowindow.content = me.template({
                      item: res.data
                    });
                    return infowindow.open(me.map, marker);
                  }
                }
              });
            });
            return me.markers.push(marker);
          });
          return markerClusterer = new MarkerClusterer(me.map, me.markers, {
            maxZoom: 15,
            gridSize: 50,
            styles: [
              {
                height: 29,
                url: SYS.baseUrl + "img/marker-images/clusterMarker1.png",
                width: 29
              }, {
                height: 34,
                url: SYS.baseUrl + "img/marker-images/clusterMarker2.png",
                width: 34
              }, {
                height: 47,
                url: SYS.baseUrl + "img/marker-images/clusterMarker3.png",
                width: 47
              }, {
                height: 56,
                url: SYS.baseUrl + "img/marker-images/clusterMarker4.png",
                width: 56
              }, {
                height: 56,
                url: SYS.baseUrl + "img/marker-images/clusterMarker4.png",
                width: 56
              }
            ]
          });
        }
      }
    });
  }
};

$(document).ready(function() {
  return map.init();
});
