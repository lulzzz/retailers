@extends('proxy.layout.skeleton')

@section('content')

   @if($retailers->isEmpty())
   <div class="row">
      <div class="col-xs-12">
         <i class="re-icon re-icon-location_strike"></i>
         <h1>Currently no Retailers</h1>
      </div>
   </div>
   @else
      @include('proxy.components.map')
   @endif

@stop

@section('js')
var markers = [@foreach($retailers as $key => $value)[{{$value['latitude']}},{{$value['longitude']}},'{{$value['country_code']}}','{{$value['name']}}','{{$value['logo_md']}}'],@endforeach];

if(store.get('latitude')) {
   retailers.map('{{env('PROXY_URL')}}','locate-retailer-map', store.get('latitude'), store.get('longitude'), '{{$domain}}', markers, 'index');
} else {
   retailers.map('{{env('PROXY_URL')}}','locate-retailer-map', {{$geo['lat']}}, {{$geo['lon']}}, '{{$domain}}', markers, 'index');
}

@stop
