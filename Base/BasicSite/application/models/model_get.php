<?php

class Model_get extends CI_Model {

    function getData($page) {
        $query = $this->db->get_where("pageData", array("page" => $page));
        return $query->result();
    }

    function getUndoneDocs() {
        $query = $this->db->query('SELECT nome,data FROM temp_docs WHERE estado="0"');
        return $query->result();
    }

    function getUndoneDocsAll() {
        $query = $this->db->query('SELECT * FROM temp_docs');
        return $query->result();
    }

}
