<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$requestMethod = $_SERVER['REQUEST_METHOD'];
if ($requestMethod == 'POST'):

    include './phpConnection.php';
    $getSelectedSquardsMemberId = $_POST['getSelectedSquardsMemberId'];
    $feedbackTitle = $_POST['feedbackTitle'];
    $contribution_behaviour = $_POST['contribution_behaviour'];
    $contribution_behaviour_star_val = $_POST['contribution_behaviour_star_val'];
    $contribution_achievement = $_POST['contribution_achievement'];
    $contribution_achievement_star_val = $_POST['contribution_achievement_star_val'];
    $level_of_initiative_and_effort = $_POST['level_of_initiative_and_effort'];
    $level_of_initiative_and_effort_star_val = $_POST['level_of_initiative_and_effort_star_val'];
    $duration_of_contribution = $_POST['duration_of_contribution'];
    $duration_of_contribution_star_val = $_POST['duration_of_contribution_star_val'];
    $feedBackComment = $_POST['feedBackComment'];
    $currentUserId = $_POST['currentUserId'];

    $feedBackCurrentDate = date('Y-m-d');
    $feedBackEndDate = date('Y-m-d', strtotime("+" . FEEDBACK_SUBMITION_DAYS . " days"));

    $overAllRating = ($contribution_behaviour_star_val + $contribution_achievement_star_val + $level_of_initiative_and_effort_star_val + $duration_of_contribution_star_val) / 4;
    if (!empty($getSelectedSquardsMemberId)):
        include './phpConnection.php';
        $setMemberQry = "INSERT INTO members_feedback (squard_member_id,squard_id,last_feedback_date,feedback_title,contribution_or_behaviour,contribution_or_behaviour_rating,contribution_on_achievement,contribution_on_achievement_rating,level_of_initiative,level_of_initiative_rating,duration_of_cintribution,duration_of_cintribution_rating,feedback_comments,overall_rating,user_id) VALUES ('$getSelectedSquardsMemberId','1','$feedBackEndDate','$feedbackTitle','$contribution_behaviour','$contribution_behaviour_star_val','$contribution_achievement','$contribution_achievement_star_val','$level_of_initiative_and_effort','$level_of_initiative_and_effort_star_val','$duration_of_contribution','$duration_of_contribution_star_val','$feedBackComment','$overAllRating','$currentUserId');";
        $setMemberFeedBackData = mysqli_query($conn, $setMemberQry);      
    endif;
endif;