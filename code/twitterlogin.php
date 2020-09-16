<?php

require "Twitter/autoload.php";
include './phpConnection.php';

use Abraham\TwitterOAuth\TwitterOAuth;

define("Consumer_Key", TWETTER_CLIENT_KEY);
define("Consumer_Secret", TWETTER_CLIENT_SECRET);


if (empty($_GET['oauth_token'])) {
    $connection = new TwitterOAuth(Consumer_Key, Consumer_Secret);
    $request_token = $connection->oauth("oauth/request_token", array("oauth_callback" => TWETTER_REDIRECT));

    $_SESSION['oauth_token'] = $request_token['oauth_token'];
    $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

    $url = $connection->url("oauth/authorize", array("oauth_token" => $request_token['oauth_token']));
    header('Location: ' . $url);
}



if ($_GET['oauth_token'] || $_GET['oauth_verifier']) {
    $connection = new TwitterOAuth(Consumer_Key, Consumer_Secret, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
    $access_token = $connection->oauth('oauth/access_token', array('oauth_verifier' => $_REQUEST['oauth_verifier'], 'oauth_token' => $_GET['oauth_token']));

    $connection = new TwitterOAuth(Consumer_Key, Consumer_Secret, $access_token['oauth_token'], $access_token['oauth_token_secret']);

    $user_info = $connection->get('account/verify_credentials');

    $oauth_token = $access_token['oauth_token'];
    $oauth_token_secret = $access_token['oauth_token_secret'];


    $user_id = $user_info->id;
    $user_name = $user_info->name;
    $user_pic = $user_info->profile_image_url_https;
    $text = $user_info->status->text;
    $username = $user_info->screen_name;

    include './phpConnection.php';
    $checkUserIsExistQry = "SELECT * FROM users WHERE tw_id='$user_id'";
    $exCheckUserIsExistQry = mysqli_query($conn, $checkUserIsExistQry);
    $getUser = mysqli_fetch_assoc($exCheckUserIsExistQry);
    if (!empty($getUser)):
        $_SESSION['user'] = $getUser;
        $_SESSION['currentUserId'] = $getUser['id'];
        header("location: ".TWETTER_LOGED_IN_URL);
    else:

        $fullName = $user_name;
        $tw_id = $user_id;
        $loginType = 'TWETTER';

        include './phpConnection.php';
        $findUserQry = "INSERT INTO users (user_fullname,tw_id,social_type) VALUES ('$fullName','$tw_id','$loginType')";
        $exUserQry = mysqli_query($conn, $findUserQry);

        $checkUserIsExistQry = "SELECT * FROM users WHERE tw_id='$tw_id'";
        $exCheckUserIsExistQry = mysqli_query($conn, $checkUserIsExistQry);
        $getUser = mysqli_fetch_assoc($exCheckUserIsExistQry);
        $_SESSION['user'] = $getUser;
        $_SESSION['currentUserId'] = $getUser['id'];
        header("location:".TWETTER_LOGED_IN_URL);
    endif;
}
?>