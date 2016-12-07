window.retailers = window.retailers || {};

var geocoding  = new google.maps.Geocoder;
var infowindow = new google.maps.InfoWindow();
var marker, i, loc;
var markers = new Array();

retailers.geo = function (appUrl, geoLat, geoLng, domain, locations) {

  var map = new google.maps.Map(document.getElementById('map-container'), {
    styles: styles,
    zoom: 7,
    mapTypeControl: false,
    streetViewControl: true,
    center: new google.maps.LatLng(geoLat, geoLng),
    mapTypeControl: false,
    streetViewControl: true,
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

  if(store.get('latitude')) {
    // Returning visitor.
    retailers.json(appUrl+'/app/'+store.get('latitude')+'/'+store.get('longitude')+'?shop='+domain);

  } else {
    // check if user browser has geolocation
    if (navigator.geolocation) {

      //Get users location
      navigator.geolocation.getCurrentPosition(function(position) {

        // Stores latitude and longitude of visitor address
        store.set('latitude', position.coords.latitude);
        store.set('longitude', position.coords.longitude);

        // New visitor
        retailers.json(appUrl+'/app/'+position.coords.latitude+'/'+position.coords.longitude+'?shop='+domain);

      }, function() {
        retailers.json(appUrl+'/app/'+geoLat+'/'+geoLng+'?shop='+domain);
      });
    } else {
      // Browser doesn't support Geolocation
      retailers.json(appUrl+'/app/'+geoLat+'/'+geoLng+'?shop='+domain);
    }
  }

  retailers.markers(locations);
};
