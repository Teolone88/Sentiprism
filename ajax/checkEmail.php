<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include './phpConnection.php';

$status = '';
$message = '';
$data = [];

$email = $_POST['email'];
if (!empty($email)):
    $findEmailQry = "CALL checkEmail('$email')";
    $exFindEmailQry = mysqli_query($conn, $findEmailQry);
    if ($exFindEmailQry->num_rows > 0):
        $status = 0;
        $message = 'This Email is already exist.';
        $data = [];
    else:
        $status = 1;
        $message = 'Available.';
        $data = [];
    endif;
else:
    $status = 2;
    $message = 'Email is Not field.';
    $data = [];
endif;

$responseData['starus'] = $status;
$responseData['message'] = $message;
$responseData['data'] = $data;

echo json_encode($responseData);
die;
