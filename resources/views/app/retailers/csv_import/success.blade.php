@extends('app.layout.iframe')

@section('content')
  <div class="container-fluid">
    <div class="container-fluid">
      <div class="row my-3">
        <div class="col-xs-12">
          <h3>Uploaded Successful!</h3>
        </div>
        <div class="col-xs-12 text-xs-left">
          <p class="lead">What next?</p>
          <p class="pt-1">Upload Retailer logos and their location storefront photos to enable the scrolling marquee feature and poster labels within the application. </p>
          <p class="pt-1"><a href="{{ route( 'import' )  }}">Back to Import</p>
        </div>
      </div>
    </div>

  @stop

  @section('js')

  @stop
