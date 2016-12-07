@extends('app.layout.iframe')

@section('content')
  <div class="container-fluid">
    <div class="row my-2">
      <div class="col-xs-6">
        <h5>Import Retailers</h5>
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
          <p>To ensure a successful upload please upload a valid <b>.CSV</b> file. Each Retailers is <b>REQUIRED</b> you list a name value. You should refer to the below example <b>.CSV</b> table setup and match the logic.</p>
          <p>
            <a href="/assets/app/csv/retailers-example.csv">Download .CSV template</a><br>
          </p>
          <p><i><b>Please note:</b> Each Retailer may have one or more locations. For Retailers with one or more locations you will need to repeat the values for each location:
            <p> <code>name, description, email, website, instagram and twitter</code>
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
