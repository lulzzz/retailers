@extends('app.layout.iframe')

@section('content')
<div class="container-fluid">
  {{ Form::model($location, array(
    'data-shopify-app-submit' => 'edit_address',
    'route' => array('address_save', $location->id))) }}
    <div class="row">
      <div class="col-sm-12">
        <div class="row p-x-2 p-t-2">
          <div class="col-sm-2">
            <fieldset class="form-group">
              {{ Form::text('street_number', null, array('class' => 'form-control form-control-sm',  'data-geo' => 'street_number', 'placeholder' => 'No.')) }}
            </fieldset>
          </div>
          <div class="col-sm-4">
            <fieldset class="form-group">
              {{ Form::text('street_address', null, array('class' => 'form-control form-control-sm ',  'data-geo' => 'route','placeholder' => 'Street Name')) }}
            </fieldset>
          </div>
          <div class="col-sm-4">
            <fieldset class="form-group">
              {{ Form::text('city', null, array('class' => 'form-control form-control-sm ',  'data-geo' => 'locality', 'placeholder' => 'City')) }}
            </fieldset>
          </div>
          <div class="col-sm-2">
            <fieldset class="form-group">
              {{ Form::text('postcode', null, array('class' => 'form-control form-control-sm ',  'data-geo' => 'postal_code', 'placeholder' => 'Postcode')) }}
            </fieldset>
          </div>
        </div>
        <div class="row  p-x-2">
         <div class="col-sm-5">
          <fieldset class="form-group">
            {{ Form::text('state', null, array('class' => 'form-control form-control-sm ',  'data-geo' => 'administrative_area_level_1', 'placeholder' => 'State/Province')) }}
          </fieldset>
        </div>
        <div class="col-sm-5">
          <fieldset class="form-group">
            {{ Form::text('country', null, array('class' => 'form-control form-control-sm ',  'data-geo' => 'country', 'placeholder' => 'Country')) }}
          </fieldset>
        </div>
        <div class="col-sm-2">
          <fieldset class="form-group">
            {{ Form::text('country_code', null, array('class' => 'form-control form-control-sm ',  'data-geo' => 'country_short', 'placeholder' => 'ISO')) }}
          </fieldset>
        </div>
      </div>
      <div class="row p-x-2">
        <div class="col-sm-4">
          <fieldset class="form-group">
            {{ Form::text('latitude', null, array('class' => 'form-control form-control-sm ',  'data-geo' => 'lat', 'placeholder' => 'Latitude')) }}
          </fieldset>
        </div>
        <div class="col-sm-4">
          <fieldset class="form-group">
            {{ Form::text('longitude', null, array('class' => 'form-control form-control-sm ',  'data-geo' => 'lng', 'placeholder' => 'Longitude')) }}
          </fieldset>
        </div>
      </div>
    </div>
  </div>
  {{ Form::close() }}

  @if ($errors->any())
  <ul>
    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
  </ul>
  @endif
</div>
@stop
