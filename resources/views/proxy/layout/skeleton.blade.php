<!-- Loadjs :: Async Asset Loading -->
<script src="{{env('APP_URL')}}/assets/proxy/js/loadjs.min.js"></script>

<!-- Stylesheet :: Locator Styling -->
<link rel="stylesheet" type="text/css" href="{{ env('APP_URL') }}/assets/proxy/css/stylesheet.min.css">

<div class="retailers-fluid">
  
  @if($retailers->isEmpty())
    <div class="row">
      <div class="col-xs-12 text-xs-center pa-3">
        <h1 class="top-header">No Retailers Found</h1>
        <h2 class="sub-header">Sorry! We couldn't find any Retailers at this time. Please check back later.</h2>
      </div>
    </div>
  @else
    @yield('content')

    <!-- Dependencies -->
    <script>
    loadjs([
      '{{env('APP_URL')}}/assets/proxy/js/core.min.js',
      '//maps.google.com/maps/api/js?key=AIzaSyAMElu9QAKi3qU68wXQ5yJSCG_YNWVU3do',
      '{{env('APP_URL')}}/assets/proxy/js/map_themes/greywash.min.js',
      '{{env('APP_URL')}}/assets/proxy/js/map.min.js'], {
        async:false,
        success: function() {
          if(store.get('geolocate')) {
            var latlng = { latitude: store.get('latitude'), longitude: store.get('longitude') };
          } else {
            var latlng = { latitude: {{$geo['lat']}}, longitude: {{$geo['lon']}} };
          }
          var settings = {
            environment: '{{env('PROXY_URL')}}',
            element:  'locate-retailer-map',
            latitude: latlng.latitude,
            longitude: latlng.longitude,
            domain: '{{$domain}}',
            api_key: 'AIzaSyAMElu9QAKi3qU68wXQ5yJSCG_YNWVU3do',
            zoom: 9
          };
          retailers.map(settings);
        }
      }
    );
    </script>
  </div>
@endif
