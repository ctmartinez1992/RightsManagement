<?php

class Model_api extends CI_Model {
    
    //**********************************************  Gets  **********************************************
    
    /*
     * Parameters: $name (the name must be in the form of: "docdate/docdate_articlename.txt")
     * Returns: Array with each line of the txt in a diferent index, ranging from 0 to (number of lines-1)
     */
    public function get_article($name) {
        return explode("\n", trim(read_file('C:/wamp/www/BasicSite/codigo_civil/' . $name)));
    }
    
    /*
     * Parameters: $name (the article number); $doc (the date of the document)
     * Returns: Array with each line of the txt in a diferent index, ranging from 0 to (number of lines-1)
     */
    public function get_article_given_doc($name, $doc) {
        return explode("\n", trim(read_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/' . $doc . '_' . $name . '.txt')));
    }
    
    /*
     * Parameters: $name (the name must be in the form of: "docdate/docdate_articlename.txt")
     * Returns: The first line of the txt, which is the title
     */
    public function get_article_title($name) {
        $array = explode("\n", trim(read_file('C:/wamp/www/BasicSite/codigo_civil/' . $name)));
        return $array[0];
    }
    
    /*
     * Parameters: $name (the article number); $doc (the date of the document)
     * Returns: The first line of the txt, which is the title
     */
    public function get_article_title_given_doc($name, $doc) {
        $array = explode("\n", trim(read_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/' . $doc . '_' . $name . '.txt')));
        return $array[0];
    }
    
    /*
     * Parameters: $name (the name must be in the form of: "docdate/docdate_articlename.txt")
     * Returns: Array with each line of the txt except the title in a diferent index, ranging from 0 to (number of lines-2)
     */
    public function get_article_text($name) {
        $array = explode("\n", trim(read_file('C:/wamp/www/BasicSite/codigo_civil/' . $name)));
        if (sizeof($array) > 2) {
            unset($array[0]);
            return array_values($array);
        }
        return $array[1];
    }
    
    /*
     * Parameters: $name (the article number); $doc (the date of the document)
     * Returns: Array with each line of the txt except the title in a diferent index, ranging from 0 to (number of lines-2)
     */
    public function get_article_text_given_doc($name, $doc) {
        $array = explode("\n", trim(read_file('C:/wamp/www/BasicSite/codigo_civil/' . $doc . '/' . $doc . '_' . $name . '.txt')));
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
                if ($this->does_article_exist_in_given_doc($name, $docs->doc[$i]) == 1) {
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
        $evolution[0][1] = $this->get_article_text("/1966_11_25/1966_11_25_" . $name . ".txt");
        $count = 1;
        for ($i = 1; $i <= $number_docs; $i++) {
            if ($docs->doc[$i] != null) {
                if ($this->does_article_exist_in_given_doc($name, $docs->doc[$i]) == 1) {
                    $evolution[$count][0] = $docs->doc[$i];
                    $evolution[$count][1] = $this->get_article_text("/" . $docs->doc[$i] . "/" . $docs->doc[$i] . "_" . $name . ".txt");
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
        $array = simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/' . $name . "/" . $name . ".xml");
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
    
    /*
     * Returns: An array with the names of all the documents existent in the directory
     */
    public function get_all_doc_names() {
        return simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/documentos.xml');
    }
    
    /*
     * Returns: An array with the count of all the documents existent in the directory
     */
    public function get_all_doc_count() {
        return sizeof($this->get_all_doc_names());
    }
    
    /*
     * Returns: An array with the names of all the documents that suffered an alteration in the hierarchy
     */
    public function get_all_doc_changed_hierarchy_names() {
        return simplexml_load_file('C:/wamp/www/BasicSite/codigo_civil/documentos_hierarquia.xml');
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
}