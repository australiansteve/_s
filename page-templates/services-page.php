<?php
/**
 * Template Name: Services Page
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

		if (has_post_thumbnail($post)) :
			the_post_thumbnail( 'hero-image' );
		endif;
		?>

		<div class="grid-container">
			<div class="page-content">
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
				<div class="custom-content">
					<?php the_title('<h2 class="page-title"><span>', '</span></h2>');?>  

					<div class="entry-content">
						<div class="grid-x medium-up-2" id="custom-content-1">

							<?php
							if( have_rows('services') ):

								$counter = 1;
								while( have_rows('services') ) : the_row();

									$serviceName = get_sub_field('name');
									$serviceDescription = get_sub_field('description');
									?>
									<div class="cell">
										<div class="container service link">
											
											<h4><a href="#" data-service="<?php echo $counter++;?>"><?php echo $serviceName;?></a></h4>
											
										</div>
									</div>
									<?php

								endwhile;
								reset_rows();
							endif;
							?>
						</div>
						<div id="custom-content-2">
							<?php
							if( have_rows('services') ):
								$counter = 1;
								while( have_rows('services') ) : the_row();

									$serviceName = get_sub_field('name');
									$serviceDescription = get_sub_field('description');
									$visibility = $counter == 1 ? '' : 'hidden';
									?>
									<div class="container service description <?php echo $visibility;?>" id="service-<?php echo $counter++;?>">
										
										<h3><?php echo $serviceName;?></h3>
										<?php echo $serviceDescription;?>
										
									</div>
									<?php

								endwhile;
							endif;
							?>

							<script type="text/javascript">
								jQuery( ".service.link" ).on("click", function(e) {
									e.preventDefault();
									console.log("link clicked " + jQuery(e.target).data("service"));
									jQuery(".service.description:not(.hidden)").each(function() {jQuery(this).addClass("hidden");});
									jQuery("#service-" + jQuery(e.target).data("service")).toggleClass("hidden");
									
								});
							</script>
						</div>
					</div>
				</div>
			</div>
		</div>


		<?php
	endwhile;
	?>

</main><!-- #main -->

<?php
get_footer();
