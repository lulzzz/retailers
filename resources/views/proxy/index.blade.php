@extends('proxy.layout.skeleton')

@section('content')

@if (is_null($country))

<h1>Listing All Retailers</h1>

@foreach ($retailers as $key => $value)
//
@endforeach
@else

@include('proxy.components.fullscreen')

@endif


@stop

@section('js')
<script>
  loadjs([
   'https://maps.google.com/maps/api/js?key=AIzaSyCTlnXnQV55QOGl22nw627SDxo6yXynJYs',
   'https://cdn.shopify.com/s/files/1/0638/4637/t/2/assets/gmaps.min.js',
   '{{ env('APP_URL') }}js/plugins/list.min.js',
   '{{ env('APP_URL') }}js/plugins/dropdown.min.js'],
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

   var locations = [
   @foreach ($retailers as $key => $value)
   ['<a href="{{ env('APP_URL') }}{{$value->country}}/{{$value->city}}/{{$value->slug}}"><img src="{{ env('APP_URL') }}{{ Storage::url($value->storefront_lg) }}"></a>', 
   {{$value->latitude}},{{$value->longitude}}, 
   {{$value->id}}, 
   $marker_url2],
   @endforeach
   ];

   var styles = [{"featureType":"all","elementType":"geometry","stylers":[{"lightness":"-5"}]},{"featureType":"all","elementType":"geometry.fill","stylers":[{"lightness":"-10"},{"saturation":"-100"}]},{"featureType":"all","elementType":"labels","stylers":[{"visibility":"off"},{"lightness":"0"},{"gamma":"1"}]},{"featureType":"all","elementType":"labels.text","stylers":[{"visibility":"on"}]},{"featureType":"all","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"lightness":"0"},{"gamma":"1"}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"hue":"#d700ff"},{"visibility":"off"}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"hue":"#ff0000"}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"},{"saturation":"0"},{"lightness":"0"},{"visibility":"on"}]},{"featureType":"administrative.country","elementType":"geometry.stroke","stylers":[{"lightness":"50"}]},{"featureType":"administrative.country","elementType":"labels.text.fill","stylers":[{"lightness":"25"}]},{"featureType":"administrative.province","elementType":"geometry.stroke","stylers":[{"weight":"1"},{"lightness":"0"}]},{"featureType":"administrative.province","elementType":"labels.text","stylers":[{"lightness":"25"}]},{"featureType":"administrative.locality","elementType":"labels.text","stylers":[{"lightness":"30"},{"gamma":"1.00"}]},{"featureType":"administrative.neighborhood","elementType":"labels.text","stylers":[{"lightness":"53"},{"gamma":"1.00"}]},{"featureType":"administrative.neighborhood","elementType":"labels.text.fill","stylers":[{"lightness":"-20"},{"gamma":"1.00"}]},{"featureType":"administrative.land_parcel","elementType":"labels.text.fill","stylers":[{"lightness":"30"},{"gamma":"1"},{"visibility":"on"}]},{"featureType":"administrative.land_parcel","elementType":"labels.text.stroke","stylers":[{"visibility":"on"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"lightness":"-10"}]},{"featureType":"landscape","elementType":"labels.text.fill","stylers":[{"lightness":"-40"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"lightness":"18"},{"saturation":"-100"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"lightness":"-30"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"},{"lightness":"50"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"},{"lightness":"0"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"weight":"1"},{"saturation":"0"},{"lightness":"83"}]},{"featureType":"road.arterial","elementType":"all","stylers":[{"lightness":"0"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"lightness":"80"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"all","stylers":[{"lightness":"0"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"lightness":"80"},{"gamma":"1"}]},{"featureType":"road.local","elementType":"geometry.stroke","stylers":[{"saturation":"0"},{"lightness":"-15"},{"weight":".25"},{"gamma":"1"}]},{"featureType":"road.local","elementType":"labels.text","stylers":[{"lightness":"0"},{"gamma":"1.00"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#ffc1d9"},{"visibility":"on"}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"saturation":"-100"},{"lightness":"-5"},{"gamma":"0.5"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels.text.stroke","stylers":[{"weight":".75"},{"visibility":"off"}]}];


   if (document.getElementById('map-container')){

     var is_internetExplorer11= navigator.userAgent.toLowerCase().indexOf('trident') > -1;
     var $marker_url = ( is_internetExplorer11 ) ? '//cdn.shopify.com/s/files/1/0638/4637/t/2/assets/favicon-32x32.png?8466146662870439663' : '//cdn.shopify.com/s/files/1/0638/4637/t/2/assets/favicon-32x32.png?8466146662870439663';

     var $marker_url2 = ( is_internetExplorer11 ) ? '//cdn.shopify.com/s/files/1/0638/4637/t/2/assets/favicon-32x32.png?8466146662870439663' : '//cdn.shopify.com/s/files/1/0638/4637/t/2/assets/favicon-32x32.png?8466146662870439663';


     var map = new google.maps.Map(document.getElementById('map-container'), {
      zoom: 4,
      mapTypeControl: false,
      streetViewControl: true,
      center: new google.maps.LatLng({{$lat}}, {{$lon}}),
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      scrollwheel: false,
      mapTypeControl: true,
      mapTypeControlOptions: {
        position: google.maps.ControlPosition.RIGHT_BOTTOM
      },
      zoomControl: true,
      zoomControlOptions: {
        position: google.maps.ControlPosition.LEFT_TOP
      },
      scaleControl: true,
      streetViewControl: true,
      streetViewControlOptions: {
        position: google.maps.ControlPosition.LEFT_TOP
      },
      styles: styles,
    });

     var infowindow = new google.maps.InfoWindow();

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
      }
    })(marker, i));
    }


    var map, marker, infowindow;


    $('.location').on('click', function() {
      var latlonStr   = $(this).data('location');
      var storefront  = $(this).data('storefront');
      var logo = $(this).data('logo');
      var iso_flag = $(this).data('iso');


      var sticker = $('div[data-sticker]');
      var sticker_src = $('<div class="storefront-sticker"><div class="storefront-feature" data-sticker><div class="inner"><span class="flag-icon" style="background-image: url('+iso_flag+');"></span><div class="logo"><img src="'+logo+'"></div></div><div class="tint"><img src="'+storefront+'" class="bg"></div></div><div class="row pt-1"><div class="col-xs-6 pr-0"><button class="btn btn-secondary btn-sm pull-left" type="button">Find Directions</button></div><div class="col-xs-6"><a class="btn btn-secondary btn-sm pull-right" href="#">View Retailer</button></div></div></div>');

      var coords = latlonStr.split(",");
      var latLng = new google.maps.LatLng(coords[0], coords[1]);

      sticker_src.appendTo('div[data-map]');


      if (marker && marker.setMap) {
       marker.setMap(null);
     }
     pan(latLng);


     var geocoder = new google.maps.Geocoder;

     geocoder.geocode({'location': latLng}, function(results, status) {
      if (status === 'OK') {
        if (results[1]) {
          map.setZoom(13);
          marker = new google.maps.Marker({
            position: latLng,
            map: map
          });
          infowindow.setContent('<address><b>'+ results[0].address_components[0].long_name+'&nbsp;' + results[0].address_components[1].long_name +'<br>'+results[0].address_components[5].long_name+'<br>'+ results[0].address_components[6].long_name +',&nbsp;'+ results[0].address_components[7].long_name +'</b></address>');

          infowindow.open(map, marker);
        } else {
          window.alert('No results found');
        }
      } else {
        window.alert('Geocoder failed due to: ' + status);
      }
    });

     google.maps.event.addListener(map, 'click', function() {
      infowindow.close();
    });
   });
  }
  google.maps.event.addDomListener(window, 'load');

  function pan(latlng) {
    map.panTo(latlng);
    map.setZoom(20);
  }

  google.maps.event.addListener(infowindow, 'domready', function() {

    // Reference to the DIV that wraps the bottom of infowindow
    var iwOuter = $('.gm-style-iw');

    /* Since this div is in a position prior to .gm-div style-iw.
     * We use jQuery and create a iwBackground variable,
     * and took advantage of the existing reference .gm-style-iw for the previous div with .prev().
     */
     var iwBackground = iwOuter.prev();

    // Removes background shadow DIV
    //iwBackground.children(':nth-child(2)').css({'display' : 'none'});

    // Removes white background DIV
    //iwBackground.children(':nth-child(4)').css({'display' : 'none'});

    // Moves the infowindow 115px to the right.
    
   // iwOuter.parent().parent().css({right: '50px'});

    // Moves the shadow of the arrow 76px to the left margin.
   // iwBackground.children(':nth-child(1)').attr('style', function(i,s){ return s + 'left: 76px !important;'});

    // Moves the arrow 76px to the left margin.
    iwBackground.children(':nth-child(3)').attr('style', function(i,s){ return s + 'bottom: -10px !important;'});

    // Changes the desired tail shadow color.
    //iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': 'rgba(72, 181, 233, 0.6) 0px 1px 6px', 'z-index' : '1'});

    // Reference to the div that groups the close button elements.
    var iwCloseBtn = iwOuter.next();

    // Apply the desired effect to the close button
    iwCloseBtn.css({opacity: '.7', right: '7px', top: '7px'});

    // If the content of infowindow not exceed the set maximum height, then the gradient is removed.
    if($('.iw-content').height() < 200){
      $('.iw-bottom-gradient').css({display: 'none'});
    }

    // The API automatically applies 0.7 opacity to the button after the mouseout event. This function reverses this event to the desired value.
    iwCloseBtn.mouseout(function(){
      $(this).css({opacity: '1'});
    });
  });
};

</script>
@stop

