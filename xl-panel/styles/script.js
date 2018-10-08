// XL Date Picker
$(function() {
	$('.xlDate').datepicker({
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		changeYear: true,
		numberOfMonths: 1,
		showMonthAfterYear: true,
		yearRange: "c-25:c+25", // c = Current Year, Or Use like 2002:2010 etc.
		autoSize: true,
		onSelect: function(selectedDate) {
			// we can write code here 
		}
	});
});
	

// Read a page's GET URL variables and return them as an associative array.
function getUrlVars(wLocation)
{
    var vars = [], hash;
    var hashes = wLocation.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}
	
$(document).ready(function () {
	$(function(){
		var current_page_Var = getUrlVars(window.location.href)["spg"];
		$( "a.nav" ).each(function() {
			if ($(this).attr("href") !== "#") {
				var target_URL = $(this).prop("href");
				var target_Var = getUrlVars(target_URL)["spg"];
				if (target_Var == current_page_Var) {
					$('a.nav').parents('li, ul').removeClass('active');
					$(this).parent('li').addClass('active');
					$(this).closest('li').parent().addClass('in');
					
					return false;
				}
			}
		});
	});
	$(function() { 
		$('#menu-content').on('click','.parent_nav', function ( e ) {
			e.preventDefault();
		});
	});
});

// XL Loader Script
document.onreadystatechange = function () {
	var state = document.readyState
	if (state == 'complete') {
		document.getElementById('interactive');
		document.getElementById('xl-loader').style.visibility="hidden";
	}
}