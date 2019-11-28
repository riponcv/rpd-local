<!DOCTYPE html>

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
	<title>untitled</title>
	<style type="text/css" media="screen">
		/*label {display: block;}
		fieldset{ width:500px;margin:0 auto;}
		#error{color:#FF0000;
		margin-left:229px;
		line-height:8px;}
		*/
	</style>
	
	<title>Login Information</title>
	
</head>
<body>


<?php

  echo form_open('auth_user/create');?>
  <fieldset>
  <legend align="center"><h2>Login Information</h2></legend>
  <div id="error"> <?php echo validation_errors();?> </div> 
  <table> 
<!--	
    <tr>
	<td><strong>Designation</strong></td>
	<td><strong>:</strong></td>
	<td><input type="text" name="designation" size="30" value="<?php if (isset($_SESSION['designation'] )) echo $_SESSION['designation'];echo isset($_POST['designation'])?$_POST['designation']:''; ?>" /></td>
	</tr>
	-->
    <tr>
	<td><strong>Designation</strong></td>
	<td><strong>:</strong></td>
    <td>
      <?php 
      
	  $selected_designation='';
	  if(isset($_POST['designation']))
	  {
	  	$selected_designation=$_POST['designation'];
	  } 
	  ?>
      <?php echo form_dropdown('designation',$designation_dropdown,$selected_designation,'') ?>
      </td> 
    </tr>
    
    <tr>
	<td><strong>Personal File No. </strong></td>
	<td><strong>:</strong></td>
	<td><input type="text" name="pfno" size="30" value="<?php echo isset($_POST['pfno'])?$_POST['pfno']:''; ?>"/></td>
	</tr>
	
    <tr>
	<td><strong>Full Name </strong></td>
	<td><strong>:</strong></td>
	<td><input type="text" name="fullname" size="30" value="<?php echo isset($_POST['fullname'])?$_POST['fullname']:''; ?>"/></td>
	</tr>
	<tr>
	<td><strong>Mobile No. </strong></td>
	<td><strong>:</strong></td>
	<td><input type="text" name="mobileno" size="20" value="<?php echo isset($_POST['mobileno'])?$_POST['mobileno']:''; ?>"/></td>
	</tr>
	<tr>
	<td><strong>Posting Office/Branch Code </strong></td>
	<td><strong>:</strong></td>
	<td><input type="text" name="pocode" size="10" value="<?php echo isset($_POST['pocode'])?$_POST['pocode']:''; ?>"/></td>
	</tr>
	<tr>
	<td><strong>Is Office Head </strong></td>
	<td><strong>:</strong></td>
	<td><input type="checkbox" name="officehead"/></td>
	</tr>
	<tr>
	<td><strong>Control Office </strong></td>
	<td><strong>:</strong></td>
	<td><input type="checkbox" name="controloffice"/></td>
	</tr>
	<tr>
	<td><strong>Password </strong> </td>
	<td><strong>:</strong></td>
	<td><input type="password" name="password" id="password" size="30"/></td>
	</tr>
	
	<tr>
	<td><strong>Confirm Password </strong> </td>
	<td><strong>:</strong></td>
	<td><input type="password" name="conf_password" id="conf_password" onBlur="pwd_check()" size="30"/></td>
	</tr>
		
	<tr>
	<td><strong>E-Mail</strong></td>
	<td><strong>:</strong></td>
	<td><input type="text" name="email" size="30" value="<?php echo isset($_POST['email'])?$_POST['email']:''; ?>" /></td>
	</tr>
	
	<tr>
	<td><strong>Date of Birth </strong></td>
	<td><strong>:</strong></td>
	<td><input type="text" name="dob" id="datepicker" size="15"/></td>
	</tr>
	
	<tr>
	<td> </td>
	<td><strong> </strong></td>
	<td>
	&nbsp;<input type="hidden" name="createdate" size="15" value="<?php echo date('Y-m-d') ?>"/>
	&nbsp;<input type="hidden" name="ui_LastProfileUpdateDate" size="15"/>
	&nbsp;<input type="hidden" name="status" size="5"/>
	&nbsp;<input type="hidden" name="level" size="5"/>
	&nbsp;<input type="hidden" name="pwdlink" size="30"/>
	</td>
	</tr>
	
	
	
	<tr>
	<td></td>
	<td width="32"><strong></strong></td>
	<td><?php echo form_submit('actionbtn', 'Submit ');?><?php form_reset('myClear', 'Clear');?></td>
    <td><input type="submit" name="back" value="Back" /></td>
	</tr>
  </table>
</fieldset>
	
  	<?php echo form_close(); ?>
    
</body>
</html>	