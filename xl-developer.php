<?php
/*
Plugin Name: XL Developer
Plugin URI: https://www.ojeel.com
Description: Core Application by Ojeel. Its performs many importants and core functionalities for your website. Don't Deactivate or Delete this plugin else your site may not work properly. Please contact us for any assistance.
Version: 1.0
Author: Mostafijur Rahaman
Author URI: http://mostafijur.in
*/

if ( ! defined( 'WPINC' ) ) {
	die;
}

if(!function_exists('wp_get_current_user')) {
	include_once(ABSPATH . "wp-includes/pluggable.php");
}

/* ************************************************************ Prevent PHP E_WARNING Reporting ************************************************************ */	
/*error_reporting(E_WARNING);*/


/* *********************************************************** Declare Global variables ********************************************************** */
define( 'XLDEV_URL', plugins_url( '', __FILE__ ) );
define( 'XLDEV_PATH', plugin_dir_path( __FILE__ ) );

define( 'XLDEV_STYLE_URL', plugins_url( 'assets/styles', __FILE__ ) );
define( 'XLDEV_STYLE_PATH', plugin_dir_path( __FILE__ ) .'assets/styles' );

define( 'XLDEV_WPCONF', plugin_dir_path( dirname( dirname( dirname( __FILE__ ) ) ) ) .'wp-config.php' );

define( 'XL_AJAX_PATH', plugin_dir_path( __FILE__ ) .'xl-ajax-process.php' );
define( 'XL_AJAX_URI', get_bloginfo( 'url' ) .'/xl-ajax-process/' );


/* ******************* Current Page Url ************************ */
$protocol 		= (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

$current_url	= $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

define( 'XL_CURRENT_URL', $current_url );


/************************************ Get XL Upload Directory in wp_upload_dir ************************************/
$XLwpUpload		= wp_upload_dir();

$xl_upload_dir		= $XLwpUpload['basedir'];
$xl_upload_dir		= $xl_upload_dir . '/xl-files';
define( 'XL_UPLOAD_DIR_PATH', $xl_upload_dir );

$xl_upload_dir_url	= $XLwpUpload['baseurl'];
$xl_upload_dir_url	= $xl_upload_dir_url . '/xl-files';
define( 'XL_UPLOAD_DIR_URL', $xl_upload_dir_url );

if (! is_dir($xl_upload_dir)) {
	mkdir( $xl_upload_dir, 0755 );
}


/* *********************************************************** Get Company Email Settings ************************************************************ */
function xl_email_settings() {
	$companyName	= '';
	$websiteTitle	= '';
	$senderName		= '';
	$senderEmail	= '';
	$salesEmail		= '';
	$supportEmail	= '';
	$contactNumber	= '';
		
	$getXlEmailSettings	= get_option('xl_email_settings');
	if($getXlEmailSettings !== false) {
		$companyName	= $getXlEmailSettings['company_name'];
		$websiteTitle	= $getXlEmailSettings['website_title'];
		$senderName		= $getXlEmailSettings['sender_name'];
		$senderEmail	= $getXlEmailSettings['sender_email'];
		$salesEmail		= $getXlEmailSettings['sales_email'];
		$supportEmail	= $getXlEmailSettings['support_email'];
		$contactNumber	= $getXlEmailSettings['contact_number'];
	}
	define( "XL_COMPANY_NAME", $companyName );
	define( "XL_WEBSITE_TITLE", $websiteTitle );
	define( "XL_SENDER_NAME", $senderName );
	define( "XL_SENDER_EMAIL", $senderEmail );
	define( "XL_SALES_EMAIL", $salesEmail );
	define( "XL_SUPPORT_EMAIL", $supportEmail );
	define( "XL_CONTACT_NUMBER", $contactNumber );
}
add_action( 'init', 'xl_email_settings' );

/* *********************************************************** Google reCAPTCHA Keys ************************************************************ */
$xlGoogleReCaptcha		= 'disable';
$xlRecaptchaSiteKey	= '';
$xlRecaptchaSecretKey	= '';

$xlGoogleReCaptcha		= get_option('xl_google_recaptcha');
if($xlGoogleReCaptcha !== false) {
	$xlRecaptchaSiteKey	= get_option('xl_recaptcha_sitekey');
	$xlRecaptchaSecretKey	= get_option('xl_recaptcha_secretkey');
}
define( 'XL_GOOGLE_RECAPTCHA', $xlGoogleReCaptcha );
define( 'XL_RECAPTCHA_SITEKEY', $xlRecaptchaSiteKey );
define( 'XL_RECAPTCHA_SECRETKEY', $xlRecaptchaSecretKey );


/* ******************************************************** XLDEV Website Frontend Styles ********************************************************* */
function xldev_front_styles() {
	global $wp_scripts;
	wp_enqueue_style( 'xldev-front-style', XLDEV_STYLE_URL . '/front-default-style.css' );
	
	wp_register_script( 'xldev-front-script', XLDEV_URL . '/assets/js/front-default-script.js', array( 'jquery-lib' ) );
	wp_enqueue_script ( 'xldev-front-script' );
	
	/* ****** Pass XL_AJAX_URI to Javascript / jQuery ******* */
	$data = array( 'xl_ajax_uri' => __( XL_AJAX_URI ) );
	wp_localize_script( 'xldev-front-script', 'xl_urls', $data );
	
	if( XL_GOOGLE_RECAPTCHA == 'enable' ) {
		wp_enqueue_script( 'google-recaptcha-api', 'https://www.google.com/recaptcha/api.js' );
	}
	
	if( get_option('xl_font_awesome') == 'enable' ) {
		wp_enqueue_style( 'xl-font_awesome', XLDEV_URL . '/assets/font-awesome-470/css/font-awesome.min.css' );
	}
}
add_action( 'wp_enqueue_scripts', 'xldev_front_styles' );



/***************************************** Creating random password ******************************************************/
if(!function_exists('xl_random_password')) {
	function xl_random_password($length = 20){
	  $chars =  'ABCDEFGHJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz'.
				'0123456789=@#$()[]{}';

	  $str = '';
	  $max = strlen($chars) - 1;

	  for ($i=0; $i < $length; $i++)
		$str .= $chars[random_int(0, $max)];

	  return $str;
	}
}

/* ************************************* Custom Admin menu | Roles and Capabilities | Shortcodes | Classes ************************************* */
	include_once('admin/xl-admin-menu.php');
	include_once('admin/xl-roles-capabilities.php');
	include_once('shortcodes.php');
	
	include_once('functions.php');
	include_once('classes.php');
	
/* ****************************************** User IP Data - Country, Currency, time zone etc ***************************************** */
	include_once('country-ip-data/user-ip-data.php');
	
	
/****************************************************************************************************************************************
 * XL Panel - Default XL Dashboard class "xlClass"
 * Read the guidelines for XL Panel at [This Plugin Folder]/xl-panel/xl-panel-guidelines.html
 */
	include_once('xl-panel/panel-index.php');
	
	
	
/* ************************************************ Custom Query Vars for batch id to url ************************************************ */
function xldev_query_vars( $xl_acp_vars ) {
	$xl_acp_vars[]	= "auth";
	$xl_acp_vars[]	= "spg";
	$xl_acp_vars[]	= "spage";
	$xl_acp_vars[]	= "tab";
	$xl_acp_vars[]	= "action";
	$xl_acp_vars[]	= "qid";
	$xl_acp_vars[]	= "viewid";
	$xl_acp_vars[]	= "editid";
	$xl_acp_vars[]	= "deleteid";
	
	return $xl_acp_vars;
}
add_filter( 'query_vars', 'xldev_query_vars' );


/* ******************************************************** Login Away if User is Not Logged in ************************************************ */
$getXlLoginGoAwaySatatus = get_option('xl_wplogin_goaway');
if( $getXlLoginGoAwaySatatus == 'yes' ) {
	if( !function_exists( 'wplogin_go_away' ) ) {
		function wplogin_go_away() {
			header('Location: '. get_bloginfo( 'url' ) );
		}
		add_action( 'login_init' , 'wplogin_go_away' );
	}
}


/* *************************************************************** Remove WP Admin Bar ****************************************************** */
if( !function_exists( 'remove_admin_bar_func' ) ) {
	add_action('init', 'remove_admin_bar_func');
	
	function remove_admin_bar_func() {
		if ( ! current_user_can( 'manage_options' ) ) {
			show_admin_bar( false );
		}
	}
}

/* Remove WordPress Logo From Admin Bar */
if( !function_exists( 'remove_wp_logo' ) ) {
	add_action( 'admin_bar_menu', 'remove_wp_logo', 999 );
	
	function remove_wp_logo( $wp_admin_bar ) {
		$wp_admin_bar->remove_node( 'wp-logo' );
	}
}

/* ********************************************************* SET Default Admin Color Scheme ************************************************ */
if( !function_exists( 'set_default_admin_color' ) ) {
	function set_default_admin_color($user_id) {
		$args = array(
			'ID' => $user_id,
			'admin_color' => 'sunrise'
		);
		wp_update_user( $args );
	}
	add_action('user_register', 'set_default_admin_color');
}

// Stop Users From Switching Admin Color Schemes
if(!current_user_can('manage_options') ) {
	remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );
}