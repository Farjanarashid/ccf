<?php

class Ccfjournalentry extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->sessiondata = $this->session->userdata('logindata');
    }

    public function ledgerdata() {
        $this->db->select('*');
        $this->db->from('accountledger');
        $this->db->where('companyId', $this->sessiondata['companyid']);
        $query = $this->db->get();
        return $query->result();
    }

    public function sortalldata() {
        $this->db->select('*');
        $this->db->order_by("journalMasterId", "desc");
        $this->db->from('journalmaster');
        $this->db->where('companyId', $this->sessiondata['companyid']);
        $query = $this->db->get();
        return $query->result();
    }

    public function addjournal() {
        $data = array(
            'date' => $this->input->post('date'),
            'description' => $this->input->post('description'),
            'companyId' => $this->sessiondata['companyid']
        );
        $query = $this->db->insert('journalmaster', $data);
        return $query;
    }

    public function addjournaldetails1($journalMasterId) {
        $data = array(
            'journalMasterId' => $journalMasterId,
            'ledgerId' => $this->input->post('first_ledgerId'),
            'debit' => $this->input->post('first_debit'),
            'credit' => $this->input->post('first_credit'),
            'description' => $this->input->post('description'),
            'companyId' => $this->sessiondata['companyid']
        );

//        $data2 = array(
//            'journalMasterId' => $journalMasterId,
//            'ledgerId' => $this->input->post('second_ledgerId'),
//            'debit' => $this->input->post('second_debit'),
//            'credit' => $this->input->post('second_credit'),
//            'description' => $this->input->post('description'),
//            'companyId' => $this->sessiondata['companyid']
//        );
        $query = $this->db->insert('journaldetails', $data);
        #$query2 = $this->db->insert('journaldetails', $data2);
        return $query;
    }

    public function addjournaldetails2($journalMasterId) {
        $data = array(
            'journalMasterId' => $journalMasterId,
            'ledgerId' => $this->input->post('second_ledgerId'),
            'debit' => $this->input->post('second_debit'),
            'credit' => $this->input->post('second_credit'),
            'description' => $this->input->post('description'),
            'companyId' => $this->sessiondata['companyid']
        );
        $query = $this->db->insert('journaldetails', $data);
        return $query;
    }

    public function addjournaldetails3($journalMasterId) {
        $ledgerids = array();
        $newcredit = array();
        $newdebit = array();
        $ledgerId = $_POST['new_ledgerId'];
        $newcredit = $_POST['credit'];
        $newdebit = $_POST['debit'];
        $sizeofpostdata = count($ledgerId);
        for ($i = 0; $i < count($ledgerId); $i++) {
            $dataarrayforjurnal = array(
                'journalMasterId' => $journalMasterId,
                'ledgerId' => $ledgerId[$i],
                'debit' => $newdebit[$i],
                'credit' => $newcredit[$i],
                'description' => $this->input->post('description'),
                'companyId' => $this->sessiondata['companyid']
            );
            $saveresultjdetails = $this->db->insert('journaldetails', $dataarrayforjurnal);
            $dataarrayforledger = array(
                'voucherNumber' => $journalMasterId,
                'ledgerId' => $ledgerId[$i],
                'voucherType' => "Journal entry",
                'debit' => $newdebit[$i],
                'credit' => $newcredit[$i],
                'description' => "From journal",
                'companyId' => $this->sessiondata['companyid']
            );
            $saveresultlposting = $this->db->insert('ledgerposting', $dataarrayforledger);
        }
        if ($saveresultjdetails && $saveresultlposting):
            return true;
        else:
            return false;
        endif;
    }

    public function deletejournalMaster() {
        $journalMasterId = $this->input->post('journalMasterId');
        $companyId = $this->sessiondata['companyid'];
        $query = $this->db->query("Delete from journalmaster where journalMasterId='$journalMasterId' AND companyId='$companyId'");
        return $query;
    }

    public function deletejournalDetails() {
        $journalMasterId = $this->input->post('journalMasterId');
        $companyId = $this->sessiondata['companyid'];
        $query = $this->db->query("Delete from journaldetails where journalMasterId='$journalMasterId' AND companyId='$companyId'");
        return $query;
    }

    public function deletejournalLedger() {
        $journalMasterId = $this->input->post('journalMasterId');
        $companyId = $this->sessiondata['companyid'];
        $query = $this->db->query("Delete from ledgerposting where companyId='$companyId' AND (voucherNumber='$journalMasterId' AND voucherType='Journal entry')");
        return $query;
    }

}
