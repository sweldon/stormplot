// Get polygon coordinates and parse into readable array
var polygonString = "44.71,-72.91 44.32,-72.98 44.09,-73.07 44.07,-73.82 44.32,-73.64 44.66,-73.42 44.71,-72.91";
//var polygonString = rawPolygon;
var stringChunked = polygonString.split(" ");

console.log(stringChunked);

// Convert coordinates back to integers for plotting
for(var i = 0;i<stringChunked.length;i++)
{
  tempChunk = stringChunked[i].split(",")
  tempChunk[0] = parseFloat(tempChunk[0]);
  tempChunk[1] = parseFloat(tempChunk[1]);
  stringChunked[i] = [tempChunk[0],tempChunk[1]];

}
console.log(stringChunked);

// Build Coordinate Array

coordinateArray = []

for(var i = 0;i<stringChunked.length;i++)
{

coordinateArray[i] = new google.maps.LatLng(stringChunked[i][0], stringChunked[i][1]);
}