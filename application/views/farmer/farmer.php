<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                Farmer 
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
                            <button  class="btn btn-info" id="addfarmer" data-toggle="modal" data-target="#myModal">
                                Add New <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <table  class="display table table-bordered table-striped" id="cloudAccounting">
                        <thead>
                            <tr>
                                <th></th>                               
                                <th>Farmer Name</th>
                                <th>Address</th>
                                <th>Mobile No</th>
                                <th>Email Address</th>

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
                            <a data-toggle="modal" href="#myModaledit<?php
                            if ($row->defaultOrNot == 1) {
                                echo '00' . $row->ledgerId;
                            } else {
                                echo $row->ledgerId;
                            }
                            ?>">                                   
                                <td data-toggle="modal" href="#myModaledit<?php
                                if ($row->defaultOrNot == 1) {
                                    echo '00' . $row->ledgerId;
                                } else {
                                    echo $row->ledgerId;
                                }
                                ?>"><?php echo $row->acccountLedgerName; ?></td>

                                <td data-toggle="modal" href="#myModaledit<?php
                                if ($row->defaultOrNot == 1) {
                                    echo '00' . $row->ledgerId;
                                } else {
                                    echo $row->ledgerId;
                                }
                                ?>"><?php echo $row->address; ?></td>

                                <td data-toggle="modal" href="#myModaledit<?php
                                if ($row->defaultOrNot == 1) {
                                    echo '00' . $row->ledgerId;
                                } else {
                                    echo $row->ledgerId;
                                }
                                ?>"><?php echo $row->mobileNo; ?></td>

                                <td data-toggle="modal" href="#myModaledit<?php
                                if ($row->defaultOrNot == 1) {
                                    echo '00' . $row->ledgerId;
                                } else {
                                    echo $row->ledgerId;
                                }
                                ?>"><?php echo $row->emailId; ?></td>
                            </a>
                            </tr>    
                            <!-- start modal for edit data-->
                            <div class="modal fade" id="myModaledit<?php echo $row->ledgerId ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form class="cmxform form-horizontal tasi-form" id="editaccgroup" method="post" action="" >
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                <h4 class="modal-title" id="myModalLabel" align="Center">Edit Farmer Account</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-12">                                                                                                           
                                                        <div class="form">
                                                            <div class="panel-body">
                                                                <div class="form-group ">
                                                                    <label for="editacccountLedgerName" class="control-label col-lg-4">Farmer Name :</label>
                                                                    <div class="col-lg-8">
                                                                        <input class=" form-control" id="editledgerId<?php echo $row->ledgerId; ?>" name="editledgerId" type="hidden" value="<?php echo $row->ledgerId; ?>" />
                                                                        <input class=" form-control" id="editacccountLedgerName<?php echo $row->ledgerId; ?>" name="editacccountLedgerName" type="text" value="<?php echo $row->acccountLedgerName; ?>" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="panel-body">
                                                                <div class="form-group ">
                                                                    <label for="Address" class="control-label col-lg-4">Address :</label>
                                                                    <div class="col-lg-8">
                                                                        <input class=" form-control" id="editaddress<?php echo $row->ledgerId; ?>" name="editaddress"  type="text" value="<?php echo $row->address; ?>" required />                                       
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                            <div class="panel-body">
                                                                <div class="form-group ">
                                                                    <label for="phoneNo" class="control-label col-lg-4">Phone No :</label>
                                                                    <div class="col-lg-8">
                                                                        <input class=" form-control" id="editphoneNo<?php echo $row->ledgerId; ?>" name="editphoneNo"  type="text" value="<?php echo $row->phoneNo; ?>" required />                                       
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                            <div class="panel-body">
                                                                <div class="form-group ">
                                                                    <label for="Mobile" class="control-label col-lg-4">Mobile :</label>
                                                                    <div class="col-lg-8">
                                                                        <input class=" form-control" id="editmobileNo<?php echo $row->ledgerId; ?>" name="editmobileNo"  type="text" value="<?php echo $row->mobileNo; ?>" required />                                       
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                            <div class="panel-body">
                                                                <div class="form-group ">
                                                                    <label for="emailId" class="control-label col-lg-4">E-mail Id :</label>
                                                                    <div class="col-lg-8">
                                                                        <input class=" form-control" id="editemailId<?php echo $row->ledgerId; ?>" name="editemailId"  type="email" value="<?php echo $row->emailId; ?>" required />                                     
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
                                                                        <textarea class=" form-control" id="editdescription<?php echo $row->ledgerId; ?>" name="editdescription"  type="text"><?php echo $row->description; ?></textarea>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <input class=" form-control" id="editaccountGroupId<?php echo $row->ledgerId; ?>" name="editaccountGroupId"  type="hidden" value="<?php echo $row->accountGroupId; ?>"/>
                                                            <input class=" form-control" id="editcreditPeriod<?php echo $row->ledgerId; ?>" name="editcreditPeriod"  type="hidden" value="<?php echo $row->creditPeriod; ?>"/>
                                                            <input class=" form-control" id="editbillByBill<?php echo $row->ledgerId; ?>" name="editbillByBill"  type="hidden" value="<?php echo $row->billByBill ?>"  />
                                                            <input class=" form-control" id="editfax<?php echo $row->ledgerId; ?>" name="editfax"  type="hidden" value="<?php echo $row->fax ?>" />
                                                            <input class=" form-control" id="edittin<?php echo $row->ledgerId; ?>" name="edittin"  type="hidden" value="<?php echo $row->tin ?>" />
                                                            <input class=" form-control" id="editcst<?php echo $row->ledgerId; ?>" name="editcst"  type="hidden" value="<?php echo $row->cst ?>" />
                                                        </div>  
                                                    </div>                                                       
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" id="updatefarmer<?php echo $row->ledgerId; ?>" class="btn btn-primary" onclick="return editledger(<?php echo $row->ledgerId; ?>);">Update</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                </div>                                      
                                </form>                                 
                            </div>
                            <!--End of edit -->
                            <!--Start Modal Delete Data -->
                            <div class="modal fade" id="myModaldelete<?php echo $row->ledgerId; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form class="cmxform form-horizontal tasi-form" id="delaccgroup" method="post" action="">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                <h3 class="modal-title" id="myModalLabel" align="Center">Delete message</h3>
                                            </div>
                                            <div class="modal-body">
                                                <h5><i class="fa fa-warning"></i>&nbsp; Are You Sure You Want To Delete Farmer :&nbsp;&nbsp;<?php echo $row->acccountLedgerName ?></h5>
                                                <input id="ledgerId" name="ledgerId" type=hidden value="<?php echo $row->ledgerId; ?>" />
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" id="deletefarmer<?php echo $row->ledgerId; ?>" class="btn btn-danger" onclick="return deleteFarmer(<?php echo $row->ledgerId; ?>)">YES</button>
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
<!--Add Farmer modal Start-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="cmxform form-horizontal tasi-form" id="addfarmer" method="post" action="#">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel" align="Center">Add Farmer Information</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel-body">
                                <div class="form-group ">
                                    <label for="acccountLedgerName" class="control-label col-lg-4">Farmer Name :</label>
                                    <div class="col-lg-8">
                                        <input class=" form-control" id="acccountLedgerName" name="acccountLedgerName"  type="text" required  onchange="return accountNameCheck()" />
                                        <span id="servermsg"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group ">
                                    <label for="Address" class="control-label col-lg-4">Address :</label>
                                    <div class="col-lg-8">
                                        <input class=" form-control" id="address" name="address"  type="text" required />                                       
                                    </div>
                                </div>
                            </div> 
                            <div class="panel-body">
                                <div class="form-group ">
                                    <label for="phoneNo" class="control-label col-lg-4">Phone No :</label>
                                    <div class="col-lg-8">
                                        <input class=" form-control" id="phoneNo" name="phoneNo"  type="text" required />                                       
                                    </div>
                                </div>
                            </div> 
                            <div class="panel-body">
                                <div class="form-group ">
                                    <label for="Mobile" class="control-label col-lg-4">Mobile :</label>
                                    <div class="col-lg-8">
                                        <input class=" form-control" id="mobileNo" name="mobileNo"  type="text" required />                                       
                                    </div>
                                </div>
                            </div> 
                            <div class="panel-body">
                                <div class="form-group ">
                                    <label for="emailId" class="control-label col-lg-4">E-mail Id :</label>
                                    <div class="col-lg-8">
                                        <input class=" form-control" id="emailId" name="emailId"  type="email" required />                                     
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
                            <input class=" form-control" id="accountGroupId" name="accountGroupId" value="13" type="hidden" required  />
                            <input class=" form-control" id="creditPeriod" name="creditPeriod" value="0" type="hidden" required  />
                            <input class=" form-control" id="billByBill" name="billByBill" value="1" type="hidden" required  />
                            <input class=" form-control" id="fax" name="fax"  type="hidden"  />
                            <input class=" form-control" id="tin" name="tin"  type="hidden"  />
                            <input class=" form-control" id="cst" name="cst"  type="hidden"  />
                        </div>
                    </div>  
                </div>
                <div class="modal-footer">
                    <button type="button"  class="btn btn-primary" onclick="return addledger();">Save</button>
                    <button type="reset" class="btn btn-info">Clear</button>
                    <button type="button" class="btn btn-default " data-dismiss="modal" id="addfarmercancle">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div> 
<!-- Warning Delete modal for accessed-->
<div class="modal fade" id="deletedinaccessed" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete message</h4>
            </div>
            <div class="modal-body">    
                <p><h4><i class="fa fa-warning"></i>&nbsp;Sorry !! You can not delete this farmer!! This farmer is in used</h4></p>
            </div>
            <div class="modal-footer">                 
                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
            </div>
        </div> 
    </div>
</div>
<!-- end warning delete modal-->
<!---------End of Add New Farmer------------------------>
<script>
<?php $this->sessiondata = $this->session->userdata('logindata'); ?>
    $(document).ready(function () {
        var fyearstatus = "<?php echo $this->sessiondata['fyear_status']; ?>";
<?php foreach ($alldata as $unitvalue): ?>
            var id = "<?php echo $unitvalue->ledgerId; ?>"
            if (fyearstatus == '0') {
                $("#updatefarmer" + id).prop("disabled", true);
                $("#deletefarmer" + id).prop("disabled", true);
            }
<?php endforeach; ?>
        if (fyearstatus == '0') {
            $("#addfarmer").prop("disabled", true);
        }
    });
</script>
<script type="text/javascript">
    $("#addfarmercancle").click(function () {
        $("#addfarmer")[0].reset();
    });
    function accountNameCheck() {
        var acccountLedgerName = $("#acccountLedgerName").val();
        var dataString = "acccountLedgerName=" + acccountLedgerName;
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('farmer/farmer/accountNameCheck'); ?>",
            data: dataString,
            success: function (data)
            {
                if (data === 'free') {
                    $("#acccountLedgerName").css('border-color', 'green');
                    $("#servermsg").text("Farmer name available");
                    $("#servermsg").css('color', 'green');
                    return true;
                }
                if (data === 'booked') {
                    $("#acccountLedgerName").css('border-color', 'red');
                    $("#servermsg").text("Farmer Name not Available. Please try another");
                    $("#servermsg").css('color', 'red');
                }
            }
        });
    }
    function addledger() {
        var accountLedgerName = $("#servermsg").html();
        if (accountLedgerName === "Farmer Name not Available. Please try another") {
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
                $("#servermsg").text("Please Enter Farmer Name ");
                return false;
            } else {
                $("#servermsg").css({"display": "none"});
                var dataString = "acccountLedgerName=" + acccountLedgerName + "&accountGroupId=" + accountGroupId + "&openingBalance=" + openingBalance + "&debitOrCredit=" + debitOrCredit + "&address=" + address + "&phoneNo=" + phoneNo + "&emailId=" + emailId + "&creditPeriod=" + creditPeriod + "&mobileNo=" + mobileNo + "&fax=" + fax + "&tin=" + tin + "&cst=" + cst + "&defaultOrNot=" + defaultOrNot + "&description=" + description + "&billByBill=" + billByBill;
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('farmer/farmer/addAccLedger'); ?>",
                    data: dataString,
                    success: function (data)
                    {
                        if (data == 'Added') {
                            $('#myModal').modal('hide');
                            $.gritter.add({
                                title: 'Successfull!',
                                text: 'Farmer Added Successfully',
                                sticky: false,
                                time: '5000'
                            });
                            setTimeout("window.location.reload(1)", 2000);
                            return true;
                        }
                        if (data == 'Notadded') {
                            $('#myModal').modal('hide');
                            $.gritter.add({
                                title: 'Unsuccessfull!',
                                text: 'Farmer Added Failed',
                                sticky: false,
                                time: '2000'
                            });
                        }
                    }
                });
            }
        }
    }

    function editledger(id)
    {
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
        var editdescription = $(editdescription).val();
        var editbillByBill = $(editbillByBill).val();
        var dataString = "editledgerId=" + id + "&editacccountLedgerName=" + editacccountLedgerName + "&editaccountGroupId=" + editaccountGroupId + "&editopeningBalance=" + editopeningBalance + "&editdebitOrCredit=" + editdebitOrCredit + "&editaddress=" + editaddress + "&editphoneNo=" + editphoneNo + "&editemailId=" + editemailId + "&editcreditPeriod=" + editcreditPeriod + "&editmobileNo=" + editmobileNo + "&editfax=" + editfax + "&edittin=" + edittin + "&editcst=" + editcst + "&editdefaultOrNot=" + editdefaultOrNot + "&editdescription=" + editdescription + "&editbillByBill=" + editbillByBill;

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('farmer/farmer/editAccLedger'); ?>",
            data: dataString,
            success: function (data)
            {
                if (data === 'Updated') {
                    $('#myModaledit' + id).modal('hide');
                    $.gritter.add({
                        title: 'Successfull!',
                        text: 'Farmer Updated Successfully',
                        sticky: false,
                        time: '5000'
                    });
                    setTimeout("window.location.reload(1)", 2000);
                }
                if (data === 'Notupdated') {
                    $('#myModaledit' + id).modal('hide');
                    $.gritter.add({
                        title: 'Unsuccessfull!',
                        text: 'Farmer Not Updated ',
                        sticky: false,
                        time: '5000'
                    });
                    setTimeout("window.location.reload(1)", 2000);
                }
            }
        });
    }
    function deleteFarmer(id)
    {
        var dataString = "ledgerId=" + id;
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('farmer/farmer/deleteFarmer'); ?>",
            data: dataString,
            success: function (data)
            {                
                if (data == 'Deleted') {
                    $('#myModaldelete' + id).modal('hide');
                    $.gritter.add({
                        title: 'Successfull!',
                        text: 'Farmer Deleted Successfully',
                        sticky: false,
                        time: '5000'
                    });
                    setTimeout("window.location.reload(1)", 2000);
                }
                if (data == 'Notdeleted') {
                    $('#myModaldelete' + id).modal('hide');
                    $("#deletedinaccessed").modal('show');
                }
            }
        });
    }
</script>