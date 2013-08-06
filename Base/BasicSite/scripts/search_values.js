var xmlHttp = null;

function CreateXmlHttpRequestObject() {   
    if (window.XMLHttpRequest) {
        xmlHttp = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    } else {
        xmlHttp = false;
    }
    return xmlHttp;
}

function fill_titulo() {
    var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
    var xmlHttp = CreateXmlHttpRequestObject();
    if (xmlHttp.readyState == 0 || xmlHttp.readystate == 4) {
        livro = encodeURIComponent(document.getElementById("dd_livro").value);
        var array_values = {0:'I', 1:'II', 2:'III', 3:'IV', 4:'V', 5:'VI', 6:'VII', 7:'VIII', 8:'IX', 9:'X', 10:'XI', 11:'XII', 12:'XIII', 13:'XIV', 14:'XV', 15:'XVI', 16:'XVII', 17:'XVIII', 18:'XIX', 19:'XX'};
        xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_titulo?doc=" + doc + "&livro=" + array_values[livro], true);
        xmlHttp.onreadystatechange = handleServerResponseTitulo;
        xmlHttp.send(null);
    } else {
        setTimeout("fill_titulo()", 10000);
    }
}
function handleServerResponseTitulo() {
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200) {
            clearTitulo();
            clearSubtitulo();
            clearCapitulo();
            clearSeccao();
            clearSubseccao();
            clearDivisao();
            clearSubdivisao();
            clearArtigo();
            
            xmlResponse = xmlHttp.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            var element = document.getElementById("dd_titulo");
            
            if (message !== "0") {
                var splited_message = message.split(",");
                while(element.firstChild){
                        element.removeChild(element.firstChild);
                }

                for (i=0; i<splited_message.length; i++) {
                    var opt = document.createElement("option");
                    var text = document.createTextNode(splited_message[i]);
                    element.appendChild(opt);
                    opt.appendChild(text);
                }
            } else {                
                var opt = document.createElement("option");
                var text = document.createTextNode("0");
                element.appendChild(opt);
                opt.appendChild(text);
            }
        }
    }
}

function fill_subtitulo() {
        var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
    var xmlHttp = CreateXmlHttpRequestObject();
    if (xmlHttp.readyState == 0 || xmlHttp.readystate == 4) {
        livro = encodeURIComponent(document.getElementById("dd_livro").value);
        titulo = encodeURIComponent(document.getElementById("dd_titulo").value);
        var array_values = {0:'I', 1:'II', 2:'III', 3:'IV', 4:'V', 5:'VI', 6:'VII', 7:'VIII', 8:'IX', 9:'X', 10:'XI', 11:'XII', 12:'XIII', 13:'XIV', 14:'XV', 15:'XVI', 16:'XVII', 17:'XVIII', 18:'XIX', 19:'XX'};
        xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_subtitulo?doc=" + doc + "&livro=" + array_values[livro] + "&titulo=" + titulo, true);
        xmlHttp.onreadystatechange = handleServerResponseSubtitulo;
        xmlHttp.send(null);
    } else {
        setTimeout("fill_subtitulo()", 10000);
    }
}
function handleServerResponseSubtitulo() {
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200) {
            clearSubtitulo();
            clearCapitulo();
            clearSeccao();
            clearSubseccao();
            clearDivisao();
            clearSubdivisao();
            clearArtigo();
            
            xmlResponse = xmlHttp.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            var element = document.getElementById("dd_subtitulo");
            
            if (message !== "0") {
                var splited_message = message.split(",");
                while(element.firstChild){
                        element.removeChild(element.firstChild);
                }

                for (i=0; i<splited_message.length; i++) {
                    var opt = document.createElement("option");
                    var text = document.createTextNode(splited_message[i]);
                    element.appendChild(opt);
                    opt.appendChild(text);
                }
            } else {
                var opt = document.createElement("option");
                var text = document.createTextNode("0");
                element.appendChild(opt);
                opt.appendChild(text);
                fill_capitulo_no_subtitulo();
            }
        }
    }
}

function fill_capitulo() {
        var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
    var xmlHttp = CreateXmlHttpRequestObject();
    if (xmlHttp.readyState == 0 || xmlHttp.readystate == 4) {
        livro = encodeURIComponent(document.getElementById("dd_livro").value);
        titulo = encodeURIComponent(document.getElementById("dd_titulo").value);
        subtitulo = encodeURIComponent(document.getElementById("dd_subtitulo").value);
        var array_values = {0:'I', 1:'II', 2:'III', 3:'IV', 4:'V', 5:'VI', 6:'VII', 7:'VIII', 8:'IX', 9:'X', 10:'XI', 11:'XII', 12:'XIII', 13:'XIV', 14:'XV', 15:'XVI', 16:'XVII', 17:'XVIII', 18:'XIX', 19:'XX'};
        xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_capitulo?doc=" + doc + "&livro=" + array_values[livro] + "&titulo=" + titulo + "&subtitulo=" + subtitulo, true);
        xmlHttp.onreadystatechange = handleServerResponseCapitulo;
        xmlHttp.send(null);
    } else {
        setTimeout("fill_capitulo()", 10000);
    }
}
function handleServerResponseCapitulo() {
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200) {
            clearCapitulo();
            clearSeccao();
            clearSubseccao();
            clearDivisao();
            clearSubdivisao();
            clearArtigo();
            
            xmlResponse = xmlHttp.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            var element = document.getElementById("dd_capitulo");
            
            if (message !== "0") {
                var splited_message = message.split(",");
                while(element.firstChild){
                        element.removeChild(element.firstChild);
                }

                for (i=0; i<splited_message.length; i++) {
                    var opt = document.createElement("option");
                    var text = document.createTextNode(splited_message[i]);
                    element.appendChild(opt);
                    opt.appendChild(text);
                }
            } else {                
                var opt = document.createElement("option");
                var text = document.createTextNode("0");
                element.appendChild(opt);
                opt.appendChild(text);
                fill_artigo_with_subtitulo();
            }
        }
    }
}
function fill_capitulo_no_subtitulo() {
        var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
    var xmlHttp = CreateXmlHttpRequestObject();
    if (xmlHttp.readyState == 0 || xmlHttp.readystate == 4) {
        livro = encodeURIComponent(document.getElementById("dd_livro").value);
        titulo = encodeURIComponent(document.getElementById("dd_titulo").value);
        var array_values = {0:'I', 1:'II', 2:'III', 3:'IV', 4:'V', 5:'VI', 6:'VII', 7:'VIII', 8:'IX', 9:'X', 10:'XI', 11:'XII', 12:'XIII', 13:'XIV', 14:'XV', 15:'XVI', 16:'XVII', 17:'XVIII', 18:'XIX', 19:'XX'};
        xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_capitulo_no_subtitulo?doc=" + doc + "&livro=" + array_values[livro] + "&titulo=" + titulo, true);
        xmlHttp.onreadystatechange = handleServerResponseCapituloNoSubtitulo;
        xmlHttp.send(null);
    } else {
        setTimeout("fill_capitulo_no_subtitulo()", 10000);
    }
}
function handleServerResponseCapituloNoSubtitulo() {
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200) {
            clearCapitulo();
            clearSeccao();
            clearSubseccao();
            clearDivisao();
            clearSubdivisao();
            clearArtigo();
            
            xmlResponse = xmlHttp.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            var element = document.getElementById("dd_capitulo");
            
            if (message !== "0") {
                var splited_message = message.split(",");
                while(element.firstChild){
                        element.removeChild(element.firstChild);
                }

                for (i=0; i<splited_message.length; i++) {
                    var opt = document.createElement("option");
                    var text = document.createTextNode(splited_message[i]);
                    element.appendChild(opt);
                    opt.appendChild(text);
                }
            } else {                
                fill_artigo_with_titulo();
            }
        }
    }
}

function fill_seccao() {
        var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
    var xmlHttp = CreateXmlHttpRequestObject();
    if (xmlHttp.readyState == 0 || xmlHttp.readystate == 4) {
        livro = encodeURIComponent(document.getElementById("dd_livro").value);
        titulo = encodeURIComponent(document.getElementById("dd_titulo").value);
        subtitulo = encodeURIComponent(document.getElementById("dd_subtitulo").value);
        capitulo = encodeURIComponent(document.getElementById("dd_capitulo").value);
        var array_values = {0:'I', 1:'II', 2:'III', 3:'IV', 4:'V', 5:'VI', 6:'VII', 7:'VIII', 8:'IX', 9:'X', 10:'XI', 11:'XII', 12:'XIII', 13:'XIV', 14:'XV', 15:'XVI', 16:'XVII', 17:'XVIII', 18:'XIX', 19:'XX'};
        if (subtitulo === "0") {
            xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_seccao_no_subtitulo?doc=" + doc + "&livro=" + array_values[livro] + "&titulo=" + titulo + "&capitulo=" + capitulo, true); 
        } else {
            xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_seccao?doc=" + doc + "&livro=" + array_values[livro] + "&titulo=" + titulo + "&subtitulo=" + subtitulo + "&capitulo=" + capitulo, true);
        }
        xmlHttp.onreadystatechange = handleServerResponseSeccao;
        xmlHttp.send(null);
    } else {
        setTimeout("fill_seccao()", 10000);
    }
}
function handleServerResponseSeccao() {
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200) {
            clearSeccao();
            clearSubseccao();
            clearDivisao();
            clearSubdivisao();
            clearArtigo();
            
            xmlResponse = xmlHttp.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            var element = document.getElementById("dd_seccao");
            
            if (message !== "0") {
                var splited_message = message.split(",");
                while(element.firstChild){
                        element.removeChild(element.firstChild);
                }

                for (i=0; i<splited_message.length; i++) {
                    var opt = document.createElement("option");
                    var text = document.createTextNode(splited_message[i]);
                    element.appendChild(opt);
                    opt.appendChild(text);
                }
            } else {                
                var opt = document.createElement("option");
                var text = document.createTextNode("0");
                element.appendChild(opt);
                opt.appendChild(text);
                
                if (document.getElementById("dd_subtitulo").value === "0") {
                    fill_artigo_with_capitulo_no_subtitulo()
                } else {
                    fill_artigo_with_capitulo();
                }
            }
        }
    }
}

function fill_subseccao() {
        var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
    var xmlHttp = CreateXmlHttpRequestObject();
    if (xmlHttp.readyState == 0 || xmlHttp.readystate == 4) {
        livro = encodeURIComponent(document.getElementById("dd_livro").value);
        titulo = encodeURIComponent(document.getElementById("dd_titulo").value);
        subtitulo = encodeURIComponent(document.getElementById("dd_subtitulo").value);
        capitulo = encodeURIComponent(document.getElementById("dd_capitulo").value);
        seccao = encodeURIComponent(document.getElementById("dd_seccao").value);
        var array_values = {0:'I', 1:'II', 2:'III', 3:'IV', 4:'V', 5:'VI', 6:'VII', 7:'VIII', 8:'IX', 9:'X', 10:'XI', 11:'XII', 12:'XIII', 13:'XIV', 14:'XV', 15:'XVI', 16:'XVII', 17:'XVIII', 18:'XIX', 19:'XX'};
        if (subtitulo === "0") {
            xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_subseccao_no_subtitulo?doc=" + doc + "&livro=" + array_values[livro] + "&titulo=" + titulo + "&capitulo=" + capitulo + "&seccao=" + seccao, true); 
        } else {
            xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_subseccao?doc=" + doc + "&livro=" + array_values[livro] + "&titulo=" + titulo + "&subtitulo=" + subtitulo + "&capitulo=" + capitulo + "&seccao=" + seccao, true);
        }
        xmlHttp.onreadystatechange = handleServerResponseSubseccao;
        xmlHttp.send(null);
    } else {
        setTimeout("fill_subseccao()", 10000);
    }
}
function handleServerResponseSubseccao() {
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200) {
            clearSubseccao();
            clearDivisao();
            clearSubdivisao();
            clearArtigo();
            
            xmlResponse = xmlHttp.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            var element = document.getElementById("dd_subseccao");
            
            if (message !== "0") {
                var splited_message = message.split(",");
                while(element.firstChild){
                        element.removeChild(element.firstChild);
                }

                for (i=0; i<splited_message.length; i++) {
                    var opt = document.createElement("option");
                    var text = document.createTextNode(splited_message[i]);
                    element.appendChild(opt);
                    opt.appendChild(text);
                }
            } else {                
                var opt = document.createElement("option");
                var text = document.createTextNode("0");
                element.appendChild(opt);
                opt.appendChild(text);
                
                if (document.getElementById("dd_subtitulo").value === "0") {
                    fill_artigo_with_seccao_no_subtitulo()
                } else {
                    fill_artigo_with_seccao();
                }
            }
        }
    }
}

function fill_divisao() {
        var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
    var xmlHttp = CreateXmlHttpRequestObject();
    if (xmlHttp.readyState == 0 || xmlHttp.readystate == 4) {
        livro = encodeURIComponent(document.getElementById("dd_livro").value);
        titulo = encodeURIComponent(document.getElementById("dd_titulo").value);
        subtitulo = encodeURIComponent(document.getElementById("dd_subtitulo").value);
        capitulo = encodeURIComponent(document.getElementById("dd_capitulo").value);
        seccao = encodeURIComponent(document.getElementById("dd_seccao").value);
        subseccao = encodeURIComponent(document.getElementById("dd_subseccao").value);
        var array_values = {0:'I', 1:'II', 2:'III', 3:'IV', 4:'V', 5:'VI', 6:'VII', 7:'VIII', 8:'IX', 9:'X', 10:'XI', 11:'XII', 12:'XIII', 13:'XIV', 14:'XV', 15:'XVI', 16:'XVII', 17:'XVIII', 18:'XIX', 19:'XX'};
        if (subtitulo === "0") {
            xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_divisao_no_subtitulo?doc=" + doc + "&livro=" + array_values[livro] + "&titulo=" + titulo + "&capitulo=" + capitulo + "&seccao=" + seccao + "&subseccao=" + subseccao, true); 
        } else {
            xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_divisao?doc=" + doc + "&livro=" + array_values[livro] + "&titulo=" + titulo + "&subtitulo=" + subtitulo + "&capitulo=" + capitulo + "&seccao=" + seccao + "&subseccao=" + subseccao, true);
        }
        xmlHttp.onreadystatechange = handleServerResponseDivisao;
        xmlHttp.send(null);
    } else {
        setTimeout("fill_divisao()", 10000);
    }
}
function handleServerResponseDivisao() {
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200) {
            clearDivisao();
            clearSubdivisao();
            clearArtigo();
            
            xmlResponse = xmlHttp.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            var element = document.getElementById("dd_divisao");
            
            if (message !== "0") {
                var splited_message = message.split(",");
                while(element.firstChild){
                        element.removeChild(element.firstChild);
                }

                for (i=0; i<splited_message.length; i++) {
                    var opt = document.createElement("option");
                    var text = document.createTextNode(splited_message[i]);
                    element.appendChild(opt);
                    opt.appendChild(text);
                }
            } else {                
                var opt = document.createElement("option");
                var text = document.createTextNode("0");
                element.appendChild(opt);
                opt.appendChild(text);
                
                if (document.getElementById("dd_subtitulo").value === "0") {
                    fill_artigo_with_subseccao_no_subtitulo()
                } else {
                    fill_artigo_with_subseccao();
                }
            }
        }
    }
}

function fill_subdivisao() {
        var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
    var xmlHttp = CreateXmlHttpRequestObject();
    if (xmlHttp.readyState == 0 || xmlHttp.readystate == 4) {
        livro = encodeURIComponent(document.getElementById("dd_livro").value);
        titulo = encodeURIComponent(document.getElementById("dd_titulo").value);
        subtitulo = encodeURIComponent(document.getElementById("dd_subtitulo").value);
        capitulo = encodeURIComponent(document.getElementById("dd_capitulo").value);
        seccao = encodeURIComponent(document.getElementById("dd_seccao").value);
        subseccao = encodeURIComponent(document.getElementById("dd_subseccao").value);
        divisao = encodeURIComponent(document.getElementById("dd_divisao").value);
        var array_values = {0:'I', 1:'II', 2:'III', 3:'IV', 4:'V', 5:'VI', 6:'VII', 7:'VIII', 8:'IX', 9:'X', 10:'XI', 11:'XII', 12:'XIII', 13:'XIV', 14:'XV', 15:'XVI', 16:'XVII', 17:'XVIII', 18:'XIX', 19:'XX'};
        if (subtitulo === "0") {
            xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_subdivisao_no_subtitulo?doc=" + doc + "&livro=" + array_values[livro] + "&titulo=" + titulo + "&capitulo=" + capitulo + "&seccao=" + seccao + "&subseccao=" + subseccao + "&divisao=" + divisao, true); 
        } else {
            xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_subdivisao?doc=" + doc + "&livro=" + array_values[livro] + "&titulo=" + titulo + "&subtitulo=" + subtitulo + "&capitulo=" + capitulo + "&seccao=" + seccao + "&subseccao=" + subseccao + "&divisao=" + divisao, true);
        }
        xmlHttp.onreadystatechange = handleServerResponseSubdivisao;
        xmlHttp.send(null);
    } else {
        setTimeout("fill_subdivisao()", 10000);
    }
}
function handleServerResponseSubdivisao() {
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200) {
            clearSubdivisao();
            clearArtigo();
            
            xmlResponse = xmlHttp.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            var element = document.getElementById("dd_subdivisao");
            
            if (message !== "0") {
                var splited_message = message.split(",");
                while(element.firstChild){
                        element.removeChild(element.firstChild);
                }

                for (i=0; i<splited_message.length; i++) {
                    var opt = document.createElement("option");
                    var text = document.createTextNode(splited_message[i]);
                    element.appendChild(opt);
                    opt.appendChild(text);
                }
            } else {                
                var opt = document.createElement("option");
                var text = document.createTextNode("0");
                element.appendChild(opt);
                opt.appendChild(text);
                
                if (document.getElementById("dd_subtitulo").value === "0") {
                    fill_artigo_with_divisao_no_subtitulo()
                } else {
                    fill_artigo_with_divisao();
                }
            }
        }
    }
}

function fill_artigo() {
    var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
    var xmlHttp = CreateXmlHttpRequestObject();
    if (xmlHttp.readyState == 0 || xmlHttp.readystate == 4) {
        livro = encodeURIComponent(document.getElementById("dd_livro").value);
        titulo = encodeURIComponent(document.getElementById("dd_titulo").value);
        subtitulo = encodeURIComponent(document.getElementById("dd_subtitulo").value);
        capitulo = encodeURIComponent(document.getElementById("dd_capitulo").value);
        seccao = encodeURIComponent(document.getElementById("dd_seccao").value);
        subseccao = encodeURIComponent(document.getElementById("dd_subseccao").value);
        divisao = encodeURIComponent(document.getElementById("dd_divisao").value);
        subdivisao = encodeURIComponent(document.getElementById("dd_subdivisao").value);
        var array_values = {0:'I', 1:'II', 2:'III', 3:'IV', 4:'V', 5:'VI', 6:'VII', 7:'VIII', 8:'IX', 9:'X', 10:'XI', 11:'XII', 12:'XIII', 13:'XIV', 14:'XV', 15:'XVI', 16:'XVII', 17:'XVIII', 18:'XIX', 19:'XX'};
        if (subtitulo === "0") {
            xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_subdivisao_no_subtitulo?doc=" + doc + "&livro=" + array_values[livro] + "&titulo=" + titulo + "&capitulo=" + capitulo + "&seccao=" + seccao + "&subseccao=" + subseccao + "&divisao=" + divisao + "&subdivisao=" + subdivisao, true); 
        } else {
            xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_subdivisao?doc=" + doc + "&livro=" + array_values[livro] + "&titulo=" + titulo + "&subtitulo=" + subtitulo + "&capitulo=" + capitulo + "&seccao=" + seccao + "&subseccao=" + subseccao + "&divisao=" + divisao + "&subdivisao=" + subdivisao, true);
        }
        xmlHttp.onreadystatechange = handleServerResponseArtigo;
        xmlHttp.send(null);
    } else {
        setTimeout("fill_artigo()", 10000);
    }
}
function handleServerResponseArtigo() {
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200) {
            clearArtigo();
            
            xmlResponse = xmlHttp.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            var element = document.getElementById("dd_artigo");
            
            if (message !== "0") {
                var splited_message = message.split(",");
                while(element.firstChild) {
                    element.removeChild(element.firstChild);
                }

                for (i=0; i<splited_message.length; i++) {
                    var opt = document.createElement("option");
                    var text = document.createTextNode(splited_message[i]);
                    element.appendChild(opt);
                    opt.appendChild(text);
                }
            } else {                
                var opt = document.createElement("option");
                var text = document.createTextNode("0");
                element.appendChild(opt);
                opt.appendChild(text);
            }
        }
    }
}

function fill_artigo_with_titulo() {
    var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
    var xmlHttp = CreateXmlHttpRequestObject();
    if (xmlHttp.readyState == 0 || xmlHttp.readystate == 4) {
        livro = encodeURIComponent(document.getElementById("dd_livro").value);
        titulo = encodeURIComponent(document.getElementById("dd_titulo").value);
        var array_values = {0:'I', 1:'II', 2:'III', 3:'IV', 4:'V', 5:'VI', 6:'VII', 7:'VIII', 8:'IX', 9:'X', 10:'XI', 11:'XII', 12:'XIII', 13:'XIV', 14:'XV', 15:'XVI', 16:'XVII', 17:'XVIII', 18:'XIX', 19:'XX'};
        xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_artigo_with_titulo?doc=" + doc + "&livro=" + array_values[livro] + "&titulo=" + titulo, true);
        xmlHttp.onreadystatechange = handleServerResponseArtigoWithTitulo;
        xmlHttp.send(null);
    } else {
        setTimeout("fill_artigo_with_titulo()", 10000);
    }
}
function handleServerResponseArtigoWithTitulo() {
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200) {
            zeroSubtitulo();
            zeroCapitulo();
            zeroSeccao();
            zeroSubseccao();
            zeroDivisao();
            zeroSubdivisao();
            zeroArtigo();
            
            xmlResponse = xmlHttp.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            var element = document.getElementById("dd_artigo");
            
            if (message !== "0") {
                var splited_message = message.split(",");
                while(element.firstChild){
                    element.removeChild(element.firstChild);
                }

                for (i=0; i<splited_message.length; i++) {
                    var opt = document.createElement("option");
                    var text = document.createTextNode(splited_message[i]);
                    element.appendChild(opt);
                    opt.appendChild(text);
                }
            } else {                
                var opt = document.createElement("option");
                var text = document.createTextNode("0");
                element.appendChild(opt);
                opt.appendChild(text);
            }
        }
    }
}
function fill_artigo_with_subtitulo() {
        var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
    var xmlHttp = CreateXmlHttpRequestObject();
    if (xmlHttp.readyState == 0 || xmlHttp.readystate == 4) {
        livro = encodeURIComponent(document.getElementById("dd_livro").value);
        titulo = encodeURIComponent(document.getElementById("dd_titulo").value);
        subtitulo = encodeURIComponent(document.getElementById("dd_subtitulo").value);
        var array_values = {0:'I', 1:'II', 2:'III', 3:'IV', 4:'V', 5:'VI', 6:'VII', 7:'VIII', 8:'IX', 9:'X', 10:'XI', 11:'XII', 12:'XIII', 13:'XIV', 14:'XV', 15:'XVI', 16:'XVII', 17:'XVIII', 18:'XIX', 19:'XX'};
        xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_artigo_with_subtitulo?doc=" + doc + "&livro=" + array_values[livro] + "&titulo=" + titulo + "&subtitulo=" + subtitulo, true);
        xmlHttp.onreadystatechange = handleServerResponseArtigoWithSubtitulo;
        xmlHttp.send(null);
    } else {
        setTimeout("fill_artigo_with_subtitulo()", 10000);
    }
}
function handleServerResponseArtigoWithSubtitulo() {
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200) {
            zeroCapitulo();
            zeroSeccao();
            zeroSubseccao();
            zeroDivisao();
            zeroSubdivisao();
            zeroArtigo();
            
            xmlResponse = xmlHttp.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            var element = document.getElementById("dd_artigo");
            
            if (message !== "0") {
                var splited_message = message.split(",");
                while(element.firstChild){
                    element.removeChild(element.firstChild);
                }

                for (i=0; i<splited_message.length; i++) {
                    var opt = document.createElement("option");
                    var text = document.createTextNode(splited_message[i]);
                    element.appendChild(opt);
                    opt.appendChild(text);
                }
            } else {                
                var opt = document.createElement("option");
                var text = document.createTextNode("0");
                element.appendChild(opt);
                opt.appendChild(text);
            }
        }
    }
}
function fill_artigo_with_capitulo() {
        var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
    var xmlHttp = CreateXmlHttpRequestObject();
    if (xmlHttp.readyState == 0 || xmlHttp.readystate == 4) {
        livro = encodeURIComponent(document.getElementById("dd_livro").value);
        titulo = encodeURIComponent(document.getElementById("dd_titulo").value);
        subtitulo = encodeURIComponent(document.getElementById("dd_subtitulo").value);
        capitulo = encodeURIComponent(document.getElementById("dd_capitulo").value);
        var array_values = {0:'I', 1:'II', 2:'III', 3:'IV', 4:'V', 5:'VI', 6:'VII', 7:'VIII', 8:'IX', 9:'X', 10:'XI', 11:'XII', 12:'XIII', 13:'XIV', 14:'XV', 15:'XVI', 16:'XVII', 17:'XVIII', 18:'XIX', 19:'XX'};
        xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_artigo_with_capitulo?doc=" + doc + "&livro=" + array_values[livro] + "&titulo=" + titulo + "&subtitulo=" + subtitulo + "&capitulo=" + capitulo, true);
        xmlHttp.onreadystatechange = handleServerResponseArtigoWithCapitulo;
        xmlHttp.send(null);
    } else {
        setTimeout("fill_artigo_with_capitulo()", 10000);
    }
}
function handleServerResponseArtigoWithCapitulo() {
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200) {
            zeroSeccao();
            zeroSubseccao();
            zeroDivisao();
            zeroSubdivisao();
            zeroArtigo();
            
            xmlResponse = xmlHttp.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            var element = document.getElementById("dd_artigo");
            
            if (message !== "0") {
                var splited_message = message.split(",");
                while(element.firstChild){
                    element.removeChild(element.firstChild);
                }

                for (i=0; i<splited_message.length; i++) {
                    var opt = document.createElement("option");
                    var text = document.createTextNode(splited_message[i]);
                    element.appendChild(opt);
                    opt.appendChild(text);
                }
            } else {                
                var opt = document.createElement("option");
                var text = document.createTextNode("0");
                element.appendChild(opt);
                opt.appendChild(text);
            }
        }
    }
}
function fill_artigo_with_capitulo_no_subtitulo() {
        var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
    var xmlHttp = CreateXmlHttpRequestObject();
    if (xmlHttp.readyState == 0 || xmlHttp.readystate == 4) {
        livro = encodeURIComponent(document.getElementById("dd_livro").value);
        titulo = encodeURIComponent(document.getElementById("dd_titulo").value);
        capitulo = encodeURIComponent(document.getElementById("dd_capitulo").value);
        var array_values = {0:'I', 1:'II', 2:'III', 3:'IV', 4:'V', 5:'VI', 6:'VII', 7:'VIII', 8:'IX', 9:'X', 10:'XI', 11:'XII', 12:'XIII', 13:'XIV', 14:'XV', 15:'XVI', 16:'XVII', 17:'XVIII', 18:'XIX', 19:'XX'};
        xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_artigo_with_capitulo_no_subtitulo?doc=" + doc + "&livro=" + array_values[livro] + "&titulo=" + titulo + "&capitulo=" + capitulo, true);
        xmlHttp.onreadystatechange = handleServerResponseArtigoWithCapituloNoSubtitulo;
        xmlHttp.send(null);
    } else {
        setTimeout("fill_artigo_with_capitulo_no_subtitulo()", 10000);
    }
}
function handleServerResponseArtigoWithCapituloNoSubtitulo() {
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200) {
            zeroSeccao();
            zeroSubseccao();
            zeroDivisao();
            zeroSubdivisao();
            zeroArtigo();
            
            xmlResponse = xmlHttp.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            var element = document.getElementById("dd_artigo");
            
            if (message !== "0") {
                var splited_message = message.split(",");
                while(element.firstChild){
                    element.removeChild(element.firstChild);
                }

                for (i=0; i<splited_message.length; i++) {
                    var opt = document.createElement("option");
                    var text = document.createTextNode(splited_message[i]);
                    element.appendChild(opt);
                    opt.appendChild(text);
                }
            } else {                
                var opt = document.createElement("option");
                var text = document.createTextNode("0");
                element.appendChild(opt);
                opt.appendChild(text);
            }
        }
    }
}
function fill_artigo_with_seccao() {
        var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
    var xmlHttp = CreateXmlHttpRequestObject();
    if (xmlHttp.readyState == 0 || xmlHttp.readystate == 4) {
        livro = encodeURIComponent(document.getElementById("dd_livro").value);
        titulo = encodeURIComponent(document.getElementById("dd_titulo").value);
        subtitulo = encodeURIComponent(document.getElementById("dd_subtitulo").value);
        capitulo = encodeURIComponent(document.getElementById("dd_capitulo").value);
        seccao = encodeURIComponent(document.getElementById("dd_seccao").value);
        var array_values = {0:'I', 1:'II', 2:'III', 3:'IV', 4:'V', 5:'VI', 6:'VII', 7:'VIII', 8:'IX', 9:'X', 10:'XI', 11:'XII', 12:'XIII', 13:'XIV', 14:'XV', 15:'XVI', 16:'XVII', 17:'XVIII', 18:'XIX', 19:'XX'};
        xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_artigo_with_seccao?doc=" + doc + "&livro=" + array_values[livro] + "&titulo=" + titulo + "&subtitulo=" + subtitulo + "&capitulo=" + capitulo + "&seccao=" + seccao, true);
        xmlHttp.onreadystatechange = handleServerResponseArtigoWithSeccao;
        xmlHttp.send(null);
    } else {
        setTimeout("fill_artigo_with_seccao()", 10000);
    }
}
function handleServerResponseArtigoWithSeccao() {
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200) {
            zeroSubseccao();
            zeroDivisao();
            zeroSubdivisao();
            zeroArtigo();
            
            xmlResponse = xmlHttp.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            var element = document.getElementById("dd_artigo");
            
            if (message !== "0") {
                var splited_message = message.split(",");
                while(element.firstChild){
                    element.removeChild(element.firstChild);
                }

                for (i=0; i<splited_message.length; i++) {
                    var opt = document.createElement("option");
                    var text = document.createTextNode(splited_message[i]);
                    element.appendChild(opt);
                    opt.appendChild(text);
                }
            } else {                
                var opt = document.createElement("option");
                var text = document.createTextNode("0");
                element.appendChild(opt);
                opt.appendChild(text);
            }
        }
    }
}
function fill_artigo_with_seccao_no_subtitulo() {
        var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
    var xmlHttp = CreateXmlHttpRequestObject();
    if (xmlHttp.readyState == 0 || xmlHttp.readystate == 4) {
        livro = encodeURIComponent(document.getElementById("dd_livro").value);
        titulo = encodeURIComponent(document.getElementById("dd_titulo").value);
        capitulo = encodeURIComponent(document.getElementById("dd_capitulo").value);
        seccao = encodeURIComponent(document.getElementById("dd_seccao").value);
        var array_values = {0:'I', 1:'II', 2:'III', 3:'IV', 4:'V', 5:'VI', 6:'VII', 7:'VIII', 8:'IX', 9:'X', 10:'XI', 11:'XII', 12:'XIII', 13:'XIV', 14:'XV', 15:'XVI', 16:'XVII', 17:'XVIII', 18:'XIX', 19:'XX'};
        xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_artigo_with_seccao_no_subtitulo?doc=" + doc + "&livro=" + array_values[livro] + "&titulo=" + titulo + "&capitulo=" + capitulo + "&seccao=" + seccao, true);
        xmlHttp.onreadystatechange = handleServerResponseArtigoWithSeccaoNoSubtitulo;
        xmlHttp.send(null);
    } else {
        setTimeout("fill_artigo_with_seccao_no_subtitulo()", 10000);
    }
}
function handleServerResponseArtigoWithSeccaoNoSubtitulo() {
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200) {
            zeroSubseccao();
            zeroDivisao();
            zeroSubdivisao();
            zeroArtigo();
            
            xmlResponse = xmlHttp.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            var element = document.getElementById("dd_artigo");
            
            if (message !== "0") {
                var splited_message = message.split(",");
                while(element.firstChild){
                    element.removeChild(element.firstChild);
                }

                for (i=0; i<splited_message.length; i++) {
                    var opt = document.createElement("option");
                    var text = document.createTextNode(splited_message[i]);
                    element.appendChild(opt);
                    opt.appendChild(text);
                }
            } else {                
                var opt = document.createElement("option");
                var text = document.createTextNode("0");
                element.appendChild(opt);
                opt.appendChild(text);
            }
        }
    }
}
function fill_artigo_with_subseccao() {
        var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
    var xmlHttp = CreateXmlHttpRequestObject();
    if (xmlHttp.readyState == 0 || xmlHttp.readystate == 4) {
        livro = encodeURIComponent(document.getElementById("dd_livro").value);
        titulo = encodeURIComponent(document.getElementById("dd_titulo").value);
        subtitulo = encodeURIComponent(document.getElementById("dd_subtitulo").value);
        capitulo = encodeURIComponent(document.getElementById("dd_capitulo").value);
        seccao = encodeURIComponent(document.getElementById("dd_seccao").value);
        subseccao = encodeURIComponent(document.getElementById("dd_subseccao").value);
        var array_values = {0:'I', 1:'II', 2:'III', 3:'IV', 4:'V', 5:'VI', 6:'VII', 7:'VIII', 8:'IX', 9:'X', 10:'XI', 11:'XII', 12:'XIII', 13:'XIV', 14:'XV', 15:'XVI', 16:'XVII', 17:'XVIII', 18:'XIX', 19:'XX'};
        xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_artigo_with_subseccao?doc=" + doc + "&livro=" + array_values[livro] + "&titulo=" + titulo + "&subtitulo=" + subtitulo + "&capitulo=" + capitulo + "&seccao=" + seccao + "&subseccao=" + subseccao, true);
        xmlHttp.onreadystatechange = handleServerResponseArtigoWithSubseccao;
        xmlHttp.send(null);
    } else {
        setTimeout("fill_artigo_with_subseccao()", 10000);
    }
}
function handleServerResponseArtigoWithSubseccao() {
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200) {
            zeroDivisao();
            zeroSubdivisao();
            zeroArtigo();
            
            xmlResponse = xmlHttp.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            var element = document.getElementById("dd_artigo");
            
            if (message !== "0") {
                var splited_message = message.split(",");
                while(element.firstChild){
                    element.removeChild(element.firstChild);
                }

                for (i=0; i<splited_message.length; i++) {
                    var opt = document.createElement("option");
                    var text = document.createTextNode(splited_message[i]);
                    element.appendChild(opt);
                    opt.appendChild(text);
                }
            } else {                
                var opt = document.createElement("option");
                var text = document.createTextNode("0");
                element.appendChild(opt);
                opt.appendChild(text);
            }
        }
    }
}
function fill_artigo_with_subseccao_no_subtitulo() {
        var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
    var xmlHttp = CreateXmlHttpRequestObject();
    if (xmlHttp.readyState == 0 || xmlHttp.readystate == 4) {
        livro = encodeURIComponent(document.getElementById("dd_livro").value);
        titulo = encodeURIComponent(document.getElementById("dd_titulo").value);
        capitulo = encodeURIComponent(document.getElementById("dd_capitulo").value);
        seccao = encodeURIComponent(document.getElementById("dd_seccao").value);
        subseccao = encodeURIComponent(document.getElementById("dd_subseccao").value);
        var array_values = {0:'I', 1:'II', 2:'III', 3:'IV', 4:'V', 5:'VI', 6:'VII', 7:'VIII', 8:'IX', 9:'X', 10:'XI', 11:'XII', 12:'XIII', 13:'XIV', 14:'XV', 15:'XVI', 16:'XVII', 17:'XVIII', 18:'XIX', 19:'XX'};
        xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_artigo_with_subseccao_no_subtitulo?doc=" + doc + "&livro=" + array_values[livro] + "&titulo=" + titulo + "&capitulo=" + capitulo + "&seccao=" + seccao + "&subseccao=" + subseccao, true);
        xmlHttp.onreadystatechange = handleServerResponseArtigoWithSubseccaoNoSubtitulo;
        xmlHttp.send(null);
    } else {
        setTimeout("fill_artigo_with_subseccao_no_subtitulo()", 10000);
    }
}
function handleServerResponseArtigoWithSubseccaoNoSubtitulo() {
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200) {
            zeroDivisao();
            zeroSubdivisao();
            zeroArtigo();
            
            xmlResponse = xmlHttp.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            var element = document.getElementById("dd_artigo");
            
            if (message !== "0") {
                var splited_message = message.split(",");
                while(element.firstChild){
                    element.removeChild(element.firstChild);
                }

                for (i=0; i<splited_message.length; i++) {
                    var opt = document.createElement("option");
                    var text = document.createTextNode(splited_message[i]);
                    element.appendChild(opt);
                    opt.appendChild(text);
                }
            } else {                
                var opt = document.createElement("option");
                var text = document.createTextNode("0");
                element.appendChild(opt);
                opt.appendChild(text);
            }
        }
    }
}
function fill_artigo_with_divisao() {
        var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
    var xmlHttp = CreateXmlHttpRequestObject();
    if (xmlHttp.readyState == 0 || xmlHttp.readystate == 4) {
        livro = encodeURIComponent(document.getElementById("dd_livro").value);
        titulo = encodeURIComponent(document.getElementById("dd_titulo").value);
        subtitulo = encodeURIComponent(document.getElementById("dd_subtitulo").value);
        capitulo = encodeURIComponent(document.getElementById("dd_capitulo").value);
        seccao = encodeURIComponent(document.getElementById("dd_seccao").value);
        subseccao = encodeURIComponent(document.getElementById("dd_subseccao").value);
        divisao = encodeURIComponent(document.getElementById("dd_divisao").value);
        var array_values = {0:'I', 1:'II', 2:'III', 3:'IV', 4:'V', 5:'VI', 6:'VII', 7:'VIII', 8:'IX', 9:'X', 10:'XI', 11:'XII', 12:'XIII', 13:'XIV', 14:'XV', 15:'XVI', 16:'XVII', 17:'XVIII', 18:'XIX', 19:'XX'};
        xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_artigo_with_divisao?doc=" + doc + "&livro=" + array_values[livro] + "&titulo=" + titulo + "&subtitulo=" + subtitulo + "&capitulo=" + capitulo + "&seccao=" + seccao + "&subseccao=" + subseccao + "&divisao=" + divisao, true);
        xmlHttp.onreadystatechange = handleServerResponseArtigoWithDivisao;
        xmlHttp.send(null);
    } else {
        setTimeout("fill_artigo_with_divisao()", 10000);
    }
}
function handleServerResponseArtigoWithDivisao() {
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200) {
            zeroSubdivisao();
            zeroArtigo();
            
            xmlResponse = xmlHttp.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            var element = document.getElementById("dd_artigo");
            
            if (message !== "0") {
                var splited_message = message.split(",");
                while(element.firstChild){
                    element.removeChild(element.firstChild);
                }

                for (i=0; i<splited_message.length; i++) {
                    var opt = document.createElement("option");
                    var text = document.createTextNode(splited_message[i]);
                    element.appendChild(opt);
                    opt.appendChild(text);
                }
            } else {                
                var opt = document.createElement("option");
                var text = document.createTextNode("0");
                element.appendChild(opt);
                opt.appendChild(text);
            }
        }
    }
}
function fill_artigo_with_divisao_no_subtitulo() {
        var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
    var xmlHttp = CreateXmlHttpRequestObject();
    if (xmlHttp.readyState == 0 || xmlHttp.readystate == 4) {
        livro = encodeURIComponent(document.getElementById("dd_livro").value);
        titulo = encodeURIComponent(document.getElementById("dd_titulo").value);
        capitulo = encodeURIComponent(document.getElementById("dd_capitulo").value);
        seccao = encodeURIComponent(document.getElementById("dd_seccao").value);
        subseccao = encodeURIComponent(document.getElementById("dd_subseccao").value);
        divisao = encodeURIComponent(document.getElementById("dd_divisao").value);
        var array_values = {0:'I', 1:'II', 2:'III', 3:'IV', 4:'V', 5:'VI', 6:'VII', 7:'VIII', 8:'IX', 9:'X', 10:'XI', 11:'XII', 12:'XIII', 13:'XIV', 14:'XV', 15:'XVI', 16:'XVII', 17:'XVIII', 18:'XIX', 19:'XX'};
        xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_artigo_with_subseccao_no_subtitulo?doc=" + doc + "&livro=" + array_values[livro] + "&titulo=" + titulo + "&capitulo=" + capitulo + "&seccao=" + seccao + "&subseccao=" + subseccao + "&divisao=" + divisao, true);
        xmlHttp.onreadystatechange = handleServerResponseArtigoWithDivisaoNoSubtitulo;
        xmlHttp.send(null);
    } else {
        setTimeout("fill_artigo_with_divisao_no_subtitulo()", 10000);
    }
}
function handleServerResponseArtigoWithDivisaoNoSubtitulo() {
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200) {
            zeroSubdivisao();
            zeroArtigo();
            
            xmlResponse = xmlHttp.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            var element = document.getElementById("dd_artigo");
            
            if (message !== "0") {
                var splited_message = message.split(",");
                while(element.firstChild){
                    element.removeChild(element.firstChild);
                }

                for (i=0; i<splited_message.length; i++) {
                    var opt = document.createElement("option");
                    var text = document.createTextNode(splited_message[i]);
                    element.appendChild(opt);
                    opt.appendChild(text);
                }
            } else {                
                var opt = document.createElement("option");
                var text = document.createTextNode("0");
                element.appendChild(opt);
                opt.appendChild(text);
            }
        }
    }
}

function clearTitulo() {
    var element = document.getElementById("dd_titulo");
    while(element.firstChild) {
        element.removeChild(element.firstChild);
    }
}
function clearSubtitulo() {
    var element = document.getElementById("dd_subtitulo");
    while(element.firstChild) {
        element.removeChild(element.firstChild);
    }
}
function clearCapitulo() {
    var element = document.getElementById("dd_capitulo");
    while(element.firstChild) {
        element.removeChild(element.firstChild);
    }
}
function clearSeccao() {
    var element = document.getElementById("dd_seccao");
    while(element.firstChild) {
        element.removeChild(element.firstChild);
    }
}
function clearSubseccao() {
    var element = document.getElementById("dd_subseccao");
    while(element.firstChild) {
        element.removeChild(element.firstChild);
    }
}
function clearDivisao() {
    var element = document.getElementById("dd_divisao");
    while(element.firstChild) {
        element.removeChild(element.firstChild);
    }
}
function clearSubdivisao() {
    var element = document.getElementById("dd_subdivisao");
    while(element.firstChild) {
        element.removeChild(element.firstChild);
    }
}
function clearArtigo() {
    var element = document.getElementById("dd_artigo");
    while(element.firstChild) {
        element.removeChild(element.firstChild);
    }
}
function zeroTitulo() {
    var element = document.getElementById("dd_titulo");
    while(element.firstChild) {
        element.removeChild(element.firstChild);
    }
    var opt = document.createElement("option");
    var text = document.createTextNode("0");
    element.appendChild(opt);
    opt.appendChild(text);
}
function zeroSubtitulo() {
    var element = document.getElementById("dd_subtitulo");
    while(element.firstChild) {
        element.removeChild(element.firstChild);
    }
    var opt = document.createElement("option");
    var text = document.createTextNode("0");
    element.appendChild(opt);
    opt.appendChild(text);
}
function zeroCapitulo() {
    var element = document.getElementById("dd_capitulo");
    while(element.firstChild) {
        element.removeChild(element.firstChild);
    }
    var opt = document.createElement("option");
    var text = document.createTextNode("0");
    element.appendChild(opt);
    opt.appendChild(text);
}
function zeroSeccao() {
    var element = document.getElementById("dd_seccao");
    while(element.firstChild) {
        element.removeChild(element.firstChild);
    }
    var opt = document.createElement("option");
    var text = document.createTextNode("0");
    element.appendChild(opt);
    opt.appendChild(text);
}
function zeroSubseccao() {
    var element = document.getElementById("dd_subseccao");
    while(element.firstChild) {
        element.removeChild(element.firstChild);
    }
    var opt = document.createElement("option");
    var text = document.createTextNode("0");
    element.appendChild(opt);
    opt.appendChild(text);
}
function zeroDivisao() {
    var element = document.getElementById("dd_divisao");
    while(element.firstChild) {
        element.removeChild(element.firstChild);
    }
    var opt = document.createElement("option");
    var text = document.createTextNode("0");
    element.appendChild(opt);
    opt.appendChild(text);
}
function zeroSubdivisao() {
    var element = document.getElementById("dd_subdivisao");
    while(element.firstChild) {
        element.removeChild(element.firstChild);
    }
    var opt = document.createElement("option");
    var text = document.createTextNode("0");
    element.appendChild(opt);
    opt.appendChild(text);
}
function zeroArtigo() {
    var element = document.getElementById("dd_artigo");
    while(element.firstChild) {
        element.removeChild(element.firstChild);
    }
    var opt = document.createElement("option");
    var text = document.createTextNode("0");
    element.appendChild(opt);
    opt.appendChild(text);
}
function appendTodosToElement(element) {
    var opt = document.createElement("option");
    var text = document.createTextNode("Todos");
    element.appendChild(opt);
    opt.appendChild(text);
}





//Backend functions
function change_doc_alteration() {
    var xmlHttp = CreateXmlHttpRequestObject();
    if (xmlHttp.readyState == 0 || xmlHttp.readystate == 4) {
        xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_livro_last_doc", true);
        xmlHttp.onreadystatechange = handleServerResponseDocAlteration;
        xmlHttp.send(null);
    } else {
        setTimeout("fill_titulo()", 10000);
    }
}

function handleServerResponseDocAlteration() {
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200) {            
            xmlResponse = xmlHttp.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            var element = document.getElementById("dd_livro");
            
            if (message !== "0") {
                var splited_message = message.split("_");
                while(element.firstChild){
                        element.removeChild(element.firstChild);
                }

                for (i=0; i<splited_message.length; i++) {
                    var opt = document.createElement("option");
                    var text = document.createTextNode(splited_message[i]);
                    element.appendChild(opt);
                    opt.appendChild(text);
                }
            } else {                
                var opt = document.createElement("option");
                var text = document.createTextNode("0");
                element.appendChild(opt);
                opt.appendChild(text);
            }
        }
    }
}