@extends('layouts.iframe')

@section('content')
  <div class="container-fluid">
    <div class="row import-csv">
      <div class="col-xs-6">
        <form action="{{ route( 'import_csv' )  }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <input type="file" name="csv_file">

          <button type="submit">Send it</button>
        </form>
      </div>
      <div class="col-xs-6">
        <div class="info-box">
          <i>When importing from a <b>.CSV</b> file that has been generated by other "Store Locator" applications, you will need to match each field to their corresponding group.</i>
        </div>
      </div>
    </div>
    <hr>
    <div class="text-xs-center pa-3">
      <h3>Add a .CSV file with column titles!</h3>
    </div>
  </div>
@stop

@section('js')

@stop
