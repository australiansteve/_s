//customizer.js is only done in backend so not including in main
import './navigation.js'
import './foundation.js'


jQuery( document ).ready(function() {

	window.addEventListener('resize', calculateSectionMinusHeaderHeight);
	calculateSectionMinusHeaderHeight();
	
});

var calculateSectionMinusHeaderHeight = _.debounce(function () {
	jQuery(".full-height-minus-header").each(function() {
		var headerHeight = jQuery("header").outerHeight();
		var sectionHeight = "calc(100vh - " + headerHeight + "px)";
		jQuery(this).css("height", sectionHeight);

		var maxChildHeight = 0;
		jQuery(this).find(".section-content div.cell").each(function() {
			if (jQuery(this).outerHeight() > maxChildHeight) {
				maxChildHeight = jQuery(this).outerHeight();
			}
		});
		jQuery(this).css("min-height", maxChildHeight + "px");

	});
}, 250);
