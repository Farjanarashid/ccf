<script>
    //customer name check
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
                    $("#servermsg2").text("Customer name available");
                    $("#servermsg2").css('color', 'green');
                    //return true;
                }
                if (data == 'booked') {
                    $("#customer_name1").css('border-color', 'red');
                    $("#servermsg2").text("Customer Name not Available. Please try another");
                    $("#servermsg2").css('color', 'red');
                    //return true;
                }

            }
        });
    }



        // Add new customer
        $('#submitaddcustomer').click(function () {
            var accountGrName = $("#servermsg2").html();
            var customer_name = $("#customer_name1").val();
            if (accountGrName === "Customer Name not Available. Please try another") {
                $("#customer_name1").focus();
                return false;
            } else if (customer_name == "") {
                $("#customer_name1").css('border-color', 'red');
                $("#servermsg2").text("This field is required!");
                $("#servermsg2").css('color', 'red');
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
                            $('#myModalnews').modal('hide');
                            $.gritter.add({
                                title: 'Successfull!',
                                text: 'Customer Added Successfully',
                                sticky: false,
                                time: '5000'
                            });
                            return true;
                           location.reload(4000);
                        }
                        if (data === 'Notadded') {
                            $('#myModalnews').modal('hide');
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
        // Add new customer
    $("#corparty_account").change(function(){
        var value=$("#corparty_account").val();
       if(value=="3newone"){
           $('#myModalnews').modal();
       }
    });


        //When click on credit
        $(".credit_period").hide();
        $('input[name=cash_cr]').change(function() {
            if (this.id == "credit") {
                $(".credit_period").show();
            } else {
                $(".credit_period").hide();
            }
        });

        //when put value
        $("#product_name").change(function(){
            $("#product_name").css('border-color', '#898990');
        });
        $("#qty").change(function(){
            $("#qty").css('border-color', '#898990');
        });
        $("#rate").change(function(){
            $("#rate").css('border-color', '#898990');
        });

        //click on reset for products
        $("#product-reset").click(function(){
            $("#product_name").val("");
            $("#qty").val("");
            $("#unit").val("");
            $("#unitshow").val("");
            $("#rate").val("");
            $("#discountsingle").val("");
            $("#vat").val("");
        });

    //data append into table from session
             var count=0;
             var countqtyrate=0;
             var countvat=0;
            $("#addpurchase").click(function(){
                    count=count+1;
                    var product_name = $("#product_name").val();
                    var qty = $("#qty").val();
                    var unit = $("#unit").val();
                    var rate = $("#rate").val();
                    var discountsingle = $("#discountsingle").val();
                    var vat = $("#vat").val();
                    var qtymsg = $("#qtymsg").text();

                    if(vat==""){
                        vat=0.00;
                    }
                    if(discountsingle==""){
                        discountsingle=0.00;
                    }
                    if(qtymsg=="Limit exceeds!"){
                        return false;
                    }
                    if(product_name==""){
                        $("#product_name").css('border-color', 'red');
                        return false;
                    }
                    if(qty==""){
                        $("#qty").css('border-color', 'red');
                        return false;
                    }
                    if(rate==""){
                        $("#rate").css('border-color', 'red');
                        return false;
                    }

                    var dataString = "count=" + count + "&product_name=" + product_name + "&qty=" + qty +"&discountsingle=" + discountsingle + "&unit=" + unit + "&rate=" + rate + "&vat=" + vat;

                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('sales/sales/add_view_table'); ?>",
                    data: dataString,
                    success: function (data) {
                        $("#addnewrow").append(data);

                        //3rd part
                        var qty2=parseInt($("#qty"+count).val());
                        var rate2=parseInt($("#rate"+count).val());
                        var vat2 = parseInt($("#vat"+count).val());
                        var discountsingle2 = parseInt($("#discountsingle"+count).val());

                        var qtyrate=qty2 * rate2;
                        var vatamount=(qtyrate-qtyrate*(discountsingle2/100)) * (vat2/100); //Vat amount
                        var amount= qtyrate-(qtyrate*(discountsingle2/100))  //Amount
                        countqtyrate=countqtyrate + amount;  //Total quantity * rate
                        countvat=countvat + vatamount;  //Total vat

                        var totalamount= countqtyrate;  //total amount
                        var grandtotal= totalamount + countvat;  //total amount

                        document.getElementById("total_amout").innerHTML=totalamount;
                        $(".total_amout").val(totalamount);

                        document.getElementById("total_vat").innerHTML=countvat;
                        $(".total_vat").val(countvat);

                        document.getElementById("grandtotal").innerHTML=grandtotal;
                        $(".grandtotal").val(grandtotal);

                        document.getElementById("net_amout").innerHTML=grandtotal;
                        $(".net_amout").val(grandtotal);



                        //2nd part click for edit data from table view
                        $(".edit-field").click(function(){
                            $(this).find("span").hide();
                            $(this).find("input").prop("type","text");

                        });
                        //edit table for product
                        $(".edit_input").change(function(){
                            var value=$(this).val();
                            $(this).siblings("span").show();
                            $(this).siblings("span").text(value);
                            $(this).prop("type","hidden");

                            //3rd part
                            var k=1;
                            countvat=0;
                            countqtyrate=0;
                            for(k;k<=count;k++){
                            var qty3=parseInt($("#qty"+k).val());
                            var rate3=parseInt($("#rate"+k).val());
                            var vat3 = parseInt($("#vat"+k).val());
                            var discountsingle3 = parseInt($("#discountsingle"+k).val());
                            var qtyrate= qty3 * rate3;

                                //Net amount per product
                                var vatamount=(qtyrate-qtyrate*(discountsingle3/100)) * (vat3/100); //Vat amount
                                var amount=  qtyrate-( qtyrate*(discountsingle3/100));  //Amount
                                var grandtotal= amount + vatamount;  //total amount

                                $("#product_amount"+k).text(grandtotal);


                             var vatamount=(qtyrate-qtyrate*(discountsingle3/100)) * (vat3/100); //Vat amount
                             var amount= qtyrate-(qtyrate*(discountsingle3/100))  //Amount
                             countqtyrate= countqtyrate+amount;  //Total quantity * rate
                             countvat=countvat+vatamount;  //Total vat
                            }

                             totalamount= countqtyrate;  //total amount
                             grandtotal= totalamount + countvat;  //total amount
                            var discount=$("#discount").val();
                            var net_amout=grandtotal-discount;

                            document.getElementById("total_amout").innerHTML=totalamount;
                            $(".total_amout").val(totalamount);

                            document.getElementById("total_vat").innerHTML=countvat;
                            $(".total_vat").val(countvat);

                            document.getElementById("grandtotal").innerHTML=grandtotal;
                            $(".grandtotal").val(grandtotal);

                            document.getElementById("net_amout").innerHTML=net_amout;
                            $(".net_amout").val(net_amout);
                            return false;
                        });

                        //count_product
                        $(".count_product").val(count);
                    }
                });

                //clear value fields

                    $("#product_name").val("");
                    $("#qty").val("");
                    $("#unit").val("");
                    $("#unitshow").val("");
                    $("#rate").val("");
                    $("#discountsingle").val("");
                    $("#vat").val("");
                });


        //3rd part for discount
        $("#discount").change(function(){
            var grandtotal=$(".grandtotal").val();
            var discount=$("#discount").val();
            var net_amout=grandtotal-discount;

            document.getElementById("net_amout").innerHTML=net_amout;
            $(".net_amout").val(net_amout);
        });

        //show unit id and rate
        $("#product_name").change(function(){
            var product_id=$(this).val();
            //alert(product_id);
            var dataString = "product_id=" + product_id;

            //for unit
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('sales/sales/unit_name'); ?>",
                data: dataString,
                success: function (data) {
                    var res = data.split(",");
                    $("#unitshow").val(res[1]);
                    $("#unit").val(res[0]);
                }
                });

            //for rate
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('sales/sales/product_salerate'); ?>",
                data: dataString,
                success: function (data) {
                    $("#rate").val(data);
                }
            });
            //for rate
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('sales/sales/product_qty'); ?>",
                data: dataString,
                success: function (data) {
                    var range=data;
                    if(range==""){
                        range=0;
                    }
                    $("#qtymsg").text("Available qty is "+range );
                    $("#qtymsg").css('color', 'green');
                    $("#qty").change(function(){
                        var qtyval=parseInt($("#qty").val());
                        if(qtyval>range){
                            $("#qty").css('border-color', 'red');
                            $("#qtymsg").text("Limit exceeds!");
                            $("#qtymsg").css('color', 'red');
                        }else{
                            $("#qty").css('border-color', '#898990');
                            $("#qtymsg").text("Available qty is "+range);
                            $("#qtymsg").css('color', 'green');
                        }
                    });
                }
            });
        });


    //Check Invoice Number
    $("#order_no").change(function(){
        var order_no=$(this).val();
        var companyid=$("#company_id").val();
        var dataString = "order_no=" + order_no + "&companyid=" + companyid ;

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('sales/sales/checkorderno'); ?>",
            data: dataString,
            success: function (data) {
                if(data=="found"){
                    $("#order_no").css('border-color', 'red');
                    $("#servermsg").text("Order No is already exist!");
                    $("#servermsg").css('color', 'red');
                }
                if(data=="notfound"){
                    $("#order_no").css('border-color', '#898990');
                    $("#servermsg").text("Order No is Available!");
                    $("#servermsg").css('color', 'green');

                }
            }
        });
    });

    $("#addpurchase_submit").click(function(){
        var msg=$("#servermsg").text();
        if(msg=="Order No is already exist!"){
            return false;
        }
    });



    //Date time picker
    <?php $this->sessiondata = $this->session->userdata('logindata'); ?>
    var start_date = "<?php echo $this->sessiondata['mindate']; ?>";
    var end_date = "<?php echo $this->sessiondata['maxdate']; ?>";
    $('#datetimepicker').datetimepicker({
        dayOfWeekStart : 1,
        lang:'en',
        disabledDates:['1986-01-08','1986-01-09','1986-01-10'],
        startDate:'2014-12-01',
        minDate:start_date,
        maxDate:end_date,
        timepicker:false
    });
</script>
<?php
if((isset($data_added)) && ($data_added=="added")){

?>
    <script>
    $(document).ready(function () {
        //show gritter after add data
        $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Successfull!',
            // (string | mandatory) the text inside the notification
            text: 'Data Added Successfully',
            // (string | optional) the image to display on the left
            // image: 'img/avatar-mini.jpg',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: false,
            // (int | optional) the time you want it to be alive for before fading out
            time: '5000'
        });
    });
</script>
<?php
}
?>


<?php
if((isset($data_added)) && ($data_added=="edited")){

    ?>
    <script>
        $(document).ready(function () {
            //show gritter after add data
            $.gritter.add({
                // (string | mandatory) the heading of the notification
                title: 'Successfull!',
                // (string | mandatory) the text inside the notification
                text: 'Data Edited Successfully',
                // (string | optional) the image to display on the left
                // image: 'img/avatar-mini.jpg',
                // (bool | optional) if you want it to fade out on its own or just sit there
                sticky: false,
                // (int | optional) the time you want it to be alive for before fading out
                time: '5000'
            });
        });
    </script>
<?php
}
?>

<?php
if((isset($data_added)) && ($data_added=="deleted")){

    ?>
    <script>
        $(document).ready(function () {
            //show gritter after add data
            $.gritter.add({
                // (string | mandatory) the heading of the notification
                title: 'Successfull!',
                // (string | mandatory) the text inside the notification
                text: 'Data Deleted Successfully',
                // (string | optional) the image to display on the left
                // image: 'img/avatar-mini.jpg',
                // (bool | optional) if you want it to fade out on its own or just sit there
                sticky: false,
                // (int | optional) the time you want it to be alive for before fading out
                time: '5000'
            });
        });
    </script>
<?php
}
?>


<?php
if((isset($data_added)) && ($data_added=="notdeleted")){

    ?>
    <script>
        $(document).ready(function () {
            //show gritter after add data
            $.gritter.add({
                // (string | mandatory) the heading of the notification
                title: 'Failed Deleted!',
                // (string | mandatory) the text inside the notification
                text: 'Data is not Deleted',
                // (string | optional) the image to display on the left
                // image: 'img/avatar-mini.jpg',
                // (bool | optional) if you want it to fade out on its own or just sit there
                sticky: false,
                // (int | optional) the time you want it to be alive for before fading out
                time: '5000'
            });
        });
    </script>
<?php
}
?>


<?php
if((isset($data_added)) && ($data_added=="add_unit")){

    ?>
    <script>
        $(document).ready(function () {
            //show gritter after add data
            $.gritter.add({
                // (string | mandatory) the heading of the notification
                title: 'Successfull!',
                // (string | mandatory) the text inside the notification
                text: 'New Unit created  Successfully',
                // (string | optional) the image to display on the left
                // image: 'img/avatar-mini.jpg',
                // (bool | optional) if you want it to fade out on its own or just sit there
                sticky: false,
                // (int | optional) the time you want it to be alive for before fading out
                time: '5000'
            });
        });
    </script>
<?php
}
?>

