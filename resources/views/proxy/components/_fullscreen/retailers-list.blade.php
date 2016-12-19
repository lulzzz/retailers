<div class="list-retailers">
  <ul class="list disabled">
    @foreach ($retailers as $key => $value)
      <li class="li-list--index" data-map="retailer">
        <div class="retailer-list--left">
          <span class="name">{{$value['name']}}</span><br>
          <span class="street_number">{{ $value['street_number']}}</span>
          <span class="street_address">{{ $value['street_address']}}</span><br>
          <span class="city">{{ $value['city']}}</span>,
          <span class="country"> {{ $value['country']}}</span>
        </div>
        <div class="retailer-list--right pr-1">
          <span class="distance">{{ $value['distance']}}</span>
          <small>@if($geo['isoCode'] == 'US')miles @else km @endif away</small><br>
        </div>
      </li>
    @endforeach
  </ul>
</div>
