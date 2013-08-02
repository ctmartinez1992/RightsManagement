<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_get_backend_values extends CI_Controller {
    
    public function get_articles_given_temp_doc() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $doc = (string)$_GET['doc'];
            $resposta = $this->model_api->get_articles_given_temp_doc($doc);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    
    public function get_full_article() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $artigo = (string)$_GET['artigo'];
            $resposta = $this->model_api->get_full_article($artigo);
            if ($resposta == "") {
                echo "0";
            } else {                
                for ($i=0; $i<sizeof($resposta); $i++) {
                    if (is_array($resposta[$i])) {
                        for ($j=0; $j<sizeof($resposta[$i]); $j++) {
                            echo $resposta[$i][$j] . "#";
                        }
                    } else {
                        echo $resposta[$i] . "#";
                    }
                }
            }
        echo '</response>';
    }
    
    public function put_doc_in_db() {
        $this->load->model("model_put");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $nome = (string)$_GET['nome'];
            $data = (string)$_GET['data'];
            $resposta = $this->model_put->save_doc($nome, $data);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
}
