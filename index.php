<?php
require_once(dirname(__FILE__) . '/users/users.php');

$user = StartupAPI::requireLogin();

$facebook_module = AuthenticationModule::get('facebook');

// start with global template data needed for Startup API menus and stuff
$template_info = StartupAPI::getTemplateInfo();

$template_info['name'] = $user->getName();

// We'll be fetching friends data into this array
$friends = array();

$page = 0;
$page_size = 5000; // seems to be API's default anyway

do {
	$data = $facebook_module->api('/me/friends?fields=id,name,picture', 'GET', array(
		'limit' => $page_size,
		'offset' => $page * $page_size
			));

	foreach ($data['data'] as $friend) {
		if (is_array($friend['picture'])) {
			$friend['picture'] = $friend['picture']['data']['url'];
		}

		$friends[] = $friend;
	}

	$page++;
} while (array_key_exists('paging', $data) && array_key_exists('next', $data['paging']));

$template_info['friends'] = $friends;

StartupAPI::$template->getLoader()->addPath(__DIR__ . '/templates', 'app');
StartupAPI::$template->display('@app/index.html.twig', $template_info);
