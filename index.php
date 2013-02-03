<?php
require_once(dirname(__FILE__) . '/users/users.php');

// get user if logged in or require user to login
$user = User::get();
#$user = User::require_login();

$facebook_module = AuthenticationModule::get('facebook');

// We'll be fetching friends data into this array
$friends = array();

if (!is_null($facebook_module) && !is_null($user)) {
	// You can work with users, but it's recommended to tie your data to accounts, not users
	#$current_account = Account::getCurrentAccount($user);
	// We'll be looping through multiple pages of results
	$page = 0;
	$page_size = 5000; // seems to be API's default anyway

	do {
		$data = $facebook_module->api('/me/friends?fields=id,name,picture', 'GET', array(
			'limit' => $page_size,
			'offset' => $page * $page_size
				));

		foreach ($data['data'] as $friend) {
			$friends[] = $friend;
		}

		$page++;
	} while (array_key_exists('paging', $data) && array_key_exists('next', $data['paging']));
}
?><html>
	<head>
		<title>Sample Facebook Application</title>

		<?php StartupAPI::head(); ?>
		<style>
			.fb-userpic {
				width: 50px;
				height: 50px;
				background: #eceff6;
			}
		</style>
	</head>
	<body>
		<div style="float: right"><?php StartupAPI::power_strip(); ?></div>
		<?php
		if (!is_null($user)) {
			?>
			<h1>Friends of <?php echo $user->getName() ?>!</h1>
			<div style="width: 400px; max-width: 100%">
				<a href="https://github.com/StartupAPI/sample-facebook-application/" target="_blank" style="float: left"><img alt="Octocat.png" src="http://startupapi.org/w/images/thumb/6/61/Octocat.png/50px-Octocat.png" width="50" height="50" border="0" align="top" style="margin-right: 1em"></a>
				This is a sample Facebook application powered by <a href="http://www.startupapi.com">Startup API</a>, you can see the <a href="https://github.com/StartupAPI/sample-facebook-application/" target="_blank">code on Github</a>.
			</div>
			<div style="clear: both"></div>
			<div class="fb-like" data-href="https://github.com/StartupAPI/sample-facebook-application" data-send="true" data-show-faces="false"></div>
			<div>
				<?php
				foreach ($friends as $friend) {
					if (is_array($friend['picture'])) {
						$friend['picture'] = $friend['picture']['data']['url'];
					}
					?>
					<a href="http://www.facebook.com/<?php echo $friend['id'] ?>" target="_blank"><img src="<?php echo $friend['picture'] ?>" title="<?php echo $friend['name'] ?>" class="fb-userpic"/></a>
						<?php
					}
					?>
			</div>
			<?php
		} else {
			?>
			<h1>Sample Facebook Application</h1>
			<?php
			if (!is_null($facebook_module)) {
				?>
				<p>
					<?php $facebook_module->renderRegistrationForm(); ?>
				</p>
				<?php
			}
		}
		?>
	</body>
</html>
