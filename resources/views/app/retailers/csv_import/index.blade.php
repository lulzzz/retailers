@extends('app.layout.iframe')

@section('content')
  <div class="container-fluid">
    <div class="row my-2">
      <div class="col-xs-6">
        <h5>Import Retailers</h5>
      </div>
      <div class="col-xs-6 text-xs-right">
        <h5 class="lead">Step 1 of 3</h5>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12">
        <form action="{{ route( 'import_retailers' )  }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
          <div class=" upload-file-wrap">
          <div class="row">
            <div class="col-xs-6">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <label for="file-upload" class="float-xs-left">
                <input class="pb-1" type="file" id="file-upload"  name="csv_file"/>
              </label>
            </div>
            <div class="col-xs-6">
              <button type="submit" class="btn btn-success float-xs-right">Import Retailers CSV</button>
            </div>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
  <hr class="mb-0">
  <div class="row">
    <div class="col-xs-12">
      <div class="instructions bg-gray">
        <div class="p-3 small text-lighten">
          <h4><svg id="i-alert" viewBox="0 0 32 32" width="22" height="22" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="6.75%">
            <path d="M16 3 L30 29 2 29 Z M16 11 L16 19 M16 23 L16 25" />
          </svg>&nbsp;&nbsp;<span>Importing Retailers</span></h4>
          <p>Each Retailer will have one or more locations, so when importing your Retailers using a <b>.CSV</b> file you will need to upload 2 seperate files. One file will add Retailers and the other file will add the locations of these Retailers.</p>
          <p>
            <a href="#">Download .CSV template</a><br>
            <a href="/import-readme">View Table Example<br>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop

@section('js')

@stop
