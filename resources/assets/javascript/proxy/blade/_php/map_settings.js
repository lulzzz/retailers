var marker, i, loc;
var markers = new Array();
var infowindow = new google.maps.InfoWindow();
var geocoder = new google.maps.Geocoder;

var map = new google.maps.Map(document.getElementById('map-container'), {
    styles: styles,
    zoom: 6,
    mapTypeControl: false,
    streetViewControl: true,
    center: new google.maps.LatLng({{$geo['lat']}}, {{$geo['lon']}}),
    scrollwheel: false,
    mapTypeControl: true,
    scaleControl: true,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    mapTypeControlOptions: {
      position: google.maps.ControlPosition.RIGHT_BOTTOM
  },
  zoomControl: true,
  zoomControlOptions: {
      position: google.maps.ControlPosition.LEFT_TOP
  },
  streetViewControl: true,
  streetViewControlOptions: {
      position: google.maps.ControlPosition.LEFT_TOP
  }
});


@if(Route::current()->getName() == 'proxy_country')

geocoder.geocode({'address': '{{$iso}}'}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {

        var lat = results[0].geometry.location.lat();
        var lon = results[0].geometry.location.lng();
        var latlng = new google.maps.LatLng(lat, lon);

        pan(latlng);
        map.setCenter(latlng);
        map.setZoom(6);

    } else {
      alert("Something got wrong " + status);
  }
});

@elseif(Route::current()->getName() == 'proxy_city')

geocoder.geocode({'address': '{{$iso}}'}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {

        var lat = results[0].geometry.location.lat();
        var lon = results[0].geometry.location.lng();
        var latlng = new google.maps.LatLng(lat, lon);

        pan(latlng);
        map.setCenter(latlng);
        map.setZoom(13);

    } else {
      alert("Something got wrong " + status);
  }
});

@else
var map = new google.maps.Map(document.getElementById('map-container'), {
    styles: styles,
    zoom: 6,
    mapTypeControl: false,
    streetViewControl: true,
    center: new google.maps.LatLng({{$geo['lat']}}, {{$geo['lon']}}),
    scrollwheel: false,
    mapTypeControl: true,
    scaleControl: true,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    mapTypeControlOptions: {
      position: google.maps.ControlPosition.RIGHT_BOTTOM
  },
  zoomControl: true,
  zoomControlOptions: {
      position: google.maps.ControlPosition.LEFT_TOP
  },
  streetViewControl: true,
  streetViewControlOptions: {
      position: google.maps.ControlPosition.LEFT_TOP
  }
});
@endif