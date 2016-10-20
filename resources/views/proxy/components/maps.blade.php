<div class="grid--full">  
 <div class="grid__item one-whole">
   <div class="map_canvas" id="map-index"></div>
 </div>
</div>


@section('js')
<script>
  loadjs([
    '//maps.google.com/maps/api/js?key=AIzaSyB5HPEKmq2MDh5JKp-Zmys0SjV2-UNNGNQ',
    '//cdn.shopify.com/s/files/1/0638/4637/t/2/assets/gmaps.min.js'],
    { success: function() {  
      skriptz.map();
    }
  });

  window.skriptz = window.skriptz || {};

  skriptz.map = function () {
   var latlongs = [
   @foreach ($retailers as $key => $value)
   [{{$value->lat}},{{$value->lng}}],
   @endforeach
   ];

   map = new GMaps({
    div: '#map-index',
    styles: styles,
    scrollwheel: false
  });

   latlongs.forEach(function(val, i){
    var lat = latlongs[i][0]*1,
    long = latlongs[i][1]*1;

    map.addMarker({
      lat: lat,
      lng: long,
    });
  });

   map.fitZoom();
 };

</script>
@stop