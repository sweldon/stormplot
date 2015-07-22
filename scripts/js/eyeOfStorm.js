function eyeOfStorm(coords)
{
	var eyeString = coords;
	//var polygonString = rawPolygon;
	var eyeChunked = eyeString.split(" ");



	// Convert coordinates back to integers for plotting
	for(var i = 0;i<eyeChunked.length;i++)
	{
	  tempChunk = eyeChunked[i].split(",")
	  tempChunk[0] = parseFloat(tempChunk[0]);
	  tempChunk[1] = parseFloat(tempChunk[1]);
	  eyeChunked[i] = [tempChunk[0],tempChunk[1]];

	}

	//eyeChunked = is array, each element is an array: [coord1, coord2] (floats)
	xCoords = [];
	yCoords = [];
	for(var i = 0;i<eyeChunked.length;i++)
	{
		item = eyeChunked[i];
		console.log(item);
	
		xCoords.push(item[0]);
		yCoords.push(item[1]);
		
	}
	
	xLow = Math.min.apply(Math,xCoords);
	xHi = Math.max.apply(Math,xCoords);
	yLow = Math.min.apply(Math,yCoords);
	yHi = Math.max.apply(Math,yCoords);

	console.log(xLow,xHi,yLow,yHi);

	centerX = xLow + ((xHi - xLow) / 2);
	centerY = yLow + ((yHi - yLow) / 2);

	eyeOfStorm = Array(centerX, centerY);

	return eyeOfStorm;
	
}

//eyeOfStorm("37.47,-101.52 37.58,-101.52 37.56,-101.24 37.42,-101.22 37.46,-101.4 37.47,-101.52")

// xLow, the lowest x coordinate
// yLow, the lowest y coordinate
// xHi, the highest x coordinate
// yHi, the highest y coordinate

// You now have the bounding rectangle, and can work out the center using:

// center.x = xLow + ((xHi - xLow) / 2);
// center.y = yLow + ((yHi - yLow) / 2);