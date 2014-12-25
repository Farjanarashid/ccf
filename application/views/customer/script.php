<script type="text/javascript">
    function customerNameCheck() {
        var customer_name = $("#customer_name1").val();
        var dataString = "suppname=" + customer_name;
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('customer/customer/customerNameCheck'); ?>",
            data: dataString,
            success: function (data) {
                if (data == 'free') {
                    $("#customer_name1").css('border-color', 'green');
                    $("#servermsg").text("Customer name available");
                    $("#servermsg").css('color', 'green');
                    //return true;
                }
                if (data == 'booked') {
                    $("#customer_name1").css('border-color', 'red');
                    $("#servermsg").text("Customer Name not Available. Please try another");
                    $("#servermsg").css('color', 'red');
                    //return true;
                }

            }
        });
    }
    function customerNameCheckedit(id) {
        var customer_name = $("#customer_name2" + id).val();
        var dataString = "suppname=" + customer_name;
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('customer/customer/customerNameCheck'); ?>",
            data: dataString,
            success: function (data) {
                if (data == 'free') {
                    $("#customer_name2" + id).css('border-color', 'green');
                    $("#servermsg2" + id).text("Customer name available");
                    $("#servermsg2" + id).css('color', 'green');
                    return true;
                }
                if (data == 'booked') {
                    $("#customer_name2" + id).css('border-color', 'red');
                    $("#servermsg2" + id).text("Customer Name not Available. Please try another");
                    $("#servermsg2" + id).css('color', 'red');
                    //return true;
                }
            }
        });
    }
//submit edit data
    function editcustomer(id) {
        var accountName = $("#servermsg2" + id).html();
        if (accountName === "Customer Name not Available. Please try another") {
            $("#Customer_name2" + id).focus();
            return false;
        } else {
            var customer_name1 = $("#customer_name2" + id).val();
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
            var dataString = "customer_name=" + customer_name1 + "&address=" + address1 + "&country=" + country1 + "&company_id=" + company_id1 + "&realuser=" + realuser + "&phone=" + phone1 + "&mobile=" + mobile1 + "&email=" + email1 + "&dr_cr=" + dr_cr1 + "&opening_balance=" + opening_balance1 + "&description=" + description1;
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('customer/customer/edit'); ?>",
                data: dataString,
                success: function (data) {
                    if (data === 'Added') {
                        $('#myModaledit' + id).modal('hide');
                        $.gritter.add({                           
                            title: 'Successfull!',                            
                            text: 'Customer Edited Successfully',                           
                            sticky: false,                            
                            time: '5000'
                        });
                        setTimeout("window.location.reload(1)", 2000);
                        return true;
                    }
                    if (data === 'Notadded') {
                        $('#myModaledit' + id).modal('hide');
                        $.gritter.add({                           
                            title: 'Unsuccessfull!',                            
                            text: 'Customer Not Edited ',                           
                            sticky: false,                            
                            time: '2000'
                        });
                    }
                }
            });
        }
    }

//submit delete data
    function deletecustomer(id) {

        var ledgerid = $("#ledgerid" + id).val();
        var dataString = "ledgerid=" + ledgerid;

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('customer/customer/delete'); ?>",
            data: dataString,
            success: function (data) {
                if (data == 'deleted') {
                    $('#myModaldelete' + id).modal('hide');
                    $.gritter.add({                        
                        title: 'Successfull!',                        
                        text: 'Customer Deleted Successfully',                        
                        sticky: false,                        
                        time: '5000'
                    });
                    setTimeout("window.location.reload(1)", 2000);
                    return true;
                }
                if (data == 'Notdeleted') {
                    $('#myModaldelete' + id).modal('hide'); 
                    $("#deletedinaccessed").modal('show');
                }
            }
        });
    }
    function modalcloseforaddcustomer() {
        $("#customer_add")[0].reset();
    }
</script>



