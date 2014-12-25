<style>
    .clickable a{
        width:100%;
        display:block;
    }   
</style>
<section id="main-content">
    <section class="wrapper site-min-height">    
        <section class="panel">
            <header class="panel-heading">
                Receipt Voucher
            </header>
            <div class="panel-body">
                <div class="adv-table">
                    <div class="clearfix">
                        <div class="btn-group pull-right">
                            <a href="<?php echo site_url('receiptvoucher/receiptvoucher/addreceiptvoucher'); ?>">
                                <button  class="btn btn-info">
                                    Add New <i class="fa fa-plus"></i>
                                </button>
                            </a>
                        </div>                        
                    </div> 
                    <?php if ($this->session->userdata('success')): ?>
                        <div class="alert alert-block alert-success fade in">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            <strong>Success!</strong> <?php
                            echo $this->session->userdata('success');
                            $this->session->unset_userdata('success');
                            ?>
                        </div> 
                    <?php endif; ?>
                    <table  class="display table table-bordered table-striped" id="cloudAccounting">
                        <thead>
                            <tr>
                                <th></th>                                
                                <th>Voucher No</th>
                                <th>Received From</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (sizeof($sortalldata) > 0):
                                foreach ($sortalldata as $rows):
                                    ?>
                                    <tr class="table_hand">
                                        <td><a data-toggle="modal" href="#myModaldelete<?php echo $rows->receiptMasterId ?>">
                                                <i class="fa fa-times-circle delete-icon"></i></a>
                                        </td>
                                        <td class="clickable"> <a href="<?php echo site_url('receiptvoucher/receiptvoucher/editreceiptvoucher/' . $rows->receiptMasterId) ?>"><?php echo $rows->receiptMasterId ?></a></td>
                                        <td class="clickable"> <a href="<?php echo site_url('receiptvoucher/receiptvoucher/editreceiptvoucher/' . $rows->receiptMasterId) ?>">
                                                <?php
                                                foreach ($ledger as $value) :
                                                    if ($rows->ledgerId == $value->ledgerId) {
                                                        echo $value->acccountLedgerName;
                                                    }
                                                endforeach;
                                                ?>
                                            </a></td>                                      
                                        <td class="clickable"> <a href="<?php echo site_url('receiptvoucher/receiptvoucher/editreceiptvoucher/' . $rows->receiptMasterId) ?>"><?php echo $rows->amount ?></a></td>
                                        <td class="clickable"> <a href="<?php echo site_url('receiptvoucher/receiptvoucher/editreceiptvoucher/' . $rows->receiptMasterId) ?>">
                                                <?php
                                                $query = $this->db->query("Select * from receiptmaster where receiptMasterId='$rows->receiptMasterId'");
                                                if ($query->num_rows() > 0):
                                                    echo $query->row()->date;
                                                else:
                                                    echo 'Undefined';
                                                endif;
                                                ?></a></td>                                                                        
                                    </tr>
                                    <!--Start Modal Delete Data -->
                                <div class="modal fade" id="myModaldelete<?php echo $rows->receiptMasterId; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form class="cmxform form-horizontal tasi-form" id="delpaymentvou<?php echo $rows->receiptMasterId; ?>" method="post" action="<?php echo site_url('receiptvoucher/receiptvoucher/deletereceiptvou') ?>">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">Delete message</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="panel-body">
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <h5><i class="fa fa-warning"></i>&nbsp; Are You Sure You Want To Delete The Receipt Voucher :&nbsp;&nbsp;<?php echo $rows->receiptMasterId; ?></h5>
                                                                    <input id="receiptMasterId" name="receiptMasterId" type=hidden value="<?php echo $rows->receiptMasterId; ?>" />
                                                                    <input id="ledgerId" name="ledgerId" type=hidden value="<?php echo $rows->ledgerId ?>" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-danger" >YES</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--end delete modal-->
                                <?php
                            endforeach;
                        endif;
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </section>
</section>