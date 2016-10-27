<div class="retailers-menu--map">
  <ul class="list">
    @foreach ($retailers as $key => $value)
    <li>  
      <button type="button" class="list-btn location" data-location="{{ $value['latitude']}},{{ $value['longitude']}}" data-logo="{{ env('APP_URL') }}{{ Storage::url($value['logo_lg']) }}" data-storefront="{{ env('APP_URL') }}{{ Storage::url($value['storefront_lg']) }}" data-iso="{{ env('APP_URL') }}storage/flags/{{strtolower($value['country_code'])}}.svg">
        <div class="pull-left">
          <span class="name">{{$value['name']}}</span><br>
          <span class="street">{{ $value['street_number']}} {{ $value['street_address']}}</span><br>
          <span class="city">{{ $value['city']}}</span>,
          <span class="country"> {{ $value['country']}}</span> {{$value['postcode']}}
        </div>
        <div class="pull-left pl-3">
          <br>
          @if(Route::current()->getName() == 'proxy_country')
          <span class="distance pl-3">{{$value['distance']}} Away</span><br>
          @endif
        </div>
        <div class="pull-right">
          <div class="logo">

            @if($value['logo_lg'])
            {{-- If Retailer Logo Exisits--}}
            <img src="{{ env('APP_URL') }}{{ Storage::url($value['logo_lg']) }}">
            @else
            {{-- If Retailer Logo Exisits--}}
            <img>
            @endif
          </div>
        </div>
      </button>
    </li>
    @endforeach
  </ul>  
</div>