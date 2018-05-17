(function($) {
"use strict";   			
		// create Zozo Shortcodes plugin
		tinymce.PluginManager.add( 'zozo_button', function( editor, url ) {
			
			editor.addCommand("zozoPopup", function ( a, params )
			{
				var popup = 'zozo-sc-generator';

				if(typeof params != 'undefined' && params.identifier) {
					popup = params.identifier;
				}
				
				// load thickbox
				tb_show("Zozo Shortcodes", ajaxurl + "?action=zozothemes_shortcodes_popup&popup=" + popup);
				
				jQuery('#TB_window').hide();
			});
 
			editor.addButton( 'zozo_button', {				
				text: '',
				icon: true,
				image: zozoShortcodes.plugin_folder +"/tinymce/images/icon.png",				
				cmd: 'zozoPopup'			
		  	});
	 
	  }); 
})(jQuery);