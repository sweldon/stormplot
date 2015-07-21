<?php 
 
require_once('scripts/php/getxml.php'); 
//USE HTTP NOT HTTPS!!!!!!!!!!!!!
$coordinates = getCoordinates("http://alerts.weather.gov/cap/wwacapget.php?x=GA1253B4949318.SevereThunderstormWarning.1253B4949F34GA.CHSSVSCHS.ff1e54d8f3fa208eca10232f4dbd8c80");
$json = getJSON("Terrell,%20GA");

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



    coordinates = "<?php echo $coordinates; ?>;";


    //getPolygon("44.71,-72.91 44.32,-72.98 44.09,-73.07 44.07,-73.82 44.32,-73.64 44.66,-73.42 44.71,-72.91");

    getPolygon(coordinates);

        jsonString = <?php echo $json; ?>;

    json = JSON.parse(jsonString);

    console.log(json);



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