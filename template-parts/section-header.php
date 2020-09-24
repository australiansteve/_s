<?php

if ($backgroundImage) {
	$backgroundCssValue[] = "background-image: url(".$backgroundImageUrl[0].")";
}

if ($backgroundColor) {
	$backgroundCssValue[] = "background-color: ".$backgroundColor;
}

//error_log("BackgroundCssValue: ".print_r($backgroundCssValue, true));

$explicitHeight = null;
if ($sectionVAlignment != 'left') {
	if (is_array($sectionHeight)) {
		error_log("sectionHeight: ".print_r($sectionHeight, true));
		foreach ($sectionHeight as $height) :
			error_log("height: ".print_r($height, true));
			if ($height['acf_fc_layout'] == 'explicit_value') :

				$explicitHeight = $height['explicit_value'];
			endif;
		endforeach;
	}
}

?>

<section id="<?php echo str_replace('_', '-', $sectionId);?>" class="<?php echo $sectionClasses;?>" style="<?php echo ($explicitHeight) ? 'height:'.$explicitHeight: '';?>">
	<div class="section-background <?php echo $backgroundClasses;?>" style="<?php echo implode("; ", $backgroundCssValue);?>"></div>
	<div class="section-content" style="color: <?php echo $contentTextColor;?>;">

		<div class="grid-y align-<?php echo $sectionVAlignment;?>" style="height: 100%">
			<div class="cell text-<?php echo $sectionHAlignment;?>">