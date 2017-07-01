<?php
/* including local app config */
require_once(__DIR__.'/config.php');

/**
 * You must fill it in with some random string
 * this protects some of your user's data when sent over the network
 * and must be different from other sites
 */
UserConfig::$SESSION_SECRET = $randomness;

/**
 * Database connectivity
 */
UserConfig::$mysql_db = $your_mysql_db;
UserConfig::$mysql_user = $your_mysql_user;
UserConfig::$mysql_password = $your_mysql_password;
UserConfig::$mysql_host = isset($your_mysql_host) ? $your_mysql_host : 'localhost';
UserConfig::$mysql_port = isset($your_mysql_port) ? $your_mysql_port : 3306;
UserConfig::$mysql_socket = isset($your_mysql_socket) ? $your_mysql_socket : null;

/**
 * User IDs of admins for this instance (to be able to access dashboard at /users/admin/)
 */
UserConfig::$admins = $admins; // usually first user has ID of 1

/*
 * Name of your application to be used in UI and emails to users
 */
UserConfig::$appName = 'Sample Facebook Application';

/*
 * Uncomment next line to enable debug messages in error_log
 */
#UserConfig::$DEBUG = true;

/**
 * Email configuration
 */
UserConfig::$supportEmailFromName = 'Sample App Support';
UserConfig::$supportEmailFromEmail = 'support@startupapi.com';
UserConfig::$supportEmailReplyTo = 'support@startupapi.com';

if ($amazonSMTPHost && $amazonSMTPUserName && $amazonSMTPPassword) {
  UserConfig::$mailer = Swift_Mailer::newInstance(
    Swift_SmtpTransport::newInstance($amazonSMTPHost, 587, 'tls')
      ->setUsername($amazonSMTPUserName)
      ->setPassword($amazonSMTPPassword)
  );
}

/**
 * Facebook Connect configuration
 * Register your app here: http://www.facebook.com/developers/createapp.php
 * Click "Edit settings" -> "Web Site" and enter your site's URL
 * And then uncomment two lines below and copy API Key and App Secret
 */
UserConfig::loadModule('facebook');
new FacebookAuthenticationModule(
	$fb_key,
	$fb_secret,
	array('email'), # set to array of extended permissions if needed, e.g. array('email')
	null,
	array(
		'facepile' => true
	)
);

/**
 * Set these to point at your header and footer or leave them commented out to use default ones
 */
#UserConfig::$header = dirname(__FILE__).'/header.php';
#UserConfig::$footer = dirname(__FILE__).'/footer.php';

/**
 * Username and password registration configuration
 * just have these lines or comment them out if you don't want regular form registration
 */
#UserConfig::loadModule('usernamepass');
#new UsernamePasswordAuthenticationModule();
