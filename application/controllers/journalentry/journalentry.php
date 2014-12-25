<?php

class Journalentry extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->sessiondata = $this->session->userdata('logindata');
        $this->load->model('ccfjournalentry');
        if ($this->sessiondata['status'] == 'login'):
            $accessFlag = 1;
        else:
            $accessFlag = 0;
            redirect('home');
        endif;
    }

    public function index() {
        $data['baseurl'] = $this->config->item('base_url');
        $data['title'] = "Journal Entry";
        $data['active_menu'] = "transaction";
        $data['active_sub_menu'] = "journalentry";
        $data['ledger'] = $this->ccfjournalentry->ledgerdata();
        $data['sortalldata'] = $this->ccfjournalentry->sortalldata();
        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('journalentry/journalentry', $data);
        $this->load->view('footer', $data);
        $this->load->view('journalentry/script', $data);
    }

    public function ledgerdata() {
        $c = $this->input->post('c');
        $ledger = $this->ccfjournalentry->ledgerdata();
        echo '<input type="hidden" id="count" name="count" value="' . $c . '" />';
        echo '<select class = " form-control" id = "new_ledgerId' . $c . '" name = "new_ledgerId[]">';
        echo '<option value = "">Select</option>';
        foreach ($ledger as $value) {
            echo "<option value='" . $value->ledgerId . "'>$value->acccountLedgerName</option>";
        }
        echo '</select>';
    }

    public function addjournal() {
        #print_r($_POST['credit']);exit();
        #echo count($_POST['credit']);exit();
        $cmpid = $this->sessiondata['companyid'];
        $isadded1 = $this->ccfjournalentry->addjournal();
        $query1 = $this->db->query("SELECT MAX( journalMasterId ) FROM journalmaster where companyId=$cmpid");
        $row1 = $query1->row_array();
        $journalMasterId = $row1['MAX( journalMasterId )'];  
        $isadded4 = $this->ccfjournalentry->addjournaldetails3($journalMasterId, $count);
        if ($isadded4) {
            $this->session->set_userdata('success', 'Journal entry added successfully');
            redirect('journalentry/journalentry');
        } else {
            $this->session->set_userdata('fail', 'Journal entry add failed');
            redirect('journalentry/journalentry');
        }
    }

    public function deletejournalentry() {
        $isdeleted1 = $this->ccfjournalentry->deletejournalMaster();
        $isdeleted2 = $this->ccfjournalentry->deletejournalDetails();
        $isdeleted3 = $this->ccfjournalentry->deletejournalLedger();
        if ($isdeleted1 && $isdeleted2 && $isdeleted3) {
            $this->session->set_userdata('success', 'Journal entry deleted successfully');
            redirect('journalentry/journalentry');
        } else {
            $this->session->set_userdata('fail', 'Journal entry delete failed');
            redirect('journalentry/journalentry');
        }
    }

}
