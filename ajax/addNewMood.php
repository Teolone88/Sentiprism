<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$requestMethod = $_SERVER['REQUEST_METHOD'];
if ($requestMethod == 'POST'):
    $mood1IsSelected = @$_POST['mood1IsSelected'];
    $mood2IsSelected = @$_POST['mood2IsSelected'];
    $mood3IsSelected = @$_POST['mood3IsSelected'];
    $mood4IsSelected = @$_POST['mood4IsSelected'];
    $mood5IsSelected = @$_POST['mood5IsSelected'];
    $mood_comment = @$_POST['mood_comment'];
    $getCurrentUserId = @$_POST['getCurrentUserId'];
    $moodSubmitDate = @date('Y-m-d');
    if (!empty($getCurrentUserId)):
        include './phpConnection.php';
        $checkTodayAlreadySubmitted = "SELECT * FROM user_moods WHERE mood_date='$moodSubmitDate' AND user_id='$getCurrentUserId'";
        $getCheckTodayAlreadySubmitted = mysqli_query($conn, $checkTodayAlreadySubmitted);
        $getCheckTodayAlreadySubmittedArr = mysqli_fetch_assoc($getCheckTodayAlreadySubmitted);
        if (empty($getCheckTodayAlreadySubmittedArr)):
            include './phpConnection.php';
            $addMoodQuery = "INSERT INTO user_moods (user_id,mood_1,mood_2,mood_3,mood_4,mood_5,mood_comment,mood_date) VALUES('$getCurrentUserId','$mood1IsSelected','$mood2IsSelected','$mood3IsSelected','$mood4IsSelected','$mood5IsSelected','$mood_comment','$moodSubmitDate')";
            $setMoodQuery = mysqli_query($conn, $addMoodQuery);
        endif;
    endif;
endif;
