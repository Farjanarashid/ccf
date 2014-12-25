<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AccountLedger extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ccfaccountledger');
        $this->sessiondata = $this->session->userdata('logindata');
    }

    public function index() {
        $data['baseurl'] = $this->config->item('base_url');
        $data['title'] = "Account Ledger";
        $data['active_menu'] = "master";
        $data['active_sub_menu'] = "accountLedger";
        if ($this->sessiondata['username'] != NULL && $this->sessiondata['status'] == 'login' && $this->sessiondata['role'] == 'admin'):
            $data['sortalldata'] = $this->ccfaccountledger->sortalldata();
            $data['alldata'] = $this->ccfaccountledger->showalldata();
            $this->load->view('accountLedger', $data);
        else:
            redirect('home');
        endif;
    }

    public function addAccLedger() {
        if ($this->sessiondata['username'] != NULL && $this->sessiondata['status'] == 'login' && $this->sessiondata['role'] == 'admin'):
            $acclednam = $this->input->post('acccountLedgerName');
            $accgrp = $this->input->post('accountGroupId');
            if ($accgrp == "27") {
                $cmpid = $this->sessiondata['companyid'];
                $isadded1 = $this->ccfaccountledger->addAccLedger();
                $query = $this->db->query("SELECT  ledgerId  FROM  accountledger WHERE acccountLedgerName='$acclednam' AND companyId = '$cmpid'");
                $ledgerId = $query->row()->ledgerId;
                $isadded2 = $this->ccfaccountledger->addvendor2($ledgerId);
                if ($isadded1 && $isadded2) {
                    die('Added');
                } else {
                    die('Notadded');
                }
            } else {
                $isadded = $this->ccfaccountledger->addAccLedger();
                if ($isadded) {
                    die('Added');
                } else {
                    die('Notadded');
                }
            }
        else:
            redirect('home');
        endif;
    }

    public function editAccLedger() {
        if ($this->sessiondata['username'] != NULL && $this->sessiondata['status'] == 'login' && $this->sessiondata['role'] == 'admin'):
            $isupdated = $this->ccfaccountledger->AccLedgerEdit();
            if ($isupdated) {
                echo 'Updated';
            } else {
                echo 'Notupdated';
            }
        else:
            redirect('home');
        endif;
    }

    public function deleteAccLedger() {
        if ($this->sessiondata['username'] != NULL && $this->sessiondata['status'] == 'login' && $this->sessiondata['role'] == 'admin'):
            $deleted = $this->ccfaccountledger->AccLedgerdelete();
            echo $deleted;
        else:
            redirect('home');
        endif;
    }

    public function editAccLedgerDefault() {
        if ($this->sessiondata['username'] != NULL && $this->sessiondata['status'] == 'login' && $this->sessiondata['role'] == 'admin'):
            $isupdated = $this->ccfaccountledger->editAccLedgerDefault();
            if ($isupdated) {
                echo 'Updated';
            } else {
                echo 'Notupdated';
            }
        else:
            redirect('home');
        endif;
    }

    public function accountNameCheck() {
        if ($this->sessiondata['username'] != NULL && $this->sessiondata['status'] == 'login' && $this->sessiondata['role'] == 'admin'):
            $isExist = $this->ccfaccountledger->accountNameCheck();
            if ($isExist) {
                die('free');
            } else {
                die('booked');
            }
        else:
            redirect('home');
        endif;
    }

}
