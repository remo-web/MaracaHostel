<?php 
/**
 * Service Box shortcode
 */

if ( ! function_exists( 'zozo_vc_service_box_shortcode' ) ) {
	function zozo_vc_service_box_shortcode( $atts, $content = NULL ) {
		
		extract( 
			shortcode_atts( 
				array(
					'classes'				=> '',
					'css_animation'			=> '',
					'alignment'				=> 'center',
					'box_style'				=> 'circle',
					'type' 					=> '',
					'icon_flaticons' 		=> '',
					'icon_fontawesome' 		=> 'fa fa-minus-circle',
					'icon_lineicons' 		=> '',
					'icon_icomoonpack1' 	=> '',
					'icon_icomoonpack2' 	=> '',
					'icon_icomoonpack3' 	=> '',
					'ribbon_text' 			=> '',
					'title' 				=> '',
					'title_url' 			=> '',
					'icon_color'			=> '',
					'title_color' 			=> '',
					'ribbon_font_color'		=> '',
					'content_color'			=> '',
				), $atts 
			) 
		);

		$output = '';
		$extra_class = '';
		
		$icon_styles = '';
		if( $icon_color ) {
			$icon_styles = ' style="color:'. $icon_color .';"';
		}
		
		$title_styles = '';
		if( $title_color ) {			
			$title_styles = ' style="color:'. $title_color .';"';
		}
		
		$ribbon_styles = '';
		if( $ribbon_font_color ) {			
			$ribbon_styles = ' style="color:'. $ribbon_font_color .';"';
		}
		
		$content_styles = '';
		if( $content_color ) {
			$content_styles = ' style="color:'. $content_color .';"';
		}
		
		// Classes
		$main_classes = 'zozo-vc-service-box';
		
		if( isset( $classes ) && $classes != '' ) {
			$main_classes .= ' ' . $classes;
		}
		if( isset( $alignment ) && $alignment != '' ) {
			$main_classes .= ' text-' . $alignment;
		}
		if( isset( $box_style ) && $box_style != '' ) {		
			$main_classes .= ' service-box-'. $box_style;
		}
		$main_classes .= zozo_vc_animation( $css_animation );
		
		$output .= '<div class="'. esc_attr( $main_classes ) .'">';	
			$output .= '<div class="service-box-inner">';
				if( isset( $ribbon_text ) && $ribbon_text != '' ) {
					$output .= '<div class="service-ribbon-text"'.$ribbon_styles.'>'. $ribbon_text .'</div>';
				}
				$output .= '<div class="service-box-content">';
					// Icon
					if( isset( ${'icon_'. $type} ) && ${'icon_'. $type} != '' ) {
						$output .= '<i class="'. esc_attr( ${'icon_'. $type} ) .' service-icon"'.$icon_styles.'></i>';
					}
					// Title
					if( isset( $title ) && $title != '' ) {
						// Title URL
						$title_link = $link_title = $link_target = '';
						if( $title_url && $title_url != '' ) {
							$link = vc_build_link( $title_url );
							$title_link = isset( $link['url'] ) ? $link['url'] : '';
							$link_title = isset( $link['title'] ) ? $link['title'] : '';
							$link_target = isset( $link['target'] ) ? $link['target'] : '';
						}
						if( isset( $title_link ) && $title_link != '' ) {
							$output .= '<a href="'. esc_url( $title_link ) .'" title="'. esc_attr( $link_title ) .'" target="'. esc_attr( $link_target ) .'">';
						}
						$output .= '<h4 class="service-title"'.$title_styles.'>'. $title .'</h4>';
						if( isset( $title_link ) && $title_link != '' ) {
							$output .= '</a>';
						}
					}
					// Content
					$output .= '<div class="service-desc"'. $content_styles .'>';
						$output .= apply_filters( 'the_content', $content );
					$output .= '</div>';
					
				$output .= '</div>';
			$output .= '</div>';
		$output .= '</div>';
		
		return $output;
	}
}
add_shortcode( 'zozo_vc_service_box', 'zozo_vc_service_box_shortcode' );

if ( ! function_exists( 'zozo_vc_service_box_shortcode_map' ) ) {
	function zozo_vc_service_box_shortcode_map() {
		
		vc_map( 
			array(
				"name"					=> __( "Service Box", "zozothemes" ),
				"description"			=> __( "List your services with different style.", 'zozothemes' ),
				"base"					=> "zozo_vc_service_box",
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
						"param_name"	=> "alignment",
						"value"			=> array(
							__( "Default", "zozothemes" )	=> "center",
							__( "Center", "zozothemes" )	=> "center",
							__( "Left", "zozothemes" )		=> "left",
							__( "Right", "zozothemes" )		=> "right",
						),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Services Box Style", "zozothemes" ),
						"param_name"	=> "box_style",
						"value"			=> array(
							__( "Default", "zozothemes" )	=> "circle",
							__( "Circle", "zozothemes" )	=> "circle",
							__( "Rounded", "zozothemes" )	=> "rounded",
							__( "Square", "zozothemes" )	=> "square",
						),
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
					// Content
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Ribbon Text", "zozothemes" ),
						"param_name"	=> "ribbon_text",
						"value"			=> "",
						"group"			=> __( "Content", "zozothemes" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Heading", "zozothemes" ),
						"param_name"	=> "title",
						"value"			=> "Sample Heading",
						"group"			=> __( "Content", "zozothemes" ),
					),
					array(
						"type"			=> "vc_link",
						"heading"		=> __( "Heading URL", "zozothemes" ),
						"param_name"	=> "title_url",
						"value"			=> "",
						"group"			=> __( "Content", "zozothemes" ),
					),
					array(
						"type"			=> "textarea_html",
						"holder"		=> "div",
						"heading"		=> __( "Content", "zozothemes" ),
						"param_name"	=> "content",
						"value"			=> __( 'I am text block. Please change this dummy text in your page editor for this service box.', "zozothemes" ),
						"group"			=> __( "Content", "zozothemes" ),
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
						"heading"		=> __( "Title Color", "zozothemes" ),
						"param_name"	=> "title_color",
						"group"			=> __( "Stylings", "zozothemes" ),			
					),
					array(
						"type"			=> 'colorpicker',
						"heading"		=> __( "Ribbon Font Color", "zozothemes" ),
						"param_name"	=> "ribbon_font_color",
						"group"			=> __( "Stylings", "zozothemes" ),			
					),
					array(
						"type"			=> 'colorpicker',
						"heading"		=> __( "Content Color", "zozothemes" ),
						"param_name"	=> "content_color",
						"group"			=> __( "Stylings", "zozothemes" ),			
					),
				)
			) 
		);
	}
}
add_action( 'vc_before_init', 'zozo_vc_service_box_shortcode_map' );