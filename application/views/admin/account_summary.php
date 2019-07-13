
<!-- Content Wrapper -->
<div class="content-wrapper">
    <section class="content-title">
        <h1>
            Accounts Summary
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-money"></i>Accounts Balance</a></li>
        </ol>
    </section>
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading">Accounts Summary</div>
                    <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead style="background-color: lightgrey">
                            <tr>
                                <th>S/N</th>
                                <th>National ID</th>
                                <th>Full Name</th>
                                <th>Total Savings</th>
                                <th>Total Withdrawn</th>
                                <th>Balance</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count=1;
                            foreach($sum as $s){
                                ?>
                                <tr>
                                    <td><?php echo $count;?>.</td>
                                    <td><?php echo $s['id'];?></td>
                                    <td><?php echo $s['first_name'].' '.$s['last_name'];?></td>
                                    <td><?php echo number_format($s['total'],2);?></td>
                                    <td>
                                        <?php
                                        foreach($subtract as $sub){
                                            if($sub['member_id']==$s['member_no']){
                                                echo number_format($sub['total'],2);
                                            }
                                            else{

                                            }
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        foreach($subtract as $sub){
                                            if($sub['member_id']==$s['member_no']){
                                                $total_withdraw=$sub['total'];
                                                echo number_format($s['total']-$total_withdraw,2);
                                            }
                                            else{
                                                //$total_withdraw='';
                                            }
                                        }
                                        //echo number_format($s['total']-$total_withdraw,2);
                                        ?>
                                    </td>
                                </tr>
                            <?php
                                $count++;
                            }
                            ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><strong>TOTAL: <?php foreach($total as $tot);?><?php echo number_format($tot['amount'],2);?></strong></td>
                                <td><strong>TOTAL: <?php foreach($total_drawn as $tota);?><?php echo number_format($tota['amount'],2);?></strong></td>
                                <td><strong>TOTAL: <?php echo number_format($tot['amount']-$tota['amount'],2);?></strong></td>
                            </tr>
                            </tfoot>
                        </table>
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
