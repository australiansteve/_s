<?php
/**
 * The template for displaying the blog page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hamburger_Cat
 */

get_header();
?>

<main id="primary" class="site-main">

	<div class="grid-container">

		<div class="page-content">

			<div class="entry-content">

				<h2 class="page-title"><span>
				<?php
				echo get_the_title( get_option( 'page_for_posts' ) );
				?>
				</span></h2>

				<div class="grid-x grid-margin-x small-up-1 medium-up-2">
					<?php
					while ( have_posts() ) :
						the_post();
						?>
							<div class="cell">
								<?php get_template_part( 'template-parts/archive', get_post_type() ); ?>
							</div>
						<?php
					endwhile;
					?>
				</div>
				<?php get_template_part( 'template-parts/archive', 'nav' ); ?>

			</div>
		</div>
	</div>

</main><!-- #main -->

<div class="reveal" id="video-modal" data-reveal>
	<div class="iframe-container">
	</div>
	<div class="actions text-center">
		<a href="" class="read-more-button button"><?php the_field('read_more_text', 'options')?></a>
	</div>
	<button class="close-button" data-close aria-label="Close modal" type="button">
		<span aria-hidden="true">&times;</span>
	</button>
</div>

<script type="text/javascript">
	function showVideo(el) {
		html = jQuery(el).data('video-html');
		console.log("Show this: " + html);
		jQuery("#video-modal .iframe-container").html(html);
		jQuery("#video-modal .read-more-button").attr("href", jQuery(el).data('post-link'));
	}
	</script>
<?php
get_footer();
