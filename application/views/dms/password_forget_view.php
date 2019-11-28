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
	
	<title>Retrive Password</title>
	
</head>
<body>


<?php

  echo form_open('auth_user/get_password');?>
  <fieldset>
  <legend align=center><h2>Retrive Password</h2></legend>
   <?php
    if ($this->session->flashdata('errors_forget_password'))
	{ 
		echo "<div class='error'>";
		echo '<font color="red">'.$this->session->flashdata('errors_forget_password').'</font>';
		echo "</div>";
    }
    ?>
    
     <?php
    if ($this->session->flashdata('info_forget_password'))
	{ 
		echo "<div class='success'>";
		echo '<font color="green" size="+1" style="font-weight:bold">'.$this->session->flashdata('info_forget_password').'</font>';
		echo "</div>";
    }
    ?>
    
    <?php
    if ($this->session->flashdata('post_value_forget_password'))
	{ 
		$post=$this->session->flashdata('post_value_forget_password');
    }
    ?>
  <table> 

	<tr>
	<td><strong>Personal File No </strong></td>
	<td><strong>:</strong></td>
	<td><input type="text" name="pfno" size="30" value="<?php echo (isset($post['pfno']))?$post['pfno']:''; ?>"/></td>
	</tr>

	<tr>
	<td><strong>E-Mail</strong></td>
	<td><strong>:</strong></td>
	<td><input type="text" name="email" size="30" value="<?php echo (isset($post['email']))?$post['email']:''; ?>"/></td>
	</tr>
	
	<tr>
	<td><strong>Branch/Office Code</strong></td>
	<td><strong>:</strong></td>
	<td><input type="text" name="pocode" size="30" value="<?php echo (isset($post['pocode']))?$post['pocode']:''; ?>"/></td>
	</tr>
	
	<tr>
	<td><strong>Date of Birth</strong></td>
	<td><strong>:</strong></td>
	<td><input type="text" name="dob" id="datepicker" size="15" value="<?php echo (isset($post['dob']))?$post['dob']:''; ?>"/></td>
	</tr>

	<tr>
	<td></td>
	<td width="32"><strong></strong></td>
	<td><?php echo form_submit('actionbtn', 'Get Password');?><?php form_reset('myClear', 'Clear');?></td>
    <td><input type="submit" name="back" value="Back" /></td>
	</tr>
  </table>
</fieldset>
	
  	<?php echo form_close(); ?>
    
</body>
</html>	