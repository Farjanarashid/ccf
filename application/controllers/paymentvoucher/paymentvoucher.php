<?php

if (!defined('BASEPATH'))
    exit('No direct Script access allowed');

class Paymentvoucher extends CI_Controller {

    private $sessiondata;

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->sessiondata = $this->session->userdata('logindata');
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
        $data['title'] = "Payment Voucher";
        $data['active_menu'] = "transaction";
        $data['active_sub_menu'] = "paymentvoucher";
        $data['countries'] = $this->ccfpaymentvou->countrylist();
        $data['ledger'] = $this->ccfpaymentvou->ledgerdata();
        $data['sortalldata'] = $this->ccfpaymentvou->sortalldata();
        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('paymentvoucher/paymentvoucherfirst', $data);
        $this->load->view('footer', $data);
        $this->load->view('paymentvoucher/script', $data);
    }

    public function addpaymentvoucher() {
        $data['baseurl'] = $this->config->item('base_url');
        $data['title'] = "Payment Voucher";
        $data['active_menu'] = "transaction";
        $data['active_sub_menu'] = "paymentvoucher";
        $data['countries'] = $this->ccfpaymentvou->countrylist();
        $data['ledger'] = $this->ccfpaymentvou->ledgerdata();
        $data['sortalldata'] = $this->ccfpaymentvou->sortalldata();
        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('paymentvoucher/paymentvoucher', $data);
        $this->load->view('footer', $data);
        $this->load->view('paymentvoucher/script', $data);
    }

    public function editpaymentvoucher() {
        $data['baseurl'] = $this->config->item('base_url');
        $data['title'] = "Payment Voucher";
        $data['active_menu'] = "transaction";
        $data['active_sub_menu'] = "paymentvoucher";
        $id = $this->uri->segment(4);
        $data['countries'] = $this->ccfpaymentvou->countrylist();
        $data['ledger'] = $this->ccfpaymentvou->ledgerdata();
        $data['alldata'] = $this->ccfpaymentvou->alldata($id);
        $data['ledgerdata'] = $this->ccfpaymentvou->getledger();
        $data['paidtoname'] = $this->ccfpaymentvou->editpaidtoname($id);
        $temp = $data['paidtoname'];
        foreach ($temp as $value) {
            $data['paymsid'] = $value->paymentMasterId;
            $data['paidid'] = $value->ledgerId;
            $data['amount'] = $value->amount;
            $data['chequeNumber'] = $value->chequeNumber;
            $data['chequeDate'] = $value->chequeDate;
        }
        $data['currentbalance'] = $this->ccfpaymentvou->currentbalance($data['paidid']);
        $data['preferenceType'] = $this->ccfpaymentvou->getpartydata($id, $data['paidid']);
        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('paymentvoucher/editpaymentvoucher', $data);
        $this->load->view('footer', $data);
        $this->load->view('paymentvoucher/script', $data);
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
            echo ' <select class="form-control" id="ledgerId" name="ledgerId" type="text"> ';
            echo '<option>Select Paid To</option>';
            foreach ($paidtoname as $value) {
                $pid = $value->ledgerId;
                $pname = $value->acccountLedgerName;
                echo '<option value="' . $pid . '">' . $pname . '</option>';
            }
            echo '<option value="addpsuplr" class="add">Add new Supplier</option>';
            echo '</select>';
        } else {
            echo ' <select class="form-control add" id="ledgerId" name="ledgerId" type="text"> ';
            echo '<option>Select Paid To</option>';
            foreach ($paidtoname as $value) {
                $pid = $value->ledgerId;
                $pname = $value->acccountLedgerName;
                echo '<option value="' . $pid . '">' . $pname . '</option>';
            }
            echo '<option value="addpsuplr" class="add">Add new Supplier</option>';
            echo '</select>';
        }
    }

    public function addpayment() {
        $ledgerid = $this->input->post('paymentMode');
        $paidtoid = $this->input->post('ledgerId');
        $cmpid = $this->sessiondata['companyid'];
        if ($ledgerid == "2") {
            $data = array(
                'date' => $_POST['date'],
                'ledgerId' => $_POST['paymentMode'],
                'paymentMode' => "By Cash",
                'description' => $_POST['description'],
                'companyId' => $this->sessiondata['companyid']
            );
            $isadded = $this->ccfpaymentvou->addpayment($data);
        } else {
            $data = array(
                'date' => $_POST['date'],
                'ledgerId' => $_POST['paymentMode'],
                'paymentMode' => "By Cheque",
                'description' => $_POST['description'],
                'companyId' => $this->sessiondata['companyid']
            );
            $isadded = $this->ccfpaymentvou->addpayment($data);
        }
        $query1 = $this->db->query("SELECT MAX( paymentMasterId ) FROM paymentmaster where ledgerId=$ledgerid AND companyId=$cmpid");
        $row1 = $query1->row_array();
        $payid = $row1['MAX( paymentMasterId )'];
        $purchaseid = $this->input->post('voucherNumber');
        $isaddpaydet = $this->ccfpaymentvou->adddpaymentetails($payid);
        $isadded3 = $this->ccfpaymentvou->addledgerposting1($payid);
        $isadded4 = $this->ccfpaymentvou->addledgerposting2($payid);
        $isadded5 = $this->ccfpaymentvou->addPartyBalance($payid);
        $isupdated = $this->ccfpaymentvou->updatePurchaseMaster($purchaseid);
        if ($isadded && $isaddpaydet && $isadded3 && $isadded4 && $isadded5) {
            $this->session->set_userdata('success', 'Payment Voucher added successfully');
            redirect('paymentvoucher/paymentvoucher');
        } else {
            $this->session->set_userdata('fail', 'Payment Voucher add failed');
            redirect('paymentvoucher/paymentvoucher');
        }
    }

    public function vouinfo() {
        $puchasedata = $this->ccfpaymentvou->purchaseinfo();
        echo ' <select class="form-control" id="voucherType" name="voucherType" type="text">';
        echo '<option> Select Purchase Invoice </option>';
        foreach ($puchasedata as $value) {
            $puid = $value->purchaseMasterId;
            $purchaseinfo = $this->ccfpaymentvou->invoicedata($puid);
            foreach ($purchaseinfo as $row) {
                $invoid = $row->invoiceStatusId;
                if ($invoid == "2" || "3") {
                    $pid = $row->purchaseMasterId;
                    $partvalue = $this->ccfpaymentvou->partpaid($pid);
                    echo '<option value="' . $pid . '">' . "Purchase Invoice" . " - " . $pid . " ---> " . $partvalue . '</option>';
                }
            }
        }
        echo '</select>';
    }

    public function editvouinfo() {
        $paymsid = $this->input->post('paymentmasid');       
        $id = $this->input->post('id');
        $temp = $this->ccfpaymentvou->getallpartybalance($paymsid, $id);
        $puchasedata = $this->ccfpaymentvou->editpurchaseinfo($id);
        echo ' <select class="form-control" id="voucherType" name="voucherType" type="text" disabled>';
        foreach ($puchasedata as $value) {
            $pid = $value->purchaseMasterId;
            $invoid = $value->invoiceStatusId;
            if ($invoid == "2" || "3") {
                $partvalue = $this->ccfpaymentvou->editpartpaid($pid, $id);
                if ($pid == $temp) {
                    echo '<option value="' . $pid . '">' . "Purchase Invoice" . " - " . $pid . " ---> " . $partvalue . '</option>';
                }
            }
        }
        echo '</select>';
    }

    public function updatepayment() {
        $isupdated1 = $this->ccfpaymentvou->updatepaymentdetails();
        $isupdated2 = $this->ccfpaymentvou->updateledgerposting1();
        $isupdated3 = $this->ccfpaymentvou->updateledgerposting2();
        $isupdated4 = $this->ccfpaymentvou->updatepartybalance();
        if ($isupdated1 && $isupdated2 && $isupdated3 && $isupdated4) {
            $this->session->set_userdata('success', 'Payment Voucher Updated successfully');
            redirect('paymentvoucher/paymentvoucher');
        } else {
            $this->session->set_userdata('fail', 'Payment Voucher Update failed');
            redirect('paymentvoucher/paymentvoucher');
        }
    }

    public function invoicedata() {
        $pid = $this->input->post('purid');
        $purchasedata = $this->ccfpaymentvou->invoicedata($pid);
        foreach ($purchasedata as $value) {
            $invoid = $value->invoiceStatusId;
            if ($invoid == "3") {
                $amountvalue = number_format($value->amount, 2);
                $purchaseid = $value->purchaseMasterId;
                echo json_encode(array(
                    'purchaseid' => $purchaseid,
                    'amountvalue' => $amountvalue
                ));
            }
            if ($invoid == "2") {
                $pid = $this->input->post('purid');
                $partvalue = $this->ccfpaymentvou->partpaid($pid);
                echo json_encode(array(
                    'purchaseid' => $pid,
                    'amountvalue' => $partvalue
                ));
            }
        }
    }

    public function deletepaymentvou() {
        $id = $this->input->post('paymentMasterId');
        $ledgerId = $this->input->post('ledgerId');
        $isdeleted = $this->ccfpaymentvou->deletepaymentmaster($id);
        $isdeleteddetails = $this->ccfpaymentvou->deletepaymentdetails($id);
        $isdeleteparty = $this->ccfpaymentvou->deletepartybalance($id, $ledgerId);
        $isdeletedledgerposting = $this->ccfpaymentvou->deleteladgerposting($id);

        if ($isdeleted && $isdeleteparty) {
            $this->session->set_userdata('success', 'Payment Voucher Deleted successfully');
            redirect('paymentvoucher/paymentvoucher');
        } else {
            $this->session->set_userdata('fail', 'Payment Voucher Delete failed');
            redirect('paymentvoucher/paymentvoucher');
        }
    }

    public function currentbalance() {
        $paidid = $this->input->post('ledgerid');
        $currentbalance = $this->ccfpaymentvou->currentbalance($paidid);
        echo $currentbalance;
    }

}
