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

    public function save_addition_file() {
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
        $sxe->addChild("acrescenta", $art_name);
        $sxe->asXML("codigo_civil/temp/" . $doc_name . "/" . $doc_name . ".xml");
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
