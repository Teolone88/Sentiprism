<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <?php require './core_functions.php'; ?>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Reset Password Here</title>
        <!-- Favicon-->
        <link rel="icon" href="assets/favicon.ico" type="image/x-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

        <!-- Bootstrap Core Css -->
        <link href="assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

        <!-- Waves Effect Css -->
        <link href="assets/plugins/node-waves/waves.css" rel="stylesheet" />

        <!-- Animation Css -->
        <link href="assets/plugins/animate-css/animate.css" rel="stylesheet" />

        <!-- Custom Css -->
        <link href="assets/css/style.css" rel="stylesheet">
    </head>

    <body class="login-page">
        <div class="login-box">
            <div class="logo">
                <a href="../index.php">Sentiprism<b></b></a>
                <small>Admin Panel</small>
            </div>
            <?php
            $msg = new \Plasticbrain\FlashMessages\FlashMessages();
            $msg->display();
            ?>
            <div class="card">
                <div class="body">
                    <form action="resetPasswordCode.php"  method="POST">
                        <div class="msg">Reset Your Password</div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">person</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" name="user_email" placeholder="Email" required autofocus>
                            </div>
                        </div>                      
                        <div class="row">
                            <div class="col-xs-8 p-t-5">
<!--                                <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                                <label for="rememberme">Remember Me</label>-->
                            </div>
                            <div class="col-xs-4">
                                <button class="btn btn-block bg-pink waves-effect" type="submit">SUBMIT</button>
                            </div>
                        </div>
                        <div class="row m-t-15 m-b--20">
                            <div class="col-xs-6">
                                <!--<a href="sign-up.html">Register Now!</a>-->
                            </div>
                            <div class="col-xs-6 align-right">
                                <a href="index.php">Go Back?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Jquery Core Js -->
        <script src="assets/plugins/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core Js -->
        <script src="assets/plugins/bootstrap/js/bootstrap.js"></script>

        <!-- Waves Effect Plugin Js -->
        <script src="assets/plugins/node-waves/waves.js"></script>

        <!-- Validation Plugin Js -->
        <script src="assets/plugins/jquery-validation/jquery.validate.js"></script>

        <!-- Custom Js -->
        <script src="assets/js/admin.js"></script>
        <script src="assets/js/pages/examples/sign-in.js"></script>
    </body>

</html>