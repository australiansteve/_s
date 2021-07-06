<?php
/**
 * Template part for displaying excerpts on project archives
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hamburger_Cat
 */


$location = get_field('project-location');
$date = get_field('project-date');
$client = get_field('project-client');
?>
<div class="excerpt project">
    <?php echo $client ? "<div>Client: <span>".$client."</span></div>" : ''; ?>
    <?php echo $location ? "<div>Location: <span>".$location."</span></div>" : ''; ?>
    <?php echo $date ? "<div>Date: <span>".$date."</span></div>" : ''; ?>
</div>