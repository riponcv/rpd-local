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
    echo "<table align =center id=\"tbldesgTarget\"><tr><th>Integrated Supervision System Bangladesh Bank letter Report</th></tr></table>";
    echo "</table>";  

    echo form_open_multipart('iss/iss_bb_letter_report_save', 'id="iss_bb_letter_form"'); ?>
	
    <table border="1" style="margin-top: 50px;" id="search_form_table">
    
    <tr >
		<td colspan="3" style="text-align:center">Bangladesg Bank Letter Information(ISM-CELL)</td>
    </tr>
    <tr>
		<td>Bangladesg Bank Letter No.</td>
		<td><input type="text" name="bb_letter_no" id="bb_letter_no" value="" style="width:555px;height:35px;font-size:18px" /></td>
	</tr>
	<tr>
		<td>Bangladesg Bank Letter Date</td>
		<td><input type="text" name="bb_letter_date" id="bb_letter_date" value="" style="width:555px;height:35px;font-size:18px" /></td>
		<td>(DD/MM/YYYY)</td>
	</tr>
	<tr>
		<td>Bangladesg Bank Letter Sub.</td>
		<td><input type="text" name="bb_letter_sub" id="bb_letter_sub" value="" style="width:555px;height:35px;font-size:18px" /></td>
	</tr>
	<tr>
		<td>BB ISS related field</td>
		<td>
			<?php
				echo '<select name="report_of_iss2_item_bb_letter" id="report_of_iss2_item_bb_letter" style="width:555px;height:35px;font-size:18px">';
				echo '<option value="">Select ISS Form-2 Item</option>';
				foreach($form2_iss_item as $row_iss2item)
				{
					$select='';
					if(isset($_POST['report_of_iss2_item_bb_letter']) && $_POST['report_of_iss2_item_bb_letter']==$row_iss2item->SUPERVISION_COA_ID)
					{
						$select="selected='selected'";
					}
				  echo '<option value="'.$row_iss2item->SUPERVISION_COA_ID.'" '.$select.'>'.'('.$row_iss2item->SL.') '.$row_iss2item->COA_DESCRIPTION.'</option>';
			
				}
				echo '</select>';
			?>
		</td>
	</tr>
	<tr>
		<td>BB Letter Upload</td>
		<td colspan="2">
			<input type="file" id="input_file_id" name="photo" >
			<!--<input type="file" name="photo" id="input_file_id" size="25" />-->
		</td>
	</tr>
	<tr>
		<td>JBL Branch</td>
		<td colspan="2">
			<table border="1">
				<tr>
					<td style="width:90px">Branch Code (BB)</td>
					<td style="text-align:center; width:360px;">Branch Name</td>
				</tr>
			</table>
		</td>	
	</tr>
	<tr id="extra_id_1" style="">
		<td id="extra_id_2" style="">JBL Branch</td>
		<td colspan="2" id="extra_id_3" style="">
			<div class="abb_br_here"></div>
		</td>
		
	</tr>
    <tr>
    <td>Search Required Office</td>
		<td><input type="text" name="search_text" id="search_text" value="" onkeyup="fetch_br_ao_do_iss_2_bb_letter(this.value)" style="width:555px;height:35px;font-size:18px"/></td>
		<td><input type="button" name="add_br" id="add_br" value="Add Branch" style="background-color: #FF9900;height:35px" onclick="add_branch_bb_letter_info()"/></td>
	</tr>
    
    <tr id="report_of_br_ao_do_div_msg">
    <td COLSPAN="2"><h6 style="color: red;">Type on search box to get desired office </h6></td>
    </tr>
    
    <tr id="report_of_br_ao_do_div">
    <td COLSPAN="3">
    <input type="button" name="view_report" id="view_report" value="Submit" style="background-color: #FF9900;" onclick="check_search_form_iss_bb_letter(this.value)"/>
    </td>
    </tr>
    
    </table>
    <input type="hidden" name="login_office_status" id="login_office_status" value="<?php echo $login_office_status; ?>" />
    <input type="hidden" name="report_click_btn" id="report_click_btn" value="0" />
   <?php echo form_close(); ?>
    
 