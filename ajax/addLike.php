<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$requestMethod = $_SERVER['REQUEST_METHOD'];
if ($requestMethod == 'POST'):

    $feedBackId = @$_POST['feedBackId'];
    $UserId = @$_POST['UserId'];
    if (!empty($feedBackId)):
        $data = [];
        include './phpConnection.php';
        $checkTodayAlreadySubmitted = "SELECT * FROM members_feedback_comments WHERE member_feedback_id='$feedBackId' AND user_id='$UserId'";
        $getCheckTodayAlreadySubmitted = mysqli_query($conn, $checkTodayAlreadySubmitted);
        $getCheckTodayAlreadySubmittedArr = mysqli_fetch_assoc($getCheckTodayAlreadySubmitted);
        if (empty($getCheckTodayAlreadySubmittedArr)):
            include './phpConnection.php';
            $addMoodQuery = "INSERT INTO members_feedback_comments (member_feedback_id,user_id,is_liked) VALUES('$feedBackId','$UserId','1')";
            $setMoodQuery = mysqli_query($conn, $addMoodQuery);
            include './phpConnection.php';
            $checkisliked = "SELECT * FROM members_feedback_comments WHERE member_feedback_id='$feedBackId' AND user_id='$UserId'";
            $getislikedSubmitted = mysqli_query($conn, $checkisliked);
            $getgetLiked = mysqli_fetch_assoc($getislikedSubmitted);

            $data['is_liked'] = ($getgetLiked['is_liked']) ? $getgetLiked['is_liked'] : '0';
        else:

            include './phpConnection.php';
            $checkisliked = "SELECT * FROM members_feedback_comments WHERE member_feedback_id='$feedBackId' AND user_id='$UserId'";
            $getislikedSubmitted = mysqli_query($conn, $checkisliked);
            $getgetLiked = mysqli_fetch_assoc($getislikedSubmitted);

            $like = '';
            if ($getgetLiked['is_liked'] == 0):
                $like = 1;
            else:
                $like = 0;
            endif;

            include './phpConnection.php';
            $addMoodQuery = "UPDATE members_feedback_comments SET is_liked='$like' WHERE member_feedback_id='$feedBackId' AND user_id='$UserId'";
            $setMoodQuery = mysqli_query($conn, $addMoodQuery);

            include './phpConnection.php';
            $checkisliked = "SELECT * FROM members_feedback_comments WHERE member_feedback_id='$feedBackId' AND user_id='$UserId'";
            $getislikedSubmitted = mysqli_query($conn, $checkisliked);
            $getgetLiked = mysqli_fetch_assoc($getislikedSubmitted);



            $data['is_liked'] = ($getgetLiked['is_liked']) ? $getgetLiked['is_liked'] : '0';
        endif;
    endif;
    echo json_encode($data);
    die;
endif;
