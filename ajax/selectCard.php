<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$requestMethod = $_SERVER['REQUEST_METHOD'];
if ($requestMethod == 'POST'):
    $squardId = @$_POST['squardId'];
    $userId = @$_POST['userId'];
    if (!empty($squardId) && !empty($userId)):
        include './phpConnection.php';
        $setSquard = mysqli_query($conn, "CALL setSelectedCard('$squardId','$userId')");
        exit();
    endif;
endif;

$requestMethod = $_SERVER['REQUEST_METHOD'];
if ($requestMethod == 'POST'):
    if (@$_POST['colorConst'] == 'SAVECOLOR'):
        $currentUserSquardId = @$_POST['currentUserSquardId'];
        $selectedColor = @$_POST['selectedColor'];
        if (!empty($currentUserSquardId) && !empty($selectedColor)):
            include './phpConnection.php';
            $setSquard = mysqli_query($conn, "CALL setSquadMemberColor('$currentUserSquardId','$selectedColor')");
            exit();
        endif;
    endif;
endif;


