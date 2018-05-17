<?php 
/**
 * List Item shortcode
 */

if ( ! function_exists( 'zozo_vc_list_item_shortcode' ) ) {
	function zozo_vc_list_item_shortcode( $atts, $content = NULL ) {
		
		$atts = vc_map_get_attributes( 'zozo_vc_list_item', $atts );
		extract( $atts );

		$output = '';
		$extra_class = '';

		// Icon style		
		$icon_style = '';
		if( $icon_color ) {
			$icon_style .= 'color:'. $icon_color .';';
		}
		if( $icon_size ) {
			$icon_style .= 'font-size:'. $icon_size .';';
		}		
		if( $icon_style ) {
			$icon_style = ' style="'. $icon_style  .'"';
		}		
		
		// Content						
		if( isset( $content ) && $content != '' ) {
			$content_style = '';
			if ( $content_size ) {
				$content_style .= 'font-size:'. $content_size.';';
			}
			if ( $content_color ) {
				$content_style .= 'color:'. $content_color.';';
			}
			if( isset( $icon_align ) && ( $icon_align == "default" || $icon_align == "left" ) ) {
				if ( $icon_spacing ) {
					$content_style .= 'margin-left:'. $icon_spacing.';';
				}
			} else if( isset( $icon_align ) && $icon_align == 'right' ) {
				if ( $icon_spacing ) {
					$content_style .= 'margin-right:'. $icon_spacing.';';
				}
			}
			if ( $content_style ) {
				$content_style = ' style="'. $content_style .'"';
			}
			
		}
		
		// Classes
		$main_classes = 'zozo-features-list-wrapper vc-features-list';
		
		if( isset( $classes ) && $classes != '' ) {
			$main_classes .= ' ' . $classes;
		}
		$main_classes .= zozo_vc_animation( $css_animation );
		
		$output .= '<div class="'. esc_attr( $main_classes ) .'">';
			$output .= '<div class="features-list">';
				
				$output .= '<div class="features-list-inner list-text-'.$icon_align.'">';
					// Icon
					$output .= '<div class="features-icon'.$extra_class.'">';
						if( isset( ${'icon_'. $type} ) && ${'icon_'. $type} != '' ) {								
							$output .= '<i class="'. esc_attr( ${'icon_'. $type} ) .' list-icon"'.$icon_style.'></i>';
						}
					$output .= '</div>';
					
					// Content						
					if( isset( $content ) && $content != '' ) {
						$output .= '<div class="list-desc"'. $content_style .'>';
							$output .= wpb_js_remove_wpautop( $content, true );
						$output .= '</div>';
					}				
				$output .= '</div>';
	
			$output .= '</div>';
		$output .= '</div>';
		
		return $output;
	}
}
add_shortcode( 'zozo_vc_list_item', 'zozo_vc_list_item_shortcode' );

if ( ! function_exists( 'zozo_vc_list_item_shortcode_map' ) ) {
	function zozo_vc_list_item_shortcode_map() {
		
		vc_map( 
			array(
				"name"					=> __( "List Item", "zozothemes" ),
				"description"			=> __( "List your items with Icons.", 'zozothemes' ),
				"base"					=> "zozo_vc_list_item",
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
						"type"			=> "textarea_html",
						"holder"		=> "div",
						"heading"		=> __( "Content", "zozothemes" ),
						"param_name"	=> "content",
						"value"			=> __( 'I am text block. Please change this dummy text in your page editor for this list item section.', "zozothemes" ),						
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Content Font Size", "zozothemes" ),
						"description" 	=> __( "Enter Font Size in px. Ex: 20px", "zozothemes" ),
						"param_name"	=> "content_size",						
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> __( "Content Text Color", "zozothemes" ),
						"param_name"	=> "content_color",						
					),
					// Icon
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Alignment", "zozothemes" ),
						"param_name"	=> "icon_align",
						"value"			=> array(
							__( "Default", "zozothemes" )	=> "default",
							__( "Left", "zozothemes" )		=> "left",
							__( "Right", "zozothemes" )		=> "right",
						),
						"group"			=> __( "Icon", "zozothemes" ),
					),
					array(
						"type" 			=> "dropdown",
						"heading" 		=> __( "Choose from Icon library", "zozothemes" ),
						"value" 		=> array(
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
					array(
						"type"			=> 'colorpicker',
						"heading"		=> __( "Icon Color", "zozothemes" ),
						"param_name"	=> "icon_color",
						"group"			=> __( "Icon", "zozothemes" ),
					),		
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Icon Font Size", "zozothemes" ),
						"param_name"	=> "icon_size",
						"description" 	=> __( "Enter Icon Size in px. Ex: 15px", "zozothemes" ),
						"group"			=> __( "Icon", "zozothemes" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Icon Spacing", "zozothemes" ),
						"param_name"	=> "icon_spacing",
						"description" 	=> __( "Enter Icon Right Spacing in px. Ex: 30px", "zozothemes" ),
						"group"			=> __( "Icon", "zozothemes" ),			
					),
				)
			) 
		);
	}
}
add_action( 'vc_before_init', 'zozo_vc_list_item_shortcode_map' );