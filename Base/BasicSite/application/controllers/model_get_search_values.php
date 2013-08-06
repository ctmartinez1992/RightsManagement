<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_get_search_values extends CI_Controller {

    public function get_titulo() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $doc = $_GET['doc'];
            $livro = $_GET['livro'];
            $valor = array('0' => 'I', '1' => 'II', '2' => 'III', '3' => 'IV', '4' => 'V', '5' => 'VI', '6' => 'VII', '7' => 'VIII', '8' => 'IX', '9' => 'X');
            $resposta = $this->model_api->get_hierarchy_titulo_given_livro($doc, $livro);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }

    public function get_subtitulo() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $doc = $_GET['doc'];
            $livro = $_GET['livro'];
            $titulo = $_GET['titulo'];
            $resposta = $this->model_api->get_hierarchy_subtitulo_given_previous($doc, $livro, $titulo);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }

    public function get_capitulo() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $doc = $_GET['doc'];
            $livro = $_GET['livro'];
            $titulo = $_GET['titulo'];
            $subtitulo = $_GET['subtitulo'];
            $resposta = $this->model_api->get_hierarchy_capitulo_given_previous($doc, $livro, $titulo, $subtitulo);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    public function get_capitulo_no_subtitulo() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $doc = $_GET['doc'];
            $livro = $_GET['livro'];
            $titulo = $_GET['titulo'];
            $resposta = $this->model_api->get_hierarchy_capitulo_given_previous_no_subtitulo($doc, $livro, $titulo);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }

    public function get_seccao() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $doc = $_GET['doc'];
            $livro = $_GET['livro'];
            $titulo = $_GET['titulo'];
            $subtitulo = $_GET['subtitulo'];
            $capitulo = $_GET['capitulo'];
            $resposta = $this->model_api->get_hierarchy_seccao_given_previous($doc, $livro, $titulo, $subtitulo, $capitulo);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    public function get_seccao_no_subtitulo() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $doc = $_GET['doc'];
            $livro = $_GET['livro'];
            $titulo = $_GET['titulo'];
            $capitulo = $_GET['capitulo'];
            $resposta = $this->model_api->get_hierarchy_seccao_given_previous_no_subtitulo($doc, $livro, $titulo, $capitulo);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    
    public function get_subseccao() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $doc = $_GET['doc'];
            $livro = $_GET['livro'];
            $titulo = $_GET['titulo'];
            $subtitulo = $_GET['subtitulo'];
            $capitulo = $_GET['capitulo'];
            $seccao = $_GET['seccao'];
            $resposta = $this->model_api->get_hierarchy_subseccao_given_previous($doc, $livro, $titulo, $subtitulo, $capitulo, $seccao);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    public function get_subseccao_no_subtitulo() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $doc = $_GET['doc'];
            $livro = $_GET['livro'];
            $titulo = $_GET['titulo'];
            $capitulo = $_GET['capitulo'];
            $seccao = $_GET['seccao'];
            $resposta = $this->model_api->get_hierarchy_subseccao_given_previous_no_subtitulo($doc, $livro, $titulo, $capitulo, $seccao);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    
    public function get_divisao() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $doc = $_GET['doc'];
            $livro = $_GET['livro'];
            $titulo = $_GET['titulo'];
            $subtitulo = $_GET['subtitulo'];
            $capitulo = $_GET['capitulo'];
            $seccao = $_GET['seccao'];
            $subseccao = $_GET['subseccao'];
            $resposta = $this->model_api->get_hierarchy_divisao_given_previous($doc, $livro, $titulo, $subtitulo, $capitulo, $seccao, $subseccao);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    public function get_divisao_no_subtitulo() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $doc = $_GET['doc'];
            $livro = $_GET['livro'];
            $titulo = $_GET['titulo'];
            $capitulo = $_GET['capitulo'];
            $seccao = $_GET['seccao'];
            $subseccao = $_GET['subseccao'];
            $resposta = $this->model_api->get_hierarchy_divisao_given_previous_no_subtitulo($doc, $livro, $titulo, $capitulo, $seccao, $subseccao);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    
    public function get_subdivisao() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $doc = $_GET['doc'];
            $livro = $_GET['livro'];
            $titulo = $_GET['titulo'];
            $subtitulo = $_GET['subtitulo'];
            $capitulo = $_GET['capitulo'];
            $seccao = $_GET['seccao'];
            $subseccao = $_GET['subseccao'];
            $divisao = $_GET['divisao'];
            $resposta = $this->model_api->get_hierarchy_subdivisao_given_previous($doc, $livro, $titulo, $subtitulo, $capitulo, $seccao, $subseccao, $divisao);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    public function get_subdivisao_no_subtitulo() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $doc = $_GET['doc'];
            $livro = $_GET['livro'];
            $titulo = $_GET['titulo'];
            $capitulo = $_GET['capitulo'];
            $seccao = $_GET['seccao'];
            $subseccao = $_GET['subseccao'];
            $divisao = $_GET['divisao'];
            $resposta = $this->model_api->get_hierarchy_subdivisao_given_previous_no_subtitulo($doc, $livro, $titulo, $capitulo, $seccao, $subseccao, $divisao);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    
    public function get_artigo() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $doc = $_GET['doc'];
            $livro = $_GET['livro'];
            $titulo = $_GET['titulo'];
            $subtitulo = $_GET['subtitulo'];
            $capitulo = $_GET['capitulo'];
            $seccao = $_GET['seccao'];
            $subseccao = $_GET['subseccao'];
            $divisao = $_GET['divisao'];
            $subdivisao = $_GET['subdivisao'];
            $resposta = $this->model_api->get_hierarchy_artigo_given_previous($doc, $livro, $titulo, $subtitulo, $capitulo, $seccao, $subseccao, $divisao, $subdivisao);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    public function get_artigo_no_subtitulo() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $doc = $_GET['doc'];
            $livro = $_GET['livro'];
            $titulo = $_GET['titulo'];
            $capitulo = $_GET['capitulo'];
            $seccao = $_GET['seccao'];
            $subseccao = $_GET['subseccao'];
            $divisao = $_GET['divisao'];
            $subdivisao = $_GET['subdivisao'];
            $resposta = $this->model_api->get_hierarchy_artigo_given_previous_no_subtitulo($doc, $livro, $titulo, $capitulo, $seccao, $subseccao, $divisao, $subdivisao);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }

    public function get_artigo_with_titulo() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $doc = $_GET['doc'];
            $livro = $_GET['livro'];
            $titulo = $_GET['titulo'];
            $resposta = $this->model_api->get_hierarchy_artigo_given_previous_and_titulo($doc, $livro, $titulo);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    public function get_artigo_with_subtitulo() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $doc = $_GET['doc'];
            $livro = $_GET['livro'];
            $titulo = $_GET['titulo'];
            $subtitulo = $_GET['subtitulo'];
            $resposta = $this->model_api->get_hierarchy_artigo_given_previous_and_subtitulo($doc, $livro, $titulo, $subtitulo);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    public function get_artigo_with_capitulo() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $doc = $_GET['doc'];
            $livro = $_GET['livro'];
            $titulo = $_GET['titulo'];
            $subtitulo = $_GET['subtitulo'];
            $capitulo = $_GET['capitulo'];
            $resposta = $this->model_api->get_hierarchy_artigo_given_previous_and_capitulo($doc, $livro, $titulo, $subtitulo, $capitulo);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    public function get_artigo_with_capitulo_no_subtitulo() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $doc = $_GET['doc'];
            $livro = $_GET['livro'];
            $titulo = $_GET['titulo'];
            $capitulo = $_GET['capitulo'];
            $resposta = $this->model_api->get_hierarchy_artigo_given_previous_and_capitulo_no_subtitulo($doc, $livro, $titulo, $capitulo);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    public function get_artigo_with_seccao() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $doc = $_GET['doc'];
            $livro = $_GET['livro'];
            $titulo = $_GET['titulo'];
            $subtitulo = $_GET['subtitulo'];
            $capitulo = $_GET['capitulo'];
            $seccao = $_GET['seccao'];
            $resposta = $this->model_api->get_hierarchy_artigo_given_previous_and_seccao($doc, $livro, $titulo, $subtitulo, $capitulo, $seccao);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    public function get_artigo_with_seccao_no_subtitulo() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $doc = $_GET['doc'];
            $livro = $_GET['livro'];
            $titulo = $_GET['titulo'];
            $capitulo = $_GET['capitulo'];
            $seccao = $_GET['seccao'];
            $resposta = $this->model_api->get_hierarchy_artigo_given_previous_and_seccao_no_subtitulo($doc, $livro, $titulo, $capitulo, $seccao);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    public function get_artigo_with_subseccao() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $doc = $_GET['doc'];
            $livro = $_GET['livro'];
            $titulo = $_GET['titulo'];
            $subtitulo = $_GET['subtitulo'];
            $capitulo = $_GET['capitulo'];
            $seccao = $_GET['seccao'];
            $subseccao = $_GET['subseccao'];
            $resposta = $this->model_api->get_hierarchy_artigo_given_previous_and_subseccao($doc, $livro, $titulo, $subtitulo, $capitulo, $seccao, $subseccao);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    public function get_artigo_with_subseccao_no_subtitulo() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $doc = $_GET['doc'];
            $livro = $_GET['livro'];
            $titulo = $_GET['titulo'];
            $capitulo = $_GET['capitulo'];
            $seccao = $_GET['seccao'];
            $subseccao = $_GET['subseccao'];
            $resposta = $this->model_api->get_hierarchy_artigo_given_previous_and_subseccao_no_subtitulo($doc, $livro, $titulo, $capitulo, $seccao, $subseccao);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    public function get_artigo_with_divisao() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $doc = $_GET['doc'];
            $livro = $_GET['livro'];
            $titulo = $_GET['titulo'];
            $subtitulo = $_GET['subtitulo'];
            $capitulo = $_GET['capitulo'];
            $seccao = $_GET['seccao'];
            $subseccao = $_GET['subseccao'];
            $divisao = $_GET['divisao'];
            $resposta = $this->model_api->get_hierarchy_artigo_given_previous_and_divisao($doc, $livro, $titulo, $subtitulo, $capitulo, $seccao, $subseccao, $divisao);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    public function get_artigo_with_divisao_no_subtitulo() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $doc = $_GET['doc'];
            $livro = $_GET['livro'];
            $titulo = $_GET['titulo'];
            $capitulo = $_GET['capitulo'];
            $seccao = $_GET['seccao'];
            $subseccao = $_GET['subseccao'];
            $divisao = $_GET['divisao'];
            $resposta = $this->model_api->get_hierarchy_artigo_given_previous_and_divisao_no_subtitulo($doc, $livro, $titulo, $capitulo, $seccao, $subseccao, $divisao);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    
    
    
    
    //backend functions
    public function get_livro_last_doc() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $resposta = $this->model_api->get_hierarchy_livro_last_doc();
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
}

?>
