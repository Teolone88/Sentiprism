<?php

include './phpConnection.php';
########## Linked in Settings.. Client ID, Client Secret #############
$baseURL = 'http://localhost/sentipresim/home.php';
$callbackURL = LINKED_IN_REDIRECT;
$linkedinApiKey = LINKED_IN_CLIENT_KEY;
$linkedinApiSecret = LINKED_IN_CLIENT_SECRET;
$linkedinScope = 'r_basicprofile r_emailaddress';
###################################################################
include_once("LinkedIn/http.php");
include_once("LinkedIn/oauth_client.php");


$client = new oauth_client_class;

$client->debug = false;
$client->debug_http = true;
$client->redirect_uri = $callbackURL;

$client->client_id = $linkedinApiKey;
$application_line = __LINE__;
$client->client_secret = $linkedinApiSecret;
$_SESSION['requestToken'] = serialize($client->client_secret);

/* API permissions
 */
$client->scope = $linkedinScope;
if (($success = $client->Initialize())) {
    if (($success = $client->Process())) {
        if (strlen($client->authorization_error)) {
            $client->error = $client->authorization_error;
            $success = false;
        } elseif (strlen($client->access_token)) {
            $success = $client->CallAPI(
                    'http://api.linkedin.com/v1/people/~:(id,email-address,first-name,last-name,location,picture-url,public-profile-url,formatted-name)', 'GET', array(
                'format' => 'json'
                    ), array('FailOnAccessError' => true), $user);
        }
    }
    $success = $client->Finalize($success);
}
if ($client->exit)
    exit;
if ($success) {
    $name = $user->firstName . ' ' . $user->lastName;
    $email = $user->emailAddress;

    $loginType = 'LINKEDIN';
    $identifierId = $user->id;

    include './phpConnection.php';
    $checkUserIsExistQry = "SELECT * FROM users WHERE linked_in_id='$identifierId'";
    $exCheckUserIsExistQry = mysqli_query($conn, $checkUserIsExistQry);
    $getUser = mysqli_fetch_assoc($exCheckUserIsExistQry);
    if (!empty($getUser)):
        $_SESSION['user'] = $getUser;
        $_SESSION['currentUserId'] = $getUser['id'];
        header("location: $redirect_to");
    else:
        $fullName = $user->formattedName;
        $linkInId = $user->id;
        $email = $user->emailAddress;
        include './phpConnection.php';
        $findUserQry = "INSERT INTO users (user_fullname,email,linked_in_id,social_type) VALUES ('$fullName','$email','$linkInId','$loginType')";
        $exUserQry = mysqli_query($conn, $findUserQry);

        $checkUserIsExistQry = "SELECT * FROM users WHERE linked_in_id='$linkInId'";
        $exCheckUserIsExistQry = mysqli_query($conn, $checkUserIsExistQry);
        $getUser = mysqli_fetch_assoc($exCheckUserIsExistQry);
        $_SESSION['user'] = $getUser;
        $_SESSION['currentUserId'] = $getUser['id'];
        header("location: $redirect_to");
    endif;

    //$user->pictureUrl;
    //$user->id;   

    if (isset($_SESSION['redirect_to_back'])) {
        $redirect_to = urldecode($_SESSION['redirect_to_back']);
        unset($_SESSION['redirect_to_back']);
    } else {
        $redirect_to = LINKED_IN_LOGED_IN_URL;
    }

    header("location: $redirect_to");
} else {
    $json['msg'] = 'error';
}
?>
