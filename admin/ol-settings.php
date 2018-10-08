<?php
/**
 * Template Name: Manage LMS
 */ 
$stylePath = OLDEV_PATH . "assets/styles/admin-style.php";
include_once($stylePath);

global $wpdb;
date_default_timezone_set("Asia/Kolkata");

?>

<h1 class="page-title">OL Settings</h1>

<div class="main-container">
	
	<div class="container-div">
		<div class="row no-margin">
			
			<!-- ************************************************* START General Settings ******************************************************** -->
			<div class="col col-left col1" style="width:49%;">
				<div class="row no-margin">
					<div class="col col-left col1" style="width:75%;">
						<h3 class="container-heading">
							General Settings
							<span class="tips" title="."></span>
						</h3>
					</div>
					<div class="col col-right col2" style="width:80px;">
					</div>
					<div class="clearfix"></div>
				</div>
				<hr class="container-heading-divider" />
					
				<div class="inner-container-div">
					<?php
						/************************************************ Get OL Panel Options and Form validation ************************************************/
						if(isset($_POST['olGenSettingBtn'])) {
							
							/***************** OL Login GoAway *****************/
							$olLoginGoAway = $_POST['olLoginGoAway'];
							
							$getTrxLoginGoAwayQ = get_option('ol_wplogin_goaway');
							if($getTrxLoginGoAwayQ === false) {
								add_option('ol_wplogin_goaway', $olLoginGoAway, '', 'no');
							} else {
								update_option('ol_wplogin_goaway', $olLoginGoAway, '', 'no');
							}
							
							/***************** OL Login Form *****************/
							$olLoginForm = $_POST['olLoginForm'];
							
							$getTrxLoginFormQ = get_option('ol_wplogin_form');
							if($getTrxLoginFormQ === false) {
								add_option('ol_wplogin_form', $olLoginForm, '', 'no');
							} else {
								update_option('ol_wplogin_form', $olLoginForm, '', 'no');
							}
							
							/***************** OL Font-Awesome *****************/
							$olFontAwesome = $_POST['olFontAwesome'];
							
							$getXlFontAwesomeQ = get_option('ol_font_awesome');
							if($getXlFontAwesomeQ === false) {
								add_option('ol_font_awesome', $olFontAwesome, '', 'no');
							} else {
								update_option('ol_font_awesome', $olFontAwesome, '', 'no');
							}
						}
						
						
						$getTrxLoginGoAway = get_option('ol_wplogin_goaway');
						$getTrxLoginForm = get_option('ol_wplogin_form');
						$getXlFontAwesome = get_option('ol_font_awesome');
						?>
						
					<form name="olGenSettingForm" method="post" action="" style="max-width:450px;">
						<table class="table-collapse full-width">
							<tr>
								<td width="60%" title="It will help you to hide the wp-login function for none admin user.">WP Login Goaway :</td>
								<td width="40%" align="right">
									<input type="radio" name="olLoginGoAway" value="yes" <?php if($getTrxLoginGoAway == 'yes') { echo 'checked'; } ?>> Yes 
									<input type="radio" name="olLoginGoAway" value="no" <?php if($getTrxLoginGoAway == 'no') { echo 'checked'; } ?>> No
								</td>
							</tr>
							<tr>
								<td title="It will help you to hide the wp-login function for none admin user.">Enable OL Login/Signup Form :</td>
								<td align="right">
									<input type="radio" name="olLoginForm" value="yes" <?php if($getTrxLoginForm == 'yes') { echo 'checked'; } ?>> Yes 
									<input type="radio" name="olLoginForm" value="no" <?php if($getTrxLoginForm == 'no') { echo 'checked'; } ?>> No
								</td>
							</tr>
							<tr>
								<td title="It will enable the self hosted font-awesome. Enable only if your current theme not supports font-awesome.">
									Enable OL-Font-Awesome :
									<span class="tips" title="Get Option: ol_font_awesome (Value: enable / disable)"></span>
								</td>
								<td align="right">
									<input type="radio" name="olFontAwesome" value="enable" <?php if($getXlFontAwesome == 'enable') { echo 'checked'; } ?>> Yes 
									<input type="radio" name="olFontAwesome" value="disable" <?php if($getXlFontAwesome == 'disable') { echo 'checked'; } ?>> No
								</td>
							</tr>
							<tr>
								<td colspan="2" align="right">
									<hr class="margin-5 no-margin-rl" />
									<input type="submit" name="olGenSettingBtn" class="button button-primary button-large container-action-btn" value="Save">
								</td>
							</tr>
						</table>
					</form>
					
				</div>
				
			</div>
			<!-- ************************************************** END General Settings ********************************************************* -->
			
			<!-- ********************************************************** Email Settings ******************************************************************** -->
			<div class="col col-right col2" style="width:49%;">
				<div class="row no-margin">
					<div class="col col-left col1" style="width:75%;">
						<h3 class="container-heading">
							Email Settings (Supported to all OL Plugins)
							<span class="tips" title=" &#10; Get Email Settings Data => Option Name: ol_email_settings (Returns Array) &#10; Array Values- &#10; company_name, &#10; sender_name, &#10; sender_email, &#10; sales_email, &#10; support_email, &#10; contact_number"></span>
						</h3>
					</div>
					<div class="col col-right col2" style="width:80px;">
					</div>
					<div class="clearfix"></div>
				</div>
				<hr class="container-heading-divider" />
					
				<div class="inner-container-div">
					<?php
						if(isset($_POST['emailDataBtn'])) {
							
							/***************** OL Login GoAway *****************/
							$olEmailSettings	= array(
								'company_name'		=> $_POST["companyName"],
								'website_title'		=> $_POST["websiteTitle"],
								'sender_name'		=> $_POST["senderName"],
								'sender_email'		=> $_POST["senderEmail"],
								'sales_email'		=> $_POST["salesEmail"],
								'support_email'		=> $_POST["supportEmail"],
								'contact_number'	=> $_POST["contactNumber"]
							);
							
							$getTrxEmailSettingsQ = get_option('ol_email_settings');
							if($getTrxEmailSettingsQ === false) {
								add_option('ol_email_settings', $olEmailSettings, '', 'no');
							} else {
								update_option('ol_email_settings', $olEmailSettings, '', 'no');
							}
							
						}
						
						$companyName	= '';
						$websiteTitle	= '';
						$senderName		= '';
						$senderEmail	= '';
						$salesEmail		= '';
						$supportEmail	= '';
						$contactNumber	= '';
							
						$getTrxEmailSettings	= get_option('ol_email_settings');
						if($getTrxEmailSettings !== false) {
							$companyName	= $getTrxEmailSettings['company_name'];
							$websiteTitle	= $getTrxEmailSettings['website_title'];
							$senderName		= $getTrxEmailSettings['sender_name'];
							$senderEmail	= $getTrxEmailSettings['sender_email'];
							$salesEmail		= $getTrxEmailSettings['sales_email'];
							$supportEmail	= $getTrxEmailSettings['support_email'];
							$contactNumber	= $getTrxEmailSettings['contact_number'];
						}
						?>
						
					<form name="emailSettingsForm" method="post" action="" style="max-width:450px;">
						<table class="table-collapse full-width" cellpadding="2">
							<tr>
								<th width="16.666%"></th>
								<th width="16.666%"></th>
								<th width="16.666%"></th>
								<th width="16.666%"></th>
								<th width="16.666%"></th>
								<th width="16.666%"></th>
							</tr>
							<tr>
								<td colspan="6">
									<p class="no-margin"><b>Company Name:</b></p>
									<input type="text" class="full-width" name="companyName" placeholder="Company name for Invoices, Email header etc." value="<?php echo $companyName; ?>" />
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<p class="no-margin"><b>Website Title:</b></p>
									<input type="text" class="full-width" name="websiteTitle" placeholder="Website Title Email header etc." value="<?php echo $websiteTitle; ?>" />
								</td>
								<td colspan="3">
									<p class="no-margin"><b>Contact No (Help Line):</b></p>
									<input type="text" class="full-width" name="contactNumber" placeholder="9XXXXXXXXX" value="<?php echo $contactNumber; ?>" />
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<p class="no-margin"><b>Sender Name:</b></p>
									<input type="text" class="full-width" name="senderName" placeholder="My Business Name" value="<?php echo $senderName; ?>" />
								</td>
								<td colspan="3">
									<p class="no-margin"><b>Sender Email:</b></p>
									<input type="text" class="full-width" name="senderEmail" placeholder="info@yoursite.com" value="<?php echo $senderEmail; ?>" />
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<p class="no-margin"><b>Email Id (Sales Support):</b></p>
									<input type="text" class="full-width" name="salesEmail" placeholder="sales@yoursite.com" value="<?php echo $salesEmail; ?>" />
								</td>
								<td colspan="3">
									<p class="no-margin"><b>Email Id (Technical Support):</b></p>
									<input type="text" class="full-width" name="supportEmail" placeholder="support@yoursite.com" value="<?php echo $supportEmail; ?>" />
								</td>
							</tr>
							<tr>
								<td colspan="6" align="right">
									<hr class="margin-5 no-margin-rl" />
									<input type="submit" name="emailDataBtn" class="button button-primary button-large container-action-btn" value="Save">
								</td>
							</tr>
						</table>
					</form>
					
				</div>
				
			</div>
			<!-- ****************************************************** END Email Settings ************************************************************** -->
			<div class="clearfix"></div>
			
		</div>
	</div><!-- container-div -->
	
	
	<div class="container-div">	
		<div class="row no-margin">
			<div class="col col-left col1" style="width:25%;">
				<h3 class="container-heading">OL Panel</h3>
			</div>
			<div class="col col-right col2" style="width:80px;">
				<!--button onclick="dispPopDiv()" class="button button-primary button-large container-action-btn">Add New</button-->
			</div>
			<div class="clearfix"></div>
		</div>
		<hr class="container-heading-divider" />
			
		<div class="inner-container-div">
		<?php
				/************************************************ Get OL Panel Options and Form validation ************************************************/
				if(isset($_POST['panelEnableBtn'])) {
					
					$olPanelOption = $_POST['panelEnable'];
					$olcBsJqOption = $_POST['olcBsJq'];
					
					
					$getTrxPanelOptionQ = get_option('ol_panel_function');
					if($getTrxPanelOptionQ === false) {
						add_option('ol_panel_function', $olPanelOption, '', 'no');
					} else {
						update_option('ol_panel_function', $olPanelOption, '', 'no');
					}
					
					$getXlcBsJqOptionQ = get_option('olc_panel_bsjq');
					if($getXlcBsJqOptionQ === false) {
						add_option('olc_panel_bsjq', $olcBsJqOption, '', 'no');
					} else {
						update_option('olc_panel_bsjq', $olcBsJqOption, '', 'no');
					}
				}
				
				$panelEnableStatus	= '';
				
				$getTrxPanelOption = get_option('ol_panel_function');
				$getXlcBsJqOption = get_option('olc_panel_bsjq');
				?>
				
			<form name="olPanelForm" method="post" action="" style="max-width:450px;">
				<table class="table-collapse full-width">
					<tr>
						<td width="60%">Enable OL Panel :</td>
						<td width="40%" align="right">
							<input type="radio" name="panelEnable" value="enable" <?php if($getTrxPanelOption == 'enable') { echo 'checked'; } ?>> Enable 
							<input type="radio" name="panelEnable" value="disable" <?php if($getTrxPanelOption == 'disable') { echo 'checked'; } ?>> Disable
						</td>
					</tr>
					<tr>
						<td width="60%">Enable Own Bootstrap &amp; jQuery :</td>
						<td width="40%" align="right">
							<input type="radio" name="olcBsJq" value="enable" <?php if($getXlcBsJqOption == 'enable') { echo 'checked'; } ?>> Enable 
							<input type="radio" name="olcBsJq" value="disable" <?php if($getXlcBsJqOption == 'disable') { echo 'checked'; } ?>> Disable
						</td>
					</tr>
					<tr>
						<td colspan="2" align="right">
							<hr class="margin-5 no-margin-rl" />
							<input type="submit" name="panelEnableBtn" class="button button-primary button-large container-action-btn" value="Save">
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
	
	<div class="container-div">
		<div class="row no-margin">
			
			<!-- ************************************************* START Google Analytics Tracking ******************************************************** -->
			<div class="col col-left col1" style="width:49%;">
				<div class="row no-margin">
					<div class="col col-left col1" style="width:50%;">
						<h3 class="container-heading">
							Google Analytics Tracking 
							<span class="tips" title="Check if Enable => Option Name: ol_google_analytics (Value: enable / disable) &#10; Get Tracking Code => Option Name: ol_google_analytics_code"></span>
						</h3>
					</div>
					<div class="col col-right col2" style="width:80px;">
					</div>
					<div class="clearfix"></div>
				</div>
				<hr class="container-heading-divider" />
					
				<div class="inner-container-div">
				<?php
					if(isset($_POST['olGABtn'])) {
						
						$olGoogleAnalytics		= $_POST['olGoogleAnalytics'];
						$olGoogleAnalyticsCode	= $_POST['olGoogleAnalyticsCode'];
						
						$olGoogleAnalyticsCode	= stripslashes($olGoogleAnalyticsCode);
						
						if(empty($olGoogleAnalyticsCode)) {
							$olGoogleAnalytics	= "disable";
						}
						
						$olGoogleAnalyticsQ	 = get_option('ol_google_analytics');
						$olGoogleAnalyticsCodeQ = get_option('ol_google_analytics_code');
						
						if($olGoogleAnalyticsQ === false) {
							add_option('ol_google_analytics', $olGoogleAnalytics, '', 'no');
						} else {
							update_option('ol_google_analytics', $olGoogleAnalytics, '', 'no');
						}
						
						if($olGoogleAnalyticsCodeQ === false) {
							add_option('ol_google_analytics_code', $olGoogleAnalyticsCode, '', 'no');
						} else {
							update_option('ol_google_analytics_code', $olGoogleAnalyticsCode, '', 'no');
						}
					}
					
					$olGoogleAnalytics		= get_option('ol_google_analytics');
					$olGoogleAnalyticsCode	= get_option('ol_google_analytics_code');
					?>
						
					<form name="olPanelForm" method="post" action="" style="max-width:450px;">
						<table class="table-collapse full-width">
							<tr>
								<td width="60%">Enable Google Analytics :</td>
								<td width="40%" align="right">
									<input type="radio" name="olGoogleAnalytics" value="enable" <?php if($olGoogleAnalytics == 'enable') { echo 'checked'; } ?>> Enable 
									<input type="radio" name="olGoogleAnalytics" value="disable" <?php if($olGoogleAnalytics == 'disable') { echo 'checked'; } ?>> Disable
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<br/>
									<p class="no-margin"><b>Add your Tracking Code</b>:</p>
									<textarea class="full-width" name="olGoogleAnalyticsCode" rows="4"><?php echo $olGoogleAnalyticsCode; ?></textarea>
								</td>
							</tr>
							<tr>
								<td colspan="2" align="right">
									<hr class="margin-5 no-margin-rl" />
									<input type="submit" name="olGABtn" class="button button-primary button-large container-action-btn" value="Save">
								</td>
							</tr>
						</table>
					</form>
				</div>
				
			</div>
			<!-- ************************************************** END Google Analytics Tracking ********************************************************* -->
			
			<!-- ***************************************************** START Google reCAPTCHA ************************************************************* -->
			<div class="col col-right col2" style="width:49%;">
				<div class="row no-margin">
					<div class="col col-left col1" style="width:50%;">
						<h3 class="container-heading">
							Google reCAPTCHA 
							<span class="tips" title="Check if Enable => Option Name: ol_google_recaptcha (Value: enable / disable) &#10; Get Site Key => Option Name: ol_recaptcha_sitekey &#10; Get Secret Key => Option Name: ol_recaptcha_secretkey"></span>
						</h3>
					</div>
					<div class="col col-right col2" style="width:80px;">
					</div>
					<div class="clearfix"></div>
				</div>
				<hr class="container-heading-divider" />
					
				<div class="inner-container-div">
				<?php
					if(isset($_POST['olGrCBtn'])) {
						
						$olGoogleReCaptcha		= $_POST['olGoogleReCaptcha'];
						$olRecaptchaSiteKey	= $_POST['olRecaptchaSiteKey'];
						$olRecaptchaSecretKey	= $_POST['olRecaptchaSecretKey'];
						
						
						if( empty($olRecaptchaSiteKey) || empty($olRecaptchaSecretKey) ) {
							$olGoogleReCaptcha	= "disable";
						}
						
						$olGoogleReCaptchaQ	= get_option('ol_google_recaptcha');
						$olRecaptchaSiteKeyQ 	= get_option('ol_recaptcha_sitekey');
						$olRecaptchaSecretKeyQ = get_option('ol_recaptcha_secretkey');
						
						if($olGoogleReCaptchaQ === false) {
							add_option('ol_google_recaptcha', $olGoogleReCaptcha, '', 'no');
						} else {
							update_option('ol_google_recaptcha', $olGoogleReCaptcha, '', 'no');
						}
						
						if($olRecaptchaSiteKeyQ === false) {
							add_option('ol_recaptcha_sitekey', $olRecaptchaSiteKey, '', 'no');
						} else {
							update_option('ol_recaptcha_sitekey', $olRecaptchaSiteKey, '', 'no');
						}
						
						if($olRecaptchaSecretKeyQ === false) {
							add_option('ol_recaptcha_secretkey', $olRecaptchaSecretKey, '', 'no');
						} else {
							update_option('ol_recaptcha_secretkey', $olRecaptchaSecretKey, '', 'no');
						}
					}
					
					$olGoogleReCaptcha		= get_option('ol_google_recaptcha');
					$olRecaptchaSiteKey	= get_option('ol_recaptcha_sitekey');
					$olRecaptchaSecretKey	= get_option('ol_recaptcha_secretkey');
					?>
						
					<form name="olPanelForm" method="post" action="" style="max-width:450px;">
						<table class="table-collapse full-width">
							<tr>
								<td width="60%">Enable Google reCAPTCHA :</td>
								<td width="40%" align="right">
									<input type="radio" name="olGoogleReCaptcha" value="enable" <?php if($olGoogleReCaptcha == 'enable') { echo 'checked'; } ?>> Enable 
									<input type="radio" name="olGoogleReCaptcha" value="disable" <?php if($olGoogleReCaptcha == 'disable') { echo 'checked'; } ?>> Disable
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<br/>
									<p class="no-margin"><b>Site Key</b>:</p>
									<input type="text" class="full-width" name="olRecaptchaSiteKey" value="<?php echo $olRecaptchaSiteKey; ?>" placeholder="6LftjEEUAAAAAEELcXP8OvQl548JcZbCMbGfW16C"/>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<br/>
									<p class="no-margin"><b>Secret key</b>:</p>
									<input type="text" class="full-width" name="olRecaptchaSecretKey" value="<?php echo $olRecaptchaSecretKey; ?>" placeholder="6LftjEEUAAAAANsBbhOl2cpVnTHcer-e-2xzxWtr"/>
								</td>
							</tr>
							<tr>
								<td colspan="2" align="right">
									<hr class="margin-5 no-margin-rl" />
									<input type="submit" name="olGrCBtn" class="button button-primary button-large container-action-btn" value="Save">
								</td>
							</tr>
						</table>
					</form>
				</div>
				
			</div>
			<!-- ****************************************************** END Google reCAPTCHA ************************************************************** -->
			<div class="clearfix"></div>
			
		</div>
	</div><!-- container-div -->
	
</div><!-- main-container -->