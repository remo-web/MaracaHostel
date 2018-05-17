<?php 
/**
 * Clients Slider shortcode
 */

if ( ! function_exists( 'zozo_vc_clients_slider_shortcode' ) ) {
	function zozo_vc_clients_slider_shortcode( $atts, $content = NULL ) {
		
		extract( 
			shortcode_atts( 
				array(
					'classes'					=> '',
					'css_animation'				=> '',
					'images' 					=> '',
					'custom_links' 				=> '',
					'link_target' 				=> '',
					'show_slider' 				=> 'yes',
					'columns' 					=> '2',
					'items'						=> '5',
					'items_scroll' 				=> '1',
					'auto_play' 				=> 'true',					
					'timeout_duration' 			=> '5000',
					'infinite_loop' 			=> 'false',
					'margin' 					=> '0',
					'items_tablet'				=> '3',
					'items_mobile_landscape'	=> '2',
					'items_mobile_portrait'		=> '1',
					'navigation' 				=> 'true',
					'pagination' 				=> 'true',
				), $atts 
			) 
		);

		$output = '';
		static $clients_id = 1;
				
		// Slider Configuration
		$data_attr = '';
		
		if( isset( $show_slider ) && $show_slider == "yes" ) {
			if( isset( $items ) && $items != '' ) {
				$data_attr .= ' data-items="' . $items . '" ';
			}
			
			if( isset( $items_scroll ) && $items_scroll != '' ) {
				$data_attr .= ' data-slideby="' . $items_scroll . '" ';
			}
			
			if( isset( $items_tablet ) && $items_tablet != '' ) {
				$data_attr .= ' data-items-tablet="' . $items_tablet . '" ';
			}
			
			if( isset( $items_mobile_landscape ) && $items_mobile_landscape != '' ) {
				$data_attr .= ' data-items-mobile-landscape="' . $items_mobile_landscape . '" ';
			}
			
			if( isset( $items_mobile_portrait ) && $items_mobile_portrait != '' ) {
				$data_attr .= ' data-items-mobile-portrait="' . $items_mobile_portrait . '" ';
			}
		
			if( isset( $auto_play ) && $auto_play != '' ) {
				$data_attr .= ' data-autoplay="' . $auto_play . '" ';
			}
			if( isset( $timeout_duration ) && $timeout_duration != '' ) {
				$data_attr .= ' data-autoplay-timeout="' . $timeout_duration . '" ';
			}
			
			if( isset( $items ) && $items == 1 ) {
				$data_attr .= ' data-loop="false" ';
			} else {
				if( isset( $infinite_loop ) && $infinite_loop != '' ) {
					$data_attr .= ' data-loop="' . $infinite_loop . '" ';
				}
			}
			
			if( isset( $margin ) && $margin != '' ) {
				$data_attr .= ' data-margin="' . $margin . '" ';
			}
		
			if( isset( $pagination ) && $pagination != '' ) {
				$data_attr .= ' data-pagination="' . $pagination . '" ';
			}
			if( isset( $navigation ) && $navigation != '' ) {
				$data_attr .= ' data-navigation="' . $navigation . '" ';
			}
		}
		
		// Classes
		$main_classes = '';
		$column_class = '';
		$main_classes .= zozo_vc_animation( $css_animation );
		if( isset( $show_slider ) && $show_slider == "no" ) {
			$main_classes .= ' client-columns-'.$columns.'';
		
			if( isset( $columns ) && $columns != '' ) {
				if( isset( $columns ) && $columns == '2' ) {
					$column_class = ' col-md-6 col-sm-6 col-xs-12';
				} else if( isset( $columns ) && $columns == '3' ) {
					$column_class = ' col-md-4 col-sm-4 col-xs-12';
				} else if( isset( $columns ) && $columns == '4' ) {
					$column_class = ' col-md-3 col-sm-4 col-xs-12';
				} else if( isset( $columns ) && $columns == '6' ) {
					$column_class = ' col-md-2 col-sm-4 col-xs-12';
				}
			} else {
				$column_class = ' col-md-6 col-sm-6 col-xs-12';
			}
		}
		
		// Clients link
		$client_links = explode( ",", $custom_links );
		$images = explode( ',', $images );
		$i = -1;
		$client_images = '';
		
		foreach ( $images as $attach_id ) {
			$i++;
			
			$post_thumbnail = wpb_getImageBySize( array( 'attach_id' => $attach_id, 'thumb_size' => 'full' ) );
			$thumbnail = $post_thumbnail['thumbnail'];
			
			$link_start = $link_end = '';
		
			if( isset( $client_links[$i] ) && $client_links[$i] != '' ) {
				$link_start = '<a href="' . $client_links[$i] . '"' . ( ! empty( $link_target ) ? ' target="' . $link_target . '"' : '' ) . '>';
				$link_end = '</a>';
			}
			$client_images .= '<div class="client-item'. $column_class .'">' . $link_start . $thumbnail . $link_end . '</div>';
		}
		
		$extra_margin_class = "";
		if( $i > $columns ) {
			$extra_margin_class = " client-grid-spacer";
		}
		
		// Main Wrapper
		$output = '<div class="zozo-client-slider-wrapper'.$main_classes.'">';
		if( isset( $show_slider ) && $show_slider == "yes" ) {
			$output .= '<div id="zozo-client-slider-' . $clients_id. '" class="zozo-owl-carousel zozo-client-slider owl-carousel"' . $data_attr . '>';
		} else {		
			$output .= '<div id="zozo-client-grid-' . $clients_id. '" class="zozo-client-grid'.$extra_margin_class.'">';
		}
			$output .= $client_images;
		$output .= '</div>';
		$output .= '</div>'; // .zozo-client-slider-wrapper
		
		$clients_id++;
		
		return $output;
	}
}
add_shortcode( 'zozo_vc_clients_slider', 'zozo_vc_clients_slider_shortcode' );

if ( ! function_exists( 'zozo_vc_clients_slider_shortcode_map' ) ) {
	function zozo_vc_clients_slider_shortcode_map() {
		
		vc_map( 
			array(
				"name"					=> __( "Clients Slider", "zozothemes" ),
				"description"			=> __( "Clients/Brands Images Carousel Slider.", 'zozothemes' ),
				"base"					=> "zozo_vc_clients_slider",
				"category"				=> __( "Theme Addons", "zozothemes" ),
				"icon"					=> "zozo-vc-icon",
				"params"				=> array(
					array(
						'type'			=> 'textfield',
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
						"type" 			=> 'attach_images',
						"heading" 		=> __( "Client/Brand Images", "zozothemes" ),
						"param_name"	=> "images",
						"admin_label" 	=> true,
						"value" 		=> '',
						"description" 	=> __( "Select images from media library.", "zozothemes" )
					),					
					array(
						"type"			=> 'exploded_textarea',
						"heading"		=> __( "Custom Links", "zozothemes" ),
						"param_name"	=> "custom_links",
						"value" 		=> 'http://customlink.com,http://customlink.com',
						"description" 	=> __( "Enter links for each image here. Divide links with linebreaks (Enter).", "zozothemes" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Link Target", "zozothemes" ),
						"param_name"	=> "link_target",
						"value"			=> array(
							__( 'Same window', 'zozothemes' ) 	=> "_self",
							__( 'New window', 'zozothemes' ) 	=> "_blank" ),
					),
					// Slider
					array(
						'type'			=> 'dropdown',
						'heading'		=> __( "Show as Slider", 'zozothemes' ),
						'param_name'	=> "show_slider",
						'value'			=> array(
							__( 'Yes', 'zozothemes' )	=> 'yes',
							__( 'No', 'zozothemes' )	=> 'no',
						),
						"group"			=> __( "Slider", "zozothemes" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Columns", "zozothemes" ),
						"param_name"	=> "columns",
						'dependency' 	=> array(
							'element' 	=> 'show_slider',
							'value' 	=> 'no',
						),				
						"value"			=> array(
							__( "Two Columns", "zozothemes" )		=> "2",
							__( "Three Columns", "zozothemes" )		=> "3",
							__( "Four Columns", "zozothemes" )		=> "4",
							__( "Six Columns", "zozothemes" )		=> "6", ),
						"group"			=> __( "Slider", "zozothemes" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Items to Display", "zozothemes" ),
						"param_name"	=> "items",
						"admin_label" 	=> true,
						'dependency' 	=> array(
							'element' 	=> 'show_slider',
							'value' 	=> 'yes',
						),
						"group"			=> __( "Slider", "zozothemes" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Items to Scrollby", "zozothemes" ),
						"param_name"	=> "items_scroll",
						'dependency' 	=> array(
							'element' 	=> 'show_slider',
							'value' 	=> 'yes',
						),
						"group"			=> __( "Slider", "zozothemes" ),
					),
					array(
						'type'			=> 'dropdown',
						'heading'		=> __( "Auto Play", 'zozothemes' ),
						'param_name'	=> "auto_play",
						"admin_label" 	=> true,
						'value'			=> array(
							__( 'True', 'zozothemes' )	=> 'true',
							__( 'False', 'zozothemes' )	=> 'false',
						),
						'dependency' 	=> array(
							'element' 	=> 'show_slider',
							'value' 	=> 'yes',
						),
						"group"			=> __( "Slider", "zozothemes" ),
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> __( 'Timeout Duration (in milliseconds)', 'zozothemes' ),
						'param_name'	=> "timeout_duration",
						'value'			=> "5000",
						'dependency'	=> array(
							'element'	=> "auto_play",
							'value'		=> 'true'
						),
						"group"			=> __( "Slider", "zozothemes" ),
					),
					array(
						'type'			=> 'dropdown',
						'heading'		=> __( "Infinite Loop", 'zozothemes' ),
						'param_name'	=> "infinite_loop",
						'value'			=> array(
							__( 'False', 'zozothemes' )	=> 'false',
							__( 'True', 'zozothemes' )	=> 'true',
						),
						'dependency' 	=> array(
							'element' 	=> 'show_slider',
							'value' 	=> 'yes',
						),
						"group"			=> __( "Slider", "zozothemes" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Margin ( Items Spacing )", "zozothemes" ),
						"param_name"	=> "margin",
						'admin_label'	=> true,
						'dependency' 	=> array(
							'element' 	=> 'show_slider',
							'value' 	=> 'yes',
						),
						"group"			=> __( "Slider", "zozothemes" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Items To Display in Tablet", "zozothemes" ),
						"param_name"	=> "items_tablet",
						'dependency' 	=> array(
							'element' 	=> 'show_slider',
							'value' 	=> 'yes',
						),
						"group"			=> __( "Slider", "zozothemes" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Items To Display In Mobile Landscape", "zozothemes" ),
						"param_name"	=> "items_mobile_landscape",
						'dependency' 	=> array(
							'element' 	=> 'show_slider',
							'value' 	=> 'yes',
						),
						"group"			=> __( "Slider", "zozothemes" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Items To Display In Mobile Portrait", "zozothemes" ),
						"param_name"	=> "items_mobile_portrait",
						'dependency' 	=> array(
							'element' 	=> 'show_slider',
							'value' 	=> 'yes',
						),
						"group"			=> __( "Slider", "zozothemes" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Navigation", "zozothemes" ),
						"param_name"	=> "navigation",
						"value"			=> array(
							__( "Yes", "zozothemes" )	=> "true",
							__( "No", "zozothemes" )	=> "false" ),
						'dependency' 	=> array(
							'element' 	=> 'show_slider',
							'value' 	=> 'yes',
						),
						"group"			=> __( "Slider", "zozothemes" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Pagination", "zozothemes" ),
						"param_name"	=> "pagination",
						"value"			=> array(
							__( "Yes", "zozothemes" )	=> "true",
							__( "No", "zozothemes" )	=> "false" ),
						'dependency' 	=> array(
							'element' 	=> 'show_slider',
							'value' 	=> 'yes',
						),
						"group"			=> __( "Slider", "zozothemes" ),
					),
				)
			) 
		);
	}
}
add_action( 'vc_before_init', 'zozo_vc_clients_slider_shortcode_map' );