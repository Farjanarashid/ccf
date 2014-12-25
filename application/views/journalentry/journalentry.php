<style>
    .col-lg-3{
        padding-top: 3px;
    }
    .clickable a{
        width:100%;
        display:block;
    }   
</style>
<section id="main-content">
    <section class="wrapper site-min-height">    
        <section class="panel">
            <header class="panel-heading">
                Journal Entry
            </header>
            <div class="panel-body">
                <div class="adv-table">
                    <div class="clearfix">
                        <div class="btn-group pull-right">                           
                            <button  class="btn btn-info" data-toggle="modal" data-target="#myModal">
                                Add New <i class="fa fa-plus"></i>
                            </button>                          
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
                                <th>Date</th>
                                <th>Debit</th>
                                <th>Credit</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($sortalldata as $rows):
                                ?>
                                <tr class="table_hand">
                                    <td><a data-toggle="modal" href="#myModaldelete<?php echo $rows->journalMasterId ?>">
                                            <i class="fa fa-times-circle delete-icon"></i></a>
                                    </td>
                                    <td data-toggle="modal" href="#myModaledit<?php echo $rows->journalMasterId ?>"><?php echo $rows->journalMasterId ?></td>
                                    <td data-toggle="modal" href="#myModaledit<?php echo $rows->journalMasterId ?>"><?php echo $rows->date ?></td>
                                    <td data-toggle="modal" href="#myModaledit<?php echo $rows->journalMasterId ?>">
                                        <?php
                                        $cmpid = $this->sessiondata['companyid'];
                                        $id = $rows->journalMasterId;
                                        $query = $this->db->query("SELECT sum(debit) as debit ,sum(credit) as credit FROM `ledgerposting` where companyId='$cmpid' AND (voucherType='Journal entry'AND voucherNumber='$id')");
                                        if ($query->num_rows() > 0) {
                                            $value = $query->row();
                                            $debit = $value->debit;
                                            $credit = $value->credit;
                                        }
                                        ?><?php echo $debit ?></td>                                      
                                    <td data-toggle="modal" href="#myModaledit<?php $rows->journalMasterId ?>"><?php echo $credit ?></td>

                                </tr>
                                <!--Start Modal Delete Data -->
                            <div class="modal fade" id="myModaldelete<?php echo $rows->journalMasterId; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form class="cmxform form-horizontal tasi-form" id="delpaymentvou<?php echo $rows->journalMasterId; ?>" method="post" action="<?php echo site_url('journalentry/journalentry/deletejournalentry') ?>">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Delete message</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="panel-body">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <h5><i class="fa fa-warning"></i>&nbsp; Are You Sure You Want To Delete The Journal Entry :&nbsp;&nbsp;<?php echo $rows->journalMasterId; ?></h5>
                                                                <input id="journalMasterId" name="journalMasterId" type=hidden value="<?php echo $rows->journalMasterId; ?>" />                                                                    
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
                            <!--Edit Journal Entry Modal Start -->
                            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModaledit<?php echo $rows->journalMasterId ?>" class="modal fade">
                                <div class="modal-dialog">
                                    <form class="cmxform form-horizontal tasi-form" id="edit<?php echo $rows->journalMasterId ?>" method="post" action="<?php echo site_url('journalentry/journalentry/editjournal') ?>">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                <h4 class="modal-title">Edit Journal Entry</h4>
                                            </div>
                                            <div class="modal-body">  
                                                <div class="row">  

                                                    <div class="col-lg-12"> 
                                                        <div class="panel-body">
                                                            <div class="form-group">                                                                 
                                                                <div class="col-lg-4">
                                                                    <label  for="accountledger">Account Ledger</label>
                                                                </div>                                    
                                                                <div class="col-lg-3">
                                                                    <label  for="debit">Debit</label>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <label  for="credit">Credit</label>
                                                                </div>                                  
                                                            </div>                           
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12" style="padding-left: 0px;">
                                                        <div class="panel-body">
                                                            <div class="form-group" style="padding-top: 3px">   
                                                                <?php
                                                                $jmasterId = $rows->journalMasterId;
                                                                $this->sessiondata = $this->session->userdata('logindata');
                                                                $companyid = $this->sessiondata['companyid'];
                                                                $getidData = $this->db->query("select * from journaldetails where journalMasterId = '$jmasterId' AND companyId = '$companyid'");
                                                                $getidValues = $getidData->result();
                                                                $j = 0;
                                                                foreach ($getidValues as $idrows):
                                                                    ?>
                                                                    <div class="col-lg-4">
                                                                        <select class=" form-control" id="editfirst_ledgerId<?php echo $rows->journalMasterId ?>" name="editfirst_ledgerId<?php echo $rows->journalMasterId ?>">
                                                                            <option value="">Select</option>
                                                                            <?php
                                                                            foreach ($ledger as $value) {
                                                                                ?>                                                                                
                                                                                <option <?php
                                                                                if ($value->ledgerId == $idrows->ledgerId) {
                                                                                    echo 'selected';
                                                                                }
                                                                                ?> value="<?php echo $value->ledgerId; ?>"><?php echo $value->acccountLedgerName; ?></option>;
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                        </select>
                                                                    </div>                                    
                                                                    <div class="col-lg-3">
                                                                        <input type="text" id="editdebit" value="<?php echo $idrows->debit; ?>" name="editdebit[]" class="form-control editdebit<?php echo $jmasterId;?>"  placeholder="0.00" onchange="adddebitedit(<?php echo $jmasterId;?>)">
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <input type="text" id="editfirst_credit<?php echo $rows->journalMasterId ?>" value="<?php echo $idrows->credit; ?>" name="editcredit[]" class="form-control"  placeholder="0.00" onchange="addcredit()">
                                                                    </div> 
                                                                    <?php
                                                                    $j++;
                                                                endforeach;
                                                                ?>
                                                            </div>                           
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12" style="padding-left: 0px"> 
                                                        <div class="form-group">
                                                            &nbsp;
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12" style="padding-left: 0px;font-weight:700;"> 
                                                        <div class="panel-body">
                                                            <div class="form-group ">
                                                                <label for="opening_balance" style="font-weight:700;"class="control-label col-lg-4 ">Total</label>
                                                                <div class="col-lg-3">
                                                                    <input style="border:1px solid #0A0101" class="form-control " type="text" id="edittotal_debit<?php echo $rows->journalMasterId ?>" placeholder="0.00" value="<?php echo $debit ?>"
                                                                           name="edittotal_debit<?php echo $rows->journalMasterId ?>" readonly/>
                                                                </div>                               
                                                                <div class="col-lg-3 ">
                                                                    <input style="border:1px solid #0A0101" class="form-control " type="text" id="edittotal_credit<?php echo $rows->journalMasterId ?>" placeholder="0.00" value="<?php echo $credit ?>"
                                                                           name="edittotal_credit<?php echo $rows->journalMasterId ?>" readonly />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12" style="padding-left: 0px"> 
                                                        <div class="form-group">
                                                            &nbsp;
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12" style="padding-left: 0px">
                                                        <div class="panel-body">
                                                            <div class="form-group ">
                                                                <label for="opening_balance" class="control-label col-lg-4">Description</label>
                                                                <div class="col-lg-6">
                                                                    <textarea class="form-control " id="editdescription<?php echo $rows->journalMasterId ?>" name="editdescription<?php echo $rows->journalMasterId ?>" cols="30" rows="3"><?php echo $rows->description; ?></textarea>
                                                                </div>                               
                                                            </div>
                                                        </div>
                                                    </div>
                                                    &nbsp;
                                                    <div class="col-lg-12" style="padding-left: 0px"> 
                                                        <div class="form-group ">
                                                            <label for="opening_balance" class="control-label col-lg-4">Date</label>
                                                            <div class="col-lg-6">
                                                                <input class="form-control " id="editdate<?php echo $rows->journalMasterId ?>" name="editdate<?php echo $rows->journalMasterId ?>" value="<?php echo $rows->date; ?>"/>
                                                            </div>                               
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit"  class="btn btn-primary">Save</button>
                                                <button type="reset" class="btn btn-info">Clear</button>
                                                <button type="button" class="btn btn-default " data-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!--End of edit Modal -->
                            <?php
                        endforeach;
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </section>
</section>

<!--- Add New Journal Modal -->

<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
    <div class="modal-dialog">
        <form class="cmxform form-horizontal tasi-form" id="" method="post" action="<?php echo site_url('journalentry/journalentry/addjournal') ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 class="modal-title">Add Journal Entry</h4>
                </div>
                <div class="modal-body">  
                    <div class="row">    

                        <div class="col-lg-12"> 
                            <div class="panel-body">
                                <div class="form-group">                                                                 
                                    <div class="col-lg-4">
                                        <label  for="accountledger">Account Ledger</label>
                                    </div>                                    
                                    <div class="col-lg-3">
                                        <label  for="debit">Debit</label>
                                    </div>
                                    <div class="col-lg-3">
                                        <label  for="credit">Credit</label>
                                    </div>                                  
                                </div>                           
                            </div>
                        </div>
                        <div class="col-lg-12" style="padding-left: 0px;">
                            <div class="panel-body">
                                <div class="form-group" style="padding-top: 3px">                                                                 
                                    <div class="col-lg-4">
                                        <select class=" form-control" id="first_ledgerId" name="new_ledgerId[]">
                                            <option value="">Select</option>
                                            <?php
                                            foreach ($ledger as $value) {
                                                echo "<option value='" . $value->ledgerId . "'>$value->acccountLedgerName</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>                                    
                                    <div class="col-lg-3">
                                        <input type="text" id="first_debit" name="debit[]" class="form-control"  placeholder="0.00" onchange="adddebit()">
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="text" id="first_credit" name="credit[]" class="form-control"  placeholder="0.00" onchange="addcredit()">
                                    </div>                                  
                                </div>                           
                            </div>
                        </div>
                        <div id='TextBoxesGroup'>
                            <div id="TextBoxDiv1">
                                <div class="col-lg-12" style="padding-left: 0px"> 
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <div class="col-lg-4">
                                                <select class=" form-control" id="second_ledgerId" name="new_ledgerId[]">
                                                    <option value="">Select</option>
                                                    <?php
                                                    foreach ($ledger as $value) {
                                                        echo "<option value='" . $value->ledgerId . "'>$value->acccountLedgerName</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>                                    
                                            <div class="col-lg-3">
                                                <input id="second_debit" type="text" name="debit[]" class="form-control"  placeholder="0.00" onchange="adddebit()">
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="col-lg-3" style="width:62%;padding-left: 0px;">                                          
                                                    <input id="second_credit" type="text" name="credit[]" class="form-control"  placeholder="0.00" onchange="addcredit()">                                       
                                                </div>
                                                <button type="button" id='addButton' value='Add Button' class="btn btn-default pull-right">Add <i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>                             
                                </div>  
                            </div>
                        </div>
                        <div class="col-lg-12" style="padding-left: 0px"> 
                            <div class="form-group">
                                &nbsp;
                            </div>
                        </div>
                        <div class="col-lg-12" style="padding-left: 0px;font-weight:700;"> 
                            <div class="panel-body">
                                <div class="form-group ">
                                    <label for="opening_balance" style="font-weight:700;"class="control-label col-lg-4 ">Total</label>
                                    <div class="col-lg-3">
                                        <input style="border:1px solid #0A0101" class="form-control " type="text" id="total_debit" placeholder="0.00"
                                               name="total_debit" readonly/>
                                    </div>                               
                                    <div class="col-lg-3 ">
                                        <input style="border:1px solid #0A0101" class="form-control " type="text" id="total_credit" placeholder="0.00"
                                               name="total_credit" readonly />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12" style="padding-left: 0px"> 
                            <div class="form-group">
                                &nbsp;
                            </div>
                        </div>
                        <div class="col-lg-12" style="padding-left: 0px">
                            <div class="panel-body">
                                <div class="form-group ">
                                    <label for="opening_balance" class="control-label col-lg-4">Description</label>
                                    <div class="col-lg-6">
                                        <textarea class="form-control " id="description" name="description" cols="30" rows="3"></textarea>
                                    </div>                               
                                </div>
                            </div>
                        </div>
                        &nbsp;
                        <div class="col-lg-12" style="padding-left: 0px"> 
                            <div class="form-group ">
                                <label for="opening_balance" class="control-label col-lg-4">Date</label>
                                <div class="col-lg-6">
                                    <input class="form-control " id="date" name="date" />
                                </div>                               
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit"  class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-info">Clear</button>
                    <button type="button" class="btn btn-default " data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--End Of Add Journal MOdal -->
