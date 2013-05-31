<?php

class Model_api extends CI_Model {

    //**********************************************  Gets  **********************************************

    /*
     * Parameters: $name (the name of the article)
     * Returns: Array with an organized content of the article
     */
    public function get_full_article($name) {
        $resposta = array();
        $docs = $this->get_all_doc_names_array();
        $doc = $docs[sizeof($docs)-1];
        $new_old_docs = $this->get_last_doc_given_article($name, $doc);
        $array = file('C:/wamp/www/BasicSite/codigo_civil/' . $new_old_docs[0] . '/' . $new_old_docs[0] . '_' . $name . '.txt', FILE_SKIP_EMPTY_LINES);
        if ($new_old_docs[1] != null) {
            $array_old = file('C:/wamp/www/BasicSite/codigo_civil/' . $new_old_docs[1] . '/' . $new_old_docs[1] . '_' . $name . '.txt', FILE_SKIP_EMPTY_LINES);
        }
        
        $n_array = array();
        $n_array_old = array();
        $j=0;
        for ($i=0; $i<sizeof($array); $i++) {
            if (strlen((string) $array[$i]) > 0 && strlen(trim((string) $array[$i])) != 0) {
                $n_array[$j] = $array[$i];
                $j++;
            }
        }
        
        $j=0;
        if ($new_old_docs[1] != null) {
            for ($i=0; $i<sizeof($array_old); $i++) {
                if (strlen((string) $array_old[$i]) > 0 && strlen(trim((string) $array_old[$i])) != 0) {
                    $n_array_old[$j] = $array_old[$i];
                    $j++;
                }
            }
        }
        
        if (sizeof($n_array) <= 2) {
            $resposta[0] = $n_array[0];
            $resposta[1] = $n_array[1];
        } else {
            for ($i=0; $i<sizeof($n_array); $i++) {
                $splited = explode("...", $n_array[$i]);
                if (sizeof($splited) >= 2) {
                    if (strlen(trim($splited[0])) < 10) {
                        $resposta[$i] = $n_array_old[$i];
                    }
                } else {
                    $resposta[$i] = $n_array[$i];
                }
            }
        }
                
        $sub_count = 1;
        $item_count = 1;
        $return[0] = $resposta[0];
        for ($i=1; $i<sizeof($resposta); $i++) {
            $sub_resposta = substr($resposta[$i], 0, 3);
            if (preg_match('/[0-9]*\. /', $sub_resposta) || preg_match('/[0-9]* -/', $sub_resposta)) {
                $return[$item_count][0] = $resposta[$i];
                $sub_count = 1;
                $item_count++;
            } else if (preg_match('/[a-z]*\) /', $sub_resposta) || preg_match('/[a-z]* -/', $sub_resposta)) {
                $return[$item_count-1][$sub_count] = $resposta[$i];
                $sub_count++;
            } else {
                $return[$i] = $resposta[$i];
            }
        }
        
        return $return;
    }
    
    public function get_last_doc_given_article($artigo, $doc) {
        $docs_hierarchy = $this->get_article_evolution_names((string) $artigo);
        $doc_match = false;
        $doc_res_2 = null;
        for ($i = 0; $i < sizeof($docs_hierarchy); $i++) {
            if ((string) $artigo == (string) $docs_hierarchy[$i]) {
                $doc_match = true;
            }
        }

        if ($doc_match == false) {
            $doc_res = $docs_hierarchy[sizeof($docs_hierarchy) - 1];
            if (sizeof($docs_hierarchy) - 2 >= 0) {
                $doc_res_2 = $docs_hierarchy[sizeof($docs_hierarchy) - 2];
            }
            
            for ($i = sizeof($docs_hierarchy) - 1; $i >= 0; $i--) {
                $doc1 = str_replace("_", "-", $docs_hierarchy[$i]);
                $doc2 = str_replace("_", "-", $doc);
                $doc_user = strtotime($doc2);
                $doc_list = strtotime($doc1);

                if ($doc_list > $doc_user) {
                    if ($i - 1 >= 0) {
                        $doc_res = $docs_hierarchy[$i - 1];
                        if ($i - 2 >= 0) {
                            $doc_res_2 = $docs_hierarchy[$i - 2];
                        }
                        continue;
                    } else if ($i - 1 == 0) {
                        $doc_res = $docs_hierarchy[0];
                        continue;
                    }
                } else {
                    $valid = "no";
                }
            }
        }
        $doc_2[0] = $doc_res;
        $doc_2[1] = $doc_res_2;
        
        return $doc_2;
    }

    /*
     * Parameters: $name (the name must be in the form of: "docdate/docdate_articlename.txt")
     * Returns: Array with each line of the txt in a diferent index, ranging from 0 to (number of lines-1)
     */
    public function get_article($name) {
        return file('C:/wamp/www/BasicSite/codigo_civil/' . $name, FILE_SKIP_EMPTY_LINES);
    }

    /*
     * Parameters: $name (the article number); $doc (the date of the document)
     * Returns: Array with each line of the txt in a diferent index, ranging from 0 to (number of lines-1)
     */
    public function get_article_given_doc($name, $doc) {
        $array = file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/' . $doc . '_' . $name . '.txt', FILE_SKIP_EMPTY_LINES);
        $n_array = array();
        $j=0;
        for ($i=0; $i<sizeof($array); $i++) {
            if (strlen((string) $array[$i]) > 0 && strlen(trim((string) $array[$i])) != 0) {
                $n_array[$j] = $array[$i];
                $j++;
            }
        }
        return $n_array;
    }

    /*
     * Parameters: $name (the name must be in the form of: "docdate/docdate_articlename.txt")
     * Returns: The first line of the txt, which is the title
     */
    public function get_article_title($name) {
        $array = file('C:/wamp/www/BasicSite/codigo_civil/' . $name, FILE_SKIP_EMPTY_LINES);
        return $array[0];
    }

    /*
     * Parameters: $name (the article number); $doc (the date of the document)
     * Returns: The first line of the txt, which is the title
     */
    public function get_article_title_given_doc($name, $doc) {
        $array = file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/' . $doc . '_' . $name . '.txt', FILE_SKIP_EMPTY_LINES);
        return $array[0];
    }

    /*
     * Parameters: $name (the name must be in the form of: "docdate/docdate_articlename.txt")
     * Returns: Array with each line of the txt except the title in a diferent index, ranging from 0 to (number of lines-2)
     */
    public function get_article_text($name) {
        $array = file('C:/wamp/www/BasicSite/codigo_civil/' . $name, FILE_SKIP_EMPTY_LINES);
        $array;
    }

    /*
     * Parameters: $name (the article number); $doc (the date of the document)
     * Returns: Array with each line of the txt except the title in a diferent index, ranging from 0 to (number of lines-2)
     */
    public function get_article_text_given_doc($name, $doc) {
        $array = explode("\n", trim(readfile('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/' . $doc . '_' . $name . '.txt', FILE_SKIP_EMPTY_LINES)));
        if (sizeof($array) > 2) {
            unset($array[0]);
            return array_values($array);
        }
        return $array[1];
    }

    /*
     * Parameters: $name (the article number)
     * Returns: Array with the names of the doc in which the article altered/added/revoked
     */
    public function get_article_evolution_names($name) {
        $number_docs = $this->get_all_doc_count();
        $docs = $this->get_all_doc_names();
        $evolution[0] = "1966_11_25";
        $count = 1;
        for ($i = 1; $i <= $number_docs; $i++) {
            if ($docs->doc[$i] != null) {
                if ($this->was_article_altered_in_given_doc($name, $docs->doc[$i]) == 1) {
                    $evolution[$count] = $docs->doc[$i];
                    $count++;
                }
            }
        }
        return $evolution;
    }

    /*
     * Parameters: $name (the article number)
     * Returns: Array with the title evolution ([x][y] - x=doc's date; y=article title)
     */
    public function get_article_evolution_title($name) {
        $number_docs = $this->get_all_doc_count();
        $docs = $this->get_all_doc_names();
        $evolution[0][0] = "1966_11_25";
        $evolution[0][1] = $this->get_article_title("/1966_11_25/1966_11_25_" . $name . ".txt");
        $count = 1;
        for ($i = 1; $i <= $number_docs; $i++) {
            if ($docs->doc[$i] != null) {
                if ($this->does_article_exist_in_given_doc($name, $docs->doc[$i]) == 1) {
                    $evolution[$count][0] = $docs->doc[$i];
                    $evolution[$count][1] = $this->get_article_title("/" . $docs->doc[$i] . "/" . $docs->doc[$i] . "_" . $name . ".txt");
                    $count++;
                }
            }
        }
        return $evolution;
    }

    /*
     * Parameters: $name (the article number)
     * Returns: Array with the title evolution ([x][y] - x=doc's date; y=article text)
     */
    public function get_article_evolution_text($name) {
        $number_docs = $this->get_all_doc_count();
        $docs = $this->get_all_doc_names();
        $evolution[0][0] = "1966_11_25";
        $evolution[0][1] = $this->get_article_given_doc($name, "1966_11_25");;
        $count = 1;
        for ($i = 1; $i <= $number_docs; $i++) {
            if ($docs->doc[$i] != null) {
                if ($this->does_article_exist_in_given_doc($name, $docs->doc[$i]) == 1) {
                    $evolution[$count][0] = $docs->doc[$i];
                    $evolution[$count][1] = $this->get_article_given_doc($name, $docs->doc[$i]);
                    $count++;
                }
            }
        }
        return $evolution;
    }

    /*
     * Parameters: $name (the article number)
     * Returns: Array with the title evolution ([x][y] - x=doc's date; y=article text)
     */
    public function get_article_evolution_content($name) {
        $number_docs = $this->get_all_doc_count();
        $docs = $this->get_all_doc_names();
        $evolution[0][0] = "1966_11_25";
        $evolution[0][1] = $this->get_article_text("/1966_11_25/1966_11_25_" . $name . ".txt");
        $count = 1;
        for ($i = 1; $i <= $number_docs; $i++) {
            if ($docs->doc[$i] != null) {
                if ($this->does_article_exist_in_given_doc($name, $docs->doc[$i]) == 1) {
                    $evolution[$count][0] = $docs->doc[$i];
                    $evolution[$count][1] = $this->get_article("/" . $docs->doc[$i] . "/" . $docs->doc[$i] . "_" . $name . ".txt");
                    $count++;
                }
            }
        }
        return $evolution;
    }

    /*
     * Parameters: $name (the doc's date)
     * Returns: Array with the articles that it contains ([x][y] - x=alteration/adition/revoke; y=number of the article)
     */
    public function get_all_articles($name) {
        $array = $this->get_doc_content($name . "/" . $name . ".xml");
        $result['altera'] = array();
        $result['acrescenta'] = array();
        $result['revoga'] = array();
        for ($i = 0; $i <= sizeof($array->altera); $i++) {
            $article = $this->get_article($name . "/" . $name . "_" . $array->altera[$i] . ".txt");
            $result['altera'][$i] = $article;
        }
        for ($i = 0; $i <= sizeof($array->acrescenta); $i++) {
            $article = $this->get_article($name . "/" . $name . "_" . $array->acrescenta[$i] . ".txt");
            $result['acrescenta'][$i] = $article;
        }
        for ($i = 0; $i <= sizeof($array->revoga); $i++) {
            $result['revoga'][$i] = $array->revoga[$i];
        }
        return $result;
    }

    /*
     * Parameters: $name (the doc's date)
     * Returns: Array with the content of the xml document
     */
    public function get_doc_content($name) {
        return simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $name . "/" . $name . ".xml");
    }

    /*
     * Parameters: $name (the doc's date)
     * Returns: The name of the document
     */
    public function get_doc_name($name) {
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $name . "/" . $name . ".xml");
        return $array['nome'];
    }

    /*
     * Parameters: $name (the doc's date)
     * Returns: Array with only the altered articles
     */
    public function get_doc_altered($name) {
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $name . "/" . $name . ".xml");
        if (sizeof($array->altera) > 0) {
            return $array->altera;
        }
        return null;
    }

    /*
     * Parameters: $name (the doc's date)
     * Returns: Array with only the added articles
     */
    public function get_doc_added($name) {
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $name . "/" . $name . ".xml");
        if (sizeof($array->acrescenta) > 0) {
            return $array->acrescenta;
        }
    }

    /*
     * Parameters: $name (the doc's date)
     * Returns: Array with only the revoked articles
     */
    public function get_doc_revoked($name) {
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $name . "/" . $name . ".xml");
        if (sizeof($array->revoga) > 0) {
            return $array->revoga;
        }
    }

    /*
     * Parameters: $name (the doc's date)
     * Returns: Array with the amount of altered articles
     */
    public function get_doc_altered_count($name) {
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $name . '/' . $name . '.xml');
        return sizeof($array->altera);
    }

    /*
     * Parameters: $name (the doc's date)
     * Returns: Array with the amount of added articles
     */
    public function get_doc_added_count($name) {
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $name . "/" . $name . ".xml");
        return sizeof($array->acrescenta);
    }

    /*
     * Parameters: $name (the doc's date)
     * Returns: Array with the amount of revoked articles
     */
    public function get_doc_revoked_count($name) {
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $name . "/" . $name . ".xml");
        return sizeof($array->revoga);
    }
    
    public function get_doc_only($doc) {
        $resposta = array();
        $resposta[0] = null;
        $resposta[1] = null;
        $resposta[2] = null;
        
        $count = 0;
        $alts = $this->get_doc_altered($doc);
        if ($alts != null) {
            foreach ($alts as $alt) {
                $resposta[0][$count][0] = $alt;
                $resposta[0][$count][1] = $this->get_article_given_doc($alt, $doc);
                $count++;
            }
        }
        
        $count = 0;
        $adds = $this->get_doc_added($doc);
        if ($adds != null) {
            foreach ($adds as $add) {
                $resposta[1][$count][0] = $add;
                $resposta[1][$count][1] = $this->get_article_given_doc($add, $doc);
                $count++;
            }
        }
        
        $count = 0;
        $revs = $this->get_doc_revoked($doc);
        if ($revs != null) {
            foreach ($revs as $rev) {
                $resposta[2][$count] = $rev;
                $count++;
            }
        }
        
        return $resposta;
    }

    /*
     * Returns: A SimpleXMLElement with the names of all the documents existent in the directory
     */
    public function get_all_doc_names() {
        return simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/documentos.xml');
    }
    /*
     * Returns: An array with the names of all the documents existent in the directory
     */
    public function get_all_doc_names_array() {
        $xml = $this->get_all_doc_names();
        $array = array();
        $i = 0;
        foreach($xml->doc as $doc) {
            $array[$i] = $doc;
            $i++;
        }
        return $array;
    }
    /*
     * Returns: An array with the count of all the documents existent in the directory
     */
    public function get_all_doc_count() {
        return sizeof($this->get_all_doc_names_array());
    }

    /*
     * Returns: A SimpleXMLElement with the names of all the documents that suffered an alteration in the hierarchy
     */
    public function get_all_doc_changed_hierarchy_names() {
        return simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/documentos_hierarquia.xml');
    }
    /*
     * Returns: An array with the names of all the documents that suffered an alteration in the hierarchy
     */
    public function get_all_doc_changed_hierarchy_names_array() {
        $xml = $this->get_all_doc_changed_hierarchy_names();
        $array = array();
        $i = 0;
        foreach($xml->doc as $doc) {
            $array[$i] = $doc;
            $i++;
        }
        return $array;
    }
    /*
     * Returns: An array with the count of all the documents that suffered an alteration in the hierarchy
     */
    public function get_all_doc_changed_hierarchy_count() {
        return sizeof($this->get_all_doc_changed_hierarchy_names());
    }
    
    /*
     * Returns: An array with the names of all the documents that were revoked or revoke another doc
     */
    public function get_all_revokes_names() {
        return simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/revogados.xml');
    }
    /*
     * Returns: An array with the count of all the documents that were revoked or revoke another doc
     */
    public function get_all_revokes_count() {
        return sizeof($this->get_all_revokes_names());
    }

    /*
     * Returns: All the numbers of the first hierarchy "Livro"
     */
    public function get_hierarchy_livro($p_doc) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = array();
        if (sizeof($array->Livro) > 0) {
            for ($i = 0; $i < sizeof($array->Livro); $i++) {
                $resposta[$i] = $array->Livro[$i]['id'];
            }
        }
        return $resposta;
    }
    /*
     * Returns: The numbers and the name of the first hierarchy "Livro"
     */
    public function get_hierarchy_livro_name($p_doc) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = array();
        if (sizeof($array->Livro) > 0) {
            for ($i = 0; $i < sizeof($array->Livro); $i++) {
                $resposta[$i][0] = $array->Livro[$i]['id'];
                $resposta[$i][1] = $array->Livro[$i]['nome'];
            }
        }
        return $resposta;
    }
    /*
     * Returns: The numbers and the name in the form of a stringof the first hierarchy "Livro"
     */
    public function get_hierarchy_livro_name_string($p_doc) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        if (sizeof($array->Livro) > 0) {
            foreach ($array->Livro as $livro) {
                $resposta .= $livro['id'] . '$' . $livro['nome'] . '_';
            }
            if (strlen($resposta) > 0) {
                return substr($resposta, 0, sizeof($resposta) - 2);
            } else {
                return $resposta;
            }
        }
        return $resposta;
    }
    
    /*
     * Returns: All the numbers of the first hierarchy "Titulo" given the previous hierarchy "Livro"
     */
    public function get_hierarchy_titulo_given_livro($p_doc, $p_livro) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($titulo != null) {
                        $resposta .= $titulo['id'] . ',';
                        $count++;
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }
    /*
     * Returns: The numbers and the name of the first hierarchy "Titulo" given the previous hierarchy "Livro"
     */
    public function get_hierarchy_titulo_name_given_livro($p_doc, $p_livro) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($titulo != null) {
                        $resposta .= $titulo['id'] . '$' . $titulo['nome'] . '_';
                        $count++;
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }
    
    /*
     * Returns: All the numbers of the first hierarchy "Subtitulo" given the previous hierarchy "Livro" & "Titulo"
     */
    public function get_hierarchy_subtitulo_given_previous($p_doc, $p_livro, $p_titulo) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Subtitulo as $subtitulo) {
                            if ($subtitulo != null) {
                                $resposta .= $subtitulo['id'] . ',';
                                $count++;
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }
    /*
     * Returns: The numbers and the name of the first hierarchy "Subtitulo" given the previous hierarchy "Livro" & "Titulo"
     */
    public function get_hierarchy_subtitulo_name_given_previous($p_doc, $p_livro, $p_titulo) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Subtitulo as $subtitulo) {
                            if ($subtitulo != null) {
                                $resposta .= $subtitulo['id'] . '$' . $subtitulo['nome'] . '_';
                                $count++;
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }
    
    /*
     * Returns: All the numbers of the first hierarchy "Capitulo" given the previous hierarchy "Livro" & "Titulo" & "Subtitulo"
     */
    public function get_hierarchy_capitulo_given_previous($p_doc, $p_livro, $p_titulo, $p_subtitulo) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Subtitulo as $subtitulo) {
                            if ($p_subtitulo == (string) $subtitulo['id']) {
                                foreach ($subtitulo->Capitulo as $capitulo) {
                                    if ($capitulo != null) {
                                        $resposta .= $capitulo['id'] . ',';
                                        $count++;
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }
    /*
     * Returns: All the numbers of the first hierarchy "Capitulo" given the previous hierarchy "Livro" & "Titulo" & "Subtitulo"
     */
    public function get_hierarchy_capitulo_name_given_previous($p_doc, $p_livro, $p_titulo, $p_subtitulo) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Subtitulo as $subtitulo) {
                            if ($p_subtitulo == (string) $subtitulo['id']) {
                                foreach ($subtitulo->Capitulo as $capitulo) {
                                    if ($capitulo != null) {
                                        $resposta .= $capitulo['id'] . '$' . $capitulo['nome'] . '_';
                                        $count++;
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }
    /*
     * Returns: All the numbers of the first hierarchy "Capitulo" given the previous hierarchy "Livro" & "Titulo" & "Subtitulo"
     */
    public function get_hierarchy_capitulo_given_previous_no_subtitulo($p_doc, $p_livro, $p_titulo) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Capitulo as $capitulo) {
                            if ($capitulo != null) {
                                $resposta .= $capitulo['id'] . ',';
                                $count++;
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }
    /*
     * Returns: All the numbers of the first hierarchy "Capitulo" given the previous hierarchy "Livro" & "Titulo" & "Subtitulo"
     */
    public function get_hierarchy_capitulo_name_given_previous_no_subtitulo($p_doc, $p_livro, $p_titulo) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Capitulo as $capitulo) {
                            if ($capitulo != null) {
                                $resposta .= $capitulo['id'] . '$' . $capitulo['nome'] . '_';
                                $count++;
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }
    
    /*
     * Returns: All the numbers of the first hierarchy "Seccao" given the previous hierarchy "Livro" & "Titulo" & "Subtitulo" & "Capitulo"
     */
    public function get_hierarchy_seccao_given_previous($p_doc, $p_livro, $p_titulo, $p_subtitulo, $p_capitulo) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Subtitulo as $subtitulo) {
                            if ($p_subtitulo == (string) $subtitulo['id']) {
                                foreach ($subtitulo->Capitulo as $capitulo) {
                                    if ($p_capitulo == (string) $capitulo['id']) {
                                        foreach ($capitulo->Seccao as $seccao) {
                                            if ($seccao != null) {
                                                $resposta .= $seccao['id'] . ',';
                                                $count++;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }
    /*
     * Returns: The number and the name of the first hierarchy "Seccao" given the previous hierarchy "Livro" & "Titulo" & "Subtitulo" & "Capitulo"
     */
    public function get_hierarchy_seccao_name_given_previous($p_doc, $p_livro, $p_titulo, $p_subtitulo, $p_capitulo) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Subtitulo as $subtitulo) {
                            if ($p_subtitulo == (string) $subtitulo['id']) {
                                foreach ($subtitulo->Capitulo as $capitulo) {
                                    if ($p_capitulo == (string) $capitulo['id']) {
                                        foreach ($capitulo->Seccao as $seccao) {
                                            if ($seccao != null) {
                                                $resposta .= $seccao['id'] . '$' . $seccao['nome'] . '_';
                                                $count++;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }
    /*
     * Returns: All the numbers of the first hierarchy "Seccao" given the previous hierarchy "Livro" & "Titulo" & "Capitulo"
     */
    public function get_hierarchy_seccao_given_previous_no_subtitulo($p_doc, $p_livro, $p_titulo, $p_capitulo) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Capitulo as $capitulo) {
                            if ($p_capitulo == (string) $capitulo['id']) {
                                foreach ($capitulo->Seccao as $seccao) {
                                    if ($seccao != null) {
                                        $resposta .= $seccao['id'] . ',';
                                        $count++;
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }
    /*
     * Returns: The number and the name of the first hierarchy "Seccao" given the previous hierarchy "Livro" & "Titulo" & "Capitulo"
     */
    public function get_hierarchy_seccao_name_given_previous_no_subtitulo($p_doc, $p_livro, $p_titulo, $p_capitulo) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Capitulo as $capitulo) {
                            if ($p_capitulo == (string) $capitulo['id']) {
                                foreach ($capitulo->Seccao as $seccao) {
                                    if ($seccao != null) {
                                        $resposta .= $seccao['id'] . '$' . $seccao['nome'] . '_';
                                        $count++;
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }

    /*
     * Returns: All the numbers of the first hierarchy "Subseccao" given the previous hierarchy "Livro" & "Titulo" & "Subtitulo" & "Capitulo" & "Seccao"
     */
    public function get_hierarchy_subseccao_given_previous($p_doc, $p_livro, $p_titulo, $p_subtitulo, $p_capitulo, $p_seccao) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Subtitulo as $subtitulo) {
                            if ($p_subtitulo == (string) $subtitulo['id']) {
                                foreach ($subtitulo->Capitulo as $capitulo) {
                                    if ($p_capitulo == (string) $capitulo['id']) {
                                        foreach ($capitulo->Seccao as $seccao) {
                                            if ($p_seccao == (string) $seccao['id']) {
                                                foreach ($seccao->Subseccao as $subseccao) {
                                                    if ($subseccao != null) {
                                                        $resposta .= $subseccao['id'] . ',';
                                                        $count++;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }
    /*
     * Returns: All the numbers of the first hierarchy "Subseccao" given the previous hierarchy "Livro" & "Titulo" & "Subtitulo" & "Capitulo" & "Seccao"
     */
    public function get_hierarchy_subseccao_name_given_previous($p_doc, $p_livro, $p_titulo, $p_subtitulo, $p_capitulo, $p_seccao) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Subtitulo as $subtitulo) {
                            if ($p_subtitulo == (string) $subtitulo['id']) {
                                foreach ($subtitulo->Capitulo as $capitulo) {
                                    if ($p_capitulo == (string) $capitulo['id']) {
                                        foreach ($capitulo->Seccao as $seccao) {
                                            if ($p_seccao == (string) $seccao['id']) {
                                                foreach ($seccao->Subseccao as $subseccao) {
                                                    if ($subseccao != null) {
                                                        $resposta .= $subseccao['id'] . '$' . $subseccao['nome'] . '_';
                                                        $count++;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }
    /*
     * Returns: All the numbers of the first hierarchy "Subseccao" given the previous hierarchy "Livro" & "Titulo" & "Capitulo" & "Seccao"
     */
    public function get_hierarchy_subseccao_given_previous_no_subtitulo($p_doc, $p_livro, $p_titulo, $p_capitulo, $p_seccao) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Capitulo as $capitulo) {
                            if ($p_capitulo == (string) $capitulo['id']) {
                                foreach ($capitulo->Seccao as $seccao) {
                                    if ($p_seccao == (string) $seccao['id']) {
                                        foreach ($seccao->Subseccao as $subseccao) {
                                            if ($subseccao != null) {
                                                $resposta .= $subseccao['id'] . ',';
                                                $count++;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }
    /*
     * Returns: All the numbers of the first hierarchy "Subseccao" given the previous hierarchy "Livro" & "Titulo" & "Capitulo" & "Seccao"
     */
    public function get_hierarchy_subseccao_name_given_previous_no_subtitulo($p_doc, $p_livro, $p_titulo, $p_capitulo, $p_seccao) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Capitulo as $capitulo) {
                            if ($p_capitulo == (string) $capitulo['id']) {
                                foreach ($capitulo->Seccao as $seccao) {
                                    if ($p_seccao == (string) $seccao['id']) {
                                        foreach ($seccao->Subseccao as $subseccao) {
                                            if ($subseccao != null) {
                                                $resposta .= $subseccao['id'] . '$' . $subseccao['nome'] . '_';
                                                $count++;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }

    /*
     * Returns: All the numbers of the first hierarchy "Divisao" given the previous hierarchy "Livro" & "Titulo" & "Subtitulo" & "Capitulo" & "Seccao" & "Subseccao"
     */
    public function get_hierarchy_divisao_given_previous($p_doc, $p_livro, $p_titulo, $p_subtitulo, $p_capitulo, $p_seccao, $p_subseccao) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Subtitulo as $subtitulo) {
                            if ($p_subtitulo == (string) $subtitulo['id']) {
                                foreach ($subtitulo->Capitulo as $capitulo) {
                                    if ($p_capitulo == (string) $capitulo['id']) {
                                        foreach ($capitulo->Seccao as $seccao) {
                                            if ($p_seccao == (string) $seccao['id']) {
                                                foreach ($seccao->Subseccao as $subseccao) {
                                                    if ($p_subseccao == (string) $subseccao['id']) {
                                                        foreach ($subseccao->Divisao as $divisao) {
                                                            if ($divisao != null) {
                                                                $resposta .= $divisao['id'] . ',';
                                                                $count++;
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }
    /*
     * Returns: All the numbers of the first hierarchy "Divisao" given the previous hierarchy "Livro" & "Titulo" & "Subtitulo" & "Capitulo" & "Seccao" & "Subseccao"
     */
    public function get_hierarchy_divisao_name_given_previous($p_doc, $p_livro, $p_titulo, $p_subtitulo, $p_capitulo, $p_seccao, $p_subseccao) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Subtitulo as $subtitulo) {
                            if ($p_subtitulo == (string) $subtitulo['id']) {
                                foreach ($subtitulo->Capitulo as $capitulo) {
                                    if ($p_capitulo == (string) $capitulo['id']) {
                                        foreach ($capitulo->Seccao as $seccao) {
                                            if ($p_seccao == (string) $seccao['id']) {
                                                foreach ($seccao->Subseccao as $subseccao) {
                                                    if ($p_subseccao == (string) $subseccao['id']) {
                                                        foreach ($subseccao->Divisao as $divisao) {
                                                            if ($divisao != null) {
                                                                $resposta .= $divisao['id'] . '$' . $divisao['nome'] . '_';
                                                                $count++;
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }
    /*
     * Returns: All the numbers of the first hierarchy "Subseccao" given the previous hierarchy "Livro" & "Titulo" & "Capitulo" & "Seccao" & "Subseccao"
     */
    public function get_hierarchy_divisao_given_previous_no_subtitulo($p_doc, $p_livro, $p_titulo, $p_capitulo, $p_seccao, $p_subseccao) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Capitulo as $capitulo) {
                            if ($p_capitulo == (string) $capitulo['id']) {
                                foreach ($capitulo->Seccao as $seccao) {
                                    if ($p_seccao == (string) $seccao['id']) {
                                        foreach ($seccao->Subseccao as $subseccao) {
                                            if ($p_subseccao == (string) $subseccao['id']) {
                                                foreach ($subseccao->Divisao as $divisao) {
                                                    if ($divisao != null) {
                                                        $resposta .= $divisao['id'] . ',';
                                                        $count++;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }
    /*
     * Returns: All the numbers of the first hierarchy "Subseccao" given the previous hierarchy "Livro" & "Titulo" & "Capitulo" & "Seccao" & "Subseccao"
     */
    public function get_hierarchy_divisao_name_given_previous_no_subtitulo($p_doc, $p_livro, $p_titulo, $p_capitulo, $p_seccao, $p_subseccao) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Capitulo as $capitulo) {
                            if ($p_capitulo == (string) $capitulo['id']) {
                                foreach ($capitulo->Seccao as $seccao) {
                                    if ($p_seccao == (string) $seccao['id']) {
                                        foreach ($seccao->Subseccao as $subseccao) {
                                            if ($p_subseccao == (string) $subseccao['id']) {
                                                foreach ($subseccao->Divisao as $divisao) {
                                                    if ($divisao != null) {
                                                        $resposta .= $divisao['id'] . '$' . $divisao['nome'] . '_';
                                                        $count++;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }

    /*
     * Returns: All the numbers of the first hierarchy "Subdivisao" given the previous hierarchy "Livro" & "Titulo" & "Subtitulo" & "Capitulo" & "Seccao" & "Subseccao" & "Divisao"
     */
    public function get_hierarchy_subdivisao_given_previous($p_doc, $p_livro, $p_titulo, $p_subtitulo, $p_capitulo, $p_seccao, $p_subseccao, $p_divisao) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Subtitulo as $subtitulo) {
                            if ($p_subtitulo == (string) $subtitulo['id']) {
                                foreach ($subtitulo->Capitulo as $capitulo) {
                                    if ($p_capitulo == (string) $capitulo['id']) {
                                        foreach ($capitulo->Seccao as $seccao) {
                                            if ($p_seccao == (string) $seccao['id']) {
                                                foreach ($seccao->Subseccao as $subseccao) {
                                                    if ($p_subseccao == (string) $subseccao['id']) {
                                                        foreach ($subseccao->Divisao as $divisao) {
                                                            if ($p_divisao == (string) $divisao['id']) {
                                                                foreach ($divisao->Subdivisao as $subdivisao) {
                                                                    if ($subdivisao != null) {
                                                                        $resposta .= $subdivisao['id'] . ',';
                                                                        $count++;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }
    /*
     * Returns: All the numbers of the first hierarchy "Subdivisao" given the previous hierarchy "Livro" & "Titulo" & "Subtitulo" & "Capitulo" & "Seccao" & "Subseccao" & "Divisao"
     */
    public function get_hierarchy_subdivisao_name_given_previous($p_doc, $p_livro, $p_titulo, $p_subtitulo, $p_capitulo, $p_seccao, $p_subseccao, $p_divisao) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Subtitulo as $subtitulo) {
                            if ($p_subtitulo == (string) $subtitulo['id']) {
                                foreach ($subtitulo->Capitulo as $capitulo) {
                                    if ($p_capitulo == (string) $capitulo['id']) {
                                        foreach ($capitulo->Seccao as $seccao) {
                                            if ($p_seccao == (string) $seccao['id']) {
                                                foreach ($seccao->Subseccao as $subseccao) {
                                                    if ($p_subseccao == (string) $subseccao['id']) {
                                                        foreach ($subseccao->Divisao as $divisao) {
                                                            if ($p_divisao == (string) $divisao['id']) {
                                                                foreach ($divisao->Subdivisao as $subdivisao) {
                                                                    if ($subdivisao != null) {
                                                                        $resposta .= $subdivisao['id'] . '$' . $subdivisao['nome'] . '_';
                                                                        $count++;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }
    /*
     * Returns: All the numbers of the first hierarchy "Subdivisao" given the previous hierarchy "Livro" & "Titulo" & "Capitulo" & "Seccao" & "Subseccao" & "Divisao"
     */
    public function get_hierarchy_subdivisao_given_previous_no_subtitulo($p_doc, $p_livro, $p_titulo, $p_capitulo, $p_seccao, $p_subseccao, $p_divisao) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Capitulo as $capitulo) {
                            if ($p_capitulo == (string) $capitulo['id']) {
                                foreach ($capitulo->Seccao as $seccao) {
                                    if ($p_seccao == (string) $seccao['id']) {
                                        foreach ($seccao->Subseccao as $subseccao) {
                                            if ($p_subseccao == (string) $subseccao['id']) {
                                                foreach ($subseccao->Divisao as $divisao) {
                                                    if ($p_divisao == (string) $divisao['id']) {
                                                        foreach ($divisao->Subdivisao as $subdivisao) {
                                                            if ($subdivisao != null) {
                                                                $resposta .= $subdivisao['id'] . ',';
                                                                $count++;
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }
    /*
     * Returns: All the numbers of the first hierarchy "Subdivisao" given the previous hierarchy "Livro" & "Titulo" & "Capitulo" & "Seccao" & "Subseccao" & "Divisao"
     */
    public function get_hierarchy_subdivisao_name_given_previous_no_subtitulo($p_doc, $p_livro, $p_titulo, $p_capitulo, $p_seccao, $p_subseccao, $p_divisao) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Capitulo as $capitulo) {
                            if ($p_capitulo == (string) $capitulo['id']) {
                                foreach ($capitulo->Seccao as $seccao) {
                                    if ($p_seccao == (string) $seccao['id']) {
                                        foreach ($seccao->Subseccao as $subseccao) {
                                            if ($p_subseccao == (string) $subseccao['id']) {
                                                foreach ($subseccao->Divisao as $divisao) {
                                                    if ($p_divisao == (string) $divisao['id']) {
                                                        foreach ($divisao->Subdivisao as $subdivisao) {
                                                            if ($subdivisao != null) {
                                                                $resposta .= $subdivisao['id'] . '$' . $subdivisao['nome'] . '_';
                                                                $count++;
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }

    /*
     * Returns: All the numbers of the first hierarchy "Artigo" given the previous hierarchy "Livro" & "Titulo" & "Subtitulo" & "Capitulo" & "Seccao" & "Subseccao" & "Divisao" & "Subdivisao"
     */
    public function get_hierarchy_artigo_given_previous($p_doc, $p_livro, $p_titulo, $p_subtitulo, $p_capitulo, $p_seccao, $p_subseccao, $p_divisao, $p_subdivisao) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Subtitulo as $subtitulo) {
                            if ($p_subtitulo == (string) $subtitulo['id']) {
                                foreach ($subtitulo->Capitulo as $capitulo) {
                                    if ($p_capitulo == (string) $capitulo['id']) {
                                        foreach ($capitulo->Seccao as $seccao) {
                                            if ($p_seccao == (string) $seccao['id']) {
                                                foreach ($seccao->Subseccao as $subseccao) {
                                                    if ($p_subseccao == (string) $subseccao['id']) {
                                                        foreach ($subseccao->Divisao as $divisao) {
                                                            if ($p_divisao == (string) $divisao['id']) {
                                                                foreach ($divisao->Subdivisao as $subdivisao) {
                                                                    if ($p_subdivisao == (string) $subdivisao['id']) {
                                                                        foreach ($subdivisao->artigo as $artigo) {
                                                                            if ($artigo != null) {
                                                                                $resposta .= $artigo . ',';
                                                                                $count++;
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }
    /*
     * Returns: All the numbers of the first hierarchy "Artigo" given the previous hierarchy "Livro" & "Titulo" & "Capitulo" & "Seccao" & "Subseccao" & "Divisao" & "Subdivisao"
     */
    public function get_hierarchy_artigo_given_previous_no_subtitulo($p_doc, $p_livro, $p_titulo, $p_capitulo, $p_seccao, $p_subseccao, $p_divisao, $p_subdivisao) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Capitulo as $capitulo) {
                            if ($p_capitulo == (string) $capitulo['id']) {
                                foreach ($capitulo->Seccao as $seccao) {
                                    if ($p_seccao == (string) $seccao['id']) {
                                        foreach ($seccao->Subseccao as $subseccao) {
                                            if ($p_subseccao == (string) $subseccao['id']) {
                                                foreach ($subseccao->Divisao as $divisao) {
                                                    if ($p_divisao == (string) $divisao['id']) {
                                                        foreach ($divisao->Subdivisao as $subdivisao) {
                                                            if ($p_subdivisao == (string) $subdivisao['id']) {
                                                                foreach ($subdivisao->artigo as $artigo) {
                                                                    if ($artigo != null) {
                                                                        $resposta .= $artigo . ',';
                                                                        $count++;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }

    /*
     * Returns: All the numbers of the first hierarchy "artigo" given the previous hierarchy all the way up to "Titulo"
     */
    public function get_hierarchy_artigo_given_previous_and_titulo($p_doc, $p_livro, $p_titulo) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->artigo as $artigo) {
                            if ($artigo != null) {
                                $resposta .= $artigo . ',';
                                $count++;
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }
    /*
     * Returns: All the numbers of the first hierarchy "artigo" given the previous hierarchy all the way up to "Titulo"
     */
    public function get_hierarchy_artigo_name_given_previous_and_titulo($p_doc, $p_livro, $p_titulo) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->artigo as $artigo) {
                            if ($artigo != null) {
                                $resposta = $this->process_article($artigo, $p_doc, $resposta);
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }
    
    /*
     * Returns: All the numbers of the first hierarchy "artigo" given the previous hierarchy all the way up to "Subtitulo"
     */
    public function get_hierarchy_artigo_given_previous_and_subtitulo($p_doc, $p_livro, $p_titulo, $p_subtitulo) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Subtitulo as $subtitulo) {
                            if ($p_subtitulo == (string) $subtitulo['id']) {
                                foreach ($subtitulo->artigo as $artigo) {
                                    if ($artigo != null) {
                                        $resposta .= $artigo . ',';
                                        $count++;
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }
    /*
     * Returns: All the numbers of the first hierarchy "artigo" given the previous hierarchy all the way up to "Subtitulo"
     */
    public function get_hierarchy_artigo_name_given_previous_and_subtitulo($p_doc, $p_livro, $p_titulo, $p_subtitulo) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Subtitulo as $subtitulo) {
                            if ($p_subtitulo == (string) $subtitulo['id']) {
                                foreach ($subtitulo->artigo as $artigo) {
                                    if ($artigo != null) {
                                        $resposta = $this->process_article($artigo, $p_doc, $resposta);
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }

    /*
     * Returns: All the numbers of the first hierarchy "artigo" given the previous hierarchy all the way up to "Capitulo"
     */
    public function get_hierarchy_artigo_given_previous_and_capitulo($p_doc, $p_livro, $p_titulo, $p_subtitulo, $p_capitulo) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Subtitulo as $subtitulo) {
                            if ($p_subtitulo == (string) $subtitulo['id']) {
                                foreach ($subtitulo->Capitulo as $capitulo) {
                                    if ($p_capitulo == (string) $capitulo['id']) {
                                        foreach ($capitulo->artigo as $artigo) {
                                            if ($artigo != null) {
                                                $resposta .= $artigo . ',';
                                                $count++;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }
    /*
     * Returns: All the numbers of the first hierarchy "artigo" given the previous hierarchy all the way up to "Capitulo"
     */
    public function get_hierarchy_artigo_name_given_previous_and_capitulo($p_doc, $p_livro, $p_titulo, $p_subtitulo, $p_capitulo) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Subtitulo as $subtitulo) {
                            if ($p_subtitulo == (string) $subtitulo['id']) {
                                foreach ($subtitulo->Capitulo as $capitulo) {
                                    if ($p_capitulo == (string) $capitulo['id']) {
                                        foreach ($capitulo->artigo as $artigo) {
                                            if ($artigo != null) {
                                                $resposta = $this->process_article($artigo, $p_doc, $resposta);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }
    /*
     * Returns: All the numbers of the first hierarchy "artigo" given the previous hierarchy all the way up to "Capitulo" and it doesnt have the hierarchy "Subtitulo"
     */
    public function get_hierarchy_artigo_given_previous_and_capitulo_no_subtitulo($p_doc, $p_livro, $p_titulo, $p_capitulo) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Capitulo as $capitulo) {
                            if ($p_capitulo == (string) $capitulo['id']) {
                                foreach ($capitulo->artigo as $artigo) {
                                    if ($artigo != null) {
                                        $resposta .= $artigo . ',';
                                        $count++;
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }
    /*
     * Returns: All the numbers of the first hierarchy "artigo" given the previous hierarchy all the way up to "Capitulo" and it doesnt have the hierarchy "Subtitulo"
     */
    public function get_hierarchy_artigo_name_given_previous_and_capitulo_no_subtitulo($p_doc, $p_livro, $p_titulo, $p_capitulo) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Capitulo as $capitulo) {
                            if ($p_capitulo == (string) $capitulo['id']) {
                                foreach ($capitulo->artigo as $artigo) {
                                    if ($artigo != null) {
                                        $resposta = $this->process_article($artigo, $p_doc, $resposta);
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }

    /*
     * Returns: All the numbers of the first hierarchy "artigo" given the previous hierarchy all the way up to "Seccao"
     */
    public function get_hierarchy_artigo_given_previous_and_seccao($p_doc, $p_livro, $p_titulo, $p_subtitulo, $p_capitulo, $p_seccao) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Subtitulo as $subtitulo) {
                            if ($p_subtitulo == (string) $subtitulo['id']) {
                                foreach ($subtitulo->Capitulo as $capitulo) {
                                    if ($p_capitulo == (string) $capitulo['id']) {
                                        foreach ($capitulo->Seccao as $seccao) {
                                            if ($p_seccao == (string) $seccao['id']) {
                                                foreach ($seccao->artigo as $artigo) {
                                                    if ($artigo != null) {
                                                        $resposta .= $artigo . ',';
                                                        $count++;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }
    /*
     * Returns: All the numbers of the first hierarchy "artigo" given the previous hierarchy all the way up to "Seccao"
     */
    public function get_hierarchy_artigo_name_given_previous_and_seccao($p_doc, $p_livro, $p_titulo, $p_subtitulo, $p_capitulo, $p_seccao) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Subtitulo as $subtitulo) {
                            if ($p_subtitulo == (string) $subtitulo['id']) {
                                foreach ($subtitulo->Capitulo as $capitulo) {
                                    if ($p_capitulo == (string) $capitulo['id']) {
                                        foreach ($capitulo->Seccao as $seccao) {
                                            if ($p_seccao == (string) $seccao['id']) {
                                                foreach ($seccao->artigo as $artigo) {
                                                    if ($artigo != null) {
                                                        $resposta = $this->process_article($artigo, $p_doc, $resposta);
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }
    /*
     * Returns: All the numbers of the first hierarchy "artigo" given the previous hierarchy all the way up to "Seccao" and it doesnt have the hierarchy "Subtitulo"
     */
    public function get_hierarchy_artigo_given_previous_and_seccao_no_subtitulo($p_doc, $p_livro, $p_titulo, $p_capitulo, $p_seccao) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Capitulo as $capitulo) {
                            if ($p_capitulo == (string) $capitulo['id']) {
                                foreach ($capitulo->Seccao as $seccao) {
                                    if ($p_seccao == (string) $seccao['id']) {
                                        foreach ($seccao->artigo as $artigo) {
                                            if ($artigo != null) {
                                                $resposta .= $artigo . ',';
                                                $count++;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }
    /*
     * Returns: All the numbers of the first hierarchy "artigo" given the previous hierarchy all the way up to "Seccao" and it doesnt have the hierarchy "Subtitulo"
     */
    public function get_hierarchy_artigo_name_given_previous_and_seccao_no_subtitulo($p_doc, $p_livro, $p_titulo, $p_capitulo, $p_seccao) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Capitulo as $capitulo) {
                            if ($p_capitulo == (string) $capitulo['id']) {
                                foreach ($capitulo->Seccao as $seccao) {
                                    if ($p_seccao == (string) $seccao['id']) {
                                        foreach ($seccao->artigo as $artigo) {
                                            if ($artigo != null) {
                                                $resposta = $this->process_article($artigo, $p_doc, $resposta);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }

    /*
     * Returns: All the numbers of the first hierarchy "artigo" given the previous hierarchy all the way up to "Subseccao"
     */
    public function get_hierarchy_artigo_given_previous_and_subseccao($p_doc, $p_livro, $p_titulo, $p_subtitulo, $p_capitulo, $p_seccao, $p_subseccao) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Subtitulo as $subtitulo) {
                            if ($p_subtitulo == (string) $subtitulo['id']) {
                                foreach ($subtitulo->Capitulo as $capitulo) {
                                    if ($p_capitulo == (string) $capitulo['id']) {
                                        foreach ($capitulo->Seccao as $seccao) {
                                            if ($p_seccao == (string) $seccao['id']) {
                                                foreach ($seccao->Subseccao as $subseccao) {
                                                    if ($p_subseccao == (string) $subseccao['id']) {
                                                        foreach ($subseccao->artigo as $artigo) {
                                                            if ($artigo != null) {
                                                                $resposta .= $artigo . ',';
                                                                $count++;
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }
    /*
     * Returns: All the numbers of the first hierarchy "artigo" given the previous hierarchy all the way up to "Subseccao"
     */
    public function get_hierarchy_artigo_name_given_previous_and_subseccao($p_doc, $p_livro, $p_titulo, $p_subtitulo, $p_capitulo, $p_seccao, $p_subseccao) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Subtitulo as $subtitulo) {
                            if ($p_subtitulo == (string) $subtitulo['id']) {
                                foreach ($subtitulo->Capitulo as $capitulo) {
                                    if ($p_capitulo == (string) $capitulo['id']) {
                                        foreach ($capitulo->Seccao as $seccao) {
                                            if ($p_seccao == (string) $seccao['id']) {
                                                foreach ($seccao->Subseccao as $subseccao) {
                                                    if ($p_subseccao == (string) $subseccao['id']) {
                                                        foreach ($subseccao->artigo as $artigo) {
                                                            if ($artigo != null) {
                                                                $resposta = $this->process_article($artigo, $p_doc, $resposta);
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }
    /*
     * Returns: All the numbers of the first hierarchy "artigo" given the previous hierarchy all the way up to "Subseccao" and it doesnt have the hierarchy "Subtitulo"
     */
    public function get_hierarchy_artigo_given_previous_and_subseccao_no_subtitulo($p_doc, $p_livro, $p_titulo, $p_capitulo, $p_seccao, $p_subseccao) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Capitulo as $capitulo) {
                            if ($p_capitulo == (string) $capitulo['id']) {
                                foreach ($capitulo->Seccao as $seccao) {
                                    if ($p_seccao == (string) $seccao['id']) {
                                        foreach ($seccao->Subseccao as $subseccao) {
                                            if ($p_subseccao == (string) $subseccao['id']) {
                                                foreach ($subseccao->artigo as $artigo) {
                                                    if ($artigo != null) {
                                                        $resposta .= $artigo . ',';
                                                        $count++;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }
    /*
     * Returns: All the numbers of the first hierarchy "artigo" given the previous hierarchy all the way up to "Subseccao" and it doesnt have the hierarchy "Subtitulo"
     */
    public function get_hierarchy_artigo_name_given_previous_and_subseccao_no_subtitulo($p_doc, $p_livro, $p_titulo, $p_capitulo, $p_seccao, $p_subseccao) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Capitulo as $capitulo) {
                            if ($p_capitulo == (string) $capitulo['id']) {
                                foreach ($capitulo->Seccao as $seccao) {
                                    if ($p_seccao == (string) $seccao['id']) {
                                        foreach ($seccao->Subseccao as $subseccao) {
                                            if ($p_subseccao == (string) $subseccao['id']) {
                                                foreach ($subseccao->artigo as $artigo) {
                                                    if ($artigo != null) {
                                                        $resposta = $this->process_article($artigo, $p_doc, $resposta);
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }

    /*
     * Returns: All the numbers of the first hierarchy "artigo" given the previous hierarchy all the way up to "Divisao"
     */
    public function get_hierarchy_artigo_given_previous_and_divisao($p_doc, $p_livro, $p_titulo, $p_subtitulo, $p_capitulo, $p_seccao, $p_subseccao, $p_divisao) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Subtitulo as $subtitulo) {
                            if ($p_subtitulo == (string) $subtitulo['id']) {
                                foreach ($subtitulo->Capitulo as $capitulo) {
                                    if ($p_capitulo == (string) $capitulo['id']) {
                                        foreach ($capitulo->Seccao as $seccao) {
                                            if ($p_seccao == (string) $seccao['id']) {
                                                foreach ($seccao->Subseccao as $subseccao) {
                                                    if ($p_subseccao == (string) $subseccao['id']) {
                                                        foreach ($subseccao->Divisao as $divisao) {
                                                            if ($p_divisao == (string) $divisao['id']) {
                                                                foreach ($divisao->artigo as $artigo) {
                                                                    if ($artigo != null) {
                                                                        $resposta .= $artigo . ',';
                                                                        $count++;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }
    /*
     * Returns: All the numbers of the first hierarchy "artigo" given the previous hierarchy all the way up to "Divisao"
     */
    public function get_hierarchy_artigo_name_given_previous_and_divisao($p_doc, $p_livro, $p_titulo, $p_subtitulo, $p_capitulo, $p_seccao, $p_subseccao, $p_divisao) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Subtitulo as $subtitulo) {
                            if ($p_subtitulo == (string) $subtitulo['id']) {
                                foreach ($subtitulo->Capitulo as $capitulo) {
                                    if ($p_capitulo == (string) $capitulo['id']) {
                                        foreach ($capitulo->Seccao as $seccao) {
                                            if ($p_seccao == (string) $seccao['id']) {
                                                foreach ($seccao->Subseccao as $subseccao) {
                                                    if ($p_subseccao == (string) $subseccao['id']) {
                                                        foreach ($subseccao->Divisao as $divisao) {
                                                            if ($p_divisao == (string) $divisao['id']) {
                                                                foreach ($divisao->artigo as $artigo) {
                                                                    if ($artigo != null) {
                                                                        $resposta = $this->process_article($artigo, $p_doc, $resposta);
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }
    /*
     * Returns: All the numbers of the first hierarchy "artigo" given the previous hierarchy all the way up to "Subseccao" and it doesnt have the hierarchy "Subtitulo"
     */
    public function get_hierarchy_artigo_given_previous_and_divisao_no_subtitulo($p_doc, $p_livro, $p_titulo, $p_capitulo, $p_seccao, $p_subseccao, $p_divisao) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Capitulo as $capitulo) {
                            if ($p_capitulo == (string) $capitulo['id']) {
                                foreach ($capitulo->Seccao as $seccao) {
                                    if ($p_seccao == (string) $seccao['id']) {
                                        foreach ($seccao->Subseccao as $subseccao) {
                                            if ($p_subseccao == (string) $subseccao['id']) {
                                                foreach ($subseccao->Divisao as $divisao) {
                                                    if ($p_divisao == (string) $divisao['id']) {
                                                        foreach ($divisao->artigo as $artigo) {
                                                            if ($artigo != null) {
                                                                $resposta .= $artigo . ',';
                                                                $count++;
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }
    /*
     * Returns: All the numbers of the first hierarchy "artigo" given the previous hierarchy all the way up to "Subseccao" and it doesnt have the hierarchy "Subtitulo"
     */
    public function get_hierarchy_artigo_name_given_previous_and_divisao_no_subtitulo($p_doc, $p_livro, $p_titulo, $p_capitulo, $p_seccao, $p_subseccao, $p_divisao) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Capitulo as $capitulo) {
                            if ($p_capitulo == (string) $capitulo['id']) {
                                foreach ($capitulo->Seccao as $seccao) {
                                    if ($p_seccao == (string) $seccao['id']) {
                                        foreach ($seccao->Subseccao as $subseccao) {
                                            if ($p_subseccao == (string) $subseccao['id']) {
                                                foreach ($subseccao->Divisao as $divisao) {
                                                    if ($p_divisao == (string) $divisao['id']) {
                                                        foreach ($divisao->artigo as $artigo) {
                                                            if ($artigo != null) {
                                                                $resposta = $this->process_article($artigo, $p_doc, $resposta);
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }

    /*
     * Returns: All the numbers of the first hierarchy "artigo" given the previous hierarchy all the way up to "Divisao"
     */
    public function get_hierarchy_artigo_given_previous_and_subdivisao($p_doc, $p_livro, $p_titulo, $p_subtitulo, $p_capitulo, $p_seccao, $p_subseccao, $p_divisao, $p_subdivisao) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Subtitulo as $subtitulo) {
                            if ($p_subtitulo == (string) $subtitulo['id']) {
                                foreach ($subtitulo->Capitulo as $capitulo) {
                                    if ($p_capitulo == (string) $capitulo['id']) {
                                        foreach ($capitulo->Seccao as $seccao) {
                                            if ($p_seccao == (string) $seccao['id']) {
                                                foreach ($seccao->Subseccao as $subseccao) {
                                                    if ($p_subseccao == (string) $subseccao['id']) {
                                                        foreach ($subseccao->Divisao as $divisao) {
                                                            if ($p_divisao == (string) $divisao['id']) {
                                                                foreach ($divisao->Subdivisao as $subdivisao) {
                                                                    if ($p_subdivisao == (string) $subdivisao['id']) {
                                                                        foreach ($subdivisao->artigo as $artigo) {
                                                                            if ($artigo != null) {
                                                                                $resposta .= $artigo . ',';
                                                                                $count++;
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }
    /*
     * Returns: All the numbers of the first hierarchy "artigo" given the previous hierarchy all the way up to "Divisao"
     */
    public function get_hierarchy_artigo_name_given_previous_and_subdivisao($p_doc, $p_livro, $p_titulo, $p_subtitulo, $p_capitulo, $p_seccao, $p_subseccao, $p_divisao, $p_subdivisao) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Subtitulo as $subtitulo) {
                            if ($p_subtitulo == (string) $subtitulo['id']) {
                                foreach ($subtitulo->Capitulo as $capitulo) {
                                    if ($p_capitulo == (string) $capitulo['id']) {
                                        foreach ($capitulo->Seccao as $seccao) {
                                            if ($p_seccao == (string) $seccao['id']) {
                                                foreach ($seccao->Subseccao as $subseccao) {
                                                    if ($p_subseccao == (string) $subseccao['id']) {
                                                        foreach ($subseccao->Divisao as $divisao) {
                                                            if ($p_divisao == (string) $divisao['id']) {
                                                                foreach ($divisao->Subdivisao as $subdivisao) {
                                                                    if ($p_subdivisao == (string) $subdivisao['id']) {
                                                                        foreach ($subdivisao->artigo as $artigo) {
                                                                            if ($artigo != null) {
                                                                                $resposta = $this->process_article($artigo, $p_doc, $resposta);
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }
    /*
     * Returns: All the numbers of the first hierarchy "artigo" given the previous hierarchy all the way up to "Subseccao" and it doesnt have the hierarchy "Subtitulo"
     */
    public function get_hierarchy_artigo_given_previous_and_subdivisao_no_subtitulo($p_doc, $p_livro, $p_titulo, $p_capitulo, $p_seccao, $p_subseccao, $p_divisao, $p_subdivisao) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Capitulo as $capitulo) {
                            if ($p_capitulo == (string) $capitulo['id']) {
                                foreach ($capitulo->Seccao as $seccao) {
                                    if ($p_seccao == (string) $seccao['id']) {
                                        foreach ($seccao->Subseccao as $subseccao) {
                                            if ($p_subseccao == (string) $subseccao['id']) {
                                                foreach ($subseccao->Divisao as $divisao) {
                                                    if ($p_divisao == (string) $divisao['id']) {
                                                        foreach ($divisao->Subdivisao as $subdivisao) {
                                                            if ($p_subdivisao == (string) $subdivisao['id']) {
                                                                foreach ($subdivisao->artigo as $artigo) {
                                                                    if ($artigo != null) {
                                                                        $resposta .= $artigo . ',';
                                                                        $count++;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }
    /*
     * Returns: All the numbers of the first hierarchy "artigo" given the previous hierarchy all the way up to "Subseccao" and it doesnt have the hierarchy "Subtitulo"
     */
    public function get_hierarchy_artigo_name_given_previous_and_subdivisao_no_subtitulo($p_doc, $p_livro, $p_titulo, $p_capitulo, $p_seccao, $p_subseccao, $p_divisao, $p_subdivisao) {
        $doc = $this->get_last_hierarchy_given_doc($p_doc);
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/hierarquia.xml');
        $resposta = "";
        $count = 0;
        foreach ($array->Livro as $livro) {
            if ($p_livro == (string) $livro['id']) {
                foreach ($livro->Titulo as $titulo) {
                    if ($p_titulo == (string) $titulo['id']) {
                        foreach ($titulo->Capitulo as $capitulo) {
                            if ($p_capitulo == (string) $capitulo['id']) {
                                foreach ($capitulo->Seccao as $seccao) {
                                    if ($p_seccao == (string) $seccao['id']) {
                                        foreach ($seccao->Subseccao as $subseccao) {
                                            if ($p_subseccao == (string) $subseccao['id']) {
                                                foreach ($subseccao->Divisao as $divisao) {
                                                    if ($p_divisao == (string) $divisao['id']) {
                                                        foreach ($divisao->Subdivisao as $subdivisao) {
                                                            if ($p_subdivisao == (string) $subdivisao['id']) {
                                                                foreach ($subdivisao->artigo as $artigo) {
                                                                    if ($artigo != null) {
                                                                        $resposta = $this->process_article($artigo, $p_doc, $resposta);
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if (strlen($resposta) > 0) {
                    return substr($resposta, 0, sizeof($resposta) - 2);
                } else {
                    return $resposta;
                }
            }
        }
        return $resposta;
    }


    //********************************************  Question  ********************************************

    /*
     * Parameters: $article (the number of the article); $doc (the date of the article)
     * Returns: true if it exists, false if it doesn't
     */
    public function does_article_exist_in_given_doc($article, $doc) {
        if ($this->was_article_altered_in_given_doc($article, $doc)) {
            return true;
        }
        if ($this->was_article_added_in_given_doc($article, $doc)) {
            return true;
        }
        if ($this->was_article_revoked_in_given_doc($article, $doc)) {
            return true;
        }
        return false;
    }

    /*
     * Parameters: $article (the number of the article); $doc (the date of the article)
     * Returns: true if it exists and it was altered, false if it doesn't exist/was altered
     */
    public function was_article_altered_in_given_doc($article, $doc) {
        if ($doc == "1966_11_25" && ($article >= 1 && $article <= 2334)) {
            return true;
        }
        $array = $this->get_doc_content($doc);
        for ($i = 0; $i <= sizeof($array->altera); $i++) {
            if ($article == $array->altera[$i]) {
                return true;
            }
        }
        return false;
    }

    /*
     * Parameters: $article (the number of the article); $doc (the date of the article)
     * Returns: true if it exists and it was added, false if it doesn't exist/was added
     */
    public function was_article_added_in_given_doc($article, $doc) {
        if ($doc == "1966_11_25") {
            return false;
        }
        $array = $this->get_doc_content($doc);
        for ($i = 0; $i <= sizeof($array->acrescenta); $i++) {
            if ($article == $array->acrescenta[$i]) {
                return true;
            }
        }
        return false;
    }

    /*
     * Parameters: $article (the number of the article); $doc (the date of the article)
     * Returns: true if it exists and it was revoked, false if it doesn't exist/was revoked
     */
    public function was_article_revoked_in_given_doc($article, $doc) {
        if ($doc == "1966_11_25") {
            return false;
        }
        $array = $this->get_doc_content($doc);
        for ($i = 0; $i <= sizeof($array->revoga); $i++) {
            if ($article == $array->revoga[$i]) {
                return true;
            }
        }
        return false;
    }

    /*
     * Parameters: $article (the number of the article)
     * Returns: the date of the document or "" if it doesn't exist
     */

    public function when_was_article_first_altered($article) {
        $number_docs = $this->get_all_doc_count();
        $docs = $this->get_all_doc_names();
        for ($i = 1; $i <= $number_docs; $i++) {
            if ($docs->doc[$i] != null) {
                if ($this->was_article_altered_in_given_doc($article, $docs->doc[$i]) == 1) {
                    return $docs->doc[$i];
                }
            }
        }
        return "";
    }

    /*
     * Parameters: $article (the number of the article)
     * Returns: the date of the document or "" if it doesn't exist
     */

    public function when_was_article_added($article) {
        $number_docs = $this->get_all_doc_count();
        $docs = $this->get_all_doc_names();
        for ($i = 1; $i <= $number_docs; $i++) {
            if ($docs->doc[$i] != null) {
                if ($this->was_article_added_in_given_doc($article, $docs->doc[$i]) == 1) {
                    return $docs->doc[$i];
                }
            }
        }
        return "";
    }

    /*
     * Parameters: $doc (the date of the doc)
     * Returns: true if it was revoked, false if it wasn't
     */
    public function was_doc_revoked($doc) {
        $number_docs = $this->get_all_revokes_count();
        $docs = $this->get_all_revokes_names();
        for ($i = 0; $i <= $number_docs; $i++) {
            for ($j = 0; $j <= sizeof($docs->doc[$i]); $j++) {
                if ($docs->doc[$i] != null) {
                    if ($docs->doc[$i]->revoga[$j] == $doc) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    /*
     * Parameters: $doc (the date of the doc)
     * Returns: true if it was revoked, false if it wasn't
     */
    public function was_doc_revoked_get_names($doc) {
        $number_docs = $this->get_all_revokes_count();
        $docs = $this->get_all_revokes_names();
        $return = null;
        for ($i = 0; $i <= $number_docs; $i++) {
            for ($j = 0; $j <= sizeof($docs->doc[$i]); $j++) {
                if ($docs->doc[$i] != null) {
                    if ($docs->doc[$i]->revoga[$j] == $doc) {
                        $return[0] = $doc;
                        $return[1] = $docs->doc[$i]['name'];
                    }
                }
            }
        }
        return $return;
    }

    /*
     * Parameters: $doc (the date of the doc)
     * Returns: true if it revokes, false if it doesn't
     */

    public function does_doc_revoke($doc) {
        $number_docs = $this->get_all_revokes_count();
        $docs = $this->get_all_revokes_names();
        for ($i = 0; $i <= $number_docs; $i++) {
            if ($docs->doc[$i]["name"] == $doc) {
                return true;
            }
        }
        return false;
    }

    /*
     * Parameters: $doc (the date of the doc)
     * Returns: the amount of revokes that the doc does, 0 if it doesn't revoke any
     */

    public function how_many_does_doc_revoke($doc) {
        $number_docs = $this->get_all_revokes_count();
        $docs = $this->get_all_revokes_names();
        for ($i = 0; $i <= $number_docs; $i++) {
            if ($docs->doc[$i]["name"] == $doc) {
                return sizeof($docs->doc[$i]->revoga);
            }
        }
        return 0;
    }
    
    /********************************* Private ************************************/
    
    private function get_last_hierarchy_given_doc($doc) {
        $doc_res = (string) $doc;
        $docs_hierarchy = $this->get_all_doc_changed_hierarchy_names_array();
        $doc_match = false;
        for ($i = 0; $i < sizeof($docs_hierarchy); $i++) {
            if ($doc_res == (string) $docs_hierarchy[$i]) {
                $doc_match = true;
            }
        }

        if ($doc_match == false) {
            $doc_res = $docs_hierarchy[sizeof($docs_hierarchy) - 1];
            for ($i = sizeof($docs_hierarchy) - 1; $i >= 0; $i--) {
                $doc1 = str_replace("_", "-", $docs_hierarchy[$i]);
                $doc2 = str_replace("_", "-", $doc);

                $doc_user = strtotime($doc2);
                $doc_list = strtotime($doc1);

                if ($doc_list > $doc_user) {
                    if ($i - 1 >= 0) {
                        $doc_res = $docs_hierarchy[$i - 1];
                        continue;
                    } else if ($i - 1 == 0) {
                        $doc_res = $docs_hierarchy[0];
                        continue;
                    }
                } else {
                    $valid = "no";
                }
            }
        }
        return $doc_res;
    }
    
    public function process_article($artigo, $doc, $resposta) {
        $doc_res = (string) $artigo;
        $doc_res_2 = "";
        $docs_hierarchy = $this->get_article_evolution_names((string) $artigo);
        $doc_match = false;
        for ($i = 0; $i < sizeof($docs_hierarchy); $i++) {
            if ((string) $artigo == (string) $docs_hierarchy[$i]) {
                $doc_match = true;
            }
        }

        if ($doc_match == false) {
            $doc_res = $docs_hierarchy[sizeof($docs_hierarchy) - 1];
            if (sizeof($docs_hierarchy) - 2 >= 0) {
                $doc_res_2 = $docs_hierarchy[sizeof($docs_hierarchy) - 2];
            }
            
            for ($i = sizeof($docs_hierarchy) - 1; $i >= 0; $i--) {
                $doc1 = str_replace("_", "-", $docs_hierarchy[$i]);
                $doc2 = str_replace("_", "-", $doc);
                $doc_user = strtotime($doc2);
                $doc_list = strtotime($doc1);

                if ($doc_list > $doc_user) {
                    if ($i - 1 >= 0) {
                        $doc_res = $docs_hierarchy[$i - 1];
                        if ($i - 2 >= 0) {
                            $doc_res_2 = $docs_hierarchy[$i - 2];
                        }
                        continue;
                    } else if ($i - 1 == 0) {
                        $doc_res = $docs_hierarchy[0];
                        continue;
                    }
                } else {
                    $valid = "no";
                }
            }
        }

        if ($doc_res_2 != $doc_res && strcmp($doc_res_2, "")) {
            $artigo_texto = $this->get_article_given_doc($artigo, (string) $doc_res);
            $old_artigo_texto = $this->get_article_given_doc($artigo, (string) $doc_res_2);
            $resp = array();
            $resp = $this->process_article_versions($artigo, $doc_res, $doc_res_2, $artigo_texto, $old_artigo_texto);
            
            if (sizeof($resp) == 0) {
                $resposta .= $artigo . "$";
                $artigo_texto = $this->get_article_given_doc($artigo, (string) $doc_res);
                $resposta .= trim($artigo_texto[0]);
                for ($i = 1; $i < sizeof($artigo_texto); $i++) {
                    $resposta .= "#" . trim($artigo_texto[$i]);
                }
                $resposta = $resposta;
                $resposta .= '_';
                return $resposta;
            } else {
                $resposta .= $artigo . "$";
                $resposta .= trim($resp[0]);
                for ($i = 1; $i < sizeof($resp); $i++) {
                    $resposta .= "#" . trim($resp[$i]);
                }

                $resposta .= '_';
                return $resposta; 
            }
        } else {
            $resposta .= $artigo . "$";
            $artigo_texto = $this->get_article_given_doc($artigo, (string) $doc_res);
            $resposta .= trim($artigo_texto[0]);
            for ($i = 1; $i < sizeof($artigo_texto); $i++) {
                $resposta .= "#" . trim($artigo_texto[$i]);
            }
            
            //$resposta = substr($resposta, 0, sizeof($resposta) - 2);
            $resposta = $resposta;
            $resposta .= '_';
            return $resposta;
        }
    }
    
    public function process_article_versions($artigo, $doc, $old_doc, $artigo_texto, $old_artigo_texto) {        
        $artigo_texto_splited = array();
        $old_artigo_texto_splited = array();
        $texto = "";
        $old_texto = "";
        
        $return = array();
        $return[0] = $artigo_texto[0];
        $return_count = 1;
        
        if (sizeof($artigo_texto) == 2) {
            $texto = $artigo_texto[1];
            $old_texto = $old_artigo_texto[1];
            if ($texto != $old_texto) {
                $return[1] = $artigo_texto[1] . "«yellow";
            }
        }
        
        if (sizeof($artigo_texto) >= sizeof($old_artigo_texto)) {
            for ($i = 1; $i < sizeof($artigo_texto); $i++) {
                if ($i < sizeof($old_artigo_texto)) {
                    $texto = trim($artigo_texto[$i]);
                    $old_texto = trim($old_artigo_texto[$i]);
                    $return[$return_count] = $texto;
                    if (strcmp($texto, $old_texto) != 0) {
                        if (sizeof(explode("...", $texto)) != 1) {
                            $return[$return_count] = $old_artigo_texto[$i];
                            $return_count++;
                        } else {
                            $return[$return_count] = $artigo_texto[$i] . "«yellow";
                            $return_count++;
                        }
                    }
                } else {
                    $return[$return_count] = $artigo_texto[$i] . "«green";
                            $return_count++;
                }
            }
        } else {
            for ($i = 1; $i < sizeof($old_artigo_texto); $i++) {
                if ($i < sizeof($artigo_texto)) {
                    $texto = trim($artigo_texto[$i]);
                    $old_texto = trim($old_artigo_texto[$i]);
                    $return[$return_count] = $texto;
                    if (strcmp($texto, $old_texto) != 0) {
                        if (sizeof(explode("...", $texto)) != 1) {
                            $return[$return_count] = $old_artigo_texto[$i];
                            $return_count++;
                        } else {
                            $return[$return_count] = $artigo_texto[$i] . "«yellow";
                            $return_count++;
                        }
                    }
                } else {
                    $return[$return_count] = $old_artigo_texto[$i] . "«red";
                            $return_count++;
                }
            }
        }
        
        return $return;
    }

}