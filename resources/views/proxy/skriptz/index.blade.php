<script>
loadjs([
 'https://maps.google.com/maps/api/js?key=AIzaSyCTlnXnQV55QOGl22nw627SDxo6yXynJYs',
 '{{ env('APP_URL') }}js/plugins/list.min.js',
 '{{ env('APP_URL') }}js/plugins/dropdown.min.js',
 '{{ env('APP_URL') }}js/plugins/map_styles.min.js'],
 { success: function() { 
   skriptz.init();
 }
});

window.skriptz = window.skriptz || {};


skriptz.init = function () {
 skriptz.search();
 skriptz.maps();
};

skriptz.search = function () {
  var RetailersList=new List("retailers-list",{valueNames:["country","city","name"]});
};

skriptz.maps = function () {
  if (document.getElementById('map-container')){
    var is_internetExplorer11= navigator.userAgent.toLowerCase().indexOf('trident') > -1;
    var $marker_url = ( is_internetExplorer11 ) ? '//cdn.shopify.com/s/files/1/0638/4637/t/2/assets/favicon-32x32.png?8466146662870439663' : '//cdn.shopify.com/s/files/1/0638/4637/t/2/assets/favicon-32x32.png?8466146662870439663';
    
    var $marker_url2 = ( is_internetExplorer11 ) ? '//cdn.shopify.com/s/files/1/0638/4637/t/2/assets/favicon-32x32.png?8466146662870439663' : '//cdn.shopify.com/s/files/1/0638/4637/t/2/assets/favicon-32x32.png?8466146662870439663';
    
    var locations = [@foreach($retailers as $key => $value)['<a href="{{ env('APP_URL') }}{{$value->country}}/{{$value->city}}/{{$value->slug}}"><img src="{{ env('APP_URL') }}{{ Storage::url($value->storefront_lg) }}"></a>',{{$value->latitude}},{{$value->longitude}},{{$value->id}},$marker_url2],@endforeach];
    var marker, i, loc;
    var markers = new Array();
    var infowindow = new google.maps.InfoWindow();
    var geocoder = new google.maps.Geocoder;
    
    var map = new google.maps.Map(document.getElementById('map-container'), {
        styles: styles,
        zoom: 6,
        mapTypeControl: false,
        streetViewControl: true,
        center: new google.maps.LatLng({{$geo['lat']}}, {{$geo['lon']}}),
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
    
    
    @if(Route::current()->getName() == 'proxy_country')
    
    geocoder.geocode({'address': '{{$iso}}'}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
    
            var lat = results[0].geometry.location.lat();
            var lon = results[0].geometry.location.lng();
            var latlng = new google.maps.LatLng(lat, lon);
    
            pan(latlng);
            map.setCenter(latlng);
            map.setZoom(6);
    
        } else {
          alert("Something got wrong " + status);
      }
    });
    
    @elseif(Route::current()->getName() == 'proxy_city')
    
    geocoder.geocode({'address': '{{$iso}}'}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
    
            var lat = results[0].geometry.location.lat();
            var lon = results[0].geometry.location.lng();
            var latlng = new google.maps.LatLng(lat, lon);
    
            pan(latlng);
            map.setCenter(latlng);
            map.setZoom(13);
    
        } else {
          alert("Something got wrong " + status);
      }
    });
    
    @else
    var map = new google.maps.Map(document.getElementById('map-container'), {
        styles: styles,
        zoom: 6,
        mapTypeControl: false,
        streetViewControl: true,
        center: new google.maps.LatLng({{$geo['lat']}}, {{$geo['lon']}}),
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
    @endif
    function pan(o){map.panTo(o),map.setZoom(15)}for(i=0;i<locations.length;i++)marker=new google.maps.Marker({position:new google.maps.LatLng(locations[i][1],locations[i][2]),map:map,icon:locations[i][4]}),markers.push(marker),google.maps.event.addListener(marker,"click",function(o,n){return function(){infowindow.setContent(locations[n][4])}}(marker,i));$(".location").on("click",function(){var o=$(this).data("location"),n=$(this).data("storefront"),a=$(this).data("logo"),s=$(this).data("iso"),e=o.split(","),t=new google.maps.LatLng(e[0],e[1]),i=$("div[data-sticker]"),r=$('<div class="storefront-sticker"><div class="storefront-feature" data-sticker><div class="inner"><span class="flag-icon" style="background-image: url('+s+');"></span><div class="logo"><img src="'+a+'"></div></div><div class="tint"><img src="'+n+'" class="bg"></div></div><div class="row pt-1"><div class="col-xs-6 pr-0"><button class="btn btn-secondary btn-sm pull-left" type="button">Find Directions</button></div><div class="col-xs-6"><a class="btn btn-secondary btn-sm pull-right" href="#">View Retailer</button></div></div></div>');i.remove(),r.appendTo("div[data-map]"),marker&&marker.setMap&&marker.setMap(null),geocoder.geocode({location:t},function(o,n){"OK"===n?o[1]?(pan(t),marker=new google.maps.Marker({position:t,map:map}),infowindow.setContent("<address><b>"+o[0].address_components[0].long_name+"&nbsp;"+o[0].address_components[1].long_name+"<br>"+o[0].address_components[5].long_name+"<br>"+o[0].address_components[6].long_name+",&nbsp;"+o[0].address_components[4].long_name+"</b></address>"),infowindow.open(map,marker)):window.alert("No results found"):window.alert("Geocoder failed due to: "+n)})}),google.maps.event.addListener(marker,"click",function(){infowindow.close()});
  };
};


</script>