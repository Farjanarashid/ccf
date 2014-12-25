<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customer extends CI_Controller
{
    private $sessiondata;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('customerdb');
        $this->sessiondata = $this->session->userdata('logindata');
    }

    public function index()
    {
        $data['title'] = "Customer";
        $data['active_menu'] = "master";
        $data['active_sub_menu'] = "customer";;
        $data['baseurl'] = $this->config->item('base_url');
        //query data to view into table
        $cmpid = $this->sessiondata['companyid'];
        $query2 = $this->db->query("SELECT  *  FROM  accountledger WHERE accountGroupId=28 and companyId='$cmpid' ORDER BY ledgerId DESC ");
        $data['customerinfo'] = $query2->result();

        $getcompanylist = $this->load->model('company_y');
        $data['companylist'] = $this->company_y->getcomapnylist();
        if ($this->sessiondata['username'] != NULL && $this->sessiondata['status'] == 'login'):

            $data['company_id']=$this->sessiondata['companyid'];
            $this->load->view('header', $data);
            $this->load->view('sidebar', $data);
            $this->load->view('customer/customer', $data);
            $this->load->view('footer', $data);
            $this->load->view('customer/script', $data);
        else:
            $this->load->view('masterlogin', $data);
        endif;
    }

    function customerNameCheck()
    {
        $isExist = $this->customerdb->customerNameCheck();
        if ($isExist == 'true') {
            die('free');
        } else {
            die('booked');
        }
    }

    public function add()
    {
        $data['title'] = "Customer";
        $data['active_menu'] = "master";
        $data['active_sub_menu'] = "home";
        $data['baseurl'] = $this->config->item('base_url');
        $isadded = $this->customerdb->addcustomer();
        if ($isadded) {
            echo 'Added';
        } else {
            echo 'Notadded';
        }
    }

    public function edit()
    {
        $data['title'] = "customer";
        $data['active_menu'] = "master";
        $data['active_sub_menu'] = "home";
        $data['baseurl'] = $this->config->item('base_url');
        $realuser = $this->input->post('realuser');

        //find ledger id for supplier name
        $query = $this->db->query("SELECT ledgerId FROM accountledger WHERE acccountLedgerName = '$realuser'");
        $ledgerId = $query->row()->ledgerId;

        $isadded = $this->customerdb->editCustomer($ledgerId);

        if ($isadded) {
            die('Added');
        } else {
            die('Notadded');
        }
    }

    public function delete()
    {
        $ledger_id = $this->input->post('ledgerid');
        $checkifused = $this->db->query("select ledgerId from ledgerposting where ledgerId = '$ledger_id'");
        if($checkifused->num_rows() > 0){
            echo 'Notdeleted';
        }else{
           $delete = $this->db->query("DELETE FROM accountledger WHERE ledgerId='$ledger_id'");
           echo 'deleted';
        }   
    }
}