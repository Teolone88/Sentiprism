<?php session_start(); ?>
<?php

require './core_functions.php';
checkSession();


$requestMethod = $_SERVER['REQUEST_METHOD'];
if ($requestMethod == 'POST'):
    $user_name = $_REQUEST['user_name'];
    $user_phone = $_REQUEST['user_phone'];
    $user_desig = $_REQUEST['user_desig'];
    $user_birth = $_REQUEST['user_birth'];
    $userId = $_REQUEST['userId'];
    $user_business_name = $_REQUEST['user_business_name'];
    if (!empty($_REQUEST)):
        include './phpConnection.php';
        $findUserQry = "UPDATE users SET user_fullname='$user_name',phone='$user_phone',person_designation='$user_desig',birth_date='$user_birth',business_name='$user_business_name' WHERE id=$userId";
        $exUserQrys = mysqli_query($conn, $findUserQry);
        if ($exUserQrys):
            messageSuccess('User updated successfully.');
            header('Location:allManager.php');
        else:
            messageError('User updating error..');
            header('Location:editManager.php?edit=' . $userId);
        endif;
    endif;
endif;
?>   