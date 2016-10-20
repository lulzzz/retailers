@extends('proxy.layout.skeleton')

@section('content')
<div class="grid--full retailers p-x-0">
  <div class="grid__item one-whole">
    <div class="grid wrapper-seller">
      <div class="grid__item one-half medium--one-whole small--one-whole hr-right store-cover">
        <div class="description p-y-2 ">
          <h6><a href="/a/retailers">BRIXTOL RETAILER</a></h6>
          <h1>{{$retailer->name}}</h1>
          {{ $retailer->description}}<br>
          <hr>

          @if ($retailer->type == 'storefront')
          {{$retailer->url}}
          @endif

          <hr>
          {{ $retailer->country}}<br>
          {{ $retailer->street_number}} {{ $retailer->street_address}}<br>
          {{ $retailer->city}}, {{ $retailer->state}}<br>
          {{ $retailer->country}}, {{ $retailer->postcode }}
          <p>
            <ul>
              <li><i class="icon icon-instagram"></i><a href="http://instagram.com/{{ $retailer->instagram }}">{{$retailer->instagram}}</a>
                <li><i class="icon icon-share"></i><a href="http://instagram.com/{{ $retailer->website }}">{{$retailer->website}}</a></li>
                <li><i class="icon icon-email"></i><a href="mailto:{{ $retailer->email }}">{{ $retailer->email }}</a></li>
              </ul>
            </div>
  
          </div>
          <div class="grid__item one-half medium--one-whole small--one-whole map-cover">
            <div class="grid">
              <div class="grid__item one-quarter medium--one-half small--one-whole hr-right">
                <div class="retailer-locations">
                  <address>
                    {{$retailer->street_number}} {{$retailer->street_address}}<br>
                    {{$retailer->city}}, {{$retailer->postcode}}<br>
                    {{$retailer->country }} | {{$retailer->country_code }}
                  </address>
                </div>
              </div>
            </div>
            <div class="grid">
              <div class="grid__item one-whole wrapper-map">
                <div id="map"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endsection


