<?php
require_once(dirname(__FILE__).'/users/users.php');

// get user if logged in or require user to login
$user = User::get();
#$user = User::require_login();

$facebook_module = AuthenticationModule::get('facebook');

// We'll be fetching friends data into this array
$friends = array();

if (!is_null($user)) {
	// You can work with users, but it's recommended to tie your data to accounts, not users
	#$current_account = Account::getCurrentAccount($user);

	// We'll be looping through multiple pages of results
	$page = 0;
	$page_size = 5000; // seems to be API's default anyway

	do {
		$data = $facebook_module->api('/me/friends', 'GET', array(
			'limit' => $page_size,
			'offset' => $page * $page_size
		));

		foreach ($data['data'] as $friend) {
			$friends[] = $friend;
		}

		$page++;
	} while (array_key_exists('next', $data['paging']));
}
?><html>
<head>
	<title>Sample Facebook Application</title>

<style>
.fb-userpic {
	width: 50px;
	height: 50px;
}
</style>
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=262721247170448";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div style="float: right"><?php include(dirname(__FILE__).'/users/navbox.php'); ?></div>
<?php

if (!is_null($user)) {
?>
<h1>Friends of <?php echo $user->getName() ?>!</h1>
<div class="fb-like" data-href="https://github.com/StartupAPI/sample-facebook-application" data-send="true" data-show-faces="false"></div>
<div>
<?php
	foreach ($friends as $friend) {
		?>
		<a href="http://www.facebook.com/<?php echo $friend['id'] ?>" target="_blank"><img src="http://graph.facebook.com/<?php echo $friend['id'] ?>/picture" title="<?php echo $friend['name'] ?>" class="fb-userpic"/></a>
		<?php
	}
?>
</div>
<?php
}
else
{
?>
<h1>Sample Facebook Application</h1>
<?php
	?><p><?php $facebook_module->renderRegistrationForm(); ?></p><?php
}
?> 
</body>
</html>
