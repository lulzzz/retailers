@extends('app.layout.iframe')

@section('content')
  <div class="container-fluid">
    <div class="row import-csv">
      <div class="col-xs-12">
        <form action="{{ route( 'import_retailers' )  }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="upload-csv-file">
            <input type="file" id="file" name="csv_file">
            <label for="file">
              <span class="upload-file-text">
                <svg id="i-file" viewBox="0 0 32 32" width="32" height="32" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="6.25%">
                  <path d="M6 2 L6 30 26 30 26 10 18 2 Z M18 2 L18 10 26 10" />
                </svg>   Import a valid <b>Retailers</b> .CSV file
              </span>
              <button type="submit">insert</button>
            </label>
          </div>
        </form>
      </div>
    </div>
    <hr>
    <div class="p2">
      <h4>Importing with .CSV</h4>
      Each Retailer will have one or more locations, so when importing you Retailers via .CSV you will need to upload 2 files.
    </div>
  </div>
@stop

@section('js')

@stop
