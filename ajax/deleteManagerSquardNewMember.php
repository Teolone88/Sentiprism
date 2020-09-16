<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$requestMethod = $_SERVER['REQUEST_METHOD'];
if ($requestMethod == 'POST'):
    $memberId = @$_POST['memberId'];
    if (!empty($memberId)):
        include './phpConnection.php';
        $squardMemberId = mysqli_query($conn, "SELECT * FROM squard_member WHERE id='$memberId'");
        $getMemberUserId = mysqli_fetch_assoc($squardMemberId);

        include './phpConnection.php';
        $getUserDetails = mysqli_query($conn, "SELECT * FROM users WHERE id='$getMemberUserId[user_id]'");
        $getUser = mysqli_fetch_assoc($getUserDetails);

        include './phpConnection.php';
        $setMemberData = mysqli_query($conn, "DELETE FROM squard_member WHERE id='$memberId'");
        if (!empty($setMemberData)):
            include './phpConnection.php';
            mysqli_query($conn, "UPDATE users SET is_joined_to_squard='0' WHERE id='$getMemberUserId[user_id]'");            

            $userData = [];
            $userData['id'] = $getUser['id'];
            $userData['user_fullname'] = $getUser['user_fullname'];
            $userData['email'] = $getUser['email'];

            echo json_encode($userData);
            die;
        endif;
    endif;
endif;