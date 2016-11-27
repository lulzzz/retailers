if(store.get('latitude')) {

  // Returning visitor.
  retailers.json('/a/retailers/'+store.get('latitude')+'/'+store.get('longitude')+'?shop={{$domain}}');

} else {
  // check if user browser has geolocation
  if (navigator.geolocation) {

    //Get users location
    navigator.geolocation.getCurrentPosition(function(position) {

      // Stores latitude and longitude of visitor address
      store.set('latitude', position.coords.latitude);
      store.set('longitude', position.coords.longitude);

      // New visitor
      retailers.json('/a/retailers/'+position.coords.latitude+'/'+position.coords.longitude+'?shop={{$domain}}');

    }, function() {
      retailers.json('/a/retailers/{{$geo['lat']}}/{{$geo['lon']}}?shop={{$domain}}');
    });
  } else {
    // Browser doesn't support Geolocation
    retailers.json('/a/retailers/{{$geo['lat']}}/{{$geo['lon']}}?shop={{$domain}}');
  }
}
