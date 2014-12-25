<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>
<style>
    .col-lg-2 {
        width: 10.666667%;
    }

    .align-right {
        float: right;
        font-weight: 500;
    }
</style>
<!--main content start-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                Balance Sheet
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix" style="margin: 10px 0;">
                        <div class="col-md-5" style="padding-left: 0">
                            <div class="input-group input-sm" >
                                <span class="input-group-addon">From </span>
                                <div class="iconic-input right">
                                    <i class="fa fa-calendar"></i>
                                    <input type="text" id="datetimepickerfrom" class="form-control" name="date_from"
                                           value="<?php echo $date_from; ?>">
                                </div>
                                <span class="input-group-addon">To</span>
                                <div class="iconic-input right">
                                    <i class="fa fa-calendar"></i>
                                    <input type="text" id="datetimepickerto" class="form-control" name="date_to"
                                           value="<?php echo $date_to; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <label>
                                <button class="btn btn-info" type="submit">Submit</button>
                            </label>
                        </div>
                        <div class="col-md-3 col-md-offset-1" style="margin-bottom: 15px;padding-top: 7px;">
                                <label>
                                    <input type="radio" checked="true" onclick="togglebankdiv()"  value="Condensed"  name="bank_book_radio">
                                    Group Wise &nbsp;&nbsp;&nbsp;&nbsp;
                                </label>
                                <label>
                                    <input type="radio"  value="Detailed" onclick="togglebankdiv()"   name="bank_book_radio">
                                    Ledger Wise
                                </label>
                        </div>
                        <div class="btn-group pull-right">
                            <button class="btn dropdown-toggle" data-toggle="dropdown">Export <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="#">Print</a></li>
                                <li><a href="#">Save as PDF</a></li>
                                <li><a href="#">Export to Excel</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div role="tabpanel" id="Condensed"  class="tab-pane active">
                        <table class="table table-striped table-hover table-bordered editable-sample1" id="editable-sample">
                            <thead>
                                <tr>
                                    <th>Liability</th>
                                    <th></th>

                                    <th>Asset</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="">

                                    <td>Supplier</td>
                                    <td><?= (isset($liabilitytotal))?$liabilitytotal:0;?></td>
                                    <td>Cash In Hand</td>
                                    <td><?= (isset($cashtotal))?$cashtotal:0;?></td>
                                </tr>
                                <tr class="">

                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>Customer</td>
                                    <td><?= (isset($customertotal))?$customertotal:0;?></td>
                                </tr>
                                <tr class="">

                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>Closing-Stock</td>
                                    <td><?= (isset($closingstockstotal))?$closingstockstotal:0;?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div role="tabpanel" id="Detailed"  class="tab-pane">
                        <table class="table table-striped table-hover table-bordered editable-sample1" id="editable-sample">
                            <thead>
                                <tr>
                                    <th>Liability</th>
                                    <th></th>

                                    <th>Asset</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(isset($liability)):foreach($liability as $liabilit):?>
                                <tr class="">
                                    <td><?= (isset($liabilit->name))?$liabilit->name:""?></td>
                                    <td><?= (isset($liabilit->totalpurchase))?$liabilit->totalpurchase:""?></td>
                                    <td><?= (isset($liabilit->name))?$liabilit->name:""?></td>
                                    <td><?= (isset($liabilit->name))?$liabilit->name:""?></td>
                                </tr>
                                <?php endforeach;endif;?>
<!--                                <tr class="">-->
<!---->
<!--                                    <td>Supplier-1</td>-->
<!--                                    <td>62500.00</td>-->
<!--                                    <td>Cash Account</td>-->
<!--                                    <td>-42246.00</td>-->
<!--                                </tr>-->
<!--                                <tr class="">-->
<!---->
<!--                                    <td>Supplier-2</td>-->
<!--                                    <td>0.00</td>-->
<!--                                    <td>Customer-Karim</td>-->
<!--                                    <td>0.00</td>-->
<!--                                </tr>-->
<!--                                <tr class="">-->
<!---->
<!--                                    <td>Supplier-3</td>-->
<!--                                    <td>0.00</td>-->
<!--                                    <td>Customer-Rahim</td>-->
<!--                                    <td>2800.00</td>-->
<!--                                </tr>-->
<!--                                <tr class="">-->
<!---->
<!--                                    <td></td>-->
<!--                                    <td></td>-->
<!--                                    <td>Closing-Stock</td>-->
<!--                                    <td>103870.00</td>-->
<!--                                </tr>-->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
            <div class="row" style=" padding-top: 10px">
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                    <section class="panel summary">
                        <header class="panel-heading">
                            Summary
                        </header>
                        <div class="panel-body">
                            <div class="row">
                                <ul class="unstyled amounts">
                                    <li><strong>Total profit :</strong><span class="align-right ">1924</span></li>
                                    <li><strong>Total Liability :</strong><span class="align-right ">64424</span></li>
                                    <li><strong>Total Asset :</strong> <span class="align-right ">64424</span></li>
                                </ul>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-lg-4"></div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--main content end-->
<!--modal-->

<?php include_once('footer.php'); ?>
<script>
    function togglebankdiv() {
        var selected_val = document.querySelector('input[name="bank_book_radio"]:checked').value;
        if (selected_val == "Detailed") {
            $("#Condensed").hide();
            $("#Detailed").show();
        } else {
            $("#Condensed").show();
            $("#Detailed").hide();
        }
    }

    var start_date = "<?php echo $this->sessiondata['mindate']; ?>";
    var end_date = "<?php echo $this->sessiondata['maxdate']; ?>";
    $('#datetimepickerfrom').datetimepicker({
        dayOfWeekStart: 1,
        lang: 'en',
        disabledDates: ['1986-01-08', '1986-01-09', '1986-01-10'],
        startDate: start_date,
        minDate: start_date,
        maxDate: end_date,
        timepicker: false
    });
    $('#datetimepickerto').datetimepicker({
        dayOfWeekStart: 1,
        lang: 'en',
        disabledDates: ['1986-01-08', '1986-01-09', '1986-01-10'],
        startDate: start_date,
        minDate: start_date,
        maxDate: end_date,
        timepicker: false
    });
</script>