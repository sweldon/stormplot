<?php

function curlPage($url)
{

	$curlURL = $url;
	$ch = curl_init($curlURL);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_PROXYAUTH, CURLAUTH_NTLM);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
	curl_setopt($ch, CURLOPT_PROXY, "http://rdg-proxy.am.boehringer.com");
	curl_setopt($ch, CURLOPT_PROXYPORT,80);
	curl_setopt($ch, CURLOPT_PROXYUSERPWD,"AM\\sweldon1:Password6");

	$source = curl_exec($ch);
	curl_close($ch);

	return $source;

}

function getCoordinates($alerturl)
{

$html = curlPage($alerturl);

$xml = new SimpleXMLElement($html);
#print_r($xml);

// IDEA: RETURN WHOLE XML AND PARSE WITH JAVASCRIPT

//FIRST 2 DIGITS OF <geocode> GIVE STATE
$polygon = $xml->xpath("/*/*/*/*[local-name()='polygon']/text()");

$polygonString = $polygon[0];

return $polygonString;


}


function getJSON($address)
{
	$clean = str_replace(" ","%20", $address);
	$url = "http://maps.googleapis.com/maps/api/geocode/json?address=".$clean;

	$rawjson = curlPage($url);


//$json = json_decode($rawjson);

// IDEA: RETURN WHOLE JSON AND PARSE WITH JAVASCRIPT

// $general_lat = $json->results[0]->geometry->location->lat;
// $general_lng =  $json->results[0]->geometry->location->lng;

// $center = array($general_lat,$general_lng);



return $rawjson;
}

function centerMap($location)
{
	$rawjson = getJSON($location);
	$json = json_decode($rawjson);
	$general_lat = $json->results[0]->geometry->location->lat;
	$general_lng =  $json->results[0]->geometry->location->lng;

	return $general_lat." ".$general_lng;

}

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

if(strpos($areaString,";") !== false)
{
$areas = explode(";", $areaString);

//RIGHT NOW ONLY USES 1 OF THE LISTED COUNTIES

$county = $areas[0].", ".$state;
}
else
{
	$county = $areaString.", ".$state;
}

return $county;

}

function getCounty($lat,$lng)
{

	$html = curlPage("http://data.fcc.gov/api/block/2010/find?latitude=".$lat."&longitude=".$lng."");
	$xml = new SimpleXMLElement($html);
	$county = $xml->xpath('/*/*[local-name()="County"]/@name');
	$state = $xml->xpath('/*/*[local-name()="State"]/@code');
	return (string)$county[0][0];
	


}

function getIP()
{

	$html = curlPage("http://ip4.me/");
	$dom = new DOMDocument;
	@$dom->loadHTML($html);
	$xpath = new DOMXPath($dom);
	$ip = $xpath->evaluate("//table//font[@face='Arial, Monospace']");
	$ipVal = $ip[0]->textContent;


	return $ipVal;	
}
function locateIP($ip)
{

	$html = curlPage("http://freegeoip.net/xml/".$ip);

	$xml = new SimpleXMLElement($html);
	$lat = $xml->xpath('/*');
	$latVal = (string)$lat[0]->Latitude;
	$lngVal = (string)$lat[0]->Longitude;
	

	return [$latVal, $lngVal];

}









?>