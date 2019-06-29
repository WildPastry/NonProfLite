// Customizer Controls
(function(exports, $) {
	'use strict';

	var api = wp.customize,
		OldPreviewer;

	// Custom Customizer Previewer class (attached to the Customize API)
	api.myCustomizerPreviewer = {
		// Init
		init: function() {
			var self = this; // Store a reference to "this" in case callback functions need to reference it

			// get slides
			var slide1 = document.getElementById('customize-control-featured_slide_1_control');
			var slide2 = document.getElementById('customize-control-featured_slide_2_control');
			var slide3 = document.getElementById('customize-control-featured_slide_3_control');
			var slide4 = document.getElementById('customize-control-featured_slide_4_control');
			var slide5 = document.getElementById('customize-control-featured_slide_5_control');
			var slide6 = document.getElementById('customize-control-featured_slide_6_control');
			var slide7 = document.getElementById('customize-control-featured_slide_7_control');
			var slide8 = document.getElementById('customize-control-featured_slide_8_control');
			var slide9 = document.getElementById('customize-control-featured_slide_9_control');
			var slide10 = document.getElementById('customize-control-featured_slide_10_control');

			// for (var i = 1; i < 10; i++) {
			// console.log(slide + i);
			// }

			// Listen to the "my-custom-event" event has been triggered from the Previewer
			this.preview.bind('my-custom-event', function(data) {
				console.log(data);
				console.log(data.slideCount);

				// show and hide slides based on count
				if (data.slideCount == '2') {
					$(slide1).show();
					$(slide2).show();
					$(slide3).hide();
					$(slide4).hide();
					$(slide5).hide();
					$(slide6).hide();
					$(slide7).hide();
					$(slide8).hide();
					$(slide9).hide();
					$(slide10).hide();
				}
				if (data.slideCount == '3') {
					$(slide1).show();
					$(slide2).show();
					$(slide3).show();
					$(slide4).hide();
					$(slide5).hide();
					$(slide6).hide();
					$(slide7).hide();
					$(slide8).hide();
					$(slide9).hide();
					$(slide10).hide();
				}
				if (data.slideCount == '4') {
					$(slide1).show();
					$(slide2).show();
					$(slide3).show();
					$(slide4).show();
					$(slide5).hide();
					$(slide6).hide();
					$(slide7).hide();
					$(slide8).hide();
					$(slide9).hide();
					$(slide10).hide();
				}
				if (data.slideCount == '5') {
					$(slide1).show();
					$(slide2).show();
					$(slide3).show();
					$(slide4).show();
					$(slide5).show();
					$(slide6).hide();
					$(slide7).hide();
					$(slide8).hide();
					$(slide9).hide();
					$(slide10).hide();
				}
				if (data.slideCount == '6') {
					$(slide1).show();
					$(slide2).show();
					$(slide3).show();
					$(slide4).show();
					$(slide5).show();
					$(slide6).show();
					$(slide7).hide();
					$(slide8).hide();
					$(slide9).hide();
					$(slide10).hide();
				}
				if (data.slideCount == '7') {
					$(slide1).show();
					$(slide2).show();
					$(slide3).show();
					$(slide4).show();
					$(slide5).show();
					$(slide6).show();
					$(slide7).show();
					$(slide8).hide();
					$(slide9).hide();
					$(slide10).hide();
				}
				if (data.slideCount == '8') {
					$(slide1).show();
					$(slide2).show();
					$(slide3).show();
					$(slide4).show();
					$(slide5).show();
					$(slide6).show();
					$(slide7).show();
					$(slide8).show();
					$(slide9).hide();
					$(slide10).hide();
				}
				if (data.slideCount == '9') {
					$(slide1).show();
					$(slide2).show();
					$(slide3).show();
					$(slide4).show();
					$(slide5).show();
					$(slide6).show();
					$(slide7).show();
					$(slide8).show();
					$(slide9).show();
					$(slide10).hide();
				}
				if (data.slideCount == '10') {
					$(slide1).show();
					$(slide2).show();
					$(slide3).show();
					$(slide4).show();
					$(slide5).show();
					$(slide6).show();
					$(slide7).show();
					$(slide8).show();
					$(slide9).show();
					$(slide10).show();
				}
			});
		},
	};

	// Capture preview instance
	OldPreviewer = api.Previewer;
	api.Previewer = OldPreviewer.extend({
		initialize: function(params, options) {
			// Store a reference to the Previewer
			api.myCustomizerPreviewer.preview = this;

			// Call the old Previewer's initialize function
			OldPreviewer.prototype.initialize.call(this, params, options);
		},
	});

	// Document Ready
	$(function() {
		// Initialize our Previewer
		api.myCustomizerPreviewer.init();
	});
})(wp, jQuery);
