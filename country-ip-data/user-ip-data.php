<?php
/************************************************************************************************************************************************
************************************************************ Detect User Details API ************************************************************
*************************************************************************************************************************************************/
if (isset($_GET['setip'])) {
	$ipaddress = $_GET['setip'];
	
} elseif (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
	$ipaddress = $_SERVER['HTTP_CF_CONNECTING_IP'];
	
} elseif (isset($_SERVER['HTTP_X_REAL_IP'])) {
	$ipaddress = $_SERVER['HTTP_X_REAL_IP'];
	
} elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
	$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	
} elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	
} elseif (isset($_SERVER['REMOTE_ADDR'])) {
	$ipaddress = $_SERVER['REMOTE_ADDR'];
	
} else {
	$ipaddress = '216.239.32.10'; 
}


$country	= '';
if (isset($_GET['country'])) {
	$country = $_GET['country'];
}


class clientLocal {
	
	var $clientIp;
	var $ip_data;
	
	var $countryCode	= 'US';
	var $countryName	= 'United States';
	var $dialCode		= '1';
	var $currency		= 'USD';
	var $currencySymbol	= '&#x00024;';
	var $currencyRate	= '64.58';
	var $rateUpdatedOn	= '';
	var $timezone		= '+6';
	
	function __construct() {
		global $ipaddress;
		global $country;
		global $wpdb;
		
		if( ($country != '') || !empty($country) ) {
			$this->countryCode	= $country;
		} else {
			$this->clientIp	= $ipaddress;
			
			$this->ip_data		= geoip_detect2_get_info_from_ip($this->clientIp, NULL);
			$this->countryCode	= $this->ip_data->country->isoCode;
		}
		
		$countryDataQ	= $wpdb->get_results("SELECT * FROM {$wpdb->prefix}ol_country_data WHERE countryCode = '{$this->countryCode}'");
		if( ($wpdb->num_rows) == 1) {
			foreach($countryDataQ as $countryData) {
				$this->countryName		= $countryData->countryName;
				$this->dialCode			= $countryData->dialCode;
				$this->currency			= $countryData->currency;
				$this->currencySymbol	= $countryData->currencySymbol;
				$this->currencyRate		= $countryData->currencyRate;
				$this->rateUpdatedOn	= $countryData->rateUpdatedOn;
				$this->timezone			= $countryData->timezone;
				
				if( empty($this->currencySymbol) ) {
					$this->currencySymbol	= $this->currency;
				}
				
				$today			= date_create( date('Y-m-d') );
				$updatedDate	= date_create( date('Y-m-d', strtotime($this->rateUpdatedOn)) );
				
				$clDateDiff	= date_diff($today, $updatedDate);
				$clDateDiff	= $clDateDiff->days;
				
				// Update currency rate
				
				/*
				if( ($this->currency !== 'USD') && ( $clDateDiff >= 2 ) ) {
		
					$to_Currency = urlencode($this->currency);
				
					$url = "https://finance.google.com/finance/converter?a=1&from=USD&to=$to_Currency";

					$ch = curl_init();
					$timeout = 0;
					curl_setopt ($ch, CURLOPT_URL, $url);
					curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

					curl_setopt ($ch, CURLOPT_USERAGENT,
								 "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
					curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
					$rawdata = curl_exec($ch);
					curl_close($ch);
					$data = explode('bld>', $rawdata);
					$data = explode($to_Currency, $data[1]);
					
					$cRate	= round($data[0], 2);
					
					if($cRate > 0) {
						$updateCurrencyRate	= $wpdb->update(
							$wpdb->prefix . 'ol_country_data',
							array(
								'currencyRate'	=> $cRate,
								'rateUpdatedOn'	=> date('Y-m-d H:i:s')
							),
							array( 'currency' => $this->currency )
						);
					}
				}
				*/
				
			}
			
		}
	}
	
	function get_clientip() {
		return $this->clientIp;
	}
	
	function country_code() {
		
		$clientCountryCode	= $this->countryCode;
		return $clientCountryCode;
	}
	
	function country_name() {
		
		$clientCountryName	= $this->countryName;
		return $clientCountryName;
	}
	function currency() {
		
		$clientCurrency	= $this->currency;
		if( ($clientCurrency == null) || ($clientCurrency == '') ) {
			$clientCurrency	= 'USD';
		}
		return $clientCurrency;
	}
	function currsymb() {
		
		$clientCurrsymb	= $this->currencySymbol;
		if($clientCurrsymb == "&#8360;") {
			$clientCurrsymb	= "&#8377;";
		}
		return $clientCurrsymb;
	}
	
	/************************************************************ Currency Convertion API **********************************************/
	
	// Function to get Local Price WITHOUT currency symbol
	
	function get_amt( $amount, $to_Currency = null, $from_Currency = null ) {
		
		global $wpdb;
		
		if($to_Currency == null) {
			$to_Currency	= self::currency();
		}
		
		if($from_Currency == null) {
			$from_Currency	= 'INR';
		}
		
		if(get_query_var('curr') ) {
			$to_Currency	= get_query_var('curr');
		}
		
		if($from_Currency !== $to_Currency) {
		
			$gaFromCDataQ		= $wpdb->get_results("SELECT currencyRate FROM {$wpdb->prefix}ol_country_data WHERE currency = '{$from_Currency}' ORDER BY rateUpdatedOn DESC LIMIT 1");
			$gaFromCDataCount	= $wpdb->num_rows;
			
			if( $gaFromCDataCount == 1 ) {
				foreach($gaFromCDataQ as $gaFromCData) {
					$gaFromCRate	= $gaFromCData->currencyRate;
				}
			}
			
			$gaToCDataQ		= $wpdb->get_results("SELECT currencyRate FROM {$wpdb->prefix}ol_country_data WHERE currency = '{$to_Currency}' ORDER BY rateUpdatedOn DESC LIMIT 1");
			$gaToCDataCount	= $wpdb->num_rows;
			
			if( $gaToCDataCount == 1 ) {
				foreach($gaToCDataQ as $gaToCData) {
					$gaToCRate	= $gaToCData->currencyRate;
				}
			}
			
			if( ($gaFromCDataCount == 1) && ($gaToCDataCount == 1) ) {
				$gaRate	= ( ($gaToCRate / $gaFromCRate) * $amount );
			}
			
			$price	= round($gaRate, 2);
			return $price;
		
			
		} else {
			$price	= round($amount, 2);
			return $price;
		}
	}
	
	// Function to get Local Price with currency symbol
	
	function get_lp( $amount, $to_Currency = null, $from_Currency = null ) {
		
		if($to_Currency == null) {
			$to_Currency	= self::currency();
		}
		
		if($from_Currency == null) {
			$from_Currency	= 'INR';
		}
		
		if(get_query_var('curr') ) {
			$to_Currency	= get_query_var('curr');
		}
		
		$currsymbol ='';
		if($to_Currency == 'USD') {
			$currsymbol = '&#36;';
		} elseif($to_Currency == 'EUR') {
			$currsymbol = '&#8364;';
		} elseif($to_Currency == 'AUD') {
			$currsymbol = '&#36;';
		} else {
			$currsymbol	= self::currsymb();
		}
		
		$price	= $currsymbol . number_format( self::get_amt( $amount, $to_Currency, $from_Currency ), 2 );
		return $price;
	}
}