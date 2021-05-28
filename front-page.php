<?php 

get_header();

?>
<main id="primary" class="site-main">

	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/hero-image', get_post_type() );
		?>

		<div class="page-content">

			<?php
			get_template_part( 'template-parts/section-landing' );
			?>

			<?php
			$image = get_field('ctas_background_accent');
			$size = 'full'; // (thumbnail, medium, large, full or custom size)
			
			if( $image ) {
				$ctasBackgroundImageUrl = wp_get_attachment_image_src( $image, $size )[0];
			}
			?>

			<section id="calls-to-action" class="background-container">
				<div class="grid-container">
					<div class="content-container">
						<div class="entry-content">
							<div class="grid-x grid-margin-x text-center">
								<div class="cell">
									<div class="ctas-intro">
										<?php the_field('ctas_intro_text'); ?>
									</div>
								</div>
								<div class="cell medium-6 medium-text-right">
									<a href="<?php the_field('ctas_button_link_1'); ?>" class="button large"><?php the_field('ctas_button_text_1'); ?></a>
								</div>
								<div class="cell medium-6 medium-text-left">
									<a href="<?php the_field('ctas_button_link_2'); ?>" class="button large"><?php the_field('ctas_button_text_2'); ?></a>
								</div>
								<div class="cell">
									<a href="<?php the_field('ctas_button_link_3'); ?>" class="button medium secondary"><?php the_field('ctas_button_text_3'); ?></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="background-image" style="background-image: url(<?php echo $ctasBackgroundImageUrl;?>);"></div>
			</section>

			<?php
			$image = get_field('featured_post_background_image');
			$size = 'full'; // (thumbnail, medium, large, full or custom size)
			
			if( $image ) {
				$fpBackgroundImageUrl = wp_get_attachment_image_src( $image, $size )[0];
			}

			if (get_field('featured_post')) :
			?>

			<section id="featured-post">
				<div class="grid-container">
					<div class="background-container">
						<div class="content-container">
							<div class="entry-content">
								<div class="grid-x align-center">
									<div class="cell medium-8 xlarge-6">
										<h4 class="featured-post-section-title"><?php the_field('featured_post_section_title'); ?></h4>
										<?php
										$args = array(
											'post_type'              => array( 'post' ),
											'post_status'            => array( 'publish' ),
											'posts_per_page'         => '1',
											'p'						=> get_field('featured_post') 
										);

										$postsquery = new WP_Query( $args );

										if ( $postsquery->have_posts() ) {
											while ( $postsquery->have_posts() ) {
												$postsquery->the_post();
												?>
												<?php get_template_part( 'template-parts/featured', get_post_type() ); ?>
												<?php
											}
										}

										wp_reset_postdata();
										?>
									</div>
								</div>
							</div>
						</div>
						<div class="background-image" style="background-image: url(<?php echo $fpBackgroundImageUrl;?>);"></div>
					</div>
				</div>
			</section>

			<?php
			endif;

			$image = get_field('news_background_accent');
			$size = 'full'; // (thumbnail, medium, large, full or custom size)
			
			if( $image ) {
				$newsBackgroundImageUrl = wp_get_attachment_image_src( $image, $size )[0];
			}
			?>

			<section id="news" class="background-container">
				<div class="grid-container">
					<div class="content-container">
						<div class="entry-content">
							<div class="grid-x align-center text-center">
								<div class="cell">
									<h3 class="news-section-title"><?php the_field('news_section_title'); ?></h3>
								</div>
								<div class="cell">
									<div class="grid-x small-up-1 medium-up-3 align-center grid-margin-x grid-margin-y">
										<?php
										$args = array(
											'post_type'              => array( 'post' ),
											'post_status'            => array( 'publish' ),
											'posts_per_page'         => '3',
											'post__not_in'			=> array(get_field('featured_post')),
											'tax_query'				=> array(
												array(
													'taxonomy'         => 'category',
													'terms'            => 'news',
													'field'            => 'slug',
													'operator'         => 'IN',
												),
											)
										);

										$postsquery = new WP_Query( $args );

										if ( $postsquery->have_posts() ) {
											while ( $postsquery->have_posts() ) {
												$postsquery->the_post();
												?>
												<div class="cell">
													<?php get_template_part( 'template-parts/front-page', get_post_type() ); ?>
												</div>
												<?php
											}
										}

										wp_reset_postdata();
										?>
									</div>
								</div>
								<div class="cell">
									<a href="<?php the_permalink(get_option('page_for_posts'));?>" class="button medium"><?php the_field('news_all_news_button_text'); ?></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="background-image" style="background-image: url(<?php echo $newsBackgroundImageUrl;?>);"></div>
			</section>

			<?php
			$image = get_field('sponsors_background_accent');
			$size = 'full'; // (thumbnail, medium, large, full or custom size)
			
			if( $image ) {
				$sponsorsBackgroundImageUrl = wp_get_attachment_image_src( $image, $size )[0];
			}
			?>

			<section id="sponsors" class="background-container">
				<div class="grid-container">
					<div class="content-container">
						<div class="entry-content">
							<div class="grid-x align-center text-center">
								<div class="cell">
									<h3 class="sponsors-section-title"><?php the_field('sponsors_section_title'); ?></h3>
								</div>
								<div class="cell">
									<div class="grid-x small-up-2 medium-up-3 large-up-5 align-center grid-margin-x grid-margin-y" id="sponsor-grid">
										<?php
										if( have_rows('sponsors') ):

											while( have_rows('sponsors') ) : the_row();

												$sponsor = get_sub_field('sponsor');
												$link = $sponsor['link'];

												?>
												<div class="cell">
													<div class="sponsor">
														<?php if (!empty($link)) : ?>
															<a href="<?php echo $sponsor['link']; ?>">
															<?php endif; ?>
															<?php 
															$image = $sponsor['logo'];
															$size = 'full';

															if( $image ) {
																echo wp_get_attachment_image( $image, $size );
															}
															?>
															<?php if (!empty($link)) : ?>
															</a>
														<?php endif; ?>
													</div>
												</div>
												<?php

											endwhile;

										endif;
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="background-image" style="background-image: url(<?php echo $sponsorsBackgroundImageUrl;?>);"></div>
			</section>

			<section id="newsletter">
				<div class="grid-container">
					<div class="content-container">						
						<div class="entry-content">
							<div class="grid-x align-center text-center">
								<div class="cell">
									<h3 class="newsletter-section-title"><?php the_field('newsletter_section_title'); ?></h3>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

		</div>

		<?php
	endwhile;
	?>

</main><!-- #main -->
<?php

get_footer();
?>