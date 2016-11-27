<script>
loadjs(['{{ env('APP_URL') }}/js/plugins/map_styles.min.js',
'https://cdnjs.cloudflare.com/ajax/libs/qwest/4.4.5/qwest.min.js'],
 { success: function() {
   skriptz.init();
 }
});

window.skriptz = window.skriptz || {};

skriptz.init = function () {
 skriptz.maps();
};

skriptz.maps = function () {
  if (document.getElementById('map-container')){
    //=include ../blade/_map/location.js
    //=include ../blade/_map/settings.js
    //=include ../blade/_map/geolocate.js
    //=include ../blade/_map/markers.js
    //=include ../blade/_map/list.js
  };
  console.log('Map Initialized')
};




</script>
