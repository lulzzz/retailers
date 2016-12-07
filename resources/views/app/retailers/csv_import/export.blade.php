@extends('app.layout.iframe')

@section('content')
  <div class="container-fluid pt-2 px-2">
    <div class="row import-csv">
      <div class="col-xs-12 text-xs-center pt-2">
        <a href="{{ route( 'export_retailers' )  }}">
          <svg id="i-file" viewBox="0 0 32 32" width="32" height="32" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="6.25%">
            <path d="M6 2 L6 30 26 30 26 10 18 2 Z M18 2 L18 10 26 10" />
          </svg>
          <h5><small>EXPORT RETAILERS</small></h5>
        </a>
      </div>
    </div>
  </div>  
@stop

@section('js')

@stop
