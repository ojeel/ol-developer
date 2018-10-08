<?php
/*
Plugin Name: OL Developer
Plugin URI: https://www.ojeel.com
Description: Core Application by Ojeel. Its performs many importants and core functionalities for your website. Don't Deactivate or Delete this plugin else your site may not work properly. Please contact us for any assistance.
Version: 2.0
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
define( 'OLDEV_URL', plugins_url( '', __FILE__ ) );
define( 'OLDEV_PATH', plugin_dir_path( __FILE__ ) );

define( 'OLDEV_STYLE_URL', plugins_url( 'assets/styles', __FILE__ ) );
define( 'OLDEV_STYLE_PATH', plugin_dir_path( __FILE__ ) .'assets/styles' );

define( 'OLDEV_WPCONF', plugin_dir_path( dirname( dirname( dirname( __FILE__ ) ) ) ) .'wp-config.php' );

define( 'OL_AJAX_PATH', plugin_dir_path( __FILE__ ) .'ol-ajax-process.php' );
define( 'OL_AJAX_URI', get_bloginfo( 'url' ) .'/ol-ajax-process/' );


/* ******************* Current Page Url ************************ */
$protocol 		= (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

$current_url	= $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

define( 'OL_CURRENT_URL', $current_url );


/************************************ Get OL Upload Directory in wp_upload_dir ************************************/
$OLwpUpload		= wp_upload_dir();

$ol_upload_dir		= $OLwpUpload['basedir'];
$ol_upload_dir		= $ol_upload_dir . '/ol-files';
define( 'OL_UPLOAD_DIR_PATH', $ol_upload_dir );

$ol_upload_dir_url	= $OLwpUpload['baseurl'];
$ol_upload_dir_url	= $ol_upload_dir_url . '/ol-files';
define( 'OL_UPLOAD_DIR_URL', $ol_upload_dir_url );

if (! is_dir($ol_upload_dir)) {
	mkdir( $ol_upload_dir, 0755 );
}


/* *********************************************************** Get Company Email Settings ************************************************************ */
function ol_email_settings() {
	$companyName	= '';
	$websiteTitle	= '';
	$senderName		= '';
	$senderEmail	= '';
	$salesEmail		= '';
	$supportEmail	= '';
	$contactNumber	= '';
		
	$getXlEmailSettings	= get_option('ol_email_settings');
	if($getXlEmailSettings !== false) {
		$companyName	= $getXlEmailSettings['company_name'];
		$websiteTitle	= $getXlEmailSettings['website_title'];
		$senderName		= $getXlEmailSettings['sender_name'];
		$senderEmail	= $getXlEmailSettings['sender_email'];
		$salesEmail		= $getXlEmailSettings['sales_email'];
		$supportEmail	= $getXlEmailSettings['support_email'];
		$contactNumber	= $getXlEmailSettings['contact_number'];
	}
	define( "OL_COMPANY_NAME", $companyName );
	define( "OL_WEBSITE_TITLE", $websiteTitle );
	define( "OL_SENDER_NAME", $senderName );
	define( "OL_SENDER_EMAIL", $senderEmail );
	define( "OL_SALES_EMAIL", $salesEmail );
	define( "OL_SUPPORT_EMAIL", $supportEmail );
	define( "OL_CONTACT_NUMBER", $contactNumber );
}
add_action( 'init', 'ol_email_settings' );

/* *********************************************************** Google reCAPTCHA Keys ************************************************************ */
$olGoogleReCaptcha		= 'disable';
$olRecaptchaSiteKey	= '';
$olRecaptchaSecretKey	= '';

$olGoogleReCaptcha		= get_option('ol_google_recaptcha');
if($olGoogleReCaptcha !== false) {
	$olRecaptchaSiteKey	= get_option('ol_recaptcha_sitekey');
	$olRecaptchaSecretKey	= get_option('ol_recaptcha_secretkey');
}
define( 'OL_GOOGLE_RECAPTCHA', $olGoogleReCaptcha );
define( 'OL_RECAPTCHA_SITEKEY', $olRecaptchaSiteKey );
define( 'OL_RECAPTCHA_SECRETKEY', $olRecaptchaSecretKey );


/* ******************************************************** OLDEV Website Frontend Styles ********************************************************* */
function oldev_front_styles() {
	global $wp_scripts;
	wp_enqueue_style( 'oldev-front-style', OLDEV_STYLE_URL . '/front-default-style.css' );
	
	wp_register_script( 'oldev-front-script', OLDEV_URL . '/assets/js/front-default-script.js', array( 'jquery-lib' ) );
	wp_enqueue_script ( 'oldev-front-script' );
	
	/* ****** Pass OL_AJAX_URI to Javascript / jQuery ******* */
	$data = array( 'ol_ajax_uri' => __( OL_AJAX_URI ) );
	wp_localize_script( 'oldev-front-script', 'ol_urls', $data );
	
	if( OL_GOOGLE_RECAPTCHA == 'enable' ) {
		wp_enqueue_script( 'google-recaptcha-api', 'https://www.google.com/recaptcha/api.js' );
	}
	
	if( get_option('ol_font_awesome') == 'enable' ) {
		wp_enqueue_style( 'ol-font_awesome', OLDEV_URL . '/assets/font-awesome-470/css/font-awesome.min.css' );
	}
}
add_action( 'wp_enqueue_scripts', 'oldev_front_styles' );



/***************************************** Creating random password ******************************************************/
if(!function_exists('ol_random_password')) {
	function ol_random_password($length = 20){
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
	include_once('admin/ol-admin-menu.php');
	include_once('admin/ol-roles-capabilities.php');
	include_once('shortcodes.php');
	
	include_once('functions.php');
	include_once('classes.php');
	
/* ****************************************** User IP Data - Country, Currency, time zone etc ***************************************** */
	include_once('country-ip-data/user-ip-data.php');
	
	
/****************************************************************************************************************************************
 * OL Panel - Default OL Dashboard class "olClass"
 * Read the guidelines for OL Panel at [This Plugin Folder]/ol-panel/ol-panel-guidelines.html
 */
	include_once('ol-panel/panel-index.php');
	
	
	
/* ************************************************ Custom Query Vars for batch id to url ************************************************ */
function oldev_query_vars( $ol_acp_vars ) {
	$ol_acp_vars[]	= "auth";
	$ol_acp_vars[]	= "spg";
	$ol_acp_vars[]	= "spage";
	$ol_acp_vars[]	= "tab";
	$ol_acp_vars[]	= "action";
	$ol_acp_vars[]	= "qid";
	$ol_acp_vars[]	= "viewid";
	$ol_acp_vars[]	= "editid";
	$ol_acp_vars[]	= "deleteid";
	
	return $ol_acp_vars;
}
add_filter( 'query_vars', 'oldev_query_vars' );


/* ******************************************************** Login Away if User is Not Logged in ************************************************ */
$getXlLoginGoAwaySatatus = get_option('ol_wplogin_goaway');
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