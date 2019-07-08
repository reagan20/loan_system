<?php
if(!$this->session->userdata('isloggedin')){
    redirect('System/index');
}
else{
foreach($details as $det){
    $fname=$det['first_name'];
    $lname=$det['last_name'];
    $mail=$det['email'];
}
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Loan System</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" href="<?php echo base_url()?>assets/resources/img/favicon.png">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/morris/morris.css">
    <!-- Icons -->
    <link href="<?php echo base_url();?>assets/resources/icons/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/resources/icons/themify-icons/themify-icons.css" rel="stylesheet">
    <!--animate css-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/animate.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/resources/css/main-style.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/resources/css/skins/all-skins.min.css">

    <link rel="stylesheet" href="<?php echo base_url();?>assets/resources/css/demo.css">
    <!--Supports searchable select field-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/search_select/select2.css">
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-112423372-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-112423372-2');
    </script>
    <style>
        .required, .error{
            color: red;
        }
        .form-control{
            border-radius: 6px;
        }
    </style>
</head>

<body class="skin-blue sidebar-mini">

<div class="wrapper">
    <!-- Main Header -->
    <header class="top-menu-header">
        <!-- Logo -->
        <a href="<?php echo site_url('System/dashboard');?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><img src="<?php echo base_url();?>assets/resources/img/icons/logo-mini.png" class="img-circle" alt="Logo Mini"></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Administrator</b></span>
        </a>
        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a class="sidebar-toggle fa-icon" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-top-menu">
                <ul class="nav navbar-nav">
                    <!--Fullscreen-->
                    <li>
                        <a id="fullscreen-page" role="button"><i class="fa fa-arrows-alt"></i></a>
                    </li>
                    <!-- Notifications Menu -->
                    <!--<li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label bg-black">4</span>
                        </a>
                        <ul class="dropdown-menu animated flipInY">
                            <li class="header">4 notifications</li>
                            <li>
                                <ul class="menu">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-green"></i> Your profile has been updated
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-user text-green"></i> Settings updated
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-warning text-yellow"></i> Problem with the CPU
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-red"></i> The meeting has been canceled
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer"><a href="#">View all</a></li>
                        </ul>
                    </li>-->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" data-toggle="dropdown" aria-expanded="false">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs"><?php echo $fname.' '.$lname;?><i class="fa fa-angle-down pull-right"></i></span>
                            <!-- The user image in the navbar-->
                            <img src="<?php echo base_url();?>assets/resources/img/icons/icon-user.jpg" class="user-image" alt="User Image">
                        </a>
                        <ul class="dropdown-menu user-menu animated flipInY">
                            <li><a href="<?php echo site_url('System/profile');?>"><i class="ti-user"></i> Profile</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo site_url('System/logout');?>"><i class="ti-power-off"></i> Log Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>