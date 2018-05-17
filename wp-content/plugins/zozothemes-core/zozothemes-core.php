<?php
/*
Plugin Name: Zozothemes Core
Plugin URI: http://zozothemes.com
Description: Zozothemes Core Plugin for Zozothemes Themes
Version: 1.0.3
Author: Zozothemes
Author URI: http://zozothemes.com/
*/

if( ! class_exists( 'ZozothemesCore_Plugin' ) ) {
	class ZozothemesCore_Plugin {
		
		const VERSION = '1.0.3';
		
		/**
		 * Instance of this class.
		 *
		 * @since	1.0.0
		 *
		 * @var	  object
		 */
		protected static $instance = null;
		
		/**
		 * Initialize the plugin by setting localization and loading public scripts
		 * and styles.
		 *
		 * @since	 1.0.0
		 */
		private function __construct() {
			define('ZOZO_TINYMCE_URI', plugin_dir_url( __FILE__ ) . 'tinymce');
			define('ZOZO_TINYMCE_DIR', plugin_dir_path( __FILE__ ) .'tinymce');

			add_action('init', array(&$this, 'init'));
			add_action('admin_init', array(&$this, 'admin_init'));
			add_action('after_setup_theme', array(&$this, 'load_zozothemes_core_text_domain'));
			add_action('wp_enqueue_scripts', array(&$this, 'zozo_custom_scripts'), 30);
			add_action('wp_ajax_zozothemes_shortcodes_popup', array(&$this, 'zozo_popup'));
		}

		/**
		 * Registers TinyMCE rich editor buttons
		 *
		 * @return	void
		 */
		function init() {
		
			if ( get_user_option('rich_editing') == 'true' )
			{
				add_filter( 'mce_external_plugins', array(&$this, 'add_rich_plugins') );
				add_filter( 'mce_buttons', array(&$this, 'register_rich_buttons') );
			}

			$this->init_shortcodes();

		}

		/**
		 * Find and include all shortcodes
		 *
		 * @return void
		 */
		function init_shortcodes() {
			require_once plugin_dir_path( __FILE__ ) . '/shortcodes.php';
		}
		
		/**
		 * Register the plugin text domain
		 *
		 * @return void
		 */		
		function load_zozothemes_core_text_domain() {
			load_plugin_textdomain( 'zozothemes-core', false, dirname( plugin_basename(__FILE__) ) . '/languages' );
		}
		
		/**
		 * Defins TinyMCE rich editor js plugin
		 *
		 * @return	void
		 */
		function add_rich_plugins( $plugin_array )
		{
			if( is_admin() ) {
				$plugin_array['zozo_button'] = ZOZO_TINYMCE_URI . '/plugin.js';
			}

			return $plugin_array;
		}

		/**
		 * Adds TinyMCE rich editor buttons
		 *
		 * @return	void
		 */
		function register_rich_buttons( $buttons )
		{
			array_push( $buttons, 'zozo_button' );
			return $buttons;
		}
		
		/**
		 * Return an instance of this class.
		 *
		 * @since	 1.0.0
		 *
		 * @return	object	A single instance of this class.
		 */
		public static function get_instance() {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;

		}
		
		/**
		 * Enqueue Scripts and Styles
		 *
		 * @return	void
		 */
		function zozo_custom_scripts()
		{
			if( ! is_admin() ) {
				wp_enqueue_style( 'zozo-shortcodes', plugin_dir_url( __FILE__ ) . 'shortcodes.css', array(), null );
			}
			
		}
		
		/**
		 * Enqueue Scripts and Styles for Admin
		 *
		 * @return	void
		 */
		function admin_init()
		{
			global $pagenow;
		
			if( is_admin() && ( $pagenow == 'themes.php' ) ) {
				wp_enqueue_style( 'zozo-font-awesome', ZOZO_TINYMCE_URI . '/css/font-awesome.css', false, '4.3.0', 'all' );
			}
		
			// css
			wp_enqueue_style( 'zozo-popup', ZOZO_TINYMCE_URI . '/css/popup.css', false, '1.0', 'all' );
			wp_enqueue_style( 'wp-color-picker' );

			// js
			wp_enqueue_script( 'jquery-ui-sortable' );
			wp_enqueue_script( 'zozo-jquery-livequery', ZOZO_TINYMCE_URI . '/js/jquery.livequery.js', false, '1.1.1', false );
			wp_enqueue_script( 'zozo-jquery-appendo', ZOZO_TINYMCE_URI . '/js/jquery.appendo.js', false, '1.0', false );
			wp_enqueue_script( 'zozo-base64', ZOZO_TINYMCE_URI . '/js/base64.js', false, '1.0', false );
			wp_enqueue_script( 'bootstrap-tooltip', ZOZO_TINYMCE_URI . '/js/bootstrap-tooltip.js', false, '2.2.2', false );	
			wp_enqueue_script( 'bootstrap-popover', ZOZO_TINYMCE_URI . '/js/bootstrap-popover.js', false, '2.2.2', false );
			wp_enqueue_script( 'wp-color-picker' );
			
			wp_enqueue_script( 'zozo-popup', ZOZO_TINYMCE_URI . '/js/popup.js', false, '1.0', false );

			wp_localize_script( 'zozo-popup', 'zozoShortcodes', array( 'plugin_folder' => plugins_url( '', __FILE__ ) ) );
		}

		/**
		 * Popup function which will show shortcode options in thickbox.
		 *
		 * @return void
		 */
		function zozo_popup() {

			require_once( ZOZO_TINYMCE_DIR . '/popup.php' );

			die();

		}
	}
}
// Load the instance of the plugin
add_action( 'plugins_loaded', array( 'ZozothemesCore_Plugin', 'get_instance' ) );
register_activation_hook( __FILE__, 'zozo_custom_flush_rules');
function zozo_custom_flush_rules(){
	//defines the post type so the rules can be flushed.
	zozo_register_post_types();

	//and flush the rules.
	flush_rewrite_rules();
}

/* =======================================
 * Register custom post types
 * ======================================= */
function zozo_register_post_types() {
	
	global $zozo_options;
	
	$testimonial_labels = array(
		'name' 					=> esc_html__( 'Testimonial', 'zozothemes' ),
		'singular_name' 		=> esc_html__( 'Testimonial', 'zozothemes' ),
		'add_new' 				=> esc_html__( 'Add New', 'zozothemes' ),
		'add_new_item' 			=> esc_html__( 'Add New Testimonial', 'zozothemes' ),
		'edit_item' 			=> esc_html__( 'Edit Testimonial', 'zozothemes' ),
		'new_item' 				=> esc_html__( 'New Testimonial', 'zozothemes' ),
		'all_items' 			=> esc_html__( 'Testimonials', 'zozothemes' ),
		'view_item' 			=> esc_html__( 'View Testimonial', 'zozothemes' ),
		'search_items' 			=> esc_html__( 'Search Testimonials', 'zozothemes' ),
		'not_found' 			=> esc_html__( 'No Testimonials found', 'zozothemes' ),
		'not_found_in_trash' 	=> esc_html__( 'No testimonials found in Trash', 'zozothemes' ), 
		'parent_item_colon' 	=> ''
	);
	
	$testimonial_args = array(
		'labels' 				=> $testimonial_labels,
		'public' 				=> true,
		'publicly_queryable' 	=> true,
		'show_ui' 				=> true,
		'show_in_menu'       	=> true,
		'query_var' 			=> true,
		'rewrite' 				=> array( 'with_front' => false, 'slug' => 'testimonial' ),
		'capability_type' 		=> 'post',
		'hierarchical' 			=> false,
		'has_archive' 			=> false,
		'exclude_from_search' 	=> true,
		'supports' 				=> array( 'title', 'thumbnail', 'editor' )
	);
	
	if( ! post_type_exists('zozo_testimonial') ) {
		register_post_type( 'zozo_testimonial', $testimonial_args );
	}
	
	$testimonial_category_labels = array(
		'name'              	=> esc_html__( 'Categories', 'zozothemes' ),
		'singular_name'     	=> esc_html__( 'Category', 'zozothemes' ),
		'search_items'      	=> esc_html__( 'Search Categories', 'zozothemes' ),
		'all_items'         	=> esc_html__( 'All Categories', 'zozothemes' ),
		'parent_item'       	=> esc_html__( 'Parent Category', 'zozothemes' ),
		'parent_item_colon' 	=> esc_html__( 'Parent Category:', 'zozothemes' ),
		'edit_item'         	=> esc_html__( 'Edit Category', 'zozothemes' ),
		'update_item'       	=> esc_html__( 'Update Category', 'zozothemes' ),
		'add_new_item'      	=> esc_html__( 'Add New Category', 'zozothemes' ),
		'new_item_name'     	=> esc_html__( 'New Category Name', 'zozothemes' ),
		'menu_name'         	=> esc_html__( 'Categories', 'zozothemes' ),
	);

	$testimonial_category_args = array(
		'hierarchical'      	=> true,
		'labels'            	=> $testimonial_category_labels,
		'show_ui'           	=> true,
		'show_admin_column' 	=> true,
		'show_in_nav_menus' 	=> true,
		'query_var'         	=> true,
		'rewrite'           	=> array( 'with_front' => false, 'slug' => 'testimonial-categories' ),
	);
	
	if( ! taxonomy_exists( 'testimonial_categories' ) ) {
		register_taxonomy( 'testimonial_categories', 'zozo_testimonial', $testimonial_category_args );
	}
	
	$portfolio_labels = array(
		'name' 					=> esc_html__( 'Portfolio', 'zozothemes' ),
		'singular_name' 		=> esc_html__( 'Portfolio', 'zozothemes' ),
		'add_new' 				=> esc_html__( 'Add New', 'zozothemes' ),
		'add_new_item' 			=> esc_html__( 'Add New Portfolio', 'zozothemes' ),
		'edit_item' 			=> esc_html__( 'Edit Portfolio', 'zozothemes' ),
		'new_item' 				=> esc_html__( 'New Portfolio', 'zozothemes' ),
		'all_items' 			=> esc_html__( 'Portfolio', 'zozothemes' ),
		'view_item' 			=> esc_html__( 'View Portfolio', 'zozothemes' ),
		'search_items' 			=> esc_html__( 'Search Portfolio', 'zozothemes' ),
		'not_found' 			=> esc_html__( 'No Portfolio found', 'zozothemes' ),
		'not_found_in_trash' 	=> esc_html__( 'No portfolio found in Trash', 'zozothemes' ), 
		'parent_item_colon' 	=> ''
	);
	
	$portfolio_args = array(
		'labels' 				=> $portfolio_labels,
		'public' 				=> true,
		'publicly_queryable' 	=> true,
		'show_ui' 				=> true,
		'show_in_menu'       	=> true,
		'query_var' 			=> true,
		'rewrite' 				=> array( 'with_front' => false, 'slug' => 'portfolio' ),
		'capability_type' 		=> 'post',
		'hierarchical' 			=> false,
		'has_archive' 			=> false,
		'exclude_from_search' 	=> true,
		'supports' 				=> array( 'title', 'thumbnail', 'editor' )
	);
	
	if( ! post_type_exists('zozo_portfolio') ) {
		register_post_type( 'zozo_portfolio', $portfolio_args );
	}
		
	$portfolio_category_labels = array(
		'name'              	=> esc_html__( 'Categories', 'zozothemes' ),
		'singular_name'     	=> esc_html__( 'Category', 'zozothemes' ),
		'search_items'      	=> esc_html__( 'Search Categories', 'zozothemes' ),
		'all_items'         	=> esc_html__( 'All Categories', 'zozothemes' ),
		'parent_item'       	=> esc_html__( 'Parent Category', 'zozothemes' ),
		'parent_item_colon' 	=> esc_html__( 'Parent Category:', 'zozothemes' ),
		'edit_item'         	=> esc_html__( 'Edit Category', 'zozothemes' ),
		'update_item'       	=> esc_html__( 'Update Category', 'zozothemes' ),
		'add_new_item'      	=> esc_html__( 'Add New Category', 'zozothemes' ),
		'new_item_name'     	=> esc_html__( 'New Category Name', 'zozothemes' ),
		'menu_name'         	=> esc_html__( 'Categories', 'zozothemes' ),
	);

	$portfolio_category_args = array(
		'hierarchical'      	=> true,
		'labels'            	=> $portfolio_category_labels,
		'show_ui'           	=> true,
		'show_admin_column' 	=> true,
		'show_in_nav_menus' 	=> true,
		'query_var'         	=> true,
		'rewrite'           	=> array( 'with_front' => false, 'slug' => 'portfolio-categories' ),
	);	
	
	if( ! taxonomy_exists( 'portfolio_categories' ) ) {
		register_taxonomy( 'portfolio_categories', 'zozo_portfolio', $portfolio_category_args );
	}	
	
	$portfolio_tags_labels = array(
		'name'              	=> esc_html__( 'Tags', 'zozothemes' ),
		'singular_name'     	=> esc_html__( 'Tag', 'zozothemes' ),
		'search_items'      	=> esc_html__( 'Search Tags', 'zozothemes' ),
		'all_items'         	=> esc_html__( 'All Tags', 'zozothemes' ),
		'parent_item'       	=> esc_html__( 'Parent Tag', 'zozothemes' ),
		'parent_item_colon' 	=> esc_html__( 'Parent Tag:', 'zozothemes' ),
		'edit_item'         	=> esc_html__( 'Edit Tag', 'zozothemes' ),
		'update_item'       	=> esc_html__( 'Update Tag', 'zozothemes' ),
		'add_new_item'      	=> esc_html__( 'Add New Tag', 'zozothemes' ),
		'new_item_name'     	=> esc_html__( 'New Tag Name', 'zozothemes' ),
		'menu_name'         	=> esc_html__( 'Tags', 'zozothemes' ),
	);

	$portfolio_tags_args = array(
		'hierarchical'      	=> true,
		'labels'            	=> $portfolio_tags_labels,
		'show_ui'           	=> true,
		'show_admin_column' 	=> true,
		'show_in_nav_menus' 	=> true,
		'query_var'         	=> true,
		'rewrite'           	=> array( 'with_front' => false, 'slug' => 'portfolio-tags' ),
	);
	
	if( ! taxonomy_exists( 'portfolio_tags' ) ) {
		register_taxonomy( 'portfolio_tags', 'zozo_portfolio', $portfolio_tags_args );
	}	
	
	$team_labels = array(
		'name' 					=> esc_html__( 'Team Member', 'zozothemes' ),
		'singular_name' 		=> esc_html__( 'Team Member', 'zozothemes' ),
		'add_new' 				=> esc_html__( 'Add New', 'zozothemes' ),
		'add_new_item' 			=> esc_html__( 'Add New Member', 'zozothemes' ),
		'edit_item' 			=> esc_html__( 'Edit Member', 'zozothemes' ),
		'new_item' 				=> esc_html__( 'New Member', 'zozothemes' ),
		'all_items' 			=> esc_html__( 'Team Members', 'zozothemes' ),
		'view_item' 			=> esc_html__( 'View Members', 'zozothemes' ),
		'search_items' 			=> esc_html__( 'Search Members', 'zozothemes' ),
		'not_found' 			=> esc_html__( 'No Members found', 'zozothemes' ),
		'not_found_in_trash' 	=> esc_html__( 'No Members found in Trash', 'zozothemes' ), 
		'parent_item_colon' 	=> ''
	);
	
	$team_args = array(
		'labels' 				=> $team_labels,
		'public' 				=> true,
		'publicly_queryable' 	=> true,
		'show_ui' 				=> true,
		'show_in_menu'       	=> true,
		'query_var' 			=> true,
		'rewrite' 				=> array( 'with_front' => false, 'slug' => 'team' ),
		'capability_type' 		=> 'post',
		'hierarchical' 			=> false,
		'has_archive' 			=> false,
		'exclude_from_search' 	=> true,
		'supports' 				=> array( 'title', 'thumbnail', 'editor' )
	);
	
	if( ! post_type_exists('zozo_team_member') ) {
		register_post_type( 'zozo_team_member', $team_args );
	}
		
	$team_category_labels = array(
		'name'              	=> esc_html__( 'Categories', 'zozothemes' ),
		'singular_name'     	=> esc_html__( 'Category', 'zozothemes' ),
		'search_items'      	=> esc_html__( 'Search Categories', 'zozothemes' ),
		'all_items'         	=> esc_html__( 'All Categories', 'zozothemes' ),
		'parent_item'       	=> esc_html__( 'Parent Category', 'zozothemes' ),
		'parent_item_colon' 	=> esc_html__( 'Parent Category:', 'zozothemes' ),
		'edit_item'         	=> esc_html__( 'Edit Category', 'zozothemes' ),
		'update_item'       	=> esc_html__( 'Update Category', 'zozothemes' ),
		'add_new_item'      	=> esc_html__( 'Add New Category', 'zozothemes' ),
		'new_item_name'     	=> esc_html__( 'New Category Name', 'zozothemes' ),
		'menu_name'         	=> esc_html__( 'Categories', 'zozothemes' ),
	);

	$team_category_args = array(
		'hierarchical'      	=> true,
		'labels'            	=> $team_category_labels,
		'show_ui'           	=> true,
		'show_admin_column' 	=> true,
		'show_in_nav_menus' 	=> true,
		'query_var'         	=> true,
		'rewrite'           	=> array( 'with_front' => false, 'slug' => 'team-groups' ),
	);
	
	if( ! taxonomy_exists( 'team_categories' ) ) {
		register_taxonomy( 'team_categories', 'zozo_team_member', $team_category_args );
	}
	
}

add_action( 'init', 'zozo_register_post_types', 5 );