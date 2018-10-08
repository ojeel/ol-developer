<?php
/**
 * Template Name: Manage LMS
 */ 
$stylePath = XLDEV_PATH . "assets/styles/admin-style.php";
include_once($stylePath);

global $wpdb;
date_default_timezone_set("Asia/Kolkata");

?>

<h1 class="page-title">XL Settings</h1>

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
						/************************************************ Get XL Panel Options and Form validation ************************************************/
						if(isset($_POST['xlGenSettingBtn'])) {
							
							/***************** XL Login GoAway *****************/
							$xlLoginGoAway = $_POST['xlLoginGoAway'];
							
							$getTrxLoginGoAwayQ = get_option('xl_wplogin_goaway');
							if($getTrxLoginGoAwayQ === false) {
								add_option('xl_wplogin_goaway', $xlLoginGoAway, '', 'no');
							} else {
								update_option('xl_wplogin_goaway', $xlLoginGoAway, '', 'no');
							}
							
							/***************** XL Login Form *****************/
							$xlLoginForm = $_POST['xlLoginForm'];
							
							$getTrxLoginFormQ = get_option('xl_wplogin_form');
							if($getTrxLoginFormQ === false) {
								add_option('xl_wplogin_form', $xlLoginForm, '', 'no');
							} else {
								update_option('xl_wplogin_form', $xlLoginForm, '', 'no');
							}
							
							/***************** XL Font-Awesome *****************/
							$xlFontAwesome = $_POST['xlFontAwesome'];
							
							$getXlFontAwesomeQ = get_option('xl_font_awesome');
							if($getXlFontAwesomeQ === false) {
								add_option('xl_font_awesome', $xlFontAwesome, '', 'no');
							} else {
								update_option('xl_font_awesome', $xlFontAwesome, '', 'no');
							}
						}
						
						
						$getTrxLoginGoAway = get_option('xl_wplogin_goaway');
						$getTrxLoginForm = get_option('xl_wplogin_form');
						$getXlFontAwesome = get_option('xl_font_awesome');
						?>
						
					<form name="xlGenSettingForm" method="post" action="" style="max-width:450px;">
						<table class="table-collapse full-width">
							<tr>
								<td width="60%" title="It will help you to hide the wp-login function for none admin user.">WP Login Goaway :</td>
								<td width="40%" align="right">
									<input type="radio" name="xlLoginGoAway" value="yes" <?php if($getTrxLoginGoAway == 'yes') { echo 'checked'; } ?>> Yes 
									<input type="radio" name="xlLoginGoAway" value="no" <?php if($getTrxLoginGoAway == 'no') { echo 'checked'; } ?>> No
								</td>
							</tr>
							<tr>
								<td title="It will help you to hide the wp-login function for none admin user.">Enable XL Login/Signup Form :</td>
								<td align="right">
									<input type="radio" name="xlLoginForm" value="yes" <?php if($getTrxLoginForm == 'yes') { echo 'checked'; } ?>> Yes 
									<input type="radio" name="xlLoginForm" value="no" <?php if($getTrxLoginForm == 'no') { echo 'checked'; } ?>> No
								</td>
							</tr>
							<tr>
								<td title="It will enable the self hosted font-awesome. Enable only if your current theme not supports font-awesome.">
									Enable XL-Font-Awesome :
									<span class="tips" title="Get Option: xl_font_awesome (Value: enable / disable)"></span>
								</td>
								<td align="right">
									<input type="radio" name="xlFontAwesome" value="enable" <?php if($getXlFontAwesome == 'enable') { echo 'checked'; } ?>> Yes 
									<input type="radio" name="xlFontAwesome" value="disable" <?php if($getXlFontAwesome == 'disable') { echo 'checked'; } ?>> No
								</td>
							</tr>
							<tr>
								<td colspan="2" align="right">
									<hr class="margin-5 no-margin-rl" />
									<input type="submit" name="xlGenSettingBtn" class="button button-primary button-large container-action-btn" value="Save">
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
							Email Settings (Supported to all XL Plugins)
							<span class="tips" title=" &#10; Get Email Settings Data => Option Name: xl_email_settings (Returns Array) &#10; Array Values- &#10; company_name, &#10; sender_name, &#10; sender_email, &#10; sales_email, &#10; support_email, &#10; contact_number"></span>
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
							
							/***************** XL Login GoAway *****************/
							$xlEmailSettings	= array(
								'company_name'		=> $_POST["companyName"],
								'website_title'		=> $_POST["websiteTitle"],
								'sender_name'		=> $_POST["senderName"],
								'sender_email'		=> $_POST["senderEmail"],
								'sales_email'		=> $_POST["salesEmail"],
								'support_email'		=> $_POST["supportEmail"],
								'contact_number'	=> $_POST["contactNumber"]
							);
							
							$getTrxEmailSettingsQ = get_option('xl_email_settings');
							if($getTrxEmailSettingsQ === false) {
								add_option('xl_email_settings', $xlEmailSettings, '', 'no');
							} else {
								update_option('xl_email_settings', $xlEmailSettings, '', 'no');
							}
							
						}
						
						$companyName	= '';
						$websiteTitle	= '';
						$senderName		= '';
						$senderEmail	= '';
						$salesEmail		= '';
						$supportEmail	= '';
						$contactNumber	= '';
							
						$getTrxEmailSettings	= get_option('xl_email_settings');
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
				<h3 class="container-heading">XL Panel</h3>
			</div>
			<div class="col col-right col2" style="width:80px;">
				<!--button onclick="dispPopDiv()" class="button button-primary button-large container-action-btn">Add New</button-->
			</div>
			<div class="clearfix"></div>
		</div>
		<hr class="container-heading-divider" />
			
		<div class="inner-container-div">
		<?php
				/************************************************ Get XL Panel Options and Form validation ************************************************/
				if(isset($_POST['panelEnableBtn'])) {
					
					$xlPanelOption = $_POST['panelEnable'];
					$xlcBsJqOption = $_POST['xlcBsJq'];
					
					
					$getTrxPanelOptionQ = get_option('xl_panel_function');
					if($getTrxPanelOptionQ === false) {
						add_option('xl_panel_function', $xlPanelOption, '', 'no');
					} else {
						update_option('xl_panel_function', $xlPanelOption, '', 'no');
					}
					
					$getXlcBsJqOptionQ = get_option('xlc_panel_bsjq');
					if($getXlcBsJqOptionQ === false) {
						add_option('xlc_panel_bsjq', $xlcBsJqOption, '', 'no');
					} else {
						update_option('xlc_panel_bsjq', $xlcBsJqOption, '', 'no');
					}
				}
				
				$panelEnableStatus	= '';
				
				$getTrxPanelOption = get_option('xl_panel_function');
				$getXlcBsJqOption = get_option('xlc_panel_bsjq');
				?>
				
			<form name="xlPanelForm" method="post" action="" style="max-width:450px;">
				<table class="table-collapse full-width">
					<tr>
						<td width="60%">Enable XL Panel :</td>
						<td width="40%" align="right">
							<input type="radio" name="panelEnable" value="enable" <?php if($getTrxPanelOption == 'enable') { echo 'checked'; } ?>> Enable 
							<input type="radio" name="panelEnable" value="disable" <?php if($getTrxPanelOption == 'disable') { echo 'checked'; } ?>> Disable
						</td>
					</tr>
					<tr>
						<td width="60%">Enable Own Bootstrap &amp; jQuery :</td>
						<td width="40%" align="right">
							<input type="radio" name="xlcBsJq" value="enable" <?php if($getXlcBsJqOption == 'enable') { echo 'checked'; } ?>> Enable 
							<input type="radio" name="xlcBsJq" value="disable" <?php if($getXlcBsJqOption == 'disable') { echo 'checked'; } ?>> Disable
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
							<span class="tips" title="Check if Enable => Option Name: xl_google_analytics (Value: enable / disable) &#10; Get Tracking Code => Option Name: xl_google_analytics_code"></span>
						</h3>
					</div>
					<div class="col col-right col2" style="width:80px;">
					</div>
					<div class="clearfix"></div>
				</div>
				<hr class="container-heading-divider" />
					
				<div class="inner-container-div">
				<?php
					if(isset($_POST['xlGABtn'])) {
						
						$xlGoogleAnalytics		= $_POST['xlGoogleAnalytics'];
						$xlGoogleAnalyticsCode	= $_POST['xlGoogleAnalyticsCode'];
						
						$xlGoogleAnalyticsCode	= stripslashes($xlGoogleAnalyticsCode);
						
						if(empty($xlGoogleAnalyticsCode)) {
							$xlGoogleAnalytics	= "disable";
						}
						
						$xlGoogleAnalyticsQ	 = get_option('xl_google_analytics');
						$xlGoogleAnalyticsCodeQ = get_option('xl_google_analytics_code');
						
						if($xlGoogleAnalyticsQ === false) {
							add_option('xl_google_analytics', $xlGoogleAnalytics, '', 'no');
						} else {
							update_option('xl_google_analytics', $xlGoogleAnalytics, '', 'no');
						}
						
						if($xlGoogleAnalyticsCodeQ === false) {
							add_option('xl_google_analytics_code', $xlGoogleAnalyticsCode, '', 'no');
						} else {
							update_option('xl_google_analytics_code', $xlGoogleAnalyticsCode, '', 'no');
						}
					}
					
					$xlGoogleAnalytics		= get_option('xl_google_analytics');
					$xlGoogleAnalyticsCode	= get_option('xl_google_analytics_code');
					?>
						
					<form name="xlPanelForm" method="post" action="" style="max-width:450px;">
						<table class="table-collapse full-width">
							<tr>
								<td width="60%">Enable Google Analytics :</td>
								<td width="40%" align="right">
									<input type="radio" name="xlGoogleAnalytics" value="enable" <?php if($xlGoogleAnalytics == 'enable') { echo 'checked'; } ?>> Enable 
									<input type="radio" name="xlGoogleAnalytics" value="disable" <?php if($xlGoogleAnalytics == 'disable') { echo 'checked'; } ?>> Disable
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<br/>
									<p class="no-margin"><b>Add your Tracking Code</b>:</p>
									<textarea class="full-width" name="xlGoogleAnalyticsCode" rows="4"><?php echo $xlGoogleAnalyticsCode; ?></textarea>
								</td>
							</tr>
							<tr>
								<td colspan="2" align="right">
									<hr class="margin-5 no-margin-rl" />
									<input type="submit" name="xlGABtn" class="button button-primary button-large container-action-btn" value="Save">
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
							<span class="tips" title="Check if Enable => Option Name: xl_google_recaptcha (Value: enable / disable) &#10; Get Site Key => Option Name: xl_recaptcha_sitekey &#10; Get Secret Key => Option Name: xl_recaptcha_secretkey"></span>
						</h3>
					</div>
					<div class="col col-right col2" style="width:80px;">
					</div>
					<div class="clearfix"></div>
				</div>
				<hr class="container-heading-divider" />
					
				<div class="inner-container-div">
				<?php
					if(isset($_POST['xlGrCBtn'])) {
						
						$xlGoogleReCaptcha		= $_POST['xlGoogleReCaptcha'];
						$xlRecaptchaSiteKey	= $_POST['xlRecaptchaSiteKey'];
						$xlRecaptchaSecretKey	= $_POST['xlRecaptchaSecretKey'];
						
						
						if( empty($xlRecaptchaSiteKey) || empty($xlRecaptchaSecretKey) ) {
							$xlGoogleReCaptcha	= "disable";
						}
						
						$xlGoogleReCaptchaQ	= get_option('xl_google_recaptcha');
						$xlRecaptchaSiteKeyQ 	= get_option('xl_recaptcha_sitekey');
						$xlRecaptchaSecretKeyQ = get_option('xl_recaptcha_secretkey');
						
						if($xlGoogleReCaptchaQ === false) {
							add_option('xl_google_recaptcha', $xlGoogleReCaptcha, '', 'no');
						} else {
							update_option('xl_google_recaptcha', $xlGoogleReCaptcha, '', 'no');
						}
						
						if($xlRecaptchaSiteKeyQ === false) {
							add_option('xl_recaptcha_sitekey', $xlRecaptchaSiteKey, '', 'no');
						} else {
							update_option('xl_recaptcha_sitekey', $xlRecaptchaSiteKey, '', 'no');
						}
						
						if($xlRecaptchaSecretKeyQ === false) {
							add_option('xl_recaptcha_secretkey', $xlRecaptchaSecretKey, '', 'no');
						} else {
							update_option('xl_recaptcha_secretkey', $xlRecaptchaSecretKey, '', 'no');
						}
					}
					
					$xlGoogleReCaptcha		= get_option('xl_google_recaptcha');
					$xlRecaptchaSiteKey	= get_option('xl_recaptcha_sitekey');
					$xlRecaptchaSecretKey	= get_option('xl_recaptcha_secretkey');
					?>
						
					<form name="xlPanelForm" method="post" action="" style="max-width:450px;">
						<table class="table-collapse full-width">
							<tr>
								<td width="60%">Enable Google reCAPTCHA :</td>
								<td width="40%" align="right">
									<input type="radio" name="xlGoogleReCaptcha" value="enable" <?php if($xlGoogleReCaptcha == 'enable') { echo 'checked'; } ?>> Enable 
									<input type="radio" name="xlGoogleReCaptcha" value="disable" <?php if($xlGoogleReCaptcha == 'disable') { echo 'checked'; } ?>> Disable
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<br/>
									<p class="no-margin"><b>Site Key</b>:</p>
									<input type="text" class="full-width" name="xlRecaptchaSiteKey" value="<?php echo $xlRecaptchaSiteKey; ?>" placeholder="6LftjEEUAAAAAEELcXP8OvQl548JcZbCMbGfW16C"/>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<br/>
									<p class="no-margin"><b>Secret key</b>:</p>
									<input type="text" class="full-width" name="xlRecaptchaSecretKey" value="<?php echo $xlRecaptchaSecretKey; ?>" placeholder="6LftjEEUAAAAANsBbhOl2cpVnTHcer-e-2xzxWtr"/>
								</td>
							</tr>
							<tr>
								<td colspan="2" align="right">
									<hr class="margin-5 no-margin-rl" />
									<input type="submit" name="xlGrCBtn" class="button button-primary button-large container-action-btn" value="Save">
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