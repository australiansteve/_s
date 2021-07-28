<?php
if ($section9Text) :
	?>
	<section id="section-9">
		<div class="entry-content" id="section-9-content">
			<?php echo $section9Title ? "<h3 class='section-title'>".$section9Title."</h3>" : ""; ?>
			<?php echo $section9Text; ?>
		</div>
	</section>
	<?php
endif;
?>