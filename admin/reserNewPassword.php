<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <?php require './core_functions.php'; ?>
    <?php
    $_SESSION['MAIL_CODE_PAGE'] = 'OFF';
    $_SESSION['RESET_PASSWORD_USER'] = '';
    if ($_SESSION['RESET_PASS_CODE_IS_VERIFY'] == 'NO'):
        $_SESSION['RESET_PASS_CODE_IS_VERIFY'] = 'NO';
        $_SESSION['RESET_PASS_USER'] = '';
        messageSuccess('Sorry you have not access to allow this');
        header('Location:index.php');
    endif;
    ?>
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Sign In | Sentiprism</title>
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
                <a href="javascript:void(0);">Sentiprism<b></b></a>
                <small>Admin Panel</small>
            </div>
            <?php
            $msg = new \Plasticbrain\FlashMessages\FlashMessages();
            $msg->display();
            ?>
            <div class="card">
                <div class="body">
                    <form method="POST">
                        <div class="msg">SET NEW PASSWORD</div>                        
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">lock</i>
                            </span>
                            <div class="form-line">
                                <input type="password" class="form-control" name="user_new_password" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">lock</i>
                            </span>
                            <div class="form-line">
                                <input type="password" class="form-control" name="user_confirm_new_password" placeholder="Confirm Password" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-8 p-t-5">
<!--                                <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                                <label for="rememberme">Remember Me</label>-->
                            </div>
                            <div class="col-xs-4">
                                <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                            </div>
                        </div>
                        <div class="row m-t-15 m-b--20">
                            <div class="col-xs-6">
                                <!--<a href="sign-up.html">Register Now!</a>-->
                            </div>
                            <div class="col-xs-6 align-right">
                                <a href="reset_password.php">Forgot Password?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <?PHP
        $checkMethod = $_SERVER['REQUEST_METHOD'];
        if ($checkMethod == 'POST'):
            if (!empty($_POST['user_new_password']) && !empty($_POST['user_confirm_new_password'])):
                include './phpConnection.php';
                $userId = $_SESSION['RESET_PASS_USER'];
                $findUserQry = "CALL getUserById('$userId')";
                $exUserQry = mysqli_query($conn, $findUserQry);               
                if ($exUserQry->num_rows > 0):
                    $getUser = mysqli_fetch_assoc($exUserQry);
                    if ($getUser['login_type'] == 'ADMIN'):
                        if ($_POST['user_new_password'] == $_POST['user_confirm_new_password']):
                            $newPassword = password_hash($_POST['user_new_password'], PASSWORD_DEFAULT);
                            include './phpConnection.php';
                            $userId = $_SESSION['RESET_PASS_USER'];
                            $findUserQry = "CALL updatePassword('$userId','$newPassword')";
                            $exUserQry = mysqli_query($conn, $findUserQry);                         

                            if ($exUserQry):
                                $_SESSION['RESET_PASS_CODE_IS_VERIFY'] = 'NO';
                                $_SESSION['RESET_PASS_USER'] = '';
                                $_SESSION['MAIL_CODE_PAGE'] = 'OFF';
                                $_SESSION['RESET_PASSWORD_USER'] = '';
                                messageSuccess('Your password changed successfully.');
                                header('Location:index.php');
                            else:
                                $_SESSION['RESET_PASS_CODE_IS_VERIFY'] = 'NO';
                                $_SESSION['RESET_PASS_USER'] = '';
                                messageError('Please recheck your conformation code');
                                header('Location:code_reset_password.php');
                            endif;
                        else:
                            messageError('Please check Your both entered password.');
                            header('Location:reserNewPassword.php');
                        endif;

                    else:
                        $_SESSION['RESET_PASS_CODE_IS_VERIFY'] = 'NO';
                        $_SESSION['RESET_PASS_USER'] = '';
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