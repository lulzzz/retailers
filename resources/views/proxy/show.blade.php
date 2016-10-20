@extends('proxy.layout.skeleton')

@section('content')

<div class="grid-middle">

  @include('proxy.components.fullscreen')
  {{--@include('proxy.components.flexbox')--}}

</div>


@stop

@section('js')
<script>
  loadjs([
    '//maps.google.com/maps/api/js?key=AIzaSyB5HPEKmq2MDh5JKp-Zmys0SjV2-UNNGNQ',
    '//cdn.shopify.com/s/files/1/0638/4637/t/2/assets/gmaps.min.js',
    '/a/retailers/js/plugins/list.min.js',
    '/a/retailers/js/plugins/dropdown.min.js'],
    { success: function() {  
     skriptz.maps();
     skriptz.search();
   }
 });

  window.skriptz = window.skriptz || {};

  skriptz.search = function () {
   var RetailersList = new List('retailers-list', {
     valueNames: ['country','city','name']
   });
 };

 skriptz.maps = function () {
  if (document.getElementById('map-container')){

   var is_internetExplorer11= navigator.userAgent.toLowerCase().indexOf('trident') > -1;
   var $marker_url = ( is_internetExplorer11 ) ? '//cdn.shopify.com/s/files/1/0638/4637/t/2/assets/favicon-32x32.png?8466146662870439663' : '//cdn.shopify.com/s/files/1/0638/4637/t/2/assets/favicon-32x32.png?8466146662870439663';

   var $marker_url2 = ( is_internetExplorer11 ) ? '//cdn.shopify.com/s/files/1/0638/4637/t/2/assets/favicon-32x32.png?8466146662870439663' : '//cdn.shopify.com/s/files/1/0638/4637/t/2/assets/favicon-32x32.png?8466146662870439663';

   var locations = [
   @foreach ($retailers as $key => $value)
   ['<a href="/a/retailers/{{$value->country}}/{{$value->city}}/{{$value->slug}}"><div class="mp-storefront"><img src="/a/retailers{{ Storage::url($value->storefront_lg) }}"></div></a>', 
   {{$value->latitude}},{{$value->longitude}}, 
   {{$value->id}}, 
   $marker_url2],
   @endforeach
   ];


   var map = new google.maps.Map(document.getElementById('map-container'), {
    zoom: 7,
    mapTypeControl: false,
    streetViewControl: false,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    scrollwheel: false,
    styles: styles,
  });




   var infowindow = new google.maps.InfoWindow({
    maxWidth: 500
  });

   var marker, i;
   var markers = new Array();

   for (i = 0; i < locations.length; i++) {  
    marker = new google.maps.Marker({
     position: new google.maps.LatLng(locations[i][1], locations[i][2]),
     map: map,
     icon: locations[i][4],
   });

    markers.push(marker);

    google.maps.event.addListener(marker, 'click', (function(marker, i) {
     return function() {
      infowindow.setContent(locations[i][0]);
      infowindow.open(map, marker);
    }
  })(marker, i));
  }


  var map, marker;

  $('.location').on('click', function() {
    $(this).addClass('active');

    var latlonStr = $(this).data('location')
    var coords = latlonStr.split(",");
    var latLng = new google.maps.LatLng(coords[0], coords[1]);
    pan(latLng);
    if (marker && marker.setMap) {
     marker.setMap(null);
   }

   marker = new google.maps.Marker({
     map: map,
     position: latLng,
     animation: google.maps.Animation.DROP
   });


 });
}
google.maps.event.addDomListener(window, 'load');

function pan(latlon) {
 map.panTo(latlon)
 map.setZoom(14);
}
};

</script>
@stop