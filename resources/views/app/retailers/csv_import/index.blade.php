@extends('app.layout.iframe')

@section('content')
  <div class="container-fluid">
    <div class="row import-csv">
      <div class="col-xs-12 px-0">
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
        <hr>
        <div class="p2">
          <h4>Importing Retailers</h4>
          <p>Each Retailer will have one or more locations, so when importing your Retailers using a <b>.CSV</b> file you will need to upload 2 seperate files. One file will add Retailers and the other file will add the locations of these Retailers.</p>
          <p><a href="#">Download Example .CSV</a></p>
          <small>
          <table class="table tablesorter" id="table-list">
            <thead>
              <tr>
                <th>Column Header</th>
                <th>Value Type</th>
                <th>Example</th>
                <th>Required</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>name</td>
                <td><i>string</i></td>
                <td>Example Store</td>
                <td>Yes</td>
              </tr>
              <tr>
                <td>description</td>
                <td><i>text</i></td>
                <td>A cool store from Sweden.</td>
                <td>No</td>
              </tr>
              <tr>
                <td>phone</td>
                <td><i>numeric</i></td>
                <td><i>-</i></td>
                <td>No</td>
              </tr>
              <tr>
                <td>website</td>
                <td><i>url</i></td>
                <td>www.domain.com</td>
                <td>No</td>
              </tr>
              <tr>
                <td>email</td>
                <td><i>string</i></td>
                <td>hello@email.com</td>
                <td>No</td>
              </tr>
              <tr>
                <td>instagram</td>
                <td><i>string</i></td>
                <td><code>@handle</code></td>
                <td>No</td>
              </tr>
              <tr>
                <td>facebook</td>
                <td><i>string</i></td>
                <td><code>facebook.com/retailer-name</code></td>
                <td>No</td>
              </tr>
              <tr>
                <td>twitter</td>
                <td><i>string</i></td>
                <td><code>@handle</code></td>
                <td>No</td>
              </tr>
              <tr>
                <td>featured</td>
                <td><i>yes/no</i></td>
                <td><code>no</code></td>
                <td>Yes</td>
              </tr>
              <tr>
                <td>visibility</td>
                <td><i>public/hidden</i></td>
                <td>Public</td>
                <td>Yes</td>
              </tr>

            </tbody>
          </table>
        </small>
        </div>
      </div>
    </div>
    <hr>
  </div>
@stop

@section('js')

@stop
