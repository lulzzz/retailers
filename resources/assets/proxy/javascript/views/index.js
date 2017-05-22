<script src="/assets/app/js/plugins/map_styles.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/qwest/4.4.5/qwest.min.js"></script>
<script>
window.skriptz = window.skriptz || {};
skriptz.init = function () { skriptz.maps(); };
skriptz.maps = function () {
   var locArray = [@foreach($retailers as $key => $value)[{{$value['latitude']}},{{$value['longitude']}},'{{$value['country_code']}}','{{$value['storefront_md']}}','{{$value['logo_md']}}'],@endforeach];
      retailers.geo("{{env('APP_URL')}}", "{{$geo['lat']}}", "{{$geo['lon']}}", "{{$domain}}", locArray);
   };
skriptz.init();
</script>
