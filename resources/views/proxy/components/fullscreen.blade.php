<div class="row">
  <div class="col-xs-3 p-0">
    <div id="retailers-list" class="retailers-search">
      <h2>Retailers</h2>

      <div class="retailers-locator">
        <input type="search" name="search" class="search search--map" placeholder="Enter your City, State or Country">
        <div class="filter-locations">
          <div class="btn-group">

            @if($exists)
            {{-- If country has retailers show active selection --}}
            <button class="btn btn-secondary btn-sm dropdown-toggle b1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             <span class="flag-nation flag-icon" style="background-image: url('storage/flags/{{strtolower($geo['isoCode'])}}.svg');"></span> 
             <span class="pl-1">{{ucfirst($geo['country'])}}</span>
           </button>
           @else 
           {{-- If country has no retailers show only flag  --}}
           <button class="btn btn-secondary btn-sm dropdown-toggle b1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             <span class="flag-nation flag-icon" style="background-image: url('storage/flags/{{strtolower($geo['isoCode'])}}.svg');"></span> 
             <span class="pl-1">Country</span>
           </button>
           @endif

           <div class="dropdown-menu">
            @foreach ($countries as $key => $value)
            <a class="dropdown-item location-country" href="app/{{ $value->country_slug}}?shop=nah-bro.myshopify.com" data-country-code="{{ $value->country_code}}">
              <span class="flag-nation flag-icon" style="background-image: url('storage/flags/{{strtolower($value->country_code)}}.svg');"></span>
              {{ $value->country}}
            </a>
            @endforeach
          </div>
        </div>
        <div class="btn-group">
          <button class="btn btn-secondary btn-sm dropdown-toggle b2 pl-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            City
          </button>
          <div class="dropdown-menu">
            @if(Route::current()->getName() == 'proxy_country')
            @foreach ($cities as $key => $value)
            <a class="dropdown-item location-city" href="app/{{ $value->city_slug}}?shop=nah-bro.myshopify.com" >{{ $value->city}}</a>
            @endforeach
            @endif
          </div>
        </div>
      </div>
    </div>
    <div class="retailers-menu--map">
      <ul class="list">
        @foreach ($retailers as $key => $value)
        <li>  
          <button type="button" class="list-btn location" data-location="{{ $value->latitude}},{{ $value->longitude}}" data-logo="{{ Storage::url($value->logo_lg) }}" data-storefront="{{ Storage::url($value->storefront_lg) }}" data-iso="storage/flags/{{strtolower($value->country_code)}}.svg">
            <div class="row pt-0">
              <div class="col-xs-8">
                <div class="name">{{$value->name}}</div>
                <div class="city">{{ $value->city}}</div>
                <div class="country"> {{ $value->country}}</div>
              </div>
              <div class="col-xs-4">
                <div class="logo">
                  <img src="{{ Storage::url($value->logo_lg) }}" class="img-fluid">
                </div>
              </div>
            </div>
          </button>
        </li>
        @endforeach
      </ul>  
    </div>
  </div>
</div>
<div class="col-xs-9 p-0">
  <div class="map" id="map-container" data-map></div>
</div>
</div>
