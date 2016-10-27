<div class="filter-locations">
  <div class="btn-group">

    {{-- If country has retailers show active selection --}}
    @if($exists)
    <button class="btn btn-secondary btn-sm dropdown-toggle b1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="flag-nation flag-icon" style="background-image: url('{{ env('APP_URL') }}storage/flags/{{strtolower($iso)}}.svg');"></span> 
      <span class="pl-1">{{$country}}</span>
    </button>

    {{-- If country has no retailers show only flag  --}}
    @else 
    <button class="btn btn-secondary btn-sm dropdown-toggle b1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="flag-nation flag-icon" style="background-image: url('{{ env('APP_URL') }}storage/flags/{{strtolower($geo['isoCode'])}}.svg');"></span> 
      <span class="pl-1">Country</span>
    </button>
    @endif

    {{-- Countries Dropdown  --}}
    <div class="dropdown-menu">
      @foreach ($countries as $key => $value)
      {{-- If Country Active --}}
      <a class="dropdown-item location-country" href="{{ $value->country_slug}}?shop=nah-bro.myshopify.com" data-country-code="{{ $value->country_code}}">
        <span class="flag-nation flag-icon" style="background-image: url('{{ env('APP_URL') }}storage/flags/{{strtolower($value->country_code)}}.svg');"></span>
        {{ $value->country}}
      </a>
      @endforeach
    </div>
  </div>
</div>