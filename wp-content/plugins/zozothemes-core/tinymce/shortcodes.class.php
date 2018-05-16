<?php

// load wordpress
require_once('get_wp.php');

class zozo_shortcodes
{
	var	$conf;
	var	$popup;
	var	$params;
	var	$shortcode;
	var $cparams;
	var $cshortcode;
	var $popup_title;
	var $no_preview;
	var $has_child;
	var	$output;
	var	$errors;

	// --------------------------------------------------------------------------

	function __construct( $popup )
	{
		if( file_exists( dirname(__FILE__) . '/config.php' ) )
		{
			$this->conf = dirname(__FILE__) . '/config.php';
			$this->popup = $popup;
			
			$this->formate_shortcode();
		}
		else
		{
			$this->append_error('Config file does not exist');
		}
	}
	
	// --------------------------------------------------------------------------
	
	function formate_shortcode()
	{
		// get config file
		require_once( $this->conf );
		
		if( isset( $zozo_shortcodes[$this->popup]['child_shortcode'] ) )
			$this->has_child = true;
		
		if( isset( $zozo_shortcodes ) && is_array( $zozo_shortcodes ) )
		{
			// get shortcode config stuff
			$this->params = $zozo_shortcodes[$this->popup]['params'];
			$this->shortcode = $zozo_shortcodes[$this->popup]['shortcode'];
			$this->popup_title = $zozo_shortcodes[$this->popup]['popup_title'];
			
			// adds stuff for js use			
			$this->append_output( "\n" . '<div id="_zozo_shortcode" class="hidden">' . $this->shortcode . '</div>' );
			$this->append_output( "\n" . '<div id="_zozo_popup" class="hidden">' . $this->popup . '</div>' );
			
			if( isset( $zozo_shortcodes[$this->popup]['no_preview'] ) && $zozo_shortcodes[$this->popup]['no_preview'] )
			{
				//$this->append_output( "\n" . '<div id="_zozo_preview" class="hidden">false</div>' );
				$this->no_preview = true;		
			}
			
			// filters and excutes params
			foreach( $this->params as $pkey => $param )
			{
				// prefix the fields names and ids with zozo_
				$pkey = 'zozo_' . $pkey;
				
				// popup form row start
				$row_start  = '<tbody>' . "\n";
				$row_start .= '<tr class="form-row">' . "\n";
				$row_start .= '<td class="label">' . $param['label'] . '</td>' . "\n";
				$row_start .= '<td class="field">' . "\n";
				
				// popup form row end
				$row_end	= '<span class="zozo-form-desc">' . $param['desc'] . '</span>' . "\n";
				$row_end   .= '</td>' . "\n";
				$row_end   .= '</tr>' . "\n";					
				$row_end   .= '</tbody>' . "\n";
				
				switch( $param['type'] )
				{
					case 'text' :
						
						// prepare
						$output  = $row_start;
						$output .= '<input type="text" class="zozo-form-text zozo-input" name="' . $pkey . '" id="' . $pkey . '" value="' . $param['std'] . '" />' . "\n";
						$output .= $row_end;
						
						// append
						$this->append_output( $output );
						
						break;
						
					case 'textarea' :
						
						// prepare
						$output  = $row_start;
						$output .= '<textarea rows="10" cols="30" name="' . $pkey . '" id="' . $pkey . '" class="zozo-form-textarea zozo-input">' . $param['std'] . '</textarea>' . "\n";
						$output .= $row_end;
						
						// append
						$this->append_output( $output );
						
						break;
						
					case 'select' :
						
						// prepare
						$output  = $row_start;
						$output .= '<select name="' . $pkey . '" id="' . $pkey . '" class="zozo-form-select zozo-input">' . "\n";
						
						foreach( $param['options'] as $value => $option )
						{
							$output .= '<option value="' . $value . '">' . $option . '</option>' . "\n";
						}
						
						$output .= '</select>' . "\n";
						$output .= $row_end;
						
						// append
						$this->append_output( $output );
						
						break;
						
					case 'multiselect' :
						
						// prepare
						$output  = $row_start;
						$output .= '<select multiple="multiple" name="' . $pkey . '" id="' . $pkey . '" class="zozo-form-multi-select zozo-input">' . "\n";
						
						foreach( $param['options'] as $value => $option )
						{
							$output .= '<option value="' . $value . '">' . $option . '</option>' . "\n";
						}
						
						$output .= '</select>' . "\n";
						$output .= $row_end;
						
						// append
						$this->append_output( $output );
						
						break;
						
					case 'checkbox' :
						
						// prepare
						$output  = $row_start;
						$output .= '<label for="' . $pkey . '" class="zozo-form-checkbox">' . "\n";
						$output .= '<input type="checkbox" class="zozo-input" name="' . $pkey . '" id="' . $pkey . '" ' . ( $param['std'] ? 'checked' : '' ) . ' />' . "\n";
						$output .= ' ' . $param['checkbox_text'] . '</label>' . "\n";
						$output .= $row_end;
						
						// append
						$this->append_output( $output );
						
						break;
						
					case 'iconpicker' :

						// prepare
						$output  = $row_start;

						$output .= '<div class="iconpicker">';
						foreach( $param['options'] as $value => $option ) {
							$output .= '<i class="' . $value . ' icon-tooltip" data-toggle="tooltip" data-placement="top" data-iconclass="' . $value . '" title="' . $option . '"></i>';
						}
						$output .= '</div>';

						if(!isset($param['std'])) {
							$param['std'] = '';
						}

						$output .= '<input type="hidden" class="zozo-form-text zozo-input" name="' . $pkey . '" id="' . $pkey . '" value="' . $param['std'] . '" />' . "\n";
						$output .= $row_end;

						// append
						$this->append_output( $output );

						break;
						
					case 'lineiconpicker' :

						// prepare
						$output  = $row_start;

						$output .= '<div class="line-icons iconpicker">';
						foreach( $param['options'] as $value => $option ) {
							$output .= '<i class="simple-icon ' . $value . ' icon-tooltip" data-toggle="tooltip" data-placement="top" title="' . $value . '"></i>';
						}
						$output .= '</div>';

						if(!isset($param['std'])) {
							$param['std'] = '';
						}

						$output .= '<input type="hidden" class="zozo-form-text zozo-input" name="' . $pkey . '" id="' . $pkey . '" value="' . $param['std'] . '" />' . "\n";
						$output .= $row_end;

						// append
						$this->append_output( $output );

						break;
						
					case 'colorpicker' :

						if(!isset($param['std'])) {
							$param['std'] = '';
						}

						// prepare
						$output  = $row_start;
						$output .= '<input type="text" class="zozo-form-text zozo-input wp-color-picker-field" name="' . $pkey . '" id="' . $pkey . '" value="' . $param['std'] . '" />' . "\n";
						$output .= $row_end;

						// append
						$this->append_output( $output );

						break;
						
					case 'media' :

						// prepare
						$output  = $row_start;
						$output .= '<div class="zozo-upload-container">';
						$output .= '<img src="" alt="Image" class="uploaded-image" style="display: none;" />';
						$output .= '<input type="hidden" class="zozo-form-text zozo-form-upload zozo-input" name="' . $pkey . '" id="' . $pkey . '" value="' . $param['std'] . '" />' . "\n";
						$output .= '<input class="zozo_upload_button" data-upload="1" type="button" value="Upload" />';
						$output .= '<input class="zozo_remove_button" data-remove="1" type="button" value="Remove" style="display: none;" />';
						$output .= '</div>';
						$output .= $row_end;

						// append
						$this->append_output( $output );

						break;
						
				}
			}
			
			// checks if has a child shortcode
			if( isset( $zozo_shortcodes[$this->popup]['child_shortcode'] ) )
			{
				// set child shortcode
				$this->cparams = $zozo_shortcodes[$this->popup]['child_shortcode']['params'];
				$this->cshortcode = $zozo_shortcodes[$this->popup]['child_shortcode']['shortcode'];
			
				// popup parent form row start
				$prow_start  = '<tbody>' . "\n";
				$prow_start .= '<tr class="form-row has-child">' . "\n";
				$prow_start .= '<td>' . "\n";
				$prow_start .= '<div class="child-clone-rows">' . "\n";
				
				// for js use
				$prow_start .= '<div id="_zozo_cshortcode" data-row="1" class="hidden">' . $this->cshortcode . '</div>' . "\n";
				
				// start the default row
				$prow_start .= '<div class="child-clone-row" data-row="1">' . "\n";
				$prow_start .= '<ul class="child-clone-row-form">' . "\n";
				
				// add $prow_start to output
				$this->append_output( $prow_start );
				
				foreach( $this->cparams as $cpkey => $cparam )
				{
				
					// prefix the fields names and ids with zozo_
					$cpkey = 'zozo_' . $cpkey;
					
					// popup form row start
					$crow_start  = '<li class="child-clone-row-form-row">' . "\n";
					$crow_start .= '<div class="child-clone-row-label">' . "\n";
					$crow_start .= '<label>' . $cparam['label'] . '</label>' . "\n";
					$crow_start .= '</div>' . "\n";
					$crow_start .= '<div class="child-clone-row-field">' . "\n";
					
					// popup form row end
					$crow_end	  = '<span class="child-clone-row-desc">' . $cparam['desc'] . '</span>' . "\n";
					$crow_end   .= '</div>' . "\n";
					$crow_end   .= '</li>' . "\n";
					
					switch( $cparam['type'] )
					{
						case 'text' :
							
							// prepare
							$coutput  = $crow_start;
							$coutput .= '<input type="text" class="zozo-form-text zozo-cinput" name="' . $cpkey . '" id="' . $cpkey . '" value="' . $cparam['std'] . '" />' . "\n";
							$coutput .= $crow_end;
							
							// append
							$this->append_output( $coutput );
							
							break;
							
						case 'textarea' :
							
							// prepare
							$coutput  = $crow_start;
							$coutput .= '<textarea rows="10" cols="30" name="' . $cpkey . '" id="' . $cpkey . '" class="zozo-form-textarea zozo-cinput">' . $cparam['std'] . '</textarea>' . "\n";
							$coutput .= $crow_end;
							
							// append
							$this->append_output( $coutput );
							
							break;
							
						case 'select' :
							
							// prepare
							$coutput  = $crow_start;
							$coutput .= '<select name="' . $cpkey . '" id="' . $cpkey . '" class="zozo-form-select zozo-cinput">' . "\n";
							
							foreach( $cparam['options'] as $value => $option )
							{
								$coutput .= '<option value="' . $value . '">' . $option . '</option>' . "\n";
							}
							
							$coutput .= '</select>' . "\n";
							$coutput .= $crow_end;
							
							// append
							$this->append_output( $coutput );
							
							break;
							
						case 'multiselect' :
						
							// prepare
							$coutput  = $crow_start;
							$coutput .= '<select multiple="multiple" name="' . $cpkey . '" id="' . $cpkey . '" class="zozo-form-multi-select zozo-cinput">' . "\n";
							
							foreach( $cparam['options'] as $value => $option )
							{
								$coutput .= '<option value="' . $value . '">' . $option . '</option>' . "\n";
							}
							
							$coutput .= '</select>' . "\n";
							$coutput .= $crow_end;
							
							// append
							$this->append_output( $coutput );
							
							break;							
							
						case 'checkbox' :
							
							// prepare
							$coutput  = $crow_start;
							$coutput .= '<label for="' . $cpkey . '" class="zozo-form-checkbox">' . "\n";
							$coutput .= '<input type="checkbox" class="zozo-cinput" name="' . $cpkey . '" id="' . $cpkey . '" ' . ( $cparam['std'] ? 'checked' : '' ) . ' />' . "\n";
							$coutput .= ' ' . $cparam['checkbox_text'] . '</label>' . "\n";
							$coutput .= $crow_end;
							
							// append
							$this->append_output( $coutput );
							
							break;
							
						case 'iconpicker' :

							// prepare
							$coutput  = $crow_start;

							$coutput .= '<div class="iconpicker">';
							foreach( $cparam['options'] as $value => $option ) {
								$coutput .= '<i class="' . $value . ' icon-tooltip" data-toggle="tooltip" data-placement="top" data-iconclass="' . $value . '" title="' . $option . '"></i>';
								
							}
							$coutput .= '</div>';

							$coutput .= '<input type="hidden" class="zozo-form-text zozo-cinput" name="' . $cpkey . '" id="' . $cpkey . '" value="' . $cparam['std'] . '" />' . "\n";
							$coutput .= $crow_end;

							// append
							$this->append_output( $coutput );

							break;
							
						case 'lineiconpicker' :

							// prepare
							$coutput  = $crow_start;

							$coutput .= '<div class="line-icons iconpicker">';
							foreach( $cparam['options'] as $value => $option ) {
								$coutput .= '<i class="simple-icon ' . $value . ' icon-tooltip" data-toggle="tooltip" data-placement="top" title="' . $value . '"></i>';
							}
							$coutput .= '</div>';

							$coutput .= '<input type="hidden" class="zozo-form-text zozo-cinput" name="' . $cpkey . '" id="' . $cpkey . '" value="' . $cparam['std'] . '" />' . "\n";
							$coutput .= $crow_end;

							// append
							$this->append_output( $coutput );

							break;
							
						case 'colorpicker' :

							// prepare
							$coutput  = $crow_start;
							$coutput .= '<input type="text" class="zozo-form-text zozo-cinput wp-color-picker-field" name="' . $cpkey . '" id="' . $cpkey . '" value="' . $cparam['std'] . '" />' . "\n";
							$coutput .= $crow_end;

							// append
							$this->append_output( $coutput );

							break;
							
						case 'media' :

							if(!isset($cparam['std'])) {
								$cparam['std'] = '';
							}

							// prepare
							$coutput  = $crow_start;
							$coutput .= '<div class="zozo-upload-container">';
							$coutput .= '<img src="" alt="Image" class="uploaded-image" style="display: none;" />';
							$coutput .= '<input type="hidden" class="zozo-form-text zozo-form-upload zozo-cinput" name="' . $cpkey . '" id="' . $cpkey . '" value="' . $cparam['std'] . '" />' . "\n";
							$coutput .= '<input class="zozo_upload_button" data-upload="1" type="button" value="Upload" />';							
							$coutput .= '<input class="zozo_remove_button" data-remove="1" type="button" value="Remove" style="display: none;" />';
							$coutput .= '</div>';
							$coutput .= $crow_end;

							// append
							$this->append_output( $coutput );

							break;
					}
				}
				
				// popup parent form row end
				$prow_end    = '</ul>' . "\n";		// end .child-clone-row-form
				$prow_end   .= '<a href="#" class="child-clone-row-remove">Remove</a>' . "\n";
				$prow_end   .= '</div>' . "\n";		// end .child-clone-row
				
				
				$prow_end   .= '</div>' . "\n";		// end .child-clone-rows
				$prow_end 	.= '<a href="#" id="form-child-add" class="button-secondary">' . $zozo_shortcodes[$this->popup]['child_shortcode']['clone_button'] . '</a>' . "\n";
				$prow_end   .= '</td>' . "\n";
				$prow_end   .= '</tr>' . "\n";					
				$prow_end   .= '</tbody>' . "\n";
				
				// add $prow_end to output
				$this->append_output( $prow_end );
			}			
		}
	}
	
	// --------------------------------------------------------------------------
	
	function append_output( $output )
	{
		$this->output = $this->output . "\n" . $output;		
	}
	
	// --------------------------------------------------------------------------
	
	function reset_output( $output )
	{
		$this->output = '';
	}
	
	// --------------------------------------------------------------------------
	
	function append_error( $error )
	{
		$this->errors = $this->errors . "\n" . $error;
	}
}

?>