<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class backend extends CI_Controller {
    
    public function main_alteration() {
        $this->load->helper('xml');
        $this->load->helper('file');
        $this->load->model("model_api");
        $this->load->model("model_get");
        $this->load->model("model_put");
        $this->load->model("model_users");
        $this->load->library('session');
        $data["result"] = $this->model_get->getData("about");

        $this->load->view("site_header");
        if ($this->session->userdata('is_logged_in')) {
            $data["logged_user"] = $this->session->userdata('nome');
            $data["tipo"] = $this->model_users->get_tipo_given_email($this->session->userdata('email'));
            $this->load->view("site_logged", $data);
            $this->load->view("site_nav_logged", $data);
        } else {
            $this->load->view("site_login");
            $this->load->view("site_nav");
        }
        
        $main_data["docs"] = $this->model_get->getUndoneDocs();
        
        $this->load->view("content_main_alteration", $main_data);
        $this->load->view("site_footer");
    }
    
    public function add_doc_alt() {
        $this->load->helper('xml');
        $this->load->helper('file');
        $this->load->model("model_api");
        $this->load->model("model_get");
        $this->load->model("model_users");
        $this->load->library('session');
        $data["result"] = $this->model_get->getData("about");

        $this->load->view("site_header");
        if ($this->session->userdata('is_logged_in')) {
            $data["logged_user"] = $this->session->userdata('nome');
            $data["tipo"] = $this->model_users->get_tipo_given_email($this->session->userdata('email'));
            $this->load->view("site_logged", $data);
            $this->load->view("site_nav_logged", $data);
        } else {
            $this->load->view("site_login");
            $this->load->view("site_nav");
        }
        
        $main_data['artigos'] = $this->model_api->get_all_articles_ever();
        $main_data['main'] = $this->model_api->get_full_article(1);
        
        $this->load->view("content_alteration", $main_data);
        $this->load->view("site_footer");
    }
    
    public function alt_doc_alt() {
        $this->load->helper('xml');
        $this->load->helper('file');
        $this->load->model("model_api");
        $this->load->model("model_get");
        $this->load->model("model_users");
        $this->load->library('session');
        $data["result"] = $this->model_get->getData("about");

        $this->load->view("site_header");
        if ($this->session->userdata('is_logged_in')) {
            $data["logged_user"] = $this->session->userdata('nome');
            $data["tipo"] = $this->model_users->get_tipo_given_email($this->session->userdata('email'));
            $this->load->view("site_logged", $data);
            $this->load->view("site_nav_logged", $data);
        } else {
            $this->load->view("site_login");
            $this->load->view("site_nav");
        }
        
        $main_data['main'] = $this->model_api->get_full_article($_GET['artigo']);
        
        $this->load->view("content_alt_alteration", $main_data);
        $this->load->view("site_footer");
    }
}