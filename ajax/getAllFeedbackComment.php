<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$requestMethod = $_SERVER['REQUEST_METHOD'];
if ($requestMethod == 'POST'):
    $currentSquardId = @$_POST['currentSquardId'];
    if (!empty($currentSquardId)):
        include './phpConnection.php';
        $getCurrentMonth = date('m');
        $getCurrentYear = date('Y');
        $getUserDetails = mysqli_query($conn, "SELECT  * FROM `members_feedback` WHERE squard_id='$currentSquardId' AND YEAR(created_at)='$getCurrentYear' AND MONTH(created_at)='$getCurrentMonth'");
        if (!empty($getUserDetails)):
            $topRatedUserData = [];
            foreach ($getUserDetails as $getUserDetail):
                $userData = [];
                $userData['userId'] = $getUserDetail['user_id'];
                $userData['squard_id'] = $getUserDetail['squard_id'];
//                $userData['user_name'] = $getUserDetail['user_name'];
                $userData['overall_rating'] = $getUserDetail['overall_rating'];
                $userData['feedback_date'] = $getUserDetail['created_at'];
                $userData['feedback_title'] = $getUserDetail['feedback_title'];
                $userData['small_description'] = substr($getUserDetail['feedback_description'], 0, 100);
                $userData['long_description'] = $getUserDetail['feedback_description'];
                $userData['id'] = $getUserDetail['id'];
//                $imagePath = '/../uploads/users/';
//                $imageBastPath = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
//                $imageUrl = $imageBastPath . $imagePath . $getUserDetail['profile_image'];
//                $userData['profile_image'] = $imageUrl;
                $topRatedUserData[] = $userData;
            endforeach;

            if (!empty($topRatedUserData)):
                echo json_encode($topRatedUserData);
            else:
                echo json_encode([]);
            endif;
        endif;
    endif;
endif;