<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Purchase_return extends CI_Controller
{
    private $sessiondata;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('purchasereturndb');
        $this->sessiondata = $this->session->userdata('logindata');
    }

    public function index()
    {
        $data['title'] = "Purchase Return";
        $data['active_menu'] = "transaction";
        $data['active_sub_menu'] = "purchasereturn";
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
            $query2 = $this->db->query("SELECT  *  FROM  purchasereturnmaster ORDER BY purchaseReturnMasterId DESC ");
            $data['purchasereturninfo'] = $query2->result();

            //query from invoicestatus data to view into table
            $queryinvoicestatus = $this->db->query("SELECT  *  FROM  purchasemaster ");
            $data['purchaseinfo'] = $queryinvoicestatus->result();

            $getcompanylist = $this->load->model('company_y');
            $data['companylist'] = $this->company_y->getcomapnylist();


            $data['company_id']=$this->sessiondata['companyid'];
            $this->load->view('header', $data);
            $this->load->view('sidebar', $data);
            $this->load->view('purchasereturn/purchasereturn', $data);
            $this->load->view('footer', $data);
            $this->load->view('purchasereturn/script', $data);
        else:
            $this->load->view('masterlogin', $data);
        endif;
    }

//  ==================================  Add View==========================================
    public function add_view(){
        $data['title'] = "Purchase Return";
        $data['active_menu'] = "transaction";
        $data['active_sub_menu'] = "purchasereturn";
        $data['baseurl'] = $this->config->item('base_url');
        if ($this->sessiondata['username'] != NULL && $this->sessiondata['status'] == 'login' && $this->sessiondata['role'] == 'admin'):

            $data['company_id']=$this->sessiondata['companyid'];
            $company_id=$data['company_id'];

            $querypurchasemaster = $this->db->query("SELECT * FROM purchasemaster LEFT JOIN purchasereturnmaster ON purchasemaster.purchaseMasterId = purchasereturnmaster.purchaseMasterId WHERE purchasereturnmaster.purchaseMasterId IS NULL");
            $data['purchaseinfo']= $querypurchasemaster->result();


            $getcompanylist = $this->load->model('company_y');
            $data['companylist'] = $this->company_y->getcomapnylist();


            $this->load->view('header', $data);
            $this->load->view('sidebar', $data);
            $this->load->view('purchasereturn/add_view', $data);
            $this->load->view('footer', $data);
            $this->load->view('purchasereturn/script', $data);
        else:
            $this->load->view('masterlogin', $data);
        endif;
    }

    //=======================find company name==============================
    public function findcompanyname(){
        $invoiceno=$this->input->post('invoiceno');

        if($invoiceno!==""){
        $querypurchasemaster = $this->db->query("SELECT  *  FROM  purchasemaster WHERE purchaseInvoiceNo='$invoiceno'");
        $row2 = $querypurchasemaster->row_array();
        $ledgerId=$row2['ledgerId'];

        //query  Company Name name from table
        $queryaccountladger = $this->db->query("SELECT  *  FROM  accountledger WHERE ledgerId='$ledgerId'");
        $row3 = $queryaccountladger->row_array();
        $acccountLedgerName=$row3['acccountLedgerName'];

        echo "$acccountLedgerName,$ledgerId";
        }
    }
//==================================find product info ===============================================
    public function findproductinfo(){
        $invoiceno=$this->input->post('invoiceno');

        if($invoiceno!==""){
        //query  product  name from table
        $queryp = $this->db->query("SELECT  *  FROM  product");
        $productinfo = $queryp->result();

        //query  unit  name from table
        $queryunit = $this->db->query("SELECT  *  FROM  unit");
        $unitinfo = $queryunit->result();

             /*======================= query data from inserted tables=========================== */
        //query  from PurchaseMaster
        $querypurchasemaster = $this->db->query("SELECT  *  FROM  purchasemaster WHERE purchaseInvoiceNo='$invoiceno'");
        $purchasemaster = $querypurchasemaster->row_array();
        $purchaseMasterId=$purchasemaster['purchaseMasterId'];

        //for product
        //from purchasedetails
        $queryratequalityvat= $this->db->query("SELECT * FROM purchasedetails INNER JOIN stockposting ON purchasedetails.purchaseMasterId = stockposting.voucherNumber AND purchasedetails.productBatchId = stockposting.productBatchId WHERE purchasedetails.purchaseMasterId='$purchaseMasterId'group by purchaseDetailsId");
        $ratequalityvatdisc = $queryratequalityvat->result();
        $count_product = $queryratequalityvat->num_rows();

        //from productbatch
        $queryproducts = $this->db->query("SELECT  *  FROM  productbatch");
        $products = $queryproducts->result();

        $count=0;
        foreach($ratequalityvatdisc as $rqvd){
            $count=$count+1;
            echo '<tr>';
            //Product Name
            echo  '<td>
                   <input name="purchaseDetailsId'.$count.'" id="purchaseDetailsId'.$count.'" value="'.$rqvd->purchaseDetailsId.'" type="hidden"/>
                   <input name="purchasemasterid" id="purchasemasterid" value="'.$purchaseMasterId.'" type="hidden"/>';
            echo  '<input name="count_product" id="count_product" value="'.$count_product.'" type="hidden"/>';
                    foreach($products as $product){
                        $batchid=$product->productBatchId;
                        $salesRate=$product->salesRate;
                        $productId=$product->productId;
                        if($batchid==$rqvd->productBatchId){
                            echo '<input name="product_id'.$count.'" id="product_id'.$count.'" value="'.$productId.'" type="hidden"/> ';//Input field
                            foreach($productinfo as $productname){
                                $prodid=$productname->productId;
                                $productName=$productname->productName;
                                if($prodid==$productId){
                                    echo '<span class="product_id'.$count.'">'.$productName.'</span>';
                                }
                            }
                        }
                    }
            echo  '</td><td>';
            //Qty
            echo '<input name="qty'.$count.'" id="qty'.$count.'" value="'.$rqvd->qty.'" type="hidden"/>'.'<span class="qty'.$count.'">'.$rqvd->qty.'</span>';
            echo  '</td><td>';
            //Return Qty
            echo '<input name="returnqty'.$count.'" class="returnqty" data-id="'.$count.'" id="returnqty'.$count.'" value="00" type="text"/>';
            echo  '</td><td>';
            //Unit name
            echo '<input name="unit_id'.$count.'" id="unit_id'.$count.'" value="'.$rqvd->unitId.'" type="hidden"/>';  //Input field
            foreach($unitinfo as $unit){
                $unitid=$unit->unitId;
                $unitName=$unit->unitName;
                if($unitid==$rqvd->unitId){
                    echo '<span class="unit_id'.$count.'">'.$unitName.'</span>';
                }
            }
            echo  '</td><td>';
            //rate
            echo '<input name="rate'.$count.'" id="rate'.$count.'" value="'.$rqvd->rate.'" type="hidden"/>'.'<span class="rate'.$count.'">'.$rqvd->rate.'</span>'; //Input field
            echo  '</td><td>';
            //salerate
            foreach($products as $product){
                $batchid=$product->productBatchId;
                $salesRate=$product->salesRate;
                $productId=$product->productId;
                if($batchid==$rqvd->productBatchId){
                    echo '<input name="salerate'.$count.'" id="salerate'.$count.'" value="'.$salesRate.'" type="hidden"/>'.'<span class="salerate'.$count.'">'.$salesRate.'</span>'; //Input field
                }
            }
            echo  '</td><td>';
            //Discount
            echo '<input name="discountsingle'.$count.'" id="discountsingle'.$count.'" value="'.$rqvd->discount.'" type="hidden"/>'.'<span class="discountsingle'.$count.'">'.$rqvd->discount.'</span>'; //Input field
            echo  '</td><td>';
            //vat
            echo '<input name="vat'.$count.'" id="vat'.$count.'" value="'.$rqvd->taxPercentage.'" type="hidden"/>'.'<span class="vat'.$count.'">'.$rqvd->taxPercentage.'</span>'; //Input field
            echo  '</td><td>';
            //Net amount per product
            $zero=0;
            echo '<span id="product_amount'.$count.'">'.$zero.'</span>'; //Input field
            echo  '</td>';
           echo   '</tr>';
        }
        }

    }

    public function findproductinfoedit(){
        $invoiceno=$this->input->post('invoiceno');

        if($invoiceno!==""){
        //query  product  name from table
        $queryp = $this->db->query("SELECT  *  FROM  product");
        $productinfo = $queryp->result();

        //query  unit  name from table
        $queryunit = $this->db->query("SELECT  *  FROM  unit");
        $unitinfo = $queryunit->result();

             /*======================= query data from inserted tables=========================== */
        //query  from PurchaseMaster
        $querypurchasemaster = $this->db->query("SELECT  *  FROM  purchasemaster WHERE purchaseInvoiceNo='$invoiceno'");
        $purchasemaster = $querypurchasemaster->row_array();
        $purchaseMasterId=$purchasemaster['purchaseMasterId'];

        //for product
        //from purchasedetails
        $queryratequalityvat= $this->db->query("SELECT * FROM purchasedetails INNER JOIN stockposting ON purchasedetails.purchaseMasterId = stockposting.voucherNumber AND purchasedetails.productBatchId = stockposting.productBatchId WHERE purchasedetails.purchaseMasterId='$purchaseMasterId' group by purchaseDetailsId");
        $ratequalityvatdisc = $queryratequalityvat->result();
        $count_product = $queryratequalityvat->num_rows();

        //from productbatch
        $queryproducts = $this->db->query("SELECT  *  FROM  productbatch");
        $products = $queryproducts->result();

        //query from purchasereturndetails data
        $querypurchasereturndetails = $this->db->query("SELECT  *  FROM  purchasereturndetails ");
        $purchasereturninfo = $querypurchasereturndetails->result();

        $count=0;
        foreach($ratequalityvatdisc as $rqvd){
            $count=$count+1;
            echo '<tr class="row'.$count.'">';
            //Product Name
            echo  '<td>
                   <input name="purchaseDetailsId'.$count.'" id="purchaseDetailsId'.$count.'" value="'.$rqvd->purchaseDetailsId.'" type="hidden"/>
                   <input name="purchasemasterid" id="purchasemasterid" value="'.$purchaseMasterId.'" type="hidden"/>';
            echo  '<input name="count_product" id="count_product" value="'.$count_product.'" type="hidden"/>';
                    foreach($products as $product){
                        $batchid=$product->productBatchId;
                        $salesRate=$product->salesRate;
                        $productId=$product->productId;
                        if($batchid==$rqvd->productBatchId){
                            echo '<input name="product_id'.$count.'" id="product_id'.$count.'" value="'.$productId.'" type="hidden"/> ';//Input field
                            foreach($productinfo as $productname){
                                $prodid=$productname->productId;
                                $productName=$productname->productName;
                                if($prodid==$productId){
                                    echo '<span class="product_id'.$count.'">'.$productName.'</span>';
                                }
                            }
                        }
                    }
            echo  '</td><td>';
            //Qty
            echo '<input name="qty'.$count.'" id="qty'.$count.'" value="'.$rqvd->qty.'" type="hidden"/>'.'<span class="qty'.$count.'">'.$rqvd->qty.'</span>';
            echo  '</td><td>';
            //Return Qty
            foreach($purchasereturninfo as $purchasereturn){
                $purchaseDetailsId=$purchasereturn->purchaseDetailsId;
                if($purchaseDetailsId==$rqvd->purchaseDetailsId){
                    echo '<input name="returnqty'.$count.'" class="returnqty" data-id="'.$count.'" id="returnqty'.$count.'" value="'.$purchasereturn->returnedQty.'" type="text"/>';
                }
            }
           // echo '<input name="returnqty'.$count.'" class="returnqty" data-id="'.$count.'" id="returnqty'.$count.'" value="" type="text"/>';
            echo  '</td><td>';
            //Unit name
            echo '<input name="unit_id'.$count.'" id="unit_id'.$count.'" value="'.$rqvd->unitId.'" type="hidden"/>';  //Input field
            foreach($unitinfo as $unit){
                $unitid=$unit->unitId;
                $unitName=$unit->unitName;
                if($unitid==$rqvd->unitId){
                    echo '<span class="unit_id'.$count.'">'.$unitName.'</span>';
                }
            }
            echo  '</td><td>';
            //rate
            echo '<input name="rate'.$count.'" id="rate'.$count.'" value="'.$rqvd->rate.'" type="hidden"/>'.'<span class="rate'.$count.'">'.$rqvd->rate.'</span>'; //Input field
            echo  '</td><td>';
            //salerate
            foreach($products as $product){
                $batchid=$product->productBatchId;
                $salesRate=$product->salesRate;
                $productId=$product->productId;
                if($batchid==$rqvd->productBatchId){
                    echo '<input name="salerate'.$count.'" id="salerate'.$count.'" value="'.$salesRate.'" type="hidden"/>'.'<span class="salerate'.$count.'">'.$salesRate.'</span>'; //Input field
                }
            }
            echo  '</td><td>';
            //Discount
            echo '<input name="discountsingle'.$count.'" id="discountsingle'.$count.'" value="'.$rqvd->discount.'" type="hidden"/>'.'<span class="discountsingle'.$count.'">'.$rqvd->discount.'</span>'; //Input field
            echo  '</td><td>';
            //vat
            echo '<input name="vat'.$count.'" id="vat'.$count.'" value="'.$rqvd->taxPercentage.'" type="hidden"/>'.'<span class="vat'.$count.'">'.$rqvd->taxPercentage.'</span>'; //Input field
            echo  '</td><td>';
            //Net amount per product
            $qty=0;
            foreach($purchasereturninfo as $purchasereturn){
                $purchaseDetailsId=$purchasereturn->purchaseDetailsId;
                if($purchaseDetailsId==$rqvd->purchaseDetailsId){
                   $qty=$purchasereturn->returnedQty;
                    break;
                }else{
                   $qty=$rqvd->qty;

                }
            }
            $qtyrate=$qty* $rqvd->rate;
            $vatamount=($qtyrate-$qtyrate*($rqvd->discount/100)) * ($rqvd->taxPercentage/100); //Vat amount
            $amount= $qtyrate-($qtyrate*($rqvd->discount/100));  //Amount
            $grandtotal= $amount + $vatamount;  //total amount
            echo '<span id="product_amount'.$count.'">'.$grandtotal.'</span>'; //Input field
            echo  '</td>';
           echo   '</tr>';
        }
        }

    }

    //=======================================================add data=======================================================

    public function add(){

        $data['title'] = "Purchase Return";
        $data['active_menu'] = "transaction";
        $data['active_sub_menu'] = "purchasereturn";
        $data['baseurl'] = $this->config->item('base_url');

        $isadded = $this->purchasereturndb->purchasereturnadd();

        $this->session->set_userdata(array('dataaddedpurchase'=>'added'));
        redirect('purchasereturn/purchase_return');
    }
//  ==================================  Edit View==========================================
    public function edit_view(){
        $data['title'] = "Purchase Return";
        $data['active_menu'] = "transaction";
        $data['active_sub_menu'] = "purchasereturn";
        $data['baseurl'] = $this->config->item('base_url');
        if ($this->sessiondata['username'] != NULL && $this->sessiondata['status'] == 'login' && $this->sessiondata['role'] == 'admin'):

            $data['company_id']=$this->sessiondata['companyid'];
            $company_id=$data['company_id'];

            $data['invoiceno']=$this->input->get('id');

            $getcompanylist = $this->load->model('company_y');
            $data['companylist'] = $this->company_y->getcomapnylist();


            $this->load->view('header', $data);
            $this->load->view('sidebar', $data);
            $this->load->view('purchasereturn/edit_view', $data);
            $this->load->view('footer', $data);
            $this->load->view('purchasereturn/script-edit', $data);
        else:
            $this->load->view('masterlogin', $data);
        endif;
    }


    //=======================================================Edit data=======================================================

    public function edit(){

        $data['title'] = "Purchase Return Edit";
        $data['active_menu'] = "transaction";
        $data['active_sub_menu'] = "purchasereturn";
        $data['baseurl'] = $this->config->item('base_url');

        $isadded = $this->purchasereturndb->purchasereturnedit();

        $this->session->set_userdata(array('dataaddedpurchase'=>'edited'));
        redirect('purchasereturn/purchase_return');
    }

    //=====================================================Delete Data=============================================================
    public function delete()
    {
        $purchasereturnMasterId = $this->input->post('purchasereturnMasterId');

            $delete1=$this->db->query("DELETE FROM purchasereturnmaster WHERE purchaseReturnMasterId='$purchasereturnMasterId'");
            $delete2=$this->db->query("DELETE FROM purchasereturndetails  WHERE purchaseReturnMasterId='$purchasereturnMasterId'");
            $delete3=$this->db->query("DELETE FROM ledgerposting  WHERE voucherNumber='$purchasereturnMasterId'");
            $delete4=$this->db->query("DELETE FROM stockposting  WHERE voucherNumber='$purchasereturnMasterId'");

            if ($delete1 && $delete2 && $delete3 && $delete4) {
                $this->session->set_userdata(array('dataaddedpurchase'=>'deleted'));
                redirect('purchasereturn/purchase_return');
             }

    }


}