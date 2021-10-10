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


class AUSteve_GradeHelper {

	function __construct() {

	}

	function convert_grade($grade_str) {
		error_log('convert_grade '.$grade_str);
		switch($grade_str) :
			case ('00-kindergarten') :
				return 'Kindergarten';
				break;
			case ('01-one') :
				return '1';
				break;
			case ('02-two') :
				return '2';
				break;
			case ('03-three') :
				return '3';
				break;
			case ('04-four') :
				return '4';
				break;
			case ('05-five') :
				return '5';
				break;
			case ('06-six') :
				return '6';
				break;
			default: 
				return "Unknown Grade";
				break;
		endswitch;

	}
}

$austeve_gradehelper = new AUSteve_GradeHelper();
?>
