<?php
/**
 * Template Name: Custom Admin Menu
 */

//************************************ Remove Some Admin Menue ***********************************
/*
if(!current_user_can('manage_options')) {
	function admin_menu_page_removing() {
		remove_menu_page( 'index.php' );	
		remove_menu_page( 'tools.php' );	
	}
	add_action( 'admin_menu', 'admin_menu_page_removing' );
}
*/

/* ************************************************************************************************************************************************************
 * Adding admin menue for KT Orders
 * as per mentioned in https://developer.wordpress.org/reference/functions/add_menu_page/
 * Code Reference: add_menu_page( string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '', string $icon_url = '', int $position = null )
 */
 
function xl_developer_menu_page() {
	
	// XL Dashboard Page
	add_menu_page( 'XL Dashboard', 'XL Dashboard', 'xl_options', 'xl-dashboard', 'xl_dashboard_page', 'dashicons-admin-home', 1 );
	add_submenu_page( 'xl-dashboard', 'XL Dashboard Page', 'Dashboard', 'xl_options', 'xl-dashboard', 'xl_dashboard_page' );
	
	// XL Developer Page
	add_menu_page( 'XL Developer', 'XL Developer', 'xl_settings', 'xl-settings', 'xl_settings_page', 'dashicons-screenoptions', 80 );
	add_submenu_page( 'xl-settings', 'XL Settings Page', 'XL Settings', 'xl_settings', 'xl-settings', 'xl_settings_page' );
	
	//XL Panel
	$getTrxPanelOption = get_option('xl_panel_function');
	if( $getTrxPanelOption == 'enable' ) {
		add_submenu_page( 'xl-settings', 'XL Panel Options', 'XL Panel', 'xl_settings', 'xl-panel-option', 'xl_panel_option_page' );
	}
	
	// XL Country Data
	add_submenu_page( 'xl-settings', 'XL Country Data', 'XL Countries', 'xl_country_data', 'xl-country-data', 'xl_country_data_page' ); 
}

add_action( 'admin_menu', 'xl_developer_menu_page' );

/**************************************************************************************************************************************************************
*********************************************************************** XL Dashboard Pages ***********************************************************************
**************************************************************************************************************************************************************/

function xl_dashboard_page() {
	
	// Check that the user has the required capability 
	if(!current_user_can('xl_options')) {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	
	// Display page content
	echo '<div class="wrap">';

	/* include_once( XLDEV_PATH .'admin/xl-dashboard.php'); */
	
	echo '</div>';
}

/* ************************************************************* XL Settings Page ************************************************************************* */
function xl_settings_page() {
	
	// Check that the user has the required capability 
	if(!current_user_can('xl_settings')) {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	
	// Display page content
	echo '<div class="wrap">';

		include_once( XLDEV_PATH .'admin/xl-settings.php');
		 
	echo '</div>';
}

/* ********************************************************** XL Panel Option Page ********************************************************************** */
/* ********************************************************** XL Panel Option Page ********************************************************************** */
/* ********************************************************** XL Panel Option Page ********************************************************************** */
function xl_panel_option_page() {
	
	// Check that the user has the required capability 
	if (!current_user_can('xl_settings')) {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	
	// Display page content
	echo '<div class="wrap">';

		include_once( XLDEV_PATH .'admin/xl-panel-option.php');
	
	echo '</div>';
}

/* ********************************************************** XL Country Data Page ********************************************************************** */
/* ********************************************************** XL Country Data Page ********************************************************************** */
/* ********************************************************** XL Country Data Page ********************************************************************** */
function xl_country_data_page() {
	
	// Check that the user has the required capability 
	if (!current_user_can('xl_country_data')) {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	
	// Display page content
	echo '<div class="wrap">';

		include_once( XLDEV_PATH .'country-ip-data/xl-country-data.php');
	
	echo '</div>';
}


/* *********************************************************** Edit Footer Thankyou Creating with Wordpress text *********************************************************** */

function xl_edit_text($content) {
	return 'Need Help? <a href="http://www.traaxe.com/support" target="_blank" title="Click here for Support" style="text-decoration:none;">Get Support</a> | Powered By <a href="http://www.traaxe.com" target="_blank" title="TraAxe" style="text-decoration:none;">TraAxe</a>.';
}

function xl_edit_footer() {
	add_filter( 'admin_footer_text', 'xl_edit_text', 11 );
}

add_action( 'admin_init', 'xl_edit_footer' );