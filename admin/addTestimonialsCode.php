<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require './core_functions.php';
checkSession();


$checkMethod = $_SERVER['REQUEST_METHOD'];
if ($checkMethod == 'POST'):

   

    $testiName = $_REQUEST['testi_name'];
    $testiDescription = $_REQUEST['testi_description'];
    $testiImage = $_FILES['testi_image'];
    if (!empty($testiName) && !empty($testiDescription)):
        include './phpConnection.php';
        $testimonialsQry = "CALL addNewTestimonial('$testiName','','$testiDescription')";
        $exTestimonialsQry = mysqli_query($conn, $testimonialsQry);
        if ($exTestimonialsQry):
            $getLastInsertId = mysqli_fetch_assoc($exTestimonialsQry);
            $lastInsertId = $getLastInsertId['InsertId'];
            if (!empty($lastInsertId)):
                $getNewImageName = uniqFileNameGenerator($testiImage);
                $getImageStoringPath = uploadTestimonialsDirectoryPath();
                if (!file_exists($getImageStoringPath)):
                    mkdir($getImageStoringPath, 0777, TRUE);
                endif;
                $fileUploadDestination = $getImageStoringPath . $getNewImageName;
                $uploadFile = move_uploaded_file($testiImage['tmp_name'], $fileUploadDestination);
                if (!empty($uploadFile)):
                    include './phpConnection.php';
                    $testimonialsImageQry = "CALL updateTestimonialsImage('$lastInsertId','$getNewImageName')";
                    mysqli_query($conn, $testimonialsImageQry);
                    messageSuccess('Testimonials Successfully added.');
                    header('Location:testimonials.php');
                else:
                    messageError('Image uploading problem.');
                    header('Location:testimonials.php');
                endif;
            else:
                messageError('Data adding problem.');
                header('Location:testimonials.php');
            endif;
        else:
            messageError('Data adding problem.');
            header('Location:testimonials.php');
        endif;
    else:
        messageError('Please enter required field.');
        header('Location:testimonials.php');
    endif;
else:
    messageError('Invalid Call.');
    header('Location:testimonials.php'); 
endif;
