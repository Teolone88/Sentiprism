<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require './core_functions.php';

$request = $_SERVER['REQUEST_METHOD'];
if ($request == 'POST'):
    $userEmail = mysqli_real_escape_string($conn, $_POST['user_email']);
    $userPassword = mysqli_real_escape_string($conn, $_POST['user_password']);
    include './phpConnection.php';
    $findUserQry = "CALL checkEmail('$userEmail')";
    $exUserQry = mysqli_query($conn, $findUserQry);
    if ($exUserQry->num_rows > 0):
        $getUser = mysqli_fetch_assoc($exUserQry);
        $verifyPassword = password_verify($userPassword, $getUser['password']);
        if ($verifyPassword == 1):
            $_SESSION['user'] = $getUser;
            $_SESSION['currentUserId'] = $getUser['id'];
            messageSuccess('Welcome.');
            header('Location:home.php');
        else:
            messageError('Please check your email and password.');
            header('Location:index.php');
        endif;
    else:
        messageError('Please check your email id and password.');
        header('Location:signUp.php');
    endif;
else:
    messageError('Invalid Mathod.');
    header('Location:signUp.php');
endif;
