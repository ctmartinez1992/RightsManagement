<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_get_main_values extends CI_Controller {
    
    public function get_hierarchy_livro() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $doc = $_GET['doc'];
            $this->session->set_userdata('current_doc', $doc);
            $resposta = $this->model_api->get_hierarchy_livro_name_string($doc);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    
    public function get_hierarchy_titulo() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $doc = $_GET['doc'];
            $livro = $_GET['livro'];
            $valor = array('0' => 'I', '1' => 'II', '2' => 'III', '3' => 'IV', '4' => 'V', '5' => 'VI', '6' => 'VII', '7' => 'VIII', '8' => 'IX', '9' => 'X', '10' => 'XI', '11' => 'XII', '12' => 'XIII', '13' => 'XIV', '14' => 'XV', '15' => 'XVI', '16' => 'XVII', '17' => 'XVIII', '18' => 'XIX', '19' => 'XX');
            $resposta = $this->model_api->get_hierarchy_titulo_name_given_livro($doc, $valor[$livro-1]);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    public function get_hierarchy_subtitulo() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $doc = $_GET['doc'];
            $livro = $_GET['livro'];
            $titulo = $_GET['titulo'];
            $valor = array('0' => 'I', '1' => 'II', '2' => 'III', '3' => 'IV', '4' => 'V', '5' => 'VI', '6' => 'VII', '7' => 'VIII', '8' => 'IX', '9' => 'X', '10' => 'XI', '11' => 'XII', '12' => 'XIII', '13' => 'XIV', '14' => 'XV', '15' => 'XVI', '16' => 'XVII', '17' => 'XVIII', '18' => 'XIX', '19' => 'XX');
            $resposta = $this->model_api->get_hierarchy_subtitulo_name_given_previous($doc, $valor[$livro-1], $valor[$titulo-1]);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    public function get_hierarchy_capitulo() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $doc = $_GET['doc'];
            $livro = $_GET['livro'];
            $titulo = $_GET['titulo'];
            $subtitulo = $_GET['subtitulo'];
            $valor = array('0' => 'I', '1' => 'II', '2' => 'III', '3' => 'IV', '4' => 'V', '5' => 'VI', '6' => 'VII', '7' => 'VIII', '8' => 'IX', '9' => 'X', '10' => 'XI', '11' => 'XII', '12' => 'XIII', '13' => 'XIV', '14' => 'XV', '15' => 'XVI', '16' => 'XVII', '17' => 'XVIII', '18' => 'XIX', '19' => 'XX');
            $resposta = $this->model_api->get_hierarchy_capitulo_name_given_previous($doc, $valor[$livro-1], $valor[$titulo-1], $valor[$subtitulo-1]);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    public function get_hierarchy_capitulo_no_subtitulo() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $doc = $_GET['doc'];
            $livro = $_GET['livro'];
            $titulo = $_GET['titulo'];
            $valor = array('0' => 'I', '1' => 'II', '2' => 'III', '3' => 'IV', '4' => 'V', '5' => 'VI', '6' => 'VII', '7' => 'VIII', '8' => 'IX', '9' => 'X', '10' => 'XI', '11' => 'XII', '12' => 'XIII', '13' => 'XIV', '14' => 'XV', '15' => 'XVI', '16' => 'XVII', '17' => 'XVIII', '18' => 'XIX', '19' => 'XX');
            $resposta = $this->model_api->get_hierarchy_capitulo_name_given_previous_no_subtitulo($doc, $valor[$livro-1], $valor[$titulo-1]);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    public function get_hierarchy_seccao() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $doc = $_GET['doc'];
            $livro = $_GET['livro'];
            $titulo = $_GET['titulo'];
            $subtitulo = $_GET['subtitulo'];
            $capitulo = $_GET['capitulo'];
            $valor = array('0' => 'I', '1' => 'II', '2' => 'III', '3' => 'IV', '4' => 'V', '5' => 'VI', '6' => 'VII', '7' => 'VIII', '8' => 'IX', '9' => 'X', '10' => 'XI', '11' => 'XII', '12' => 'XIII', '13' => 'XIV', '14' => 'XV', '15' => 'XVI', '16' => 'XVII', '17' => 'XVIII', '18' => 'XIX', '19' => 'XX');
            $resposta = $this->model_api->get_hierarchy_seccao_name_given_previous($doc, $valor[$livro-1], $valor[$titulo-1], $valor[$subtitulo-1], $valor[$capitulo-1]);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    public function get_hierarchy_seccao_no_subtitulo() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $doc = $_GET['doc'];
            $livro = $_GET['livro'];
            $titulo = $_GET['titulo'];
            $capitulo = $_GET['capitulo'];
            $valor = array('0' => 'I', '1' => 'II', '2' => 'III', '3' => 'IV', '4' => 'V', '5' => 'VI', '6' => 'VII', '7' => 'VIII', '8' => 'IX', '9' => 'X', '10' => 'XI', '11' => 'XII', '12' => 'XIII', '13' => 'XIV', '14' => 'XV', '15' => 'XVI', '16' => 'XVII', '17' => 'XVIII', '18' => 'XIX', '19' => 'XX');
            $resposta = $this->model_api->get_hierarchy_seccao_name_given_previous_no_subtitulo($doc, $valor[$livro-1], $valor[$titulo-1], $valor[$capitulo-1]);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    public function get_hierarchy_subseccao() {
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
            $valor = array('0' => 'I', '1' => 'II', '2' => 'III', '3' => 'IV', '4' => 'V', '5' => 'VI', '6' => 'VII', '7' => 'VIII', '8' => 'IX', '9' => 'X', '10' => 'XI', '11' => 'XII', '12' => 'XIII', '13' => 'XIV', '14' => 'XV', '15' => 'XVI', '16' => 'XVII', '17' => 'XVIII', '18' => 'XIX', '19' => 'XX');
            $resposta = $this->model_api->get_hierarchy_subseccao_name_given_previous($doc, $valor[$livro-1], $valor[$titulo-1], $valor[$subtitulo-1], $valor[$capitulo-1], $valor[$seccao-1]);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    public function get_hierarchy_subseccao_no_subtitulo() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $doc = $_GET['doc'];
            $livro = $_GET['livro'];
            $titulo = $_GET['titulo'];
            $capitulo = $_GET['capitulo'];
            $seccao = $_GET['seccao'];
            $valor = array('0' => 'I', '1' => 'II', '2' => 'III', '3' => 'IV', '4' => 'V', '5' => 'VI', '6' => 'VII', '7' => 'VIII', '8' => 'IX', '9' => 'X', '10' => 'XI', '11' => 'XII', '12' => 'XIII', '13' => 'XIV', '14' => 'XV', '15' => 'XVI', '16' => 'XVII', '17' => 'XVIII', '18' => 'XIX', '19' => 'XX');
            $resposta = $this->model_api->get_hierarchy_subseccao_name_given_previous_no_subtitulo($doc, $valor[$livro-1], $valor[$titulo-1], $valor[$capitulo-1], $valor[$seccao-1]);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    public function get_hierarchy_divisao() {
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
            $valor = array('0' => 'I', '1' => 'II', '2' => 'III', '3' => 'IV', '4' => 'V', '5' => 'VI', '6' => 'VII', '7' => 'VIII', '8' => 'IX', '9' => 'X', '10' => 'XI', '11' => 'XII', '12' => 'XIII', '13' => 'XIV', '14' => 'XV', '15' => 'XVI', '16' => 'XVII', '17' => 'XVIII', '18' => 'XIX', '19' => 'XX');
            $resposta = $this->model_api->get_hierarchy_divisao_name_given_previous($doc, $valor[$livro-1], $valor[$titulo-1], $valor[$subtitulo-1], $valor[$capitulo-1], $valor[$seccao-1], $valor[$subseccao-1]);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    public function get_hierarchy_divisao_no_subtitulo() {
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
            $valor = array('0' => 'I', '1' => 'II', '2' => 'III', '3' => 'IV', '4' => 'V', '5' => 'VI', '6' => 'VII', '7' => 'VIII', '8' => 'IX', '9' => 'X', '10' => 'XI', '11' => 'XII', '12' => 'XIII', '13' => 'XIV', '14' => 'XV', '15' => 'XVI', '16' => 'XVII', '17' => 'XVIII', '18' => 'XIX', '19' => 'XX');
            $resposta = $this->model_api->get_hierarchy_divisao_name_given_previous_no_subtitulo($doc, $valor[$livro-1], $valor[$titulo-1], $valor[$capitulo-1], $valor[$seccao-1], $valor[$subseccao-1]);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    public function get_hierarchy_subdivisao() {
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
            $valor = array('0' => 'I', '1' => 'II', '2' => 'III', '3' => 'IV', '4' => 'V', '5' => 'VI', '6' => 'VII', '7' => 'VIII', '8' => 'IX', '9' => 'X', '10' => 'XI', '11' => 'XII', '12' => 'XIII', '13' => 'XIV', '14' => 'XV', '15' => 'XVI', '16' => 'XVII', '17' => 'XVIII', '18' => 'XIX', '19' => 'XX');
            $resposta = $this->model_api->get_hierarchy_subdivisao_name_given_previous($doc, $valor[$livro-1], $valor[$titulo-1], $valor[$subtitulo-1], $valor[$capitulo-1], $valor[$seccao-1], $valor[$subseccao-1], $valor[$divisao-1]);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    public function get_hierarchy_subdivisao_no_subtitulo() {
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
            $valor = array('0' => 'I', '1' => 'II', '2' => 'III', '3' => 'IV', '4' => 'V', '5' => 'VI', '6' => 'VII', '7' => 'VIII', '8' => 'IX', '9' => 'X', '10' => 'XI', '11' => 'XII', '12' => 'XIII', '13' => 'XIV', '14' => 'XV', '15' => 'XVI', '16' => 'XVII', '17' => 'XVIII', '18' => 'XIX', '19' => 'XX');
            $resposta = $this->model_api->get_hierarchy_subdivisao_name_given_previous_no_subtitulo($doc, $valor[$livro-1], $valor[$titulo-1], $valor[$capitulo-1], $valor[$seccao-1], $valor[$subseccao-1], $valor[$divisao-1]);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    
    public function get_hierarchy_artigo_with_titulo() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $doc = $_GET['doc'];
            $livro = $_GET['livro'];
            $titulo = $_GET['titulo'];
            $valor = array('0' => 'I', '1' => 'II', '2' => 'III', '3' => 'IV', '4' => 'V', '5' => 'VI', '6' => 'VII', '7' => 'VIII', '8' => 'IX', '9' => 'X', '10' => 'XI', '11' => 'XII', '12' => 'XIII', '13' => 'XIV', '14' => 'XV', '15' => 'XVI', '16' => 'XVII', '17' => 'XVIII', '18' => 'XIX', '19' => 'XX');
            $resposta = $this->model_api->get_hierarchy_artigo_name_given_previous_and_titulo($doc, $valor[$livro-1], $valor[$titulo-1]);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    public function get_hierarchy_artigo_with_subtitulo() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $doc = $_GET['doc'];
            $livro = $_GET['livro'];
            $titulo = $_GET['titulo'];
            $subtitulo = $_GET['subtitulo'];
            $valor = array('0' => 'I', '1' => 'II', '2' => 'III', '3' => 'IV', '4' => 'V', '5' => 'VI', '6' => 'VII', '7' => 'VIII', '8' => 'IX', '9' => 'X', '10' => 'XI', '11' => 'XII', '12' => 'XIII', '13' => 'XIV', '14' => 'XV', '15' => 'XVI', '16' => 'XVII', '17' => 'XVIII', '18' => 'XIX', '19' => 'XX');
            $resposta = $this->model_api->get_hierarchy_artigo_name_given_previous_and_subtitulo($doc, $valor[$livro-1], $valor[$titulo-1], $valor[$subtitulo-1]);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    public function get_hierarchy_artigo_with_capitulo() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $doc = $_GET['doc'];
            $livro = $_GET['livro'];
            $titulo = $_GET['titulo'];
            $subtitulo = $_GET['subtitulo'];
            $capitulo = $_GET['capitulo'];
            $valor = array('0' => 'I', '1' => 'II', '2' => 'III', '3' => 'IV', '4' => 'V', '5' => 'VI', '6' => 'VII', '7' => 'VIII', '8' => 'IX', '9' => 'X', '10' => 'XI', '11' => 'XII', '12' => 'XIII', '13' => 'XIV', '14' => 'XV', '15' => 'XVI', '16' => 'XVII', '17' => 'XVIII', '18' => 'XIX', '19' => 'XX');
            $resposta = $this->model_api->get_hierarchy_artigo_name_given_previous_and_capitulo($doc, $valor[$livro-1], $valor[$titulo-1], $valor[$subtitulo-1], $valor[$capitulo-1]);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    public function get_hierarchy_artigo_with_capitulo_no_subtitulo() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $doc = $_GET['doc'];
            $livro = $_GET['livro'];
            $titulo = $_GET['titulo'];
            $capitulo = $_GET['capitulo'];
            $valor = array('0' => 'I', '1' => 'II', '2' => 'III', '3' => 'IV', '4' => 'V', '5' => 'VI', '6' => 'VII', '7' => 'VIII', '8' => 'IX', '9' => 'X', '10' => 'XI', '11' => 'XII', '12' => 'XIII', '13' => 'XIV', '14' => 'XV', '15' => 'XVI', '16' => 'XVII', '17' => 'XVIII', '18' => 'XIX', '19' => 'XX');
            $resposta = $this->model_api->get_hierarchy_artigo_name_given_previous_and_capitulo_no_subtitulo($doc, $valor[$livro-1], $valor[$titulo-1], $valor[$capitulo-1]);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    public function get_hierarchy_artigo_with_seccao() {
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
            $valor = array('0' => 'I', '1' => 'II', '2' => 'III', '3' => 'IV', '4' => 'V', '5' => 'VI', '6' => 'VII', '7' => 'VIII', '8' => 'IX', '9' => 'X', '10' => 'XI', '11' => 'XII', '12' => 'XIII', '13' => 'XIV', '14' => 'XV', '15' => 'XVI', '16' => 'XVII', '17' => 'XVIII', '18' => 'XIX', '19' => 'XX');
            $resposta = $this->model_api->get_hierarchy_artigo_name_given_previous_and_seccao($doc, $valor[$livro-1], $valor[$titulo-1], $valor[$subtitulo-1], $valor[$capitulo-1], $valor[$seccao-1]);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    public function get_hierarchy_artigo_with_seccao_no_subtitulo() {
        $this->load->model("model_api");
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

        echo '<response>';
            $doc = $_GET['doc'];
            $livro = $_GET['livro'];
            $titulo = $_GET['titulo'];
            $capitulo = $_GET['capitulo'];
            $seccao = $_GET['seccao'];
            $valor = array('0' => 'I', '1' => 'II', '2' => 'III', '3' => 'IV', '4' => 'V', '5' => 'VI', '6' => 'VII', '7' => 'VIII', '8' => 'IX', '9' => 'X', '10' => 'XI', '11' => 'XII', '12' => 'XIII', '13' => 'XIV', '14' => 'XV', '15' => 'XVI', '16' => 'XVII', '17' => 'XVIII', '18' => 'XIX', '19' => 'XX');
            $resposta = $this->model_api->get_hierarchy_artigo_name_given_previous_and_seccao_no_subtitulo($doc, $valor[$livro-1], $valor[$titulo-1], $valor[$capitulo-1], $valor[$seccao-1]);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    public function get_hierarchy_artigo_with_subseccao() {
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
            $valor = array('0' => 'I', '1' => 'II', '2' => 'III', '3' => 'IV', '4' => 'V', '5' => 'VI', '6' => 'VII', '7' => 'VIII', '8' => 'IX', '9' => 'X', '10' => 'XI', '11' => 'XII', '12' => 'XIII', '13' => 'XIV', '14' => 'XV', '15' => 'XVI', '16' => 'XVII', '17' => 'XVIII', '18' => 'XIX', '19' => 'XX');
            $resposta = $this->model_api->get_hierarchy_artigo_name_given_previous_and_subseccao($doc, $valor[$livro-1], $valor[$titulo-1], $valor[$subtitulo-1], $valor[$capitulo-1], $valor[$seccao-1], $valor[$subseccao-1]);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    public function get_hierarchy_artigo_with_subseccao_no_subtitulo() {
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
            $valor = array('0' => 'I', '1' => 'II', '2' => 'III', '3' => 'IV', '4' => 'V', '5' => 'VI', '6' => 'VII', '7' => 'VIII', '8' => 'IX', '9' => 'X', '10' => 'XI', '11' => 'XII', '12' => 'XIII', '13' => 'XIV', '14' => 'XV', '15' => 'XVI', '16' => 'XVII', '17' => 'XVIII', '18' => 'XIX', '19' => 'XX');
            $resposta = $this->model_api->get_hierarchy_artigo_name_given_previous_and_subseccao_no_subtitulo($doc, $valor[$livro-1], $valor[$titulo-1], $valor[$capitulo-1], $valor[$seccao-1], $valor[$subseccao-1]);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    public function get_hierarchy_artigo_with_divisao() {
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
            $valor = array('0' => 'I', '1' => 'II', '2' => 'III', '3' => 'IV', '4' => 'V', '5' => 'VI', '6' => 'VII', '7' => 'VIII', '8' => 'IX', '9' => 'X', '10' => 'XI', '11' => 'XII', '12' => 'XIII', '13' => 'XIV', '14' => 'XV', '15' => 'XVI', '16' => 'XVII', '17' => 'XVIII', '18' => 'XIX', '19' => 'XX');
            $resposta = $this->model_api->get_hierarchy_artigo_name_given_previous_and_divisao($doc, $valor[$livro-1], $valor[$titulo-1], $valor[$subtitulo-1], $valor[$capitulo-1], $valor[$seccao-1], $valor[$subseccao-1], $valor[$divisao-1]);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    public function get_hierarchy_artigo_with_divisao_no_subtitulo() {
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
            $valor = array('0' => 'I', '1' => 'II', '2' => 'III', '3' => 'IV', '4' => 'V', '5' => 'VI', '6' => 'VII', '7' => 'VIII', '8' => 'IX', '9' => 'X', '10' => 'XI', '11' => 'XII', '12' => 'XIII', '13' => 'XIV', '14' => 'XV', '15' => 'XVI', '16' => 'XVII', '17' => 'XVIII', '18' => 'XIX', '19' => 'XX');
            $resposta = $this->model_api->get_hierarchy_artigo_name_given_previous_and_divisao_no_subtitulo($doc, $valor[$livro-1], $valor[$titulo-1], $valor[$capitulo-1], $valor[$seccao-1], $valor[$subseccao-1], $valor[$divisao-1]);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    public function get_hierarchy_artigo_with_subdivisao() {
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
            $valor = array('0' => 'I', '1' => 'II', '2' => 'III', '3' => 'IV', '4' => 'V', '5' => 'VI', '6' => 'VII', '7' => 'VIII', '8' => 'IX', '9' => 'X', '10' => 'XI', '11' => 'XII', '12' => 'XIII', '13' => 'XIV', '14' => 'XV', '15' => 'XVI', '16' => 'XVII', '17' => 'XVIII', '18' => 'XIX', '19' => 'XX');
            $resposta = $this->model_api->get_hierarchy_artigo_name_given_previous_and_subdivisao($doc, $valor[$livro-1], $valor[$titulo-1], $valor[$subtitulo-1], $valor[$capitulo-1], $valor[$seccao-1], $valor[$subseccao-1], $valor[$divisao-1], $valor[$subdivisao-1]);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
    public function get_hierarchy_artigo_with_subdivisao_no_subtitulo() {
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
            $valor = array('0' => 'I', '1' => 'II', '2' => 'III', '3' => 'IV', '4' => 'V', '5' => 'VI', '6' => 'VII', '7' => 'VIII', '8' => 'IX', '9' => 'X', '10' => 'XI', '11' => 'XII', '12' => 'XIII', '13' => 'XIV', '14' => 'XV', '15' => 'XVI', '16' => 'XVII', '17' => 'XVIII', '18' => 'XIX', '19' => 'XX');
            $resposta = $this->model_api->get_hierarchy_artigo_name_given_previous_and_subdivisao_no_subtitulo($doc, $valor[$livro-1], $valor[$titulo-1], $valor[$capitulo-1], $valor[$seccao-1], $valor[$subseccao-1], $valor[$divisao-1], $valor[$subdivisao-1]);
            if ($resposta == "") {
                echo "0";
            } else {
                echo $resposta;
            }
        echo '</response>';
    }
}