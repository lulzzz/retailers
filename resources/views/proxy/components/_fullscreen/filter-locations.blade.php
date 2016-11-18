<div class="filter-locations">
  <div class="btn-group">

    {{-- If country has retailers show active selection --}}
    <button class="btn btn-secondary btn-sm dropdown-toggle b1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="flag-nation flag-icon" style="background-image: url('https://5c452b52.ngrok.io/Retailers/public/images/flags/{{strtolower($iso)}}.svg');"></span>
      <span class="pl-1">{{$nation}}</span>
    </button>

    {{-- Countries Dropdown  --}}
    <div class="dropdown-menu">
      @foreach ($countries as $key => $value)
      {{-- If Country Active --}}
      <a class="dropdown-item location-country" href="/app/{{ $value->country_slug}}?shop=nah-bro.myshopify.com">
        <span class="flag-nation flag-icon" style="background-image: url('https://5c452b52.ngrok.io/Retailers/public/images/flags/{{strtolower($value->country_code)}}.svg');"></span>
        {{ $value->country}}
      </a>
      @endforeach
    </div>
  </div>
</div>
