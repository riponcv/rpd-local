<!DOCTYPE html>

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
	<title>untitled</title>
	<style type="text/css" media="screen">
		label {display: block;}
	</style>
	
	<title>My Date Time Picker</title>
	
  <link href="<?php echo base_url(); ?>calendar/calendar.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="<?php echo base_url(); ?>calendar/calendar.js"></script>


<script language="javascript" type="text/javascript" src="datetimepicker.js">

</script>
</head>
<body>
<?php
require_once('calendar/classes/tc_calendar.php'); 
?>
<?php 
$frm_date_default = "today days";
$to_date_default = "today"; 
$myCalendar = new tc_calendar("frm_date", true, false);
$myCalendar->setIcon("calendar/images/iconCalendar.gif");
$myCalendar->setDate(date('d', strtotime($frm_date_default)), date('m', strtotime($frm_date_default)), date('Y', strtotime($frm_date_default)));
$myCalendar->setPath("calendar/");
$myCalendar->setYearInterval(2000, 2015);
$myCalendar->setAlignment('left', 'bottom');
$myCalendar->writeScript(); 
?>

<?php

  echo form_open('site/create');
  echo "<fieldset>";
  echo '<legend align="center"><h2>Personal Information</h2></legend>';
  echo "<table align=\"center\">"; 
	echo "<tr>";
	echo "<td>User Name </td>";
	echo "<td><strong>:</strong></td>";
	echo "<td>&nbsp;<input type='text' name='username' size='10'/></td>";
	echo "<tr>";

	echo "<tr>";
	echo "<td>Full Name </td>";
	echo "<td><strong>:</strong></td>";
	echo "<td>&nbsp;<input type='text' name='fullname' size='30'/></td>";
	echo "<tr>";

	echo "<tr>";
	echo "<td>E-Mail </td>";
	echo "<td><strong>:</strong></td>";
	echo "<td>&nbsp;<input type='text' name='email' size='30'/></td>";
	echo "<tr>";

	echo "<tr>";
	echo "<td>Password </td>";
	echo "<td><strong>:</strong></td>";
	echo "<td>&nbsp;<input type='password' name='password' size='30'/></td>";
	echo "<tr>";

	echo "<tr>";
	echo "<td>Office Id </td>";
	echo "<td><strong>:</strong></td>";
	echo "<td>&nbsp;<input type='text' name='officeid' size='4'/></td>";
	echo "<tr>";

	echo "<tr>";
	echo "<td>Date of Birth </td>";
	echo "<td><strong>:</strong></td>";
	echo "<td>";
	
	$frm_date_default = "today days";
	$to_date_default = "today"; 
	$myCalendar = new tc_calendar("frm_date", true, false);
	$myCalendar->setIcon("calendar/images/iconCalendar.gif");
	$myCalendar->setDate(date('d', strtotime($frm_date_default)), date('m', strtotime($frm_date_default)), date('Y', strtotime(					    $frm_date_default)));
	$myCalendar->setPath("calendar/");
	$myCalendar->setYearInterval(2000, 2015);
	$myCalendar->setAlignment('left', 'bottom');
	$myCalendar->writeScript(); 
	
	
	echo "</td>";
	
	
	echo "<tr>";

	echo "<tr>";
	echo "<td>User Level </td>";
	echo "<td><strong>:</strong></td>";
	echo "<td>&nbsp;<input type='text' name='userlevel' size='4'/></td>";
	echo "<tr>";

	echo "<tr>";
	echo "<td>Status </td>";
	echo "<td><strong>:</strong></td>";
	echo "<td>&nbsp;<input type='text' name='status' size='10'/></td>";
	echo "<tr>";

	echo "<tr>";
	echo "<td>Password Link </td>";
	echo "<td><strong>:</strong></td>";
	echo "<td>&nbsp;<input type='text' name='pwdlink' size='30'/></td>";
	echo "<tr>";
	
	echo "<tr>";
	echo "<td>".form_submit('actionbtn', 'Submit ')."</td>";
	echo "<td width='10'><strong>:</strong></td>";
	echo "<td>".form_reset('myClear', 'Clear')."</td>";
	echo "</tr>";
	echo "</table>";
  	echo "</fieldset>";
  	echo form_close();
?>
    
	
		
</body>
</html>	