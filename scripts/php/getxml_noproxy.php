<?php

function getCoordinates($alerturl)
{

$url = $alerturl;

$ch = curl_init($url);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	//curl_setopt($ch, CURLOPT_PROXYAUTH, CURLAUTH_NTLM);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
	// curl_setopt($ch, CURLOPT_PROXY, "http://rdg-proxy.am.boehringer.com");
	// curl_setopt($ch, CURLOPT_PROXYPORT,80);
	// curl_setopt($ch, CURLOPT_PROXYUSERPWD,"AM\\sweldon1:Password6");

$html = curl_exec($ch);
curl_close($ch);



$xml = new SimpleXMLElement($html);
#print_r($xml);

// IDEA: RETURN WHOLE XML AND PARSE WITH JAVASCRIPT

//FIRST 2 DIGITS OF <geocode> GIVE STATE
$polygon = $xml->xpath("/*/*/*/*[local-name()='polygon']/text()");

$polygonString = $polygon[0];

return $polygonString;


}
getCoordinates("http://alerts.weather.gov/cap/wwacapget.php?x=GA1253B4949318.SevereThunderstormWarning.1253B4949F34GA.CHSSVSCHS.ff1e54d8f3fa208eca10232f4dbd8c80");

function getJSON($address)
{
	$url = "http://maps.googleapis.com/maps/api/geocode/json?address=".$address;



	$ch = curl_init($url);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	//curl_setopt($ch, CURLOPT_PROXYAUTH, CURLAUTH_NTLM);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
	// curl_setopt($ch, CURLOPT_PROXY, "http://rdg-proxy.am.boehringer.com");
	// curl_setopt($ch, CURLOPT_PROXYPORT,80);
	// curl_setopt($ch, CURLOPT_PROXYUSERPWD,"AM\\sweldon1:Password6");

$rawjson = curl_exec($ch);
curl_close($ch);



//$json = json_decode($rawjson);

// IDEA: RETURN WHOLE JSON AND PARSE WITH JAVASCRIPT

// $general_lat = $json->results[0]->geometry->location->lat;
// $general_lng =  $json->results[0]->geometry->location->lng;

// $center = array($general_lat,$general_lng);
return $rawjson;;




}

function centerMap($address)
{
	$json = getJSON($address);

	$general_lat = $json->results[0]->geometry->location->lat;
	$general_lng =  $json->results[0]->geometry->location->lng;

	$center = array($general_lat,$general_lng);

	return $center;


}


?>