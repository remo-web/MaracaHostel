<?php 
/**
 * Content Carousel Slider shortcode
 */

if ( ! function_exists( 'zozo_vc_content_carousel_shortcode' ) ) {
	function zozo_vc_content_carousel_shortcode( $atts, $content = NULL ) {
		
		extract( 
			shortcode_atts( 
				array(
					'classes'					=> '',
					'css_animation'				=> '',
					'items'						=> '1',
					'items_scroll' 				=> '1',
					'auto_play'					=> 'true',
					'timeout_duration'			=> '5000',
					'infinite_loop' 			=> 'false',
					'margin' 					=> '0',
					'items_tablet'				=> '1',
					'items_mobile_landscape'	=> '1',
					'items_mobile_portrait'		=> '1',
					'navigation' 				=> 'true',
					'pagination' 				=> 'true',
				), $atts 
			) 
		);

		$output = '';
		static $carousel_id = 1;
		
		// Slider Configuration
		$data_attr = '';
		
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
		
		if( isset( $margin ) && $margin != '' ) {
			$data_attr .= ' data-margin="' . $margin . '" ';
		}
		
		if( isset( $auto_play ) && $auto_play != '' ) {
			$data_attr .= ' data-autoplay="' . $auto_play . '" ';
		}
		if( isset( $timeout_duration ) && $timeout_duration != '' ) {
			$data_attr .= ' data-autoplay-timeout="' . $timeout_duration . '" ';
		}
		
		if( isset( $infinite_loop ) && $infinite_loop != '' ) {
			$data_attr .= ' data-loop="' . $infinite_loop . '" ';
		}
		
		if( isset( $pagination ) && $pagination != '' ) {
			$data_attr .= ' data-pagination="' . $pagination . '" ';
		}
		if( isset( $navigation ) && $navigation != '' ) {
			$data_attr .= ' data-navigation="' . $navigation . '" ';
		}
		
		// Classes
		$main_classes = '';
		$main_classes .= zozo_vc_animation( $css_animation );		
		
		$output = '<div class="zozo-content-carousel-wrapper'.$main_classes.'">';
		$output .= '<div id="zozo-content-carousel'.$carousel_id.'" class="zozo-owl-carousel owl-carousel content-carousel-slider"'.$data_attr.'>';
			$output .= do_shortcode( wpb_js_remove_wpautop( $content, true ) );
		$output .= '</div>';
		$output .= '</div>';
		
		$carousel_id++;
		
		return $output;
	}
}
add_shortcode( 'zozo_vc_content_carousel', 'zozo_vc_content_carousel_shortcode' );

if ( ! function_exists( 'zozo_vc_content_carousel_shortcode_map' ) ) {
	function zozo_vc_content_carousel_shortcode_map() {
		
		vc_map( 
			array(
				"name"					=> __( "Content Carousel", "zozothemes" ),
				"description"			=> __( "Show your contents in carousel slider.", 'zozothemes' ),
				"base"					=> "zozo_vc_content_carousel",
				"as_parent" 			=> array( 'only' => 'vc_row' ),
				"js_view" 				=> 'VcColumnView',
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
					// Slider
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Items to Display", "zozothemes" ),
						"param_name"	=> "items",
						'admin_label'	=> true,
						"group"			=> __( "Slider", "zozothemes" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Items to Scrollby", "zozothemes" ),
						"param_name"	=> "items_scroll",
						"group"			=> __( "Slider", "zozothemes" ),
					),
					array(
						'type'			=> 'dropdown',
						'heading'		=> __( "Auto Play", 'zozothemes' ),
						'param_name'	=> "auto_play",
						'admin_label'	=> true,
						'value'			=> array(
							__( 'True', 'zozothemes' )	=> 'true',
							__( 'False', 'zozothemes' )	=> 'false',
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
						"group"			=> __( "Slider", "zozothemes" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Margin ( Items Spacing )", "zozothemes" ),
						"param_name"	=> "margin",
						'admin_label'	=> true,
						"group"			=> __( "Slider", "zozothemes" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Items To Display in Tablet", "zozothemes" ),
						"param_name"	=> "items_tablet",
						"group"			=> __( "Slider", "zozothemes" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Items To Display In Mobile Landscape", "zozothemes" ),
						"param_name"	=> "items_mobile_landscape",
						"group"			=> __( "Slider", "zozothemes" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Items To Display In Mobile Portrait", "zozothemes" ),
						"param_name"	=> "items_mobile_portrait",
						"group"			=> __( "Slider", "zozothemes" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Navigation", "zozothemes" ),
						"param_name"	=> "navigation",
						"value"			=> array(
							__( "Yes", "zozothemes" )	=> "true",
							__( "No", "zozothemes" )	=> "false" ),
						"group"			=> __( "Slider", "zozothemes" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Pagination", "zozothemes" ),
						"param_name"	=> "pagination",
						"value"			=> array(
							__( "Yes", "zozothemes" )	=> "true",
							__( "No", "zozothemes" )	=> "false" ),
						"group"			=> __( "Slider", "zozothemes" ),
					),
				),
				'default_content' => '[vc_row_inner][vc_column_inner width="1/1"][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner width="1/1"][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner width="1/1"][/vc_column_inner][/vc_row_inner]',
			) 
		);
	}
}
add_action( 'vc_before_init', 'zozo_vc_content_carousel_shortcode_map' );

/**
 * We need to define this so that VC will show our nesting container correctly
 */
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Zozo_Vc_Content_Carousel extends WPBakeryShortCodesContainer {
    }
}