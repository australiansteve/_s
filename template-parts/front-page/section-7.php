<?php
if ($section7Text) :
	?>
	<section id="section-7">
		<div class="entry-content" id="section-7-content">
			<?php echo $section7Title ? "<h3 class='section-title'>".$section7Title."</h3>" : ""; ?>
			<?php echo $section7Text; ?>
		</div>
	</section>
	<?php
endif;
?>