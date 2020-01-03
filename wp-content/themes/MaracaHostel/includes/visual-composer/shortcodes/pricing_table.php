<?php 
/**
 * Pricing Table shortcode
 */

if ( ! function_exists( 'zozo_vc_pricing_table_shortcode' ) ) {
	function zozo_vc_pricing_table_shortcode( $atts, $content = NULL ) {
		
		extract( 
			shortcode_atts( 
				array(
					'classes'				=> '',
					'css_animation'			=> '',
					'featured' 				=> 'no',
					'featured_text' 		=> __('Offer', 'zozothemes'),
					'plan'					=> __( 'Basic', 'zozothemes' ),
					'plan_extra_class' 		=> '',
					'plan_color' 			=> '',
					'cost_before' 			=> '',
					'cost' 					=> '$99.9',
					'cost_per' 				=> '',
					'cost_color' 			=> '',
					'cost_position' 		=> '',
					'font_active_color' 	=> '',
					'font_inactive_color' 	=> '',
					'font_sep_color' 		=> '',
					'pricing_image' 		=> '',
					'image_url' 			=> '',
					'video' 				=> '',
					'video_id' 				=> '',
					'video_fallback' 		=> '',
					'video_autoplay' 		=> 'false',
					'video_controls' 		=> 'false',
					'video_height' 			=> '180',
					'show_icon' 			=> '',
					'type' 					=> 'fontawesome',
					'icon_flaticons' 		=> '',
					'icon_fontawesome' 		=> 'fa fa-minus-circle',
					'icon_lineicons' 		=> '',
					'icon_icomoonpack1' 	=> '',
					'icon_icomoonpack2' 	=> '',
					'icon_icomoonpack3' 	=> '',
					'icon_br_color' 		=> '',
					'button_url' 			=> '',
					'button_text' 			=> __('Order Now', 'zozothemes')
				), $atts 
			) 
		);
		
		global $post;
	
		static $zozo_pricing_table = 1;

		$output = '';
		
		$extra_classes = '';
		if( isset( $classes ) && $classes != '' ) {
			$extra_classes .= ' ' . $classes;
		}
		$extra_classes .= zozo_vc_animation( $css_animation );
		
		$plan_style = '';
		if( isset( $plan_color ) && $plan_color != '' ) {
			$plan_style = 'color: '. $plan_color .';';
		}
		
		$cost_style = '';
		if( isset( $cost_color ) && $cost_color != '' ) {
			$cost_style = 'color: '. $cost_color .';';
		}
		
		$feature_active_style = '';
		if( isset( $font_active_color ) && $font_active_color != '' ) {
			$feature_active_style = 'color: '. $font_active_color .';';
		}
		
		$feature_inactive_style = '';
		if( isset( $font_inactive_color ) && $font_inactive_color != '' ) {
			$feature_inactive_style = 'color: '. $font_inactive_color .';';
		}
		
		$feature_sep_style = '';
		if( isset( $font_sep_color ) && $font_sep_color != '' ) {
			$feature_sep_style = 'border-color: '. $font_sep_color .';';
		}
		
		$icon_style = '';
		if( isset( $icon_br_color ) && $icon_br_color != '' ) {
			$icon_style = 'border-color: '. $icon_br_color .';';
		}
		
		// Button URL
		$btn_link = $btn_title = $btn_target = '';
		if( $button_url && $button_url != '' ) {
			$link = vc_build_link( $button_url );
			$btn_link = isset( $link['url'] ) ? $link['url'] : '';
			$btn_title = isset( $link['title'] ) ? $link['title'] : '';
			$btn_target =!empty( $link['target'] ) ? $link['target'] : '_self';
		}
		
		if( ( isset( $btn_link ) && $btn_link != '' ) || ( isset( $cost_position ) && $cost_position == 'before_button' ) ) {
			$extra_classes .= ' pricing-bottom-spacing';
		}
		
		// Custom Styles
		$styles = '';
		
		if( $plan_style != '' || $cost_style != '' || $feature_active_style != '' || $feature_inactive_style != '' || $feature_sep_style != '' || $icon_style != '' ) {
			$styles .= '<style type="text/css" scoped>';				
			
			if( $plan_style != '' ) {
				$styles .= sprintf( '#zozo-pricing-table-%s .zozo-pricing-item .pricing-title {%s}', $zozo_pricing_table, $plan_style ) . "\n";
			}
			if( $cost_style != '' ) {
				$styles .= sprintf( '#zozo-pricing-table-%s .zozo-pricing-item .pricing-cost h3 {%s}', $zozo_pricing_table, $cost_style ) . "\n";
			}
			if( $feature_active_style != '' ) {
				$styles .= sprintf( '#zozo-pricing-table-%s .zozo-pricing-item .pricing-features li {%s}', $zozo_pricing_table, $feature_active_style ) . "\n";
			}
			if( $feature_inactive_style != '' ) {
				$styles .= sprintf( '#zozo-pricing-table-%s .zozo-pricing-item .pricing-features li.inactive {%s}', $zozo_pricing_table, $feature_inactive_style ) . "\n";
			}
			if( $feature_sep_style != '' ) {
				$styles .= sprintf( '#zozo-pricing-table-%s .zozo-pricing-item .pricing-features .li {%s}', $zozo_pricing_table, $feature_sep_style ) . "\n";
			}
			if( $icon_style != '' ) {
				$styles .= sprintf( '#zozo-pricing-table-%s .zozo-pricing-item .pricing-icon {%s}', $zozo_pricing_table, $icon_style ) . "\n";
			}
			
			$styles .= '</style>';
		}
			
		$output .= $styles;
		
		// Pricing Column
		$output .= '<div id="zozo-pricing-table-'. $zozo_pricing_table .'" class="zozo-pricing-table-wrapper vc-pricing-table'.$extra_classes.'">';			
			// Pricing Item
			$output .= '<div class="zozo-pricing-item">';			
				$output .= '<div class="pricing-plan-list pricing-box">';
				if( isset( $featured ) && $featured == 'yes' ) {
					$output .= '<div class="pricing-ribbon-wrapper">';
						$output .= '<div class="pricing-ribbon">';
						$output .= $featured_text;
						$output .= '</div>';
					$output .= '</div>';
				}
				$output .= '<div class="pricing-head">';
					$output .= '<h4 class="pricing-title '.$plan_extra_class .'">'. $plan .'</h4>';
					if( isset( $cost_position ) && $cost_position != 'before_button' ) {
						$output .= '<div class="pricing-cost-wrapper">';
						if( isset( $cost_before ) && $cost_before != '' ) {
							$output .= '<div class="pricing-starts">';
								$output .= $cost_before;
							$output .= '</div>';
						}
						if( isset( $cost ) && $cost != '' ) {
							$output .= '<div class="pricing-cost">';
								$output .= '<h3>'. $cost . '</h3>';
								if( isset( $cost_per ) && $cost_per != '' ) {
									$output .= '<span class="pricing-duration">'. $cost_per .'</span>';
								}
							$output .= '</div>';
						}
						$output .= '</div>';
					}
				$output .= '</div>';
				
				// Image URL
				$img_link = $img_title = $img_target = '';
				if( $image_url && $image_url != '' ) {
					$link = vc_build_link( $image_url );
					$img_link = isset( $link['url'] ) ? $link['url'] : '';
					$img_title = isset( $link['title'] ) ? $link['title'] : '';
					$img_target = isset( $link['target'] ) ? $link['target'] : '';
				}
				
				// Image
				if( isset( $pricing_image ) && $pricing_image != '' ) {
					$post_thumbnail = wpb_getImageBySize( array( 'attach_id' => $pricing_image, 'thumb_size' => 'theme-mid' ) );
					$thumbnail = $post_thumbnail['thumbnail'];
					
					$output .= '<div class="pricing-image-wrapper">';
						if( isset( $img_link ) && $img_link != '' ) {
							$output .= '<a href="'. esc_url( $img_link ) .'" title="'. esc_attr( $img_title ) .'" target="'. esc_attr( $img_target ) .'">';
						}
						$output .= $thumbnail;
						if( isset( $img_link ) && $img_link != '' ) {
							$output .= '</a>';
						}
					$output .= '</div>';
				}
				elseif( isset( $video ) && $video == 'yes' ) {
					// Video
					if( isset( $video_id ) && $video_id != '' ) {
						$video_count = '';
						$video_count = rand(1, 100);
						
						$video_fallback_src = '';
						if ( $video_fallback ) {
							$video_fallback_id = preg_replace( '/[^\d]/', '', $video_fallback );
							$video_fallback_src = wp_get_attachment_image_src( $video_fallback_id, 'full' );
							if ( ! empty( $video_fallback_src[0] ) ) {
								$video_fallback_src = $video_fallback_src[0];
							}
						}
						
						$video_styles = '';
						if( ( isset( $video_height ) && $video_height != '' ) || $video_fallback_src != '' ) {
							$video_styles .= ' style="';
							if( isset( $video_height ) && $video_height != '' ) {
								$video_styles .= 'height:'. (int) $video_height.'px;';
							}
							if ( $video_fallback_src ) {
								$video_styles .= ' background-image: url( ' . $video_fallback_src . ');';
							}
							$video_styles .= ' "';
						}
						
						wp_enqueue_script( 'zozo-video-slider-js' );
						
						$output .= '<div class="pricing-video-wrapper">';
						
						$output .= '<div id="video-player-'. esc_attr( $video_count ) .'" class="pricing-video-player"'.$video_styles.'>';
						
							ob_start();	?>
						
							<div id="player-<?php echo esc_attr( $video_count );?>" class="zozo-yt-player bg-video-container" 
							data-property="{<?php echo "videoURL:'https://www.youtube.com/watch?v=".$video_id."',autoPlay:".$video_autoplay.""; ?>,showControls:false,mute:false,containment:'self',loop:false,startAt:0,opacity:1}" <?php echo 'style="height:'. (int) $video_height.'px;"'; ?>>
							</div>
							<?php if( isset( $video_controls ) && $video_controls == "true" ) { ?>
								<div id="video-controls-<?php echo esc_attr( $video_count ); ?>" class="zozo-video-controls">
									<a class="fa fa-pause" id="video-play" href="#"></a>
								</div>
							<?php } ?>
						
							<?php $output .= ob_get_clean();
						$output .= '</div>';
						
						$output .= '</div>';
					}
				}
				elseif( isset( $show_icon ) && $show_icon == 'yes' ) {
					// Icon
					if( isset( ${'icon_'. $type} ) && ${'icon_'. $type} != '' ) {
						$output .= '<div class="pricing-icon-wrapper">';
							$output .= '<i class="'. esc_attr( ${'icon_'. $type} ) .' pricing-icon"></i>';
						$output .= '</div>';
					}
				}
				
				// Content
				$output .= '<div class="pricing-features">';
					$output .= wpb_js_remove_wpautop( $content, true );
				$output .= '</div>';
								
				if( ( isset( $btn_link ) && $btn_link != '' ) || ( isset( $cost_position ) && $cost_position == 'before_button' ) ) {
					$output .= '<div class="pricing-bottom">';
					if( isset( $cost_position ) && $cost_position == 'before_button' ) {
						$output .= '<div class="pricing-cost-wrapper">';
						if( isset( $cost_before ) && $cost_before != '' ) {
							$output .= '<div class="pricing-starts">';
								$output .= $cost_before;
							$output .= '</div>';
						}
						if( isset( $cost ) && $cost != '' ) {
							$output .= '<div class="pricing-cost">';
								$output .= '<h3>'. $cost . '</h3>';
								if( isset( $cost_per ) && $cost_per != '' ) {
									$output .= '<span class="pricing-duration">'. $cost_per .'</span>';
								}
							$output .= '</div>';
						}
						$output .= '</div>';
					}
					
					if( isset( $btn_link ) && $btn_link != '' ) {
						$output .= '<a href="'. esc_url( $btn_link ) .'" title="'. esc_attr( $btn_title ) .'" target="'. esc_attr( $btn_target ) .'" class="btn btn-default btn-pricing">';
						$output .= $button_text;
						$output .= '</a>';
					}
					$output .= '</div>';
				}
				
				$output .= '</div>';
			$output .= '</div>';
		$output .= '</div>';
		
		$zozo_pricing_table++;
		
		return $output;
	}
}
add_shortcode( 'zozo_vc_pricing_table', 'zozo_vc_pricing_table_shortcode' );

if ( ! function_exists( 'zozo_vc_pricing_table_shortcode_map' ) ) {
	function zozo_vc_pricing_table_shortcode_map() {
		
		vc_map( 
			array(
				"name"					=> __( "Pricing Table", "zozothemes" ),
				"description"			=> __( "Insert a pricing table.", 'zozothemes' ),
				"base"					=> "zozo_vc_pricing_table",
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
					// Pricing Plan
					array(
						'type'			=> 'dropdown',
						'heading'		=> __( 'Featured', 'zozothemes' ),
						'param_name'	=> 'featured',
						'admin_label' 	=> true,
						'value'			=> array(
							__( 'No', 'zozothemes' )	=> 'no',
							__( 'Yes', 'zozothemes')	=> 'yes',
						),
						'group'			=> __( 'Plan', 'zozothemes' ),
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> __( 'Featured Text', 'zozothemes' ),
						'param_name'	=> 'featured_text',
						'admin_label' 	=> true,
						'group'			=> __( 'Plan', 'zozothemes' ),
						'std'			=> __( 'Offer', 'zozothemes' ),
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> __( 'Pricing Plan', 'zozothemes' ),
						'param_name'	=> 'plan',
						'admin_label' 	=> true,
						'group'			=> __( 'Plan', 'zozothemes' ),
						'std'			=> __( 'Basic', 'zozothemes' ),
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> __( 'Plan Extra Class', 'zozothemes' ),
						'param_name'	=> 'plan_extra_class',
						'group'			=> __( 'Plan', 'zozothemes' ),
					),
					array(
						'type'			=> 'colorpicker',
						'heading'		=> __( 'Plan Font Color', 'zozothemes' ),
						'param_name'	=> 'plan_color',
						'group'			=> __( 'Plan', 'zozothemes' ),
						'dependency'	=> array(
							'element'	=> 'plan',
							'not_empty'	=> true,
						),
					),
					
					// Cost
					array(
						'type'			=> 'textfield',
						'heading'		=> __( 'Cost Before Text', 'zozothemes' ),
						'param_name'	=> 'cost_before',
						'group'			=> __( 'Cost', 'zozothemes' ),
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> __( 'Cost', 'zozothemes' ),
						'param_name'	=> 'cost',
						'admin_label' 	=> true,
						'group'			=> __( 'Cost', 'zozothemes' ),
						'std'			=> '$99.9',
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> __( 'Per Text', 'zozothemes' ),
						'param_name'	=> 'cost_per',
						'group'			=> __( 'Cost', 'zozothemes' ),
					),
					array(
						'type'			=> 'colorpicker',
						'heading'		=> __( 'Cost Font Color', 'zozothemes' ),
						'param_name'	=> 'cost_color',
						'group'			=> __( 'Cost', 'zozothemes' ),
						'dependency'	=> array(
							'element'	=> 'cost',
							'not_empty'	=> true,
						),
					),
					array(
						'type'			=> 'dropdown',
						'heading'		=> __( 'Cost Position', 'zozothemes' ),
						'param_name'	=> 'cost_position',
						'admin_label' 	=> true,
						'value'			=> array(
							__( 'Default', 'zozothemes' )		=> '',
							__( 'Before Button', 'zozothemes')	=> 'before_button',
						),
						'dependency'	=> array(
							'element'	=> 'cost',
							'not_empty'	=> true,
						),
						'group'			=> __( 'Cost', 'zozothemes' ),
					),
					// Features
					array(
						'type'			=> 'textarea_html',
						'heading'		=> __( 'Features', 'zozothemes' ),
						'param_name'	=> 'content',
						'value'			=> '<ul>
												<li class="inactive">Wordpress</li>
												<li>HTML5 & CSS 3</li>
												<li>PSD Files</li>
												<li class="inactive">Unlimited Support</li>
											</ul>',
						'description'	=> __('Enter your pricing content.', 'zozothemes'),
						'group'			=> __( 'Features', 'zozothemes' ),
					),
					array(
						'type'			=> 'colorpicker',
						'heading'		=> __( 'Features Active Font Color', 'zozothemes' ),
						'param_name'	=> 'font_active_color',
						'group'			=> __( 'Features', 'zozothemes' ),
					),
					array(
						'type'			=> 'colorpicker',
						'heading'		=> __( 'Features InActive Font Color', 'zozothemes' ),
						'param_name'	=> 'font_inactive_color',
						'group'			=> __( 'Features', 'zozothemes' ),
					),
					array(
						'type'			=> 'colorpicker',
						'heading'		=> __( 'Features Divider Color', 'zozothemes' ),
						'param_name'	=> 'font_sep_color',
						'group'			=> __( 'Features', 'zozothemes' ),
					),
					// Image / Video
					array(
						"type"			=> "attach_image",
						"heading"		=> __( "Image", "zozothemes" ),
						"param_name"	=> "pricing_image",
						"value"			=> "",
						'group'			=> __( 'Image / Video', 'zozothemes' ),
					),
					array(
						"type"			=> "vc_link",
						"heading"		=> __( "Image Link", 'zozothemes' ),
						"param_name"	=> "image_url",
						"value"			=> "",
						'group'			=> __( 'Image / Video', 'zozothemes' ),
						'dependency'	=> array(
							'element'	=> 'pricing_image',
							'not_empty'	=> true,
						),
					),
					array(
						'type'			=> 'checkbox',
						'heading'		=> __( 'Enable Video?', 'zozothemes' ),
						'param_name'	=> 'video',
						'description'	=> __( 'Check this box to enable video for this pricing table.', 'zozothemes' ),
						'value'			=> array(
							__( 'Yes, please', 'zozothemes' )	=> 'yes'
						),
						'group'			=> __( 'Image / Video', 'zozothemes' ),
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> __( 'Video ID', 'zozothemes' ),
						'param_name'	=> 'video_id',
						'description'	=> __( 'Enter Youtube Video ID. Ex: Y-OLlJUXwKU', 'zozothemes' ),
						'dependency'	=> array(
							'element'	=> 'video',
							'value'		=> 'yes'
						),
						'group'			=> __( 'Image / Video', 'zozothemes' ),
					),
					array(
						'type'			=> 'attach_image',
						'heading'		=> __( 'Video Fallback Image', 'zozothemes' ),
						'param_name'	=> 'video_fallback',
						'value'			=> '',
						'dependency'	=> array(
							'element'	=> 'video',
							'value'		=> 'yes'
						),
						'group'			=> __( 'Image / Video', 'zozothemes' ),
					),
					array(
						'type'			=> 'dropdown',
						'heading'		=> __( 'Video Autoplay', 'zozothemes' ),
						'param_name'	=> 'video_autoplay',
						'value'			=> array(
							__( 'Yes', 'zozothemes' )	=> 'true',
							__( 'No', 'zozothemes' )	=> 'false',
						),
						'dependency'	=> array(
							'element'	=> 'video',
							'value'		=> 'yes'
						),
						'group'			=> __( 'Image / Video', 'zozothemes' ),
					),
					array(
						'type'			=> 'dropdown',
						'heading'		=> __( 'Video Controls', 'zozothemes' ),
						'param_name'	=> 'video_controls',
						'value'			=> array(		
							__( 'No', 'zozothemes' )	=> 'false',
							__( 'Yes', 'zozothemes' )	=> 'true',
						),
						'dependency'	=> array(
							'element'	=> 'video',
							'value'		=> 'yes'
						),
						'group'			=> __( 'Image / Video', 'zozothemes' ),
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> __( 'Video Height', 'zozothemes' ),
						'param_name'	=> 'video_height',
						'description'	=> __( 'Enter Video Height. Ex: 150', 'zozothemes' ),
						'dependency'	=> array(
							'element'	=> 'video',
							'value'		=> 'yes'
						),
						'group'			=> __( 'Image / Video', 'zozothemes' ),
					),
					// Icon
					array(
						'type'			=> 'checkbox',
						'heading'		=> __( 'Show Icon?', 'zozothemes' ),
						'param_name'	=> 'show_icon',
						'description'	=> __( 'Check this box to show icon for this pricing table.', 'zozothemes' ),
						'value'			=> array(
							__( 'Yes, please', 'zozothemes' )	=> 'yes'
						),
						'group'			=> __( 'Icon', 'zozothemes' ),
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
						"dependency" 	=> array(
							"element" 	=> "show_icon",
							"value" 	=> "yes",
						),
						"group"			=> __( "Icon", "zozothemes" ),
					),					
					array(
						"type" 			=> 'iconpicker',
						"heading" 		=> __( "Pricing Icon", "zozothemes" ),
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
						"heading" 		=> __( "Pricing Icon", "zozothemes" ),
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
						"heading" 		=> __( "Pricing Icon", "zozothemes" ),
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
						"heading" 		=> __( "Pricing Icon", "zozothemes" ),
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
						"heading" 		=> __( "Pricing Icon", "zozothemes" ),
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
						"heading" 		=> __( "Pricing Icon", "zozothemes" ),
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
						'type'			=> 'colorpicker',
						'heading'		=> __( 'Icon Border Color', 'zozothemes' ),
						'param_name'	=> 'icon_br_color',
						"dependency" 	=> array(
							"element" 	=> "show_icon",
							"value" 	=> "yes",
						),
						'group'			=> __( 'Icon', 'zozothemes' ),
					),
					array(
						"type"			=> "vc_link",
						"heading"		=> __( "Button URL", "zozothemes" ),
						"param_name"	=> "button_url",
						"value"			=> "",
						"group"			=> __( "Button", "zozothemes" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Button Text", "zozothemes" ),
						"param_name"	=> "button_text",
						"group"			=> __( "Button", "zozothemes" ),
					),
				)
			) 
		);
	}
}
add_action( 'vc_before_init', 'zozo_vc_pricing_table_shortcode_map' );