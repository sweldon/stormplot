 
 function parseXML()
 {

	$.get( "scripts/php/getxml.php", function( data )
	{
		getCoordinates(data);

	});

 }

 function getCoordinates(rawdata)
 {
 	return rawdata;
 }

 