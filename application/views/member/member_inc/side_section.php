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
                <a href="#"><i class="fa fa-circle text-success"></i> Member</a>
            </div>

        </div>
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview"><a href="<?php echo site_url('Member_controller/index');?>"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
            <?php
            if($this->session->userdata['member_no']==2){
                ?>
                <li><a href="<?php echo site_url('Member_controller/contributions');?>"><i class="fa fa-money"></i> <span>Add Contribution</span></a></li>
            <?php
            }
            ?>
            <li><a href="<?php echo site_url('Member_controller/withdraw');?>"><i class="fa fa-money"></i> <span>Withdrawals</span></a></li>
            <li><a href="<?php echo site_url('Member_controller/my_profile');?>"><i class="fa fa-flag"></i> <span>View Details</span></a></li>
            <li><a href="<?php echo site_url('System/logout');?>"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
        </ul>
    </section>
</aside>