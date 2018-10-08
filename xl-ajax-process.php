<?php
/**
 * Template Name: XL AJAX Process
*/

/*
$getWpload = dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) .'\wp-load.php' ;
include(  $getWpload );
*/

date_default_timezone_set("Asia/Kolkata");

/* ******************** Action hook To process AJAX Request from Plugins ******************** */
do_action( 'xl_ajax_process' );



/* ****************************** Some AJAX Request Processing for this Plugin Only ****************************** */

/* ********** XL User Login Authentication ************* */
if($_GET["action"] == "userLoginAuth") {
	$username	= $_POST["username"];
	$password	= $_POST["pwd"];
	$remember	= $_POST["rememberme"];
	if($remember == "forever") {
		$remember	= true;
	} else {
		$remember	= false;
	}
	
	$creds = array(
		'user_login'    => $username,
		'user_password' => $password,
		'remember'      => $remember
	);
	
    $user = wp_signon( $creds, false );
 
    if ( is_wp_error( $user ) ) {
        echo 'Error|<p class="error-msg">'. $user->get_error_message() .'</p>';
    } else {
		echo 'Success|<p class="success-msg">Login Successful, redirecting...</p>';
	}
}