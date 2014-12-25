<style>
    .form-control {
        margin-left: 0px;

    }
    .custom{
        padding-left: 35px;
    }
    .custom-form label{
        margin-top: -5px !important;
    }
    ul.amounts li {
        background: none repeat scroll 0 0 #f5f5f5;
        border-radius: 4px;
        float: left;
        font-weight: 300;
        margin-bottom: 5px;
        margin-right: 2%;
        padding: 8px;
        width: 48%;
    }
    ul.amounts li.last {

    }
    #discount {
        height: 19px;
        padding: 1px 6px;
        width: 80px !important;
    }
    .final-submit {
        margin-right: 15px;
    }
    .edit-table td {
        cursor: pointer;
    }
    .purchase-top .form-group{
        margin-bottom: -5px;
    }
    .label_radio {
        margin-right: 10px;
        position: relative;
        top: -10px;
    }
</style>
<form action="<?php echo site_url('sales/sales/edit'); ?>" method="post" class="form-horizontal custom-form" role="form">
<!--main content start-->
<section id="main-content">
<section class="wrapper site-min-height">
<!-- page start-->
<section class="panel">
    <header class="panel-heading">
        Edit  Sales Information
    </header>
    <div class="panel-body">
        <div class="adv-table">
            <div class="clearfix">
                <div class="btn-group pull-right">
                    <br/>
                </div>
            </div>
            <?php if(isset($salesmasterinfo)):
            foreach($salesmasterinfo as $salesmaster):?>
            <div class="row purchase-top">

                <div class="form-group col-sm-4">
                    <label for="corparty_account" class="col-sm-4 control-label custom">Cash/Party </label>
                    <div class="col-sm-8">
                        <select class="form-control" name="corparty_account" id="corparty_account">
                            <?php
                            if(isset($supplierinfo1)){
                                foreach($supplierinfo1 as $supplier){
                                if($supplier->ledgerId==$salesmaster->ledgerId){
                                echo '<option value="'.$supplier->ledgerId.'" selected>'.$supplier->acccountLedgerName.'</option>';
                                }
                                }
                            }
                            if($salesmaster->ledgerId==2){
                                echo '<option value="2" selected>Cash Account</option>';
                            }
                            if($salesmaster->ledgerId!=2){
                                echo '<option value="2">Cash Account</option>';
                            }?>
                            <?php
                            if(isset($supplierinfo1)){
                                foreach($supplierinfo1 as $supplier){
                                    if($supplier->ledgerId!=$salesmaster->ledgerId){
                                        echo '<option value="'.$supplier->ledgerId.'">'.$supplier->acccountLedgerName.'</option>';
                                    }
                                }
                            }?>
                            <option value="3newone" id="newsupplier">Add New Customer</option>
                        </select>
                        <input  id="company_id"  name="company_id" type="hidden" value="<?php echo $company_id;?>"/>
                        <input  id="salesMasterId"  name="salesMasterId" type="hidden" value="<?php echo $this->input->get('id');?>"/>
                    </div>
                </div>
                <div class="form-group col-sm-3">
                    <label for="invoice_data" class="col-sm-4 control-label text-left"> Date</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="invoice_date" value="<?php echo $salesmaster->date;?>" id="datetimepicker" readonly/>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <div class="col-md-6">
                        <div class="radios">
                            <label class="label_radio r_on pull-left">
                                <input name="cash_cr" id="cash" class="cash_cr" value="Cash" type="radio" <?php echo ($salesmaster->description=='Cash')?"checked":"";?>> Cash
                            </label>
                            <label class="label_radio r_off pull-left">
                                <input name="cash_cr" id="credit" class="cash_cr" value="Credit" type="radio" <?php echo ($salesmaster->description=='Credit')?"checked":"";?>> Credit
                            </label>
                        </div>
                    </div>
                    <div class="credit_period">
                        <label for="credit_period" class="col-md-3 control-label text-left">Credit Period</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="credit_period" id="credit_period" value="<?php echo ($salesmaster->description=="Credit")?$salesmaster->creditPeriod:0;?>">
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <label for="order_no" class="col-md-4 control-label text-left">Order No</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="order_no" id="order_no" value="<?php echo $salesmaster->orderNo;?>" required>
                        <span id="servermsg"></span>
                    </div>
                </div>
                <?php endforeach;endif;?>
                </div>
                <hr/>
                <!--       ============================ PART 2====================================================-->
                <div class="row">
                <div class="form-group col-sm-4 clear">
                    <label for="product_name" class="col-sm-4 control-label custom">Product </label>
                    <div class="col-sm-8">
                        <select class="form-control" name="product_name" id="product_name">
                            <option value="">Select One</option>
                            <?php
                            if(isset($productinfo)){
                                foreach($productinfo as $product){
                                    echo '<option value="'.$product->productId.'">'.$product->productName.'</option>';
                                }

                            }?>
                            <input name="count" id="count" value="" type="hidden"/>
                        </select>
                    </div>
                </div>
                <div class="form-group col-sm-3">
                    <label for="unit" class="col-sm-4 control-label text-left">Unit</label>
                    <div class="col-sm-8">
                        <input type="hidden" class="form-control" name="unit" id="unit" placeholder="Unit">
                        <input type="text" class="form-control"  id="unitshow" placeholder="Unit" readonly>
                    </div>
                </div>
                <div class="form-group col-sm-2">
                    <label for="qtyi" class="col-sm-4 control-label text-left">Qty</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="qtyi" id="qtyi" placeholder="Qty">
                        <span id="qtymsg"></span>
                    </div>
                </div>
                <div class="form-group col-sm-3">
                    <label for="ratei" class="col-sm-4 control-label text-left">Sale Rate</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="ratei" id="ratei" placeholder="Rate">
                    </div>
                </div>
                </div>
                 <div class="row">
                 <div class="form-group col-md-4">
                     <label for="discountsinglei" class="col-md-4 control-label text-left custom">Discount%</label>
                     <div class="col-md-8">
                         <input type="text" class="form-control" name="discountsinglei" id="discountsinglei" placeholder="Discount%">
                     </div>
                 </div>
                <div class="form-group col-sm-3">
                    <label for="vati" class="col-sm-4 control-label text-left">VAT%</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="vati" id="vati" placeholder="VAT%">
                    </div>
                </div>
                <div class="form-group col-sm-3">
                    <div class="col-sm-12">
                        <button type="button" id="addpurchase" class="btn btn-default">Edit</button>
                        <button type="button" id="product-reset"  class="btn btn-default">Clear</button>
                    </div>
                </div>
                <!--     ================================   END 2nd part input=========================-->
            </div>



            <table class="display table table-bordered table-striped edit-table" id="cloudAccounting1">
                <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Qty</th>
                    <th>Unit</th>
                    <th>Rate</th>
                    <th>Discount%</th>
                    <th>VAT%</th>
                    <th>Amount</th>

                </tr>
                </thead>
                <tbody id="addnewrowedit">
                    <?php if(isset($ratequalityvat) && isset($products)):
                        $count=0;
                        foreach($ratequalityvat as $rqv):
                            $count=$count+1;
                            ?>

                        <tr class="single_row" id="<?php echo $count;?>">
                            <td>
                                <?php  //product name
                                echo  '<input name="purchaseDetailsId'.$count.'" id="purchaseDetailsId'.$count.'" value="'.$rqv->salesDetailsId.'" type="hidden"/>';
                                echo  '<input name="count_product" id="count_product" value="'.$count_product.'" type="hidden"/>';
                                foreach($products as $product){
                                    $batchid=$product->productBatchId;
                                    $salesRate=$product->salesRate;
                                    $productId=$product->productId;
                                    if($batchid==$rqv->productBatchId){
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
                                ?>
                            </td>
                            <td><?php //qty
                                echo '<input name="qty'.$count.'" id="qty'.$count.'" value="'.$rqv->qty.'" type="hidden"/>'.'<span class="qty'.$count.'">'.$rqv->qty.'</span>';  //Input field
                                ?>
                            </td>
                            <td><?php //Unit name
                                echo '<input name="unit_id'.$count.'" id="unit_id'.$count.'" value="'.$rqv->unitId.'" type="hidden"/>';  //Input field
                                foreach($unitinfo as $unit){
                                    $unitid=$unit->unitId;
                                    $unitName=$unit->unitName;
                                    if($unitid==$rqv->unitId){
                                        echo '<span class="unit_id'.$count.'">'.$unitName.'</span>';
                                    }
                                }
                                ?>
                            </td>
                            <td><?php //rate
                                echo '<input name="rate'.$count.'" id="rate'.$count.'" value="'.$rqv->rate.'" type="hidden"/>'.'<span class="rate'.$count.'">'.$rqv->rate.'</span>'; //Input field
                                ?>
                            </td>
                            <td><?php //Discount
                                echo '<input name="discountsingle'.$count.'" id="discountsingle'.$count.'" value="'.$rqv->discount.'" type="hidden"/>'.'<span class="discountsingle'.$count.'">'.$rqv->discount.'</span>'; //Input field
                                ?>
                            </td>
                            <td><?php //vat
                                echo '<input name="vat'.$count.'" id="vat'.$count.'" value="'.$rqv->taxPercentage.'" type="hidden"/>'.'<span class="vat'.$count.'">'.$rqv->taxPercentage.'</span>'; //Input field
                                ?>
                            </td>
                            <td><?php
                                //Net amount per product
                                $qtyrate=$rqv->qty * $rqv->rate;
                                $vatamount=($qtyrate-$qtyrate*($rqv->discount/100)) * ($rqv->taxPercentage/100); //Vat amount
                                $amount= $qtyrate-($qtyrate*($rqv->discount/100));  //Amount
                                $grandtotal= $amount + $vatamount;  //total amount
                                echo '<span id="product_amount'.$count.'">'.$grandtotal.'</span>'; //Input field
                                ?>
                            </td>
                        </tr>

                    <?php

                        endforeach;
                      //  }
                    endif;?>


                </tbody>
            </table>

            <div class="panel-body">
                <div class="row">
                    <?php if(isset($salesmasterinfo)):
                    foreach($salesmasterinfo as $salesmaster):?>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="description" class="col-sm-3 control-label">Description</label>
                            <div class="col-sm-9">
                                <textarea name="description" id="description" cols="30" rows="5"><?php echo $salesmaster->description;?></textarea>
                            </div>
                        </div>

                    </div>
                    <?php endforeach;endif;?>
                    <div class="col-sm-6 col-sm-offset-2">
                        <ul class="unstyled amounts">
                            <li class="text-center"><strong>Total Amount : </strong><span id="total_amout" class="align-right "> 0.00 </span> <input name="total_amout" class="total_amout" type="hidden"/></li>
                            <li class="text-center"><strong>VAT Amount :</strong> <span id="total_vat" class="align-right ">0.00</span><input name="total_vat" class="total_vat" type="hidden"/></li>
                            <li style="display: none" class="text-center"><strong>Grand Total :</strong> <span  id="grandtotal" class="align-right ">0.00</span><input name="grandtotal" class="grandtotal" type="hidden"/></li>
                            <?php if(isset($salesmasterinfo)):
                            foreach($salesmasterinfo as $salesmaster):?>
                            <li class="text-center last"><strong>Discount :</strong> <span class="align-right ">
                                        <input type="text" name="discount" id="discount" style="width: 40px" value="<?php echo $salesmaster->billDiscount;?>"/></span></li>
                            <li class="text-center"><strong>Net Amount :</strong> <span id="net_amout" class="align-right "><?php echo $salesmaster->amount;?></span><input name="net_amout" class="net_amout" value="<?php echo $salesmaster->amount;?>" type="hidden"/></li>
                            <?php endforeach;endif;?>
                        </ul>
                        <div class="final-submit pull-right">
                                <button type="submit" id="addpurchase_submit"  class="btn btn-default">Update</button>
                            <a href="<?php echo site_url('purchase/purchase'); ?>"><button type="button" id="newrow" class="btn btn-default">Cancel</button></a>
                        </div>

                    </div>

                </div>
            </div>
        </div>


    </div>
</section>
<!-- page end-->
</section>
</section>
</form>
<!--main content end-->



<!-------------------------Add New Customer------------------------------------->
<div class="modal fade" id="myModalnews" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel" align="Center">Add Customer Information</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form class="cmxform form-horizontal tasi-form" id="customer_add" method="post" action="#">
                            <div class="panel-body">
                                <div class="form-group ">
                                    <label for="customer_name" class="control-label col-lg-4">Customer Name</label>
                                    <div class="col-lg-8">
                                        <input class=" form-control" id="customer_name1" name="customer_name"
                                               type="text" onchange="return customerNameCheck()" value="" required/>
                                        <span id="servermsg2"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group ">
                                    <label for="address" class="control-label col-lg-4">Address</label>

                                    <div class="col-lg-8">
                                        <input class=" form-control" id="address1" name="address" type="text"/>
                                        <input  id="company_id1"  name="company_id" type="hidden" value="<?php echo $company_id; ?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group ">
                                    <label for="phone" class="control-label col-lg-4">Phone</label>

                                    <div class="col-lg-8">
                                        <input class="form-control " id="phone1" name="phone" type="text"/>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group ">
                                    <label for="mobile" class="control-label col-lg-4">Mobile</label>

                                    <div class="col-lg-8">
                                        <input class="form-control " id="mobile1" name="mobile" type="text"/>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">

                                <div class="form-group ">
                                    <label for="email" class="control-label col-lg-4">Email</label>

                                    <div class="col-lg-8">
                                        <input class="form-control " id="email1" name="email" type="email"/>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group ">
                                    <label for="opening_balance" class="control-label col-lg-4 ">Opening Balance</label>

                                    <div class="col-lg-5">
                                        <input class="form-control " type="text" id="opening_balance1" placeholder="0.00"
                                               name="opening_balance"/>

                                    </div>
                                    <div class="col-lg-2 ">
                                        <select name="dr_cr" id="dr_cr1" class="customer_debit pull-right">
                                            <option value="1">Dr</option>
                                            <option value="0">Cr</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group ">
                                    <label for="description" class="control-label col-lg-4">Description</label>

                                    <div class="col-lg-8 col-sm-8">
                                        <textarea class="form-control" id="description1" name="description" cols="30" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="submitaddcustomer" class="btn btn-primary">Save</button>
                <button type="reset" class="btn btn-info">Reset</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="modalcloseforaddcustomer()">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>