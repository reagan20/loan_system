
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
                <a href="<?php //echo site_url('System/contributions');?>">
                    <div class="info-box2 bg-green">
                        <div class="info-box-content">
                            <i class="fa fa-money text-aqua"></i>
                            <span class="info-box-text">Total Contribution</span>
                            <span class="info-box-number"><?php foreach($total_contributions as $total){}; echo number_format($total['amount'],2); ?></span>
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
                <a href="<?php //echo site_url('System/withdrawals');?>">
                    <div class="info-box2 bg-navy">
                        <div class="info-box-content">
                            <i class="fa fa-money text-blue"></i>
                            <!--<i class="fa fa-users text-blue"></i>-->
                            <span class="info-box-text">Total Withdrawals</span>
                            <span class="info-box-number"><?php foreach($total_withdraw as $tota); echo number_format($tota['amount'],2);?></span>
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
                <a href="<?php //echo site_url('System/account_summary');?>">
                    <div class="info-box2 bg-teal">
                        <div class="info-box-content">
                            <i class="fa fa-money text-navy"></i>
                            <span class="info-box-text">Available Cash</span>
                            <span class="info-box-number"><?php echo number_format($total['amount']-$tota['amount'],2);?></span>
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
                <div class="panel panel-primary">
                    <div class="panel-heading"><i class="fa fa-money"></i> My Contributions</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped datatable" id="example2">
                                <thead style="background-color: lightgrey">
                                <tr>
                                    <th>S/N</th>
                                    <th>Amount Paid</th>
                                    <th>Paid Date</th>
                                    <th>Date Recorded</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $count=1;
                                foreach($contributions as $pay ){
                                ?>
                                <tr>
                                    <td><?php echo $count?>.</td>
                                    <td><?php echo number_format($pay['amount'],2);?></td>
                                    <td><?php echo $pay['paid_date'];?></td>
                                    <td><?php echo $pay['dated'];?></td>
                                </tr>
                                <?php
                                $count++;
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="panel-footer" style="text-align: center;">
                        <h5 style="color: red; font-weight: bold;">TOTAL CONTRIBUTION: <?php foreach($total_contributions as $total){}; echo number_format($total['amount'],2); ?></h5>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /. main content -->
    <span class="return-up"><i class="fa fa-chevron-up"></i></span>
</div>
<!-- /. content-wrapper -->
<!-- Main Footer -->
