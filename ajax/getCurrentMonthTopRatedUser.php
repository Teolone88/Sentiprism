<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$requestMethod = $_SERVER['REQUEST_METHOD'];
if ($requestMethod == 'POST'):
    $managerCurrentSquardId = @$_POST['managerCurrentSquardId'];
    if (!empty($managerCurrentSquardId)):
        include './phpConnection.php';
        $getCurrentMonth = date('m');
        $getCurrentYear = date('Y');
        $getUserDetails = mysqli_query($conn, "SELECT a.user_id,a.squard_id,(SELECT user_fullname FROM users WHERE id=a.user_id) as user_name,(SELECT profile_image FROM users WHERE id=a.user_id) as profile_image,(SELECT COALESCE(SUM(ab.overall_rating),0) as rating FROM members_feedback AS ab WHERE ab.user_id=a.user_id AND YEAR(ab.created_at)='$getCurrentYear' AND MONTH(ab.created_at)='$getCurrentMonth') as overall_rating FROM `squard_member` AS a WHERE a.squard_id='$managerCurrentSquardId' ORDER BY overall_rating DESC");
        if (!empty($getUserDetails)):
            $topRatedUserData = [];
            foreach ($getUserDetails as $getUserDetail):
                $userData = [];
                $userData['userId'] = $getUserDetail['user_id'];
                $userData['squard_id'] = $getUserDetail['squard_id'];
                $userData['user_name'] = $getUserDetail['user_name'];
                $userData['overall_rating'] = $getUserDetail['overall_rating'];
                $imagePath = '/../uploads/users/';
                $imageBastPath = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
                $imageUrl = $imageBastPath . $imagePath . $getUserDetail['profile_image'];
                $userData['profile_image'] = $imageUrl;
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