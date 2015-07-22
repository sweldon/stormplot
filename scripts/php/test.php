<?php
require_once('getxml.php'); 
function getArea($alert)
{

$html = curlPage($alert);

$xml = new SimpleXMLElement($html);
#print_r($xml);

// IDEA: RETURN WHOLE XML AND PARSE WITH JAVASCRIPT

//FIRST 2 DIGITS OF <geocode> GIVE STATE
$geocode = $xml->xpath("/*/*/*/*[local-name()='geocode'][last()]/text()");

$stateString = $geocode[0];


$state = (string)$stateString->value;

$state = substr($state, 0, 2);



$areaDesc = $xml->xpath("/*/*/*/*[local-name()='areaDesc']/text()");

$areaString = (string)$areaDesc[0];

$areas = explode(";", $areaString);

$county = $areas[0].", ".$state;

return $county;

}
getArea("http://alerts.weather.gov/cap/wwacapget.php?x=LA1253B4A0C2A0.FloodWarning.1253B4B0EF40LA.LIXFLSLIX.f29d82b6ed481b5c6357a93188151398");
?>

