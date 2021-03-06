<?php

require_once('scripts/php/getxml.php'); 

$ip = getIP();
$ipLoc = locateIP($ip);
$lat = $ipLoc[0];
$lng = $ipLoc[1];
$countyFromIP = getCounty($lat, $lng);


?>

<!DOCTYPE html>
<html>
  <head>
    <title>Geolocation</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">

    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0;
        padding: 0;
      }

    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
    <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script>

//Gets lat and long of a place

// BOUND NORTHEAST AND SOUTHWEST

// var southWest = new google.maps.LatLng(36.90731625763393,-86.51778523864743);
// var northEast = new google.maps.LatLng(37.02763411292923,-86.37183015289304);
// var bounds = new google.maps.LatLngBounds(southWest,northEast);
// myMap.fitBounds(bounds);

  // var latlong = []
  // var longitude;
  // var latitude;
  // place = "1 wood creek road, new fairfield"
  // url="https://maps.googleapis.com/maps/api/geocode/json?address="+place;

  // $.getJSON(url, function(data) {
  //   longitude = data.results[0].geometry.location.lng
  //   latitude = data.results[0].geometry.location.lat
  //   latlong.push(longitude);
  //   latlong.push(latitude);
  //   console.log(latlong);})


var map;

function initialize() {
  var mapOptions = {
    zoom: 15,
     mapTypeId: google.maps.MapTypeId.TERRAIN
  };
  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);

// console.log(<?php echo $lat; ?>, <?php echo $lng; ?>)
// var pos =  new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>);

//       var infowindow = new google.maps.InfoWindow({
//         map: map,
//         position: pos,
//         content: 'YOU: <?php echo $countyFromIP; ?> (county)'
//       });

//       map.setCenter(pos);



//GEO LOCATION with JAVASCRIPT (much more precise atm):

  if(navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = new google.maps.LatLng(position.coords.latitude,
                                       position.coords.longitude);


      console.log(pos);

    //https://maps.googleapis.com/maps/api/geocode/json?address=[WHATEVER]
    //var pos = new google.maps.LatLng(41.4676771, -73.47374669999999)

      var infowindow = new google.maps.InfoWindow({
        map: map,
        position: pos,
        content: 'YOU: <?php echo $countyFromIP; ?> (county)'
      });

      map.setCenter(pos);
    }, function() {
      handleNoGeolocation(true);
    });
  } else {
    // Browser doesn't support Geolocation
    handleNoGeolocation(false);
  }



}


// UN COMMMENT WITH GEOLOCATION
function handleNoGeolocation(errorFlag) {
  if (errorFlag) {
    var content = 'Error: The Geolocation service failed.';
  } else {
    var content = 'Error: Your browser doesn\'t support geolocation.';
  }

  var options = {
    map: map,
    position: new google.maps.LatLng(60, 105),
    content: content
  };

  var infowindow = new google.maps.InfoWindow(options);
  map.setCenter(options.position);
}


// ALWAYS NEED THIS
google.maps.event.addDomListener(window, 'load', initialize);



    </script>
  </head>
  <body>
    <div id="map-canvas"></div>
  </body>
</html>