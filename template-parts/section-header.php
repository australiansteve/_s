<?php
$contentTextColor = $section['section_text_color'];
$backgroundColor = $section['background_color'];
$backgroundImage = $section['background_image'];
$backgroundImageUrl = wp_get_attachment_image_src($backgroundImage, 'full');
$backgroundCssValue = array();
$backgroundClasses = $section['background_classes'];
$sectionClasses = $section['section_classes'];
$sectionHAlignment = $section['section_horizontal_alignment'];
$sectionVAlignment = $section['section_vertical_alignment'];
$sectionHeight = $section['section_height'];

$headerOverlay = $sectionId == 'header' ? "linear-gradient(rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0.5)), " : "";

if ($backgroundImage) {
	$backgroundCssValue[] = "background-image: $headerOverlay url(".$backgroundImageUrl[0].")";
}

if ($backgroundColor) {
	$backgroundCssValue[] = "background-color: ".$backgroundColor;
}

//error_log("BackgroundCssValue: ".print_r($backgroundCssValue, true));

$explicitHeight = null;
if ($sectionVAlignment != 'left') {
	if (is_array($sectionHeight)) {
		//error_log("sectionHeight: ".print_r($sectionHeight, true));
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
	<?php if(array_key_exists('section_title', $section)) :?>
		<div class="section-title text-center">
			<h2><?php echo $section['section_title'];?></h2>
		</div>
	<?php endif; ?>
	<div class="section-content" style="color: <?php echo $contentTextColor;?>;">
		<div class="grid-container">
			<div class="grid-y align-<?php echo $sectionVAlignment;?>" style="height: 100%">
				<div class="cell text-<?php echo $sectionHAlignment;?>">