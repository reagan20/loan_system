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
        <h3><span><b>Create Account</b></span></h3>
        <!--<p class="box-login-msg">Register a new membership</p>-->
        <form class="login-form" action="<?php echo site_url('System/new_admin')?>" method="post">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>National ID:</label> <span class="required">*</span>
                        <input class="form-control" type="number" name='id_no' placeholder="ID Number" required autofocus/="">
                    </div>
                    <div class="form-group">
                        <label>First Name:</label> <span class="required">*</span>
                        <input class="form-control" type="text" name='first_name' placeholder="First Name" required autofocus/="">
                    </div>
                    <div class="form-group">
                        <label>Last Name:</label> <span class="required">*</span>
                        <input class="form-control" type="text" name='last_name' placeholder="Last Name" required autofocus/="">
                    </div>
                    <div class="form-group">
                        <label>Email:</label> <span class="required">*</span>
                        <input class="form-control" type="email" name='email' placeholder="Email Address" required autofocus/="">
                    </div>
                    <div class="form-group">
                        <label>Password:</label> <span class="required">*</span>
                        <input class="form-control" type="password" name='password' required placeholder="Password">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="signup_btn" class="btn btn-block btn-primary">Sign Up</button>
                    </div>
                    <div class="form-group text-center">
                        <a href="<?php echo site_url('System/index');?>">Have an account?</a>&nbsp;|&nbsp;<a href="#">Support</a>
                    </div>
                </div>
            </div>
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