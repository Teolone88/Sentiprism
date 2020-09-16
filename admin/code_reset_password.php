<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <?php require './core_functions.php'; ?>
        <?php
        if ($_SESSION['MAIL_CODE_PAGE'] == 'OFF'):
            $_SESSION['MAIL_CODE_PAGE'] = 'OFF';
            $_SESSION['RESET_PASSWORD_USER'] = '';
            messageSuccess('Sorry you have not access to allow this');
            header('Location:index.php');
        endif;
        ?>
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
                    <form  method="POST">
                        <div class="msg">Reset Password Verification</div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">person</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" value="<?= @$_POST['confirmation_code']; ?>" name="confirmation_code" placeholder="Enter Conformation code" required autofocus>
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

        <?PHP       
        $checkMethod = $_SERVER['REQUEST_METHOD'];
        if ($checkMethod == 'POST'):
            if (!empty($_POST['confirmation_code'])):
                include './phpConnection.php';
                $userId = $_SESSION['RESET_PASSWORD_USER'];
                $findUserQry = "CALL getUserById('$userId')";
                $exUserQry = mysqli_query($conn, $findUserQry);
                if ($exUserQry->num_rows > 0):
                    $getUser = mysqli_fetch_assoc($exUserQry);
                    if ($getUser['login_type'] == 'ADMIN'):
                        if ($getUser['reset_token'] == $_POST['confirmation_code']):
                            messageSuccess('Please set your new password');
                            $_SESSION['RESET_PASS_CODE_IS_VERIFY'] = 'YES';
                            $_SESSION['RESET_PASS_USER'] = $getUser['id'];
                            header('Location:reserNewPassword.php');
                        else:
                            $_SESSION['RESET_PASS_CODE_IS_VERIFY'] = 'NO';
                            $_SESSION['RESET_PASS_USER'] = '';
                            messageError('Please recheck your conformation code');
                            header('Location:code_reset_password.php');
                        endif;
                    else:
                        $_SESSION['MAIL_CODE_PAGE'] = 'OFF';
                        $_SESSION['RESET_PASSWORD_USER'] = '';
                        messageError('You are not authorizedto access this.');
                        header('Location:index.php');
                    endif;
                else:
                    $_SESSION['MAIL_CODE_PAGE'] = 'OFF';
                    $_SESSION['RESET_PASSWORD_USER'] = '';
                    messageError('User not found.');
                    header('Location:index.php');
                endif;
            else:
                messageError('Please recheck your conformation code');
                header('Location:code_reset_password.php');
            endif;
        endif;
        ?>  

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