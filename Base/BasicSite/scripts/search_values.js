var livro=["I","II"];
var titulo= new Array();
titulo["I"] = ["I"];
titulo["II"] = ["I", "II", "III"];

function fill_titulo() {
    var selecionado = document.getElementById("dd_livro").value;
    var ele = document.getElementById("dd_titulo");
    while(ele.firstChild) {
    	ele.removeChild(ele.firstChild);
    }
    
    var listFreg = document.getElementById("dd_titulo");
    for(i=0;i<titulo[selecionado].length; i++) {
	var opt = document.createElement("option");
	var texto = document.createTextNode(titulo[selecionado][i]);
	ele.appendChild(opt);
	opt.appendChild(texto);
    }
}