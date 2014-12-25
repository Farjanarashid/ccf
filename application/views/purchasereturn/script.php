<script>
    //Find Company name for Invoice no
    $("#invoive_number").change(function () {
        var invoiceno = $(this).val();
        var dataString = "invoiceno=" + invoiceno;
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('purchasereturn/purchase_return/findcompanyname'); ?>",
            data: dataString,
            success: function (data) {
                var res = data.split(",");
                $("#ladger_id").val(res[1]);
                $("#corparty_account").val(res[0]);
            }
        });
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('purchasereturn/purchase_return/findproductinfo'); ?>",
            data: dataString,
            success: function (data) {
                document.getElementById("addnewrow").innerHTML = data;




                //3rd part calculation
                var countproduct = $("#count_product").val();
                var count = 1;
                var countqtyrate = 0;
                var countvat = 0;
                for (count; count <= countproduct; count++) {
                    //3rd part
                    var qty2 = parseInt($("#qty" + count).val());
                    var rate2 = parseInt($("#rate" + count).val());
                    var vat2 = parseInt($("#vat" + count).val());
                    var discountsingle2 = parseInt($("#discountsingle" + count).val());
                    var qtyrate = qty2 * rate2;
                    var vatamount = (qtyrate - qtyrate * (discountsingle2 / 100)) * (vat2 / 100); //Vat amount
                    var amount = qtyrate - (qtyrate * (discountsingle2 / 100))  //Amount
                    countqtyrate = countqtyrate + amount;  //Total quantity* qty
                    countvat = countvat + vatamount;  //Total vat
                    var qty2=parseInt($("#returnqty"+count).val());
                    var rate2=parseInt($("#rate"+count).val());
                    var vat2 = parseInt($("#vat"+count).val());
                    var discountsingle2 = parseInt($("#discountsingle"+count).val());

                    var qtyrate=qty2 * rate2;
                    var vatamount=(qtyrate-qtyrate*(discountsingle2/100)) * (vat2/100); //Vat amount
                    var amount= qtyrate-(qtyrate*(discountsingle2/100))  //Amount
                    countqtyrate=countqtyrate + amount;  //Total quantity* qty
                    countvat=countvat + vatamount;  //Total vat
                }

                var totalamount = countqtyrate;  //total amount
                var grandtotal = totalamount + countvat;  //grand total


                document.getElementById("total_amout").innerHTML = totalamount;
                $(".total_amout").val(totalamount);

                document.getElementById("total_vat").innerHTML = countvat;
                $(".total_vat").val(countvat);

                document.getElementById("grandtotal").innerHTML = grandtotal;
                $(".grandtotal").val(grandtotal);

                document.getElementById("net_amout").innerHTML=grandtotal;
                $(".net_amout").val(grandtotal);

                //edit table for product
                $(".returnqty").change(function () {
                    var returnqty = $(this).val();
                    alert(returnqty);
                    //3rd part
                    var k = 1;
                    countvat = 0;
                    countqtyrate = 0;
                    for (k; k <= count; k++) {
                        var qty3 = parseInt($("#returnqty" + k).val());
                        var rate3 = parseInt($("#rate" + k).val());
                        var vat3 = parseInt($("#vat" + k).val());
                        var discountsingle3 = parseInt($("#discountsingle" + k).val());
                        var qtyrate = qty3 * rate3;
                $(".returnqty").change(function(){
                    var returnqty=$(this).val();
                    var returnqtyid=$(this).data("id");
                    //3rd part
                    var k=1;
                    countvat=0;
                    countqtyrate=0;
                    var   qty3=0;
                    for(k;k<count;k++){

                        if(k == returnqtyid){
                            qty3 =returnqty;
                        }
                        if(k != returnqtyid){
                            qty3=parseInt($("#returnqty"+k).val());
                        }
                        var rate3=parseInt($("#rate"+k).val());
                        var vat3 = parseInt($("#vat"+k).val());
                        var discountsingle3 = parseInt($("#discountsingle"+k).val());
                        var qtyrate= qty3 * rate3;

                        //Net amount per product
                        var vatamount = (qtyrate - qtyrate * (discountsingle3 / 100)) * (vat3 / 100); //Vat amount
                        var amount = qtyrate - ( qtyrate * (discountsingle3 / 100));  //Amount
                        var grandtotal = amount + vatamount;  //total amount

                        $("#product_amount" + k).text(grandtotal);

                        var vatamount = (qtyrate - qtyrate * (discountsingle3 / 100)) * (vat2 / 100); //Vat amount
                        var amount = qtyrate - (qtyrate * (discountsingle3 / 100))  //Amount
                        countqtyrate = countqtyrate + amount;  //Total quantity * rate
                        countvat = countvat + vatamount;  //Total vat
                        var vatamount=(qtyrate-qtyrate*(discountsingle3/100)) * (vat3/100); //Vat amount
                        var amount= qtyrate-(qtyrate*(discountsingle3/100))  //Amount
                        countqtyrate= countqtyrate+amount;  //Total quantity * rate
                        countvat=countvat+vatamount;  //Total vat
                    }

                    totalamount = countqtyrate;  //total amount
                    grandtotal = totalamount + countvat;  //total amount

                    document.getElementById("total_amout").innerHTML = totalamount;
                    $(".total_amout").val(totalamount);

                    document.getElementById("total_vat").innerHTML = countvat;
                    $(".total_vat").val(countvat);

                    document.getElementById("grandtotal").innerHTML = grandtotal;
                    $(".grandtotal").val(grandtotal);

                    document.getElementById("net_amout").innerHTML = grandtotal;
                    $(".net_amout").val(grandtotal);
                    return false;
                });
            }
        });

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('purchasereturn/purchase_return/finddiscount'); ?>",
            data: dataString,
            success: function (data) {
                document.getElementById("discount").innerHTML = data;
                var grandtotal = $(".grandtotal").val();
                var netamount = grandtotal - data;
                document.getElementById("net_amout").innerHTML = netamount;
                $(".net_amout").val(netamount);

            }
        });

    });
</script>


<?php
if ((isset($data_added)) && ($data_added == "added")) {

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
if ((isset($data_added)) && ($data_added == "edited")) {

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
if ((isset($data_added)) && ($data_added == "deleted")) {

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
if ((isset($data_added)) && ($data_added == "notdeleted")) {

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
