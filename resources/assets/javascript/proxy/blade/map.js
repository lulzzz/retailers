for (i = 0; i < locations.length; i++) {  


  var destination = [444, 333];
  var distance_text = calculateDistance(origin, destination);


  marker = new google.maps.Marker({
    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
    map: map,
    icon: locations[i][4],
  });

  markers.push(marker);

  google.maps.event.addListener(marker, 'click', (function(marker, i) {
    return function() {
      infowindow.setContent(locations[i][4]);
    }
  })(marker, i));
 


 
  function calculateDistance(origin, destination) {
    var service = new google.maps.DistanceMatrixService();
    service.getDistanceMatrix(
    {
      origins: [origin],
      destinations: [destination],
      travelMode: google.maps.TravelMode.DRIVING,
      unitSystem: google.maps.UnitSystem.IMPERIAL,
      avoidHighways: false,
      avoidTolls: false
    }, callback);
  }

  function callback(response, status) {
    if (status != google.maps.DistanceMatrixStatus.OK) {
      $('#result').html(err);
    } else {
      var origin = response.originAddresses[0];
      var destination = response.destinationAddresses[0];
      if (response.rows[0].elements[0].status === "ZERO_RESULTS") {
        $('#result').html("Better get on a plane. There are no roads between " 
          + origin + " and " + destination);
      } else {
        var distance = response.rows[0].elements[0].distance;
        var distance_value = distance.value;
        var distance_text = distance.text;
        var miles = distance_text.substring(0, distance_text.length - 3);
        console.log(miles);
        $('#result').html("It is " + miles + " miles from " + origin + " to " + destination);
      }
    }
  }

}

$('.location').on('click', function() {

  var latlonStr   = $(this).data('location');
  var storefront  = $(this).data('storefront');
  var logo = $(this).data('logo');
  var iso_flag = $(this).data('iso');
  var coords = latlonStr.split(",");
  var latLng = new google.maps.LatLng(coords[0], coords[1]);
  var sticker = $('div[data-sticker]');

  var feature_width, logo_width;
  if ($('.container-fluid').width() < 1000) {
    feature_width = '180px';
    logo_width    = '90px';
  } else {
    feature_width = '250px';
    logo_width    = '120px';
  }

  var sticker_src = $('<div class="storefront-sticker" style="max-width:'+feature_width+';"><div class="storefront-feature" data-sticker><div class="inner"><span class="flag-icon" style="background-image: url('+iso_flag+');"></span><div class="logo"><img src="'+logo+'"></div></div><div class="tint"><img src="'+storefront+'" class="bg"></div></div><div class="row pt-1"><div class="col-xs-12 col-sm-12 col-md-6 pr-0"><button class="btn btn-secondary btn-sm pull-left" type="button">Find Directions</button></div><div class="col-xs-12 col-sm-12 col-md-6"><a class="btn btn-secondary btn-sm pull-right" href="#">View Retailer</button></div></div></div>');

  sticker.remove();
  sticker_src.appendTo('div[data-map]');

  if (marker && marker.setMap) {
    marker.setMap(null);
    //map.setZoom(10);
  }


  geocoder.geocode({'location': latLng}, function(results, status) {
    if (status === 'OK') {
      if (results[1]) {
        pan(latLng);
        marker = new google.maps.Marker({
          position: latLng,
          map: map
        });
        infowindow.setContent('<address><b>'+ results[0].address_components[0].long_name+'&nbsp;' + results[0].address_components[1].long_name +'<br>'+results[0].address_components[5].long_name+'<br>'+ results[0].address_components[6].long_name +',&nbsp;'+ results[0].address_components[4].long_name +'</b></address>');

        infowindow.open(map, marker);
      } else {
        window.alert('No results found');
      }
    } else {
      window.alert('Geocoder failed due to: ' + status);
    }
  });


});

google.maps.event.addListener(marker, 'click', function() {
  infowindow.close();
});

function pan(latLng) {
 map.panTo(latLng)
 map.setZoom(15);
}