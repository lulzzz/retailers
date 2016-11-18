
/**
* Retailers Javascript Controller
*
* jQuery interface for the "Retailers" Store Locator.
* This logic controls the proccess within the map and is using:
*
*/


window.retailers = window.retailers || {};

var geocoding  = new google.maps.Geocoder;
var infowindow = new google.maps.InfoWindow();

//var $('.location') = $('.location');


/**
* Map Markers
*
*/
retailers.markers = function (latlng, map) {
  marker = new google.maps.Marker({
    position: latlng,
    map: map
  });
};


/**
* Map Pan
*
*/
retailers.pan = function(latlng, zoom) {
  map.panTo(latlng);
  map.setCenter(latlng);
  map.setZoom(zoom);
};


/**
* Retailers Shop
*
* Geocoder used within "qwest" and is initated if
* user allows browser to acquire their location or
* mapping to a selection Retailer within the list.
*
*/
retailers.shop = function (latitude, longitude, iso, storefront, logo) {

  var newlatlng  = new google.maps.LatLng(latitude, longitude);

  if (marker && marker.setMap) {
    marker.setMap(null);
  }

  geocoding.geocode({'location': newlatlng}, function(results, status) {
    if (status === 'OK') {

      retailers.pan(newlatlng, 15);
      retailers.markers(newlatlng, map);

      infowindow.setContent('<address><b>'+ results[0].address_components[0].long_name+'&nbsp;' + results[0].address_components[1].long_name +'<br>'+results[0].address_components[5].long_name+'<br>'+ results[0].address_components[6].long_name +',&nbsp;'+ results[0].address_components[4].long_name +'</b></address>');

      infowindow.open(map, marker);
      $('.list').show();

    } else {
      window.alert('Geocoder failed due to: ' + status);
    }
  });

  if ($('.container-fluid').width() < 1000) {
  var  feature_width = '170px';
  var  logo_width    = '80px';
  } else {
  var  feature_width = '250px';
  var  logo_width    = '120px';
  }

  var sticker = $('<div class="storefront-sticker" style="max-width:'+feature_width+';"><div class="storefront-feature" data-sticker><div class="inner"><span class="flag-icon" style="background-image: url('+iso+');"></span><div class="logo"><img src="'+logo+'"></div></div><div class="tint"><img src="'+storefront+'" class="bg"></div></div><div class="row pt-1"><div class="col-xs-12 col-sm-12 col-md-6 pr-0"><button class="btn btn-secondary btn-sm pull-left" type="button">Find Directions</button></div><div class="col-xs-12 col-sm-12 col-md-6"><a class="btn btn-secondary btn-sm pull-right" href="#">View Retailer</button></div></div></div>');

  $('div[data-sticker]').remove();
  sticker.appendTo('div[data-map]');

};



/**
* Retailers Json
*
* Using qwest.js, and list.jswe re-populate the
* retailers list with new results based on geoip location.
*
*/
retailers.json = function(url) {

  qwest.get(url)
  .then(function(xhr, response) {
    $('#locating').hide();

    // Re-structure the listed retailers
    listings.clear();
    listings.add(response);
    listings.sort('distance');

    // Select first result based on distance.

    retailers.shop(
      $('.location').closest('li').first().data('latitude'),
      $('.location').closest('li').first().data('longitude'),
      $('.location').closest('li').first().data('country_code'),
      $('.location').closest('li').first().data('storefront_lg'),
      $('.location').closest('li').first().data('logo_lg')
    );
  })

  .complete(function() {

    // Select via data attribute value (injected inline)

    $('.location').on('click', function() {
      retailers.shop(
        $(this).data('latitude'),
        $(this).data('longitude'),
        $(this).data('country_code'),
        $(this).data('storefront_lg'),
        $(this).data('logo_lg')
      );
    });
  });
};
