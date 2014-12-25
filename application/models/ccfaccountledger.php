<?php

class Ccfaccountledger extends CI_Model {

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
        $this->db->where('companyId', $this->sessiondata['companyid']);
        $query = $this->db->get();
        return $query->result();
    }

    function sortalldata() {
        $cmpid = $this->sessiondata['companyid'];
        $query = $this->db->query("SELECT * FROM accountgroup where companyId = '$cmpid' ORDER BY accountGroupName ASC");
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
        $insertstatus = $this->db->insert('accountledger', $data);
        return $insertstatus;
    }

    function addvendor2($ledgerId) {
        $data2 = array(
            'vendorName' => $this->input->post('acccountLedgerName'),
            'ledgerId' => $ledgerId,
            'companyId' => $this->sessiondata['companyid']
        );
        $saveresult = $this->db->insert('vendor', $data2);
        return $saveresult;
    }

    function AccLedgerEdit() {
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

    public function editAccLedgerDefault() {
        $ledgerId = $this->input->post('editledgerId');
        $data = array(
            'openingBalance' => $this->input->post('editopeningBalanceofdefault')
        );
        $this->db->where('ledgerId', $ledgerId);
        $updatestatus = $this->db->update('accountledger', $data);
        return $updatestatus;
    }

    public function AccLedgerdelete() {
        $ledgerId = $this->input->post('ledgerId');        
        $checkinused = $this->db->query("select ledgerId from ledgerposting where ledgerId = '$ledgerId'");
        if ($checkinused->num_rows() > 0):
            return 'notdeleted';
        else:
            $this->db->where('ledgerId', $ledgerId);
            $deletestatus = $this->db->delete('accountledger');
            return 'deleted';
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
