<div class="row">
  <div class="col-sm-8">
    <div class="card-box location-card">
     @if ($errors->any())
     <div id="location_error" class="alert alert-danger" role="alert">
      <strong>Submission Error!</strong>
      <ul class="py-2">
        <li class="error">
          {{ implode('', $errors->all(':message')) }}
        </li>
      </ul>
    </div>
    @endif

    <h3>Locations</h3>
    <hr>
    <div class="input-group">
      <input type="text" class="form-control geocomplete" placeholder="Enter Location..." data-geo>
      <span class="input-group-btn">
        <button  class="btn btn-secondary finder" type="button">Find</button>
      </span>
    </div>
    <hr>
    <div class="row">
      <div class="col-sm-1">
        <fieldset class="form-group">
          {{ Form::label('street_number', 'No') }}
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
          {{ Form::label('country_code', 'Iso') }}<br>
          {{ Form::text('country_code', null, array('class' => 'form-control form-control-sm ',  'data-geo' => 'country_short')) }}
        </fieldset>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-xs-6">
        {{ Form::submit('Add Location',  array('class' => 'btn btn-primary', 'id' => 'add_location', 'data-disable-with' => 'Adding Location')) }}
        {{ Form::reset('Clear',  array('class' => 'btn btn-link')) }}

      </div>
      <div class="col-xs-6">
      </div>
    </div>
  </div>
</div>
<div class="col-sm-4">
  <div class="left-card p-0">
    <div class="map_canvas">
    </div>
  </div>
</div>
</div>


<div class="row" id="pjax-container">
  @foreach ($location as $key => $value)
  <div class="col-sm-3">
    <div class="card-box p-0">
      <div class="delete-location">
      <a class="location_delete" href="{{ route('locations.destroy',array($value->id)) }}" data-method="delete" data-remote="true">
          <svg id="i-close" viewBox="0 0 32 32" width="12" height="12" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="6.25%">
            <path d="M2 30 L30 2 M30 30 L2 2" />
          </svg>
        </a>
      </div>
      <div class="py-3 px-2">
        <a href="#pjax-container" onclick="addressModal('{{ route('address_edit',array($value->id)) }}')" >
          <small>
            {{ $value->street_number }} {{ $value->street_address }}<br>
            {{ $value->city }}, {{ $value->state }}, {{ $value->postcode }}<br>
            {{ $value->country }}, {{ $value->country_code }}
          </small>
        </a>
      </div>
      @if(is_null($value->storefront_lg))
      <div class="px-2 pb-2 text-xs-center">
        <a href="#pjax-container" onclick="storefrontModal('{{ route('locations.edit',array($value->id)) }}')" class="btn btn-block btn-secondary">
         Upload Storefront
       </a>
     </div>
     @else
     <a href="#pjax-container" onclick="storefrontModal('{{ route('locations.edit',array($value->id)) }}')">
      <img src="{{ $value->storefront_lg }}" class="img-fluid">
    </a>
    @endif
  </div>
</div>
@endforeach
</div>
