
<script type="text/javascript">
    $(document).ready(function() {
        window.onload = function() {
            var value = "ByCash";
            var dataString = 'value=' + value;
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('paymentvoucher/paymentvoucher/getledger'); ?>",
                data: dataString,
                cache: false,
                success: function(data) {
                    document.getElementById("banknames").innerHTML = data;
                }
            });
            $('#chequeNumber').prop('readonly', true);
            $('#chequeDate').prop('readonly', true);
        };
        $('.radiobutton').click(function() {
            $('#paidto select').empty();
            $('#currentbalance').val(" ");
            var value = $(this).val();
            if (value === "ByCheque") {
                $('#chequeNumber').prop('readonly', false);
                $('#chequeDate').prop('readonly', false);
                $('#paymentMode').prop('disabled', false);
                var dataString = 'value=' + value;
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('paymentvoucher/paymentvoucher/getledger'); ?>",
                    data: dataString,
                    cache: false,
                    success: function(data) {
                        document.getElementById("banknames").innerHTML = data;
                    }
                });
            }
            else {
                var dataString = 'value=' + value;
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('paymentvoucher/paymentvoucher/getledger'); ?>",
                    data: dataString,
                    cache: false,
                    success: function(data) {
                        document.getElementById("banknames").innerHTML = data;
                    }
                });
                $('#chequeNumber').prop('readonly', true);
                $('#chequeDate').prop('readonly', true);
            }
        });
        $('.hidefields').hide();
        $('#voutype').change(function() {
            var purid = $("#voucherType").val();
            var ledgerid = $('#ledgerId').val();
            var dataString = 'purid=' + purid + '&ledgerid=' + ledgerid;
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('paymentvoucher/paymentvoucher/invoicedata'); ?>",
                data: dataString,
                dataType: 'json',
                success: function(data) {
                    $('#fullamount').val(data.amountvalue);
                    $('#purchaseid').val(data.purchaseid);
                    $('#voucherNumber').val(data.purchaseid);
                }
            });
            $('.hidefields').show();
        });
    });
    $('#banknames').change(function() {
        var ledgerid = $('#paymentMode').val();
        if (ledgerid === "addsuplr") {
            $('#myModalsup').modal();
        }
    });
    $('#paidto').change(function() {
        var value = $('#ledgerId').val();
        var dataString = 'ledgerid=' + value;
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('paymentvoucher/paymentvoucher/currentbalance'); ?>",
            data: dataString,
            success: function(data) {
                $('#currentbalance').val(data);
            }
        });
        if (value === "addpsuplr") {
            $('#myModalsup').modal();
        }
    });

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
        }
    });

    function setpaidto()
    {
        var ledgerid = $('#paymentMode').val();
        var dataString = 'ledgerid=' + ledgerid;
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('paymentvoucher/paymentvoucher/paidtoname'); ?>",
            data: dataString,
            cache: false,
            success: function(data) {
                document.getElementById("paidto").innerHTML = data;
            }
        });
    }
    function vouinfo()
    {
        var valag = $("#agnstornew").val();
        $('#referenceType').val(valag);
        var ledgerid = $('#ledgerId').val();
        var dataString = 'ledgerid=' + ledgerid;
        if (valag === "Against") {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('paymentvoucher/paymentvoucher/vouinfo'); ?>",
                data: dataString,
                success: function(data) {
                    document.getElementById("voutype").innerHTML = data;
                }
            });
        }
        if (valag === "New") {
            $('.hidefields').show();
            $('#voutype select').empty();
            $('#purchaseid').val("");
            $('#fullamount').val("");
        }
        else
        {
            $('#voutype select').empty();
        }
    }
    function editvouinfo(id)
    {
        var paymentmasid = $('#paymentmasid').val();
        var dataString = "id=" + id + "&paymentmasid=" + paymentmasid;
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('paymentvoucher/paymentvoucher/editvouinfo'); ?>",
            data: dataString,
            success: function(data) {
                document.getElementById("editvoutype").innerHTML = data;
            }
        });
    }
    function excuteall()
    {

        againstclick1();
        editmodalinfo();

    }
    function editmodalinfo()
    {
        var purid = $("#voucherType").val();
        var ledgerid = $('#ledgerId').val();
        var dataString = 'purid=' + purid + '&ledgerid=' + ledgerid;
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('paymentvoucher/paymentvoucher/invoicedata'); ?>",
            data: dataString,
            dataType: 'json',
            success: function(data) {
                $('#fullamount').val(data.amountvalue);
                $('#purchaseid').val(data.purchaseid);
                $('#voucherNumber').val(data.purchaseid);
            }
        });
    }
    function againstclick1() {
        var id = $('#ledgerId').val();
        var ref = $('#referenceType').val();
        var paymentmasid = $('#paymentmasid').val();
        var dataString = "id=" + id + "&paymentmasid=" + paymentmasid + "&ref=" + ref;
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('paymentvoucher/paymentvoucher/editvouinfo'); ?>",
            data: dataString,
            success: function(data) {               
                document.getElementById("editvoutype").innerHTML = data;
            }
        });
    }
    function amountbalance()
    {
        var fullamount = document.getElementById("fullamount").value;
        var balance = document.getElementById("paidamount").value;
//        var intval1 = parseInt(fullamount);
//        var intval2 = parseInt(balance);
//        if (intval1 > intval2) {
//            $("#paidamount").css('border-color', 'green');
//            $("#pservermsg").text("valid amount");
//            $("#pservermsg").css('color', 'green');
        $('#amount').val(balance);
        $('#myModalagnst').modal('hide');
//        }
//        if (intval1 < intval2)
//        {
//            $("#paidamount").css('border-color', 'red');
//            $("#pservermsg").text("Paid amount cannot be high than due amount");
//            $("#pservermsg").css('color', 'red');
//        }
    }

    function editamountbalance()
    {
        var balance = $('#editpaidamount').val();
        $('#amount').val(balance);
        $('#editmyModalagnst').modal('hide');
    }
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

</script>

