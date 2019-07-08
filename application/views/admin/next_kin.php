<?php
if($spec_mem){
    ?>
    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <section class="content-title">
            <h1>
                Add Next of Kin
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href=""><i class="fa fa-home"></i>Dashboard</a></li>
                <li><a href=""><i class="fa fa-user-plus"></i>Next of Kin</a></li>
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
                        <div class="panel-heading">
                            <i class="fa fa-info"></i> <strong style="color: red; font-weight: bold">Member Details:</strong>
                            <?php
                            foreach ($spec_mem as $spec){
                                $m=$spec['member_no'];
                                echo $spec['first_name'].' '.$spec['last_name'].' '.$spec['serial'];
                            }
                            ?></div>
                        <div class="panel-body">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="active"><a href="#home2" role="tab" data-toggle="tab"><i class="fa fa-users"></i> Next of Kin List</a></li>
                                <li><a href="#profile2" role="tab" data-toggle="tab"><i class="fa fa-user-plus"></i> Add Next of Kin</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="home2">
                                    <!--<h5>All Members</h5>--><br/>
                                    <div class="table-responsive">
                                        <table class="table-responsive table table-bordered table-striped datatable" id="example2">
                                            <thead style="background-color: lightgrey">
                                            <tr>
                                                <th style="width: 5%;">#</th>
                                                <th>Full Name</th>
                                                <th>Relationship</th>
                                                <th>National ID</th>
                                                <th>Phone No.</th>
                                                <th>D.O.B</th>
                                                <th>Postal Address</th>
                                                <th>Added Date</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $count=1;
                                            foreach($kin as $mem){
                                                ?>
                                                <tr>
                                                    <td><?php echo $count;?>.</td>
                                                    <td><?php echo $mem['fullname'];?></td>
                                                    <td><?php echo $mem['relationship'];?></td>
                                                    <td><?php echo $mem['kin_national_id'];?></td>
                                                    <td><?php echo $mem['kin_phone'];?></td>
                                                    <td><?php echo $mem['date_of_birth'];?></td>
                                                    <td><?php echo $mem['box_address'];?></td>
                                                    <td><?php echo $mem['added_date'];?></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
                                                                Action <span class="caret"></span>
                                                                <span class="sr-only">Toggle Dropdown</span>
                                                            </button>
                                                            <ul class="dropdown-menu" role="menu">
                                                                <li><a data-target="#details_modal<?php echo $mem['member_no'];?>" data-toggle="modal" data-backdrop="static" class="btn btn-md btn-primary"><i class="fa fa-angle-double-right"></i> More</a></li>
                                                                <li class="divider"></li>
                                                                <li><a data-toggle="modal" data-target="#delete_member<?php echo $mem['member_no'];?>" class="btn btn-md btn-danger"><i class="fa fa-trash"></i> Delete </a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <!--Delete modal-->
                                                <div class="modal fade" id="delete_member<?php echo $mem['member_no'];?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title">Delete Kin details</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p><i class="fa fa-warning"></i> SURE TO DELETE,,? The data will be deleted permanently..!!</p>
                                                                <form method="post" action="<?php echo site_url('System/deleteMember/'.$mem['member_no']);?>">
                                                                    <div class="modal-footer">
                                                                        <button type="submit" name="delete" class="btn btn-danger">
                                                                            <i class="fa fa-trash"></i> Confirm Delete
                                                                        </button>
                                                                        <button class="btn btn-warning" data-dismiss="modal"
                                                                                aria-hidden="true"><i class="fa fa-remove"></i> Cancel
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--Modal for updating member detasils-->
                                                <div class="modal fade" id="details_modal<?php echo $mem['member_no'];?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title">Next of kin Details</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="post" action="<?php echo site_url('System/updateMemberDetails/'.$mem['member_no']);?>">
                                                                    <div class="form-group">
                                                                        <label>Fullname </label><span class="required">*</span>
                                                                        <input value="<?php echo $mem['fullname'];?>" class="form-control" name="fullname" placeholder="Fullname">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Relationship </label><span class="required">*</span>
                                                                        <select class="form-control" name="relationship">
                                                                            <?php
                                                                            foreach($gender as $g){
                                                                                ?>
                                                                                <option value="<?php echo $g['gender_id'];?>" <?php if($mem['gender']==$g['gender_id']) echo 'selected="selected"'?>><?php echo $g['gender_name'];?></option>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Date of Birth </label>
                                                                        <input type="date" value="<?php echo $mem['date_of_birth'];?>" class="form-control" name="dob" placeholder="Date">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Last Name </label><span class="required">*</span>
                                                                        <input value="<?php echo $mem['last_name'];?>" class="form-control" name="last_name" placeholder="Last Name">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Gender </label><span class="required">*</span>
                                                                        <select class="form-control" name="gender">
                                                                            <?php
                                                                            foreach($gender as $g){
                                                                                ?>
                                                                                <option value="<?php echo $g['gender_id'];?>" <?php if($mem['gender']==$g['gender_id']) echo 'selected="selected"'?>><?php echo $g['gender_name'];?></option>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>National ID </label><span class="required">*</span>
                                                                        <input value="<?php echo $mem['id'];?>" class="form-control" name="id" placeholder="National ID" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Phone Number </label><span class="required">*</span>
                                                                        <input value="<?php echo $mem['phone_no'];?>" class="form-control" name="phone" placeholder="Phone Number">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Box Address </label>
                                                                        <input value="<?php echo $mem['box_address'];?>" class="form-control" name="box_address" placeholder="Box Address">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Email Address </label>
                                                                        <input value="<?php echo $mem['email'];?>" class="form-control" name="email" placeholder="Email Address">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Role </label><span class="required">*</span>
                                                                        <select class="form-control" name="role" required>
                                                                            <option value="<?php echo $mem['role'];?>"><?php echo $mem['role'];?></option>
                                                                            <?php
                                                                            if($mem['status']=='admin'){
                                                                                ?>
                                                                                <option value="member">Member</option>
                                                                                <?php
                                                                            }
                                                                            else{
                                                                                ?>
                                                                                <option value="admin">Admin</option>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Account Status: </label><span class="required">*</span>
                                                                        <select class="form-control" name="status" required>
                                                                            <option value="<?php echo $mem['status'];?>"><?php echo $mem['status'];?></option>
                                                                            <?php
                                                                            if($mem['status']=='Active'){
                                                                                ?>
                                                                                <option value="Inactive">Inactive</option>
                                                                                <?php
                                                                            }
                                                                            else{
                                                                                ?>
                                                                                <option value="Active">Active</option>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" name="updatemember_btn" class="btn btn-primary"><i class="fa fa-save"></i> Save Updates</button>
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
                                <div class="tab-pane fade" id="profile2">
                                    <h5></h5>
                                    <form method="post" action="<?php echo site_url('System/add_kin')?>">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input style="display: none;" name="member_no" value="<?php echo $m;?>" readonly>
                                                <label>Full Name:</label><span class="required">*</span>
                                                <input class="form-control" name="fullname" id="fullname" placeholder="Fullname" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Relationship:</label>
                                                <select name="relationship" class="form-control" required>
                                                    <option value="">Select Relationship</option>
                                                    <option value="Father">Father</option>
                                                    <option value="Mother">Mother</option>
                                                    <option value="Son">Son</option>
                                                    <option value="Daughter">Daughter</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Date of Birth:</label><span class="required">*</span>
                                                <input type="date" class="form-control" name="dob" id="dob" placeholder="Date of Birth" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>ID Number:</label>
                                                <input type="number" class="form-control" name="id" id="id" placeholder="ID Number" >
                                            </div>
                                            <div class="col-md-4">
                                                <label>Phone Number:</label>
                                                <input class="form-control" name="phone" id="phone" placeholder="Phone Number">
                                            </div>
                                            <div class="col-md-4">
                                                <label>Email Address:</label>
                                                <input type="text" class="form-control" name="email" id="email" placeholder="Email Address">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Box Address:</label>
                                                <input class="form-control" name="box_address" id="box_address" placeholder="Box Address">
                                            </div>
                                            <div class="col-md-4">
                                                <label>City:</label>
                                                <input type="text" class="form-control" name="city" id="city" placeholder="City">
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" name="addkin_btn" class="btn btn-md btn-primary"><i class="fa fa-user-plus"></i> Save Kin</button>
                                                <button type="reset" class="btn btn-md btn-warning"><i class="fa fa-remove"></i> Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="settings2">
                                    <h5 style="color: red"><strong>NOTE</strong> Kindly upload the correct data format (CSV).</h5>
                                    <form method="post" action="<?php echo site_url('System/members_bulk_upload');?>" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <input class="form-control" type="file" name="csv_file" id="csv_file" required accept=".csv">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-md btn-success"><i class="fa fa-upload"></i> Upload Data</button>
                                        </div>
                                    </form>
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
    redirect('System/members');
}
?>

