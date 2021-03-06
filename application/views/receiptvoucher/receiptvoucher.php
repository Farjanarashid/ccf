
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->       
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Receipt Voucher
                    </header>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <section class="panel">                    
                                    <div class="panel-body">
                                        <div class="col-lg-6">
                                            <span>
                                                <div class="radio">
                                                    <label>
                                                       Cash Receipt
                                                        <input type="radio" class="radiobutton" name="optionsRadios" id="optionsRadios1" value="ByCash" checked/>
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" class="radiobutton" name="optionsRadios" id="optionsRadios2" value="ByCheque"/>                                                        
                                                       Bank Receipt
                                                    </label>
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                </section>                    
                            </div>
                        </div>                        
                        <form class="form-horizontal" role="form" method="post" action="<?php echo site_url('receiptvoucher/receiptvoucher/addreceiptmaster') ?>">
                            <div class="col-lg-6">                                
                                <div class="form-group">
                                    <label for="receiptMode" class="col-lg-5 col-sm-2 control-label">Cash/Bank Account</label>
                                    <div class="col-lg-6">
                                        <div id="banknames"> 
                                            <select class="form-control"></select>
                                        </div>
                                        <span id="grpmsg"></span>
                                    </div>                                   
                                </div>
                                <div class="form-group">
                                    <label for="paidto" class="col-lg-5 col-sm-2 control-label">Received From</label>
                                    <div class="col-lg-6">
                                        <div id="paidto"> 
                                            <select class="form-control"></select>
                                        </div>                                  
                                    </div>                                   
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-5 col-sm-2 control-label">Current Balance</label>
                                    <div class="col-lg-3" > 
                                        <input type="text" class="form-control" id="currentbalance" name="currentbalance" readonly >
                                    </div>
                                    <div class="col-lg-2"> 
                                        <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#myModalagnst" >Against</button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="amount" class="col-lg-5 col-sm-2 control-label">Amount</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="amount" name="amount"  readonly>
                                        <input type="hidden" class="form-control" id="voucherNumber" name="voucherNumber" >
                                        <input type="hidden" class="form-control" id="referenceType" name="referenceType" >
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="col-lg-5 col-sm-2 control-label"> Date</label>
                                    <div class="col-lg-6">                                        
                                        <input type="text" id="date" name="date" class="form_datetime form-control"/>                                                                                  
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-5 col-sm-2 control-label">Description</label>
                                    <div class="col-lg-6">
                                        <textarea type="text" class="form-control" id="description" name="description" ></textarea>                                    
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="chequeNumber" class="col-lg-5 col-sm-2 control-label">Cheque Number</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="chequeNumber" name="chequeNumber" />                                    
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="chequeDate" class="col-lg-5 col-sm-2 control-label">Cheque Date</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form_datetime form-control" id="chequeDate"  name="chequeDate" />                                    
                                    </div>
                                </div>                               
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-4">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <button type="reset" class="btn btn-info">Reset</button>
                                    <button type="button" class="btn btn-default">Close</button>
                                </div>
                            </div>
                        </form>                        
                    </div>
                </section>
            </div>
        </div>
    </section>
</section>
<!-------------------------Add New supplier------------------------------------->
<div class="modal fade" id="myModalsup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel" align="Center">Add Supplier Information</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form class="cmxform form-horizontal tasi-form" id="supplier_add" method="post" action="<?php echo site_url('supplier/add');?>">
                            <div class="panel-body">
                                <div class="form-group ">
                                    <label for="supplier_name" class="control-label col-lg-4">Supplier Name</label>

                                    <div class="col-lg-8">
                                        <input class=" form-control" id="supplier_name1" name="supplier_name"  type="text" onchange="return supplierNameCheck()" value=""/>
                                        <input class=" form-control" id="receiptvouModal" name="receiptvouModal"  type="hidden"  value="addreceiptvouModal"/>
                                         <span id="servermsg"></span>
                                     </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group ">
                                    <label for="address" class="control-label col-lg-4">Address</label>

                                    <div class="col-lg-8">
                                        <input class=" form-control" id="address1" name="address" type="text"/>                                        
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group ">
                                    <label for="country" class="control-label col-lg-4">Country</label>

                                    <div class="col-lg-4">
                                        <select class=" form-control" id="country1" name="country">
                                            <?php
                                            if (isset($countries)) {
                                                foreach ($countries as $country) {
                                                    echo "<option value='" . $country->country_name . "'>$country->country_name</option>";
                                                }
                                            }
                                            ?>

                                        </select>
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
                                        <select name="dr_cr" id="dr_cr1" class="supplier_debit pull-right">
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
                                        <textarea class="form-control " id="description1" name="description" cols="30" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="submitaddsupplier">Save</button>
                <button type="reset" class="btn btn-info">Reset</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!--End of supplier-->
<!--Add against -->
<div class="modal fade" id="myModalagnst" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel" align="Center">Party balance</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form class="cmxform form-horizontal tasi-form" id="aganstfrm" name="aganstfrm" method="post" action="">
                            <div class="panel-body">
                                <div class="form-group ">
                                    <label for="supplier_name" class="control-label col-lg-4">Reference </label>
                                    <div class="col-lg-8">                                       
                                        <select class="form-control" id="agnstornew" name="agnstornew" onchange="return vouinfo()">
                                            <option> Select </option>
                                            <option value="Against"> Against</option>
                                            <option value="New"> New</option>
                                        </select>                                       
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group ">
                                    <label for="address" class="control-label col-lg-4">Voucher Type</label>
                                    <div class="col-lg-8">
                                        <div id="voutype">
                                            <select class="form-control">                                          
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="amountpay" class="hidefields">
                                <div class="panel-body">
                                    <div class="form-group ">
                                        <label for="address" class="control-label col-lg-4">Purchase Voucher No </label>
                                        <div class="col-lg-8">
                                            <input class=" form-control" id="purchaseid" name="purchaseid" type="text" readonly/>                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group ">
                                        <label for="country" class="control-label col-lg-4">Pending Amount</label>
                                        <div class="col-lg-8">
                                            <input class=" form-control" id="fullamount" name="fullamount" type="text" readonly/>  
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group ">
                                        <label for="country" class="control-label col-lg-4">Amount</label>
                                        <div class="col-lg-8">
                                            <input class=" form-control" id="paidamount" name="paidamount" type="text"/>  
                                           <span id="pservermsg"></span>
                                        </div>                                      
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group ">
                                        <label for="phone" class="control-label col-lg-4">Dr/Cr</label>
                                        <div class="col-lg-8">
                                            <input class="form-control " id="drorcr" name="drorcr" type="text" value="Dr." readonly/>
                                        </div>
                                    </div>
                                </div>   
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" onclick="return amountbalance();">Done</button>
                                <button type="reset" class="btn btn-info">Reset</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>