<?php
/**
 * Front page template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hamburger_Cat
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php
	while ( have_posts() ) :
		the_post();

		$sectionId = 'landing';
		$section = get_field($sectionId);
		if ($section) {
			include( locate_template( 'template-parts/section-header.php', false, false ) ); 
			?>	
			<div class="grid-container">
				<div class="grid-x">
					<div class="cell">
						<?php 
						$image = $section['logo'];
						$size = 'rect-large'; 

						if( $image ) {
							echo wp_get_attachment_image( $image, $size );
						}
						?>
					</div>
				</div>
				<div class="grid-x">
					<div class="cell intro-text">
						<?php 
						echo $section['intro_text'];
						?>
						<a href="<?php echo $section['button_link'];?>" class="button"><?php echo $section['button_text'];?></a>
					</div>
				</div>
			</div>
			<?php
			include( locate_template( 'template-parts/section-footer.php', false, false ) ); 

		}

		$sectionId = 'video';
		$section = get_field($sectionId);
		if ($section && $section['video_url']) {

			include( locate_template( 'template-parts/section-header.php', false, false ) ); 
			?>	
			<div class="grid-container">

				<?php include(locate_template( 'template-parts/about-video.php', false, false)); ?>

				<div class="grid-x" id="find-out-more">
					<div class="cell">
						<a href="<?php echo $section['button_link'];?>" class="button"><?php echo $section['button_text'];?></a>
					</div>
				</div>
			</div>
			<?php
			include( locate_template( 'template-parts/section-footer.php', false, false ) ); 

		}

		$sectionId = 'projects';
		$section = get_field($sectionId);
		if ($section) {

			include( locate_template( 'template-parts/section-header.php', false, false ) ); 
			?>
			<div class="grid-container">
				<div class="white-content-container">

					<div class="grid-x">
						<div class="cell text-center">
							<h2><?php echo $section['section_title'];?></h2>
							<?php
							$categories = $section['project_categories'];
							//echo "There are ".count($categories)." categories";
							?>
							<div class="grid-x small-up-2 medium-up-<?php echo count($categories);?> text-center" id="project-category-grid">
								<?php
								foreach($categories as $category) {
									$cat = get_term($category['category'], 'project-category');
								//echo print_r($category, true);
									echo "<div class='cell'><a href='#project-category-".$cat->slug."' data-project-category='".$cat->slug."'>". $cat->name ."</a></div>";
								}
								?>
							</div>

							<div id="project-category-content-container">
								<?php
								$counter = 0;
								foreach($categories as $category) {
									$cat = get_term($category['category'], 'project-category');
									$counter++;
									?>
									<div class="project-category-content <?php echo ($counter == 1) ? 'active' : '';?>" id="project-category-<?php echo $cat->slug; ?>">
										<div class="grid-x">
											<div class="cell text-center">
												<div class="description">
													<?php echo $category['description']; ?>
												</div>
												<div class="grid-x project-grid" id="project-category-<?php echo $cat->slug; ?>-grid">
													<?php

													// WP_Query arguments
													$args = array(
														'post_type'              => array( 'austeve-projects' ),
														'post_status'            => array( 'publish' ),
														'posts_per_page'            => '-1',
														'tax_query'				=> array(
															array(
																'taxonomy'         => 'project-category',
																'terms'            => $cat->slug,
																'field'            => 'slug',
																'operator'         => 'IN',
															),
														)
													);

													// The Query
													$query = new WP_Query( $args );

													if ( $query->have_posts() ) {
														while ( $query->have_posts() ) {
															$query->the_post();
															?>
															<div class="cell medium-6">
																<a class="project-link" href="<?php the_permalink();?>?returnto=project-category-<?php echo $cat->slug;?>">
																	<div class="image">
																		<?php
																		echo the_post_thumbnail('square-large');
																		?>
																	</div>
																	<div class="title text-center">
																		<?php the_title('<h3>', '</h3>');?>
																	</div>
																</a>
															</div>
															<?php

														}
													} else {
														echo "No ".$cat->name." projects";
													}

													wp_reset_postdata();
													?>
												</div>
											</div>
										</div>
									</div>
									<?php
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
						</div>
					</div>
				</div>
			</div>
			<?php
			include( locate_template( 'template-parts/section-footer.php', false, false ) ); 

		}

		$sectionId = 'contact';
		$section = get_field($sectionId);
		if ($section) {

			include( locate_template( 'template-parts/section-header.php', false, false ) ); 
			?>	
			<div class="grid-container">
				<div class="grid-x">
					<div class="cell">
						<?php echo do_shortcode("[ninja_forms id='".$section['ninja_form_id']."']");?>
					</div>
				</div>
			</div>
			<?php
			include( locate_template( 'template-parts/section-footer.php', false, false ) ); 

		}

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

	<?php
	get_footer();
