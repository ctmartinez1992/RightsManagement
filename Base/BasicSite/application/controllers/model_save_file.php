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
}

?>
