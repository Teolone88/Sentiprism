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
    if (!empty($_SESSION['user'])):
        if ($_SESSION['user']['user_type'] != 'ADMIN'):
            messageError('You are not authorized to access this.');
            header('Location:../index.php');
            session_start();
            session_destroy();
        endif;
    endif;
}

function baseURL() {
    $actualLink = 'http://' . $_SERVER['HTTP_HOST'];
    return $actualLink;
}

function directoryName() {
    return dirname($_SERVER['REQUEST_URI']) . "/";
}

function blogImageURL($imageName) {
    $imagePath = 'images/blogs/';
    $imageBastPath = baseURL() . directoryName();
    $imageUrl = $imageBastPath . $imagePath . $imageName;
    return $imageUrl;
}

function testimonialsProfileImageURL($imageName) {
    $imagePath = 'uploads/testimonials/';
    $imageBastPath = baseURL() . dirname($_SERVER['PHP_SELF']) . '../../';
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

function uploadUserDirectoryPath() {
    $destinationPath = dirname(__DIR__) . '/uploads/users/';
    return $destinationPath;
}

function removeUserProfileImage($fileName) {
    $destinationPath = dirname(__DIR__) . '/uploads/testimonials/' . $fileName;
    return unlink($destinationPath);
}

function removeUserImage($fileName) {
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

function sessionDestroy() {
    session_destroy();
}
