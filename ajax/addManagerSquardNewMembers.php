<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$requestMethod = $_SERVER['REQUEST_METHOD'];
if ($requestMethod == 'POST'):
    $memberId = @$_POST['memberId'];
    $squardId = @$_POST['squardId'];
    if (!empty($memberId)):
        include './phpConnection.php';
        $setMemberData = mysqli_query($conn, "INSERT INTO squard_member (squard_id,user_id) VALUES ('$squardId','$memberId')");
        $lastId = $conn->insert_id;
        if (!empty($setMemberData)):
            include './phpConnection.php';
            mysqli_query($conn, "UPDATE users SET is_joined_to_squard='1' WHERE id='$memberId'");

            $getUserDetails = mysqli_query($conn, "SELECT * FROM users WHERE id='$memberId'");
            $getUser = mysqli_fetch_assoc($getUserDetails);

            $imagePath = '/../uploads/users/';
            $imageBastPath = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
            $imageUrl = $imageBastPath . $imagePath . $getUser['profile_image'];


            $userData = [];
            $userData['id'] = $lastId;
            $userData['profile_image'] = $imageUrl;
            $userData['user_fullname'] = $getUser['user_fullname'];
            $userData['email'] = $getUser['email'];

            echo json_encode($userData);
            die;

        endif;
    endif;
endif;