<?php
class Zozo_Category_Posts_Widget extends WP_Widget {

	function Zozo_Category_Posts_Widget()
	{
		/* Widget settings. */
		$widget_options = array('classname' => 'zozo_category_posts_widget', 'description' => 'Displays category posts.');
		$control_options = array('id_base' => 'zozo_category_posts-widget');
		
		/* Create the widget. */
		parent::__construct('zozo_category_posts-widget', 'Category Posts', $widget_options, $control_options);
	}

	function widget($args, $instance)
	{
		global $zozo_options, $post;

		extract($args);

		$categories = absint($instance['categories']) ? $instance['categories'] : '';
		$posts_count = absint($instance['posts_count']) ? $instance['posts_count'] : 3;
		$show_button = $instance['show_button'];
		$button_text = !empty($instance['button_text']) ? $instance['button_text'] : 'View All';
		$title = apply_filters('widget_title', $instance['title']);

		echo wp_kses( $before_widget, zozo_expanded_allowed_tags() );
		
		if($title) {
			echo wp_kses( $before_title . $title . $after_title, zozo_expanded_allowed_tags() );
		}
		
		$args = array(
			'posts_per_page' 		=> $posts_count,
			'orderby' 		 		=> 'date',
			'order' 		 		=> 'DESC',
			'cat'			 		=> $categories,
			'ignore_sticky_posts' 	=> 1
		);
		
		$ct_posts = new WP_Query($args);
		if( $ct_posts->have_posts() ): ?>
		
			<div id="zozo_category_posts_widget" class="zozo-category-posts">
				<ul class="category-posts-menu list-unstyled clearfix">
				<?php while( $ct_posts->have_posts( )): $ct_posts->the_post(); ?>
					
					<li class="cat-posts-item">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
					</li>
			
				<?php endwhile; ?>
				</ul>
				<?php if( $show_button == 'on' ) { 
					$category_link = get_category_link( $categories ); ?>
					<a href="<?php echo esc_url( $category_link ); ?>" class="btn btn-posts" role="button"><?php echo esc_attr( $button_text ); ?></a>
				<?php } ?>
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
		$instance['show_button'] = $new_instance['show_button'];
		$instance['button_text'] = $new_instance['button_text'];
		
		return $instance;
	}

	function form($instance)
	{
		$defaults = array('categories' => '', 'title' => '', 'posts_count' => '', 'show_button' => '', 'button_text' => '');
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
			<input class="checkbox" type="checkbox" <?php checked(esc_attr( $instance['show_button'] ), 'on'); ?> id="<?php echo esc_attr( $this->get_field_id('show_button') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_button') ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id('show_button') ); ?>"><?php _e('Show Button', 'zozothemes'); ?></label>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('button_text') ); ?>"><?php _e('Button Text:', 'zozothemes'); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('button_text') ); ?>" name="<?php echo esc_attr( $this->get_field_name('button_text') ); ?>" value="<?php echo esc_attr( $instance['button_text'] ); ?>" />
		</p>
			
	<?php }
}

function zozo_category_posts_load()
{
	register_widget('Zozo_Category_Posts_Widget');
}

add_action('widgets_init', 'zozo_category_posts_load');

?>