<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dailysale extends CI_Controller {

    private $sessiondata;

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->sessiondata = $this->session->userdata('logindata');
    }

    public function index() {
        $data['baseurl'] = $this->config->item('base_url');
        $data['title'] = "Daily Sale";
        $data['active_menu'] = "report";
        $data['active_sub_menu'] = "dailysale";
        $companyid = $this->sessiondata['companyid'];
        $sdate = date("Y-m-d 00:00:00");
        $edate = date("Y-m-d 23:59:59");
        $data['fdate'] = $sdate;
        $data['edate'] = $edate;
        $productname = $this->db->query("select productName,sum((productbatch.purchaseRate)*(stockposting.outwardQuantity-stockposting.inwardQuantity)) as cost,sum(stockposting.outwardQuantity-stockposting.inwardQuantity) as qty,sum(stockposting.rate*(stockposting.outwardQuantity-stockposting.inwardQuantity)) as amount from productbatch inner join stockposting on productbatch.productBatchId = stockposting.productBatchId inner join product on product.productId = productbatch.productId where stockposting.companyId = '$companyid' And stockposting.date between '$sdate%' AND '$edate%' group by productbatch.productId,stockposting.productBatchId");
        $data['saleinfo'] = $productname->result();
        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('dailysale/dailysale', $data);
        $this->load->view('footer', $data);
    }
    public function searchbydate() {
        $data['baseurl'] = $this->config->item('base_url');
        $data['title'] = "Daily Sale";
        $data['active_menu'] = "report";
        $data['active_sub_menu'] = "dailysale";
        if ($this->sessiondata['username'] != NULL && $this->sessiondata['status'] == 'login' && $this->sessiondata['role'] == 'admin'):
        $companyid = $this->sessiondata['companyid'];
        $sdate = $_POST['date_from'];
        $edate = $_POST['date_to'];
        $data['fdate'] = $sdate;
        $data['edate'] = $edate;
        #var_dump("select productName,sum((productbatch.purchaseRate)*(stockposting.inwardQuantity)) as cost,sum(stockposting.inwardQuantity) as qty,sum(stockposting.rate*stockposting.inwardQuantity) as amount from productbatch inner join stockposting on productbatch.productBatchId = stockposting.productBatchId inner join product on product.productId = productbatch.productId where stockposting.companyId = '$companyid' And date between '$sdate%' AND '$edate%' group by productbatch.productId,stockposting.productBatchId");exit();
        $productname = $this->db->query("select productName,sum((productbatch.purchaseRate)*(stockposting.outwardQuantity-stockposting.inwardQuantity)) as cost,sum(stockposting.outwardQuantity-stockposting.inwardQuantity) as qty,sum(stockposting.rate*(stockposting.outwardQuantity-stockposting.inwardQuantity)) as amount from productbatch inner join stockposting on productbatch.productBatchId = stockposting.productBatchId inner join product on product.productId = productbatch.productId where stockposting.companyId = '$companyid' And stockposting.date between '$sdate%' AND '$edate%' group by productbatch.productId,stockposting.productBatchId");
        $data['saleinfo'] = $productname->result();
        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('dailysale/dailysale', $data);
        $this->load->view('footer', $data);
        else:
            redirect('home');
        endif;
    }

}
