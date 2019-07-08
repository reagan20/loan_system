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
            Awarded Loans
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-home"></i>Dashboard</a></li>
            <li><a href="#"><i class="fa fa-home"></i>Awarded Loans</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">

            </div>
            <div class="col-md-12">
                <div class="modal fade" id="loantype_modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Add Loan Type</h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="<?php echo site_url('System/addloantype')?>">
                                    <div class="form-group">
                                        <label>Loan Name </label><span class="required">*</span>
                                        <input class="form-control" name="loan_type" placeholder="Loan Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Interest Rate</label><span class="required">*</span>
                                        <input type="number" class="form-control" name="interest_rate" placeholder="Interest Rate in (%)" required>
                                    </div>
                                    <div class="form-goup">
                                        <label>Frequency</label><span class="required">*</span>
                                        <select class="form-control" name="frequency" required>
                                            <option value="">Select Frequency</option>
                                            <option value="Monthly">Monthly</option>
                                        </select>
                                    </div>
                                    <div class="form-goup">
                                        <label>Payment Term</label><span class="required">*</span>
                                        <input type="number" class="form-control" name="payment_term" placeholder="Payment Term" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="loantype_btn" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div><br/>
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="panel-heading"><i class="fa fa-plus"></i> Add Loan Type</div>
                    <div class="panel-body">
                        <?php if(isset($_SESSION['message'])){
                            echo $_SESSION['message'];
                        }
                        ?>
                        <form method="post" action="<?php echo site_url('System/addborrowedloan');?>">
                            <div class="form-group">
                                <label>Borrower Name: </label><span class="required">*</span>
                                <select class="form-control" name="borrower" id="student" required>
                                    <option value="">Select Borrower</option>
                                    <?php
                                    foreach ($borrowers as $borrow){
                                        ?>
                                        <option value="<?php echo $borrow['member_no'];?>"><?php echo $borrow['first_name'].' '.$borrow['last_name'].' '.$borrow['serial'];?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-goup">
                                <label>Loan Type: </label><span class="required">*</span>
                                <select class="form-control" name="frequency" required>
                                    <option value="">Select Frequency</option>
                                    <?php
                                    foreach ($loan_type as $type){
                                        ?>
                                        <option value="<?php echo $type['type_id'];?>"><?php echo $type['interest_rate'];?> % in <?php echo $type['payment_term'];?> Months</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Amount:</label><span class="required">*</span>
                                <input type="number" class="form-control" name="amount" placeholder="Amount e.g 1000" required>
                            </div>
                            <div class="form-goup">
                                <label>Loan Start Date: </label><span class="required">*</span>
                                <input type="date" class="form-control" name="start_date" placeholder="Start Date" required>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="borrowloan_btn" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                <button type="reset" class="btn btn-warning"><i class="fa fa-close"></i> Clear</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-lg-8">
                <div class="panel panel-info">
                    <div class="panel-heading" style="background-color: #c49f47;"><i class="fa fa-money"></i> Awarded Loans</div>
                    <div class="panel-body">
                        <?php
                        if($borrowdetails){
                            ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th style="width: 5%;">S/N</th>
                                        <th>Borrower Name</th>
                                        <th>Loan Type</th>
                                        <th>Principle</th>
                                        <th>Interest</th>
                                        <th>Amount</th>
                                        <th>Dated</th>
                                        <th>Status</th>
                                        <th style="width: 20%;">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count=1;
                                    foreach ($borrowdetails as $details){
                                        ?>
                                        <tr>
                                            <td><?php echo $count;?>.</td>
                                            <td><?php echo $details['first_name'].' '.$details['last_name'].' '.$details['serial'];?></td>
                                            <td><?php echo $details['loan_type'];?> </td>
                                            <td><?php echo number_format($details['borrowed_amount'],2);?> </td>
                                            <td><?php echo number_format($details['interest_amount'],2);?> </td>
                                            <td><?php echo number_format($details['expected_amount'],2);?> </td>
                                            <td><?php echo $details['start_date'];?> </td>
                                            <td><?php echo $details['status'];?> </td>
                                            <td>
                                                <a href="" ><i class="fa fa-info"></i> More</a>
                                                <a href=""><i class="fa fa-trash"></i>Delete</a>
                                            </td>
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
                </div>
            </div>
        </div>
    </section>
    <!-- /. main content -->
    <span class="return-up"><i class="fa fa-chevron-up"></i></span>
</div>
<!-- /. content-wrapper -->
<!-- Main Footer -->