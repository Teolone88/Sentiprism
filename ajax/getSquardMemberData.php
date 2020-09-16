<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$requestMethod = $_SERVER['REQUEST_METHOD'];
if ($requestMethod == 'POST'):
    $squardMemberId = @$_POST['squardMemberId'];
    if (!empty($squardMemberId)):
        include './phpConnection.php';
        $setSquardData = mysqli_query($conn, "CALL getSquardMemberById('$squardMemberId')");
        $getSquardDetails = mysqli_fetch_assoc($setSquardData);
        if (!empty($getSquardDetails)):
            $imagePath = '/../uploads/users/';
            $imageBastPath = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
            $imageUrl = $imageBastPath . $imagePath . $getSquardDetails['profile_image'];
            $userData = [];
            $userData['Id'] = ((int) $getSquardDetails['id']) ? (int) $getSquardDetails['id'] : '';
            $userData['user_fullname'] = ($getSquardDetails['user_fullname']) ? $getSquardDetails['user_fullname'] : '';
            $userData['profile_image'] = $imageUrl;
            if (!empty($userData)):
                echo json_encode((object) $userData);
            else:
                echo json_encode((object) []);
            endif;
        endif;
    endif;
endif;