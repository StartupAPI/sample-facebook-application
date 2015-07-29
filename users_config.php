<?php
/* including local app config */
require_once(dirname(__FILE__).'/config.php');

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
#UserConfig::$mysql_port = 3306;
#UserConfig::$mysql_socket = '/tmp/mysql.sock';

/**
 * User IDs of admins for this instance (to be able to access dashboard at /users/admin/)
 */
UserConfig::$admins[] = 1; // usually first user has ID of 1

/*
 * Name of your application to be used in UI and emails to users
 */
UserConfig::$appName = 'Sample Facebook Application';

/*
 * Uncomment next line to enable debug messages in error_log
 */
#UserConfig::$DEBUG = true;

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
	array(), # set to array of extended permissions if needed, e.g. array('email')
	null,
	array(
		'facepile' => true
	)
);

/**
 * Meetup Authentication configuration
 * Register your app here: http://www.meetup.com/meetup_api/oauth_consumers/
 * Click red "Register OAuth Consumer" button on the right and enter your site's name and URL
 * And then uncomment two lines below and copy API Key and App Secret
 */
#UserConfig::loadModule('meetup');
#new MeetupAuthenticationModule('aoaiv1n5ldhsd6o07v55e6fjb5', 'cs230v72h5j93v684kfkepikq0');


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

/**
 * Twitter Authentication configuration
 * Register your app here: https://dev.twitter.com/apps/new
 * And then uncomment two lines below and copy API Key and App Secret
 */
#UserConfig::loadModule('twitter');
#new TwitterAuthenticationModule('...api.key.goes.here...', '...api.secret.goes.here...');

/**
 * Status.Net Authentication configuration
 * Register your app with your Status.Net installation
 * And then uncomment two lines below and copy API Key, App Secret
 * as well as provider name and root URL for the site and API
 */
#UserConfig::loadModule('statusnet');
#new StatusNetAuthenticationModule('...api.key.goes.here...', '...api.secret.goes.here...', '...provider.name...', '...base.app.url...', '...base.api.url...');

# Identi.ca's simplified setup (get your keys here: http://identi.ca/settings/oauthapps)
#UserConfig::loadModule('statusnet');
#new StatusNetAuthenticationModule('...identi.ca.api.key.goes.here...', '...identi.ca.api.secret.goes.here...');

/**
 * Google OAuth Authentication configuration
 * Register your app here: https://www.google.com/accounts/ManageDomains
 * Add URL for your site, verify it using one of the methods provided
 * And then uncomment lines below and copy API Key and App Secret
 * Optional 3rd parameter is an array of API scopes you need authorization for.
 * 	See up-to-date list of scopes here: http://code.google.com/apis/gdata/faq.html#AuthScopes
 *	(Google Contacts API scope is required and is included by default)
 */
#UserConfig::loadModule('google_oauth');
#new GoogleOAuthAuthenticationModule(
#	'...OAuth.key.goes.here...',
#	'...OAuth.secret.goes.here...',
#	array(
#		'https://www.google.com/analytics/feeds/',		// Google Analytics Data API
#		'http://www.google.com/base/feeds/',			// Google Base Data API
#		'https://sites.google.com/feeds/',			// Google Sites Data API
#		'http://www.blogger.com/feeds/',			// Blogger Data API
#		'http://www.google.com/books/feeds/',			// Book Search Data API
#		'https://www.google.com/calendar/feeds/',		// Calendar Data API
#		'https://docs.google.com/feeds/',			// Documents List Data API
#		'http://finance.google.com/finance/feeds/',		// Finance Data API
#		'https://mail.google.com/mail/feed/atom/',		// Gmail Atom feed
#		'http://maps.google.com/maps/feeds/',			// Maps Data API
#		'http://picasaweb.google.com/data/',			// Picasa Web Albums Data API
#		'http://www.google.com/sidewiki/feeds/',		// Sidewiki Data API
#		'https://spreadsheets.google.com/feeds/',		// Spreadsheets Data API
#		'http://www.google.com/webmasters/tools/feeds/',	// Webmaster Tools API
#		'http://gdata.youtube.com'				// YouTube Data API
#	)
#);

/**
 * LinkedIn Authentication configuration
 * Register your app here: https://www.linkedin.com/secure/developer
 * And then uncomment two lines below and copy API Key and Secret Key
 */
#UserConfig::loadModule('linkedin');
#new LinkedInAuthenticationModule('...OAuth.key.goes.here...', '...OAuth.secret.goes.here...');
