
<p>
  <?php

  echo form_open('rpd/insert');
  ?>
 
  <!--fieldset id="depmod">
  <legend>Core Deposit </legend-->
  <table style="border:1px solid #345688;padding:0;margin:0;">
  <tr>
  <td>
 <table align=center> 
 <tr>
 <td ><h4><strong>Core Deposit Data Entry Form</strong></h4></td>
 </tr>
 
 </table>
 <table align=center> 
 <tr>
 <td align=center> </td>
 </tr>
 </table>
  	<table align =center  > 
	<tr>
	<td colspan="5' align ="center" style="<?php echo isset($err) ? 'border:solid 1px blue': '' ?>"> 
	<div id="error"><?php echo validation_errors(); ?></div>
	</td>
	</tr>
	
  	<tr id="tbldesgTarget">
    <td ><strong>Up to the month From January </strong></td>
<td>&nbsp; <input type="text" name="upmonth" size="2" maxlength="2" value="<?php echo isset($_POST['upmonth'])?$_POST['upmonth']:'';?>"/></td>
    <td>&nbsp;</td>
    <td><strong>Year</strong></td>
    <td>&nbsp; <input type="text" name="year" size="4" maxlength="4" value="<?php echo isset($_POST['year'])?$_POST['year']:'';?>"/></td>
  	</tr>
	</table>
 	
	<!--</br>
	</br-->
	
<!--	<table align =center id="tbldesgTarget">
 	<tr>
    <th>Office Code and Name </th>
    <td >&nbsp;<input type="hidden" name="officeId" size="10"  id="txt_office_id" onBlur="Office_Name_Show(this.value)"  value="<?php echo isset($_POST['officeId'])?$_POST['officeId']:'';?>"/></td>
    <td ><input type="hidden" name="txt_office_name" id="txt_office_name" disabled="disabled" size="50"style="background-color:#FFFFFF;font-size:14px;font-weight:bold;color:#000000;" value="<?php echo isset($_POST['officeId'])?$_POST['officeId']:'';?>"/></td>
  	</tr>
	</table-->
 
	</br>
 
	<table align =center id="tbldesgTarget">
 	<tr>
    <th>No. of Employee </th>
    </tr>
	</table>
	</br>
	
	<table align =center id="tbldesgTarget">
 	<tr>
   <?php $count=0;
   //print_r($records_target);
	foreach($records_target as $row)
	{?>
    <th><?php echo $row->Dsg_File_No_Prefix; ?></th>
    <td><input type="text"  onKeyUp="displayTargetAmt()"  name="desig[]" id="<?php echo $row->Dsg_File_No_Prefix; ?>"size="2" value="<?php echo set_value('desig[]'); ?>"/></td>
  	<input type="hidden" name="desig_id[]" value= "<?php echo $row->Dsg_File_No_Prefix; ?>"size="5" />
	<input type="hidden" name="amtount[]" value= "<?php echo $row->Dsg_Target_Amt; ?>"size="5" />
	<input type="hidden" name="noac[]"  value= "<?php echo $row->Dsg_Target_ac; ?>" size="5" />
	<?php $count++;
	}?>
 	
	  	
	</tr>
	</table>

	</br>
	
	<table align =center  id="tbldesgTarget" >
 	<tr>
    <th>SI </th>
    <th>A/C Type</th>
	<th>No. of A/C </th>
	<th>Amount in Taka </th>
    </tr>
	<?php $count=1;
	foreach($records as $row)
	{?>
	<tr>
    <th><?php echo $count;//echo "$row->pt_id"; ?></th>
	<?php  $prty=$row->pt_id;?>
	<input type="hidden" name="prod_type[]" value="<?php echo $prty; ?>" size="30"/>
    <th><?php  echo"$row->pt_short_name"; ?></th>
	<td bgcolor=#FFFFFF><input type="text" name="ac[]" size="10" onKeyUp="displayText()" value="<?php echo set_value('ac[]'); ?>"/></td>
	<td bgcolor=#FFFFFF><input type="text" name="amt[]" size="15"  onKeyUp="displayText()" value="<?php echo set_value('amt[]'); ?>"/></td>
    </tr>
	<?php $count++;
	}?>
		<tr>
    <td ><?php echo $count; ?> </td>
    <td >Total </td>
	<!--<td bgcolor=#FA58F4><input type="text" id="text3" value="0" size="15" disabled="disabled" /></td>
	<td bgcolor=#FA58F4 height=5> <input type="text" id="text4" value="0" size="15" disabled="disabled" /></td>-->
	<td bgcolor=#FA58F4><input type="text" id="text3" value="<?php echo isset($_POST['a'])?$_POST['a']:'0'; ?>" size="15"  name="a" readonly="readonly"/></td>
	<td bgcolor=#FA58F4 height=5> <input type="text" id="text4" value="<?php echo isset($_POST['a'])?$_POST['b']:'0'; ?>" size="15" readonly="readonly" name="b"/></td>
    </tr>
	</table>

	
 </br>
 
 <table align=center> 
 <tr>
 <td style="color:#FF0000;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight:bold;">Before giving entry the user should be alert that the data entry is correct and confirm.</td>
 </tr>
 </table>
 
 </br>
 
    <table align=center> 
	<tr>
	<td><td><?php echo form_submit('actionbtn', 'Submit'); ?></td>
	</tr>
	</table>
  	
	</br>
	 
	<table Width="70%" align =center id="tbldesgTarget">
	 <tr>
	   <td height="102">
		<table width="70%">
			<tr>
			<th>Designation </th>
			</tr>
			<tr>
			<th>Target No.of A/C </th>
			</tr>
			<tr>
			<th >Target Amt in Lac </th>
			</tr>
		</table>
		</td>
		
		<td height="102" style="vertical-align:top;">
		<table >
				<tr>
						<?php 
					foreach($records_target as $row)
					{?>
					<th style="padding-top:1px; padding-bottom:10px;" ><?php echo $row->Dsg_File_No_Prefix; ?></th>
					<?php 
					}?>
				</tr>
				<tr>
					<?php 
					foreach($records_target as $row)
					{?>
					<td style="padding-top:15px;"><input type="text" name="designoac[]" value= "<?php echo $row->Dsg_Target_ac; ?>"  disabled="disabled" size="6"  style="background-color:#FFFFFF;font-size:14px;font-weight:bold;color:#000000;"/></td>
					<?php 
					}?>
				</tr>
				<tr>
					<?php 
					foreach($records_target as $row)
					{?>
					<td style="padding-top:15px;"><input type="text" name="desigamt[]" disabled="disabled" value= "<?php echo $row->Dsg_Target_Amt; ?>" size="6" style="background-color:#FFFFFF;font-size:14px;font-weight:bold;color:#000000;" /></td>
					<?php 
					}?>
				</tr>
			</table>
		</td>		
				
	  </tr>
	</table>
	</td>
	</tr>
	</table>
  
	<!--/fieldset-->
  	<?php echo form_close();
?>
