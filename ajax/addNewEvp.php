<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$requestMethod = $_SERVER['REQUEST_METHOD'];
if ($requestMethod == 'POST'):    
    $evp1IsSelected = @$_POST['evp1IsSelected'];
    $evp2IsSelected = @$_POST['evp2IsSelected'];
    $evp3IsSelected = @$_POST['evp3IsSelected'];
    $evp4IsSelected = @$_POST['evp4IsSelected'];
    $evp_comment = @$_POST['evp_comment'];
    $getCurrentUserId = @$_POST['getCurrentUserId'];
    $moodSubmitDate = @date('Y-m-d');
    if (!empty($getCurrentUserId)):
        include './phpConnection.php';
        $checkTodayAlreadySubmitted = "SELECT * FROM members_evp WHERE date='$moodSubmitDate' AND user_id='$getCurrentUserId'";
        $getCheckTodayAlreadySubmitted = mysqli_query($conn, $checkTodayAlreadySubmitted);
        $getCheckTodayAlreadySubmittedArr = mysqli_fetch_assoc($getCheckTodayAlreadySubmitted);      
        if (empty($getCheckTodayAlreadySubmittedArr)):
            include './phpConnection.php';
            $addEvpQuery = "INSERT INTO members_evp (user_id,opportunity,orgnization,people,work,date,comments) VALUES('$getCurrentUserId','$evp1IsSelected','$evp2IsSelected','$evp3IsSelected','$evp4IsSelected','$moodSubmitDate','$evp_comment')";
            $setEvpQuery = mysqli_query($conn, $addEvpQuery);           
        endif;
    endif;
endif;
