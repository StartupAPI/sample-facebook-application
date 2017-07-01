<?php
######################################################
##
##  Configuration file for sample Facebook app
##  Copy it to config.php and set values below
##
##  run make when you're done to init the data
##
######################################################

/**
 * Source of randomness for security
 */
$randomness = '...type.some.random.characters.here...';

/**
 * MySQL configuration variables
 */
$your_mysql_db = 'my_fb_app';
$your_mysql_user = 'my_fb_app';
$your_mysql_password = '...password...';

/**
 * Register your app here: https://developers.facebook.com/apps/
 * Click "Edit settings" -> "Web Site" and enter your site's URL
 * And then copy API Key and App Secret
 */
$fb_key = '...api.key.goes.here...';
$fb_secret = '...api.secret.goes.here...';

/**
 * Array of admin IDs
 */
$admins = []; // Usually first user has an ID of 1

/**
 * SMTP host
 */
$amazonSMTPHost = 'email-smtp.us-east-1.amazonaws.com';

/**
 * SMTP UserName
 */
$amazonSMTPUserName = '';

/**
 * SMTP Password
 */
$amazonSMTPPassword = '';
