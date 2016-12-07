@extends('proxy.layout.skeleton')

@section('content')

   @if (is_null($geo['country']))
      <h1>Listing All Retailers</h1>
      @foreach ($retailers as $key => $value)
         //
      @endforeach
   @else
      @include('proxy.components.map')
   @endif
@stop

@section('js')
   <script>
   loadjs([
      '/assets/proxy/js/qwest.min.js',
      '/assets/proxy/js/map_styles.min.js',
      '/assets/proxy/js/map.min.js'],
      {
         success: function() {

            var markers = [@foreach($retailers as $key => $value)[{{$value['latitude']}},{{$value['longitude']}},'{{$value['country_code']}}','{{$value['storefront_md']}}','{{$value['logo_md']}}'],@endforeach];

            retailers.map('map', {{$geo['lat']}}, {{$geo['lon']}}, '{{$domain}}', markers);

         }
      }
   );
   </script>
@stop
