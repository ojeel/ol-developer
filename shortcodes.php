<?php
/**
 * Template Name: XL Shortcodes
 */

if ( ! defined( 'WPINC' ) ) {
	die;
} 

/*
 * *************************************************************************************************************************
 * Orders and Checkout
*/

/****************************************************************** XL AJAX LOGIN ************************************************************************/


$getTrxLoginForm = get_option('xl_wplogin_form');
if($getTrxLoginForm == "yes") {
	// XL AJAX LOGIN ONLY
	function xl_ajax_login() {
		$xlAjax_Login	= new xlAjaxLogin;
		return $xlAjax_Login->login();
	}
	add_shortcode( 'xl-ajax-login','xl_ajax_login' );

	// XL AJAX LOGIN SIGNUP
	function xl_ajax_login_signup() {
		$xlAjax_Login	= new xlAjaxLogin;
		return $xlAjax_Login->login_signup();
	}
	add_shortcode( 'xl-ajax-login-signup','xl_ajax_login_signup' );
}