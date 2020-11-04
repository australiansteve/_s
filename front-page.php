<?php
get_header(); ?>

	<div class="grid-x">

		<div class="cell small-12">
			<?php
			
			// WP_Query arguments
			$args = array(
				'post_type'              => array( 'austeve-portfolio' ),
				'post_status'            => array( 'publish' )
			);
			// The Query
			$artistQuery = new WP_Query( $args );
			// The Loop
			if ( have_posts() ) :
				while ( $artistQuery->have_posts() ) :
				    $artistQuery->the_post();
				    
				    get_template_part( 'template-parts/artist' );
				endwhile;	
			else :
				echo esc_html( 'Sorry, no posts' );
			endif; //have_posts
			?>

		</div>
		
	</div>

	<div class="grid-x">

		<div class="cell small-12 medium-6">

			<div id="soundcloud-embed">
				<?php the_field('soundcloud_embed_code', 'option'); ?> 

				<a href="https://soundcloud.com/user-792010754" class="button"><i class="fab fa-soundcloud"></i> Follow on SoundCloud</a>
			</div>

		</div>

		<div class="cell small-12 medium-6">

			<div id="instagram-feed">
				<?php echo do_shortcode('[instagram-feed]'); ?> 
			</div>

		</div>
	
	</div>

<?php
get_footer();
