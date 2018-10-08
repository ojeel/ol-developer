<?php
/**
 * Template Name: OL Panel Index
 */

if( ! defined( 'WPINC' ) ) {
	die();
}

class olPanel {
	
	var $panelId;
	var $panelCap;
	var $panelUrl;
	var $contentDir;
	
	function __construct($pid,$pcap,$purl,$cdir) {
		$this->panelId		= $pid;
		$this->panelCap		= $pcap;
		$this->panelUrl		= $purl;
		$this->contentDir	= $cdir;
	}
	
	function ol_panel_logo_func() {
		$logoOptionName	= $this->panelId . '_logo';
		$get_panel_logo	= get_option($logoOptionName);
		
		if( ($get_panel_logo !== false) || ( !empty($get_panel_logo) ) ) {
			$panelLogo = OL_UPLOAD_DIR_URL .'/'. $get_panel_logo;
		} else {
			$panelLogo = OLDEV_URL . "/ol-panel/img/panel-logo.png";
		}
		return $panelLogo;
	}
	
	function ol_dashboard() {
		
		$getXlcBsJq = get_option('ol_panel_bsjq');
		if( $getXlcBsJq !== 'disable' ) {
		
			/*** Latest compiled and minified CSS ***/
			wp_enqueue_style( 'olp_bootstrap_lcmcss', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' );
			
			/*** FontAwesome ***/
			wp_enqueue_style( 'olp_fontawesome_css', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
			
			/*** jQuery library ***/
			wp_enqueue_script( 'olp_google_jqlib', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js' );
			
			/*** Latest compiled JavaScript ***/
			wp_enqueue_script( 'olp_bootstrap_lcjs', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' );
		
			/*** Google jqueryui for DatePicker ***/
			wp_enqueue_style( 'olp_style_DatePicker', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css' );
			wp_enqueue_script( 'olp_jquery_DatePicker', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js' );
		}
		
		
		/*** Xl Panel Custom CSS ***/
		wp_enqueue_style( 'olp_pccss', OLDEV_URL .'/ol-panel/styles/stylesheet.css' );
		
		/*** Xl Panel Custom JS ***/
		wp_enqueue_script( 'olp_pcjs', OLDEV_URL .'/ol-panel/styles/script.js' );
		
		
	$getXlPanelOption = get_option('ol_panel_function');
	
	if( is_user_logged_in() ) {
			
		if( $getXlPanelOption == 'enable' ) {
		if (!current_user_can($this->panelCap)) {
?>
			
			<div style="background-color: #f0f0f0;padding:30px 10px;">
				<div style="max-width:650px; margin:auto;">
					<p class="error-msg" style="margin:0;padding:10px 0;">Ooops...<br>Requested page is not available or unauthorized access.</p>
				</div>
			</div>
<?php
		} else {

			$document_title = "";
			
			$popMessage	= '';
			
			global $wpdb;
			
			date_default_timezone_set("Asia/Kolkata");
			
			echo '<div id="ol-panel-'. $this->panelId .'">';
				
				$profileAvatar	= OLDEV_URL . "/ol-panel/img/profile-avatar.png";
				$siteUrl		= get_bloginfo('url');
				
?>
				<!-- ***************************************************** OL Loader *********************************************************** -->
				<div id="ol-loader"></div>
				
				<!-- ***************************************************** Top Bar *********************************************************** -->
				<div class="ol-container ol-panel-container">
					<div class="ol-container-inner">
					
						<div class="row panel">
							<div class="col-xs-4 col-sm-3 col-md-2 no-padding panel-col eq-height">
								<div class="panel-logo">
									<?php
										$ol_panel_logo_func	= self::ol_panel_logo_func();
										$olPanelLogo	= apply_filters('ol_panel_logo', $ol_panel_logo_func );
									?>
									<img src="<?php echo $olPanelLogo; ?>" class="img-responsive" alt="">
								</div>
										
								<div class="nav-side-menu">
								
									<!-- SIDEBAR USERPIC -->
									<div class="panel-userpic">
										<img src="<?php echo $profileAvatar; ?>" class="img-responsive" alt="">
									</div>
									
									<!-- SIDEBAR USER TITLE -->
									<div class="panel-usertitle">
										<div class="panel-usertitle-name">
<?php
												$currentUser_info	= ol_current_user();
												$currentUser_Id		= $currentUser_info['userId'];
												echo $currentUser_info['displayName'];
?>
										</div>
									</div>
										
									<!-- SIDEBAR BUTTONS -->
									<div class="panel-userbuttons">
										<a  href="<?php echo add_query_arg( 'spg', 'profile', $this->panelUrl ); ?>"><button type="button" class="btn btn-success btn-sm">Profile</button></a>
										<a  href="<?php echo wp_logout_url( get_bloginfo( 'url' ) ); ?>"><button type="button" class="btn btn-danger btn-sm">Logout</button></a>
									</div>
									
									<!-- ********************************************** SIDEBAR MENU *************************************************** -->
								
									<i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
									<div class="menu-list">
										<ul id="menu-content" class="menu-content collapse out">
										
<?php
										
										// Navigation Data query from DB
										$olNavDataQ	= $wpdb->get_results("SELECT * FROM {$wpdb->prefix}ol_panel_nav WHERE panel_id = '{$this->panelId}' AND is_subnav = 'No' AND status = 'active' ORDER BY short_value ASC");
											
										if( ($wpdb->num_rows) >= 1) {
											
											foreach($olNavDataQ as $olNavData) {
												$acp_nId	= $olNavData->id;
												$acp_nTitle	= $olNavData->nav_title;
												$acp_nSlug	= $olNavData->nav_slug;
												$acp_nIcon	= $olNavData->nav_icon;
												
												// Sub Menu Data query from DB
												$olSubNavDataQ	= $wpdb->get_results("SELECT * FROM {$wpdb->prefix}ol_panel_nav WHERE parent_id = '{$acp_nId}' AND status = 'active' ORDER BY short_value ASC");
												if( ($wpdb->num_rows) == 0) {
													echo '
														<li>
															<a class="nav" href="'. add_query_arg( 'spg', $acp_nSlug, $this->panelUrl ) .'">
																<i class="'. $acp_nIcon .'"></i> '. $acp_nTitle .'
															</a>
														</li>
													';
												
												} else {
													
													echo '
													<li data-toggle="collapse" data-target="#'. $acp_nSlug .'" class="collapsed parent_nav">
													  <a class="nav" href="#"><i class="'. $acp_nIcon .'"></i> '. $acp_nTitle .' <span class="arrow"></span></a>
													</li>
													<ul class="sub-menu collapse" id="'. $acp_nSlug .'">
													';
													foreach($olSubNavDataQ as $olSubNavData) {
														$acp_snId		= $olSubNavData->id;
														$acp_snTitle	= $olSubNavData->nav_title;
														$acp_snSlug		= $olSubNavData->nav_slug;
														
														echo '
														<li class="sub-nav current_page"><a class="nav" href="'. add_query_arg( 'spg', $acp_snSlug, $this->panelUrl ) .'">'. $acp_snTitle .'</a></li>
														';
													}
													
													echo '
													</ul>
													';
												}
											}										
										}
										
?>
										</ul>
									</div><!-- menu-list -->
										
		<!-- ****************************************************************** END SIDEBAR MENU ****************************************************************** -->
								</div><!-- nav-side-menu -->
							</div>
							<div class="col-xs-8 col-sm-9 col-md-10 page-container eq-height">
<?php
									$pageSlug	= '';
									
									if(get_query_var("spg")) {
										$pageSlug	= get_query_var("spg");
										
										$olPageDataQ	= $wpdb->get_results("SELECT page_title,page_src FROM {$wpdb->prefix}ol_panel_nav WHERE panel_id = '{$this->panelId}' AND nav_slug = '{$pageSlug}'");
											
										if( ($wpdb->num_rows) == 1) {
											
											foreach($olPageDataQ as $olPageData) {
												$acp_pTitle	= $olPageData->page_title;
												$acp_pSrc	= $olPageData->page_src;
											}
?>
											<div class="row title-bar no-margin">
												<div id="top-left-action" class="col-sm-2 title-bar-left pull-left"></div>
												
												<div class="col-sm-8 title-bar-center pull-left">
													<h3 class="page-title" id="acp-page-title"><?php echo $acp_pTitle; ?></h3>
												</div>
												
												<div id="top-right-action" class="col-sm-2 title-bar-right pull-right"></div>
											</div>
											<div class="outer-container">
												<div class="inner-container panel-content">
												   <?php include($this->contentDir . $acp_pSrc); ?>
												</div>
											</div>
<?php
										} else {
											echo '<p class="warning-msg">Ooops... Something going wrong, Or<br>Unauthorize Access</p>';
										}
									} else {
?>
										<div class="title-bar">
											<h3 class="page-title">Dashboard</h3>
										</div>
										<div class="outer-container">
											<div class="inner-container panel-content">
											   <?php include($this->contentDir . 'dashboard-content.php'); ?>
											</div>
										</div>
						
							<?php	}	?>
								</div>
						</div>
					</div>
				</div>
				
				<!-- ******************************************************** Panel Outer contents ******************************************************** -->
				<div class="ol-outer-panel">
					<?php
						do_action('ol_outer_panel');
					?>
				</div>
				
				<?php
				
				
				/******************************************************************* Override Page Title *****************************************************/
				if($document_title != '') {
					?>
					<script>
						document.title = '<?php echo $document_title ." - ". get_bloginfo("name"); ?>';
					</script>
					<?php
				} else {
					if($pageSlug != '') {
						$olPageTtlQ	= $wpdb->get_results("SELECT page_title FROM {$wpdb->prefix}ol_panel_nav WHERE panel_id = '{$this->panelId}' AND nav_slug = '{$pageSlug}'");
						foreach($olPageTtlQ as $olPageTtl) {
							$docTitle	= $olPageTtl->page_title;
						}
					} else {
						$docTitle	= "Dashboard";
					}
					?>
					<script>
						document.title = '<?php echo $docTitle ." - ". get_bloginfo("name"); ?>';
					</script>
					<?php
				}
				
			echo '</div>';
		}
		} else {
			echo '<p class="error-msg">Error...!<br>OL Panel is not Enabled.</p>';
		}
	} else {
		echo '<div class="ol-login-div">';
		
			$olLogin		= new olAjaxLogin;
			echo $olLogin->login();
			
		echo '</div>';
	}
	}
}