// Get polygon coordinates and parse into readable array
function getPolygon(string)
{
var polygonString = string;
//var polygonString = rawPolygon;
var stringChunked = polygonString.split(" ");



// Convert coordinates back to integers for plotting
for(var i = 0;i<stringChunked.length;i++)
{
  tempChunk = stringChunked[i].split(",")
  tempChunk[0] = parseFloat(tempChunk[0]);
  tempChunk[1] = parseFloat(tempChunk[1]);
  stringChunked[i] = [tempChunk[0],tempChunk[1]];

}


// Build Coordinate Array

coordinateArray = []

for(var i = 0;i<stringChunked.length;i++)
{

coordinateArray[i] = new google.maps.LatLng(stringChunked[i][0], stringChunked[i][1]);
}
}

