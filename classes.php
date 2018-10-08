<?php
/*
 * *********************************************************************************************************************************************
 * Shortcode for Ajax Login with Registration form
 * This AJax login form works only with "Login With Ajax" plugin By "Marcus Sykes" | Plugin link: https://wordpress.org/plugins/login-with-ajax/
*/

class xlAjaxLogin {
	
	var $loginRedirect;
	
	function __construct() {
		if( is_page( 'checkout' ) ) {
			$this->loginRedirect	= XL_CURRENT_URL;
		} else if( current_user_can( 'xl_options' ) ) {
			$this->loginRedirect	= admin_url('index.php');
		} else if( current_user_can( 'manage_options' ) ) {
			
			$this->loginRedirect	= admin_url('index.php');
		} else if( defined( DASHBOARD_URL ) ) {
			
			$this->loginRedirect	= DASHBOARD_URL;
		} else {
			
			$this->loginRedirect	= XL_CURRENT_URL;
		}
	}
	
	function login_signup($lurl = null) {
		if(is_user_logged_in()) {
			echo "Please wait...";
			
			if( $lurl == null ) {
				$login_redirect	=  $this->loginRedirect;
			} else {
				$login_redirect	=  $lurl;
			}
			
			?>
			<script>
				var locationUrl = "<?php echo $login_redirect; ?>";
				window.location.replace(locationUrl);
			</script>
			<?php
		} else {
			
			$signupQuery	= '';
			if( get_query_var('qpage') && get_query_var('qpage') == 'signup') {
				$signupQuery	= 'signup';
			}
	?>
		<div id="xl-login-block" class="xl-login-block">
				<ul class="nav nav-tabs nav-justified">
					<li class="<?php if(empty($signupQuery)) { echo 'active'; } ?>"><a data-toggle="tab" href="#login-tab"><b>Login</b></a></li>
					<li class="<?php if($signupQuery == 'signup') { echo 'active'; } ?>"><a data-toggle="tab" href="#signup-tab"><b>Signup</b></a></li>
				</ul>

				<div class="tab-content">
					<div id="login-tab" class="tab-pane fade <?php if(empty($signupQuery)) { echo 'in active'; } ?>">
						<p class="please-login">Please login to continue</p>
						<?php echo do_shortcode('[login-with-ajax registration="0"]'); ?>
					</div>
					<div id="signup-tab" class="tab-pane fade <?php if($signupQuery == 'signup') { echo 'in active'; } ?>">
						<p class="please-signup">Please Signup Now</p>
						<?php
							echo do_shortcode('[xl_custom_registration]');
						?>
					</div>
				</div>
		</div>
	<?php
		}
	}

	
	/* ********************************************************** Shortcode for Ajax Login only form ******************************************************* */

	function login($lurl = null) {
		if(is_user_logged_in()) {
			echo "Please wait...";
			
			if ( $lurl == null ) {
				$location_url	=  $this->loginRedirect;
			} else {
				
				$location_url	=  $lurl;
			}
			
			?>
			<script>
				var locationUrl = "<?php echo $location_url; ?>";
				window.location.replace(locationUrl);
			</script>
			<?php
		} else {
			
			?>
			<div id="xl-login-block" class="xl-login-block">
				<div class="login-block-title">
					<h3 class="login-title">Please Login</h3>
				</div>
				<div class="tab-content">
					<div id="login-tab" class="tab-pane fade in active">
						<?php echo do_shortcode('[login-with-ajax registration="0"]'); ?>
					</div>
				</div>
			</div>
	<?php
		}
	}
}

class Xl_User_Auth {
	
	public function user_login_form($lurl = null) {
		?>
		<div id="userLoginForm_ajax_status"></div>
		
		<form name="userLoginForm" id="userLoginForm" class="full-width" method="post" action="" accept-charset="utf-8">
		<table id="user-login-table" class="fixed-layout">
			<tr style="visibility:hidden;">
				<th width="15%"></th>
				<th width="15%"></th>
				<th width="15%"></th>
				<th width="15%"></th>
				<th width="15%"></th>
				<th width="25%"></th>
			</tr>
			<tr class="xua-username">
				<td colspan="2" class="xua-username-label">
					<label>Username</label>
				</td>
				<td colspan="4" class="xua-username-input">
					<input type="text" name="username" id="username" class="reqField" />
				</td>
			</tr>
			<tr class="xua-password">
				<td colspan="2" class="xua-password-label">
					<label>Password</label>
				</td>
				<td colspan="4" class="xua-password-input">
					<input type="password" name="pwd" id="pwd" class="reqField" />
				</td>
			</tr>
			<tr>
				<td colspan="6"></td>
			</tr>
			<tr class="xua-submit">
				<td colspan="4" class="xua-submit-links">
					<input name="rememberme" id="rememberme" type="checkbox" class="xua-rememberme" value="forever"> 
					<label for="rememberme">Remember Me</label>
					<br>
					<a class="xua-links-remember" href="" title="Password Lost and Found">Lost your password?</a>
				</td>
				<td colspan="2" class="xua-submit-button">
					<input type="submit" name="xua_login_submit" id="xua_login_submit" value="Log In">
				</td>
			</tr>
		</table>
		</form>
		<?php
	}
	
	public function user_login($lurl = null) {
		if(is_user_logged_in()) {
			echo "Hello... You are Loggedin.";
		} else {
			?>
			<div id="xl-login-block" class="xl-login-block">
				<div class="login-block-title">
					<h3 class="login-title">Please Login</h3>
				</div>
				<div class="tab-content">
					<div id="login-tab" class="tab-pane fade in active">
						<?php
							self::user_login_form($lurl);
						?>
					</div>
				</div>
			</div>
			<?php
		}
	}
}


/* ******************************************************************** Class xlFileUploader ******************************************************************** */
class xlFileUploader {
	
	var $files;
	var $upload_dir;
	var $size_limit;
	var $file_type;
	var $rename;
	var $loaded_file;
	var $status = FALSE;
	var $error_msg = '';
	
	function __construct($files, $upload_dir, $size_limit, $file_type = null, $rename) {
	
		/* $upload_dir_path	= ACP_UPLOAD_DIR_PATH . 'template-files/'; */
		$upload_dir_path	= $upload_dir;
		
		if (! is_dir($upload_dir_path)) {
			mkdir( $upload_dir_path, 0755 );
		}
		
		$filesErr	= '';
		$files		= $files;
			
		$files_basename	= basename($files["name"]);
		if($rename === TRUE) {
			$files_basenameExt	= explode('.', $files_basename);
			$files_basename	= $files_basenameExt[0] .'-'. date("ymdHi") .'.'. end($files_basenameExt);
		}
		
		$target_file	= $upload_dir_path . $files_basename;
		
		
		/* **************************** Check file size **************************** */
		if( !empty($files["tmp_name"]) ) {
			
			$files_size	= $files["size"];
			if ($files_size > ($size_limit * 1024) ) {
				$errorMsg	= 'Sorry, file size more than '. $size_limit .'kb not allowed.';
			}
		}
		if(empty($errorMsg)) {
			
			/* **************************** Allow certain file formats **************************** */
			$uFileType	= strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			if($file_type !== null) {
				if(!in_array($uFileType, $file_type)) {
					$errorMsg	= 'Sorry, only JPG, JPEG, PNG &amp; GIF files are allowed.';
				}
			}
			
			/* **************************** Move file to the Target Dir **************************** */				
			if( empty($errorMsg) && $errorMsg == '' ) {
				if( move_uploaded_file($files["tmp_name"], $target_file) ) {
					$this->status	= TRUE;
					$this->loaded_file	= $files_basename;
				} else {
					$errorMsg	= 'Sorry, there was an error uploading your file.';
				}
			}
		}
		
		if( !empty($errorMsg) && ($errorMsg !== '') ) {
			$this->error_msg	= $errorMsg;
		}
	}
}