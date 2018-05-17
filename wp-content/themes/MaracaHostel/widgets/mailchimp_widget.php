<?php
class Zozo_Mailchimp_Form_Widget extends WP_Widget {	
	
	private $api_key = '';
	private $api_url = '';
	
	function Zozo_Mailchimp_Form_Widget()
	{
		/* Widget settings. */
		$widget_options = array('classname' => 'zozo_mailchimp_form_widget', 'description' => 'Displays subscribe form for Mailchimp Lists.');
		$control_options = array('id_base' => 'zozo_mailchimp_form_widget-widget');
		
		/* Create the widget. */
		parent::__construct('zozo_mailchimp_form_widget-widget', 'Mailchimp Subscribe Form', $widget_options, $control_options);
	
	}
	
	function widget($args, $instance)
	{
		extract($args);
		
		$description = !empty($instance['description']) ? $instance['description'] : __( 'Subscribe to Our Newsletter to get Important News, Amazing Offers & Inside Scoops:', 'zozothemes' );
		$mailchimp_list = $instance['mailchimp_list'];
		$title = apply_filters('widget_title', $instance['title']);
		static $zozo_mailchimp_id = 1;
		
		echo wp_kses( $before_widget, zozo_expanded_allowed_tags() );
		
		if($title) {
			echo wp_kses( $before_title . $title . $after_title, zozo_expanded_allowed_tags() );
		}
		
		if( $description ) {
			echo '<p class="subscribe-desc">' . $description . '</p>';
		}
				
		if( $mailchimp_list != '' ) { 
		
			wp_enqueue_script( 'zozo-bootstrap-validator-js' ); ?>
			
			<div id="mc-subscribe-widget<?php echo esc_attr( $zozo_mailchimp_id ); ?>" class="zozo-mc-form subscribe-form mailchimp-form-wrapper">
				<p class="mailchimp-msg zozo-form-success"></p>
				
				<form action="<?php echo esc_url( zozo_get_current_url() ); ?>" id="zozo-mailchimp-form-widget<?php echo esc_attr( $zozo_mailchimp_id ); ?>" name="zozo-mailchimp-form-widget<?php echo esc_attr( $zozo_mailchimp_id ); ?>" class="zozo-mailchimp-form">
					
					<div class="form-group mailchimp-email zozo-form-group-addon">
						<div class="input-group">
							<input type="email" placeholder="@yourmail.com" class="zozo-subscribe input-email form-control" name="subscribe_email">
							<div class="input-group-btn">
								<button type="submit" id="zozo_mc_form_widget_submit" name="zozo_mc_submit" class="btn mc-subscribe zozo-submit"><i class="glyphicon glyphicon-arrow-right"></i></button>
							</div>
						</div>
					</div>
					
					<input type="hidden" id="zozo_mc_form_widget_list" name="zozo_mc_form_list" value="<?php echo esc_attr( $mailchimp_list ); ?>">															
				</form>
			</div>

		<?php }
		
		$zozo_mailchimp_id++; ?>
		
		<?php echo wp_kses( $after_widget, zozo_expanded_allowed_tags() );
	}
		
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['description'] = $new_instance['description'];
		$instance['mailchimp_list'] = $new_instance['mailchimp_list'];
		
		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => '', 'description' => '', 'mailchimp_list' => '');
		$instance = wp_parse_args((array) $instance, $defaults);
		
		$lists = get_mailing_lists_format(); ?>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php _e('Title:', 'zozothemes'); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('description') ); ?>"><?php _e('Description:', 'zozothemes'); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('description') ); ?>" name="<?php echo esc_attr( $this->get_field_name('description') ); ?>" value="<?php echo esc_attr( $instance['description'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('mailchimp_list') ); ?>"><?php _e( 'Choose Mailing List:', 'zozothemes' ); ?></label>			
			<select id="<?php echo esc_attr( $this->get_field_id('mailchimp_list') ); ?>" name="<?php echo esc_attr( $this->get_field_name('mailchimp_list') ); ?>">
				<?php foreach( $lists as $key => $value ) { ?>
					<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $instance['mailchimp_list'], $value ); ?>><?php echo esc_attr( $key ); ?></option>
				<?php } ?>
			</select>
		</p>
	<?php }
}

function zozo_mailchimp_form_load()
{
	register_widget('Zozo_Mailchimp_Form_Widget');
}

add_action('widgets_init', 'zozo_mailchimp_form_load');
?>