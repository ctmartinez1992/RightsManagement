<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class main_program extends CI_Controller {

    public function search_validation() {
        echo "js";
    }

    public function macro_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('input_macro', 'Macro', 'required');
        
        $livro_count = 0;
        $titulo_count = 0;
        $subtitulo_count = 0;
        $capitulo_count = 0;
        $seccao_count = 0;
        $subseccao_count = 0;
        $divisao_count = 0;
        $subdivisao_count = 0;
        $artigo_count = 0;
        $return = array(array());
        $failed = false;
        if ($this->form_validation->run()) {
            $parts = explode(";", $this->input->post("input_macro"));
            if (count($parts) <= 1) {
                echo "10";
            } else {
                for ($i=0; $i<count($parts)-1; $i++) {
                    $part = explode(":", $parts[$i]);
                    if ($parts[$i] != "" && count($part) <= 1) {
                        echo "20";
                    } else {
                        $values = explode(",", $part[1]);
                        if (count($values) < 1) {
                            echo "30";
                        } else if (count($values) == 1) {
                            if (is_numeric($part[1])) {
                                if (trim($part[0]) == "Livro" || trim($part[0]) == "livro") {
                                    $return["livro"][0] = trim($part[1]);
                                }
                                if (trim($part[0]) == "Titulo" || trim($part[0]) == "titulo") {
                                    $return["titulo"][0] = trim($part[1]);
                                }
                                if (trim($part[0]) == "Subtitulo" || trim($part[0]) == "subtitulo") {
                                    $return["subtitulo"][0] = trim($part[1]);
                                }
                                if (trim($part[0]) == "Capitulo" || trim($part[0]) == "capitulo") {
                                    $return["capitulo"][0] = trim($part[1]);
                                }
                                if (trim($part[0]) == "Seccao" || trim($part[0]) == "seccao") {
                                    $return["seccao"][0] = trim($part[1]);
                                }
                                if (trim($part[0]) == "Subseccao" || trim($part[0]) == "subseccao") {
                                    $return["subseccao"][0] = trim($part[1]);
                                }
                                if (trim($part[0]) == "Divisao" || trim($part[0]) == "divisao") {
                                    $return["divisao"][0] = trim($part[1]);
                                }
                                if (trim($part[0]) == "Subdivisao" || trim($part[0]) == "subdivisao") {
                                    $return["subdivisao"][0] = trim($part[1]);
                                }
                                if (trim($part[0]) == "Artigo" || trim($part[0]) == "artigo") {
                                    $return["artigo"][0] = trim($part[1]);
                                }
                            }
                        } else {
                            for ($j=0; $j<count($values); $j++) {
                                if (is_numeric($values[$j])) {
                                    if (trim($part[0]) == "Livro" || trim($part[0]) == "livro") {
                                        $return["livro"][$livro_count] = trim($values[$j]);
                                        $livro_count++;
                                    }
                                    if (trim($part[0]) == "Titulo" || trim($part[0]) == "titulo") {
                                        $return["titulo"][$titulo_count] = trim($values[$j]);
                                        $titulo_count++;
                                    }
                                    if (trim($part[0]) == "Subtitulo" || trim($part[0]) == "subtitulo") {
                                        $return["subtitulo"][$subtitulo_count] = trim($values[$j]);
                                        $subtitulo_count++;
                                    }
                                    if (trim($part[0]) == "Capitulo" || trim($part[0]) == "capitulo") {
                                        $return["capitulo"][$capitulo_count] = trim($values[$j]);
                                        $capitulo_count++;
                                    }
                                    if (trim($part[0]) == "Seccao" || trim($part[0]) == "seccao") {
                                        $return["seccao"][$seccao_count] = trim($values[$j]);
                                        $seccao_count++;
                                    }
                                    if (trim($part[0]) == "Subseccao" || trim($part[0]) == "subseccao") {
                                        $return["subseccao"][$subseccao_count] = trim($values[$j]);
                                        $subseccao_count++;
                                    }
                                    if (trim($part[0]) == "Divisao" || trim($part[0]) == "divisao") {
                                        $return["divisao"][$divisao_count] = trim($values[$j]);
                                        $divisao_count++;
                                    }
                                    if (trim($part[0]) == "Subdivisao" || trim($part[0]) == "subdivisao") {
                                        $return["subdivisao"][$subdivisao_count] = trim($values[$j]);
                                        $subdivisao_count++;
                                    }
                                    if (trim($part[0]) == "Artigo" || trim($part[0]) == "artigo") {
                                        $return["artigo"][$artigo_count] = trim($values[$j]);
                                        $artigo_count++;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        for ($i=0; $i<count($return["artigo"]); $i++) {
            echo $return["artigo"][$i] . "-";
        }
        echo "<br>";
        for ($i=0; $i<count($return["livro"]); $i++) {
            echo $return["livro"][$i] . "-";
        }
        echo "<br>";
        for ($i=0; $i<count($return["subseccao"]); $i++) {
            echo $return["subseccao"][$i] . "-";
        }
    }
}