<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$requestMethod = $_SERVER['REQUEST_METHOD'];
if ($requestMethod == 'POST'):
    $taxQuality = @$_POST['taxQuality'];
    $taxWork = @$_POST['taxWork'];
    $taxControl = @$_POST['taxControl'];
    $taxInnovation = @$_POST['taxInnovation'];
    $taxLegacy = @$_POST['taxLegacy'];
    $taxResponsiveness = @$_POST['taxResponsiveness'];
    $bds_comment = @$_POST['bds_comment'];
    $getCurrentUserId = @$_POST['getCurrentUserId'];
    $bdsSubmitDate = @date('Y-m-d');
    if (!empty($getCurrentUserId)):
        include './phpConnection.php';
        $checkTodayAlreadySubmitted = "SELECT * FROM business_drivers_selection WHERE date='$bdsSubmitDate' AND user_id='$getCurrentUserId'";
        $getCheckTodayAlreadySubmitted = mysqli_query($conn, $checkTodayAlreadySubmitted);
        $getCheckTodayAlreadySubmittedArr = mysqli_fetch_assoc($getCheckTodayAlreadySubmitted);
        if (empty($getCheckTodayAlreadySubmittedArr)):
            include './phpConnection.php';
            $addBdsQuery = "INSERT INTO business_drivers_selection (user_id,quantity,team_work,control,innovation,legacy,responsiveness,comment,date) VALUES('$getCurrentUserId','$taxQuality','$taxWork','$taxControl','$taxInnovation','$taxLegacy','$taxResponsiveness','$bds_comment','$bdsSubmitDate')";
            $setBdsQuery = mysqli_query($conn, $addBdsQuery);
        endif;
    endif;
endif;
