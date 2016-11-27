@extends('app.layout.skeleton')

@section('content')
<div class="template-merchants">
 <div class="vertical-align">
  <div class="center-align">
    <div class="row flex-items-xs-center">
      <div class="col-xs-6">
        @if ($errors->any())
        <div class="alert alert-danger" role="alert">
          <strong>Submission Error!</strong>
          <ul class="p-t-2">
            <li class="error">
              {{ implode('', $errors->all(':message')) }}
            </li>
          </ul>
        </div>
        @endif
        <div class="card">
          <h5 class="card-header">
            <span class="pull-xs-left">Brand / Company</span>
            <span class="pull-xs-right lead">Step 1</span>
          </h5>
          {{ Form::model($brand,
            array(
              'method' => 'PATCH',
              'route' => array(
                'brand.update', $brand->id
                )
              )
            )
          }}
          <div class="card-block">
            <div class="form-group">
            {{ Form::text('brand_name', null, array(
                'class' => 'form-control',
                'placeholder' => 'Brand Name')) }}
              </div>
              <div class="text-xs-center p-y-2">
                {{ Form::submit('Set Merchant Types',  array('class' => 'btn btn-primary')) }}
              </div>
            </div>
            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
