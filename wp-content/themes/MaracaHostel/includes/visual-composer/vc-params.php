<?php 
/**
 * Add new params to Visual Composer
 *
 * @package		Mist
 * @subpackage	Visual Composer
 * @author		Zozothemes
 */

/* =========================================
*  Rows
*  ========================================= */

vc_add_param( 'vc_row', array(
	'type'			=> 'dropdown',
	'heading'		=> __( 'Background Style', 'zozothemes' ),
	'param_name'	=> 'bg_style',
	'value'			=> array(
		__( 'Default', 'zozothemes' )								=> '',
		__( 'Primary Background Color', 'zozothemes' )				=> 'bg-normal',
		__( 'Light Background Color', 'zozothemes' )				=> 'light-wrapper',
		__( 'Grey Background Color', 'zozothemes' )					=> 'grey-wrapper',
		__( 'Dark Background Color', 'zozothemes' )					=> 'dark-wrapper',
		__( 'Dark Grey Background Color', 'zozothemes' )			=> 'dark-grey-wrapper',
		__( 'Image Left, Content on Right', 'zozothemes' )			=> 'image-left',
		__( 'Image Right, Content on Left', 'zozothemes' )			=> 'image-right',
	),
) );

vc_add_param( 'vc_row', array(
	'type'			=> 'dropdown',
	'heading'		=> __( 'Background Skin', 'zozothemes' ),
	'param_name'	=> 'bg_side_skin',
	'value'			=> array(
		__( 'Default', 'zozothemes' )								=> '',
		__( 'Primary Background Color', 'zozothemes' )				=> 'bg-normal',
		__( 'Light Background Color', 'zozothemes' )				=> 'light-wrapper',
		__( 'Grey Background Color', 'zozothemes' )					=> 'grey-wrapper',
		__( 'Dark Background Color', 'zozothemes' )					=> 'dark-wrapper',
		__( 'Dark Grey Background Color', 'zozothemes' )			=> 'dark-grey-wrapper',
	),
	'dependency'	=> array(
		'element'	=> 'bg_style',
		'value'		=> array( 'image-left', 'image-right' )
	),
) );

vc_add_param( 'vc_row', array(
	'type'			=> 'attach_image',
	'heading'		=> __( 'Left or Right Image', 'zozothemes' ),
	'param_name'	=> 'bg_side_image',
	'value'			=> '',
	'dependency'	=> array(
		'element'	=> 'bg_style',
		'value'		=> array( 'image-left', 'image-right' )
	),
) );

vc_add_param( 'vc_row', array(
	'type'			=> 'dropdown',
	'heading'		=> __( 'Background Size', 'zozothemes' ),
	'param_name'	=> 'bg_side_size',
	'value'			=> array(
		__( 'Default', 'zozothemes' )	=> 'default',
		__( 'Cover', 'zozothemes' )		=> 'cover',
		__( 'Contain', 'zozothemes' )	=> 'contain',
	),
	'dependency'	=> array(
		'element'	=> 'bg_style',
		'value'		=> array( 'image-left', 'image-right' )
	),
) );

vc_add_param( 'vc_row', array(
	'type'			=> 'dropdown',
	'heading'		=> __( 'Background Repeat', 'zozothemes' ),
	'param_name'	=> 'bg_side_repeat',
	'value'			=> array(
		__( 'No Repeat', 'zozothemes' )	=> 'no-repeat',
		__( 'Repeat', 'zozothemes' )	=> 'repeat',
		__( 'Repeat-x', 'zozothemes' )	=> 'repeat-x',
		__( 'Repeat-y', 'zozothemes' )	=> 'repeat-y',
	),
	'dependency'	=> array(
		'element'	=> 'bg_style',
		'value'		=> array( 'image-left', 'image-right' )
	),
) );

vc_add_param( 'vc_row', array(
	'type'			=> 'dropdown',
	'heading'		=> __( 'Make Container Fluid ?', 'zozothemes' ),
	'param_name'	=> 'container_fluid',
	'value'			=> array(
		__( 'No', 'zozothemes' )	=> 'no',
		__( 'Yes', 'zozothemes' )	=> 'yes',
	),
	'dependency'	=> array(
		'element'	=> 'bg_style',
		'value'		=> array( 'image-left', 'image-right' )
	),
	'description'	=> __( 'Use this option to make column in fluid container.', 'zozothemes' ),
) );

vc_add_param( 'vc_row', array(
	'type'			=> 'dropdown',
	'heading'		=> __( 'Column Match Height', 'zozothemes' ),
	'param_name'	=> 'match_height',
	'value'			=> array(
		__( 'No', 'zozothemes' )	=> 'no',
		__( 'Yes', 'zozothemes' )	=> 'yes',
	),
	'dependency'	=> array(
		'element'	=> 'bg_style',
		'value'		=> array( '', 'bg-normal', 'light-wrapper', 'grey-wrapper', 'dark-wrapper' )
	),
	'description'	=> __( 'Use this option to make all column in equal heights..', 'zozothemes' ),
) );

vc_add_param( 'vc_row', array(
	'type'			=> 'dropdown',
	'heading'		=> __( 'Center Row Content', 'zozothemes' ),
	'param_name'	=> 'center_row',
	'value'			=> array(
		__( 'No', 'zozothemes' )	=> 'no',
		__( 'Yes', 'zozothemes' )	=> 'yes',
	),
	'description'	=> __( 'Use this option to add container and center the inner content. Useful when using full-width pages.', 'zozothemes' ),
) );

vc_add_param( 'vc_row', array(
	'type'			=> 'checkbox',
	'heading'		=> __( 'Enable Background Image Overlay?', 'zozothemes' ),
	'param_name'	=> 'bg_overlay',
	'description'	=> __( 'Check this box to enable the overlay for background image.', 'zozothemes' ),
	'value'			=> array(
		__( 'Yes, please', 'zozothemes' )	=> 'yes'
	),
) );

vc_add_param( 'vc_row', array(
	'type'			=> 'dropdown',
	'heading'		=> __( 'Background Overlay Style', 'zozothemes' ),
	'param_name'	=> 'bg_overlay_style',
	'value'			=> array(
		__( 'Default', 'zozothemes' )				=> 'overlay-dark',
		__( 'Dark Overlay', 'zozothemes' )			=> 'overlay-dark',
		__( 'Light Overlay', 'zozothemes' )			=> 'overlay-light',
		__( 'Theme Overlay', 'zozothemes' )			=> 'overlay-primary',	
	),
	'dependency'	=> array(
		'element'	=> 'bg_overlay',
		'value'		=> 'yes'
	),
) );

vc_add_param( 'vc_row', array(
	'type'			=> 'checkbox',
	'heading'		=> __( 'Enable Video Background?', 'zozothemes' ),
	'param_name'	=> 'enable_video_bg',
	'description'	=> __( 'Check this box to enable the options for video background.', 'zozothemes' ),
	'value'			=> array(
		__( 'Yes, please', 'zozothemes' )	=> 'yes'
	),
	'group'			=> __( 'Video', 'zozothemes' ),
) );

vc_add_param( 'vc_row', array(
	'type'			=> 'textfield',
	'heading'		=> __( 'Video ID', 'zozothemes' ),
	'param_name'	=> 'video_id',
	'description'	=> __( 'Enter Youtube Video ID to play background video. Ex: Y-OLlJUXwKU', 'zozothemes' ),
	'dependency'	=> array(
		'element'	=> 'enable_video_bg',
		'value'		=> 'yes'
	),
	'group'			=> __( 'Video', 'zozothemes' ),
) );

vc_add_param( 'vc_row', array(
	'type'			=> 'attach_image',
	'heading'		=> __( 'Video Fallback Image', 'zozothemes' ),
	'param_name'	=> 'video_fallback',
	'value'			=> '',
	'dependency'	=> array(
		'element'	=> 'enable_video_bg',
		'value'		=> 'yes'
	),
	'group'			=> __( 'Video', 'zozothemes' ),
) );

vc_add_param( 'vc_row', array(
	'type'			=> 'dropdown',
	'heading'		=> __( 'Video Autoplay', 'zozothemes' ),
	'param_name'	=> 'video_autoplay',
	'value'			=> array(
		__( 'Yes', 'zozothemes' )	=> 'true',
		__( 'No', 'zozothemes' )	=> 'false',
	),
	'dependency'	=> array(
		'element'	=> 'enable_video_bg',
		'value'		=> 'yes'
	),
	'group'			=> __( 'Video', 'zozothemes' ),
) );

vc_add_param( 'vc_row', array(
	'type'			=> 'dropdown',
	'heading'		=> __( 'Video Mute', 'zozothemes' ),
	'param_name'	=> 'video_mute',
	'value'			=> array(
		__( 'No', 'zozothemes' )	=> 'false',
		__( 'Yes', 'zozothemes' )	=> 'true',
	),
	'dependency'	=> array(
		'element'	=> 'enable_video_bg',
		'value'		=> 'yes'
	),
	'group'			=> __( 'Video', 'zozothemes' ),
) );

vc_add_param( 'vc_row', array(
	'type'			=> 'dropdown',
	'heading'		=> __( 'Video Controls', 'zozothemes' ),
	'param_name'	=> 'video_controls',
	'value'			=> array(
		__( 'No', 'zozothemes' )	=> 'false',
		__( 'Yes', 'zozothemes' )	=> 'true',
	),
	'dependency'	=> array(
		'element'	=> 'enable_video_bg',
		'value'		=> 'yes'
	),
	'group'			=> __( 'Video', 'zozothemes' ),
) );

vc_add_param( 'vc_row', array(
	'type'			=> 'textfield',
	'heading'		=> __( 'Video Height', 'zozothemes' ),
	'param_name'	=> 'video_height',
	'description'	=> __( 'Enter Video Height. Ex: 400', 'zozothemes' ),
	'dependency'	=> array(
		'element'	=> 'enable_video_bg',
		'value'		=> 'yes'
	),
	'group'			=> __( 'Video', 'zozothemes' ),
) );

vc_add_param( 'vc_row', array(
	'type'			=> 'dropdown',
	'heading'		=> __( 'Typography Style', 'zozothemes' ),
	'param_name'	=> 'typo_style',
	'value'			=> array(
		__( 'Dark Text', 'zozothemes' )		=> 'dark',
		__( 'Default', 'zozothemes' )		=> 'default',
		__( 'White Text', 'zozothemes' )	=> 'light',
	),
) );

vc_add_param( 'vc_row', vc_map_add_css_animation( $label = false ) );

vc_add_param( 'vc_row', array(
	'type'			=> 'textfield',
	'heading'		=> __( 'Minimum Height', 'zozothemes' ),
	'param_name'	=> 'min_height',
	'description'	=> __( 'You can enter a minimum height for this row.', 'zozothemes' ),
) );

vc_remove_param( 'vc_row', 'equal_height' );

/* =========================================
*  Row Inner
*  ========================================= */

vc_add_param( 'vc_row_inner', array(
	'type'			=> 'dropdown',
	'heading'		=> __( 'Column Match Height', 'zozothemes' ),
	'param_name'	=> 'match_height',
	'value'			=> array(
		__( 'No', 'zozothemes' )	=> 'no',
		__( 'Yes', 'zozothemes' )	=> 'yes',
	),
	'description'	=> __( 'Use this option to make all column in equal heights..', 'zozothemes' ),
) );

vc_remove_param( 'vc_row_inner', 'equal_height' );

/* =========================================
*  Columns
*  ========================================= */

vc_add_param( 'vc_column', array(
	'type'			=> 'dropdown',
	'heading'		=> __( 'Background Style', 'zozothemes' ),
	'param_name'	=> 'bg_style',
	'value'			=> array(
		__( 'Default', 'zozothemes' )								=> '',
		__( 'Primary Background Color', 'zozothemes' )				=> 'bg-normal',
		__( 'Light Background Color', 'zozothemes' )				=> 'light-wrapper',
		__( 'Grey Background Color', 'zozothemes' )					=> 'grey-wrapper',
		__( 'Dark Background Color', 'zozothemes' )					=> 'dark-wrapper',
		__( 'Dark Grey Background Color', 'zozothemes' )			=> 'dark-grey-wrapper',
	),
) );

vc_add_param( 'vc_column', array(
	'type'			=> 'dropdown',
	'heading'		=> __( 'Typography Style', 'zozothemes' ),
	'param_name'	=> 'typo_style',
	'value'			=> array(
		__( 'Default', 'zozothemes' )		=> 'default',
		__( 'Dark Text', 'zozothemes' )		=> 'dark',
		__( 'White Text', 'zozothemes' )	=> 'light',
	),
) );

vc_add_param( 'vc_column', vc_map_add_css_animation( $label = false) );

/* =========================================
*  Column inner
*  ========================================= */

vc_add_param( 'vc_column_inner', array(
	'type'			=> 'dropdown',
	'heading'		=> __( 'Background Style', 'zozothemes' ),
	'param_name'	=> 'bg_style',
	'value'			=> array(
		__( 'Default', 'zozothemes' )								=> '',
		__( 'Primary Background Color', 'zozothemes' )				=> 'bg-normal',
		__( 'Light Background Color', 'zozothemes' )				=> 'light-wrapper',
		__( 'Grey Background Color', 'zozothemes' )					=> 'grey-wrapper',
		__( 'Dark Background Color', 'zozothemes' )					=> 'dark-wrapper',
		__( 'Dark Grey Background Color', 'zozothemes' )			=> 'dark-grey-wrapper',
	),
) );

vc_add_param( 'vc_column_inner', array(
	'type'			=> 'dropdown',
	'heading'		=> __( 'Typography Style', 'zozothemes' ),
	'param_name'	=> 'typo_style',
	'value'			=> array(
		__( 'Default', 'zozothemes' )		=> 'default',
		__( 'Dark Text', 'zozothemes' )		=> 'dark',
		__( 'White Text', 'zozothemes' )	=> 'light',
	),
) );

vc_add_param( 'vc_column_inner', vc_map_add_css_animation( $label = false) );

/* =========================================
*  Accordion
*  ========================================= */

vc_add_param( 'vc_tta_accordion', array(
	'type'			=> 'dropdown',
	'heading'		=> __( 'Style', 'zozothemes' ),
	'description' 	=> __( 'Select accordion display style.', 'zozothemes' ),
	'param_name'	=> 'style',
	'value'			=> array(
		__( 'Default', 'zozothemes' ) 	=> 'default',
		__( 'Classic', 'zozothemes' ) 	=> 'classic',
		__( 'Modern', 'zozothemes' ) 	=> 'modern',
		__( 'Flat', 'zozothemes' ) 		=> 'flat',
		__( 'Outline', 'zozothemes' ) 	=> 'outline',
	),
) );

/* =========================================
*  Section
*  ========================================= */

vc_remove_param( 'vc_tta_section', 'el_class' );

vc_add_param( 'vc_tta_section', array(
	"type" 			=> "dropdown",
	"heading" 		=> __( "Icon library", "zozothemes" ),
	"value" 		=> array(
		__( "Font Awesome", "zozothemes" ) 		=> "fontawesome",
		__( 'Open Iconic', 'zozothemes' ) 		=> 'openiconic',
		__( 'Typicons', 'zozothemes' ) 		=> 'typicons',
		__( 'Entypo', 'zozothemes' ) 			=> 'entypo',
		__( "Lineicons", "zozothemes" ) 		=> "lineicons",
		__( "Flaticons", "zozothemes" ) 		=> "flaticons",
		__( "Icomoon Pack 1", "zozothemes" ) 	=> "icomoonpack1",
		__( "Icomoon Pack 2", "zozothemes" ) 	=> "icomoonpack2",
		__( "Icomoon Pack 3", "zozothemes" ) 	=> "icomoonpack3",
	),
	"admin_label" 	=> true,
	"param_name" 	=> "i_type",
	"dependency" 	=> array(
						"element" 	=> "add_icon",
						"value" 	=> "true",
					),
	"description" 	=> __( "Select icon library.", "zozothemes" ),
) );

vc_add_param( 'vc_tta_section', array(
	"type" 			=> 'iconpicker',
	"heading" 		=> __( "Icon", "zozothemes" ),
	"param_name" 	=> "i_icon_lineicons",
	"value" 		=> "",
	"settings" 		=> array(
		"emptyIcon" 	=> true,
		"type" 			=> 'simplelineicons',
		"iconsPerPage" 	=> 4000,
	),
	"dependency" 	=> array(
		"element" 	=> "i_type",
		"value" 	=> "lineicons",
	),
	"description" 	=> __( "Select icon from library.", "zozothemes" ),
) );

vc_add_param( 'vc_tta_section', array(
	"type" 			=> 'iconpicker',
	"heading" 		=> __( "Icon", "zozothemes" ),
	"param_name" 	=> "i_icon_flaticons",
	"value" 		=> "",
	"settings" 		=> array(
		"emptyIcon" 	=> true,
		"type" 			=> 'flaticons',
		"iconsPerPage" 	=> 4000,
	),
	"dependency" 	=> array(
		"element" 	=> "i_type",
		"value" 	=> "flaticons",
	),
	"description" 	=> __( "Select icon from library.", "zozothemes" ),
) );

vc_add_param( 'vc_tta_section', array(
	"type" 			=> 'iconpicker',
	"heading" 		=> __( "Icon", "zozothemes" ),
	"param_name" 	=> "i_icon_icomoonpack1",
	"value" 		=> "",
	"settings" 		=> array(
		"emptyIcon" 	=> true,
		"type" 			=> 'icomoonpack1',
		"iconsPerPage" 	=> 4000,
	),
	"dependency" 	=> array(
		"element" 	=> "i_type",
		"value" 	=> "icomoonpack1",
	),
	"description" 	=> __( "Select icon from library.", "zozothemes" ),
) );

vc_add_param( 'vc_tta_section', array(
	"type" 			=> 'iconpicker',
	"heading" 		=> __( "Icon", "zozothemes" ),
	"param_name" 	=> "i_icon_icomoonpack2",
	"value" 		=> "",
	"settings" 		=> array(
		"emptyIcon" 	=> true,
		"type" 			=> 'icomoonpack2',
		"iconsPerPage" 	=> 4000,
	),
	"dependency" 	=> array(
		"element" 	=> "i_type",
		"value" 	=> "icomoonpack2",
	),
	"description" 	=> __( "Select icon from library.", "zozothemes" ),	
) );

vc_add_param( 'vc_tta_section', array(
	"type" 			=> 'iconpicker',
	"heading" 		=> __( "Icon", "zozothemes" ),
	"param_name" 	=> "i_icon_icomoonpack3",
	"value" 		=> "",
	"settings" 		=> array(
		"emptyIcon" 	=> true,
		"type" 			=> 'icomoonpack3',
		"iconsPerPage" 	=> 4000,
	),
	"dependency" 	=> array(
		"element" 	=> "i_type",
		"value" 	=> "icomoonpack3",
	),
	"description" 	=> __( "Select icon from library.", "zozothemes" ),
) );

vc_add_param( 'vc_tta_section', array(
	'type' 			=> 'textfield',
	'heading' 		=> __( 'Extra class name', 'zozothemes' ),
	'param_name' 	=> 'el_class',
	'description' 	=> __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'zozothemes' )
) );

/* =========================================
*  Button
*  ========================================= */

vc_add_param( 'vc_btn', array(
	"type" 			=> "dropdown",
	'heading' 		=> __( 'Style', 'zozothemes' ),
	'description' 	=> __( 'Select button display style.', 'zozothemes' ),
	'value' 		=> array(
		__( 'Default', 'zozothemes' ) 			=> 'default',
		__( 'Transparent', 'zozothemes' ) 		=> 'transparent',
		__( 'Modern', 'zozothemes' ) 			=> 'modern',
		__( 'Classic', 'zozothemes' ) 			=> 'classic',
		__( 'Flat', 'zozothemes' ) 				=> 'flat',
		__( 'Outline', 'zozothemes' ) 			=> 'outline',
		__( '3d', 'zozothemes' ) 				=> '3d',
		__( 'Custom', 'zozothemes' ) 			=> 'custom',
		__( 'Outline custom', 'zozothemes' ) 	=> 'outline-custom',
	),
	"param_name" 	=> "style",
) );

vc_add_param( 'vc_btn', array(
	'type' 					=> 'dropdown',
	'heading' 				=> __( 'Color', 'zozothemes' ),
	'param_name' 			=> 'color',
	'description' 			=> __( 'Select button color.', 'zozothemes' ),
	// compatible with btn2, need to be converted from btn1
	'param_holder_class' 	=> 'vc_colored-dropdown vc_btn3-colored-dropdown',
	'value' 				=> array(
				// Theme Colors
				__( 'Theme Color', 'js_composer' ) 		=> 'primary-bg',
			   // Btn1 Colors
			   __( 'Classic Grey', 'js_composer' ) 		=> 'default',
			   __( 'Classic Blue', 'js_composer' ) 		=> 'primary',
			   __( 'Classic Turquoise', 'js_composer' ) => 'info',
			   __( 'Classic Green', 'js_composer' ) 	=> 'success',
			   __( 'Classic Orange', 'js_composer' )	=> 'warning',
			   __( 'Classic Red', 'js_composer' ) 		=> 'danger',
			   __( 'Classic Black', 'js_composer' ) 	=> "inverse"
			   // + Btn2 Colors (default color set)
		   ) + getVcShared( 'colors-dashed' ),
	'std' 					=> 'primary-bg',
	// must have default color grey
	'dependency' => array(
		'element' => 'style',
		'value_not_equal_to' => array( 'custom', 'outline-custom' )
	),
) );

/* =========================================
*  Call To Action
*  ========================================= */

vc_add_param( 'vc_cta', array(
	'type' 			=> 'dropdown',
	'heading' 		=> __( 'Style', 'zozothemes' ),
	'param_name' 	=> 'style',
	'value' 		=> array(
		__( 'Default', 'zozothemes' ) 	=> 'default',
		__( 'Classic', 'zozothemes' ) 	=> 'classic',
		__( 'Flat', 'zozothemes' ) 		=> 'flat',
		__( 'Outline', 'zozothemes' ) 	=> 'outline',
		__( '3d', 'zozothemes' ) 		=> '3d',
		__( 'Custom', 'zozothemes' ) 	=> 'custom',
	),
	'std' 			=> 'default',
	'description' 	=> __( 'Select call to action display style.', 'zozothemes' ),
) );

vc_add_param( 'vc_cta', array(
	"type" 			=> "dropdown",
	'heading' 		=> __( 'Style', 'zozothemes' ),
	'description' 	=> __( 'Select button display style.', 'zozothemes' ),
	'value' 		=> array(
		__( 'Default', 'zozothemes' ) 			=> 'default',
		__( 'Transparent', 'zozothemes' ) 		=> 'transparent',
		__( 'Modern', 'zozothemes' ) 			=> 'modern',
		__( 'Classic', 'zozothemes' ) 			=> 'classic',
		__( 'Flat', 'zozothemes' ) 				=> 'flat',
		__( 'Outline', 'zozothemes' ) 			=> 'outline',
		__( '3d', 'zozothemes' ) 				=> '3d',
		__( 'Custom', 'zozothemes' ) 			=> 'custom',
		__( 'Outline custom', 'zozothemes' ) 	=> 'outline-custom',
	),
	'dependency' 			=> array(
		'element' 		=> 'add_button',
		'not_empty' 	=> true,
	),
	"integrated_shortcode" 			=> "vc_btn",
	"integrated_shortcode_field" 	=> "btn_",
	"param_name" 					=> "btn_style",
	"group"							=> __( 'Button', 'zozothemes' ),
) );

vc_add_param( 'vc_cta', array(
	'type' 					=> 'dropdown',
	'heading' 				=> __( 'Color', 'zozothemes' ),
	'param_name' 			=> 'btn_color',
	'description' 			=> __( 'Select button color.', 'zozothemes' ),
	// compatible with btn2, need to be converted from btn1
	'param_holder_class' 	=> 'vc_colored-dropdown vc_btn3-colored-dropdown',
	'value' 				=> array(
				// Theme Colors
				__( 'Theme Color', 'js_composer' ) 		=> 'primary-bg',
			   // Btn1 Colors
			   __( 'Classic Grey', 'js_composer' ) 		=> 'default',
			   __( 'Classic Blue', 'js_composer' ) 		=> 'primary',
			   __( 'Classic Turquoise', 'js_composer' ) => 'info',
			   __( 'Classic Green', 'js_composer' ) 	=> 'success',
			   __( 'Classic Orange', 'js_composer' )	=> 'warning',
			   __( 'Classic Red', 'js_composer' ) 		=> 'danger',
			   __( 'Classic Black', 'js_composer' ) 	=> "inverse"
			   // + Btn2 Colors (default color set)
		   ) + getVcShared( 'colors-dashed' ),
	'std' 							=> 'primary-bg',
	"group"							=> __( 'Button', 'zozothemes' ),
	"integrated_shortcode" 			=> "vc_btn",
	"integrated_shortcode_field" 	=> "btn_",
	// must have default color grey
	'dependency' 			=> array(
		'element' 				=> 'btn_style',
		'value_not_equal_to' 	=> array( 'custom', 'outline-custom' )
	),
) );

vc_add_param( 'vc_cta', array(
	"type" 			=> "dropdown",
	'heading' 		=> __( 'Icon color', 'zozothemes' ),
	'description' 	=> __( 'Select icon color.', 'zozothemes' ),
	'value' 		=> array_merge( getVcShared( 'colors' ), array( __( 'Theme Color', 'zozothemes' ) => 'primary-bg' ), array( __( 'Custom color', 'zozothemes' ) => 'custom' ) ),
	'dependency' 			=> array(
		'element' 		=> 'add_icon',
		'not_empty' 	=> true,
	),
	"integrated_shortcode" 			=> "vc_icon",
	"integrated_shortcode_field" 	=> "i_",
	"param_name" 					=> "i_color",
	'param_holder_class' 			=> 'vc_colored-dropdown',
	"group"							=> __( 'Icon', 'zozothemes' ),
) );

vc_add_param( 'vc_cta', array(
	"type" 			=> "dropdown",
	'heading' 		=> __( 'Background color', 'zozothemes' ),
	'description' 	=> __( 'Select background color for icon.', 'zozothemes' ),
	'value' 		=> array_merge( getVcShared( 'colors' ), array( __( 'Theme Color', 'zozothemes' ) => 'primary-bg' ), array( __( 'Custom color', 'zozothemes' ) => 'custom' ) ),
	'dependency' 		=> array(
		'element' 		=> 'i_background_style',
		'not_empty' 	=> true,
	),
	"integrated_shortcode" 			=> "vc_icon",
	"integrated_shortcode_field" 	=> "i_",
	"param_name" 					=> "i_background_color",
	'param_holder_class' 			=> 'vc_colored-dropdown',
	"group"							=> __( 'Icon', 'zozothemes' ),
) );

/* =========================================
*  Progress Bar
*  ========================================= */

vc_add_param( 'vc_progress_bar', array(
	'type' 			=> 'dropdown',
	'heading' 		=> __( 'Color', 'zozothemes' ),
	'param_name' 	=> 'bgcolor',
	'value' 		=> array(
		__( 'Default', 'zozothemes' ) 		=> 'bar_default',
		__( 'Default White', 'zozothemes' ) => 'bar_default_white',
		__( 'Grey', 'zozothemes' ) 			=> 'bar_grey',
		__( 'Blue', 'zozothemes' ) 			=> 'bar_blue',
		__( 'Turquoise', 'zozothemes' ) 	=> 'bar_turquoise',
		__( 'Green', 'zozothemes' ) 		=> 'bar_green',
		__( 'Orange', 'zozothemes' ) 		=> 'bar_orange',
		__( 'Red', 'zozothemes' ) 			=> 'bar_red',
		__( 'Black', 'zozothemes' ) 		=> 'bar_black',
		__( 'Custom Color', 'zozothemes' ) 	=> 'custom'
	),
	'admin_label' 	=> true,
	'description' 	=> __( 'Select bar background color.', 'zozothemes' ),
) );

vc_add_param( 'vc_progress_bar', array(
	'type' 			=> 'dropdown',
	'heading' 		=> __( 'Style', 'zozothemes' ),
	'param_name' 	=> 'bar_style',
	'value' 		=> array(
		__( 'Default', 'zozothemes' ) 		=> 'default',
		__( 'Tooltip', 'zozothemes' ) 		=> 'tooltip',
	),
	'description' 	=> __( 'Select bar style.', 'zozothemes' ),
) );

vc_add_param( 'vc_progress_bar', array(
	'type' 			=> 'textfield',
	'heading' 		=> __( 'Bar Height', 'zozothemes' ),
	'param_name' 	=> 'bar_height',
	'description' 	=> __( 'Enter bar height. Ex: 20px', 'zozothemes' )
) );

/* =========================================
*  Testimonial Categories
*  ========================================= */
if( ZOZO_TESTIMONIAL_ACTIVE ) {

	$testimonial_args = array(
		'orderby'                  => 'name',
		'hide_empty'               => 0,
		'hierarchical'             => 1,
		'taxonomy'                 => 'testimonial_categories'
	);
	
	$testimonial_lists = get_categories( $testimonial_args );
	$testimonials_cats = array( 'Show all categories' => 'all' );
	
	foreach( $testimonial_lists as $cat ){
		$testimonials_cats[$cat->name] = $cat->slug;
	}
	
	vc_add_param( 'zozo_vc_testimonials_slider', array(
		'type'			=> 'dropdown',
		'admin_label' 	=> true,
		'heading'		=> __( 'Choose Testimonial Categories', 'zozothemes' ),
		'param_name'	=> 'categories_id',
		'value' 		=> $testimonials_cats		
	) );
	
	vc_add_param( 'zozo_vc_testimonials_grid', array(
		'type'			=> 'dropdown',
		'admin_label' 	=> true,
		'heading'		=> __( 'Choose Testimonial Categories', 'zozothemes' ),
		'param_name'	=> 'categories_id',
		'value' 		=> $testimonials_cats		
	) );
	
}

/* =========================================
*  Team Categories
*  ========================================= */
if( ZOZO_TEAM_ACTIVE ) {

	$team_args = array(
		'orderby'                  => 'name',
		'hide_empty'               => 0,
		'hierarchical'             => 1,
		'taxonomy'                 => 'team_categories'
	);
	
	$team_lists = get_categories( $team_args );
	$team_cats = array( 'Show all categories' => 'all' );
	
	foreach( $team_lists as $cat ){
		$team_cats[$cat->name] = $cat->slug;
	}
	
	vc_add_param( 'zozo_vc_team_grid', array(
		'type'			=> 'dropdown',
		'admin_label' 	=> true,
		'heading'		=> __( 'Choose Team Categories', 'zozothemes' ),
		'param_name'	=> 'categories_id',
		'value' 		=> $team_cats		
	) );
	
	vc_add_param( 'zozo_vc_team_slider', array(
		'type'			=> 'dropdown',
		'admin_label' 	=> true,
		'heading'		=> __( 'Choose Team Categories', 'zozothemes' ),
		'param_name'	=> 'categories_id',
		'value' 		=> $team_cats		
	) );
	
	vc_add_param( 'zozo_vc_team_list', array(
		'type'			=> 'dropdown',
		'admin_label' 	=> true,
		'heading'		=> __( 'Choose Team Categories', 'zozothemes' ),
		'param_name'	=> 'categories_id',
		'value' 		=> $team_cats		
	) );
	
}

/* =========================================
*  Woocommerce Product Categories
*  ========================================= */
if( ZOZO_WOOCOMMERCE_ACTIVE ) {

	$woo_args = array(
		'orderby'                  => 'name',
		'hide_empty'               => 0,
		'hierarchical'             => 1,
		'taxonomy'                 => 'product_cat'
	);
	
	$woo_lists = get_categories( $woo_args );
	$woo_cats = array( 'Show all categories' => 'all' );
	
	foreach( $woo_lists as $cat ){
		$woo_cats[$cat->name] = $cat->slug;
	}
	
	vc_add_param( 'zozo_vc_woo_product_slider', array(
		'type'			=> 'dropdown',
		'admin_label' 	=> true,
		'heading'		=> __( 'Choose Product Categories', 'zozothemes' ),
		'param_name'	=> 'categories_id',
		'value' 		=> $woo_cats		
	) );
	
}