function initialize() 
{
  var mapOptions = {
    zoom: 12,
    //Center at your location, at the moment it is the county
    center: new google.maps.LatLng(eyeCoords[0], eyeCoords[1]),
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

