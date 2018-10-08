<?php
/**
 * Template Name: OL Shortcodes
 */

if ( ! defined( 'WPINC' ) ) {
	die;
} 

/*
 * *************************************************************************************************************************
 * Orders and Checkout
*/

/****************************************************************** OL AJAX LOGIN ************************************************************************/


$getTrxLoginForm = get_option('ol_wplogin_form');
if($getTrxLoginForm == "yes") {
	// OL AJAX LOGIN ONLY
	function ol_ajax_login() {
		$olAjax_Login	= new olAjaxLogin;
		return $olAjax_Login->login();
	}
	add_shortcode( 'ol-ajax-login','ol_ajax_login' );

	// OL AJAX LOGIN SIGNUP
	function ol_ajax_login_signup() {
		$olAjax_Login	= new olAjaxLogin;
		return $olAjax_Login->login_signup();
	}
	add_shortcode( 'ol-ajax-login-signup','ol_ajax_login_signup' );
}