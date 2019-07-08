<?php
if($member1){
    ?>
    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <section class="content-title">
            <h1>
                <a href="<?php echo site_url('System/registration_fee');?>" class="btn btn-info btn-md"><i class="fa fa-backward"></i> Back</a> Add Registration Fee
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href=""><i class="fa fa-home"></i>Dashboard</a></li>
                <li><a href=""><i class="fa fa-plus"></i>Registration Fee</a></li>
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
                    <div class="panel panel-info">
                        <div class="panel-heading"><i class="fa fa-plus-square"></i> Registration Fee</div>
                        <div class="panel-body">
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="home2">
                                    <!--<h5>All Members</h5>--><br/>
                                    <div class="table-responsive">
                                        <table class="table-responsive table table-bordered table-striped datatable" id="example2">
                                            <thead style="background-color: lightgrey">
                                            <tr>
                                                <th style="width: 5%;">#</th>
                                                <th style="width: 5%">Number</th>
                                                <th>Full Name</th>
                                                <th>Phone No.</th>
                                                <th>Amount</th>
                                                <th>Payment Mode</th>
                                                <th>Registration Date</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $count=1;
                                            foreach($member1 as $mem){
                                                ?>
                                                <tr>
                                                    <td><?php echo $count;?>.</td>
                                                    <td><?php echo $mem['serial'];?></td>
                                                    <td><?php echo $mem['first_name'].' '.$mem['middle_name'].' '.$mem['last_name'];?></td>
                                                    <td><?php echo $mem['phone_no'];?></td>
                                                    <td><?php echo number_format($mem['amount_paid'],2);?></td>
                                                    <td><?php echo $mem['payment_name'];?></td>
                                                    <td><?php echo $mem['dated'];?></td>
                                                    <td>
                                                        <button data-target="#details_modal<?php echo $mem['reg_id'];?>" data-toggle="modal" data-backdrop="static" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i> Update</button>
                                                        <button data-toggle="modal" data-target="#delete_member<?php echo $mem['reg_id'];?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
                                                    </td>
                                                </tr>
                                                <!--Delete modal-->
                                                <div class="modal fade" id="delete_member<?php echo $mem['reg_id'];?>">
                                                    <div class="modal-dialog modal-sm">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title">Delete Data</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p><i class="fa fa-warning"></i> SURE TO DELETE,,? The data will be deleted permanently..!!</p>
                                                                <form method="post" action="<?php echo site_url('System/deleteregfee/'.$mem['reg_id']);?>">
                                                                    <input style="display: none;" name="member" value="<?php echo $mem['member_no'];?>">
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
                                                <!--Modal for updating member detasils-->
                                                <div class="modal fade" id="details_modal<?php echo $mem['reg_id'];?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title">Payment Details</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="post" action="<?php echo site_url('System/updateregfee/'.$mem['reg_id']);?>">
                                                                    <div class="form-group">
                                                                        <label>Number </label>
                                                                        <input style="display: none;" name="member_number" value="<?php echo $mem['member_no']; ?>">
                                                                        <input class="form-control" value="<?php echo $mem['serial']; ?>" readonly>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Fullname </label>
                                                                        <input value="<?php echo $mem['first_name'].' '.$mem['middle_name'].' '.$mem['last_name'];?>" class="form-control" readonly>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Amount Paid </label><span class="required">*</span>
                                                                        <input type="number" value="<?php echo $mem['amount_paid'];?>" class="form-control" name="amount_paid" placeholder="Amount Paid">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Payment Mode </label><span class="required">*</span>
                                                                        <select class="form-control" name="pay_mode" required>
                                                                            <?php
                                                                            foreach($payment_mode as $g){
                                                                                ?>
                                                                                <option value="<?php echo $g['mode_id'];?>" <?php if($mem['payment_mode']==$g['mode_id']) echo 'selected="selected"'?>><?php echo $g['payment_name'];?></option>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" name="updateregfee_btn" class="btn btn-primary"><i class="fa fa-save"></i> Save Updates</button>
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                                                                    </div>
                                                                </form>
                                                            </div>

                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                                <?php
                                                $count++;
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- /. main content -->
        <span class="return-up"><i class="fa fa-chevron-up"></i></span>
    </div>
<?php
}
else{
    redirect('System/registration_fee');
}
?>

