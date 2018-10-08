<?php
/**
 * Template Name: OL Country Data
 */ 
$stylePath = OLDEV_PATH . "assets/styles/admin-style.php";
include_once($stylePath);

global $wpdb;
date_default_timezone_set("UTC");

?>
<style>
.ol-popup-container {
	position: fixed;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background: rgba(0, 0, 0, 0.6);
	z-index: 99998;
	
}
.ol-popup-inner {
	position: relative;
	top: 10%;
	width: 80%;
	height: auto;
	max-width: 550px;
	margin: auto;
	padding: 15px;
	background-color: #fff;
	border-radius: 10px;
}
.ol-pop-close {
	position: absolute;
    top: 0;
    right: 0;
    width: 40px;
    height: 40px;
    margin-top: -15px;
    margin-right: -15px;
    background-color: rgba(56, 56, 56, 0.8);
    border: 2px solid rgba(150, 150, 150, 0.8);
    border-radius: 50px;
	cursor: pointer;
}
h1.pop-close-x {
	color: #fff !important;
    padding: 4px;
    margin: 0 !important;
    text-align: center;
}

</style>

<div class="main-container">
	<div class="container-div">	
		<div class="row no-margin">
			<div class="col col-left col1" style="width:25%;">
				<h1 class="container-heading">Country Details</h1>
			</div>
			<div class="col col-right col2" style="width:80px;">
				<button onclick="dispPopDiv()" class="button button-primary button-large container-action-btn">Add New</button>
			</div>
			<div class="clearfix"></div>
		</div>
		<hr />
		
<?php
		$popMessage = '';
		$fError		= '';
		
		/*************** Validating Add new form data ***************/
		if(isset($_POST["addCountryBtn"])) {
			$ncName		= $_POST["countryName"];
			$ncCode		= $_POST["countryCode"];
			$nDialCode	= $_POST["dialCode"];
			$currName	= $_POST["currName"];
			$currCode	= $_POST["currCode"];
			$currRate	= $_POST["currRate"];
			$nTimezone	= $_POST["timezone"];
			
			
			if(empty($ncName)) {
				$fError	.= $ncNameErr	= "Country Name Required, ";
			}
			if(empty($ncCode)) {
				$fError	.= $ncCodeErr	= "Country Code Required, ";
			}
			if(empty($nDialCode)) {
				$fError	.= $nDialCodeErr	= "Dial Code Required, ";
			}
			if(empty($currName)) {
				$fError	.= $currNameErr	= "Currency Name Required, ";
			}
			if(empty($currCode)) {
				$fError	.= $currCodeErr	= "Currency Code Required, ";
			}
			if(empty($currRate)) {
				$fError	.= $currRateErr	= "Currency Rate Required, ";
			}
			if(empty($nTimezone)) {
				$fError	.= $nTimezoneErr	= "Select Time Zone";
			}
			
			$dateTimeNow	= date('Y-m-d H:i:s');
			
			if(empty($fError)) {
					
				$existingDataQ	= $wpdb->get_results("SELECT id,countryCode FROM {$wpdb->prefix}ol_country_data WHERE countryCode = '{$ncCode}'");
				$existingDataCount	= $wpdb->num_rows;
				if($existingDataCount >= 1) {
					$popMessage = '<p class="error-msg">Country code: '. $ncCode .' ('. $ncName .') already exist.</p>';
					
					echo '
						<body onload="dispPopMessageDiv()"></body>
					';
					
				} else {
				
					$formDataInsert	= $wpdb->insert(
						$wpdb->prefix . 'ol_country_data',
						array(
							'countryCode'	=> $ncCode,
							'countryName'	=> $ncName,
							'dialCode'		=> $nDialCode,
							'currency'		=> $currCode,
							'currencyName'	=> $currName,
							'currencyRate'	=> $currRate,
							'timezone'		=> $nTimezone,
							'rateUpdatedOn'	=> $dateTimeNow,
							'timestamp'		=> $dateTimeNow
						),
						array(
							'%s',
							'%s',
							'%d',
							'%s',
							'%s',
							'%f',
							'%s',
							'%s',
							'%s'
						)
					);
					
					if($formDataInsert !== false) {
						$popMessage = '<p class="success-msg">Success... Your details has been saved.</p>';
						
						echo '
							<body onload="dispPopMessageDiv()"></body>
							<body onload="resetOnSuccess()"></body>
						';
						
					} else {
						$popMessage = '<p class="error-msg">Ooops... Unable save details.<br>'. $wpdb->last_error .'</p>';
						
						echo '
							<body onload="dispPopDiv()"></body>
						';
					}
				}
			} else {
				$popMessage = $fError;
				
				echo '
					<body onload="dispPopDiv()"></body>
				';
			}
		}
			
		$countryDataQuery = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}ol_country_data ORDER BY countryName ASC" );
		$countryDataCount = $wpdb->num_rows;
		
		?>
			
		<div class="inner-container-div">
			
			<table id="data-list-table" class="data-list-table table-collapse full-width" cellpadding="2">
					<tr id="tr-header">
						<th class="as-td"><p class="no-margin as-label-h">SL No.</p></th>
						<th class="as-td"><p class="no-margin as-label-h">Country Name</p></th>
						<th class="as-td"><p class="no-margin as-label-h">Code</p></th>
						<th class="as-td"><p class="no-margin as-label-h">Dial Code</p></th>
						<th class="as-td"><p class="no-margin as-label-h">Currency</p></th>
						<th class="as-td"><p class="no-margin as-label-h">Rate</p></th>
						<th class="as-td"><p class="no-margin as-label-h">Updated On</p></th>
						<th class="as-td"><p class="no-margin as-label-h">Timezone</p></th>
						<th class="as-td"><p class="no-margin as-label-h">Current Time</p></th>
						<th class="as-td"><p class="no-margin as-label-h"></p></th>
					</tr>
<?php 
					
					$csl	= 1;
					foreach($countryDataQuery as $countryData) {
						$id				= $countryData->id;
						$countryCode	= $countryData->countryCode;
						$countryName	= $countryData->countryName;
						$dialCode		= $countryData->dialCode;
						$currency		= $countryData->currency;
						$currencyName	= $countryData->currencyName;
						$currencyRate	= $countryData->currencyRate;
						
						$rateUpdated_nf	= $countryData->rateUpdatedOn;
						$rateUpdatedS	= date("d-M-Y", strtotime($rateUpdated_nf));
						$rateUpdatedF	= date("d-M-Y h:i A", strtotime($rateUpdated_nf));
						
						$timezone_nf	= $countryData->timezone;
						$timezone		= str_replace('.5', ':30', $timezone_nf);
						$timezone		= str_replace('.75', ':45', $timezone);
						
						$timeDiff	= ( $timezone_nf * 60 );
						
						$cLocalTimeNow	= date( 'd-M-Y h:i A', strtotime("+{$timeDiff} minutes") );
						
						$view_link		= "admin.php?page=ol-lms-single-view&lms-id=". $id;
						$edit_link		= "admin.php?page=ol-lms-edit&lms-id=". $id;
?>
						<tr>
							<td class="as-td" align="center"><p class="no-margin as-label"><?php echo $csl; ?></p></td>
							<td class="as-td"><p class="no-margin as-label"><?php echo $countryName; ?></p></td>
							<td class="as-td" align="center"><p class="no-margin as-label"><?php echo $countryCode; ?></p></td>
							<td class="as-td" align="center"><p class="no-margin as-label"><?php echo $dialCode; ?></p></td>
							<td class="as-td" align="center"><p class="no-margin as-label"><?php echo $currency; ?></p></td>
							<td class="as-td" align="center"><p class="no-margin as-label"><?php echo $currencyRate; ?></p></td>
							<td class="as-td text-center"><p class="no-margin as-label"><span title="<?php echo $rateUpdatedF; ?>"><?php echo $rateUpdatedS; ?></span></p></td>
							<td class="as-td" align="center"><p class="no-margin as-label">UTC<?php echo $timezone; ?></p></td>
							<td class="as-td" align="center"><p class="no-margin as-label"><?php echo $cLocalTimeNow; ?></p></td>
							
							<td class="as-td text-center" align="center">
								<p class="no-margin as-label">
									<a href="<?php echo $edit_link; ?>"><button class="pointer btn-yellow"><?php echo "Edit"; ?></button></a>
								</p>
							</td>
						</tr>
<?php
					$csl++;
					}
?>
			</table>
		</div>
	</div>
	
	<!--************************************** Add New Popup ********************************************* -->
	<div class="ol-popup-container" id="ol-popup-container" style="display:none;">
		<div class="ol-popup-inner">
			<div class="ol-pop-close" onclick="hidePopDiv()">
				<h1 class="pop-close-x">X</h1>
			</div>
			
			<h2 class="container-heading text-center">Add a New Country Data</h2>
			<?php
			if(!empty($popMessage)) {
				echo $popMessage;
			}
			?>
			<form name="newTrainerForm" method="post" action=""  style="max-width:450px;margin:auto;">
			<table class="ol-table full-width">
				<tr>
					<td width="40%">Country Name<span class="red-star">*</span> :</td>
					<td width="60%"><input type="text" name="countryName" class="full-width" value="<?php echo $ncName; ?>" placeholder="India" /></td>
				</tr>
				<tr>
					<td width="50%">Country Code<span class="red-star">*</span> :</td>
					<td width="50%"><input type="text" name="countryCode" class="full-width" value="<?php echo $ncCode; ?>" placeholder="IN" /></td>
				</tr>
				<tr>
					<td width="50%">Dial Code<span class="red-star">*</span> :</td>
					<td width="50%"><input type="number" name="dialCode" class="full-width" value="<?php echo $nDialCode; ?>" placeholder="91" /></td>
				</tr>
				<tr>
					<td width="50%">Currency Name<span class="red-star">*</span> :</td>
					<td width="50%"><input type="text" name="currName" class="full-width" value="<?php echo $currName; ?>" placeholder="Indian Rupee" /></td>
				</tr>
				<tr>
					<td width="50%">Currency Code<span class="red-star">*</span> :</td>
					<td width="50%"><input type="text" name="currCode" class="full-width" value="<?php echo $currCode; ?>" placeholder="INR" /></td>
				</tr>
				<tr>
					<td width="50%">Currency Rate<span class="red-star">*</span> :</td>
					<td width="50%"><input type="number" name="currRate" class="full-width" step=".01" value="<?php echo $currRate; ?>" placeholder="56.48" /></td>
				</tr>
				<tr>
					<td width="50%">Timezone<span class="red-star">*</span> :</td>
					<td width="50%">
						<select name="timezone" class="full-width">
							<option value="">-- Select A Timezone --</option>
							<option value="-12">UTC-12</option>
							<option value="-11.5">UTC-11:30</option>
							<option value="-11">UTC-11</option>
							<option value="-10.5">UTC-10:30</option>
							<option value="-10">UTC-10</option>
							<option value="-9.5">UTC-9:30</option>
							<option value="-9">UTC-9</option>
							<option value="-8.5">UTC-8:30</option>
							<option value="-8">UTC-8</option>
							<option value="-7.5">UTC-7:30</option>
							<option value="-7">UTC-7</option>
							<option value="-6.5">UTC-6:30</option>
							<option value="-6">UTC-6</option>
							<option value="-5.5">UTC-5:30</option>
							<option value="-5">UTC-5</option>
							<option value="-4.5">UTC-4:30</option>
							<option value="-4">UTC-4</option>
							<option value="-3.5">UTC-3:30</option>
							<option value="-3">UTC-3</option>
							<option value="-2.5">UTC-2:30</option>
							<option value="-2">UTC-2</option>
							<option value="-1.5">UTC-1:30</option>
							<option value="-1">UTC-1</option>
							<option value="-0.5">UTC-0:30</option>
							<option selected="selected" value="+0">UTC+0</option>
							<option value="+0.5">UTC+0:30</option>
							<option value="+1">UTC+1</option>
							<option value="+1.5">UTC+1:30</option>
							<option value="+2">UTC+2</option>
							<option value="+2.5">UTC+2:30</option>
							<option value="+3">UTC+3</option>
							<option value="+3.5">UTC+3:30</option>
							<option value="+4">UTC+4</option>
							<option value="+4.5">UTC+4:30</option>
							<option value="+5">UTC+5</option>
							<option value="+5.5">UTC+5:30</option>
							<option value="+5.75">UTC+5:45</option>
							<option value="+6">UTC+6</option>
							<option value="+6.5">UTC+6:30</option>
							<option value="+7">UTC+7</option>
							<option value="+7.5">UTC+7:30</option>
							<option value="+8">UTC+8</option>
							<option value="+8.5">UTC+8:30</option>
							<option value="+8.75">UTC+8:45</option>
							<option value="+9">UTC+9</option>
							<option value="+9.5">UTC+9:30</option>
							<option value="+10">UTC+10</option>
							<option value="+10.5">UTC+10:30</option>
							<option value="+11">UTC+11</option>
							<option value="+11.5">UTC+11:30</option>
							<option value="+12">UTC+12</option>
							<option value="+12.75">UTC+12:45</option>
							<option value="+13">UTC+13</option>
							<option value="+13.75">UTC+13:45</option>
							<option value="+14">UTC+14</option>
						</select>
					</td>
				</tr>
				<tr>
					<td></td>
					<td align="right">
						<input type="submit" name="addCountryBtn" class="button button-primary button-large container-action-btn" value="Save">
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
		function dispPopDiv() {
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
			document.newTrainerForm.reset();
		}
	</script>
</div>