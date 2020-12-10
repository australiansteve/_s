<?php
$contentTextColor = $section['content_text_color'];
$backgroundColor = $section['background_color'];
$backgroundImage = $section['background_image'];
$backgroundImageUrl = wp_get_attachment_image_src($backgroundImage, 'full-page-background');
$backgroundCssValue = array();
$backgroundClasses = $section['background_classes'];
$sectionClasses = $section['section_classes'];
$sectionHAlignment = $section['section_horizontal_alignment'];
$sectionVAlignment = $section['section_vertical_alignment'];
$sectionHeight = $section['section_height'];

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
		<div class="grid-container">
			<div class="grid-y align-<?php echo $sectionVAlignment;?>" style="height: 100%">
				<div class="cell text-<?php echo $sectionHAlignment;?>">