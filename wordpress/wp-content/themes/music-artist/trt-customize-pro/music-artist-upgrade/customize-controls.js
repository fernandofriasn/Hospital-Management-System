( function( api ) {

	// Extends our custom "music-artist-upgrade" section.
	api.sectionConstructor['music-artist-upgrade'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
