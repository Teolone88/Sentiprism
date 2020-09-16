<?php
include '../constant.php';
include './phpConnection.php';
$response = array();
	$id =$_REQUEST['id'];
	$check = mysqli_query($conn,"SELECT * FROM users WHERE id = '$id'");
	$checkfetch = mysqli_fetch_array($check);

	$status = $checkfetch['is_active'] == '0' ? '1' : '0';
	$selcheck = mysqli_query($conn,"UPDATE users SET is_active = '$status' WHERE id = '$id'");
 	$key = $status == '0' ? 'activate' : 'deactivate';
 	if($selcheck)
 	{
 		$response['status']  = 'success';
		$response['message'] = 'User '.$key.' Successfully ...';
 	}
	else
	{
		$response['status']  = 'error';
		$response['message'] = 'Unable to '.$key.' User...';
	}
	
	echo json_encode($response);
	
?>