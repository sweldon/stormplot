<?php

$url		= "http://alerts.weather.gov/cap/wwacapget.php?x=KS1253B493082C.FlashFloodWarning.1253B493F160KS.SGFFFWSGF.41fb5af2f9aa236c2ada8d684b37af3c";

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

echo $polygonString;

?>