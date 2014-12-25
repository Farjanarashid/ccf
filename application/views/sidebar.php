<!--sidebar start-->
<aside>
    <div id="sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">

            <li class=" sub-menu " >
                <a href="javascript:;" class="<?php echo (isset($active_menu) && ($active_menu == 'master')) ? 'active' : ''; ?>" >
                    <i class="fa fa-laptop"></i>
                    <span>Master</span>
                </a>
                <ul class="sub">
                    <li class="<?php echo (isset($active_sub_menu) && ($active_sub_menu == 'accountGroup')) ? 'active' : ''; ?>"><a  href="<?php echo site_url('home/accountGroup'); ?>">Account Group</a></li>
                    <li class="<?php echo (isset($active_sub_menu) && ($active_sub_menu == 'accountLedger')) ? 'active' : ''; ?>"><a  href="<?php echo site_url('accountLedger'); ?>">Account Ledger</a></li>                    
                    <li class="<?php echo (isset($active_sub_menu) && ($active_sub_menu == 'home')) ? 'active' : ''; ?>"><a  href="<?php echo site_url('supplier'); ?>">Supplier</a></li>
                    <li class="<?php echo (isset($active_sub_menu) && ($active_sub_menu == 'customer')) ? 'active' : ''; ?>"><a  href="<?php echo site_url('customer/customer'); ?>">Customer</a></li>
                    <li class="<?php echo (isset($active_sub_menu) && ($active_sub_menu == 'farmer')) ? 'active' : ''; ?>"><a  href="<?php echo site_url('farmer/farmer'); ?>">Farmer</a></li>
                    <li class="<?php echo (isset($active_sub_menu) && ($active_sub_menu == 'manufacture')) ? 'active' : ''; ?>"><a  href="<?php echo site_url('manufacture/manufacture'); ?>">Manufacturer</a></li>
                    <li class="<?php echo (isset($active_sub_menu) && ($active_sub_menu == 'unit')) ? 'active' : ''; ?>"><a  href="<?php echo site_url('productunit/unit'); ?>">Unit</a></li>
                    <li class="<?php echo (isset($active_sub_menu) && ($active_sub_menu == 'productGroup')) ? 'active' : ''; ?>"><a  href="<?php echo site_url('productlist/productGroup'); ?>">Product Group</a></li>
                    <li class="<?php echo (isset($active_sub_menu) && ($active_sub_menu == 'product')) ? 'active' : ''; ?>"><a  href="<?php echo site_url('productlist/product'); ?>">Product</a></li>
                    
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:;" class="<?php echo (isset($active_menu) && ($active_menu == 'transaction')) ? 'active' : ''; ?>">
                    <i class="fa fa-laptop"></i>
                    <span>Transaction</span>
                </a>
                <ul class="sub">
                    <li class="<?php echo (isset($active_sub_menu) && ($active_sub_menu == 'purchase')) ? 'active' : ''; ?>"><a  href="<?php echo site_url('purchase/purchase'); ?>">Purchase</a></li>
                    <li class="<?php echo (isset($active_sub_menu) && ($active_sub_menu == 'purchasereturn')) ? 'active' : ''; ?>"><a  href="<?php echo site_url('purchasereturn/purchase_return'); ?>">Purchase Return</a></li>
                    <li class="<?php echo (isset($active_sub_menu) && ($active_sub_menu == 'sales')) ? 'active' : ''; ?>"><a  href="<?php echo site_url('sales/sales'); ?>">Sales</a></li>
                    <li class="<?php echo (isset($active_sub_menu) && ($active_sub_menu == 'salesfarmer')) ? 'active' : ''; ?>"><a  href="<?php echo site_url('salesfarmer/salesfarmer'); ?>">Sales Farmer</a></li>
                    <li class="<?php echo (isset($active_sub_menu) && ($active_sub_menu == 'paymentvoucher')) ? 'active' : ''; ?>"><a  href="<?php echo site_url('paymentvoucher/paymentvoucher'); ?>">Payment Voucher</a></li>
                    <li class="<?php echo (isset($active_sub_menu) && ($active_sub_menu == 'receiptvoucher')) ? 'active' : ''; ?>"><a  href="<?php echo site_url('receiptvoucher/receiptvoucher'); ?>">Receipt Voucher</a></li>
                    <li class="<?php echo (isset($active_sub_menu) && ($active_sub_menu == 'journalentry')) ? 'active' : ''; ?>"><a  href="<?php echo site_url('journalentry/journalentry'); ?>">Journal Entry</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:;"  class="<?php echo (isset($active_menu) && ($active_menu == 'account_statement')) ? 'active' : ''; ?>">
                    <i class="fa fa-laptop"></i>
                    <span>Account Statements</span>
                </a>
                <ul class="sub">
                    <li class="<?php echo (isset($active_sub_menu) && ($active_sub_menu == 'cash_book')) ? 'active' : ''; ?>"><a  href="<?php echo site_url('home/cash_book'); ?>">Cash Book</a></li>
                    <li class="<?php echo (isset($active_sub_menu) && ($active_sub_menu == 'bank_book')) ? 'active' : ''; ?>"><a  href="<?php echo site_url('home/bank_book'); ?>">Bank Book</a></li>
                    <li class="<?php echo (isset($active_sub_menu) && ($active_sub_menu == 'day_book')) ? 'active' : ''; ?>"><a  href="<?php echo site_url('home/day_book'); ?>">Day book</a></li>
                    <li class="<?php echo (isset($active_sub_menu) && ($active_sub_menu == 'trail_balance')) ? 'active' : ''; ?>"><a  href="<?php echo site_url('home/trail_balance'); ?>">Trail Balance</a></li>
                    <li class="<?php echo (isset($active_sub_menu) && ($active_sub_menu == 'ladger_balance')) ? 'active' : ''; ?>"><a  href="<?php echo site_url('home/ladger_balance'); ?>">Ledger Balance</a></li>
                    <li class="<?php echo (isset($active_sub_menu) && ($active_sub_menu == 'profit_loss')) ? 'active' : ''; ?>"><a  href="<?php echo site_url('home/profit_loss'); ?>">Profit and Loss Analysis</a></li>
                    <li class="<?php echo (isset($active_sub_menu) && ($active_sub_menu == 'balance_sheet')) ? 'active' : ''; ?>"><a  href="<?php echo site_url('home/balance_sheet'); ?>">Balance Sheet</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:;"  class="<?php echo (isset($active_menu) && ($active_menu == 'report')) ? 'active' : ''; ?>" >
                    <i class="fa fa-laptop"></i>
                    <span>Report</span>
                </a>
                <ul class="sub">
                    <li class="<?php echo (isset($active_sub_menu) && ($active_sub_menu == 'transection')) ? 'active' : ''; ?>"><a  href="<?php echo site_url('home/transection'); ?>">Transection</a></li>
                    <li class="<?php echo (isset($active_sub_menu) && ($active_sub_menu == 'stock_sale')) ? 'active' : ''; ?>"><a  href="<?php echo site_url('home/stock_sale'); ?>">Stock and sale</a></li>
                    <li class="<?php echo (isset($active_sub_menu) && ($active_sub_menu == 'dailysale')) ? 'active' : ''; ?>"><a  href="<?php echo site_url('dailysale/dailysale'); ?>">Daily Sale</a></li>
                </ul>
            </li>

        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->