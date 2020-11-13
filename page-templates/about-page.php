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
			<h2><?php echo $section['title'];?></h2>
			<div class="text-box">
				<?php echo $section['text']; ?>
			</div>
			<a class="button" href="<?php echo $section['button_link']; ?>"><?php echo $section['button_text']; ?></a>
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
		<div id="post-grid" class="grid-x grid-margin-x small-up-1 medium-up-2 large-up-3" data-equalizer data-equalize-by-row="true">
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
