import { lodash } from 'lodash'

//customizer.js is only done in backend so not including in main
import './navigation.js'
import './foundation.js'

var sliderInterval = null;
var sliderTime = null;
var sliderId = null;

jQuery( document ).ready(function() {

	window.addEventListener('resize', calculateSectionMinusHeaderHeight);
	window.addEventListener('resize', triggerFoundationEqualizer);
	calculateSectionMinusHeaderHeight();
	Foundation.addToJquery(jQuery);

	/* Slider functionality */
	jQuery(".move-left").on('click', function(e) {
		e.preventDefault();

		var slider = jQuery("#" + jQuery(e.target).data('slider-id'));
		var current = parseInt(slider.data('focus'));
		var max = slider.data('max-count');

		if (current > 1) {
			focusPicture(slider, current - 1);
		}
		else if (current == 1) {
			focusPicture(slider, max);
		}
	})

	jQuery(".move-right").on('click', function(e) {
		e.preventDefault();

		var slider = jQuery("#" + jQuery(e.target).data('slider-id'));
		var current = parseInt(slider.data('focus'));
		var max = slider.data('max-count');
		
		if (current < max) {
			focusPicture(slider, current + 1);
		}
		else if (current == max) {
			focusPicture(slider, 1);
		}
	});

	jQuery('.slider').on('slider-focus-change', function() {
		console.log("slider-focus-change");
	    var image_num = jQuery(this).attr('data-focus');
		console.log(image_num);
	    focusPicture(jQuery(this), image_num);
	});

	jQuery('.slider-container').first().each(function() {
		var slider = jQuery(this).find('.slider').first();
		sliderId = slider.attr('id');
		console.log("slider with id found! " + sliderId);
		if (sliderId) {
			sliderTime = slider.data('slider-time');
			if (sliderTime > 0) {
				sliderInterval = setInterval(autoScrollSlider, sliderTime);
			}
		}
	});

	jQuery('.slider-navigation').on('mouseover', function() {
		if (sliderTime) {
			clearInterval(sliderInterval);
			sliderInterval = null; 
		}
	})
	jQuery('.slider-navigation').on('mouseout', function() {
		if (sliderTime && !sliderInterval) {
    		sliderInterval = setInterval(autoScrollSlider, sliderTime);
  		}
	})
});

function autoScrollSlider() {
	jQuery('.move-right[data-slider-id="'+sliderId+'"]').trigger('click');
}


var focusPicture = _.debounce(function(slider, image_num) {
	var newMargin = ((image_num - 1)*-100)+'%';
	slider.css('margin-left', newMargin);
	slider.data('focus', image_num);
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
