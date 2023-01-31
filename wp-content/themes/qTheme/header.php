<!DOCTYPE html>
<?php
	$q_user_name = isset($_COOKIE['q_user_name']) ? $_COOKIE['q_user_name'] : null;
?>
<html>
	<head>
		<title><?php echo get_bloginfo('name') ? get_bloginfo('name') : 'Q Agency Test Assignment' ?></title>
		<?php wp_head(); ?>
	</head>
	<body>
		<main>
			<header>
				<h1>Q Agency Test</h1>
				<div>
					<?php if(!is_page('q-api-login') && $q_user_name): ?>
						<p>You are logged in as <?php echo $q_user_name; ?></p>
					<?php endif; ?>

					<?php if(!is_page('q-api-login') && !$q_user_name): ?>
						<a href="javascript:;" class="js-toggle-form-trigger">Login</a>
						<form method="POST" action="<?php echo(QSITE_URL); ?>/q-api-login" class="js-login-form js-toggle-form-target">
							<input type="text" name="q_email" id="q_email" placeholder="Your Email" autocomplete="off">
							<input type="password" name="q_password" id="q_password" placeholder="Your Password" autocomplete="off">
							<input type="submit" name="q_submit" id="q_submit" value="Login">
						</form>
					<?php endif; ?>
					
				</div>
			</header>

