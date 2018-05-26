<?php
class Zozo_Popular_Posts_Widget extends WP_Widget {

	function Zozo_Popular_Posts_Widget()
	{
		/* Widget settings. */
		$widget_options = array('classname' => 'zozo_popular_posts_widget', 'description' => 'Displays latest posts based on categories.');
		$control_options = array('id_base' => 'zozo_popular_posts-widget');
		
		/* Create the widget. */
		parent::__construct('zozo_popular_posts-widget', 'Popular Posts', $widget_options, $control_options);
	}

	function widget($args, $instance)
	{
		global $zozo_options, $post;

		extract($args);

		$categories = absint($instance['categories']) ? $instance['categories'] : '';
		$posts_count = absint($instance['posts_count']) ? $instance['posts_count'] : 5;
		$show_date = !empty($instance['show_date']) ? $instance['show_date'] : '';
		$show_excerpt = !empty($instance['show_excerpt']) ? $instance['show_excerpt'] : '';
		$show_thumb = !empty($instance['show_thumb']) ? $instance['show_thumb'] : '';
		$title = apply_filters('widget_title', $instance['title']);

		echo wp_kses( $before_widget, zozo_expanded_allowed_tags() );
		
		if($title) {
			echo wp_kses( $before_title . $title . $after_title, zozo_expanded_allowed_tags() );
		}
				
		$popular_args = array(
			'posts_per_page' 		=> $posts_count,
			'meta_key'		 		=> 'zozo_post_views_count',
			'orderby' 		 		=> 'meta_value_num',
			'order' 		 		=> 'DESC',
			'cat'			 		=> $categories,
			'ignore_sticky_posts' 	=> 1
		);
		
		$popular_posts = new WP_Query($popular_args);
		if( $popular_posts->have_posts() ): ?>
		
			<div id="zozo_latest_posts_widget" class="zozo-latest-posts">
				<ul class="latest-posts-menu list-unstyled">
				<?php while( $popular_posts->have_posts( )): $popular_posts->the_post();
					$featured_img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'thumbnail');	?>
					
					<li class="posts-item clearfix">
						<?php if( $show_thumb == 'on' && $featured_img[0] != '' ) { ?>
							<div class="latest-post-img">
								<img class="img-responsive latest-post-img" src="<?php echo esc_url( $featured_img[0] ); ?>" alt="<?php the_title(); ?>" />
							</div>
						<?php } ?>
						<div class="latest-post-content">
							<h6 class="posts-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h6>
							<?php if( $show_excerpt == 'on' ) { ?>
								<div class="entry-summary">
									<p><?php echo zozo_shortcode_stripped_excerpt( get_the_content(), '10' ); ?></p>
								</div>
							<?php } ?>
							<?php if( $show_date == 'on' ) { ?>
								<span class="entry-date posted-date"><i class="fa fa-calendar"></i> <?php the_time( $zozo_options['zozo_blog_date_format'] ); ?></span>
							<?php } ?>
						</div>
					</li>

				<?php endwhile; ?>
				</ul>
			</div>
			<?php endif; ?>
		<?php wp_reset_postdata();
		echo wp_kses( $after_widget, zozo_expanded_allowed_tags() );
	}

	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['categories'] = $new_instance['categories'];
		$instance['posts_count'] = $new_instance['posts_count'];
		$instance['show_date'] = $new_instance['show_date'];
		$instance['show_excerpt'] = $new_instance['show_excerpt'];
		$instance['show_thumb'] = $new_instance['show_thumb'];
		
		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => '', 'categories' => '', 'posts_count' => '', 'show_date' => '', 'show_excerpt' => '', 'show_thumb' => '');
		$instance = wp_parse_args((array) $instance, $defaults);	
		
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php _e('Title:', 'zozothemes'); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('categories') ); ?>"><?php _e('Choose Category:', 'zozothemes'); ?></label>			
			<?php $args = array(
					'show_option_all'    => 'All Categories',
					'id'                 => esc_attr( $this->get_field_id('categories' ) ),
					'name'               => esc_attr( $this->get_field_name('categories' ) ),
					'class'              => 'widefat',
					'orderby'            => 'NAME', 
					'order'              => 'ASC',	
					'selected'           => esc_attr($instance['categories']),				
					'hierarchical'       => 1,
					);
					
			wp_dropdown_categories($args); ?>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('posts_count') ); ?>"><?php _e('Number of posts to show:', 'zozothemes'); ?></label>
			<input class="widefat" type="text" style="width: 35px;" id="<?php echo esc_attr( $this->get_field_id('posts_count') ); ?>" name="<?php echo esc_attr( $this->get_field_name('posts_count') ); ?>" value="<?php echo esc_attr( $instance['posts_count'] ); ?>" />
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked(esc_attr( $instance['show_date'] ), 'on'); ?> id="<?php echo esc_attr( $this->get_field_id('show_date') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_date') ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id('show_date') ); ?>"><?php _e('Show Date', 'zozothemes'); ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked(esc_attr( $instance['show_excerpt'] ), 'on'); ?> id="<?php echo esc_attr( $this->get_field_id('show_excerpt') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_excerpt') ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id('show_excerpt') ); ?>"><?php _e('Show Excerpt', 'zozothemes'); ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked(esc_attr( $instance['show_thumb'] ), 'on'); ?> id="<?php echo esc_attr( $this->get_field_id('show_thumb') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_thumb') ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id('show_thumb') ); ?>"><?php _e('Show Thumbnail Image', 'zozothemes'); ?></label>
		</p>	
			
	<?php }
}

function zozo_popular_posts_load()
{
	register_widget('Zozo_Popular_Posts_Widget');
}

add_action('widgets_init', 'zozo_popular_posts_load');

?>