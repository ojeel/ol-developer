<?php
/**
 * Template Name: OL Panel Option
 */ 
$stylePath = OLDEV_PATH . "assets/styles/admin-style.php";
include_once($stylePath);

if ( ! defined( 'WPINC' ) ) {
	die;
}

global $wpdb;

/***************** Setting Default Time zone *****************/

date_default_timezone_set("Asia/Kolkata");
?>
<div class="main-container">
	<div class="container-div">
		<div class="row">
			<div class="col col-left col1" style="width:45%;">
				<h1 class="container-heading">OL Panel Option</h1>
			</div>
			<div class="col col-left col1" style="width:45%;">
			</div>
			<div class="col col-right col2" style="width:80px;">
				<button class="button button-primary button-large container-action-btn" onclick="addNewForm()">Add New</button>
			</div>
			<div class="clearfix"></div>
		</div>
		<hr />
		
		
		<div class="inner-container-div">
			<?php
				$panelOptionUrl	= admin_url('admin.php?page=ol-panel-option');
				$qpage	= '';
				if(isset($_GET["qpage"])) {
					$qpage	= $_GET["qpage"];
				}
				
			?>
			
			<div class="row tabs-container">
				<div class="col col-left nav-tabs" style="width:20%;">
					<a href="<?php echo $panelOptionUrl; ?>">
						<div class="<?php echo ( ($qpage == '') ? 'active-nav' : 'inactive-nav' );?>">
							<h3 class="nav-tab-heading">Panel Navigations</h3>
						</div>
					</a>
				</div>
				<div class="col col-left nav-tabs" style="width:20%;">
					<a href="<?php echo add_query_arg( 'qpage', 'manage-panels', $panelOptionUrl ); ?>">
						<div class="<?php echo ( ($qpage == 'manage-panels') ? 'active-nav' : 'inactive-nav' ); ?>">
							<h3 class="nav-tab-heading">Manage Panels</h3>
						</div>
					</a>
				</div>
				<div class="col col-left nav-tabs" style="width:60%;">	
					<div class="empty-nav">
						<h3 class="nav-tab-heading">&nbsp;</h3>
					</div>
				</div>
				<div class="clearfix"></div>
			</div><!-- tabs-container -->
			<?php
			/**************************************************** Add Nav Form Validation ****************************************************/
			
			$errorMsg	= '';
			if(isset($_POST['addNavBtn'])) {
				$panel_id		= $_POST['panel_id'];
				if( empty($panel_id) ) {
					$errorMsg	.= 'Panel Id is required<br>';
				}
				
				$nav_title		= $_POST['nav_title'];
				if( empty($nav_title) ) {
					$errorMsg	.= 'Navigation Title is required<br>';
				}
				
				$nav_slug		= $_POST['nav_slug'];
				if( empty($nav_slug) ) {
					$errorMsg	.= 'Navigation Slug is required<br>';
				}
				
				$is_subnav		= $_POST['is_subnav'];
				
				$parent_nav_id		= $_POST['parent_nav_id'];
				if( ($is_subnav == 'Yes') && empty($parent_nav_id) ) {
					$errorMsg	.= 'Parent Id is required for Subnav<br>';
				}
				
				$short_value	= $_POST['short_value'];
				if( empty($short_value) ) {
					$errorMsg	.= 'Shorting position is required<br>';
				}
				
				$nav_icon		= $_POST['nav_icon'];
				
				$page_title		= $_POST['page_title'];
				if( empty($page_title) ) {
					$errorMsg	.= 'Page Title is required<br>';
				}
				
				$page_src		= $_POST['page_src'];
				if( empty($page_src) ) {
					$errorMsg	.= 'Page Source is required<br>';
				}
				$datetime	= date('Y-m-d H:i:s');
				
				if(empty($errorMsg)) {
					$insertNavData	= $wpdb->insert(
						$wpdb->prefix .'ol_panel_nav',
						array(
							'panel_id' 		=> $panel_id,
							'nav_title' 	=> $nav_title,
							'nav_slug' 		=> $nav_slug,
							'status' 		=> 'active',
							'is_subnav' 	=> $is_subnav,
							'parent_id' 	=> $parent_nav_id,
							'short_value' 	=> $short_value,
							'nav_icon' 		=> $nav_icon,
							'page_title' 	=> $page_title,
							'page_src'	 	=> $page_src,
							'datetime'	 	=> $datetime
						),
						array(
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%d',
							'%d',
							'%s',
							'%s',
							'%s',
							'%s'
						)
					);
					
					if( $insertNavData === false) {
						$popMessage	= $insertNavStatus	= '<p class="error-msg">Failed...Unable to save submitted data.<br>'. $wpdb->last_error .'</p>';
						
						echo '<body onload="addNewForm()"></body>';
						
					} else {
						$popMessage = $insertNavStatus	= '<p class="success-msg">Success... Details saved successfully.</p>';
						echo '
							<body onload="dispPopMessageDiv()"></body>
							<body onload="resetOnSuccess()"></body>
						';
					}
				} else {
					$popMessage = '<p class="error-msg">'. $errorMsg .'</p>';
					echo '<body onload="addNewForm()"></body>';
				}
			}
			?>
			<div class="tab-content">
				<?php
				if($qpage == 'manage-panels') {
					
				} else {
				?>
					<table id="data-list-table" class="data-list-table table-collapse full-width" cellpadding="2">
						<tr id="tr-header">
							<th width="60">ID.</th>
							<th width="105">Panel Id</th>
							<th width="150">Nav Title</th>
							<th width="150">Nav Slug</th>
							<th width="80">Status</th>
							<th width="80">Subnav</th>
							<th width="70">Parent Id</th>
							<th width="70">Short</th>
							<th >Page Src</th>
							<th width="105"></th>
						</tr>
						
						<?php
						// Get Live Courses List
						
						$olNavDataQ = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}ol_panel_nav ORDER BY panel_id,id DESC;");
						
						if( ($wpdb->num_rows) > 0 ) {
							$sln	= 1;
							foreach($olNavDataQ as $olNavData) {
								$navId		= $olNavData->id;
								$panelId	= $olNavData->panel_id;
								$navTitle	= $olNavData->nav_title;
								$navSlug	= $olNavData->nav_slug;
								$status		= $olNavData->status;
								$isSubnav	= $olNavData->is_subnav;
								$parentId	= $olNavData->parent_id;
								$shortVal	= $olNavData->short_value;
								$pageSrc	= $olNavData->page_src;
								?>
								<tr>
									<td class="" align="center"><?php echo $navId; ?></td>
									<td class=""><?php echo $panelId; ?></td>
									<td class="text-left"><?php echo $navTitle; ?></td>
									<td class="text-left"><?php echo $navSlug; ?></td>
									<td class=""><?php echo $status; ?></td>
									<td class=""><?php echo $isSubnav; ?></td>
									<td class=""><?php echo $parentId; ?></td>
									<td class=""><?php echo $shortVal; ?></td>
									<td class="text-left"><?php echo $pageSrc; ?></td>
									
									<td class="as-td text-center" align="center">
										<?php
											$view_url	= admin_url('admin.php?page=single-course-faqs-view');
										?>
										<a href="<?php echo add_query_arg( array( 'action' => 'edit', 'qid' => $navId ), $panelOptionUrl ); ?>">
											<button class="pointer btn-yellow" >Edit</button>
										</a>
									</td>
								</tr>
								<?php
								
								$sln++;
							}
						}
					echo '</table>';
				}
			?>
			</div><!-- tab-content -->
		
		</div><!-- inner-container-div -->
		
		<!--************************************** Add New Popup ********************************************* -->
		<div class="ol-popup-container" id="ol-popup-container" style="display:none;">
			<div class="ol-popup-inner">
				<div class="ol-pop-close" onclick="hidePopDiv()">
					<h1 class="pop-close-x">X</h1>
				</div>
				
				<h2 class="container-heading text-center">Add New Navigation</h2>
				<?php
				if(!empty($popMessage)) {
					echo $popMessage;
				}
				?>
				<form id="newNavForm" name="newNavForm" method="post" action=""  style="max-width:650px;margin:auto;">
				<table class="ol-table full-width">
					<tr>
						<th width="16.666%"></th>
						<th width="16.666%"></th>
						<th width="16.666%"></th>
						<th width="16.666%"></th>
						<th width="16.666%"></th>
						<th width="16.666%"></th>
					</tr>
					<tr>
						<td colspan="2">
							<p class="no-margin-bottom bold">Panel Id<span class="red-star">*</span> :</p>
							<input type="text" name="panel_id" class="full-width" value="<?php echo $panel_id; ?>" placeholder="olacp" />
						</td>
						<td colspan="2">
							<p class="no-margin-bottom bold">Nav Title<span class="red-star">*</span> :</p>
							<input type="text" name="nav_title" class="full-width" value="<?php echo $nav_title; ?>" placeholder="Navigation Title to Display" />
						</td>
						<td colspan="2">
							<p class="no-margin-bottom bold">Nav Slug<span class="red-star">*</span> :</p>
							<input type="text" name="nav_slug" class="full-width" value="<?php echo $nav_slug; ?>" placeholder="navigation-slug" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<p class="no-margin-bottom bold">Is Subnav :</p>
							<select name="is_subnav" class="full-width">
								<option value="No">No</option>
								<option value="Yes">Yes</option>
							</select>
						</td>
						<td colspan="2">
							<p class="no-margin-bottom bold">Parent Id :</p>
							<input type="number" name="parent_nav_id" class="full-width" value="<?php echo $parent_nav_id; ?>" placeholder="0" />
						</td>
						<td colspan="2">
							<p class="no-margin-bottom bold">Short Value :</p>
							<input type="text" name="short_value" class="full-width" value="<?php echo $short_value; ?>" placeholder="1" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<p class="no-margin-bottom bold">Nav Icon :</p>
							<input type="text" name="nav_icon" class="full-width" value="<?php echo $nav_icon; ?>" placeholder="Font Awesome Icon Class" />
						</td>
						<td colspan="2">
							<p class="no-margin-bottom bold">Page Title<span class="red-star">*</span> :</p>
							<input type="text" name="page_title" class="full-width" value="<?php echo $page_title; ?>" placeholder="Page Title (for Page Header)" />
						</td>
						<td colspan="2">
							<p class="no-margin-bottom bold">Page Source<span class="red-star">*</span> :</p>
							<input type="text" name="page_src" class="full-width" value="<?php echo $page_src; ?>" placeholder="folder/content-source.php (Source File)" />
						</td>
					</tr>
					<tr>
						<td colspan="3">
						</td>
						<td colspan="3" align="right" valign="bottom">
							<input type="submit" name="addNavBtn" class="button button-primary button-large container-action-btn" value="Save"/>
						</td>
					</tr>
				</table>
				</form>
			</div>
		</div>
		
		<!--************************************** Add New Popup ********************************************* -->
		<div class="ol-popup-container" id="ol-popmessage-container" style="display:none;">
			<div class="ol-popup-inner">
				<div class="ol-pop-close" onclick="hidePopDiv()">
					<h1 class="pop-close-x">X</h1>
				</div>
				<div>
					<?php
						echo $popMessage;
					?>
				</div>
			</div>
		</div>
	
		<script>
			function addNewForm() {
				document.getElementById('ol-popup-container').style.display = 'inherit';
			}
			function hidePopDiv() {
				document.getElementById('ol-popup-container').style.display = 'none';
				document.getElementById('ol-popmessage-container').style.display = 'none';
			}
			function dispPopMessageDiv() {
				document.getElementById('ol-popmessage-container').style.display = 'inherit';
			}
			function resetOnSuccess() {
				$('#newNavForm')[0].reset();
			}
		</script>
		
		
		
	</div><!-- main-container -->
</div><!-- container-div -->