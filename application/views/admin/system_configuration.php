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
            System Configuration
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-home"></i>Dashboard</a></li>
            <li><a href="#"><i class="fa fa-home"></i>System Configuration</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default" style="min-height: 150px;">
                    <!--<div class="panel-heading"><i class="fa fa-plus"></i> System Configuration</div>-->
                    <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <?php
                            if(isset($_SESSION['message'])){
                                echo $_SESSION['message'];
                            }
                            ?>
                            <div class="panel panel-primary">
                                <div class="panel-heading"><i class="fa fa-cog"></i> System Configuration</div>
                                <div class="panel-body">
                                    <form method="post" action="<?php echo site_url('System/sacco_details');?>">
                                        <div class="form-group">
                                            <label>SACCO Name:</label> <span class="required">*</span>
                                            <input onkeyup="this.value = this.value.toUpperCase();" name="sacco_name" class="form-control" placeholder="Sacco Name" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Phone Number:</label> <span class="required">*</span>
                                            <input name="sacco_phone" class="form-control" placeholder="Phone Number" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Email Address:</label> <span class="required">*</span>
                                            <input name="sacco_email" class="form-control" placeholder="Email Address" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Box Address:</label> <span class="required">*</span>
                                            <input type="number" name="sacco_box" class="form-control" placeholder="Box Address e.g (111)" required>
                                        </div>
                                        <div class="form-group">
                                            <label>County:</label> <span class="required">*</span>
                                            <input name="county" class="form-control" placeholder="County" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Country:</label> <span class="required">*</span>
                                            <input name="country" class="form-control" value="Kenya" placeholder="Country" required>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="sacco_btn" class="btn btn-info btn-info"><i class="fa fa-save"></i> Save Details</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="box">
                                <div class="box-header with-border">Organisation Logo</div>
                                <div class="box-body">
                                    <?php
                                    foreach ($sacco_det as $s){
                                        $id=$s['sacco_id'];
                                    }
                                    ?>
                                    <form method="post" enctype="multipart/form-data" action="<?php echo site_url('System/update_logo/'.$id);?>">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <!--<label>Logo:</label>-->
                                                    <input class="form-control" type="file" name="logo" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <button type="submit" name="update_logo" class="btn btn-info btn-md"><i class="fa fa-save"></i> Save Logo</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">SACCO Details
                                    </h3>
                                </div>
                                <?php
                                foreach ($sacco_det as $ac){
                                    ?>
                                    <div class="box-body">
                                        <strong>SACCO Name:</strong>
                                        <p><?php echo $ac['sacco_name'];?></p>
                                        <strong>Phone Number:</strong>
                                        <p><?php echo $ac['sacco_phone'];?></p>
                                        <strong>Email Address:</strong>
                                        <p><?php echo $ac['sacco_email'];?></p>
                                        <strong>Box Address:</strong>
                                        <p><?php echo $ac['sacco_box'];?></p>
                                        <strong>County:</strong>
                                        <p><?php echo $ac['county'];?></p>
                                        <strong>Country:</strong>
                                        <p><?php echo $ac['country'];?></p>
                                    </div>
                                    <div class="box-footer">
                                        <a data-toggle="modal" data-target="#sacco<?php echo $ac['sacco_id'];?>" class="btn btn-info btn-md"><i class="fa fa-pencil-square"></i> Update Details</a>
                                    </div>
                                    <div class="modal fade" id="sacco<?php echo $ac['sacco_id'];?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Update SACCO Details</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="<?php echo site_url('System/updatesacco_details/'.$ac['sacco_id']);?>">
                                                        <div class="form-group">
                                                            <label>SACCO Name:</label> <span class="required">*</span>
                                                            <input value="<?php echo $ac['sacco_name'];?>" onkeyup="this.value = this.value.toUpperCase();" name="sacco_name" class="form-control" placeholder="Sacco Name" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Phone Number:</label> <span class="required">*</span>
                                                            <input value="<?php echo $ac['sacco_phone'];?>" name="sacco_phone" class="form-control" placeholder="Phone Number" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Email Address:</label> <span class="required">*</span>
                                                            <input value="<?php echo $ac['sacco_email'];?>" name="sacco_email" class="form-control" placeholder="Email Address" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Box Address:</label> <span class="required">*</span>
                                                            <input value="<?php echo $ac['sacco_box'];?>" type="number" name="sacco_box" class="form-control" placeholder="Box Address e.g (111)" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>County:</label> <span class="required">*</span>
                                                            <input value="<?php echo $ac['county'];?>" name="county" class="form-control" placeholder="County" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Country:</label> <span class="required">*</span>
                                                            <input value="<?php echo $ac['country'];?>" name="country" class="form-control" value="Kenya" placeholder="Country" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" name="updatesacco_btn" class="btn btn-info btn-info"><i class="fa fa-save"></i> Save Updates</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
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
<!-- /. content-wrapper -->
<!-- Main Footer -->
