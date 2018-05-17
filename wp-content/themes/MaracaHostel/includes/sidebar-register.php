<?php
/**
 * Register widgetized areas
 */
if ( ! function_exists( 'zozo_widgets_init' ) ) {
	function zozo_widgets_init() {
	
	global $zozo_options;
	
	// Primary Sidebar
	    
	register_sidebar( array(
		'name'          => __( 'Main Sidebar', 'zozothemes' ),
		'id'            => 'primary',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		'description' => __( 'The default sidebar used in two or three-column layouts.', 'zozothemes' ),
	) );
	
	// Secondary Sidebar
	
	register_sidebar( array(
		'name'          => __( 'Secondary Sidebar', 'zozothemes' ),
		'id'            => 'secondary',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		'description' => __( 'A secondary sidebar used in three-column layouts.', 'zozothemes' ),
	) );
	
	// Secondary Menu Sidebar
	
	register_sidebar( array(
		'name'          => __( 'Secondary Menu Sidebar', 'zozothemes' ),
		'id'            => 'secondary-menu',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		'description' => __( 'A secondary menu sidebar used to show your widgets on secondary menu area if enabled in theme options.', 'zozothemes' ),
	) );
	
	// Footer Widgets Sidebar
	$is_footer_widgets = '';
	$is_footer_widgets = isset( $zozo_options['zozo_footer_widgets_enable'] ) ? $zozo_options['zozo_footer_widgets_enable'] : 0;
	
	if( $is_footer_widgets ) {
		
		$footer_type = $zozo_options['zozo_footer_type'];
		
		$columns = '';
		switch( $footer_type ) {
			case 'footer-1':
				$columns = 4;
				break;
			case 'footer-2':
			case 'footer-3':
				$columns = 3;
				break;
			case 'footer-4':
			case 'footer-5':
			case 'footer-6':
				$columns = 2;
				break;
			case 'footer-7':
				$columns = 1;
				break;
		}
		
		if ( ! $columns ) $columns = 4;
		for ( $i = 1; $i <= intval( $columns ); $i++ ) {
		
			register_sidebar( array(
				'name'          => sprintf( __( 'Footer %d', 'zozothemes' ), $i ),
				'id'            => sprintf( 'footer-widget-%d', $i ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
				'description'	=> sprintf( __( 'Footer widget Area %d.', 'zozothemes' ), $i ),
			) );
				
		}
		
	}
	
	// Sliding Widgets Sidebar
	$sliding_widgets = '';
	$sliding_widgets = isset( $zozo_options['zozo_enable_sliding_bar'] ) ? $zozo_options['zozo_enable_sliding_bar'] : 0;
	
	if( $sliding_widgets ) {
	
		$columns = '';
		$columns = $zozo_options['zozo_sliding_bar_columns'];
		
		if ( ! $columns ) $columns = 3;
		for ( $i = 1; $i <= intval( $columns ); $i++ ) {
		
			register_sidebar( array(
				'name'          => sprintf( __( 'Sliding Bar Widget %d', 'zozothemes' ), $i ),
				'id'            => sprintf( 'sliding-bar-%d', $i ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
				'description'	=> sprintf( __( 'Sliding Bar Widget Area %d.', 'zozothemes' ), $i ),
			) );
				
		}
	}
	
	/**
	 * Woocommerce Sidebar
	 */
	if( class_exists('Woocommerce') ) {
		register_sidebar( array(
			'name'          => __( 'Shop Sidebar', 'zozothemes' ),
			'id'            => 'shop-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
			'description' => __( 'Shop Sidebar to show your widgets on Shop Pages.', 'zozothemes' ),
		) );
	}
	
	/**
	 * EPL Sidebar
	 */
	if( class_exists('Easy_Property_Listings') ) {
		register_sidebar( array(
			'name'          => __( 'EPL Sidebar', 'zozothemes' ),
			'id'            => 'epl-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
			'description' => __( 'EPL Sidebar to show your widgets on property single pages.', 'zozothemes' ),
		) );
	}
		
	} // End zozo_widgets_init()
}

add_action( 'widgets_init', 'zozo_widgets_init' );  
?>