<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$requestMethod = $_SERVER['REQUEST_METHOD'];
if ($requestMethod == 'POST'):
    $getSquardManagerId = @$_POST['getSquardManagerId'];
    if (!empty($getSquardManagerId)):
        include './phpConnection.php';
        $setUserDatas = mysqli_query($conn, "SELECT a.squard_id,a.user_id,a.squard_color,b.squard_name,c.user_fullname,c.email,c.profile_image,c.person_designation_details,c.title FROM `squard_member` as a JOIN squard as b ON a.squard_id=b.id JOIN users as c ON a.user_id=c.id  WHERE b.id='$getSquardManagerId'");
        if (!empty($setUserDatas)):
            $membersData = [];
            foreach ($setUserDatas as $setUserData):
                $data = [];
                $data['squard_id'] = $setUserData['squard_id'];
                $data['user_id'] = $setUserData['user_id'];
                $data['squard_color'] = $setUserData['squard_color'];
                $data['squard_name'] = $setUserData['squard_name'];
                $data['user_fullname'] = $setUserData['user_fullname'];
                $data['title'] = $setUserData['title'];
                $data['person_designation_details'] = $setUserData['person_designation_details'];
                $data['email'] = $setUserData['email'];
                $imagePath = '../../../uploads/users/';
                $imageBastPath = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
                $imageUrl = $imageBastPath . $imagePath . $setUserData['profile_image'];
                $data['profile_image'] = $imageUrl;
                $membersData[] = $data;
            endforeach;

            if (!empty($membersData)):
                echo json_encode($membersData);
            else:
                echo json_encode([]);
            endif;
        endif;
    endif;
endif;