<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$requestMethod = $_SERVER['REQUEST_METHOD'];
if ($requestMethod == 'POST'):
        $squardId = @$_POST['squardId'];
    if (!empty($squardId)):
        include './phpConnection.php';
        $getUserDetails = mysqli_query($conn, "SELECT a.user_id,a.squard_color,b.user_fullname,b.key_characteristic_details,b.title,b.email,b.business_name,b.profile_image,b.phone,b.person_designation,b.person_designation_details,b.goals,b.goals_details FROM `squard_member` as a JOIN users as b ON a.user_id=b.id WHERE a.squard_id='$squardId'");
//        $getUserDetails = mysqli_fetch_assoc($setUserData);
        if (!empty($getUserDetails)):

            $userData = [];
            foreach ($getUserDetails as $getUserDetail):
                $userDetails = [];
                $userDetails['user_id'] = $getUserDetail['user_id'];
                $userDetails['squard_color'] = $getUserDetail['squard_color'];
                $userDetails['user_fullname'] = $getUserDetail['user_fullname'];
                $userDetails['email'] = $getUserDetail['email'];
                $userDetails['business_name'] = $getUserDetail['business_name'];
                $userDetails['title'] = $getUserDetail['title'];
                $imagePath = '/../uploads/users/';
                $imageBastPath = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
                $imageUrl = $imageBastPath . $imagePath . $getUserDetail['profile_image'];
                $userDetails['profile_image'] = $imageUrl;
                $userDetails['phone'] = $getUserDetail['phone'];
                $userDetails['person_designation'] = $getUserDetail['person_designation'];
                $userDetails['person_designation_details'] = $getUserDetail['person_designation_details'];
                $userDetails['key_characteristic_details'] = $getUserDetail['key_characteristic_details'];
                $userDetails['goals'] = $getUserDetail['goals'];
                $userDetails['goals_details'] = $getUserDetail['goals_details'];
                $userData[] = $userDetails;
            endforeach;
            if (!empty($userData)):
                echo json_encode($userData);
            else:
                echo json_encode([]);
            endif;
        endif;
    endif;
endif;