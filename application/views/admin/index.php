<?php
foreach($details as $det) {
    $fname = $det['first_name'];
    $lname = $det['last_name'];
    $mail = $det['email'];
    $phone= $det['phone_no'];
}
?>
    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <section class="content-title">
            <h1>
                Dashboard
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-home"></i>Dashboard</a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <a href="<?php echo site_url('System/members');?>">
                        <div class="info-box2 bg-blue">
                            <div class="info-box-content">
                                <i class="fa fa-user-plus text-teal"></i>
                                <span class="info-box-text">Members</span>
                                <span class="info-box-number"><?php echo $totMember;?></span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 60%"></div>
                                </div>
                                <!--<span class="progress-description">
                                    70% Increase in 30 Days
                                </span>-->
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <a href="<?php echo site_url('System/contributions');?>">
                        <div class="info-box2 bg-green">
                            <div class="info-box-content">
                                <i class="fa fa-money text-aqua"></i>
                                <span class="info-box-text">Total Contribution</span>
                                <span class="info-box-number"><?php foreach($total as $tot);?><?php echo number_format($tot['amount'],2);?></span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 60%"></div>
                                </div>
                                <!--<span class="progress-description">
                                    60% Increase in 15 Days
                                </span>-->
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <a href="<?php echo site_url('System/withdrawals');?>">
                        <div class="info-box2 bg-navy">
                            <div class="info-box-content">
                                <i class="fa fa-money text-blue"></i>
                                <!--<i class="fa fa-users text-blue"></i>-->
                                <span class="info-box-text">Total Withdrawals</span>
                                <span class="info-box-number"><?php foreach($total_withdraw as $tota);?><?php echo number_format($tota['amount'],2);?></span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 60%"></div>
                                </div>
                                <!--<span class="progress-description">
                                    60% Increase in 15 Days
                                </span>-->
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <a href="<?php echo site_url('System/account_summary');?>">
                        <div class="info-box2 bg-teal">
                            <div class="info-box-content">
                                <i class="fa fa-money text-navy"></i>
                                <span class="info-box-text">Available Cash</span>
                                <span class="info-box-number"><?php echo number_format($tot['amount']-$tota['amount'],2);?></span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 60%"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h4 style="font-weight: bold;">SACCO Management System Quick Links</h4>
                </div>
                <a href="<?php echo site_url('System/members');?>">
                    <div class="col-md-2">
                        <div class="well well-sm" style="text-align: center;">
                            <img src="<?php echo base_url();?>assets/resources/img/users.png" alt="Chama Logo" style="width: 50px; text-align: center;" class="img-circle profile_img"><br/>
                            <h5>Members Data</h5>
                        </div>
                    </div>
                </a>
                <a href="<?php echo site_url('System/registration_fee');?>">
                    <div class="col-md-2">
                        <div class="well well-sm" style="text-align: center;">
                            <img src="<?php echo base_url();?>assets/resources/img/reg.png" alt="Chama Logo" style="width: 50px; text-align: center;" class="img-circle profile_img"><br/>
                            <h5>Registration Fees</h5>
                        </div>
                    </div>
                </a>
                <a href="<?php echo site_url('System/contributions');?>">
                    <div class="col-md-2">
                        <div class="well well-sm" style="text-align: center;">
                            <img src="<?php echo base_url();?>assets/resources/img/save2.png" alt="Chama Logo" style="width: 50px; text-align: center;" class="img-circle profile_img"><br/>
                            <h5>Contributions/Savings</h5>
                        </div>
                    </div>
                </a>
                <a href="<?php echo site_url('System/withdrawals');?>">
                    <div class="col-md-2">
                        <div class="well well-sm" style="text-align: center;">
                            <img src="<?php echo base_url();?>assets/resources/img/withdraw.png" alt="Chama Logo" style="width: 50px; text-align: center;" class="img-circle profile_img"><br/>
                            <h5>Withdrawals</h5>
                        </div>
                    </div>
                </a>
                <a href="<?php echo site_url('System/loan_type');?>">
                    <div class="col-md-2">
                        <div class="well well-sm" style="text-align: center;">
                            <img src="<?php echo base_url();?>assets/resources/img/loan3.png" alt="Chama Logo" style="width: 50px; text-align: center;" class="img-circle profile_img"><br/>
                            <h5>Loan Types</h5>
                        </div>
                    </div>
                </a>
                <a href="<?php echo site_url('System/loan_list');?>">
                    <div class="col-md-2">
                        <div class="well well-sm" style="text-align: center;">
                            <img src="<?php echo base_url();?>assets/resources/img/favicon.png" alt="Chama Logo" style="width: 50px; text-align: center;" class="img-circle profile_img"><br/>
                            <h5>Given Loan Lists</h5>
                        </div>
                    </div>
                </a>
                <a href="<?php echo site_url('System/loan_calculator');?>">
                    <div class="col-md-2">
                        <div class="well well-sm" style="text-align: center;">
                            <img src="<?php echo base_url();?>assets/resources/img/calc.ico" alt="Chama Logo" style="width: 50px; text-align: center;" class="img-circle profile_img"><br/>
                            <h5>Loan Calculator</h5>
                        </div>
                    </div>
                </a>
            </div>
<!--            <div class="row" style="text-align: center">-->
<!--                <div class="col-md-4"></div>-->
<!--                <div class="col-md-4" style="text-align: center">-->
<!--                    <img src="--><?php //echo base_url();?><!--assets/resources/img/favicon.png" alt="Chama Logo" style="width: 200px;" class="img-circle profile_img">-->
<!--                    <p>-->
<!--                    <h3>LOAN MANAGEMENT SYSTEM</h3>-->
<!--                    <h4>Phone: --><?php //echo $phone;?><!--</h4>-->
<!--                    <h4>Email:--><?php //echo $mail;?><!--</h4>-->
<!--                    </p>-->
<!--                </div>-->
<!--                <div class="col-md-4"></div>-->
<!--            </div>-->

        </section>
        <!-- /. main content -->
        <span class="return-up"><i class="fa fa-chevron-up"></i></span>
    </div>
    <!-- /. content-wrapper -->
    <!-- Main Footer -->
