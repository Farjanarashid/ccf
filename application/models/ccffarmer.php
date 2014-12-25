<?php

class Ccffarmer extends CI_Model {

    private $sessiondata;

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->sessiondata = $this->session->userdata('logindata');
    }

    function showalldata() {
        $this->db->select('*');
        $this->db->order_by("ledgerId", "desc");
        $this->db->from('accountledger');
        $this->db->where('accountGroupId', "13");
        $this->db->where('companyId', $this->sessiondata['companyid']);
        $query = $this->db->get();
        return $query->result();
    }

    function sortalldata() {
        $query = $this->db->query('SELECT * FROM `accountgroup` ORDER BY `accountgroup`.`accountGroupName` ASC');
        return $query->result();
    }

    function addAccLedger() {
        $data = array(
            'acccountLedgerName' => $this->input->post('acccountLedgerName'),
            'accountGroupId' => $this->input->post('accountGroupId'),
            'openingBalance' => $this->input->post('openingBalance'),
            'debitOrCredit' => $this->input->post('debitOrCredit'),
            'address' => $this->input->post('address'),
            'phoneNo' => $this->input->post('phoneNo'),
            'emailId' => $this->input->post('emailId'),
            'creditPeriod' => $this->input->post('creditPeriod'),
            'mobileNo' => $this->input->post('mobileNo'),
            'fax' => $this->input->post('fax'),
            'tin' => $this->input->post('tin'),
            'cst' => $this->input->post('cst'),
            'billByBill' => $this->input->post('billByBill'),
            'description' => $this->input->post('description'),
            'defaultOrNot' => $this->input->post('defaultOrNot'),
            'companyId' => $this->sessiondata['companyid']
        );
        $insertStatus = $this->db->insert('accountledger', $data);
        return $insertStatus;
    }

    function editAccLedger() {
        $ledgerId = $this->input->post('editledgerId');
        $data = array(
            'acccountLedgerName' => $this->input->post('editacccountLedgerName'),
            'accountGroupId' => $this->input->post('editaccountGroupId'),
            'openingBalance' => $this->input->post('editopeningBalance'),
            'debitOrCredit' => $this->input->post('editdebitOrCredit'),
            'address' => $this->input->post('editaddress'),
            'phoneNo' => $this->input->post('editphoneNo'),
            'emailId' => $this->input->post('editemailId'),
            'creditPeriod' => $this->input->post('editcreditPeriod'),
            'mobileNo' => $this->input->post('editmobileNo'),
            'fax' => $this->input->post('editfax'),
            'tin' => $this->input->post('edittin'),
            'cst' => $this->input->post('editcst'),
            'billByBill' => $this->input->post('editbillByBill'),
            'description' => $this->input->post('editdescription'),
            'defaultOrNot' => $this->input->post('editdefaultOrNot'),
            'companyId' => $this->sessiondata['companyid']
        );
        $this->db->where('ledgerId', $ledgerId);
        $updatestatus = $this->db->update('accountledger', $data);
        return $updatestatus;
    }

    public function deleteFarmer() {
        $ledgerId = $this->input->post('ledgerId');
        $checkfarmer = $this->db->query("select ledgerId from ledgerposting where ledgerId = '$ledgerId'");        
        if ($checkfarmer->num_rows() > 0):
            return 'Notdeleted';
        else:
            $this->db->where('ledgerId', $ledgerId);
            $deletestatus = $this->db->delete('accountledger');
            return 'Deleted';
        endif;
    }

    public function accountNameCheck() {
        $acccountLedgerName = $this->input->post('acccountLedgerName');
        $this->db->select('*');
        $this->db->from('accountledger');
        $this->db->where('companyId', $this->sessiondata['companyid']);
        $this->db->where('acccountLedgerName', $acccountLedgerName);
        $queryresult = $this->db->get();
        if ($queryresult->num_rows() > 0):
            return false;
        else:
            return true;
        endif;
    }

}
