<script>
//Find Company name for Invoice no
    $("#invoive_number").each(function(){
    var invoiceno=$(this).val();
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
        url: "<?php echo site_url('purchasereturn/purchase_return/findproductinfoedit'); ?>",
        data: dataString,
        success: function (data) {
            document.getElementById("addnewrow").innerHTML=data;


            //3rd part calculation
            var countproduct=$("#count_product").val();
            var count=1;
            var countqtyrate=0;
            var countvat=0;

<<<<<<< HEAD
            //hide empty return
//            for(count;count<=countproduct;count++){
//                var returnqty=$('#returnqty'+count).val();
//                if(returnqty == 0){
//                    $('.row'+count).hide();
//                    count=count-1;
//                }
//            }


=======
>>>>>>> 5c89c4458db615bd1289cc9f10b25ea017a72d67
            for(count;count<=countproduct;count++){
            //3rd part
            var qty2=parseInt($("#returnqty"+count).val());
            var id=$("#returnqty"+count).data("id");

            //For hide 0 return row
            if(qty2==0){
                $(".row"+count).hide();
            }

            var rate2=parseInt($("#rate"+count).val());
            var vat2 = parseInt($("#vat"+count).val());
            var discountsingle2 = parseInt($("#discountsingle"+count).val());

            var qtyrate=qty2 * rate2;
            var vatamount=(qtyrate-qtyrate*(discountsingle2/100)) * (vat2/100); //Vat amount
            var amount= qtyrate-(qtyrate*(discountsingle2/100))  //Amount
            countqtyrate=countqtyrate + amount;  //Total quantity* qty
            countvat=countvat + vatamount;  //Total vat
            }

            var totalamount= countqtyrate;  //total amount
            var grandtotal= totalamount + countvat;  //grand total


            document.getElementById("total_amout").innerHTML=totalamount;
            $(".total_amout").val(totalamount);

            document.getElementById("total_vat").innerHTML=countvat;
            $(".total_vat").val(countvat);

            document.getElementById("grandtotal").innerHTML=grandtotal;
            $(".grandtotal").val(grandtotal);

            document.getElementById("net_amout").innerHTML=grandtotal;
            $(".net_amout").val(grandtotal);


            //edit table for product
            $(".returnqty").change(function(){
            //3rd part
            var k=1;
            countvat=0;
            countqtyrate=0;
            for(k;k<count;k++){

            var qty3=parseInt($("#returnqty"+k).val());
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

            document.getElementById("total_amout").innerHTML=totalamount;
            $(".total_amout").val(totalamount);

            document.getElementById("total_vat").innerHTML=countvat;
            $(".total_vat").val(countvat);

            document.getElementById("grandtotal").innerHTML=grandtotal;
            $(".grandtotal").val(grandtotal);

            document.getElementById("net_amout").innerHTML=grandtotal;
            $(".net_amout").val(grandtotal);
            return false;
            });
            }
        });

    });
</script>