<?php

$all_icons = array();
// Fontawesome icons list
$pattern = '/\.(fa-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
$fontawesome_path = ZOZOTHEME_DIR . '/css/font-awesome.css';
if( file_exists( $fontawesome_path ) ) {
	$subject = file_get_contents($fontawesome_path);
}

preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);

$icons = array();

foreach($matches as $match){
	$icons['fa ' . $match[1]] = $match[1];
	$all_icons['fa ' . $match[1]] = $match[1];
}

// Simple icons list
$simpleicons = '/\.(icon-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
$simplelineicons_path = ZOZO_ADMIN_ASSETS_DIR . 'css/simple-line-icons.css';
if( file_exists( $simplelineicons_path ) ) {
	$licon_subject = file_get_contents($simplelineicons_path);
}

preg_match_all($simpleicons, $licon_subject, $licon_matches, PREG_SET_ORDER);

$line_icons = array();

foreach($licon_matches as $licon_match){
	$line_icons['simple-icon ' . $licon_match[1]] = $licon_match[1];
	$all_icons['simple-icon ' . $licon_match[1]] = $licon_match[1];
}

// Icomoon icons list
$icomoon_pattern = '/\.(icomoon-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
$icomoon_path = ZOZO_ADMIN_ASSETS_DIR . 'css/icomoon-1.css';
if( file_exists( $icomoon_path ) ) {
	$ico_subject = file_get_contents($icomoon_path);
}

preg_match_all($icomoon_pattern, $ico_subject, $ico_matches, PREG_SET_ORDER);

$icomoon_icons = array();

foreach($ico_matches as $ico_match){
	$icomoon_icons['icomoon1 ' . $ico_match[1]] = $ico_match[1];
	$all_icons['icomoon1 ' . $ico_match[1]] = $ico_match[1];
}

$icomoon_pattern2 = '/\.(icomoon2-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
$icomoon_path2 = ZOZO_ADMIN_ASSETS_DIR . 'css/icomoon-2.css';
if( file_exists( $icomoon_path2 ) ) {
	$ico_subject2 = file_get_contents($icomoon_path2);
}

preg_match_all($icomoon_pattern2, $ico_subject2, $ico_matches2, PREG_SET_ORDER);

foreach($ico_matches2 as $ico_match2){
	$icomoon_icons['icomoon2 ' . $ico_match2[1]] = $ico_match2[1];
	$all_icons['icomoon2 ' . $ico_match2[1]] = $ico_match2[1];
}

$icomoon_pattern3 = '/\.(icomoon3-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
$icomoon_path3 = ZOZO_ADMIN_ASSETS_DIR . 'css/icomoon-3.css';
if( file_exists( $icomoon_path3 ) ) {
	$ico_subject3 = file_get_contents($icomoon_path3);
}

preg_match_all($icomoon_pattern3, $ico_subject3, $ico_matches3, PREG_SET_ORDER);

foreach($ico_matches3 as $ico_match3){
	$icomoon_icons['icomoon2 ' . $ico_match3[1]] = $ico_match3[1];
	$all_icons['icomoon2 ' . $ico_match3[1]] = $ico_match3[1];
}

$list_icons = array ( 'fa-th-list' => '\f00b', 'fa-check' => '\f00c', 'fa-times' => '\f00d', 'fa-tag' => '\f02b', 'fa-tags' => '\f02c', 'fa-list' => '\f03a', 'fa-pencil' => '\f040', 'fa-check-square-o' => '\f046', 'fa-plus' => '\f067', 'fa-minus' => '\f068', 'fa-hand-o-right' => '\f0a4', 'fa-hand-o-up' => '\f0a6', 'fa-hand-o-down' => '\f0a7', 'fa-list-ul' => '\f0ca', 'fa-circle-o' => '\f10c', 'fa-angle-double-right' => '\f101' );

$animations = array ( 'none' => 'None', 'bounce' => 'Bounce', 'flash' => 'Flash', 'pulse' => 'Pulse', 'rubberBand' => 'Rubber Band', 'shake' => 'Shake', 'swing' => 'Swing', 'tada' => 'Tada', 'wobble' => 'Wobble', 'bounceIn' => 'Bounce In', 'bounceInDown' => 'Bounce In Down', 'bounceInLeft' => 'Bounce In Left', 'bounceInRight' => 'Bounce In Right', 'bounceInUp' => 'Bounce In Up', 'bounceOut' => 'Bounce Out', 'bounceOutDown' => 'Bounce Out Down', 'bounceOutLeft' => 'Bounce Out Left', 'bounceOutRight' => 'Bounce Out Right', 'bounceOutUp' => 'Bounce Out Up', 'fadeIn' => 'Fade In', 'fadeInDown' => 'Fade In Down', 'fadeInDownBig' => 'Fade In Down Big', 'fadeInLeft' => 'Fade In Left', 'fadeInLeftBig' => 'Fade In Left Big', 'fadeInRight' => 'Fade In Right', 'fadeInRightBig' => 'Fade In Right Big', 'fadeInUp' => 'Fade In Up', 'fadeInUpBig' => 'Fade In Up Big', 'fadeOut' => 'Fade Out', 'fadeOutDown' => 'Fade Out Down', 'fadeOutDownBig' => 'Fade Out Down Big', 'fadeOutLeft' => 'Fade Out Left', 'fadeOutLeftBig' => 'Fade Out Left Big', 'fadeOutRight' => 'Fade Out Right', 'fadeOutRightBig' => 'Fade Out Right Big', 'fadeOutUp' => 'Fade Out Up', 'fadeOutUpBig' => 'Fade Out Up Big', 'flip' => 'Flip', 'flipInX' => 'Flip In X', 'flipInY' => 'Flip In Y', 'flipOutX' => 'Flip Out X', 'flipOutY' => 'Flip Out Y', 'lightSpeedIn' => 'Light Speed In', 'rotateIn' => 'Rotate In', 'rotateInDownLeft' => 'Rotate In Down Left', 'rotateInDownRight' => 'Rotate In Down Right', 'rotateInUpLeft' => 'Rotate In Up Left', 'rotateInUpRight' => 'Rotate In Up Right', 'rotateOut' => 'Rotate Out', 'rotateOutDownLeft' => 'Rotate Out Down Left', 'rotateOutDownRight' => 'Rotate Out Down Right', 'rotateOutUpLeft' => 'Rotate Out Up Left', 'rotateOutUpRight' => 'Rotate Out Up Right', 'hinge' => 'Hinge', 'rollIn' => 'Roll In', 'rollOut' => 'Roll Out', 'zoomIn' => 'Zoom In', 'zoomInDown' => 'Zoom In Down', 'zoomInLeft' => 'Zoom In Left', 'zoomInRight' => 'Zoom In Right', 'zoomInUp' => 'Zoom In Up', 'zoomOut' => 'Zoom Out', 'zoomOutDown' => 'Zoom Out Down', 'zoomOutLeft' => 'Zoom Out Left', 'zoomOutRight' => 'Zoom Out Right', 'zoomOutUp' => 'Zoom Out Up' );

// Get Taxonomy Term List
function zozo_taxonomy_term_list($taxonomy, $post_type, $msg) {
			
	$list_groups = get_categories('taxonomy='.$taxonomy.'&post_type='.$post_type.'');
		$groups_list[0] = $msg;
		if( !empty($list_groups) ) {
			foreach ($list_groups as $groups) {
				$group_name = $groups->name;
				$termid = $groups->term_id;		
				$groups_list[$termid] = $group_name;
			}
		}
	
		if( isset($groups_list) ) {
			return $groups_list;
		}
	
}

/* =============================================================
 *  Shortcode Selection Config
 * ============================================================= */

$zozo_shortcodes['zozo-sc-generator'] = array(
	'no_preview' 	=> true,
	'params' 		=> array(),
	'shortcode' 	=> '',
	'popup_title' 	=> ''
);

/* =============================================================
 *	Alert Config
 * ============================================================= */

$zozo_shortcodes['alert'] = array(
	'no_preview' => true,
	'params' => array(
		'type' => array(			
			'type' 		=> 'select',
			'label' 	=> __('Alert Type', 'zozoshortcodes'),
			'desc' 		=> __('Select alert type', 'zozoshortcodes'),
			'options'	=> array(				
				'success' 	=> 'Success',
				'info' 		=> 'Info',
				'warning'	=> 'Warning',
				'danger' 	=> 'Danger'
			)
		),
		'content' => array(
			'std' 	=> 'Your Alert Content!',
			'type' 	=> 'textarea',
			'label' => __('Alert Content', 'zozoshortcodes'),
			'desc' 	=> __('Add the alert\'s content', 'zozoshortcodes'),
		),
		'dismissable' => array(			
			'type' 	=> 'select',
			'label' => __('Alert Dismissable', 'zozoshortcodes'),
			'desc'	=> __('Select to show close button in alert.', 'zozoshortcodes'),
			'options'	=> array(				
				'yes' 	=> 'Yes',
				'no' 	=> 'No'
			)
		),
		'animation_type' => array(			
			'type' 		=> 'select',
			'label' 	=> __('Animation Type', 'zozoshortcodes'),
			'desc'		=> __('Select the animation type for shortcode', 'zozoshortcodes'),
			'options'	=> $animations
		),
		'animation_delay' => array(
			'std' 		=> '500',
			'type' 		=> 'text',
			'label' 	=> __('Animation Delay', 'zozoshortcodes'),
			'desc' 		=> __('Enter animation delay in milliseconds. Ex: 500', 'zozoshortcodes'),
		),
	),
	'shortcode' 	=> '[zozo_alert type="{{type}}" close="{{dismissable}}" animation_type="{{animation_type}}" animation_delay="{{animation_delay}}"]{{content}}[/zozo_alert]',
	'popup_title' 	=> __('Alert Shortcode', 'zozoshortcodes')
);

/* =============================================================
 *	Button Config
 * ============================================================= */

$zozo_shortcodes['button'] = array(
	'no_preview' => true,
	'params' 	 => array(
		'url'	=> array(
			'std' 	=> '',
			'type' 	=> 'text',
			'label' => __('Button URL', 'zozoshortcodes'),
			'desc' 	=> __('Add the button\'s url. Ex: http://example.com', 'zozoshortcodes')
		),
		'style'	=> array(
			'type' 		=> 'select',
			'label' 	=> __('Button Style', 'zozoshortcodes'),
			'desc' 		=> __('Select the button\'s color', 'zozoshortcodes'),
			'options' 	=> array(
				'default'	=> 'Default',				
				'primary' 	=> 'Blue',
				'custom' 	=> 'Custom',
				'info' 		=> 'Light Blue',
				'success' 	=> 'Green',
				'warning' 	=> 'Orange',
				'danger' 	=> 'Red'
			)
		),
		'size' => array(
			'type' 		=> 'select',
			'label' 	=> __('Button Size', 'zozoshortcodes'),
			'desc' 		=> __('Select the button\'s size', 'zozoshortcodes'),
			'options' 	=> array(
				'default' 	=> 'Default',
				'wide' 		=> 'Wide',
				'mini'		=> 'Extra Small',
				'small'		=> 'Small',
				'large' 	=> 'Large'
			)
		),		
		'target' => array(
			'type' 		=> 'select',
			'label' 	=> __('Button Target', 'zozoshortcodes'),
			'desc' 		=> __('_self = open in same window. <br /> _blank = open in new window', 'zozoshortcodes'),
			'options' 	=> array(
				'_self' 	=> '_self',
				'_blank' 	=> '_blank'
			)
		),
		'content' => array(
			'std' 	=> 'Button Text',
			'type' 	=> 'text',
			'label' => __('Button\'s Text', 'zozoshortcodes'),
			'desc' 	=> __('Add the button\'s text', 'zozoshortcodes'),
		),
		'bg_color' => array(
			'std' 	=> '',
			'type' 	=> 'colorpicker',			
			'label' => __('Button Background Color', 'zozoshortcodes'),
			'desc' 	=> __('Button Background Color. It only works if choosed "Custom" style for button.', 'zozoshortcodes'),
		),
		'bg_hover_color' => array(
			'std' 	=> '',
			'type' 	=> 'colorpicker',			
			'label' => __('Button Background Hover Color', 'zozoshortcodes'),
			'desc' 	=> __('Button Background Hover Color. It only works if choosed "Custom" style for button.', 'zozoshortcodes'),
		),
		'textcolor' => array(
			'std' 	=> '',
			'type' 	=> 'colorpicker',			
			'label' => __('Button Text Color', 'zozoshortcodes'),
			'desc' 	=> __('Button Text Color. Leave blank for default.', 'zozoshortcodes'),
		),
		'texthovercolor' => array(
			'std' 	=> '',
			'type' 	=> 'colorpicker',			
			'label' => __('Button Text Hover Color', 'zozoshortcodes'),
			'desc' 	=> __('Button Text Hover Color. Leave blank for default.', 'zozoshortcodes'),
		),
		'border_width' => array(
			'std' 	=> '',
			'type' 	=> 'text',
			'label' => __('Border Width', 'zozoshortcodes'),
			'desc' 	=> __('Enter border width for button. Ex: 2 or 3.', 'zozoshortcodes'),
		),
		'border_color' => array(
			'std' 	=> '',
			'type' 	=> 'colorpicker',			
			'label' => __('Button Border Color', 'zozoshortcodes'),
			'desc' 	=> __('Button Border Color. Leave blank for default.', 'zozoshortcodes'),
		),
		'border_hover_color' => array(
			'std' 	=> '',
			'type' 	=> 'colorpicker',			
			'label' => __('Button Border Hover Color', 'zozoshortcodes'),
			'desc' 	=> __('Button Border Hover Color. Leave blank for default.', 'zozoshortcodes'),
		),
		'icon' => array(
			'type' 		=> 'iconpicker',
			'label' 	=> __('Select Icon', 'zozoshortcodes'),
			'desc' 		=> __('Click an icon to select, click again to deselect', 'zozoshortcodes'),
			'options' 	=> $icons			
		),
		'icon_position' => array(
			'type' 		=> 'select',
			'label' 	=> __('Icon Position', 'zozoshortcodes'),
			'desc' 		=> __('Select the position of the icon', 'zozoshortcodes'),
			'options' 	=> array(
				'left' 		=> 'Left',
				'right' 	=> 'Right',				
			)
		),
		'extra_class' => array(
			'std' 	=> '',
			'type' 	=> 'text',
			'label' => __('Button Extra Class', 'zozoshortcodes'),
			'desc' 	=> __('Add the button extra class.', 'zozoshortcodes'),
		),
		'animation_type' => array(			
			'type' 		=> 'select',
			'label' 	=> __('Animation Type', 'zozoshortcodes'),
			'desc'		=> __('Select the animation type for shortcode', 'zozoshortcodes'),
			'options'	=> $animations
		),
		'animation_delay' => array(
			'std' 		=> '500',
			'type' 		=> 'text',
			'label' 	=> __('Animation Delay', 'zozoshortcodes'),
			'desc' 		=> __('Enter animation delay in milliseconds. Ex: 500', 'zozoshortcodes'),
		),
	),
	'shortcode' 	=> '[zozo_button url="{{url}}" style="{{style}}" size="{{size}}" color="{{textcolor}}" hover_color="{{texthovercolor}}" bg_color="{{bg_color}}" bg_hover_color="{{bg_hover_color}}" border_width="{{border_width}}" border_color="{{border_color}}" border_hover_color="{{border_hover_color}}" icon="{{icon}}" icon_pos="{{icon_position}}" extra_class="{{extra_class}}" animation_type="{{animation_type}}" animation_delay="{{animation_delay}}" target="{{target}}"]{{content}}[/zozo_button]',
	'popup_title' 	=> __('Button Shortcode', 'zozoshortcodes')
);

/* =============================================================
 *	Columns Config
 * ============================================================= */
 
$zozo_shortcodes['columns'] = array(	
	'no_preview' 	=> true,
	'params' 		=> array(	
		'container' => array(
			'type' 	=> 'select',
			'label' => __('Container', 'zozoshortcodes'),
			'desc' 	=> __('Choose to append container div to the columns.', 'zozoshortcodes'),
			'options'	=> array(
				'no'	=> 'No',
				'yes'	=> 'Yes'						
			)
		),
		'container_class'  => array(
			'std' 	=> '',
			'type' 	=> 'text',
			'label' => __('Container Extra Class', 'zozoshortcodes'),
			'desc' 	=> __('Enter extra class for container.', 'zozoshortcodes')
		),
	),
	'child_shortcode' => array(
		'params' 	=> array(
			'column' => array(
				'type' 		=> 'select',
				'label' 	=> __('Column Size', 'zozoshortcodes'),
				'desc' 		=> __('Select the width of the column.', 'zozoshortcodes'),
				'options' 	=> array(
					'1' 	=> 'Size 1 (8.33%)',
					'2' 	=> 'Size 2 (16.67%)',
					'3' 	=> 'Size 3 (25%)',
					'4' 	=> 'Size 4 (33.33%)',
					'5' 	=> 'Size 5 (41.67%)',
					'6' 	=> 'Size 6 (50%)',
					'7' 	=> 'Size 7 (58.33%)',
					'8' 	=> 'Size 8 (66.67%)',
					'9' 	=> 'Size 9 (75%)',
					'10' 	=> 'Size 10 (83.33%)',
					'11' 	=> 'Size 11 (91.67%)',
					'12' 	=> 'Size 12 (100%)'
				)
			),
			'content' => array(
				'std' 	=> 'Your Content !',
				'type' 	=> 'textarea',
				'label' => __('Column Content', 'zozoshortcodes'),
				'desc' 	=> __('Add the column content.', 'zozoshortcodes'),
			),
			'column_class'  => array(
				'std' 	=> '',
				'type' 	=> 'text',
				'label' => __('Column Extra Class', 'zozoshortcodes'),
				'desc' 	=> __('Enter extra class for column.', 'zozoshortcodes')
			),
			'animation_type' => array(			
				'type' 		=> 'select',
				'label' 	=> __('Animation Type', 'zozoshortcodes'),
				'desc'		=> __('Select the animation type for shortcode', 'zozoshortcodes'),
				'options'	=> $animations
			),
			'animation_delay' => array(
				'std' 		=> '500',
				'type' 		=> 'text',
				'label' 	=> __('Animation Delay', 'zozoshortcodes'),
				'desc' 		=> __('Enter animation delay in milliseconds. Ex: 500', 'zozoshortcodes'),
			),
		),
		'shortcode' 	=> '[zozo_column size="{{column}}" column_class="{{column_class}}" animation_type="{{animation_type}}" animation_delay="{{animation_delay}}"]{{content}}[/zozo_column]',
		'clone_button' 	=> __('Add New Column', 'zozoshortcodes')
	),
	'shortcode' 	=> '[zozo_columns container="{{container}}" container_class="{{container_class}}"]{{child_shortcode}}[/zozo_columns]',
	'popup_title' 	=> __('Columns Shortcode', 'zozoshortcodes'),
);

/* =============================================================
 *	Client Slider Config
 * ============================================================= */
 
$zozo_shortcodes['client_slider'] = array(
	'no_preview' 	=> true,
	'params' 		=> array(	
		'number_of_items' 	=> array(
			'std' 		=> '5',
			'type' 		=> 'text',
			'label' 	=> __('Items to Display', 'zozoshortcodes'),
			'desc' 		=> __('Enter Number of items to Display for Clients Slider', 'zozoshortcodes')
		),
		'items_scroll' 	=> array(
			'std' 		=> '1',
			'type' 		=> 'text',
			'label' 	=> __('Items to Scrollby', 'zozoshortcodes'),
			'desc' 		=> __('Enter Number of items to Scrollby', 'zozoshortcodes')
		),
		'number_of_items_dksmall' => array(
			'std' 		=> '4',
			'type' 		=> 'text',
			'label' 	=> __('Items To Display in Tablet', 'zozoshortcodes'),
			'desc' 		=> __('Enter Number of items to Display in Tablet', 'zozoshortcodes')
		),
		'number_of_items_tablet' => array(
			'std' 		=> '2',
			'type' 		=> 'text',
			'label' 	=> __('Items To Display In Mobile Landscape', 'zozoshortcodes'),
			'desc' 		=> __('Enter Number of items to Display in Mobile Landscape', 'zozoshortcodes')
		),
		'number_of_items_mobile' => array(
			'std' 		=> '1',
			'type' 		=> 'text',
			'label' 	=> __('Items To Display In Mobile Portrait', 'zozoshortcodes'),
			'desc' 		=> __('Enter Number of items to Display in Mobile Portrait', 'zozoshortcodes')
		),
		'navigation' 	=> array(
			'type' 		=> 'select',
			'label' 	=> __('Enable Navigation', 'zozoshortcodes'),
			'desc' 		=> __('Select to enable navigation for slider', 'zozoshortcodes'),
			'options' 	=> array(
				'true'	=> 'Yes',
				'false' => 'No',
			)
		),
		'pagination' 	=> array(
			'type' 		=> 'select',
			'label' 	=> __('Enable Pagination', 'zozoshortcodes'),
			'desc' 		=> __('Select to enable pagination for slider', 'zozoshortcodes'),
			'options' 	=> array(
				'true'	=> 'Yes',
				'false' => 'No',
			)
		),
		'autoplay' 	=> array(
			'type' 		=> 'select',
			'label' 	=> __('Auto Play', 'zozoshortcodes'),
			'desc' 		=> __('Select to enable autoplay for slider', 'zozoshortcodes'),
			'options' 	=> array(
				'true'	=> 'Yes',
				'false' => 'No',
			)
		),
		'duration' => array(
			'std' 		=> '5000',
			'type' 		=> 'text',
			'label' 	=> __('Timeout Duration (in milliseconds)', 'zozoshortcodes'),
			'desc' 		=> __('Select Timeout Duration for slider.', 'zozoshortcodes')			
		),
		'margin' 		=> array(
			'std' 		=> '0',
			'type' 		=> 'text',
			'label' 	=> __('Margin ( Items Spacing )', 'zozoshortcodes'),
			'desc' 		=> __('Enter Spacing between items', 'zozoshortcodes')
		),
		'loop' 	=> array(
			'type' 		=> 'select',
			'label' 	=> __('Infinite Loop', 'zozoshortcodes'),
			'desc' 		=> __('Select to enable Infinite Loop for slider', 'zozoshortcodes'),
			'options' 	=> array(
				'false' => 'No',
				'true'	=> 'Yes',
			)
		),
	),	
	'child_shortcode' => array(
		'params' 	=> array(
			'url'	=> array(
				'std' 	=> '',
				'type' 	=> 'text',
				'label' => __('Client/Brand Link', 'zozoshortcodes'),
				'desc' 	=> __('Add the client\'s/brand\'s website url. Ex: http://example.com', 'zozoshortcodes')
			),
			'target' => array(
				'type' 		=> 'select',
				'label' 	=> __('Link Target', 'zozoshortcodes'),
				'desc' 		=> __('_self = open in same window. <br /> _blank = open in new window', 'zozoshortcodes'),
				'options' 	=> array(
					'_self' 	=> '_self',
					'_blank' 	=> '_blank'
				)
			),
			'image' => array(
				'type' 	=> 'media',
				'label' => __('Upload Image', 'zozoshortcodes'),
				'desc' 	=> __('Upload the client/brand image.', 'zozoshortcodes')
			),
			'alt' => array(
				'std' 	=> 'Image',
				'type' 	=> 'text',
				'label' => __('Image Alt Text', 'zozoshortcodes'),
				'desc' 	=> __('If an image cannot be viewed the alt attribute text will be shown', 'zozoshortcodes')
			),			
		),
		'shortcode' 	=> '[zozo_client link="{{url}}" target="{{target}}" image="{{image}}" alt="{{alt}}"]',
		'clone_button' 	=> __('Add New Client/Brand', 'zozoshortcodes')
	),
	'shortcode' 	=> '[zozo_client_slider items="{{number_of_items}}" itemsscroll="{{items_scroll}}" itemsdesktopsmall="{{number_of_items_dksmall}}" itemstablet="{{number_of_items_tablet}}" itemsmobile="{{number_of_items_mobile}}" navigation="{{navigation}}" pagination="{{pagination}}" autoplay="{{autoplay}}" duration="{{duration}}" margin="{{margin}}" loop="{{loop}}"]{{child_shortcode}}[/zozo_client_slider]',
	'popup_title' 	=> __('Client/Brands Slider Shortcode', 'zozoshortcodes'),
);

/* =============================================================
 *	Dropcap Config
 * ============================================================= */

$zozo_shortcodes['dropcap'] = array(
	'no_preview' => true,
	'params' 	 => array(
		'content' => array(
			'std' 	=> 'Z',
			'type' 	=> 'textarea',
			'label' => __( 'Dropcap Letter', 'zozoshortcodes' ),
			'desc' 	=> __( 'Enter the letter to be used as dropcap', 'zozoshortcodes' ),
		),
		'textcolor' => array(
			'std' 	=> '',
			'type' 	=> 'colorpicker',			
			'label' => __('Dropcap Color', 'zozoshortcodes'),
			'desc' 	=> __('Dropcap Color. Leave blank for default.', 'zozoshortcodes' ),
		),
	),
	'shortcode' 	=> '[zozo_dropcap color="{{textcolor}}"]{{content}}[/zozo_dropcap]',
	'popup_title' 	=> __( 'Dropcap Shortcode', 'zozoshortcodes' )
);


/* =============================================================
 *	Highlight Config
 * ============================================================= */

$zozo_shortcodes['highlight'] = array(
	'no_preview' => true,
	'params' 	 => array(
		'bg_color' => array(
			'type' 	=> 'colorpicker',
			'label' => __('Highlight Background Color', 'zozoshortcodes'),
			'desc' 	=> __('Choose a highlight background color', 'zozoshortcodes')
		),
		'color'  => array(
			'type' 	=> 'colorpicker',
			'label' => __('Highlight Text Color', 'zozoshortcodes'),
			'desc' 	=> __('Choose a highlight text color', 'zozoshortcodes')
		),
		'content' => array(
			'std' 	=> 'Your Content !',
			'type' 	=> 'textarea',
			'label' => __( 'Content to Hightlight', 'zozoshortcodes' ),
			'desc' 	=> __( 'Enter the content to be highlighted', 'zozoshortcodes' ),
		)

	),
	'shortcode' 	=> '[zozo_highlight color="{{color}}" bg_color="{{bg_color}}"]{{content}}[/zozo_highlight]',
	'popup_title' 	=> __( 'Highlight Shortcode', 'zozoshortcodes' )
);

/* =============================================================
 *	List Item Config
 * ============================================================= */

$zozo_shortcodes['listitem'] = array(
	'no_preview' => true,
	'params' 	 => array(
		'icon' 	=> array(
			'type' 		=> 'iconpicker',
			'label' 	=> __('Select Icon', 'zozoshortcodes'),
			'desc' 		=> __('Click an icon to select, click again to deselect', 'zozoshortcodes'),
			'options' 	=> $list_icons
		),
		'iconcolor' => array(
			'type' 	=> 'colorpicker',
			'label' => __('Icon Color', 'zozoshortcodes'),
			'desc' 	=> __('Leave blank for default', 'zozoshortcodes')
		),
		'iconbgcolor' => array(
			'type' 	=> 'colorpicker',
			'label' => __('Icon Background Color', 'zozoshortcodes'),
			'desc' 	=> __('Leave blank for default color', 'zozoshortcodes')
		),
		'icontype' => array(
			'type' 	=> 'select',
			'label' => __('Icon Type', 'zozoshortcodes'),
			'desc' 	=> __('Choose to display of icon', 'zozoshortcodes'),
			'options'	=> array(
				'none'		=> 'None',
				'circle'	=> 'Circle',
				'square' 	=> 'Square'
			)
		),
		'listinline' => array(
			'type' 	=> 'select',
			'label' => __('Inline List Type', 'zozoshortcodes'),
			'desc' 	=> __('Choose to display of list items inline', 'zozoshortcodes'),
			'options'	=> array(
				'yes'	=> 'Yes',
				'no'	=> 'No'				
			)
		),
		'animation_type' => array(			
			'type' 		=> 'select',
			'label' 	=> __('Animation Type', 'zozoshortcodes'),
			'desc'		=> __('Select the animation type for shortcode', 'zozoshortcodes'),
			'options'	=> $animations
		),
		'animation_delay' => array(
			'std' 		=> '500',
			'type' 		=> 'text',
			'label' 	=> __('Animation Delay', 'zozoshortcodes'),
			'desc' 		=> __('Enter animation delay in milliseconds. Ex: 500', 'zozoshortcodes'),
		),
	),
		
	'child_shortcode' => array(
		'params' 	=> array(
			'content' 	=> array(
				'std' 	=> 'Your Content',
				'type' 	=> 'textarea',
				'label' => __( 'List Item Content', 'zozoshortcodes' ),
				'desc' 	=> __( 'Enter list item content', 'zozoshortcodes' ),
			),
		),
		'shortcode' 	=> '&lt;li&gt;{{content}}&lt;/li&gt;',
		'clone_button' 	=> __('Add New List Item', 'zozoshortcodes')
	),
	'shortcode' 	=> '[zozo_listitem icon="{{icon}}" iconcolor="{{iconcolor}}" iconbgcolor="{{iconbgcolor}}" icontype="{{icontype}}" listinline="{{listinline}}" animation_type="{{animation_type}}" animation_delay="{{animation_delay}}"]&lt;ul&gt;{{child_shortcode}}&lt;/ul&gt;[/zozo_listitem]',
	'popup_title' 	=> __('List Item Shortcode', 'zozoshortcodes'),
);

/* =============================================================
 *	Fontawesome Config
 * ============================================================= */

$zozo_shortcodes['fontawesome'] = array(
	'no_preview' => true,
	'params'	 => array(
		'icon' 		=> array(
			'type' 		=> 'iconpicker',
			'label' 	=> __('Select Icon', 'zozoshortcodes'),
			'desc' 		=> __('Click an icon to select, click again to deselect', 'zozoshortcodes'),
			'options' 	=> $icons
		),
		'icontype' => array(
			'type' 		=> 'select',
			'label' 	=> __('Icon Type', 'zozoshortcodes'),
			'desc' 		=> __('Choose to display of icon. If "none" background and border icon wont displayed.', 'zozoshortcodes'),
			'options'	=> array(
				'none'		=> 'None',
				'circle'	=> 'Circle',
				'square' 	=> 'Square'
			)
		),
		'iconstyle' => array(
			'type' 		=> 'select',
			'label' 	=> __('Icon Style', 'zozoshortcodes'),
			'desc' 		=> __('Choose icon style.', 'zozoshortcodes'),
			'options'	=> array(				
				'light'			=> 'Light',
				'dark' 			=> 'Dark',
				'bordered'		=> 'Bordered',
				'transparent'	=> 'Transparent'
			)
		),
		'size' => array(
			'type' 		=> 'select',
			'label' 	=> __('Icon Size', 'zozoshortcodes'),
			'desc' 		=> __('Select the size of the icon', 'zozoshortcodes'),
			'options' 	=> array(
				'small' 	=> 'Small',				
				'medium' 	=> 'Medium',
				'large' 	=> 'Large',
				'exlarge' 	=> 'Extra Large'
			)
		),
		'iconcolor' => array(
			'type' 	=> 'colorpicker',
			'label' => __('Icon Color', 'zozoshortcodes'),
			'desc' 	=> __('Leave blank for default color', 'zozoshortcodes')
		),
		'iconbgcolor' => array(
			'type' 	=> 'colorpicker',
			'label' => __('Icon Background Color', 'zozoshortcodes'),
			'desc' 	=> __('Leave blank for default color', 'zozoshortcodes')
		),
		'bordercolor' => array(
			'type' 	=> 'colorpicker',
			'label' => __('Icon Border Color', 'zozoshortcodes'),
			'desc' 	=> __('Leave blank for default color', 'zozoshortcodes')
		),
		'border_width' => array(
			'std' 	=> '',
			'type' 	=> 'text',
			'label' => __('Border Width', 'zozoshortcodes'),
			'desc' 	=> __('Enter border width for icon. Ex: 2 or 3.', 'zozoshortcodes'),
		),
		'animation_type' => array(			
			'type' 		=> 'select',
			'label' 	=> __('Animation Type', 'zozoshortcodes'),
			'desc'		=> __('Select the animation type for shortcode', 'zozoshortcodes'),
			'options'	=> $animations
		),
		'animation_delay' => array(
			'std' 		=> '500',
			'type' 		=> 'text',
			'label' 	=> __('Animation Delay', 'zozoshortcodes'),
			'desc' 		=> __('Enter animation delay in milliseconds. Ex: 500', 'zozoshortcodes'),
		),
	),
	'shortcode' 	=> '[zozo_fontawesome icon="{{icon}}" icontype="{{icontype}}" iconstyle="{{iconstyle}}" size="{{size}}" iconcolor="{{iconcolor}}" iconbgcolor="{{iconbgcolor}}" bordercolor="{{bordercolor}}" borderwidth="{{border_width}}" animation_type="{{animation_type}}" animation_delay="{{animation_delay}}"]',
	'popup_title' 	=> __( 'Font Awesome Shortcode', 'zozoshortcodes' )
);

/* =============================================================
 *	Flaticons & Icomoon Config
 * ============================================================= */

$zozo_shortcodes['allicons'] = array(
	'no_preview' => true,
	'params'	 => array(
		'icon' 		=> array(
			'type' 		=> 'iconpicker',
			'label' 	=> __('Select Icon', 'zozoshortcodes'),
			'desc' 		=> __('Click an icon to select, click again to deselect', 'zozoshortcodes'),
			'options' 	=> $all_icons
		),
		'icontype' => array(
			'type' 		=> 'select',
			'label' 	=> __('Icon Type', 'zozoshortcodes'),
			'desc' 		=> __('Choose to display of icon. If "none" background and border icon wont displayed.', 'zozoshortcodes'),
			'options'	=> array(
				'none'		=> 'None',
				'circle'	=> 'Circle',
				'square' 	=> 'Square'				
			)
		),
		'iconstyle' => array(
			'type' 		=> 'select',
			'label' 	=> __('Icon Style', 'zozoshortcodes'),
			'desc' 		=> __('Choose icon style.', 'zozoshortcodes'),
			'options'	=> array(
				'light'			=> 'Light',
				'dark' 			=> 'Dark',
				'bordered'		=> 'Bordered',
				'transparent'	=> 'Transparent'
			)
		),
		'size' => array(
			'type' 		=> 'select',
			'label' 	=> __('Icon Size', 'zozoshortcodes'),
			'desc' 		=> __('Select the size of the icon', 'zozoshortcodes'),
			'options' 	=> array(
				'small' 	=> 'Small',
				'medium' 	=> 'Medium',
				'large' 	=> 'Large',
				'exlarge' 	=> 'Extra Large'
			)
		),
		'iconcolor' => array(
			'type' 	=> 'colorpicker',
			'label' => __('Icon Color', 'zozoshortcodes'),
			'desc' 	=> __('Leave blank for default color', 'zozoshortcodes')
		),
		'iconbgcolor' => array(
			'type' 	=> 'colorpicker',
			'label' => __('Icon Background Color', 'zozoshortcodes'),
			'desc' 	=> __('Leave blank for default color', 'zozoshortcodes')
		),
		'bordercolor' => array(
			'type' 	=> 'colorpicker',
			'label' => __('Icon Border Color', 'zozoshortcodes'),
			'desc' 	=> __('Leave blank for default color', 'zozoshortcodes')
		),
		'border_width' => array(
			'std' 	=> '',
			'type' 	=> 'text',
			'label' => __('Border Width', 'zozoshortcodes'),
			'desc' 	=> __('Enter border width for icon. Ex: 2 or 3.', 'zozoshortcodes'),
		),
		'animation_type' => array(			
			'type' 		=> 'select',
			'label' 	=> __('Animation Type', 'zozoshortcodes'),
			'desc'		=> __('Select the animation type for shortcode', 'zozoshortcodes'),
			'options'	=> $animations
		),
		'animation_delay' => array(
			'std' 		=> '500',
			'type' 		=> 'text',
			'label' 	=> __('Animation Delay', 'zozoshortcodes'),
			'desc' 		=> __('Enter animation delay in milliseconds. Ex: 500', 'zozoshortcodes'),
		),
	),
	'shortcode' 	=> '[zozo_icons icon="{{icon}}" icontype="{{icontype}}" iconstyle="{{iconstyle}}" size="{{size}}" iconcolor="{{iconcolor}}" iconbgcolor="{{iconbgcolor}}" bordercolor="{{bordercolor}}" borderwidth="{{border_width}}" animation_type="{{animation_type}}" animation_delay="{{animation_delay}}"]',
	'popup_title' 	=> __( 'Icons Shortcode', 'zozoshortcodes' )
);

/* =============================================================
 *	Image Frame Config
 * ============================================================= */

$zozo_shortcodes['imageframe'] = array(
	'no_preview' => true,
	'params' 	 => array(
		'shape'  => array(
			'type' 		=> 'select',
			'std' 		=> '',
			'label' 	=> __('Image Shape', 'zozoshortcodes'),
			'desc' 		=> __('Choose image shape. For circle shape image need to be equal in width and height.', 'zozoshortcodes'),
			'options' 	=> array(
				'none' 			=> 'None',
				'angle' 		=> 'Angle Shape',
				'rounded' 		=> 'Rounded Corners',
				'circle' 		=> 'Circle',
				'thumbnail' 	=> 'Border'				
			)
		),
		'shadow'  => array(
			'type' 		=> 'select',
			'std' 		=> '',
			'label' 	=> __('Image Frame Shadow', 'zozoshortcodes'),
			'desc' 		=> __('Select shadow will show on Image Frame.', 'zozoshortcodes'),
			'options' 	=> array(
				'none' 			=> 'None',
				'dropshade'		=> 'Drop Shadow',
				'bottomcurved' 	=> 'Bottom Curved Shadow',
				'roundedshade' 	=> 'Rounded Drop Shadow',
			)
		),
		'bordercolor' => array(
			'type' 	=> 'colorpicker',
			'label' => __( 'Border Color', 'zozoshortcodes' ),
			'desc' 	=> __( 'Choose color for border.', 'zozoshortcodes' ),
		),
		'border_width' => array(
			'std' 	=> '',
			'type' 	=> 'text',
			'label' => __('Border Width', 'zozoshortcodes'),
			'desc' 	=> __('Enter border width for image. Ex: 2 or 3.', 'zozoshortcodes'),
		),
		'lightbox' => array(
			'type' 		=> 'select',
			'std' 		=> '',
			'label' 	=> __('Lightbox Image', 'zozoshortcodes'),
			'desc' 		=> __('Show image in Lightbox', 'zozoshortcodes'),
			'options' 	=> array(
				'yes' 		=> 'Yes',
				'no' 		=> 'No'				
			)
		),
		'image' => array(
			'type' 	=> 'media',
			'std' 	=> '',
			'label' => __('Upload Image', 'zozoshortcodes'),
			'desc' 	=> __('Upload an image to display in the frame', 'zozoshortcodes')
		),
		'alt' => array(
			'std' 	=> 'Image',
			'type' 	=> 'text',
			'label' => __('Image Alt Text', 'zozoshortcodes'),
			'desc' 	=> __('If an image cannot be viewed the alt attribute text will be shown', 'zozoshortcodes')
		),
		'animation_type' => array(			
			'type' 		=> 'select',
			'label' 	=> __('Animation Type', 'zozoshortcodes'),
			'desc'		=> __('Select the animation type for shortcode', 'zozoshortcodes'),
			'options'	=> $animations
		),
		'animation_delay' => array(
			'std' 		=> '500',
			'type' 		=> 'text',
			'label' 	=> __('Animation Delay', 'zozoshortcodes'),
			'desc' 		=> __('Enter animation delay in milliseconds. Ex: 500', 'zozoshortcodes'),
		),
	),
	'shortcode' 	=> '[zozo_imageframe shape="{{shape}}" shadow="{{shadow}}" bordercolor="{{bordercolor}}" borderwidth="{{border_width}}" lightbox="{{lightbox}}" src="{{image}}" alt="{{alt}}" animation_type="{{animation_type}}" animation_delay="{{animation_delay}}"]',
	'popup_title' 	=> __( 'Image Frame Shortcode', 'zozoshortcodes' )
);

/* =============================================================
 *	Bootstrap Simple Carousel Config
 * ============================================================= */

$zozo_shortcodes['bootcarousel'] = array(
	'no_preview' => true,
	'params' 	 => array(),
	'child_shortcode' => array(
		'params' => array(
			'linktype' => array(
				'type' 		=> 'select',
				'label' 	=> __('Link Type', 'zozoshortcodes'),
				'desc' 		=> __('Choose Image Link Type', 'zozoshortcodes'),
				'options' 	=> array(
					'none'		=> 'None',
					'lightbox' 	=> 'Lightbox',
					'link' 		=> 'Link'
				)
			),
			'url' => array(
				'std' 	=> '',
				'type' 	=> 'text',
				'label' => __('Image Link', 'zozoshortcodes'),
				'desc' 	=> __('Add the url to image. Only for Image Link Type', 'zozoshortcodes')
			),
			'target' => array(
				'type' 		=> 'select',
				'label' 	=> __('Link Target', 'zozoshortcodes'),
				'desc' 		=> __('_self = Open in same window <br />_blank = Open in new window', 'zozoshortcodes'),
				'options' 	=> array(
					'_self' => '_self',
					'_blank' => '_blank'
				)
			),
			'image' => array(
				'type' 	=> 'media',
				'label' => __('Image', 'zozoshortcodes'),
				'desc' 	=> __('Upload an image for carousel', 'zozoshortcodes')
			),
			'alt' => array(
				'std' 	=> '',
				'type' 	=> 'text',
				'label' => __('Image Alt Text', 'zozoshortcodes'),
				'desc' 	=> __('If an image cannot be viewed the alt attribute text will be shown', 'zozoshortcodes')
			),
			'caption' => array(
				'std' 	=> 'Your Caption',
				'type' 	=> 'textarea',
				'label' => __( 'Caption', 'zozoshortcodes' ),
				'desc' 	=> __( 'Add caption to show in slider', 'zozoshortcodes' ),
			)
		),
		'shortcode' 	=> '[zozo_image linktype="{{linktype}}" link="{{url}}" target="{{target}}" image="{{image}}" alt="{{alt}}" caption="{{caption}}"]',
		'clone_button'  => __('Add New Carousel Item', 'zozoshortcodes')
	),
	'shortcode' 	=> '[zozo_carousel]{{child_shortcode}}[/zozo_carousel]',
	'popup_title' 	=> __('Boostrap Carousel Shortcode', 'zozoshortcodes'),
);

/* =============================================================
 *	Progress Bar Config
 * ============================================================= */

$zozo_shortcodes['progressbar'] = array(
	'no_preview' => true,
	'params' 	 => array(
		'title' => array(
			'std' 	=> '',
			'type' 	=> 'text',
			'label' => __( 'Progress Bar Title', 'zozoshortcodes' ),
			'desc' 	=> __( 'Enter Progress Bar Title', 'zozoshortcodes' ),
		),
		'value' => array(
			'std' 	=> '20',
			'type' 	=> 'text',
			'label' => __('Filled Area Percentage', 'zozoshortcodes'),
			'desc' 	=> __('Enter number from 1 to 100', 'zozoshortcodes')			
		),		
		'filledcolor' => array(
			'type' 	=> 'colorpicker',
			'label' => __('Filled Color', 'zozoshortcodes'),
			'desc'	=> __('Background Color for filled in area', 'zozoshortcodes')
		),
		'unfilledcolor' => array(
			'type' 	=> 'colorpicker',
			'label' => __('Unfilled Color', 'zozoshortcodes'),
			'desc'  => __('Background Color for unfilled area', 'zozoshortcodes')
		),
		'animation' => array(
			'type' 		=> 'select',
			'label' 	=> __('Enable Striped Animation', 'zozoshortcodes'),
			'desc' 		=> __('Choose to enable striped animation on Progress Bars.', 'zozoshortcodes'),
			'options' 	=> array(
				'yes'	=> 'Yes',
				'no' 	=> 'No'
			)
		),
		'content' => array(
			'std' 	=> '',
			'type' 	=> 'text',
			'label' => __( 'Progress Bar Text', 'zozoshortcodes' ),
			'desc' 	=> __( 'Enter the text to show in progess bar', 'zozoshortcodes' ),
		)
	),
	'shortcode' 	=> '[zozo_progress_bar title="{{title}}" percentage="{{value}}" filledcolor="{{filledcolor}}" unfilledcolor="{{unfilledcolor}}" animation="{{animation}}"]{{content}}[/zozo_progress_bar]',
	'popup_title' 	=> __('Progress Bar Shortcode', 'zozoshortcodes')
);

/* =============================================================
 *	Counters Config
 * ============================================================= */

$zozo_shortcodes['counters'] = array(
	'no_preview' => true,
	'params' 	 => array(),
	'child_shortcode' => array(
		'params' => array(
			'title' => array(
				'std' 	=> '',
				'type' 	=> 'text',
				'label' => __('Title', 'zozoshortcodes'),
				'desc' 	=> __('Enter the title for counter item.', 'zozoshortcodes')
			),
			'value' => array(
				'std' 	=> '150',
				'type' 	=> 'text',
				'label' => __('Counter Value', 'zozoshortcodes'),
				'desc' 	=> __('Enter counter value.', 'zozoshortcodes')
			),
			'icon' 		=> array(
				'type' 		=> 'iconpicker',
				'label' 	=> __('Select Icon', 'zozoshortcodes'),
				'desc' 		=> __('Click an icon to select, click again to deselect', 'zozoshortcodes'),
				'options' 	=> $icons
			),
			'iconsize' => array(
				'std' 	=> '',
				'type' 	=> 'text',
				'label' => __('Icon Size', 'zozoshortcodes'),
				'desc' 	=> __('Enter Icon size. Ex: 30px', 'zozoshortcodes')
			),
			'iconcolor' => array(
				'type' 	=> 'colorpicker',
				'label' => __('Icon Color', 'zozoshortcodes'),
				'desc' 	=> __('Leave blank for default', 'zozoshortcodes')
			),
			'titlecolor' => array(
				'type' 	=> 'colorpicker',
				'label' => __('Title Color', 'zozoshortcodes'),
				'desc' 	=> __('Leave blank for default', 'zozoshortcodes')
			),
			'animation_type' => array(			
				'type' 		=> 'select',
				'label' 	=> __('Animation Type', 'zozoshortcodes'),
				'desc'		=> __('Select the animation type for shortcode', 'zozoshortcodes'),
				'options'	=> $animations
			),
			'animation_delay' => array(
				'std' 		=> '500',
				'type' 		=> 'text',
				'label' 	=> __('Animation Delay', 'zozoshortcodes'),
				'desc' 		=> __('Enter animation delay in milliseconds. Ex: 500', 'zozoshortcodes'),
			),			
		),
		'shortcode' 	=> '[zozo_counter title="{{title}}" value="{{value}}" icon="{{icon}}" iconsize="{{iconsize}}" iconcolor="{{iconcolor}}" titlecolor="{{titlecolor}}" animation_type="{{animation_type}}" animation_delay="{{animation_delay}}"]',
		'clone_button'  => __('Add New Counter', 'zozoshortcodes')
	),
	'shortcode' 	=> '[zozo_counters]{{child_shortcode}}[/zozo_counters]',
	'popup_title' 	=> __('Counters Shortcode', 'zozoshortcodes'),
);

/* =============================================================
 *	Jumbotron Config
 * ============================================================= */

$zozo_shortcodes['jumbotron'] = array(
	'no_preview' => true,
	'params' 	 => array(
		'title' => array(
			'std' 	=> '',
			'type' 	=> 'text',
			'label' => __('Title', 'zozoshortcodes'),
			'desc' 	=> __('Enter title to show in Jumbotron', 'zozoshortcodes')			
		),
		'content' => array(
			'type' 	=> 'textarea',
			'label' => __('Content', 'zozoshortcodes'),
			'desc'	=> __('Enter content to show in Jumbotron', 'zozoshortcodes')
		),
		'bg_image' => array(
			'type' 	=> 'media',
			'label' => __('Container Background Image', 'zozoshortcodes'),
			'desc' 	=> __('Upload an image to use background for container. Leave blank for default.', 'zozoshortcodes'),
		),
		'bg_repeat' => array(
			'type' 		=> 'select',
			'label' 	=> __('Background Repeat', 'zozoshortcodes'),
			'desc' 		=> __('Choose background repeat for container.', 'zozoshortcodes'),
			'options' 	=> array(
				'repeat'	=> 'Repeat', 
				'repeat-x'	=> 'Repeat-x', 
				'repeat-y'	=> 'Repeat-y', 
				'no-repeat' => 'No Repeat' 
			)
		),
		'bg_color' => array(
			'std' 	=> '',
			'type' 	=> 'colorpicker',			
			'label' => __('Container Background Color', 'zozoshortcodes'),
			'desc' 	=> __('Choose Container Background Color.', 'zozoshortcodes'),
		),
		'content_color' => array(
			'std' 	=> '',
			'type' 	=> 'colorpicker',			
			'label' => __('Container Text Color', 'zozoshortcodes'),
			'desc' 	=> __('Choose Container Text Color.', 'zozoshortcodes'),
		),
		'border_radius' => array(
			'std' 	=> '',
			'type' 	=> 'text',
			'label' => __('Border Radius', 'zozoshortcodes'),
			'desc' 	=> __('Enter border radius. Ex: 2px or 50%.', 'zozoshortcodes')			
		),
		'show_button' => array(
			'type' 		=> 'select',
			'label' 	=> __('Show Button', 'zozoshortcodes'),
			'desc' 		=> __('Choose to show button with custom link.', 'zozoshortcodes'),
			'options' 	=> array(
				'yes'	=> 'Yes',
				'no' 	=> 'No'
			)
		),
		'button_text' => array(
			'std' 	=> '',
			'type' 	=> 'text',
			'label' => __('Button Text', 'zozoshortcodes'),
			'desc' 	=> __('Enter button text.', 'zozoshortcodes')			
		),
		'button_link' => array(
			'std' 	=> '',
			'type' 	=> 'text',
			'label' => __('Button Link', 'zozoshortcodes'),
			'desc'  => __('Enter button link.', 'zozoshortcodes')
		),
		'target' => array(
			'type' 		=> 'select',
			'label' 	=> __('Link Target', 'zozoshortcodes'),
			'desc' 		=> __('_self = Open in same window <br />_blank = Open in new window', 'zozoshortcodes'),
			'options' 	=> array(
				'_self'  => '_self',
				'_blank' => '_blank'
			)
		),
		'size' 	=> array(
			'type' 		=> 'select',
			'label' 	=> __('Button Size', 'zozoshortcodes'),
			'desc' 		=> __('Select the button\'s size', 'zozoshortcodes'),
			'options' 	=> array(
				'default' 	=> 'Default',
				'mini'		=> 'Extra Small',
				'small'		=> 'Small',
				'large' 	=> 'Large'
			)
		),
		'button_bg_color' => array(
			'std' 	=> '',
			'type' 	=> 'colorpicker',			
			'label' => __('Button Background Color', 'zozoshortcodes'),
			'desc' 	=> __('Button Background Color.', 'zozoshortcodes'),
		),
		'button_bg_hover_color' => array(
			'std' 	=> '',
			'type' 	=> 'colorpicker',			
			'label' => __('Button Background Hover Color', 'zozoshortcodes'),
			'desc' 	=> __('Button Background Hover Color.', 'zozoshortcodes'),
		),
		'textcolor' => array(
			'std' 	=> '',
			'type' 	=> 'colorpicker',			
			'label' => __('Button Text Color', 'zozoshortcodes'),
			'desc' 	=> __('Button Text Color. Leave blank for default.', 'zozoshortcodes'),
		),
		'texthovercolor' => array(
			'std' 	=> '',
			'type' 	=> 'colorpicker',			
			'label' => __('Button Text Hover Color', 'zozoshortcodes'),
			'desc' 	=> __('Button Text Hover Color. Leave blank for default.', 'zozoshortcodes'),
		),
		'icon' => array(
			'type' 		=> 'iconpicker',
			'label' 	=> __('Select Icon', 'zozoshortcodes'),
			'desc' 		=> __('Click an icon to select, click again to deselect', 'zozoshortcodes'),
			'options' 	=> $icons			
		),
		'icon_position' => array(
			'type' 		=> 'select',
			'label' 	=> __('Icon Position', 'zozoshortcodes'),
			'desc' 		=> 'Select the position of the icon for button',
			'options' 	=> array(
				'left' 		=> 'Left',
				'right' 	=> 'Right',				
			)
		),
		'animation_type' => array(			
			'type' 		=> 'select',
			'label' 	=> __('Animation Type', 'zozoshortcodes'),
			'desc'		=> __('Select the animation type for shortcode', 'zozoshortcodes'),
			'options'	=> $animations
		),
		'animation_delay' => array(
			'std' 		=> '500',
			'type' 		=> 'text',
			'label' 	=> __('Animation Delay', 'zozoshortcodes'),
			'desc' 		=> __('Enter animation delay in milliseconds. Ex: 500', 'zozoshortcodes'),
		),
	),
	'shortcode' 	=> '[zozo_jumbotron title="{{title}}" show_button="{{show_button}}" bg_image="{{bg_image}}" bg_repeat="{{bg_repeat}}" bg_color="{{bg_color}}" content_color="{{content_color}}" borderradius="{{border_radius}}" button_text="{{button_text}}" button_link="{{button_link}}" target="{{target}}" size="{{size}}" button_bg_color="{{button_bg_color}}" button_bg_hover_color="{{button_bg_hover_color}}" color="{{textcolor}}" hovercolor="{{texthovercolor}}" icon="{{icon}}" icon_pos="{{icon_position}}" animation_type="{{animation_type}}" animation_delay="{{animation_delay}}"]{{content}}[/zozo_jumbotron]',
	'popup_title' 	=> __('Jumbotron Shortcode', 'zozoshortcodes')
);

/* =============================================================
 *	Modals Config
 * ============================================================= */

$zozo_shortcodes['modal'] = array(
	'no_preview' => true,
	'params' 	 => array(
		'title' => array(
			'std' 	=> '',
			'type' 	=> 'text',
			'label' => __('Modal Title', 'zozoshortcodes'),
			'desc' 	=> __('Enter title to show in Modal header', 'zozoshortcodes')
		),
		'content' => array(
			'type' 	=> 'textarea',
			'label' => __('Content', 'zozoshortcodes'),
			'desc'	=> __('Enter content to show in Modal', 'zozoshortcodes')
		),
		'modal_size' => array(
			'type' 	=> 'select',
			'label' => __('Modal Size', 'zozoshortcodes'),
			'desc' 	=> __('Choose modal size', 'zozoshortcodes'),
			'options' 	=> array(
				'default'	=> 'Default',
				'small'		=> 'Small',
				'large' 	=> 'Large'
			)
		),
		'button_size' => array(
			'type' 	=> 'select',
			'label' => __('Button Size', 'zozoshortcodes'),
			'desc' 	=> __('Choose button size', 'zozoshortcodes'),
			'options' 	=> array(
				'default'	=> 'Default',
				'mini'		=> 'Extra Small',
				'small'		=> 'Small',
				'large' 	=> 'Large'
			)
		),
		'button_text' => array(
			'std' 	=> '',
			'type' 	=> 'text',
			'label' => __('Button Text', 'zozoshortcodes'),
			'desc' 	=> __('Enter button text to open modal window by clicking it.', 'zozoshortcodes')
		),
		'button_bg_color' => array(
			'std' 	=> '',
			'type' 	=> 'colorpicker',
			'label' => __('Button Background Color', 'zozoshortcodes'),
			'desc' 	=> __('Button Background Color.', 'zozoshortcodes'),
		),
		'button_bg_hover_color' => array(
			'std' 	=> '',
			'type' 	=> 'colorpicker',
			'label' => __('Button Background Hover Color', 'zozoshortcodes'),
			'desc' 	=> __('Button Background Hover Color.', 'zozoshortcodes'),
		),
		'textcolor' => array(
			'std' 	=> '',
			'type' 	=> 'colorpicker',
			'label' => __('Button Text Color', 'zozoshortcodes'),
			'desc' 	=> __('Button Text Color. Leave blank for default.', 'zozoshortcodes'),
		),
		'texthovercolor' => array(
			'std' 	=> '',
			'type' 	=> 'colorpicker',
			'label' => __('Button Text Hover Color', 'zozoshortcodes'),
			'desc' 	=> __('Button Text Hover Color. Leave blank for default.', 'zozoshortcodes'),
		),
		'icon' => array(
			'type' 		=> 'iconpicker',
			'label' 	=> __('Select Icon', 'zozoshortcodes'),
			'desc' 		=> __('Click an icon to select, click again to deselect', 'zozoshortcodes'),
			'options' 	=> $icons
		),
		'icon_position' => array(
			'type' 		=> 'select',
			'label' 	=> __('Icon Position', 'zozoshortcodes'),
			'desc' 		=> 'Select the position of the icon for button',
			'options' 	=> array(
				'left' 		=> 'Left',
				'right' 	=> 'Right',
			)
		),
		'animation_type' => array(			
			'type' 		=> 'select',
			'label' 	=> __('Animation Type', 'zozoshortcodes'),
			'desc'		=> __('Select the animation type for shortcode', 'zozoshortcodes'),
			'options'	=> $animations
		),
		'animation_delay' => array(
			'std' 		=> '500',
			'type' 		=> 'text',
			'label' 	=> __('Animation Delay', 'zozoshortcodes'),
			'desc' 		=> __('Enter animation delay in milliseconds. Ex: 500', 'zozoshortcodes'),
		),
	),
	'shortcode' 	=> '[zozo_modals title="{{title}}" modal_size="{{modal_size}}" button_size="{{button_size}}" button_text="{{button_text}}" button_bg_color="{{button_bg_color}}" button_bg_hover_color="{{button_bg_hover_color}}" color="{{textcolor}}" hovercolor="{{texthovercolor}}" icon="{{icon}}" icon_pos="{{icon_position}}" animation_type="{{animation_type}}" animation_delay="{{animation_delay}}"]{{content}}[/zozo_modals]',
	'popup_title' 	=> __('Modals Shortcode', 'zozoshortcodes')
);

/* =============================================================
 *	Tabs Config
 * ============================================================= */

$zozo_shortcodes['tabs'] = array(
	'no_preview' => true,
	'params' 	 => array(
		'layout' 		=> array(
			'type' 		=> 'select',
			'std' 		=> '',
			'label' 	=> __('Layout', 'zozoshortcodes'),
			'desc' 		=> __('Choose the layout of tabs', 'zozoshortcodes'),
			'options' 	=> array(
				'horizontal' 	=> 'Horizontal',
				'vertical-left'	=> 'Vertical Left',
				'vertical-right'=> 'Vertical Right'
			)
		),
		'activecolor' 	=> array(
			'type' 	=> 'colorpicker',
			'std' 	=> '',
			'label' => __('Active Background Color', 'zozoshortcodes'),
			'desc' 	=> __('Choose active tab background color. Leave blank for default', 'zozoshortcodes'),
		),
		'inactivecolor' => array(
			'type' 	=> 'colorpicker',
			'std' 	=> '',
			'label' => __('Inactive Background Color', 'zozoshortcodes'),
			'desc' 	=> __('Choose inactive tab background color. Leave blank for default', 'zozoshortcodes'),
		)
	),
	'child_shortcode' => array(
		'params' 	  => array(
			'title'   => array(
				'std' 	=> 'Title',
				'type' 	=> 'text',
				'label' => __('Tab Title', 'zozoshortcodes'),
				'desc' 	=> __('Title of the tab', 'zozoshortcodes'),
			),
			'icon' => array(
				'type' 		=> 'iconpicker',
				'std' 		=> '',
				'label' 	=> __('Select Icon', 'zozoshortcodes'),
				'desc' 		=> __('Select icon to show before tab title. Click an icon to select, click again to deselect', 'zozoshortcodes'),
				'options' 	=> $icons
			),
			'titlecolor' => array(
				'type' 	=> 'colorpicker',
				'std' 	=> '',
				'label' => __('Icon & Title Color', 'zozoshortcodes'),
				'desc' 	=> __('Choose icon and tab title color. Leave blank for default', 'zozoshortcodes'),
			),
			'content' => array(
				'std' 	=> 'Your Tab Content',
				'type' 	=> 'textarea',
				'label' => __('Tab Content', 'zozoshortcodes'),
				'desc' 	=> __('Add the tabs content', 'zozoshortcodes')
			)
		),
		'shortcode' 	=> '[zozo_tab title="{{title}}" icon="{{icon}}" color="{{titlecolor}}"]{{content}}[/zozo_tab]',
		'clone_button'  => __('Add New Tab', 'zozoshortcodes')
	),
	'shortcode' 	=> '[zozo_tabs layout="{{layout}}" activecolor="{{activecolor}}" inactivecolor="{{inactivecolor}}"]{{child_shortcode}}[/zozo_tabs]',
	'popup_title' 	=> __('Tab Shortcode', 'zozoshortcodes'),
);

/* =============================================================
 *	Accordion Config
 * ============================================================= */

$zozo_shortcodes['accordion'] = array(
	'no_preview' => true,
	'params' 	 => array(
		'style'	=> array(
			'type' 		=> 'select',
			'label' 	=> __('Accordion Style', 'zozoshortcodes'),
			'desc' 		=> __('Select the accordion style', 'zozoshortcodes'),
			'options' 	=> array(
				'default'	=> 'Default',
				'classic' 	=> 'Classic',
			)
		),
		'id'   => array(
			'std' 	=> 'accordion-1',
			'type' 	=> 'text',
			'label' => __('Accordion ID', 'zozoshortcodes'),
			'desc' 	=> __('Insert accordion id', 'zozoshortcodes')
		),
	),
	'child_shortcode' => array(
		'params' 	  => array(
			'title'   => array(
				'std' 	=> 'Title',
				'type' 	=> 'text',
				'label' => __('Title', 'zozoshortcodes'),
				'desc' 	=> __('Insert the accordion title', 'zozoshortcodes')
			),
			'open' 	  => array(
				'type' 		=> 'select',
				'label' 	=> __('Open by Default', 'zozoshortcodes'),
				'desc' 		=> __('Choose to have the accordion open by default', 'zozoshortcodes'),
				'options' 	=> array(
					'no' 	=> 'No',
					'yes'	=> 'Yes'					
				)
			),
			'parent_id'   => array(
				'std' 	=> 'accordion-1',
				'type' 	=> 'text',
				'label' => __('Parent Accordion ID', 'zozoshortcodes'),
				'desc' 	=> __('Insert parent accordion id', 'zozoshortcodes')
			),
			'content' => array(
				'std' 	=> 'Your Content !',
				'type' 	=> 'textarea',
				'label' => __('Accordion Content', 'zozoshortcodes'),
				'desc' 	=> __('Insert the accordion content', 'zozoshortcodes')
			)
		),
		'shortcode' 	=> '[zozo_accordion title="{{title}}" open="{{open}}" parent_id="{{parent_id}}"]{{content}}[/zozo_accordion]',
		'clone_button'  => __('Add New Accordion Item', 'zozoshortcodes')
	),
	'shortcode' 	=> '[zozo_accordions style="{{style}}" id="{{id}}"]{{child_shortcode}}[/zozo_accordions]',
	'popup_title' 	=> __('Accordion Shortcode', 'zozoshortcodes'),
);

/* =============================================================
 *	Tooltip Config
 * ============================================================= */

$zozo_shortcodes['tooltip'] = array(
	'no_preview' => true,
	'params' 	 => array(
		'title'  => array(
			'std' 	=> '',
			'type' 	=> 'text',
			'label' => __('Tooltip Text', 'zozoshortcodes'),
			'desc' 	=> __('Insert the text that displays in the tooltip', 'zozoshortcodes')
		),
		'link_type'	=> array(
			'type' 		=> 'select',
			'label' 	=> __('Tooltip Type', 'zozoshortcodes'),
			'desc' 		=> __('Select tooltip type', 'zozoshortcodes'),
			'options' 	=> array(
				'text'		=> 'Text',
				'button' 	=> 'Button'
			)
		),
		'style'	=> array(
			'type' 		=> 'select',
			'label' 	=> __('Button Style', 'zozoshortcodes'),
			'desc' 		=> __('Select the button\'s color', 'zozoshortcodes'),
			'options' 	=> array(
				'default'	=> 'Default',
				'primary' 	=> 'Blue',
				'custom' 	=> 'Custom',
				'info' 		=> 'Light Blue',
				'success' 	=> 'Green',
				'warning' 	=> 'Orange',
				'danger' 	=> 'Red'
			)
		),
		'position' 	 => array(
			'type' 		=> 'select',
			'label' 	=> __('Tooltip Position', 'zozoshortcodes'),
			'desc' 		=> __('Choose the position to tooltip appear', 'zozoshortcodes'),
			'options' 	=> array(
				'left' 		=> 'Left',
				'top'		=> 'Top',
				'bottom'	=> 'Bottom',
				'right'		=> 'Right'
			)
		),
		'content' => array(
			'std' 	=> '',
			'type' 	=> 'textarea',
			'label' => __('Content', 'zozoshortcodes'),
			'desc' 	=> __('Insert the text that will activate the tooltip hover', 'zozoshortcodes')
		),
	),
	'shortcode' 	=> '[zozo_tooltip title="{{title}}" link_type="{{link_type}}" style="{{style}}" position="{{position}}"]{{content}}[/zozo_tooltip]',
	'popup_title' 	=> __( 'Tooltip Shortcode', 'zozoshortcodes' )
);

/* =============================================================
 *	Page Header Config
 * ============================================================= */

$zozo_shortcodes['pageheader'] = array(
	'no_preview' => true,
	'params' 	 => array(
		'title'  => array(
			'std' 	=> '',
			'type' 	=> 'text',
			'label' => __('Title', 'zozoshortcodes'),
			'desc' 	=> __('Enter the Title.', 'zozoshortcodes')
		),
		'slogan' => array(
			'std' 	=> '',
			'type' 	=> 'textarea',
			'label' => __('Section Slogan', 'zozoshortcodes'),
			'desc' 	=> __('Enter the Section Slogan.', 'zozoshortcodes')
		),
		'textalign' => array(						    
			'type' 		=> 'select',
			'label' 	=> __('Text Alignment', 'zozoshortcodes'),
			'desc' 		=> __('Choose Text Alignment.', 'zozoshortcodes'),
			'options' 	=> array(
					''	 	 => 'Select Alignment',
					'left'	 => 'Left',
					'right'	 => 'Right',
					'center' => 'Center'
			)
		),
		'titlecolor' => array(
			'type' 	=> 'colorpicker',
			'std' 	=> '',
			'label' => __('Title Color', 'zozoshortcodes'),
			'desc' 	=> __('Choose title color. Leave blank for default', 'zozoshortcodes'),
		),		
		'slogancolor' => array(
			'type' 	=> 'colorpicker',
			'std' 	=> '',
			'label' => __('Slogan Color', 'zozoshortcodes'),
			'desc' 	=> __('Choose page slogan color. Leave blank for default', 'zozoshortcodes'),
		),
		'animation_type' => array(			
			'type' 		=> 'select',
			'label' 	=> __('Animation Type', 'zozoshortcodes'),
			'desc'		=> __('Select the animation type for arrows', 'zozoshortcodes'),
			'options'	=> $animations
		),
		'animation_delay' => array(
			'std' 		=> '500',
			'type' 		=> 'text',
			'label' 	=> __('Animation Delay', 'zozoshortcodes'),
			'desc' 		=> __('Enter animation delay in milliseconds. Ex: 500', 'zozoshortcodes'),
		),
	),
	'shortcode' 	=> '[zozo_page_header title="{{title}}" slogan="{{slogan}}" textalign="{{textalign}}" titlecolor="{{titlecolor}}" slogancolor="{{slogancolor}}" animation_type="{{animation_type}}" animation_delay="{{animation_delay}}"]',
	'popup_title' 	=> __( 'Page Header Shortcode', 'zozoshortcodes' )
);

/* =============================================================
 *	Blockquotes Config
 * ============================================================= */

$zozo_shortcodes['blockquotes'] = array(
	'no_preview' => true,
	'params' 	 => array(
		'footer_text' => array(
			'std' 	=> '',
			'type' 	=> 'text',
			'label' => __('Blockquote Cite Text', 'zozoshortcodes'),
			'desc' 	=> __('Insert the footer text. Author or source name', 'zozoshortcodes')
		),
		'position' 	 => array(
			'type' 		=> 'select',
			'label' 	=> __('Blockquote Align', 'zozoshortcodes'),
			'desc' 		=> __('Choose blockquote alignment', 'zozoshortcodes'),
			'options' 	=> array(
				'left' 		=> 'Left',
				'right'		=> 'Right'
			)
		),
		'content'	=> array(
			'std' 	=> 'Your Blockquote content !',
			'type' 	=> 'textarea',
			'label' => __('Content', 'zozoshortcodes'),
			'desc' 	=> __('Insert the blockquote content', 'zozoshortcodes')
		),
		'animation_type' => array(			
			'type' 		=> 'select',
			'label' 	=> __('Animation Type', 'zozoshortcodes'),
			'desc'		=> __('Select the animation type for shortcode', 'zozoshortcodes'),
			'options'	=> $animations
		),
		'animation_delay' => array(
			'std' 		=> '500',
			'type' 		=> 'text',
			'label' 	=> __('Animation Delay', 'zozoshortcodes'),
			'desc' 		=> __('Enter animation delay in milliseconds. Ex: 500', 'zozoshortcodes'),
		),
	),
	'shortcode' 	=> '[zozo_blockquote footer_text="{{footer_text}}" position="{{position}}" animation_type="{{animation_type}}" animation_delay="{{animation_delay}}"]{{content}}[/zozo_blockquote]',
	'popup_title' 	=> __( 'Blockquotes Shortcode', 'zozoshortcodes' )
);

/* =============================================================
 *	Lead Paragraph Config
 * ============================================================= */

$zozo_shortcodes['leadpara'] = array(
	'no_preview' => true,
	'params' 	 => array(		
		'align' 	 => array(
			'type' 		=> 'select',
			'label' 	=> __('Paragraph Alignment', 'zozoshortcodes'),
			'desc' 		=> __('Choose paragraph alignment', 'zozoshortcodes'),
			'options' 	=> array(
				'left' 		=> 'Left',
				'right'		=> 'Right',
				'center'	=> 'Center',
				'justify'	=> 'Justify'
			)
		),
		'content'	=> array(
			'std' 	=> 'Your content !',
			'type' 	=> 'textarea',
			'label' => __('Content', 'zozoshortcodes'),
			'desc' 	=> __('Insert the paragraph content', 'zozoshortcodes')
		),
	),
	'shortcode' 	=> '[zozo_leadpara align="{{align}}"]{{content}}[/zozo_leadpara]',
	'popup_title' 	=> __( 'Lead Paragraph Shortcode', 'zozoshortcodes' )
);

/* =============================================================
 *	Popover Config
 * ============================================================= */

$zozo_shortcodes['popover'] = array(
	'no_preview' => true,
	'params' 	 => array(
		'title' => array(
			'std' 	=> '',
			'type' 	=> 'text',
			'label' => __('Popover Title', 'zozoshortcodes'),
			'desc' 	=> __('Insert the title.', 'zozoshortcodes')
		),
		'content'	=> array(
			'std' 	=> 'Your content !',
			'type' 	=> 'textarea',
			'label' => __('Popover Content', 'zozoshortcodes'),
			'desc' 	=> __('Insert the popover content', 'zozoshortcodes')
		),		
		'position' 	 => array(
			'type' 		=> 'select',
			'label' 	=> __('Popover Position', 'zozoshortcodes'),
			'desc' 		=> __('Choose the position to popover appear', 'zozoshortcodes'),
			'options' 	=> array(
				'left' 		=> 'Left',
				'top'		=> 'Top',
				'bottom'	=> 'Bottom',
				'right'		=> 'Right'
			)
		),
		'link_type' 	 => array(
			'type' 		=> 'select',
			'label' 	=> __('Popover Link Type', 'zozoshortcodes'),
			'desc' 		=> __('Choose type of text to active popover.', 'zozoshortcodes'),
			'options' 	=> array(
				'button' 	=> 'Button',
				'link'		=> 'Link'
			)
		),
		'popover_show' 	 => array(
			'type' 		=> 'select',
			'label' 	=> __('Popover Show', 'zozoshortcodes'),
			'desc' 		=> __('Choose when popover needs to activate. By "Click" on popover show wont work with Link type.', 'zozoshortcodes'),
			'options' 	=> array(
				'hover' 	=> 'Hover',
				'click'		=> 'Click'				
			)
		),
		'link_text' => array(
			'std' 	=> '',
			'type' 	=> 'text',
			'label' => __('Link or Button Text', 'zozoshortcodes'),
			'desc' 	=> __('Insert the link or button text.', 'zozoshortcodes')
		),
		'link_url' => array(
			'std' 	=> '',
			'type' 	=> 'text',
			'label' => __('Link or Button URL', 'zozoshortcodes'),
			'desc' 	=> __('Insert the link for text.', 'zozoshortcodes')
		),
		'target' => array(
			'type' 		=> 'select',
			'label' 	=> __('Link or Button Target', 'zozoshortcodes'),
			'desc' 		=> __('_self = Open in same window <br />_blank = Open in new window', 'zozoshortcodes'),
			'options' 	=> array(
				'_self' 	=> '_self',
				'_blank' 	=> '_blank'
			)
		),		
		'button_size' => array(
			'type' 		=> 'select',
			'label' 	=> __('Button Size', 'zozoshortcodes'),
			'desc' 		=> __('Select the button\'s size', 'zozoshortcodes'),
			'options' 	=> array(
				'default' 	=> 'Default',
				'mini'		=> 'Extra Small',
				'small'		=> 'Small',
				'large' 	=> 'Large'
			)
		),
		'button_bg_color' => array(
			'std' 	=> '',
			'type' 	=> 'colorpicker',			
			'label' => __('Button Background Color', 'zozoshortcodes'),
			'desc' 	=> __('Button Background Color.', 'zozoshortcodes'),
		),
		'button_bg_hover_color' => array(
			'std' 	=> '',
			'type' 	=> 'colorpicker',			
			'label' => __('Button Background Hover Color', 'zozoshortcodes'),
			'desc' 	=> __('Button Background Hover Color.', 'zozoshortcodes'),
		),
		'textcolor' => array(
			'std' 	=> '',
			'type' 	=> 'colorpicker',			
			'label' => __('Button Text Color', 'zozoshortcodes'),
			'desc' 	=> __('Button Text Color. Leave blank for default.', 'zozoshortcodes'),
		),
		'texthovercolor' => array(
			'std' 	=> '',
			'type' 	=> 'colorpicker',			
			'label' => __('Button Text Hover Color', 'zozoshortcodes'),
			'desc' 	=> __('Button Text Hover Color. Leave blank for default.', 'zozoshortcodes'),
		),
		'icon' => array(
			'type' 		=> 'iconpicker',
			'label' 	=> __('Select Icon', 'zozoshortcodes'),
			'desc' 		=> __('Click an icon to select, click again to deselect', 'zozoshortcodes'),
			'options' 	=> $icons			
		),
		'icon_position' => array(
			'type' 		=> 'select',
			'label' 	=> __('Icon Position', 'zozoshortcodes'),
			'desc' 		=> 'Select the position of the icon',
			'options' 	=> array(
				'left' 		=> 'Left',
				'right' 	=> 'Right',				
			)
		),		
	),
	'shortcode' 	=> '[zozo_popover title="{{title}}" popover_pos="{{position}}" link_type="{{link_type}}" show_on="{{popover_show}}" link_text="{{link_text}}" link_url="{{link_url}}" target="{{target}}" size="{{button_size}}" button_bg_color="{{button_bg_color}}" button_bg_hover_color="{{button_bg_hover_color}}" color="{{textcolor}}" hovercolor="{{texthovercolor}}" icon="{{icon}}" icon_pos="{{icon_position}}"]{{content}}[/zozo_popover]',
	'popup_title' 	=> __( 'Popover Shortcode', 'zozoshortcodes' )
);

/* =============================================================
 *	Table Config
 * ============================================================= */

$zozo_shortcodes['table'] = array(
	'no_preview' => true,
	'params' 	 => array(
		'type' 	 => array(
			'type' 		=> 'select',
			'label' 	=> __('Style Type', 'zozoshortcodes'),
			'desc' 		=> __('Choose the table style', 'zozoshortcodes'),
			'options' 	=> array(
				'striped' 		=> 'Striped',
				'bordered'		=> 'Bordered',
				'condensed' 	=> 'Condensed'
			)
		),
		'rows' => array(
			'type' 		=> 'select',
			'label' 	=> __('Number of Rows', 'zozoshortcodes'),
			'desc' 		=> __('Select number of rows for table', 'zozoshortcodes'),
			'options' 	=> array(
				'1' 	=> '1 Row',
				'2'		=> '2 Rows',
				'3'		=> '3 Rows',
				'4'		=> '4 Rows',
				'5'		=> '5 Rows'
			)
		),
		'columns' => array(
			'type' 		=> 'select',
			'label' 	=> __('Number of Columns', 'zozoshortcodes'),
			'desc' 		=> __('Select number of columns for table', 'zozoshortcodes'),
			'options' 	=> array(
				'1' 	=> '1 Column',
				'2'		=> '2 Columns',
				'3'		=> '3 Columns',
				'4'		=> '4 Columns',
				'5'		=> '5 Columns'
			)
		),
	),
	'shortcode' 	=> '',
	'popup_title' 	=> __( 'Table Shortcode', 'zozoshortcodes' )
);

/* =============================================================
 *	SoundCloud Config
 * ============================================================= */

$zozo_shortcodes['soundcloud'] = array(
	'no_preview' => true,
	'params' 	 => array(
		'url' 	 => array(
			'std' 	=> '',
			'type' 	=> 'text',
			'label' => __('SoundCloud Url', 'zozoshortcodes'),
			'desc' 	=> __('Enter SoundCloud url, Ex: http://api.soundcloud.com/tracks/59051244', 'zozoshortcodes')
		),
		'comments' => array(
			'type' 		=> 'select',
			'label' 	=> __('Show Comments', 'zozoshortcodes'),
			'desc' 		=> __('Choose to display comments', 'zozoshortcodes'),
			'options' 	=> array(
				'yes' 	=> 'Yes',
				'no'	=> 'No'				
			)
		),
		'auto_play' => array(
			'type' 		=> 'select',
			'label' 	=> __('Autoplay', 'zozoshortcodes'),
			'desc' 		=> __('Select to autoplay the track', 'zozoshortcodes'),
			'options' 	=> array(
				'no' 	=> 'No',
				'yes'	=> 'Yes'				
			)
		),
		'buy_like_buttons' => array(
			'type' 		=> 'select',
			'label' 	=> __('Show Buy & Like Buttons', 'zozoshortcodes'),
			'desc' 		=> __('Select to show/hide buy & like buttons', 'zozoshortcodes'),
			'options' 	=> array(
				'yes'	=> 'Yes',
				'no' 	=> 'No'
			)
		),
		'show_artwork' => array(
			'type' 		=> 'select',
			'label' 	=> __('Show Artwork', 'zozoshortcodes'),
			'desc' 		=> __('Select to show/hide artwork', 'zozoshortcodes'),
			'options' 	=> array(
				'yes'	=> 'Yes',
				'no' 	=> 'No'
			)
		),
		'color' 	=> array(
			'type' 	=> 'colorpicker',
			'std' 	=> '#FF5500',
			'label' => __('Color', 'zozoshortcodes'),
			'desc' 	=> __('Select the color for play button and other controls', 'zozoshortcodes')
		),		
		'width' 	=> array(
			'std' 	=> '100%',
			'type' 	=> 'text',
			'label' => __('Width', 'zozoshortcodes'),
			'desc' 	=> __('Enter player width in pixels or percentage. Ex: 100% or 500px',  'zozoshortcodes')
		),
		'height' 	=> array(
			'std' 	=> '110',
			'type' 	=> 'text',
			'label' => __('Height', 'zozoshortcodes'),
			'desc' 	=> __('Enter player height in pixels. Ex: 110', 'zozoshortcodes')
		),
	),
	'shortcode' 	=> '[zozo_soundcloud url="{{url}}" comments="{{comments}}" autoplay="{{auto_play}}" buy_like="{{buy_like_buttons}}" show_artwork="{{show_artwork}}" color="{{color}}" width="{{width}}" height="{{height}}"]',
	'popup_title' 	=> __( 'SoundCloud Shortcode', 'zozoshortcodes' )
);

/* =============================================================
 *	Vimeo Config
 * ============================================================= */

$zozo_shortcodes['vimeo'] = array(
	'no_preview' => true,
	'params' 	 => array(
		'player_id' => array(
			'std' 	=> '',
			'type' 	=> 'text',
			'label' => __('Video ID', 'zozoshortcodes'),
			'desc' 	=> __('For example the Video ID for https://vimeo.com/19940853 is 19940853', 'zozoshortcodes')
		),
		'width' 	=> array(
			'std' 	=> '',
			'type' 	=> 'text',
			'label' => __('Player Width', 'zozoshortcodes'),
			'desc' 	=> __('Enter only number in pixels. Ex: 700', 'zozoshortcodes')
		),
		'height' 	=> array(
			'std' 	=> '',
			'type' 	=> 'text',
			'label' => __('Player Height', 'zozoshortcodes'),
			'desc' 	=> __('Enter only number in pixels. Ex: 350', 'zozoshortcodes'),
		),
		'auto_play' 	=> array(
			'type' 		=> 'select',
			'label' 	=> __('Autoplay', 'zozoshortcodes'),
			'desc' 		=> __('Select to autoplay the video', 'zozoshortcodes'),
			'options' 	=> array(
				'no' 	=> 'No',
				'yes'	=> 'Yes'				
			)
		),
		'color' 	=> array(
			'type' 	=> 'colorpicker',
			'std' 	=> '#00adef',
			'label' => __('Color', 'zozoshortcodes'),
			'desc' 	=> __('Select the color for video controls', 'zozoshortcodes')
		),
		'fit_video' 	=> array(
			'type' 		=> 'select',
			'label' 	=> __('Fit Video', 'zozoshortcodes'),
			'desc' 		=> __('Select to show your video fluid.', 'zozoshortcodes'),
			'options' 	=> array(
				'no' 	=> 'No',
				'yes'	=> 'Yes',
			)
		),
		'show_title' 	=> array(
			'type' 		=> 'select',
			'label' 	=> __('Show Title', 'zozoshortcodes'),
			'desc' 		=> __('Select to show title in video', 'zozoshortcodes'),
			'options' 	=> array(				
				'yes'	=> 'Yes',
				'no' 	=> 'No'				
			)
		),
		'show_byline' 	=> array(
			'type' 		=> 'select',
			'label' 	=> __('Show Byline', 'zozoshortcodes'),
			'desc' 		=> __('Select to show user byline in video', 'zozoshortcodes'),
			'options' 	=> array(				
				'yes'	=> 'Yes',
				'no' 	=> 'No'				
			)
		),
	),
	'shortcode' 	=> '[zozo_vimeo id="{{player_id}}" width="{{width}}" height="{{height}}" autoplay="{{auto_play}}" color="{{color}}" fit_video="{{fit_video}}" show_title="{{show_title}}" show_byline="{{show_byline}}"]',
	'popup_title' 	=> __( 'Vimeo Shortcode', 'zozoshortcodes' )
);

/* =============================================================
 *	Youtube Config
 * ============================================================= */

$zozo_shortcodes['youtube'] = array(
	'no_preview' => true,
	'params' 	 => array(
		'player_id' => array(
			'std' 	=> '',
			'type' 	=> 'text',
			'label' => __('Video ID', 'zozoshortcodes'),
			'desc' 	=> __('For example the Video ID for <br />http://www.youtube.com/R4-YdC5N6Lo is R4-YdC5N6Lo', 'zozoshortcodes')
		),
		'width' 	=> array(
			'std' 	=> '',
			'type' 	=> 'text',
			'label' => __('Player Width', 'zozoshortcodes'),
			'desc' 	=> __('Enter only number in pixels. Ex: 700', 'zozoshortcodes')
		),
		'height' 	=> array(
			'std' 	=> '',
			'type' 	=> 'text',
			'label' => __('Player Height', 'zozoshortcodes'),
			'desc' 	=> __('Enter only number in pixels. Ex: 350', 'zozoshortcodes'),
		),
		'auto_play' 	=> array(
			'type' 		=> 'select',
			'label' 	=> __('Autoplay', 'zozoshortcodes'),
			'desc' 		=> __('Select to autoplay the video', 'zozoshortcodes'),
			'options' 	=> array(
				'no' 	=> 'No',
				'yes'	=> 'Yes'				
			)
		),
		'fit_video' 	=> array(
			'type' 		=> 'select',
			'label' 	=> __('Fit Video', 'zozoshortcodes'),
			'desc' 		=> __('Select to show your video fluid.', 'zozoshortcodes'),
			'options' 	=> array(
				'no' 	=> 'No',
				'yes'	=> 'Yes',
			)
		),
		'related' 		=> array(
			'type' 		=> 'select',
			'label' 	=> __('Related Videos', 'zozoshortcodes'),
			'desc' 		=> __('Select to show related videos', 'zozoshortcodes'),
			'options' 	=> array(
				'no' 	=> 'No',
				'yes'	=> 'Yes'				
			)
		),
	),
	'shortcode' 	=> '[zozo_youtube id="{{player_id}}" width="{{width}}" height="{{height}}" autoplay="{{auto_play}}" fit_video="{{fit_video}}" rel_video="{{related}}"]',
	'popup_title' 	=> __( 'Youtube Shortcode', 'zozoshortcodes' )
);

/* =============================================================
 *	Circle Counters Config
 * ============================================================= */
 
$zozo_shortcodes['circle_counters'] = array(
	'no_preview' => true,
	'params' 	 => array(
		'show_in_slider' => array(
			'type' 	=> 'select',
			'std' 	=> '',
			'label' => __('Show as Slider', 'zozoshortcodes'),
			'desc' 	=> __('Choose to show counters in carousel slider.', 'zozoshortcodes'),
			'options'	=> array(
				'no'	=> 'No',
				'yes'	=> 'Yes'
			)
		),		
		'number_of_items' 	=> array(
			'std' 		=> '3',
			'type' 		=> 'text',
			'label' 	=> __('Items to Display', 'zozoshortcodes'),
			'desc' 		=> __('Enter Number of items to Display', 'zozoshortcodes')
		),
		'items_scroll' 	=> array(
			'std' 		=> '1',
			'type' 		=> 'text',
			'label' 	=> __('Items to Scrollby', 'zozoshortcodes'),
			'desc' 		=> __('Enter Number of items to Scrollby', 'zozoshortcodes')
		),
		'number_of_items_dksmall' => array(
			'std' 		=> '2',
			'type' 		=> 'text',
			'label' 	=> __('Items To Display in Tablet', 'zozoshortcodes'),
			'desc' 		=> __('Enter Number of items to Display in Tablet', 'zozoshortcodes')
		),
		'number_of_items_tablet' => array(
			'std' 		=> '1',
			'type' 		=> 'text',
			'label' 	=> __('Items To Display In Mobile Landscape', 'zozoshortcodes'),
			'desc' 		=> __('Enter Number of items to Display in Mobile Landscape', 'zozoshortcodes')
		),
		'number_of_items_mobile' => array(
			'std' 		=> '1',
			'type' 		=> 'text',
			'label' 	=> __('Items To Display In Mobile Portrait', 'zozoshortcodes'),
			'desc' 		=> __('Enter Number of items to Display in Mobile Portrait', 'zozoshortcodes')
		),
		'navigation' 	=> array(
			'type' 		=> 'select',
			'label' 	=> __('Enable Navigation', 'zozoshortcodes'),
			'desc' 		=> __('Select to enable navigation for slider', 'zozoshortcodes'),
			'options' 	=> array(
				'true'	=> 'Yes',
				'false' => 'No',
			)
		),
		'pagination' 	=> array(
			'type' 		=> 'select',
			'label' 	=> __('Enable Pagination', 'zozoshortcodes'),
			'desc' 		=> __('Select to enable pagination for slider', 'zozoshortcodes'),
			'options' 	=> array(
				'true'	=> 'Yes',
				'false' => 'No',
			)
		),
		'autoplay' 	=> array(
			'type' 		=> 'select',
			'label' 	=> __('Auto Play', 'zozoshortcodes'),
			'desc' 		=> __('Select to enable autoplay for slider', 'zozoshortcodes'),
			'options' 	=> array(
				'true'	=> 'Yes',
				'false' => 'No',
			)
		),
		'duration' => array(
			'std' 		=> '5000',
			'type' 		=> 'text',
			'label' 	=> __('Timeout Duration (in milliseconds)', 'zozoshortcodes'),
			'desc' 		=> __('Select Timeout Duration for slider.', 'zozoshortcodes')			
		),
		'margin' 		=> array(
			'std' 		=> '0',
			'type' 		=> 'text',
			'label' 	=> __('Margin ( Items Spacing )', 'zozoshortcodes'),
			'desc' 		=> __('Enter Spacing between items', 'zozoshortcodes')
		),
		'column' => array(
			'type' 		=> 'select',
			'label' 	=> __('Column Size', 'zozoshortcodes'),
			'desc' 		=> __('Select the width of the counter.', 'zozoshortcodes'),
			'options' 	=> array(
				'3' 	=> '3 Columns',
				'4' 	=> '4 Columns',
				'5' 	=> '5 Columns'
			)
		),		
		'circle_size' => array(
			'std' 		=> '',
			'type' 		=> 'text',
			'label' 	=> __('Circle Size', 'zozoshortcodes'),
			'desc' 		=> __('Enter Circle Size. Ex: 220 or 150 ( Only Numbers ).', 'zozoshortcodes')
		),
		'circle_line_size' => array(
			'std' 		=> '',
			'type' 		=> 'text',
			'label' 	=> __('Circle Line Width', 'zozoshortcodes'),
			'desc' 		=> __('Enter Circle Line Width. Ex: 15 ( Only Numbers ).', 'zozoshortcodes')
		),		
		'text_color' => array(
			'std' 	=> '',
			'type'  => 'colorpicker',
			'label' => __('Counter Text Color', 'zozoshortcodes'),
			'desc' 	=> __('Choose Counter Text Color.', 'zozoshortcodes'),
		),
		'desc_color' => array(
			'std' 	=> '',
			'type'  => 'colorpicker',
			'label' => __('Counter Description Color', 'zozoshortcodes'),
			'desc' 	=> __('Choose Counter Description Color.', 'zozoshortcodes'),
		),
	),
	'child_shortcode' => array(
		'params' 	  => array(			
			'value' => array(
				'std' 	=> '65',
				'type' 	=> 'text',
				'label' => __('Counter Value', 'zozoshortcodes'),
				'desc' 	=> __('Enter counter value. Only from 1 to 100.', 'zozoshortcodes')
			),
			'bar_color' => array(
				'std' 	=> '',
				'type'  => 'colorpicker',
				'label' => __('Counter Bar Color', 'zozoshortcodes'),
				'desc' 	=> __('Choose Counter Bar Color.', 'zozoshortcodes'),
			),
			'title' => array(
				'std' 	=> '',
				'type' 	=> 'text',
				'label' => __('Enter Title', 'zozoshortcodes'),
				'desc' 	=> __('Enter counter title.', 'zozoshortcodes')
			),
			'description' => array(
				'std' 	=> '',
				'type' 	=> 'textarea',
				'label' => __('Description', 'zozoshortcodes'),
				'desc' 	=> __('Enter the description for counter.', 'zozoshortcodes')
			),
			'extra_class'  => array(
				'std' 	=> '',
				'type' 	=> 'text',
				'label' => __('Extra Class', 'zozoshortcodes'),
				'desc' 	=> __('Enter extra class for counter item.', 'zozoshortcodes')
			),
			'animation_type' => array(			
				'type' 		=> 'select',
				'label' 	=> __('Animation Type', 'zozoshortcodes'),
				'desc'		=> __('Select the animation type for shortcode', 'zozoshortcodes'),
				'options'	=> $animations
			),
			'animation_delay' => array(
				'std' 		=> '500',
				'type' 		=> 'text',
				'label' 	=> __('Animation Delay', 'zozoshortcodes'),
				'desc' 		=> __('Enter animation delay in milliseconds. Ex: 500', 'zozoshortcodes'),
			),
		),
		'shortcode' 	=> '[zozo_circle_counter_item value="{{value}}" bar_color="{{bar_color}}" title="{{title}}" description="{{description}}" extra_class="{{extra_class}}" animation_type="{{animation_type}}" animation_delay="{{animation_delay}}"]',
		'clone_button'  => __('Add New Counter', 'zozoshortcodes')				
	),
	'shortcode' 	=> '[zozo_circle_counter show_in_slider="{{show_in_slider}}" items="{{number_of_items}}" itemsscroll="{{items_scroll}}" itemsdesktopsmall="{{number_of_items_dksmall}}" itemstablet="{{number_of_items_tablet}}" itemsmobile="{{number_of_items_mobile}}" navigation="{{navigation}}" pagination="{{pagination}}" autoplay="{{autoplay}}" duration="{{duration}}" margin="{{margin}}" column="{{column}}" circle_size="{{circle_size}}" circle_line_size="{{circle_line_size}}" text_color="{{text_color}}" desc_color="{{desc_color}}"]{{child_shortcode}}[/zozo_circle_counter]',
	'popup_title' 	=> __( 'Insert Circle Counters Shortcode', 'zozoshortcodes' )
);

/* =============================================================
 *	Day Counters Config
 * ============================================================= */
 
$zozo_shortcodes['day_counter'] = array(
	'no_preview' => true,
	'params' 	 => array(
		'counter' => array(
			'type' 	=> 'select',
			'std' 	=> '',
			'label' => __('Counter Type', 'zozoshortcodes'),
			'desc' 	=> __('Choose how to display the counter.', 'zozoshortcodes'),
			'options'	=> array(
				'down'	=> 'Counter Down',
				'up'	=> 'Counter Up'
			)
		),		
		'year' 	=> array(
			'std' 		=> '',
			'type' 		=> 'text',
			'label' 	=> __('Year', 'zozoshortcodes'),
			'desc' 		=> __('Enter Counter Year. Ex: 2015', 'zozoshortcodes')
		),
		'month' => array(
			'std' 		=> '',
			'type' 		=> 'text',
			'label' 	=> __('Month', 'zozoshortcodes'),
			'desc' 		=> __('Enter Counter Month. Ex: 6', 'zozoshortcodes')
		),
		'date' => array(
			'std' 		=> '',
			'type' 		=> 'text',
			'label' 	=> __('Date', 'zozoshortcodes'),
			'desc' 		=> __('Enter Counter Date. Ex: 20', 'zozoshortcodes')
		),
		'button' => array(
			'type' 	=> 'select',
			'label' => __('Show Button', 'zozoshortcodes'),
			'desc' 	=> __('Choose to show button for Counter.', 'zozoshortcodes'),
			'options'	=> array(
				'no'	=> 'No',
				'yes'	=> 'Yes'						
			)
		),
		'button_text'  => array(
			'std' 	=> '',
			'type' 	=> 'text',
			'label' => __('Button Text', 'zozoshortcodes'),
			'desc' 	=> __('Enter button text.', 'zozoshortcodes')
		),
		'button_link'  => array(
			'std' 	=> '',
			'type' 	=> 'text',
			'label' => __('Button Link', 'zozoshortcodes'),
			'desc' 	=> __('Enter button link.', 'zozoshortcodes')
		),
		'extra_class' => array(
			'std' 		=> '',
			'type' 		=> 'text',
			'label' 	=> __('Extra Class', 'zozoshortcodes'),
			'desc' 		=> __('Enter extra class for counter.', 'zozoshortcodes')
		),	
		'animation_type' => array(			
			'type' 		=> 'select',
			'label' 	=> __('Animation Type', 'zozoshortcodes'),
			'desc'		=> __('Select the animation type for shortcode', 'zozoshortcodes'),
			'options'	=> $animations
		),
		'animation_delay' => array(
			'std' 		=> '500',
			'type' 		=> 'text',
			'label' 	=> __('Animation Delay', 'zozoshortcodes'),
			'desc' 		=> __('Enter animation delay in milliseconds. Ex: 500', 'zozoshortcodes'),
		),	
	),	
	'shortcode' 	=> '[zozo_day_counter counter="{{counter}}" year="{{year}}" month="{{month}}" date="{{date}}" button="{{button}}" button_text="{{button_text}}" button_link="{{button_link}}" extra_class="{{extra_class}}" animation_type="{{animation_type}}" animation_delay="{{animation_delay}}"]',
	'popup_title' 	=> __( 'Insert Day Counter Shortcode', 'zozoshortcodes' )
);

/* =============================================================
 *	HTML Block Config
 * ============================================================= */
 
$zozo_shortcodes['html_block'] = array(
	'no_preview' => true,
	'params' 	 => array(		
		'tag' 	=> array(
			'type' 		=> 'select',
			'label' 	=> __('HTML Tag', 'zozoshortcodes'),
			'desc' 		=> __('Choose HTML tag to insert.', 'zozoshortcodes'),
			'options' 	=> array(
				'div'    	=> 'div',
				'section'   => 'section',
				'p'   		=> 'p',
				'span'   	=> 'span',
			)
		),
		'class' => array(
			'std'		=> '',
			'type'		=> 'text',
			'label'  	=> __('Class', 'zozoshortcodes'),
			'desc'   	=> __('Enter class name for HTML tag.', 'zozoshortcodes')
		),
		'content' => array(
			'std' 	=> 'Your Content!',
			'label' => __('Content', 'zozoshortcodes'),
			'desc' 	=> __('Enter Content', 'zozoshortcodes'),
			'type' 	=> 'textarea'			
		),
	),
	'shortcode' 	=> '[zozo_html_block tag="{{tag}}" class="{{class}}"]{{content}}[/zozo_html_block]',
	'popup_title' 	=> __( 'HTML Block Shortcode', 'zozoshortcodes' )
);

/* =============================================================
 *	Contact Form Config
 * ============================================================= */

$zozo_shortcodes['contact_form'] = array(
	'no_preview' => true,
	'params' 	 => array(		
		'form' => array(
			'std' 			=> '',
			'type' 			=> 'checkbox',
			'checkbox_text' => '',
			'label' 		=> __('Show Contact Form', 'zozoshortcodes'),
			'desc' 			=> __('Check to Show Contact Form', 'zozoshortcodes'),
		),
	),
	'shortcode' 	=> '[zozo_contact_form form="{{form}}"]',
	'popup_title' 	=> __( 'Contact Form Shortcode', 'zozoshortcodes' )
);

/* =============================================================
 *	Fullwidth Config
 * ============================================================= */

$zozo_shortcodes['fullwidth'] = array(
	'no_preview' => true,
	'params' 	 => array(		
		'class' => array(
			'std' 	=> '',
			'label' => __('Class for Fullwidth Box', 'zozoshortcodes'),
			'desc' 	=> __('Enter class for Fullwidth Box', 'zozoshortcodes'),
			'type' 	=> 'text'			
		),
		'bg_image' => array(
			'std' 	=> '',
			'type' 	=> 'media',
			'label' => __('Fullwidth Box Background Image', 'zozoshortcodes'),
			'desc' 	=> __('Upload an image to use background for Fullwidth Box.', 'zozoshortcodes'),
		),
		'bg_repeat' => array(
			'std' 	=> '',
			'type' 		=> 'select',
			'label' 	=> __('Background Repeat', 'zozoshortcodes'),
			'desc' 		=> __('Choose background repeat for Fullwidth Box.', 'zozoshortcodes'),
			'options' 	=> array(
				'repeat'	=> 'Repeat', 
				'repeat-x'	=> 'Repeat-x', 
				'repeat-y'	=> 'Repeat-y', 
				'no-repeat' => 'No Repeat' 
			)
		),
		'bg_attachment' => array(
			'std' 	=> '',
			'type' 		=> 'select',
			'label' 	=> __('Background Attachment', 'zozoshortcodes'),
			'desc' 		=> __('Choose background attachment for Fullwidth Box.', 'zozoshortcodes'),
			'options' 	=> array(
				'fixed'		=> 'Fixed', 
				'scroll'	=> 'Scroll',
			)
		),
		'bg_color' => array(
			'std' 	=> '',
			'type' 	=> 'colorpicker',			
			'label' => __('Fullwidth Box Background Color', 'zozoshortcodes'),
			'desc' 	=> __('Choose Fullwidth Box Background Color.', 'zozoshortcodes'),
		),
		'overlay' => array(
			'std' 	=> '',
			'type' 		=> 'select',
			'label' 	=> __('Overlay', 'zozoshortcodes'),
			'desc' 		=> __('Choose background have Overlay color.', 'zozoshortcodes'),
			'options' 	=> array(
				'yes'	=> 'Yes', 
				'no'	=> 'No',
			)
		),
		'overlay_color' => array(
			'std' 	=> '',
			'type' 	=> 'colorpicker',			
			'label' => __('Background Overlay Color', 'zozoshortcodes'),
			'desc' 	=> __('Choose Fullwidth Background Overlay Color.', 'zozoshortcodes'),
		),
		'overlay_opacity' => array(
			'std' 	=> '',
			'label' => __('Overlay Opacity', 'zozoshortcodes'),
			'desc' 	=> __('Enter Overlay Opacity. Values from 0.1 to 1. Ex: 0.1 or 0.3 or 1.', 'zozoshortcodes'),
			'type' 	=> 'text'			
		),
		'padding_top' => array(
			'std' 	=> '',
			'label' => __('Padding Top', 'zozoshortcodes'),
			'desc' 	=> __('Enter Padding Top for Section. Ex: 20px', 'zozoshortcodes'),
			'type' 	=> 'text'			
		),
		'padding_bottom' => array(
			'std' 	=> '',
			'label' => __('Padding Bottom', 'zozoshortcodes'),
			'desc' 	=> __('Enter Padding Bottom for Section. Ex: 20px', 'zozoshortcodes'),
			'type' 	=> 'text'			
		),
		'content' => array(
			'std' 	=> '',
			'type' 	=> 'textarea',
			'label' => __('Content', 'zozoshortcodes'),
			'desc'	=> __('Enter content', 'zozoshortcodes')
		),
	),
	'shortcode' 	=> '[zozo_fullwidth_box class="{{class}}" bg_image="{{bg_image}}" bg_repeat="{{bg_repeat}}" bg_attachment="{{bg_attachment}}" bg_color="{{bg_color}}" overlay="{{overlay}}" overlay_color="{{overlay_color}}" overlay_opacity="{{overlay_opacity}}" padding_top="{{padding_top}}" padding_bottom="{{padding_bottom}}"]{{content}}[/zozo_fullwidth_box]',
	'popup_title' 	=> __( 'Fullwidth Box Shortcode', 'zozoshortcodes' )
);
?>