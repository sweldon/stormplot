<?php
require_once('getxml.php'); 
function getFeed()
{

/*

Types of alerts:

RSS Library: http://www.nws.noaa.gov/rss/

	Severe Weather:
		-Watch/Warnings/Advisories: http://alerts.weather.gov/cap/us.php?x=1

*/

$acceptedTypes = array("FloodWarning","FloodAdvisory","FlashFloodWatch","SpecialWeatherStatement","SevereThunderstormWarning","TornadoWarning");

$url = "http://alerts.weather.gov/cap/us.php?x=1";


$rawxml = curlPage($url);

$xml = new SimpleXMLElement($rawxml);


http://alerts.weather.gov/cap/wwacapget.php?x=AL1253B4A2F0D4.HeatAdvisory.1253B4AFB6C0AL.MOBNPWMOB.37dd2dbeec77dcbd81e72718a99b8b2f
// ALL ENTRIES:
//$entry = $xml->xpath("/*/*[local-name()='entry']/*[local-name()='id']/text()");
// MOST RECENT 10: 
$entry = $xml->xpath("/*/*[local-name()='entry'][position() >= 0 and position() < 12]/*[local-name()='id']/text()");

$newxml = new SimpleXMLElement('<xml/>');

foreach($entry as $id)
{
	$type = substr($id,61,-58);
	$link = $id;
	if(in_array($type, $acceptedTypes))
	{
		$xmlitem = $newxml->addChild('entry');
		$xmlitem->addChild('type',"".$type."");
		$xmlitem->addChild('link',"".$link."");
		//echo $link."<br />";
	}
	
}
Header('Content-type: text/xml');
print($newxml->asXML());

}

getFeed();

?>