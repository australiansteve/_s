<?php
$today = date('Y-m-d');
$rawOpenDate = get_field('applications_open');
$rawClosedDate = get_field('applications_close');
$openDate = new DateTime($rawOpenDate);
$closedDate = new DateTime($rawClosedDate);

$isOpen = $today >= $rawOpenDate && $today <= $rawClosedDate;

$bgColor = get_field('grant_highlight_color'); //Default color

?>

<div class="cell grant">
	<div class="container" >

		<div class="bg-color" style="background-color:<?php echo $bgColor; ?>"></div>


		<div class="grid-x archive-content">

			<div class="cell title" data-equalizer-watch="grant-title">
				<?php the_title('<h3>', '</h3>'); ?>
			</div>

			<?php if ($isOpen): ?>
			<div class="cell dates">
				<p>Currently <strong>OPEN</strong></p>
				<p>Applications close: <br/><?php echo $closedDate->format('jS F Y'); ?>
			</div>
			<?php else: ?>
			<div class="cell dates">
				<p>Currently CLOSED</p>

				<?php if ($today >= $rawOpenDate): ?>
				<p><?php the_field('current_status'); ?></p>
				<?php else: ?>
				<p>Applications open: <br/><?php echo $openDate->format('jS F Y'); ?>
				<?php endif; ?>
			</div>
			<?php endif; ?>

			<div class="cell action">		
				<a class="button" href="<?php the_permalink();?>">READ MORE</a>
			</div>
		</div>

	</div>
</div>
