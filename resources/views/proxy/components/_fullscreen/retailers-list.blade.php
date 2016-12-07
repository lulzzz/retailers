@if(Request::route()->getName() == 'proxy_index')
<div class="retailers-menu--map">
  @if($error)
    <div class="alert">
      <h3>No Retailers located in {{$geo['country']}}! </h3>
    </div>
  @endif
  <ul class="list list-disabled">
    @foreach ($retailers as $key => $value)
      <li class="list-btn location" data-iso data-logo data-storefront data-location data-slug>
        <span class="name">{{$value['name']}}</span><br>
        <span class="street_number">{{ $value['street_number']}}</span>
        <span class="street_address">{{ $value['street_address']}}</span><br>
        <span class="city">{{ $value['city']}}</span>,
        <span class="country"> {{ $value['country']}}</span> <span class="postcode">{{$value['postcode']}}</span><br>
        <span class="distance">{{$value['distance']}}</span><small>km away </small><br>

      </li>
    @endforeach
  </ul>
</div>

@elseif (Request::route()->getName() == 'proxy_retailer')

  <ul class="list list-disabled">
    @foreach ($locations as $key => $value)
      <li class="list-btn location" data-iso data-logo data-storefront data-location data-slug>
        <span class="name">{{$value['name']}}</span><br>
        <span class="street_number">{{ $value['street_number']}}</span>
        <span class="street_address">{{ $value['street_address']}}</span><br>
        <span class="city">{{ $value['city']}}</span>,
        <span class="country"> {{ $value['country']}}</span> <span class="postcode">{{$value['postcode']}}</span><br>
        <span class="distance">{{$value['distance']}}</span><small>km away </small><br>

      </li>
    @endforeach
  </ul>
@else

@endif
