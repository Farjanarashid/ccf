<?php include_once 'header.php'; ?>
<?php include_once 'sidebar.php'; ?>
<section id="main-content" >
    <section class="wrapper site-min-height">
        <section class="panel">
            <header class="panel-heading">
                Account Ledger
            </header>
            <style>
                #myModalLabel{
                    font-weight: bold
                }
            </style>
            <div class="panel-body">
                <div class="adv-table">
                    <div class="clearfix">
                        <div class="btn-group pull-right">
                            <button  class="btn btn-info" id="addaccountledger" data-toggle="modal" data-target="#myModal">
                                Add New <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>                  
                    <table  class="display table table-bordered table-striped" id="cloudAccounting">
                        <thead>
                            <tr>
                                <th></th>                               
                                <th>Account Ledger Name</th>
                                <th>Group Under</th>
                                <th>Description</th>
                            </tr>
                        </thead>   
                        <tbody>
                            <?php foreach ($alldata as $row): ?>                          
                                <tr class="table_hand">
                                    <td >
                                        <a data-toggle="modal" href="#myModaldelete<?php
                                        if ($row->defaultOrNot == 1) {
                                            echo '00';
                                        } else {
                                            echo $row->ledgerId;
                                        }
                                        ?>"><i class="fa fa-times-circle delete-icon" ></i></a>
                                    </td>                                                           
                                    <td data-toggle="modal" href="#myModaledit<?php
                                    if ($row->defaultOrNot == 1) {
                                        echo '00' . $row->ledgerId;
                                    } else {
                                        echo $row->ledgerId;
                                    }
                                    ?>"><?php echo $row->acccountLedgerName; ?>
                                    </td>
                                    <td data-toggle="modal" href="#myModaledit<?php
                                    if ($row->defaultOrNot == 1) {
                                        echo '00' . $row->ledgerId;
                                    } else {
                                        echo $row->ledgerId;
                                    }
                                    ?>">
                                            <?php
                                            foreach ($sortalldata as $acgrp):
                                                if ($row->accountGroupId == $acgrp->accountGroupId):
                                                    echo $acgrp->accountGroupName;
                                                endif;
                                            endforeach;
                                            ?>
                                    </td>
                                    <td data-toggle="modal" href="#myModaledit<?php
                                    if ($row->defaultOrNot == 1) {
                                        echo '00' . $row->ledgerId;
                                    } else {
                                        echo $row->ledgerId;
                                    }
                                    ?>"><?php echo $row->description; ?>
                                    </td>                           
                                </tr>    
                                <!-- start modal for edit data-->
                            <div class="modal fade" id="myModaledit<?php echo $row->ledgerId ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form class="cmxform form-horizontal tasi-form" id="editaccgroup<?php echo $row->ledgerId ?>" method="post" action="" >
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                <h4 class="modal-title" id="myModalLabel" align="Center">Edit Account Ledger</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-12">                                                                                                           
                                                        <div class="form">
                                                            <div class="panel-body">
                                                                <div class="form-group ">
                                                                    <label for="editacccountLedgerName" class="control-label col-lg-4">Account Ledger Name :</label>
                                                                    <div class="col-lg-8">
                                                                        <input class=" form-control" id="editledgerId<?php echo $row->ledgerId; ?>" name="editledgerId" type="hidden" value="<?php echo $row->ledgerId; ?>" />
                                                                        <input class=" form-control" id="editacccountLedgerName<?php echo $row->ledgerId; ?>" name="editacccountLedgerName" type="text" value="<?php echo $row->acccountLedgerName; ?>"/>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="panel-body">
                                                                <div class="form-group ">
                                                                    <label for="editaccountGroupId" class="control-label col-lg-4">Account Group Name :</label>
                                                                    <div class="col-lg-8">
                                                                        <select class="form-control" id="editaccountGroupId<?php echo $row->ledgerId; ?>" name="editaccountGroupId" type="text" onchange="return checkgroup(<?php echo $row->ledgerId; ?>)">
                                                                            <?php
                                                                            foreach ($sortalldata as $group):
                                                                                ?>                                                                               
                                                                                <option <?php
                                                                                if ($group->accountGroupId == $row->accountGroupId) {
                                                                                    echo 'selected';
                                                                                }
                                                                                ?> value="<?php echo $group->accountGroupId; ?>"><?php echo $group->accountGroupName; ?></option>
                                                                                <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="panel-body">
                                                                <div class="form-group ">
                                                                    <label for="openingBalance" class="control-label col-lg-4">Opening Balance :</label>
                                                                    <div class="col-lg-5">
                                                                        <input  class="form-control "  type="text" id="editopeningBalance<?php echo $row->ledgerId; ?>" name="editopeningBalance" value="<?php echo $row->openingBalance; ?>" />
                                                                    </div>
                                                                    <div class="col-lg-2 col-sm-2">
                                                                        <select class="supplier_debit pull-right" id="editdebitOrCredit<?php echo $row->ledgerId; ?>">
                                                                            <?php if ($row->debitOrCredit == "1"): ?>
                                                                                <option selected value="<?php echo $row->debitOrCredit ?>">Dr</option>
                                                                                <option value="0">Cr</option>
                                                                                <?php
                                                                            endif;
                                                                            ?>
                                                                            <?php if ($row->debitOrCredit == "0"): ?>
                                                                                <option selected value="<?php echo $row->debitOrCredit ?>">Cr</option>
                                                                                <option value="1">Dr</option>
                                                                                <?php
                                                                            endif;
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="panel-body">
                                                                <div class="form-group ">
                                                                    <label for="description" class="control-label col-lg-4">Description :</label>
                                                                    <div class="col-lg-8">
                                                                        <textarea class=" form-control" id="editdescription<?php echo $row->ledgerId; ?>" name="editdescription"  type="text" ><?php echo $row->description; ?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="panel-body">
                                                                <div class="form-group ">
                                                                    <label for="creditPeriod" class="control-label col-lg-4">Credit Period :</label>
                                                                    <div class="col-lg-8">
                                                                        <?php if ($row->accountGroupId == "27" || $row->accountGroupId == "28"): ?>
                                                                            <input class=" form-control" id="editcreditPeriod<?php echo $row->ledgerId; ?>" name="editcreditPeriod"  type="text" value="<?php echo $row->creditPeriod; ?>" />                                                                     
                                                                        <?php else: ?><input class=" form-control" id="editcreditPeriod<?php echo $row->ledgerId; ?>" name="editcreditPeriod"  type="text" value="<?php echo $row->creditPeriod; ?>" readonly/>
                                                                        <?php endif; ?>                                                                     
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="panel-body">
                                                                <div class="form-group ">
                                                                    <label for="billByBill" class="control-label col-lg-4">Bill by Bill  :</label>
                                                                    <div class="col-lg-8">
                                                                        <?php if ($row->accountGroupId == "27" || $row->accountGroupId == "28"): ?>
                                                                            <select class="form-control" id="editbillByBill<?php echo $row->ledgerId; ?>">
                                                                                <?php if ($row->billByBill == "1"): ?>
                                                                                    <option selected value="<?php echo $row->billByBill ?>">Yes</option>
                                                                                    <option value="0">No</option>
                                                                                    <?php
                                                                                endif;
                                                                                ?>
                                                                                <?php if ($row->billByBill == "0"): ?>
                                                                                    <option selected value="<?php echo $row->billByBill ?>">No</option>
                                                                                    <option value="1">Yes</option>
                                                                                    <?php
                                                                                endif;
                                                                                ?>
                                                                            </select>
                                                                        <?php else : ?>                                                                        
                                                                            <select class="form-control" id="editbillByBill<?php echo $row->ledgerId; ?>" disabled >
                                                                                <?php if ($row->billByBill == "1"): ?>
                                                                                    <option selected value="<?php echo $row->billByBill ?>">Yes</option>
                                                                                    <option value="0">No</option>
                                                                                    <?php
                                                                                endif;
                                                                                ?>
                                                                                <?php if ($row->billByBill == "0"): ?>
                                                                                    <option selected value="<?php echo $row->billByBill ?>">No</option>
                                                                                    <option value="1">Yes</option>
                                                                                    <?php
                                                                                endif;
                                                                                ?>
                                                                            </select>
                                                                        <?php endif; ?>

                                                                    </div>
                                                                    <input class=" form-control" id="editaddress" name="editaddress"  type="hidden"  />
                                                                    <input class=" form-control" id="editphoneNo" name="editphoneNo"  type="hidden"  />
                                                                    <input class=" form-control" id="editemailId" name="editemailId"  type="hidden"  />
                                                                    <input class=" form-control" id="editfax" name="editfax"  type="hidden"  />
                                                                    <input class=" form-control" id="edittin" name="edittin"  type="hidden"  />
                                                                    <input class=" form-control" id="editcst" name="editcst"  type="hidden"  />
                                                                    <input class=" form-control" id="editcompanyId" name="editcompanyId"  type="hidden" value="1" />

                                                                </div>
                                                            </div>  
                                                        </div>                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" id="updateaccountledger<?php echo $row->ledgerId; ?>" class="btn btn-primary" onclick="return editledger(<?php echo $row->ledgerId; ?>);">Update</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="return reload(<?php echo $row->ledgerId; ?>);" >Cancel</button>
                                            </div>
                                        </div>                                      
                                    </form>                                 
                                </div>
                            </div>
                            <!-- end edit modal-->  

                            <!-- Start DefaultorNot Modal Edit ----->

                            <div class="modal fade" id="myModaledit00<?php echo $row->ledgerId ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form class="cmxform form-horizontal tasi-form" id="editaccgroup" method="post" action="#" >
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                <h4 class="modal-title" id="myModalLabel" align="Center">Edit Account Ledger</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-12">                                                                                                           
                                                        <div class="form">
                                                            <div class="panel-body">
                                                                <div class="form-group ">
                                                                    <label for="editacccountLedgerName" class="control-label col-lg-4">Account Ledger Name :</label>
                                                                    <div class="col-lg-8">
                                                                        <input class=" form-control" id="editledgerId<?php echo $row->ledgerId; ?>" name="editledgerId" type="hidden" value="<?php echo $row->ledgerId; ?>" />
                                                                        <input class=" form-control" id="editacccountLedgerName<?php echo $row->ledgerId; ?>" name="editacccountLedgerName" type="text" value="<?php echo $row->acccountLedgerName; ?>"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="panel-body">
                                                                <div class="form-group ">
                                                                    <label for="editaccountGroupId" class="control-label col-lg-4">Account Group Name :</label>
                                                                    <div class="col-lg-8">
                                                                        <select class="form-control" id="editaccountGroupId<?php echo $row->ledgerId; ?>"  name="editaccountGroupId" type="text" disabled >
                                                                            <?php foreach ($sortalldata as $group): ?>                                                                                                                                                    
                                                                                <option <?php
                                                                                if ($group->accountGroupId == $row->accountGroupId) {
                                                                                    echo 'selected';
                                                                                }
                                                                                ?> value="<?php echo $group->accountGroupId; ?>"><?php echo $group->accountGroupName; ?></option>
                                                                                <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="panel-body">
                                                                <div class="form-group ">
                                                                    <label for="openingBalance" class="control-label col-lg-4">Opening Balance :</label>
                                                                    <div class="col-lg-5">
                                                                        <input  class="form-control "  type="text" id="editopeningBalanceofdefault<?php echo $row->ledgerId; ?>" name="editopeningBalanceofdefault" value="<?php echo $row->openingBalance; ?>" />
                                                                    </div>
                                                                    <div class="col-lg-2 col-sm-2">
                                                                        <select class="supplier_debit pull-right" id="editdebitOrCredit<?php echo $row->ledgerId; ?>" disabled >
                                                                            <?php if ($row->debitOrCredit == "1"): ?>
                                                                                <option selected value="<?php echo $row->debitOrCredit ?>">Dr</option>
                                                                                <option value="0">Cr</option>
                                                                                <?php
                                                                            endif;
                                                                            ?>
                                                                            <?php if ($row->debitOrCredit == "0"): ?>
                                                                                <option selected value="<?php echo $row->debitOrCredit ?>">Cr</option>
                                                                                <option value="1">Dr</option>
                                                                                <?php
                                                                            endif;
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="panel-body">
                                                                <div class="form-group ">
                                                                    <label for="description" class="control-label col-lg-4">Description :</label>
                                                                    <div class="col-lg-8">
                                                                        <textarea class=" form-control" id="editdescription<?php echo $row->ledgerId; ?>" name="editdescription"  type="text" ><?php echo $row->description; ?></textarea>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="panel-body">
                                                                <div class="form-group ">
                                                                    <label for="creditPeriod" class="control-label col-lg-4">Credit Period :</label>
                                                                    <div class="col-lg-8">
                                                                        <input class=" form-control" id="editcreditPeriod<?php echo $row->ledgerId; ?>" name="editcreditPeriod"  type="text" value="<?php echo $row->creditPeriod; ?>" readonly />
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="panel-body">
                                                                <div class="form-group ">
                                                                    <label for="billByBill" class="control-label col-lg-4">Bill by Bill  :</label>
                                                                    <div class="col-lg-8">
                                                                        <select class="form-control" id="editbillByBill<?php echo $row->ledgerId; ?>" disabled >
                                                                            <?php if ($row->billByBill == "1"): ?>
                                                                                <option selected value="<?php echo $row->billByBill ?>">Yes</option>
                                                                                <option value="0">No</option>
                                                                                <?php
                                                                            endif;
                                                                            ?>
                                                                            <?php if ($row->billByBill == "0"): ?>
                                                                                <option selected value="<?php echo $row->billByBill ?>">No</option>
                                                                                <option value="1">Yes</option>
                                                                                <?php
                                                                            endif;
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <input class=" form-control" id="editdefaultOrNot<?php echo $row->ledgerId; ?>" name="editdefaultOrNot" value="<?php echo $row->defaultOrNot; ?>" type="hidden"  />
                                                                    <input class=" form-control" id="editaddress<?php echo $row->ledgerId; ?>" name="editaddress" value="<?php echo $row->address; ?>" type="hidden"  />
                                                                    <input class=" form-control" id="editphoneNo<?php echo $row->ledgerId; ?>" name="editphoneNo" value="<?php echo $row->phoneNo; ?>" type="hidden"  />
                                                                    <input class=" form-control" id="editemailId<?php echo $row->ledgerId; ?>" name="editemailId" value="<?php echo $row->emailId; ?>" type="hidden"  />
                                                                    <input class=" form-control" id="editfax<?php echo $row->ledgerId; ?>" name="editfax" value="<?php echo $row->fax; ?>" type="hidden"  />
                                                                    <input class=" form-control" id="edittin<?php echo $row->ledgerId; ?>" name="edittin" value="<?php echo $row->tin; ?>" type="hidden"  />
                                                                    <input class=" form-control" id="editcst<?php echo $row->ledgerId; ?>" name="editcst" value="<?php echo $row->cst; ?>" type="hidden"  />
                                                                    <input class=" form-control" id="editcompanyId<?php echo $row->ledgerId; ?>" name="editcompanyId" value="<?php echo $row->companyId; ?>" type="hidden"  />

                                                                </div>
                                                            </div>  
                                                        </div>                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" id="editledger<?php echo $row->ledgerId; ?>" class="btn btn-primary" onclick="return editledgerofdefault(<?php echo $row->ledgerId; ?>);">Update</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="return editreload(<?php echo $row->ledgerId; ?>);">Cancel</button>
                                            </div>
                                        </div>                                      
                                    </form>                                 
                                </div>
                            </div>
                            <!--End of DefaultorNot -->
                            <!--Start Modal Delete Data -->
                            <div class="modal fade" id="myModaldelete<?php echo $row->ledgerId; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form class="cmxform form-horizontal tasi-form" id="delaccgroup<?php echo $row->ledgerId; ?>" method="post" action="#">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Delete message</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="panel-body">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <h5><i class="fa fa-warning"></i>&nbsp; Are You Sure You Want To Delete The Account Ledger :&nbsp;&nbsp;<?php echo $row->acccountLedgerName ?></h5>
                                                                <input id="ledgerId" name="ledgerId" type=hidden value="<?php echo $row->ledgerId; ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" id="deleteledger<?php echo $row->ledgerId; ?>" class="btn btn-danger" onclick="return deleteAccLedger(<?php echo $row->ledgerId; ?>)">YES</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!--end delete modal-->

                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </section>
</section>
<!-- Warning Delete modal-->
<div class="modal fade" id="myModaldelete00" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel" align="Center">Delete message</h4>
            </div>
            <div class="modal-body">    
                <p><h4><i class="fa fa-warning"></i>&nbsp;You can not delete a built-in Account Ledger </h4></p>
            </div>
            <div class="modal-footer">                 
                <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
            </div>
        </div> 
    </div>
</div>
<!-- end warning delete modal-->
<!-- Warning Delete modal for accessed-->
<div class="modal fade" id="deletedinaccessed" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete message</h4>
            </div>
            <div class="modal-body">    
                <p><h4><i class="fa fa-warning"></i>&nbsp;Sorry !! You can not delete this account ledger!! This account ledger is in used</h4></p>
            </div>
            <div class="modal-footer">                 
                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
            </div>
        </div> 
    </div>
</div>
<!-- end warning delete modal-->
<!-- Add Account Group Ledger -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="cmxform form-horizontal tasi-form" id="addaccledger" method="post" action="#">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel" align="Center">Add Account Ledger</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel-body">
                                <div class="form-group ">
                                    <label for="acccountLedgerName" class="control-label col-lg-4">Account Ledger Name :</label>
                                    <div class="col-lg-8">
                                        <input class=" form-control" id="acccountLedgerName" name="acccountLedgerName"  type="text" onchange="return accountNameCheck()" />
                                        <span id="servermsg"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group ">
                                    <label for="accountGroupId" class="control-label col-lg-4">Account Group Name :</label>
                                    <div class="col-lg-8">
                                        <select class="form-control" id="accountGroupId" name="accountGroupId" type="text"  onchange="return checkgroup();">
                                            <option value="">-- Group Under --</option>
                                            <?php foreach ($sortalldata as $row): ?>
                                                <option value="<?php echo $row->accountGroupId; ?>"><?php echo $row->accountGroupName; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <span id="grpmsg"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group ">
                                    <label for="openingBalance" class="control-label col-lg-4">Opening Balance :</label>
                                    <div class="col-lg-5">
                                        <input  class="form-control "  type="text" id="openingBalance" name="openingBalance" value="0.00" />
                                    </div>
                                    <div class="col-lg-2 col-sm-2">
                                        <select class="supplier_debit pull-right" id="debitOrCredit">
                                            <option value="1">Dr</option>
                                            <option value="0">Cr</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group ">
                                    <label for="description" class="control-label col-lg-4">Description :</label>
                                    <div class="col-lg-8">
                                        <textarea class=" form-control" id="description" name="description"  type="text" ></textarea>

                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group ">
                                    <label for="creditPeriod" class="control-label col-lg-4">Credit Period :</label>
                                    <div class="col-lg-8">                                            
                                        <input class=" form-control" id="creditPeriod" name="creditPeriod"  type="text"  />
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group ">
                                    <label for="billByBill" class="control-label col-lg-4">Bill by Bill  :</label>
                                    <div class="col-lg-8">
                                        <select id="billByBill" class="form-control">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                    <input class=" form-control" id="address" name="address"  type="hidden"  />
                                    <input class=" form-control" id="mobileNo" name="mobileNo"  type="hidden"  />
                                    <input class=" form-control" id="phoneNo" name="phoneNo"  type="hidden"  />
                                    <input class=" form-control" id="emailId" name="emailId"  type="hidden"  />
                                    <input class=" form-control" id="fax" name="fax"  type="hidden"  />
                                    <input class=" form-control" id="tin" name="tin"  type="hidden"  />
                                    <input class=" form-control" id="cst" name="cst"  type="hidden"  />                                   

                                </div>
                            </div>  
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit"  class="btn btn-primary" onclick="return addledger();">Save</button>
                    <button type="reset" class="btn btn-info">Clear</button>
                    <button type="button" class="btn btn-default " data-dismiss="modal" onclick="return reloadMymodel();">Cancel</button>
                </div>
            </div>
        </form>
    </div>    
</div>
<?php include_once 'footer.php'; ?>
<script>
<?php $this->sessiondata = $this->session->userdata('logindata'); ?>
    $(document).ready(function () {
        var fyearstatus = "<?php echo $this->sessiondata['fyear_status']; ?>";
<?php foreach ($alldata as $unitvalue): ?>
            var id = "<?php echo $unitvalue->ledgerId; ?>"
            if (fyearstatus == '0') {
                $("#updateaccountledger" + id).prop("disabled", true);
                $("#editledger" + id).prop("disabled", true);
                $("#deleteledger" + id).prop("disabled", true);
            }
<?php endforeach; ?>
        if (fyearstatus == '0') {
            $("#addaccountledger").prop("disabled", true);
        }
    });
</script>
<script type="text/javascript">
    function reloadMymodel() {
        $("#addaccledger")[0].reset();
    }
    function reload(id) {
        $('#myModaledit' + id).on('hidden.bs.modal', function () {
            location.reload();
        });
    }
    function editreload(id) {
        $("#editaccgroup" + id)[0].reset();
    }
    function editaccountNameCheck(id) {
        var acccountLedgerName = "#editacccountLedgerName" + id;
        var acccountLedgerName = $(acccountLedgerName).val();
        var dataString = "acccountLedgerName=" + acccountLedgerName;
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('accountLedger/accountNameCheck'); ?>",
            data: dataString,
            success: function (data)
            {
                if (data === 'free') {
                    $("#editacccountLedgerName").css('border-color', 'green');
                    $("#editservermsg").text("Account Ledger name available");
                    $("#editservermsg").css('color', 'green');
                    return true;
                }
                if (data === 'booked') {
                    $("#editacccountLedgerName").css('border-color', 'red');
                    $("#editservermsg").text("Account Ledger Name not Available. Please try another");
                    $("#editservermsg").css('color', 'red');
                }
            }
        });
    }
    function accountNameCheck() {
        var acccountLedgerName = $("#acccountLedgerName").val();
        var dataString = "acccountLedgerName=" + acccountLedgerName;
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('accountLedger/accountNameCheck'); ?>",
            data: dataString,
            success: function (data)
            {
                if (data === 'free') {
                    $("#acccountLedgerName").css('border-color', 'green');
                    $("#servermsg").text("Account Ledger name available");
                    $("#servermsg").css('color', 'green');
                    return true;
                }
                if (data === 'booked') {
                    $("#acccountLedgerName").css('border-color', 'red');
                    $("#servermsg").text("Account Ledger Name not Available. Please try another");
                    $("#servermsg").css('color', 'red');
                }
            }
        });
    }

    function addledger() {
        var accountLedgerName = $("#servermsg").html();
        if (accountLedgerName === "Account Ledger Name not Available. Please try another") {
            $("#acccountLedgerName").focus();
            return false;
        } else {
            var acccountLedgerName = $("#acccountLedgerName").val();
            var accountGroupId = $("#accountGroupId").val();
            var openingBalance = $("#openingBalance").val();
            var debitOrCredit = $("#debitOrCredit").val();
            var address = $("#address").val();
            var phoneNo = $("#phoneNo").val();
            var emailId = $("#emailId").val();
            var creditPeriod = $("#creditPeriod").val();
            var mobileNo = $("#mobileNo").val();
            var fax = $("#fax").val();
            var tin = $("#tin").val();
            var cst = $("#cst").val();
            var defaultOrNot = $("#defaultOrNot").val();
            var description = $("#description").val();
            var billByBill = $("#billByBill").val();
            if (acccountLedgerName.length < 1) {
                $("#servermsg").css({"display": "block", "color": "red"});
                $("#servermsg").text("Please Enter Account Ledger Name ");
                return false;
            }
            if (accountGroupId.length < 1) {
                $("#grpmsg").css({"display": "block", "color": "red"});
                $("#grpmsg").text("Please Enter Account Group ");
                return false;
            }
            else {
                $("#servermsg").css({"display": "none"});
                var dataString = "acccountLedgerName=" + acccountLedgerName + "&accountGroupId=" + accountGroupId + "&openingBalance=" + openingBalance + "&debitOrCredit=" + debitOrCredit + "&address=" + address + "&phoneNo=" + phoneNo + "&emailId=" + emailId + "&creditPeriod=" + creditPeriod + "&mobileNo=" + mobileNo + "&fax=" + fax + "&tin=" + tin + "&cst=" + cst + "&defaultOrNot=" + defaultOrNot + "&description=" + description + "&billByBill=" + billByBill;
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('accountLedger/addAccLedger'); ?>",
                    data: dataString,
                    success: function (data)
                    {
                        if (data == 'Added') {
                            $('#myModal').modal('hide');
                            $.gritter.add({
                                title: 'Successfull!',
                                text: 'Account Ledger  Added Successfully',
                                sticky: false,
                                time: '5000'
                            });
                            $("#addaccledger")[0].reset();
                        }
                        if (data == 'Notadded') {
                            $('#myModal').modal('hide');
                            $.gritter.add({
                                title: 'Unsuccessfull!',
                                text: 'Account Ledger Not Added ',
                                sticky: false,
                                time: '5000'
                            });
                            $("#addaccledger")[0].reset();
                        }
                    }
                });
            }
        }
    }

    function editledger(id)
    {
        var accountLedgerName = $("#editservermsg").html();
        if (accountLedgerName === "Account Ledger Name not Available. Please try another") {
            $("#editacccountLedgerName" + id).focus();
            return false;
        } else {
            var editacccountLedgerName = "#editacccountLedgerName" + id;
            var editaccountGroupId = "#editaccountGroupId" + id;
            var editopeningBalance = "#editopeningBalance" + id;
            var editdebitOrCredit = "#editdebitOrCredit" + id;
            var editaddress = "#editaddress" + id;
            var editphoneNo = "#editphoneNo" + id;
            var editemailId = "#editemailId" + id;
            var editcreditPeriod = "#editcreditPeriod" + id;
            var editmobileNo = "#editmobileNo" + id;
            var editfax = "#editfax" + id;
            var edittin = "#edittin" + id;
            var editcst = "#editcst" + id;
            var editdefaultOrNot = "#editdefaultOrNot" + id;
            var editcompanyId = "#editcompanyId" + id;
            var editdescription = "#editdescription" + id;
            var editbillByBill = "#editbillByBill" + id;
            var editacccountLedgerName = $(editacccountLedgerName).val();
            var editaccountGroupId = $(editaccountGroupId).val();
            var editopeningBalance = $(editopeningBalance).val();
            var editdebitOrCredit = $(editdebitOrCredit).val();
            var editaddress = $(editaddress).val();
            var editphoneNo = $(editphoneNo).val();
            var editemailId = $(editemailId).val();
            var editcreditPeriod = $(editcreditPeriod).val();
            var editmobileNo = $(editmobileNo).val();
            var editfax = $(editfax).val();
            var edittin = $(edittin).val();
            var editcst = $(editcst).val();
            var editdefaultOrNot = $(editdefaultOrNot).val();
            var editcompanyId = $(editcompanyId).val();
            var editdescription = $(editdescription).val();
            var editbillByBill = $(editbillByBill).val();
            var dataString = "editledgerId=" + id + "&editacccountLedgerName=" + editacccountLedgerName + "&editaccountGroupId=" + editaccountGroupId + "&editopeningBalance=" + editopeningBalance + "&editdebitOrCredit=" + editdebitOrCredit + "&editaddress=" + editaddress + "&editphoneNo=" + editphoneNo + "&editemailId=" + editemailId + "&editcreditPeriod=" + editcreditPeriod + "&editmobileNo=" + editmobileNo + "&editfax=" + editfax + "&edittin=" + edittin + "&editcst=" + editcst + "&editdefaultOrNot=" + editdefaultOrNot + "&editcompanyId=" + editcompanyId + "&editdescription=" + editdescription + "&editbillByBill=" + editbillByBill;
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('accountLedger/editAccLedger'); ?>",
                data: dataString,
                success: function (data)
                {                   
                    if (data == 'Updated') {
                        $('#myModaledit' + id).modal('hide');
                        $.gritter.add({
                            title: 'Successfull!',
                            text: 'Account Ledger Updated Successfully',
                            sticky: false,
                            time: '5000'
                        });
                        $("#editaccgroup" + id)[0].reset();
                    }
                    if (data == 'Notupdated') {
                        $('#myModaledit' + id).modal('hide');
                        $.gritter.add({
                            title: 'Unsuccessfull!',
                            text: 'Account Ledger Not Updated ',
                            sticky: false,
                            time: '5000'
                        });
                        $("#editaccgroup" + id)[0].reset();
                    }
                    location.reload();
                }
            });
        }
    }

    function editledgerofdefault(id)
    {
        var editopeningBalanceofdefault = '#editopeningBalanceofdefault' + id;
        var editopeningBalanceofdefault = $(editopeningBalanceofdefault).val();
        var dataString = "editledgerId=" + id + "&editopeningBalanceofdefault=" + editopeningBalanceofdefault;
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('accountLedger/editAccLedgerDefault'); ?>",
            data: dataString,
            success: function (data)
            {
                if (data == 'Updated') {
                    $('#myModaledit' + id).modal('hide');
                    $.gritter.add({
                        title: 'Successfull!',
                        text: 'Account Ledger Updated Successfully',
                        sticky: false,
                        time: '5000'
                    });
                    $("#editaccgroup" + id)[0].reset();
                }
                if (data == 'Notupdated') {
                    $('#myModaledit' + id).modal('hide');
                    $.gritter.add({
                        title: 'Unsuccessfull!',
                        text: 'Account Ledger Not Updated ',
                        sticky: false,
                        time: '5000'
                    });
                    $("#editaccgroup" + id)[0].reset();
                }
                location.reload();
            }
        });
    }
    function checkgroup(id)
    {
        var editaccountGroupId = "#editaccountGroupId" + id;
        var editaccountGroupId = $(editaccountGroupId).val();
        if (editaccountGroupId === '27' || editaccountGroupId === '28') {
            $('#editcreditPeriod' + id).prop('readonly', false);
            $('#editbillByBill' + id).prop('disabled', false);
        }
        else
        {
            $('#editcreditPeriod' + id).prop('readonly', true);
            $('#editbillByBill' + id).prop('disabled', true);
        }
        var accountGroupId = $('#accountGroupId').val();
        if (accountGroupId === '27' || accountGroupId === '28') {
            $('#creditPeriod').prop('readonly', false);
            $('#billByBill').prop('disabled', false);
        }
        else
        {
            $('#creditPeriod').prop('readonly', true);
            $('#billByBill').prop('disabled', true);
        }
    }
    function deleteAccLedger(id)
    {
        var dataString = "ledgerId=" + id;
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('accountLedger/deleteAccLedger'); ?>",
            data: dataString,
            success: function (data)
            {
                if (data == 'deleted') {
                    $('#myModaldelete' + id).modal('hide');
                    $.gritter.add({
                        title: 'Successfull!',
                        text: 'Account Ledger Deleted Successfully',
                        sticky: false,
                        time: '5000'
                    });
                    $("#delaccgroup" + id)[0].reset();
                }
                if (data == 'notdeleted') {
                    $('#myModaldelete' + id).modal('hide');
                    $("#deletedinaccessed").modal('show');
                }
                window.location.reload();
            }
        });
    }
</script>
