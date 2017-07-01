<?php
require_once(dirname(__FILE__) . '/users/users.php');

$user = StartupAPI::requireLogin();

$facebook_module = AuthenticationModule::get('facebook');

// start with global template data needed for Startup API menus and stuff
$template_info = StartupAPI::getTemplateInfo();

$template_info['name'] = $user->getName();

$response = $facebook_module->api("/me?fields=cover,picture");
if ($response) {
	$me = $response->getDecodedBody();

	if ($me['cover']['source']) {
		$template_info['cover'] = $me['cover']['source'];
	}

	if ($me['picture']['data']['url']) {
		$template_info['picture'] = $me['picture']['data']['url'];
	}
}

StartupAPI::$template->getLoader()->addPath(__DIR__ . '/templates', 'app');
StartupAPI::$template->display('@app/index.html.twig', $template_info);
