<script>
loadjs(['{{ env('APP_URL') }}js/plugins/map_styles.min.js'],
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
  
  console.log('List Initialized') 
};

skriptz.maps = function () {
  if (document.getElementById('map-container')){
    var is_internetExplorer11= navigator.userAgent.toLowerCase().indexOf('trident') > -1;
    var $marker_url = ( is_internetExplorer11 ) ? '//cdn.shopify.com/s/files/1/0638/4637/t/2/assets/favicon-32x32.png?8466146662870439663' : '//cdn.shopify.com/s/files/1/0638/4637/t/2/assets/favicon-32x32.png?8466146662870439663';
    
    var $marker_url2 = ( is_internetExplorer11 ) ? '//cdn.shopify.com/s/files/1/0638/4637/t/2/assets/favicon-32x32.png?8466146662870439663' : '//cdn.shopify.com/s/files/1/0638/4637/t/2/assets/favicon-32x32.png?8466146662870439663';
    
    var locations = [@foreach($retailers as $key => $value)['<a href="{{ env('APP_URL') }}{{$value['country']}}/{{$value['city']}}/{{$value['slug']}}"><img src="{{ env('APP_URL') }}{{ Storage::url($value['storefront_lg']) }}"></a>',{{$value['latitude']}},{{$value['longitude']}},{{$value['id']}},$marker_url2],@endforeach];
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
    
      var origin = [{{$geo['lat']}}, {{$geo['lon']}}];
    
    function calculateDistance(e,o){var a=new google.maps.DistanceMatrixService;a.getDistanceMatrix({origins:[e],destinations:[o],travelMode:google.maps.TravelMode.DRIVING,unitSystem:google.maps.UnitSystem.IMPERIAL,avoidHighways:!1,avoidTolls:!1},callback)}function callback(e,o){if(o!=google.maps.DistanceMatrixStatus.OK)$("#result").html(err);else{var a=e.originAddresses[0],t=e.destinationAddresses[0];if("ZERO_RESULTS"===e.rows[0].elements[0].status)$("#result").html("Better get on a plane. There are no roads between "+a+" and "+t);else{var s=e.rows[0].elements[0].distance,n=(s.value,s.text),i=n.substring(0,n.length-3);console.log(i),$("#result").html("It is "+i+" miles from "+a+" to "+t)}}}function pan(e){map.panTo(e),map.setZoom(15)}for(i=0;i<locations.length;i++){var destination=[444,333],distance_text=calculateDistance(origin,destination);marker=new google.maps.Marker({position:new google.maps.LatLng(locations[i][1],locations[i][2]),map:map,icon:locations[i][4]}),markers.push(marker),google.maps.event.addListener(marker,"click",function(e,o){return function(){infowindow.setContent(locations[o][4])}}(marker,i))}$(".location").on("click",function(){var e,o,a=$(this).data("location"),t=$(this).data("storefront"),s=$(this).data("logo"),n=$(this).data("iso"),i=a.split(","),r=new google.maps.LatLng(i[0],i[1]),l=$("div[data-sticker]");$(".container-fluid").width()<1e3?(e="180px",o="90px"):(e="250px",o="120px");var d=$('<div class="storefront-sticker" style="max-width:'+e+';"><div class="storefront-feature" data-sticker><div class="inner"><span class="flag-icon" style="background-image: url('+n+');"></span><div class="logo"><img src="'+s+'"></div></div><div class="tint"><img src="'+t+'" class="bg"></div></div><div class="row pt-1"><div class="col-xs-12 col-sm-12 col-md-6 pr-0"><button class="btn btn-secondary btn-sm pull-left" type="button">Find Directions</button></div><div class="col-xs-12 col-sm-12 col-md-6"><a class="btn btn-secondary btn-sm pull-right" href="#">View Retailer</button></div></div></div>');l.remove(),d.appendTo("div[data-map]"),marker&&marker.setMap&&marker.setMap(null),geocoder.geocode({location:r},function(e,o){"OK"===o?e[1]?(pan(r),marker=new google.maps.Marker({position:r,map:map}),infowindow.setContent("<address><b>"+e[0].address_components[0].long_name+"&nbsp;"+e[0].address_components[1].long_name+"<br>"+e[0].address_components[5].long_name+"<br>"+e[0].address_components[6].long_name+",&nbsp;"+e[0].address_components[4].long_name+"</b></address>"),infowindow.open(map,marker)):window.alert("No results found"):window.alert("Geocoder failed due to: "+o)})}),google.maps.event.addListener(marker,"click",function(){infowindow.close()});
  };
  console.log('Map Initialized')
};




</script>