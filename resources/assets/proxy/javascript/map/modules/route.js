
$('.route').on('click', function() {
  function initMap() {
      var pointA = new google.maps.LatLng(store.get('latitude'), store.get('longitude')),
          pointB = new google.maps.LatLng(store.get('retailer_latitude'), store.get('retailer_longitude'));
          map.panTo(pointA);
          map.setCenter(pointA);
          map.setZoom(7);

          // Instantiate a directions service.
        var   directionsService = new google.maps.DirectionsService,
          directionsDisplay = new google.maps.DirectionsRenderer({
              map: map
          }),
          markerA = new google.maps.Marker({
              position: pointA,
              title: "Your Location",
              label: "A",
              map: map
          }),
          markerB = new google.maps.Marker({
              position: pointB,
              title: "Retailer",
              label: "B",
              map: map
          });

      // get route from A to B
      calculateAndDisplayRoute(directionsService, directionsDisplay, pointA, pointB);

  }



  function calculateAndDisplayRoute(directionsService, directionsDisplay, pointA, pointB) {
      directionsService.route({
          origin: pointA,
          destination: pointB,
          avoidTolls: true,
          avoidHighways: false,
          travelMode: google.maps.TravelMode.DRIVING
      }, function (response, status) {
          if (status == google.maps.DirectionsStatus.OK) {
              directionsDisplay.setDirections(response);
          } else {
              window.alert('Directions request failed due to ' + status);
          }
      });
  }

  initMap();
});
