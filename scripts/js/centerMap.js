function centerMap(json)
{
	latitude = json.results[0].geometry.location.lat;
	longitude = json.results[0].geometry.location.lng;

	center = new google.maps.LatLng(latitude, longitude);

	return center;
	
}

