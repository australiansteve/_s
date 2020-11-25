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
	$sectionId = 'landing';
	$section = get_field($sectionId);
	if ($section) {
		include( locate_template( 'template-parts/section-header.php', false, false ) ); 
		?>
		<h1 class="page-title"><?php the_title();?></h1>
		<div class="intro-box">
			<?php echo $section['text']; ?>
		</div>
		<?php
		include( locate_template( 'template-parts/section-footer.php', false, false ) ); 
	}

	$sectionId = 'call_to_action';
	$section = get_field($sectionId);
	if ($section) {
		include( locate_template( 'template-parts/section-header.php', false, false ) ); 
		?>

		<div class="container">
			<div class="grid-x">
				<div class="cell">
					<h2><?php echo $section['title'];?></h2>
				</div>
			</div>
			<div class="grid-x grid-margin-x">
				<div class="cell medium-6">
					<div class="grid-y align-center" style="height: 100%">
						<div class="cell">
							<div class="text-box">
								<?php echo $section['text']; ?>
							</div>
							<?php if ($section['button_text'] && $section['button_link']):?>
								<a class="button" href="<?php echo $section['button_link']; ?>"><?php echo $section['button_text']; ?></a>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<div class="cell medium-6">
					<div class="grid-y align-center" style="height: 100%">
						<div class="cell">
							<?php 
							if ($section['video_url']) :
								$videoEmbed = "<div class='iframe-container'>".$GLOBALS['wp_embed']->run_shortcode( "[embed width='100%']".$section['video_url']."[/embed]")."</div>";
								echo $videoEmbed;
							endif;
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		include( locate_template( 'template-parts/section-footer.php', false, false ) ); 
	}

	$sectionId = 'team';
	$section = get_field($sectionId);
	if ($section) {
		include( locate_template( 'template-parts/section-header.php', false, false ) ); 
		?>
		<h2><?php echo $section['title'];?></h2>
		<div class="text-box">
			<?php echo $section['text']; ?>
		</div>
		<div id="post-grid" class="grid-x grid-margin-x small-up-1 medium-up-2 large-up-3 align-center" data-equalizer data-equalize-by-row="true">
			<?php
			$args = array(
				'post_type'              => array( 'austeve-team-members' ),
				'post_status'            => array( 'publish' ),
			);
			$postsquery = new WP_Query( $args );
			if ( $postsquery->have_posts() ) {
				while ( $postsquery->have_posts() ) {
					$postsquery->the_post();

					get_template_part( 'template-parts/archive', get_post_type() );

				}
			}
			wp_reset_postdata();
			?>
		</div>


		<?php
		include( locate_template( 'template-parts/section-footer.php', false, false ) ); 
	}
	?>
</main><!-- #main -->

<?php
get_footer();
