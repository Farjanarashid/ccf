<style>
    .form-control {
        margin-left: 0px;
    }
    .edit_purchase{
        display: block;
        color: #111;
    }
</style>
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                Sales Farmer Information
            </header>
            <div class="panel-body">
                <div class="adv-table">
                    <div class="clearfix">
                        <div class="btn-group pull-right">
                            <br/>
                            <a href="<?php echo site_url('salesfarmer/salesfarmer/add_view'); ?>">
                                <button class="btn btn-info" >
                                    Add New <i class="fa fa-plus"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                    <table class="display table table-bordered table-striped" id="cloudAccounting">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Invoice No</th>
                            <th>Ledger</th>
                            <th>Amount</th>
                            <th>Date</th>

                        </tr>
                        </thead>
                        <tbody>

                        <?php if (isset($salesmasterinfo)&& isset($accountledgerinfo)) {
                            foreach ($salesmasterinfo as $sales) {
                                ?>

                                <tr>
                                <td>
                                <a  data-toggle="modal" href="#myModaldelete<?php echo $sales->salesMasterId;?>">
                                <i  class="fa fa-times-circle delete-icon"></i></a>
                                </td>
                                <td><a class='edit_purchase' href='<?php echo site_url('salesfarmer/salesfarmer/add_view_edit');?>?id=<?php echo $sales->salesMasterId;?>'><?php echo $sales->salesInvoiceNo;?></a> </td>
                                <td><a class='edit_purchase' href='<?php echo site_url('salesfarmer/salesfarmer/add_view_edit');?>?id=<?php echo $sales->salesMasterId;?>'> <?php
                                       foreach($accountledgerinfo as $accountledger){
                                           $name=$accountledger->acccountLedgerName;
                                           $ledgerid=$accountledger->ledgerId;
                                           echo ($sales->ledgerId==$ledgerid)?$name:"";
                                       }?></a> </td>
                                <td><a class='edit_purchase' href='<?php echo site_url('salesfarmer/salesfarmer/add_view_edit');?>?id=<?php echo $sales->salesMasterId;?>'><?php echo $sales->amount;?></a> </td>
                                <td><a class='edit_purchase' href='<?php echo site_url('salesfarmer/salesfarmer/add_view_edit');?>?id=<?php echo $sales->salesMasterId;?>'><?php echo $sales->date;?></a> </td>
<!--                                <td><a class='edit_purchase' href='--><?php //echo site_url('purchase/purchase/add_view_edit');?><!--?id=--><?php //echo $sales->salesMasterId;?><!--'>--><?php //foreach($invoicestatus as $status){if($status->invoiceStatusId==$sales->invoiceStatusId){echo $status->Description;}}?><!--</a> </td>-->

                                </tr>
                        <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--=======================================================Modal for Delete data ===================================-->
<?php  if (isset($salesmasterinfo)&& isset($accountledgerinfo)) {
        foreach ($salesmasterinfo as $sales) {
        ?>
        <div class="modal fade" id="myModaldelete<?php echo $sales->salesMasterId; ?>" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                                class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel" align="Center">Alert</h4>
                    </div>
                    <form method="POST" action="<?php echo site_url('salesfarmer/salesfarmer/delete'); ?>">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <section class="panel">
                                        <div class="panel-body">
                                            <div class="form">
                                                <h4>Are you sure you want to void the Sales invoice :
                                                    <b><?php echo $sales->salesMasterId;?></b>
                                                      ?</h4>
                                                <input type="hidden" name="salesMasterId"
                                                       value="<?php echo $sales->salesMasterId;?>">
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Delete</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
    <?php
    }
}?>
