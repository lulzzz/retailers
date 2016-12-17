@extends('proxy.layout.skeleton')

@section('content')


      @include('proxy.components.map')

@stop

@section('js')
if(store.get('latitude') && store.get('longitude')) {
   var latlng = {latitude: store.get('latitude'), longitude: store.get('longitude') };
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
   locations: [@foreach($retailers as $key => $value)[{{$value['latitude']}},{{$value['longitude']}},'{{$value['country_code']}}','{{$value['name']}}','{{$value['logo_md']}}'],@endforeach]
};

retailers.map(settings);
@stop
