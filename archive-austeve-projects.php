<?php
/**
 * The template for displaying Project archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hamburger_Cat
 */

get_header();

$ajax_nonce = wp_create_nonce( "archive-page-projects" );
?>

<main id="primary" class="site-main">

	<?php
	get_template_part( 'template-parts/hero', 'austeve-projects' );
	?>

	<div class="grid-container">

		<div class="page-content">

			<div class="entry-content">
				<?php
				the_archive_title( '<h2 class="page-title"><span>', '</span></h2>' );
				?>

				<div class="archive-description">
					<?php
					the_field('projects_page_introduction', 'option');
					?>
				</div>

				<ul class="austeve-projects-list">
					<?php
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/archive', get_post_type() ); 

					endwhile;
					?>
					<span class="load-more-projects"></span>
				</ul>
			</div>
		</div>
	</div>
</main><!-- #main -->

<script type="text/javascript">

	function loadMoreProjects(pageNumber, style = 'list') {
		console.log('style ' + style);
		jQuery.ajax({
			type: 'POST',
			url: '<?php echo admin_url('admin-ajax.php');?>',
			dataType: "html",  
			data: { 
				action : 'austeve_get_projects', 
				security: '<?php echo $ajax_nonce; ?>', 
				page: pageNumber,
				style: style
			},
			error: function (xhr, status, error) {
				console.log("Error: " + error);

			},
			success: function( response ) {
				if (response) {
					console.log(response);
					jQuery( '.austeve-projects-' + style + ' .load-more-projects' ).before( response );
					window.dispatchEvent(new Event('resize'));
					loadMoreProjects(pageNumber + 1, style);
				}
				else {
					console.log("no response");
					/* No more responses */
					if (style == 'list') {			
						jQuery( '.austeve-projects-list .load-more-projects' ).remove();
					}
					else if (style == 'hero') {			
						jQuery( '.austeve-projects-hero .load-more-projects' ).remove();
					}
				}
			}
		});
	}

	jQuery(document).ready(function() {
		console.log("Load next page");
		loadMoreProjects(2, 'list');
		loadMoreProjects(2, 'hero');
	});
</script>

<?php
get_footer();
