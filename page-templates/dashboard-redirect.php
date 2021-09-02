<?php
/**
* Template Name: Dashboard Redirect page
*/

$redirect_url = "";
if (is_user_logged_in()) :
	$redirect_url = bp_loggedin_user_domain(); //bp_core_get_userlink( get_current_user_id() );
else: 
	$redirect_url = home_url('/login');
endif;

wp_redirect( $redirect_url );
exit;

?>
<h1>Redirtect failed</h1>