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

function pinPoint($ip)
{

	$html = curlPage("http://freegeoip.net/xml/".$ip);

	$xml = new SimpleXMLElement($html);
	$lat = $xml->xpath('/*');
	$latVal = (string)$lat[0]->Latitude;
	$lngVal = (string)$lat[0]->Longitude;
	

		
	print_r([$latVal, $lngVal]);
}

pinPoint("148.188.192.60");

?>

