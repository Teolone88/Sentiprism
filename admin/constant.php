<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// CREATE ALL CONSTANT 

define('DATE_DEFAULT_FORMAT', 'd-m-Y');
define('DATE_DEFAULT_FORMAT_DMYHis', 'M-d-Y H:i:s');
define('DATE_FORMAT_YMD', 'Y-m-d H:i:s');

define('IS_PRODUCT_DEVELOPMENT_MODE', FALSE);

if (IS_PRODUCT_DEVELOPMENT_MODE):

    define('HOST', 'localhost');
    define('USER_NAME', 'root');
    define('PASSWORD', '');
    define('DB_NAME', 'senti');

    define('GOOGLE_CLIENT_KEY', '819282554963-vnl47ju0d1ntjkdute45ka1gdjfmc8k1.apps.googleusercontent.com');
    define('GOOGLE_CLIENT_SECRET', 'KAaU8LYr3JKiFiS81GdM8umh');


    define('EMAIL_USERNAME', 'savan.sensussoft@gmail.com');
    define('EMAIL_PASSWORD', 'orjrkocrqferxeip');
    define('EMAIL_HOST', 'smtp.gmail.com');
    define('EMAIL_PORT', '587');
    define('EMAIL_SMTP_SECURE', 'tls');

else:

    define('HOST', 'localhost');
    define('USER_NAME', 'root');
    define('PASSWORD', '');
    define('DB_NAME', 'senti');

    define('EMAIL_USERNAME', 'savan.sensussoft@gmail.com');
    define('EMAIL_PASSWORD', 'orjrkocrqferxeip');
    define('EMAIL_HOST', 'smtp.gmail.com');
    define('EMAIL_PORT', '587');
    define('EMAIL_SMTP_SECURE', 'tls');

endif;

define('THEME_COLOR', 'theme-light-blue');

define('IS_DEBUG_MODE', TRUE);

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

