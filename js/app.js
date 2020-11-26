//customizer.js is only done in backend so not including in main
import './navigation.js'
import './foundation.js'


jQuery( document ).ready(function() {

	window.addEventListener('resize', calculateSectionMinusHeaderHeight);
	window.addEventListener('resize', triggerFoundationEqualizer);
	calculateSectionMinusHeaderHeight();
	Foundation.addToJquery(jQuery);
	spaceHyphensInHeaders();
	
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


var triggerFoundationEqualizer = _.debounce(function (groups) {
	if (jQuery("[data-equalize-by-row]").length) {
		new Foundation.Equalizer(jQuery("[data-equalize-by-row]")).getHeightsByRow(resetHeights);
	}
}, 250);


function resetHeights(groups) {
	jQuery('[data-equalize-by-row]').foundation('applyHeightByRow', groups);
}

function spaceHyphensInHeaders() {

	
	jQuery("h1, h2, h3, h4, h5, h6").each(function() {
		/* Replace mdash with regular dash */
		jQuery(this).html(function (i, html) {
			return html.replace(/–/g, "-");
		});

		/* Surround hypen in -s in span so that inline-block styling happens */
		jQuery(this).html(function (i, html) {
			return html.replace(/-S/gi, "<span class='dash'>-</span>S");
		});
		jQuery(this).html(function (i, html) {
			return html.replace(/E-/gi, "E<span class='dash'>-</span>");
		});
		jQuery(this).html(function (i, html) {
			return html.replace(/I-/gi, "I<span class='dash'>-</span>");
		});
	});

}


