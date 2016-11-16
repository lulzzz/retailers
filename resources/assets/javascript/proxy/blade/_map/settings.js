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
