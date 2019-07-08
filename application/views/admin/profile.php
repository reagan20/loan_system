<?php
foreach($details as $deta){
    $fname=$deta['first_name'];
    $mname=$deta['middle_name'];
    $lname=$deta['last_name'];
    $email=$deta['email'];
    $id=$deta['id'];
    $phone=$deta['phone_no'];
    $box=$deta['box_address'];
    $role=$deta['role'];
    $admin_id=$deta['member_no'];
    $gend=$deta['gender'];
}
?>
<!-- Content Wrapper -->
<div class="content-wrapper">
    <section class="content-title">
        <h1>
           Personal Details
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i>Profile</a></li>
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
            <div class="col-md-8">
                <div class="panel panel-info">
                    <div class="panel-heading">Details</div>
                    <div class="panel-body">
                    <form method="post" action="<?php echo site_url('System/updateAdminDetails/'.$admin_id);?>">
                    <div class="row">
                        <div class="col-md-6">
                            <label>First Name:</label>
                            <input value="<?php echo $fname;?>" type="text" class="form-control" name="first_name" required placeholder="First Name">
                        </div>
                        <div class="col-md-6">
                            <label>Middle Name:</label>
                            <input value="<?php echo $mname;?>" type="text" class="form-control" name="middle_name" required placeholder="Middle Name">
                        </div>
                        <div class="col-md-6">
                            <label>Last Name:</label>
                            <input value="<?php echo $lname;?>" type="text" class="form-control" name="last_name" required placeholder="Last Name">
                        </div>
                        <div class="col-md-6">
                            <label>National ID:</label>
                            <input value="<?php echo $id;?>" readonly class="form-control" name="national_id" required placeholder="National ID">
                        </div>
                        <div class="col-md-6">
                            <label>Phone:</label>
                            <input value="<?php echo $phone;?>" type="text" class="form-control" name="phone" required placeholder="Phone">
                        </div>
                        <div class="col-md-6">
                            <label>Email Address:</label>
                            <input value="<?php echo $email;?>" type="email" class="form-control" name="email" required placeholder="Email Address">
                        </div>
                        <div class="col-md-6">
                            <label>Box Address:</label>
                            <input value="<?php echo $box;?>" type="text" class="form-control" name="box_address" required placeholder="Box Address">
                        </div>
                        <div class="col-md-6">
                            <label>Role:</label>
                            <input value="<?php echo $role;?>" type="text" class="form-control" name="role" required placeholder="Membership Role">
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-md-12">
                            <button disabled type="submit" name="updateadmin_btn" class="btn btn-primary btn-md"><i class="fa fa-save"></i> Save Update</button>
                        </div>
                    </div>
                    </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-success">
                    <div class="panel-heading">Update Password</div>
                    <div class="panel-body">
                    <div class="row">
                        <form method="post" action="<?php echo site_url('System/updatePassword/'.$admin_id);?>">
                            <div class="col-md-12">
                                <label>New Password</label>
                                <input type="password" class="form-control" name="password" required placeholder="New Password">
                            </div>
                            <div class="col-md-12">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" name="password1" required placeholder="Confirm Password">
                            </div>

                        </form>
                    </div><br/>
                        <div class="row">
                            <div class="col-md-12">
                                <label></label>
                                <button type="submit" name="updatepass_btn" class="btn btn-md btn-primary"><i class="fa fa-save"></i> Update Password</button>
                            </div>
                        </div>
                    </div
                </div>
            </div>
        </div>

    </section>
    <!-- /. main content -->
    <span class="return-up"><i class="fa fa-chevron-up"></i></span>
</div>
<!-- /. content-wrapper -->
<!-- Main Footer -->
