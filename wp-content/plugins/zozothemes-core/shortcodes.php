<?php
/* =========================================================
 * Alert Shortcode
 * ========================================================= */
function zozo_alert_shortcode( $atts, $content = null ) {
	$atts = extract(shortcode_atts(
			array(
				'type' 				=> 'info',
				'close' 			=> 'no',
				'animation_type' 	=> 'none',
				'animation_delay' 	=> '',
			), $atts));
			
	$close_btn = $animation_class = $extra_data = '';
			
	if( $close == 'yes' ) {
		$close_btn = '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>';
	}
	
	if( $animation_type != '' && $animation_type != 'none' ) {
		$animation_class = ' animated';
		$extra_data = ' data-animation="'.$animation_type.'"';
	}
	
	if( $animation_delay != '' && $animation_type != 'none' ) {
		$extra_data .= ' data-animation-delay="'.$animation_delay.'"';
	}
  
	return '<div role="alert" class="alert fade in alert-'.esc_attr( $type ).''.esc_attr( $animation_class ).'"'.$extra_data.'>'. $close_btn . do_shortcode( str_replace('<br />', '', $content) ) . '</div>';
}
add_shortcode('zozo_alert', 'zozo_alert_shortcode');

/* =========================================================
 * Button Shortcode
 * ========================================================= */
function zozo_button_shortcode( $atts, $content = null ) {
	$atts = extract(shortcode_atts(
			array(
				'url' 					=> '',
				'style' 				=> 'default',
				'size' 					=> 'default',
				'color' 				=> '',
				'hover_color' 			=> '',
				'bg_color' 				=> '',
				'bg_hover_color' 		=> '',
				'border_width'			=> '',
				'border_color' 			=> '',
				'border_hover_color' 	=> '',
				'icon' 					=> '',
				'icon_pos' 				=> '',
				'extra_class'			=> '',
				'animation_type' 		=> 'none',
				'animation_delay' 		=> '',
				'target' 				=> '',
			), $atts));
			
	static $zozo_button_id = 1;
	$output = $styles = $icon_left = $icon_right = $animation_class = $extra_data = $btn_sizes = $color_styles = $hover_styles = '';
	
	if( $color != '' ) {		
		$color_styles = sprintf( 'color:%s;', $color );		
	}
	
	if( $hover_color != '' ) {
		$hover_styles = sprintf( 'color:%s;', $hover_color );
	} else {
		$hover_styles = sprintf( 'color:%s;', $color );
	}
	
	if( $style == 'custom' && $bg_color != '' ) {
		$color_styles .= sprintf( 'background-color:%s;', $bg_color );
	}
	
	if( $style == 'custom' && $bg_hover_color != '' ) {
		$hover_styles .= sprintf( 'background-color:%s;', $bg_hover_color );
	} else if( $style == 'custom' && $bg_hover_color == '' ) {
		$hover_styles .= sprintf( 'background-color:%s;', $bg_color );
	}
	
	if( $style == 'custom' && $border_width != '' || $border_color != '' ) {
		if( $border_width == '' ) {
			$border_width = 1;
		}
		$color_styles .= sprintf( 'border:%spx solid %s;', $border_width, $border_color );
	}
	
	if( $style == 'custom' && $border_hover_color != '' ) {
		$hover_styles .= sprintf( 'border-color:%s;', $border_hover_color );
	}
	
	if( $style == 'custom' && $bg_color != '' || $color != '' ) {
		$styles .= '<style type="text/css" scoped="scoped">';
		$styles .= sprintf( 'a.zozo-button-%s{%s}', $zozo_button_id, $color_styles );
		$styles .= sprintf( 'a.zozo-button-%s:hover, a.zozo-button-%s:active, a.zozo-button-%s:focus{%s}', $zozo_button_id, $zozo_button_id, $zozo_button_id, $hover_styles );
		$styles .= '</style>';
	}
	
	if( $size ) {
		if( $size == 'large' ) $btn_sizes = 'btn-lg';
		if( $size == 'small' ) $btn_sizes = 'btn-sm';
		if( $size == 'mini' ) $btn_sizes = 'btn-xs';
		if( $size == 'wide' ) $btn_sizes = ' btn-wide';
	}
	
	if( $animation_type != '' && $animation_type != 'none' ) {
		$animation_class = ' animated';
		$extra_data = ' data-animation="'.$animation_type.'"';
	}
	
	if( $animation_delay != '' && $animation_type != 'none' ) {
		$extra_data .= ' data-animation-delay="'.$animation_delay.'"';
	}
	
	if( $icon != '' && $icon_pos == "left" ) {
		$icon_left = '<i class="fa fa-'.$icon.'"></i> ';
	}
	
	elseif( $icon != '' && $icon_pos == "right" ) {
		$icon_right = ' <i class="fa right-align fa-'.$icon.'"></i>';
	}
	
	$output = $styles . '<a class="zozo-button-'.$zozo_button_id.' btn btn-'.$style.' '. $btn_sizes . $animation_class.'  '.$extra_class.'" href="'.esc_url($url).'" target="'.$target.'"'.$extra_data.'>'. $icon_left . do_shortcode($content) . $icon_right .'</a>';
	
	$zozo_button_id++;
  
	return $output;
}
add_shortcode('zozo_button', 'zozo_button_shortcode');
	
/* =========================================================
 * Columns Shortcode
 * ========================================================= */ 
function zozo_columns_shortcode( $atts, $content = null ) {
	$atts = extract(shortcode_atts(
			array(
				'container' 		=> 'no',
				'container_class' 	=> '',
			), $atts));
			
	$output = $extra_class = '';
	
	if( isset( $container_class ) && $container_class != '' ) {
		$extra_class = ' ' . $container_class;
	}
	if( isset( $container ) && $container == 'yes' ) {
		$output .= '<div class="container'.$extra_class.'">';
	}
	
	$output .= '<div class="row">';
	$output .= do_shortcode( str_replace('<br />', '', $content) );
	$output .= '</div>';
	
	if( isset( $container ) && $container == 'yes' ) {
		$output .= '</div>';
	}
	return $output;
}
add_shortcode('zozo_columns', 'zozo_columns_shortcode');

function zozo_column_shortcode( $atts, $content = null ) {
	$atts = extract(shortcode_atts(
			array(
				'size' 				=> '6',
				'column_class' 		=> '',
				'animation_type' 	=> '',
				'animation_delay' 	=> '',
			), $atts));
			
	$animation_class = $extra_data = '';
			
	if( $animation_type != '' && $animation_type != 'none' ) {
		$animation_class = ' animated';
		$extra_data = ' data-animation="'.$animation_type.'"';
	}
	
	if( $animation_delay != '' && $animation_type != 'none' ) {
		$extra_data .= ' data-animation-delay="'.$animation_delay.'"';
	}
			  
	return '<div class="col-md-'.$size.''.$animation_class.' '.$column_class.'"'.$extra_data.'>'. do_shortcode($content) . '</div>';
}
add_shortcode('zozo_column', 'zozo_column_shortcode');

/* =========================================================
 * Client Slider Shortcode
 * ========================================================= */ 
function zozo_client_slider_shortcode( $atts, $content = null ) {
	static $zozo_clients = 1;
	
	extract(shortcode_atts(
		array(				
			'items' 			=> '5',
			'itemsscroll' 		=> '1',
			'itemsdesktopsmall' => '4',
			'itemstablet' 		=> '2',					
			'itemsmobile' 		=> '1',
			'navigation' 		=> '',
			'pagination' 		=> '',
			'autoplay' 			=> 'true',
			'duration' 			=> '5000',
			'margin' 			=> '0',
			'loop' 				=> 'false',
		), $atts));
	
	$data_attr = '';
	
	if( isset( $items ) && $items != '' ) {
		$data_attr .= ' data-items="' . $items . '" ';
	}
	
	if( isset( $itemsscroll ) && $itemsscroll != '' ) {
		$data_attr .= ' data-slideby="' . $itemsscroll . '" ';
	}
	
	if( isset( $itemsdesktopsmall ) && $itemsdesktopsmall != '' ) {
		$data_attr .= ' data-items-tablet="' . $itemsdesktopsmall . '" ';
	}
	
	if( isset( $itemstablet ) && $itemstablet != '' ) {
		$data_attr .= ' data-items-mobile-landscape="' . $itemstablet . '" ';
	}
	
	if( isset( $itemsmobile ) && $itemsmobile != '' ) {
		$data_attr .= ' data-items-mobile-portrait="' . $itemsmobile . '" ';
	}
	
	if( isset( $autoplay ) && $autoplay != '' ) {
		$data_attr .= ' data-autoplay="' . $autoplay . '" ';
	}
	if( isset( $duration ) && $duration != '' ) {
		$data_attr .= ' data-autoplay-timeout="' . $duration . '" ';
	}
	
	if( isset( $loop ) && $loop != '' ) {
		$data_attr .= ' data-loop="' . $loop . '" ';
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
	
	$output = '';
	$output = '<div class="zozo-client-slider-wrapper">';
		$output .= '<div id="zozo-client-slider-' . $zozo_clients. '" class="zozo-owl-carousel zozo-client-slider owl-carousel"' . $data_attr . '>';
			$output .= do_shortcode(strip_tags($content));
		$output .= '</div>';
	$output .= '</div>';
	
	$zozo_clients++;
	
	return $output;
}
add_shortcode('zozo_client_slider', 'zozo_client_slider_shortcode');

function zozo_client_shortcode( $atts, $content = null ) {
	$atts = extract(shortcode_atts(
			array(
				'link' 		=> '',
				'target' 	=> '_self',
				'image' 	=> '',
				'alt' 		=> '',
			), $atts));
			
	$output = '';
	
	$output .= '<div class="client-item">';
	if( $link != '' ) {
		$output .= '<a href="'.esc_url($link).'" target="'.$target.'"><img src="'.esc_url($image).'" alt="'.esc_attr($alt).'" class="img-responsive" /></a>';
	} else {
		$output .= '<img src="'.esc_url($image).'" alt="'.esc_attr($alt).'" class="img-responsive" />';
	}
	$output .= '</div>';
	
	return $output;
}
add_shortcode('zozo_client', 'zozo_client_shortcode');

/* =========================================================
 * Counters Shortcode
 * ========================================================= */ 
function zozo_counters_shortcode( $atts, $content = null ) {
	$output = '';
	$output = '<div class="zozo-counter-wrapper">';
	$output .= do_shortcode( str_replace('<br />', '', $content) );
	$output .= '</div>';
	return $output;
}
add_shortcode('zozo_counters', 'zozo_counters_shortcode');

function zozo_counter_shortcode( $atts, $content = null ) {
	$atts = extract(shortcode_atts(
			array(
				'title' 			=> '',
				'value' 			=> '',				
				'icon'				=> '',
				'iconsize' 			=> '',
				'iconcolor'       	=> '',
				'titlecolor' 		=> '',
				'animation_type' 	=> '',
				'animation_delay' 	=> '',
			), $atts));
	
	$output = $column_class = $inline_style = $icon_style = $countercolor = $title_style = '';
	$animation_class = $extra_data = '';
	
	if( $animation_type != '' && $animation_type != 'none' ) {
		$animation_class = ' animated';
		$extra_data = ' data-animation="'.$animation_type.'"';
	}
	
	if( $animation_delay != '' && $animation_type != 'none' ) {
		$extra_data .= ' data-animation-delay="'.$animation_delay.'"';
	}
	
	if( $titlecolor != '' ) {
		$title_style = ' style="color: '.$titlecolor.';"';
	}
	
	if( $iconsize != '' || $iconcolor != '' ) {
		$icon_style = ' style="';
		
		if( $iconsize != '' ) {
			$icon_style .= 'font-size: '.$iconsize.';';
		}
		
		if( $iconcolor != '' ) {
			$icon_style .= 'color: '.$iconcolor.';';
		}
		$icon_style .= '"';	
	}
	
	$output .= '<div class="counter-item zozo-counter'. $animation_class.'"'.$extra_data.'>';
	
		if( $icon != '' ) {
			$output .= '<div class="counter-icon">';
			$output .= '<i class="fa fa-'.$icon.'"'.$icon_style.'></i>';
			$output .= '</div>';
		}
		$output .= '<div class="counter-info">';				
			$output .= '<div class="zozo-count-number text-center" data-count="'.$value.'">';
				$output .= '<h3 class="counter zozo-counter-count"'.$countercolor.'></h3>';
			$output .= '</div>';
			$output .= '<div class="counter-title text-center"'.$title_style.'>';
				$output .= '<h5>' . esc_html( $title ) .'</h5>';
			$output .= '</div>';
		$output .= '</div>';
		
	$output .= '</div>';
	
	return $output;
}
add_shortcode('zozo_counter', 'zozo_counter_shortcode');

/* =========================================================
 * Dropcap Shortcode
 * ========================================================= */ 
function zozo_dropcap_shortcode( $atts, $content = null ) {
	$atts = extract(shortcode_atts(
			array(
				'color' 	=> '',				
			), $atts));
	
	if( $color != '' ) {
		$styles = sprintf( 'color:%s;', $color );
		$inline_style = sprintf( ' style=%s', $styles );
	}
	
	return '<p class="dropcap-container"><span class="dropcap"'.$inline_style.'>'. do_shortcode($content) . '</span></p>';	
}
add_shortcode('zozo_dropcap', 'zozo_dropcap_shortcode');

/* =========================================================
 * Highlight Shortcode
 * ========================================================= */ 
function zozo_highlight_shortcode( $atts, $content = null ) {
	$atts = extract(shortcode_atts(
			array(
				'bg_color' 	=> '',
				'color' 	=> '',
			), $atts));
	
	if( $color != '' || $bg_color != '' ) {
		$styles = sprintf( 'color:%s;', $color );
		$styles .= sprintf( 'background-color:%s;', $bg_color );
		$inline_style = sprintf( ' style=%s', $styles );
	}
	
	return '<span class="label"'.$inline_style.'>'. do_shortcode($content) . '</span>';	
}
add_shortcode('zozo_highlight', 'zozo_highlight_shortcode');

/* =========================================================
 * List Item Shortcode
 * ========================================================= */ 
function zozo_listitem_shortcode( $atts, $content = null ) {
	$atts = extract(shortcode_atts(
			array(
				'icon' 			 	=> '',
				'iconcolor' 	 	=> '',
				'iconbgcolor' 	 	=> '',
				'icontype'  	 	=> '',
				'listinline' 	 	=> '',
				'animation_type' 	=> '',
				'animation_delay'	=> '',
			), $atts));
			
	static $zozo_list_id = 1;
	$output = $extra_class = $icon_class = $icon_styles = $animation_class = $extra_data = '';
	
	if( $icon != '' ) {
		$icon_class = sprintf( 'fa-%s', $icon );
		$icon_styles = 'font-family: FontAwesome;';
		$extra_class = ' icon';
	}
	
	if( $iconcolor != '' ) {
		$icon_styles .= sprintf( 'color:%s;', $iconcolor );
	}
	
	if( $icontype != 'none' ) {
		$icon_styles .= sprintf( 'background-color:%s;', $iconbgcolor );
		$extra_class .= sprintf( ' %s', $icontype );
	}
	
	if( $animation_type != '' && $animation_type != 'none' ) {
		$animation_class = ' animated';
		$extra_data = ' data-animation="'.$animation_type.'"';
	}
	
	if( $animation_delay != '' && $animation_type != 'none' ) {
		$extra_data .= ' data-animation-delay="'.$animation_delay.'"';
	}
	
	if( $listinline == 'yes' ) {
		$extra_class .= ' list-inline';
	}
	
	if( $icon != '' ) {	
		$output .= "<style type='text/css'>#zozo-list-item-{$zozo_list_id} li:before{ {$icon_styles} };</style>";
	}
	
	$output .= str_replace('<ul>', '<ul id="zozo-list-item-'.$zozo_list_id.'" class="zozo-listitem'. $extra_class . $animation_class .'"'.$extra_data.'>', $content);
	if( $icon_class != '' ) {
		$output = str_replace('<li>', '<li class="'.$icon_class.'">', $output);
	} else {
		$output = str_replace('<li>', '<li><span class="custom-icon"></span>', $output);
	}
	
	$zozo_list_id++;
	
	return $output;
}
add_shortcode('zozo_listitem', 'zozo_listitem_shortcode');

/* =========================================================
 * FontAwesome Icons Shortcode
 * ========================================================= */ 
function zozo_fontawesome_shortcode( $atts, $content = null ) {
	$atts = extract(shortcode_atts(
			array(
				'icon' 				=> '',
				'icontype' 			=> '',
				'iconstyle' 		=> '',
				'size' 				=> '',
				'iconcolor'			=> '',
				'iconbgcolor' 		=> '',
				'bordercolor' 		=> '',
				'borderwidth' 		=> '',
				'animation_type'	=> '',
				'animation_delay'	=> '',
			), $atts));
			
	$styles = $extra_class = $inline_style = $animation_class = $extra_data = '';
	
	if( $iconcolor != '' ) {
		$styles = sprintf( 'color:%s;', $iconcolor );
	}
	
	if( $bordercolor != '' ) {
		if( $borderwidth == '' ) {
			$borderwidth = 1;
		} 
		$styles .= sprintf( ' border:%spx solid %s;', $borderwidth, $bordercolor );
	}
	
	if( $icontype != 'none' ) {
		if( $iconbgcolor != '' ) {
			$styles .= sprintf( ' background-color:%s;', $iconbgcolor );
		}
		$extra_class .= sprintf( ' icon-%s', $icontype );
	} else {
		$extra_class .= ' icon-plain';
	}
	
	if( $size ) {		
		$extra_class .= sprintf( ' icon-%s', $size );
	}	
	
	if( $iconstyle ) {		
		$extra_class .= sprintf( ' icon-%s', $iconstyle );
	}
	
	if( $iconcolor != '' || $bordercolor != '' || $iconbgcolor != '' ) {	
		$inline_style = ' style="'.$styles.'"';
	}
				
	if( $animation_type != '' && $animation_type != 'none' ) {
		$animation_class = ' animated';
		$extra_data = ' data-animation="'.$animation_type.'"';
	}
	
	if( $animation_delay != '' && $animation_type != 'none' ) {
		$extra_data .= ' data-animation-delay="'.$animation_delay.'"';
	}
	
	return '<i class="zozo-icon '. $icon . $extra_class . $animation_class .'"'.$inline_style.''.$extra_data.'></i>';	
}
add_shortcode('zozo_fontawesome', 'zozo_fontawesome_shortcode');

/* =========================================================
 * Icons Shortcode
 * ========================================================= */ 
function zozo_icons_shortcode( $atts, $content = null ) {
	$atts = extract(shortcode_atts(
			array(
				'icon' 				=> '',
				'icontype' 			=> '',
				'iconstyle' 		=> '',
				'size' 				=> '',
				'iconcolor'			=> '',
				'iconbgcolor' 		=> '',
				'bordercolor' 		=> '',
				'borderwidth' 		=> '',
				'animation_type'	=> '',
				'animation_delay'	=> '',
			), $atts));
			
	$styles = $extra_class = $inline_style = $animation_class = $extra_data = '';
	
	if( $iconcolor != '' ) {
		$styles = sprintf( 'color:%s;', $iconcolor );
	}
	
	if( $bordercolor != '' ) {
		if( $borderwidth == '' ) {
			$borderwidth = 1;
		}
		$styles .= sprintf( ' border:%spx solid %s;', $borderwidth, $bordercolor );
	}
	
	if( $icontype != 'none' ) {
		$styles .= sprintf( ' background-color:%s;', $iconbgcolor );		
		$extra_class .= sprintf( ' icon-%s', $icontype );
	} else {
		$extra_class .= ' icon-plain';
	}
	
	if( $size ) {		
		$extra_class .= sprintf( ' icon-%s', $size );
	}
	
	if( $iconstyle ) {		
		$extra_class .= sprintf( ' icon-%s', $iconstyle );
	}
	
	if( $iconcolor != '' || $bordercolor != '' || $iconbgcolor != '' ) {	
		$inline_style = ' style="'.$styles.'"';	
	}
				
	if( $animation_type != '' && $animation_type != 'none' ) {
		$animation_class = ' animated';
		$extra_data = ' data-animation="'.$animation_type.'"';
	}
	
	if( $animation_delay != '' && $animation_type != 'none' ) {
		$extra_data .= ' data-animation-delay="'.$animation_delay.'"';
	}
	
	return '<i class="zozo-icon '. $icon . $extra_class . $animation_class .'"'.$inline_style.''.$extra_data.'></i>';	
}
add_shortcode('zozo_icons', 'zozo_icons_shortcode');

/* =========================================================
 * Blockquote Shortcode
 * ========================================================= */ 
function zozo_blockquote_shortcode( $atts, $content = null ) {
	$atts = extract(shortcode_atts(
			array(
				'footer_text' 		=> '',
				'position' 			=> '',
				'animation_type' 		=> '',
				'animation_delay' 		=> '',
			), $atts));
	
	$extra_class = $author_html = $extra_data = '';
	
	if( $position == 'right' ) {
		$extra_class = ' blockquote-reverse';
	}
	
	if( $footer_text != '' ) {
		$author_html = '<footer>'. $footer_text . '</footer>';
	}
	
	if( $animation_type != '' && $animation_type != 'none' ) {
		$extra_class .= ' animated';
		$extra_data = ' data-animation="'.$animation_type.'"';
	}
	
	if( $animation_delay != '' && $animation_type != 'none' ) {
		$extra_data .= ' data-animation-delay="'.$animation_delay.'"';
	}
	
	$output = '';
	
	$output = '<blockquote class="zozo-blockquote'.$extra_class.'"'.$extra_data.'><p>' . do_shortcode($content) . '</p>'. $author_html . '</blockquote>';
	
	return $output;	
}
add_shortcode('zozo_blockquote', 'zozo_blockquote_shortcode');

/* =========================================================
 * Bootstrap Carousel Shortcode
 * ========================================================= */ 
function zozo_carousel_shortcode( $atts, $content = null ) {

	static $zozo_carousel = 1;
	$output = '';
	
	$output .= '<script type="text/javascript">';
	$output .= 'jQuery(document).ready(function($){';	
	$output .= '$("#zozo-carousel-'.$zozo_carousel.'").find(".item:first").addClass("active");';
	$output .= '});';
	$output .= '</script>';
	$output .= '<div id="zozo-carousel-'.$zozo_carousel.'" class="carousel slide" data-ride="carousel">';
	$output .= '<div class="carousel-inner">';
	$output .= do_shortcode( $content );
	$output .= '</div>';
	$output .= '<a class="left carousel-control" href="#zozo-carousel-'.$zozo_carousel.'" data-slide="prev">';
    $output .= '<span class="glyphicon glyphicon-chevron-left"></span>';
	$output .= '</a>';
	$output .= '<a class="right carousel-control" href="#zozo-carousel-'.$zozo_carousel.'" data-slide="next">';
	$output .= '<span class="glyphicon glyphicon-chevron-right"></span>';
	$output .= '</a>';
	$output .= '</div>';
	
	$zozo_carousel++;
	
	return $output;	
}
add_shortcode('zozo_carousel', 'zozo_carousel_shortcode');

function zozo_image_shortcode( $atts, $content = null ) {
	
	$atts = extract(shortcode_atts(
			array(
				'linktype' 	=> 'lightbox',
				'link' 	 	=> '',
				'target' 	=> '',
				'image'  	=> '',
				'alt' 	 	=> '',
				'caption' 	=> '',
			), $atts));
		
	$output = $lightbox_class = '';
	
	if( $linktype == 'link' ) {
		$url = $link;
	}
	elseif( $linktype == 'lightbox' ) {
		$url = $image;
		$lightbox_class = ' data-rel="prettyPhoto"';
	}
	$output = '<div class="item">';
		if( $image != '' ) {
			if( $linktype == 'none' ) {
				$output .= '<img src="'.esc_url($image).'" alt="'.esc_attr($alt).'" class="img-responsive" />';
			}
			else {
				$output .= '<a class="carousel-image" href="'.esc_url($url).'"'.$lightbox_class.' target="'.$target.'"><img src="'.esc_url($image).'" alt="'.esc_attr($alt).'" class="img-responsive" /></a>';
			}
		}
		if( $caption != '' ) {
			$output .= '<div class="carousel-caption">'.$caption.'</div>';
		}
	$output .= '</div>';
	
	return $output;
}
add_shortcode('zozo_image', 'zozo_image_shortcode');

/* =========================================================
 * Image Frame Shortcode
 * ========================================================= */ 
function zozo_imageframe_shortcode( $atts, $content = null ) {
	$atts = extract(shortcode_atts(
			array(
				'shape' 		 	=> 'none',
				'shadow' 		 	=> 'no',
				'bordercolor' 	 	=> '',
				'borderwidth' 	 	=> '',
				'lightbox' 		 	=> 'no',
				'src' 			 	=> '',
				'alt' 			 	=> '',
				'animation_type' 	=> '',
				'animation_delay' 	=> ''
			), $atts));
	
	static $zozo_image_frame = 1;
	
	$output = '';
	$animation_class = $img_shape = $extra_data = $extra_class = '';
	
	if( $shape != 'none' ) {
		$img_shape = 'img-' . $shape . ' ';
	}
	
	if( $shadow != 'none' ) {
		$extra_class = ' ' . $shadow;
	}
	
	if( $animation_type != '' && $animation_type != 'none' ) {
		$animation_class = ' animated';
		$extra_data = ' data-animation="'.$animation_type.'"';
	}
	
	if( $animation_delay != '' && $animation_type != 'none' ) {
		$extra_data .= ' data-animation-delay="'.$animation_delay.'"';
	}
	
	if( $bordercolor != '' ) {
		if( !$borderwidth ) {
			$borderwidth = '1px';
		}
		$output = '<style type="text/css" scoped>';
		if( isset( $shape ) && $shape == 'angle' ) {
			$output .= '#zozo-imgframe-'.$zozo_image_frame.' .imgframe-wrapper { border-bottom: '.$borderwidth.'px solid '.$bordercolor.'; border-right: '.$borderwidth.'px solid '.$bordercolor.'; }';
			$output .= '#zozo-imgframe-'.$zozo_image_frame.' img { border-top: '.$borderwidth.'px solid '.$bordercolor.'; border-left: '.$borderwidth.'px solid '.$bordercolor.'; }';
		} else {
			$output .= '#zozo-imgframe-'.$zozo_image_frame.' img { border: '.$borderwidth.'px solid '.$bordercolor.'; }';
		}
		$output .= '</style>';
	}
	
	$attachment_id = zozo_get_attachment_id_from_url($src);
	$full_image = wp_get_attachment_image_src( $attachment_id, 'full' );
	
	$output .= '<div id="zozo-imgframe-'.$zozo_image_frame.'" class="zozo-imageframe img-shape-' . $shape . ''.$animation_class.$extra_class.'"'.$extra_data.'>';	
	$output .= '<div class="imgframe-wrapper">';
	
	if( $lightbox == 'yes' ) {
		$output .= '<a href="'.esc_url($full_image[0]).'" data-rel="prettyPhoto" title="'.esc_attr($alt).'">';
	}
	
	$output .= '<img src="'.esc_url($src).'" alt="'.esc_attr($alt).'" class="'.esc_attr($img_shape).'img-responsive" />';
	
	if( $lightbox == 'yes' ) {
		$output .= '</a>';
	}
	
	$output .= '</div>';
	$output .= '</div>';
	
	$zozo_image_frame++;
	
	return $output;
}
add_shortcode('zozo_imageframe', 'zozo_imageframe_shortcode');

/* =========================================================
 * Progress Bars Shortcode
 * ========================================================= */ 
function zozo_progress_bar_shortcode( $atts, $content = null ) {
	$atts = extract(shortcode_atts(
			array(
				'title' 		=> '',
				'percentage' 	=> '',
				'filledcolor' 	=> '',
				'unfilledcolor' => '',
				'animation' 	=> '',
			), $atts));
			
	$progress_class = $extra_style = $filledcolor_style = '';
	
	if( $filledcolor != '' ) {
		$filledcolor_style = ' style="background-color: '.$filledcolor.';"';
	}
	
	if( $unfilledcolor != '' ) {
		$extra_style = ' style="background-color: '.$unfilledcolor.';"';
	}
	
	if( $animation == 'yes' ) {
		$progress_class = " progress-striped active";
	}
	
	$output = '';
	
	$output .= '<div class="zozo-sc-progress-bar">';
		if( $title != '' ) {
			$output .= '<h5 class="progress-bar-title">'.$title.'<span>'.do_shortcode($content).'</span></h5>';
		}
		$output .= '<div class="zozo-progress-bar progress'.$progress_class.'"'.$extra_style.'>';
			$output .= '<div class="progress-bar" role="progressbar" aria-valuenow="'.$percentage.'" aria-valuemin="0" aria-valuemax="100"'.$filledcolor_style.'>';			
			$output .= '</div>';
		$output .= '</div>';
	$output .= '</div>';

	return $output;	
}
add_shortcode('zozo_progress_bar', 'zozo_progress_bar_shortcode');

/* =========================================================
 * Jumbotron Shortcode
 * ========================================================= */
function zozo_jumbotron_shortcode( $atts, $content = null ) {
	$atts = extract(shortcode_atts(
			array(
				'title' 				=> '',
				'show_button' 			=> 'no',
				'bg_image' 				=> '',
				'bg_repeat' 			=> 'no-repeat',
				'bg_color' 				=> '',
				'content_color'			=> '',
				'borderradius'			=> '',
				'button_text' 			=> '',
				'button_link' 			=> '',
				'target' 				=> '',
				'size' 					=> '',
				'button_bg_color'		=> '',
				'button_bg_hover_color'	=> '',
				'color' 				=> '',
				'hovercolor' 			=> '',
				'icon' 					=> '',
				'icon_pos' 				=> '',
				'animation_type'		=> '',
				'animation_delay'		=> '',
			), $atts));
			
	static $zozo_jumbo_button_id = 1;
	
	$animation_class = $extra_data = $color_styles = $hover_styles = $container_styles = $btn_sizes = $icon_left = $icon_right = $styles = '';
		
	if( $animation_type != '' && $animation_type != 'none' ) {
		$animation_class = ' animated';
		$extra_data = ' data-animation="'.$animation_type.'"';
	}
	
	if( $animation_delay != '' && $animation_type != 'none' ) {
		$extra_data .= ' data-animation-delay="'.$animation_delay.'"';
	}
	
	if( $color != '' ) {		
		$color_styles = sprintf( 'color:%s;', $color );		
	}
	
	if( $hovercolor != '' ) {		
		$hover_styles = sprintf( 'color:%s;', $hovercolor );
	}
	
	if( $bg_image != '' ) {
		$container_styles .= sprintf( 'background-image:url(%s);', $bg_image );
	}
	
	if( $bg_image != '' && $bg_repeat != '' ) {
		$container_styles .= sprintf( 'background-repeat:%s;', $bg_repeat );
	}
	
	if( $bg_color != '' ) {
		$container_styles .= sprintf( 'background-color:%s;', $bg_color );
	}
	
	if( $content_color != '' ) {
		$container_styles .= sprintf( 'color:%s;', $content_color );
	}
	
	if( $borderradius != '' ) {
		$container_styles .= 'border-radius:'.$borderradius.'; -moz-border-radius: '.$borderradius.'; -webkit-border-radius: '.$borderradius.'; -o-border-radius: '.$borderradius.'; -ms-border-radius: '.$borderradius.';';
	}
	
	if( $button_bg_color != '' ) {
		$color_styles .= sprintf( 'background-color:%s;', $button_bg_color );
	}
	
	if( $button_bg_hover_color != '' ) {
		$hover_styles .= sprintf( 'background-color:%s;', $button_bg_hover_color );
	}
	
	if( $button_bg_color != '' || $color != '' || $bg_image != '' || $bg_color != '' ) {
		$styles .= '<style type="text/css">';
		if( $button_bg_color != '' || $color != '' ) {
			$styles .= sprintf( 'a.zozo-jumbo-button-%s{%s}', $zozo_jumbo_button_id, $color_styles );
			$styles .= sprintf( 'a.zozo-jumbo-button-%s:hover{%s}', $zozo_jumbo_button_id, $hover_styles );
		}
		
		if( $bg_image != '' || $bg_color != '' ) {
			$styles .= sprintf( '.jumbotron.zozo-jumbotron-%s{%s}', $zozo_jumbo_button_id, $container_styles );	
		}
		
		$styles .= '</style>';
	}
	
	if( $size ) {
		if( $size == 'large' ) $btn_sizes = 'btn-lg';
		if( $size == 'small' ) $btn_sizes = 'btn-sm';
		if( $size == 'mini' ) $btn_sizes = 'btn-xs';
	}
	
	if( $icon != '' && $icon_pos == "left" ) {
		$icon_left = '<i class="fa fa-'.$icon.'"></i> ';
	}
	
	elseif( $icon != '' && $icon_pos == "right" ) {
		$icon_right = ' <i class="fa fa-'.$icon.'"></i>';
	}
	
	$output = '';
	
	$output = $styles;	
	$output .= '<div class="zozo-jumbotron-'.$zozo_jumbo_button_id.' jumbotron'.$animation_class.'"'.$extra_data.'>';
	$output .= '<div class="container">';
    $output .= '<h1>'.$title.'</h1>';
	$output .= '<p>'.$content.'</p>';
	
	if( $show_button == 'yes' ) {
		$output .= '<p><a class="zozo-jumbo-button-'.$zozo_jumbo_button_id.' btn '.$btn_sizes.'" href="'.$button_link.'" target="'.$target.'">'. $icon_left . $button_text . $icon_right .'</a></p>';	
	}
	
	$output .= '</div>';
	$output .= '</div>';
	
	$zozo_jumbo_button_id++;

	return $output;	
}
add_shortcode('zozo_jumbotron', 'zozo_jumbotron_shortcode');

/* =========================================================
 * Modals Shortcode
 * ========================================================= */ 
function zozo_modals_shortcode( $atts, $content = null ) {
	$atts = extract(shortcode_atts(
			array(
				'title' 				=> '',
				'modal_size' 			=> '',
				'button_size' 			=> '',	
				'button_text' 			=> '',			
				'button_bg_color'		=> '',
				'button_bg_hover_color'	=> '',
				'color' 				=> '',
				'hovercolor' 			=> '',
				'icon' 					=> '',
				'icon_pos' 				=> '',
				'animation_type' 		=> '',
				'animation_delay' 		=> '',
			), $atts));
			
	static $zozo_modals_id = 1;
	
	$animation_class = $color_styles = $hover_styles = $styles = $btn_sizes = $modal_sizes = $icon_left = $icon_right = $extra_data = '';
		
	if( $animation_type != '' && $animation_type != 'none' ) {
		$animation_class = ' animated';
		$extra_data = ' data-animation="'.$animation_type.'"';
	}
	
	if( $animation_delay != '' && $animation_type != 'none' ) {
		$extra_data .= ' data-animation-delay="'.$animation_delay.'"';
	}
	
	if( $color != '' ) {		
		$color_styles = sprintf( 'color:%s;', $color );		
	}
	
	if( $hovercolor != '' ) {		
		$hover_styles = sprintf( 'color:%s;', $hovercolor );
	}
		
	if( $button_bg_color != '' ) {
		$color_styles .= sprintf( 'background-color:%s;', $button_bg_color );
	}
	
	if( $button_bg_hover_color != '' ) {
		$hover_styles .= sprintf( 'background-color:%s;', $button_bg_hover_color );
	}
	
	if( $button_bg_color != '' || $color != '' ) {
		$styles .= '<style type="text/css">';		
		$styles .= sprintf( '.zozo-modal-button-%s{%s}', $zozo_modals_id, $color_styles );
		$styles .= sprintf( '.zozo-modal-button-%s:hover{%s}', $zozo_modals_id, $hover_styles );		
		$styles .= '</style>';
	}
	
	if( $button_size ) {
		if( $button_size == 'large' ) $btn_sizes = 'btn-lg';
		if( $button_size == 'small' ) $btn_sizes = 'btn-sm';
		if( $button_size == 'mini' ) $btn_sizes = 'btn-xs';
	}
	
	if( $modal_size ) {
		if( $modal_size == 'large' ) $modal_sizes = ' modal-lg';
		if( $modal_size == 'small' ) $modal_sizes = ' modal-sm';		
	}
	
	if( $icon != '' && $icon_pos == "left" ) {
		$icon_left = '<i class="fa fa-'.$icon.'"></i> ';
	}
	
	elseif( $icon != '' && $icon_pos == "right" ) {
		$icon_right = ' <i class="fa fa-'.$icon.'"></i>';
	}

	$script = '<script type="text/javascript">
	jQuery(document).ready(function($) {
	function centerModal() {
		$(this).css("display", "block");
		var dialog = $(this).find(".modal-dialog");
		var windowHeight = $(window).height();
		var dialogHeight = dialog.height();
		if( dialogHeight < windowHeight ) {
			var offset = (windowHeight - dialogHeight) / 2;		
			dialog.css("margin-top", offset);
		}		
	}
	$(".zozo-modal-'.$zozo_modals_id.'").on("show.bs.modal", centerModal);
     $(window).on("resize", function () {
    	$(".zozo-modal-'.$zozo_modals_id.':visible").each(centerModal);
	 });
	});
	</script>';	
	
	$output = '';
	
	$output = $styles;
	$output .= $script;
	$output .= '<div id="zozo-modal-'.$zozo_modals_id.'" class="zozo-modal zozo-modal-'.$zozo_modals_id.' modal fade" tabindex="-1" role="dialog" aria-hidden="true">';
	$output .= '<div class="modal-dialog'.$modal_sizes.'"><div class="modal-content">';
		$output .= '<div class="modal-header">';
		$output .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
		$output .= '<h4 class="modal-title">'.$title.'</h1>';
		$output .= '</div>';
		$output .= '<div class="modal-body">';
		$output .= do_shortcode($content);
		$output .= '</div>';
	$output .= '</div></div>';
	$output .= '</div>';
	$output .= '<button class="zozo-modal-button-'.$zozo_modals_id.' btn '.$btn_sizes.$animation_class.'" data-toggle="modal" data-target="#zozo-modal-'.$zozo_modals_id.'"'.$extra_data.'>'. $icon_left . $button_text . $icon_right .'</button>';
	
	$zozo_modals_id++;

	return do_shortcode($output);
}
add_shortcode('zozo_modals', 'zozo_modals_shortcode');

/* =========================================================
 * Accordion Shortcode
 * ========================================================= */
function zozo_accordions_shortcode( $atts, $content = null ) {

	$atts = extract(shortcode_atts(
			array(
				'style' 	=> 'default',
				'id' 		=> 'accordion-1',
			), $atts));
		
	$extra_class = '';	
	if( isset( $style ) && $style != '' ) {
		$extra_class = ' zozo-accordion-'.$style.'';
	} else {
		$extra_class = ' zozo-accordion-default';
	}
	
	$accordion_id = '';
	if( isset( $id ) && $id != '' ) {
		$accordion_id = $id;
	} else {
		$accordion_id = 'accordion-1';
	}
			
	$output = '';
	$output .= '<div class="panel-group zozo-accordion'.$extra_class.'" id="'. $accordion_id .'">';
	$output .= do_shortcode( str_replace('<br />', '', $content) );
	$output .= '</div>';

   return $output;
}
add_shortcode('zozo_accordions', 'zozo_accordions_shortcode');

function zozo_accordion_shortcode( $atts, $content = null ) {
	$atts = extract(shortcode_atts(
			array(				
				'title' 	=> '',
				'open' 		=> 'no',
				'parent_id' => 'accordion-1',							
			), $atts));
			
	static $zozo_accordion_item_id = 1;
	
	$active_class = $extra_class = '';

	if( $open == 'yes' ){
		$active_class = ' in';
		$extra_class = '';
	} else if( $open == 'no' ) {
		$extra_class = 'collapsed';
	}
	
	$accordion_parent_id = '';
	if( isset( $parent_id ) && $parent_id != '' ) {
		$accordion_parent_id = $parent_id;
	} else {
		$accordion_parent_id = 'accordion-1';
	}
	
	$output = '';
	
	$output .= '<div class="zozo-accordion-panel panel panel-default">';
	$output .= '<div class="panel-heading">';
		$output .= '<h4 class="panel-title">';
		$output .= '<a class="'.$extra_class.'" data-toggle="collapse" data-parent="#'. $accordion_parent_id .'" href="#zozo-accordion-'.$zozo_accordion_item_id.'">';
		$output .= $title;
		$output .= '</a>';
		$output .= '</h4>';
	$output .= '</div>';
	$output .= '<div id="zozo-accordion-'.$zozo_accordion_item_id.'" class="panel-collapse collapse'.$active_class.'">';
		$output .= '<div class="panel-body">';
		$output .= do_shortcode($content);
		$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';
	
	$zozo_accordion_item_id++;
	
	return $output;
}
add_shortcode('zozo_accordion', 'zozo_accordion_shortcode');

/* =========================================================
 * Tooltip Shortcode
 * ========================================================= */
function zozo_tooltip_shortcode( $atts, $content = null ) {
	$atts = extract(shortcode_atts(
			array(				
				'title' 	=> '',
				'link_type'	=> 'text',
				'position' 	=> 'top',
				'style' 	=> '',
			), $atts));
	
	$output = '';
	$extra_class = '';
	
	if( $link_type == "button" ) {
		$extra_class = ' btn btn-'.$style.'';
	}
	$output .= '<span class="zozo-tooltip'.$extra_class.'" data-toggle="tooltip" data-placement="'.$position.'" title="'.$title.'">';
	$output .= do_shortcode($content);	
	$output .= '</span>';
	
	return $output;
}
add_shortcode('zozo_tooltip', 'zozo_tooltip_shortcode');

/* =========================================================
 * Page Header Shortcode
 * ========================================================= */
function zozo_page_header_shortcode( $atts, $content = null ) {
	$atts = extract(shortcode_atts(
			array(
				'title' 			=> '',				
				'slogan' 			=> '',
				'textalign' 		=> '',
				'titlecolor' 		=> '',				
				'slogancolor' 		=> '',
				'animation_type' 	=> '',
				'animation_delay' 	=> '500',				
			), $atts));
					
	$output = $text_align = $title_style = $slogan_style = $extra_class = $extra_data = '';	
	
	$title_class = 'parallax-title';	
	$slogan_class = 'parallax-desc';
	
	if( isset($animation_type) && $animation_type != 'none' ) {
		$extra_class = ' animated';
		$extra_data = ' data-animation="'.$animation_type.'"';
	}
	
	if( $animation_delay != '' && $animation_type != 'none' ) {
		$extra_data .= ' data-animation-delay="'.$animation_delay.'"';
	}
	
	if( isset( $textalign ) && $textalign != '' ) {
		$text_align = ' text-'.$textalign.'';
	}
	
	if( isset( $titlecolor ) && $titlecolor != '' ) {
		$title_style = ' style="color: '.$titlecolor.';"';
	}
	
	if( isset( $slogancolor ) && $slogancolor != '' ) {
		$slogan_style = ' style="color: '.$slogancolor.';"';
	}
	
	$output .= '<div class="zozo-parallax-header'.$extra_class.'"'.$extra_data.'>';
		$output .= '<div class="parallax-header">';
			if( isset( $title ) && $title != '' ) {
				$output .= '<h2 class="'.$title_class.''.$text_align.'"'.$title_style.'>'.do_shortcode($title).'</h2>';		
			}
				
			if( isset( $slogan ) && $slogan != '' ) {
				$output .= '<p class="'.$slogan_class.''.$text_align.'"'.$slogan_style.'>'.do_shortcode($slogan).'</p>';
			}
		$output .= '</div>';
	$output .= '</div>';
	
	return $output;
}
add_shortcode('zozo_page_header', 'zozo_page_header_shortcode');

/* =========================================================
 * Lead Paragraph Shortcode
 * ========================================================= */
function zozo_leadpara_shortcode( $atts, $content = null ) {
	$atts = extract(shortcode_atts(
			array(				
				'align' 	=> '',				
			), $atts));
			
	if( $align != '' ) {
		$text_align = ' text-'.$align.'';
	}
	
	$output = '';	
	$output .= '<p class="lead'.$text_align.'">'.do_shortcode($content).'</p>';
	
	return $output;
}
add_shortcode('zozo_leadpara', 'zozo_leadpara_shortcode');

/* =========================================================
 * Popover Shortcode
 * ========================================================= */
function zozo_popover_shortcode( $atts, $content = null ) {
	$atts = extract(shortcode_atts(
			array(				
				'title' 				=> '',
				'popover_pos' 			=> 'top',
				'link_type' 			=> 'button',
				'show_on' 				=> 'click',
				'link_text' 			=> '',
				'link_url' 				=> '',
				'target' 				=> '',
				'size' 					=> '',
				'button_bg_color' 		=> '',
				'button_bg_hover_color' => '',
				'color' 				=> '',
				'hovercolor' 			=> '',
				'icon' 					=> '',
				'icon_pos' 				=> '',				
			), $atts));
			
	static $zozo_popover_id = 1;
	
	$color_styles = $hover_styles = $styles = $btn_sizes = $icon_left = $icon_right = '';	
	
	$output = '';
	
	if( $link_type == "button" ) {
	
		if( $color != '' ) {		
			$color_styles = sprintf( 'color:%s;', $color );		
		}
		
		if( $hovercolor != '' ) {		
			$hover_styles = sprintf( 'color:%s;', $hovercolor );
		}
			
		if( $button_bg_color != '' ) {
			$color_styles .= sprintf( 'background-color:%s;', $button_bg_color );
		}
		
		if( $button_bg_hover_color != '' ) {
			$hover_styles .= sprintf( 'background-color:%s;', $button_bg_hover_color );
		}
		
		if( $button_bg_color != '' || $color != '' ) {
			$styles .= '<style type="text/css">';		
			$styles .= sprintf( '.zozo-popover-button-%s{%s}', $zozo_popover_id, $color_styles );
			$styles .= sprintf( '.zozo-popover-button-%s:hover{%s}', $zozo_popover_id, $hover_styles );		
			$styles .= '</style>';
		}
	
		if( $size ) {
			if( $size == 'large' ) $btn_sizes = 'btn-lg';
			if( $size == 'small' ) $btn_sizes = 'btn-sm';
			if( $size == 'mini' ) $btn_sizes = 'btn-xs';
		}
			
		if( $icon != '' && $icon_pos == "left" ) {
			$icon_left = '<i class="fa fa-'.$icon.'"></i> ';
		}
		
		elseif( $icon != '' && $icon_pos == "right" ) {
			$icon_right = ' <i class="fa fa-'.$icon.'"></i>';
		}
		
		$output = $styles . '<button type="button" class="zozo-popover zozo-popover-button-'.$zozo_popover_id.' btn '.$btn_sizes.'" title="'.$title.'" data-container="body" data-toggle="popover" data-placement="'.$popover_pos.'" data-trigger="'.$show_on.'" data-html="true" data-content="'.do_shortcode($content).'">'.$link_text.'</button>';
		
	} elseif( $link_type == "link" ) {
	
		$output = '<a href="'.$link_url.'" class="zozo-popover zozo-popover-link-'.$zozo_popover_id.'" target="'.$target.'" title="'.$title.'" data-container="body" data-toggle="popover" data-placement="'.$popover_pos.'" data-trigger="hover" data-html="true" data-content="'.do_shortcode($content).'">'.$link_text.'</a>';
	
	}
	
	$zozo_popover_id++;
	
	return $output;
}
add_shortcode('zozo_popover', 'zozo_popover_shortcode');

/* =========================================================
 * Tabs Shortcode
 * ========================================================= */
function zozo_tabs_shortcode( $atts, $content = null ) {
	$atts = extract(shortcode_atts(
			array(
				'layout' 			=> '',
				'activecolor' 		=> '',
				'inactivecolor' 	=> '',
			), $atts));
	
	static $zozo_tabs_id = 1;
	static $zozo_tab_id = 1;
	
	$color_active_styles = $color_inactive_styles = $styles = $style_tag = $icon_tag = '';
	
	$preg_matches = preg_match_all( '/zozo_tab title="([^\"]+)" icon="([^\"]*)" color="([^\"]*)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
	
	$tab_titles = array();	
	$new_tabs = array();
	
	if( isset($matches[1]) ) {
		$tab_titles = $matches[1];
		$tab_icons	= $matches[2];
		$color_codes = $matches[3];		
	
		if( isset($tab_icons) ) {
			foreach( $tab_icons as $key => $tabs_list ) {
				$tab_icons_incl[] = array_merge((array)$tab_titles[$key], (array)$tabs_list);
			}
		} else {
			$new_tabs[] = $tab_titles;
		}
		
		if( isset($color_codes) ) {
			if( isset($tab_icons_incl) ) {
				foreach( $color_codes as $key => $tabs_color ) {
					$new_tabs[] = array_merge((array)$tab_icons_incl[$key], (array)$tabs_color);
				}
			} else {
				foreach( $color_codes as $key => $tabs_color ) {
					$new_tabs[] = array_merge((array)$tab_titles[$key], (array)$tabs_color);
				}
			}
		} elseif( !isset($color_codes) && isset($tab_icons_incl) ) {
			$new_tabs[] = $tab_icons_incl;
		} else {
			$new_tabs[] = $tab_titles;
		}
				
	}
	
	if( $activecolor != '' ) {
		$color_active_styles = sprintf( 'background-color:%s;', $activecolor );
	}
	
	if( $inactivecolor != '' ) {
		$color_inactive_styles = sprintf( 'background-color:%s;', $inactivecolor );
	}
	
	if( $activecolor != '' || $inactivecolor != '' ) {
		$styles .= '<style type="text/css">';		
		$styles .= sprintf( '#zozo-tabs-%s .nav-tabs li.active a{%s}', $zozo_tabs_id, $color_active_styles );
		$styles .= sprintf( '#zozo-tabs-%s .nav-tabs li a{%s}', $zozo_tabs_id, $color_inactive_styles );		
		$styles .= '</style>';
	}
	
	$output = '';
	
	$output .= $styles;
	
	$output .= '<script type="text/javascript">';
	$output .= 'jQuery(document).ready(function($){	
	$("#zozo-tabs-'.$zozo_tabs_id.'").find("ul.nav li:first").addClass("active");
	$("#zozo-tabs-'.$zozo_tabs_id.'").find(".tab-content .tab-pane:first").addClass("in active");
	});';
	$output .= '</script>';
	
	if( $layout == 'horizontal' ) {
	
		if( count($tab_titles) ){
			$output .= '<div id="zozo-tabs-'.$zozo_tabs_id.'" class="zozo-tabs zozo-tab-horizontal">';
			$output .= '<ul class="nav nav-tabs">';
			
			foreach( $new_tabs as $tab ) {			
				
				if( $tab[2] != '' ) {
					$icon_tag = '<i class="fa fa-'.$tab[2].'"></i> ';
				}
				
				if( $tab[4] != '' ) {
					$style_tag = ' style="color: '.$tab[4].';"';
				}
				$output .= '<li class="zozo-tab-'.$zozo_tab_id.'"><a href="#zozo-tab-'. sanitize_title( $tab[0] ) .'" data-toggle="tab"'.$style_tag.'>' . $icon_tag . $tab[0] . '</a></li>';
				
				$zozo_tab_id++;
			}
			
			$output .= '</ul>';
			$output .= '<div class="tab-content">';
			$output .= do_shortcode( str_replace('<br />', '', $content) );
			$output .= '</div>';
			$output .= '</div>';
		} else {
			$output .= do_shortcode( str_replace('<br />', '', $content) );
		}
		
	} elseif( $layout == 'vertical-left' ) {
		
		if( count($tab_titles) ){
			$output .= '<div id="zozo-tabs-'.$zozo_tabs_id.'" class="zozo-tabs zozo-left-vertical">';
				$output .= '<ul class="nav nav-tabs tabs-left">';
				
				foreach( $new_tabs as $tab ) {
					if( $tab[2] != '' ) {
						$icon_tag = '<i class="fa fa-'.$tab[2].'"></i> ';
					}
					
					if( $tab[4] != '' ) {
						$style_tag = ' style="color: '.$tab[4].';"';
					}
				
					$output .= '<li class="zozo-tab-'.$zozo_tab_id.'"><a href="#zozo-tab-'. sanitize_title( $tab[0] ) .'" data-toggle="tab"'.$style_tag.'>' . $icon_tag . $tab[0] . '</a></li>';
					
					$zozo_tab_id++;
				}
				
				$output .= '</ul>';
				
				$output .= '<div class="tab-content">';
				$output .= do_shortcode( str_replace('<br />', '', $content) );
				$output .= '</div>';
			$output .= '<div class="clearfix"></div>';
			$output .= '</div>';
		} else {
			$output .= do_shortcode( str_replace('<br />', '', $content) );
		}
	
	} elseif( $layout == 'vertical-right' ) {
		
		if( count($tab_titles) ){
			$output .= '<div id="zozo-tabs-'.$zozo_tabs_id.'" class="zozo-tabs zozo-right-vertical">';				
						
				$output .= '<ul class="nav nav-tabs tabs-right">';
				
				foreach( $new_tabs as $tab ) {
					if( $tab[2] != '' ) {
						$icon_tag = '<i class="fa fa-'.$tab[2].'"></i> ';
					}
					
					if( $tab[4] != '' ) {
						$style_tag = ' style="color: '.$tab[4].';"';
					}
					
					$output .= '<li class="zozo-tab-'.$zozo_tab_id.'"><a href="#zozo-tab-'. sanitize_title( $tab[0] ) .'" data-toggle="tab"'.$style_tag.'>' . $icon_tag . $tab[0] . '</a></li>';
					
					$zozo_tab_id++;
				}
				
				$output .= '</ul>';
				
				$output .= '<div class="tab-content">';
				$output .= do_shortcode( str_replace('<br />', '', $content) );
				$output .= '</div>';
			
			$output .= '<div class="clearfix"></div>';
			$output .= '</div>';
		} else {
			$output .= do_shortcode( str_replace('<br />', '', $content) );
		}
	
	}
	
	$zozo_tabs_id++;
	
	return $output;
}
add_shortcode('zozo_tabs', 'zozo_tabs_shortcode');

function zozo_tab_shortcode( $atts, $content = null ) {
	$atts = extract(shortcode_atts(
			array(
				'title' 	=> '',
				'icon' 		=> '',
				'color' 	=> '',
			), $atts));
			
	$output = '';
	
	$output .= '<div class="tab-pane fade" id="zozo-tab-'.sanitize_title( $title ).'">';
	$output .= '<p>' . do_shortcode( str_replace('<br />', '', $content) ) . '</p>';
	$output .= '</div>';
	
	return $output;
}
add_shortcode( 'zozo_tab', 'zozo_tab_shortcode' );

/* =========================================================
 * Soundcloud Shortcode
 * ========================================================= */ 
function zozo_soundcloud_shortcode( $atts ) {

	$atts = extract(shortcode_atts(
			array(
				'url' 			=> '',
				'comments' 		=> '',
				'autoplay' 		=> '',
				'buy_like' 		=> '',
				'show_artwork' 	=> '',
				'color' 		=> '',				
				'width' 		=> '100%',
				'height' 		=> 81,
			), $atts));

		if( $comments == 'yes' ) {
			$comments = 'true';
		} elseif( $comments == 'no' ) {
			$comments = 'false';
		}

		if( $autoplay == 'yes' ) {
			$autoplay = 'true';
		} elseif( $autoplay == 'no' ) {
			$autoplay = 'false';
		}
		
		if( $buy_like == 'yes' ) {
			$buy_like = 'true';
		} elseif( $buy_like == 'no' ) {
			$buy_like = 'false';
		}
		
		if( $show_artwork == 'yes' ) {
			$show_artwork = 'true';
		} elseif( $show_artwork == 'no' ) {
			$show_artwork = 'false';
		}

		if( $color != '' ) {
			$color = str_replace('#', '', $color);
		}

		return '<div class="soundcloud-shortcode"><iframe width="'.$width.'" height="'.$height.'" scrolling="no" src="https://w.soundcloud.com/player/?url=' . urlencode($url) . '&amp;show_comments=' . $comments . '&amp;auto_play=' . $autoplay . '&amp;color=' . $color . '&amp;buying=' . $buy_like . '&amp;liking=' . $buy_like . '&amp;show_artwork=' . $show_artwork . '"></iframe></div>';
		
}

add_shortcode('zozo_soundcloud', 'zozo_soundcloud_shortcode');

/* =========================================================
 * Vimeo Shortcode
 * ========================================================= */
function zozo_vimeo_shortcode( $atts ) {

	$atts = extract(shortcode_atts(
			array(
				'id' 			=> '',				
				'autoplay' 		=> '',				
				'color' 		=> '',				
				'width' 		=> '',
				'height' 		=> '',
				'fit_video' 	=> '',
				'show_title' 	=> '',
				'show_byline' 	=> '',
			), $atts));

		if( $autoplay == 'yes' ) {
			$autoplay = '1';
		} elseif( $autoplay == 'no' ) {
			$autoplay = '0';
		}
		
		if( $show_title == 'yes' ) {
			$show_title = '1';
		} elseif( $show_title == 'no' ) {
			$show_title = '0';
		}
		
		if( $show_byline == 'yes' ) {
			$show_byline = '1';
		} elseif( $show_byline == 'no' ) {
			$show_byline = '0';
		}

		if( $color != '' ) {
			$color = str_replace('#', '', $color);
		}
		
		$protocol = (is_ssl())? 's' : '';
		
		$inner_style = '';
		if( isset( $fit_video ) && $fit_video == 'no' ) {
			if( ( isset( $width ) && $width != '' ) || ( isset( $height ) && $height != '' ) ) {
				$inner_style = ' style="';
			}
			if( isset( $width ) && $width != '' ) {
				$inner_style .= 'max-width:'.$width.'px;';
			}
			if( isset( $height ) && $height != '' ) {
				$inner_style .= ' max-height:'.$height.'px;';
			} 
			
			if( ( isset( $width ) && $width != '' ) || ( isset( $height ) && $height != '' ) ) {
				$inner_style .= '"';
			}
		}
		
		$extra_class = '';
		if( isset( $fit_video ) && $fit_video == 'yes' ) {
			$extra_class = ' zozo-fit-video';
		}
		
		return '<div class="vimeo-shortcode'. $extra_class .'"><div class="vimeo-inner"'. $inner_style .'><iframe width="'.$width.'" height="'.$height.'" src="http'.$protocol.'://player.vimeo.com/video/' . $id . '?autoplay=' . $autoplay . '&amp;color=' . $color . '&amp;title=' . $show_title . '&amp;byline=' . $show_byline . '"></iframe></div></div>';
		
}

add_shortcode('zozo_vimeo', 'zozo_vimeo_shortcode');

/* =========================================================
 * Youtube Shortcode
 * ========================================================= */ 
function zozo_youtube_shortcode( $atts ) {

	$atts = extract(shortcode_atts(
			array(
				'id' 			=> '',				
				'autoplay' 		=> '',				
				'rel_video' 	=> '',
				'fit_video' 	=> '',
				'width' 		=> '',
				'height' 		=> ''
			), $atts));
			
		if( $autoplay == 'yes' ) {
			$autoplay = '1';
		} elseif( $autoplay == 'no' ) {
			$autoplay = '0';
		}
		
		if( $rel_video == 'yes' ) {
			$rel_video = '1';
		} elseif( $rel_video == 'no' ) {
			$rel_video = '0';
		}
		
		$inner_style = '';
		if( isset( $fit_video ) && $fit_video == 'no' ) {
			if( ( isset( $width ) && $width != '' ) || ( isset( $height ) && $height != '' ) ) {
				$inner_style = ' style="';
			}
			if( isset( $width ) && $width != '' ) {
				$inner_style .= 'max-width:'.$width.'px;';
			}
			if( isset( $height ) && $height != '' ) {
				$inner_style .= ' max-height:'.$height.'px;';
			} 
			
			if( ( isset( $width ) && $width != '' ) || ( isset( $height ) && $height != '' ) ) {
				$inner_style .= '"';
			}
		}
		
		$extra_class = '';
		if( isset( $fit_video ) && $fit_video == 'yes' ) {
			$extra_class = ' zozo-fit-video';
		}
		
		return '<div class="youtube-shortcode'. $extra_class .'"><div class="youtube-inner"'. $inner_style .'><iframe width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/' . $id . '?autoplay=' . $autoplay . 'amp;rel=' . $rel_video . '"></iframe></div></div>';
		
}

add_shortcode('zozo_youtube', 'zozo_youtube_shortcode');

/* =========================================================
 * Circle Counters Shortcode
 * ========================================================= */
 
function zozo_circle_counter_shortcode( $atts, $content = null ) {

	static $zozo_circle_counter_id = 1;

	extract(shortcode_atts(
		array(
			'show_in_slider' 	=> '',
			'items' 			=> '4',
			'itemsscroll' 		=> '1',
			'itemsdesktopsmall' => '3',
			'itemstablet' 		=> '2',
			'itemsmobile' 		=> '1',
			'navigation' 		=> '',
			'pagination'		=> '',
			'margin' 			=> '0',
			'autoplay' 			=> 'true',
			'duration' 			=> '5000',
			'column' 			=> '',
			'circle_size'		=> '',
			'circle_line_size' 	=> '',			
			'text_color' 		=> '',
			'desc_color' 		=> '',				
		), $atts));
		
	$text_styles = $desc_styles = $line_height = '';
	if( ( isset( $text_color ) && $text_color != '' ) || ( isset( $desc_color ) && $desc_color != '' ) ) {
		if( isset( $text_color ) && $text_color != '' ) {
			$text_styles = 'color: '.$text_color.';';
		}
		if( isset( $desc_color ) && $desc_color != '' ) {
			$desc_styles = 'color: '.$desc_color.';';
		}		
	}
	
	if( isset( $circle_size ) && $circle_size != '' ) {
		$line_height = 'line-height: '.$circle_size.'px;';
	} else {
		$line_height = 'line-height: 152px;';
	}
	
	if( isset( $column ) && $column == '' ) {
		$column = 5;
	}
	
	if( isset( $circle_size ) && $circle_size == '' ) {
		$circle_size = 152;
	}
	
	if( isset( $circle_line_size ) && $circle_line_size == '' ) {
		$circle_line_size = 6;
	}
	
	$data_attr = '';
	
	if( isset( $items ) && $items != '' ) {
		$data_attr .= ' data-items="' . $items . '" ';
	}
	
	if( isset( $itemsscroll ) && $itemsscroll != '' ) {
		$data_attr .= ' data-slideby="' . $itemsscroll . '" ';
	}
	
	if( isset( $itemsdesktopsmall ) && $itemsdesktopsmall != '' ) {
		$data_attr .= ' data-items-tablet="' . $itemsdesktopsmall . '" ';
	}
	
	if( isset( $itemstablet ) && $itemstablet != '' ) {
		$data_attr .= ' data-items-mobile-landscape="' . $itemstablet . '" ';
	}
	
	if( isset( $itemsmobile ) && $itemsmobile != '' ) {
		$data_attr .= ' data-items-mobile-portrait="' . $itemsmobile . '" ';
	}
	
	if( isset( $autoplay ) && $autoplay != '' ) {
		$data_attr .= ' data-autoplay="' . $autoplay . '" ';
	}
	if( isset( $duration ) && $duration != '' ) {
		$data_attr .= ' data-autoplay-timeout="' . $duration . '" ';
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
	
	$data_attr .= ' data-loop="false"';
	
	$output = '';
	
	$output = '<div class="zozo-circle-counter-wrapper clearfix">';
	
		if( $text_styles != '' || $desc_styles != '' || $line_height != '' ) {
			$output .= '<style type="text/css" scoped>';
			if( isset($text_styles) && $text_styles != '' ) {
				$output .= '.circle-counter' . $zozo_circle_counter_id. ' .circle-counter-title { '.$text_styles.' }' . "\n";
			}
			
			if( isset($desc_styles) && $desc_styles != '' ) {
				$output .= '.circle-counter' . $zozo_circle_counter_id. ' .circle-counter-desc { '.$desc_styles.' }' . "\n";
			}
			
			if( isset($line_height) && $line_height != '' ) {
				$output .= '.circle-counter' . $zozo_circle_counter_id. ' .zozo-piechart span { '.$line_height.' }' . "\n";
			}		
			$output .= '</style>';
		}
		
		if( isset( $show_in_slider ) && $show_in_slider == 'yes' ) {
			$output .= '<div id="zozo-owl-carousel-' . $zozo_circle_counter_id. '" class="zozo-owl-carousel zozo-circle-counter owl-carousel circle-counter' . $zozo_circle_counter_id. ' columns-'.$column.' clearfix" ' . $data_attr . ' data-circle="'.$circle_size.'" data-linewidth="'.$circle_line_size.'">';
		} else {
			$output .= '<div id="zozo-circle-counter-' . $zozo_circle_counter_id. '" class="zozo-circle-counter circle-no-slider circle-counter' . $zozo_circle_counter_id. ' columns-'.$column.' clearfix" data-circle="'.$circle_size.'" data-linewidth="'.$circle_line_size.'">';
		}
		
		$content = str_replace('<p>', '', $content);
	
		$output .= do_shortcode( str_replace('<br />', '', $content) );
		
		$output .= '</div>';
	
	$output .= '</div>';
		
	$zozo_circle_counter_id++;
	
	return $output;	
}

add_shortcode('zozo_circle_counter', 'zozo_circle_counter_shortcode');

function zozo_circle_counter_item_shortcode( $atts, $content = null ) {

	static $zozo_circle_counteritem_id = 1;

	$atts = extract(shortcode_atts(
			array(
				'value'				=> '',
				'title'				=> '',
				'bar_color' 		=> '',
				'description' 		=> '',				
				'extra_class' 		=> '',
				'animation_type' 	=> '',
				'animation_delay' 	=> '',
			), $atts));
	
	$output = $additional_class = '';
	
	$animation_class = $extra_data = '';
	
	if( $animation_type != 'none' ) {
		$animation_class = ' animated';
		$extra_data = 'data-animation="'.$animation_type.'"';
	}
	
	if( $animation_delay != '' && $animation_type != 'none' ) {
		$extra_data .= ' data-animation-delay="'.$animation_delay.'"';
	}
	
	if( isset( $bar_color ) && $bar_color == '' ) {
		$bar_color = '#FFC400';
	}
		
	$output .= '<div id="counter-item'.$zozo_circle_counteritem_id.'" class="circle-counter-item'.$animation_class.' '.$extra_class.'" '.$extra_data.'>';
	
		$output .= '<div class="zozo-piechart" data-barcolor="'.$bar_color.'" data-percent="'.$value.'">';
		$output .= '<span></span>';
		$output .= '</div>';
		$output .= '<div class="zozo-piechart-content">';
		if( isset( $title ) && $title != '' ) {
			$output .= '<p class="circle-counter-title">'.$title.'</p>';
		}
		if( isset( $description ) && $description != '' ) {
			$output .= '<p class="circle-counter-desc">'.$description.'</p>';
		}
		$output .= '</div>';
		
	$output .= '</div>';
	
	$zozo_circle_counteritem_id++;
	
	return $output;	
}
add_shortcode('zozo_circle_counter_item', 'zozo_circle_counter_item_shortcode');

/* =========================================================
 * Day Counter Shortcode
 * ========================================================= */
 
function zozo_day_counter_shortcode( $atts, $content = null ) {

	static $zozo_day_counter_id = 1;

	extract(shortcode_atts(
		array(
			'counter' 			=> '',
			'year' 				=> '',
			'month' 			=> '',
			'date' 				=> '',
			'button' 			=> '',
			'button_text' 		=> '',
			'button_link' 		=> '',
			'extra_class'		=> '',
			'animation_type' 	=> '',
			'animation_delay' 	=> '',			
		), $atts));
		
	$animation_class = $extra_data = '';
	
	if( isset( $animation_type ) && $animation_type != 'none' ) {
		$animation_class = ' animated';
		$extra_data = 'data-animation="'.$animation_type.'"';
	}
	
	if( $animation_delay != '' && $animation_type != 'none' ) {
		$extra_data .= ' data-animation-delay="'.$animation_delay.'"';
	}
		
	$data_attr = '';
	if( ( isset( $counter ) && $counter == '' ) ) {
		$counter = "down";
	}
	if( ( isset( $year ) && $year == '' ) ) {
		$year = "2015";
	}
	if( ( isset( $month ) && $month == '' ) ) {
		$month = "1";
	}
	if( ( isset( $date ) && $date == '' ) ) {
		$date = "1";
	}
	
	$data_attr .= ' data-counter="'.$counter.'" ';
	$data_attr .= ' data-year="'.$year.'" ';
	$data_attr .= ' data-month="'.$month.'" ';
	$data_attr .= ' data-date="'.$date.'" ';	
	
	if( ( isset( $extra_class ) && $extra_class != '' ) ) {
		$extra_class = ' ' . $extra_class;
	}
	
	if( ( isset( $button_text ) && $button_text == '' ) ) {
		$button_text = esc_html__('Get a discount', 'zozothemes');
	}
	
	$output = '';
	
	wp_enqueue_script( 'zozo-countdown-plugin-js' );
	wp_enqueue_script( 'zozo-countdown-js' );
	
	$output = '<div class="zozo-daycounter-container">';
		$output .= '<div id="zozo-daycounter-'.$zozo_day_counter_id.'" class="zozo-daycounter zozo-daycounter-wrapper clearfix'.$extra_class.'"'.$data_attr.' '.$extra_data.'>';
		$output .= '</div>';
		if( ( isset( $button ) && $button == 'yes' ) ) {
			$output .= '<div class="daycounter-button">';
				$output .= '<a class="btn btn-discount" href="'.esc_url($button_link).'">'. do_shortcode($button_text) .'</a>';
			$output .= '</div>';
		}
	$output .= '</div>';
	
	$zozo_day_counter_id++;
	
	return $output;	
}

add_shortcode('zozo_day_counter', 'zozo_day_counter_shortcode');

/* =========================================================
 * HTML Block Shortcode
 * ========================================================= */ 
 
function zozo_html_block_shortcode( $atts, $content = null ) {

	$atts = extract(shortcode_atts(
			array(
				'tag' 		=> '',
				'class' 	=> '',				
			), $atts));
				
	$output = $extra_data = '';
			
	if( isset($class) && $class != '' ) {		
		$extra_data = ' class="'.$class.'"';
	}
	
	$output .= '<'. $tag . $extra_data . '>';
	$output .= do_shortcode( $content );
	$output .= '</'. $tag .'>';
		
	return $output;
}

add_shortcode('zozo_html_block', 'zozo_html_block_shortcode');

/* =========================================================
 * Contact Form Shortcode
 * ========================================================= */ 
 
function zozo_contact_form_shortcode( $atts, $content = null ) {

	$atts = extract(shortcode_atts(
			array(
				'form' 			=> 'on'
			), $atts));
	
	static $zozo_contactform_id = 1;
			
	global $zozo_options;
				
	$output = $name = $email = $subject = $phone = $message = $btn_sizes = $btn_text = '';
		
	$btn_sizes = ' btn-wide';
	
	$btn_text = $zozo_options['zozo_submit_button_text'];
	
	if( isset($btn_text) && $btn_text == '' ) {
		$btn_text = esc_html__('Send Message', 'zozothemes');
	}
	
	$name = $zozo_options['zozo_labels_name'] ? $zozo_options['zozo_labels_name'] : esc_html__('Your Name', 'zozothemes');
	$email = $zozo_options['zozo_labels_email'] ? $zozo_options['zozo_labels_email'] : esc_html__('Your Email', 'zozothemes');
	$subject = $zozo_options['zozo_labels_subject'] ? $zozo_options['zozo_labels_subject'] : esc_html__('Your Subject', 'zozothemes');
	$phone = $zozo_options['zozo_labels_phone'] ? $zozo_options['zozo_labels_phone'] : esc_html__('Your Phone Number', 'zozothemes');
	$message = $zozo_options['zozo_labels_message'] ? $zozo_options['zozo_labels_message'] : esc_html__('Write your questions here', 'zozothemes');	
	
	if( isset( $form ) && $form == 'on' ) {
	
		wp_enqueue_script( 'zozo-bootstrap-validator-js' );
		
		$output .= '<div class="container">';
			$output .= '<div class="row">';			
				$output .= '<div class="col-sm-12 contact-form-top">';
					$output .= '<p class="bg-success zozo-form-success"></p>'; 
					$output .= '<p class="bg-danger zozo-form-error"></p>'; 
					$output .= '<div class="zozo-contact-form-wrapper">';
						$output .= '<form role="form" name="contactform" class="zozo-contact-form" id="contactform'.$zozo_contactform_id.'" method="post" action="#">';
						
							$output .= '<div class="row">';
								// Name Field
								if( isset( $zozo_options['zozo_form_name'] ) && ! $zozo_options['zozo_form_name'] ) {								
									$output .= '<div class="col-md-4">';
										$output .= '<div class="zozo-input-text form-group">';
											$output .= '<label class="sr-only" for="contact_name">'.$name.'</label>';
											$output .= '<div class="input-group zozo-input-group-addon">';
												$output .= '<div class="input-group-addon"><i class="fa fa-user"></i></div>';
												$output .= '<input type="text" name="contact_name" id="contact_name" class="input-name form-control" placeholder="'.esc_attr($name).'">';
											$output .= '</div>';
										$output .= '</div>';
									$output .= '</div>';
								}
								
								// Email Field
								$output .= '<div class="col-md-4">';
									$output .= '<div class="zozo-input-email form-group">';
										$output .= '<label class="sr-only" for="contact_email">'.$email.'</label>';
										$output .= '<div class="input-group zozo-input-group-addon">';
											$output .= '<div class="input-group-addon"><i class="fa fa-envelope"></i></div>';
											$output .= '<input type="email" name="contact_email" id="contact_email" class="input-email form-control" placeholder="'.esc_attr($email).'">';															
										$output .= '</div>';
									$output .= '</div>';
								$output .= '</div>';
								
								// Phone Field
								if( isset( $zozo_options['zozo_form_phone_number'] ) && ! $zozo_options['zozo_form_phone_number'] ) {
									$output .= '<div class="col-md-4">';
										$output .= '<div class="zozo-input-phone form-group">';									
											$output .= '<label class="sr-only" for="contact_phone">'.$phone.'</label>';
											$output .= '<div class="input-group zozo-input-group-addon">';
												$output .= '<div class="input-group-addon"><i class="fa fa-phone"></i></div>';
												$output .= '<input type="text" id="contact_phone" name="contact_phone" class="input-phone form-control" placeholder="'.esc_attr($phone).'">';									
											$output .= '</div>';
										$output .= '</div>';
									$output .= '</div>';
								}
								
							$output .= '</div>';
								
							// Subject Field
							if( isset( $zozo_options['zozo_form_subject'] ) && ! $zozo_options['zozo_form_subject'] ) {
								$output .= '<div class="zozo-input-subject form-group">';									
									$output .= '<label class="sr-only" for="contact_subject">'.$subject.'</label>';
									$output .= '<div class="input-group zozo-input-group-addon">';
										$output .= '<div class="input-group-addon"><i class="fa fa-info"></i></div>';
										$output .= '<input type="text" id="contact_subject" name="contact_subject" class="input-subject form-control" placeholder="'.esc_attr($subject).'">';
									$output .= '</div>';										
								$output .= '</div>';
							}
								
							// Message Field
							$output .= '<div class="zozo-textarea-message form-group">';								
								$output .= '<label class="sr-only" for="contact_message">'.$message.'</label>';
								$output .= '<textarea name="contact_message" id="contact_message" class="textarea-message form-control" rows="3" cols="25" placeholder="'.esc_attr($message).'"></textarea>';
							$output .= '</div>';
								
							$output .= '<div class="zozo-input-submit form-group submit text-center">';
								$output .= '<button type="submit" class="btn zozo-submit'.$btn_sizes.'">'.$btn_text.'</button>';
							$output .= '</div>';
												
						$output .= '</form>';
						
					$output .= '</div>';
				$output .= '</div>';
			
			$output .= '</div>';
		$output .= '</div>';
	}
	
	$zozo_contactform_id++;
		
	return $output;
}

add_shortcode('zozo_contact_form', 'zozo_contact_form_shortcode');

/* =========================================================
 * Fullwidth Box Shortcode
 * ========================================================= */ 
 
function zozo_fullwidth_box_shortcode( $atts, $content = null ) {

	$atts = extract(shortcode_atts(
			array(
				'class' 			=> '',
				'bg_image' 			=> '',
				'bg_repeat' 		=> '',
				'bg_attachment' 	=> '',
				'bg_color' 			=> '',
				'overlay' 			=> '',
				'overlay_color' 	=> '',
				'overlay_opacity' 	=> '',
				'padding_top' 		=> '',
				'padding_bottom' 	=> '',
			), $atts));
	
	global $zozo_options;
	
	static $zozo_fullwidthbox_id = 1;
	
	$bg_styles = '';
	
	if( isset( $bg_image ) && $bg_image != '' ) {
		$bg_styles = ' background-image: url('.$bg_image.'); ';
	}
	
	if( isset( $bg_image ) && $bg_image != '' && isset( $bg_repeat ) && $bg_repeat != '' ) {
		$bg_styles .= ' background-repeat: '.$bg_repeat.'; ';
	}
	
	if( isset( $bg_image ) && $bg_image != '' && isset( $bg_attachment ) && $bg_attachment != '' ) {
		$bg_styles .= ' background-attachment: '.$bg_attachment.'; ';
	}
	
	if( isset( $bg_color ) && $bg_color != '' ) {
		$bg_styles .= ' background-color: '.$bg_color.'; ';
	}
	
	$padding_styles = '';
	
	if( isset( $padding_top ) && $padding_top != '' ) {
		$padding_styles = ' padding-top: '.$padding_top.'; ';
	}
	
	if( isset( $padding_bottom ) && $padding_bottom != '' ) {
		$padding_styles .= ' padding-bottom: '.$padding_bottom.'; ';
	}
	
	$overlay_styles = '';
	
	if( isset( $overlay_opacity ) && $overlay_opacity != '' ) {
		$overlay_opacity = '0.8';
	}
	if( isset( $overlay ) && $overlay == 'yes' ) {
		if( isset( $overlay_color ) && $overlay_color != '' ) {
			$bg_color_rgb = zozo_hex2rgb( $overlay_color );
			$overlay_styles .= ' background-color: rgba(' . $bg_color_rgb[0] . ',' . $bg_color_rgb[1] . ',' . $bg_color_rgb[2] . ', ' . $overlay_opacity . '); ';
		}
	}
	
	$fullwidth_styles = '';
	if( ( isset( $bg_styles ) && $bg_styles != '' ) || ( isset( $padding_styles ) && $padding_styles != '' ) || ( isset( $overlay_styles ) && $overlay_styles != '' ) ) {
		$fullwidth_styles = '<style type="text/css" scoped="scoped">';
			$fullwidth_styles .= '#zozo-fullwidth-box-'.$zozo_fullwidthbox_id.' { ';
				if( isset( $bg_styles ) && $bg_styles != '' ) {
					$fullwidth_styles .= $bg_styles;
				}			
			$fullwidth_styles .= ' } ';
		
			if( isset( $padding_styles ) && $padding_styles != '' ) {
				$fullwidth_styles .= '#zozo-fullwidth-box-'.$zozo_fullwidthbox_id.' .fullwidth-page-inner { ';
					$fullwidth_styles .= $padding_styles;
				$fullwidth_styles .= ' } ';
			}
			
			if( isset( $overlay_styles ) && $overlay_styles != '' ) {
				$fullwidth_styles .= '#zozo-fullwidth-box-'.$zozo_fullwidthbox_id.' .fullwidth-bg-overlay { ';
					$fullwidth_styles .= $overlay_styles;
				$fullwidth_styles .= ' } ';
			}			
		$fullwidth_styles .= '</style>';
	}
			
	$output = '';
	$extra_class = '';
	
	if( isset( $bg_image ) && $bg_image != '' ) {
		$extra_class = ' parallax-background';
	} else {
		$extra_class = ' normal-background';
	}
	
	$output .= '<div id="zozo-fullwidth-box-'.$zozo_fullwidthbox_id.'" class="zozo-fullwidth-box'.$extra_class.' '.$class.'">';
		$output .= $fullwidth_styles;		
		$output .= '<div class="fullwidth-page-inner">';
			$output .= '<div class="fullwidth-bg-overlay"></div>';
			$output .= '<div class="fullwidth-section-container">';
				$output .= '<div class="container">';
					$output .= do_shortcode( str_replace('<br />', '', $content) );
				$output .= '</div>';
			$output .= '</div>';
		$output .= '</div>';
	$output .= '</div>';
	
	$zozo_fullwidthbox_id++;
	
	return $output;
}

add_shortcode('zozo_fullwidth_box', 'zozo_fullwidth_box_shortcode');

/* =========================================================
 * Sitemap Shortcode
 * ========================================================= */

function zozo_sitemap_shortcode() {

	$output = '';
	
	$output .= '<div class="sitemap-wrapper">';
		$output .= '<div class="sitemap-pages">';
			$output .= '<h6 class="parallax-title text-left">'. esc_html__('Pages', 'zozothemes') .'</h4>';
			$output .= '<ul class="sitemap-nav">';
			$output .= wp_list_pages('title_li=&echo=0');
			$output .= '</ul>';
		$output .= '</div>';
		$output .= '<div class="sitemap-categories">';
			$output .= '<h6 class="parallax-title text-left">'. esc_html__('Categories', 'zozothemes') .'</h4>';
			$output .= '<ul class="sitemap-nav">';
			$output .= wp_list_categories('title_li=&echo=0');
			$output .= '</ul>';
		$output .= '</div>';
		$output .= '<div class="sitemap-archives">';	
			$output .= '<h6 class="parallax-title text-left">'. esc_html__('Archives', 'zozothemes') .'</h4>';
			$output .= '<ul class="sitemap-nav">';
			$output .=	wp_get_archives('type=monthly&show_post_count=0&echo=0');
			$output .= '</ul>';
		$output .= '</div>';
	$output .= '</div>';
	
	return $output;
}

add_shortcode('sitemap', 'zozo_sitemap_shortcode');

/* =========================================================
 * Get Attachment ID from attachment URL
 * ========================================================= */

function zozo_get_attachment_id_from_url( $attachment_url = '' ) {
		
	global $wpdb;
	$attachment_id = false;

	// If there is no url, return.
	if ( '' == $attachment_url ) {
		return;
	}

	// Get the upload directory paths
	$upload_dir_paths = wp_upload_dir();

	// Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
	if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {

		// If this is the URL of an auto-generated thumbnail, get the URL of the original image
		$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );

		// Remove the upload path base directory from the attachment URL
		$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );

		// Run a custom database query to get the attachment ID from the modified attachment URL
		$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
	}
	
	return $attachment_id;
}
?>