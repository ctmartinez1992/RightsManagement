<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Site extends CI_Controller {

    public function index() {
        $this->home();
    }

    public function home() {
        $this->load->model("model_get");
        $this->load->model("model_api");
        $data["result"] = $this->model_get->getData("home");

        $this->load->view("site_header");
        if ($this->session->userdata('is_logged_in')) {
            $data["logged_user"] = $this->session->userdata('nome');
            $this->load->view("site_logged", $data);
            $this->load->view("site_nav_logged");
        } else {
            $this->load->view("site_login");
            $this->load->view("site_nav");
        }
        $this->load->view("content_home", $data);
        $this->load->view("site_footer");
        
//        $array = $this->model_api->get_article_evolution_names("1778");
//        for ($i=0; $i<sizeof($array); $i++) {
//            echo $array[$i] . " - ";
//        }
        $resposta = "";
//        $resposta = $this->model_api->was_doc_revoked_get_names("1981_12_4");
//        if ($resposta != null) {
//            echo $resposta[0] . " - " . $resposta[1];
//        } else {
//            echo "kjskjskj";
//        }
//        $array = $this->model_api->get_article_evolution_names(1767);
//        for ($i=0; $i<sizeof($array); $i++) {
//            echo $array[$i] . " - ";
//        }
        //echo $this->model_api->process_article("1778", "1976_7_17", $resposta);
        //echo $this->model_api->process_article("1779", "1975_5_27", $resposta);
        //echo $this->model_api->get_hierarchy_artigo_name_given_previous_and_subseccao_no_subtitulo("1976_7_17", "IV", "II", "XI", "II", "II");
        //echo $this->model_api->get_hierarchy_artigo_name_given_previous_and_seccao_no_subtitulo("1966_11_25", "III", "VI", "III", "II");

        //echo $this->model_api->get_hierarchy_artigo_name_given_previous_and_seccao_no_subtitulo("1966_11_25", "IV", "III", "III", "III");
//        $artigo_texto = $this->model_api->get_article_given_doc("1778", "1975_5_27");
//        $old_artigo_texto = $this->model_api->get_article_given_doc("1778", "1966_11_25");
//        echo $this->model_api->does_article_exist_in_given_doc("1", "1966_11_25");
//        $array = $this->model_api->get_article_evolution_text("1051");
//        for ($i=0; $i<sizeof($array); $i++) {
//            echo $array[$i][0] . " - ";
//            for ($j=0; $j<sizeof($array[$i][1]); $j++) {
//                echo $array[$i][1][$j] . "<br>";
//            }
//            echo "<br><br><br>";
//        }
    }

    public function about() {
        $this->load->model("model_get");
        $data["result"] = $this->model_get->getData("about");

        $this->load->view("site_header");
        if ($this->session->userdata('is_logged_in')) {
            $data["logged_user"] = $this->session->userdata('nome');
            $this->load->view("site_logged", $data);
            $this->load->view("site_nav_logged");
        } else {
            $this->load->view("site_login");
            $this->load->view("site_nav");
        }
        $this->load->view("content_about", $data);
        $this->load->view("site_footer");
    }

    public function codigo_civil() {
        $this->load->helper('xml');
        $this->load->helper('file');
        $this->load->model("model_api");
        $this->load->model("model_get");
        $this->load->library('session');
        $data["result"] = $this->model_get->getData("about");

        $this->load->view("site_header");
        if ($this->session->userdata('is_logged_in')) {
            $data["logged_user"] = $this->session->userdata('nome');
            $this->load->view("site_logged", $data);
            $this->load->view("site_nav_logged");
        } else {
            $this->load->view("site_login");
            $this->load->view("site_nav");
        }
        
        $array = $this->model_api->get_all_doc_names_array();
        $doc = $this->session->userdata('current_doc');
        if ($doc == null) {
            $doc = (string) $array[sizeof($array)-1];
            $this->session->set_userdata('current_doc', $doc);
        }
        
        $revogado = $this->model_api->was_doc_revoked_get_names($doc);
        $title = $this->model_api->get_doc_name($doc);
        
        $nav_data['docs'] = $array;
        $nav_data['current_doc'] = $doc;
        $nav_data['revogado'] = $revogado;
        $nav_data['title'] = $title;
        $search_data['livro'] = $this->model_api->get_hierarchy_livro($doc);
        $main_data['main'] = $this->model_api->get_hierarchy_livro_name($doc);
        
        $this->load->view("content_navbar", $nav_data);
        $this->load->view("content_codigo_civil", $main_data);
        $this->load->view("content_sidebar", $search_data);
        $this->load->view("site_footer");
    }
    
    public function evolucao() {
        $this->load->helper('xml');
        $this->load->helper('file');
        $this->load->model("model_api");
        $this->load->model("model_get");
        $this->load->library('session');
        $data["result"] = $this->model_get->getData("about");

        $this->load->view("site_header");
        if ($this->session->userdata('is_logged_in')) {
            $data["logged_user"] = $this->session->userdata('nome');
            $this->load->view("site_logged", $data);
            $this->load->view("site_nav_logged");
        } else {
            $this->load->view("site_login");
            $this->load->view("site_nav");
        }
        
        $array = $this->model_api->get_all_doc_names_array();
        $doc = $this->session->userdata('current_doc');
        if ($doc == null) {
            $doc = (string) $array[sizeof($array)-1];
            $this->session->set_userdata('current_doc', $doc);
        }
        
        $search_data['livro'] = $this->model_api->get_hierarchy_livro($doc);
        $main_data['main'] = $this->model_api->get_article_evolution_text($_GET['artigo']);
        
        $this->load->view("content_evolucao", $main_data);
        $this->load->view("content_sidebar", $search_data);
        $this->load->view("site_footer");
    }

    public function contact_no() {
        $data["message"] = "";
        $this->load->view("site_header");
        if ($this->session->userdata('is_logged_in')) {
            $data["logged_user"] = $this->session->userdata('nome');
            $this->load->view("site_logged", $data);
            $this->load->view("site_nav_logged");
        } else {
            $this->load->view("site_login");
            $this->load->view("site_nav");
        }
        $this->load->view("content_contact", $data);
        $this->load->view("site_footer");
    }

    public function contact($message) {
        $data["message"] = $message;
        $this->load->view("site_header");
        if ($this->session->userdata('is_logged_in')) {
            $data["logged_user"] = $this->session->userdata('nome');
            $this->load->view("site_logged", $data);
            $this->load->view("site_nav_logged");
        } else {
            $this->load->view("site_login");
            $this->load->view("site_nav");
        }
        $this->load->view("content_contact", $data);
        $this->load->view("site_footer");
    }

    public function profile() {
        $this->load->model("model_get");
        $data["result"] = $this->model_get->getData("home");

        $this->load->view("site_header");
        if ($this->session->userdata('is_logged_in')) {
            $data["logged_user"] = $this->session->userdata('nome');
            $this->load->view("site_logged", $data);
            $this->load->view("site_nav_logged");
        } else {
            $this->load->view("site_login");
            $this->load->view("site_nav");
        }
        $this->load->model("model_users");
        $data["user"] = $this->model_users->get_everything_given_email($this->session->userdata('email'));
        $this->load->view("site_profile", $data);
        $this->load->view("site_footer");
    }

    public function send_email() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("fullName", "Full Name", "required|alpha|xss_clean");
        $this->form_validation->set_rules("email", "Email", "required|valid_email|xss_clean");
        $this->form_validation->set_rules("message", "Message", "required|xss_clean");
        if ($this->form_validation->run() == FALSE) {
            $this->contact_no();
        } else {
            $this->load->library('email');
            $this->email->set_newline("\r\n");
            $this->email->from(set_value("email"), set_value("fullName"));
            $this->email->to("martinezzz_92@hotmail.com");
            $this->email->subject("Message from form");
            $this->email->message(set_value("message"));
            $result = $this->email->send();

            $this->contact("Success");
        }
    }

    public function signup() {
        $this->load->model("model_get");
        $data["result"] = $this->model_get->getData("home");

        $this->load->view("site_header");
        if ($this->session->userdata('is_logged_in')) {
            $data["logged_user"] = $this->session->userdata('nome');
            $this->load->view("site_logged", $data);
            $this->load->view("site_nav_logged");
        } else {
            $this->load->view("site_login");
            $this->load->view("site_nav");
        }
        $this->load->view("site_signup", $data);
        $this->load->view("site_footer");
    }

    public function signup_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nome', 'Nome', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|trim|matches[password]');

        $this->form_validation->set_message('is_unique', 'That email already exists.');

        if ($this->form_validation->run()) {
            $key = md5(uniqid());

            $this->load->library('email');
            $this->load->model('model_users');

            $this->email->set_newline("\r\n");
            $this->email->from('ctmartinez@sapo.pt', 'Steve');
            $this->email->to($this->input->post('email'));
            $this->email->subject("confirm your account");

            $message = "<p>Thank you for signing up!</p>";
            $message .= "<p><a href='" . base_url() . "site/register_user/$key'>Click here</a>
            to confirm</p>";
            $this->email->message($message);

            if ($this->model_users->add_temp_user($key)) {
                $result = $this->email->send();
                if ($result) {
                    $data["answer"] = "O email de confirmação foi enviado com sucesso para a sua conta.";
                } else {
                    $data["answer"] = "Pedimos desculpa, houve um erro a enviar o email de confirmação.";
                }
            } else {
                $data["answer"] = "Pedimos desculpa, houve um erro com a nossa base de dados, tente mais tarde.";
            }
            
            $this->load->model("model_get");
            $data["result"] = $this->model_get->getData("home");

            $this->load->view("site_header");
            if ($this->session->userdata('is_logged_in')) {
                $data["logged_user"] = $this->session->userdata('email');
                $this->load->view("site_logged", $data);
                $this->load->view("site_nav_logged");
            } else {
                $this->load->view("site_login");
                $this->load->view("site_nav");
            }
            $this->load->view("site_signup_answer", $data);
            $this->load->view("site_footer");
        } else {
            $this->signup();
            echo "erro a preencher os campos";
        }
    }

    public function register_user($key) {
        $this->load->model('model_users');
        if ($this->model_users->is_key_valid($key)) {
            if ($newemail = $this->model_users->add_user($key)) {
                $result = $this->model_users->get_name_given_email($newemail);
                $data = array(
                'nome' => $result->nome,
                'email' => $newemail,
                'is_logged_in' => 1
                );
                $this->session->set_userdata($data);
                
                $this->home();
            } else {
                echo "fail to add user";
            }
        } else {
            echo "invalid key";
        }
    }

    public function members() {
        $this->home();
    }

    public function login_validation() {
        $this->load->model("model_users");
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clear|callback_validate_credentials');
        $this->form_validation->set_rules('password', 'Password', 'required|md5|trim|xss_clear');
        if ($this->form_validation->run()) {
            $result = $this->model_users->get_name_given_email($this->input->post('email'));
            $data = array(
                'nome' => $result->nome,
                'email' => $this->input->post('email'),
                'is_logged_in' => 1
            );
            $this->session->set_userdata($data);
            redirect('site/members');
        } else {
            $this->home();
        }
    }

    public function validate_credentials() {
        $this->load->model('model_users');
        if ($this->model_users->can_log_in()) {
            return true;
        } else {
            $this->form_validation->set_message('validate_credentials', 'incorrect user/pass');
            return false;
        }
    }

    public function profile_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nome', 'Nome', 'required');
        if ($this->form_validation->run()) {
            $this->load->model("model_users");
            $date = mktime(0, 0, 0, $this->input->post('mes'), $this->input->post('dia'), $this->input->post('ano'));
            $this->model_users->update_profile($this->input->post('nome'),
                                               date('d/m/Y', $date),
                                               $this->input->post('pais'),
                                               $this->session->userdata('email'));
            $data = array(
                'nome' => $this->input->post('nome'),
                'email' => $this->session->userdata('email'),
                'nascimento' => date('d/m/Y', $date),
                'pais' => $this->input->post('pais'),
                'is_logged_in' => 1
            );
            $this->session->set_userdata($data);
            redirect('site/members');
        } else {
            $this->profile();
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        $this->home();
    }
}