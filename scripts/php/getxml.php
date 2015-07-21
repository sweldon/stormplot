<?php

$url		= "http://alerts.weather.gov/cap/wwacapget.php?x=VT1253B493DC48.SevereThunderstormWarning.1253B493F73CVT.BTVSVSBTV.3ce51d4efac4a8e59e9fde95741277ae";

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