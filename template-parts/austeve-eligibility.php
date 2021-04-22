<?php
$eligibility = get_field( 'eligibility' );
error_log("Eligibility:".$eligibility);
if ($eligibility) :
?>
			<h2>Eligibility</h2>
<?php

	$conditions = get_field('conditions', $eligibility);

	//echo print_r($conditions, true);
	if ($conditions) :
		foreach ($conditions as $condition):
?>
				<h3 class="eligibility-condition-title"><?php echo $condition['title'];?> </h3>
				<div class="eligibility-condition-details"><?php echo $condition['details'];?> </div>
<?php
		endforeach;
	endif;

endif;
?>