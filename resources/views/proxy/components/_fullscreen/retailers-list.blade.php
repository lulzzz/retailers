<div class="retailers-menu--map">
  <ul class="list" style="display:none;">
    @foreach ($retailers as $key => $value)
      <li class="list-btn location" data-iso data-logo data-storefront data-location>
        <span class="name">{{$value['name']}}</span><br>
        <span class="street_number">{{ $value['street_number']}}</span>
        <span class="street_address">{{ $value['street_address']}}</span><br>
        <span class="city">{{ $value['city']}}</span>,
        <span class="country"> {{ $value['country']}}</span> <span class="postcode">{{$value['postcode']}}</span><br>
        <span class="distance">{{$value['distance']}} Away</span><br>
        <div class="pull-right">
          <div class="logos">
            @if($value['logo_lg'])
              <img src="{{$value['logo_md']}}" class="img-fluid" style="max-width:50px;">
            @endif
          </div>
        </div>
      </li>
    @endforeach
  </ul>
</div>
