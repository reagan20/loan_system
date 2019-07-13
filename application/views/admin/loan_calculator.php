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
            Loan Calculator
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-home"></i>Dashboard</a></li>
            <li><a href="#"><i class="fa fa-home"></i>Loan Calculator</a></li>
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
        </div><br/>
        <div class="row">
            <div class="col-md-5">
                <div class="panel panel-info">
                    <div class="panel-heading"><i class="fa fa-calculator"></i> Loan Calculator</div>
                    <div class="panel-body">
                        <form method="post" action="">
                            <div class="form-group">
                                <label>Principle(Amount Borrowed)</label><span class="required">*</span>
                                <input type="number" class="form-control" name="principle" placeholder="Principle Amount")" required>
                            </div>
                            <div class="form-goup">
                                <label>Loan Type</label><span class="required">*</span>
                                <select class="form-control" name="loan_type" id="loan_type" required>
                                    <option value="">Select Loan Type</option>
                                    <?php
                                    foreach ($loan_type as $type){
                                        ?>
                                        <option value="<?php echo $type['type_id'];?>"><?php echo $type['interest_rate'].' % in'.' '.$type['payment_term'].' ('.$type['frequency'].')';?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div><br/>
                            <div class="modal-footer">
                                <button type="submit" name="calculate_btn" class="btn btn-primary"><i class="fa fa-calculator"></i> Calculate Loan</button>
                                <!--<button type="button" class="btn btn-warning"><i class="fa fa-close"></i> Clear</button>-->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-lg-7">
                <div class="panel panel-info">
                    <div class="panel-heading" style="background-color: #c49f47;"><i class="fa fa-money"></i> Loan</div>
                    <div class="panel-body" style="min-height: 245px ;">
                    <?php
                    if(isset($result)){
                        echo $result;
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
