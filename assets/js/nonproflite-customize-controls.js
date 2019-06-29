// Customizer Controls
( function ( exports, $ ) {
	"use strict";

	var api = wp.customize, OldPreviewer;

	// Custom Customizer Previewer class (attached to the Customize API)
	api.myCustomizerPreviewer = {
		// Init
		init: function () {
			var self = this; // Store a reference to "this" in case callback functions need to reference it

			// Listen to the "my-custom-event" event has been triggered from the Previewer
			this.preview.bind( 'my-custom-event', function( data ) {

				console.log( data );
			} );
		}
	};

// Capture preview instance
	OldPreviewer = api.Previewer;
	api.Previewer = OldPreviewer.extend( {
		initialize: function( params, options ) {

			// Store a reference to the Previewer
			api.myCustomizerPreviewer.preview = this;

			// Call the old Previewer's initialize function
			OldPreviewer.prototype.initialize.call( this, params, options );
		}
	} );

	// Document Ready
	$( function() {
		// Initialize our Previewer
		api.myCustomizerPreviewer.init();
	} );
} )( wp, jQuery );

// function filterPrimary() {
// 	$(function () {
// 			$(".secondary").hide();
// 	});
// 	$(function () {
// 			$(".primary").show();
// 	});
// 	console.log(document.getElementsByClassName('.primary'));
// }
// $(test).hide();
