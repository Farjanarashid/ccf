<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>
<!--main content start-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                Supplier Information
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
                            <button class="btn btn-info" id="addsupplier" data-toggle="modal" data-target="#myModal">
                                Add New <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <table class="display table table-bordered table-striped" id="cloudAccounting">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Supplier Name</th>
                                <th>Address</th>
                                <th>Mobile No</th>
                                <th>Email</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            if (isset($supplierinfo1)) {
                                foreach ($supplierinfo1 as $supplier1) {
                                    echo '<tr>
                                        <td>
                                        <a  data-toggle="modal" href="#myModaldelete' . $supplier1->ledgerId . '">
                                        <i  class="fa fa-times-circle delete-icon"></i> </a>
                                        </td>';
                                    echo "<td  style='cursor:pointer' data-toggle='modal' href='#myModaledit" . $supplier1->ledgerId . "'>$supplier1->acccountLedgerName </td>";

                                    $query = $this->db->query("SELECT  *  FROM  vendor WHERE ledgerId=$supplier1->ledgerId ORDER BY vendorId DESC LIMIT 1");
                                    $row = $query->row_array();
                                    if ((isset($row['address'])) || (isset($row['phoneNumber'])) || (isset($row['emailId']))) {
                                        $address = $row['address'];
                                        $phoneNumber = $row['phoneNumber'];
                                        $emailId = $row['emailId'];
                                    } else {
                                        $address = "";
                                        $phoneNumber = "";
                                        $emailId = "";
                                    }
                                    echo "<td style='cursor:pointer'  data-toggle='modal' href='#myModaledit" . $supplier1->ledgerId . "'>" . $address . "  </td>";
                                    echo "<td  style='cursor:pointer'   data-toggle='modal' href='#myModaledit" . $supplier1->ledgerId . "'>" . $phoneNumber . "</td>";
                                    echo "<td  style='cursor:pointer'  data-toggle='modal' href='#myModaledit" . $supplier1->ledgerId . "'>" . $emailId . "</td>";



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
<!--main content end-->
<!--Edit-->
<?php
if ((isset($supplierinfo2)) && (isset($supplierinfo1))) {
    foreach ($supplierinfo2 as $supplier) {
        foreach ($supplierinfo1 as $supplier2) {
            if ($supplier2->ledgerId == $supplier->ledgerId) {
                ?>
                <div class="modal fade" id="myModaledit<?php echo $supplier->ledgerId; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                                    <label for="supplier_name" class="control-label col-lg-4">Supplier
                                                        Name:</label>

                                                    <div class="col-lg-8">
                                                        <input type="hidden" id="realunername<?php echo $supplier->ledgerId; ?>" value="<?php echo $supplier->vendorName; ?>"/>
                                                        <input class=" form-control "
                                                               id="supplier_name2<?php echo $supplier->ledgerId; ?>"
                                                               name="supplier_name" type="text"
                                                               onchange="return supplierNameCheckedit(<?php echo $supplier->ledgerId; ?>)"
                                                               value="<?php echo $supplier->vendorName; ?>"/>
                                                        <span id="servermsg2<?php echo $supplier->ledgerId; ?>"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="form-group ">
                                                    <label for="address" class="control-label col-lg-4">Address:</label>

                                                    <div class="col-lg-8">
                                                        <input class=" form-control "
                                                               id="address2<?php echo $supplier->ledgerId; ?>"
                                                               name="address" type="text"
                                                               value="<?php echo $supplier->address; ?>"/>
                                                        <input  id="company_id2<?php echo $supplier->ledgerId; ?>"  name="company_id" type="hidden" value="<?php echo $supplier->companyId; ?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="form-group ">
                                                    <label for="country" class="control-label col-lg-4">Country:</label>
                                                    <div class="col-lg-4">
                                                        <select class="form-control" id="country2<?php echo $supplier->ledgerId; ?>" name="country">                                                            
                                                                    <?php
                                                                    if (isset($countries)) {
                                                                        foreach ($countries as $country) {?>                                                                           
                                                                        <option <?php if ($country->country_name == $supplier->country){echo 'selected';}?> value="<?php echo $country->country_name; ?>"><?php echo $country->country_name; ?></option>;
                                                                        <?php                                                                        
                                                                        }
                                                                    }
                                                                    ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="form-group ">
                                                    <label for="phone" class="control-label col-lg-4">Phone:</label>

                                                    <div class="col-lg-8">
                                                        <input class="form-control  "
                                                               id="phone2<?php echo $supplier->ledgerId; ?>"
                                                               name="phone" type="text"
                                                               value="<?php echo $supplier->phoneNumber; ?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="form-group ">
                                                    <label for="mobile" class="control-label col-lg-4">Mobile:</label>

                                                    <div class="col-lg-8">
                                                        <input class="form-control "
                                                               id="mobile2<?php echo $supplier->ledgerId; ?>"
                                                               name="mobile" type="text"
                                                               value="<?php echo $supplier->mobileNumber; ?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="form-group ">
                                                    <label for="email" class="control-label col-lg-4">Email:</label>

                                                    <div class="col-lg-8">
                                                        <input class="form-control  "
                                                               id="email2<?php echo $supplier->ledgerId; ?>"
                                                               name="email" type="email"
                                                               value="<?php echo $supplier->emailId; ?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="form-group ">
                                                    <label for="opening_balance" class="control-label col-lg-4 ">Opening
                                                        Balance:</label>

                                                    <div class="col-lg-5">
                                                        <input class="form-control "
                                                               id="opening_balance2<?php echo $supplier->ledgerId; ?>"
                                                               type="text" name="opening_balance"
                                                               value="<?php echo $supplier2->openingBalance; ?>"/>

                                                    </div>
                                                    <div class="col-lg-2 ">
                                                        <select name="dr_cr"
                                                                id="dr_cr2<?php echo $supplier->ledgerId; ?>"
                                                                class="supplier_debit pull-right ">
                                                            <option value="<?php echo $supplier2->debitOrCredit; ?>" selected><?php echo ($supplier2->debitOrCredit == 1) ? "Dr" : "Cr"; ?></option>
                                                            <?php
                                                            if ($supplier2->debitOrCredit == 0) {
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
                                                        <textarea class="form-control " id="description2<?php echo $supplier->ledgerId; ?>" name="description" cols="30" rows="3"><?php echo $supplier->description; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="updatesupplier<?php echo $supplier->ledgerId; ?>" onclick="return editsupplier(<?php echo $supplier->ledgerId; ?>)">Update</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
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
                <h4 class="modal-title" id="myModalLabel" align="Center">Add Supplier Information</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form class="cmxform form-horizontal tasi-form" id="supplier_add" method="post" action="">
                            <div class="panel-body">
                                <div class="form-group ">
                                    <label for="supplier_name" class="control-label col-lg-4">Supplier Name</label>
                                    <div class="col-lg-8">
                                        <input class=" form-control" id="supplier_name1" name="supplier_name" type="text" onchange="return supplierNameCheck()" value=""/>
                                        <input class=" form-control" id="paymentvouModal" name="paymentvouModal" type="hidden" value="addsuppliermodal"/>
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
                                    <label for="country" class="control-label col-lg-4">Country</label>

                                    <div class="col-lg-4">
                                        <select class=" form-control" id="country1" name="country">
                                            <?php                                          
                                                foreach ($countries as $country) {
                                                    echo "<option value='" . $country->country_name . "'>$country->country_name</option>";
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
                <button type="button" id="submitaddsupplier" class="btn btn-primary">Save</button>
                <button type="reset" class="btn btn-info">Reset</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
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
                <p><h4><i class="fa fa-warning"></i>&nbsp;Sorry !! You can not delete this supplier!! This supplier is in used</h4></p>
            </div>
            <div class="modal-footer">                 
                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
            </div>
        </div> 
    </div>
</div>
<!-- end warning delete modal-->
<!--..............................Delete.........................-->
<?php
if (isset($supplierinfo1)) {
    foreach ($supplierinfo1 as $supplier) {
        ?>
        <div class="modal fade" id="myModaldelete<?php echo $supplier->ledgerId; ?>" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                                class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel" align="Center">Delete message</h4>
                    </div>
                    <form method="POST" action="#">
                        <div class="modal-body">
                            <h4><i class="fa fa-warning"></i>&nbsp;Are you sure you want to delete the Supplier :
                                <b><?php echo $supplier->acccountLedgerName; ?> </b> !</h4>                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="deletesupplier<?php echo $supplier->ledgerId; ?>" class="btn btn-danger" onclick="return deletesupplier(<?php echo $supplier->ledgerId; ?>);">YES</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }
}
?>
<script>
<?php $this->sessiondata = $this->session->userdata('logindata'); ?>
    $(document).ready(function () {
        var fyearstatus = "<?php echo $this->sessiondata['fyear_status']; ?>";
<?php foreach ($supplierinfo1 as $unitvalue): ?>
            var id = "<?php echo $unitvalue->ledgerId; ?>"
            if (fyearstatus == '0') {
                $("#updatesupplier" + id).prop("disabled", true);
                $("#deletesupplier" + id).prop("disabled", true);               
            }
<?php endforeach; ?>
        if (fyearstatus == '0') {
            $("#addsupplier").prop("disabled", true);
        }
    });
</script>
<?php include_once('footer.php'); ?>
<script type="text/javascript">
    function supplierNameCheck() {
        var supplier_name = $("#supplier_name1").val();
        var dataString = "suppname=" + supplier_name;
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('supplier/suppliernamecheck'); ?>",
            data: dataString,
            success: function(data) {
                if (data == 'free') {
                    $("#supplier_name1").css('border-color', 'green');
                    $("#servermsg").text("Supplier name available");
                    $("#servermsg").css('color', 'green');
                    //return true;
                }
                if (data == 'booked') {
                    $("#supplier_name1").css('border-color', 'red');
                    $("#servermsg").text("Supplier Name not Available. Please try another");
                    $("#servermsg").css('color', 'red');
                    //return true;
                }
            }
        });
    }
    function supplierNameCheckedit(id) {
        var supplier_name = $("#supplier_name2" + id).val();
        var dataString = "suppname=" + supplier_name;
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('supplier/suppliernamecheck'); ?>",
            data: dataString,
            success: function(data) {
                if (data == 'free') {
                    $("#supplier_name2" + id).css('border-color', 'green');
                    $("#servermsg2" + id).text("Supplier name available");
                    $("#servermsg2" + id).css('color', 'green');
                    return true;
                }
                if (data == 'booked') {
                    $("#supplier_name2" + id).css('border-color', 'red');
                    $("#servermsg2" + id).text("Supplier Name not Available. Please try another");
                    $("#servermsg2" + id).css('color', 'red');
                    //return true;
                }
            }
        });
    }
    // Add new data
    $('#submitaddsupplier').click(function() {

        var accountGrName = $("#servermsg").html();
        var supplier_name = $("#supplier_name1").val();
        if (accountGrName === "Supplier Name not Available. Please try another") {
            $("#supplier_name1").focus();
            return false;
        }
        else if (supplier_name == "") {
            $("#supplier_name1").css('border-color', 'red');
            $("#servermsg").text("This field is required!");
            $("#servermsg").css('color', 'red');
            return false;
        } else {
            var address = $("#address1").val();
            var country = $("#country1").val();
            var phone = $("#phone1").val();
            var mobile = $("#mobile1").val();
            var email = $("#email1").val();
            var dr_cr = $("#dr_cr1").val();
            var opening_balance = $("#opening_balance1").val();
            var description = $("#description1").val();
            var company_id = $("#company_id1").val();
            var dataString = "supplier_name=" + supplier_name + "&address=" + address + "&country=" + country + "&phone=" + phone + "&company_id=" + company_id + "&mobile=" + mobile + "&email=" + email + "&dr_cr=" + dr_cr + "&opening_balance=" + opening_balance + "&description=" + description;
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('supplier/add'); ?>",
                data: dataString,
                success: function(data) {                   
                    if (data == 'Added') {
                        $('#myModal').modal('hide');
                        $.gritter.add({                            
                            title: 'Successfull!',                           
                            text: 'Supplier Added Successfully',                           
                            sticky: false,                         
                            time: '5000'
                        });
                        return true;
                    }
                    if (data == 'Notadded') {
                        $('#myModal').modal('hide');
                        $.gritter.add({                           
                            title: 'Unsuccessfull!',                           
                            text: 'Supplier Not Added ',                           
                            sticky: false,                            
                            time: '2000'
                        });
                    }
                   location.reload(); 
                }
            });
        }
    });

    //submit edit data
    function editsupplier(id) {
        var accountName = $("#servermsg2" + id).html();
        if (accountName === "Supplier Name not Available. Please try another") {
            $("#supplier_name2" + id).focus();
            return false;
        } else {
            var supplier_name1 = $("#supplier_name2" + id).val();
            var address1 = $("#address2" + id).val();
            var country1 = $("#country2" + id).val();
            var phone1 = $("#phone2" + id).val();
            var mobile1 = $("#mobile2" + id).val();
            var email1 = $("#email2" + id).val();
            var dr_cr1 = $("#dr_cr2" + id).val();
            var realuser = $("#realunername" + id).val();
            var opening_balance1 = $("#opening_balance2" + id).val();
            var description1 = $("#description2" + id).val();
            var company_id1 = $("#company_id2" + id).val();
            var dataString = "supplier_name=" + supplier_name1 + "&address=" + address1 + "&country=" + country1 + "&company_id=" + company_id1 + "&realuser=" + realuser + "&phone=" + phone1 + "&mobile=" + mobile1 + "&email=" + email1 + "&dr_cr=" + dr_cr1 + "&opening_balance=" + opening_balance1 + "&description=" + description1;
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('supplier/edit'); ?>",
                data: dataString,
                success: function(data) {
                    if (data == 'Added') {
                        $('#myModaledit' + id).modal('hide');
                        $.gritter.add({                            
                            title: 'Successfull!',                            
                            text: 'Supplier Updated Successfully',                            
                            sticky: false,                            
                            time: '5000'
                        });
                        setTimeout("window.location.reload(1)", 2000);
                        return true;
                    }
                    if (data == 'Notadded') {
                        $('#myModaledit' + id).modal('hide');
                        $.gritter.add({                            
                            title: 'Unsuccessfull!',                            
                            text: 'Supplier Updated Failed ',                            
                            sticky: false,                            
                            time: ''
                        });
                    }
                }
            });
        }
    }

    //submit delete data
    function deletesupplier(id) {
        var dataString = "ledgerid=" + id;
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('supplier/delete'); ?>",
            data: dataString,
            success: function(data) {
                if (data === 'deleted') {
                    $('#myModaldelete' + id).modal('hide');
                    $.gritter.add({                       
                        title: 'Successfull!',                       
                        text: 'Supplier Deleted Successfully',                      
                        sticky: false,                        
                        time: '5000'
                    });
                    setTimeout("window.location.reload(1)", 2000);
                    return true;
                }
                if (data === 'Notdeleted') {
                    $('#myModaldelete' + id).modal('hide');
                    $("#deletedinaccessed").modal('show');
                }
            }
        });
    }
</script>



