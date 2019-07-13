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
            Loan Type
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-home"></i>Dashboard</a></li>
            <li><a href="#"><i class="fa fa-home"></i>Loan Type</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <?php if(isset($_SESSION['message'])){
                    echo $_SESSION['message'];
                }
                ?>
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
                                    <div class="form-group">
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
                                   <option value="Weekly">2 Weeks</option>
                                   <option value="Weekly">Weekly</option>
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
            <div class="col-md-8 col-lg-8">
                <div class="panel panel-info">
                    <div class="panel-heading" style="background-color: #c49f47;"><i class="fa fa-money"></i> Loan Types</div>
                    <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Loan Name</th>
                                <th>Interest Rate</th>
                                <th>Payment Terms</th>
                                <th>Frequency</th>
                                <th style="width: 30%;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count=1;
                            foreach ($loan_type as $type){
                                ?>
                                <tr>
                                    <td><?php echo $count;?>.</td>
                                    <td><?php echo $type['loan_type'];?></td>
                                    <td><?php echo $type['interest_rate'];?> %</td>
                                    <td><?php echo $type['payment_term'];?></td>
                                    <td><?php echo $type['frequency'];?></td>
                                    <td>
                                        <a data-toggle="modal" data-target="#update_loantype<?php echo $type['type_id'];?>" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
                                        <a data-toggle="modal" data-target="#delete_loantype<?php echo $type['type_id'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="update_loantype<?php echo $type['type_id'];?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Add Loan Type</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="<?php echo site_url('System/updateloantype/'.$type['type_id']);?>">
                                                    <div class="form-group">
                                                        <label>Loan Name </label><span class="required">*</span>
                                                        <input value="<?php echo $type['loan_type'];?>" class="form-control" name="loan_type" placeholder="Loan Name" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Interest Rate</label><span class="required">*</span>
                                                        <input value="<?php echo $type['interest_rate'];?>" type="number" class="form-control" name="interest_rate" placeholder="Interest Rate in (%)" required>
                                                    </div>
                                                    <div class="form-goup">
                                                        <label>Frequency</label><span class="required">*</span>
                                                        <select class="form-control" name="frequency" required>
                                                            <option value="<?php echo $type['frequency'];?>"><?php echo $type['frequency'];?></option>
                                                            <option value="Monthly">Monthly</option>
                                                            <option value="2 Weeks">2 Weeks</option>
                                                            <option value="Weekly">Weekly</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-goup">
                                                        <label>Payment Term</label><span class="required">*</span>
                                                        <input type="number" value="<?php echo $type['payment_term'];?>" class="form-control" name="payment_term" placeholder="Payment Term" required>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="updateloantype_btn" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!--Delete modal-->
                                <div class="modal fade" id="delete_loantype<?php echo $type['type_id'];?>">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Delete Data</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p><i class="fa fa-warning"></i> SURE TO DELETE,,? The data will be deleted permanently..!!</p>
                                                <form method="post" action="<?php echo site_url('System/deleteloantype/'.$type['type_id']);?>">
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
    </section>
    <span class="return-up"><i class="fa fa-chevron-up"></i></span>
</div>
