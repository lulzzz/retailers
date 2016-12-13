<div class="list-retailers">
  @if($error)
    <div class="alert">
      <b>No Retailers Found!</b>, We have no Retailers located in <b>{{$geo['country']}}</b>.
    </div>
  @endif
  <ul class="list disabled">
    @foreach ($retailers as $key => $value)
      <li class="li-list--index ref-location">
        <div class="retailer-list--left">
          <span class="name">{{$value['name']}}</span><br>
          <span class="street_number">{{ $value['street_number']}}</span>
          <span class="street_address">{{ $value['street_address']}}</span><br>
          <span class="city">{{ $value['city']}}</span>,
          <span class="country"> {{ $value['country']}}</span>
        </div>
        <div class="retailer-list--right">
          <span class="distance">{{$value['distance']}}</span><small>km away </small><br>
        </div>
      </li>
    @endforeach
  </ul>
</div>
