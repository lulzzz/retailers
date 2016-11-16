<script>
loadjs(['{{ env('APP_URL') }}/js/plugins/map_styles.min.js',
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
    
    var is_internetExplorer11= navigator.userAgent.toLowerCase().indexOf('trident') > -1;
    
    var $marker_url = ( is_internetExplorer11 ) ? '//cdn.shopify.com/s/files/1/0638/4637/t/2/assets/favicon-32x32.png?8466146662870439663' : '//cdn.shopify.com/s/files/1/0638/4637/t/2/assets/favicon-32x32.png?8466146662870439663';
    
    var $marker_url2 = ( is_internetExplorer11 ) ? '//cdn.shopify.com/s/files/1/0638/4637/t/2/assets/favicon-32x32.png?8466146662870439663' : '//cdn.shopify.com/s/files/1/0638/4637/t/2/assets/favicon-32x32.png?8466146662870439663';
    
    var locations = [@foreach($retailers as $key => $value)['<a href="{{ env('APP_URL') }}/{{$value['country']}}/{{$value['city']}}/{{$value['slug']}}"><img src="{{ env('APP_URL') }}/{{ Storage::url($value['storefront_lg']) }}"></a>',{{$value['latitude']}},{{$value['longitude']}},{{$value['id']}},$marker_url2],@endforeach];
    
    
    var marker, i, loc;
    var markers = new Array();
    
    var map = new google.maps.Map(document.getElementById('map-container'), {
      styles: styles,
      zoom: 12,
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
    
    for (i = 0; i < locations.length; i++) {
    
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
        { name: 'logo', data: ['logo']},
    ]
    });
    
  };
  console.log('Map Initialized')
};




</script>
