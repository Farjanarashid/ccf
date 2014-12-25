<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Purchase extends CI_Controller
{
    private $sessiondata;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('purchasedb');
        $this->sessiondata = $this->session->userdata('logindata');
    }

    public function index()
    {
        $data['title'] = "Purchase";
        $data['active_menu'] = "transaction";
        $data['active_sub_menu'] = "purchase";;
        $data['baseurl'] = $this->config->item('base_url');

        if ($this->sessiondata['username'] != NULL && $this->sessiondata['status'] == 'login' && $this->sessiondata['role'] == 'admin'):

        //Session for add data
        if(isset($this->session->userdata['dataaddedpurchase'])){
            if($this->session->userdata['dataaddedpurchase'] != NULL && $this->session->userdata['dataaddedpurchase'] == 'added'){
                $data['data_added']=$this->session->userdata('dataaddedpurchase');
                $this->session->unset_userdata('dataaddedpurchase');
            }
        }
        //Session for edited
        if(isset($this->session->userdata['dataaddedpurchase'])){
            if($this->session->userdata['dataaddedpurchase'] != NULL && $this->session->userdata['dataaddedpurchase'] == 'edited'){
                $data['data_added']=$this->session->userdata('dataaddedpurchase');
                $this->session->unset_userdata('dataaddedpurchase');
            }
        }
        //Session for deleted
        if(isset($this->session->userdata['dataaddedpurchase'])){
            if($this->session->userdata['dataaddedpurchase'] != NULL && $this->session->userdata['dataaddedpurchase'] == 'deleted'){
                $data['data_added']=$this->session->userdata('dataaddedpurchase');
                $this->session->unset_userdata('dataaddedpurchase');
            }
        }
        //Session for notdeleted
        if(isset($this->session->userdata['dataaddedpurchase'])){
            if($this->session->userdata['dataaddedpurchase'] != NULL && $this->session->userdata['dataaddedpurchase'] == 'notdeleted'){
                $data['data_added']=$this->session->userdata('dataaddedpurchase');
                $this->session->unset_userdata('dataaddedpurchase');
            }
        }


        //query data to view into table
        $query2 = $this->db->query("SELECT  *  FROM  purchasemaster ORDER BY purchaseMasterId DESC ");
        $data['purchaseinfo'] = $query2->result();

        //query from invoicestatus data to view into table
        $queryinvoicestatus = $this->db->query("SELECT  *  FROM  invoicestatus ");
        $data['invoicestatus'] = $queryinvoicestatus->result();

        //query data to view into table
        $query3 = $this->db->query("SELECT  *  FROM  accountledger ORDER BY ledgerId DESC ");
        $data['accountledgerinfo'] = $query3->result();

        $getcompanylist = $this->load->model('company_y');
        $data['companylist'] = $this->company_y->getcomapnylist();


            $data['company_id']=$this->sessiondata['companyid'];
            $this->load->view('header', $data);
            $this->load->view('sidebar', $data);
            $this->load->view('purchase/purchase', $data);
            $this->load->view('footer', $data);
            $this->load->view('purchase/script', $data);
        else:
            $this->load->view('masterlogin', $data);
        endif;
    }

//  ==================================  Add new==========================================
    public function add_view(){
        $data['title'] = "Purchase";
        $data['active_menu'] = "transaction";
        $data['active_sub_menu'] = "purchase";;
        $data['baseurl'] = $this->config->item('base_url');
        if ($this->sessiondata['username'] != NULL && $this->sessiondata['status'] == 'login' && $this->sessiondata['role'] == 'admin'):


        // add new unit
        if(isset($this->session->userdata['dataaddedpurchase'])){
            if($this->session->userdata['dataaddedpurchase'] != NULL && $this->session->userdata['dataaddedpurchase'] == 'add_unit'){
                $data['data_added']=$this->session->userdata('dataaddedpurchase');
                $this->session->unset_userdata('dataaddedpurchase');
            }
         }
        $data['company_id']=$this->sessiondata['companyid'];
        $company_id=$data['company_id'];
        //query  supplier name from table
        $query2 = $this->db->query("SELECT  *  FROM  accountledger WHERE accountGroupId=27 AND  companyId='$company_id' ORDER BY ledgerId DESC");
        $data['supplierinfo1'] = $query2->result();

        //query  product  name from table
        $queryp = $this->db->query("SELECT  *  FROM  product");
        $data['productinfo'] = $queryp->result();

        //query  unit  name from table
        $queryunit = $this->db->query("SELECT  *  FROM  unit");
        $data['unitinfo'] = $queryunit->result();


        $query2 = $this->db->query("SELECT  *  FROM  countries");
        $data['countries'] = $query2->result();
        $getcompanylist = $this->load->model('company_y');
        $data['companylist'] = $this->company_y->getcomapnylist();


            $this->load->view('header', $data);
            $this->load->view('sidebar', $data);
            $this->load->view('purchase/add_view', $data);
            $this->load->view('footer', $data);
            $this->load->view('purchase/script', $data);
        else:
            $this->load->view('masterlogin', $data);
        endif;
    }

    //query unit id for product
    public function unit_name(){
        $product_id=$this->input->post("product_id");

        //query  unit  name from table
        $queryunit = $this->db->query("SELECT  unitId  FROM  product WHERE productId='$product_id'");
       // $data['unitinfo'] = $queryunit->result();
        $row1 = $queryunit->row_array();
        $unitId=$row1['unitId'];

        //query  unit  name from table
        $queryunitname = $this->db->query("SELECT  unitName  FROM  unit WHERE unitId='$unitId'");
        $row2 = $queryunitname->row_array();
        $unitName=$row2['unitName'];
        echo $unitId.",".$unitName;
    }

    public  function  add_view_table(){
         $product_name=$this->input->post('product_name');
         $unit=$this->input->post('unit');
         $count=$this->input->post('count');

        if ($this->sessiondata['username'] != NULL && $this->sessiondata['status'] == 'login' && $this->sessiondata['role'] == 'admin'):
        //query  product  name from table
        $queryp = $this->db->query("SELECT  *  FROM  product WHERE productId='$product_name'");
        $row1 = $queryp->row_array();
        $productName=$row1['productName'];

        //query  unit  name from table
        $queryunit = $this->db->query("SELECT  *  FROM  unit WHERE unitId='$unit'");
        $row2 = $queryunit->row_array();
        $unitName= $row2['unitName'];

        echo '<tr id="row'.$count.'">
                    <td>'.$productName.'<input name="product_name'.$count.'" id="product_name'.$count.'" type="hidden" value="'.$this->input->post('product_name').'"/></td>
                    <td id="click" class="edit-field" title="Click for Edit"><span>'.$this->input->post('qty').'</span><input name="qty'.$count.'"  class="edit_input" id="qty'.$count.'" type="hidden" value="'.$this->input->post('qty').'"/></td>
                    <td>'.$unitName.'<input name="unit'.$count.'" id="unit'.$count.'" type="hidden" value="'.$this->input->post('unit').'"/></td>
                    <td class="edit-field" title="Click for Edit"><span>'.$this->input->post('rate').'</span><input name="rate'.$count.'" id="rate'.$count.'" type="hidden"  class="edit_input"value="'.$this->input->post('rate').'"/></td>
                    <td class="edit-field" title="Click for Edit"><span>'.$this->input->post('sale_rate').'</span><input name="sale_rate'.$count.'" id="sale_rate'.$count.'"  class="edit_input"type="hidden" value="'.$this->input->post('sale_rate').'"/></td>
                    <td class="edit-field" title="Click for Edit"><span>'.$this->input->post('discountsingle').'</span><input name="discountsingle'.$count.'" id="discountsingle'.$count.'" type="hidden" class="edit_input" value="'.$this->input->post('discountsingle').'"/></td>
                    <td class="edit-field" title="Click for Edit"><span>'.$this->input->post('vat').'</span><input name="vat'.$count.'" id="vat'.$count.'" type="hidden" class="edit_input" value="'.$this->input->post('vat').'"/></td>';
             //Net amount per product
            $qty=$this->input->post('qty');
            $rate=$this->input->post('rate');
            $vat = $this->input->post('vat');
            $discountsingle= $this->input->post('discountsingle');
            $qtyrate=$qty * $rate;
            $vatamount=($qtyrate-$qtyrate*($discountsingle/100)) * ($vat/100); //Vat amount
            $amount= $qtyrate-($qtyrate*($discountsingle/100));  //Amount
            $grandtotal= $amount + $vatamount;  //total amount

            echo     '<td><span id="product_amount'.$count.'">'.$grandtotal.'</span></td>
               </tr>';

        else:
            $this->load->view('masterlogin', $data);
        endif;
    }


    public function add(){

        $data['title'] = "Purchase";
        $data['active_menu'] = "transaction";
        $data['active_sub_menu'] = "purchase";
        $data['baseurl'] = $this->config->item('base_url');

        $isadded = $this->purchasedb->addpurchase();

        $this->session->set_userdata(array('dataaddedpurchase'=>'added'));
        redirect('purchase/purchase');
    }


//  =============================================  Edit page======================================================
    public function add_view_edit(){
        $data['title'] = "Purchase";
        $data['active_menu'] = "transaction";
        $data['active_sub_menu'] = "purchase";;
        $data['baseurl'] = $this->config->item('base_url');

        if ($this->sessiondata['username'] != NULL && $this->sessiondata['status'] == 'login' && $this->sessiondata['role'] == 'admin'):
        $data['company_id']=$this->sessiondata['companyid'];
        $company_id =$data['company_id'];
        //query  supplier name from table
        $query2 = $this->db->query("SELECT  *  FROM  accountledger WHERE accountGroupId=27  AND  companyId='$company_id' ORDER BY ledgerId DESC");
        $data['supplierinfo1'] = $query2->result();

        //query  product  name from table
        $queryp = $this->db->query("SELECT  *  FROM  product");
        $data['productinfo'] = $queryp->result();

        //query  unit  name from table
        $queryunit = $this->db->query("SELECT  *  FROM  unit");
        $data['unitinfo'] = $queryunit->result();

        /*======================= query data from inserted tables=========================== */
        $id=$this->input->get('id');
        $ledger=$this->input->get('ledger');
        //query  from PurchaseMaster
        $querypurchasemaster = $this->db->query("SELECT  *  FROM  purchasemaster WHERE purchaseMasterId='$id'");
        $data['purchasemasterinfo'] = $querypurchasemaster->result();

        //for product
        //from purchasedetails
        $queryratequalityvat= $this->db->query("SELECT * FROM purchasedetails INNER JOIN stockposting ON purchasedetails.purchaseMasterId = stockposting.voucherNumber AND purchasedetails.productBatchId = stockposting.productBatchId WHERE purchasedetails.purchaseMasterId='$id'group by purchaseDetailsId");
        $data['ratequalityvat'] = $queryratequalityvat->result();
        $data['count_product'] = $queryratequalityvat->num_rows();
        //from productbatch
        $queryproducts = $this->db->query("SELECT  *  FROM  productbatch");
        $data['products'] = $queryproducts->result();

        $query2 = $this->db->query("SELECT  *  FROM  countries");
        $data['countries'] = $query2->result();
        $getcompanylist = $this->load->model('company_y');
        $data['companylist'] = $this->company_y->getcomapnylist();


            $this->load->view('header', $data);
            $this->load->view('sidebar', $data);
            $this->load->view('purchase/add_view_edit', $data);
            $this->load->view('footer', $data);
            $this->load->view('purchase/script-edit', $data);
        else:
            $this->load->view('masterlogin', $data);
        endif;
    }

    public function dataqueryedit(){
        $product_id=$this->input->post("product_id");
        $unitid=$this->input->post("unitid");

        //query  product  name from table
        $queryp = $this->db->query("SELECT  productName  FROM  product WHERE productId='$product_id'");
       // $productinfo = $queryp->result();
        $productinfo = $queryp->row();
        echo $productinfo->productName.",";

        //query  unit  name from table
        $queryunit = $this->db->query("SELECT  unitName  FROM  unit WHERE unitId='$unitid'");
        $unitinfo = $queryunit->row();
        echo $unitinfo->unitName;
    }

    //===========================edit submit=========================================
    public function edit()
    {
        $data['title'] = "Purchase";
        $data['active_menu'] = "transaction";
        $data['active_sub_menu'] = "purchase";
        $data['baseurl'] = $this->config->item('base_url');

        $isadded = $this->purchasedb->editPurchase();

        $this->session->set_userdata(array('dataaddedpurchase'=>'edited'));
        redirect('purchase/purchase');
    }

    //================================================================================Delete data=================================================
    public function delete()
    {
        $purchaseMasterId = $this->input->post('purchaseMasterId');
        $query1=$this->db->query("SELECT  *  FROM  partybalance WHERE voucherNo='$purchaseMasterId' AND voucherType='Payment Voucher'");
        $row1 = $query1->row();
        $query2=$this->db->query("SELECT  purchaseDetailsId  FROM  purchasedetails WHERE purchaseDetailsId='$purchaseMasterId'");
        $row2 = $query2->row_array();
        $purchaseDetailsId= $row2['purchaseDetailsId'];
        $query3=$this->db->query("SELECT  *  FROM  purchasereturndetails WHERE purchaseDetailsId='$purchaseDetailsId'");
        $row3 = $query3->row();

        if($row1 || $row3){
            $this->session->set_userdata(array('dataaddedpurchase'=>'notdeleted'));
            redirect('purchase/purchase');
        }else{
            $delete1=$this->db->query("DELETE FROM purchasemaster WHERE purchaseMasterId='$purchaseMasterId'");
            $delete2=$this->db->query("DELETE FROM purchasedetails  WHERE purchaseMasterId='$purchaseMasterId'");
            $delete3=$this->db->query("DELETE FROM ledgerposting  WHERE voucherNumber='$purchaseMasterId'");
            $delete4=$this->db->query("DELETE FROM stockposting  WHERE voucherNumber='$purchaseMasterId'");
            $delete5=$this->db->query("DELETE FROM partybalance  WHERE voucherNo='$purchaseMasterId'");

            if ($delete1 && $delete2 && $delete3 && $delete4 && $delete5) {
                $this->session->set_userdata(array('dataaddedpurchase'=>'deleted'));
                redirect('purchase/purchase');
            }
        }

    }

    //====================================================add new unit==========================================================================

    public function addunit() {
       // $Modalname = $this->input->post('modalname');
        $this->load->model('productunit_model');
        $saveresult = $this->productunit_model->saveproductunit();

        if ($saveresult) {
            $this->session->set_userdata(array('dataaddedpurchase'=>'add_unit'));
            redirect('purchase/purchase/add_view');
        }
    }

    //=======================================check checkinvoiceno====================================================================================
    public function checkinvoiceno(){
        $invoiceno=$this->input->post('invoiceno');
        $companyid=$this->input->post('companyid');

        $queryinvoice=$this->db->query("SELECT * FROM purchasemaster WHERE companyId='$companyid' AND purchaseInvoiceNo='$invoiceno'");
        $row = $queryinvoice->row();
        if($row){
            echo "found";
        }else{
            echo "notfound";
        }
    }
}