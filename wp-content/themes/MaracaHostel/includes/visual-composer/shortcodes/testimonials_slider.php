<?php 
/**
 * Testimonials Slider shortcode
 */

if ( ! function_exists( 'zozo_vc_testimonials_slider_shortcode' ) ) {
	function zozo_vc_testimonials_slider_shortcode( $atts, $content = NULL ) {
		
		$atts = vc_map_get_attributes( 'zozo_vc_testimonials_slider', $atts );
		extract( $atts );

		$output = '';
		global $post;
		static $testimonials_id = 1;
				
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
		
		// Classes
		$main_classes = '';
		$main_classes .= zozo_vc_animation( $css_animation );
		
		if( isset( $classes ) && $classes != '' ) {
			$main_classes .= ' ' . $classes;
		}
		
		$query_args = array(
						'post_type' 		=> 'zozo_testimonial',
						'posts_per_page' 	=> -1,
						'orderby' 		 	=> 'date',
						'order' 		 	=> 'DESC',
					  );
					  
		if( $categories_id != 'all' ) {
			$query_args['tax_query'] 	= array(
											array(
												'taxonomy' 	=> 'testimonial_categories',
												'field' 	=> 'slug',
												'terms' 	=> $categories_id
											) );
		
		}
		
		$testimonial_query = new WP_Query( $query_args );
		
		//if( $testimonial_query->have_posts() ) {
			$output = '<div class="zozo-testimonial-slider-wrapper'.$main_classes.'">';
			$output .= '<div id="zozo-testimonial-slider'.$testimonials_id.'" class="zozo-owl-carousel owl-carousel testimonial-carousel-slider"'.$data_attr.'>';
			
				while ($testimonial_query->have_posts()) : $testimonial_query->the_post();
					$testi_img 			= wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'blog-thumb');
					$author_designation = get_post_meta( $post->ID, 'zozo_author_designation', true );
					$author_company 	= get_post_meta( $post->ID, 'zozo_author_company_name', true );
					$author_company_url = get_post_meta( $post->ID, 'zozo_author_company_url', true );
					$author_rating 		= get_post_meta( $post->ID, 'zozo_author_rating', true );
					
					$output .= '<div class="testimonial-item tstyle-'.$style.'">';
					
						if( isset( $style ) && $style == 'border2' ) {
							if( isset( $testi_img ) && $testi_img != '' ) {
								$output .= '<div class="testimonial-img">';
								$output .= '<img src="'.esc_url($testi_img[0]).'" width="'.esc_attr($testi_img[1]).'" height="'.esc_attr($testi_img[2]).'" alt="'.get_the_title().'" class="img-responsive img-circle" />';
								$output .= '</div>';
							}
						}
						
						$output .= '<div class="testimonial-content">';
							if( isset( $testi_desc_type ) && $testi_desc_type == 'full_content' ) {
								$output .= '<blockquote>'. get_the_content() .'</blockquote>';
							} elseif( isset( $testi_desc_type ) && $testi_desc_type == 'excerpt' ) {
								$output .= '<blockquote><p>'. zozo_shortcode_stripped_excerpt( get_the_content(), $excerpt_limit ) .'</p></blockquote>';
							}
							
							if( isset( $author_rating ) && $author_rating != '' ) {
								$output .= '<div class="testimonial-rating">';	
									$output .= '<div class="rateit" data-rateit-value="'.$author_rating.'" data-rateit-ispreset="true" data-rateit-readonly="true"></div>';
								$output .= '</div>';
							}
						$output .= '</div>';
						
						$output .= '<div class="author-info-box">';
							if( isset( $style ) && $style != 'border2' ) {
								if( isset( $testi_img ) && $testi_img != '' ) {
									$output .= '<div class="testimonial-img">';
									$output .= '<img src="'.esc_url($testi_img[0]).'" width="'.esc_attr($testi_img[1]).'" height="'.esc_attr($testi_img[2]).'" alt="'.get_the_title().'" class="img-responsive" />';
									$output .= '</div>';
								}
							}
						
							$output .= '<div class="author-details">';
								$output .= '<p><span class="testimonial-author-name"><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></span></p>';
								$output .= '<p class="author-designation-info">';
									if( isset( $author_designation ) && $author_designation != '' ) {
										$output .= '<span class="testimonial-author-designation">'.$author_designation.'</span>';
									}
									if( isset( $author_company ) && $author_company != '' ) {
										if( isset( $author_company_url ) && $author_company_url != '' ) {
											$output .= '<span class="testimonial-author-company"><a href="'.esc_url( $author_company_url ).'" target="_blank">'.$author_company.'</a></span>';
										} else {
											$output .= '<span class="testimonial-author-company">'.$author_company.'</span>';
										}
									}
								$output .= '</p>';
							$output .= '</div>';
						$output .= '</div>';
							
					$output .= '</div>';
					
				endwhile;
				
			$output .= '</div>';
			$output .= '</div>';
		//}
		
		$testimonials_id++;
		wp_reset_postdata();
		
		return $output;
	}
}
add_shortcode( 'zozo_vc_testimonials_slider', 'zozo_vc_testimonials_slider_shortcode' );

if ( ! function_exists( 'zozo_vc_testimonials_slider_shortcode_map' ) ) {
	function zozo_vc_testimonials_slider_shortcode_map() {
				
		vc_map( 
			array(
				"name"					=> __( "Testimonials Slider", "zozothemes" ),
				"description"			=> __( "Show your testimonials in Slider.", 'zozothemes' ),
				"base"					=> "zozo_vc_testimonials_slider",
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
						"type"			=> 'dropdown',
						"admin_label" 	=> true,
						"heading"		=> __( "Testimonial Style", "zozothemes" ),
						"param_name"	=> "style",
						"value"			=> array(
							__( 'Default Style', 'zozothemes' ) 	=> "default",
							__( 'Border Style', 'zozothemes' ) 		=> "border",
							__( 'Border Style 2', 'zozothemes' ) 	=> "border2",
							__( 'Without Border', 'zozothemes' ) 	=> "no-border" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Testimonial Description Type", "zozothemes" ),
						"param_name"	=> "testi_desc_type",
						"value"			=> array(
							__( "Excerpt", "zozothemes" )			=> "excerpt",
							__( "Full Content", "zozothemes" )		=> "full_content" ),
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> __( 'Excerpt Limit', 'zozothemes' ),
						'param_name'	=> "excerpt_limit",
						'value'			=> "35",
						'dependency'	=> array(
							'element'	=> "testi_desc_type",
							'value'		=> 'excerpt'
						),
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
add_action( 'vc_before_init', 'zozo_vc_testimonials_slider_shortcode_map' );