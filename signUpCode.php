<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require './core_functions.php';

$request = $_SERVER['REQUEST_METHOD'];
if ($request == 'POST'):
    $fullName = $_REQUEST['user_fullname'];
    $userEmail = @mysqli_real_escape_string($conn, $_REQUEST['user_email']);
    $userPassword = @mysqli_real_escape_string($conn, $_REQUEST['user_password']);
    $userReTypePassword = @mysqli_real_escape_string($conn, $_REQUEST['user_retype_password']);
    $userPhone = @mysqli_real_escape_string($conn, $_REQUEST['user_phone']);
    $userType = 'USER';
    $loginType = 'USER';
    if ($userPassword == $userReTypePassword):
        $userPassword = password_hash($_REQUEST['user_password'], PASSWORD_DEFAULT);
        include './phpConnection.php';
        $findUserQry = "CALL addNewUser('$userEmail','$userPassword','$userPhone','$loginType','$userType','$fullName')";
        $exUserQry = mysqli_query($conn, $findUserQry);
        if ($exUserQry):
            messageSuccess('User registration completed successfully.');
            header('Location:index.php');
        else:
            messageError('User is already exist.');
            header('Location:signUp.php');
        endif;
    else:
        messageError('Your both password is not match.');
        header('Location:signUp.php');
    endif;
else:
    messageError('Invalid Mathod.');
    header('Location:signUp.php');
endif;
