<?php
/**
 * Template Name: About Page
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

		get_template_part( 'template-parts/hero-image', get_post_type() );
		?>

		<div class="grid-container">
			<div class="page-content">

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="grid-x grid-margin-x">
						<div class="cell medium-6">
							<?php
							$pageIntroPhoto = get_field('page_intro_photo');
							if($pageIntroPhoto) :
								?>
								<div class="page-intro-photo">
									<?php echo wp_get_attachment_image( $pageIntroPhoto, 'full' ); ?>
								</div>
								<?php
							endif;
							?>
						</div>
						<div class="cell medium-6">
							<?php the_title('<h1 class="page-title">', '</h1>');?>  
							<?php the_content(); ?>
						</div>
					</div>
					
					<div class="entry-content">
						<section id="section-1">
							<h2 class="section-title"><?php the_field('section_1_title');?></h2>
							<?php the_field('section_1_text');?>
							<div class="button-container">
								<?php
								$buttonId = 'section_1_button_1';
								$buttonText = get_field($buttonId.'_text');
								$buttonUrl = get_field($buttonId.'_url');
								$buttonInNewTab = get_field($buttonId.'_new_tab');
								if($buttonText && $buttonUrl):
									?>
									<a class="button" href="<?php echo $buttonUrl;?>" target="<?php echo $buttonInNewTab ? '_blank' : '';?>"><?php echo $buttonText;?></a>
									<?php
								endif;
								?>
							</div>
						</section>
						<section id="section-2">
							<h2 class="section-title"><?php the_field('section_2_title');?></h2>
							<?php the_field('section_2_text');?>
							<div class="button-container">
								<?php
								$buttonId = 'section_1_button_2';
								$buttonText = get_field($buttonId.'_text');
								$buttonUrl = get_field($buttonId.'_url');
								$buttonInNewTab = get_field($buttonId.'_new_tab');
								if($buttonText && $buttonUrl):
									?>
									<a class="button" href="<?php echo $buttonUrl;?>" target="<?php echo $buttonInNewTab ? '_blank' : '';?>"><?php echo $buttonText;?></a>
									<?php
								endif;

								$buttonId = 'section_1_button_3';
								$buttonText = get_field($buttonId.'_text');
								$buttonUrl = get_field($buttonId.'_url');
								$buttonInNewTab = get_field($buttonId.'_new_tab');
								if($buttonText && $buttonUrl):
									?>
									<a class="button" href="<?php echo $buttonUrl;?>" target="<?php echo $buttonInNewTab ? '_blank' : '';?>"><?php echo $buttonText;?></a>
									<?php
								endif;
								?>
							</div>
						</section>

					</div>

				</article><!-- #post-<?php the_ID(); ?> -->



			</div>
		</div>

		<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

	<?php
	get_footer();
