<!-- Left side column. contains the logo and sidebar -->
<?php
foreach($details as $det) {
    $fname = $det['first_name'];
    $lname = $det['last_name'];
    $mail = $det['email'];
}
?>
<aside class="sidebar-left">
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url();?>assets/resources/img/icons/icon-user.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="info">
                <p><?php echo $fname;?></p>
                <p><small><?php echo $lname;?></small>
                </p>
                <a href="#"><i class="fa fa-circle text-success"></i> Admin</a>
            </div>

        </div>
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview"><a href="<?php echo site_url('System/dashboard');?>"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
            <li class="treeview"><a href="<?php echo site_url('System/members');?>"><i class="fa fa-users"></i> <span>Members</span></a></li>
            <li class="treeview">
                <a href="#"><i class="fa fa-google-wallet"></i> <span>Payments</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('System/registration_fee');?>">Registration Fees</a></li>
                    <li><a href="<?php echo site_url('System/contributions');?>">Contribution/Savings</a></li>
                </ul>
            </li>
            <li><a href="<?php echo site_url('System/withdrawals');?>"><i class="fa fa-money"></i> <span>Withdrawals</span></a></li>
            <li class="treeview">
                <a href="#"><i class="fa fa-money"></i> <span>Loan</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('System/loan_type');?>">Loan Types</a></li>
                    <li><a href="<?php echo site_url('System/loan_list');?>">Given Loan List</a></li>
                    <li><a href="<?php echo site_url('System/loan_calculator');?>">Loan Calculator</a></li>
                </ul>
            </li>
<!--            <li class="treeview">-->
<!--                <a href="#"><i class="fa fa-bar-chart"></i> <span>Loan Reports</span>-->
<!--                    <span class="pull-right-container">-->
<!--                        <i class="fa fa-angle-right pull-right"></i>-->
<!--                    </span>-->
<!--                </a>-->
<!--                <ul class="treeview-menu">-->
<!--                    <li><a href="--><?php //echo site_url('System/loan_type');?><!--">Loan Type</a></li>-->
<!--                    <li><a href="--><?php //echo site_url('System/loan_list');?><!--">Loan List</a></li>-->
<!--                </ul>-->
<!--            </li>-->
            <li><a href="<?php echo site_url('System/reports');?>"><i class="fa fa-sign-out"></i> <span>Reports</span></a></li>
            <li><a href="<?php echo site_url('System/logout');?>"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
        </ul>
        <!-- /. sidebar-menu -->
    </section>
</aside>