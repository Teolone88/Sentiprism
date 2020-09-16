<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include './phpConnection.php';
session_start();
$requestMethod = $_SERVER['REQUEST_METHOD'];
if ($requestMethod == 'POST'):
    $userID = @$_SESSION['currentUserId'];

    $getDate = $_POST['selectedDate'];
    $getTwoDate = explode('-', $getDate);

    $date = date_create(trim(str_replace('/', '-', $getTwoDate[0])));
    $date1 = date_create(trim(str_replace('/', '-', $getTwoDate[1])));
    $startDate = date_format($date, "Y-m-d");
    $endDate = date_format($date1, "Y-m-d");

    if ($startDate == $endDate):
        $modifyDate = date('Y-m-d', strtotime('-30 day', strtotime($startDate)));
        $startDate = $modifyDate;
    endif;

    // MOOD 1 COUNT
    include './phpConnection.php';
    $checkUserIsExist = "SELECT count(mood_1) as moodCount FROM user_moods WHERE mood_1>0 AND user_id='$userID' AND DATE(mood_date) BETWEEN ('$startDate') AND ('$endDate')";
    $exCheckUserIsExist = mysqli_query($conn, $checkUserIsExist);
    $happyMoodCount = mysqli_fetch_assoc($exCheckUserIsExist);

    // MOOD 2 COUNT
    include './phpConnection.php';
    $mood2 = "SELECT count(mood_2) as moodCount FROM user_moods WHERE mood_2 > 0 AND user_id='$userID' AND DATE(mood_date) BETWEEN ('$startDate') AND ('$endDate')";
    $mood21 = mysqli_query($conn, $mood2);
    $mood211 = mysqli_fetch_assoc($mood21);

    // MOOD 3 COUNT
    include './phpConnection.php';
    $mood3 = "SELECT count(mood_3) as moodCount FROM user_moods WHERE mood_3 > 0 AND user_id='$userID' AND DATE(mood_date) BETWEEN ('$startDate') AND ('$endDate')";
    $mood31 = mysqli_query($conn, $mood3);
    $mood311 = mysqli_fetch_assoc($mood31);

    // MOOD 4 COUNT
    include './phpConnection.php';
    $mood4 = "SELECT count(mood_4) as moodCount FROM user_moods WHERE mood_4 > 0 AND user_id='$userID' AND DATE(mood_date) BETWEEN ('$startDate') AND ('$endDate')";
    $mood41 = mysqli_query($conn, $mood4);
    $mood411 = mysqli_fetch_assoc($mood41);

    $mood_1 = number_format($happyMoodCount['moodCount'], 0);
    $mood_2 = number_format($mood211['moodCount'], 0);
    $mood_3 = number_format($mood311['moodCount'], 0);
    $mood_4 = number_format($mood411['moodCount'], 0);


    // MOOD 5 COUNT
    include './phpConnection.php';
    $mood5 = "SELECT count(mood_4) as moodCount FROM user_moods WHERE mood_4 > 0 AND user_id='$userID' AND DATE(mood_date) BETWEEN ('$startDate') AND ('$endDate')";
    $mood51 = mysqli_query($conn, $mood5);
    $mood511 = mysqli_fetch_assoc($mood51);

    $mood_1 = intval($happyMoodCount['moodCount'], 0);
    $mood_2 = intval($mood211['moodCount'], 0);
    $mood_3 = intval($mood311['moodCount'], 0);
    $mood_4 = intval($mood411['moodCount'], 0);
    $mood_5 = intval($mood511['moodCount'], 0);
    $mood_0 = intval(0);


    $mainArray = [];
    $mainArray[] = ['Mood', 'Happy', 'Sad', 'Tender', 'Satisfied', 'Energetic'];
    $mainArray[] = [1, $mood_1, $mood_0, $mood_0, $mood_0, $mood_0];
    $mainArray[] = [2, $mood_0, $mood_2, $mood_0, $mood_0, $mood_0];
    $mainArray[] = [3, $mood_0, $mood_0, $mood_3, $mood_0, $mood_0];
    $mainArray[] = [4, $mood_0, $mood_0, $mood_0, $mood_4, $mood_0];
    $mainArray[] = [5, $mood_0, $mood_0, $mood_0, $mood_0, $mood_5];

    echo json_encode($mainArray);
    die;
endif;