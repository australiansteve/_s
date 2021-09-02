<?php
/**
 *
 * @package Hamburger_Cat
 */

//Add options pages
acf_add_options_page(array(
	'page_title'	=> 'General Settings',
	'menu_title'	=> 'Theme Settings',
	'menu_slug'		=> 'theme-general-settings',
	'capability'	=> 'edit_posts',
	'redirect'		=> false
));

acf_add_options_sub_page(array(
	'page_title' 	=> 'Header Settings',
	'menu_title'	=> 'Header Settings',
	'parent_slug'	=> 'theme-general-settings',
));

acf_add_options_sub_page(array(
	'page_title' 	=> 'Footer Settings',
	'menu_title'	=> 'Footer Settings',
	'parent_slug'	=> 'theme-general-settings',
));

acf_add_options_sub_page(array(
	'page_title' 	=> 'GrassBlade LRS Connection Settings',
	'menu_title'	=> 'GrassBlade LRS Settings',
	'parent_slug'	=> 'theme-general-settings',
));

?>
