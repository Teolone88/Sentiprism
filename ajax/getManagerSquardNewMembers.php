<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$requestMethod = $_SERVER['REQUEST_METHOD'];
if ($requestMethod == 'POST'):
    $selectedUserId = @$_POST['selectedUserId'];
    if (!empty($selectedUserId)):
        include './phpConnection.php';
        $setUserData = mysqli_query($conn, "SELECT * FROM users WHERE id='$selectedUserId'");
        $getUserDetails = mysqli_fetch_assoc($setUserData);
        if (!empty($getUserDetails)):
            $imagePath = '/../uploads/users/';
            $imageBastPath = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
            $imageUrl = $imageBastPath . $imagePath . $getUserDetails['profile_image'];
            $userData = [];
            $userData['Id'] = ((int) $getUserDetails['id']) ? (int) $getUserDetails['id'] : '';
            $userData['user_fullname'] = ($getUserDetails['user_fullname']) ? $getUserDetails['user_fullname'] : '';
            $userData['profile_image'] = $imageUrl;
            if (!empty($userData)):
                echo json_encode((object) $userData);
            else:
                echo json_encode((object) []);
            endif;
        endif;
    endif;
endif;