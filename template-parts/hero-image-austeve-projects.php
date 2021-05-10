
<div class="hero-austeve-projects-background">
	<div class="grid-container">
		<div class="grid-x small-up-1 medium-up-4 align-center austeve-projects-hero">

			<?php

			$currentPostId = get_the_ID();

			$args = array(
				'post_type'              => array( 'austeve-projects' ),
				'post_status'            => array( 'publish' ),
				'nopaging'               => true,
				'posts_per_page'         => '-1',
			);

			$projects_query = new WP_Query( $args );

			if ( $projects_query->have_posts() ) {
				while ( $projects_query->have_posts() ) {
					$projects_query->the_post();
					?>
					<div class="cell <?php echo $currentPostId == get_the_ID() ? 'is-active' : 'show-for-medium not-active'; ?>">
						<div class="container">
							<?php if ($currentPostId != get_the_ID()) :?>
								<a href="<?php the_permalink();?>" title="<?php the_title();?>">
									<div class="shaded-background"></div>
							<?php endif; ?>
									<?php
									the_post_thumbnail( 'hero-image' );
									?>
							<?php if ($currentPostId != get_the_ID()) :?>
								</a>
							<?php endif; ?>

						</div>
					</div>
					<?php
				}
			}

			wp_reset_postdata();

			?>
		</div>
	</div>
</div>