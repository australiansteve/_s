<?php include( locate_template( 'template-parts/archive-project-categories-menu.php', false, false ) );  ?>

<div id="project-category-content-container">
	<?php
	$counter = 0;
	foreach($categories as $category) {
		$cat = get_term($category->term_id, 'project-category');
		$counter++;

		include( locate_template( 'template-parts/archive-project-category.php', false, false ) ); 
	}
	?>	
</div>
<script type="text/javascript">
	function changeProjectCategory(category) {
		console.log("changeProjectCategory: " + category);
		if (category) {
			if (category.indexOf("project-category") == 0) {
				category = category.substring(17);
				console.log("Stripped - new category: " + category);
			}
			jQuery(".project-category-content").css({"opacity": "0", "z-index": "-1"}).removeClass('active');
			jQuery("#project-category-" + category).css({"opacity": "1", "z-index": "1"}).addClass('active');
			resizeContainer();									
		}
	}

	function clickProjectCategoryLink(event) {
		event.preventDefault();
		var category = jQuery(event.target).data('project-category');
		changeProjectCategory(category);
		var newHistoryLocation = window.location.toString().substr(0, window.location.toString().indexOf("#")) + "#project-category-" + category;
		jQuery("#project-category-grid a").removeClass('active');
		jQuery(this).addClass('active');

		history.pushState({page: 1}, "", newHistoryLocation);
	}
	jQuery(document).on("click", "#project-category-grid a", clickProjectCategoryLink);

	var resizeContainer = _.throttle(function() {
		var activeHeight =  jQuery(".project-category-content.active").height();
		jQuery("#project-category-content-container").height(activeHeight);
	}, 500);

	jQuery(document).ready(function() {
		resizeContainer();
		console.log(window.location.hash);
	});
	jQuery(window).on('resize', resizeContainer);

	window.onpopstate = function(event) {
		if (String(document.location).indexOf("#") > 0) {
			var hash = String(document.location).substring(String(document.location).indexOf("#") + 1);
			console.log("Pop hash: " + hash);
			changeProjectCategory(hash)
		}
		else {
			/* Default to first category */
			changeProjectCategory(jQuery("#project-category-grid a").first().data('project-category'));
		}
	}

</script>