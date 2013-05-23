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

function change_hierarchy() {
    var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
    var xmlHttp = CreateXmlHttpRequestObject();
    if (xmlHttp.readyState == 0 || xmlHttp.readystate == 4) {
        xmlHttp.open("GET", "http://localhost/BasicSite/model_get_main_values/get_hierarchy_livro?doc=" + doc, true);
        xmlHttp.onreadystatechange = handleServerResponseHierarchyLivro;
        xmlHttp.send(null);
    } else {
        setTimeout("change_hierarchy()", 10000);
    }
}
function handleServerResponseHierarchyLivro() {
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200) {            
            xmlResponse = xmlHttp.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            
            if (message != "0") {
                alert(message);
                $('#nestable').empty();
                $('#nestable').append('<ol class="dd-list">');
                
                var splited_message = message.split("_");
                for (i=0; i<splited_message.length; i++) {
                    var id_name = splited_message[i].split("$");
                    var truncated_name = id_name[1];
                    if (id_name[1].length > 45) {
                        truncated_name = id_name[1].substring(0, 45);
                        truncated_name += "...";
                        $('#nestable').children('ol').append('<li class="dd-item" id="livro"data-id="' + (i+1) + '">');
                        $('#nestable').children('ol').children('li').eq(i).append('<div class="dd-handle">Livro:' + id_name[0] + ' - <span style="font-weight: bold;" title="' + id_name[1] + '">' + truncated_name + '</span></div><ol class="dd-list"></ol></li>');
                        $('#nestable').children('ol').children('li').eq(i).append('<ol class="dd-list"></ol>');
                        $('#nestable').children('ol').append('</li>');
                    } else {
                        $('#nestable').children('ol').append('<li class="dd-item" id="livro"data-id="' + (i+1) + '">');
                        $('#nestable').children('ol').children('li').eq(i).append('<div class="dd-handle">Livro:' + id_name[0] + ' - ' + truncated_name + '</div>');
                        $('#nestable').children('ol').children('li').eq(i).append('<ol class="dd-list"></ol>');
                        $('#nestable').children('ol').append('</li>');
                    }
                    if ($('#nestable').children('ol').length) {
                        $('#nestable').children('ol').children('li').eq(i).prepend('<button data-action="expand" type="button">Expand</button>');
                        $('#nestable').children('ol').children('li').eq(i).prepend('<button data-action="collapse" type="button">Collapse</button>');
                    }
                    $('#nestable').children('ol').children('li').eq(i).children('[data-action="collapse"]').hide();
                }
                $('#nestable').append('</ol>');
            }
        }
    }
}