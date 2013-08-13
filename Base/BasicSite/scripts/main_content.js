var xmlHttp = null;

$(function() {
    $('#item_menu li').find('.sub_item_menu').hide();
    $('#item_menu li').hover(function() {
        $(this).find('.sub_item_menu').fadeIn(100);
    }, function() {
        $(this).find('.sub_item_menu').fadeOut(50);
    });
});

$( document ).ready(function() {
    $.fn.invisible = function() {
        return this.css("visibility", "hidden");
    };
    $.fn.visible = function() {
        return this.css("visibility", "visible");
    };
});

function CreateXmlHttpRequestObject() {   
    if (window.XMLHttpRequest) {
        xmlHttp = new XMLHttpRequest();
    }else if (window.ActiveXObject) {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    } else {
        xmlHttp = false;
    }
    return xmlHttp;
}

function change_hierarchy() {
    alert(document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].value);
    var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].value;
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
    var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].value;
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
            
            $('.//alert').remove();
            if (message != "0") {
                docs = message.split("$");
                if (docs.length >= 2) {
                    $('#main_area').children().prepend('<p class="//alert">Este documento for revogado integralmente pelo documento com a data ' + docs[1].replace("_", "-").replace("_", "-") + '</p>');
                }
            }
        }
    }
}

function get_doc_title() {
    var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].value;
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
                var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].value;
                $('.dd').prepend('<table id="doc_titulo"><tr><td><div class="dd-title">' + message + ' : ' + doc.replace("_", "-").replace("_", "-") + 
                                 '</div></div></td><td><button type="button" onclick="show_document()">Ver apenas documento</button></td></tr></table>');
            }
            var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].value;
            
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

function blass() {
    //alert("#");
}

function clearOptionsFast() {
    var selectObj = document.getElementById('mdd_article_alteration');
    var selectParentNode = selectObj.parentNode;
    var newSelectObj = selectObj.cloneNode(false);
    selectParentNode.replaceChild(newSelectObj, selectObj);
    var selectObj2 = document.getElementById('mdd_article_addition');
    var selectParentNode2 = selectObj2.parentNode;
    var newSelectObj2 = selectObj2.cloneNode(false);
    selectParentNode2.replaceChild(newSelectObj2, selectObj2);
    var selectObj3 = document.getElementById('mdd_article_revoke');
    var selectParentNode3 = selectObj3.parentNode;
    var newSelectObj3 = selectObj3.cloneNode(false);
    selectParentNode3.replaceChild(newSelectObj3, selectObj3);
}

function display_table_alteration() {
    this.clearOptionsFast();
    this.get_articles();
    document.getElementById('id_table_alteration').style.visibility = 'visible';
}

function create_table_alteration() {
    this.clearOptionsFast();
    if (document.getElementById('new_doc_name').value != "" && document.getElementById('new_doc_data').value != "") {
        this.put_doc_in_db();
        
    }
    document.getElementById('id_table_alteration').style.visibility = 'visible';
}

function add_article_alt() {    
    var doc = document.getElementById('dd_doc_alteration').options[document.getElementById('dd_doc_alteration').selectedIndex].text;
    var filter = doc.split("(");
    var filter2 = filter[1].split(")");
    var doc_res = filter2[0].replace("/", "_").replace("/", "_");
    var dia_mes_ano = doc_res.split("_");
    var res = String(dia_mes_ano[2] + "_" + dia_mes_ano[1] + "_" + dia_mes_ano[0]);
    var split = window.location.pathname.split("/");
    window.location.replace(window.location.protocol + "//" + window.location.host + "/" + split[1] + "/backend/add_doc_alt?doc=" + res + "&artigo=1");
}

function alt_article_alt() {    
    var art = document.getElementById('mdd_article_alteration').value;
    var doc = document.getElementById('dd_doc_alteration').options[document.getElementById('dd_doc_alteration').selectedIndex].text;
    var filter = doc.split("(");
    var filter2 = filter[1].split(")");
    var doc_res = filter2[0].replace("/", "_").replace("/", "_");
    var dia_mes_ano = doc_res.split("_");
    var res = String(dia_mes_ano[2] + "_" + dia_mes_ano[1] + "_" + dia_mes_ano[0]);
    var split = window.location.pathname.split("/");
    if (art.length > 0) {
        window.location.replace(window.location.protocol + "//" + window.location.host + "/" + split[1] + "/backend/alt_doc_alt?doc=" + res + "&artigo=" + art);
    }
}

function rem_article_alt() {    
    var art = document.getElementById('mdd_article_alteration').value;
    var doc = document.getElementById('dd_doc_alteration').options[document.getElementById('dd_doc_alteration').selectedIndex].text;
    var filter = doc.split("(");
    var filter2 = filter[1].split(")");
    var doc_res = filter2[0].replace("/", "_").replace("/", "_");
    var dia_mes_ano = doc_res.split("_");
    var res = String(dia_mes_ano[2] + "_" + dia_mes_ano[1] + "_" + dia_mes_ano[0]);
    
    output = [];
    output[0] = art;
    output[1] = res;
    
    if (art.length > 0) {
        if (confirm("Tem a certeza?")) {
            var jsonString = JSON.stringify(output);
            $.ajax({
                type: "POST",
                url: "http://localhost/BasicSite/model_save_file/save_rem_alteration_file",
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
}

function add_article_add() {    
    var doc = document.getElementById('dd_doc_alteration').options[document.getElementById('dd_doc_alteration').selectedIndex].text;
    var filter = doc.split("(");
    var filter2 = filter[1].split(")");
    var doc_res = filter2[0].replace("/", "_").replace("/", "_");
    var dia_mes_ano = doc_res.split("_");
    var res = String(dia_mes_ano[2] + "_" + dia_mes_ano[1] + "_" + dia_mes_ano[0]);
    var split = window.location.pathname.split("/");
    window.location.replace(window.location.protocol + "//" + window.location.host + "/" + split[1] + "/backend/add_doc_add?doc=" + res);
}

function alt_article_add() {
    var art = document.getElementById('mdd_article_addition').value;
    var doc = document.getElementById('dd_doc_alteration').options[document.getElementById('dd_doc_alteration').selectedIndex].text;
    var filter = doc.split("(");
    var filter2 = filter[1].split(")");
    var doc_res = filter2[0].replace("/", "_").replace("/", "_");
    var dia_mes_ano = doc_res.split("_");
    var res = String(dia_mes_ano[2] + "_" + dia_mes_ano[1] + "_" + dia_mes_ano[0]);
    var split = window.location.pathname.split("/");
    if (art.length > 0) {
        window.location.replace(window.location.protocol + "//" + window.location.host + "/" + split[1] + "/backend/alt_doc_add?doc=" + res + "&artigo=" + art);
    }
}

function rem_article_add() {    
    var art = document.getElementById('mdd_article_addition').value;
    var doc = document.getElementById('dd_doc_alteration').options[document.getElementById('dd_doc_alteration').selectedIndex].text;
    var filter = doc.split("(");
    var filter2 = filter[1].split(")");
    var doc_res = filter2[0].replace("/", "_").replace("/", "_");
    var dia_mes_ano = doc_res.split("_");
    var res = String(dia_mes_ano[2] + "_" + dia_mes_ano[1] + "_" + dia_mes_ano[0]);
    
    output = [];
    output[0] = art;
    output[1] = res;
    
    if (art.length > 0) {
        if (confirm("Tem a certeza?")) {
            var jsonString = JSON.stringify(output);
            $.ajax({
                type: "POST",
                url: "http://localhost/BasicSite/model_save_file/save_rem_addition_file",
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
}

function add_article_rem() {    
    var doc = document.getElementById('dd_doc_alteration').options[document.getElementById('dd_doc_alteration').selectedIndex].text;
    var filter = doc.split("(");
    var filter2 = filter[1].split(")");
    var doc_res = filter2[0].replace("/", "_").replace("/", "_");
    var dia_mes_ano = doc_res.split("_");
    var res = String(dia_mes_ano[2] + "_" + dia_mes_ano[1] + "_" + dia_mes_ano[0]);
    var split = window.location.pathname.split("/");
    window.location.replace(window.location.protocol + "//" + window.location.host + "/" + split[1] + "/backend/add_doc_rem?doc=" + res);
}

function rem_article_rem() {    
    var art = document.getElementById('mdd_article_revoke').value;
    var doc = document.getElementById('dd_doc_alteration').options[document.getElementById('dd_doc_alteration').selectedIndex].text;
    var filter = doc.split("(");
    var filter2 = filter[1].split(")");
    var doc_res = filter2[0].replace("/", "_").replace("/", "_");
    var dia_mes_ano = doc_res.split("_");
    var res = String(dia_mes_ano[2] + "_" + dia_mes_ano[1] + "_" + dia_mes_ano[0]);
    
    output = [];
    output[0] = art;
    output[1] = res;
    
    if (art.length > 0) {
        if (confirm("Tem a certeza?")) {
            var jsonString = JSON.stringify(output);
            $.ajax({
                type: "POST",
                url: "http://localhost/BasicSite/model_save_file/save_rem_remove_file",
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
}

function get_articles() {
    var doc = document.getElementById('dd_doc_alteration').options[document.getElementById('dd_doc_alteration').selectedIndex].text;
    var filter = doc.split("(");
    var filter2 = filter[1].split(")");
    var doc_res = filter2[0].replace("/", "_").replace("/", "_");
    var dia_mes_ano = doc_res.split("_");
    var res = String(dia_mes_ano[2] + "_" + dia_mes_ano[1] + "_" + dia_mes_ano[0]);
    var xmlHttp = CreateXmlHttpRequestObject();
    if (xmlHttp.readyState == 0 || xmlHttp.readystate == 4) {
        xmlHttp.open("GET", "http://localhost/BasicSite/model_get_backend_values/get_articles_given_temp_doc?doc=" + res.trim(), true);
        xmlHttp.onreadystatechange = handleServerResponseGetArticles;
        xmlHttp.send(null);
    } else {
        setTimeout("get_articles", 10000);
    }
}

function handleServerResponseGetArticles() {
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200) {
            xmlResponse = xmlHttp.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            
            splited = message.split("=");
            //alert(splited);
            alts = splited[0].split("$");
            adds = splited[1].split("$");
            revs = splited[2].split("$");
            
            if (alts.length >= 2) {
                for (i=0; i<alts.length; i++) {
                    number = alts[i].split(" - ");
                    $('#mdd_article_alteration').append($("<option/>", {
                        value: number[0],
                        text: alts[i]
                    }));
                }
            } else if (alts.length == 1) {
                number = splited[0].split(" - ");
                $('#mdd_article_alteration').append($("<option/>", {
                    value: number[0],
                    text: splited[0]
                }));
            } else {
            }
            
            if (adds.length >= 2) {
                for (i=0; i<adds.length; i++) {
                    number = adds[i].split(" - ");
                    $('#mdd_article_addition').append($("<option/>", {
                        value: number[0],
                        text: adds[i]
                    }));
                }
            } else if (adds.length == 1) {
                number = splited[1].split(" - ");
                $('#mdd_article_addition').append($("<option/>", {
                    value: number[0],
                    text: splited[1]
                }));
            } else {
            }
            
            if (revs.length >= 2) {
                for (i=0; i<revs.length; i++) {
                    number = revs[i].split(" - ");
                    $('#mdd_article_revoke').append($("<option/>", {
                        value: number[0],
                        text: revs[i]
                    }));
                }
            } else if (revs.length == 1) {
                number = splited[2].split(" - ");
                $('#mdd_article_revoke').append($("<option/>", {
                    value: number[0],
                    text: splited[2]
                }));
            } else {
            }
        }
    }
}

function put_doc_in_db() {
    nome = document.getElementById('new_doc_name').value;
    data = document.getElementById('new_doc_data').value;
    var xmlHttp = CreateXmlHttpRequestObject();
    if (xmlHttp.readyState == 0 || xmlHttp.readystate == 4) {
        xmlHttp.open("GET", "http://localhost/BasicSite/model_get_backend_values/put_doc_in_db?nome=" + nome + "&data=" + data, true);
        xmlHttp.onreadystatechange = handleServerResponseSaveDoc;
        xmlHttp.send(null);
    } else {
        setTimeout("get_articles", 10000);
    }
}

function handleServerResponseSaveDoc() {
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200) {
            xmlResponse = xmlHttp.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            if (message != "0") {
                nome = document.getElementById('new_doc_name').value;
                nome2 = document.getElementById('new_doc_name').value.replace(/ /g, "").replace(/\//g, "");
                data = document.getElementById('new_doc_data').value;
                $('#dd_doc_alteration').append($("<option/>", {
                    value: nome2,
                    text: nome + " (" + data + ")"
                }));
                var $opt = $('option[value='+ nome2 +']'); 
                $opt.attr('selected', 'selected');
                document.getElementById('new_doc_name').value = "";
                document.getElementById('new_doc_data').value = "";
            }
        }
    }
}




function add_article_alt() {
    var doc = document.getElementById('dd_doc_alteration').options[document.getElementById('dd_doc_alteration').selectedIndex].text;
    var filter = doc.split("(");
    var filter2 = filter[1].split(")");
    var doc_res = filter2[0].replace("/", "_").replace("/", "_");
    var dia_mes_ano = doc_res.split("_");
    var res = String(dia_mes_ano[2] + "_" + dia_mes_ano[1] + "_" + dia_mes_ano[0]);
    
    var split = window.location.pathname.split("/");
    window.location.replace(window.location.protocol + "//" + window.location.host + "/" + split[1] + "/backend/add_doc_alt?doc=" + res + "&artigo=1");
}

function display_change_of_article() {
    var artigo = document.getElementById('dd_choose_article').options[document.getElementById('dd_choose_article').selectedIndex].text;
    var xmlHttp = CreateXmlHttpRequestObject();
    if (xmlHttp.readyState == 0 || xmlHttp.readystate == 4) {
        xmlHttp.open("GET", "http://localhost/BasicSite/model_get_backend_values/get_full_article?artigo=" + artigo, true);
        xmlHttp.onreadystatechange = handleServerResponseDisplayChangeArticle;
        xmlHttp.send(null);
    } else {
        setTimeout("display_change_of_article", 10000);
    }
}

function handleServerResponseDisplayChangeArticle() {
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200) {
            xmlResponse = xmlHttp.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            if (message != "0") {
                document.getElementById("left_area").value = "";
                document.getElementById("right_area").value = "";
                
                splited = message.split("#");
                
                for (i=0; i<splited.length;i++) {
                    document.getElementById("left_area").value += splited[i];
                    document.getElementById("right_area").value += splited[i];
                    if (splited[0] == "revogado") {
                        document.getElementById("alteration_submit").disabled = true;
                        return;
                    } else {
                        document.getElementById("alteration_submit").disabled = false;
                    }
                }
            }
        }
    }
}

function display_change_of_article_on_remove() {
    var artigo = document.getElementById('dd_choose_article').options[document.getElementById('dd_choose_article').selectedIndex].text;
    var xmlHttp = CreateXmlHttpRequestObject();
    if (xmlHttp.readyState == 0 || xmlHttp.readystate == 4) {
        xmlHttp.open("GET", "http://localhost/BasicSite/model_get_backend_values/get_full_article?artigo=" + artigo, true);
        xmlHttp.onreadystatechange = handleServerResponseDisplayChangeArticleOnRemove;
        xmlHttp.send(null);
    } else {
        setTimeout("display_change_of_article_on_remove", 10000);
    }
}

function handleServerResponseDisplayChangeArticleOnRemove() {
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200) {
            xmlResponse = xmlHttp.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            if (message != "0") {
                document.getElementById("text_area").value = "";
                
                splited = message.split("#");
                
                for (i=0; i<splited.length;i++) {
                    document.getElementById("text_area").value += splited[i];
                    if (splited[0] == "revogado") {
                        document.getElementById("remove_submit").disabled = true;
                        return;
                    } else {
                        document.getElementById("remove_submit").disabled = false;
                    }
                }
            }
        }
    }
}





function alteration(el) {
    var doc = document.getElementById('dd_data_doc').options[document.getElementById('dd_data_doc').selectedIndex].value;
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
    left_ids = [[]];
    right_ids = [[]];
    output = [];
    letters = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];
    numbers = ["1", "2", "3", "4", "5", "6", "7", "8", "9"];
        
    // Se não tem nada é porque pretendeme revogá-lo
    if (right_lines.length <= 1) {
        output[0] = "revogado";
    } else {
        output[0] = right_lines[0];
        //Se só tem 2 linhas no lado esquerdo, podemos facilmente calcular uma vez que só pode haver alteração e/ou aditamentos
        if (left_lines.length <= 2) {
            for (var i=1; i<right_lines.length; i++) {
                left_string = new String(left_lines[i]);
                right_string = new String(right_lines[i]);
                if (typeof left_lines[i] === "undefined") {
                    output[i] = right_string + "$verde";
                } else if (left_string.trim() != right_string.trim()) {
                    output[i] = right_string + "$amarelo";
                } else {
                    output[i] = "...";
                }
            }
        // Se tem mais do que 2 linhas então vamos percorrer o que tiver mais linhas e comparar diferenças
        } else {
            ns = 0;
            ls = 1;
            for (i=1; i<left_lines.length; i++) {
                left_string = new String(left_lines[i]);
                left_id = left_string.substr(0, 1);
                if (!isNaN(left_id)) {
                    left_ids[ns] = [];
                    left_ids[ns][0] = left_id;
                    ns++;ls=1;
                } else {
                    left_ids[ns-1][ls] = left_id;
                    ls++;
                }
            }
            
            ns = 0;
            ls = 1;
            for (i=1; i<right_lines.length; i++) {
                right_string = new String(right_lines[i]);
                right_id = right_string.substr(0, 1);
                if (!isNaN(right_id)) {
                    right_ids[ns] = [];
                    right_ids[ns][0] = right_id;
                    ns++;ls=1;
                } else {
                    right_ids[ns-1][ls] = right_id;
                    ls++;
                }
            }
            
            for (i=0; i<right_ids.length; i++) {
                for (j=0; j<right_ids[i].length; j++) {
                    ////alert(right_ids[i][j] + " - ");
                }
                ////alert(" . ");
            }
            
            outc = 1;
            lcount = 0;lcount2 = 0;la = 1;
            rcount = 0;rcount2 = 0;ra = 1;
            if (left_ids.length >= right_ids.length) {
                // Percorrer ids
                for (var i=0; i<left_ids.length; i++) {
                    // Se já não há mais na coluna da direita, quer dizer que removido o último em que ficou
                    if (typeof right_ids[rcount] === "undefined") {
                        output[outc] = left_lines[la] + "$vermelho";
                        outc++;
                        ra++;
                        la++;
                    } else { 
                        if (left_ids[lcount].length >= right_ids[rcount].length) {
                            //Percorrer sub ids
                            //alert("lc = " + lcount + "   lc2 = " + lcount2 + "   rc = " + rcount + "   rc2 = " + rcount2 + "   la = " + la + "   ra = " + ra);
                            for (var j=0; j<left_ids[lcount].length; j++) {
                                //alert("j:" + j);
                                //alert(left_ids[lcount][lcount2] + " - " + right_ids[rcount][rcount2]);
                                //alert(left_lines[la] + " - " + right_lines[ra]);
                                //compara os ids
                                if(left_ids[lcount][lcount2] == right_ids[rcount][rcount2]) {
                                    //compara os conteudos
                                    if (left_lines[la] == right_lines[ra]) {
                                        //alert(right_lines[ra].substr(0, 2) + " ...");
                                        output[outc] = right_lines[ra].substr(0, 2) + " ...";
                                    } else {
                                        //alert(right_lines[ra] + "$amarelo");
                                        output[outc] = right_lines[ra] + "$amarelo";
                                    }
                                } else {
                                    if (!searchArray(right_ids[rcount], left_ids[lcount][lcount2])) {
                                        //alert(left_lines[la] + "$vermelho");
                                        output[outc] = left_lines[la] + "$vermelho";
                                        ra--;
                                        if (right_ids[rcount].length <= 1) rcount--; 
                                        rcount2--;
                                    } else if (!searchArray(left_ids[lcount], right_ids[rcount][rcount2])) {
                                        //alert(right_lines[ra] + "$verde");
                                        output[outc] = right_lines[ra] + "$verde";
                                        la--;
                                        if (left_ids[lcount].length <= 1) lcount--; 
                                        lcount2--;
                                    }
                                }

                                outc++;
                                lcount2++;rcount2++;la++;ra++;
                            }
                        } else {
                            if (left_ids[lcount].length == "1" && !searchArray(right_ids[rcount], left_ids[lcount][0])) {
                                ////alert(left_lines[la] + "$vermelho");
                                output[outc] = left_lines[la] + "$vermelho";
                                la++;
                                rcount--;
                                outc++;
                            } else {
                                ////alert("jhjkhkjhkhjk");
                                //Percorrer sub ids
                                ////alert("lc = " + lcount + "   lc2 = " + lcount2 + "   rc = " + rcount + "   rc2 = " + rcount2 + "   la = " + la + "   ra = " + ra);
                                for (var j=0; j<right_ids[rcount].length; j++) {
                                    ////alert("j:" + j);
                                    ////alert("lc = " + lcount + "   lc2 = " + lcount2 + "   rc = " + rcount + "   rc2 = " + rcount2 + "   la = " + la + "   ra = " + ra);
                                    ////alert(left_ids[lcount][lcount2] + " - " + right_ids[rcount][rcount2]);
                                    ////alert(left_lines[la] + " - " + right_lines[ra]);
                                    //compara os ids
                                    if(left_ids[lcount][lcount2] == right_ids[rcount][rcount2]) {
                                        //compara os conteudos
                                        if (left_lines[la] == right_lines[ra]) {
                                            ////alert(right_lines[ra].substr(0, 2) + " ...");
                                            output[outc] = right_lines[ra].substr(0, 2) + " ...";
                                        } else {
                                            ////alert(right_lines[ra] + "$amarelo");
                                            output[outc] = right_lines[ra] + "$amarelo";
                                        }
                                    } else {
                                        if (!searchArray(right_ids[rcount], left_ids[lcount][lcount2])) {
                                            ////alert(right_lines[ra] + "$verde");
                                            output[outc] = right_lines[ra] + "$verde";
                                        } else if (!searchArray(left_ids[lcount], right_ids[rcount][rcount2])) {
                                            ////alert(right_lines[ra] + "$verde");
                                            output[outc] = right_lines[ra] + "$verde";
                                            la++;
                                            rcount--;
                                            break;
                                        }
                                    }

                                    outc++;
                                    lcount2++;rcount2++;la++;ra++;
                                }
                            }
                        }
                    
                        lcount++;rcount++;lcount2=0;rcount2=0;
                    }
                }
            } else {
                // Percorrer ids
                for (var i=0; i<right_ids.length; i++) {
                    // Se já não há mais na coluna da esquerda, quer dizer que foi adicionado
                    if (typeof left_ids[lcount] === "undefined") {
                        for (var j=0; j<right_ids[rcount].length; j++) {
                            output[outc] = right_lines[ra] + "$verde";
                            outc++;
                            la++;ra++;
                        }
                    } else { 
                        if (left_ids[lcount].length >= right_ids[rcount].length) {
                            //Percorrer sub ids
                            ////alert("lc = " + lcount + "   lc2 = " + lcount2 + "   rc = " + rcount + "   rc2 = " + rcount2 + "   la = " + la + "   ra = " + ra);
                            for (var j=0; j<left_ids[lcount].length; j++) {
                                ////alert("j:" + j);
                                ////alert(left_ids[lcount][lcount2] + " - " + right_ids[rcount][rcount2]);
                                ////alert(left_lines[la] + " - " + right_lines[ra]);
                                //compara os ids
                                if(left_ids[lcount][lcount2] == right_ids[rcount][rcount2]) {
                                    //compara os conteudos
                                    if (left_lines[la] == right_lines[ra]) {
                                        ////alert(right_lines[ra].substr(0, 2) + " ...");
                                        output[outc] = right_lines[ra].substr(0, 2) + " ...";
                                    } else {
                                        ////alert(right_lines[ra] + "$amarelo");
                                        output[outc] = right_lines[ra] + "$amarelo";
                                    }
                                } else {
                                    if (!searchArray(right_ids[rcount], left_ids[lcount][lcount2])) {
                                        ////alert(left_lines[la] + "$vermelho");
                                        output[outc] = left_lines[la] + "$vermelho";
                                        ra--;
                                        rcount2--;
                                    } else if (!searchArray(left_ids[lcount], right_ids[rcount][rcount2])) {
                                        ////alert(right_lines[ra] + "$verde");
                                        output[outc] = right_lines[ra] + "$verde";
                                        la--;
                                        lcount2--;
                                    }
                                }

                                outc++;
                                lcount2++;rcount2++;la++;ra++;
                            }
                        } else {
                            if (left_ids[lcount]. length == "1") {
                                if (!searchArray(left_ids[lcount][0], right_ids[rcount])) {
                                    ////alert(left_lines[la] + "$vermelho");
                                    output[outc] = left_lines[la] + "$vermelho";
                                    la++;
                                    rcount--;
                                    outc++;
                                }
                            } else {
                                //Percorrer sub ids
                                ////alert("lc = " + lcount + "   lc2 = " + lcount2 + "   rc = " + rcount + "   rc2 = " + rcount2 + "   la = " + la + "   ra = " + ra);
                                for (var j=0; j<right_ids[rcount].length; j++) {
                                    ////alert("j:" + j);
                                    ////alert("lc = " + lcount + "   lc2 = " + lcount2 + "   rc = " + rcount + "   rc2 = " + rcount2 + "   la = " + la + "   ra = " + ra);
                                    ////alert(left_ids[lcount][lcount2] + " - " + right_ids[rcount][rcount2]);
                                    ////alert(left_lines[la] + " - " + right_lines[ra]);
                                    //compara os ids
                                    if(left_ids[lcount][lcount2] == right_ids[rcount][rcount2]) {
                                        //compara os conteudos
                                        if (left_lines[la] == right_lines[ra]) {
                                            ////alert(right_lines[ra].substr(0, 2) + " ...");
                                            output[outc] = right_lines[ra].substr(0, 2) + " ...";
                                        } else {
                                            ////alert(right_lines[ra] + "$amarelo");
                                            output[outc] = right_lines[ra] + "$amarelo";
                                        }
                                    } else {
                                        if (!searchArray(right_ids[rcount], left_ids[lcount][lcount2])) {
                                            ////alert(right_lines[ra] + "$verde");
                                            output[outc] = right_lines[ra] + "$verde";
                                        } else if (!searchArray(left_ids[lcount], right_ids[rcount][rcount2])) {
                                            ////alert(right_lines[ra] + "$verde");
                                            output[outc] = right_lines[ra] + "$verde";
                                            la++;
                                            rcount--;
                                        }
                                    }

                                    outc++;
                                    lcount2++;rcount2++;la++;ra++;
                                }
                            }
                        }
                    
                        lcount++;rcount++;lcount2=0;rcount2=0;
                    }
                }
            }
        }
    }
    
    for (i=0; i<output.length; i++) {
        sVermelho = output[i].split("$vermelho");
        if(sVermelho.length > 1) {
            output[i] = output[i].substring(0, 2) + "revogado";
        }
        
        sAmarelo = output[i].split("$amarelo");
        if(sAmarelo.length > 1) {
            output[i] = output[i].substring(0, output[i].length - 8);
        }
        
        sVerde = output[i].split("$verde");
        if(sVerde.length > 1) {
            output[i] = output[i].substring(0, output[i].length - 6);
        }
    }
    
    for (i=0; i<output.length; i++) {
        alert(output[i]);
    }
    
    art = document.getElementById('dd_choose_article').options[document.getElementById('dd_choose_article').selectedIndex].text;
    output[output.length] = art;
    
    docname = document.getElementById('doc_name').innerHTML;
    splitdocname = docname.split("Documento: ");
    output[output.length] = splitdocname[1];
    
    if (confirm("Tem a certeza?")) {
        var jsonString = JSON.stringify(output);
        $.ajax({
            type: "POST",
            url: "http://localhost/BasicSite/model_save_file/save_alteration_file",
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

function validate_alt_alteration() {
    output = [];
    
    var lines = $('textarea#right_area').val().split(/\n/);
    for (var i=0; i < lines.length; i++) {
    if (/\S/.test(lines[i])) {
            output.push($.trim(lines[i]));
        }
    }
    
    artname = document.getElementById('art_name').innerHTML;
    splitartname = artname.split("Artigo: ");
    output[output.length] = splitartname[1];
    
    docname = document.getElementById('doc_name').innerHTML;
    splitdocname = docname.split("Documento: ");
    output[output.length] = splitdocname[1];
    
    var jsonString = JSON.stringify(output);
    if (confirm("Tem a certeza?")) {
        var jsonString = JSON.stringify(output);
        $.ajax({
            type: "POST",
            url: "http://localhost/BasicSite/model_save_file/save_alt_alteration_file",
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

/*
 * 0 a tamanho do artigo - conteudo do artigo
 * tamanho do artigo +1 - o artigo
 * tamanho do artigo +2 - o documento a alterar
 * tamanho do artigo +3 - o documento que tem a hierarquia mais recente
 * tamanho do artigo +4 a +10 - a hierarquia
 * 
 */
function validate_addition() {
    output = [];
    
    output[0] = "(" + document.getElementById('choose_article_title').value + ")";
    
    var lines = $('textarea#text_area').val().split(/\n/);
    for (var i=0; i < lines.length; i++) {
    if (/\S/.test(lines[i])) {
            output.push($.trim(lines[i]));
        }
    }
    
    output[output.length] = document.getElementById('choose_article_n').value;
    
    docname = document.getElementById('doc_name').innerHTML;
    splitdocname = docname.split("Documento: ");
    output[output.length] = splitdocname[1];
    
    output[output.length] = document.getElementById('dd_data_hierarchy_doc').options[document.getElementById('dd_data_hierarchy_doc').selectedIndex].text;
    
    if (document.getElementById('dd_livro').options.length > 0 && document.getElementById('dd_livro').options[document.getElementById('dd_livro').selectedIndex].text != "") {
        output[output.length] = document.getElementById('dd_livro').options[document.getElementById('dd_livro').selectedIndex].text;
    } else { output[output.length] = '0'; }
    if (document.getElementById('dd_titulo').options.length > 0 && document.getElementById('dd_titulo').options[document.getElementById('dd_titulo').selectedIndex].text != "") {
        output[output.length] = document.getElementById('dd_titulo').options[document.getElementById('dd_titulo').selectedIndex].text;
    } else { output[output.length] = '0'; }
    if (document.getElementById('dd_subtitulo').options.length > 0 && document.getElementById('dd_subtitulo').options[document.getElementById('dd_subtitulo').selectedIndex].text != "") {
        output[output.length] = document.getElementById('dd_subtitulo').options[document.getElementById('dd_subtitulo').selectedIndex].text;
    } else { output[output.length] = '0'; }
    if (document.getElementById('dd_capitulo').options.length > 0 && document.getElementById('dd_capitulo').options[document.getElementById('dd_capitulo').selectedIndex].text != "") {
        output[output.length] = document.getElementById('dd_capitulo').options[document.getElementById('dd_capitulo').selectedIndex].text;
    } else { output[output.length] = '0'; }
    if (document.getElementById('dd_seccao').options.length > 0 && document.getElementById('dd_seccao').options[document.getElementById('dd_seccao').selectedIndex].text != "") {
        output[output.length] = document.getElementById('dd_seccao').options[document.getElementById('dd_seccao').selectedIndex].text;
    } else { output[output.length] = '0'; }
    if (document.getElementById('dd_subseccao').options.length > 0 && document.getElementById('dd_subseccao').options[document.getElementById('dd_subseccao').selectedIndex].text != "") {
        output[output.length] = document.getElementById('dd_subseccao').options[document.getElementById('dd_subseccao').selectedIndex].text;
    } else { output[output.length] = '0'; }
    if (document.getElementById('dd_divisao').options.length > 0 && document.getElementById('dd_divisao').options[document.getElementById('dd_divisao').selectedIndex].text != "") {
        output[output.length] = document.getElementById('dd_divisao').options[document.getElementById('dd_divisao').selectedIndex].text;
    } else { output[output.length] = '0'; }
    if (document.getElementById('dd_subdivisao').options.length > 0 && document.getElementById('dd_subdivisao').options[document.getElementById('dd_subdivisao').selectedIndex].text != "") {
        output[output.length] = document.getElementById('dd_subdivisao').options[document.getElementById('dd_subdivisao').selectedIndex].text;
    } else { output[output.length] = '0'; }
    
    var jsonString = JSON.stringify(output);
    if (confirm("Tem a certeza?")) {
        var jsonString = JSON.stringify(output);
        $.ajax({
            type: "POST",
            url: "http://localhost/BasicSite/model_save_file/save_addition_file",
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

function validate_alt_addition() {
    output = [];
    
    var lines = $('textarea#right_area').val().split(/\n/);
    for (var i=0; i < lines.length; i++) {
    if (/\S/.test(lines[i])) {
            output.push($.trim(lines[i]));
        }
    }
    
    artname = document.getElementById('art_name').innerHTML;
    splitartname = artname.split("Artigo: ");
    output[output.length] = splitartname[1];
    
    docname = document.getElementById('doc_name').innerHTML;
    splitdocname = docname.split("Documento: ");
    output[output.length] = splitdocname[1];
    
    var jsonString = JSON.stringify(output);
    if (confirm("Tem a certeza?")) {
        var jsonString = JSON.stringify(output);
        $.ajax({
            type: "POST",
            url: "http://localhost/BasicSite/model_save_file/save_alt_addition_file",
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

function validate_remove() {
    output = [];
    
    art = document.getElementById('dd_choose_article').options[document.getElementById('dd_choose_article').selectedIndex].text;
    output[0] = document.getElementById('dd_choose_article').options[document.getElementById('dd_choose_article').selectedIndex].text;
    
    docname = document.getElementById('doc_name').innerHTML;
    splitdocname = docname.split("Documento: ");
    output[1] = splitdocname[1];
    
    var jsonString = JSON.stringify(output);
    if (confirm("Tem a certeza?")) {
        var jsonString = JSON.stringify(output);
        $.ajax({
            type: "POST",
            url: "http://localhost/BasicSite/model_save_file/save_remove_file",
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

function done_doc() {
    if (doc.length >= 1) {
        if (confirm("Tem a certeza que não quer fazer mais alterações?")) {
            var split = window.location.pathname.split("/");
            window.location.replace(window.location.protocol + "//" + window.location.host + "/" + split[1] + "/site/home");
        } else {
        }
    } else {
        alert("Carregue um documento primeiro!");
    }
}

function finish_doc() {
    var doc = document.getElementById('dd_doc_alteration').options[document.getElementById('dd_doc_alteration').selectedIndex].text;
    var split = doc.split("(");
    var res = split[0].trim();    
    if (doc.length >= 1) {
        if (confirm("Tem a certeza que não quer fazer mais alterações?\nATENÇÂO! Depois de o fechar, não pode fazer mais alterações ao documento.")) {
            $.ajax({
                type: "POST",
                url: "http://localhost/BasicSite/model_save_file/save_doc_but_dont_send",
                data: {doc: res}, 
                cache: false,

                success: function(){
                    var split = window.location.pathname.split("/");
                    window.location.replace(window.location.protocol + "//" + window.location.host + "/" + split[1] + "/site/home");
                }
            });
        } else {
        }
    } else {
        alert("Carregue um documento primeiro!");
    }
}

function send_doc() {
    var doc = document.getElementById('dd_doc_alteration').options[document.getElementById('dd_doc_alteration').selectedIndex].text;
    var split = doc.split("(");
    var res = split[0].trim();    
    if (doc.length >= 1) {
        if (confirm("Tem a certeza que não quer fazer mais alterações?\nATENÇÂO! Depois de o enviar para aprovação, não pode fazer mais alterações ao documento.")) {
            $.ajax({
                type: "POST",
                url: "http://localhost/BasicSite/model_save_file/save_doc_and_send",
                data: {doc: res}, 
                cache: false,

                success: function(){
                    var split = window.location.pathname.split("/");
                    window.location.replace(window.location.protocol + "//" + window.location.host + "/" + split[1] + "/site/home");
                }
            });
        } else {
        }
    } else {
        alert("Carregue um documento primeiro!");
    }
}



function approve_temp_doc() {
    var dat = document.getElementById('select_doc_manage').options[document.getElementById('select_doc_manage').selectedIndex].value;
    var d_res = dat.replace("/", "_").replace("/", "_");
    var dia_mes_ano = d_res.split("_");
    var res = dia_mes_ano[2].trim() + "_" + dia_mes_ano[1].trim() + "_" + dia_mes_ano[0].trim();
    
    var doc = document.getElementById('select_doc_manage').options[document.getElementById('select_doc_manage').selectedIndex].text;
    var split = doc.split("(");
    var split2 = split[1].split(")");
    var nome_doc = split[0].trim();
    var estado = split2[0].trim();
    
    if (doc.length >= 1) {
        if (estado === "2") {
            if (confirm("Tem a certeza que quer APROVAR este documento?\nATENÇÂO! Depois de o aprovar, não dá para voltar atrás.")) {
                $.ajax({
                    type: "POST",
                    url: "http://localhost/BasicSite/model_save_file/approve_temp_doc",
                    data: {doc: res, name: nome_doc},

                    success: function() {
                        alert("Documento aprovado com sucesso.");
                        var split = window.location.pathname.split("/");
                        window.location.replace(window.location.protocol + "//" + window.location.host + "/" + split[1] + "/site/home");
                    }
                });
            } else {
                //alert("Problemas de Coneção ao Servidor...");
            }
        } else {
            alert("Apenas documentos com estado 2 é que podem ser aprovados.");
        }
    } else {
        alert("Carregue um documento primeiro!");
    }
}

function disapprove_temp_doc() {
    var dat = document.getElementById('select_doc_manage').options[document.getElementById('select_doc_manage').selectedIndex].value;
    var d_res = dat.replace("/", "_").replace("/", "_");
    var dia_mes_ano = d_res.split("_");
    var res = dia_mes_ano[2].trim() + "_" + dia_mes_ano[1].trim() + "_" + dia_mes_ano[0].trim();
    
    var doc = document.getElementById('select_doc_manage').options[document.getElementById('select_doc_manage').selectedIndex].text;
    var split = doc.split("(");
    var split2 = split[1].split(")");
    var nome_doc = split[0].trim();
    var estado = split2[0].trim();
    
    if (doc.length >= 1) {
        if (estado === "2") {
            if (confirm("Tem a certeza que quer REPROVAR este documento?\nATENÇÂO! Depois de o reprovar, pode voltar a fazer alterações ao documento e enviá-lo de novo para aprovação.")) {
                $.ajax({
                    type: "POST",
                    url: "http://localhost/BasicSite/model_save_file/disapprove_temp_doc",
                    data: {doc: res, name: nome_doc},

                    success: function() {
                        alert("Documento reprovado com sucesso.");
                        var split = window.location.pathname.split("/");
                        window.location.replace(window.location.protocol + "//" + window.location.host + "/" + split[1] + "/site/home");
                    }
                });
            } else {
                //alert("Problemas de Coneção ao Servidor...");
            }
        } else {
            alert("Apenas documentos com estado 2 é que podem ser reprovados.");
        }
    } else {
        alert("Carregue um documento primeiro!");
    }
}

function delete_temp_doc() {
    var dat = document.getElementById('select_doc_manage').options[document.getElementById('select_doc_manage').selectedIndex].value;
    var d_res = dat.replace("/", "_").replace("/", "_");
    var dia_mes_ano = d_res.split("_");
    var res = dia_mes_ano[2].trim() + "_" + dia_mes_ano[1].trim() + "_" + dia_mes_ano[0].trim();
    
    var doc = document.getElementById('select_doc_manage').options[document.getElementById('select_doc_manage').selectedIndex].text;
    var split = doc.split("(");
    var split2 = split[1].split(")");
    var nome_doc = split[0].trim();
    var estado = split2[0].trim();
    
    if (doc.length >= 1) {
        if (estado != "2") {
            if (confirm("Tem a certeza que quer ELIMINAR este documento?\nATENÇÂO! Depois de o eliminar, não dá para voltar atrás.")) {
                $.ajax({
                    type: "POST",
                    url: "http://localhost/BasicSite/model_save_file/delete_temp_doc",
                    data: {doc: res, name: nome_doc},

                    success: function() {
                        alert("Documento eliminado com sucesso.");
                        var split = window.location.pathname.split("/");
                        window.location.replace(window.location.protocol + "//" + window.location.host + "/" + split[1] + "/site/home");
                    }
                });
            } else {
                //alert("Problemas de Coneção ao Servidor...");
            }
        } else {
            alert("Apenas pode eliminar documentos com estado inferior a 2.");
        }
    } else {
        alert("Carregue um documento primeiro!");
    }
}

function searchArray(ArrayObj, SearchFor) {
    var Found = false;
    for (var i = 0; i < ArrayObj.length; i++) {
        if (ArrayObj[i] == SearchFor){
            return true;
            var Found = true;
            break;
        } else if ((i == (ArrayObj.length - 1)) && (!Found)) {
            if (ArrayObj[i] != SearchFor) {
                return false;
            }
        }
    }
}

function alertArray(output) {
    for (i=0; i<output.length; i++) {
        alert(output[i]);
    }
}
