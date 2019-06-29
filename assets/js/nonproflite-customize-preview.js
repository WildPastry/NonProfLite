// Customizer Previewer
( function ( wp, $ ) {
	"use strict";

	// Bail if the customizer isn't initialized
	if ( ! wp || ! wp.customize ) {
		return;
	}

	var api = wp.customize, OldPreview;

	// Custom Customizer Preview class (attached to the Customize API)
	api.myCustomizerPreview = {
		// Init
		init: function () {
			var self = this; // Store a reference to "this"

			// When the previewer is active, the "active" event has been triggered (on load)
			this.preview.bind( 'active', function() {

				// Send "my-custom-event" data over to the Customizer
				self.preview.send( 'my-custom-event', window.myCustomData );
			} );
		}
	};

// Capture preview instance
	OldPreview = api.Preview;
	api.Preview = OldPreview.extend( {
		initialize: function( params, options ) {

			// Store a reference to the Preview
			api.myCustomizerPreview.preview = this;

			// Call the old Preview's initialize function
			OldPreview.prototype.initialize.call( this, params, options );
		}
	} );

	// Document ready
	$( function () {
		// Initialize our Preview
		api.myCustomizerPreview.init();
	} );
} )( window.wp, jQuery );