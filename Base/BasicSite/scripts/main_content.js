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

function blass() {
    alert("#YOLOSWAG BLAZEIT 420 FAGGOT");
}

function display_table_alteration() {
    document.getElementById('id_table_alteration').style.visibility = 'visible';
}

function create_table_alteration() {
    document.getElementById('id_table_alteration').style.visibility = 'visible';
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
                    ns++; ls=1;
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
                    ns++; ls=1;
                } else {
                    right_ids[ns-1][ls] = right_id;
                    ls++;
                }
            }
            
            for (i=0; i<right_ids.length; i++) {
                for (j=0; j<right_ids[i].length; j++) {
                    //alert(right_ids[i][j] + " - ");
                }
                //alert(" . ");
            }
            
            outc = 1;
            lcount = 0; lcount2 = 0; la = 1;
            rcount = 0; rcount2 = 0; ra = 1;
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
                                        rcount2--;
                                    } else if (!searchArray(left_ids[lcount], right_ids[rcount][rcount2])) {
                                        //alert(right_lines[ra] + "$verde");
                                        output[outc] = right_lines[ra] + "$verde";
                                        la--;
                                        lcount2--;
                                    }
                                }

                                outc++;
                                lcount2++; rcount2++; la++; ra++;
                            }
                        } else {
                            if (left_ids[lcount].length == "1" && !searchArray(right_ids[rcount], left_ids[lcount][0])) {
                                //alert(left_lines[la] + "$vermelho");
                                output[outc] = left_lines[la] + "$vermelho";
                                la++;
                                rcount--;
                                outc++;
                            } else {
                                //alert("jhjkhkjhkhjk");
                                //Percorrer sub ids
                                //alert("lc = " + lcount + "   lc2 = " + lcount2 + "   rc = " + rcount + "   rc2 = " + rcount2 + "   la = " + la + "   ra = " + ra);
                                for (var j=0; j<right_ids[rcount].length; j++) {
                                    //alert("j:" + j);
                                    //alert("lc = " + lcount + "   lc2 = " + lcount2 + "   rc = " + rcount + "   rc2 = " + rcount2 + "   la = " + la + "   ra = " + ra);
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
                                            //alert(right_lines[ra] + "$verde");
                                            output[outc] = right_lines[ra] + "$verde";
                                        } else if (!searchArray(left_ids[lcount], right_ids[rcount][rcount2])) {
                                            //alert(right_lines[ra] + "$verde");
                                            output[outc] = right_lines[ra] + "$verde";
                                            la++;
                                            rcount--;
                                            break;
                                        }
                                    }

                                    outc++;
                                    lcount2++; rcount2++; la++; ra++;
                                }
                            }
                        }
                    
                        lcount++; rcount++; lcount2=0; rcount2=0;
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
                            la++; ra++;
                        }
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
                                        rcount2--;
                                    } else if (!searchArray(left_ids[lcount], right_ids[rcount][rcount2])) {
                                        //alert(right_lines[ra] + "$verde");
                                        output[outc] = right_lines[ra] + "$verde";
                                        la--;
                                        lcount2--;
                                    }
                                }

                                outc++;
                                lcount2++; rcount2++; la++; ra++;
                            }
                        } else {
                            if (left_ids[lcount]. length == "1") {
                                if (!searchArray(left_ids[lcount][0], right_ids[rcount])) {
                                    //alert(left_lines[la] + "$vermelho");
                                    output[outc] = left_lines[la] + "$vermelho";
                                    la++;
                                    rcount--;
                                    outc++;
                                }
                            } else {
                                //Percorrer sub ids
                                //alert("lc = " + lcount + "   lc2 = " + lcount2 + "   rc = " + rcount + "   rc2 = " + rcount2 + "   la = " + la + "   ra = " + ra);
                                for (var j=0; j<right_ids[rcount].length; j++) {
                                    //alert("j:" + j);
                                    //alert("lc = " + lcount + "   lc2 = " + lcount2 + "   rc = " + rcount + "   rc2 = " + rcount2 + "   la = " + la + "   ra = " + ra);
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
                                            //alert(right_lines[ra] + "$verde");
                                            output[outc] = right_lines[ra] + "$verde";
                                        } else if (!searchArray(left_ids[lcount], right_ids[rcount][rcount2])) {
                                            //alert(right_lines[ra] + "$verde");
                                            output[outc] = right_lines[ra] + "$verde";
                                            la++;
                                            rcount--;
                                        }
                                    }

                                    outc++;
                                    lcount2++; rcount2++; la++; ra++;
                                }
                            }
                        }
                    
                        lcount++; rcount++; lcount2=0; rcount2=0;
                    }
                }
            }
        }
    }
    
    for (var i=0; i<output.length; i++) {
        alert(output[i]);
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