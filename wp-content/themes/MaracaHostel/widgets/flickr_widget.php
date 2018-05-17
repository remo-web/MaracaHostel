<?php
class Zozo_Flickr_Widget extends WP_Widget {

	function Zozo_Flickr_Widget()
	{
		/* Widget settings. */
		$widget_options = array('classname' => 'zozo_flickr_widget', 'description' => 'Displays your recent photos from Flickr.');
		$control_options = array('id_base' => 'zozo_flickr_widget-widget');
		
		/* Create the widget. */
		parent::__construct('zozo_flickr_widget-widget', 'Flickr', $widget_options, $control_options);
	}

	function widget($args, $instance)
	{
		extract($args);

		$user_id = $instance['user_id'];
		$photo_count = $instance['photo_count'];
		$api_key = $instance['api_key'];
		if(empty($api_key)) {
			$api_key = '9a0554259914a86fb9e7eb014e4e5d52';
		}
		$size = isset($instance['size']) ? $instance['size'] : 's';
		
		if( $size == 's' ) {
			$image_size_w = '75';
			$image_size_h = '75';
		} elseif( $size == 't' ) {
			$image_size_w = '100';
			$image_size_h = '75';
		} elseif( $size == 'q' ) {
			$image_size_w = '150';
			$image_size_h = '150';
		} elseif( $size == 'm' ) {
			$image_size_w = '500';
			$image_size_h = '375';
		} 
		$title = apply_filters('widget_title', $instance['title']);

		echo wp_kses( $before_widget, zozo_expanded_allowed_tags() );
		
		if($title) {
			echo wp_kses( $before_title . $title . $after_title, zozo_expanded_allowed_tags() );
		} 
		
		if( $user_id != '' ) {
		
			//set transient name
			$transient_name = 'zozo-flickr-photos-' . sanitize_title_with_dashes($user_id);
			$transient_name1 = 'zozo-flickr-links-' . sanitize_title_with_dashes($user_id);
			
			// Get stored transients
			$cached_flickr_photos = get_transient( $transient_name );
			$cached_flickr_links = get_transient( $transient_name1 );
			
			if( false === $cached_flickr_links || empty( $cached_flickr_links ) ) {
			
				// Get Image Links
				$get_url = wp_remote_get('https://api.flickr.com/services/rest/?method=flickr.urls.getUserPhotos&api_key='.$api_key.'&user_id='.$user_id.'&format=json');
				
				if(is_array($get_url) && array_key_exists('body', $get_url))
				{
					$get_url = trim($get_url['body'], 'jsonFlickrApi()');
					$get_url = json_decode($get_url);
				}
				
				// Set it to transient
				set_transient( $transient_name1, $get_url, HOUR_IN_SECONDS * 24 );
				
			} else {
		
				$get_url = $cached_flickr_links;
				
			}
				
			if( false === $cached_flickr_photos || empty( $cached_flickr_photos ) ) {
			
				// Get Images
				$get_photos = wp_remote_get('https://api.flickr.com/services/rest/?method=flickr.people.getPublicPhotos&api_key='.$api_key.'&user_id='.$user_id.'&per_page='.$photo_count.'&format=json');
				
				if(is_array($get_photos) && array_key_exists('body', $get_photos)) {
					$get_photos = trim($get_photos['body'], 'jsonFlickrApi()');				
					$get_photos = json_decode($get_photos);				
				} 
				
				// Set it to transient
				set_transient( $transient_name, $get_photos, HOUR_IN_SECONDS * 24 );
				
			} else {
		
				$get_photos = $cached_flickr_photos;
				
			} ?>
			
			<ul class="zozo_flickr_widget list-unstyled">
				<?php 
				foreach($get_photos->photos->photo as $photo) {					
					$photo = (array) $photo; 
					$url = "http://farm" . $photo['farm'] . ".static.flickr.com/" . $photo['server'] . "/" . $photo['id'] . "_" . $photo['secret'] . "_".$size."" . ".jpg"; ?>

					<li class="flickr_photo_item">	
						<a href="<?php echo esc_url( $get_url->user->url ); ?><?php echo esc_attr( $photo['id'] ); ?>" target="_blank" title="<?php echo esc_attr( $photo['title'] ); ?>">
							<img src="<?php echo esc_url( $url ); ?>" alt="<?php echo esc_attr( $photo['title'] ); ?>" width="<?php echo esc_attr( $image_size_w ); ?>" height="<?php echo esc_attr( $image_size_h ); ?>" />	
						</a>
					</li>

				<?php } ?>
			</ul>
		
		<?php } ?>
		
		<?php echo wp_kses( $after_widget, zozo_expanded_allowed_tags() );
	}

	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['user_id'] = $new_instance['user_id'];
		$instance['photo_count'] = $new_instance['photo_count'];
		$instance['api_key'] = $new_instance['api_key'];
		$instance['size'] = $new_instance['size'];
		
		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => '', 'user_id' => '', 'photo_count' => '', 'api_key' => '', 'size' => '');
		$instance = wp_parse_args((array) $instance, $defaults);
			
		$sizes = array(
			's' => esc_attr__( 'Standard', 'zozothemes' ),
			't' => esc_attr__( 'Thumbnail', 'zozothemes' ),
			'q' => esc_attr__( 'Large Square', 'zozothemes' ),
			'm' => esc_attr__( 'Medium', 'zozothemes' )
		);
		
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php _e('Title:', 'zozothemes'); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('user_id') ); ?>"><?php _e('Flickr ID:', 'zozothemes'); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('user_id') ); ?>" name="<?php echo esc_attr( $this->get_field_name('user_id') ); ?>" value="<?php echo esc_attr( $instance['user_id'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('photo_count') ); ?>"><?php _e('Number of Photos to show:', 'zozothemes'); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('photo_count') ); ?>" name="<?php echo esc_attr( $this->get_field_name('photo_count') ); ?>" value="<?php echo esc_attr( $instance['photo_count'] ); ?>" />
		</p>		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('api_key') ); ?>"><?php _e('API Key:', 'zozothemes'); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('api_key') ); ?>" name="<?php echo esc_attr( $this->get_field_name('api_key') ); ?>" value="<?php echo esc_attr( $instance['api_key'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('size') ); ?>"><?php _e( 'Sizes:', 'zozothemes' ); ?></label>			
			<select id="<?php echo esc_attr( $this->get_field_id('size') ); ?>" name="<?php echo esc_attr( $this->get_field_name('size') ); ?>">
				<?php foreach ( $sizes as $key => $value ) { ?>
					<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $instance['size'], $key ); ?>><?php echo esc_attr( $value ); ?></option>
				<?php } ?>
			</select>				
		</p>
	<?php }
}

function zozo_flickr_load()
{
	register_widget('Zozo_Flickr_Widget');
}

add_action('widgets_init', 'zozo_flickr_load');
?>