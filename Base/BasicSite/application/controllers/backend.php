<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class backend extends CI_Controller {
    
    public function manage_docs() {
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
        
        $main_data["docs"] = $this->model_get->getUndoneDocsAll();
        
        $this->load->view("content_manage_docs", $main_data);
        $this->load->view("site_footer");
    }
    
    public function hierarchy_alteration() {
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
        
        $main_data["hdoc"] = $this->model_api->get_last_hierarchy_doc_added();
        $main_data["doc"] = $this->model_api->get_last_doc_added();
        $main_data["docs"] = $this->model_get->getUndoneDocs();
        
        $this->load->view("content_hierarchy_alteration", $main_data);
        $this->load->view("site_footer");
    }
    
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
        
        $main_data['main'] = $this->model_api->get_article_given_temp_doc($_GET['artigo'], $_GET['doc']);
        
        $this->load->view("content_alteration_alt", $main_data);
        $this->load->view("site_footer");
    }
    
    public function add_doc_add() {
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
        
        $main_data["hdoc"] = $this->model_api->get_last_hierarchy_doc_added();
        $main_data["doc"] = $this->model_api->get_last_doc_added();
        $main_data["docs"] = $this->model_get->getUndoneDocs();
        
        $this->load->view("content_addition", $main_data);
        $this->load->view("site_footer");
    }
    
    public function alt_doc_add() {
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
        
        $main_data['main'] = $this->model_api->get_article_given_temp_doc($_GET['artigo'], $_GET['doc']);
        
        $this->load->view("content_addition_alt", $main_data);
        $this->load->view("site_footer");
    }
    
    public function add_doc_rem() {
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
        
        $this->load->view("content_remove", $main_data);
        $this->load->view("site_footer");
    }
}