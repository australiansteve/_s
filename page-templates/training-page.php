<?php
/**
 * Template Name: Training Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hamburger_Cat
 */

get_header();

$ajax_nonce = wp_create_nonce( "get-courses" );

$queries = array();
parse_str($_SERVER['QUERY_STRING'], $queries);
error_log(print_r($queries, true));
$searchTerm = array_key_exists('search', $queries) ? $queries['search'] : "";
$searchCategory = array_key_exists('category', $queries) ? $queries['category'] : "";

?>

<main id="primary" class="site-main">

	<?php

	$sectionId = 'landing';
	$section = get_field($sectionId);
	if ($section) {
		include( locate_template( 'template-parts/section-header.php', false, false ) ); 
		?>
		<h1 class="page-title"><?php the_title();?></h1>
		<?php
		include( locate_template( 'template-parts/section-footer.php', false, false ) ); 
	}

	$sectionId = 'courses';
	$section = get_field($sectionId);
	if ($section) {
		include( locate_template( 'template-parts/section-header.php', false, false ) ); 
		?>
		<div class="intro-box">
			<?php echo $section['introductory_text']; ?>

			<div id="search-filters">
				<div class="grid-x">
					<div class="cell small-2">
						<label label-for="s"><?php echo $section['search_label'];?></label>
					</div>
					<div class="cell small-8 text-right">
						<input type="text" name="s" id="s" value="<?php echo $searchTerm;?>"/>
					</div>
					<div class="cell small-2 text-left">
						<a class="button" name="submit-s" id="submit-s"><i class="fas fa-search"></i></a>
					</div>
				</div>
				<?php
				$categories = get_terms([
					'taxonomy' => 'course-category',
					'hide_empty' => false
				]);
				?>
				<label label-for="course-category-select"><?php echo $section['filter_by_category_label'];?></label>
				<select type="select" id="course-category-select" name="course-category-select" style="display: none">
					<option value="">Select</option>
					<?php
					foreach($categories as $category) {
						$cat = get_term($category->term_id, 'course-category');
						echo "<option value='".$cat->slug."' ".($searchCategory == $cat->slug ? 'selected': '').">". $cat->name ."</option>";
					}
					?>
				</select>
				<div class="grid-x" id="course-category-grid">
					<div class='cell text-center'>
						<?php
						foreach($categories as $category) {
							$cat = get_term($category->term_id, 'course-category');
							echo "<a class='course-category-filter button ".($searchCategory == $cat->slug ? 'active': '')."' href='#' data-course-category='".$cat->slug."'>". $cat->name ."<i class='fas fa-times remove-filter'></i></a>";
						}
						?>
					</div>
				</div>
			</div>
		</div>

		<div id="post-grid" class="grid-x grid-margin-x small-up-1 medium-up-2 large-up-3 austeve-courses align-center" data-equalizer data-equalize-by-row="true">
			<?php
			$args = array(
				'post_type'              => array( 'austeve-courses' ),
				'post_status'            => array( 'publish' ),
			);
			$postsquery = new WP_Query( $args );
			if ( $postsquery->have_posts() ) {
				while ( $postsquery->have_posts() ) {
					$postsquery->the_post();

					include( locate_template( 'template-parts/archive-austeve-courses.php', false, false ) ); 

				}
			}
			wp_reset_postdata();
			?>
		</div>
		<script type="text/javascript">

			var triggerFoundationEqualizer = _.debounce(function (groups) {
				if (jQuery("[data-equalize-by-row]").length) {
					new Foundation.Equalizer(jQuery("[data-equalize-by-row]")).getHeightsByRow(resetHeights);
				}
			}, 250);

			function resetHeights(groups) {
				jQuery('[data-equalize-by-row]').foundation('applyHeightByRow', groups);
			}

			function startSearch() {
				jQuery(".austeve-courses").html("<div id='search-progress' class='cell auto text-center'><i class='fas fa-spinner fa-spin'></i><?php the_field('search_in_progress', 'options');?></div>").addClass("in-progress");
			}

			function endSearch() {
				triggerFoundationEqualizer();
			}

			function clearCategoryFilter(e) {
				e.preventDefault();
				var selectBox = jQuery('#course-category-select');
				selectBox.val("");
				selectBox.trigger('change');
			}

			function filterByCategory(e) {
				e.preventDefault(e);
				var origin = jQuery(e.target);
				var selectBox = jQuery('#course-category-select');
				console.log(origin.data('course-category'));

				if (origin.hasClass('active')) {
					clearCategoryFilter(e);
					origin.removeClass('active');
				}
				else {
					selectBox.val(jQuery(e.target).data('course-category'));
					selectBox.trigger('change');
					jQuery('.course-category-filter').removeClass('active');
					origin.addClass('active');
				}
			}

			function clearSearch(e) {
				e.preventDefault();
				searchTerm = document.getElementById('s').value = "";
				category = document.getElementsByName('course-category')[0].value = "";
				jQuery("#search-result-summary").removeClass().html("");
				startSearch();
				getCourses(searchTerm, category, false);
			}

			function searchCourses(e) {
				e.preventDefault();
				searchTerm = document.getElementById('s').value;
				category = document.getElementById('course-category-select').value;
				//jQuery(".austeve-courses").html("");
				startSearch();
				console.log("Search terms: " + searchTerm);
				console.log("category: " + category);
				getCourses(searchTerm, category, false);
			}

			function popState(e) {
				console.log("location: " + document.location + ", state: " + JSON.stringify(e.state));
				searchTerm = document.getElementById('s').value = (e.state === null ? "" : e.state.search);
				category = document.getElementById('course-category-select').value = (e.state === null ? "" : e.state.category);
				jQuery(".austeve-courses").html("");
				jQuery('.course-category-filter').removeClass('active');
				jQuery('.course-category-filter[data-course-category='+category+']').addClass('active');
				startSearch();
				getCourses(searchTerm, category, false, false);
			}

			function bumpNextPage(nextPage) {
				jQuery("#load-more-courses").data('next-page', nextPage).removeClass("active");
			}
			function noMoreLoadMore() {
				jQuery("#load-more-courses").data('next-page', '-1').addClass("hidden");
			}

			function getCourses(search = '', category = '', appendResults = false, setNewState = true) {
				var newHistoryLocation = window.location.toString().substr(0, window.location.toString().indexOf("?"));
				newHistoryLocation += "?lang=<?php echo ICL_LANGUAGE_CODE; ?>";
				if (search != "") {
					newHistoryLocation += "&search=" + search;
				}
				if (category != "") {
					newHistoryLocation += "&category=" + category;
				}
				if (setNewState) {
					console.log("newHistoryLocation: " + newHistoryLocation);
					history.pushState({page: 1, search : search, category: category}, "", newHistoryLocation);
				}

				jQuery.ajax({
					type: 'POST',
					url: '<?php echo admin_url('admin-ajax.php');?>',
					dataType: "html",  
					data: { 
						action : 'austeve_get_courses', 
						security: '<?php echo $ajax_nonce; ?>', 
						lang: '<?php echo ICL_LANGUAGE_CODE; ?>', 
						category: category, 
						s: search
					},
					error: function (xhr, status, error) {
						console.log("Error: " + error);
						jQuery("#search-result-summary").addClass('error').html("Search failed. Please contact us for further support");
					},
					success: function( response ) {
						if (response) {
							if (appendResults) {
								jQuery( '.austeve-courses' ).append( response );
								bumpNextPage(page + 1);
							}

							else {
								jQuery( '.austeve-courses' ).html( response ); 

							}
							endSearch();
						}
						else {
							if (appendResults) {
								noMoreLoadMore();
							}
							else {
								console.log("No response!");						
								jQuery("#search-progress").addClass('info').html("<?php the_field('search_returned_zero_results', 'options');?>");
								endSearch();
								
							}

						}
					}
				});
			}

			jQuery(document).on("change", "#search-filters select", searchCourses);
			jQuery(document).on("click", "#search-filters button#clear-search", clearSearch);
			jQuery(document).on("click", "#search-filters .course-category-filter", filterByCategory);
			jQuery(document).on("click", "#search-filters #submit-s", searchCourses);

			window.onpopstate = popState;

		</script>

		<?php
		include( locate_template( 'template-parts/section-footer.php', false, false ) ); 
	}

	?>

</main><!-- #main -->

<?php
get_footer();
