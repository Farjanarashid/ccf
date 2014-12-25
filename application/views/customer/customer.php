<style>
    #myModalLabel{
        font-weight: bold
    }
</style>
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                Customer Information
            </header>
            <div class="panel-body">
                <div class="adv-table">
                    <div class="clearfix">
                        <div class="btn-group pull-right">
                            <button class="btn btn-info" data-toggle="modal" data-target="#myModal" id="addcustomer">
                                Add New <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <table class="display table table-bordered table-striped" id="cloudAccounting">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Customer Name</th>
                                <th>Address</th>
                                <th>Mobile No</th>
                                <th>Email</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($customerinfo)) {
                                foreach ($customerinfo as $customer) {
                                    echo '<tr>
                                <td>
                                <a  data-toggle="modal" href="#myModaldelete' . $customer->ledgerId . '">
                                <i  class="fa fa-times-circle delete-icon"></i> </a>
                                </td>';
                                    echo "<td  style='cursor:pointer' data-toggle='modal' href='#myModaledit" . $customer->ledgerId . "'>$customer->acccountLedgerName </td>";
                                    echo "<td style='cursor:pointer'  data-toggle='modal' href='#myModaledit" . $customer->ledgerId . "'> " . $customer->address . " </td>";
                                    echo "<td  style='cursor:pointer'   data-toggle='modal' href='#myModaledit" . $customer->ledgerId . "'>" . $customer->mobileNo . " </td>";
                                    echo "<td  style='cursor:pointer'  data-toggle='modal' href='#myModaledit" . $customer->ledgerId . "'>" . $customer->emailId . " </td>";
                                    echo "</tr>";
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


<!--...........................Edit..........................-->

<?php
if (isset($customerinfo)) {
    foreach ($customerinfo as $customer) {
        ?>
        <div class="modal fade" id="myModaledit<?php echo $customer->ledgerId; ?>" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel" align="Center">Add Supplier Information</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form class="cmxform form-horizontal tasi-form" id="supplier_add" method="post" action="">
                                    <div class="panel-body">
                                        <div class="form-group ">
                                            <label for="supplier_name" class="control-label col-lg-4">Supplier Name:</label>

                                            <div class="col-lg-8">
                                                <input type="hidden" id="realunername<?php echo $customer->ledgerId; ?>" value="<?php echo $customer->acccountLedgerName; ?>"/>
                                                <input class=" form-control "
                                                       id="customer_name2<?php echo $customer->ledgerId; ?>"
                                                       name="customer_name" type="text"
                                                       onchange="return customerNameCheckedit(<?php echo $customer->ledgerId; ?>)"
                                                       value="<?php echo $customer->acccountLedgerName; ?>"/>
                                                <span id="servermsg2<?php echo $customer->ledgerId; ?>"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group ">
                                            <label for="address" class="control-label col-lg-4">Address:</label>

                                            <div class="col-lg-8">
                                                <input class=" form-control "
                                                       id="address2<?php echo $customer->ledgerId; ?>"
                                                       name="address" type="text"
                                                       value="<?php echo $customer->address; ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group ">
                                            <label for="phone" class="control-label col-lg-4">Phone:</label>

                                            <div class="col-lg-8">
                                                <input class="form-control  "
                                                       id="phone2<?php echo $customer->ledgerId; ?>"
                                                       name="phone" type="text"
                                                       value="<?php echo $customer->phoneNo; ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group ">
                                            <label for="mobile" class="control-label col-lg-4">Mobile:</label>

                                            <div class="col-lg-8">
                                                <input class="form-control "
                                                       id="mobile2<?php echo $customer->ledgerId; ?>"
                                                       name="mobile" type="text"
                                                       value="<?php echo $customer->mobileNo; ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group ">
                                            <label for="email" class="control-label col-lg-4">Email:</label>

                                            <div class="col-lg-8">
                                                <input class="form-control  "
                                                       id="email2<?php echo $customer->ledgerId; ?>"
                                                       name="email" type="email"
                                                       value="<?php echo $customer->emailId; ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group ">
                                            <label for="opening_balance" class="control-label col-lg-4 ">Opening
                                                Balance:</label>

                                            <div class="col-lg-5">
                                                <input class="form-control "
                                                       id="opening_balance2<?php echo $customer->ledgerId; ?>"
                                                       type="text" name="opening_balance"
                                                       value="<?php echo $customer->openingBalance; ?>"/>

                                            </div>
                                            <div class="col-lg-2 ">
                                                <select name="dr_cr"
                                                        id="dr_cr2<?php echo $customer->ledgerId; ?>"
                                                        class="customer_debit pull-right ">

                                                    <option value="<?php echo $customer->debitOrCredit; ?>" selected><?php echo ($customer->debitOrCredit == 1) ? "Dr" : "Cr"; ?></option>
                                                    <?php
                                                    if ($customer->debitOrCredit == 0) {
                                                        echo ' <option value="1">Dr</option>';
                                                    } else {
                                                        echo '<option value="0">Cr</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group ">
                                            <label for="description"
                                                   class="control-label col-lg-4">Description:</label>

                                            <div class="col-lg-8 col-sm-8">
                                                <textarea class="form-control" id="description2<?php echo $customer->ledgerId; ?>" name="description" cols="30" rows="3"><?php echo $customer->description; ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="updatecustomer<?php echo $customer->ledgerId; ?>" onclick="return editcustomer(<?php echo $customer->ledgerId; ?>)">Update</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }
}
?>
<!-------------------------Add New------------------------------------->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                        <span id="servermsg"></span>
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
<!--..............................Delete.........................-->
<?php
if (isset($customerinfo)) {
    foreach ($customerinfo as $customer) {
        ?>
        <div class="modal fade" id="myModaldelete<?php echo $customer->ledgerId; ?>" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                                class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel" align="Center">Delete message</h4>
                    </div>
                    <form method="POST" action="<?php echo site_url('customer/customer/delete'); ?>">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <section class="panel">
                                        <div class="panel-body">
                                            <div class="form">
                                                <h4><i class="fa fa-warning"></i>&nbsp;Are you sure you want to delete the Customer :
                                                    <b><?php echo $customer->acccountLedgerName; ?> </b> !</h4>
                                                <input type="hidden" name="ledger_id" id="ledgerid<?php echo $customer->ledgerId; ?>"
                                                       value="<?php echo $customer->ledgerId; ?>">
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="deletecustomer<?php echo $customer->ledgerId; ?>" class="btn btn-danger" onclick="return deletecustomer(<?php echo $customer->ledgerId; ?>);">YES</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
        <?php
    }
}
?>
<!-- Warning Delete modal for accessed-->
<div class="modal fade" id="deletedinaccessed" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete message</h4>
            </div>
            <div class="modal-body">    
                <p><h4><i class="fa fa-warning"></i>&nbsp;Sorry !! You can not delete this customer!! This customer is in used</h4></p>
            </div>
            <div class="modal-footer">                 
                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
            </div>
        </div> 
    </div>
</div>
<!-- end warning delete modal-->
<script>
    // Add new data
    $('#submitaddcustomer').click(function () {
        var accountGrName = $("#servermsg").html();
        var customer_name = $("#customer_name1").val();
        if (accountGrName === "Customer Name not Available. Please try another") {
            $("#customer_name1").focus();
            return false;
        } else if (customer_name == "") {
            $("#customer_name1").css('border-color', 'red');
            $("#servermsg").text("This field is required!");
            $("#servermsg").css('color', 'red');
            return false;
        } else {
            var address = $("#address1").val();
            var phone = $("#phone1").val();
            var mobile = $("#mobile1").val();
            var email = $("#email1").val();
            var dr_cr = $("#dr_cr1").val();
            var opening_balance = $("#opening_balance1").val();
            var description = $("#description1").val();
            var company_id = $("#company_id1").val();
            var dataString = "customer_name=" + customer_name + "&address=" + address + "&phone=" + phone + "&company_id=" + company_id + "&mobile=" + mobile + "&email=" + email + "&dr_cr=" + dr_cr + "&opening_balance=" + opening_balance + "&description=" + description;
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('customer/customer/add'); ?>",
                data: dataString,
                success: function (data) {                    
                    if (data == 'Added') {
                        $('#myModal').modal('hide');
                        $.gritter.add({
                            title: 'Successfull!',
                            text: 'Customer Added Successfully',
                            sticky: false,
                            time: '5000'
                        });
                        return true;
                        window.location.reload();
                    }
                    if (data === 'Notadded') {
                        $('#myModal').modal('hide');
                        $.gritter.add({
                            title: 'Unsuccessfull!',
                            text: 'Customer Not Added ',
                            sticky: false,
                            time: '2000'
                        });                        
                    }                    
                }
            });
        }
    });
<?php $this->sessiondata = $this->session->userdata('logindata'); ?>
    $(document).ready(function () {
        var fyearstatus = "<?php echo $this->sessiondata['fyear_status']; ?>";
<?php foreach ($customerinfo as $unitvalue): ?>
            var id = "<?php echo $unitvalue->ledgerId; ?>"
            if (fyearstatus == '0') {
                $("#updatecustomer" + id).prop("disabled", true);
                $("#deletecustomer" + id).prop("disabled", true);               
            }
<?php endforeach; ?>
        if (fyearstatus == '0') {
            $("#addcustomer").prop("disabled", true);
        }
    });
</script>

