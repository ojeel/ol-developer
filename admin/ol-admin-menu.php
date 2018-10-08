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
 * Adding admin menue for OL Orders
 * as per mentioned in https://developer.wordpress.org/reference/functions/add_menu_page/
 * Code Reference: add_menu_page( string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '', string $icon_url = '', int $position = null )
 */
 
function ol_developer_menu_page() {
	
	// OL Dashboard Page
	add_menu_page( 'OL Dashboard', 'OL Dashboard', 'ol_options', 'ol-dashboard', 'ol_dashboard_page', 'dashicons-admin-home', 1 );
	add_submenu_page( 'ol-dashboard', 'OL Dashboard Page', 'Dashboard', 'ol_options', 'ol-dashboard', 'ol_dashboard_page' );
	
	// OL Developer Page
	add_menu_page( 'OL Developer', 'OL Developer', 'ol_settings', 'ol-settings', 'ol_settings_page', 'dashicons-screenoptions', 80 );
	add_submenu_page( 'ol-settings', 'OL Settings Page', 'OL Settings', 'ol_settings', 'ol-settings', 'ol_settings_page' );
	
	//OL Panel
	$getTrxPanelOption = get_option('ol_panel_function');
	if( $getTrxPanelOption == 'enable' ) {
		add_submenu_page( 'ol-settings', 'OL Panel Options', 'OL Panel', 'ol_settings', 'ol-panel-option', 'ol_panel_option_page' );
	}
	
	// OL Country Data
	add_submenu_page( 'ol-settings', 'OL Country Data', 'OL Countries', 'ol_country_data', 'ol-country-data', 'ol_country_data_page' ); 
}

add_action( 'admin_menu', 'ol_developer_menu_page' );

/**************************************************************************************************************************************************************
*********************************************************************** OL Dashboard Pages ***********************************************************************
**************************************************************************************************************************************************************/

function ol_dashboard_page() {
	
	// Check that the user has the required capability 
	if(!current_user_can('ol_options')) {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	
	// Display page content
	echo '<div class="wrap">';

	/* include_once( OLDEV_PATH .'admin/ol-dashboard.php'); */
	
	echo '</div>';
}

/* ************************************************************* OL Settings Page ************************************************************************* */
function ol_settings_page() {
	
	// Check that the user has the required capability 
	if(!current_user_can('ol_settings')) {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	
	// Display page content
	echo '<div class="wrap">';

		include_once( OLDEV_PATH .'admin/ol-settings.php');
		 
	echo '</div>';
}

/* ********************************************************** OL Panel Option Page ********************************************************************** */
/* ********************************************************** OL Panel Option Page ********************************************************************** */
/* ********************************************************** OL Panel Option Page ********************************************************************** */
function ol_panel_option_page() {
	
	// Check that the user has the required capability 
	if (!current_user_can('ol_settings')) {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	
	// Display page content
	echo '<div class="wrap">';

		include_once( OLDEV_PATH .'admin/ol-panel-option.php');
	
	echo '</div>';
}

/* ********************************************************** OL Country Data Page ********************************************************************** */
/* ********************************************************** OL Country Data Page ********************************************************************** */
/* ********************************************************** OL Country Data Page ********************************************************************** */
function ol_country_data_page() {
	
	// Check that the user has the required capability 
	if (!current_user_can('ol_country_data')) {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	
	// Display page content
	echo '<div class="wrap">';

		include_once( OLDEV_PATH .'country-ip-data/ol-country-data.php');
	
	echo '</div>';
}


/* *********************************************************** Edit Footer Thankyou Creating with Wordpress text *********************************************************** */

function ol_edit_text($content) {
	return 'Need Help? <a href="http://www.traaxe.com/support" target="_blank" title="Click here for Support" style="text-decoration:none;">Get Support</a> | Powered By <a href="http://www.traaxe.com" target="_blank" title="TraAxe" style="text-decoration:none;">TraAxe</a>.';
}

function ol_edit_footer() {
	add_filter( 'admin_footer_text', 'ol_edit_text', 11 );
}

add_action( 'admin_init', 'ol_edit_footer' );