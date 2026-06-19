( function( api ) {

	// Extends our custom "vw-kindergarten" section.
	api.sectionConstructor['vw-kindergarten'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );