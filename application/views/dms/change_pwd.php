<!DOCTYPE html>

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
	<title>untitled</title>
	<style type="text/css" media="screen">
		label {display: block;}
		fieldset{ width:500px;margin:0 auto;}
		#error{color:#FF0000;
		margin-left:229px;
		line-height:8px;}
		
	</style>
	
	<title>My Date Time Picker</title>
	
</head>
<body>


<?php

  echo form_open('rpd/change_pwd_operation');?>
  <fieldset>
  <legend align=center><h2>Change Password</h2></legend>
  <div id="error"> <?php echo validation_errors();?> </div> 
  <table align=center> 
	
	<tr>
	<td><strong>Personal File No </strong></td>
	<td><strong>:</strong></td>
	<td><input type="text" name="pfno" size="15"/></td>
	</tr>
	<tr>
	<td><strong>Present Office ID</strong></td>
	<td><strong>:</strong></td>
	<td><input type="text" name="pr_off_id" size="15"/></td>
	</tr>
	<tr>
	<td><strong>New Office ID</strong></td>
	<td><strong>:</strong></td>
	<td><input type="text" name="new_off_id" size="15"/></td>
	</tr>
	<tr>
	<td><strong>Old Password </strong></td>
	<td><strong>:</strong></td>
	<td><input type="password" name="old_password" id="old_password" size="30"/></td>
	</tr>
	<tr>
	<td><strong>New Password </strong> </td>
	<td><strong>:</strong></td>
	<td><input type="password" name="new_password" id="new_password" size="30"/></td>
	</tr>
		
	<tr>
	<td><strong>Confirm Password </strong> </td>
	<td><strong>:</strong></td>
	<td><input type="password" name="conf_password" id="conf_password" onBlur="pwd_check()" size="30"/></td>
	</tr>	
		
	<tr>
	<td></td>
	<td width="32"><strong></strong></td>
	<td><?php echo form_submit('actionbtn', 'Submit ');?><?php echo form_reset('myClear', 'Clear');?></td>
	</tr>
  </table>
</fieldset>
	
  	<?php echo form_close(); ?>
    
</body>
</html>	