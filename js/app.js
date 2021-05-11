import { lodash } from 'lodash'

//customizer.js is only done in backend so not including in main
import './navigation.js'
import './foundation.js'

jQuery( document ).ready(function() {

	window.addEventListener('resize', calculateSectionMinusHeaderHeight);
	window.addEventListener('resize', triggerFoundationEqualizer);
	calculateSectionMinusHeaderHeight();
	Foundation.addToJquery(jQuery);

	setMarqueeSpeed();
	window.addEventListener('resize', setMarqueeSpeed);
	
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
		jQuery(this).css("min-height", "calc("+maxChildHeight + "px + 4rem)");

	});
}, 250);

var setMarqueeSpeed = _.debounce(function() {
	if (jQuery("#news-ticker .container").length) {
		var containerWidth = jQuery("#news-ticker .container")[0].offsetWidth;
		var windowWidth = window.innerWidth;
		jQuery("#news-ticker .container").css("animation-duration", ((containerWidth/windowWidth)*10)+"s");
	}
}, 250);

jQuery(".off-canvas-top").on('click', function(e) {
	e.preventDefault();
});

jQuery(".reveal-more-button").on('click', function(e) {
	e.preventDefault();
	jQuery(".hidden-paragraph").css("max-height", "500px");
	jQuery(this).css('display', 'none');
});

var triggerFoundationEqualizer = _.debounce(function (groups) {
	if (jQuery("[data-equalize-by-row]").length) {
		new Foundation.Equalizer(jQuery("[data-equalize-by-row]")).getHeightsByRow(resetHeights);
	}
}, 250);


function resetHeights(groups) {
	jQuery('[data-equalize-by-row]').foundation('applyHeightByRow', groups);
}
