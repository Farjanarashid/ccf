
<script type="text/javascript">
    function adddebitedit(id) {
        var inputs = document.getElementsByClassName('editdebit' + id),
                names = [].map.call(inputs, function(input) {
            return input.value;
        });
        var sll = names.length;
        var i, total = 0;
        for (i = 0; i < sll; i++) {
            total = total + parseFloat(names[i]);
        }
        alert(total);
    }
    $(document).ready(function() {
        var divCounter = 2;
        $("#addButton").click(function() {
            var newTextBoxDiv = $(document.createElement('div'))
                    .attr("id", 'TextBoxDiv' + divCounter);
            newTextBoxDiv.after().html('<div class="col-lg-12" style="padding-left: 0px"><div class="panel-body"><div class="form-group"><div class="col-lg-4" id="addnewoption' + divCounter + '"></div><div class="col-lg-3"><input onchange="addnewdebit(' + divCounter + ')" id="debit' + divCounter + '" type="text" name="debit[]" class="form-control" placeholder="0.00"></div>\n\
            <div class="col-lg-5"><div class="col-lg-3" style="width:62%;padding-left:0px"><input onchange="addnewcredit(' + divCounter + ')" id="credit' + divCounter + '" type="text" name="credit[]" class="form-control" placeholder="0.00"></div><button type="button" class="btn btn-default pull-right" value="Remove" onclick="removeButton(' + divCounter + ')"><i class="fa fa-minus"></i></button></div></div></div></div>');
            newTextBoxDiv.appendTo("#TextBoxesGroup");
            var c = divCounter;
            var dataString = 'c=' + c;
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('journalentry/journalentry/ledgerdata'); ?>",
                data: dataString,
                success: function(data) {
                    //alert(data);
                    $("#addnewoption" + c).html(data);

                }
            });
            divCounter = divCounter + 1;
        });
    });

    function addButtonEdit(JournalMasterID) {
        alert("Hi " + JournalMasterID);
    }
    function removeButton(divCounter) {
        var newdebit_value = parseFloat($("#debit" + divCounter).val()) || 0;
        var newcredit_value = parseFloat($("#credit" + divCounter).val()) || 0;
        var total_debit = parseFloat($('#total_debit').val()) || 0;
        var total_credit = parseFloat($('#total_credit').val()) || 0;
        var new_total_debit = total_debit - newdebit_value;
        var new_total_credit = total_credit - newcredit_value;
        $("#total_debit").val(new_total_debit);
        $("#total_credit").val(new_total_credit);
        $("#TextBoxDiv" + divCounter).remove();
    }

    function adddebit(id) {
        var firstdebit_value = parseFloat($("#first_debit").val()) || 0;
        var seconddebit_value = parseFloat($("#second_debit").val()) || 0;
        var total = firstdebit_value + seconddebit_value;
        $("#total_debit").val(total);
    }

    function addnewdebit(id) {
        var total_debit = parseFloat($("#total_debit").val()) || 0;
        var newdebit_value = parseFloat($("#debit" + id).val()) || 0;
        var total = total_debit + newdebit_value;
        $("#total_debit").val(total);
    }
    function addcredit(id) {
        var firstcredit_value = parseFloat($("#first_credit").val()) || 0;
        var secondcredit_value = parseFloat($("#second_credit").val()) || 0;
        var total = firstcredit_value + secondcredit_value;
        $("#total_credit").val(total);
    }
    function addnewcredit(id) {
        var total_credit = parseFloat($("#total_credit").val()) || 0;
        var newcredit_value = parseFloat($("#credit" + id).val()) || 0;
        var total = total_credit + newcredit_value;
        $("#total_credit").val(total);
    }

</script>
