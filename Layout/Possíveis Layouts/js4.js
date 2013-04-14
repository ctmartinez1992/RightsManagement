function doFirst() {
	var tmp = document.getElementById('canvas');
	canvas = tmp.getContext('2d');
	
	var g = canvas.createLinearGradient(0,0,250,100);
	g.addColorStop(.0, "blue");
	g.addColorStop(1, "red");
	canvas.fillStyle=g;
	canvas.fillRect(25,25,300,300);
}

window.addEventListener("load", doFirst, false);