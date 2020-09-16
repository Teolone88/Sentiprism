<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../constant.php';

$servername = HOST;
$username = USER_NAME;
$password = PASSWORD;
$databaseName = DB_NAME;

// Create connection
$conn = mysqli_connect($servername, $username, $password, $databaseName);
// Check connection
if ($conn->connect_error) :
    die("Connection failed: " . $conn->connect_error);
endif;
//    echo "Connected successfully";
?>