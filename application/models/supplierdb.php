<?php

class Supplierdb extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->sessiondata = $this->session->userdata('logindata');
    }

    function addSupplier1() {
        $opening_balance = $this->input->post('opening_balance');
        if ($opening_balance == "") {
            $opening_balance = 0.00;
        }
        $data1 = array(
            'acccountLedgerName' => $this->input->post('supplier_name'),
            'accountGroupId' => '27',
            'openingBalance' => $opening_balance,
            'debitOrCredit' => $this->input->post('dr_cr'),
            'defaultOrNot' => '0',
            'billByBill' => '1',
            'companyId' => $this->sessiondata['companyid']
        );

        $saveresult = $this->db->insert('accountledger', $data1);
        return $saveresult;
    }

    function addSupplier2($ledgerId) {
        $data2 = array(
            'vendorName' => $this->input->post('supplier_name'),
            'address' => $this->input->post('address'),
            'country' => $this->input->post('country'),
            'phoneNumber' => $this->input->post('phone'),
            'emailId' => $this->input->post('email'),
            'mobileNumber' => $this->input->post('mobile'),
            'description' => $this->input->post('description'),
            'ledgerId' => $ledgerId,
            'companyId' => $this->sessiondata['companyid']
        );
        $saveresult = $this->db->insert('vendor', $data2);
        return $saveresult;
    }

    //edit data
    function editSupplier1($ledgerId) {
        $data = array(
            'acccountLedgerName' => $this->input->post('supplier_name'),
            'accountGroupId' => '27',
            'openingBalance' => $this->input->post('opening_balance'),
            'debitOrCredit' => $this->input->post('dr_cr'),
            'defaultOrNot' => '0',
            'billByBill' => '1'
        );
        $this->db->where('ledgerId', $ledgerId);
        $update = $this->db->update('accountledger', $data);
        return $update;
    }

    function editSupplier2($ledgerId) {
        $data = array(
            'vendorName' => $this->input->post('supplier_name'),
            'address' => $this->input->post('address'),
            'country' => $this->input->post('country'),
            'phoneNumber' => $this->input->post('phone'),
            'emailId' => $this->input->post('email'),
            'mobileNumber' => $this->input->post('mobile'),
            'description' => $this->input->post('description'),
            'ledgerId' => $ledgerId
        );

        $this->db->where('ledgerId', $ledgerId);
        return $this->db->update('vendor', $data);
    }

    public function supplierNameCheck() {
        $supplierName = $this->input->post('suppname');
        $queryresult = $this->db->query("select * from accountledger where 	acccountLedgerName = '$supplierName'");
        if ($queryresult->num_rows() > 0):
            return 'false';
        else:
            return 'true';
        endif;
    }

}

?>