var xmlHttp = null;

$(function() {
    $('#item_menu li').find('.sub_item_menu').hide();
    $('#item_menu li').hover(function() {
        $(this).find('.sub_item_menu').fadeIn(100);
    }, function() {
        $(this).find('.sub_item_menu').fadeOut(50);
    });
});

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
                    $('#nestable').children('ol').children('li').eq(i).append('<div class="dd-handle"><ul id="item_menu">' +
                            '<li><div class="circle"><a></a></div><ul class="sub_item_menu">' +
                            '<li><button type="button" class="button_menu_item" onClick="">Criar LaTeX</button>' +
                            '<button type="button" class="button_menu_item" onClick="">Partilhar</button></li>' +
                            '</ul></li></ul>Livro:' + id_name[0] + ' - <span style="font-weight: bold;" title="' + id_name[1] + '">' + truncated_name + '</span></div><ol class="dd-list"></ol></li>');
                    $('#nestable').children('ol').children('li').eq(i).append('<ol class="dd-list"></ol>');
                    $('#nestable').children('ol').append('</li>');
                } else {
                    $('#nestable').children('ol').append('<li class="dd-item" id="livro"data-id="' + (i+1) + '">');
                    $('#nestable').children('ol').children('li').eq(i).append('<div class="dd-handle"><ul id="item_menu">' +
                            '<li><div class="circle"><a></a></div><ul class="sub_item_menu">' +
                            '<li><button type="button" class="button_menu_item" onClick="">Criar LaTeX</button>' +
                            '<button type="button" class="button_menu_item" onClick="">Partilhar</button></li>' +
                            '</ul></li></ul>Livro:' + id_name[0] + ' - ' + truncated_name + '</div>');
                    $('#nestable').children('ol').children('li').eq(i).append('<ol class="dd-list"></ol>');
                    $('#nestable').children('ol').append('</li>');
                }
                if ($('#nestable').children('ol').length) {
                    $('#nestable').children('ol').children('li').eq(i).prepend('<button data-action="expand" type="button">Expand</button>');
                    $('#nestable').children('ol').children('li').eq(i).prepend('<button data-action="collapse" type="button">Collapse</button>');
                }
                $('#nestable').children('ol').children('li').eq(i).children('[data-action="collapse"]').hide();
                
                $(function() {
                    $('#item_menu li').find('.sub_item_menu').hide();
                    $('#item_menu li').hover(function() {
                        $(this).find('.sub_item_menu').fadeIn(100);
                    }, function() {
                        $(this).find('.sub_item_menu').fadeOut(50);
                    });
                });
            }
            $('#nestable').append('</ol>');
            
            get_doc_title();
        }
    }
}

function check_doc_revoke() {
    var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
    var xmlHttp = CreateXmlHttpRequestObject();
    if (xmlHttp.readyState == 0 || xmlHttp.readystate == 4) {
        xmlHttp.open("GET", "http://localhost/BasicSite/model_get_main_values/was_doc_revoked_get_names?doc=" + doc, true);
        xmlHttp.onreadystatechange = handleServerResponseDocRevoke;
        xmlHttp.send(null);
    } else {
        setTimeout("check_doc_revoke", 10000);
    }
}
function handleServerResponseDocRevoke() {
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200) {            
            xmlResponse = xmlHttp.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            
            $('.alert').remove();
            if (message != "0") {
                docs = message.split("$");
                if (docs.length >= 2) {
                    $('#main_area').children().prepend('<p class="alert">Este documento for revogado integralmente pelo documento com a data ' + docs[1].replace("_", "-").replace("_", "-") + '</p>');
                }
            }
        }
    }
}

function get_doc_title() {
    var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
    var xmlHttp = CreateXmlHttpRequestObject();
    if (xmlHttp.readyState == 0 || xmlHttp.readystate == 4) {
        xmlHttp.open("GET", "http://localhost/BasicSite/model_get_main_values/get_doc_title?doc=" + doc, true);
        xmlHttp.onreadystatechange = handleServerResponseGetDocTitle;
        xmlHttp.send(null);
    } else {
        setTimeout("get_doc_title", 10000);
    }
}
function handleServerResponseGetDocTitle() {
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200) {            
            xmlResponse = xmlHttp.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            
            $('.dd_title').remove();
            if (message != "0") {
                var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
                $('.dd').prepend('<table id="doc_titulo"><tr><td><div class="dd-title">' + message + ' : ' + doc.replace("_", "-").replace("_", "-") + 
                                 '</div></div></td><td><button type="button" onclick="show_document()">Ver apenas documento</button></td></tr></table>');
            }
            var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
            
            check_doc_revoke();
        }
    }
}

function show_evolution(el) {
    var numero = $(el).parent().parent().parent().parent().parent().parent().attr('data-id');
    var split = window.location.pathname.split("/");
    window.location.replace(window.location.protocol + "//" + window.location.host + "/" + split[1] + "/main_program/evolucao?artigo=" + numero);
}

function show_document() {
    var td = $('#doc_titulo tr').find("td:first .dd-title").html();
    var nome_data = td.split(":");
    var nome = nome_data[0].trim();
    var data = nome_data[1].trim();
    var split = window.location.pathname.split("/");
    window.location.replace(window.location.protocol + "//" + window.location.host + "/" + split[1] + "/main_program/ver_document?nome=" + nome + "&data=" + data.replace("-", "_").replace("-", "_"));
}

function alteration(el) {
    var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].text;
    var numero = $(el).parent().parent().parent().parent().parent().parent().attr('data-id');
    var split = window.location.pathname.split("/");
    window.location.replace(window.location.protocol + "//" + window.location.host + "/" + split[1] + "/main_program/alteration?artigo=" + numero);
}

function validate_alteration() {
    var l_lines = $('#left_area').val().split('\n');
    var r_lines = $('#right_area').val().split('\n');
    
    left_lines = [];
    right_lines = [];
    j=0;
    for (i=0; i<l_lines.length; i++) {
        l_string = new String(l_lines[i]);
        if (l_string.length > 0 && l_string.trim().length != 0) {
            left_lines[j] = l_lines[i];
            j++;
        }
    }
    j=0;
    for (i=0; i<r_lines.length; i++) {
        r_string = new String(r_lines[i]);
        if (r_string.length > 0 && r_string.trim().length != 0) {
            right_lines[j] = r_lines[i];
            j++;
        }
    }
    
    left_count = 1;
    right_count = 1;
    for_size = (left_lines.length > right_lines.length) ? left_lines.length-1 : right_lines.length-1;
    output = [];
    
    if (right_lines.length <= 1) {
        output[0] = "revogado";
    } else {
        output[0] = right_lines[0];
        if (left_lines.length <= 2) {
            for (var i=1; i<right_lines.length; i++) {
                left_string = new String(left_lines[i]);
                right_string = new String(right_lines[i]);
                alert(left_string + "   -   " + right_string);
                if (typeof left_lines[i] === "undefined") {
                    output[i] = right_string + "   verde";
                } else if (left_string.trim() != right_string.trim()) {
                    output[i] = right_string + "   amarelo";
                } else {
                    output[i] = "...";
                }
            }
        } 
    }
    
    for (var i=0; i<output.length; i++) {
        alert(output[i]);
    }
}

//function validate_alteration() {
//    var left_lines = $('#left_area').val().split('\n');
//    for(var i=0; i<left_lines.length; i++) {
//        
//    }
//    var right_lines = $('#right_area').val().split('\n');
//    for(var i=0; i<right_lines.length; i++) {
//    }
//    
//    left_count = 1;
//    right_count = 1;
//    for_size = (left_lines.length > right_lines.length) ? left_lines.length-1 : right_lines.length-1;
//    for_count = 0;
//    output = [];
//    
//    if (right_lines.length <= 1) {
//        output[0] = "revogado";
//    } else {
//        output[0] = right_lines[0];
//        for (var i=1; i<for_size; i++) {
//            left_string = new String(left_lines[left_count]);
//            right_string = new String(right_lines[right_count]);
//            
//            if (typeof right_lines[right_count] === "undefined") {
//                output[for_count] = left_lines[left_count] + " a vermelho";
//                left_count++; right_count++; for_count++;
//            } else if (typeof left_lines[left_count] === "undefined") {
//                output[for_count] = right_lines[right_count] + " a verde";
//                left_count++; right_count++; for_count++;
//            } else {
//                if (left_string.trim() == right_string.trim()) {
//                    if (right_string.trim().match("/'/[0-9]*\./'/") == 0 && right_string.trim().match("/'/[a-z]*\./'/") == 0) {
//                        output[for_count] = right_string.trim() + " ...";
//                        left_count++; right_count++;
//                    } else {
//                        output[for_count] = right_string.trim().substring(0, 2) + " ...";
//                        left_count++; right_count++;
//                    }
//                    for_count++;
//                } else {
////                    if (right_string.trim().match("/'/[0-9]*\./'/") == 0 && right_string.trim().match("/'/[a-z]*\./'/") == 0) {
////                        if (right_string.trim().substring(0, 2) == left_string.trim().substring(0, 2)) {
////                            output[for_count] = right_string.trim() + " a amarelo";
////                            left_count++; right_count++;
////                        } else {
////                            output[for_count] = left_string.trim() + " a vermelho";
////                            left_count++;
////                        }
////                        for_count++;
//                    /*} else*/ if (right_string.trim().match("/'/[0-9]*\./'/") != 0) {
//                        alert(parseInt(right_string.trim().substring(0, 1)));
//                        alert(parseInt(left_string.trim().substring(0, 1)));
//                        if (parseInt(right_string.trim().substring(0, 1)) > parseInt(left_string.trim().substring(0, 1))) {
//                            output[for_count] = left_string.trim() + " a vermelho";
//                            left_count++;
//                        } else {
//                            output[for_count] = right_string.trim() + " a amarelo";
//                            right_count++;
//                            left_count++;
//                        }
//                        for_count++;
//                    } else if (right_string.trim().match("/'/[a-z]*\./'/") != 0) {
//                        alert(right_string.trim().substring(0, 1));
//                        alert(left_string.trim().substring(0, 1));
//                        if (right_string.trim().substring(0, 1) > left_string.trim().substring(0, 1)) {
//                            output[for_count] = left_string.trim() + " a vermelho";
//                            left_count++;
//                        } else {
//                            output[for_count] = right_string.trim() + " a amarelo";
//                            right_count++;
//                            left_count++;
//                        }
//                        for_count++;
//                    } else {
//                        alert("jh");
//                        output[for_count] = right_string.trim() + " a amarelo";
//                        left_count++; right_count++;
//                        for_count++;
//                    }
//                }
//            }
//        }
//    }
//    
//    for (var i=0; i<for_count; i++) {
//        alert(output[i]);
//    }
//}