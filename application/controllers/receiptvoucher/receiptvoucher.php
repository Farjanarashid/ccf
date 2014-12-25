<?php

if (!defined('BASEPATH'))
    exit('No direct Script access allowed');

class Receiptvoucher extends CI_Controller {

    private $sessiondata;

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->sessiondata = $this->session->userdata('logindata');
        $this->load->model('ccfreceiptvou');
        $this->load->model('ccfpaymentvou');
        if ($this->sessiondata['status'] == 'login'):
            $accessFlag = 1;
        else:
            $accessFlag = 0;
            redirect('home');
        endif;
    }

    public function index() {
        $data['baseurl'] = $this->config->item('base_url');
        $data['title'] = "Receipt Voucher";
        $data['active_menu'] = "transaction";
        $data['active_sub_menu'] = "receiptvoucher";
        $data['countries'] = $this->ccfreceiptvou->countrylist();
        $data['ledger'] = $this->ccfreceiptvou->ledgerdata();
        $data['sortalldata'] = $this->ccfreceiptvou->sortalldata();
        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('receiptvoucher/receiptvoucherfirst', $data);
        $this->load->view('footer', $data);
        $this->load->view('receiptvoucher/script', $data);
    }

    public function addreceiptvoucher() {
        $data['baseurl'] = $this->config->item('base_url');
        $data['title'] = "Receipt Voucher";
        $data['active_menu'] = "transaction";
        $data['active_sub_menu'] = "receiptvoucher";
        $data['countries'] = $this->ccfreceiptvou->countrylist();
        $data['ledger'] = $this->ccfreceiptvou->ledgerdata();
        $data['sortalldata'] = $this->ccfreceiptvou->sortalldata();
        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('receiptvoucher/receiptvoucher', $data);
        $this->load->view('footer', $data);
        $this->load->view('receiptvoucher/script', $data);
    }

    public function editreceiptvoucher() {
        $data['baseurl'] = $this->config->item('base_url');
        $data['title'] = "Receipt Voucher";
        $data['active_menu'] = "transaction";
        $data['active_sub_menu'] = "receiptvoucher";
        $id = $this->uri->segment(4);
        $data['countries'] = $this->ccfreceiptvou->countrylist();
        $data['ledger'] = $this->ccfreceiptvou->ledgerdata();
        $data['alldata'] = $this->ccfreceiptvou->alldata($id);
        $data['ledgerdata'] = $this->ccfreceiptvou->getledger();
        $data['paidtoname'] = $this->ccfreceiptvou->editpaidtoname($id);
        $temp = $data['paidtoname'];
        foreach ($temp as $value) {
            $data['paymsid'] = $value->receiptMasterId;
            $data['paidid'] = $value->ledgerId;
            $data['amount'] = $value->amount;
            $data['chequeNumber'] = $value->chequeNumber;
            $data['chequeDate'] = $value->chequeDate;
        }
        $data['currentbalance'] = $this->ccfreceiptvou->currentbalance($data['paidid']);
        $data['preferenceType'] = $this->ccfreceiptvou->getpartydata($id, $data['paidid']);
        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('receiptvoucher/editreceiptvoucher', $data);
        $this->load->view('footer', $data);
        $this->load->view('receiptvoucher/script', $data);
    }

    public function getledger() {
        $value = $this->input->post('value');
        if ($value == "ByCheque") {
            $data = $this->ccfpaymentvou->getledger();
            echo ' <select class="form-control" id="paymentMode" name="paymentMode" type="text" onclick="return setpaidto()"> ';
            foreach ($data as $row) {
                $id = $row->ledgerId;
                $name = $row->acccountLedgerName;
                echo '<option value="' . $id . '">' . $name . '</option>';
            }
            echo '<option value="addsuplr">Add new Supplier</option>';
            echo '</select>';
        } else {
            echo ' <select class="form-control" id="paymentMode" name="paymentMode" type="text" onclick="return setpaidto()"> ';
            echo '<option value="2">Cash Account</option>';
            echo '<option value="addsuplr" >Add new Supplier</option>';
            echo '</select>';
        }
    }

    public function paidtoname() {
        $ledgerid = $this->input->post('ledgerid');
        $paidtoname = $this->ccfpaymentvou->paidtoname();
        if ($ledgerid == "2") {
            echo ' <select class="form-control" id="ledgerId" name="ledgerId" type="text">';
            echo '<option>Select Received From</option>';
            foreach ($paidtoname as $value) {
                $pid = $value->ledgerId;
                $pname = $value->acccountLedgerName;
                echo '<option value="' . $pid . '">' . $pname . '</option>';
            }
            echo '<option value="addpsuplr" class="add">Add new Supplier</option>';
            echo '</select>';
        } else {
            echo ' <select class="form-control add" id="ledgerId" name="ledgerId" type="text"> ';
            echo '<option>Select Received From</option>';
            foreach ($paidtoname as $value) {
                $pid = $value->ledgerId;
                $pname = $value->acccountLedgerName;
                echo '<option value="' . $pid . '">' . $pname . '</option>';
            }
            echo '<option value="addpsuplr" class="add">Add new Supplier</option>';
            echo '</select>';
        }
    }

    public function addreceiptmaster() {
        $ledgerid = $this->input->post('paymentMode');
        print_r($ledgerid);
        $paidtoid = $this->input->post('ledgerId');
        $cmpid = $this->sessiondata['companyid'];
        if ($ledgerid == "2") {
            $data = array(
                'date' => $_POST['date'],
                'ledgerId' => $_POST['paymentMode'],
                'receiptMode' => "By Cash",
                'description' => $_POST['description'],
                'companyId' => $this->sessiondata['companyid']
            );
            $isadded = $this->ccfreceiptvou->addreceipt($data);
        } else {
            $data = array(
                'date' => $_POST['date'],
                'ledgerId' => $_POST['paymentMode'],
                'receiptMode' => "By Cheque",
                'description' => $_POST['description'],
                'companyId' => $this->sessiondata['companyid']
            );
            $isadded = $this->ccfreceiptvou->addreceipt($data);
        }
        $query1 = $this->db->query("SELECT MAX( receiptMasterId ) FROM receiptmaster where ledgerId=$ledgerid AND companyId=$cmpid");
        $row1 = $query1->row_array();
        $payid = $row1['MAX( receiptMasterId )'];
        $SalesMasterid = $this->input->post('voucherNumber');
        $isaddpaydet = $this->ccfreceiptvou->adddreceiptetails($payid);
        $isadded3 = $this->ccfreceiptvou->addledgerposting1($payid);
        $isadded4 = $this->ccfreceiptvou->addledgerposting2($payid);
        $isadded5 = $this->ccfreceiptvou->addPartyBalance($payid);
        $isupdated = $this->ccfreceiptvou->updateSalesMaster($SalesMasterid);
        if ($isadded && $isaddpaydet && $isadded3 && $isadded4 && $isadded5) {
            $this->session->set_userdata('success', 'Receipt Voucher added successfully');
            redirect('receiptvoucher/receiptvoucher');
        } else {
            $this->session->set_userdata('fail', 'Receipt Voucher add failed');
            redirect('receiptvoucher/receiptvoucher');
        }
    }

    public function vouinfo() {
        $salesdata = $this->ccfreceiptvou->salesinfo();       
        echo ' <select class="form-control" id="voucherType" name="voucherType" type="text">';
        echo '<option> Select Purchase Invoice </option>';
        foreach ($salesdata as $value) {
            $invoid = $value->status;
            if ($invoid == "2" || "3") {
                $pid = $value->salesMasterId;
                $partvalue = $this->ccfreceiptvou->partpaid($pid);
                echo '<option value="' . $pid . '">' . "Sales Invoice" . " - " . $pid . " ---> " . $partvalue . '</option>';
            }
        }
        echo '</select>';
    }

    public function editvouinfo() {
        $receiptMasterId = $this->input->post('receiptMasterId');
        $id = $this->input->post('id');
        $temp = $this->ccfreceiptvou->getallpartybalance($receiptMasterId,$id);       
        $salesdata = $this->ccfreceiptvou->editsalesinfo($id);       
        echo ' <select class="form-control" id="voucherType" name="voucherType" type="text" disabled>';
        foreach ($salesdata as $value) {
            $pid = $value->salesMasterId;
            $invoid = $value->status;
            if ($invoid == "2" || "3") {
                $partvalue = $this->ccfreceiptvou->editpartpaid($pid, $id);
                if ($pid == $temp) {
                    echo '<option value="' . $pid . '">' . "Sales Invoice" . " - " . $pid . " ---> " . $partvalue . '</option>';
                }                
            }
        }
        echo '</select>';
    }

    public function updatereceiptvoucher() {
        $isupdated1 = $this->ccfreceiptvou->updatepaymentdetails();
        $isupdated2 = $this->ccfreceiptvou->updateledgerposting1();
        $isupdated3 = $this->ccfreceiptvou->updateledgerposting2();
        $isupdated4 = $this->ccfreceiptvou->updatepartybalance();
        if ($isupdated1 && $isupdated2 && $isupdated3 && $isupdated4) {
            $this->session->set_userdata('success', 'Receipt Voucher Updated successfully');
            redirect('receiptvoucher/receiptvoucher');
        } else {
            $this->session->set_userdata('fail', 'Receipt Voucher Update failed');
            redirect('receiptvoucher/receiptvoucher');
        }
    }

    public function invoicedata() {
        $pid = $this->input->post('purid');
        $salesdata = $this->ccfreceiptvou->invoicedata($pid);
        foreach ($salesdata as $value) {
            $invoid = $value->status;
            if ($invoid == "3") {
                $amountvalue = number_format($value->amount, 2);
                $salesMasterId = $value->salesMasterId;
                echo json_encode(array(
                    'salesMasterId' => $salesMasterId,
                    'amountvalue' => $amountvalue
                ));
            }
            if ($invoid == "2") {
                $pid = $this->input->post('purid');
                $partvalue = $this->ccfreceiptvou->partpaid($pid);
                echo json_encode(array(
                    'salesMasterId' => $pid,
                    'amountvalue' => $partvalue
                ));
            }
        }
    }

    public function deletereceiptvou() {
        $id = $this->input->post('receiptMasterId');
        $ledgerId = $this->input->post('ledgerId');
        $isdeleted = $this->ccfreceiptvou->deletereceiptmaster($id);
        $isdeleteddetails = $this->ccfreceiptvou->deletereceiptdetails($id);
        $isdeleteparty = $this->ccfreceiptvou->deletepartybalance($id, $ledgerId);
        $isdeletedledgerposting = $this->ccfreceiptvou->deleteladgerposting($id);
        
        if ($isdeleted && $isdeleteparty && $isdeleteddetails && $isdeletedledgerposting) {
            $this->session->set_userdata('success', 'Receipt Voucher Deleted successfully');
            redirect('receiptvoucher/receiptvoucher');
        } else {
            $this->session->set_userdata('fail', 'Receipt Voucher Delete failed');
            redirect('receiptvoucher/receiptvoucher');
        }
    }

    public function currentbalance() {
        $paidid = $this->input->post('ledgerid');
        $currentbalance = $this->ccfreceiptvou->currentbalance($paidid);
        echo $currentbalance;
    }

}
