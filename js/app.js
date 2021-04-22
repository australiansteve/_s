import { lodash } from 'lodash'

//customizer.js is only done in backend so not including in main
import './navigation.js'
import './foundation.js'

jQuery( document ).ready(function($) {

	window.addEventListener('resize', calculateSectionMinusHeaderHeight);
	window.addEventListener('resize', triggerFoundationEqualizer);
	calculateSectionMinusHeaderHeight();
	Foundation.addToJquery(jQuery);

	
	var icons = {
      header: "ui-icon-circle-plus",
      activeHeader: "ui-icon-circle-minus"
    };

    $( "#report-types" ).accordion({
		icons : icons,
		collapsible: true,
		heightStyle: "content",
	});

	$( "#report-types" ).accordion( "option", "icons", icons );


	$("a.change-faqs").on('click', function(e){
		e.preventDefault();

		var category = $(this).attr('data-name');
		var slug = $(this).attr('data-slug');

		//add hidden class from all menu-links
		$("#faqs .question, #faqs .answer").each(function() {
			if ($(this).hasClass(slug))
			{
				$(this).removeClass('hidden');
			}
			else
			{
				$(this).addClass('hidden');
			}
		});

		//change the header
		$("span.category-name").html(category);
	});

	//trigger the first FAQ category being displayed when page initially loads
	$("a.change-faqs:nth-of-type(1)").trigger("click");


	$(".bod-image").on('click', function(e){
		//console.log("bio click");
		var img = $(this).find('img');
		var bio = $(this).find('.bod-bio').html();
		//console.log("bio:" + bio);
		var marginLeft = (img.width()/2) - 30;
		//console.log("marginLeft:" + marginLeft);

		$(".bio-display:visible").each(function(){
			$(this).html("");
		});


		$(".active-arrow.active").each(function(){
			//console.log("Removing active from active-arrow");
			$(this).removeClass("active");
		});

		$(this).find('.active-arrow').each(function(){
			//console.log("Adding active to active-arrow");
			$(this).addClass('active');
			$(this).css('margin-left', marginLeft+'px');
		});

		$(this).nextAll(".bio-display:visible").first().html(bio);		
		
	});

	$(".reason-image").on('click', function(e){
		//console.log("reason click");
		var img = $(this).find('img');
		var bio = $(this).find('.reason-bio').html();
		//console.log("reason:" + bio);

		$(".reason-display:visible").each(function(){
			$(this).html("");
		});


		$(".active-arrow.active").each(function(){
			//console.log("Removing active from active-arrow");
			$(this).removeClass("active");
		});

		$(this).find('.active-arrow').each(function(){
			//console.log("Adding active to active-arrow");
			$(this).addClass('active');
		});

		$(this).nextAll(".reason-display:visible").first().html(bio);		
		
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
