 <div class="card-box p-x-0">
  <div class="p-x-2">
    <h3><span class="pull-left">Locations</span></h3>
    <hr>
  </div>
  <div class="p-x-2">
    <div class="input-group">
      <input type="text" class="form-control geocomplete" placeholder="Enter Location..." data-geo>
      <span class="input-group-btn">
        <button  class="btn btn-secondary finder" type="button">Find</button>
      </span>
    </div>
    <div class="row">
      <div class="col-xs-12">
      </div>
    </div>
    <hr>
  </div>
  <div class="p-x-2">
    <div class="row">
      <div class="col-sm-1">
        <fieldset class="form-group">

          {{ Form::label('street_number', 'Number:') }}
          {{ Form::text('street_number', null, array('class' => 'form-control form-control-sm',  'data-geo' => 'street_number')) }}
        </fieldset>
      </div>
      <div class="col-sm-3">
        <fieldset class="form-group">
          {{ Form::label('street_address', 'Street Address:') }}
          {{ Form::text('street_address', null, array('class' => 'form-control form-control-sm ',  'data-geo' => 'route')) }}
        </fieldset>
      </div>
      <div class="col-sm-3">
        <fieldset class="form-group">
          {{ Form::label('city', 'City:') }}<br>
          {{ Form::text('city', null, array('class' => 'form-control form-control-sm ',  'data-geo' => 'locality')) }}
        </fieldset>
      </div>
      <div class="col-sm-3">
        <fieldset class="form-group">
          {{ Form::label('state', 'State/Province:') }}
          {{ Form::text('state', null, array('class' => 'form-control form-control-sm ',  'data-geo' => 'administrative_area_level_1')) }}
        </fieldset>
      </div>
      <div class="col-sm-2">
        <fieldset class="form-group">
          {{ Form::label('postcode', 'Postcode:') }}<br>
          {{ Form::text('postcode', null, array('class' => 'form-control form-control-sm ',  'data-geo' => 'postal_code')) }}
        </fieldset>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-sm-4">
        <fieldset class="form-group">
          {{ Form::label('latitude', 'Latitude:') }}<br>
          {{ Form::text('latitude', null, array('class' => 'form-control form-control-sm ',  'data-geo' => 'lat')) }}
        </fieldset>
      </div>
      <div class="col-sm-4">
        <fieldset class="form-group">
          {{ Form::label('longitude', 'Longitude:') }}<br>
          {{ Form::text('longitude', null, array('class' => 'form-control form-control-sm ',  'data-geo' => 'lng')) }}
        </fieldset>
      </div>
      <div class="col-sm-3">
        <fieldset class="form-group">
          {{ Form::label('country', 'Country:') }}<br>
          {{ Form::text('country', null, array('class' => 'form-control form-control-sm ',  'data-geo' => 'country')) }}
        </fieldset>
      </div>
      <div class="col-sm-1">
        <fieldset class="form-group">
          {{ Form::label('country_code', 'Code:') }}<br>
          {{ Form::text('country_code', null, array('class' => 'form-control form-control-sm ',  'data-geo' => 'country_short')) }}
        </fieldset>
      </div>
    </div>
  </div>
</div>

<div class="row">
  @foreach ($retailer->locations as $key => $value)
  <div class="col-sm-4" data-location-{{ $value->id }}>
    <div class="card-box  p-x-0">
      <div class="p-x-2">
        {{ $value->street_number }} {{ $value->street_address }}<br>
        {{ $value->city }}, {{ $value->state }}, {{ $value->postcode }}<br>
        {{ $value->country }}, {{ $value->country_code }}
      </div>
      <hr>
      <div class="p-x-2">
       <small> Longitude:</small><br> {{ $value->longitude }}<br>
       <small>Latitude:</small><br>{{ $value->latitude }}
     </div>
     <hr>
     <div class="row">
       <div class="col-sm-12">
         <div class="p-x-2 pull-right">
           <div class="text-right">
            <button  class="btn btn-danger btn-sm m-y-0"  type="button" id="address-remove-{{ $value->id}}">
              Delete
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endforeach
</div>

