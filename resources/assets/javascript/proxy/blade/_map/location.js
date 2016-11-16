
/**
* Retailers
*
* jQuery interface for the "Retailers" Store Locator.
* This logic controls the proccess within the map.
*
*/


window.retailers = window.retailers || {};

var geocoding  = new google.maps.Geocoder;
var infowindow = new google.maps.InfoWindow();


retailers.markers = function (latlng, map) {

  marker = new google.maps.Marker({
    position: latlng,
    map: map
  });

};

retailers.pan = function(latlng, zoom) {

  map.panTo(latlng);
  map.setCenter(latlng);
  map.setZoom(zoom);

};

retailers.shop = function (latitude, longitude, iso, storefront) {

  var newlatlng  = new google.maps.LatLng(latitude, longitude);

  retailers.box(iso, storefront);

  if (marker && marker.setMap) {
    marker.setMap(null);
  }

  geocoding.geocode({'location': newlatlng}, function(results, status) {
    if (status === 'OK') {

      retailers.pan(newlatlng, 15);
      retailers.markers(newlatlng, map);

      infowindow.setContent('<address><b>'+ results[0].address_components[0].long_name+'&nbsp;' + results[0].address_components[1].long_name +'<br>'+results[0].address_components[5].long_name+'<br>'+ results[0].address_components[6].long_name +',&nbsp;'+ results[0].address_components[4].long_name +'</b></address>');

      infowindow.open(map, marker);

    } else {
      window.alert('Geocoder failed due to: ' + status);
    }
  });

};



retailers.box = function (iso, storefront) {

  var feature_width, logo_width;

  if ($('.container-fluid').width() < 1000) {
    feature_width = '180px';
    logo_width    = '90px';
  } else {
    feature_width = '250px';
    logo_width    = '120px';
  }

  var sticker_src = $('<div class="storefront-sticker" style="max-width:'+feature_width+';"><div class="storefront-feature" data-sticker><div class="inner"><span class="flag-icon" style="background-image: url('+iso+');"></span><div class="logo"></div></div><div class="tint"><img src="'+storefront+'" class="bg"></div></div><div class="row pt-1"><div class="col-xs-12 col-sm-12 col-md-6 pr-0"><button class="btn btn-secondary btn-sm pull-left" type="button">Find Directions</button></div><div class="col-xs-12 col-sm-12 col-md-6"><a class="btn btn-secondary btn-sm pull-right" href="#">View Retailer</button></div></div></div>');

  var sticker = $('div[data-sticker]');
  sticker.remove();
  sticker_src.appendTo('div[data-map]');
}
