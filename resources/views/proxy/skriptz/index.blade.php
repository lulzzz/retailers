<script>
loadjs(['{{ env('APP_URL') }}/assets/proxy/js/map_styles.min.js',
'https://cdnjs.cloudflare.com/ajax/libs/qwest/4.4.5/qwest.min.js'],
 { success: function() {
   skriptz.init();
 }
});

window.skriptz = window.skriptz || {};

skriptz.init = function () {
 skriptz.maps();

};

skriptz.maps = function () {
  if (document.getElementById('map-container')){

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
        $('.list').removeClass('list-disabled');


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

        $('.location').closest('li').first().addClass('active');

      })

      .complete(function() {

        // Select via data attribute value (injected inline)

        $('.location').on('click', function() {
          $('.list > li').removeClass('active');
          $(this).toggleClass('active');

          store.set('retailer_latitude', $(this).data('latitude'));
          store.set('retailer_longitude', $(this).data('longitude'));

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

    var is_internetExplorer11= navigator.userAgent.toLowerCase().indexOf('trident') > -1;

    var $marker_url = ( is_internetExplorer11 ) ? '//cdn.shopify.com/s/files/1/0638/4637/t/2/assets/favicon-32x32.png?8466146662870439663' : '//cdn.shopify.com/s/files/1/0638/4637/t/2/assets/favicon-32x32.png?8466146662870439663';

    var $marker_url2 = ( is_internetExplorer11 ) ? '//cdn.shopify.com/s/files/1/0638/4637/t/2/assets/favicon-32x32.png?8466146662870439663' : '//cdn.shopify.com/s/files/1/0638/4637/t/2/assets/favicon-32x32.png?8466146662870439663';

    var locations = [@foreach($retailers as $key => $value)[{{$value['latitude']}},{{$value['longitude']}},'{{$value['country_code']}}','{{$value['storefront_md']}}','{{$value['logo_md']}}'],@endforeach];


    var marker, i, loc;
    var markers = new Array();

    var map = new google.maps.Map(document.getElementById('map-container'), {
      styles: styles,
      zoom: 7,
      mapTypeControl: false,
      streetViewControl: true,
      center: new google.maps.LatLng({{$geo['lat']}}, {{$geo['lon']}}),
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
      retailers.json('/a/retailers/'+store.get('latitude')+'/'+store.get('longitude')+'?shop={{$domain}}');

    } else {
      // check if user browser has geolocation
      if (navigator.geolocation) {

        //Get users location
        navigator.geolocation.getCurrentPosition(function(position) {

          // Stores latitude and longitude of visitor address
          store.set('latitude', position.coords.latitude);
          store.set('longitude', position.coords.longitude);

          // New visitor
          retailers.json('/a/retailers/'+position.coords.latitude+'/'+position.coords.longitude+'?shop={{$domain}}');

        }, function() {
          retailers.json('/a/retailers/{{$geo['lat']}}/{{$geo['lon']}}?shop={{$domain}}');
        });
      } else {
        // Browser doesn't support Geolocation
        retailers.json('/a/retailers/{{$geo['lat']}}/{{$geo['lon']}}?shop={{$domain}}');
      }
    }

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

    var listings = new List('retailers-list', {
      valueNames: [
        'name',
        'street_number',
        'street_address',
        'city',
        'country',
        'postcode',
        'street_number',
        'distance',
        { name: 'location', data: ['latitude','longitude']},
        { name: 'country_code', data: ['country_code'] },
        { name: 'logo_md', data: ['logo_md']},
        { name: 'storefront_md', data: ['storefront_md']}
    ]
    });

  };
  console.log('Map Initialized')
};




</script>
