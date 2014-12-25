<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Farmer extends CI_Controller {

    private $sessiondata;

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('ccffarmer');
        $this->sessiondata = $this->session->userdata('logindata');
        if ($this->sessiondata['status'] = 'login'):
            $accessFlag = 1;
        else:
            $accessFlag = 0;
            redirect('home');
        endif;
    }

    public function index() {
        $data['baseurl'] = $this->config->item('base_url');
        $data['title'] = "Farmer";
        $data['active_menu'] = "master";
        $data['active_sub_menu'] = "farmer";
        if ($this->sessiondata['username'] != NULL && $this->sessiondata['status'] == 'login' && $this->sessiondata['role'] == 'admin'):
            $data['sortalldata'] = $this->ccffarmer->sortalldata();
            $data['alldata'] = $this->ccffarmer->showalldata();
            $this->load->view('header', $data);
            $this->load->view('sidebar', $data);
            $this->load->view('farmer/farmer', $data);
            $this->load->view('footer', $data);
        else:
            redirect('home');
        endif;
    }

    public function addAccLedger() {
        if ($this->sessiondata['username'] != NULL && $this->sessiondata['status'] == 'login' && $this->sessiondata['role'] == 'admin'):
            $isadded = $this->ccffarmer->addAccLedger();
            if ($isadded) {
                echo 'Added';
            } else {
                echo 'Notadded';
            }
        else:
            redirect('home');
        endif;
    }

    public function editAccLedger() {
        if ($this->sessiondata['username'] != NULL && $this->sessiondata['status'] == 'login' && $this->sessiondata['role'] == 'admin'):
            $isupdated = $this->ccffarmer->editAccLedger();
            if ($isupdated) {
                die('Updated');
            } else {
                die('Notupdated');
            }
        else:
            redirect('home');
        endif;
    }

    public function accountNameCheck() {
        if ($this->sessiondata['username'] != NULL && $this->sessiondata['status'] == 'login' && $this->sessiondata['role'] == 'admin'):
            $isExist = $this->ccffarmer->accountNameCheck();
            if ($isExist) {
                die('free');
            } else {
                die('booked');
            }
        else:
            redirect('home');
        endif;
    }

    public function deleteFarmer() {
        if ($this->sessiondata['username'] != NULL && $this->sessiondata['status'] == 'login' && $this->sessiondata['role'] == 'admin'):
            $isdeleted = $this->ccffarmer->deleteFarmer();
            echo $isdeleted;
        else:
            redirect('home');
        endif;
    }

}
