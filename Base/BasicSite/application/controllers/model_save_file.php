<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_save_file extends CI_Controller {

    public function save_file() {
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
}

?>
