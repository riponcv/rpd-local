   	<script type="text/javascript">
    jQuery(document).ready(function() {
        var report_option_selector = jQuery('#report_option_selector').val();
        if(report_option_selector>0)
        {
            control_iss_form(report_option_selector);
        }
    })
    </script>

   	<?php 
    echo "<table align =center id=\"tbldesgTarget\"><tr><th>Integrated Supervision System Letter Information System</th></tr></table>";
    echo "</table>";  

    echo form_open_multipart('iss/', 'id="iss_bb_letter_search_form"'); ?>
	<table><tr>
			<td style="height:30px; text-align:center"><?php echo anchor('iss/iss_bb_letter_report_view', 'Branch Letter Information Entry'); ?></td>
			<td style="height:30px; text-align:center;padding-left:65px"><?php echo anchor('iss/iss_bb_letter_report_search_view', 'Branch Letter Search'); ?></td>
		</tr>
		
		
	
	</table>
	<?php
	$br_name;
	foreach($br_info as $single_br)
	{
		$br_name = $single_br->branchname;
	}
	?>
	<table>
		<tr>
			<td><?php echo "Branch Code:"; ?></td>
			<td><?php echo $br_code; ?></td>
			<td><input type="hidden" name="br_letter_code" id="br_letter_code" value="<?php echo $br_code; ?>" /></td>
		</tr>
		<tr>
			<td><?php echo "Branch Name:"; ?></td>
			<td><?php echo $br_name; ?></td>
		</tr>
	</table>
	<table border="1" style="margin-top: 50px;" id="search_form_table">
       <?php 
	   if(!empty($iss_leter_info))
		{
	   ?>
	 <tr >
		<td colspan="" style="text-align:center; font-weight: 700"> SL. No.</td>
		<td colspan="" style="text-align:center; font-weight: 700"> ISS form-2 Related Item</td>
		<td colspan="" style="text-align:center; font-weight: 700"> Branch Letter Date</td>
		<td colspan="" style="text-align:center; font-weight: 700"> Branch Summery (Ans)</td>
		<td colspan="" style="text-align:center; font-weight: 700"> Action</td>
    </tr>
	
	<?php 
			
			$count = 1;
			foreach($iss_leter_info as $single_info)
			{
			?><tr >
				<td colspan="" style="text-align:left"> <?php echo $count++; ?> </td>
				<td colspan="" style="text-align:left"> <?php echo $single_info->iss2item; ?> </td>
				<td colspan="" style="text-align:left"> <?php 
					$dayinpass = strtotime($single_info->db_br_letter_date_ans);
					echo date('d/m/Y', $dayinpass);
				?> </td>
				<td colspan="" style="text-align:left"> <?php echo $single_info->br_letter_summary; ?> </td>
				<td colspan="" style="text-align:center"> <?php echo anchor('iss/bb_letter_info_delete/'.$single_info->db_sl, 'Delete'); ?> </td>
			</tr>
			<?php } ?>
	
		<?php 
		}
		else
		{?>
			<tr > <td colspan="3" style="text-align:center; color:red"> <?php echo "No Letter Related Information Found"; ?> </td> </tr>
		<?php }
		
	?>
    
    </table>
    
   <?php echo form_close(); ?>
    
 