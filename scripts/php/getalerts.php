<?php

function getFeed()
{

/*

Types of alerts:

RSS Library: http://www.nws.noaa.gov/rss/

	Severe Weather:
		-Watch/Warnings/Advisories: http://alerts.weather.gov/cap/us.php?x=1

*/

$url = "http://alerts.weather.gov/cap/us.php?x=1";


$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($ch, CURLOPT_PROXYAUTH, CURLAUTH_NTLM);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
// curl_setopt($ch, CURLOPT_PROXY, "http://rdg-proxy.am.boehringer.com");
// curl_setopt($ch, CURLOPT_PROXYPORT,80);
// curl_setopt($ch, CURLOPT_PROXYUSERPWD,"AM\\sweldon1:Password6");

$rawxml = curl_exec($ch);
curl_close($ch);


$xml = new SimpleXMLElement($rawxml);



$entry = $xml->xpath("/*/*[local-name()='entry']/*[local-name()='id']/text()");

foreach($entry as $id)
{
	echo $id."<br />";
}


}

getFeed();

?>