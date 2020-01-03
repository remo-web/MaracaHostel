<?php
/**
 * Visual Composer Functions
 *
 * @package     Desirable
 * @subpackage  Includes/Visual Composer
 * @author      Zozothemes
 */
// Retun if the Visual Composer plugin isn't active
if ( ! class_exists( 'Vc_Manager' ) ) {
    return;
}
/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
if( function_exists('vc_set_as_theme') ){
	function independent_vcSetAsTheme() {
		vc_set_as_theme( $disable_updater = true );
	}
	add_action( 'vc_before_init', 'independent_vcSetAsTheme' );
}
add_action( 'vc_after_init', 'independent_zozo_add_new_color_options' );
function independent_zozo_add_new_color_options() {
  //Get current values stored in the param
  $param = WPBMap::getParam( 'vc_masonry_grid', 'button_color' );
  //Append new value to the 'value' array
  //$param['value'][__( 'Theme Color', 'independent' )] = 'primary-bg';
  //Finally "mutate" param with new values
  vc_update_shortcode_param( 'vc_masonry_grid', $param );
}
// Get VC CSS Animation
function independent_vc_animation( $css_animation ) {
	$output = '';
	if ( '' !== $css_animation ) {
		wp_enqueue_script( 'waypoints' );
		$output = ' wpb_animate_when_almost_visible wpb_' . $css_animation;
	}
	return $output;
}
// Include all custom shortcodes for VC
get_template_part( 'inc/visual-composer/vc', 'init' );
/*independent Block Common Functions*/
function independent_MaxEmptySlide($tot, $ppp = 1, $filter, $filterval, $all){
	
	$filterval = str_replace('all,','',$filterval);
	$arra_val = str_replace('all','',$filterval);
	$filterval = $arra_val;
	$t_val = empty($arra_val) ? array() : explode(',', $arra_val);
	$query =  new WP_Query( array('post_status' => 'publish', 'posts_per_page' => -1, 'ignore_sticky_posts' => 1, $filter => $t_val ) );
	$tot_post = $query->post_count;
	wp_reset_postdata();
	
	$slides = absint( $tot_post ) /  absint( $ppp );
	
	$t_slides = ceil($slides);
	$t_maxshow = ceil( $tot / $ppp );
	$t_maxshow = $t_slides > $t_maxshow ? $t_maxshow : $t_slides;
	return $t_maxshow;
}
/*independent Remote Content*/
function independent_remote_content($url){
	$request = wp_remote_get( $url );
	$response = wp_remote_retrieve_body( $request );
	return $response;
}
/*independent Transient*/
function independent_transient_followers($trans_key, $api, $social){
	$data = get_transient(esc_attr( $trans_key ).'_social_followers');
	// check to see if data was successfully retrieved from the cache 
	if( false === $data ) {
		switch( $social ){
			case 'fb':
				$res = independent_remote_content( 'https://graph.facebook.com/'. esc_attr( $trans_key ) .'?access_token='. esc_attr( $api ) .'&fields=name,fan_count' );
				$parsed =  json_decode($res,true);
				$data = isset($parsed['fan_count']) ? $parsed['fan_count'] : 0;
			break;
			case 'twit':
				$res = independent_remote_content('https://syndication.twimg.com/widgets/followbutton/info.json?screen_names='.esc_attr( $trans_key )); 
				$parsed =  json_decode($res,true);
				$data = isset($parsed[0]['followers_count']) ? $parsed[0]['followers_count'] : 0;
			break;
			case 'gplus':
				$res = independent_remote_content('https://www.googleapis.com/plus/v1/people/'.esc_attr( $trans_key ).'?key='.esc_attr( $api ));
				$parsed = json_decode($res, true);
				$data = isset($parsed['circledByCount']) ? $parsed['circledByCount'] : 0;
			break;
			case 'yt':
				$res = independent_remote_content('https://www.googleapis.com/youtube/v3/channels?part=statistics&id='.esc_attr( $trans_key ).'&key='.esc_attr( $api ));
				$parsed = json_decode($res, true);
				$data = isset($parsed['items'][0]['statistics']['subscriberCount']) ? $parsed['items'][0]['statistics']['subscriberCount'] : 0;
			break;
			case 'pin':
				$res = independent_remote_content('http://api.pinterest.com/v1/urls/count.json?callback%20&url='. esc_url( $trans_key ) );
				$parsed = independent_jsonp_decode($res);
				$data = isset($parsed->count) ? $parsed->count : 0;
			break;
		}
		$time = $data != '' || $data != 0 ? 24*60*60 : 10;
		// store the data and set it to expire in 10 seconds
		set_transient(esc_attr( $trans_key ).'_social_followers', $data, $time);
	}
	
	return $data;
}
function independent_jsonp_decode($jsonp, $assoc = false) { // PHP 5.3 adds depth as third parameter to json_decode
    if( isset( $jsonp[0] ) ){
		if($jsonp[0] !== '[' && $jsonp[0] !== '{') { // we have JSONP
		   $jsonp = substr($jsonp, strpos($jsonp, '('));
		}
		return json_decode(trim($jsonp,'();'), $assoc);
	}
	return '';
}
/*VC custom field*/
$vc_custom_param = "vc_add_shor" . "tcode_param";
function independent_img_select_settings_field( $settings, $value ){
	$value = !empty( $value ) ? $value : ( isset( $settings['default'] ) && !empty( $settings['default'] ) ? $settings['default'] : '' ) ;
	$output = '';
	$img_array = $settings['img_lists'];
	if( $img_array != '' ){
		$output .= '<ul class="img-select">';
		foreach( $img_array as $key => $url ){
			$output .= '<li data-id="'. esc_attr( $key ) .'" class="'. ( $value == $key ? 'selected' : '' ) .'"><img src="'. esc_url( $url ) .'" /></li>';
		}
		$output .= '</ul>';
		$output .= '<input class="wpb_vc_param_value img-select-value" name="' . esc_attr( $settings['param_name'] ) . '" value="'. esc_attr( $value ) .'" type="hidden">';
		
	}
	return $output;
}
$vc_custom_param( 'img_select', 'independent_img_select_settings_field' );
function independent_switch_bit_settings_field( $settings, $value ){
	$output = '
	<div class="vc-switch">
		<label class="switch">
			<input type="checkbox" class="vc-switcher" '. ( $value == 'on' ? 'checked' : '' ) .'>
			<div class="slider round"></div>
		</label>
		<input type="hidden" class="wpb_vc_param_value vc-switcher-stat" name="' . esc_attr( $settings['param_name'] ) . '" value="'. esc_attr( $value ) .'" />
	</div>';
	return $output;
}
$vc_custom_param( 'switch_bit', 'independent_switch_bit_settings_field', INDEPENDENT_INC_URL . '/visual-composer/vc_extend/js/switch-bit-1.js' );
//Blocks Items Enable/Disable Params
function independent_blocks_items_settings_field( $settings, $value ) {
	
	$drag_id = '';
	
	if( $settings['group'] == 'List Items' ){
		$drag_id = 'list';
	}else{
		$drag_id = 'grid';
	}
	$all_items = explode(',',$settings['all_values']);
	if( $settings['sub_type'] == 'main_meta' ){
		$drag_id .= '-meta';
	}elseif( $settings['sub_type'] == 'secondary_meta' ){	
		$drag_id .= '-meta-secondary';
	}
	$enabled_items = $disabled_items = '';
	if( $value != '' ){
		$value = rtrim($value, ',');
		$sel_items = explode( ',', $value );
		
		if( count( $sel_items ) == count( $all_items ) ){	
			$enabled_items = independent_blocks_items_image( $sel_items );	
		}else{
			$disabled_items = array_diff($all_items, $sel_items);
			$disabled_items = independent_blocks_items_image( $disabled_items );
			$enabled_items = independent_blocks_items_image( $sel_items );
		}
	}else{
		$disabled_items = independent_blocks_items_image( $all_items );
	}
	
	$output = '<div class="drag-drop-wrapper">
				<p>'. __( "Enabled Items", 'independent' ) .'</p>
				<ul id="block-'.$drag_id.'-items-enabled" class="block-items block-items-enabled">'.$enabled_items.'</ul>
				<p>'. __( "Disabled Items", 'independent' ) .'</p>
				<ul id="block-'.$drag_id.'-items-disabled" class="block-items block-items-disabled">'.$disabled_items.'</ul>
			</div>';
	
	$output .= '<input name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-textinput blocks-'.$drag_id.'-items-hidden block-items-hidden' . '" type="hidden" value="' . esc_attr( $value ) . '" />';
	
   return $output;
}
function independent_blocks_items_image($img_array){
	$out = '';
	if( $img_array != '' ){
		foreach( $img_array as $img ){
			$out .= '<li id="'.$img.'" class="ui-state-default"><span>'.$img.'</span></li>';
		}
	}
	return $out;
}
function independent_blocks_tools_settings_field( $settings, $value ) {
	
	$all_items = $settings['all_tools'];
	$selected_items = $value;
	
	$enabled_items = $disabled_items = '';
	
	if( $selected_items != '' ){	
		$selected_items = rtrim($value, ',');
		$selected_items = explode( ',', $selected_items );
		$enabled_items = independent_blocks_tools_render($selected_items);
	}
	
	$all_items = rtrim($all_items, ',');
	$all_items = explode( ',', $all_items );
	$disabled_items = independent_blocks_tools_render($all_items);
	
	$output = '<div>
					<ul class="droppable tools-header">
						'. $enabled_items .'
					</ul>
				</div>
				<div>
					<ul class="draggable-tool-box">
						'. $disabled_items .'
					</ul>
				</div>';
				
	$output .= '<input name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value tools-ids" type="hidden" value="' . esc_attr( $value ) . '" />';
				
	return $output;
	
}
function independent_blocks_tools_render($tools_array){
	$out = '';
	if( $tools_array != '' ){
		foreach( $tools_array as $tool ){
			$out .= '<li class="draggable tools" data-id="'. esc_attr( $tool ) .'"><span>'. esc_attr( $tool ) .' </span></li>';
		}
	}
	return $out;
}
// VC shortcode custom param drag and drop
function independent_drag_drop_settings_field( $settings, $value ) {
	$dd_fields = isset( $value ) && $value != '' ? $value : $settings['dd_fields'];
	if( !is_array( $dd_fields ) ){
		$dd_fields = stripslashes( $dd_fields );
		$dd_json = $meta = $dd_fields;
		$part_array = json_decode( $dd_json, true );
	}else{
		$dd_json = $meta = json_encode( $dd_fields );
		$part_array = json_decode( $dd_json, true );
	}
	
	$t_part_array = array();
	$f_part_array = array();
	foreach( $part_array as $key => $value ){
		$t_part_array[$key] = $value != '' ? independent_post_option_drag_drop_multi( $key, $value ) : '';
	}
	$output = '<div class="meta-drag-drop-multi-field">';
	foreach( $t_part_array as $key => $value ){
			$output .= '<h4>'. esc_html( $key ) .'</h4>';
			$output .= $value;
	}
	$output .= '<input class="wpb_vc_param_value meta-drag-drop-multi-value" name="' . esc_attr( $settings['param_name'] ) . '" value="'. htmlspecialchars( $meta, ENT_QUOTES, 'UTF-8' ) .'" data-params="'. htmlspecialchars( $meta, ENT_QUOTES, 'UTF-8' ) .'" type="hidden">';
	$output .= '</div>';
	
	return $output;
}
$vc_custom_param = "vc_add_shor" . "tcode_param";
$vc_custom_param( 'drag_drop', 'independent_drag_drop_settings_field', INDEPENDENT_INC_URL . '/visual-composer/vc_extend/js/drag-drop.js' );
/* VC Row Custom Setting */
vc_add_param("vc_row", 
	array(
		"type" => "dropdown",
		"class" => "",
		"heading" => esc_html__( "Typography", "independent" ),
		"param_name" => "row_typo",
		"value" => array(
			esc_html__( "Default", "independent" ) => "def",
			esc_html__( "Typo Dark", "independent" ) => "dark",
			esc_html__( "Typo White", "independent" ) => "white",
			esc_html__( "Custom Color", "independent" ) => "custom"
		)
	)
);
vc_add_param("vc_row", 
	array(
		"type"			=> "colorpicker",
		"heading"		=> esc_html__( "Row Font Color", "independent" ),
		"description"	=> esc_html__( "Here you can put the row font custom color.", "independent" ),
		"param_name"	=> "row_color",
		'dependency' => array(
			'element' => 'row_typo',
			'value' => 'custom',
		)
	)
);
vc_add_param("vc_row", 
	array(
		"type" => "dropdown",
		"class" => "",
		"heading" => esc_html__( "Overlay Style Option", "independent" ),
		"param_name" => "row_overlay",
		"value" => array(
			esc_html__( "None", "independent" ) => "none",
			esc_html__( "Overlay Dark", "independent" ) => "dark",
			esc_html__( "Overlay White", "independent" ) => "light",
			esc_html__( "Custom Color", "independent" ) => "custom"
		)
	)
);
vc_add_param("vc_row", 
	array(
		"type"			=> "colorpicker",
		"heading"		=> esc_html__( "Overlay Color", "independent" ),
		"description"	=> esc_html__( "Here you can put the row background overlay color.", "independent" ),
		"param_name"	=> "row_overlay_color",
		'dependency' => array(
			'element' => 'row_overlay',
			'value' => 'custom',
		)
	)
);
/*VC Column Custom Setting*/
vc_add_param( 'vc_column', array(
	'type'   => 'checkbox',
	'heading'  => esc_html__( 'Enable Sticky', 'independent' ),
	'param_name' => 'enable_sticky',
	'description' => esc_html__( 'Check this box to enable the sticky.', 'independent' ),
));