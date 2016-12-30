<!-- Loadjs :: Async Asset Loading -->
<script>
loadjs=function(){function n(n,e){n=n.push?n:[n];var t,r,i,o,c=[],s=n.length,a=s;for(t=function(n,t){t.length&&c.push(n),a--,a||e(c)};s--;)r=n[s],i=f[r],i?t(r,i):(o=u[r]=u[r]||[],o.push(t))}function e(n,e){if(n){var t=u[n];if(f[n]=e,t)for(;t.length;)t[0](n,e),t.splice(0,1)}}function t(n,e,t){var r,i,o=document;/\.css$/.test(n)?(r=!0,i=o.createElement("link"),i.rel="stylesheet",i.href=n):(i=o.createElement("script"),i.src=n,i.async=void 0===t||t),i.onload=i.onerror=i.onbeforeload=function(n){var t=n.type[0];if(r&&"hideFocus"in i)try{i.sheet.cssText.length||(t="e")}catch(o){t="e"}e(o,t,n.defaultPrevented)},o.head.appendChild(i)}function r(n,e,r){n=n.push?n:[n];var i,o,c=n.length,f=c,u=[];for(i=function(n,t,r){if("e"==t&&u.push(n),"b"==t){if(!r)return;u.push(n)}c--,c||e(u)},o=0;o<f;o++)t(n[o],i,r)}function i(n,t,i){var f,u;if(t&&t.trim&&(f=t),u=(f?i:t)||{},f){if(f in c)throw new Error("LoadJS");c[f]=!0}r(n,function(n){n.length?(u.fail||o)(n):(u.success||o)(),e(f,n)},u.async)}var o=function(){},c={},f={},u={};return i.ready=function(e,t){return n(e,function(n){n.length?(t.fail||o)(n):(t.success||o)()}),i},i.done=function(n){e(n,[])},i}();
</script>

<!-- Dependencies -->
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
  @endif
</div>
<script>
loadjs([
  '{{ env('APP_URL') }}/assets/proxy/css/stylesheet.min.css',
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
<!-- Stylesheet :: Locator Styling -->
