<?php
foreach($details as $det) {
    $fname = $det['first_name'];
    $lname = $det['last_name'];
    $mail = $det['email'];
    $phone= $det['phone_no'];
};
?>
<?php
if($borrow_id){
    foreach ($borrow_id as $b){
        $id=$b['borrowedloan_id'];
    };
    ?>
    <div class="content-wrapper">
        <section class="content-title">
            <h1>
                Loan Repayment
                <?php
                //date_default_timezone_set("Africa/Nairobi");
                //echo "The time is " . date("h:i:sa");
                ?>
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href=""><i class="fa fa-home"></i>Dashboard</a></li>
                <li><a href="#"><i class="fa fa-home"></i>Loan Repayment Details</a></li>
            </ol>
        </section>
        <section class="content">
            <?php if(isset($_SESSION['message'])){
                echo $_SESSION['message'];
            }?>
            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-info">
                        <div class="panel-heading">Loan Payment</div>
                        <div class="panel-body">
                            <form method="post" action="<?php echo site_url('System/addloan_repayment');?>">
                                <div class="form-group">
                                    <label>Amount Paid:</label>
                                    <input value="<?php echo $id;?>" name="borrowedloan_id" style="display: none;">
                                    <input class="form-control" name="amount" placeholder="Amount Paid" type="number" required>
                                </div>
                                <div class="form-group">
                                    <label>Payment Mode:</label>
                                    <select class="form-control" name="pay_mode">
                                        <option>Select Payment mode</option>
                                        <?php
                                        foreach ($payment_mode as $mode){
                                            ?>
                                            <option value="<?php echo $mode['mode_id'];?>"><?php echo $mode['payment_name'].' '.$mode['account_no'];?></option>
                                            <?php
                                        }
                                        ?>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Payment Date:</label>
                                    <input class="form-control" name="repayment_date" placeholder="Date" type="date" required>
                                </div>
                                <div class="form-group">
                                    <button name="addrepayment_btn" type="submit" class="btn btn-md btn-info"><i class="fa fa-save"></i> Save</button>
                                    <button type="reset" class="btn btn-md btn-warning"><i class="fa fa-remove"></i> Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="panel panel-info">
                        <div class="panel-heading">Repayment Details</div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <!--<th>Loan Type</th>-->
                                        <th>Amount Paid</th>
                                        <th>Payment Mode</th>
                                        <th>Paid Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sn=1;
                                    foreach ($repayment_details as $repay){
                                        ?>
                                        <tr>
                                            <td><?php echo $sn;?>.</td>
                                            <!--<td></td>-->
                                            <td><?php echo number_format($repay['paid_amount'],2);?></td>
                                            <td><?php echo $repay['payment_name'].' '.$repay['account_no'];?></td>
                                            <td><?php echo $repay['payment_date'];?></td>
                                            <td>
                                                <a data-toggle="modal" data-target="#details_modal<?php echo $repay['repayment_id'];?>" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                                <a data-toggle="modal" data-target="#delete_payment<?php echo $repay['repayment_id'];?>" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i></a>
                                            </td>
                                        </tr>
                                        <!--Modal for updating repayment details-->
                                        <div class="modal fade" id="details_modal<?php echo $repay['repayment_id'];?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title">Payment Details</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="<?php echo site_url('System/updaterepayment/'.$repay['repayment_id']);?>">
                                                            <div class="form-group">
                                                                <label>Amount Paid </label>
                                                                <input style="display: none;" name="repay_id" value="<?php echo $id; ?>">
                                                                <input class="form-control" value="<?php echo $repay['paid_amount']; ?>" name="amount_paid">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Payment Mode </label><span class="required">*</span>
                                                                <select class="form-control" name="pay_mode" required>
                                                                    <?php
                                                                    foreach($payment_mode as $g){
                                                                        ?>
                                                                        <option value="<?php echo $g['mode_id'];?>" <?php if($repay['payment_mode']==$g['mode_id']) echo 'selected="selected"'?>><?php echo $g['payment_name'];?></option>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Payment Date </label>
                                                                <input type="number" value="<?php echo $repay['payment_date'];?>" class="form-control" name="date" placeholder="Date" readonly>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" name="updaterepay_btn" class="btn btn-primary"><i class="fa fa-save"></i> Save Updates</button>
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!--Delete modal-->
                                        <div class="modal fade" id="delete_payment<?php echo $repay['repayment_id'];?>">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title">Delete Data</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><i class="fa fa-warning"></i> SURE TO DELETE,,? The data will be deleted permanently..!!</p>
                                                        <form method="post" action="<?php echo site_url('System/deleterepayment/'.$repay['repayment_id']);?>">
                                                            <input style="display: none;" name="repay_id" value="<?php echo $id;?>">
                                                            <button type="submit" name="delete" class="btn btn-danger">
                                                                <i class="fa fa-trash"></i> Confirm Delete
                                                            </button>
                                                            <button class="btn btn-warning" data-dismiss="modal"
                                                                    aria-hidden="true"><i class="fa fa-remove"></i> Cancel
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $sn++;
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="panel-footer" style="color: red;">
                            <?php
                            if($repayment_details){
                                ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>PRINCIPAL: <?php echo number_format($repay['borrowed_amount'],2);?></h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>AMOUNT: <?php echo number_format($repay['expected_amount'],2);?></h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>PAID: <?php foreach ($repaid_amount as $paid){ echo number_format($paid['paid_amount'],2);}?></h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>BALANCE:
                                            <?php
                                            echo number_format($repay['expected_amount']-$paid['paid_amount'],2);
                                            ?>
                                        </h5>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div><br/>
        </section>
        <!-- /. main content -->
        <span class="return-up"><i class="fa fa-chevron-up"></i></span>
    </div>
<?php
}
else{
    redirect('System/loan_list');
}
?>



