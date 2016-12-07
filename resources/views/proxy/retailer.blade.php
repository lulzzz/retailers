@extends('proxy.layout.skeleton')

@section('content')
   <div class="retailers-container">
      <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
            <h1>{{$retailer->name}}</h1>
            <p>{{$retailer->description}}</p>
            <p>{{$retailer->email}}</p>
            <p>{{$retailer->website}}</p>
            <p>{{$retailer->twitter}}</p>
            <p>{{$retailer->instagram}}</p>

         </div>
         <div class="col-xs-12 col-sm-12  col-md-6 col-lg-8">
            @include('proxy.components.map')
         </div>
      </div>
   </div>
@stop

@section('js')
   <script>
   loadjs([
      '/assets/proxy/js/map_styles.min.js',
      '/assets/proxy/js/map.min.js'],
      {
         success: function() {

            var markers = [@foreach($locations as $key => $value)[{{$value['latitude']}},{{$value['longitude']}},'{{$value['country_code']}}','{{$value['storefront_md']}}','{{$retailer['logo_md']}}'],@endforeach];

            retailers.map('map', store.get('latitude'), store.get('longitude'), '{{$domain}}', markers);

         }
      }
   );
   </script>
@stop
