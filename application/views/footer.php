<!--footer start-->
<footer class="site-footer">
    <div class="text-center">
        2013 &copy; Cloud IT Ltd.
        <a href="#" class="go-top">
            <i class="fa fa-angle-up"></i>
        </a>
    </div>
</footer>
<!--footer end-->
</section>
<script src="<?php echo $baseurl; ?>assets/js/jquery.js"></script>
<script src="<?php echo $baseurl; ?>assets/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="<?php echo $baseurl; ?>assets/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="<?php echo $baseurl; ?>assets/js/jquery.scrollTo.min.js"></script>
<script src="<?php echo $baseurl; ?>assets/js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="<?php echo $baseurl; ?>assets/js/jquery.sparkline.js" type="text/javascript"></script>
<!--<script src="<?php echo $baseurl; ?>assets/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>-->
<script src="<?php echo $baseurl; ?>assets/js/owl.carousel.js" ></script>
<script src="<?php echo $baseurl; ?>assets/js/jquery.customSelect.min.js" ></script>
<script src="<?php echo $baseurl; ?>assets/js/respond.min.js" ></script>
<script type="text/javascript" src="<?php echo $baseurl; ?>assets/js/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo $baseurl; ?>assets/js/data-tables/DT_bootstrap.js"></script>

<!--script for this page-->

<!--<script src="<?php echo $baseurl; ?>assets/js/sparkline-chart.js"></script>
<script src="<?php echo $baseurl; ?>assets/js/easy-pie-chart.js"></script>-->
<script src="<?php echo $baseurl; ?>assets/js/count.js"></script>
<!--script for this page only-->
<!--<script src="<?php echo $baseurl; ?>assets/js/editable-table.js"></script>-->

<!--<script type="text/javascript" src="https://getfirebug.com/firebug-lite.js"></script>-->
<!--this page plugins-->

<script type="text/javascript" src="<?php echo $baseurl; ?>assets/js/fuelux/js/spinner.min.js"></script>
<!--<script type="text/javascript" src="<?php echo $baseurl; ?>assets/js/bootstrap-fileupload/bootstrap-fileupload.js"></script>-->
<script type="text/javascript" src="<?php echo $baseurl; ?>assets/js/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="<?php echo $baseurl; ?>assets/js/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script type="text/javascript" src="<?php echo $baseurl; ?>assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<!--<script type="text/javascript" src="<?php echo $baseurl; ?>assets/js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="<?php echo $baseurl; ?>assets/js/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="<?php echo $baseurl; ?>assets/js/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="<?php echo $baseurl; ?>assets/js/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="<?php echo $baseurl; ?>assets/js/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script type="text/javascript" src="<?php echo $baseurl; ?>assets/js/jquery-multi-select/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="<?php echo $baseurl; ?>assets/js/jquery-multi-select/js/jquery.quicksearch.js"></script>-->
<script type="text/javascript" src="<?php echo $baseurl; ?>assets/js/jquery.datetimepicker.js"></script>

<!--common script for all pages-->
<!--<script src="<?php echo $baseurl; ?>assets/js/advanced-form-components.js"></script>-->
<script src="<?php echo $baseurl; ?>assets/js/common-scripts.js"></script>
<!--gitter files -->
<script type="text/javascript" src="<?php echo $baseurl; ?>assets/assets/gritter/js/jquery.gritter.js"></script>
<script type="text/javascript" src="<?php echo $baseurl; ?>assets/js/gritter.js" ></script>
<!-- END JAVASCRIPTS -->-->
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        $('#cloudAccounting').dataTable({
            "sPaginationType": "full_numbers"
        });
    });
</script>
<?php $this->sessiondata = $this->session->userdata('logindata'); ?>
<script type="text/javascript">
    var start_date = "<?php echo $this->sessiondata['mindate']; ?>";
    var end_date = "<?php echo $this->sessiondata['maxdate']; ?>";
    $('#dailysearchfrom').datetimepicker({
        dayOfWeekStart: 1,
        lang: 'en',
        disabledDates: ['1986-01-08', '1986-01-09', '1986-01-10'],
        startDate: start_date,
        minDate: start_date,
        maxDate: end_date,
        timepicker: false
    });
    $('#dailysearchto').datetimepicker({
        dayOfWeekStart: 1,
        lang: 'en',
        disabledDates: ['1986-01-08', '1986-01-09', '1986-01-10'],
        startDate: start_date,
        minDate: start_date,
        maxDate: end_date,
        timepicker: false
    });
</script>
</body>
</html>