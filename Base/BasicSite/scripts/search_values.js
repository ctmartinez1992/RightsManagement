var xmlHttp = null;
var xmlHttp2 = null;

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

function CreateXmlHttp2RequestObject() {   
    if (window.XMLHttpRequest) {
        xmlHttp2 = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        xmlHttp2 = new ActiveXObject("Microsoft.XMLHTTP");
    } else {
        xmlHttp2 = false;
    }
    return xmlHttp2;
}

function fill_titulo() {
    var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
    var xmlHttp = CreateXmlHttpRequestObject();
    if (xmlHttp.readyState == 0 || xmlHttp.readystate == 4) {
        livro = encodeURIComponent(document.getElementById("dd_livro").value);
        var array_values = {0:'I', 1:'II', 2:'III', 3:'IV', 4:'V', 5:'VI', 6:'VII', 7:'VIII', 8:'IX', 9:'X', 10:'XI', 11:'XII', 12:'XIII', 13:'XIV', 14:'XV', 15:'XVI', 16:'XVII', 17:'XVIII', 18:'XIX', 19:'XX'};
        xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_titulo?doc=" + doc + "&livro=" + livro, true);
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

                if (document.getElementById('is_backend').options[document.getElementById('is_backend').selectedIndex].value == "true") {
                    var opt = document.createElement("option");
                    var text = document.createTextNode("");
                    element.appendChild(opt);
                    opt.appendChild(text);
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
    
    //backend
    if (document.getElementById('is_backend').options[document.getElementById('is_backend').selectedIndex].value == "true") {
        var xmlHttp2 = CreateXmlHttp2RequestObject();
        if (xmlHttp2.readyState == 0 || xmlHttp2.readystate == 4) {
            var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
            livro = encodeURIComponent(document.getElementById("dd_livro").value);
            xmlHttp2.open("GET", "http://localhost/BasicSite/model_get_search_values/get_livro_info_given_livro?doc=" + doc + "&livro=" + livro, true);
            xmlHttp2.onreadystatechange = handleServerResponseBackendFillWithLivro;
            xmlHttp2.send(null);
        } else {
        }
    }
}
function handleServerResponseBackendFillWithLivro() {
    if (xmlHttp2.readyState == 4) {
        if (xmlHttp2.status == 200) {
            xmlResponse = xmlHttp2.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            
            if (message !== "0") {
                var split = message.split("#");
                document.getElementById("tb_hierarquia").value = "Livro";
                document.getElementById("tb_numero").value = split[0];
                document.getElementById("tb_nome").value = split[1];
            } else {
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
        xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_subtitulo?doc=" + doc + "&livro=" + livro + "&titulo=" + titulo, true);
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

                if (document.getElementById('is_backend').options[document.getElementById('is_backend').selectedIndex].value == "true") {
                    var opt = document.createElement("option");
                    var text = document.createTextNode("");
                    element.appendChild(opt);
                    opt.appendChild(text);
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
    
    //backend
    if (document.getElementById('is_backend').options[document.getElementById('is_backend').selectedIndex].value == "true") {
        var xmlHttp2 = CreateXmlHttp2RequestObject();
        if (xmlHttp2.readyState == 0 || xmlHttp2.readystate == 4) {
            var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
            livro = encodeURIComponent(document.getElementById("dd_livro").value);
            titulo = encodeURIComponent(document.getElementById("dd_titulo").value);
            xmlHttp2.open("GET", "http://localhost/BasicSite/model_get_search_values/get_titulo_info_given_titulo?doc=" + doc + "&livro=" + livro + "&titulo=" + titulo, true);
            xmlHttp2.onreadystatechange = handleServerResponseBackendFillWithTitulo;
            xmlHttp2.send(null);
        } else {
        }
    }
}
function handleServerResponseBackendFillWithTitulo() {
    if (xmlHttp2.readyState == 4) {
        if (xmlHttp2.status == 200) {
            xmlResponse = xmlHttp2.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            
            if (message !== "0") {
                var split = message.split("#");
                document.getElementById("tb_hierarquia").value = "Título";
                document.getElementById("tb_numero").value = split[0];
                document.getElementById("tb_nome").value = split[1];
            } else {
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
        xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_capitulo?doc=" + doc + "&livro=" + livro + "&titulo=" + titulo + "&subtitulo=" + subtitulo, true);
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

                if (document.getElementById('is_backend').options[document.getElementById('is_backend').selectedIndex].value == "true") {
                    var opt = document.createElement("option");
                    var text = document.createTextNode("");
                    element.appendChild(opt);
                    opt.appendChild(text);
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
                if (document.getElementById('is_backend').options[document.getElementById('is_backend').selectedIndex].value == "true") {
                    fill_artigo_with_subtitulo();
                }
            }
        }
    }
    
    //backend
    if (document.getElementById('is_backend').options[document.getElementById('is_backend').selectedIndex].value == "true") {
        var xmlHttp2 = CreateXmlHttp2RequestObject();
        if (xmlHttp2.readyState == 0 || xmlHttp2.readystate == 4) {
            var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
            livro = encodeURIComponent(document.getElementById("dd_livro").value);
            titulo = encodeURIComponent(document.getElementById("dd_titulo").value);
            subtitulo = encodeURIComponent(document.getElementById("dd_subtitulo").value);
            xmlHttp2.open("GET", "http://localhost/BasicSite/model_get_search_values/get_subtitulo_info_given_subtitulo?doc=" + doc + "&livro=" + livro + "&titulo=" + titulo + "&subtitulo=" + subtitulo, true);
            xmlHttp2.onreadystatechange = handleServerResponseBackendFillWithSubtitulo;
            xmlHttp2.send(null);
        } else {
        }
    }
}
function handleServerResponseBackendFillWithSubtitulo() {
    if (xmlHttp2.readyState == 4) {
        if (xmlHttp2.status == 200) {
            xmlResponse = xmlHttp2.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            if (message !== "0") {
                var split = message.split("#");
                document.getElementById("tb_hierarquia").value = "Sub-Título";
                document.getElementById("tb_numero").value = split[0];
                document.getElementById("tb_nome").value = split[1];
            } else {
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
        xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_capitulo_no_subtitulo?doc=" + doc + "&livro=" + livro + "&titulo=" + titulo, true);
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

                if (document.getElementById('is_backend').options[document.getElementById('is_backend').selectedIndex].value == "true") {
                    var opt = document.createElement("option");
                    var text = document.createTextNode("");
                    element.appendChild(opt);
                    opt.appendChild(text);
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
            xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_seccao_no_subtitulo?doc=" + doc + "&livro=" + livro + "&titulo=" + titulo + "&capitulo=" + capitulo, true); 
        } else {
            xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_seccao?doc=" + doc + "&livro=" + livro + "&titulo=" + titulo + "&subtitulo=" + subtitulo + "&capitulo=" + capitulo, true);
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

                if (document.getElementById('is_backend').options[document.getElementById('is_backend').selectedIndex].value == "true") {
                    var opt = document.createElement("option");
                    var text = document.createTextNode("");
                    element.appendChild(opt);
                    opt.appendChild(text);
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
    
    //backend
    if (document.getElementById('is_backend').options[document.getElementById('is_backend').selectedIndex].value == "true") {
        var xmlHttp2 = CreateXmlHttp2RequestObject();
        if (xmlHttp2.readyState == 0 || xmlHttp2.readystate == 4) {
            var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
            livro = encodeURIComponent(document.getElementById("dd_livro").value);
            titulo = encodeURIComponent(document.getElementById("dd_titulo").value);
            subtitulo = encodeURIComponent(document.getElementById("dd_subtitulo").value);
            capitulo = encodeURIComponent(document.getElementById("dd_capitulo").value);
            if (subtitulo === "0") {
                xmlHttp2.open("GET", "http://localhost/BasicSite/model_get_search_values/get_capitulo_info_given_capitulo_no_subtitulo?doc=" + doc + "&livro=" + livro + "&titulo=" + titulo + "&capitulo=" + capitulo, true);
            } else {
                xmlHttp2.open("GET", "http://localhost/BasicSite/model_get_search_values/get_capitulo_info_given_capitulo?doc=" + doc + "&livro=" + livro + "&titulo=" + titulo + "&subtitulo=" + subtitulo + "&capitulo=" + capitulo, true);
            }
            xmlHttp2.onreadystatechange = handleServerResponseBackendFillWithCapitulo;
            xmlHttp2.send(null);
        } else {
        }
    }
}
function handleServerResponseBackendFillWithCapitulo() {
    if (xmlHttp2.readyState == 4) {
        if (xmlHttp2.status == 200) {
            xmlResponse = xmlHttp2.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            if (message !== "0") {
                var split = message.split("#");
                document.getElementById("tb_hierarquia").value = "Capítulo";
                document.getElementById("tb_numero").value = split[0];
                document.getElementById("tb_nome").value = split[1];
            } else {
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
            xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_subseccao_no_subtitulo?doc=" + doc + "&livro=" + livro + "&titulo=" + titulo + "&capitulo=" + capitulo + "&seccao=" + seccao, true); 
        } else {
            xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_subseccao?doc=" + doc + "&livro=" + livro + "&titulo=" + titulo + "&subtitulo=" + subtitulo + "&capitulo=" + capitulo + "&seccao=" + seccao, true);
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

                if (document.getElementById('is_backend').options[document.getElementById('is_backend').selectedIndex].value == "true") {
                    var opt = document.createElement("option");
                    var text = document.createTextNode("");
                    element.appendChild(opt);
                    opt.appendChild(text);
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
    
    //backend
    if (document.getElementById('is_backend').options[document.getElementById('is_backend').selectedIndex].value == "true") {
        var xmlHttp2 = CreateXmlHttp2RequestObject();
        if (xmlHttp2.readyState == 0 || xmlHttp2.readystate == 4) {
            var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
            livro = encodeURIComponent(document.getElementById("dd_livro").value);
            titulo = encodeURIComponent(document.getElementById("dd_titulo").value);
            subtitulo = encodeURIComponent(document.getElementById("dd_subtitulo").value);
            capitulo = encodeURIComponent(document.getElementById("dd_capitulo").value);
            seccao = encodeURIComponent(document.getElementById("dd_seccao").value);
            if (subtitulo === "0") {
                xmlHttp2.open("GET", "http://localhost/BasicSite/model_get_search_values/get_seccao_info_given_seccao_no_subtitulo?doc=" + doc + "&livro=" + livro + "&titulo=" + titulo + "&capitulo=" + capitulo + "&seccao=" + seccao, true);
            } else {
                xmlHttp2.open("GET", "http://localhost/BasicSite/model_get_search_values/get_seccao_info_given_seccao?doc=" + doc + "&livro=" + livro + "&titulo=" + titulo + "&subtitulo=" + subtitulo + "&capitulo=" + capitulo + "&seccao=" + seccao, true);
            }
            xmlHttp2.onreadystatechange = handleServerResponseBackendFillWithSeccao;
            xmlHttp2.send(null);
        } else {
        }
    }
}
function handleServerResponseBackendFillWithSeccao() {
    if (xmlHttp2.readyState == 4) {
        if (xmlHttp2.status == 200) {
            xmlResponse = xmlHttp2.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            if (message !== "0") {
                var split = message.split("#");
                document.getElementById("tb_hierarquia").value = "Secção";
                document.getElementById("tb_numero").value = split[0];
                document.getElementById("tb_nome").value = split[1];
            } else {
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
            xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_divisao_no_subtitulo?doc=" + doc + "&livro=" + livro + "&titulo=" + titulo + "&capitulo=" + capitulo + "&seccao=" + seccao + "&subseccao=" + subseccao, true); 
        } else {
            xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_divisao?doc=" + doc + "&livro=" + livro + "&titulo=" + titulo + "&subtitulo=" + subtitulo + "&capitulo=" + capitulo + "&seccao=" + seccao + "&subseccao=" + subseccao, true);
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

                if (document.getElementById('is_backend').options[document.getElementById('is_backend').selectedIndex].value == "true") {
                    var opt = document.createElement("option");
                    var text = document.createTextNode("");
                    element.appendChild(opt);
                    opt.appendChild(text);
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
    
    //backend
    if (document.getElementById('is_backend').options[document.getElementById('is_backend').selectedIndex].value == "true") {
        var xmlHttp2 = CreateXmlHttp2RequestObject();
        if (xmlHttp2.readyState == 0 || xmlHttp2.readystate == 4) {
            var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
            livro = encodeURIComponent(document.getElementById("dd_livro").value);
            titulo = encodeURIComponent(document.getElementById("dd_titulo").value);
            subtitulo = encodeURIComponent(document.getElementById("dd_subtitulo").value);
            capitulo = encodeURIComponent(document.getElementById("dd_capitulo").value);
            seccao = encodeURIComponent(document.getElementById("dd_seccao").value);
            subseccao = encodeURIComponent(document.getElementById("dd_subseccao").value);
            if (subtitulo === "0") {
                xmlHttp2.open("GET", "http://localhost/BasicSite/model_get_search_values/get_subseccao_info_given_subseccao_no_subtitulo?doc=" + doc + "&livro=" + livro + "&titulo=" + titulo + "&capitulo=" + capitulo + "&seccao=" + seccao + "&subseccao=" + subseccao, true);
            } else {
                xmlHttp2.open("GET", "http://localhost/BasicSite/model_get_search_values/get_subseccao_info_given_subseccao?doc=" + doc + "&livro=" + livro + "&titulo=" + titulo + "&subtitulo=" + subtitulo + "&capitulo=" + capitulo + "&seccao=" + seccao + "&subseccao=" + subseccao, true);
            }
            xmlHttp2.onreadystatechange = handleServerResponseBackendFillWithSubseccao;
            xmlHttp2.send(null);
        } else {
        }
    }
}
function handleServerResponseBackendFillWithSubseccao() {
    if (xmlHttp2.readyState == 4) {
        if (xmlHttp2.status == 200) {
            xmlResponse = xmlHttp2.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            if (message !== "0") {
                var split = message.split("#");
                document.getElementById("tb_hierarquia").value = "Sub-Secção";
                document.getElementById("tb_numero").value = split[0];
                document.getElementById("tb_nome").value = split[1];
            } else {
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
            xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_subdivisao_no_subtitulo?doc=" + doc + "&livro=" + livro + "&titulo=" + titulo + "&capitulo=" + capitulo + "&seccao=" + seccao + "&subseccao=" + subseccao + "&divisao=" + divisao, true); 
        } else {
            xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_subdivisao?doc=" + doc + "&livro=" + livro + "&titulo=" + titulo + "&subtitulo=" + subtitulo + "&capitulo=" + capitulo + "&seccao=" + seccao + "&subseccao=" + subseccao + "&divisao=" + divisao, true);
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

                if (document.getElementById('is_backend').options[document.getElementById('is_backend').selectedIndex].value == "true") {
                    var opt = document.createElement("option");
                    var text = document.createTextNode("");
                    element.appendChild(opt);
                    opt.appendChild(text);
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
    
    //backend
    if (document.getElementById('is_backend').options[document.getElementById('is_backend').selectedIndex].value == "true") {
        var xmlHttp2 = CreateXmlHttp2RequestObject();
        if (xmlHttp2.readyState == 0 || xmlHttp2.readystate == 4) {
            var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
            livro = encodeURIComponent(document.getElementById("dd_livro").value);
            titulo = encodeURIComponent(document.getElementById("dd_titulo").value);
            subtitulo = encodeURIComponent(document.getElementById("dd_subtitulo").value);
            capitulo = encodeURIComponent(document.getElementById("dd_capitulo").value);
            seccao = encodeURIComponent(document.getElementById("dd_seccao").value);
            subseccao = encodeURIComponent(document.getElementById("dd_subseccao").value);
            divisao = encodeURIComponent(document.getElementById("dd_divisao").value);
            if (subtitulo === "0") {
                xmlHttp2.open("GET", "http://localhost/BasicSite/model_get_search_values/get_divisao_info_given_divisao_no_subtitulo?doc=" + doc + "&livro=" + livro + "&titulo=" + titulo + "&capitulo=" + capitulo + "&seccao=" + seccao + "&subseccao=" + subseccao + "&divisao=" + divisao, true);
            } else {
                xmlHttp2.open("GET", "http://localhost/BasicSite/model_get_search_values/get_divisao_info_given_divisao?doc=" + doc + "&livro=" + livro + "&titulo=" + titulo + "&subtitulo=" + subtitulo + "&capitulo=" + capitulo + "&seccao=" + seccao + "&subseccao=" + subseccao + "&divisao=" + divisao, true);
            }
            xmlHttp2.onreadystatechange = handleServerResponseBackendFillWithDivisao;
            xmlHttp2.send(null);
        } else {
        }
    }
}
function handleServerResponseBackendFillWithDivisao() {
    if (xmlHttp2.readyState == 4) {
        if (xmlHttp2.status == 200) {
            xmlResponse = xmlHttp2.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            if (message !== "0") {
                var split = message.split("#");
                document.getElementById("tb_hierarquia").value = "Divisão";
                document.getElementById("tb_numero").value = split[0];
                document.getElementById("tb_nome").value = split[1];
            } else {
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
            xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_subdivisao_no_subtitulo?doc=" + doc + "&livro=" + livro + "&titulo=" + titulo + "&capitulo=" + capitulo + "&seccao=" + seccao + "&subseccao=" + subseccao + "&divisao=" + divisao + "&subdivisao=" + subdivisao, true); 
        } else {
            xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_subdivisao?doc=" + doc + "&livro=" + livro + "&titulo=" + titulo + "&subtitulo=" + subtitulo + "&capitulo=" + capitulo + "&seccao=" + seccao + "&subseccao=" + subseccao + "&divisao=" + divisao + "&subdivisao=" + subdivisao, true);
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

                if (document.getElementById('is_backend').options[document.getElementById('is_backend').selectedIndex].value == "true") {
                    var opt = document.createElement("option");
                    var text = document.createTextNode("");
                    element.appendChild(opt);
                    opt.appendChild(text);
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
    
    //backend
    if (document.getElementById('is_backend').options[document.getElementById('is_backend').selectedIndex].value == "true") {
        var xmlHttp2 = CreateXmlHttp2RequestObject();
        if (xmlHttp2.readyState == 0 || xmlHttp2.readystate == 4) {
            var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
            livro = encodeURIComponent(document.getElementById("dd_livro").value);
            titulo = encodeURIComponent(document.getElementById("dd_titulo").value);
            subtitulo = encodeURIComponent(document.getElementById("dd_subtitulo").value);
            capitulo = encodeURIComponent(document.getElementById("dd_capitulo").value);
            seccao = encodeURIComponent(document.getElementById("dd_seccao").value);
            subseccao = encodeURIComponent(document.getElementById("dd_subseccao").value);
            divisao = encodeURIComponent(document.getElementById("dd_divisao").value);
            subdivisao = encodeURIComponent(document.getElementById("dd_subdivisao").value);
            if (subtitulo === "0") {
                xmlHttp2.open("GET", "http://localhost/BasicSite/model_get_search_values/get_subdivisao_info_given_subdivisao_no_subtitulo?doc=" + doc + "&livro=" + livro + "&titulo=" + titulo + "&capitulo=" + capitulo + "&seccao=" + seccao + "&subseccao=" + subseccao + "&divisao=" + divisao + "&subdivisao=" + subdivisao, true);
            } else {
                xmlHttp2.open("GET", "http://localhost/BasicSite/model_get_search_values/get_subdivisao_info_given_subdivisao?doc=" + doc + "&livro=" + livro + "&titulo=" + titulo + "&subtitulo=" + subtitulo + "&capitulo=" + capitulo + "&seccao=" + seccao + "&subseccao=" + subseccao + "&divisao=" + divisao + "&subdivisao=" + subdivisao, true);
            }
            xmlHttp2.onreadystatechange = handleServerResponseBackendFillWithSubdivisao;
            xmlHttp2.send(null);
        } else {
        }
    }
}

function handleServerResponseBackendFillWithSubdivisao() {
    if (xmlHttp2.readyState == 4) {
        if (xmlHttp2.status == 200) {
            xmlResponse = xmlHttp2.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            if (message !== "0") {
                var split = message.split("#");
                document.getElementById("tb_hierarquia").value = "Sub-Divisão";
                document.getElementById("tb_numero").value = split[0];
                document.getElementById("tb_nome").value = split[1];
            } else {
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
        xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_artigo_with_titulo?doc=" + doc + "&livro=" + livro + "&titulo=" + titulo, true);
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
        xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_artigo_with_subtitulo?doc=" + doc + "&livro=" + livro + "&titulo=" + titulo + "&subtitulo=" + subtitulo, true);
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
        xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_artigo_with_capitulo?doc=" + doc + "&livro=" + livro + "&titulo=" + titulo + "&subtitulo=" + subtitulo + "&capitulo=" + capitulo, true);
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
        xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_artigo_with_capitulo_no_subtitulo?doc=" + doc + "&livro=" + livro + "&titulo=" + titulo + "&capitulo=" + capitulo, true);
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
        xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_artigo_with_seccao?doc=" + doc + "&livro=" + livro + "&titulo=" + titulo + "&subtitulo=" + subtitulo + "&capitulo=" + capitulo + "&seccao=" + seccao, true);
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
        xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_artigo_with_seccao_no_subtitulo?doc=" + doc + "&livro=" + livro + "&titulo=" + titulo + "&capitulo=" + capitulo + "&seccao=" + seccao, true);
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
        xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_artigo_with_subseccao?doc=" + doc + "&livro=" + livro + "&titulo=" + titulo + "&subtitulo=" + subtitulo + "&capitulo=" + capitulo + "&seccao=" + seccao + "&subseccao=" + subseccao, true);
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
        xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_artigo_with_subseccao_no_subtitulo?doc=" + doc + "&livro=" + livro + "&titulo=" + titulo + "&capitulo=" + capitulo + "&seccao=" + seccao + "&subseccao=" + subseccao, true);
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
        xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_artigo_with_divisao?doc=" + doc + "&livro=" + livro + "&titulo=" + titulo + "&subtitulo=" + subtitulo + "&capitulo=" + capitulo + "&seccao=" + seccao + "&subseccao=" + subseccao + "&divisao=" + divisao, true);
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
        xmlHttp.open("GET", "http://localhost/BasicSite/model_get_search_values/get_artigo_with_subseccao_no_subtitulo?doc=" + doc + "&livro=" + livro + "&titulo=" + titulo + "&capitulo=" + capitulo + "&seccao=" + seccao + "&subseccao=" + subseccao + "&divisao=" + divisao, true);
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

function clearLivro() {
    var element = document.getElementById("dd_livro");
    while(element.firstChild) {
        element.removeChild(element.firstChild);
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
    clearLivro();
    clearTitulo();
    clearSubtitulo();
    clearCapitulo();
    clearSeccao();
    clearSubseccao();
    clearDivisao();
    clearSubdivisao();
    clearArtigo();
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
                    var split = splited_message[i].split(" - ");
                    var text = document.createTextNode(split[0]);
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

function save_hierarchy_alteration() {
    output = [];
    
    var doc = document.getElementById('dd_doc_alteration').options[document.getElementById('dd_doc_alteration').selectedIndex].text;
    var filter = doc.split("(");
    var filter2 = filter[1].split(")");
    var doc_res = filter2[0].replace("/", "_").replace("/", "_");
    var dia_mes_ano = doc_res.split("_");
    
    /*
     * output description array:
     * 0 : doc that we are changing;
     * 1 : Last doc that had a change in hierarchy, meanign that the current hierarchy is inside there;
     * 2 : The hierarchy we are changing;
     * 3 : The new number of the hierarchy;
     * 4 : The new name of the hierarchy;
     * 5 to 12 : The path to such hierarchy (5 the highest - 12 the lowest)
     * 
     */
    output[0] = String(dia_mes_ano[2] + "_" + dia_mes_ano[1] + "_" + dia_mes_ano[0]);
    output[1] = document.getElementById('dd_data_hierarchy_doc').options[document.getElementById('dd_data_hierarchy_doc').selectedIndex].text;
    output[2] = document.getElementById('tb_hierarquia').value;
    output[3] = document.getElementById('tb_numero').value;
    output[4] = document.getElementById('tb_nome').value;
    
    if (document.getElementById('dd_livro').options.length > 0 && document.getElementById('dd_livro').options[document.getElementById('dd_livro').selectedIndex].text != "") {
        output[5] = document.getElementById('dd_livro').options[document.getElementById('dd_livro').selectedIndex].text;
    } else { output[5] = '0'; }
    if (document.getElementById('dd_titulo').options.length > 0 && document.getElementById('dd_titulo').options[document.getElementById('dd_titulo').selectedIndex].text != "") {
        output[6] = document.getElementById('dd_titulo').options[document.getElementById('dd_titulo').selectedIndex].text;
    } else { output[6] = '0'; }
    if (document.getElementById('dd_subtitulo').options.length > 0 && document.getElementById('dd_subtitulo').options[document.getElementById('dd_subtitulo').selectedIndex].text != "") {
        output[7] = document.getElementById('dd_subtitulo').options[document.getElementById('dd_subtitulo').selectedIndex].text;
    } else { output[7] = '0'; }
    if (document.getElementById('dd_capitulo').options.length > 0 && document.getElementById('dd_capitulo').options[document.getElementById('dd_capitulo').selectedIndex].text != "") {
        output[8] = document.getElementById('dd_capitulo').options[document.getElementById('dd_capitulo').selectedIndex].text;
    } else { output[8] = '0'; }
    if (document.getElementById('dd_seccao').options.length > 0 && document.getElementById('dd_seccao').options[document.getElementById('dd_seccao').selectedIndex].text != "") {
        output[9] = document.getElementById('dd_seccao').options[document.getElementById('dd_seccao').selectedIndex].text;
    } else { output[9] = '0'; }
    if (document.getElementById('dd_subseccao').options.length > 0 && document.getElementById('dd_subseccao').options[document.getElementById('dd_subseccao').selectedIndex].text != "") {
        output[10] = document.getElementById('dd_subseccao').options[document.getElementById('dd_subseccao').selectedIndex].text;
    } else { output[10] = '0'; }
    if (document.getElementById('dd_divisao').options.length > 0 && document.getElementById('dd_divisao').options[document.getElementById('dd_divisao').selectedIndex].text != "") {
        output[11] = document.getElementById('dd_divisao').options[document.getElementById('dd_divisao').selectedIndex].text;
    } else { output[11] = '0'; }
    if (document.getElementById('dd_subdivisao').options.length > 0 && document.getElementById('dd_subdivisao').options[document.getElementById('dd_subdivisao').selectedIndex].text != "") {
        output[12] = document.getElementById('dd_subdivisao').options[document.getElementById('dd_subdivisao').selectedIndex].text;
    } else { output[12] = '0'; }
    
    if (confirm("Tem a certeza que quer alterar a hierarquia?")) {
        var jsonString = JSON.stringify(output);
        $.ajax({
            type: "POST",
            url: "http://localhost/BasicSite/model_save_file/save_hierarchy_file",
            data: {data : jsonString},
            cache: false,

            success: function(){
                var split = window.location.pathname.split("/");
                window.location.replace(window.location.protocol + "//" + window.location.host + "/" + split[1] + "/backend/main_alteration");
            }
        });
    } else {
    }
}