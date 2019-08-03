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
            Fully Paid Loans
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-home"></i>Dashboard</a></li>
            <li><a href="#"><i class="fa fa-home"></i>Fully Paid Loans</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-info" style="min-height: 150px;">
                    <div class="panel-heading"><i class="fa fa-plus"></i> Fully Paid Loans</div>
                    <div class="panel-body">
                        <?php
                        //if(isset($_POST['report_btn'])){
                        ?>
                        <div id="repo" style="">
                            <?php
                            if($borrowdetails){
                                ?>
                                <div class="table-responsive">
                                    <a href="<?php echo site_url('System/settledloansreport');?>" class="btn btn-md btn-danger"><i class="fa fa-sign-out"></i> Export Pdf</a>
                                    <h4>Generated Report</h4>
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th style="width: 5%;">S/N</th>
                                            <th>Borrower Name</th>
                                            <th>Loan Type</th>
                                            <th>Principle</th>
                                            <th>Interest</th>
                                            <th>Amount</th>
                                            <th>Loan Date</th>
                                            <th>Deadline</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $count=1;
                                        foreach ($borrowdetails as $details){
                                            ?>
                                            <tr>
                                                <td><?php echo $count;?>.</td>
                                                <td><?php echo $details['first_name'].' '.$details['last_name'].' ('.$details['serial'].')';?></td>
                                                <td><?php echo $details['loan_type'].' ('.$details['interest_rate'].'%'.' )';?> </td>
                                                <td><?php echo number_format($details['borrowed_amount'],2);?> </td>
                                                <td><?php echo number_format($details['interest_amount'],2);?> </td>
                                                <td><?php echo number_format($details['expected_amount'],2);?> </td>
                                                <td><?php echo $details['start_date'];?> </td>
                                                <td><?php echo $details['deadline_date'];?></td>
                                            </tr>
                                            <?php
                                            $count++;
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php
                            }
                            else{
                                ?>
                                <div class="col-md-12">
                                    <div class="alert alert-danger ">Sorry No Record Found!</div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                        // }
                        ?>

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
