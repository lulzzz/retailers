var is_internetExplorer11= navigator.userAgent.toLowerCase().indexOf('trident') > -1;

var $marker_url = ( is_internetExplorer11 ) ? '//cdn.shopify.com/s/files/1/0638/4637/t/2/assets/favicon-32x32.png?8466146662870439663' : '//cdn.shopify.com/s/files/1/0638/4637/t/2/assets/favicon-32x32.png?8466146662870439663';

var $marker_url2 = ( is_internetExplorer11 ) ? '//cdn.shopify.com/s/files/1/0638/4637/t/2/assets/favicon-32x32.png?8466146662870439663' : '//cdn.shopify.com/s/files/1/0638/4637/t/2/assets/favicon-32x32.png?8466146662870439663';

var locations = [@foreach($retailers as $key => $value)[{{$value['latitude']}},{{$value['longitude']}},'{{$value['country_code']}}','{{$value['storefront_lg']}}','{{$value['logo_lg']}}',$marker_url2],@endforeach];


var marker, i, loc;
var markers = new Array();

var map = new google.maps.Map(document.getElementById('map-container'), {
  styles: styles,
  zoom: 7,
  mapTypeControl: false,
  streetViewControl: true,
  //center: new google.maps.LatLng({{$geo['lat']}}, {{$geo['lon']}}),
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
