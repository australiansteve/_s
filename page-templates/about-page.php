<?php
/***
  * Template Name: About Page
  */

get_header(); ?>

<main id="main" class="site-main" role="main">
	<div class="page-content">
		<div class="grid-container">
			<div class="entry-content">

				<div class="grid-x" id="about-page">

					<?php while ( have_posts() ) : the_post(); ?>

						<div class="cell small-1 page-title">
							<h2><span><?php the_title(); ?></span></h2>
						</div>

						<div class="cell small-12 page-content">
							<?php the_content(); ?>
						</div>

						<div class="cell small-12 highlights">
							<div class="grid-x" data-equalizer data-equalize-by-row="true">
								<div class="cell small-12 medium-6 highlight">
									<div class="container" data-equalizer-watch>
										<h3><?php the_field('highlight_1_title'); ?></h3>
										<p><?php the_field('highlight_1_text'); ?></p>
									</div>
								</div>

								<div class="cell small-12 medium-6 highlight" >
									<div class="container" data-equalizer-watch>
										<h3><?php the_field('highlight_2_title'); ?></h3>
										<p><?php the_field('highlight_2_text'); ?></p>
									</div>
								</div>
							</div>
						</div>

						<div class="cell small-12" id="links">
							<div class="grid-x">
								<div class="cell medium-3 link-spacer show-for-medium">
								</div>

								<div class="cell small-12 medium-3 link link-1 text-center">
									<a href="<?php the_field('link_1_destination'); ?>"><?php the_field('link_1_text'); ?></a>
								</div>

								<div class="cell small-12 medium-3 link link-2 text-center">
									<a href="<?php the_field('link_2_destination'); ?>"><?php the_field('link_2_text'); ?></a>
								</div>

								<div class="cell medium-3 link-spacer show-for-medium">
								</div>
							</div>
						</div>

						<?php 
						if( have_rows('team_members') ):
							?>
							<div class="cell small-12" id="team">
								<h2>Staff</h2>
								<?php
								while ( have_rows('team_members') ) : the_row();
									?>
									<div class="grid-x">

										<div class="cell small-12 medium-3 large-2 team-member-image">
											<?php
											$image = get_sub_field('team_member_image');

											if( !empty($image) ): 
												$alt = $image['alt'];
												$size = 'bio-pic-size';
												$thumb = $image['sizes'][ $size ];
												$width = $image['sizes'][ $size . '-width' ];
												$height = $image['sizes'][ $size . '-height' ];
												?>
												<img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" title="<?php the_sub_field('team_member_name'); ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />
												<?php
											endif;
											?>
										</div>
										<div class="cell small-12 medium-9 large-10 team-member-bio"><?php the_sub_field('team_member_bio'); ?></div>
									</div>					        
									<?php
								endwhile;
								?>
							</div>
							<?php
						endif; 

						if( have_rows('board_of_directors') ):
							?>
							<div class="cell small-12" id="board">
								<h2>Board of Directors</h2>
								<?php
								$b = 0;
								?>
								<div class="grid-x">
									<?php
									while ( have_rows('board_of_directors') ) : the_row();
										?>

										<div class="cell small-4 medium-2 bod-image <?php echo ($b == 0) ? 'active' : ''?>">

											<?php
											$image = get_sub_field('bod_image');

											if( !empty($image) ): 
												$alt = $image['alt'];
												$size = 'thumbnail';
												$thumb = $image['sizes'][ $size ];
												$width = $image['sizes'][ $size . '-width' ];
												$height = $image['sizes'][ $size . '-height' ];
												?>
												<img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" title="<?php the_sub_field('bod_name'); ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" data-id="<?php echo $b;?>"/>
												<div class="active-arrow"></div>
												<div class="hidden bod-bio" style="display:none" data-id="<?php echo $b;?>">
													<div class="container">
														<?php the_sub_field('bod_bio'); ?>
													</div>
												</div>

												<?php
											endif;
											?>
										</div>		
										<?php
										$b++;

										if ($b % 3 == 0 || $b == count(get_field('board_of_directors')))
										{
											echo "<div class='bio-display cell small-12 hide-for-medium'></div>";
										}
										if ($b % 6 == 0 || $b == count(get_field('board_of_directors')))
										{
											echo "<div class='bio-display cell small-12 show-for-medium'></div>";
										}
									endwhile;
									?>
								</div>

							</div>		
							<?php
						endif;

						if( have_rows('legal_council') ):
							?>
							<div class="cell small-12" id="legal">

								<h2>Honorary Legal Counsel</h2>
								<?php
								$b = 0;
								?>
								<div class="grid-x">
									<?php
									while ( have_rows('legal_council') ) : the_row();
										?>

										<div class="cell small-4 medium-2 bod-image <?php echo ($b == 0) ? 'active' : ''?>">

											<?php
											$image = get_sub_field('lc_image');

											if( !empty($image) ): 
												$alt = $image['alt'];
												$size = 'thumbnail';
												$thumb = $image['sizes'][ $size ];
												$width = $image['sizes'][ $size . '-width' ];
												$height = $image['sizes'][ $size . '-height' ];
												?>
												<img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" title="<?php the_sub_field('lc_name'); ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" data-id="<?php echo $b;?>"/>
												<div class="active-arrow"></div>
												<div class="hidden bod-bio" style="display:none" data-id="<?php echo $b;?>">
													<div class="container">
														<?php the_sub_field('lc_bio'); ?>
													</div>
												</div>

												<?php
											endif;
											?>
										</div>		
										<?php
										$b++;

										if ($b % 3 == 0 || $b == count(get_field('legal_council')))
										{
											echo "<div class='bio-display cell small-12 hide-for-medium'></div>";
										}
										if ($b % 6 == 0 || $b == count(get_field('legal_council')))
										{
											echo "<div class='bio-display cell small-12 show-for-medium'></div>";
										}
									endwhile;
									?>
								</div>

							</div>				
							<?php
						endif; 
						?>

					<?php endwhile; ?>

				</div>

			</div>
		</div>
	</div>
</main><!-- #main -->

<?php get_footer(); ?>