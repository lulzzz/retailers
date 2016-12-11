<div class="list-retailers" style="max-height:560px;">
  @if($error)
    <div class="alert">
      <h3>No Retailers located in {{$geo['country']}}! </h3>
    </div>
  @endif
  <ul class="list disabled">
    @foreach ($retailers as $key => $value)
      <div><img src="{{$value['logo_md']}}"></div>
      <li class="li-list--index ref-location" data-iso data-logo data-name data-location data-slug>
        <div class="float-xs-left">
        <span class="name" data-retailer-name="{{$value['name']}}">{{$value['name']}}</span><br>
        <span class="street_number">{{ $value['street_number']}}</span>
        <span class="street_address">{{ $value['street_address']}}</span><br>
        <span class="city">{{ $value['city']}}</span>,
        <span class="country"> {{ $value['country']}}</span> <span class="postcode">{{$value['postcode']}}</span><br>
      </div>
      <div class="float-xs-right">
        <span class="distance">{{$value['distance']}}</span><small>km away </small><br>
      </div>
      </li>
    @endforeach
  </ul>
</div>
