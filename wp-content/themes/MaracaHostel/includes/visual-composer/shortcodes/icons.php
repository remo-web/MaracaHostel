<?php 
/**
 * Icons shortcode
 */

if ( ! function_exists( 'zozo_vc_icons_shortcode' ) ) {
	function zozo_vc_icons_shortcode( $atts, $content = NULL ) {
		
		extract( 
			shortcode_atts( 
				array(
					'classes'				=> '',
					'css_animation'			=> '',
					'icon_align'			=> 'left',
					'icon_type'				=> 'none',
					'icon_style' 			=> 'light',
					'icon_size'				=> 'small',
					'type' 					=> '',
					'icon_flaticons' 		=> '',
					'icon_fontawesome' 		=> 'fa fa-minus-circle',
					'icon_lineicons' 		=> '',
					'icon_icomoonpack1' 	=> '',
					'icon_icomoonpack2' 	=> '',
					'icon_icomoonpack3' 	=> '',
					'icon_color'			=> '',
					'icon_bg_color' 		=> '',
					'icon_border_color'		=> '',
					'icon_border_width'		=> '',
				), $atts 
			) 
		);

		$output = '';
		$extra_class = '';

		// Icon style		
		$icon_stylings = '';
		if( $icon_color ) {
			$icon_stylings .= 'color:'. $icon_color .';';
		}
		
		if( $icon_border_color ) {
			if( $icon_border_width == '' ) {
				$icon_border_width = 1;
			}
			$icon_stylings .= ' border:'.$icon_border_width.'px solid '.$icon_border_color.';';
		}
		
		if( $icon_type != 'none' ) {
			if( $icon_bg_color != '' ) {
				$icon_stylings .= ' background-color: '.$icon_bg_color.';';
			}
			$extra_class .= sprintf( ' icon-shape icon-%s', $icon_type );
		} else {
			$extra_class .= ' icon-plain';
		}
		
		if( $icon_size ) {
			$extra_class .= sprintf( ' icon-%s', $icon_size );
		}
		
		if( $icon_style ) {		
			$extra_class .= sprintf( ' icon-%s', $icon_style );
		}
				
		if( $icon_stylings ) {
			$icon_stylings = 'style="'. $icon_stylings  .'"';
		}		
		
		// Classes
		$main_classes = 'zozo-vc-icons';
		
		if( isset( $classes ) && $classes != '' ) {
			$main_classes .= ' ' . $classes;
		}
		if( isset( $icon_align ) && $icon_align != '' ) {
			$main_classes .= ' text-' . $icon_align;
		}
		$main_classes .= zozo_vc_animation( $css_animation );
		
		$output .= '<div class="'. esc_attr( $main_classes ) .'">';					
			// Icon
			if( isset( ${'icon_'. $type} ) && ${'icon_'. $type} != '' ) {
				$output .= '<i class="'. esc_attr( ${'icon_'. $type} ) . $extra_class . ' zozo-icon"'.$icon_stylings.'></i>';
			}
		$output .= '</div>';
		
		return $output;
	}
}
add_shortcode( 'zozo_vc_icons', 'zozo_vc_icons_shortcode' );

if ( ! function_exists( 'zozo_vc_icons_shortcode_map' ) ) {
	function zozo_vc_icons_shortcode_map() {
		
		vc_map( 
			array(
				"name"					=> __( "Icons", "zozothemes" ),
				"description"			=> __( "List Icons with different style.", 'zozothemes' ),
				"base"					=> "zozo_vc_icons",
				"category"				=> __( "Theme Addons", "zozothemes" ),
				"icon"					=> "zozo-vc-icon",
				"params"				=> array(					
					array(
						'type'			=> 'textfield',
						'admin_label' 	=> true,
						'heading'		=> __( 'Extra Class', "zozothemes" ),
						'param_name'	=> 'classes',
						'value' 		=> '',
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "CSS Animation", "zozothemes" ),
						"param_name"	=> "css_animation",
						"value"			=> array(
							__( "No", "zozothemes" )					=> '',
							__( "Top to bottom", "zozothemes" )			=> "top-to-bottom",
							__( "Bottom to top", "zozothemes" )			=> "bottom-to-top",
							__( "Left to right", "zozothemes" )			=> "left-to-right",
							__( "Right to left", "zozothemes" )			=> "right-to-left",
							__( "Appear from center", "zozothemes" )	=> "appear" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Alignment", "zozothemes" ),
						"param_name"	=> "icon_align",
						"value"			=> array(
							__( "Default", "zozothemes" )	=> "",
							__( "Center", "zozothemes" )	=> "center",
							__( "Left", "zozothemes" )		=> "left",
							__( "Right", "zozothemes" )		=> "right",
						),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Icon Type", "zozothemes" ),
						"param_name"	=> "icon_type",
						"value"			=> array(
							__( "None", "zozothemes" )		=> "none",
							__( "Circle", "zozothemes" )	=> "circle",
							__( "Rounded", "zozothemes" )	=> "rounded",
							__( "Square", "zozothemes" )	=> "square",
						),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Icon Style", "zozothemes" ),
						"param_name"	=> "icon_style",
						"value"			=> array(
							__( "Light", "zozothemes" )			=> "light",
							__( "Dark", "zozothemes" )			=> "dark",
							__( "Bordered", "zozothemes" )		=> "bordered",
							__( "Transparent", "zozothemes" )	=> "transparent",
						),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Icon Size", "zozothemes" ),
						"param_name"	=> "icon_size",
						"value"			=> array(
							__( "Small", "zozothemes" )			=> "small",
							__( "Medium", "zozothemes" )		=> "medium",
							__( "Large", "zozothemes" )			=> "large",
							__( "Extra Large", "zozothemes" )	=> "exlarge",
						),
						"group"			=> __( "Icon", "zozothemes" ),
					),
					array(
						"type" 			=> "dropdown",
						"heading" 		=> __( "Choose from Icon library", "zozothemes" ),
						"value" 		=> array(
							__( "None", "zozothemes" ) 				=> "",
							__( "Font Awesome", "zozothemes" ) 		=> "fontawesome",
							__( "Lineicons", "zozothemes" ) 		=> "lineicons",
							__( "Flaticons", "zozothemes" ) 		=> "flaticons",
							__( "Icomoon Pack 1", "zozothemes" ) 	=> "icomoonpack1",
							__( "Icomoon Pack 2", "zozothemes" ) 	=> "icomoonpack2",
							__( "Icomoon Pack 3", "zozothemes" ) 	=> "icomoonpack3",
						),
						"admin_label" 	=> true,
						"param_name" 	=> "type",
						"description" 	=> __( "Select icon library.", "zozothemes" ),
						"group"			=> __( "Icon", "zozothemes" ),
					),					
					array(
						"type" 			=> 'iconpicker',
						"heading" 		=> __( "Icon", "zozothemes" ),
						"param_name" 	=> "icon_fontawesome",
						"value" 		=> "fa fa-minus-circle",
						"settings" 		=> array(
							"emptyIcon" 	=> true,
							"iconsPerPage" 	=> 4000,
						),
						"dependency" 	=> array(
							"element" 	=> "type",
							"value" 	=> "fontawesome",
						),
						"description" 	=> __( "Select icon from library.", "zozothemes" ),
						"group"			=> __( "Icon", "zozothemes" ),
					),				
					array(
						"type" 			=> 'iconpicker',
						"heading" 		=> __( "Icon", "zozothemes" ),
						"param_name" 	=> "icon_lineicons",
						"value" 		=> "",
						"settings" 		=> array(
							"emptyIcon" 	=> true,
							"type" 			=> 'simplelineicons',
							"iconsPerPage" 	=> 4000,
						),
						"dependency" 	=> array(
							"element" 	=> "type",
							"value" 	=> "lineicons",
						),
						"description" 	=> __( "Select icon from library.", "zozothemes" ),
						"group"			=> __( "Icon", "zozothemes" ),
					),
					array(
						"type" 			=> 'iconpicker',
						"heading" 		=> __( "Icon", "zozothemes" ),
						"param_name" 	=> "icon_flaticons",
						"value" 		=> "",
						"settings" 		=> array(
							"emptyIcon" 	=> true,
							"type" 			=> 'flaticons',
							"iconsPerPage" 	=> 4000,
						),
						"dependency" 	=> array(
							"element" 	=> "type",
							"value" 	=> "flaticons",
						),
						"description" 	=> __( "Select icon from library.", "zozothemes" ),
						"group"			=> __( "Icon", "zozothemes" ),
					),
					array(
						"type" 			=> 'iconpicker',
						"heading" 		=> __( "Icon", "zozothemes" ),
						"param_name" 	=> "icon_icomoonpack1",
						"value" 		=> "",
						"settings" 		=> array(
							"emptyIcon" 	=> true,
							"type" 			=> 'icomoonpack1',
							"iconsPerPage" 	=> 4000,
						),
						"dependency" 	=> array(
							"element" 	=> "type",
							"value" 	=> "icomoonpack1",
						),
						"description" 	=> __( "Select icon from library.", "zozothemes" ),
						"group"			=> __( "Icon", "zozothemes" ),
					),
					array(
						"type" 			=> 'iconpicker',
						"heading" 		=> __( "Icon", "zozothemes" ),
						"param_name" 	=> "icon_icomoonpack2",
						"value" 		=> "",
						"settings" 		=> array(
							"emptyIcon" 	=> true,
							"type" 			=> 'icomoonpack2',
							"iconsPerPage" 	=> 4000,
						),
						"dependency" 	=> array(
							"element" 	=> "type",
							"value" 	=> "icomoonpack2",
						),
						"description" 	=> __( "Select icon from library.", "zozothemes" ),
						"group"			=> __( "Icon", "zozothemes" ),
					),
					array(
						"type" 			=> 'iconpicker',
						"heading" 		=> __( "Icon", "zozothemes" ),
						"param_name" 	=> "icon_icomoonpack3",
						"value" 		=> "",
						"settings" 		=> array(
							"emptyIcon" 	=> true,
							"type" 			=> 'icomoonpack3',
							"iconsPerPage" 	=> 4000,
						),
						"dependency" 	=> array(
							"element" 	=> "type",
							"value" 	=> "icomoonpack3",
						),
						"description" 	=> __( "Select icon from library.", "zozothemes" ),
						"group"			=> __( "Icon", "zozothemes" ),
					),
					// Stylings
					array(
						"type"			=> 'colorpicker',
						"heading"		=> __( "Icon Color", "zozothemes" ),
						"param_name"	=> "icon_color",
						"group"			=> __( "Stylings", "zozothemes" ),
					),		
					array(
						"type"			=> 'colorpicker',
						"heading"		=> __( "Icon Background Color", "zozothemes" ),
						"param_name"	=> "icon_bg_color",
						"group"			=> __( "Stylings", "zozothemes" ),			
					),
					array(
						"type"			=> 'colorpicker',
						"heading"		=> __( "Icon Border Color", "zozothemes" ),
						"param_name"	=> "icon_border_color",
						"group"			=> __( "Stylings", "zozothemes" ),			
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Border Width", "zozothemes" ),
						"param_name"	=> "icon_border_width",
						"description" 	=> __( "Enter border width for icon. Ex: 2 or 3.", "zozothemes" ),
						"group"			=> __( "Stylings", "zozothemes" ),
					),
				)
			) 
		);
	}
}
add_action( 'vc_before_init', 'zozo_vc_icons_shortcode_map' );