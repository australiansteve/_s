<?php
get_header(); 
?>

<main id="primary" class="site-main">
	<?php
	if ( have_posts() ) :

		while ( have_posts() ) :

			the_post();

			?>

			<div class="grid-container">
				<div class="page-content">
					<div class="grid-x grant-single">

						<div class="cell small-12 grant-title">

							<h1><?php echo get_the_title( ); ?></h1>

						</div>

						<div class="cell small-12 grant-intro">

							<?php the_field( 'information_intro' );?>

						</div>

						<div class="cell small-12 grant-timeline">

							<?php 
							$openDate = get_field( 'applications_open' );
							$closeDate = get_field( 'applications_close' );
							$deliberation = get_field( 'deliberation_period' );
							$notification = get_field( 'applicant_notification' );
							$awarded = get_field( 'grants_awarded' );
							$currentStatus = get_field( 'current_status' );

							if ($openDate) :
								$openDisplay = new DateTime($openDate);
								?>
								<div class="timeline-value open"><span class="title">Applications open: </span><?php echo $openDisplay->format("F jS, Y"); ?></div>
								<?php
							endif;

							if ($closeDate) :
								$closeDisplay = new DateTime($closeDate);
								?>
								<div class="timeline-value close"><span class="title">Applications close: </span><?php echo $closeDisplay->format("F jS, Y"); ?></div>
								<?php
							endif;

							if ($deliberation) :
								?>
								<div class="timeline-value deliberation"><span class="title">Deliberation period: </span><?php echo $deliberation; ?></div>
								<?php
							endif;

							if ($notification) :
								?>
								<div class="timeline-value notification"><span class="title">Applicant notification: </span><?php echo $notification; ?></div>
								<?php
							endif;

							if ($awarded) :
								?>
								<div class="timeline-value awarded"><span class="title">Grants awarded: </span><?php echo $awarded; ?></div>
								<?php
							endif;

							if ($currentStatus) :
								?>
								<div class="timeline-value current-status"><span class="title">Current status: </span><?php echo $currentStatus; ?></div>
								<?php
							endif;
							?>
						</div>

						<?php if (get_field( 'information_closing' )): ?>
							<div class="cell small-12 grant-closing">

								<?php the_field( 'information_closing' );?>

							</div>
						<?php endif; ?>

						<div class="cell small-12" id="grant-eligibility">

							<div class="container">

								<?php get_template_part( 'template-parts/austeve-eligibility' ); ?>

							</div>

						</div>

					</div>
				</div>
			</div>
			<?php

		endwhile;

	endif; 
	?>
</main>
<?php
get_footer();
