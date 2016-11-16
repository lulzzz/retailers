 <div class="retailers-menu--map">
  <ul class="list">
    @foreach ($retailers as $key => $value)
    <li class="list-btn location" data-iso="{{$iso}}" data-storefront="{{ env('APP_URL') }}/{{ Storage::url($value['storefront_lg']) }}" data-location>
          <span class="name">{{$value['name']}}</span><br>
          <span class="street_number">{{ $value['street_number']}}</span>
          <span class="street_address">{{ $value['street_address']}}</span><br>
          <span class="city">{{ $value['city']}}</span>,
          <span class="country"> {{ $value['country']}}</span> <span class="postcode">{{$value['postcode']}}</span><br>
          <span class="distance">{{$value['distance']}} Away</span><br>
        <div class="pull-right">
          <div class="logos">
            @if($value['logo_lg'])
            {{-- If Retailer Logo Exisits--}}
            @else
            {{-- If Retailer Logo Exisits--}}
            @endif
          </div>
        </div>
    </li>
    @endforeach
  </ul>
</div>
