@extends('proxy.layout.skeleton')

@section('content')

   <div class="retailers-container">
      <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 pr-0">
            @if(count($locations) == 1)
            <div class="retailer-wrapper"  style="border-bottom:none;">
            @elseif(count($locations) == 2)
            <div class="retailer-wrapper"   style="height:370px;">
            @elseif(count($locations) == 3)
            <div class="retailer-wrapper"   style="height:270px;">
            @elseif(count($locations) > 3)
            <div class="retailer-wrapper"   style="height:270px;">
            @endif
               <div class="retailer-info">
                  <div class="retailer-header">
                     <h1>{{$retailer->name}}</h1>
                     <h3 class="sub-header">{{$retailer->website}}</h3>
                  </div>
                  @if($retailer->description)
                     <div class="retailer-description">
                        {{$retailer->description}}
                     </div>
                  @else
                     @if(count($locations) == 1)
                        <div class="retailer-address">
                           @foreach ($locations as $key => $value)
                              {{$value['street_number']}} {{ $value['street_address']}}<br>
                              {{$value['city']}}, {{ $value['postcode']}}<br>
                              {{$value['country']}}<br>
                           @endforeach
                        </div>
                     @endif
                  @endif
               </div>
            </div>
            @if(count($locations) == 1)
               <div class="list-retailers disable-overflow" style="max-height:350px;">
                  <ul class="list list-disabled">
                     @foreach ($locations as $key => $value)
                     <li class="li-list--1-retailer ref-location" data-latitude="{{ $value['latitude']}}" data-longitude="{{ $value['longitude']}}">
                        <div class="sticker">
                           <div class="logo">
                              <img src="{{ $retailer->logo_lg}}"></div>
                              <div class="store">
                                 <img src="https://maps.googleapis.com/maps/api/streetview?size=600x300&location={{ $value['latitude']}},{{ $value['longitude']}}&heading=151.78&pitch=-0.76&key=AIzaSyAMElu9QAKi3qU68wXQ5yJSCG_YNWVU3do">
                              </div>
                           </li>
                           @endforeach
                        </ul>
                     </div>
                  @elseif (count($locations) == 2)
                     <div class="list-retailers disable-overflow" style="max-height:330px;">
                        <ul class="list list-disabled">
                           @foreach ($locations as $key => $value)
                              <li class="li-list--2-retailers ref-location" data-latitude="{{ $value['latitude']}}" data-longitude="{{ $value['longitude']}}">
                                 <div class="retailer-address">
                                    {{$value['street_number']}} {{ $value['street_address']}}<br>
                                    {{$value['city']}}, {{ $value['postcode']}}<br>
                                    {{$value['country']}}
                                    </div>
                                    <img  src="https://maps.googleapis.com/maps/api/streetview?size=600x300&location={{ $value['latitude']}},{{ $value['longitude']}}&heading=151.78&pitch=-0.76&key=AIzaSyAMElu9QAKi3qU68wXQ5yJSCG_YNWVU3do" class="storefront">
                                 </li>
                                    @endforeach
                                 </ul>
                              </div>
                           @elseif (count($locations) == 3)
                              <div class="list-retailers disable-overflow" style="max-height:340px;">
                                 <ul class="list list-disabled">
                                    @foreach ($locations as $key => $value)
                                       <li class="li-list--3-retailers ref-location" data-latitude="{{ $value['latitude']}}" data-longitude="{{ $value['longitude']}}">
                                          <div class="retailer-address">
                                             {{$value['street_number']}} {{ $value['street_address']}}<br>
                                             {{$value['city']}}, {{ $value['postcode']}}<br>
                                             {{$value['country']}}
                                             </div>
                                             <img  src="https://maps.googleapis.com/maps/api/streetview?size=600x300&location={{ $value['latitude']}},{{ $value['longitude']}}&heading=151.78&pitch=-0.76&key=AIzaSyAMElu9QAKi3qU68wXQ5yJSCG_YNWVU3do" class="storefront">
                                          </li>
                                       @endforeach
                                    </ul>
                                 </div>
                              @elseif (count($locations) > 3)
                                 <div class="list-retailers" style="max-height:330px;">
                                    <ul class="list list-disabled">
                                       @foreach ($locations as $key => $value)
                                          <li class="li-list--3-retailers ref-location" data-latitude="{{ $value['latitude']}}" data-longitude="{{ $value['longitude']}}">
                                             <div class="retailer-address">

                                             {{$value['street_number']}} {{ $value['street_address']}}<br>
                                             {{$value['city']}}, {{ $value['postcode']}}<br>
                                             {{$value['country']}}
                                                </div>
                                                <img  src="https://maps.googleapis.com/maps/api/streetview?size=600x300&location={{ $value['latitude']}},{{ $value['longitude']}}&heading=151.78&pitch=-0.76&key=AIzaSyAMElu9QAKi3qU68wXQ5yJSCG_YNWVU3do" class="storefront">
                                             </li>
                                          @endforeach
                                       </ul>
                                    </div>
                                 @else
                              @endif

                     </div>

                     <div class="col-xs-12 col-sm-12  col-md-6 col-lg-8 pl-0">
                        <div class="map" id="locate-retailer-map" data-map></div>
                     </div>
                  </div>
               </div>
            @stop

            @section('js')
               var markers = [@foreach($locations as $key => $value)[{{$value['latitude']}},{{$value['longitude']}},'{{$value['country_code']}}','{{$retailer->name}}','{{$retailer->logo_md}}'],@endforeach];

                  retailers.map('locate-retailer-map', {{$geo->latitude}}, {{$geo->longitude}}, '{{$domain}}', markers, 'retailer');
               @stop
