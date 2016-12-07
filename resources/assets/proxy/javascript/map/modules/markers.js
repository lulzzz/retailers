retailers.markers = function (locations) {
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
};
