   <h3>By Visitor Country</h3>

  @foreach ($retailers as $key => $value)

  <div class="grid__item one-quarter stroked">
    <div class="retailer-item">
      <img src="{{ env('APP_URL') }}{{ Storage::url($value->logo_lg) }}" class="img-fluid">
      <a href="{{ env('APP_URL') }}{{$value->country_slug}}/{{$value->city_slug}}/{{$value->slug}}">
        <div class="name">{{$value->name}}</div>
        <div class="city">{{ $value->city}}</div>
        <div class="country"> {{ $value->country}}</div>
      </a>
    </div>
  </div>

  @endforeach