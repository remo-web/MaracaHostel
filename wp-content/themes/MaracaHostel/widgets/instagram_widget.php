<?php
class Zozo_Instagram_Widget extends WP_Widget {

	function Zozo_Instagram_Widget()
	{
		/* Widget settings. */
		$widget_options = array('classname' => 'zozo_instagram_widget', 'description' => 'Displays your latest photos from Instagram.');
		$control_options = array('id_base' => 'zozo_instagram_widget-widget');
		
		/* Create the widget. */
		parent::__construct('zozo_instagram_widget-widget', 'Instagram', $widget_options, $control_options);
	}

	function widget($args, $instance)
	{
		extract($args);

		$user_name = $instance['user_name'];
		if( $user_name == '' ) {
			$user_name = 'google';
		}
		$photo_count = !empty($instance['photo_count']) ? $instance['photo_count'] : 6;
		$size = !empty($instance['size']) ? $instance['size'] : 'thumbnail';
		$link_text = $instance['link_text'];
		$link_target = !empty($instance['link_target']) ? $instance['link_target'] : '_self';
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'] );

		echo wp_kses( $before_widget, zozo_expanded_allowed_tags() );
		
		if($title) {
			echo wp_kses( $before_title . $title . $after_title, zozo_expanded_allowed_tags() );
		}
		
		if ($user_name != '') {
		
			// Get Photos Array 
			$media_array = $this->scrape_instagram($user_name, $photo_count); 
			
			if ( is_wp_error( $media_array ) ) {

				echo $media_array->get_error_message();

			} else {
				
				// filter for images only?
				$media_array = array_filter( $media_array, array( $this, 'zozo_images_only' ) ); ?>
			
				<ul class="zozo_instagram_widget list-unstyled">
					<?php foreach($media_array as $item) {						
						$new_img_size = getimagesize( $item[$size] );
						$item_img = $item[$size];
						
						echo '<li class="instagram-item image-'. esc_attr( $size ) .'"><a href="'. esc_url( $item['link'] ) .'" target="'. esc_attr( $link_target ) .'"><img src="'. esc_url( $item_img ) .'"  alt="'. esc_attr( $item['description'] ) .'" width="'. esc_attr( $new_img_size[0] ) .'" height="'. esc_attr( $new_img_size[1] ) .'" title="'. esc_attr( $item['description'] ).'"/></a></li>';
						}
					?>
				</ul>			
		<?php }
		}
		
		if($link_text != '') { ?>
			<p class="instagram-link"><a href="http://instagram.com/<?php echo esc_attr( trim($user_name) ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_attr( $link_text ); ?></a></p>
		<?php } ?>
		
		<?php echo wp_kses( $after_widget, zozo_expanded_allowed_tags() );
	}
	
	// code modified from https://gist.github.com/cosmocatalano/4544576
	function scrape_instagram($user_name, $photos_count) {
	
		$user_name = strtolower( $user_name );
	
		if(false === ($instagram = get_transient('zozo-instagram-'.sanitize_title_with_dashes($user_name)))) {
			
			// Get media array for user name
			$remote = wp_remote_get('http://instagram.com/'.trim( $user_name ), array( 'sslverify' => false, 'timeout' => 60 ));
			
			if ( is_wp_error( $remote ) ) {
				return new WP_Error( 'site_down', __( 'Unable to communicate with Instagram.', 'zozothemes' ) );
			}
			
			if ( 200 != wp_remote_retrieve_response_code( $remote ) ) {
				return new WP_Error( 'invalid_response', __( 'Instagram did not return a 200.', 'zozothemes' ) );
			}
			
			$shards = explode('window._sharedData = ', $remote['body']);
			$insta_json = explode(';</script>', $shards[1]);
			$insta_array = json_decode($insta_json[0], TRUE);
			
			if ( ! $insta_array ) {
				return new WP_Error( 'bad_json', __( 'Instagram has returned invalid data.', 'zozothemes' ) );
			}
			
			// old style
			if ( isset( $insta_array['entry_data']['UserProfile'][0]['userMedia'] ) ) {
				$images = $insta_array['entry_data']['UserProfile'][0]['userMedia'];
				$type = 'old';
			// new style
			} else if ( isset( $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'] ) ) {
				$images = $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'];
				$type = 'new';
			} else {
				return new WP_Error( 'bad_josn_2', __( 'Instagram has returned invalid data.', 'zozothemes' ) );
			}
			
			if ( !is_array( $images ) ) {
				return new WP_Error( 'bad_array', __( 'Instagram has returned invalid data.', 'zozothemes' ) );
			}

			$instagram = array();
						
			switch ( $type ) {
				case 'old':
					foreach ( $images as $image ) {

						if ( $image['user']['username'] == $user_name ) {

							$image['link']						  	= preg_replace( "/^http:/i", "", $image['link'] );
							$image['images']['thumbnail']		   	= preg_replace( "/^http:/i", "", $image['images']['thumbnail'] );
							$image['images']['standard_resolution'] = preg_replace( "/^http:/i", "", $image['images']['standard_resolution'] );
							$image['images']['low_resolution']	  	= preg_replace( "/^http:/i", "", $image['images']['low_resolution'] );

							$instagram[] = array(
								'description'   => $image['caption']['text'],
								'link'		  	=> $image['link'],
								'time'		  	=> $image['created_time'],
								'comments'	  	=> $image['comments']['count'],
								'likes'		 	=> $image['likes']['count'],
								'thumbnail'	 	=> $image['images']['thumbnail'],
								'large'		 	=> $image['images']['standard_resolution'],
								'medium'		=> $image['images']['low_resolution'],
								'type'		  	=> $image['type']
							);
						}
					}
				break;
				default:
					foreach ( $images as $image ) {
						
						// Image Sizes from instagram
						preg_match( '/([^\/]+$)/', $image['display_src'], $matches );
						if ( false === strpos( $matches[0], '_7.jpg' ) ) {
							$image['medium']    = str_replace( $matches[0], 's320x320/' . $matches[0], $image['display_src'] );
							$image['thumbnail'] = str_replace( $matches[0], 's150x150/' . $matches[0], $image['display_src'] );
						} else {
							$image['medium']    = str_replace( '_7.jpg', '_6.jpg', $image['display_src'] );
							$image['thumbnail'] = str_replace( '_7.jpg', '_5.jpg', $image['display_src'] );
						}

						if ( $image['is_video']  == true ) {
							$type = 'video';
						} else {
							$type = 'image';
						}
						
						$instagram[] = array(
							'description'   => __( 'Instagram Image', 'zozothemes' ),
							'link'		  	=> '//instagram.com/p/' . $image['code'],
							'time'		  	=> $image['date'],
							'comments'	  	=> $image['comments']['count'],
							'likes'		 	=> $image['likes']['count'],
							//'thumbnail'	 => $image['thumbnail_src'],
							'thumbnail'	 	=> $image['thumbnail'],
							'medium'	 	=> $image['medium'],
							'large'	 		=> $image['display_src'],
							'dimensions'	=> $image['dimensions'],
							'type'		  	=> $type
						);
					}
				break;
			}
			
			// do not set an empty transient - should help catch private or empty accounts
			if ( ! empty( $instagram ) ) {
				$instagram = base64_encode( serialize( $instagram ) );
				set_transient( 'zozo-instagram-'.sanitize_title_with_dashes( $user_name ), $instagram, HOUR_IN_SECONDS * 24 );
			}
			
		}
		
		if ( ! empty( $instagram ) ) {

			$instagram = unserialize( base64_decode( $instagram ) );			
			$instagram = array_filter( $instagram, array( $this, 'zozo_images_only' ) );
			
			return array_slice( $instagram, 0, $photos_count );

		} else {

			return new WP_Error( 'no_images', __( 'Instagram did not return any images.', 'zozothemes' ) );

		}
		
	}
	
	function zozo_images_only( $media_item ) {

		if ( $media_item['type'] == 'image' )
			return true;

		return false;
	}


	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['user_name'] = $new_instance['user_name'];
		$instance['photo_count'] = $new_instance['photo_count'];
		$instance['size'] = $new_instance['size'];
		$instance['link_text'] = $new_instance['link_text'];
		$instance['link_target'] = $new_instance['link_target'];
		
		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => '', 'user_name' => '', 'photo_count' => '', 'size' => '', 'link_text' => '', 'link_target' => '');
		$instance = wp_parse_args((array) $instance, $defaults);
			
		$sizes = array(
			'thumbnail' => esc_attr__( 'Thumbnail', 'zozothemes' ),
			'medium' => esc_attr__( 'Medium', 'zozothemes' ),
			'large' => esc_attr__( 'Large', 'zozothemes' )			
		);
		
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php _e('Title:', 'zozothemes'); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('user_name') ); ?>"><?php _e('User name:', 'zozothemes'); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('user_name') ); ?>" name="<?php echo esc_attr( $this->get_field_name('user_name') ); ?>" value="<?php echo esc_attr( $instance['user_name'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('photo_count') ); ?>"><?php _e('Number of Photos to show:', 'zozothemes'); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('photo_count') ); ?>" name="<?php echo esc_attr( $this->get_field_name('photo_count') ); ?>" value="<?php echo esc_attr( $instance['photo_count'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('size') ); ?>"><?php _e( 'Sizes:', 'zozothemes' ); ?></label>			
			<select id="<?php echo esc_attr( $this->get_field_id('size') ); ?>" name="<?php echo esc_attr( $this->get_field_name('size') ); ?>">
				<?php foreach ( $sizes as $key => $value ) { ?>
					<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $instance['size'], $key ); ?>><?php echo esc_attr( $value ); ?></option>
				<?php } ?>
			</select>				
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('link_text') ); ?>"><?php _e('Link Text:', 'zozothemes'); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('link_text') ); ?>" name="<?php echo esc_attr( $this->get_field_name('link_text') ); ?>" value="<?php echo esc_attr( $instance['link_text'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('link_target') ); ?>"><?php _e('Link Target:', 'zozothemes'); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id('link_target' )); ?>" name="<?php echo esc_attr( $this->get_field_name('link_target') ); ?>" class="widefat" style="width:100%;">
				<option value="_blank" <?php echo selected(esc_attr($instance['link_target']), '_blank', false); ?>><?php _e('Open in a New Tab', 'zozothemes'); ?></option>
				<option value="_self" <?php echo selected(esc_attr($instance['link_target']), '_self', false); ?>><?php _e('Open in a Same Tab', 'zozothemes'); ?></option>				
			</select>
		</p>
	<?php }
}

function zozo_instagram_load()
{
	register_widget('Zozo_Instagram_Widget');
}

add_action('widgets_init', 'zozo_instagram_load');
?>