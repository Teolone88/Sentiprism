<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

// CREATE ALL CONSTANT 

define('DATE_DEFAULT_FORMAT', 'd-m-Y');
define('DATE_DEFAULT_FORMAT_DMYHis', 'M-d-Y H:i:s');
define('DATE_FORMAT_YMD', 'Y-m-d H:i:s');
define('FEEDBACK_SUBMITION_DAYS', 3);  // EVERY MONTH IN 3 TIMES

define('IS_PRODUCT_DEVELOPMENT_MODE', FALSE);

if (IS_PRODUCT_DEVELOPMENT_MODE):

    define('HOST', 'localhost');
    define('USER_NAME', 'root');
    define('PASSWORD', '');
    define('DB_NAME', 'senti');

//    define('GOOGLE_CLIENT_KEY', '819282554963-vnl47ju0d1ntjkdute45ka1gdjfmc8k1.apps.googleusercontent.com');
//    define('GOOGLE_CLIENT_SECRET', 'KAaU8LYr3JKiFiS81GdM8umh');
    // GOOGLE INGNUP LOGIN DETAILS
    define('GOOGLE_CLIENT_KEY', '468339666322-nlhegguntljlud206da6fcke7klb4v04.apps.googleusercontent.com');
    define('GOOGLE_CLIENT_SECRET', 'mL7pVqmNpshOr3gkw6fB3BBm');
    define('GOOGLE_REDIRECT', 'http://localhost/sawan/sentipresim/code/googlelogin.php');
    define('GOOGLE_LOGED_IN_URL', 'http://localhost/sawan/sentipresim/home.php');

    // LINK IN INGNUP LOGIN DETAILS
    define('LINKED_IN_CLIENT_KEY', '81fkzm5dhtmydm');
    define('LINKED_IN_CLIENT_SECRET', 'HiidqVASgjWZzDTB');
    define('LINKED_IN_REDIRECT', 'http://localhost/sawan/sentipresim/code/linkedlogin.php');
    define('LINKED_IN_LOGED_IN_URL', 'http://localhost/sawan/sentipresim/home.php');

    // FACEBOOK INGNUP LOGIN DETAILS
    define('FACEBOOK_CLIENT_KEY', '159313068021979');
    define('FACEBOOK_CLIENT_SECRET', '2ee8e64c8a7117b36d29c05da62a60ec');
    define('FACEBOOK_REDIRECT', 'http://localhost/sawan/sentipresim/code/facebooklogin.php');
    define('FACEBOOK_LOGED_IN_URL', 'http://localhost/sawan/sentipresim/home.php');

    // TWETTER INGNUP LOGIN DETAILS
    define('TWETTER_CLIENT_KEY', 'HpbfV1gCfKOJFAsXUp41VWeT1');
    define('TWETTER_CLIENT_SECRET', 'hUS65ZItXaqhLmveegt6XbjaJmzQubpEhj2KP4IRsjU2PvlniU');
    define('TWETTER_REDIRECT', 'http://localhost/sawan/sentipresim/code/twitterlogin.php');
    define('TWETTER_LOGED_IN_URL', 'http://localhost/sawan/sentipresim/home.php');



else:

    define('HOST', 'localhost');
    define('USER_NAME', 'root');
    define('PASSWORD', '');
    define('DB_NAME', 'senti');


    // LINK IN INGNUP LOGIN DETAILS
    define('LINKED_IN_CLIENT_KEY', '81fkzm5dhtmydm');
    define('LINKED_IN_CLIENT_SECRET', 'HiidqVASgjWZzDTB');
    define('LINKED_IN_REDIRECT', 'http://sensussoft.com/sentiprism/code/linkedlogin.php');
    define('LINKED_IN_LOGED_IN_URL', 'http://sensussoft.com/sentiprism/home.php');
    

    // GOOGLE INGNUP LOGIN DETAILS
    define('GOOGLE_CLIENT_KEY', '468339666322-nlhegguntljlud206da6fcke7klb4v04.apps.googleusercontent.com');
    define('GOOGLE_CLIENT_SECRET', 'mL7pVqmNpshOr3gkw6fB3BBm');
    define('GOOGLE_REDIRECT', 'http://sensussoft.com/sentiprism/code/googlelogin.php');
    define('GOOGLE_LOGED_IN_URL', 'http://sensussoft.com/sentiprism/home.php');


    // FACEBOOK INGNUP LOGIN DETAILS
    define('FACEBOOK_CLIENT_KEY', '159313068021979');
    define('FACEBOOK_CLIENT_SECRET', '2ee8e64c8a7117b36d29c05da62a60ec');
    define('FACEBOOK_REDIRECT', 'http://sensussoft.com/sentiprism/code/facebooklogin.php');
    define('FACEBOOK_LOGED_IN_URL', 'http://sensussoft.com/sentiprism/home.php');


    // TWETTER INGNUP LOGIN DETAILS
    define('TWETTER_CLIENT_KEY', 'HpbfV1gCfKOJFAsXUp41VWeT1');
    define('TWETTER_CLIENT_SECRET', 'hUS65ZItXaqhLmveegt6XbjaJmzQubpEhj2KP4IRsjU2PvlniU');
    define('TWETTER_REDIRECT', 'http://sensussoft.com/sentiprism/code/twitterlogin.php');
    define('TWETTER_LOGED_IN_URL', 'http://sensussoft.com/sentiprism/home.php');

endif;





define('IS_DEBUG_MODE', FALSE);

if (IS_DEBUG_MODE):

// Report runtime errors
    error_reporting(E_ERROR | E_WARNING | E_PARSE);

// Report all errors
    error_reporting(E_ALL);

// Same as error_reporting(E_ALL);
    ini_set("error_reporting", E_ALL);

// Report all errors except E_NOTICE
    error_reporting(E_ALL & ~E_NOTICE);

else:
    error_reporting(0);    
endif;

