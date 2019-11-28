<!DOCTYPE html>

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
	<title>Profile Setting Form</title>
	
</head>
<body>


  <fieldset>
  <legend align="center"><h2>Profile Setting</h2></legend>
  <div id="error"> <?php echo validation_errors();?> </div>
  <?php 
  $flash_data=$this->session->flashdata('status_profile_setting');
  if(isset($flash_data) && $flash_data !='')
  { 
  ?>
  <div id="flash"> <?php echo $flash_data; ?> </div>  
  <?php } ?>
  <table>
  <?php if(isset($user_info) && !empty($user_info)){ ?>
    
  <?php  echo form_open('auth_user/profile_setting_save/'.$user_info['ui_code']); ?> 
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
      else
      {
        if(isset($user_info['ui_Desig_Code']) && $user_info['ui_Desig_Code'] !='')
        {
            $selected_designation=$user_info['ui_Desig_Code'];
        }
      } 
	  ?>
      <?php echo form_dropdown('designation',$designation_dropdown,$selected_designation,'') ?>
      </td> 
    </tr>
    
    <tr>
	<td><strong>Personal File No. </strong></td>
	<td><strong>:</strong></td>
	<td><input type="text" name="pfno" size="30" value="<?php echo isset($_POST['pfno'])?$_POST['pfno']:$user_info['ui_PFile_No']; ?>"/></td>
	</tr>
	
    <tr>
	<td><strong>Full Name </strong></td>
	<td><strong>:</strong></td>
	<td><input type="text" name="fullname" size="30" value="<?php echo isset($_POST['fullname'])?$_POST['fullname']:$user_info['ui_Full_Name']; ?>"/></td>
	</tr>
	<tr>
	<td><strong>Mobile No. </strong></td>
	<td><strong>:</strong></td>
	<td><input type="text" name="mobileno" size="20" value="<?php echo isset($_POST['mobileno'])?$_POST['mobileno']:$user_info['ui_Mobile_No']; ?>"/></td>
	</tr>
	<tr>
	<td><strong>Posting Office/Branch Code </strong></td>
	<td><strong>:</strong></td>
	<td><input type="text" name="pocode" size="10" value="<?php echo isset($_POST['pocode'])?$_POST['pocode']:$user_info['ui_Posting_Office_Code']; ?>"/></td>
	</tr>
	<tr>
	<td><strong>Is Office Head </strong></td>
	<td><strong>:</strong></td>
     <?php 
	  $check_officehead='';
	  if(isset($_POST['officehead']) && $_POST['officehead']=='on')
	  {
	  	$check_officehead="checked='checked'";
	  }
      else
      {
        if(isset($user_info['ui_Office_HeadYN']) && $user_info['ui_Office_HeadYN']==1)
        {
            $check_officehead="checked='checked'";
        }
      } 
	  ?>
	<td><input type="checkbox" name="officehead"  <?php echo $check_officehead; ?>/></td>
	</tr>
	<tr>
	<td><strong>Control Office </strong></td>
	<td><strong>:</strong></td>
    <?php 
	  $check_controloffice='';
	  if(isset($_POST['controloffice']) && $_POST['controloffice']=='on')
	  {
	  	$check_controloffice="checked='checked'";
	  }
      else
      {
        if(isset($user_info['ui_Control_Off_YN']) && $user_info['ui_Control_Off_YN']==1)
        {
            $check_controloffice="checked='checked'";
        }
      } 
	  ?>
	<td><input type="checkbox" name="controloffice"  <?php echo $check_controloffice; ?>/></td>
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
	<td><input type="text" name="email" size="30" value="<?php echo isset($_POST['email'])?$_POST['email']:$user_info['ui_Email']; ?>" /></td>
	</tr>
	
	<tr>
	<td><strong>Date of Birth </strong></td>
	<td><strong>:</strong></td>
    <?php 
        $dob='';
        if(isset($user_info['ui_dob']) && $user_info['ui_dob'] !='')
        {
          $dob=date('d-M-Y',strtotime($user_info['ui_dob']));  
        } 
    ?>
	<td><input type="text" name="dob" id="datepicker" size="15" value="<?php echo isset($_POST['dob'])?$_POST['dob']:$dob; ?>"/></td>
	</tr>
	
	<tr>
	<td> </td>
	<td><strong> </strong></td>
	<td>
	&nbsp;<input type="hidden" name="exist_pfno" size="15" value="<?php echo isset($user_info['ui_PFile_No'])?$user_info['ui_PFile_No']:''; ?>"/>
    &nbsp;<input type="hidden" name="exist_pocode" size="15" value="<?php echo isset($user_info['ui_Posting_Office_Code'])?$user_info['ui_Posting_Office_Code']:''; ?>"/>
	&nbsp;<input type="hidden" name="ui_LastProfileUpdateDate" size="15" value="<?php echo date('Y-m-d') ?>"/>
	</td>
	</tr>
	
	
	
	<tr>
	<td></td>
	<td width="32"><strong></strong></td>
	<td><?php echo form_submit('actionbtn', 'Save Profile ');?></td>
    <td><input type="button" name="back" value="Home" onclick="window.location.href = '<?php echo base_url().'index.php/rpd/home'; ?>'"/></td>
	</tr>
    <?php echo form_close(); ?>
    <?php }else { ?>
   	<tr>
	   <td><strong>No Profile Data Found To Edit</strong></td>
	</tr>
    <?php } ?>
  </table>
</fieldset>
    
</body>
</html>	