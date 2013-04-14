<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Site extends CI_Controller {

    public function index() {
        $this->home();
    }

    public function home() {
        $this->load->model("model_get");
        $data["result"] = $this->model_get->getData("home");

        $this->load->view("site_header");
        if ($this->session->userdata('is_logged_in')) {
            $data["logged_user"] = $this->session->userdata('email');
            $this->load->view("site_logged", $data);
        } else {
            $this->load->view("site_login");
        }
        $this->load->view("site_nav");
        $this->load->view("content_home", $data);
        $this->load->view("site_footer");
    }

    public function about() {
        $this->load->model("model_get");
        $data["result"] = $this->model_get->getData("about");

        $this->load->view("site_header");
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view("site_logged");
        } else {
            $this->load->view("site_login");
        }
        $this->load->view("site_nav");
        $this->load->view("content_about", $data);
        $this->load->view("site_footer");
    }

    public function contact() {
        $data["message"] = "";
        $this->load->view("site_header");
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view("site_logged");
        } else {
            $this->load->view("site_login");
        }
        $this->load->view("site_nav");
        $this->load->view("content_contact", $data);
        $this->load->view("site_footer");
    }

    public function send_email() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("fullName", "Full Name", "required|alpha|xss_clean");
        $this->form_validation->set_rules("email", "Email", "required|valid_email|xss_clean");
        $this->form_validation->set_rules("message", "Message", "required|xss_clean");
        if ($this->form_validation->run() == FALSE) {
            $data["message"] = "";
            $this->load->view("site_header");
            if ($this->session->userdata('is_logged_in')) {
                $this->load->view("site_logged");
            } else {
                $this->load->view("site_login");
            }
            $this->load->view("site_nav");
            $this->load->view("content_contact", $data);
            $this->load->view("site_footer");
        } else {
            $data["message"] = "Success";

            $this->load->library('email');
            $this->email->set_newline("\r\n");
            $this->email->from(set_value("email"), set_value("fullName"));
            $this->email->to("martinezzz_92@hotmail.com");
            $this->email->subject("Message from form");
            $this->email->message(set_value("message"));
            $result = $this->email->send();

            $this->load->view("site_header");
            if ($this->session->userdata('is_logged_in')) {
                $this->load->view("site_logged");
            } else {
                $this->load->view("site_login");
            }
            $this->load->view("site_nav");
            $this->load->view("content_contact", $data);
            $this->load->view("site_footer");
        }
    }

    public function signup() {
        $this->load->model("model_get");
        $data["result"] = $this->model_get->getData("home");

        $this->load->view("site_header");
        if ($this->session->userdata('is_logged_in')) {
            $data["logged_user"] = $this->session->userdata('email');
            $this->load->view("site_logged", $data);
        } else {
            $this->load->view("site_login");
        }
        $this->load->view("site_nav");
        $this->load->view("site_signup", $data);
        $this->load->view("site_footer");
    }

    public function signup_validation() {
        $this->load->library('form_validation');
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
            $this->email->to("ctmartinez1992@gmail.com");
            $this->email->subject("confirm your account");

            $message = "<p>Thank you for signing up!</p>";
            $message .= "<p><a href='" . base_url() . "site/register_user/$key'>Click here</a>
            to confirm</p>";
            $this->email->message($message);

            if ($this->model_users->add_temp_user($key)) {
                $result = $this->email->send();
                if ($result) {
                    echo "email was sent";
                } else {
                    echo "email was NOT sent";
                }
            } else {
                echo "problem adding to db.";
            }
        } else {
            $this->load->model("model_get");
            $data["result"] = $this->model_get->getData("home");

            $this->load->view("site_header");
            if ($this->session->userdata('is_logged_in')) {
                $data["logged_user"] = $this->session->userdata('email');
                $this->load->view("site_logged", $data);
            } else {
                $this->load->view("site_login");
            }
            $this->load->view("site_nav");
            $this->load->view("site_signup", $data);
            echo "erro a preencher os campos";
            $this->load->view("site_footer");
        }
    }

    public function register_user($key) {
        $this->load->model('model_users');
        if ($this->model_users->is_key_valid($key)) {
            if ($newemail = $this->model_users->add_user($key)) {
                $data = array(
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
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clear|callback_validate_credentials');
        $this->form_validation->set_rules('password', 'Password', 'required|md5|trim|xss_clear');
        if ($this->form_validation->run()) {
            $data = array(
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

    public function logout() {
        $this->session->sess_destroy();
        $this->home();
    }
}