<?php

require './core_functions.php';
session_start();
checkSession();

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$checkMethod = $_SERVER['REQUEST_METHOD'];
if ($checkMethod == 'POST'):
    $userImage = $_FILES['user_image'];
    $user_name = $_REQUEST['user_name'];
    $user_phone = $_REQUEST['user_phone'];
    $user_desig = $_REQUEST['user_desig'];
    $user_birth = $_REQUEST['user_birth'];
    $user_email = $_REQUEST['user_email'];
    $user_pass = $_REQUEST['user_pass'];
    $login_type = 'MANAGER';
    $user_type = 'MANAGER';
    $user_business_name = $_REQUEST['user_business_name'];

    if ($_REQUEST['isAvailable'] == 'NO'):
        if (!empty($user_email) && !empty($user_phone)):
            include './phpConnection.php';
            $userPassword = password_hash($user_pass, PASSWORD_DEFAULT);
            $userQry = "INSERT INTO users (user_fullname,email,phone,person_designation,birth_date,password,temp_pass,login_type,user_type) VALUES('$user_name','$user_email','$user_phone','$user_desig','$user_birth','$userPassword','$user_pass','$login_type','$user_type')";
            $exUserQry = mysqli_query($conn, $userQry);
            if ($exUserQry):
                $lastInsertId = $conn->insert_id;
                if (!empty($lastInsertId)):
                    $getNewImageName = uniqFileNameGenerator($userImage);
                    $getImageStoringPath = uploadUserDirectoryPath();
                    if (!file_exists($getImageStoringPath)):
                        mkdir($getImageStoringPath, 0777, TRUE);
                    endif;
                    $fileUploadDestination = $getImageStoringPath . $getNewImageName;
                    $uploadFile = move_uploaded_file($userImage['tmp_name'], $fileUploadDestination);
                    if (!empty($uploadFile)):
                        include './phpConnection.php';
                        $managerImageQry = "UPDATE users SET profile_image='$getNewImageName' WHERE id='$lastInsertId'";
                        mysqli_query($conn, $managerImageQry);
                        messageSuccess('User Successfully added.');
                        header('Location:addUserCode.php');
                    else:
                        messageError('Image uploading problem.');
                        header('Location:addUserCode.php');
                    endif;
                else:
                    messageError('manager Register problem');
                    header('Location:addUserCode.php');
                endif;
            else:
                messageError('manager Register problem');
                header('Location:addUserCode.php');
            endif;
        else:
            messageError('Please enter email and phone.');
            header('Location:addUserCode.php');
        endif;
    else:
        messageError('This is user is already exist.');
        header('Location:addUserCode.php');
    endif;
endif;
