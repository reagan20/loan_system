
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/pdflayout.css">
<body>
<div class="container" >
    <?php
    foreach ($details1 as $d){
        ?>
        <div class="row-fluid "  style="text-align: center;">
            <img src="<?php echo base_url('assets/uploads/'.$d['logo']);?>"  alt="SACCO Logo" class="logo" width="100" height="100"/><!--style="padding-left:39%"-->
            <h3><?php echo $d['sacco_name'];?></h3>
        </div>
        <div class="row-fluid"  style="padding-left:10%; padding-right:-5%;">
            <div class="span6 pull-left" style="text-align:left;margin-top:-20px;"><br/>
                Tel. No: <?php echo $d['sacco_phone'];?> <br/>
                Email: <u> <?php echo $d['sacco_email'];?></u><br/>
            </div>

            <div class="span6" style="text-align:left; padding-left:74%; margin-top:-65px; ">P.O Box <?php echo $d['sacco_box'].','.$d['county'];?> <br/><?php echo $d['country'];?><br/></div>
        </div>
    <?php
    }
    ?>
    <div class=" row-fluid1"  style="padding-left:10%; padding-right:-5%;"><hr/>  </div>
    <div class=" row-fluid1"  style="padding-left:10%; padding-right:-5%; text-align:center"><br/>
        <u><strong>ACTIVE LOANS REPORT</strong></u>
    </div>
    <br/>
    <div class="row-fluid " style="padding-left:10%; padding-right:-5%;">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>S/N.</th>
                <th>Borrower Name</th>
                <th>Loan Type</th>
                <th>Principle</th>
                <th>Interest</th>
                <th>Amount</th>
                <th>Loan Date</th>
                <th>Due Date</th>
                <th>Paid Amount</th>
                <th>Balance</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $count=1;
            foreach($details as $det):
                ?>
                <tr>
                    <td><?php echo $count;?>.</td>
                    <td><?php echo $det['first_name'].' '.$det['last_name'].' ('.$det['serial'].')';?></td>
                    <td><?php echo $det['loan_type'].' ('.$det['interest_rate'].'%'.' )'; ?></td>
                    <td><?php echo number_format($det['borrowed_amount'],2);?> </td>
                    <td><?php echo number_format($det['interest_amount'],2);?> </td>
                    <td><?php echo number_format($det['expected_amount'],2);?> </td>
                    <td><?php echo $det['start_date'];?> </td>
                    <td><?php echo $det['deadline_date'];?></td>
                    <td><?php echo number_format($det['paid_amount'],2);?></td>
                    <td style="font-weight: bold; color: red;"><?php echo number_format($det['expected_amount']-$det['paid_amount'],2);?></td>
                </tr>
                <?php
                $count++;
            endforeach;
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>

