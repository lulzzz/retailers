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
var markers = [@foreach($retailers as $key => $value)[{{$value['latitude']}},{{$value['longitude']}},'{{$value['country_code']}}','{{$value['storefront_md']}}','{{$value['logo_md']}}'],@endforeach];

if(store.get('latitude')) {
   retailers.map('locate-retailer-map', store.get('latitude'), store.get('longitude'), '{{$domain}}', markers, 'index');
} else {
   retailers.map('locate-retailer-map', {{$geo['lat']}}, {{$geo['lon']}}, '{{$domain}}', markers, 'index');
}

@stop
