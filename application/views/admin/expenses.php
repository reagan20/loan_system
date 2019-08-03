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
            Expenses
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-home"></i>Dashboard</a></li>
            <li><a href="#"><i class="fa fa-home"></i>Expenses</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">

            </div>
            <div class="col-md-12">
                <div class="modal fade" id="expense">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Add Expense</h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="<?php echo site_url('System/addexpense');?>" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Expense Name: </label><span class="required">*</span>
                                        <input class="form-control" name="expense_name" placeholder="Expense Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Amount:</label><span class="required">*</span>
                                        <input type="number" class="form-control" name="expense_amount" placeholder="Amount" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Expense Date:</label><span class="required">*</span>
                                        <input type="date" value="<?php echo date('Y-m-d');?>" class="form-control" name="expense_date" placeholder="Amount" required>
                                    </div>
                                    <div class="form-goup">
                                        <label>Upload Receipt:</label>
                                        <input type="file" class="form-control" name="receipt" placeholder="Upload">
                                    </div>
                                    <div class="form-goup">
                                        <label>Description:</label>
                                        <textarea name="description" placeholder="Description..." class="form-control"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="expense_btn" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
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
            <div class="col-md-12">
                <?php if(isset($_SESSION['message'])){
                    echo $_SESSION['message'];
                }
                ?>
            </div>
            <div class="col-md-12 col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading" style="background-color: #c49f47;"><a data-toggle="modal" data-target="#expense" class="btn btn-sm btn-info">Add Expense</a></div>
                    <div class="panel-body">
                        <?php
                        if($expenses){
                            ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th style="width: 5%;">S/N</th>
                                        <th>Expense Name</th>
                                        <th>Amount</th>
                                        <th>Expense Date</th>
                                        <th>Description</th>
                                        <th>Recorded Dated</th>
                                        <th style="width: 20%;">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count=1;
                                    foreach ($expenses as $details){
                                        ?>
                                        <tr>
                                            <td><?php echo $count;?>.</td>
                                            <td><?php echo $details['expense_name'];?></td>
                                            <td><?php echo number_format($details['expense_amount'],2);?></td>
                                            <td><?php echo $details['expense_date'];?> </td>
                                            <td><?php echo $details['description'];?> </td>
                                            <td><?php echo $details['recorded_date'];?> </td>
                                            <td>
                                                <?php
                                                if($details['receipt']==""){
                                                    ?>
                                                    <a class="btn btn-warning btn-sm"><i class="fa fa-warning"></i> No file!</a>
                                                    <?php
                                                }
                                                else{
                                                    ?>
                                                    <a download="" class="btn btn-info btn-sm" href="<?php echo base_url('assets/uploads/'.$details['receipt']);?>" ><i class="fa fa-download"></i> Receipt</a>
                                                <?php
                                                }
                                                ?>
                                                <a data-toggle="modal" data-target="#edit_expense<?php echo $details['expense_id'];?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil-square"></i> Edit</a>
                                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_expense<?php echo $details['expense_id'];?>"><i class="fa fa-trash"></i> Delete</a>
                                            </td>
                                        </tr>
                                        <!--Update modal-->
                                        <div class="modal fade" id="edit_expense<?php echo $details['expense_id'];?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title">Add Expense</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="<?php echo site_url('System/edit_expense/'.$details['expense_id']);?>" enctype="multipart/form-data">
                                                            <div class="form-group">
                                                                <label>Expense Name: </label><span class="required">*</span>
                                                                <input value="<?php echo $details['expense_name'];?>" class="form-control" name="expense_name" placeholder="Expense Name" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Amount:</label><span class="required">*</span>
                                                                <input value="<?php echo $details['expense_amount'];?>" type="number" class="form-control" name="expense_amount" placeholder="Amount" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Expense Date:</label><span class="required">*</span>
                                                                <input type="date" value="<?php echo $details['expense_date'];?>" class="form-control" name="expense_date" placeholder="Amount" required>
                                                            </div>
                                                            <div class="form-goup">
                                                                <label>Description:</label>
                                                                <textarea value="<?php echo $details['description'];?>" name="description" placeholder="Description..." class="form-control"><?php echo $details['description'];?></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" name="edit_expense_btn" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!--Delete modal-->
                                        <div class="modal fade" id="delete_expense<?php echo $details['expense_id'];?>">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title">Delete Data</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><i class="fa fa-warning"></i> SURE TO DELETE,,? The data will be deleted permanently..!!</p>
                                                        <form method="post" action="<?php echo site_url('System/delete_expense/'.$details['expense_id']);?>">
                                                            <button type="submit" name="delete" class="btn btn-danger">
                                                                <i class="fa fa-trash"></i> Delete
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
                            <?php
                        }
                        else{
                            ?>
                            <div class="col-md-12">
                                <div class="alert alert-danger alert-sm">Sorry no expense records found!</div>
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                    <div class="panel-footer" style="font-weight: bold;">
                        TOTAL EXPENSE:<?php foreach($expenses as $ex){} echo number_format($ex['expense_amount'],2);?>
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
