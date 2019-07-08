
<!-- Content Wrapper -->
<div class="content-wrapper">
    <section class="content-title">
        <h1>
            Contributions/Savings
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-home"></i>Dashboard</a></li>
            <li><a href=""><i class="fa fa-money"></i>Contribution/Savings</a></li>
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
                    <div class="panel-heading"><i class="fa fa-plus-square"></i> Add Contribution</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-7">
                                <button class="btn btn-primary btn-md" data-toggle="modal" data-backdrop="static" data-target="#payment_modal"><i class="fa fa-plus-square"></i> Add Contribution</button>
                                <button class="btn btn-info btn-md" data-toggle="modal" data-target="#search_modal"><i class="fa fa-search"></i> Search by date</button>
                                <a href="<?php echo site_url('System/contributions');?>" class="btn btn-success btn-md"><i class="fa fa-refresh"></i> Refresh</a>
                            </div>
                            <!--Random search functionality-->
                            <form method="post">
                                <div class="col-md-4">
                                    <input name="randomsearch_input" class="form-control" placeholder="Search here.." required>
                                </div>
                                <button name="randomsearch_btn" type="submit" class="btn btn-md btn-info"><i class="fa fa-search"></i> Search</button>
                            </form>
                        </div><br/>
                        <div class="modal fade" id="search_modal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!--<div class="modal-header">Search Contribution</div>-->
                                    <div class="modal-body">
                                        <form method="post">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Start Date:</label><span class="required">*</span>
                                                    <input class="form-control" type="date" name="start_date" required>
                                                </div>
                                                <div class="col-md-12">
                                                    <label>End Date:</label>
                                                    <input class="form-control" type="date" name="end_date" required>
                                                </div>
                                            </div><br/>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <button type="submit" name="search_btn" class="btn btn-info btn-md"><i class="fa fa-search"></i> Search</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Contribution/payment modal-->
                        <div class="modal fade" id="payment_modal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Record Contribution</h4>
                                    </div>
                                    <div class="modal-body">
                                       <form method="post" action="<?php echo site_url('System/add_contribution')?>">
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
                                                   /*foreach($months as $month){
                                                       ?>
                                                       <option value="<?php echo $month['month_code'];?>"><?php echo $month['month_name'];?> </option>
                                                       <?php
                                                   }*/
                                                   ?>
                                               </select>
                                           </div>-->
                                           <div class="form-group">
                                               <label>Paid Date:</label><span class="required">*</span>
                                               <input type="date" class="form-control" name="paid_date" required>
                                           </div>
                                           <div class="form-group">
                                               <label>Amount Paid </label><span class="required">*</span>
                                               <input class="form-control" name="amount" placeholder="Enter Amount Paid (Ksh.)" required>
                                           </div>
                                           <div class="modal-footer">
                                               <button type="submit" name="payment_btn" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
                                               <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                                           </div>
                                       </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!--<h5>All Contributions</h5>-->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped datatable1" id="example2">
                            <thead style="background-color: lightgrey">
                            <tr>
                                <th>S/N</th>
                                <th>Member Serial</th>
                                <th>Full Name</th>
                                <th>National ID.</th>
                                <th>Phone No.</th>
                                <th style="width: 10%;">Amount Paid</th>
                                <!--<th>Month</th>-->
                                <th>Paid Date</th>
                                <th>Added by</th>
                                <th>Date Recorded</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $_SESSION['start']=$this->input->post('start_date');
                            $_SESSION['end']=$this->input->post('end_date');
                            $_SESSION['randomsearch_input']=$this->input->post('randomsearch_input');
                                $count=1;
                                foreach($payments as $pay ){
                                    ?>
                                    <tr>
                                        <td><?php echo $count?>.</td>
                                        <td><?php echo $pay['serial'];?></td>
                                        <td><?php echo $pay['first_name'].' '.$pay['last_name'];?></td>
                                        <td><?php echo $pay['id'];?></td>
                                        <td><?php echo $pay['phone_no'];?></td>
                                        <form method="post" action="<?php echo site_url('System/update_Contribution/'.$pay['pay_id'])?>">
                                            <td><input class="form-control" name="amount_txt" value="<?php echo $pay['amount'];?>"></td>
                                            <!--<td><select class="form-control" name="month_txt">
                                                <?php
                                            /*foreach($months as $m){
                                                ?>
                                                <option value="<?php echo $m['month_code'];?>" <?php if($pay['month_c']==$m['month_code']) echo 'selected="selected"' ?>><?php echo $m['month_name'];?></option>
                                            <?php
                                            }*/
                                            ?>
                                            </select>
                                        </td>-->
                                            <td><?php echo $pay['paid_date'];?></td>
                                            <td><?php echo $pay['added_by'];?></td>
                                            <td><?php echo $pay['dated'];?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="submit" name="updatepay_btn" onclick="return confirm('SURE TO UPDATE THE CONTRIBUTION RECORD?')" class="btn btn-sm btn-primary">Update <i class="fa fa-edit"></i></button>
                                                    <a data-toggle="modal" data-target="#delete_payment<?php echo $pay['pay_id'];?>" href="<?php// echo site_url('System/deletePayment/'.$pay['pay_id']);?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </a>
                                                </div>
                                            </td>
                                        </form>
                                    </tr>
                                    <!--Delete modal-->
                                    <div class="modal fade" id="delete_payment<?php echo $pay['pay_id'];?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Delete selected withdrawal</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p><i class="fa fa-warning"></i> SURE TO DELETE,,? The data will be deleted permanently..!!</p>
                                                    <form method="post" action="<?php echo site_url('System/deletePayment/'.$pay['pay_id']);?>">
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
                            <div class="row text-center">
                                <div class="col-md-12">
                                    <div class="pagination-links">
                                        <?php echo $this->pagination->create_links();?>
                                        <?php //echo $stude;?>
                                    </div>
                                </div>
                            </div>
                            <style>
                                .pagination-links{
                                    margin: 30px 0;
                                }
                                a.pagination-link{
                                    padding: 8px 13px;
                                    margin: 5px;
                                    background: #F4F4F4;
                                    border: 1px #ccc solid;
                                }
                            </style>
                        </div>
                    </div>
                    <div class="panel-footer" style="text-align: center;">
                        <span class="btn btn-warning btn-sm ">Total Contribution Entries: <?php //if($entry){echo $entry;} else{};?></span>
                        <span class="btn btn-success btn-sm">Total Contributions:
                            <?php
                            if($_SESSION['start']&&$_SESSION['end']!=''){
                               foreach($total_s as $t_s){}
                                echo number_format($t_s['amount'],2);
                            }
                            elseif ($_SESSION['randomsearch_input']){
                                foreach ($total_randomsearch as $random){
                                    echo number_format($random['amount'],2);
                                }
                            }
                            else{
                                foreach($total as $tot){}
                                echo number_format($tot['amount'],2);
                            }

                            ?>
                            <?php //foreach($total as $tot);?><?php //echo number_format($tot['amount'],2);?></span>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /. main content -->
    <span class="return-up"><i class="fa fa-chevron-up"></i></span>
</div>
