( function( api ) {

	// Extends our custom "ample-business" section.
	api.sectionConstructor['ample-business'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
