
<!-- Content Wrapper -->
<div class="content-wrapper">
    <section class="content-title">
        <h1>
            Withdrawals
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-home"></i>Dashboard</a></li>
            <li><a href=""><i class="fa fa-user-plus"></i>New Withdrawal</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <?php
                if(isset($_SESSION['message'])){
                    echo $_SESSION['message'];
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading"><i class="fa fa-plus-square"></i> Add Withdraw</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table-responsive table table-bordered table-striped datatable" id="example2">
                                <thead style="background-color: lightgrey">
                                <tr>
                                    <th>S/N</th>
                                    <th>Amount Paid</th>
                                    <!--<th>Balance</th>-->
                                    <th>Date</th>
                                    <th>Date Recorded</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $count=1;
                                foreach($withdraw as $pay ){
                                    ?>
                                    <tr>
                                        <td><?php echo $count?>.</td>
                                        <td><?php echo number_format($pay['amount'],2);?></td>
                                        <!--<td>
                                            <?php
                                            /*foreach($sum as $s){
                                                if($s['member_no']==$pay['member_id']){
                                                    echo $s['total'];
                                                }

                                            }*/
                                            ?>
                                        </td>-->
                                        <td><?php echo $pay['w_date'];?></td>
                                        <td><?php echo $pay['withdraw_date'];?></td>
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
                        <span class="btn btn-warning btn-sm"><span class="btn btn-warning btn-sm">Total Withdrawal:
                                <?php
                                    foreach($total_withdraw as $tota){}
                                    echo number_format($tota['amount'],2);
                                ?>
                            </span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /. main content -->
    <span class="return-up"><i class="fa fa-chevron-up"></i></span>
</div>
