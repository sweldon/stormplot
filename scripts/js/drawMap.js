function initialize() 
{
  var mapOptions = {
    zoom: 10,
    //Center at your location, at the moment it is the county
    center: new google.maps.LatLng(31.7370079, -84.48026059999999),
    mapTypeId: google.maps.MapTypeId.TERRAIN

  };

  var AOE;

  var map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);

  // Define the LatLng coordinates for the polygon's path.
  var AOEcoords = coordinateArray;



  // Construct the polygon.
  AOE = new google.maps.Polygon({
    paths: AOEcoords,
    strokeColor: '#FF0000',
    strokeOpacity: 0.8,
    strokeWeight: 2,
    fillColor: '#FF0000',
    fillOpacity: 0.35
  });

  AOE.setMap(map);
}

