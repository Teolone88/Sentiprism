<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once './phpConnection.php';
require_once './FlashMessages.php';

function messageError($message) {
    require_once './FlashMessages.php';
    $msg = new \Plasticbrain\FlashMessages\FlashMessages();
    $msg->error($message);
}

function messageSuccess($message) {
    require_once './FlashMessages.php';
    $msg = new \Plasticbrain\FlashMessages\FlashMessages();
    $msg->success($message);
}

function checkSession() {
    if (empty($_SESSION['user']) && empty($_SESSION['currentUserId'])):
        messageSuccess('Your session is expired.');
        header('Location:index.php');
    endif;
}

function sessionDestroy() {
    session_destroy();
}

function baseURL() {
    $actualLink = 'http://' . $_SERVER['HTTP_HOST'];
    return $actualLink;
}

function directoryName() {
    return dirname($_SERVER['REQUEST_URI']) . "/";
}

function testimonialsProfileImageURL($imageName) {
    $imagePath = '/uploads/testimonials/';
    $imageBastPath = baseURL() . dirname($_SERVER['PHP_SELF']);
    $imageUrl = $imageBastPath . $imagePath . $imageName;
    return $imageUrl;
}

function userProfileImageURL($imageName) {
    $imagePath = '/uploads/users/';
    $imageBastPath = baseURL() . dirname($_SERVER['PHP_SELF']);
    $imageUrl = $imageBastPath . $imagePath . $imageName;
    return $imageUrl;
}

function directoryPath() {
    return dirname(__DIR__);
}

function uploadTestimonialsDirectoryPath() {
    $destinationPath = dirname(__DIR__) . '/uploads/testimonials/';
    return $destinationPath;
}

function uploadUsersDirectoryPath() {
    $destinationPath = dirname(__DIR__) . '/uploads/users/';
    return $destinationPath;
}

function removeUserProfileImage($fileName) {
    $destinationPath = dirname(__DIR__) . '/uploads/users/' . $fileName;
    return unlink($destinationPath);
}

function uniqFileNameGenerator($fileName) {
    if (!empty($fileName)):
        $fileType = $fileName['type'];
        $fileTypeToArray = explode('/', $fileType);
        $fileExtention = $fileTypeToArray[1];
        if (!empty($fileExtention)):
            $newFileName = uniqid() . md5(@date('YmdHis')) . uniqid() . '.' . $fileExtention;
            if (!empty($newFileName)):
                return $newFileName;
            else:
                return FALSE;
            endif;
        else:
            return FALSE;
        endif;
    else:
        return FALSE;
    endif;
}

//function getStartAndEndDate() {
//    // HERE WE GET WEEK NO AND YEAR
//    $weekNo = @date("W", strtotime(date('Y-m-d')));
//    $year = @date('Y');
//
//    $dateTime = new DateTime();
//    $dateTime->setISODate($year, $weekNo);
//    $result['start_date'] = $dateTime->format('Y-m-d');
//    $dateTime->modify('+6 days');
//    $result['end_date'] = $dateTime->format('Y-m-d');
//    return $result;
//}

function getStartAndEndDate() {

    date_default_timezone_set(DATE_TIME_ZON);
    $weekNo = @date("W", strtotime(date('Y-m-d')));
    $year = @date('Y');

    $date = @date('Y-m-d H:i:s');
    $dateTime = date_create($date);

    $dateTime->setISODate($year, $weekNo);
    $result['start_date'] = $dateTime->format('Y-m-d');
    $dateTime->modify('+6 days');
    $result['end_date'] = $dateTime->format('Y-m-d');
    return $result;
}
