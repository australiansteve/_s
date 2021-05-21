// import { lodash } from 'lodash'
var ld = require( 'lodash' );
var _ = ld.noConflict();

//customizer.js is only done in backend so not including in main
import './navigation.js'
import './foundation.js'

jQuery( document ).ready(function() {

	window.addEventListener('resize', calculateSectionMinusHeaderHeight);
	window.addEventListener('resize', triggerFoundationEqualizer);
	calculateSectionMinusHeaderHeight();
	Foundation.addToJquery(jQuery);

	padLearnerStoriesOverlay();
	window.addEventListener('resize', padLearnerStoriesOverlay);	

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

var padLearnerStoriesOverlay = _.debounce(function() {
	jQuery(".overlay").each(function(){
	    var quoteHeight = jQuery(this).find(".feature-quote").outerHeight();
	    var adjustmentHeight = (jQuery(this).outerHeight() - quoteHeight - 100);
	    console.log(jQuery(this).outerHeight());
	    console.log(quoteHeight);
	    console.log(adjustmentHeight);

	    jQuery(this).css("bottom", (adjustmentHeight * -1) + "px");

	    	console.log(screen.width);
	    if (screen.width >= 640) {
	    	jQuery(this).parents("article.category-learner-spotlight").css("padding-bottom", (adjustmentHeight < 100 ) ? 100 : adjustmentHeight + "px");
	    }
	    else {
	    	jQuery(this).parents("article.category-learner-spotlight").css("padding-bottom", "0px");
	    }
		
	});
}, 250 );

jQuery(".off-canvas-top").on('click', function(e) {
	e.preventDefault();
});

var triggerFoundationEqualizer = _.debounce(function (groups) {
	if (jQuery("[data-equalize-by-row]").length) {
		new Foundation.Equalizer(jQuery("[data-equalize-by-row]")).getHeightsByRow(resetHeights);
	}
}, 250);

function resetHeights(groups) {
	jQuery('[data-equalize-by-row]').foundation('applyHeightByRow', groups);
}
