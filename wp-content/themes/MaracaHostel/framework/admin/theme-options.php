<?php
/**
 * Theme Options
 */

require_once( ZOZOADMIN . '/functions.php' );

// include redux framework core functions
require_once( ZOZOADMIN . '/ReduxCore/framework.php' );

// Theme options
require_once( ZOZOADMIN . '/theme-config/config.php' );

// Save Theme Options
add_action('redux/options/zozo_options/saved', 'zozo_save_theme_options', 10, 2);
add_action('redux/options/zozo_options/import', 'zozo_save_theme_options', 10, 2);
add_action('redux/options/zozo_options/reset', 'zozo_save_theme_options');
add_action('redux/options/zozo_options/section/reset', 'zozo_save_theme_options');

function zozo_save_theme_options() {
	global $wp_filesystem;
	
	$upload_dir = wp_upload_dir();
	$cus_dir_name = $upload_dir['basedir'] . '/mist';

	if ( ! file_exists( $cus_dir_name ) ) {
		wp_mkdir_p( $cus_dir_name );
	}
	
	if( empty( $wp_filesystem ) ) {
        require_once( ABSPATH . '/wp-admin/includes/file.php' );
        WP_Filesystem();
    }
	
	// Custom Styles File
    ob_start();
    include ZOZOINCLUDES . 'custom-skins.php';
    $custom_css = ob_get_clean();

    $filename =  $cus_dir_name . '/theme_'.get_current_blog_id().'.css';

	if( $wp_filesystem ) {
	
		$wp_filesystem->put_contents(
			$filename,
			$custom_css,
			FS_CHMOD_FILE // predefined mode settings for WP files
		);
		
	}

}