<?php
class Zozo_Counters_Widget extends WP_Widget {
	
	function Zozo_Counters_Widget()
	{				
		/* Widget settings. */
		$widget_options = array('classname' => 'zozo_counters_widget', 'description' => 'Display counters.');
		$control_options = array('id_base' => 'zozo_counters_widget-widget');
		
		/* Create the widget. */
		parent::__construct('zozo_counters_widget-widget', 'Counters', $widget_options, $control_options);
	
	}	

	function widget($args, $instance)
	{
		extract($args);
		
		$counter_label_1 = !empty($instance['counter_label_1']) ? $instance['counter_label_1'] : __('Total Downloads : ', 'zozothemes' );
		$counter_value_1 = $instance['counter_value_1'];
		$counter_label_2 = !empty($instance['counter_label_2']) ? $instance['counter_label_2'] : __('Happy Clients : ', 'zozothemes' );
		$counter_value_2 = $instance['counter_value_2'];
		
		$title = apply_filters('widget_title', $instance['title']);
		
		echo wp_kses( $before_widget, zozo_expanded_allowed_tags() );
		
		if($title) {
			echo wp_kses( $before_title . $title . $after_title, zozo_expanded_allowed_tags() );
		} ?>
		
		<?php if( isset( $counter_value_1 ) && $counter_value_1 != '' ) { ?>
			<div class="counter-widget-wrapper zozo-counter-wrapper">
				<div class="zozo-count-number" data-count="<?php echo esc_attr( $counter_value_1 ); ?>">
					<h3 class="zozo-counter-count"><?php echo esc_html( $counter_label_1 ); ?><span class="counter"></span></h3>
				</div>
			</div>
		<?php } ?>
		
		<?php if( isset( $counter_value_2 ) && $counter_value_2 != '' ) { ?>
			<div class="counter-widget-wrapper zozo-counter-wrapper">
				<div class="zozo-count-number" data-count="<?php echo esc_attr( $counter_value_2 ); ?>">
					<h3 class="zozo-counter-count"><?php echo esc_html( $counter_label_2 ); ?><span class="counter"></span></h3>
				</div>
			</div>
		<?php } ?>
		
		<?php echo wp_kses( $after_widget, zozo_expanded_allowed_tags() );
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] 			 = $new_instance['title'];
		$instance['counter_label_1'] = $new_instance['counter_label_1'];
		$instance['counter_value_1'] = $new_instance['counter_value_1'];
		$instance['counter_label_2'] = $new_instance['counter_label_2'];
		$instance['counter_value_2'] = $new_instance['counter_value_2'];
		
		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => '', 'counter_label_1' => '', 'counter_value_1' => '', 'counter_label_2' => '', 'counter_value_2' => '');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php _e('Title:', 'zozothemes'); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('counter_label_1') ); ?>"><?php _e('Counter Label 1:', 'zozothemes'); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('counter_label_1') ); ?>" name="<?php echo esc_attr( $this->get_field_name('counter_label_1') ); ?>" value="<?php echo esc_attr( $instance['counter_label_1'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('counter_value_1') ); ?>"><?php _e('Counter Value 1:', 'zozothemes'); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('counter_value_1') ); ?>" name="<?php echo esc_attr( $this->get_field_name('counter_value_1') ); ?>" value="<?php echo esc_attr( $instance['counter_value_1'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('counter_label_2') ); ?>"><?php _e('Counter Label 2:', 'zozothemes'); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('counter_label_2') ); ?>" name="<?php echo esc_attr( $this->get_field_name('counter_label_2') ); ?>" value="<?php echo esc_attr( $instance['counter_label_2'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('counter_value_2') ); ?>"><?php _e('Counter Value 2:', 'zozothemes'); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('counter_value_2') ); ?>" name="<?php echo esc_attr( $this->get_field_name('counter_value_2') ); ?>" value="<?php echo esc_attr( $instance['counter_value_2'] ); ?>" />
		</p>
	<?php }
}

function zozo_counters_load()
{
	register_widget('Zozo_Counters_Widget');
}

add_action('widgets_init', 'zozo_counters_load');
?>