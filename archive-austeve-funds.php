<?php
/***
  * Archive page for AUSteve-Funds CPT
  */

get_header(); 

$ajax_nonce = wp_create_nonce( "archive-page-posts" );

global $categoryBgColors; 
$savedBgColors = get_field('fund_category_background_colors', 'options');
foreach($savedBgColors as $color)
{
	$categoryBgColors[$color['category']] = $color['color'];
}

?>

<main id="main" class="site-main" role="main">

	<div class="page-content">

		<div class="grid-container">

			<div class="entry-content">

				<div class="grid-x archive" id="funds-page">

					<div class="cell small-12" id="page-title" >
						<?php the_archive_title('<h2><span>', '</span></h2>'); ?>
					</div>

					<div class="cell small-12" id="page-introduction" >
						<?php the_field('funds_introduction', 'options'); ?>
					</div>

					<div class="cell small-12">

						<div class="grid-x">

							<div class="cell small-12 medium-3" id="filter-sidebar" data-sticky-container>

								<div class="sticky" data-sticky data-top-anchor="page-introduction:bottom" data-anchor="filter-results" data-margin-top="10">

									<form method="GET" action="#" id="search-filters" class="search-form" onsubmit="return validateSearch()">
										<input type="hidden" name="austeve-funds-archive" value="true"/>
										<div class="grid-x align-right">
											<div class="cell auto">
												<input type="text" name="fund-name" id="fund-name" data-filter="fund-name" class="filter" value="<?php echo (isset($_GET['fund-name']) ? $_GET['fund-name'] : ''); ?>" placeholder="Search Funds"/>
											</div>
											<div class="cell shrink">
												<input type="submit" value="go" id="submit"></input>
											</div>
										</div>
										<div class="grid-x" id="fund-category-filters">
											<?php

											/* Find all terms except for 'featured' */
											$excludeCategories[] = get_term_by( 'slug', 'featured', 'austeve-funds-category' )->term_id;
											$terms = get_terms( 'austeve-funds-category', array(
												'hide_empty' => false,
												'exclude' => $excludeCategories,
											) );


											if (count($terms) > 0) :
												echo "<div class='cell'><p>Filter by fund category:</p></div>";
												foreach($terms as $term):

													$bgColor = get_field('default_fund_background_color', 'option');
													if (array_key_exists($term->term_id, $categoryBgColors))
													{
														$bgColor = $categoryBgColors[$term->term_id];
													}

													$checked = "";
													if (isset($_GET['fund-category'])) {
														$values = explode(',', $_GET['fund-category']);
														if (in_array($term->slug, $values))
														{
															$checked = "checked='checked'";
														}
													}
													?>
													<div class="cell small-6 medium-12">
														<div class="fund-category-checkbox" style="background-color: <?php echo $bgColor;?>">
															<input type="checkbox" name="fund-category" id="fund-category" data-filter="fund-category" value="<?php echo $term->slug;?>" <?php echo $checked; ?>/>
															<?php echo $term->name;?>								     
														</div>							     
													</div>
													<?php 
												endforeach;
											endif;

											$allFundsChecked = "";
											if (!isset($_GET['fund-category']) && !isset($_GET['fund-name']))
											{
												$allFundsChecked = "checked='checked'";
											}
											?>
											<div class="cell small-6 medium-12">
												<div class="fund-category-checkbox" style="background-color: <?php echo get_field('default_fund_background_color', 'option');?>">
													<input type="checkbox" name="fund-category" id="fund-category" data-filter="fund-category" value="all-funds" <?php echo $allFundsChecked; ?>/>
													Show all funds							     
												</div>							     
											</div>
										</div>
									</form>


									<div id="donate-now" class="grid-x cell">
										<div class="container">
											<p><?php the_field('donate_now_text', 'option');?></p>
											<?php	
											$fund = get_field('local_default_fund', 'option');	
											if ($fund):				
												?>
												<a class="button donate-now" href="<?php echo get_the_permalink($fund);?>"><?php the_field('funds_button_text', 'option');?></a>
												<?php	
											endif;				
											?>
										</div>
									</div>
									<div class="placeholder">&nbsp;</div> <!-- Needed to stop the bottom margin of the #donate-now being lost when equalizer does it's thing on small screens -->

								</div>

							</div>

							<div class="cell small-12 medium-9" id="filter-results">

								<div class="grid-x small-up-2 medium-up-3" data-equalizer="fund" data-equalize-by-row="true">

									<?php 

									if ( have_posts() ) :
										while ( have_posts() ) : the_post();
											get_template_part('template-parts/austeve-funds', 'archive');
										endwhile; 
										?>
										<div class="cell text-center loading-more-funds">
											<i class="fas fa-spinner fa-spin" style="padding: 2rem;"></i>
										</div>
										<?php
									else: ?>
										<div class="cell fund auto" class="fund-title">
											No funds could be found with your search criteria. Please try a broader search or view <a href='/funds'>all funds</a>
										</div>
									<?php 
									endif;
									?>
								</div>

							</div>

						</div>

					</div>

					<?php
					global $wp;
					$home_url = home_url();
					$current_url = home_url(add_query_arg(array(),$wp->request));
					$afterhome = strlen($current_url) - strlen($home_url);
					$request_url = substr($current_url, - ($afterhome-1));
					?>

					<script type="text/javascript">
						jQuery("input[name='fund-category']").on('click', function(){
							validateSearch(jQuery(this).val() === 'all-funds');
						});

						function validateSearch(clearCategoryFilter) {
							var url = "<?php echo home_url( $request_url ); ?>";
							var args = {};

							jQuery('#search-filters .filter').each(function(){

								var filter = jQuery(this).data('filter'),
								vals = [ jQuery(this).val()];

								args[ filter ] = vals.join(',');

							});

							var diffVals = [];
							jQuery('#search-filters input[name=fund-category]').each(function(){
								if (jQuery(this).prop('checked') && jQuery(this).val() != 'all-funds')
								{
									diffVals.push(jQuery(this).val());
								}
							});
							args[ 'fund-category' ] = diffVals.join(',');

							/*If 'all funds' option has been selected clear the array */
							if (clearCategoryFilter)
							{
								args = {};
							}

							/* update url */
							url += '?';

							jQuery.each(args, function( name, value ){	
								if (value.length > 0)		
									url += name + '=' + value + '&';			
							});

							/* remove last & */
							url = url.slice(0, -1);
							
							/* reload page */
							window.location.replace( url );
							return false;
						}

						function loadMoreFunds(pageNumber) {
							var diffVals = [];
							jQuery('#search-filters input[name=fund-category]').each(function(){
								if (jQuery(this).prop('checked') && jQuery(this).val() != 'all-funds')
								{
									diffVals.push(jQuery(this).val());
								}
							});
							var category = diffVals.join(',');

							var search = jQuery('#search-filters .filter').val();

							jQuery.ajax({
					 			type: 'POST',
					 			url: '<?php echo admin_url('admin-ajax.php');?>',
					 			dataType: "html",  
					 			data: { 
					 				action : 'austeve_get_funds', 
					 				security: '<?php echo $ajax_nonce; ?>', 
					 				page: pageNumber, 
					 				category: category, 
					 				s: search
					 			},
					 			error: function (xhr, status, error) {
					 				console.log("Error: " + error);
					 				
					 			},
					 			success: function( response ) {
					 				if (response) {
					 					//console.log(response);
					 					jQuery( '#filter-results .loading-more-funds' ).before( response );
					 					window.dispatchEvent(new Event('resize'));
					 					loadMoreFunds(pageNumber + 1);
					 				}
					 				else {
					 					/* No more responses */					
					 					jQuery( '#filter-results .loading-more-funds' ).remove();
					 				}
					 			}
					 		});
						}

						jQuery(document).ready(function() {
							console.log("Load next page");
							loadMoreFunds(2);
						});
					</script>

				</div>
			</div>
		</div>
	</div>
</main><!-- #main -->

	<?php get_footer(); ?>