@extends('proxy.layout.skeleton')

@section('content')

<div class="grid-middle">
  <div id="retailers-list">
    <div class="grid">
      <div class="grid__item one-whole">
        <h1>Locate Retailers</h1>
        <input type="search" name="search" class="search" placeholder="Enter your City, State or Country">
        <hr>
      </div>
    </div>
    <ul class="grid list">
      @foreach ($retailers as $key => $value)
      <li class="grid__item one-third">
        <a href="{{ env('APP_URL') }}/{{$value->country}}/{{$value->city}}/{{$value->slug}}">
          <h4><span class="name">{{ $value->name}}</span></h4>
          <span class="city">{{ $value->city}}</span><br>
          <span class="country">{{ $value->country}}</span>
        </a>
      </li>
      @endforeach
    </ul>
  </div>
</div>

@stop

@section('js')
<script>
  loadjs([
    '{{ env('APP_URL') }}/assets/app/js/plugins/list.min.js'],
    { success: function() {
      skriptz.search();
    }
  });

  window.skriptz = window.skriptz || {};

  skriptz.search = function () {
    var RetailersList = new List('retailers-list', {
      valueNames: ['country','city','state']
    });
  };
</script>
@stop
