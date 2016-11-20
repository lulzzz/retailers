@extends('proxy.layout.skeleton')

@section('content')
   <div class="retailers-container">
      <div class="row">
         <div class="col-xs-12 col-sm-12  col-md-6 col-lg-4 p-0">
               <h1></h1>

         </div>
         <div class="col-xs-12 col-sm-12  col-md-6 col-lg-8 p-0">

            <button class="btn btn-secondary btn-sm route" type="button">Show Route</button>
            <div class="map" id="map-container" data-map></div>
         </div>
      </div>
   </div>
@stop

@section('js')
@stop
