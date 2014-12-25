<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Supplier extends CI_Controller {

    private $sessiondata;

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->sessiondata = $this->session->userdata('logindata');
    }

    public function index() {
        $data['title'] = "Supplier";
        $data['active_menu'] = "master";
        $data['active_sub_menu'] = "home";
        $data['baseurl'] = $this->config->item('base_url');
        //query data to view into table
        $cmpid = $this->sessiondata['companyid'];
        $query2 = $this->db->query("SELECT  *  FROM  accountledger WHERE accountGroupId=27 and companyId='$cmpid' ORDER BY ledgerId DESC");
        $data['supplierinfo1'] = $query2->result();

        $query = $this->db->query("SELECT  *  FROM  vendor  ORDER BY vendorId DESC");
        $data['supplierinfo2'] = $query->result();

        $query2 = $this->db->query("SELECT  *  FROM  countries");
        $data['countries'] = $query2->result();
        $getcompanylist = $this->load->model('company_y');
        $data['companylist'] = $this->company_y->getcomapnylist();
        if ($this->sessiondata['username'] != NULL && $this->sessiondata['status'] == 'login'):
            $data['company_id'] = $this->sessiondata['companyid'];
            $this->load->view('supplier', $data);
        else:
            $this->load->view('masterlogin', $data);
        endif;
    }

    function suppliernamecheck() {
        $this->load->model('supplierdb');
        $isExist = $this->supplierdb->supplierNameCheck();
        if ($isExist == 'true') {
            die('free');
        } else {
            die('booked');
        }
    }

    public function add() {
        $data['title'] = "Supplier";
        $data['active_menu'] = "master";
        $data['active_sub_menu'] = "home";
        $data['baseurl'] = $this->config->item('base_url');
        $supplier_name = $this->input->post('supplier_name');
        $paymentvouModal = $this->input->post('paymentvouModal');
        $receiptvouModal = $this->input->post('receiptvouModal');
        $this->load->model('supplierdb');
        $isadded1 = $this->supplierdb->addSupplier1();
        //find ledger id for supplier name
        $query = $this->db->query("SELECT ledgerId FROM accountledger WHERE acccountLedgerName = '$supplier_name'");
        $ledgerId = $query->row()->ledgerId;
        $isadded2 = $this->supplierdb->addSupplier2($ledgerId);               
        if ($paymentvouModal == "addpaymentvouModal") {
            if ($isadded1 && $isadded2) {               
                redirect('paymentvoucher/paymentvoucher/addpaymentvoucher');
            } else {                
                redirect('paymentvoucher/paymentvoucher/addpaymentvoucher');
            }
        } else {
            if ($isadded1 && $isadded2) {
                echo 'Added';
            } else {
                echo 'Notadded';
            }
        }
        if ($receiptvouModal == "addreceiptvouModal") {
            if ($isadded1 && $isadded2) {               
                redirect('receiptvoucher/receiptvoucher/addreceiptvoucher');
            } else {                
                redirect('receiptvoucher/receiptvoucher/addreceiptvoucher');
            }
        }
    }

    public function edit() {
        $data['title'] = "Supplier";
        $data['active_menu'] = "master";
        $data['active_sub_menu'] = "home";
        $data['baseurl'] = $this->config->item('base_url');
        $realuser = $this->input->post('realuser');
        //find ledger id for supplier name
        $query = $this->db->query("SELECT ledgerId FROM accountledger WHERE acccountLedgerName = '$realuser'");
        $ledgerId = $query->row()->ledgerId;
        $this->load->model('supplierdb');
        $isadded1 = $this->supplierdb->editSupplier1($ledgerId);

        $isadded2 = $this->supplierdb->editSupplier2($ledgerId);
        if ($isadded1 && $isadded2) {
            die('Added');
        } else {
            die('Notadded');
        }
    }

    public function delete() {
        $ledger_id = $this->input->post('ledgerid');
        $delete1 = $this->db->query("DELETE FROM `vendor` WHERE ledgerId='$ledger_id'");
        $delete2 = $this->db->query("DELETE FROM `accountledger` WHERE ledgerId='$ledger_id'");
        if ($delete1 && $delete2) {
            die('deleted');
        } else {
            die('Notdeleted');
        }
    }

}
