import { lodash } from 'lodash'

//customizer.js is only done in backend so not including in main
import './navigation.js'
import './foundation.js'

function accordionUp(event) {
	jQuery(event.target).find('i').addClass('fa-caret-down').removeClass('fa-caret-up');
}

function accordionDown(event) {
	jQuery(event.target).find('i').addClass('fa-caret-up').removeClass('fa-caret-down');
}

jQuery( document ).ready(function() {
	window.addEventListener('resize', calculateSectionMinusHeaderHeight);
	window.addEventListener('resize', triggerFoundationEqualizer);
	calculateSectionMinusHeaderHeight();
	Foundation.addToJquery(jQuery);

	var primaryMenu = jQuery('#primary-menu-accordion');
	var accMenu = new Foundation.AccordionMenu(primaryMenu);
	var wcNavMenu = jQuery('#wc-nav-menu-accoridan-small');
	var wcNavAccMenu = new Foundation.AccordionMenu(wcNavMenu);

	jQuery(primaryMenu).on('up.zf.accordionMenu', accordionUp);
	jQuery(primaryMenu).on('down.zf.accordionMenu', accordionDown);

	jQuery(wcNavMenu).on('up.zf.accordionMenu', accordionUp);
	jQuery(wcNavMenu).on('down.zf.accordionMenu', accordionDown);

	jQuery('.select2-single').each(function(){
		var thisId = jQuery(this).attr('id');
		jQuery(this).select2({
			dropdownParent: jQuery('.select2-parent[data-parent-of='+thisId+']')
		});
	});

	window.addEventListener('resize', fadeProductDescriptions);
	fadeProductDescriptions();
});


var fadeProductDescriptions = _.debounce(function () {
	/* Fade the short description if the text runs longer than the max height of the container */
	jQuery('.product-short-description').each(function() {
		var container = jQuery(this);
		if ( container.find("span").height() > container.height() ) {
			container.addClass('faded');
		}	
		else {
			container.removeClass('faded');
		}
	});
}, 250);

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
