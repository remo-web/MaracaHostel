<?php
// loads the shortcodes class, wordpress is loaded with it
require_once( 'shortcodes.class.php' );

// get popup type
$popup = trim( $_GET['popup'] );
$shortcode = new zozo_shortcodes( $popup );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head></head>
<body>
<div id="zozo-popup">
	<div id="zozo-shortcode-wrap">		
		<div id="zozo-sc-form-wrap">
			
			<?php
			$select_shortcode = array(
					'select' 			=> 'Choose a Shortcode',
					'accordion' 		=> 'Accordion',
					'alert' 			=> 'Alert',
					'blockquotes' 		=> 'Blockquotes',
					'bootcarousel' 		=> 'Bootstrap Carousel',					
					'button' 			=> 'Button',
					'circle_counters' 	=> 'Circle Counters',
					'columns' 			=> 'Columns',
					'contact_form' 		=> 'Contact Form',
					'client_slider' 	=> 'Client Slider',
					'counters' 			=> 'Counters',
					'day_counter'		=> 'Day Counter',
					'dropcap' 			=> 'Dropcap',
					'fontawesome' 		=> 'Font Awesome',
					'fullwidth' 		=> 'Fullwidth Box',
					'highlight' 		=> 'Highlight',
					'html_block' 		=> 'HTML Block',
					'allicons' 			=> 'Icons',
					'imageframe' 		=> 'Image Frame',
					'jumbotron' 		=> 'Jumbotron',
					'leadpara' 			=> 'Lead Paragraph',
					'listitem' 			=> 'List Item',
					'modal' 			=> 'Modals',
					'pageheader' 		=> 'Page Header',
					'popover' 			=> 'Popover',
					'progressbar' 		=> 'Progress Bar',			
					'soundcloud' 		=> 'SoundCloud',
					'tabs' 				=> 'Tabs',
					'table' 			=> 'Table',
					'tooltip' 			=> 'Tooltip',
					'vimeo' 			=> 'Vimeo',
					'youtube' 			=> 'Youtube',
			);
			?>
			<table id="zozo-sc-form-table" class="zozo-shortcode-selector">
				<tbody>
					<tr class="form-row">
						<td class="label">Choose Shortcode</td>
						<td class="field">
							<div class="zozo-form-select-field">
							<select name="zozo_select_shortcode" id="zozo_select_shortcode" class="zozo-form-select zozo-input">
								<?php foreach($select_shortcode as $shortcode_key => $shortcode_value): ?>
									<?php if($shortcode_key == $popup): $selected = 'selected="selected"'; else: $selected = ''; endif;
									echo '<option value="'.esc_attr( $shortcode_key ).'" '.$selected.'>'.esc_attr( $shortcode_value ) .'</option>'; ?>
								<?php endforeach; ?>
							</select>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			
			<form method="post" id="zozo-sc-form">
			
				<?php if( $shortcode->popup_title ) { ?>
					<div id="zozo-sc-form-head">				
						<?php echo wp_kses( $shortcode->popup_title, zozo_expanded_allowed_tags() ); ?>
					</div>
					<!-- #zozo-sc-form-head -->				
				<?php }
				
				echo '<table id="zozo-sc-form-table">
					' .$shortcode->output .'
					<tbody class="zozo-sc-form-button">
						<tr class="form-row">';
						if( ! $shortcode->has_child ) :
							echo '<td class="label">&nbsp;</td>';
						endif;
							echo '<td class="field"><a href="#" class="button-primary zozo-insert">Insert Shortcode</a></td>
						</tr>
					</tbody>
				</table>'; ?>
				<!-- /#zozo-sc-form-table -->
				
			</form>
			<!-- /#zozo-sc-form -->
		
		</div>
		<!-- /#zozo-sc-form-wrap -->
		
		<div class="clear"></div>
		
	</div>
	<!-- /#zozo-shortcode-wrap -->

</div>
<!-- /#zozo-popup -->

</body>
</html>