
/* **************************************** XL Modal - Popup ******************************************/
function dispXlModal(id) {
	document.getElementById(id).style.display = 'inherit';
	document.getElementById(id).style.zIndex = '99998';
}
function hideXlModal(id) {
	document.getElementById(id).style.display = 'none';
	document.getElementById(id).style.zIndex = '-99998';
}


/* ************************* Function to get sum of array values ************************* */
function array_sum(selector) {
	var getArrElements = selector.map(function(){
		return $(this).val();
	});
	
	var total	= 0;
	for (var i = 0; i < getArrElements.length; i++) {
		total += Number( getArrElements[i] );
	}
	
	return total;
}


/* ************************ Login Ajax ************************ */
$( document ).ready(function() {
	$('form#userLoginForm').on('submit', function(e){
		e.preventDefault();
		
		var isValid	= true;
		$("form#userLoginForm .reqField").each(function() {
			if( $(this).val().trim() == "" ) {
				$(this).addClass("input-error");
				$(this).focus();
				isValid	= false;
				
				return isValid;
			} else {
				$(this).removeClass("input-error");
			}
		});
		
		if(isValid == true) {
			var userLoginForm = $('form#userLoginForm')[0];
			var dqFrmData = new FormData(userLoginForm);
			
			$.ajax({
				url: xl_urls.xl_ajax_uri + "?action=userLoginAuth",
				data: dqFrmData,
				type: 'POST',
				processData: false,
				contentType: false,
				beforeSend: function (xhr) {    
					$('#userLoginForm_ajax_status').html("<p class='info-msg'>Processing, please wait...</p>");
					$('form#userLoginForm').addClass("ajax-form-processing");
				},
				success: function(asData) {
					$('form#userLoginForm').removeClass("ajax-form-processing");
					dataOutput	= asData.split('|');
					if(dataOutput[0] == 'Success') {
						$('#userLoginForm_ajax_status').html(dataOutput[1]);
						$('form#userLoginForm')[0].reset();
						
						window.location.replace(location.href);
					} else {
						$('#userLoginForm_ajax_status').html(dataOutput[1]);
					}
				}
			});
			
		} else {
			$('#userLoginForm_ajax_status').html("<p class='error-msg'>Fill all the required fields</p>");
		}
	});
});

/* ************************ User Signup Ajax ************************ */
		$('form#user_registration').on('submit', function(e){
			e.preventDefault();
			
			var isValid	= true;
			$("form#user_registration .reqField").each(function() {
				if( $(this).val().trim() == "" ) {
					$(this).addClass("input-error");
					$(this).focus();
					isValid	= false;
					
					return isValid;
				} else {
					$(this).removeClass("input-error");
				}
			})
			if(isValid == true) {
				var userRegForm = $('form#user_registration')[0];
				var dqFrmData = new FormData(userRegForm);
				
				$.ajax({
					url: "<?php echo base_url(); ?>Auth/user_register_validation",
					data: dqFrmData,
					type: 'POST',
					processData: false,
					contentType: false,
					beforeSend: function (xhr) {    
						$('#user_registration_ajax_status').html("<p class='info-msg'>Processing, please wait...</p>");
						$('form#user_registration').addClass("ajax-form-processing");
					},
					success: function(asData) {
						$('form#user_registration').removeClass("ajax-form-processing");
						dataOutput	= asData.split('|');
						if(dataOutput[0] == 'Success') {
							$('#user_registration_ajax_status').html(dataOutput[1]);
							$('form#user_registration')[0].reset();
							
							window.location	= "<?php echo base_url(); ?>dashboard";
						} else {
							$('#user_registration_ajax_status').html(dataOutput[1]);
						}
					}
				});
				
			} else {
				$('#user_registration_ajax_status').html("<p class='error-msg'>Fill all the required fields</p>");
			}
		});