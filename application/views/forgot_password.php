<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Chama System</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/resources/img/favicon.png">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/iCheck/all.css">

    <!-- Icons -->
    <link href="<?php echo base_url();?>assets/resources/icons/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/resources/icons/themify-icons/themify-icons.css" rel="stylesheet">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/resources/css/main-style.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/resources/css/skins/all-skins.min.css">

    <link rel="stylesheet" href="<?php echo base_url();?>assets/resources/css/demo.css">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-112423372-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-112423372-2');
    </script>
<style>
   .error, .required{
        color: red;
    }
</style>
</head>
<body class="skin-blue login-page">
<div class="container-fluid" style="background-color:#6495ED">
    <div class="row" style="text-align: center">
        <div class="col-md-4">
            <h1 style="color: white; font-family:  font-family: Georgia, serif; font-size: 30px; font-weight: 600; text-align: left;">CHAMA SYSTEM</h1>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4">

        </div>
    </div>
</div>
<div class="box-login">
    <div class="box-login-body">
        <div class="row">
            <div class="col-md-12">
                <?php
                if(isset($_SESSION['message'])){
                    echo $_SESSION['message'];
                }
                ?>
            </div>
        </div>
        <h3><span><b>Forgot Password</b></span></h3>
        <form class="login-form" action="<?php echo site_url('System/recover_password');?>" method="post">
            <div class="row">
                <div class="col-md-12">
                    <p style="color: green;"><strong>NOTE:</strong> Enter Valid email and a new password will be sent to your email.</p>
                </div>
            </div>
            <div class="form-group">
                <label>Email Address:</label> <span class="required">*</span>
                <input class="form-control" type="email" name='email' placeholder="Enter Valid Email" required autofocus/="">
            </div>
            <div class="form-group">
                <button type="submit" name="forgotpass_btn" class="btn btn-block btn-primary">Recover Password</button>
            </div>
            <div style="margin-top:10px; margin-bottom: 10px; text-align:center;"><a href="<?php echo site_url('System/index');?>"><i class="fa fa-backward"></i> Back Home</a></div>
        </form>
    </div>
</div>
<!-- JS scripts -->
<script src="<?php echo base_url();?>assets/vendor/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php echo base_url();?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/vendor/iCheck/icheck.min.js"></script>
<script src="<?php echo base_url();?>assets/resources/js/pages/jquery-icheck.js"></script>
<script src="<?php echo base_url();?>assets/vendor/fastclick/fastclick.min.js"></script>
<script src="<?php echo base_url();?>assets/resources/js/demo.js"></script>
</body>
</html>