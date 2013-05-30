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

function get_next_hierarchy(li, options) {
    var doc = document.getElementById('dd_data_doc').value;
    var xmlHttp = CreateXmlHttpRequestObject();
    if (xmlHttp.readyState == 0 || xmlHttp.readystate == 4) {
        var next_hierarchy_name = [];
        if (li.attr('id') == "livro") {
            next_hierarchy_name[0] = "titulo";
            next_hierarchy_name[1] = "Título";
            xmlHttp.open("GET", "http://localhost/BasicSite/model_get_main_values/get_hierarchy_titulo?doc=" + doc + "&livro=" + li.attr('data-id'), true);
        } else if (li.attr('id') == "titulo") {
            next_hierarchy_name[0] = "subtitulo";
            next_hierarchy_name[1] = "Subtítulo";
            xmlHttp.open("GET", "http://localhost/BasicSite/model_get_main_values/get_hierarchy_subtitulo?doc=" + doc + "&livro=" + li.parent().parent().attr('data-id') + 
                                                                                                        "&titulo=" + li.attr('data-id'), true);
        } else if (li.attr('id') == "subtitulo") {
            next_hierarchy_name[0] = "capitulo";
            next_hierarchy_name[1] = "Capítulo";
            xmlHttp.open("GET", "http://localhost/BasicSite/model_get_main_values/get_hierarchy_capitulo?doc=" + doc + "&livro=" + li.parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&titulo=" + li.parent().parent().attr('data-id') +
                                                                                                       "&subtitulo=" + li.attr('data-id'), true);
        } else if (li.attr('id') == "capitulo") {
            next_hierarchy_name[0] = "seccao";
            next_hierarchy_name[1] = "Secção";
            if (li.parent().parent().attr('id') == "subtitulo") {
                xmlHttp.open("GET", "http://localhost/BasicSite/model_get_main_values/get_hierarchy_seccao?doc=" + doc + "&livro=" + li.parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&titulo=" + li.parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&subtitulo=" + li.parent().parent().attr('data-id') +
                                                                                                       "&capitulo=" + li.attr('data-id'), true);
            } else {
                xmlHttp.open("GET", "http://localhost/BasicSite/model_get_main_values/get_hierarchy_seccao_no_subtitulo?doc=" + doc + "&livro=" + li.parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&titulo=" + li.parent().parent().attr('data-id') +
                                                                                                       "&capitulo=" + li.attr('data-id'), true);
            }
        } else if (li.attr('id') == "seccao") {
            next_hierarchy_name[0] = "subseccao";
            next_hierarchy_name[1] = "Subsecção";
            if (li.parent().parent().parent().parent().attr('id') == "subtitulo") {
                xmlHttp.open("GET", "http://localhost/BasicSite/model_get_main_values/get_hierarchy_subseccao?doc=" + doc + "&livro=" + li.parent().parent().parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&titulo=" + li.parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&subtitulo=" + li.parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&capitulo=" + li.parent().parent().attr('data-id') +
                                                                                                       "&seccao=" + li.attr('data-id'), true);
            } else {
                xmlHttp.open("GET", "http://localhost/BasicSite/model_get_main_values/get_hierarchy_subseccao_no_subtitulo?doc=" + doc + "&livro=" + li.parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&titulo=" + li.parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&capitulo=" + li.parent().parent().attr('data-id') +
                                                                                                       "&seccao=" + li.attr('data-id'), true);
            }
        } else if (li.attr('id') == "subseccao") {
            next_hierarchy_name[0] = "divisao";
            next_hierarchy_name[1] = "Divisão";
            if (li.parent().parent().parent().parent().parent().parent().attr('id') == "subtitulo") {
                xmlHttp.open("GET", "http://localhost/BasicSite/model_get_main_values/get_hierarchy_divisao?doc=" + doc + "&livro=" + li.parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&titulo=" + li.parent().parent().parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&subtitulo=" + li.parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&capitulo=" + li.parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&seccao=" + li.parent().parent().attr('data-id') +
                                                                                                       "&subseccao=" + li.attr('data-id'), true);
            } else {
                xmlHttp.open("GET", "http://localhost/BasicSite/model_get_main_values/get_hierarchy_divisao_no_subtitulo?doc=" + doc + "&livro=" + li.parent().parent().parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&titulo=" + li.parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&capitulo=" + li.parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&seccao=" + li.parent().parent().attr('data-id') +
                                                                                                       "&subseccao=" + li.attr('data-id'), true);
            }
        } else if (li.attr('id') == "divisao") {
            next_hierarchy_name[0] = "subdivisao";
            next_hierarchy_name[1] = "Subdivisão";
            if (li.parent().parent().parent().parent().parent().parent().parent().parent().attr('id') == "subtitulo") {
                xmlHttp.open("GET", "http://localhost/BasicSite/model_get_main_values/get_hierarchy_subdivisao?doc=" + doc + "&livro=" + li.parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&titulo=" + li.parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&subtitulo=" + li.parent().parent().parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&capitulo=" + li.parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&seccao=" + li.parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&subseccao=" + li.parent().parent().attr('data-id') +
                                                                                                       "&divisao=" + li.attr('data-id'), true);
            } else {
                xmlHttp.open("GET", "http://localhost/BasicSite/model_get_main_values/get_hierarchy_subdivisao_no_subtitulo?doc=" + doc + "&livro=" + li.parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&titulo=" + li.parent().parent().parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&capitulo=" + li.parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&seccao=" + li.parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&subseccao=" + li.parent().parent().attr('data-id') +
                                                                                                       "&divisao=" + li.attr('data-id'), true);
            }
        } else if (li.attr('id') == "subdivisao") {
            next_hierarchy_name[0] = "artigo";
            next_hierarchy_name[1] = "Artigo";
            if (li.parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().attr('id') == "subtitulo") {
                xmlHttp.open("GET", "http://localhost/BasicSite/model_get_main_values/get_hierarchy_artigo_with_subdivisao?doc=" + doc + "&livro=" + li.parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&titulo=" + li.parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&subtitulo=" + li.parent().parent().parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&capitulo=" + li.parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&seccao=" + li.parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&subseccao=" + li.parent().parent().attr('data-id') +
                                                                                                       "&divisao=" + li.attr('data-id'), true);
            } else {
                xmlHttp.open("GET", "http://localhost/BasicSite/model_get_main_values/get_hierarchy_artigo_with_subdivisao_no_subtitulo?doc=" + doc + "&livro=" + li.parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&titulo=" + li.parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&capitulo=" + li.parent().parent().parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&seccao=" + li.parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&subseccao=" + li.parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&divisao=" + li.parent().parent().attr('data-id') +
                                                                                                       "&subdivisao=" + li.attr('data-id'), true);
            }
            xmlHttp.onreadystatechange = function () {
                handleServerResponseHierarchyArtigoWithSubdivisao(li, options, next_hierarchy_name);
            };
        }
        if (li.attr('id') != "subdivisao") {
            xmlHttp.onreadystatechange = function () {
                handleServerResponseNextHierarchy(li, options, next_hierarchy_name);
            };
        }
        xmlHttp.send(null);
    } else {
        setTimeout("get_next_hierarchy(li)", 10000);
    }
}
function handleServerResponseNextHierarchy(li, options, name) {
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200) {            
            xmlResponse = xmlHttp.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            if (message != "0") {                
                add_item(li, options, name, message);
            } else if (name[0] == "subtitulo") {
                get_hierarchy_capitulo_no_subtitulo(li, options);
            } else if (name[0] == "capitulo") {
                get_hierarchy_artigo_with_subtitulo(li, options);
            } else if (name[0] == "seccao") {
                get_hierarchy_artigo_with_capitulo(li, options);
            } else if (name[0] == "subseccao") {
                get_hierarchy_artigo_with_seccao(li, options);
            } else if (name[0] == "divisao") {
                get_hierarchy_artigo_with_subseccao(li, options);
            } else if (name[0] == "subdivisao") {
                get_hierarchy_artigo_with_divisao(li, options);
            }
        }
    }
}

function get_hierarchy_capitulo_no_subtitulo(li, options) {
    var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
    var xmlHttp = CreateXmlHttpRequestObject();
    if (xmlHttp.readyState == 0 || xmlHttp.readystate == 4) {
        var next_hierarchy_name = [];
        next_hierarchy_name[0] = "capitulo";
        next_hierarchy_name[1] = "Capítulo";
        xmlHttp.open("GET", "http://localhost/BasicSite/model_get_main_values/get_hierarchy_capitulo_no_subtitulo?doc=" + doc + "&livro=" + li.parent().parent().attr('data-id') +
                                                                                                       "&titulo=" + li.attr('data-id'), true);
        xmlHttp.onreadystatechange = function () {
            handleServerResponseHierarchyCapituloNoSubtitulo(li, options, next_hierarchy_name);
        };
        xmlHttp.send(null);
    } else {
        setTimeout("get_next_hierarchy(li)", 10000);
    }
}
function handleServerResponseHierarchyCapituloNoSubtitulo(li, options, name) {
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200) {            
            xmlResponse = xmlHttp.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            
            if (message != "0") {                
                add_item(li, options, name, message);
            } else {
                get_hierarchy_artigo_with_titulo(li, options);
            }
        }
    }
}

function get_hierarchy_artigo_with_titulo(li, options) {
    var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
    var xmlHttp = CreateXmlHttpRequestObject();
    if (xmlHttp.readyState == 0 || xmlHttp.readystate == 4) {
        var next_hierarchy_name = [];
        next_hierarchy_name[0] = "artigo";
        next_hierarchy_name[1] = "Artigo";
        xmlHttp.open("GET", "http://localhost/BasicSite/model_get_main_values/get_hierarchy_artigo_with_titulo?doc=" + doc + "&livro=" + li.parent().parent().attr('data-id') +
                                                                                                       "&titulo=" + li.attr('data-id'), true);
        xmlHttp.onreadystatechange = function () {
            handleServerResponseHierarchyArtigoWithTitulo(li, options, next_hierarchy_name);
        };
        xmlHttp.send(null);
    } else {
    }
}
function handleServerResponseHierarchyArtigoWithTitulo(li, options, name) {
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200) {            
            xmlResponse = xmlHttp.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            
            if (message != "0") {                
                add_item_article(li, options, name, message);
            }
        }
    }
}

function get_hierarchy_artigo_with_subtitulo(li, options) {
        var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
    var xmlHttp = CreateXmlHttpRequestObject();
    if (xmlHttp.readyState == 0 || xmlHttp.readystate == 4) {
        var next_hierarchy_name = [];
        next_hierarchy_name[0] = "artigo";
        next_hierarchy_name[1] = "Artigo";
        xmlHttp.open("GET", "http://localhost/BasicSite/model_get_main_values/get_hierarchy_artigo_with_subtitulo?doc=" + doc + "&livro=" + li.parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&titulo=" + li.parent().parent().attr('data-id') +
                                                                                                       "&subtitulo=" + li.attr('data-id'), true);
        xmlHttp.onreadystatechange = function () {
            handleServerResponseHierarchyArtigoWithSubtitulo(li, options, next_hierarchy_name);
        };
        xmlHttp.send(null);
    } else {
        setTimeout("get_next_hierarchy(li)", 10000);
    }
}
function handleServerResponseHierarchyArtigoWithSubtitulo(li, options, name) {
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200) {            
            xmlResponse = xmlHttp.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            
            if (message != "0") {                
                add_item_article(li, options, name, message);
            }
        }
    }
}

function get_hierarchy_artigo_with_capitulo(li, options) {
        var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
    var xmlHttp = CreateXmlHttpRequestObject();
    if (xmlHttp.readyState == 0 || xmlHttp.readystate == 4) {
        var next_hierarchy_name = [];
        next_hierarchy_name[0] = "artigo";
        next_hierarchy_name[1] = "Artigo";
        if (li.parent().parent().attr('id') == "subtitulo") {
            xmlHttp.open("GET", "http://localhost/BasicSite/model_get_main_values/get_hierarchy_artigo_with_capitulo?doc=" + doc + "&livro=" + li.parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&titulo=" + li.parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&subtitulo=" + li.parent().parent().attr('data-id') +
                                                                                                       "&capitulo=" + li.attr('data-id'), true);
        } else {
            xmlHttp.open("GET", "http://localhost/BasicSite/model_get_main_values/get_hierarchy_artigo_with_capitulo_no_subtitulo?doc=" + doc + "&livro=" + li.parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&titulo=" + li.parent().parent().attr('data-id') +
                                                                                                       "&capitulo=" + li.attr('data-id'), true);
        }
        xmlHttp.onreadystatechange = function () {
            handleServerResponseHierarchyArtigoWithCapitulo(li, options, next_hierarchy_name);
        };
        xmlHttp.send(null);
    } else {
        setTimeout("get_next_hierarchy(li)", 10000);
    }
}
function handleServerResponseHierarchyArtigoWithCapitulo(li, options, name) {
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200) {            
            xmlResponse = xmlHttp.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            
            if (message != "0") {
                add_item_article(li, options, name, message);
            }
        }
    }
}

function get_hierarchy_artigo_with_seccao(li, options) {
    var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
    var xmlHttp = CreateXmlHttpRequestObject();
    if (xmlHttp.readyState == 0 || xmlHttp.readystate == 4) {
        var next_hierarchy_name = [];
        next_hierarchy_name[0] = "artigo";
        next_hierarchy_name[1] = "Artigo";
        if (li.parent().parent().parent().parent().attr('id') == "subtitulo") {
            xmlHttp.open("GET", "http://localhost/BasicSite/model_get_main_values/get_hierarchy_artigo_with_seccao?doc=" + doc + "&livro=" + li.parent().parent().parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&titulo=" + li.parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&subtitulo=" + li.parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&capitulo=" + li.parent().parent().attr('data-id') +
                                                                                                       "&seccao=" + li.attr('data-id'), true);
        } else {
            xmlHttp.open("GET", "http://localhost/BasicSite/model_get_main_values/get_hierarchy_artigo_with_seccao_no_subtitulo?doc=" + doc + "&livro=" + li.parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&titulo=" + li.parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&capitulo=" + li.parent().parent().attr('data-id') +
                                                                                                       "&seccao=" + li.attr('data-id'), true);
        }
        xmlHttp.onreadystatechange = function () {
            handleServerResponseHierarchyArtigoWithSeccao(li, options, next_hierarchy_name);
        };
        xmlHttp.send(null);
    } else {
        setTimeout("get_next_hierarchy(li)", 10000);
    }
}
function handleServerResponseHierarchyArtigoWithSeccao(li, options, name) {
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200) {            
            xmlResponse = xmlHttp.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            
            if (message != "0") {                
                add_item_article(li, options, name, message);
            }
        }
    }
}

function get_hierarchy_artigo_with_subseccao(li, options) {
        var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
    var xmlHttp = CreateXmlHttpRequestObject();
    if (xmlHttp.readyState == 0 || xmlHttp.readystate == 4) {
        var next_hierarchy_name = [];
        next_hierarchy_name[0] = "artigo";
        next_hierarchy_name[1] = "Artigo";
        if (li.parent().parent().parent().parent().parent().parent().attr('id') == "subtitulo") {
            xmlHttp.open("GET", "http://localhost/BasicSite/model_get_main_values/get_hierarchy_artigo_with_subseccao?doc=" + doc + "&livro=" + li.parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&titulo=" + li.parent().parent().parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&subtitulo=" + li.parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&capitulo=" + li.parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&seccao=" + li.parent().parent().attr('data-id') +
                                                                                                       "&subseccao=" + li.attr('data-id'), true);
        } else {
            xmlHttp.open("GET", "http://localhost/BasicSite/model_get_main_values/get_hierarchy_artigo_with_subseccao_no_subtitulo?doc=" + doc + "&livro=" + li.parent().parent().parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&titulo=" + li.parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&capitulo=" + li.parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&seccao=" + li.parent().parent().attr('data-id') +
                                                                                                       "&subseccao=" + li.attr('data-id'), true);
        }
        xmlHttp.onreadystatechange = function () {
            handleServerResponseHierarchyArtigoWithSubseccao(li, options, next_hierarchy_name);
        };
        xmlHttp.send(null);
    } else {
        setTimeout("get_next_hierarchy(li)", 10000);
    }
}
function handleServerResponseHierarchyArtigoWithSubseccao(li, options, name) {
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200) {
            xmlResponse = xmlHttp.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            if (message != "0") {                
                add_item_article(li, options, name, message);
            }
        }
    }
}

function get_hierarchy_artigo_with_divisao(li, options) {
        var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
    var xmlHttp = CreateXmlHttpRequestObject();
    if (xmlHttp.readyState == 0 || xmlHttp.readystate == 4) {
        var next_hierarchy_name = [];
        next_hierarchy_name[0] = "artigo";
        next_hierarchy_name[1] = "Artigo";
        if (li.parent().parent().parent().parent().parent().parent().parent().parent().attr('id') == "subtitulo") {
            xmlHttp.open("GET", "http://localhost/BasicSite/model_get_main_values/get_hierarchy_artigo_with_divisao?doc=" + doc + "&livro=" + li.parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&titulo=" + li.parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&subtitulo=" + li.parent().parent().parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&capitulo=" + li.parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&seccao=" + li.parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&subseccao=" + li.parent().parent().attr('data-id') +
                                                                                                       "&divisao=" + li.attr('data-id'), true);
        } else {
            xmlHttp.open("GET", "http://localhost/BasicSite/model_get_main_values/get_hierarchy_artigo_with_divisao_no_subtitulo?doc=" + doc + "&livro=" + li.parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&titulo=" + li.parent().parent().parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&capitulo=" + li.parent().parent().parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&seccao=" + li.parent().parent().parent().parent().attr('data-id') +
                                                                                                       "&subseccao=" + li.parent().parent().attr('data-id') +
                                                                                                       "&divisao=" + li.attr('data-id'), true);
        }
        xmlHttp.onreadystatechange = function () {
            handleServerResponseHierarchyArtigoWithDivisao(li, options, next_hierarchy_name);
        };
        xmlHttp.send(null);
    } else {
        setTimeout("get_next_hierarchy(li)", 10000);
    }
}
function handleServerResponseHierarchyArtigoWithDivisao(li, options, name) {
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200) {            
            xmlResponse = xmlHttp.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            
            if (message != "0") {
                add_item_article(li, options, name, message);
            }
        }
    }
}
function handleServerResponseHierarchyArtigoWithSubdivisao(li, options, name) {
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200) {            
            xmlResponse = xmlHttp.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            
            if (message != "0") {
                add_item_article(li, options, name, message);
            }
        }
    }
}

function add_item(li, options, name, message) {
    li.children(options.listNodeName).empty();
    var splited_message = message.split("_");
    for (i = 0; i < splited_message.length; i++) {
        var id_text = splited_message[i].split("$");
        var title_text = id_text[1].split("#");
        var text = "";
        var text_color = null;
        for ($j = 1; $j < title_text.length; $j++) {
            text_color = title_text[$j].split("«");
            if (text_color.length >= 2) {
                if (text_color[1] == "yellow") {
                    text_color[1] = "#2691FE";
                } else if (text_color[1] == "red") {
                    text_color[1] = "#881102";
                } else if (text_color[1] == "green") {
                    text_color[1] = "#106912";
                } else {
                    text_color[1] = "#000000";
                }
                text += '<div style="color:' + text_color[1] + ';">' + text_color[0] + '</div>';
            } else {
                text += title_text[$j] + '<br>';
            }
        }
        var truncated_name = title_text[0];
        if (id_text[0].length > 45) {
            truncated_name = id_text[0].substring(0, 45);
            truncated_name += "...";
            li.children(options.listNodeName).append('<li class="dd-item" id="' + name[0] + '"data-id="' + (i + 1) +
                    '"><div class="dd-handle"><ul id="item_menu">' +
                    '<li><div class="circle"><a></a></div><ul class="sub_item_menu">' +
                    '<li><button type="button" class="button_menu_item" onClick="">Criar LaTeX</button>' +
                    '<button type="button" class="button_menu_item" onClick="">Partilhar</button></li>' +
                    '</ul></li></ul>' + name[1] + ':' + id_text[0] +
                    ' - <span style="font-weight: bold;" title="' + title_text[0] + '">' + truncated_name + '</span></div><ol class="dd-list">' + text + '</ol></li>');
        } else {
            li.children(options.listNodeName).append('<li class="dd-item" id="' + name[0] + '"data-id="' + (i + 1) +
                    '"><div class="dd-handle"><ul id="item_menu">' +
                    '<li><div class="circle"><a></a></div><ul class="sub_item_menu">' +
                    '<li><button type="button" class="button_menu_item" onClick="">Criar LaTeX</button>' +
                    '<button type="button" class="button_menu_item" onClick="">Partilhar</button></li>' +
                    '</ul></li></ul>' + name[1] + ':' + id_text[0] +
                    ' - ' + truncated_name + '</div><ol class="dd-list">' + text + '</ol></li>');
        }
        if (li.children(options.listNodeName).length) {
            li.children(options.listNodeName).children('li').eq(i).prepend($(options.expandBtnHTML));
            li.children(options.listNodeName).children('li').eq(i).prepend($(options.collapseBtnHTML));
        }
        li.children(options.listNodeName).children('li').eq(i).children('[data-action="collapse"]').hide();
            
        $(function() {
            $('#item_menu li').find('.sub_item_menu').hide();
            $('#item_menu li').hover(function() {
                $(this).find('.sub_item_menu').fadeIn(100);
            }, function() {
                $(this).find('.sub_item_menu').fadeOut(50);
            });
        });
    }
}
function add_item_article(li, options, name, message) {
    li.children(options.listNodeName).empty();
    var splited_message = message.split("_");
    for (i = 0; i < splited_message.length; i++) {
        var id_text = splited_message[i].split("$");
        var title_text = id_text[1].split("#");
        var text = "";
        var text_color = null;
        for ($j = 1; $j < title_text.length; $j++) {
            text_color = title_text[$j].split("«");
            if (text_color.length >= 2) {
                if (text_color[1] == "yellow") {
                    text_color[1] = "#2691FE";
                } else if (text_color[1] == "red") {
                    text_color[1] = "#881102";
                } else if (text_color[1] == "green") {
                    text_color[1] = "#106912";
                } else {
                    text_color[1] = "#000000";
                }
                text += '<div style="color:' + text_color[1] + ';">' + text_color[0] + '</div>';
            } else {
                text += title_text[$j] + '<br>';
            }
        }
        var truncated_name = title_text[0];
        if (id_text[0].length > 45) {
            truncated_name = id_text[0].substring(0, 45);
            truncated_name += "...";
            li.children(options.listNodeName).append('<li class="dd-item" id="' + name[0] + '"data-id="' + id_text[0] +
                    '"><div class="dd-handle"><ul id="item_menu">' +
                    '<li><div class="circle"><a></a></div><ul class="sub_item_menu">' +
                    '<li><button type="button" class="button_menu_item" onClick="">Criar LaTeX</button>' +
                    '<button type="button" class="button_menu_item" onClick="">Partilhar</button>' +
                    '<button type="button" class="button_menu_item" onClick="alteration(this)">Modificar</button>' +
                    '<button type="button" class="button_menu_item" onClick="show_evolution(this)">Ver Evolução</button></li>' +
                    '</ul></li></ul>' + name[1] + ':' + id_text[0] +
                    ' - <span style="font-weight: bold;" title="' + title_text[0] + '">' + truncated_name + '</span></div><ol class="dd-list">' + text + '</ol></li>');
        } else {
            li.children(options.listNodeName).append('<li class="dd-item" id="' + name[0] + '"data-id="' + id_text[0] +
                    '"><div class="dd-handle"><ul id="item_menu">' +
                    '<li><div class="circle"><a></a></div><ul class="sub_item_menu">' +
                    '<li><button type="button" class="button_menu_item" onClick="">Criar LaTeX</button>' +
                    '<button type="button" class="button_menu_item" onClick="">Partilhar</button>' +
                    '<button type="button" class="button_menu_item" onClick="alteration(this)">Modificar</button>' +
                    '<button type="button" class="button_menu_item" onClick="show_evolution(this)">Ver Evolução</button></li>' +
                    '</ul></li></ul>' + name[1] + ':' + id_text[0] +
                    ' - ' + truncated_name + '</div><ol class="dd-list">' + text + '</ol></li>');
        }
        if (li.children(options.listNodeName).length) {
            li.children(options.listNodeName).children('li').eq(i).prepend($(options.expandBtnHTML));
            li.children(options.listNodeName).children('li').eq(i).prepend($(options.collapseBtnHTML));
        }
        li.children(options.listNodeName).children('li').eq(i).children('[data-action="expand"]').hide();
        
        $(function() {
            $('#item_menu li').find('.sub_item_menu').hide();
            $('#item_menu li').hover(function() {
                $(this).find('.sub_item_menu').fadeIn(100);
            }, function() {
                $(this).find('.sub_item_menu').fadeOut(50);
            });
        });
    }
}
;(function($, window, document, undefined)
{
    var hasTouch = 'ontouchstart' in window;
    
    var hasPointerEvents = (function()
    {
        var el    = document.createElement('div'),
            docEl = document.documentElement;
        if (!('pointerEvents' in el.style)) {
            return false;
        }
        el.style.pointerEvents = 'auto';
        el.style.pointerEvents = 'x';
        docEl.appendChild(el);
        var supports = window.getComputedStyle && window.getComputedStyle(el, '').pointerEvents === 'auto';
        docEl.removeChild(el);
        return !!supports;
    })();

    var eStart  = hasTouch ? 'touchstart'  : 'mousedown',
        eMove   = hasTouch ? 'touchmove'   : 'mousemove',
        eEnd    = hasTouch ? 'touchend'    : 'mouseup';
        eCancel = hasTouch ? 'touchcancel' : 'mouseup';

    var defaults = {
            listNodeName    : 'ol',
            itemNodeName    : 'li',
            rootClass       : 'dd',
            listClass       : 'dd-list',
            itemClass       : 'dd-item',
            dragClass       : 'dd-dragel',
            handleClass     : 'dd-handle',
            collapsedClass  : 'dd-collapsed',
            placeClass      : 'dd-placeholder',
            noDragClass     : 'dd-nodrag',
            emptyClass      : 'dd-empty',
            expandBtnHTML   : '<button data-action="expand" type="button">Expand</button>',
            collapseBtnHTML : '<button data-action="collapse" type="button">Collapse</button>',
            menuBtnHTML     : '<button data-action="menu" type="button">Menu</button>',
            group           : 0,
            maxDepth        : 5,
            threshold       : 20
        };

    function Plugin(element, options)
    {
        this.w  = $(window);
        this.el = $(element);
        this.options = $.extend({}, defaults, options);
        this.init();
    }

    Plugin.prototype = {

        init: function()
        {
            var list = this;

            list.reset();

            list.el.data('nestable-group', this.options.group);

            list.placeEl = $('<div class="' + list.options.placeClass + '"/>');

            $.each(this.el.find(list.options.itemNodeName), function(k, el) {
                list.setParent($(el));
            });

            list.el.on('click', 'button', function(e) {
                if (list.dragEl || (!hasTouch && e.button !== 0)) {
                    return;
                }
                var target = $(e.currentTarget),
                    action = target.data('action'),
                    item   = target.parent(list.options.itemNodeName);
                if (action === 'collapse') {
                    list.collapseItem(item);
                }
                if (action === 'expand') {
                    list.expandItem(item);
                }
                if (action === 'menu') {
                    list.menu(item);
                }
            });
            
            list.el.on('click', function(e) {
            });
        },

        serialize: function()
        {
            var data,
                depth = 0,
                list  = this;
                step  = function(level, depth)
                {
                    var array = [ ],
                        items = level.children(list.options.itemNodeName);
                    items.each(function()
                    {
                        var li   = $(this),
                            item = $.extend({}, li.data()),
                            sub  = li.children(list.options.listNodeName);
                        if (sub.length) {
                            item.children = step(sub, depth + 1);
                        }
                        array.push(item);
                    });
                    return array;
                };
            data = step(list.el.find(list.options.listNodeName).first(), depth);
            return data;
        },

        serialise: function()
        {
            return this.serialize();
        },

        reset: function()
        {
            this.mouse = {
                offsetX   : 0,
                offsetY   : 0,
                startX    : 0,
                startY    : 0,
                lastX     : 0,
                lastY     : 0,
                nowX      : 0,
                nowY      : 0,
                distX     : 0,
                distY     : 0,
                dirAx     : 0,
                dirX      : 0,
                dirY      : 0,
                lastDirX  : 0,
                lastDirY  : 0,
                distAxX   : 0,
                distAxY   : 0
            };
            this.moving     = false;
            this.dragEl     = null;
            this.dragRootEl = null;
            this.dragDepth  = 0;
            this.hasNewRoot = false;
            this.pointEl    = null;
        },

        expandItem: function(li)
        {
            li.removeClass(this.options.collapsedClass);
            li.children('[data-action="expand"]').hide();
            li.children('[data-action="collapse"]').show();
            li.children(this.options.listNodeName).show();
            get_next_hierarchy(li, this.options);
        },

        collapseItem: function(li)
        {
            var lists = li.children(this.options.listNodeName);
            if (lists.length) {
                li.addClass(this.options.collapsedClass);
                li.children('[data-action="collapse"]').hide();
                li.children('[data-action="expand"]').show();
                li.children(this.options.listNodeName).hide();
            }
        },

        menu: function(li)
        {
            var lists = li.children(this.options.listNodeName);
            if (lists.length) {
                li.addClass(this.options.collapsedClass);
                li.children('[data-action="collapse"]').hide();
                li.children('[data-action="expand"]').show();
                li.children(this.options.listNodeName).hide();
            }
        },

        expandAll: function()
        {
            var list = this;
            list.el.find(list.options.itemNodeName).each(function() {
                list.expandItem($(this));
            });
        },

        collapseAll: function()
        {
            var list = this;
            list.el.find(list.options.itemNodeName).each(function() {
                list.collapseItem($(this));
            });
        },

        setParent: function(li)
        {
            if (li.children(this.options.listNodeName).length) {
                li.prepend($(this.options.expandBtnHTML));
                li.prepend($(this.options.collapseBtnHTML));
            }
            li.children('[data-action="collapse"]').hide();
        },

        unsetParent: function(li)
        {
            li.removeClass(this.options.collapsedClass);
            li.children('[data-action]').remove();
            li.children(this.options.listNodeName).remove();
        }
    };

    $.fn.nestable = function(params)
    {
        var lists  = this,
            retval = this;

        lists.each(function()
        {
            var plugin = $(this).data("nestable");

            if (!plugin) {
                $(this).data("nestable", new Plugin(this, params));
                $(this).data("nestable-id", new Date().getTime());
            } else {
                if (typeof params === 'string' && typeof plugin[params] === 'function') {
                    retval = plugin[params]();
                }
            }
        });

        return retval || lists;
    };

})(window.jQuery || window.Zepto, window, document);