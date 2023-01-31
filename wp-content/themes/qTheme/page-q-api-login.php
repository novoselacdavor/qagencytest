<?php
	
	include get_template_directory() . '/inc/client.php';

	if(isset($_COOKIE['q_user_name']) && isset($_COOKIE['q_user_token'])) {
		header('Location: ' . QSITE_URL);
		die();
	}

	$cookie_timeout = 600;
	$login_q_api	= [];
	$login_email 	= isset($_POST['q_email']) ? $_POST['q_email'] : null;
	$login_pass 	= isset($_POST['q_password']) ? $_POST['q_password'] : null;

	if($login_email && $login_pass) {
		$login_q_api 		= new QAgencyAPIClient($login_email, $login_pass);
		$q_user_name_value 	= $login_q_api->userQLogin()['user']['first_name'];
		$q_user_token_value = $login_q_api->userQLogin()['token_key'];

		if(!isset($_COOKIE['q_user_name'])) {
		    setcookie('q_user_name', $q_user_name_value, time() + $cookie_timeout, '/' );
		}

		if(!isset($_COOKIE['q_user_token'])) {
		    setcookie('q_user_token', $q_user_token_value, time() + $cookie_timeout, '/' );
		}
	}

	get_header();
?>

<?php if(have_posts()): while(have_posts()): the_post(); ?>
	<?php the_content(); ?>

	<?php if($q_user_name_value && $q_user_token_value): ?>
		<p>You are now logged in <?php echo $q_user_name_value; ?></p>
		<p>Go back to <a href="<?php echo QSITE_URL; ?>">Homepage</a></p>
	<?php endif; ?>

	<?php if(!$login_q_api): ?>
		<p>You can not submit an empty form.</p>
	<?php endif; ?>
	
<?php endwhile; endif; ?>

<?php

	get_footer();
?>