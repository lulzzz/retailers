(function() {

  window.retailers = window.retailers || {};


  /**
  * Retailers Javascript Controller
  *
  * jQuery interface for the "Retailers" Store Locator.
  * This logic controls the proccess within the map and is using:
  *
  */

  retailers.map = function (mapElement, geoLat, geoLng, domain, locations, page) {

    if (document.getElementById(mapElement)){

      var geocoding  = new google.maps.Geocoder;
      var infowindow = new google.maps.InfoWindow();
      var directionDisplay = new google.maps.DirectionsRenderer();


      /**
      * Retailers Shop
      *
      * Geocoder used within "qwest" and is initated if
      * user allows browser to acquire their location or
      * mapping to a selection Retailer within the list.
      *
      */

      retailers.shop = function (latitude, longitude, iso, retailer_name, logo, slug) {


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

            //map.panBy(-33.3333,-100)



            infowindow.open(map, marker);
            $('.list').show();

          } else {
            window.alert('Geocoder failed due to: ' + status);
          }
        });

        if(page == 'index') {
          if ($('.container-fluid').width() < 1000) {

            map.panBy(200,0)

            var  feature_width = '200px';
            var  logo_width    = '80px';
          } else {
            var  feature_width = '250px';
            var  logo_width    = '120px';
          }

          var logo_url = [];

          if(logo) {
            var  logo_url = '<div class="logo"><img src="'+logo+'"></div>';
          } else {
            var  logo_url = '<div class="logo"><h2>'+retailer_name+'</h2></div>';
          }

            var gm_url = 'http://maps.google.com/maps?q='+latitude+','+longitude+'';
            // you can also hard code the URL
            var sticker = $('<div class="storefront-sticker" style="max-width:'+feature_width+';"><a href="/a/retailers/'+slug+'?shop='+domain+'"><div class="sticker" data-sticker>'+logo_url+'<div class="store"><img src="https://maps.googleapis.com/maps/api/streetview?size=600x300&location='+latitude+','+longitude+'&pitch=-0.76&key=AIzaSyAMElu9QAKi3qU68wXQ5yJSCG_YNWVU3do"></div></a></div><a class="btn btn-secondary btn-sm mt-1 float-xs-right" href="'+gm_url+'" target="_blank"><i class="icon icon-gmap"></i> &nbsp;View in Google Maps</a>');

            $('div[data-sticker]').remove();
            sticker.appendTo('div[data-map]');

          };

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
            $('.list').removeClass('disabled');

            // Re-structure the listed retailers
            if (page == 'index') {
              listings.clear();
              listings.add(response);
              listings.sort('distance');
            }


            // Select first result based on distance.
            var locItem = $('.ref-location');

            retailers.shop(
              locItem.closest('li').first().data('latitude'),
              locItem.closest('li').first().data('longitude'),
              locItem.closest('li').first().data('country_code'),
              locItem.closest('li').first().data('name'),
              locItem.closest('li').first().data('logo_md'),
              locItem.closest('li').first().data('slug')
            );

            locItem.closest('li').first().addClass('active');

          })

          .complete(function() {
            $('.ref-location').on('click', function() {

              $('.list > li').removeClass('active');
              $(this).toggleClass('active');

              store.set('retailer_latitude', $(this).data('latitude'));
              store.set('retailer_longitude', $(this).data('longitude'));

              retailers.shop(
                $(this).data('latitude'),
                $(this).data('longitude'),
                $(this).data('country_code'),
                $(this).data('name'),
                $(this).data('logo_md'),
                $(this).data('slug')
              );
            });
          });
        };


        var marker, i;
        var markers = new Array();

        var map = new google.maps.Map(document.getElementById(mapElement), {
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
          retailers.json('/app/'+geoLat+'/'+geoLng+'?shop='+domain+'');

        } else {
          // check if user browser has geolocation
          if (navigator.geolocation) {

            //Get users location
            navigator.geolocation.getCurrentPosition(function(position) {

              // Stores latitude and longitude of visitor address
              store.set('latitude', position.coords.latitude);
              store.set('longitude', position.coords.longitude);

              // New visitor
              retailers.json('/a/retailers/'+position.coords.latitude+'/'+position.coords.longitude+'?shop='+domain+'');

            }, function() {
              retailers.json('/a/retailers/'+geoLat+'/'+geoLng+'?shop='+domain+'');
            });
          } else {
            // Browser doesn't support Geolocation
            retailers.json('/a/retailers/'+geoLat+'/'+geoLng+'?shop='+domain+'');
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
                locations[i][3], //iso
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
            { name: 'slug', data: ['slug']}
          ]
        });

      };
      console.log('Retailers Initialized')
    };
  }());
