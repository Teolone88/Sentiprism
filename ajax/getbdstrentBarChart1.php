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
    $checkUserIsExist = "SELECT * FROM  business_drivers_selection WHERE user_id='$userID' AND DATE(date) BETWEEN ('$startDate') AND ('$endDate') LIMIT 7";
    $exCheckUserIsExist = mysqli_query($conn, $checkUserIsExist);

    $moodData = [];
    while ($happyMoodCount = mysqli_fetch_assoc($exCheckUserIsExist)):
        $getMoodData = [];
        $getMoodData[] = $happyMoodCount['date'];
        $getMoodData[] = $happyMoodCount['quantity'];
        $getMoodData[] = $happyMoodCount['team_work'];
        $getMoodData[] = $happyMoodCount['control'];
        $getMoodData[] = $happyMoodCount['innovation'];
        $getMoodData[] = $happyMoodCount['legacy'];
        $getMoodData[] = $happyMoodCount['responsiveness'];
        $moodData[] = $getMoodData;
    endwhile;

    $mainArray = [];
    $mainArray[] = ['date', 'Quantity', 'Team Work', 'Control', 'Innovation', 'Legacy', 'Responsiveness'];
    $finalArray = array_merge($mainArray, $moodData);
   


//    ['2014', 1000, 400, 200],
//    ['2015', 1170, 460, 250],
//    ['2016', 660, 1120, 300],
//    ['2017', 1030, 540, 350]
//    ]
//    $mood_1 = intval($happyMoodCount['moodCount'], 0);
//    $mood_2 = intval($mood211['moodCount'], 0);
//    $mood_3 = intval($mood311['moodCount'], 0);
//    $mood_4 = intval($mood411['moodCount'], 0);
//    $mood_5 = intval($mood511['moodCount'], 0);
//    $mood_0 = intval(0);
//    $mainArray[] = ['Year', 'Happy', 'Sad', 'Tender', 'Satisfied', 'Energetic'];

    echo json_encode($finalArray);
    die;
endif;