<?php 

get_header();

$sectionId = 'landing';
$section = get_field($sectionId);
if ($section) {
	include( locate_template( 'template-parts/section-header.php', false, false ) ); 
	?>
	<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
	<?php
	include( locate_template( 'template-parts/section-footer.php', false, false ) ); 
}

get_footer();
?>