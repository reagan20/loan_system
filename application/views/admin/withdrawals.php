
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
                <div class="panel panel-info">
                    <div class="panel-heading"><i class="fa fa-plus-square"></i> Add Withdraw</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-5">
                                <button class="btn btn-primary btn-md" data-toggle="modal" data-backdrop="static" data-target="#withdraw_modal"><i class="fa fa-plus-square"></i> Add Withdrawal</button>
                                <button class="btn btn-primary btn-md" data-toggle="modal" data-backdrop="static" data-target="#search_modal"><i class="fa fa-search"></i> search by date</button>
                                <a href="<?php echo site_url('System/withdrawals');?>" class="btn btn-success btn-md"><i class="fa fa-refresh"></i> Refresh</a>
                            </div>
                        </div><br/>
                        <div class="modal fade" id="search_modal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <form method="post">
                                            <div class="form-group">
                                                <label>Start Date</label><span class="required">*</span>
                                                <input class="form-control" name="start_date" type="date" required>
                                            </div>
                                            <div class="form-group">
                                                <label>End Date</label><span class="required">*</span>
                                                <input class="form-control" name="end_date" type="date" required>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" name="withdraw_search" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <div class="modal fade" id="withdraw_modal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Record Withdrawal</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="<?php echo site_url('System/add_withdraw')?>">
                                            <div class="form-group">
                                                <label>Member </label><span class="required">*</span>
                                                <select class="form-control" name="member" id="student" required style="width: 100%;">
                                                    <option value="">~~Select Member~~</option>
                                                    <?php
                                                    foreach($members as $mem){
                                                        ?>
                                                        <option value="<?php echo $mem['member_no'];?>"><?php echo $mem['first_name'].' '.$mem['last_name'];?> (<?php echo $mem['member_no']?>)</option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <!--<div class="form-group">
                                                <label>Month </label><span class="required">*</span>
                                                <select class="form-control" name="month" required>
                                                    <option value="">~~Select Month~~</option>
                                                    <?php
                                                    //foreach($months as $month){
                                                        ?>
                                                        <option value="<?php //echo $month['month_code'];?>"><?php //echo $month['month_name'];?> </option>
                                                        <?php
                                                    //}
                                                    ?>
                                                </select>
                                            </div>-->
                                            <div class="form-group">
                                                <label>Withdraw Date</label><span class="required">*</span>
                                                <input class="form-control" name="date_txt" type="date" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Amount Paid </label><span class="required">*</span>
                                                <input class="form-control" name="amount" placeholder="Enter Amount Paid (Ksh.)" required>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" name="withdraw_btn" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <div class="table-responsive">
                            <table class="table-responsive table table-bordered table-striped datatable" id="example2">
                            <thead style="background-color: lightgrey">
                            <tr>
                                <th>S/N</th>
                                <th>National ID.</th>
                                <th>Full Name</th>
                                <th>Phone No.</th>
                                <th>Amount Paid</th>
                                <!--<th>Balance</th>-->
                                <th>Date</th>
                                <th>Date Recorded</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $_SESSION['start']=$this->input->post('start_date');
                            $_SESSION['end']=$this->input->post('end_date');

                                $count=1;
                                foreach($withdraw as $pay ){
                                    ?>
                                    <tr>
                                        <td><?php echo $count?>.</td>
                                        <td><?php echo $pay['id'];?></td>
                                        <td><?php echo $pay['first_name'].' '.$pay['last_name'];?></td>
                                        <td><?php echo $pay['phone_no'];?></td>
                                        <form method="post" action="<?php echo site_url('System/updateWithdraw/'.$pay['withdraw_id'])?>">
                                            <td><input class="form-control" name="amount_txt" value="<?php echo $pay['amount'];?>"></td>
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
                                            <td>
                                                <div class="btn-group">
                                                    <button type="submit" name="updatewithdraw_btn" onclick="return confirm('SURE TO UPDATE THE WITHDRAW RECORD?')" class="btn btn-sm btn-primary">Update <i class="fa fa-edit"></i></button>
                                                    <a data-toggle="modal" data-target="#delete_withdraw<?php echo $pay['withdraw_id'];?>" href="<?php// echo site_url('System/deleteWithdraw/'.$pay['withdraw_id']);?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a>
                                                </div>
                                            </td>
                                        </form>
                                    </tr>
                                    <!--Delete modal-->
                                    <div class="modal fade" id="delete_withdraw<?php echo $pay['withdraw_id'];?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Delete selected withdrawal</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p><i class="fa fa-warning"></i> SURE TO DELETE,,? The data will be deleted permanently..!!</p>
                                                    <form method="post" action="<?php echo site_url('System/deleteWithdraw/'.$pay['withdraw_id']);?>">
                                                        <div class="modal-footer">
                                                            <button class="btn btn-warning" data-dismiss="modal"
                                                                    aria-hidden="true"><i class="fa fa-remove"></i> Cancel
                                                            </button>
                                                            <button type="submit" name="delete" class="btn btn-danger">
                                                                <i class="fa fa-trash"></i> Confirm Delete
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $count++;
                                }
                            ?>
                            </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="panel-footer" style="text-align: center;">
                        <span class="btn btn-warning btn-sm"><span class="btn btn-warning btn-sm">Total:
                                <?php
                                if($_SESSION['start']&&$_SESSION['end']!=''){
                                    foreach($total_s as $t_s){}
                                    echo number_format($t_s['amount'],2);
                                }
                                else{
                                    foreach($total_withdraw as $tota){}
                                    echo number_format($tota['amount'],2);
                                }
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
