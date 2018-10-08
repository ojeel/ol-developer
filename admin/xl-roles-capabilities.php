<?php
/**
 * Template Name: XL Roles and Capabilities
 */

/************************************************************
 *				Create New Role XL Admin if Not exist
 *				Run this function only once
 ************************************************************/

if( get_role( 'xl_admin' ) === null ) {
	$result = add_role(
				'xl_admin',
				__( 'XL Admin' ),
				array( 
					'read'					=> true,
					'level_0'				=> true
				)
			);
	if ( null !== $result ) {
		echo 'Yay! New role "xl_admin" created!';
	}
}


/* ************************************************************************** Add Wordpress Caps ******************************************************************************* */
function add_xl_system_caps() {
    // gets the roles
    $role_sys_1 = get_role( 'xl_admin' );
	
    // would allow the above roles to access the following capabilities
	$tr_sys_caps = array(
		'create_posts',
		'delete_others_posts',
		'delete_posts',
		'delete_private_posts',
		'delete_published_posts',
		'edit_others_posts',
		'edit_posts',
		'edit_private_posts',
		'edit_published_posts',
		'manage_categories',
		'moderate_comments',
		'publish_posts',
		'read_private_posts',
		'upload_files'
	);
	
	foreach($tr_sys_caps as $tr_sys_cap) {
		$role_sys_1->add_cap( $tr_sys_cap );
	}
}
add_action( 'admin_init', 'add_xl_system_caps');

/* ************************************************************************** Add Custom Caps ******************************************************************************* */
function add_xl_custom_caps() {
    // gets the roles
    $role_1 = get_role( 'administrator' );
	$role_2 = get_role( 'xl_admin' );
	
    // would allow the above roles to access the following capabilities
	$tr_caps = array( 'xl_options', 'xl_settings', 'xl_country_data', 'xl_acp_access' );
	foreach($tr_caps as $tr_cap) {
		$role_1->add_cap( $tr_cap );
		$role_2->add_cap( $tr_cap );
	}
}
add_action( 'admin_init', 'add_xl_custom_caps');