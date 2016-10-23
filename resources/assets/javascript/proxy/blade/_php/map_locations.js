var is_internetExplorer11= navigator.userAgent.toLowerCase().indexOf('trident') > -1;
var $marker_url = ( is_internetExplorer11 ) ? '//cdn.shopify.com/s/files/1/0638/4637/t/2/assets/favicon-32x32.png?8466146662870439663' : '//cdn.shopify.com/s/files/1/0638/4637/t/2/assets/favicon-32x32.png?8466146662870439663';

var $marker_url2 = ( is_internetExplorer11 ) ? '//cdn.shopify.com/s/files/1/0638/4637/t/2/assets/favicon-32x32.png?8466146662870439663' : '//cdn.shopify.com/s/files/1/0638/4637/t/2/assets/favicon-32x32.png?8466146662870439663';

var locations = [@foreach($retailers as $key => $value)['<a href="{{ env('APP_URL') }}{{$value->country}}/{{$value->city}}/{{$value->slug}}"><img src="{{ env('APP_URL') }}{{ Storage::url($value->storefront_lg) }}"></a>',{{$value->latitude}},{{$value->longitude}},{{$value->id}},$marker_url2],@endforeach];