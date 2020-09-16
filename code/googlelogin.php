<?php

include './phpConnection.php';


########## Google Settings.. Client ID, Client Secret #############
$google_client_id = GOOGLE_CLIENT_KEY;
$google_client_secret = GOOGLE_CLIENT_SECRET;
$google_redirect_url = GOOGLE_REDIRECT;
$google_developer_key = '';


//include google api files
require_once 'Google/src/Google_Client.php';
require_once 'Google/src/contrib/Google_Oauth2Service.php';

//start session


$gClient = new Google_Client();
$gClient->setApplicationName('Login to Sentipresim Migration');
$gClient->setClientId($google_client_id);
$gClient->setClientSecret($google_client_secret);
$gClient->setRedirectUri($google_redirect_url);
$gClient->setDeveloperKey($google_developer_key);

$google_oauthV2 = new Google_Oauth2Service($gClient);

//If user wish to log out, we just unset Session variable
if (isset($_REQUEST['reset'])) {
    unset($_SESSION['token']);
    $gClient->revokeToken();
    header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL));
}

if (isset($_REQUEST['code'])) {
    $gClient->authenticate($_REQUEST['code']);
    $_SESSION['token'] = $gClient->getAccessToken();
    header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL));
    return;
}



if (isset($_SESSION['token'])) {
    $gClient->setAccessToken($_SESSION['token']);
}


if ($gClient->getAccessToken()) {
    //Get user details if user is logged in
    $user = $google_oauthV2->userinfo->get();

    $user_id = $user['id'];
    $user_name = filter_var($user['name'], FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
    $profile_url = filter_var($user['link'], FILTER_VALIDATE_URL);
    $profile_image_url = filter_var($user['picture'], FILTER_VALIDATE_URL);
    $personMarkup = "$email<div><img src='$profile_image_url?sz=50'></div>";
    $_SESSION['token'] = $gClient->getAccessToken();


    //  PHP CODE

    include './phpConnection.php';
    $checkUserIsExistQry = "SELECT * FROM users WHERE gplus_id='$identifierId'";
    $exCheckUserIsExistQry = mysqli_query($conn, $checkUserIsExistQry);
    $getUser = mysqli_fetch_assoc($exCheckUserIsExistQry);
    if (!empty($getUser)):
        $_SESSION['user'] = $getUser;
        $_SESSION['currentUserId'] = $getUser['id'];
        header("location: $redirect_to");
    else:

        $fullName = $user['name'];
        $gplus_id = $user['id'];
        $email = $user['email'];
        $loginType = 'GOOGLE';

        include './phpConnection.php';
        $findUserQry = "INSERT INTO users (user_fullname,email,gplus_id,social_type) VALUES ('$fullName','$email','$gplus_id','$loginType')";
        $exUserQry = mysqli_query($conn, $findUserQry);

        $checkUserIsExistQry = "SELECT * FROM users WHERE gplus_id='$linkInId'";
        $exCheckUserIsExistQry = mysqli_query($conn, $checkUserIsExistQry);
        $getUser = mysqli_fetch_assoc($exCheckUserIsExistQry);
        $_SESSION['user'] = $getUser;
        $_SESSION['currentUserId'] = $getUser['id'];
        header("location: $redirect_to");
    endif;
} else {
    //get google login url
    $authUrl = $gClient->createAuthUrl();
}



if (isset($authUrl)) { //user is not logged in, show login button
    header('Location: ' . $authUrl);
} else { // user logged in 
    /* connect to mysql */


    //compare user id in our database
    if (isset($_SESSION['redirect_to_back'])) {
        $redirect_to = urldecode($_SESSION['redirect_to_back']);
        unset($_SESSION['redirect_to_back']);
    } else {
        $redirect_to = GOOGLE_LOGED_IN_URL;
    }

//print_r($redirect_to);
// header("location: $redirect_to");	
}
?>
