<?php 
/**
 * The Easy Digital Downloads List shortcode
 */

if ( ! function_exists( 'zozo_vc_edd_list_shortcode' ) ) {
	function zozo_vc_edd_list_shortcode( $atts, $content = NULL ) {
	
		/**
		 * Check if easy digital downloads class exists
		 */
		if ( ! class_exists( 'Easy_Digital_Downloads' ) ) {
			return;
		}
		
		$atts = vc_map_get_attributes( 'zozo_vc_edd_list', $atts );
		extract( $atts );

		$output = '';
		$extra_class = '';
		static $edd_id = 1;
		
		global $post;
		
		if( isset( $edd_listtype ) && $edd_listtype == 'categories' ) {
			// Include categories
			$include_categories = ( '' != $include_categories ) ? $include_categories : '';
			$include_categories = ( 'all' == $include_categories ) ? '' : $include_categories;
			$include_filter_cats = '';
			if( $include_categories ) {
				$include_categories = explode( ',', $include_categories );
				$include_filter_cats = array();
				foreach( $include_categories as $key ) {
					$key = get_term_by( 'slug', $key, 'download_category' );
					$include_filter_cats[] = $key->term_id;
				}
			}
			
			if ( ! empty( $include_categories ) && is_array( $include_categories ) ) {
				$include_categories = array(
					'taxonomy'	=> 'download_category',
					'field'		=> 'slug',
					'terms'		=> $include_categories,
					'operator'	=> 'IN',
				);
			} else {
				$include_categories = '';
			}
		
			// Exclude categories
			$exclude_filter_cats = '';
			if( $exclude_categories ) {
				$exclude_categories = explode( ',', $exclude_categories );
				if ( ! empty( $exclude_categories ) && is_array( $exclude_categories ) ) {
					$exclude_filter_cats = array();
					foreach ( $exclude_categories as $key ) {
						$key = get_term_by( 'slug', $key, 'download_category' );
						$exclude_filter_cats[] = $key->term_id;
					}
					$exclude_categories = array(
							'taxonomy'	=> 'download_category',
							'field'		=> 'slug',
							'terms'		=> $exclude_categories,
							'operator'	=> 'NOT IN',
						);
				} else {
					$exclude_categories = '';
				}
			}
		} else if( isset( $edd_listtype ) && $edd_listtype == 'tags' ) {
			// Include tags
			$include_tags = ( '' != $include_tags ) ? $include_tags : '';
			$include_tags = ( 'all' == $include_tags ) ? '' : $include_tags;
			$include_filter_tags = '';
			if( $include_tags ) {
				$include_tags = explode( ',', $include_tags );
				$include_filter_tags = array();
				foreach( $include_tags as $key ) {
					$key = get_term_by( 'slug', $key, 'download_tag' );
					$include_filter_tags[] = $key->term_id;
				}
			}
			
			if ( ! empty( $include_tags ) && is_array( $include_tags ) ) {
				$include_tags = array(
					'taxonomy'	=> 'download_tag',
					'field'		=> 'slug',
					'terms'		=> $include_tags,
					'operator'	=> 'IN',
				);
			} else {
				$include_tags = '';
			}
		
			// Exclude tags
			$exclude_filter_tags = '';
			if( $exclude_tags ) {
				$exclude_tags = explode( ',', $exclude_tags );
				if ( ! empty( $exclude_tags ) && is_array( $exclude_tags ) ) {
					$exclude_filter_tags = array();
					foreach ( $exclude_tags as $key ) {
						$key = get_term_by( 'slug', $key, 'download_tag' );
						$exclude_filter_tags[] = $key->term_id;
					}
					$exclude_tags = array(
							'taxonomy'	=> 'download_tag',
							'field'		=> 'slug',
							'terms'		=> $exclude_tags,
							'operator'	=> 'NOT IN',
						);
				} else {
					$exclude_tags = '';
				}
			}
		} else if( isset( $edd_listtype ) && $edd_listtype == 'ids' ) {
			// Include Downloads
			$include_postids = ( '' != $include_downloads ) ? $include_downloads : '';
			$include_filter_ids = '';
			if( $include_postids ) {
				$include_postids = explode( ',', $include_downloads );
				$include_filter_ids = array();
				foreach( $include_postids as $key ) {
					$include_filter_ids[] = $key;
				}
			}
			
			// Exclude Downloads
			$exclude_postids = ( '' != $exclude_downloads ) ? $exclude_downloads : '';
			$exclude_filter_ids = '';
			if( $exclude_postids ) {
				$exclude_postids = explode( ',', $exclude_downloads );
				$exclude_filter_ids = array();
				foreach( $exclude_postids as $key ) {
					$exclude_filter_ids[] = $key;
				}
			}
		}
		
		$query_relation = $relation;
		
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		
		$query_args = array(
						'post_type' 		=> 'download',
						'posts_per_page'	=> $posts,
						'paged' 			=> $paged,
						'orderby' 		 	=> $orderby,
						'order' 		 	=> $order,
					  );
					  
		switch ( $orderby ) {
			case 'price':
				$query_args['meta_key'] = 'edd_price';
				$query_args['orderby']  = 'meta_value_num';
			break;
	
			case 'title':
				$query_args['orderby'] = 'title';
			break;
	
			case 'id':
				$query_args['orderby'] = 'ID';
			break;
	
			case 'random':
				$query_args['orderby'] = 'rand';
			break;
	
			default:
				$query_args['orderby'] = 'post_date';
			break;
		}
		
		if( isset( $edd_listtype ) && $edd_listtype == 'categories' ) {
			if ( ! empty( $exclude_categories ) && is_array( $exclude_categories ) ) {
				$query_relation = 'AND';
			}
			$query_args['tax_query'] 	= array(
											'relation'	=> $query_relation,
											$include_categories,
											$exclude_categories );
		} 
		else if( isset( $edd_listtype ) && $edd_listtype == 'tags' ) {
			if ( ! empty( $exclude_tags ) && is_array( $exclude_tags ) ) {
				$query_relation = 'AND';
			}
			$query_args['tax_query'] 	= array(
											'relation'	=> $query_relation,
											$include_tags,
											$exclude_tags );
		} 
		else if( isset( $edd_listtype ) && $edd_listtype == 'ids' ) {
			if( $include_filter_ids != '' ) {
				$query_args['post__in'] 	= $include_filter_ids;
			}
			
			if( $exclude_filter_ids != '' ) {
				$query_args['post__not_in'] = $exclude_filter_ids;
			}
		}
		
		// Allow the query to be manipulated by other plugins
		$query_args = apply_filters( 'edd_downloads_query', $query_args, $atts );
		
		$downloads = new WP_Query( $query_args );
		
		// Classes
		$main_classes = 'zozo-downloads-list-wrapper';
		
		if( isset( $classes ) && $classes != '' ) {
			$main_classes .= ' ' . $classes;
		}
		$main_classes .= zozo_vc_animation( $css_animation );
		$main_classes .= ' style-'. $edd_style;
		$main_classes .= ' clearfix';
		
		$row_class = '';
		$column_class = '';
		if( isset( $edd_style ) && $edd_style == 'grid' ) {
			$row_class = ' row';
			if( isset( $columns ) && $columns != '' ) {
				if( isset( $columns ) && $columns == '1' ) {
					$column_class = ' col-md-12';
				} else if( isset( $columns ) && $columns == '2' ) {
					$column_class = ' col-md-6 col-sm-6';
				} else if( isset( $columns ) && $columns == '3' ) {
					$column_class = ' col-md-4 col-sm-6';
				} else if( isset( $columns ) && $columns == '4' ) {
					$column_class = ' col-md-3 col-sm-6';
				}
			} else {
				$column_class = ' col-md-12 col-xs-12';
			}
		}
		
		if( isset( $title_transform ) && $title_transform != '' ) {
			$extra_class = ' text-'.$title_transform.'';
		}
		
		// Stylings
		$title_styles = '';
		if( isset( $title_color ) && $title_color != '' ) {
			$title_styles = 'color: '. $title_color .';';
		}
		if( isset( $title_size ) && $title_size != '' ) {
			$title_styles .= 'font-size:'. $title_size .';';
		}
		if( $title_styles ) {
			$title_styles = ' style="'. $title_styles  .'"';
		}
		
		$content_styles = '';
		if( isset( $content_color ) && $content_color != '' ) {
			$content_styles = ' style="color: '. $content_color .';"';
		}
		
		$price_styles = '';
		if( isset( $price_color ) && $price_color != '' ) {
			$price_styles = ' style="color: '. $price_color .';"';
		}
		
		if ( $downloads->have_posts() ) :
			$i = 1;
			$wrapper_class = 'edd_download_columns_' . $columns;
		
			$output .= '<div id="zozo_edd_'.$edd_id.'" class="'. esc_attr( $main_classes ) .'">';
				$output .= '<div class="edd_downloads_list'.$row_class.' '. apply_filters( 'edd_downloads_list_wrapper_class', $wrapper_class, $atts ) .'">';
				
				$col_count = 1;
				
				while ( $downloads->have_posts() ) : $downloads->the_post();
					$schema = edd_add_schema_microdata() ? 'itemscope itemtype="http://schema.org/Product" ' : '';
					
					$output .= $col_count == 1 ? '<div class="row">' : ''; // row start
					
					$output .= '<div '. $schema .'class="edd-column'.$column_class.' '. apply_filters( 'edd_download_class', 'edd_download', get_the_ID(), $atts, $i ) .'" id="edd_download_'. get_the_ID() .'">';
					$output .= '<div class="edd_download_inner">';
					
						do_action( 'edd_download_before' );
						
						// Image
						if( isset( $thumbnails ) && $thumbnails == 'yes' ) {
							if( function_exists( 'has_post_thumbnail' ) && has_post_thumbnail( get_the_ID() ) ) {
								$output .= '<div class="edd_download_image">';
									$output .= '<a href="'. get_permalink() .'" title="'. the_title_attribute( 'echo=0' ) .'">';
										$output .= get_the_post_thumbnail( get_the_ID(), 'theme-mid' );
									$output .= '</a>';
								$output .= '</div>';
							}
							do_action( 'edd_download_after_thumbnail' );
						}
						
						$output .= '<div class="edd_download_content_wrapper">';
						
						// Title
						$output .= '<'. $title_type .' itemprop="name" class="edd_download_title'.$extra_class.'"><a title="'. the_title_attribute( 'echo=0' ) .'" href="' . get_permalink() . '" itemprop="url"'.$title_styles.'>' . get_the_title() . '</a></'. $title_type .'>';
						do_action( 'edd_download_after_title' );
						
						// Price
						if ( $price == 'yes' ) {
							if( edd_has_variable_prices( get_the_ID() ) ) :
								$output .= '<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">';
									$output .= '<div itemprop="price" class="edd_price"'. $price_styles .'>';
										$output .= edd_price_range( get_the_ID() );
									$output .= '</div>';
								$output .= '</div>';
							else :
								$output .= '<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">';
									$output .= '<div itemprop="price" class="edd_price"'. $price_styles .'>';
										ob_start();
										edd_price( get_the_ID() );
										$output .= ob_get_clean();
									$output .= '</div>';
								$output .= '</div>';
							endif;
							do_action( 'edd_download_after_price' );
						}
						
						// Content
						if( isset( $excerpt_length ) && $excerpt_length == '' ) {
							$excerpt_length = 30;
						}
						if( $excerpt == 'yes' && $full_content != 'yes' ) {
							if( has_excerpt() ) :
								$output .= '<div itemprop="description" class="edd_download_excerpt"'. $content_styles .'>';
									$output .= apply_filters( 'edd_downloads_excerpt', wp_trim_words( get_post_field( 'post_excerpt', get_the_ID() ), $excerpt_length ) );
								$output .= '</div>';
							elseif( get_the_content() ) :
								$output .= '<div itemprop="description" class="edd_download_excerpt"'. $content_styles .'>';
									$output .= apply_filters( 'edd_downloads_excerpt', wp_trim_words( get_post_field( 'post_content', get_the_ID() ), $excerpt_length ) );
								$output .= '</div>';
							endif;
							do_action( 'edd_download_after_content' );
						}
						else if( $full_content == 'yes' ) {
							$output .= '<div itemprop="description" class="edd_download_full_content"'. $content_styles .'>';
								$output .= apply_filters( 'edd_downloads_content', get_post_field( 'post_content', get_the_ID() ) );
							$output .= '</div>';
							do_action( 'edd_download_after_content' );
						}
						
						// Button
						if ( $buy_button == 'yes' ) {
							$output .= '<div class="edd_download_buy_button">';
								if ( ! edd_has_variable_prices( get_the_ID() ) ) :
									$output .= edd_get_purchase_link( array( 'download_id' => get_the_ID() ) );
								else :
									$output .= '<a href="'. get_permalink() .'" title="'. the_title_attribute( 'echo=0' ) .'" class="btn edd-single-link">'. __( 'Select Options', 'zozothemes' ) . '</a>';
								endif;
							$output .= '</div>';
						}
						
						$output .= '</div>';
						
						do_action( 'edd_download_after' );
					
					$output .= '</div>';
					$output .= '</div>';
				$i++; 
				
				if( $col_count == $columns ){
					$output .= '</div><!--row-->'; // row end
					$col_count = 1;
				}else{
					$col_count++;
				}
				
				endwhile;
				
				$output .= $col_count != 1 ? '</div><!--row-->' : ''; // unexpected row end
				
				$output .= '</div>';
				
				wp_reset_postdata();
				
				if( $pagination == 'yes' ) {
					$output .= zozo_pagination( $downloads->max_num_pages, 'pagination' );
				}
				
			$output .= '</div>';
		else:
			$output .= sprintf( _x( 'No %s found', 'download post type name', 'zozothemes' ), edd_get_label_plural() );
		endif;
		
		$edd_id++;
		return $output;
	}
}
add_shortcode( 'zozo_vc_edd_list', 'zozo_vc_edd_list_shortcode' );

if ( ! function_exists( 'zozo_vc_edd_list_shortcode_map' ) ) {
	function zozo_vc_edd_list_shortcode_map() {
		
		vc_map( 
			array(
				"name"					=> __( "Easy Digital Downloads", "zozothemes" ),
				"description"			=> __( "List your downloads from EDD Plugin.", 'zozothemes' ),
				"base"					=> "zozo_vc_edd_list",
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
						"heading"		=> __( "Style", "zozothemes" ),
						"param_name"	=> "edd_style",						
						"value"			=> array(
							__( "List", "zozothemes" )		=> "list",
							__( "Grid", "zozothemes" )		=> "grid" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Columns", "zozothemes" ),
						"param_name"	=> "columns",
						"value"			=> array(
							__( "One Column", "zozothemes" )		=> "1",
							__( "Two Columns", "zozothemes" )		=> "2",
							__( "Three Columns", "zozothemes" )		=> "3",
							__( "Four Columns", "zozothemes" )		=> "4" ),
						'dependency' 	=> array(
							'element' 	=> 'edd_style',
							'value' 	=> array( 'grid' ),
						),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Posts per Page", "zozothemes" ),
						"admin_label" 	=> true,
						"param_name"	=> "posts",						
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "List Events", "zozothemes" ),
						"param_name"	=> "edd_listtype",
						"admin_label" 	=> true,
						"value"			=> array(
							__( "Categories", "zozothemes" )		=> "categories",
							__( "Tags", "zozothemes" )				=> "tags",
							__( "List of IDs", "zozothemes" )		=> "ids" ),
					),
					array(
						'type' 			=> 'autocomplete',
						'heading' 		=> __( 'Include Downloads', 'zozothemes' ),
						'param_name' 	=> 'include_downloads',
						"admin_label" 	=> true,
						'description' 	=> __( 'Add downloads by title.', 'zozothemes' ),
						'settings' 		=> array(
							'multiple' 	=> true,
							'sortable' 	=> true,
						),
						'dependency' 	=> array(
							'element' 	=> 'edd_listtype',
							'value' 	=> array( 'ids' ),
						),
					),
					array(
						'type' 			=> 'autocomplete',
						'heading' 		=> __( 'Exclude Downloads', 'zozothemes' ),
						'param_name' 	=> 'exclude_downloads',
						"admin_label" 	=> true,
						'description' 	=> __( 'Exclude downloads by title.', 'zozothemes' ),
						'settings' 		=> array(
							'multiple' 	=> true,
							'sortable' 	=> true,
						),
						'dependency' 	=> array(
							'element' 	=> 'edd_listtype',
							'value' 	=> array( 'ids' ),
						),
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> __( 'Include Categories', 'zozothemes' ),
						'param_name'	=> 'include_categories',
						'admin_label'	=> true,
						'description'	=> __('Enter the slugs of a categories (comma seperated) to pull posts from or enter "all" to pull recent posts from all categories. Example: category-1, category-2.','zozothemes'),
						'dependency' 	=> array(
							'element' 	=> 'edd_listtype',
							'value' 	=> array( 'categories' ),
						),
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> __( 'Exclude Categories', 'zozothemes' ),
						'param_name'	=> 'exclude_categories',
						'admin_label'	=> true,
						'description'	=> __('Enter the slugs of a categories (comma seperated) to exclude. Example: category-1, category-2.','zozothemes'),
						'dependency' 	=> array(
							'element' 	=> 'edd_listtype',
							'value' 	=> array( 'categories' ),
						),
					),	
					array(
						'type'			=> 'textfield',
						'heading'		=> __( 'Include Tags', 'zozothemes' ),
						'param_name'	=> 'include_tags',
						'admin_label'	=> true,
						'description'	=> __('Enter the slugs of a categories (comma seperated) to pull posts from or enter "all" to pull recent posts from all categories. Example: category-1, category-2.','zozothemes'),
						'dependency' 	=> array(
							'element' 	=> 'edd_listtype',
							'value' 	=> array( 'tags' ),
						),
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> __( 'Exclude Tags', 'zozothemes' ),
						'param_name'	=> 'exclude_tags',
						'admin_label'	=> true,
						'description'	=> __('Enter the slugs of a categories (comma seperated) to exclude. Example: category-1, category-2.','zozothemes'),
						'dependency' 	=> array(
							'element' 	=> 'edd_listtype',
							'value' 	=> array( 'tags' ),
						),
					),	
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Relation", "zozothemes" ),
						"param_name"	=> "relation",
						"value"			=> array(
							__( "OR", "zozothemes" )		=> "OR",
							__( "AND", "zozothemes" )		=> "AND",							
						),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Show Pagination ?", "zozothemes" ),
						"param_name"	=> "pagination",	
						"value"			=> array(
							__( "Yes", "zozothemes" )		=> "yes",
							__( "No", "zozothemes" )		=> "no" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Show Price ?", "zozothemes" ),
						"param_name"	=> "price",	
						"value"			=> array(
							__( "Yes", "zozothemes" )		=> "yes",
							__( "No", "zozothemes" )		=> "no" ),
					),	
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Show Excerpt ?", "zozothemes" ),
						"param_name"	=> "excerpt",	
						"value"			=> array(
							__( "Yes", "zozothemes" )		=> "yes",
							__( "No", "zozothemes" )		=> "no" ),
					),
					array(
						"type"			=> 'textfield',
						"heading"		=> __( "Excerpt Length", "zozothemes" ),
						"param_name"	=> "excerpt_length",	
						"value"			=> "",
						'dependency'	=> array(
							'element'	=> 'excerpt',
							'value'		=> array( 'yes' ),
						),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Show Full Content ?", "zozothemes" ),
						"param_name"	=> "full_content",	
						"value"			=> array(
							__( "No", "zozothemes" )		=> "no",
							__( "Yes", "zozothemes" )		=> "yes" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Show Buy Button ?", "zozothemes" ),
						"param_name"	=> "buy_button",	
						"value"			=> array(
							__( "Yes", "zozothemes" )		=> "yes",
							__( "No", "zozothemes" )		=> "no" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Show Thumbnails ?", "zozothemes" ),
						"param_name"	=> "thumbnails",	
						"value"			=> array(
							__( "Yes", "zozothemes" )		=> "yes",
							__( "No", "zozothemes" )		=> "no" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Order By", "zozothemes" ),
						"param_name"	=> "orderby",
						"value"			=> array(
							__( "Price", "zozothemes" )		=> "price",
							__( "ID", "zozothemes" )		=> "id",
							__( "Random", "zozothemes" )	=> "random",
							__( "Post Date", "zozothemes" )	=> "post_date",
							__( "Title", "zozothemes" )		=> "title",
						),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Order", "zozothemes" ),
						"param_name"	=> "order",
						"value"			=> array(
							__( "ASC", "zozothemes" )		=> "ASC",
							__( "DESC", "zozothemes" )		=> "DESC",							
						),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Downloads Title Type", "zozothemes" ),
						"param_name"	=> "title_type",
						"value"			=> array(
							__( "h2", "zozothemes" )	=> "h2",
							__( "h3", "zozothemes" )	=> "h3",
							__( "h4", "zozothemes" )	=> "h4",
							__( "h5", "zozothemes" )	=> "h5",
							__( "h6", "zozothemes" )	=> "h6",
						),
					),
					array(
						"type"			=> "dropdown",
						"heading"		=> __( "Downloads Title Text Transform", 'zozothemes' ),
						"param_name"	=> "title_transform",
						"value"			=> array(
							__( "Default", 'zozothemes' )		=> '',
							__( "None", 'zozothemes' )			=> 'none',
							__( "Capitalize", 'zozothemes' )	=> 'capitalize',
							__( "Uppercase", 'zozothemes' )		=> 'uppercase',
							__( "Lowercase", 'zozothemes' )		=> 'lowercase',
						),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Downloads Title Font Size", "zozothemes" ),
						"param_name"	=> "title_size",
						"description" 	=> __( "Enter Title Font Size in px. Ex: 18px", "zozothemes" ),
					),
					array(
						"type"			=> 'colorpicker',
						"heading"		=> __( "Title Color", "zozothemes" ),
						"param_name"	=> "title_color",
						"group"			=> __( "Design", "zozothemes" ),
					),
					array(
						"type"			=> 'colorpicker',
						"heading"		=> __( "Content Color", "zozothemes" ),
						"param_name"	=> "content_color",
						"group"			=> __( "Design", "zozothemes" ),
					),
					array(
						"type"			=> 'colorpicker',
						"heading"		=> __( "Price Color", "zozothemes" ),
						"param_name"	=> "price_color",
						"group"			=> __( "Design", "zozothemes" ),
					),
				)
			) 
		);
		
		//Filters For autocomplete param:
		//For suggestion: vc_autocomplete_[shortcode_name]_[param_name]_callback
		add_filter( 'vc_autocomplete_zozo_vc_edd_list_include_downloads_callback', 'zozo_vc_edd_list_include_field_search', 10, 1 ); // Get suggestion(find). Must return an array
		add_filter( 'vc_autocomplete_zozo_vc_edd_list_include_downloads_render', 'zozo_vc_edd_list_include_field_render', 10, 1 ); // Render exact post. Must return an array (label,value)
		add_filter( 'vc_autocomplete_zozo_vc_edd_list_exclude_downloads_callback', 'zozo_vc_edd_list_exclude_field_search', 10, 1 ); // Get suggestion(find). Must return an array
		add_filter( 'vc_autocomplete_zozo_vc_edd_list_exclude_downloads_render', 'zozo_vc_edd_list_exclude_field_render', 10, 1 ); // Render exact post. Must return an array (label,value)
		
		/**
		 * @param $search_string
		 *
		 * @return array
		 */
		function zozo_vc_edd_list_include_field_search( $search_string ) {
			$query = $search_string;
			$data = array();
			$args = array( 's' => $query, 'post_type' => 'download' );
			$args['vc_search_by_title_only'] = true;
			$args['numberposts'] = - 1;
			if ( strlen( $args['s'] ) == 0 ) {
				unset( $args['s'] );
			}
			add_filter( 'posts_search', 'vc_search_by_title_only', 500, 2 );
			$posts = get_posts( $args );
			if ( is_array( $posts ) && ! empty( $posts ) ) {
				foreach ( $posts as $post ) {
					$data[] = array(
						'value' => $post->ID,
						'label' => $post->post_title,
						'group' => $post->post_type,
					);
				}
			}
		
			return $data;
		}
		
		/**
		 * @param $value
		 *
		 * @return array|bool
		 */
		function zozo_vc_edd_list_include_field_render( $value ) {
			$post = get_post( $value['value'] );
		
			return is_null( $post ) ? false : array(
				'label' => $post->post_title,
				'value' => $post->ID,
				'group' => $post->post_type
			);
		}
		
		/**
		 * @param $data_arr
		 *
		 * @return array
		 */
		function zozo_vc_edd_list_exclude_field_search( $data_arr ) {
			if( is_array( $data_arr ) ) {
				$query = isset( $data_arr['query'] ) ? $data_arr['query'] : null;
				$term = isset( $data_arr['term'] ) ? $data_arr['term'] : "";
			} else {
				$query = $data_arr;
			}
			$data = array();
			
			$args = ! empty( $query ) ? array( 's' => $query, 'post_type' => 'download' ) : array( 's' => $term, 'post_type' => 'download' );
			
			$args['vc_search_by_title_only'] = true;
			$args['numberposts'] = - 1;
			if ( strlen( $args['s'] ) == 0 ) {
				unset( $args['s'] );
			}
			add_filter( 'posts_search', 'vc_search_by_title_only', 500, 2 );
			$posts = get_posts( $args );
			if ( is_array( $posts ) && ! empty( $posts ) ) {
				foreach ( $posts as $post ) {
					$data[] = array(
						'value' => $post->ID,
						'label' => $post->post_title,
						'group' => $post->post_type,
					);
				}
			}
		
			return $data;
		}
		
		/**
		 * @param $value
		 *
		 * @return array|bool
		 */
		function zozo_vc_edd_list_exclude_field_render( $value ) {
			$post = get_post( $value['value'] );
		
			return is_null( $post ) ? false : array(
				'label' => $post->post_title,
				'value' => $post->ID,
				'group' => $post->post_type
			);
		}
		
	}
}
add_action( 'vc_before_init', 'zozo_vc_edd_list_shortcode_map' );