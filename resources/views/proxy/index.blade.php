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
   <script src="{{env('APP_URL')}}/assets/proxy/js/qwest.min.js"></script>
   <script src="{{env('APP_URL')}}/assets/proxy/js/map_styles.min.js"></script>
   <script src="{{env('APP_URL')}}/assets/proxy/js/map.min.js"></script>
   <script>
   ar markers = [@foreach($retailers as $key => $value)[{{$value['latitude']}},{{$value['longitude']}},'{{$value['country_code']}}','{{$value['name']}}','{{$value['logo_md']}}'],@endforeach];
   retailers.map('{{env('PROXY_URL')}}','map', {{$geo['lat']}}, {{$geo['lon']}}, '{{$domain}}', markers, 'index');
   </script>
@stop
