<script>
loadjs(['{{ env('APP_URL') }}js/plugins/map_styles.min.js'],
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
  
  console.log('List Initialized') 
};

skriptz.maps = function () {
  if (document.getElementById('map-container')){
    //=include ../blade/_php/map_locations.js
    //=include ../blade/_php/map_settings.js
    //=include ../blade/_min/map.js
  };
  console.log('Map Initialized')
};




</script>