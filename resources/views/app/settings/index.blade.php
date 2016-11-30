@extends('app.layout.skeleton')

@section('content')
  <div class="container">

    @if ($errors->any())

      <div class="row">
        <div class="col-xs-12">
          <div class="alert alert-danger" role="alert">
            <strong>Submission Error!</strong>
            <ul class="pt-2">
              <li class="error">
                {{ implode('', $errors->all(':message')) }}
              </li>
            </ul>
          </div>
        </div>
      </div>

    @endif
    <div class="row">
      <div class="col-md-8 p-3">

        <div class="form-group row my-3">
          <label class="col-xs-4 col-form-label">Company Information</label>
          <div class="col-xs-8">
            Brand Name:
            <input class="form-control" type="text" value="Artisanal kale" id="example-text-input">
          </div>
        </div>
        <div class="form-group row my-3">
          <div class="push-xs-4 col-xs-8">
            Email:
            <input class="form-control input-sm" type="text" value="Artisanal kale" id="example-text-input">
          </div>
        </div>
        <hr>
        <div class="form-group row my-3">
          <label class="col-xs-4 col-form-label">Subscription</label>
          <div class="col-xs-8">
            <small>Current</small>
            <p><b>$ 34.99 Per Month</b></p>
          </div>
        </div>
      </div>
    </div>

  @stop


  @section('js')

  @stop
