<div class="project-category-content <?php echo ($counter == 1) ? 'active' : '';?>" id="project-category-<?php echo $cat->slug; ?>">
	<div class="grid-x">
		<div class="cell text-center">
			<div class="grid-x grid-margin-x project-grid" id="project-category-<?php echo $cat->slug; ?>-grid">
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
									$projectImages = get_field('images');
									if (is_array($projectImages)):
										echo wp_get_attachment_image( $projectImages[0], 'square-large' );
									elseif (has_post_thumbnail()):
										echo the_post_thumbnail('square-large');
									else :
										echo "<img src='https://dummyimage.com/700x700/061027/fff'/>";
									endif;
									?>
								</div>
								<div class="title text-center">
									<?php the_title('<h4>', '</h4>');?>
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