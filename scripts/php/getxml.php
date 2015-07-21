<?php

// function getCoordinates($url)
// {

$url = "http://alerts.weather.gov/cap/wwacapget.php?x=GA1253B49407A4.SevereThunderstormWarning.1253B4942A04GA.TAESVRTAE.97c3a759aa0cda66e9a6f931ab877c24";

$ch = curl_init($url);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_PROXYAUTH, CURLAUTH_NTLM);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
	curl_setopt($ch, CURLOPT_PROXY, "http://rdg-proxy.am.boehringer.com");
	curl_setopt($ch, CURLOPT_PROXYPORT,80);
	curl_setopt($ch, CURLOPT_PROXYUSERPWD,"AM\\sweldon1:Password6");

$html = curl_exec($ch);
curl_close($ch);



$xml = new SimpleXMLElement($html);
#print_r($xml);

//FIRST 2 DIGITS OF <geocode> GIVE STATE
$polygon = $xml->xpath("/*/*/*/*[local-name()='polygon']/text()");

$polygonString = $polygon[0];

//return $polygonString;
//}

//getCoordinates("http://alerts.weather.gov/cap/wwacapget.php?x=SC1253B493FC50.SevereThunderstormWarning.1253B4941E4CSC.CHSSVRCHS.a755a42775434a6840a37b706e1ce7b6");

?>