<?php
class Zozo_Call_To_Action_Widget extends WP_Widget {

	function Zozo_Call_To_Action_Widget()
	{
		/* Widget settings. */
		$widget_options = array('classname' => 'zozo_call_to_action_widget', 'description' => 'Displays text and button with different style.');
		$control_options = array('id_base' => 'zozo_call_to_action-widget');
		
		/* Create the widget. */
		parent::__construct('zozo_call_to_action-widget', 'Call To Action', $widget_options, $control_options);
	}

	function widget($args, $instance)
	{
		extract($args);

		$full_width = $instance['full_width'];
		$text = $instance['text'];
		$sub_text = $instance['sub_text'];
		$show_button = $instance['show_button'];
		$button_text = $instance['button_text'];
		$button_link = $instance['button_link'];
		$button_target = $instance['button_target'];
		$title = apply_filters('widget_title', $instance['title']);

		echo wp_kses($before_widget, zozo_expanded_allowed_tags() );
		
		if($title) {
			echo wp_kses( $before_title . $title . $after_title, zozo_expanded_allowed_tags() );
		}
		
		$text_class = '';
		$button_class = '';
		
		if( $full_width != 'on' && $show_button == 'on' ) {
			$text_class = "call-text-left call-text-col";
			$button_class = "pull-right call-btn-col";
		} else {
			$text_class = "call-text-col";
			$button_class = "call-btn-col";
		}
		?>	
		
		<div id="zozo_call_action_widget" class="zozo-call-action">
			<div class="call-to-action-inner">
				<?php if( $full_width != 'on' && $show_button == 'on' ) { ?>
					<div class="<?php echo esc_attr( $button_class ); ?>">
						<a href="<?php echo esc_url( $button_link ); ?>" target="<?php echo esc_attr( $button_target ); ?>" class="btn btn-call-action" role="button"><?php echo wp_kses_post( $button_text ); ?></a>
					</div>
				<?php } ?>
				
				<div class="<?php echo esc_attr( $text_class ); ?>">
					<h6 class="call-action-text"><?php echo wp_kses_post( $text ); ?></h6>
					<p class="call-action-subtext"><?php echo wp_kses_post( $sub_text ); ?></p>
				</div>
				<?php if( $full_width == 'on' && $show_button == 'on' ) { ?>					
					<div class="<?php echo esc_attr( $button_class ); ?>">
						<a href="<?php echo esc_url( $button_link ); ?>" target="<?php echo esc_attr( $button_target ); ?>" class="btn btn-call-action" role="button"><?php echo wp_kses_post( $button_text ); ?></a>
					</div>
				<?php } ?>
			</div>
		</div>
		
		<?php echo wp_kses( $after_widget, zozo_expanded_allowed_tags() );
	}

	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['full_width'] = $new_instance['full_width'];
		$instance['text'] = $new_instance['text'];
		$instance['sub_text'] = $new_instance['sub_text'];
		$instance['show_button'] = $new_instance['show_button'];
		$instance['button_text'] = $new_instance['button_text'];
		$instance['button_link'] = $new_instance['button_link'];
		$instance['button_target'] = $new_instance['button_target'];
		
		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => '', 'full_width' => '', 'text' => '', 'sub_text' => '', 'show_button' => '', 'button_text' => '', 'button_link' => '', 'button_target' => '');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php _e('Title:', 'zozothemes'); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked(esc_attr( $instance['full_width'] ), 'on'); ?> id="<?php echo esc_attr( $this->get_field_id('full_width') ); ?>" name="<?php echo esc_attr( $this->get_field_name('full_width') ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id('full_width') ); ?>"><?php _e('Full Width', 'zozothemes'); ?></label>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('text') ); ?>"><?php _e('Text:', 'zozothemes'); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('text') ); ?>" name="<?php echo esc_attr( $this->get_field_name('text') ); ?>" value="<?php echo esc_attr( $instance['text'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('sub_text') ); ?>"><?php _e('Sub Title:', 'zozothemes'); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('sub_text') ); ?>" name="<?php echo esc_attr( $this->get_field_name('sub_text') ); ?>" value="<?php echo esc_attr( $instance['sub_text'] ); ?>" />
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked(esc_attr( $instance['show_button'] ), 'on'); ?> id="<?php echo esc_attr( $this->get_field_id('show_button') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_button') ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id('show_button') ); ?>"><?php _e('Show Button', 'zozothemes'); ?></label>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('button_text') ); ?>"><?php _e('Button Text:', 'zozothemes'); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('button_text') ); ?>" name="<?php echo esc_attr( $this->get_field_name('button_text') ); ?>" value="<?php echo esc_attr( $instance['button_text'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('button_link') ); ?>"><?php _e('Button Link:', 'zozothemes'); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('button_link') ); ?>" name="<?php echo esc_attr( $this->get_field_name('button_link') ); ?>" value="<?php echo esc_attr( $instance['button_link'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('button_target') ); ?>"><?php _e('Button Target:', 'zozothemes'); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id('button_target' )); ?>" name="<?php echo esc_attr( $this->get_field_name('button_target') ); ?>" class="widefat" style="width:100%;">
				<option value="_blank" <?php echo selected(esc_attr($instance['button_target']), '_blank', false); ?>><?php _e('Open in a New Tab', 'zozothemes'); ?></option>
				<option value="_self" <?php echo selected(esc_attr($instance['button_target']), '_self', false); ?>><?php _e('Open in a Same Tab', 'zozothemes'); ?></option>				
			</select>
		</p>
	<?php }
}

function zozo_call_to_action_load()
{
	register_widget('Zozo_Call_To_Action_Widget');
}

add_action('widgets_init', 'zozo_call_to_action_load');
?>