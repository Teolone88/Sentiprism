<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$requestMethod = $_SERVER['REQUEST_METHOD'];
if ($requestMethod == 'POST'):
    $userId = @$_POST['userId'];
    if (!empty($userId)):
        include './phpConnection.php';
        $checkUserIsExist = "SELECT * FROM users WHERE id ='$userId'";
        $exCheckUserIsExist = mysqli_query($conn, $checkUserIsExist);
        $getUserDetails = mysqli_fetch_assoc($exCheckUserIsExist);
        if (!empty($getUserDetails)):
//            $imagePath = '/../uploads/users/';
//            $imageBastPath = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
//            $imageUrl = $imageBastPath . $imagePath . $getSquardDetails['profile_image'];
            $userId = $_POST['userId'];
            $memberName = $_POST['memberName'];
            $memberTitle = $_POST['memberTitle'];
            $memberYears = $_POST['memberYears'];
            $memberDesignation = $_POST['memberDesignation'];
            $memberIncome = $_POST['memberIncome'];
            $memberDesiDescription = $_POST['memberDesiDescription'];
            $memberCharDetails = $_POST['memberCharDetails'];
            $memberGoalDescription = $_POST['memberGoalDescription'];

            include './phpConnection.php';
            $updateUser = "UPDATE users SET user_fullname='$memberName',title='$memberTitle',years_old='$memberYears',person_designation='$memberDesignation',person_designation_details='$memberDesiDescription',key_characteristic_details='$memberCharDetails',goals_details='$memberGoalDescription',yearly_income='$memberIncome' WHERE id='$userId'";
            $isUserUpdate = mysqli_query($conn, $updateUser);           
        endif;
    endif;
endif;