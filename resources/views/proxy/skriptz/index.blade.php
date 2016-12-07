<script>
loadjs([
  '/assets/proxy/js/qwest.min.js',
  '/assets/proxy/js/map_styles.min.js',
  '/assets/proxy/js/map.min.js'],
  {
    success: function() {

      var markers = [@foreach($retailers as $key => $value)[{{$value['latitude']}},{{$value['longitude']}},'{{$value['country_code']}}','{{$value['storefront_md']}}','{{$value['logo_md']}}'],@endforeach];

      retailers.set = {
        'map-container',
        {{$geo['lat']}},
        {{$geo['lon']}},
        '{{$domain}}',
        markers
      };

      retailers.map('map', {{$geo['lat']}}, {{$geo['lon']}}, '{{$domain}}', markers);

    }
  }
);
</script>
