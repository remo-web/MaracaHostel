<?php
/**
 * 
 *  @package HREFLANG Tags Pro\Init
 *  @since 1.3.3
 * 
 */

if ( ! function_exists( 'add_filter' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

if (file_exists(HREFLANG_PLUGIN_MAIN_PATH. 'includes/functions.php')) {
	include_once(HREFLANG_PLUGIN_MAIN_PATH. 'includes/functions.php');
}
else {
	die('Functions are missing');  
}

if (file_exists(HREFLANG_PLUGIN_MAIN_PATH. 'includes/variables.php')) {
	include_once(HREFLANG_PLUGIN_MAIN_PATH. 'includes/variables.php');
}
else {
	die('Variables are missing');  
}

if (file_exists(HREFLANG_PLUGIN_MAIN_PATH. 'includes/actions.php')) {
	include_once(HREFLANG_PLUGIN_MAIN_PATH. 'includes/actions.php');
}
else {
	die('Variables are missing');  
}
global $hreflanguages;

register_activation_hook(__FILE__,'hreflang_admin_actions');
// init text domain

// add this link only if admin and option is enabled
if (get_option('hreflang-enable-admin-menu', 'false' ) == 'true' ){
	if (is_admin()) {
		add_action( 'wp_before_admin_bar_render', 'hreflang_admin_bar' );
	}
}

$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", 'hreflang_plugin_settings_link' );