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
    $testiOldImageName = $_FILES['testi_image_name'];
    $testiId = $_REQUEST['testi_id'];
    $isActive = '';
    if ($_REQUEST['is_active'] == 'YES'):
        $isActive = 1;
    else:
        $isActive = 0;
    endif;

    if (!empty($testiName) && !empty($testiDescription) && !empty($testiId)):
        include './phpConnection.php';
        $testimonialsQry = "CALL editTestimonials('$testiId','$testiName','$testiDescription','$isActive')";
        $exTestimonialsQry = mysqli_query($conn, $testimonialsQry);
        if ($exTestimonialsQry):
            if (!empty($testiImage)):
                $getNewImageName = uniqFileNameGenerator($testiImage);
                $getImageStoringPath = uploadTestimonialsDirectoryPath();
                if (!empty($testiOldImageName)):
                    unlink($getImageStoringPath . $testiOldImageName);
                endif;
                if (!file_exists($getImageStoringPath)):
                    mkdir($getImageStoringPath, 0777, TRUE);
                endif;
                $fileUploadDestination = $getImageStoringPath . $getNewImageName;
                $uploadFile = move_uploaded_file($testiImage['tmp_name'], $fileUploadDestination);
                if (!empty($uploadFile)):
                    include './phpConnection.php';
                    $testimonialsImageQry = "CALL updateTestimonialsImage('$testiId','$getNewImageName')";
                    mysqli_query($conn, $testimonialsImageQry);
                    messageSuccess('Testimonials Successfully added.');
                    header('Location:allTestimonials.php');
                endif;
                header('Location:allTestimonials.php');
            else:
                messageSuccess('Testimonials updated successfully.');
                header('Location:allTestimonials.php');
            endif;
        else:
            messageError('Data adding problem.');
            header('Location:allTestimonials.php');
        endif;
    else:
        messageError('Please enter required field.');
        header('Location:allTestimonials.php');
    endif;
else:
    messageError('Invalid Call.');
    header('Location:allTestimonials.php');
endif;
