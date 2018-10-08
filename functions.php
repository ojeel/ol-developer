<?php
/* ************************************************************ Get LoggedIn User info ************************************************************ */	
if(!function_exists('ol_current_user')) {
	function ol_current_user() {
		$current_user = wp_get_current_user();
		
		$olCurrentUser	= array(	
			'userId'	=> $current_user->ID,
			'userLogin'	=> $current_user->user_login,
			'displayName'	=> $current_user->display_name,
			'userEmail'	=> $current_user->user_email
		);
		return $olCurrentUser;
	}
}
add_action( 'init', 'ol_current_user', 10 );


/*
 * *********************************************************************************************************************************************
 * Add Google Analytics Tracking Code
 * This will work only if the Option is enabled and Tracking code is present in the OL Settings page
*/

$olGoogleAnalytics		= get_option('ol_google_analytics');

if( ($olGoogleAnalytics == "enable") ) {
	function ol_google_analytics() {
		
		$olGoogleAnalyticsCode	= get_option('ol_google_analytics_code');
		echo $olGoogleAnalyticsCode;
	}
	add_action( 'wp_head', 'ol_google_analytics', 10);
}

/********************************************** Number Format with Rupee Symbol ******************************************************/
function ol_rupee($amt) {
	$rupees	= '&#8377; '. number_format($amt, 2);
	return $rupees;
}

function get_iso_date($date) {
	$newDate = '';
	if($date != '') {
		$newDate	= date('Y-m-d', strtotime($date));
	}
	return $newDate;
}
function iso_date($date) {
	if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
		return false;
	} else {
		return true;
	}
}

/*
 *****************************************************************************************************************
 ** Processing popup with logo **
 */
function page_preloader($logo) {
	echo '
		<div id="page-preloader" class="page-preloader pr-hidden">
			<div class="page-preloader-inner">
				<img class="pr-logo" src="'. $logo .'"/>
				<div class="pr-loader"></div>
				<p class="pr-processing-txt">Processing your request....</p>
				<p class="pr-wait-txt">Please wait while we getting information</p>
			</div>
		</div>
	';
}


/*
 *****************************************************************************************************************
 ** Function to Detect Mobile Device **
 */
function isMobile() {
	$mobPreg	= preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
	return $mobPreg;
}


/*
 *****************************************************************************************************************
 ** Get stars by rating **
 */
function get_stars_by_rating($rating) {
	if($rating == 1) {
		$stars = '
		<span class="fa fa-star checked"></span>
		<span class="fa fa-star-o"></span>
		<span class="fa fa-star-o"></span>
		<span class="fa fa-star-o"></span>
		<span class="fa fa-star-o"></span>
		';
	} else if($rating == 1.5) {
		$stars = '
		<span class="fa fa-star checked"></span>
		<span class="fa fa-star-half-o checked"></span>
		<span class="fa fa-star-o"></span>
		<span class="fa fa-star-o"></span>
		<span class="fa fa-star-o"></span>
		';
	} else if($rating == 2) {
		$stars = '
		<span class="fa fa-star checked"></span>
		<span class="fa fa-star checked"></span>
		<span class="fa fa-star-o"></span>
		<span class="fa fa-star-o"></span>
		<span class="fa fa-star-o"></span>
		';
	} else if($rating == 2.5) {
		$stars = '
		<span class="fa fa-star checked"></span>
		<span class="fa fa-star checked"></span>
		<span class="fa fa-star-half-o checked"></span>
		<span class="fa fa-star-o"></span>
		<span class="fa fa-star-o"></span>
		';
	} else if($rating == 3) {
		$stars = '
		<span class="fa fa-star checked"></span>
		<span class="fa fa-star checked"></span>
		<span class="fa fa-star checked"></span>
		<span class="fa fa-star-o"></span>
		<span class="fa fa-star-o"></span>
		';
	} else if($rating == 3.5) {
		$stars = '
		<span class="fa fa-star checked"></span>
		<span class="fa fa-star checked"></span>
		<span class="fa fa-star checked"></span>
		<span class="fa fa-star-half-o checked"></span>
		<span class="fa fa-star-o"></span>
		';
	} else if($rating == 4) {
		$stars = '
		<span class="fa fa-star checked"></span>
		<span class="fa fa-star checked"></span>
		<span class="fa fa-star checked"></span>
		<span class="fa fa-star checked"></span>
		<span class="fa fa-star-o"></span>
		';
	} else if($rating == 4.5) {
		$stars = '
		<span class="fa fa-star checked"></span>
		<span class="fa fa-star checked"></span>
		<span class="fa fa-star checked"></span>
		<span class="fa fa-star checked"></span>
		<span class="fa fa-star-half-o checked"></span>
		';
	} else if($rating == 5) {
		$stars = '
		<span class="fa fa-star checked"></span>
		<span class="fa fa-star checked"></span>
		<span class="fa fa-star checked"></span>
		<span class="fa fa-star checked"></span>
		<span class="fa fa-star checked"></span>
		';
	} else {
		$stars = '
		<span class="fa fa-star-o"></span>
		<span class="fa fa-star-o"></span>
		<span class="fa fa-star-o"></span>
		<span class="fa fa-star-o"></span>
		<span class="fa fa-star-o"></span>
		';
	}
	
	return $stars;
}