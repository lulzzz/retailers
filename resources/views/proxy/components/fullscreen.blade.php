<div class="row">
  <div class="col-xs-3 pr-0" id="retailers-list">

    <input type="search" name="search" class="search search--map" placeholder="Enter your City, State or Country">

    <div class="btn-group">
      <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{$country}}
      </button>
      <div class="dropdown-menu">
        @foreach ($retailers as $key => $value)
        <a class="dropdown-item" href="{{ env('APP_URL') }}{{ $value->country_slug}}">{{ $value->country}}</a>
        @endforeach
      </div>
    </div>

    <ul class="retailers-menu--map list">
      @foreach ($retailers as $key => $value)
      <li>  
        <a href="javascript:void(0);" class="location" data-location="{{ $value->latitude}},{{ $value->longitude}}" data-title="{{ $value->name}}" data-html="{{ $value->country}}">
          <div class="row">
            <div class="col-xs-8">
              <span class="flag-nation flag-icon" style="background-image: url('{{ env('APP_URL') }}storage/flags/{{strtolower($value->country_code)}}.svg');"></span>
              <div class="name">{{$value->name}}</div>
              <div class="city">{{ $value->city}}</div>
              <div class="country"> {{ $value->country}}</div>
            </div>
            <div class="col-xs-4">
              <div class="logo">
                <img src="{{ env('APP_URL') }}{{ Storage::url($value->logo_lg) }}" class="img-fluid">
              </div>
            </div>
          </div>
        </a>
      </li>
      @endforeach
    </ul>  
  </div>
  <div class="col-xs-9 pl-0">
    <div class="map-container" id="map-container"></div>
  </div>
</div>
