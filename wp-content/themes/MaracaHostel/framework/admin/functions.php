<?php // Custom Functions

add_action( 'admin_print_scripts-post.php', 'zozo_admin_icon_styles_compatible', 30 );
add_action( 'admin_print_scripts-post-new.php', 'zozo_admin_icon_styles_compatible', 30 );

/**
 * Enqueue Icon Styles for Admin
 *
 * @return	void
 */
function zozo_admin_icon_styles_compatible() {
	// CSS		
	wp_enqueue_style( 'zozo-font-awesome', ZOZOTHEME_URL . '/css/font-awesome.css', false, '4.4.0', 'all' );
	wp_enqueue_style( 'zozo-iconspack', ZOZOTHEME_URL . '/css/iconspack.css', false, '1.0', 'all' );
}

/* ==================================================================
 *	Revolution Slider Disable Notice
 * ================================================================== */

if( is_admin() ) {
	if( function_exists( 'set_revslider_as_theme' )){
		add_action( 'init', 'zozo_set_Rev_Slider_as_theme' );
		function zozo_set_Rev_Slider_as_theme() {
			update_option('revslider-valid-notice', 'false');
			set_revslider_as_theme();
		}
	}
}

/* ==================================================================
 *	Ultimate Addon Disable Notice
 * ================================================================== */

if( class_exists('Ultimate_VC_Addons') ) {
	add_action('admin_init', 'zozo_disable_ultimate_addon_notice');
}
function zozo_disable_ultimate_addon_notice() {
	remove_action('admin_notices','bsf_notices',1000);
	remove_action('network_admin_notices','bsf_notices',1000);
}

function zozo_admin_error_notice() {
	$class = "update-nag";
	$message = 'If you are existing customer with mist theme and upgrading to latest version, please save your theme options once after successful upgrade. <a href="' . admin_url( 'admin.php?page=zozo_options&tab=0' ) .'" target="_self">Theme Options</a>';
    
	echo "<div class=\"$class\"><p><strong>$message</strong></p></div>"; 
}

$upload_dir = wp_upload_dir();
$custom_css_path = $upload_dir['basedir'] . '/mist/theme_'. get_current_blog_id() .'.css';
if( ! is_file( $upload_dir['basedir'] . '/mist/theme_'. get_current_blog_id() .'.css' ) ) {
	add_action( 'admin_notices', 'zozo_admin_error_notice' ); 
}

/**
 * Move Icomoon Pack to Uploads folder for Ultimate Addon
 */

if( class_exists('Ultimate_VC_Addons') ) {
	add_action('admin_init', 'zozo_move_ultimate_icon_fonts');
}

function zozo_move_ultimate_icon_fonts() {
	global $zozo_options;
	
	$upload_dir 		= wp_upload_dir();
	$aio_fonts 			= 'smile_fonts';
	$aio_fontdir 		= trailingslashit( $upload_dir['basedir'] ) . $aio_fonts;
	$aio_font_config	= 'charmap.php';
	$aio_vc_fonts 		= trailingslashit( $upload_dir['basedir'] ). $aio_fonts . '/';
	$aio_vc_fonts_dir 	= ZOZOTHEME_DIR . '/fonts';
	
	$fonts = get_option('smile_fonts');
	if(empty($fonts)) $fonts = array();
	
	$font_packs = 1;
	
	while( $font_packs <= 3 ) {
	
		if( ! isset( $fonts[ 'icomoonpack'. $font_packs ] ) ) {
			if( isset( $zozo_options['zozo_enable_ultimate_icomoon'. $font_packs] ) && $zozo_options['zozo_enable_ultimate_icomoon'. $font_packs] == 1 ) {
				zozo_add_ultimate_icon_font( $aio_vc_fonts . 'icomoonpack' . $font_packs, $aio_vc_fonts_dir . '/icomoonpack'. $font_packs .'/', 'icomoonpack'. $font_packs );
			}
		}
		
		if( isset( $zozo_options['zozo_enable_ultimate_icomoon'. $font_packs] ) && $zozo_options['zozo_enable_ultimate_icomoon'. $font_packs] != 1 ) {
			zozo_remove_ultimate_icon_font( 'icomoonpack'. $font_packs );
		}
		
		$font_packs++;
	}
	
}

function zozo_add_ultimate_icon_font( $aio_vc_fonts, $aio_vc_fonts_dir, $font_pack ) {

	$aio_fonts 			= 'smile_fonts';
	$aio_font_config	= 'charmap.php';
	
	$fonts = get_option('smile_fonts');
	if(empty($fonts)) $fonts = array();
	
	// Make destination directory
	if( ! is_dir( $aio_vc_fonts ) ) {
		wp_mkdir_p( $aio_vc_fonts );
		
		@chmod( $aio_vc_fonts, 0777 );
	
		foreach( glob( $aio_vc_fonts_dir . '*') as $file ) {
			$new_file = basename( $file );
			@copy( $file, $aio_vc_fonts . '/' . $new_file );
		}
	}
	
	$fonts[$font_pack] = array(
		'include'   => trailingslashit( $aio_fonts ) . $font_pack,
		'folder' 	=> trailingslashit( $aio_fonts ) . $font_pack,
		'style'	 	=> $font_pack . '/' . $font_pack . '.css',
		'config' 	=> $aio_font_config
	);
	
	update_option('smile_fonts', $fonts);
	
}
function zozo_remove_ultimate_icon_font( $font_pack ) {

	$fonts = get_option('smile_fonts');
	if( isset( $fonts[$font_pack] ) ) {
		unset( $fonts[$font_pack] );
		update_option('smile_fonts', $fonts);
	}
}