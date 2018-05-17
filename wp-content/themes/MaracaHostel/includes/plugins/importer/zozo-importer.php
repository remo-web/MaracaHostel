<?php
defined( 'ABSPATH' ) or die( 'You cannot access this script directly' );

/* ================================================
 * Importer
 * ================================================ */
 
class Zozo_Import {
	
	public $message = "";
	public function __construct(){

	}
	
	public function zozo_import_content( $file ) {
			
        if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);
		require_once ABSPATH . 'wp-admin/includes/import.php';
	
		$importer_error = false;
		if ( !class_exists( 'WP_Importer' ) ) {
			$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
			if ( file_exists( $class_wp_importer ) ){
				require_once($class_wp_importer);
			} else {
				$importer_error = true;
			}
		}
		
		if ( !class_exists( 'WP_Import' ) ) {
			$class_wp_import = dirname( __FILE__ ) .'/wordpress-importer.php';
			if ( file_exists( $class_wp_import ) ){
				require_once($class_wp_import);
			}else
				$importer_error = true;
		}
		
		if ( function_exists( 'ini_get' ) ) {
			if ( 3000 < ini_get( 'max_execution_time' ) ) {
				@ini_set( 'max_execution_time', 3000 );
			}
			if ( 512 < intval( ini_get( 'memory_limit' ) ) ) {
				@ini_set( 'memory_limit', '512M' );
			}
		}
		
		if($importer_error){
			echo "Error on import";
		} else {
			if ( !class_exists( 'WP_Import' ) ) {
				echo esc_html__("WP_Import Problem", "zozothemes");
			}else{				
				$wp_import = new WP_Import();
				set_time_limit(0);
				$wp_import->fetch_attachments = true;
				
				ob_start();
				$wp_import->import( $file );
				ob_end_clean();
			}
		}
		
    }
	
	public function zozo_import_widgets($widgets, $sidebars) {
		if( $sidebars ) {
        	$this->zozo_import_custom_sidebars($sidebars);
		}
		
        $this->zozo_import_sidebars_widgets( $widgets );
        $this->message = __("Widgets imported successfully", "zozothemes");
    }
	
	public function zozo_import_custom_sidebars( $file ){
        $sidebars = $this->zozo_import_get_file( $file );
		if( isset( $sidebars ) && $sidebars ) {
			update_option( 'sbg_sidebars', $sidebars );
	
			foreach( $sidebars as $sidebar ) {
				$sidebar_class = zozo_name_to_class( $sidebar );
				
				register_sidebar(array(
					'name'			=>	$sidebar,
					'id'			=> 'zozo-custom-'.strtolower($sidebar_class),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget' 	=> '</div>',
					'before_title' 	=> '<h3 class="widget-title">',
					'after_title'	=> '</h3>',
				));
			}
        	$this->message = __("Custom sidebars imported successfully", "zozothemes");
		}
    }
	
	public function zozo_import_sidebars_widgets( $file ){
		$widgets_file = $this->zozo_import_get_file( $file );
        // Add Widgets
		if( isset( $widgets_file ) && $widgets_file ) {
			zozo_import_widget_data( $widgets_file );
		}        
    }
	
	public function zozo_import_theme_options( $file ){
		$file_contents = $this->zozo_import_get_file( $file );
		$theme_options = json_decode($file_contents, true);
		$redux = ReduxFrameworkInstances::get_instance('zozo_options');
		$redux->set_options($theme_options);
		zozo_save_theme_options();
        $this->message = __("Options imported successfully", "zozothemes");
    }
	
	public function zozo_import_menus(){
		/* Set imported menus to Registered Menu locations in Theme */
				
		// Registered Menu Locations in Theme
		$locations = get_theme_mod( 'nav_menu_locations' );
		// Get Registered menus
		$menus = wp_get_nav_menus();
		
		// Assign menus to theme locations 
		if( is_array($menus) ) {
			foreach( $menus as $menu ) {
				if( $menu->name == 'Main Menu' ) {
					$locations['primary-menu'] = $menu->term_id;
				} else if( $menu->name == 'Main Menu Right' ) {
					$locations['primary-right'] = $menu->term_id;
				} else if( $menu->name == 'Top Menu' ) {
					$locations['top-menu'] = $menu->term_id;
				} else if( $menu->name == 'Footer Menu' ) {
					$locations['footer-menu'] = $menu->term_id;
				}
			}
		}

		set_theme_mod( 'nav_menu_locations', $locations );
    }
	
	public function zozo_import_settings_pages(){
		// Set Woocommerce Pages
		$woo_pages = array(
			'woocommerce_shop_page_id' => 'Shop',
			'woocommerce_cart_page_id' => 'Cart',
			'woocommerce_checkout_page_id' => 'Checkout',
			'woocommerce_myaccount_page_id' => 'My Account'
		);
			
		foreach( $woo_pages as $woo_page_name => $woo_page_title ) {
			$woo_page = get_page_by_title( $woo_page_title );
			if( isset( $woo_page ) && $woo_page->ID ) {
				update_option($woo_page_name, $woo_page->ID);
			}
		}
    }
	
	public function zozo_import_revslider( $demo_type, $file ){
		// Import Revolution Slider
		if( class_exists( 'RevSlider' ) && $file ) {
			
			require_once ABSPATH . 'wp-load.php';
			require_once ABSPATH . 'wp-includes/functions.php';
			
			$old_filepath = "http://zozothemes.com/wp/mist/extras/importer/" . $file;
			$filepath = ZOZOINCLUDES . 'plugins/importer/data/slider-'.$demo_type.'.zip';
			
			copy($old_filepath, $filepath);
			
			$slider = new RevSlider();			
			$slider->importSliderFromPost(true,true,$filepath); 
			
		}
    }

	public function zozo_import_get_file( $file ){
        $file_content = "";
        $file_for_import = ZOZOINCLUDES . 'plugins/importer/data/' . $file;
        $file_content = $this->zozo_get_file_contents( $file );
        if( $file_content ) {
            $unserialized_content = unserialize(base64_decode($file_content));
            if( $unserialized_content ) {
                return $unserialized_content;
            }
        }
        return false;
    }
	
	function zozo_get_file_contents( $path ) {
		$url      = "http://zozothemes.com/wp/mist/extras/importer/" . $path;
		$response = wp_remote_get($url);
		$body     = wp_remote_retrieve_body($response);
		return $body;
    }

}

global $zozo_import;
$zozo_import = new Zozo_Import();
 
/* ================================================
 * Ajax Hook for Importer
 * ================================================ */
 
if( ! function_exists('zozo_demo_content_importer') ) {
    function zozo_demo_content_importer() {
	
        global $zozo_import;
		
		if( ! isset( $_POST['demo_type'] ) || trim( $_POST['demo_type'] ) == '' ) {
			$demo_type = 'demo-multi-classic';
		} else {
			$demo_type = $_POST['demo_type'];
		}
		
		if( ! empty($_POST['demo_type'] )) {
			if( class_exists('Woocommerce') && $_POST['woo_demo'] == 'yes' ) {
				$folder = $_POST['demo_type'] . "/themewithwoo.xml";
			} else {
           		$folder = $_POST['demo_type'] . "/theme.xml";
			}
		}
		
        $zozo_import->zozo_import_content($folder);
		if( class_exists('Woocommerce') && $_POST['woo_demo'] == 'yes' ) {
			$zozo_import->zozo_import_settings_pages();
		}
		
		// Reading settings
		$home_page_title = 'Home';
		
		// Set reading options
		$home_page = get_page_by_title( $home_page_title );
		if( isset( $home_page ) && $home_page->ID ) {
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $home_page->ID ); // Front Page
		}

        echo "imported";
		die();
    }

    add_action('wp_ajax_zozo_import_demo_data', 'zozo_demo_content_importer');
}

if( ! function_exists('zozo_demo_import_other_data') ) {
    function zozo_demo_import_other_data() {
	
        global $zozo_import;
		
		if( ! isset( $_POST['demo_type'] ) || trim( $_POST['demo_type'] ) == '' ) {
			$demo_type = 'demo-multi-classic';
		} else {
			$demo_type = $_POST['demo_type'];
		}
        $folder = $demo_type . "/";
		
		$zozo_import->zozo_import_theme_options( $folder.'theme-options.txt' );
		$zozo_import->zozo_import_menus();
        $zozo_import->zozo_import_widgets( $folder.'widgets.txt', $folder.'custom_sidebars.txt' );
		if( isset( $_POST['rev_slider'] ) && $_POST['rev_slider'] == 'yes' ) {
			$zozo_import->zozo_import_revslider( $demo_type, $folder.'rev_slider.zip' );
		}

        echo "imported";
		die();
    }

    add_action('wp_ajax_zozo_import_demo_other_data', 'zozo_demo_import_other_data');
}

// Get Class
function zozo_name_to_class( $name ){
	$class = str_replace(array(' ',',','.','"',"'",'/',"\\",'+','=',')','(','*','&','^','%','$','#','@','!','~','`','<','>','?','[',']','{','}','|',':',),'',$name);
	$class = sanitize_html_class($class);
	return $class;
}

/* ================================================
 * Parsing Widgets Function
 * ================================================ */
// Thanks to http://wordpress.org/plugins/widget-settings-importexport/
function zozo_import_widget_data( $widget_data ) {
	$json_data = $widget_data;
	$json_data = json_decode( $json_data, true );
	$sidebar_data = $json_data[0];
	$widget_data = $json_data[1];
	
	foreach ( $widget_data as $widget_data_title => $widget_data_value ) {
		$widgets[ $widget_data_title ] = '';
		foreach( $widget_data_value as $widget_data_key => $widget_data_array ) {
			if( is_int( $widget_data_key ) ) {
				$widgets[$widget_data_title][$widget_data_key] = 'on';
			}
		}
	}
	unset($widgets[""]);

	foreach ( $sidebar_data as $title => $sidebar ) {
		$count = count( $sidebar );
		for ( $i = 0; $i < $count; $i++ ) {
			$widget = array( );
			$widget['type'] = trim( substr( $sidebar[$i], 0, strrpos( $sidebar[$i], '-' ) ) );
			$widget['type-index'] = trim( substr( $sidebar[$i], strrpos( $sidebar[$i], '-' ) + 1 ) );
			if ( !isset( $widgets[$widget['type']][$widget['type-index']] ) ) {
				unset( $sidebar_data[$title][$i] );
			}
		}
		$sidebar_data[$title] = array_values( $sidebar_data[$title] );
	}

	foreach ( $widgets as $widget_title => $widget_value ) {
		foreach ( $widget_value as $widget_key => $widget_value ) {
			$widgets[$widget_title][$widget_key] = $widget_data[$widget_title][$widget_key];
		}
	}

	$sidebar_data = array( array_filter( $sidebar_data ), $widgets );

	zozo_parse_import_data( $sidebar_data );
}

/**
 * Import widgets
 * @param array $import_array
 */
function zozo_parse_import_data( $import_array ) {
	global $wp_registered_sidebars;
	
	$sidebars_data = $import_array[0];
	$widget_data = $import_array[1];
	$current_sidebars = get_option( 'sidebars_widgets' );
	$new_widgets = array( );

	foreach ( $sidebars_data as $import_sidebar => $import_widgets ) :

		foreach ( $import_widgets as $import_widget ) :
			//if the sidebar exists
			if ( isset( $wp_registered_sidebars[$import_sidebar] ) ) :
				$title = trim( substr( $import_widget, 0, strrpos( $import_widget, '-' ) ) );
				$index = trim( substr( $import_widget, strrpos( $import_widget, '-' ) + 1 ) );
				$current_widget_data = get_option( 'widget_' . $title );
				$new_widget_name = zozo_get_new_widget_name( $title, $index );
				$new_index = trim( substr( $new_widget_name, strrpos( $new_widget_name, '-' ) + 1 ) );

				if ( !empty( $new_widgets[ $title ] ) && is_array( $new_widgets[$title] ) ) {
					while ( array_key_exists( $new_index, $new_widgets[$title] ) ) {
						$new_index++;
					}
				}
				$current_sidebars[$import_sidebar][] = $title . '-' . $new_index;
				if ( array_key_exists( $title, $new_widgets ) ) {
					$new_widgets[$title][$new_index] = $widget_data[$title][$index];
					$multiwidget = $new_widgets[$title]['_multiwidget'];
					unset( $new_widgets[$title]['_multiwidget'] );
					$new_widgets[$title]['_multiwidget'] = $multiwidget;
				} else {
					$current_widget_data[$new_index] = $widget_data[$title][$index];
					$current_multiwidget = isset($current_widget_data['_multiwidget']) ? $current_widget_data['_multiwidget'] : false;
					$new_multiwidget = isset($widget_data[$title]['_multiwidget']) ? $widget_data[$title]['_multiwidget'] : false;
					$multiwidget = ($current_multiwidget != $new_multiwidget) ? $current_multiwidget : 1;
					unset( $current_widget_data['_multiwidget'] );
					$current_widget_data['_multiwidget'] = $multiwidget;
					$new_widgets[$title] = $current_widget_data;
				}

			endif;
		endforeach;
	endforeach;

	if ( isset( $new_widgets ) && isset( $current_sidebars ) ) {
		update_option( 'sidebars_widgets', $current_sidebars );

		foreach ( $new_widgets as $title => $content )
			update_option( 'widget_' . $title, $content );

		return true;
	}

	return false;
}

function zozo_get_new_widget_name( $widget_name, $widget_index ) {
	$current_sidebars = get_option( 'sidebars_widgets' );
	$all_widget_array = array( );
	foreach ( $current_sidebars as $sidebar => $widgets ) {
		if ( !empty( $widgets ) && is_array( $widgets ) && $sidebar != 'wp_inactive_widgets' ) {
			foreach ( $widgets as $widget ) {
				$all_widget_array[] = $widget;
			}
		}
	}
	while ( in_array( $widget_name . '-' . $widget_index, $all_widget_array ) ) {
		$widget_index++;
	}
	$new_widget_name = $widget_name . '-' . $widget_index;
	return $new_widget_name;
}