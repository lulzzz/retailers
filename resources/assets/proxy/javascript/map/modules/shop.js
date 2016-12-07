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
    map.panBy(200,0)

    var  feature_width = '175px';
    var  logo_width    = '80px';
  } else {
    var  feature_width = '225px';
    var  logo_width    = '120px';
  }

  var sticker = $('<div class="storefront-sticker" style="max-width:'+feature_width+';"><div class="storefront-feature" data-sticker><div class="inner"><span class="flag-icon" style="background-image: url('+iso+');"></span><div class="logo"><img src="'+logo+'"></div></div><div class="tint"><img src="'+storefront+'" class="bg"></div></div><div class="row pt-1"><div class="col-xs-12 col-sm-12 col-md-6 pr-0"></div><div class="col-xs-12 col-sm-12 col-md-6"><a class="btn btn-secondary btn-sm pull-right" href="#">View Retailer</button></div></div></div>');

  $('div[data-sticker]').remove();
  sticker.appendTo('div[data-map]');

};
