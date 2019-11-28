<script type="text/javascript">
$(document).ready(function() {
	jQuery('#pfno').css('opacity','1');
		
});
/*
$(function() {
				$( "#dat_entry_date" ).datepicker({ dateFormat: 'dd-M-yy' });
			});
*/
$(function() {
	   $("#dat_entry_date" ).datepicker(
	                 { dateFormat: 'dd-M-yy', 
	                   showAnim: 'slide', 
	                   changeMonth: true, 
	                   changeYear: true, 
	                   yearRange: '1990:2020' 
	                }
	                );
	 });
</script>

<script type="text/javascript">
function checkStyle(divId,status)
{
	if(status=='onfocus')
	{
		jQuery('#'+divId).css('opacity','1');
	}
	else
	{
		 jQuery('#'+divId).css('opacity','0.3');
	}
}
</script>
<style type="text/css">
table#tt
td
{ color:#0066FF;
font-size:30px;				
}
input
{
font-size:30px;		
}
</style>

<div align="center" >
    <table width="100%" height="379" id="tt" style="background-repeat:no-repeat;background-position:center" align="center"  background="<?php echo base_url();?>img/logolarge.jpg" >
<div id="error"><?php  echo validation_errors(); ?> </div> 
  
 <div id="form_message"></div>

<?php echo form_open('auth_user/logedin_form'); ?>
<!--form name="ajax_form" id ="ajax_form" method="post" -->
<tr>
<td height="90" colspan="2">&nbsp;</td>
</tr>
<tr>
<td height="24"  align="right" ><strong> Personal File No. </strong></td> 
<td align="left"><input type="text" name="pfno"  id="pfno" onblur="User_Full_Name_Show(this.value)" style="border-style:none;opacity:0.3" onfocus="checkStyle('pfno','onfocus');" onblur="checkStyle('pfno','onblur');"/> </td>
</tr>
<tr>
<td height="24"  align="right"><strong>Your Name</strong></td> 
<td  align="left"><input type="text" name="txt_your_name" id="txt_your_name"  style="border-style:none;opacity:0.3" onfocus="checkStyle('txt_your_name','onfocus');" onblur="checkStyle('txt_your_name','onblur');"/> </td>
</tr>
<tr>
<td height="24" align="right">Password</td> 
<td  align="left"><input type="password" name="txt_Password" id="txt_Password" style="border-style:none;opacity:0.3" onfocus="checkStyle('txt_Password','onfocus');" onblur="checkStyle('txt_Password','onblur');"/> </td>
</tr>
<tr>
<td height="24" align="right">Office ID</td> 
<td  align="left"><input type="text" name="txt_office_id" id="txt_office_id" onblur="Office_Name_Show(this.value)" style="border-style:none;opacity:0.3" onfocus="checkStyle('txt_office_id','onfocus');" onblur="checkStyle('txt_office_id','onblur');"/> </td>
</tr>
<tr>
<td height="27" align="right">Office Name</td> 
<td  align="left"><input type="text" name="txt_office_name" id="txt_office_name" style="border-style:none;opacity:0.3" onfocus="checkStyle('txt_office_name','onfocus');" onblur="checkStyle('txt_office_name','onblur');"/> </td>
</tr>
<tr>
<td height="24" align="right">Entry Date</td> 
<td  align="left"><input type="text" name="dat_entry_date" id="dat_entry_date" style="border-style:none;opacity:0.3" onfocus="checkStyle('dat_entry_date','onfocus');" onblur="checkStyle('dat_entry_date','onblur');"/></td>
</tr>
<tr>
<td height="30" colspan="2" align="center"> <?php echo anchor('auth_user/reg_me', 'Register Me'); ?>
<input type="submit" name="btn_login" value="Login" id="btn_login"/>
<?php echo anchor('auth_user/password_forget', 'Forgot Password!'); ?></td>
</tr>
<tr>
<td height="90" colspan="2"><div id="error"><?php if (isset($error)) echo $error; else echo ''; ?></div></td>
</tr>
</form>
</table>
<?php //button_to_function('Greetigs', 'alert("Hello world!")' );?>
</div>
