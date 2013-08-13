<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_save_file extends CI_Controller {

    public function save_alteration_file() {
        $data = json_decode(stripslashes($_POST['data']));
        $doc_name = $data[sizeof($data)-1];
        $art_name = $data[sizeof($data)-2];
        $ourFileHandle = fopen("codigo_civil/temp/" . $doc_name . "/" . $doc_name . "_" . $art_name . ".txt", 'w') or die("can't open file");
        for ($i=0; $i<sizeof($data)-2; $i++) {
            fwrite($ourFileHandle, $data[$i] . "\n");
        }
        fclose($ourFileHandle);
        
        $xml = simplexml_load_file("codigo_civil/temp/" . $doc_name . "/" . $doc_name . ".xml");
        $sxe = new SimpleXMLElement($xml->asXML());
        $sxe->addChild("altera", $art_name);
        $sxe->asXML("codigo_civil/temp/" . $doc_name . "/" . $doc_name . ".xml");
    }

    public function save_alt_alteration_file() {
        $data = json_decode(stripslashes($_POST['data']));
        $doc_name = $data[sizeof($data)-1];
        $art_name = $data[sizeof($data)-2];
        unlink("codigo_civil/temp/" . $doc_name . "/" . $doc_name . "_" . $art_name . ".txt");
        $ourFileHandle = fopen("codigo_civil/temp/" . $doc_name . "/" . $doc_name . "_" . $art_name . ".txt", 'w') or die("can't open file");
        for ($i=0; $i<sizeof($data)-2; $i++) {
            fwrite($ourFileHandle, $data[$i] . "\n");
        }
        fclose($ourFileHandle);
    }

    public function save_rem_alteration_file() {
        $data = json_decode(stripslashes($_POST['data']));
        $doc_name = $data[1];
        $art_name = $data[0];
        unlink("codigo_civil/temp/" . $doc_name . "/" . $doc_name . "_" . $art_name . ".txt");
        
        $array = simplexml_load_file("codigo_civil/temp/" . $doc_name . "/" . $doc_name . ".xml");
        for($i=0; $i<count($array->altera); $i++) {
            if ($array->altera[$i] == $art_name) {
                unset($array->altera[$i]); 
            }
        } 
        file_put_contents("codigo_civil/temp/" . $doc_name . "/" . $doc_name . ".xml", $array->saveXML());
    }

    /*
     * 0 a tamanho do artigo - conteudo do artigo
     * tamanho do artigo +1 - o artigo
     * tamanho do artigo +2 - o documento a alterar
     * tamanho do artigo +3 - o documento que tem a hierarquia mais recente
     * tamanho do artigo +4 a +10 - a hierarquia
     * 
     */
    public function save_addition_file() {
        $data = json_decode(stripslashes($_POST['data']));
        
        $ourFileHandle2 = fopen("codigo_civil/log.txt", 'w') or die("can't open file");
        
        $doc_name = $data[sizeof($data)-10];
        $hdoc_name = $data[sizeof($data)-9];
        $art_name = $data[sizeof($data)-11];
        
            fwrite($ourFileHandle2, $doc_name . "\n");
            fwrite($ourFileHandle2, $hdoc_name . "\n");
            fwrite($ourFileHandle2, $art_name . "\n");
        fclose($ourFileHandle2);
        
        $ourFileHandle = fopen("codigo_civil/temp/" . $doc_name . "/" . $doc_name . "_" . $art_name . ".txt", 'w') or die("can't open file");
        for ($i=0; $i<sizeof($data)-11; $i++) {
            fwrite($ourFileHandle, $data[$i] . "\n");
        }
        fclose($ourFileHandle);
        
        $xml = simplexml_load_file("codigo_civil/temp/" . $doc_name . "/" . $doc_name . ".xml");
        $sxe = new SimpleXMLElement($xml->asXML());
        $sxe->addChild("acrescenta", $art_name);
        $sxe->asXML("codigo_civil/temp/" . $doc_name . "/" . $doc_name . ".xml");
        
        if (file_exists("codigo_civil/temp/" . $doc_name . "/hierarquia.xml")) {
            
        } else {
        copy("codigo_civil/" . $hdoc_name . "/hierarquia.xml", "codigo_civil/temp/" . $doc_name . "/hierarquia.xml");
        }
        
        $array = simplexml_load_file("codigo_civil/temp/" . $doc_name . "/hierarquia.xml");
        $sxe2 = new SimpleXMLElement($array->asXML());
        
        $conv = array("0" => -1, "I" => 0, "II" => 1, "III" => 2, "IV" => 3, "V" => 4, "VI" => 5, "VII" => 6, "VIII" => 7, "IX" => 8, "X" => 9, "XI" => 10, "XII" => 11, "XIII" => 12, "XIV" => 13, "XV" => 14,  "XVI" => 15,  "XVII" => 16,  "XVIII" => 17,  "XIX" => 18,  "XX" => 19);
        $inds = array();
        
        $inds[0] = $conv[$data[sizeof($data)-8]];
        $inds[1] = $conv[$data[sizeof($data)-7]];
        $inds[2] = $conv[$data[sizeof($data)-6]];
        $inds[3] = $conv[$data[sizeof($data)-5]];
        $inds[4] = $conv[$data[sizeof($data)-4]];
        $inds[5] = $conv[$data[sizeof($data)-3]];
        $inds[6] = $conv[$data[sizeof($data)-2]];
        $inds[7] = $conv[$data[sizeof($data)-1]];
        
        if ($inds[7] != -1) {
            if ($inds[2] == -1) {
                $sd = $array->Livro[$inds[0]]->Titulo[$inds[1]]->Capitulo[$inds[3]]->Seccao[$inds[4]]->Subseccao[$inds[5]]->Divisao[$inds[6]]->Subdivisao;
                $sd->addChild("artigo", $art_name);
            } else {
                $sd = $array->Livro[$inds[0]]->Titulo[$inds[1]]->Subtitulo[$inds[2]]->Capitulo[$inds[3]]->Seccao[$inds[4]]->Subseccao[$inds[5]]->Divisao[$inds[6]]->Subdivisao;
                $sd->addChild("artigo", $art_name);
                
            }
        } else if ($inds[6] != -1) {
            if ($inds[2] == -1) {
                $d = $array->Livro[$inds[0]]->Titulo[$inds[1]]->Capitulo[$inds[3]]->Seccao[$inds[4]]->Subseccao[$inds[5]]->Divisao;
                $d->addChild("artigo", $art_name);
            } else {
                $d = $array->Livro[$inds[0]]->Titulo[$inds[1]]->Subtitulo[$inds[2]]->Capitulo[$inds[3]]->Seccao[$inds[4]]->Subseccao[$inds[5]]->Divisao;
                $d->addChild("artigo", $art_name);
            }
        } else if ($inds[5] != -1) {
            if ($inds[2] == -1) {
                $ss = $array->Livro[$inds[0]]->Titulo[$inds[1]]->Capitulo[$inds[3]]->Seccao[$inds[4]]->Subseccao;
                $ss->addChild("artigo", $art_name);
            } else {
                $ss = $array->Livro[$inds[0]]->Titulo[$inds[1]]->Subtitulo[$inds[2]]->Capitulo[$inds[3]]->Seccao[$inds[4]]->Subseccao;
                $ss->addChild("artigo", $art_name);
            }
        } else if ($inds[4] != -1) {
            if ($inds[2] == -1) {
                $s = $array->Livro[$inds[0]]->Titulo[$inds[1]]->Capitulo[$inds[3]]->Seccao;
                $s->addChild("artigo", $art_name);
            } else {
                $s = $array->Livro[$inds[0]]->Titulo[$inds[1]]->Subtitulo[$inds[2]]->Capitulo[$inds[3]]->Seccao;
                $s->addChild("artigo", $art_name);
            }
        } else if ($inds[3] != -1) {
            if ($inds[2] == -1) {
                $c = $array->Livro[$inds[0]]->Titulo[$inds[1]]->Capitulo;
                $c->addChild("artigo", $art_name);
            } else {
                $c = $array->Livro[$inds[0]]->Titulo[$inds[1]]->Subtitulo[$inds[2]]->Capitulo;
                $c->addChild("artigo", $art_name);
            }
        } else if ($inds[2] != -1) {
            $st = $array->Livro[$inds[0]]->Titulo[$inds[1]]->Subtitulo;
            $st->addChild("artigo", $art_name);
        } else if ($inds[1] != -1) {
            $t = $array->Livro[$inds[0]]->Titulo;
            $t->addChild("artigo", $art_name);
        } else if ($inds[0] != -1) {
            $l = $array->Livro;
            $l->addChild("artigo", $art_name);
        }
           
        $array->asXML("codigo_civil/temp/" . $doc_name . "/hierarquia.xml");
    }

    public function save_alt_addition_file() {
        $data = json_decode(stripslashes($_POST['data']));
        $doc_name = $data[sizeof($data)-1];
        $art_name = $data[sizeof($data)-2];
        unlink("codigo_civil/temp/" . $doc_name . "/" . $doc_name . "_" . $art_name . ".txt");
        $ourFileHandle = fopen("codigo_civil/temp/" . $doc_name . "/" . $doc_name . "_" . $art_name . ".txt", 'w') or die("can't open file");
        for ($i=0; $i<sizeof($data)-2; $i++) {
            fwrite($ourFileHandle, $data[$i] . "\n");
        }
        fclose($ourFileHandle);
    }

    public function save_rem_addition_file() {
        $data = json_decode(stripslashes($_POST['data']));
        $doc_name = $data[1];
        $art_name = $data[0];
        unlink("codigo_civil/temp/" . $doc_name . "/" . $doc_name . "_" . $art_name . ".txt");
        
        $array = simplexml_load_file("codigo_civil/temp/" . $doc_name . "/" . $doc_name . ".xml");
        for($i=0; $i<count($array->acrescenta); $i++) {
            if ($array->acrescenta[$i] == $art_name) {
                unset($array->acrescenta[$i]); 
            }
        } 
        file_put_contents("codigo_civil/temp/" . $doc_name . "/" . $doc_name . ".xml", $array->saveXML());
    }

    public function save_remove_file() {
        $data = json_decode(stripslashes($_POST['data']));
        $doc_name = $data[1];
        $art_name = $data[0];
        
        $xml = simplexml_load_file("codigo_civil/temp/" . $doc_name . "/" . $doc_name . ".xml");
        $sxe = new SimpleXMLElement($xml->asXML());
        $sxe->addChild("revoga", $art_name);
        $sxe->asXML("codigo_civil/temp/" . $doc_name . "/" . $doc_name . ".xml");
    }

    public function save_rem_remove_file() {
        $data = json_decode(stripslashes($_POST['data']));
        $doc_name = $data[1];
        $art_name = $data[0];
        
        $array = simplexml_load_file("codigo_civil/temp/" . $doc_name . "/" . $doc_name . ".xml");
        for($i=0; $i<count($array->revoga); $i++) {
            if ($array->revoga[$i] == $art_name) {
                unset($array->revoga[$i]); 
            }
        } 
        file_put_contents("codigo_civil/temp/" . $doc_name . "/" . $doc_name . ".xml", $array->saveXML());
    }

    public function save_doc_but_dont_send() {
        $doc = $_POST['doc'];  
        $ourFileHandle = fopen("codigo_civil/log.txt", 'w') or die("can't open file");
        fwrite($ourFileHandle, $doc);
        fclose($ourFileHandle);      
        $this->db->query("UPDATE temp_docs SET estado=1 WHERE nome='" . $doc . "';");
        return $this->db->affected_rows();
    }

    public function save_doc_and_send() {
        $doc = $_POST['doc'];  
        $ourFileHandle = fopen("codigo_civil/log.txt", 'w') or die("can't open file");
        fwrite($ourFileHandle, $doc);
        fclose($ourFileHandle);      
        $this->db->query("UPDATE temp_docs SET estado=2 WHERE nome='" . $doc . "';");
        return $this->db->affected_rows();
    }

    public function approve_temp_doc() {
        $doc = $_POST['doc'];
        $name = $_POST['name'];
        
        if (file_exists("codigo_civil/temp/" . $doc . "/hierarquia.xml")) {
            $xml3 = simplexml_load_file("codigo_civil/documentos_hierarquia.xml");
            $sxe3 = new SimpleXMLElement($xml3->asXML());
            $sxe3->addChild("doc", $doc);
            $sxe3->asXML("codigo_civil/documentos_hierarquia.xml");
        } else {
        }
        
        $this->rcopy("codigo_civil/temp/" . $doc . "/", "codigo_civil/" . $doc . "/");
        $this->rmdir_recursive("codigo_civil/temp/" . $doc . "/");
        
        $this->db->query("UPDATE temp_docs SET estado=3 WHERE nome='" . $name . "';");
        
        $xml = simplexml_load_file("codigo_civil/documentos.xml");
        $sxe = new SimpleXMLElement($xml->asXML());
        $sxe->addChild("doc", $doc);
        $sxe->asXML("codigo_civil/documentos.xml");
        
        $array = simplexml_load_file("codigo_civil/" . $doc . "/" . $doc . ".xml");
        $xml2 = simplexml_load_file("codigo_civil/todos_artigos.xml");
        for($i=0; $i<count($array->acrescenta); $i++) {
            $sxe2 = new SimpleXMLElement($xml2->asXML());
            $sxe2->addChild("artigo", $array->acrescenta[$i]);
            $sxe2->asXML("codigo_civil/todos_artigos.xml");
        } 
        
        return $this->db->affected_rows();
    }

    public function disapprove_temp_doc() {
        $doc = $_POST['doc'];
        $name = $_POST['name'];
        
        $this->db->query("UPDATE temp_docs SET estado=0 WHERE nome='" . $name . "';");
        return $this->db->affected_rows();
    }

    public function delete_temp_doc() {
        $doc = $_POST['doc'];
        $name = $_POST['name'];  
        
        $this->rmdir_recursive("codigo_civil/temp/" . $doc . "/");
        
        $this->db->query("DELETE FROM temp_docs WHERE nome='" . $name . "';");
        return $this->db->affected_rows();
    }
    
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
    public function save_hierarchy_file() {
        $data = json_decode(stripslashes($_POST['data']));
        
        $ourFileHandle = fopen("codigo_civil/log.txt", 'w') or die("can't open file");
        
        if (file_exists("codigo_civil/temp/" . $data[0] . "/hierarquia.xml")) {
            
        } else {
            copy("codigo_civil/" . $data[1] . "/hierarquia.xml", "codigo_civil/temp/" . $data[0] . "/hierarquia.xml");
        }
        
        $array = simplexml_load_file("codigo_civil/temp/" . $data[0] . "/hierarquia.xml");
        
        $conv = array("0" => -1, "I" => 0, "II" => 1, "III" => 2, "IV" => 3, "V" => 4, "VI" => 5, "VII" => 6, "VIII" => 7, "IX" => 8, "X" => 9, "XI" => 10, "XII" => 11, "XIII" => 12, "XIV" => 13, "XV" => 14,  "XVI" => 15,  "XVII" => 16,  "XVIII" => 17,  "XIX" => 18,  "XX" => 19);
        $inds = array();
        
        $inds[0] = $conv[$data[5]];
        $inds[1] = $conv[$data[6]];
        $inds[2] = $conv[$data[7]];
        $inds[3] = $conv[$data[8]];
        $inds[4] = $conv[$data[9]];
        $inds[5] = $conv[$data[10]];
        $inds[6] = $conv[$data[11]];
        $inds[7] = $conv[$data[12]];
        
        if ($inds[7] != -1) {
            if ($inds[2] == -1) {
                $array->Livro[$inds[0]]->Titulo[$inds[1]]->Capitulo[$inds[3]]->Seccao[$inds[4]]->Subseccao[$inds[5]]->Divisao[$inds[6]]->Subdivisao[$inds[7]]['id'] = $data[3];
                $array->Livro[$inds[0]]->Titulo[$inds[1]]->Capitulo[$inds[3]]->Seccao[$inds[4]]->Subseccao[$inds[5]]->Divisao[$inds[6]]->Subdivisao[$inds[7]]['nome'] = $data[4];
            } else {
                $array->Livro[$inds[0]]->Titulo[$inds[1]]->Subtitulo[$inds[2]]->Capitulo[$inds[3]]->Seccao[$inds[4]]->Subseccao[$inds[5]]->Divisao[$inds[6]]->Subdivisao[$inds[7]]['id'] = $data[3];
                $array->Livro[$inds[0]]->Titulo[$inds[1]]->Subtitulo[$inds[2]]->Capitulo[$inds[3]]->Seccao[$inds[4]]->Subseccao[$inds[5]]->Divisao[$inds[6]]->Subdivisao[$inds[7]]['nome'] = $data[4];
            }
        } else if ($inds[6] != -1) {
            if ($inds[2] == -1) {
                $array->Livro[$inds[0]]->Titulo[$inds[1]]->Capitulo[$inds[3]]->Seccao[$inds[4]]->Subseccao[$inds[5]]->Divisao[$inds[6]]['id'] = $data[3];
                $array->Livro[$inds[0]]->Titulo[$inds[1]]->Capitulo[$inds[3]]->Seccao[$inds[4]]->Subseccao[$inds[5]]->Divisao[$inds[6]]['nome'] = $data[4];
            } else {
                $array->Livro[$inds[0]]->Titulo[$inds[1]]->Subtitulo[$inds[2]]->Capitulo[$inds[3]]->Seccao[$inds[4]]->Subseccao[$inds[5]]->Divisao[$inds[6]]['id'] = $data[3];
                $array->Livro[$inds[0]]->Titulo[$inds[1]]->Subtitulo[$inds[2]]->Capitulo[$inds[3]]->Seccao[$inds[4]]->Subseccao[$inds[5]]->Divisao[$inds[6]]['nome'] = $data[4];
            }
        } else if ($inds[5] != -1) {
            if ($inds[2] == -1) {
                $array->Livro[$inds[0]]->Titulo[$inds[1]]->Capitulo[$inds[3]]->Seccao[$inds[4]]->Subseccao[$inds[5]]['id'] = $data[3];
                $array->Livro[$inds[0]]->Titulo[$inds[1]]->Capitulo[$inds[3]]->Seccao[$inds[4]]->Subseccao[$inds[5]]['nome'] = $data[4];
            } else {
                $array->Livro[$inds[0]]->Titulo[$inds[1]]->Subtitulo[$inds[2]]->Capitulo[$inds[3]]->Seccao[$inds[4]]->Subseccao[$inds[5]]['id'] = $data[3];
                $array->Livro[$inds[0]]->Titulo[$inds[1]]->Subtitulo[$inds[2]]->Capitulo[$inds[3]]->Seccao[$inds[4]]->Subseccao[$inds[5]]['nome'] = $data[4];
            }
        } else if ($inds[4] != -1) {
            if ($inds[2] == -1) {
                $array->Livro[$inds[0]]->Titulo[$inds[1]]->Capitulo[$inds[3]]->Seccao[$inds[4]]['id'] = $data[3];
                $array->Livro[$inds[0]]->Titulo[$inds[1]]->Capitulo[$inds[3]]->Seccao[$inds[4]]['nome'] = $data[4];
            } else {
                $array->Livro[$inds[0]]->Titulo[$inds[1]]->Subtitulo[$inds[2]]->Capitulo[$inds[3]]->Seccao[$inds[4]]['id'] = $data[3];
                $array->Livro[$inds[0]]->Titulo[$inds[1]]->Subtitulo[$inds[2]]->Capitulo[$inds[3]]->Seccao[$inds[4]]['nome'] = $data[4];
            }
        } else if ($inds[3] != -1) {
            if ($inds[2] == -1) {
                $array->Livro[$inds[0]]->Titulo[$inds[1]]->Capitulo[$inds[3]]['id'] = $data[3];
                $array->Livro[$inds[0]]->Titulo[$inds[1]]->Capitulo[$inds[3]]['nome'] = $data[4];
            } else {
                $array->Livro[$inds[0]]->Titulo[$inds[1]]->Subtitulo[$inds[2]]->Capitulo[$inds[3]]['id'] = $data[3];
                $array->Livro[$inds[0]]->Titulo[$inds[1]]->Subtitulo[$inds[2]]->Capitulo[$inds[3]]['nome'] = $data[4];
            }
        } else if ($inds[2] != -1) {
            $array->Livro[$inds[0]]->Titulo[$inds[1]]->Subtitulo[$inds[2]]['id'] = $data[3];
            $array->Livro[$inds[0]]->Titulo[$inds[1]]->Subtitulo[$inds[2]]['nome'] = $data[4];
        } else if ($inds[1] != -1) {
            $array->Livro[$inds[0]]->Titulo[$inds[1]]['id'] = $data[3];
            $array->Livro[$inds[0]]->Titulo[$inds[1]]['nome'] = $data[4];
        } else if ($inds[0] != -1) {
            $array->Livro[$inds[0]]['id'] = $data[3];
            $array->Livro[$inds[0]]['nome'] = $data[4];
        }
           
        $array->asXML("codigo_civil/temp/" . $data[0] . "/hierarquia.xml");
        
        fclose($ourFileHandle);
    }

    //Copia ficheiros de um diretorio para outro.
    public function rcopy($src, $dst) {
        if (is_dir ( $src )) {
            mkdir ( $dst );
            $files = scandir ( $src );
            foreach ( $files as $file )
                if ($file != "." && $file != "..")
                    $this->rcopy ( "$src/$file", "$dst/$file" );
        } else if (file_exists ( $src ))
            copy ( $src, $dst );
    }

    //Recursivamente elimina um diretorio e o seu conteudo.
    public function rmdir_recursive($dir) {
        foreach(scandir($dir) as $file) {
            if ('.' === $file || '..' === $file) continue;
            if (is_dir("$dir/$file")) $this->rmdir_recursive("$dir/$file");
            else unlink("$dir/$file");
        }
        rmdir($dir);
    }
}

?>
