<?php
/**
 * Template Name: Primary Stylesheet
 */
 
?>

<style>
* {
	box-sizing: border-box !important;
}

/************************************************************************************************************************************************/

/* Profile container */
.profile {
  margin: 0;
}

.profile-col {
  background: #2d3b55;
}

.profile {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display:         flex;
  flex-wrap: wrap;
}
.profile > [class*='eq-height'] {
  display: flex;
  flex-direction: column;
}

/* Profile sidebar */
.profile-sidebar {
  padding: 20px 0 10px 0;
}

.profile-userpic img {
  float: none;
  margin: 0 auto;
  width: 125px;
  height: 125px;
  -webkit-border-radius: 50% !important;
  -moz-border-radius: 50% !important;
  border-radius: 50% !important;
}

.profile-usertitle {
  text-align: center;
  margin-top: 20px;
}

.profile-usertitle-name {
  color: #5a7391;
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 7px;
}

.profile-usertitle-job {
  text-transform: uppercase;
  color: #5b9bd1;
  font-size: 12px;
  font-weight: 600;
  margin-bottom: 15px;
}

.profile-userbuttons {
  text-align: center;
  margin-top: 10px;
}

.profile-userbuttons .btn {
  text-transform: uppercase;
  font-size: 11px;
  font-weight: 600;
  padding: 6px 15px;
  margin-right: 5px;
}

.profile-userbuttons .btn:last-child {
  margin-right: 0px;
}
    
.profile-usermenu {
  margin-top: 30px;
}

.profile-usermenu ul li {
  border-bottom: 1px solid #f0f4f7;
}

.profile-usermenu ul li:last-child {
  border-bottom: none;
}

.profile-usermenu ul li a {
  color: #93a3b5;
  font-size: 14px;
  font-weight: 400;
}

.profile-usermenu ul li a i {
  margin-right: 8px;
  font-size: 14px;
}

.profile-usermenu ul li a:hover {
  background-color: #fafcfd;
  color: #5b9bd1;
}

.profile-usermenu ul li.active {
  border-bottom: none;
}

.profile-usermenu ul li.active a {
  color: #5b9bd1;
  background-color: #f6f9fb;
  border-left: 2px solid #5b9bd1;
  margin-left: -2px;
}

/***************************************************/
.outer-container {
    padding: 10px;
}
.inner-container {
    background-color: #f9f9f9;
    border-radius: 5px;
	min-height: 550px;
}

.page-container {
	padding: 0;
}

/* Profile Content */
.profile-content {
  padding: 10px;
}

/***************************************************** Title Bar *********************************************/

.title-bar {
	width: 100%;
	height: 65px;
	margin: 0 auto;
	background-color: #fff;
	box-shadow: 0 3px 6px #afafaf;
}
h3.page-title {
	font-size: 24px;
	line-height: 65px;
	text-align: center;
	font-weight: 700;
	padding: 0;
	padding-left: 15px;
	margin: 0 !important;
	color: #25698a;
}


p.viewall-link, .viewall-link {
	margin: 12px 0 10px 8px;
	line-height:30px;
	font-size: 15px;
}

p.edit-link, .edit-link {
	margin: 12px 10px 10px 0;
	line-height:30px;
	font-size: 15px;
}


/* ************************************************************ Default **************************************************************/
.xl-container {
	width: 100%;
}
.xl-container-inner {
	width: 100%;
	padding: 0;
	margin: 0 auto;
	background-color: #e4e8eb;
}

.border-left {
	border-left: 1px solid #ccc;
}

.full-width {
	width: 100% !important;
}
.half-width {
	width: 50% !important;
}
.no-margin, p.no-margin {
	margin: 0 !important;
}
.margin-2 {
	margin: 2px;
}
.margin-5 {
	margin: 5px;
}
.text-center {
	text-align: center;
}
.text-left {
	text-align: left !important;
}
.no-padding {
	padding: 0 !important;
}

.rl-no-margin {
	margin-left: 0;
	margin-right: 0;
}

.container-heading {
	font-size: 20px;
    color: #3a5d86;
    font-weight: 500;
	padding: 0 !important;
	margin-top: 10px;
	margin-bottom: 10px;
}

.col-left {
	float: left;
}
.col-right {
	float: right;
}
.clearfix {
	clear: both;
}
hr.heading-sep {
	margin-top: 0;
	margin-bottom: 10px;
	border-bottom: 1px solid #3a5d86;
}
.cblock {
}
.iblock {
	background-color: #fff;
    padding: 5px;
    border-radius: 3px;
    box-shadow: 2px 2px 4px 0px #ccc;
}
.table-collapse {
	border-collapse: collapse;
	margin:auto;
}

.red-star {
	color: red;
	font-weight: 900;
}

/********************************* Form Input ***********************************/
form input {
	color: #333333 !important;
}

p.inputLabel {
	margin-top: 5px !important;
	margin-bottom: 0 !important;
 }
 input[type=checkbox] {
	margin: 0 !important;
 }


.button-primary {
    background: #0085ba;
    border-color: #0073aa #006799 #006799;
    -webkit-box-shadow: 0 1px 0 #006799;
    box-shadow: 0 1px 0 #006799;
    color: #fff;
	margin: auto !important;
    text-decoration: none;
    text-shadow: 0 -1px 1px #006799, 1px 0 1px #006799, 0 1px 1px #006799, -1px 0 1px #006799;
}

#xl-btn {
	color: #fff;
    font-weight: 600;
    width: 100%;
    border: 0;
    padding: 7px 10px;
    cursor: pointer;
    background-color: #4472c4;
}

.btn-blue {
    border: 1px solid #2779bb;
    color: #FFFFFF;
    background: #2196f3; /* For browsers that do not support gradients */
	background: linear-gradient(#2196f3, #317db9, #2196f3);
	background: -webkit-linear-gradient(#2196f3, #317db9, #2196f3); /* For Safari 5.1 to 6.0 */
	background: -o-linear-gradient(#2196f3, #317db9, #2196f3); /* For Opera 11.1 to 12.0 */
	background: -moz-linear-gradient(#2196f3, #317db9, #2196f3); /* For Firefox 3.6 to 15 */
    box-shadow: 1px 1px 1px #7b7b7b;
}
.btn-yellow {
    border: 1px solid #da964d;
    color: #FFFFFF;
	background: #f8ac59; /* For browsers that do not support gradients */
	background: linear-gradient(#f8ac59, #dc984e, #f8ac59);
	background: -webkit-linear-gradient(#f8ac59, #dc984e, #f8ac59); /* For Safari 5.1 to 6.0 */
	background: -o-linear-gradient(#f8ac59, #dc984e, #f8ac59); /* For Opera 11.1 to 12.0 */
	background: -moz-linear-gradient(#f8ac59, #dc984e, #f8ac59); /* For Firefox 3.6 to 15 */
    box-shadow: 1px 1px 1px #7b7b7b;
}
.btn-red {
    border: 1px solid #ca7e86;
    color: #FFFFFF;
	background: #ed5565; /* For browsers that do not support gradients */
	background: linear-gradient(#ed5565, #ca4654, #ed5565);
	background: -webkit-linear-gradient(#ed5565, #ca4654, #ed5565); /* For Safari 5.1 to 6.0 */
	background: -o-linear-gradient(#ed5565, #ca4654, #ed5565); /* For Opera 11.1 to 12.0 */
	background: -moz-linear-gradient(#ed5565, #ca4654, #ed5565); /* For Firefox 3.6 to 15 */
    box-shadow: 1px 1px 1px #7b7b7b;
}
#xl-btn:hover {
    background-color: #345da7
}

table.simple-table {
	font-size: 14px;
	border-collapse: collapse;
	margin:auto;
}
table.data-list-table {
	font-size: 14px;
}
table.data-list-table td {
	text-align: center;
    border: 1px solid #f1f1f1;
	padding: 1px 5px;
}
table.data-list-table th {
	text-align: center;
    border: 1px solid #d8d5d5;
	padding: 2px 5px;
	line-height: 20px;
}

table.data-list-table tr#tr-header {
	background: #dedede; /* For browsers that do not support gradients */
	background: linear-gradient(#f3f3f3, #dedede, #f3f3f3);
	background: -webkit-linear-gradient(#f3f3f3, #dedede, #f3f3f3); /* For Safari 5.1 to 6.0 */
	background: -o-linear-gradient(#f3f3f3, #dedede, #f3f3f3); /* For Opera 11.1 to 12.0 */
	background: -moz-linear-gradient(#f3f3f3, #dedede, #f3f3f3); /* For Firefox 3.6 to 15 */
}
table.data-list-table tr:nth-child(even) {
	background-color: #ffffff;
}
table.data-list-table tr:nth-child(odd) {
	background-color: #f9f9f9;
}


/**************** Form Table *****************/
table.form-table td {
    border: 1px solid #f1f1f1;
	padding: 1px 5px;
}
table.form-table tr:nth-child(even) {
	background-color: #ffffff;
}
table.form-table tr:nth-child(odd) {
	background-color: #f9f9f9;
}

.success-msg {
	color: #125213;
	text-align: center;
	font-weight: 600;
    background-color: #dff0d8;
    border-color: #d6e9c6;
	padding: 8px;
}
.error-msg {
	color: #a94442 !important;
	text-align: center;
	font-weight: 600;
    background-color: #f2dede;
    border-color: #ebccd1;
	padding: 8px;
}

.warning-msg {
	color: #8a6d3b !important;
	text-align: center;
	font-weight: 600;
    background-color: #fcf8e3;
    border-color: #faebcc;
	padding: 8px;
}



/*************************** Ajax Login Box ***************************/

#login-wraper {
	padding-top: 10%;
	
}
.login-block {
	width: 100%;
	max-width: 348px;
	padding: 15px 17px!important;
	margin: auto;
	border: 1px solid #e5e5e5;
	border-radius: 4px;
}
.login-block-title {
	background-color: #0085ba;
    padding: 5px;
    margin-bottom: 20px;
	border-radius: 2px;
}
h3.login-title {
	Color: #fff;
	font-size: 28px;
	font-weight: 500;
	text-align: center !important;
	font-family: 'Lato', sans-serif;
	margin: 0 !important;
}
.please-login {
	text-align: center !important;
    font-weight: 600;
    text-decoration: underline;
}
h3.register-title {
	font-size: 16px;
	font-weight: 500;
	font-family: 'Lato', sans-serif;
}
.register-title:after {
	content: '';
    width: 85px;
    height: 3px;
    background-color: #4bbd03;
    margin: 10px 0px;
    display: block;
}
#login-div > table {
	width: 100% !important;
}


/*************************** MODIFYING DEFAULT THEME STYLES ***************************/

header.x-container {
    display: none !important;
}
</style>