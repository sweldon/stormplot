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
function getCounty($lat,$lng)
{

	$html = curlPage("http://data.fcc.gov/api/block/2010/find?latitude=".$lat."&longitude=".$lng."");
	$xml = new SimpleXMLElement($html);
	$county = $xml->xpath('/*/*[local-name()="County"]/@name');
	return (string)$county[0][0];
	
}

print_r(getCounty(41.375209600000005,-73.50734950000003));

?>

