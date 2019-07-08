
<!-- Content Wrapper -->
<div class="content-wrapper">
    <section class="content-title">
        <h1>
            Add New Member
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-home"></i>Dashboard</a></li>
            <li><a href=""><i class="fa fa-user-plus"></i>New Member</a></li>
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
                    <div class="panel-heading"><i class="fa fa-plus-square"></i> Registered Members</div>
                    <div class="panel-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active"><a href="#home2" role="tab" data-toggle="tab"><i class="fa fa-users"></i> All Members</a></li>
                        <li><a href="#profile2" role="tab" data-toggle="tab"><i class="fa fa-user-plus"></i> New Member</a></li>
                        <!--<li><a href="#settings2" role="tab" data-toggle="tab"><i class="fa fa-upload"></i> Bulk Upload</a></li>
                        <li><a class="btn btn-md btn-default" href="<?php //echo base_url('assets/downloads/Members.csv');?>" download><i class="fa fa-download"></i> Download Template</a></li>-->
                    </ul>
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
                                    <th>Gender</th>
                                    <th>ID Number</th>
                                    <th>Phone No.</th>
                                    <!--<th>Address</th>
                                    <th>Email</th>-->
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Registration Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $count=1;
                                foreach($members as $mem){
                                    ?>
                                    <tr>
                                        <td><?php echo $count;?>.</td>
                                        <td><?php echo $mem['serial'];?></td>
                                        <td><?php echo $mem['first_name'].' '.$mem['middle_name'].' '.$mem['last_name'];?></td>
                                        <td><?php echo $mem['gender_name'];?></td>
                                        <td><?php echo $mem['id'];?></td>
                                        <td><?php echo $mem['phone_no'];?></td>
                                        <!--<td><?php //echo $mem['box_address'];?></td>
                                        <td><?php// echo $mem['email'];?></td>-->
                                        <td><?php echo $mem['role'];?></td>
                                        <td><?php echo $mem['status'];?></td>
                                        <td><?php echo $mem['date_recorded'];?></td>
                                        <td>
                                            <div class="btn-group">
                                                <!--<button type="button" class="btn btn-default">Action</button>-->
                                                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
                                                    Action <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a data-target="#details_modal<?php echo $mem['member_no'];?>" data-toggle="modal" data-backdrop="static" class="btn btn-md btn-primary"><i class="fa fa-angle-double-right"></i> More</a></li>
                                                    <li><a href="<?php echo site_url('System/next_kin').'/'.$mem['member_no'];?>" class="btn btn-warning btn-md">Next of Kin</a></li>
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
                                                    <h4 class="modal-title">Delete selected Member</h4>
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
                                                    <h4 class="modal-title">Member Details</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="<?php echo site_url('System/updateMemberDetails/'.$mem['member_no']);?>">
                                                        <div class="form-group">
                                                            <label>Number </label><span class="required">*</span>
                                                            <input class="form-control" value="<?php echo $mem['serial']; ?>" name="member_no" id="member_no" placeholder="Member Number" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>First Name </label><span class="required">*</span>
                                                            <input value="<?php echo $mem['first_name'];?>" class="form-control" name="first_name" placeholder="First Name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Middle Name </label>
                                                            <input value="<?php echo $mem['middle_name'];?>" class="form-control" name="middle_name" placeholder="Middle Name">
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
                            <form method="post" action="<?php echo site_url('System/new_member')?>">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Number:</label><span class="required">*</span>
                                        <?php
                                        foreach ($max_no as $max){
                                           $no=$max['member_no']+1;
                                        }
                                        ?>
                                        <input class="form-control" value="<?php echo $no; ?>/<?php echo date('Y');?>" name="member_no" id="member_no" placeholder="Member Number" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label>First Name:</label><span class="required">*</span>
                                        <input class="form-control" name="first_name" id="first_name" placeholder="First Name" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Middle Name:</label>
                                        <input class="form-control" name="middle_name" id="middle_name" placeholder="Middle Name">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Last Name:</label><span class="required">*</span>
                                        <input class="form-control" name="last_name" id="last_name" placeholder="Last Name" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Gender:</label><span class="required">*</span>
                                        <select class="form-control" name="gender" id="gender" required>
                                            <option value="">Select Gender</option>
                                            <?php
                                            foreach($gender as $ge){
                                                ?>
                                                <option value="<?php echo $ge['gender_id'];?>"><?php echo $ge['gender_name'];?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>ID Number:</label><span class="required">*</span>
                                        <input type="number" class="form-control" name="id" id="id" placeholder="ID Number" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Phone Number:</label><span class="required">*</span>
                                        <input class="form-control" name="phone" id="phone" placeholder="Phone Number" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Address:</label>
                                        <input class="form-control" name="box_address" id="box_address" placeholder="Box Address">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Email Address:</label>
                                        <input type="text" class="form-control" name="email" id="email" placeholder="Email Address">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Role:</label> <span class="required">*</span>
                                        <select class="form-control" name="role" required>
                                            <!--<option value="">Select Role</option>-->
                                            <option value="member">Member</option>
                                            <option value="admin">Admin</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Password:</label>
                                        <input readonly type="password" class="form-control" name="password" id="password" placeholder="Default password is: 1234">
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" name="newmember_btn" class="btn btn-md btn-primary"><i class="fa fa-user-plus"></i> Save Member</button>
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
