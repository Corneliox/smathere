( function( api ) {

	// Extends our custom "green-agro-landscaping" section.
	api.sectionConstructor['green-agro-landscaping'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );