<?php
	if($login_office_status ==1)
	{
		echo "<table align =center id=\"tbldesgTarget\"><tr><th>ISS Head Office Module</th></tr></table>";
		?>
		<div class="deptt_table">
		<table>
			<tr>
				<th>SL</th>
				<th>Module Name</th>
				<th>Description</th>
			</tr>
			<!--<tr>
				<td>1</td>
				<td><?php //echo anchor('iss/iss_1_deptt_entry_con/', 'Department data entry system'); ?></td>
				<td>Department wise ISS Data entry system</td>
			</tr>
			<tr>
				<td>2</td>
				<td><?php //echo anchor('iss/iss1_dept_report/', 'Department report'); ?></td>
				<td>Department wise ISS Data entry report system</td>
			</tr>
			<tr>
				<td>3</td>
				<td><?php //echo anchor('iss/iss1_form_report_view/', 'ISS Form-1 report'); ?></td>
				<td>ISS Form-1 Report</td>
			</tr>-->
			<?php if(isset($office_id) && $office_id==9035) {?>
			<tr>
				<!--<td>4</td>
				<td><?php //echo anchor('iss/iss1_bb_form_report_view/', 'ISS Form-1 entry'); ?></td>
				<td>ISS Form-1 Report making</td>-->
			</tr>
			<?php } ?>

			<tr>
				<td>1</td>
				<td><?php echo anchor('iss/iss1_form_report_view/', 'ISS Form-1 report monthly'); ?></td>
				<td>ISS Form-1 Report</td>
			</tr>

			<tr>
				<td>2</td>
				<td><?php echo anchor('iss/iss_form_1_continous_report/', 'ISS Form-1 Report Yearly'); ?></td>
				<td>ISS Form-1 Continous Report (Year wise)</td>
			</tr>
			<tr>
				<td>3</td>
				<td><?php echo anchor('iss/iss_form_3_report/', 'ISS Form-3 Report'); ?></td>
				<td>ISS Form-3 Report</td>
			</tr>
			<tr>
				<td>4</td>
				<td><?php echo anchor('iss/iss_form_1_itemwise_report/', 'ISS Form-1 Item wise Report'); ?></td>
				<td>ISS Form-1 Item wise Report</td>
			</tr>

			<tr>
				<td>ED.5</td>
				<td><?php echo anchor('iss/iss_1_deptt_entry_con/', 'ISS Form-1 Department Data Entry system'); ?></td>
				<td>ISS Form-1 Department Data Entry system</td>
			</tr>
			
			<tr>
				<td>ED.6</td>
				<td><?php echo anchor('iss/iss1_dept_report/', 'ISS Form-1 Department Data Entry Report'); ?></td>
				<td>ISS Form-1 Department Data Entry Report</td>
			</tr>

			<tr>
				<td>ED.7</td>
				<td><?php echo anchor('iss/iss1_bb_form_report_view/', 'ISS Form-1 with department data Form-2 data and BB submitted'); ?></td>
				<td>ISS Form-1 with department data Form-2 data and BB submitted)</td>
			</tr>
			<?php if(isset($u_office_code)&& $u_office_code==9025){?>
			<tr>
				<td>ED.8</td>
				<td><?php echo anchor('iss/iss1_bb_decesion_view/', 'ISS Form-1 Decision to submit form'); ?></td>
				<td>ISS Form-2, Form-1 with department data, BB submitted data and Decision to submit data form</td>
			</tr>
			<tr>
				<td>ED.9</td>
				<td><?php echo anchor('iss/iss1_bb_prepare_view/', 'ISS Form-1 Prepare Form Data'); ?></td>
				<td>ISS Form-1 Prepare Form Data</td>
			</tr>	
			<?php } ?>
		</table>
		</div>
		<?php
	}
	else
	{
		 echo '<table align=center><tr><td style="color:#FF0000;font-family:Arial, Helvetica, sans-serif;font-size:15px;font-weight:bold;">You are not allowed to Access this module.</td></tr></table>';
	}
	
	?>