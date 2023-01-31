<?php

// Vars
define('QSITE_URL', get_bloginfo('url'));
// define('API_EMAIL', 'ahsoka.tano@q.agency');
// define('API_PASSWORD', 'Kryze4President');

// Register CSS and JS files
function addAssets() {
	// CSS
	wp_register_style('q-main-css', get_stylesheet_directory_uri() . '/assets/q-main.css', [], false, 'all');
	// JS
	wp_register_script('q-main-js', get_stylesheet_directory_uri() . '/assets/q-main.js', [], false, true);

	// Enqueue CSS and JS files
	// CSS
	wp_enqueue_style('q-main-css');
	// JS
	wp_enqueue_script('q-main-js');
}
add_action( 'wp_enqueue_scripts', 	'addAssets' );