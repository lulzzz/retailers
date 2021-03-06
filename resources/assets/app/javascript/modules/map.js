
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

      map.panTo(newlatlng);
      map.setCenter(newlatlng);
      map.setZoom(15);

      marker = new google.maps.Marker({
        position: newlatlng,
        map: map
      });

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

  var sticker = $('<div class="storefront-sticker" style="max-width:'+feature_width+';"><div class="storefront-feature" data-sticker><div class="inner"><span class="flag-icon" style="background-image: url('+iso+');"></span><div class="logo"><img src="'+logo+'"></div></div><div class="tint"><img src="'+storefront+'" class="bg"></div></div></div>');

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
      $('.location').closest('li').first().data('storefront_md'),
      $('.location').closest('li').first().data('logo_md')
    );
  })

  .complete(function() {

    // Select via data attribute value (injected inline)

    $('.location').on('click', function() {
      retailers.shop(
        $(this).data('latitude'),
        $(this).data('longitude'),
        $(this).data('country_code'),
        $(this).data('storefront_md'),
        $(this).data('logo_md')
      );
    });
  });
};


for (i = 0; i < locations.length; i++) {

  marker = new google.maps.Marker({
    position: new google.maps.LatLng(locations[i][0], locations[i][1]),
    map: map,
    icon: locations[i][5],
  });

  markers.push(marker);

  google.maps.event.addListener(marker, 'click', (function(marker, i) {
    return function() {
      retailers.shop(
        locations[i][0], //latitude
        locations[i][1], //longitude
        locations[i][2], //iso
        locations[i][3], //storefront_lg
        locations[i][4]  //logo_lg
      );
    }
  })(marker, i));

}
