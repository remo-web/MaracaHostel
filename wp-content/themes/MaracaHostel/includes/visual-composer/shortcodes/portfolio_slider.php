<?php 
/**
 * Portfolio Slider shortcode
 */

if ( ! function_exists( 'zozo_vc_portfolio_slider_shortcode' ) ) {
	function zozo_vc_portfolio_slider_shortcode( $atts, $content = NULL ) {
		
		extract( 
			shortcode_atts( 
				array(
					'classes'					=> '',
					'css_animation'				=> '',
					'include_categories' 		=> '',
					'exclude_categories' 		=> '',
					'items'						=> '3',
					'items_scroll' 				=> '1',
					'auto_play' 				=> 'true',					
					'timeout_duration' 			=> '5000',
					'infinite_loop' 			=> '',
					'margin' 					=> '30',
					'items_tablet'				=> '2',
					'items_mobile_landscape'	=> '1',
					'items_mobile_portrait'		=> '1',
					'navigation' 				=> 'true',
					'pagination' 				=> 'true',
				), $atts 
			) 
		);

		$output = '';
		static $portfolio_id = 1;
		global $post;
				
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
		
		if( isset( $items ) && $items == "1" ) {
			$image_size = 'full';
		} else {
			$image_size = 'portfolio-mid';
		}	
		
		// Classes
		$main_classes = '';
		$main_classes .= zozo_vc_animation( $css_animation );
		
		// Include categories
		$include_categories = ( '' != $include_categories ) ? $include_categories : '';
		$include_categories = ( 'all' == $include_categories ) ? '' : $include_categories;
		if( $include_categories ) {
			$include_categories = explode( ',', $include_categories );				
			if ( ! empty( $include_categories ) && is_array( $include_categories ) ) {
				$include_categories = array(
					'taxonomy'	=> 'portfolio_categories',
					'field'		=> 'slug',
					'terms'		=> $include_categories,
					'operator'	=> 'IN',
				);
			} else {
				$include_categories = '';
			}
		}
		
		// Exclude categories
		if( $exclude_categories ) {
			$exclude_categories = explode( ',', $exclude_categories );
			if ( ! empty( $exclude_categories ) && is_array( $exclude_categories ) ) {				
				$exclude_categories = array(
						'taxonomy'	=> 'portfolio_categories',
						'field'		=> 'slug',
						'terms'		=> $exclude_categories,
						'operator'	=> 'NOT IN',
					);
			} else {
				$exclude_categories = '';
			}
		}
		
		$query_args = array(
						'post_type' 		=> 'zozo_portfolio',
						'posts_per_page' 	=> -1,
						'orderby' 		 	=> 'date',
						'order' 		 	=> 'DESC',
					  );
					  
		$query_args['tax_query'] = array(
										'relation'	=> 'AND',
										$include_categories,
										$exclude_categories );
		
		$portfolio_slider_query = new WP_Query( $query_args );
		
		if( $portfolio_slider_query->have_posts() ) {
			$output = '<div class="zozo-portfolio-slider-wrapper'.$main_classes.'">';
			$output .= '<div id="zozo-portfolio-slider'.$portfolio_id.'" class="zozo-owl-carousel owl-carousel portfolio-carousel-slider"'.$data_attr.'>';
			
				while ($portfolio_slider_query->have_posts()) : $portfolio_slider_query->the_post();
					$portfolio_img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $image_size);
					
					$output .= '<div id="portfolio-'.get_the_ID().'" class="portfolio-item portfolio-slider-item">';
					$output .= '<div class="portfolio-content">';
						$output .= '<img class="img-responsive" src="'.esc_url($portfolio_img[0]).'" width="'.esc_attr($portfolio_img[1]).'" height="'.esc_attr($portfolio_img[2]).'" alt="'.get_the_title().'" />';
						$output .= '<div class="portfolio-overlay">';
							$output .= '<div class="portfolio-mask">';
							
							$portfolio_large = ''; 
							$portfolio_large = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
							
							$output .= '<div class="portfolio-title">';
								$output .= '<h4>'.get_the_title().'</h4>';
								$output .= '<p>' . zozo_shortcode_stripped_excerpt( get_the_content(), 8 ) . '</p>';
							$output .= '</div>';
							$output .= '<a href="'.esc_url( $portfolio_large[0] ).'" data-rel="prettyPhoto[gallery'.$portfolio_id.']" title="'.get_the_title().'"><i class="fa fa-search"></i></a>';
							$output .= '<a href="'. get_permalink() .'" title="'.get_the_title().'"><i class="fa fa-link"></i></a>';
							$output .= '</div>';
						$output .= '</div>';
						
					$output .= '</div>';
					$output .= '</div>';
					
				endwhile;
				
			$output .= '</div>';
			$output .= '</div>';
		}
		
		$portfolio_id++;
		wp_reset_postdata();
		
		return $output;
	}
}
add_shortcode( 'zozo_vc_portfolio_slider', 'zozo_vc_portfolio_slider_shortcode' );

if ( ! function_exists( 'zozo_vc_portfolio_slider_shortcode_map' ) ) {
	function zozo_vc_portfolio_slider_shortcode_map() {
				
		vc_map( 
			array(
				"name"					=> __( "Portfolio Slider", "zozothemes" ),
				"description"			=> __( "Show your works in Slider.", 'zozothemes' ),
				"base"					=> "zozo_vc_portfolio_slider",
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
						'type'			=> 'textfield',
						'heading'		=> __( 'Include Categories', 'zozothemes' ),
						'param_name'	=> 'include_categories',
						'admin_label'	=> true,
						'description'	=> __('Enter the slugs of a categories (comma seperated) to pull posts from or enter "all" to pull recent posts from all categories. Example: category-1, category-2.','zozothemes'),
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> __( 'Exclude Categories', 'zozothemes' ),
						'param_name'	=> 'exclude_categories',
						'admin_label'	=> true,
						'description'	=> __('Enter the slugs of a categories (comma seperated) to exclude. Example: category-1, category-2.','zozothemes'),
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
				)
			) 
		);
	}
}
add_action( 'vc_before_init', 'zozo_vc_portfolio_slider_shortcode_map' );