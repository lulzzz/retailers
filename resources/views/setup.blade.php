@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Account Setup</div>
        <div class="panel-body">
         {{ Form::open(array('route' => 'retailers.store')) }}
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <div class="form-group">
              <label for="brand">Brand Name:</label>
              <input type="text" name="brand" class="form-control">
              <button type="submit" class="btn btn-sm btn-success m-t-2">Next</button>
            </div>
          {{Form::close}}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
