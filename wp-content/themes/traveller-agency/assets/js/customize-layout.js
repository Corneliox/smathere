/*
** Scripts within the customizer controls window.
*/

(function( $ ) {
	wp.customize.bind( 'ready', function() {

	/*
	** Reusable Functions
	*/
		var optPrefix = '#customize-control-traveller_agency_options-';
		
		// Label
		function traveller_agency_customizer_label( id, title ) {

			// Site Identity

			if ( id === 'custom_logo' || id === 'site_icon' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-traveller_agency_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// General Setting

			if ( id === 'traveller_agency_scroll_hide' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-traveller_agency_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Colors

			if ( id === 'traveller_agency_theme_color' || id === 'background_color' || id === 'background_image' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-traveller_agency_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Header Image

			if ( id === 'header_image' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-traveller_agency_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			//  Header

			if ( id === 'traveller_agency_phone' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-traveller_agency_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Slider

			if ( id === 'traveller_agency_top_slider_page1' || id === 'traveller_agency_email_text' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-traveller_agency_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Best Destination

			if ( id === 'traveller_agency_best_destination_title' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-traveller_agency_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Footer

			if ( id === 'traveller_agency_footer_text_setting' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-traveller_agency_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}
			
		}


	/*
	** Tabs
	*/

	    // Site Identity
		traveller_agency_customizer_label( 'custom_logo', 'Logo Setup' );
		traveller_agency_customizer_label( 'site_icon', 'Favicon' );

		// General Setting
		traveller_agency_customizer_label( 'traveller_agency_scroll_hide', 'Scroll To Top' );

		// Colors
		traveller_agency_customizer_label( 'traveller_agency_theme_color', 'Theme Color' );
		traveller_agency_customizer_label( 'background_color', 'Colors' );
		traveller_agency_customizer_label( 'background_image', 'Image' );

		//Header Image
		traveller_agency_customizer_label( 'header_image', 'Header Image' );

		// Header
		traveller_agency_customizer_label( 'traveller_agency_phone', 'Phone' );

		//Slider
		traveller_agency_customizer_label( 'traveller_agency_top_slider_page1', 'Slider' );
		traveller_agency_customizer_label( 'traveller_agency_email_text', 'Email' );
		
		// Best Destination
		traveller_agency_customizer_label( 'traveller_agency_best_destination_title', 'Best Destination' );

		//Footer
		traveller_agency_customizer_label( 'traveller_agency_footer_text_setting', 'Footer' );
	

	}); // wp.customize ready

})( jQuery );
