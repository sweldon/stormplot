<?php 
 
require_once('scripts/php/getxml.php'); 
//USE HTTP NOT HTTPS!!!!!!!!!!!!!
$coordinates = getCoordinates("http://alerts.weather.gov/cap/wwacapget.php?x=NC1253B4A0D36C.SevereThunderstormWarning.1253B4A0F568NC.MHXSVRMHX.697dc3677acb958c1e385be679d44b3b");
$center = centerMap("Onslow, NC");



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
    <script>

    google.maps.event.addDomListener(window, 'load', initialize);



    coordinates = "<?php echo $coordinates; ?>";


    //getPolygon("44.71,-72.91 44.32,-72.98 44.09,-73.07 44.07,-73.82 44.32,-73.64 44.66,-73.42 44.71,-72.91");

    getPolygon(coordinates);

    center = "<?php echo $center; ?>";
   
    centerChunk = center.split(" ");




    /*

    Should be:

    coordinates = getCoordinates();

    getPolygon(coordinates);

    */





    </script>
  </head>
  <body>
    <div id="map-canvas"></div>
    <div id="test"></div>
  </body>
</html>