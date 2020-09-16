<?php

include './phpConnection.php';
// added in v4.0.0
require_once './Facebook/autoload.php';

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;

// init app with app id and secret
FacebookSession::setDefaultApplication(FACEBOOK_CLIENT_KEY, FACEBOOK_CLIENT_SECRET);
// login helper with redirect_uri
$helper = new FacebookRedirectLoginHelper(FACEBOOK_REDIRECT);
try {
    $session = $helper->getSessionFromRedirect();
} catch (FacebookRequestException $ex) {
    $session = null;
} catch (\Exception $ex) {
    $session = null;
}
// see if we have a session
if (isset($session)) {
    // graph api request for user data
    $request = new FacebookRequest($session, 'GET', '/me');
    $response = $request->execute();
    // get response
    $graphObject = $response->getGraphObject();
    $fbid = $graphObject->getProperty('id');              // To Get Facebook ID
    $fbfullname = $graphObject->getProperty('name'); // To Get Facebook full name
    $femail = $graphObject->getProperty('email');    // To Get Facebook email ID
    //  PHP CODE

    include './phpConnection.php';
    $checkUserIsExistQry = "SELECT * FROM users WHERE fb_id='$fbid'";
    $exCheckUserIsExistQry = mysqli_query($conn, $checkUserIsExistQry);
    $getUser = mysqli_fetch_assoc($exCheckUserIsExistQry);
    if (!empty($getUser)):
        $_SESSION['user'] = $getUser;
        $_SESSION['currentUserId'] = $getUser['id'];
        header("location: $redirect_to");
    else:

        $fullName = $fbfullname;
        $gplus_id = $fbid;
        $email = $femail;
        $loginType = 'FACEBOOK';

        include './phpConnection.php';
        $findUserQry = "INSERT INTO users (user_fullname,email,fb_id,social_type) VALUES ('$fullName','$email','$fbid','$loginType')";
        $exUserQry = mysqli_query($conn, $findUserQry);

        $checkUserIsExistQry = "SELECT * FROM users WHERE fb_id='$fbid'";
        $exCheckUserIsExistQry = mysqli_query($conn, $checkUserIsExistQry);
        $getUser = mysqli_fetch_assoc($exCheckUserIsExistQry);
        $_SESSION['user'] = $getUser;
        $_SESSION['currentUserId'] = $getUser['id'];
        header("location: $redirect_to");
    endif;



    /* ---- Session Variables ----- */

    $_SESSION['FBID'] = $fbid;
    $_SESSION['FULLNAME'] = $fbfullname;
    $_SESSION['EMAIL'] = $femail;
    /* ---- header location after session ---- */
    header("Location:" . FACEBOOK_LOGED_IN_URL);
} else {
    $loginUrl = $helper->getLoginUrl();
    header("Location: " . $loginUrl);
}
?>