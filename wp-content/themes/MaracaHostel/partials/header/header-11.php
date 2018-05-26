<?php global $post, $zozo_options; 
$object_id = get_queried_object_id();

if( ( get_option('show_on_front') && get_option('page_for_posts') && is_home() ) || 
( get_option('page_for_posts') && is_archive() && ! is_post_type_archive() ) && 
!( is_tax('product_cat') || is_tax('product_tag') ) || 
( get_option('page_for_posts') && is_search() ) ) {

	$post_id = get_option('page_for_posts');		
} else {
	if( isset($object_id) ) {
		$post_id = $object_id;
	}

	if( ZOZO_WOOCOMMERCE_ACTIVE ) {
		if( is_shop() ) {
			$post_id = get_option('woocommerce_shop_page_id');
		}
		
		if ( ! is_singular() && ! is_shop() ) {
			$post_id = false;
		}
	} else {
		if( ! is_singular() ) {
			$post_id = false;
		}
	}
}
$header_mini_cart = '';
$header_mini_cart 	= get_post_meta( $post_id, 'zozo_show_header_mini_cart', true );
if( isset( $header_mini_cart ) && $header_mini_cart == '' || $header_mini_cart == 'default' ) {
	$header_mini_cart = $zozo_options['zozo_show_cart_header'];
	if( $header_mini_cart == 1 ) {
		$header_mini_cart = 'yes';
	} else {
		$header_mini_cart = 'no';
	}
} ?>
	
<div id="header-logo-bar" class="header-logo-section navbar">			
	<div class="container">
		<?php $zozo_site_title = get_bloginfo( 'name' );
		$zozo_site_url = home_url( '/' );
		$zozo_site_description = get_bloginfo( 'description' );
		 
		$heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div';
		
		if( $zozo_options['zozo_sticky_logo'] && $zozo_options['zozo_sticky_logo']['url'] ) {
			$logo_class = " zozo-has-sticky-logo";
		} else {
			$logo_class = " zozo-no-sticky-logo"; 
		} 
		
		if( $zozo_options['zozo_mobile_logo'] && $zozo_options['zozo_mobile_logo']['url'] ) {
			$logo_class .= " zozo-has-mobile-logo";
		} else {
			$logo_class .= " zozo-no-mobile-logo"; 
		} ?>
		
		<!-- ============ Logo ============ -->
		<div class="navbar-header nav-respons zozo-logo<?php echo esc_attr( $logo_class ); ?>">
			<!-- ==================== Toggle Icon ==================== -->
			<button type="button" aria-expanded="false" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".zozo-topnavbar-collapse">
				<span class="sr-only"><?php esc_html_e('Toggle navigation', 'zozothemes'); ?></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
				
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-brand" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" rel="home">
				<?php if( $zozo_options['zozo_logo'] && $zozo_options['zozo_logo']['url'] ) {
					echo '<img class="img-responsive zozo-standard-logo" src="' . esc_url( $zozo_options['zozo_logo']['url'] ) . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" width="'. esc_attr( $zozo_options['zozo_logo']['width'] ) .'" height="'. esc_attr( $zozo_options['zozo_logo']['height'] ) .'" />';
				} else {
					bloginfo( 'name' );
				} ?>
				<?php if( $zozo_options['zozo_sticky_logo'] && $zozo_options['zozo_sticky_logo']['url'] ) {
					echo '<img class="img-responsive zozo-sticky-logo" src="' . esc_url( $zozo_options['zozo_sticky_logo']['url'] ) . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" width="'. esc_attr( $zozo_options['zozo_sticky_logo']['width'] ) .'" height="'. esc_attr( $zozo_options['zozo_sticky_logo']['height'] ) .'" />';
				} ?>
				<?php if( $zozo_options['zozo_mobile_logo'] && $zozo_options['zozo_mobile_logo']['url'] ) {
					echo '<img class="img-responsive zozo-mobile-logo" src="' . esc_url( $zozo_options['zozo_mobile_logo']['url'] ) . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" width="'. esc_attr( $zozo_options['zozo_mobile_logo']['width'] ) .'" height="'. esc_attr( $zozo_options['zozo_mobile_logo']['height'] ) .'" />';
				} ?>
			</a>
		</div>
		
		<div class="navbar-collapse zozo-topnavbar-collapse collapse">
			<!-- ==================== Header Top Bar Right ==================== -->
			<ul class="nav navbar-nav navbar-right zozo-top-right">
				<?php if( isset( $zozo_options['zozo_header_address'] ) && $zozo_options['zozo_header_address'] != '' ) { ?>
				<li class="header-details-box">
					<div class="header-details-icon header-address-icon"><i class="fa fa-map-marker"></i></div>
					<div class="header-details-info header-address"><p class="endereco-top txt-top"><strong>Onde Estamos:</strong> <?php echo force_balance_tags( $zozo_options['zozo_header_address'] ); ?></p></div>
				</li>
				<?php } ?>
				
				<?php if( ( isset( $zozo_options['zozo_header_phone'] ) && $zozo_options['zozo_header_phone'] != '' ) || ( isset( $zozo_options['zozo_header_email'] ) && $zozo_options['zozo_header_email'] != '' ) ) { ?>
				<li class="header-details-box">
					<div class="header-details-icon header-contact-icon"><i class="fa fa-phone"></i></div>
					<div class="header-details-info header-contact-details">
						<p class="telefone-top txt-top"><strong>Ligue Pro Maraca:</strong> <?php echo force_balance_tags( $zozo_options['zozo_header_phone'] ); ?></p>
					</div>
				</li>
				<?php } ?>
			</ul>
			
			<ul class="nav navbar-nav navbar-right zozo-top-right redes-sociais">
				<?php if ( isset( $zozo_options['zozo_show_socials_header']) && $zozo_options['zozo_show_socials_header'] == 1 ) { ?>
				<li class="social-nav"><?php zozo_header_content_area( 'social-links' ); ?></li>
				<?php } ?>
				<?php if( isset($zozo_options['zozo_enable_search_in_header']) && $zozo_options['zozo_enable_search_in_header'] == 1 ) { ?>
				<li class="extra-nav search-nav">
					<div id="header-main-search" class="header-main-right-search">
						<i class="fa fa-search btn-trigger"></i>
						<?php echo get_search_form(); ?>
					</div>
				</li>
				<?php } ?>
				
				<?php if( isset($zozo_options['zozo_enable_secondary_menu']) && $zozo_options['zozo_enable_secondary_menu'] == 1 ) { ?>
				<li class="extra-nav">
					<div id="secondary-menu" class="header-main-bar-sidemenu side-menu">
						<a class="secondary_menu_button" href="javascript:void(0)">
							<i class="fa fa-bars"></i>
						</a>
					</div>
				</li>
				<?php } ?>
				
				<?php if( ZOZO_WOOCOMMERCE_ACTIVE ) {
					if ( isset($header_mini_cart) && $header_mini_cart == 'yes' ) { ?>
						<li class="extra-nav header-top-cart"><?php echo zozo_header_content_area( 'cart-icon' ); ?></li>
					<?php }
				} ?>
			</ul>

			<!-- <div class="language navbar-right zozo-top-right">
				<span>Português</span>
				<ul>
					<li><a href="#">English</a></li>
					<li><a href="#">Português</a></li>
				</ul>
			</div> -->

		</div>
	</div><!-- .container -->
</div>
		
<div id="header-main" class="header-main-section navbar">
	<div class="container">
		<div class="navbar-header nav-respons">
			<!-- ==================== Toggle Icon ==================== -->
			<button type="button" aria-expanded="false" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".zozo-mainnavbar-collapse">
				<span class="sr-only"><?php esc_html_e('Toggle navigation', 'zozothemes'); ?></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
			
		<div class="navbar-collapse zozo-mainnavbar-collapse collapse zozo-header-main-bar">
			<!-- ==================== Header Left ==================== -->
			<ul class="nav navbar-nav navbar-left zozo-main-bar">
				<li><?php zozo_header_content_area( 'main-navigation' ); ?></li>
			</ul>
			
			<!-- ==================== Header Right ==================== -->
			
		</div>
	</div><!-- .container -->
</div><!-- .header-main-section -->