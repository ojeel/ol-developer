<?php
/**
 * Template Name: jQuery Date Picker
 */

?>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script>
	jQuery(document).ready(function(){
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
</script>