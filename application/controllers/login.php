<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');

    }

    function index() {
        $data['baseurl'] = $this->config->item('base_url');
        if (isset($_POST['username'])):
            $Checklogin = $this->load->model('company_y');
            $resultlogin = $this->company_y->checkuserinfoForLogin();
            if ($resultlogin):
                $data['title'] = "Login success";
                $this->load->view('header', $data);
                $this->load->view('sidebar', $data);
                $this->load->view('dashboard/dashboard', $data);
                $this->load->view('footer', $data);
            else:
                $data['page_title'] = "Fail login";
                $getcompanylist = $this->load->model('company_y');
                $data['companylist'] = $this->company_y->getcomapnylist();
                $this->load->view('masterlogin', $data);
            endif;
        else:
            $data['page_title'] = "Fail login";
            $getcompanylist = $this->load->model('company_y');
            $data['companylist'] = $this->company_y->getcomapnylist();
            $this->load->view('masterlogin', $data);
        endif;
    }

    function logout() {
        $this->session->sess_destroy();
        $data['baseurl'] = $this->config->item('base_url');
        $getcompanylist = $this->load->model('company_y');
        $data['companylist'] = $this->company_y->getcomapnylist();
        $this->load->view('masterlogin', $data);
    }

}
