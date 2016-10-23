<script>
loadjs([
 'https://maps.google.com/maps/api/js?key=AIzaSyCTlnXnQV55QOGl22nw627SDxo6yXynJYs',
 '{{ env('APP_URL') }}js/plugins/list.min.js',
 '{{ env('APP_URL') }}js/plugins/dropdown.min.js',
 '{{ env('APP_URL') }}js/plugins/map_styles.min.js'],
 { success: function() { 
   skriptz.init();
 }
});

window.skriptz = window.skriptz || {};


skriptz.init = function () {
 skriptz.search();
 skriptz.maps();
};

skriptz.search = function () {
  //=include ../blade/_min/list.js
};

skriptz.maps = function () {
  if (document.getElementById('map-container')){
    //=include ../blade/_php/map_locations.js
    //=include ../blade/_php/map_settings.js
    //=include ../blade/_min/map.js
  };
};


</script>