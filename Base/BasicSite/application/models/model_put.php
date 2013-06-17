<?php

class Model_put extends CI_Model {

    function save_doc($nome, $data) {
        $this->db->query("INSERT INTO temp_docs (nome, data, estado) VALUES ('" . $nome . "', '" . $data . "', 0)");
        $diamesano = explode("/", $data);
        $data2 = $diamesano[2] . "_" . $diamesano[1] . "_" . $diamesano[0];
        if ($this->db->affected_rows() > 0) {
            mkdir("codigo_civil/temp/" . $data2);
            $ourFileHandle = fopen("codigo_civil/temp/" . $data2 . "/" . $data2 . ".xml", 'w') or die("can't open file");
            fwrite($ourFileHandle, '<?xml version="1.0" encoding="UTF-8"?><doc nome="' . $nome . '"></doc>');
            fclose($ourFileHandle);
        } else {
        }
        
        return $this->db->affected_rows();
    }

}
