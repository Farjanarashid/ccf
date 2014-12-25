<?php

class Purchasedb extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
    }

    //add data

    // single row info
//        $this->input->post('count_product');
//        $this->input->post('product_name');
//        $this->input->post('qty');
//        $this->input->post('unit');
//        $this->input->post('rate');
//        $this->input->post('sale_rate');
//        $this->input->post('vat');
      //common  data
//        $this->input->post('company_id');
//        $this->input->post('invoice_date');
//        $this->input->post('due_days');
//        $this->input->post('invoive_number');
//        $this->input->post('corparty_account');
//        //net info
//        $this->input->post('total_amout');
//        $this->input->post('total_vat');
//        $this->input->post('grandtotal');
//        $this->input->post('discount');
//        $this->input->post('net_amout');
//        $this->input->post('description');
//============================================================add data=================================================================================================//
    function addpurchase(){
        $count=$this->input->post('count_product');
        //===================1st tbl PurchaseMaster
        if($this->input->post('corparty_account')==2){
            $invoiceStatusId=1;
        }else{
            $invoiceStatusId=3;
        }
        $invoive_number=$this->input->post('invoive_number');
        $data1 = array(
            'date' => $this->input->post('invoice_date'),
            'ledgerId' => $this->input->post('corparty_account'),
            'dueDays' => $this->input->post('due_days'),
            'purchaseInvoiceNo' => $invoive_number,
            'billDiscount' => $this->input->post('discount'),
            'description' =>$this->input->post('description'),
            'amount' => $this->input->post('net_amout'),
            'invoiceStatusId' => $invoiceStatusId,
            'companyId' => $this->input->post('company_id')
        );
        $this->db->insert('purchasemaster', $data1);

        //Query purchaseMasterId
        $query1=$this->db->query("SELECT MAX( purchaseMasterId ) FROM purchasemaster ");
        $row1 = $query1->row_array();
        $purchaseMasterId=$row1['MAX( purchaseMasterId )'];

        //====================5th tbl ProductBatch update only
        for($i=1;$i<=$count;$i++){
            $product_name=$this->input->post('product_name'.$i);

            $data5 = array(
                'purchaseRate' => $this->input->post('rate'.$i),
                'salesRate' => $this->input->post('sale_rate'.$i),
            );

            $salerate=$this->input->post('sale_rate'.$i);

            if(!empty($salerate) || $salerate!=0){
                $this->db->where('productId', $product_name);
                $this->db->update('productbatch', $data5);
              }

            //Query productBatchId
            $query2=$this->db->query("SELECT productBatchId FROM productbatch WHERE productId='$product_name'");
            $row2 = $query2->row_array();
            $productBatchId=$row2['productBatchId'];
            $productBatchIdall[]=$productBatchId;
        }
        array_unshift($productBatchIdall , 'item1');

        //===================2nd tbl PurchaseDetails
        for($i=1;$i<=$count;$i++){
            $data2 = array(
                'purchaseMasterId' =>$purchaseMasterId ,
                'productBatchId' => $productBatchIdall[$i],
                'rate' => $this->input->post('rate'.$i),
                'qty' => $this->input->post('qty'.$i),
                'discount' => $this->input->post('discountsingle'.$i),
                'taxPercentage' => $this->input->post('vat'.$i),
                'taxIncludedOrNot' =>1,
                'companyId' => $this->input->post('company_id')
            );
            $this->db->insert('purchasedetails', $data2);
         }

        //3rd tbl ledgerposting
        $data31 = array(
            'voucherNumber' => $purchaseMasterId,
            'ledgerId' => 1,
            'voucherType' => "Purchase Invoice",
            'debit' => $this->input->post('net_amout'),
            'credit' => 0,
            'description' =>"By purchase",
            'date' => $this->input->post('invoice_date'),
            'companyId' => $this->input->post('company_id')
        );
        $data32 = array(
            'voucherNumber' => $purchaseMasterId,
            'ledgerId' => $this->input->post('corparty_account'),
            'voucherType' => "Purchase Invoice",
            'debit' => 0,
            'credit' => $this->input->post('net_amout'),
            'description' =>"By purchase",
            'date' => $this->input->post('invoice_date'),
            'companyId' => $this->input->post('company_id')
        );
        $this->db->insert('ledgerposting', $data31);
        $this->db->insert('ledgerposting', $data32);


        //4th table stockposting
        for($i=1;$i<=$count;$i++){
        $data4 = array(
            'voucherNumber' => $purchaseMasterId,
            'productBatchId' => $productBatchIdall[$i],
            'inwardQuantity' => $this->input->post('qty'.$i),
            'outwardQuantity' => 0,
            'voucherType' =>"Purchase Invoice",
            'date' => $this->input->post('invoice_date'),
            'unitId' => $this->input->post('unit'.$i),
            'rate' => $this->input->post('rate'.$i),
            'defaultInwardQuantity' => $this->input->post('qty'.$i),
            'defaultOutwardQuantity' => 0,
            'companyId' => $this->input->post('company_id')
        );
       $this->db->insert('stockposting', $data4);
        }

        //6th PartyBalance
        if($this->input->post('corparty_account')!=2){
        $data6 = array(
            'date' => $this->input->post('invoice_date'),
            'ledgerId' => $this->input->post('corparty_account'),
            'voucherType' => "Purchase Invoice",
            'voucherNo' => $purchaseMasterId,
            'againstVoucherType' => "NA",
            'againstvoucherNo' =>"NA",
            'referenceType' => "New",
            'debit' => 0,
            'credit' => $this->input->post('net_amout'),
            'optional' => 0,
            'creditPeriod' => 0,
            'branchId' => 1,
            'extraDate' => date('m-d-Y h:i:s a', time()),
            'currecyConversionId' => 1,
            'companyId' => $this->input->post('company_id')
        );
        $this->db->insert('partybalance', $data6);
        }
    }

    //================================================================edit data========================================================================================//
    //edit data
    // single row info
//        $this->input->post('count_product');
//        $this->input->post('purchaseDetailsId1');
//        $this->input->post('product_id1');
//        $this->input->post('qty1');
//        $this->input->post('unit_id1');
//        $this->input->post('rate1');
//        $this->input->post('salerate1');
//        $this->input->post('vat1');
    //common  data
//        $this->input->post('purchaseMasterId');
//        $this->input->post('company_id');
//        $this->input->post('invoice_date');
//        $this->input->post('due_days');
//        $this->input->post('invoive_number');
//        $this->input->post('corparty_account');
//        //net info
//        $this->input->post('total_amout');
//        $this->input->post('total_vat');
//        $this->input->post('grandtotal');
//        $this->input->post('discount');
//        $this->input->post('net_amout');
//        $this->input->post('description');
    function editPurchase(){

        $count=$this->input->post('count_product');
        $purchaseMasterId=$this->input->post('purchaseMasterId');

        //===================1st tbl PurchaseMaster
        if($this->input->post('corparty_account')==2){
            $invoiceStatusId=1;
        }else{
            $invoiceStatusId=3;
        }
        $invoive_number=$this->input->post('invoive_number');
        $data1 = array(
            'date' => $this->input->post('invoice_date'),
            'ledgerId' => $this->input->post('corparty_account'),
            'dueDays' => $this->input->post('due_days'),
            'purchaseInvoiceNo' => $invoive_number,
            'billDiscount' => $this->input->post('discount'),
            'description' =>$this->input->post('description'),
            'amount' => $this->input->post('net_amout'),
            'invoiceStatusId' => $invoiceStatusId,
            'companyId' => $this->input->post('company_id')
        );

        $this->db->where('purchaseMasterId', $purchaseMasterId);
        $this->db->update('purchasemaster', $data1);

        //====================5th tbl ProductBatch update only
        for($i=1;$i<=$count;$i++){
            $product_name=$this->input->post('product_id'.$i);

            $salerate=$this->input->post('sale_rate'.$i);

            if(!empty($salerate) || $salerate!=0){
            $data5 = array(
                'purchaseRate' => $this->input->post('rate'.$i),
                'salesRate' => $this->input->post('sale_rate'.$i),
            );
            $this->db->where('productId', $product_name);
            $this->db->update('productbatch', $data5);
            }

            //Query productBatchId
            $query2=$this->db->query("SELECT productBatchId FROM productbatch WHERE productId='$product_name'");
            $row2 = $query2->row_array();
            $productBatchId=$row2['productBatchId'];
            $productBatchIdall[]=$productBatchId;
        }
        array_unshift($productBatchIdall,'item1');

        //===================2nd tbl PurchaseDetails

        for($i=1;$i<=$count;$i++){
            $purchaseDetailsId[$i]=$this->input->post('purchaseDetailsId'.$i);
            $data2 = array(
                'purchaseMasterId' =>$purchaseMasterId ,
                'productBatchId' => $productBatchIdall[$i],
                'rate' => $this->input->post('rate'.$i),
                'qty' => $this->input->post('qty'.$i),
                'discount' => $this->input->post('discountsingle'.$i),
                'taxPercentage' => $this->input->post('vat'.$i),
                'taxIncludedOrNot' =>1,
                'companyId' => $this->input->post('company_id')
            );
            $this->db->where('purchaseDetailsId', $purchaseDetailsId[$i]);
            $this->db->update('purchasedetails', $data2);
        }

        //3rd tbl ledgerposting
        $data31 = array(
            'voucherNumber' => $purchaseMasterId,
            'ledgerId' => 1,
            'voucherType' => "Purchase Invoice",
            'debit' => $this->input->post('net_amout'),
            'credit' => 0,
            'description' =>"By purchase",
            'date' => $this->input->post('invoice_date'),
            'companyId' => $this->input->post('company_id')
        );
        $data32 = array(
            'voucherNumber' => $purchaseMasterId,
            'ledgerId' => $this->input->post('corparty_account'),
            'voucherType' => "Purchase Invoice",
            'debit' => 0,
            'credit' => $this->input->post('net_amout'),
            'description' =>"By purchase",
            'date' => $this->input->post('invoice_date'),
            'companyId' => $this->input->post('company_id')
        );
        $this->db->where('voucherNumber', $purchaseMasterId);
        $this->db->where('credit',0);
        $this->db->update('ledgerposting', $data31);
        $this->db->where('voucherNumber', $purchaseMasterId);
        $this->db->where('debit', 0);
        $this->db->update('ledgerposting', $data32);


        //4th table stockposting
        for($i=1;$i<=$count;$i++){
            $purchaseDetailsId[$i]=$this->input->post('purchaseDetailsId'.$i);
            $data4 = array(
                'voucherNumber' => $purchaseMasterId,
                'productBatchId' => $productBatchIdall[$i],
                'inwardQuantity' => $this->input->post('qty'.$i),
                'outwardQuantity' => 0,
                'voucherType' =>"Purchase Invoice",
                'date' => $this->input->post('invoice_date'),
                'unitId' => $this->input->post('unit_id'.$i),
                'rate' => $this->input->post('rate'.$i),
                'defaultInwardQuantity' => $this->input->post('qty'.$i),
                'defaultOutwardQuantity' => 0,
                'companyId' => $this->input->post('company_id')
            );
            $this->db->where('serialNumber', $purchaseDetailsId[$i]);
            $this->db->update('stockposting', $data4);
        }

        //6th PartyBalance
        if($this->input->post('corparty_account')!=2){
            $data6 = array(
                'date' => $this->input->post('invoice_date'),
                'ledgerId' => $this->input->post('corparty_account'),
                'voucherType' => "Purchase Invoice",
                'voucherNo' => $purchaseMasterId,
                'againstVoucherType' => "NA",
                'againstvoucherNo' =>"NA",
                'referenceType' => "New",
                'debit' => 0,
                'credit' => $this->input->post('net_amout'),
                'optional' => 0,
                'creditPeriod' => 0,
                'branchId' => 1,
                'extraDate' => date('m-d-Y h:i:s a', time()),
                'currecyConversionId' => 1,
                'companyId' => $this->input->post('company_id')
            );
            $this->db->where('voucherNo', $purchaseMasterId);
            $this->db->update('partybalance', $data6);
        }
    }


    public function purchaseNameCheck()
    {
        $purchaseName = $this->input->post('suppname');
        $queryresult = $this->db->query("select * from accountledger where 	acccountLedgerName = '$purchaseName'");
        if ($queryresult->num_rows() > 0):
            return 'false';
        else:
            return 'true';
        endif;
    }
}

?>