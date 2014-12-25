<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    private $sessiondata;

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->sessiondata = $this->session->userdata('logindata');
    }

    public function index() {
        $data['baseurl'] = $this->config->item('base_url');
        $getcompanylist = $this->load->model('company_y');
        $data['companylist'] = $this->company_y->getcomapnylist();
        if ($this->sessiondata['username'] != NULL && $this->sessiondata['status'] == 'login'):
            $data['title'] = "Dashboard";
            $this->load->view('header', $data);
            $this->load->view('sidebar', $data);
            $this->load->view('dashboard/dashboard', $data);
            $this->load->view('footer', $data);
        else:
            $data['title'] = "Login | Confidence chicks and feeds";
            $this->load->view('masterlogin', $data);
        endif;
    }

    public function getcompanyyear() {
        $getcompanylist = $this->load->model('company_y');
        $id = $this->input->post('cid');
        $financialyear = $this->company_y->getfinancialyear($id);
        echo '<select class="form-control m-bot15" style="padding: 5px" name="fyearstatus">';
        if (sizeof($financialyear) > 0):
            foreach ($financialyear as $year):
                if ($year->activeOrNot == '1'):
                    $selected = ' selected';
                else:
                    $selected = "";
                endif;
                $startdate = new DateTime($year->fromDate);
                $sdate = $startdate->format("Y-m-d");
                $enddate = new DateTime($year->toDate);
                $edate = $enddate->format("Y-m-d");
                echo '<option' . $selected . ' value="' . $sdate . ':' . $edate . ',' . $year->activeOrNot . '">' . $sdate . ' &nbsp; To&nbsp;  ' . $edate . '</option>';
            endforeach;
        endif;
        echo '</select>';
    }

    public function accountGroup() {
        if ($this->sessiondata['username'] != NULL && $this->sessiondata['status'] == 'login' && $this->sessiondata['role'] == 'admin'):
            $data['baseurl'] = $this->config->item('base_url');
            $data['title'] = "Account Group";
            $data['active_menu'] = "master";
            $data['active_sub_menu'] = "accountGroup";
            $this->load->model('ccfmodel');
            $data['sortalldata'] = $this->ccfmodel->sortalldata();
            $data['alldata'] = $this->ccfmodel->showalldata();
            $this->load->view('accountGroup', $data);
        else:
            redirect('home');
        endif;
    }

    public function sales() {
        $data['title'] = "Sales";
        $data['active_menu'] = "transaction";
        $data['active_sub_menu'] = "sales";
        $data['baseurl'] = $this->config->item('base_url');
        $this->load->view('sales', $data);
    }

    public function cash_book() {
        $data['title'] = "Cash Book";
        $data['active_menu'] = "account_statement";
        $data['active_sub_menu'] = "cash_book";
        $data['baseurl'] = $this->config->item('base_url');
        $company_data = $this->session->userdata('logindata');
        $company_id = $company_data['companyid'];
        $date_from = $this->input->post('date_from');
        $date_to = $this->input->post('date_to');
        if (($date_from == "") && ($date_to == "")) {
            $today_date = date('Y-m-d');
            $strtotime_today = strtotime($today_date);
            $previous_dateadd = strtotime("-1 day", $strtotime_today);
            $previous_date = date('Y-m-d', $previous_dateadd);
            $date_from = $previous_date;
            $date_to = $today_date;
        }
        $date_from = substr($date_from, 0, 10);
        $date_to = substr($date_to, 0, 10);
        //$date_from = "2014-11-01 ";
        //$date_to = "2014-12-17";
        $leaserQuery = $this->db->query("SELECT SUM(lp.debit) as debitsum, SUM(lp.credit) as creditsum, al.acccountLedgerName, ag.accountGroupName FROM ledgerposting lp JOIN accountledger al ON lp.ledgerId = al.ledgerId JOIN accountgroup ag ON ag.accountGroupId = al.accountGroupId WHERE (lp.date BETWEEN '$date_from%' AND '$date_to%') AND lp.companyId = '$company_id' AND ag.accountGroupId = '11' GROUP BY lp.ledgerId");
        $groupQuery = $this->db->query("SELECT SUM(lp.debit) as debitsum, SUM(lp.credit) as creditsum, ag.accountGroupName FROM ledgerposting lp JOIN accountledger al ON lp.ledgerId = al.ledgerId JOIN accountgroup ag ON ag.accountGroupId = al.accountGroupId WHERE (lp.date BETWEEN '$date_from%' AND '$date_to%') AND lp.companyId = '$company_id' AND ag.accountGroupId = '11'");
        $data['ledgerwisedata'] = $leaserQuery->result();
        $data['groupwisedata'] = $groupQuery->result();
        $data['date_from'] = $date_from;
        $data['date_to'] = $date_to;
        $this->load->view('cash_book', $data);
    }

    public function day_book() {
        $data['title'] = "Day Book";
        $data['active_menu'] = "account_statement";
        $data['active_sub_menu'] = "day_book";
        $data['baseurl'] = $this->config->item('base_url');
        $this->load->view('day_book', $data);
    }

    public function bank_book() {
        $data['title'] = "Bank Book";
        $data['active_menu'] = "account_statement";
        $data['active_sub_menu'] = "bank_book";
        $data['baseurl'] = $this->config->item('base_url');
        $company_data = $this->session->userdata('logindata');
        $company_id = $company_data['companyid'];
        $date_from = $this->input->post('date_from');
        $date_to = $this->input->post('date_to');
        if (($date_from == "") && ($date_to == "")) {
            $today_date = date('Y-m-d');
            $strtotime_today = strtotime($today_date);
            $previous_dateadd = strtotime("-1 day", $strtotime_today);
            $previous_date = date('Y-m-d', $previous_dateadd);
            $date_from = $previous_date;
            $date_to = $today_date;
        }
        $date_from = substr($date_from, 0, 10);
        $date_to = substr($date_to, 0, 10);
        //$date_from = "2014-11-01 ";
        //$date_to = "2014-12-17";
        $leaserQuery = $this->db->query("SELECT SUM(lp.debit) as debitsum, SUM(lp.credit) as creditsum, al.acccountLedgerName, ag.accountGroupName FROM ledgerposting lp JOIN accountledger al ON lp.ledgerId = al.ledgerId JOIN accountgroup ag ON ag.accountGroupId = al.accountGroupId WHERE (lp.date BETWEEN '$date_from%' AND '$date_to%') AND lp.companyId = '$company_id' AND ag.accountGroupId = '9' GROUP BY lp.ledgerId");
        $groupQuery = $this->db->query("SELECT SUM(lp.debit) as debitsum, SUM(lp.credit) as creditsum, ag.accountGroupName FROM ledgerposting lp JOIN accountledger al ON lp.ledgerId = al.ledgerId JOIN accountgroup ag ON ag.accountGroupId = al.accountGroupId WHERE (lp.date BETWEEN '$date_from%' AND '$date_to%') AND lp.companyId = '$company_id' AND ag.accountGroupId = '9'");
        $data['ledgerwisedata'] = $leaserQuery->result();
        $data['groupwisedata'] = $groupQuery->result();
        $data['date_from'] = $date_from;
        $data['date_to'] = $date_to;
        $this->load->view('bank_book', $data);
    }

    public function trail_balance() {
        $data['title'] = "Trial Balance";
        $data['active_menu'] = "account_statement";
        $data['active_sub_menu'] = "trail_balance";
        $data['baseurl'] = $this->config->item('base_url');
        $company_data = $this->session->userdata('logindata');
        $company_id = $company_data['companyid'];
        $date_from = $this->input->post('date_from');
        $date_to = $this->input->post('date_to');
        if (($date_from == "") && ($date_to == "")) {
            $today_date = date('Y-m-d');
            $strtotime_today = strtotime($today_date);
            $previous_dateadd = strtotime("-1 day", $strtotime_today);
            $previous_date = date('Y-m-d', $previous_dateadd);
            $date_from = $previous_date;
            $date_to = $today_date;
        }
        $date_from = substr($date_from, 0, 10);
        $date_to = substr($date_to, 0, 10);
        //$date_from = "2014-11-01 ";
        //$date_to = "2014-12-17";
        $leaserQuery = $this->db->query("SELECT SUM(lp.debit) as debitsum, SUM(lp.credit) as creditsum, al.acccountLedgerName, ag.accountGroupName FROM ledgerposting lp JOIN accountledger al ON lp.ledgerId = al.ledgerId JOIN accountgroup ag ON ag.accountGroupId = al.accountGroupId WHERE (lp.date BETWEEN '$date_from%' AND '$date_to%') AND lp.companyId = '$company_id' GROUP BY al.accountGroupId, lp.ledgerId");
        $groupQuery = $this->db->query("SELECT SUM(lp.debit) as debitsum, SUM(lp.credit) as creditsum, ag.accountGroupName FROM ledgerposting lp JOIN accountledger al ON lp.ledgerId = al.ledgerId JOIN accountgroup ag ON ag.accountGroupId = al.accountGroupId WHERE (lp.date BETWEEN '$date_from%' AND '$date_to%') AND lp.companyId = '$company_id' GROUP BY al.accountGroupId");
        $data['ledgerwisedata'] = $leaserQuery->result();
        $data['groupwisedata'] = $groupQuery->result();
        $data['date_from'] = $date_from;
        $data['date_to'] = $date_to;
        $this->load->view('trail_balance', $data);
    }

    public function ladger_balance() {
        $data['title'] = "Ledger Balance";
        $data['active_menu'] = "account_statement";
        $data['active_sub_menu'] = "ladger_balance";
        $data['baseurl'] = $this->config->item('base_url');
        $company_data = $this->session->userdata('logindata');
        $company_id = $company_data['companyid'];
        $acledgernameQr = $this->db->query("SELECT ledgerId, acccountLedgerName FROM accountledger WHERE companyId = '$company_id'");
        $data['acledgerdata'] = $acledgernameQr->result();
        $date_from = $this->input->post('date_from');
        $date_to = $this->input->post('date_to');
        $acledgerid = $this->input->post('acledgername');
        if (($date_from == "") && ($date_to == "")) {
            $today_date = date('Y-m-d');
            $strtotime_today = strtotime($today_date);
            $previous_dateadd = strtotime("-1 day", $strtotime_today);
            $previous_date = date('Y-m-d', $previous_dateadd);
            $date_from = $previous_date;
            $date_to = $today_date;
        }
        $date_from = substr($date_from, 0, 10);
        $date_to = substr($date_to, 0, 10);
        //$date_from = "2014-11-01 ";
        //$date_to = "2014-12-17";
        $ledgerbalanceQr = $this->db->query("SELECT * FROM ledgerposting WHERE ledgerId = '$acledgerid' AND companyId = '$company_id' AND (date BETWEEN '$date_from%' AND '$date_to%')");
        $data['ledgerbalancedata'] = $ledgerbalanceQr->result();
        $data['date_from'] = $date_from;
        $data['date_to'] = $date_to;
        $this->load->view('ladger_balance', $data);
    }

    public function profit_loss() {
        $data['title'] = "Profit And Loss Analysis";
        $data['active_menu'] = "account_statement";
        $data['active_sub_menu'] = "profit_loss";
        $data['baseurl'] = $this->config->item('base_url');
        $date_from = $this->input->post('date_from');
        $date_to = $this->input->post('date_to');
        if (($date_from == "") && ($date_to == "")) {
            $today_date = date('Y-m-d');
            $strtotime_today = strtotime($today_date);
            $previous_dateadd = strtotime("-1 day", $strtotime_today);
            $previous_date = date('Y-m-d', $previous_dateadd);
            $date_from = $previous_date;
            $date_to = $today_date;
        }
        $date_from = substr($date_from, 0, 10);
        $date_to = substr($date_to, 0, 10);
        $date_from = "2014-12-01 ";
        $date_to = "2014-12-17";

        //Opening stock calculation
        $openingstockQr = $this->db->query("SELECT (SUM(S1.inwardQuantity) - SUM(S1.outwardQuantity))* B1.purchaseRate AS OpeningStock FROM productbatch B1 INNER JOIN product ON B1.productId = product.productId LEFT OUTER JOIN stockposting S1 ON B1.productBatchId = S1.productBatchId AND S1.date < '$date_from' GROUP BY B1.purchaseRate");
        $openingstockResult = $openingstockQr->result();
        $openingstockvalue = 0;
        if (sizeof($openingstockResult) > 0):
            foreach ($openingstockResult as $openingdata):
                $openingstockvalue += $openingdata->OpeningStock;
            endforeach;
        endif;
        $data['openingstockvalue'] = $openingstockvalue;

        //Closing stock calculation
        $closingstockQr = $this->db->query("SELECT (SUM(S.inwardQuantity) - SUM(S.outwardQuantity))* B.purchaseRate AS ClosingStock FROM product AS P INNER JOIN productbatch AS B ON P.productId = B.productId INNER JOIN productgroup AS G ON P.productGroupId = G.productGroupId LEFT OUTER JOIN stockposting AS S ON B.productBatchId = S.productBatchId AND (S.date BETWEEN '$date_from%' AND  '$date_to%') AND S.voucherType ='Purchase Invoice' GROUP BY B.productId, P.productName,B.purchaseRate");
        $closingstockResult = $closingstockQr->result();
        $closingstockvalue = 0;
        if (sizeof($closingstockResult) > 0):
            foreach ($closingstockResult as $closingdata):
                $closingstockvalue += $closingdata->ClosingStock;
            endforeach;
        endif;
        $data['closingstockvalue'] = $closingstockvalue;
        
        
        $data['date_from'] = $date_from;
        $data['date_to'] = $date_to;
        $this->load->view('profit_loss', $data);
    }

    public function balance_sheet() {
        $data['title'] = "Balance Sheet";
        $data['active_menu'] = "account_statement";
        $data['active_sub_menu'] = "balance_sheet";
        $data['baseurl'] = $this->config->item('base_url');
        if ($this->sessiondata['username'] != NULL && $this->sessiondata['status'] == 'login' && $this->sessiondata['role'] == 'admin'):

            $date_from = $this->input->post('date_from');
            $date_to = $this->input->post('date_to');
            if (($date_from == "") && ($date_to == "")) {
                $today_date = date('Y-m-d');
                $strtotime_today = strtotime($today_date);
                $previous_dateadd = strtotime("-1 day", $strtotime_today);
                $previous_date = date('Y-m-d', $previous_dateadd);
                $date_from = $previous_date;
                $date_to = $today_date;
            }
            $date_from = substr($date_from, 0, 10);
            $date_to = substr($date_to, 0, 10);
            $data['date_from'] = $date_from;
            $data['date_to'] = $date_to;
            //for liability
            $queryliability= $this->db->query("SELECT   A.accountGroupId AS ID, A.accountGroupName AS name,SUM(C.debit)-SUM(C.credit) AS totalpurchase FROM  accountledger AS B INNER JOIN accountgroup AS A ON B.accountGroupId = A.accountGroupId LEFT OUTER JOIN ledgerposting AS C ON B.ledgerId = C.ledgerId WHERE A.accountGroupId IN (2) group by A.accountGroupId ,A.accountGroupName");
            $data['liability'] = $queryliability->result();

            $data['liabilitytotal']=0;
            foreach($data['liability'] as $liability){
                $amount=(isset($liability->totalpurchase))?$liability->totalpurchase:0;
                $data['liabilitytotal']=$data['liabilitytotal']+$amount;
            }

            //Closing stock calculation
            $closingstockQr = $this->db->query("SELECT (SUM(S.inwardQuantity) - SUM(S.outwardQuantity))* B.purchaseRate AS ClosingStock FROM product AS P INNER JOIN productbatch AS B ON P.productId = B.productId INNER JOIN productgroup AS G ON P.productGroupId = G.productGroupId LEFT OUTER JOIN stockposting AS S ON B.productBatchId = S.productBatchId AND (S.date BETWEEN '$date_from%' AND  '$date_to%') AND S.voucherType ='Purchase Invoice' GROUP BY B.productId, P.productName,B.purchaseRate");
            $data['closingstocks'] = $closingstockQr->result();

            $data['closingstockstotal']=0;
            foreach($data['liability'] as $closingstocks){
                $amountclosingstocks=(isset($closingstocks->ClosingStock))?$closingstocks->ClosingStock:0;
                $data['closingstockstotal']=$data['closingstockstotal']+$amountclosingstocks;
            }


            $this->load->view('balance_sheet', $data);
        else:
            $this->load->view('masterlogin', $data);
        endif;
    }

    public function transection() {
        $data['title'] = "Transaction";
        $data['active_menu'] = "report";
        $data['active_sub_menu'] = "transection";
        $data['baseurl'] = $this->config->item('base_url');
        $this->load->view('transection', $data);
    }

    public function stock_sale() {
        $data['title'] = "Stock Sale";
        $data['active_menu'] = "report";
        $data['active_sub_menu'] = "stock_sale";
        $data['baseurl'] = $this->config->item('base_url');
        $this->load->view('stock_sale', $data);
    }

    public function daily_sale() {
        $data['title'] = "Daily Sale";
        $data['active_menu'] = "report";
        $data['active_sub_menu'] = "daily_sale";
        $data['baseurl'] = $this->config->item('base_url');
        $this->load->view('daily_sale', $data);
    }

    public function addAccGroup() {
        $this->load->model('ccfmodel');
        $isadded = $this->ccfmodel->addAccGroup();
        if ($isadded) {
            die('Added');
        } else {
            die('Notadded');
        }
    }

    public function editAccGroup() {
        $this->load->model('ccfmodel');
        $isupdated = $this->ccfmodel->editAccGroup();
        if ($isupdated) {
            echo 'Updated';
        } else {
            echo 'Notupdated';
        }
    }

    public function deleteAccGroup() {
        $this->load->model('ccfmodel');
        $response = $this->ccfmodel->deleteAccGroup();
        $this->session->set_userdata('deletemessage', $response);
        redirect('home/accountGroup');
    }

    public function accountNameCheck() {
        $this->load->model('ccfmodel');
        $isExist = $this->ccfmodel->accountNameCheck();
        if ($isExist) {
            die('free');
        } else {
            die('booked');
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */