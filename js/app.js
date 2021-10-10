import { lodash } from 'lodash'

//customizer.js is only done in backend so not including in main
import './navigation.js'
import './foundation.js'

jQuery( document ).ready(function() {
	//console.log("LOADED");
	window.addEventListener('resize', calculateSectionMinusHeaderHeight);
	window.addEventListener('resize', triggerFoundationEqualizer);
	calculateSectionMinusHeaderHeight();
	Foundation.addToJquery(jQuery);

	var primaryMenu = jQuery('#primary-menu-accordion');
	//console.log(primaryMenu);
	var accMenu = new Foundation.AccordionMenu(primaryMenu);

	//console.log(accMenu);

	jQuery(primaryMenu).on('up.zf.accordionMenu', function() {
		console.log("primaryMenu up");

		jQuery(this).find('i').addClass('fa-caret-down').removeClass('fa-caret-up');
	});

	jQuery(primaryMenu).on('down.zf.accordionMenu', function() {
		console.log("primaryMenu down");
		jQuery(this).find('i').addClass('fa-caret-up').removeClass('fa-caret-down');
	});

	jQuery('.select2-single').each(function(){
		var thisId = jQuery(this).attr('id');
		console.log('thisId: ' + thisId);
		jQuery(this).select2({
			dropdownParent: jQuery('.select2-parent[data-parent-of='+thisId+']')
		});
	});

	jQuery('.button.make-donation').on('click', function() {
		var teacher_id = jQuery(this).data('teacher-id');
		jQuery('.make-donation-dropdown[data-teacher-id="'+teacher_id+'"]').css('display', 'block');
	});

	jQuery('.close-donation-dropdown').on('click', function() {
		var teacher_id = jQuery(this).data('teacher-id');
		jQuery('.make-donation-dropdown[data-teacher-id="'+teacher_id+'"]').css('display', 'none');
	});

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
