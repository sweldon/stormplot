<?php 
 
require_once('scripts/php/getxml.php'); 
//USE HTTP NOT HTTPS!!!!!!!!!!!!!
$alert = "http://alerts.weather.gov/cap/wwacapget.php?x=AL1253B4A3478C.SevereThunderstormWarning.1253B4A3608CAL.BMXSVSBMX.46618850bf2a2ce3e3083951a2a37391";
$coordinates = getCoordinates($alert);
$county = getArea($alert);
//$center = centerMap($county);



?> 
<!DOCTYPE html>
<html>
  <head>
    <title>Area Plot</title>
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
    <script src="scripts/js/drawmap.js"></script>
    <script src="scripts/js/buildCoords.js"></script>
    <script src="scripts/js/parseXML.js"></script>
    <script src="scripts/js/eyeOfStorm.js"></script>
    <script>

    google.maps.event.addDomListener(window, 'load', initialize);



    coordinates = "<?php echo $coordinates; ?>";

    //stormCenter = eyeOfStorm(coordinates);

    getPolygon(coordinates);


    eyeCoords = eyeOfStorm(coordinates);



    



    </script>
  </head>
  <body>
    <div id="map-canvas"></div>
    <div id="test"></div>
  </body>
</html>