<?php 
/**
 * Latest Posts shortcode
 */

if ( ! function_exists( 'zozo_vc_latest_posts_shortcode' ) ) {
	function zozo_vc_latest_posts_shortcode( $atts, $content = NULL ) { 
		
		extract( 
			shortcode_atts( 
				array(
					'classes'				=> '',
					'css_animation'			=> '',
					'posts'					=> '3',
					'include_categories' 	=> 'all',
					'exclude_categories' 	=> '',
					'blog_style' 			=> 'default',
					'read_more' 			=> 'no',
				), $atts 
			) 
		);

		$output = '';
		global $post, $zozo_options;
		
		// Include categories
		$include_categories = ( '' != $include_categories ) ? $include_categories : '';
		$include_categories = ( 'all' == $include_categories ) ? '' : $include_categories;
		if( $include_categories ) {
			$include_categories = explode( ',', $include_categories );
			if ( ! empty( $include_categories ) && is_array( $include_categories ) ) {
				$include_categories = array(
					'taxonomy'	=> 'category',
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
						'taxonomy'	=> 'category',
						'field'		=> 'slug',
						'terms'		=> $exclude_categories,
						'operator'	=> 'NOT IN',
					);
			} else {
				$exclude_categories = '';
			}
		}
				
		if( ( is_front_page() || is_home() ) ) {
			$paged = (get_query_var('paged')) ? get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);
		} else {
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		}
		
		$query_args = array(
						'posts_per_page'	=> $posts,
						'paged' 			=> $paged,
						'orderby' 		 	=> 'date',
						'order' 		 	=> 'DESC',
					  );
					  		
		$query_args['tax_query'] 	= array(
										'relation'	=> 'AND',
										$include_categories,
										$exclude_categories );
		
		$blog_query = new WP_Query( $query_args );
		
		$post_class = '';
		$excerpt_limit = '10';
		
		$date_format = '';
		$date_format = $zozo_options['zozo_blog_date_format'];
		
		// Classes
		$main_classes = '';
		
		if( isset( $classes ) && $classes != '' ) {
			$main_classes .= ' ' . $classes;
		}
		$main_classes .= zozo_vc_animation( $css_animation );
		
		if( $blog_query->have_posts() ) {
			$output = '<div class="zozo-latest-posts-wrapper'.$main_classes.'">';
				$output .= '<div class="latest-posts-layout row">';
				
				$count = 1;
				
				while($blog_query->have_posts()) : $blog_query->the_post();
				
					$post_id = get_the_ID();				
					$post_format = get_post_format();
										
					$extra_post_class = '';
					if($blog_style == 'default' ) {
						$extra_post_class = 'col-xs-12';
					} elseif($blog_style == 'two-column') {
						$extra_post_class = 'col-md-6 col-xs-12';
					}
					
					if( $blog_style == 'two-column' && ( $count % 2 ) > 0 ) {
						$output .= '<div class="latest-posts-clear clearfix"></div>';
					}
		
					$output .= '<div id="post-'.$post_id.'" ';
					ob_start();
						post_class($extra_post_class);
					$output .= ob_get_clean() .'>';
					
					$output .= '<div class="posts-inner-container clearfix">';
					
						if ( has_post_thumbnail() && ! post_password_required() ) {
							
							if( has_post_format('link') ) { 			
								$external_url = '';
								$external_url = get_post_meta( $post_id, 'zozo_external_link_url', true );
								if( isset( $external_url ) && $external_url == '' ) {
									$external_url = get_permalink( $post_id );
								}

								$output .= '<div class="entry-thumbnail">';
									$output .= '<a href="'. esc_url($external_url) .'" title="'. get_the_title() .'" class="post-img">'. get_the_post_thumbnail( $post_id, 'blog-thumb' ) .'</a>';
									$output .= '</div>';
								$output .= '</div>';
							}
							
							else {
								$output .= '<div class="entry-thumbnail">';
									$output .= '<a href="'. get_permalink($post_id) .'" class="post-img" title="'. get_the_title() .'">'. get_the_post_thumbnail( $post_id, 'blog-thumb' ) .'</a>';
								$output .= '</div>';
							}

						}
						
						$output .= '<div class="posts-content-container">';
							$output .= '<div class="entry-header">';
								$output .= '<h2 class="entry-title">';
									$output .= '<a href="'. get_permalink($post_id) .'" rel="bookmark" title="'. get_the_title() .'">'. get_the_title() .'</a>';
								$output .= '</h2>';
							$output .= '</div>';
													
							$output .= '<div class="entry-summary">';
								$output .= '<p>'. zozo_shortcode_stripped_excerpt( get_the_content(), $excerpt_limit ) .'</p>';
							$output .= '</div>';
							
							$output .= '<div class="entry-meta-wrapper">';							
							$output .= '<ul class="entry-meta">';
																
								$output .= '<li class="posted-date"><i class="fa fa-calendar"></i> ' .get_the_time( $date_format ).'</li>';
								
								if( $read_more == 'yes' ) {
									if( ! $zozo_options['zozo_blog_read_more_text'] ) {
										$more_text = esc_html__('Read more', 'zozothemes'); 
									} else { 
										$more_text = $zozo_options['zozo_blog_read_more_text'];
									}
									$output .= '<li class="read-more"><a href="'. get_permalink($post_id) .'" class="read-more-link" title="'. get_the_title() .'">'.$more_text.'</a></li>';
								}
							
							$output .= '</ul>';
							$output .= '</div>';
						$output .= '</div>';
						
					$output .= '</div>';
					$output .= '</div>';
					
					$count++;
					
				endwhile;
				
			$output .= '</div>';
			$output .= '</div>';
			
		}
		
		wp_reset_postdata();
		
		return $output;
	}
}
add_shortcode( 'zozo_vc_latest_posts', 'zozo_vc_latest_posts_shortcode' );

if ( ! function_exists( 'zozo_vc_latest_posts_shortcode_map' ) ) {
	function zozo_vc_latest_posts_shortcode_map() {
		
		vc_map( 
			array(
				"name"					=> __( "Latest Posts", "zozothemes" ),
				"description"			=> __( "Show your latest blog posts.", 'zozothemes' ),
				"base"					=> "zozo_vc_latest_posts",
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
						"type"			=> "textfield",
						"heading"		=> __( "Posts to Show?", "zozothemes" ),
						"admin_label" 	=> true,
						"param_name"	=> "posts",						
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
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Blog Style", "zozothemes" ),
						"param_name"	=> "blog_style",
						"admin_label" 	=> true,
						"value"			=> array(
							__( "Default", "zozothemes" )			=> "default",
							__( "2 Column Style", "zozothemes" )	=> "two-column" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Show Read More Link", "zozothemes" ),
						"param_name"	=> "read_more",
						"value"			=> array(
							__( "No", "zozothemes" )	=> "no",
							__( "Yes", "zozothemes" )	=> "yes" ),
					),
				)
			) 
		);
	}
}
add_action( 'vc_before_init', 'zozo_vc_latest_posts_shortcode_map' );