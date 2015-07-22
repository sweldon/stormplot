<?php
require_once('scripts/php/getxml.php'); 
function getRecentAlerts()
{
	$html = curlPage("http://alerts.weather.gov/cap/us.php?x=1");
	$xml = new SimpleXMLElement($html);
	$test = $xml->xpath("/*/*[local-name()='entry'][1]");
	$mostrecent = (string)$test[0]->id;
	//print_r($mostrecent);
	return $mostrecent;

}

$recent = getRecentAlerts();

?>


<!DOCTYPE html>
<html>
  <head>
    <title>[BETA] Storm Plot</title>
	<link rel="stylesheet" type="text/css" href="style/style.css">
  </head>
<body>

<div id="container">

<div id="choices">
<a href="http://localhost/dev/geolocation.html">
<div id="use-here">
Use This Location
</div>
</a>
<a href="http://localhost/dev/plot.html">
<div id="use-home">
Use My Home
</div>
</a>

<br /><br /><br /><br /><br />



</div>

<hr />
<center>
<form id="directLink" method="GET" action="plot.php">

<input type="text" name="alert" size="100"></input>

<input type="submit" value="Plot"></input>

</form>
<br />
<a href="plot.php?alert=<?php echo $recent; ?>">
<div id="use-recent">
Most Recent Alert<br />
</div>
</a>
</center>


</div>


</body>
</html>