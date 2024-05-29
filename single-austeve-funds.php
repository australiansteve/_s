<?php
get_header(); 
?>

<main id="primary" class="site-main">

	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			?>

			<div class="grid-container">
				<div class="page-content">
					<div class="grid-x">
						<div class="cell small-12 fund-title">
							<?php the_title( '<h1>', '</h1>' );?>
						</div>
					</div>

					<div class="grid-x fund-single">
						<!-- FUND -->
						<?php
						$displayDonationForm = get_field('display_donation_form');
						$leftClasses = ($displayDonationForm == 'none') ? 'small-12' : 'small-12 medium-7 large-8';
						$rightClasses = ($displayDonationForm == 'none') ? 'hide-for-small' : 'small-12 medium-5 large-4';
						?>
						<div class="cell <?php echo $leftClasses;?>" id="page-content">
							<div class="grid-x">
								<div class="cell small-12">
									<?php the_post_thumbnail(); ?>

									<?php the_content(); ?>
								</div>

								<?php if (get_field('eligibility')):?>
									<div class="cell small-12" id="grant-eligibility">
										<div class="container">
											<h3>Eligibility</h3>
											<?php the_field('eligibility'); ?>
										</div>
									</div>
								<?php endif; ?>

								<div class="cell print-only" id="page-link">
									<p>Donate now at: <br/><?php echo get_permalink(); ?></p>
								</div>
							</div>
						</div>

						<div class="cell <?php echo $rightClasses;?> no-print" id="donate-now">
							<?php 
							if ($displayDonationForm != 'none') {
								$fundId = get_field('canada_helps_fund_id');
								if( $displayDonationForm == 'default' || 
									!$fundId || 
									$fundId == 'NO_FUND') {

									$fundId = get_field('canada_helps_default_fund', 'option');
								}

								// Get the base URL from the theme settings
								$base_form_url = get_field('canada_helps_form_url', 'option');
								$url_parts = parse_url($base_form_url);

								// Add the fundID part to the query if query is present
								$fund_id_part = "fundID=".$fundId;
								$url_query = array_key_exists('query', $url_parts) ? $url_parts['query']."&".$fund_id_part : $fund_id_part;

								// put the URL back together for display
								$iFrameSrc = $url_parts['scheme']."://".$url_parts['host'].$url_parts['path']."?".$url_query;
								error_log("iFrameSrc: ".$iFrameSrc);
								?>
								<iframe width="100%" height="1000px" src="<?php echo $iFrameSrc; ?>"></iframe>
								<?php
							}
							?>
						</div>
					</div>
				</div>
			</div>
	<?php
		endwhile;
	endif; 
	?>
</main>

<?php get_footer(); ?>