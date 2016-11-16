
if (navigator.geolocation) {

  geocoding.geocode({'address': '{{$iso}}'}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      var latlng = new google.maps.LatLng(
        results[0].geometry.location.lat(),
        results[0].geometry.location.lng()
      );
      retailers.pan(latlng, 9);
    } else {
      window.alert("Something got wrong " + status);
    }
  });

  navigator.geolocation.getCurrentPosition(function(position) {


    qwest.get('/app/'+position.coords.latitude+'/'+position.coords.longitude+'?shop={{$domain}}')

    .then(function(xhr, response) {

      $('#locating').hide();

      listings.clear();
      listings.add(response);
      listings.sort('distance');

      retailers.shop(
        $('.location').closest('li').first().data('latitude'),
        $('.location').closest('li').first().data('longitude'),
        $('.location').closest('li').first().data('iso'),
        $('.location').closest('li').first().data('storefront')
      );
    })

    .complete(function() {

      $('.location').on('click', function() {
        retailers.shop(
          $(this).data('latitude'),
          $(this).data('longitude'),
          $(this).data('iso'),
          $(this).data('storefront')
        );
      });

    });


  }, function() {
    handleLocationError(true, infoWindow, map.getCenter());
  });
} else {
  // Browser doesn't support Geolocation
  handleLocationError(false, infoWindow, map.getCenter());
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(latlng);
  infoWindow.setContent(browserHasGeolocation ?
    'Error: The Geolocation service failed.' :
    'Error: Your browser doesn\'t support geolocation.'
  );
}
