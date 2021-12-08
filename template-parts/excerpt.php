<?php
/**
 * Template part for displaying excerpts on project archives
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hamburger_Cat
 */

if (has_category('testimonials')) :
    ?>
    <div class="excerpt"><?php the_content();?></div>
    <?php
else:
    ?>
    <div class="excerpt"><?php the_excerpt();?></div>
    <?php
endif;
?>