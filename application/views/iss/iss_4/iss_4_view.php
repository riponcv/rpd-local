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
    echo "<table align =center id=\"tbldesgTarget\"><tr><th>Integrated Supervision System Form-4 Report</th></tr></table>";
    echo "</table>";  

	  if($this->session->flashdata('success_wp'))
		{
			echo "<div id='flashdata'>";
			echo '<font style="background-color:yellow;font-weight: bold;color: green;">'.$this->session->flashdata('success_wp').'</font>'; 
			echo "</div>";
		}
	
    echo form_open('iss/iss_form_4_report_details','id="iss_form_4_search_form"');
	echo '<div id="report_option_div" style="margin-top:50px">';
    echo '<font style="color:brown;font-weight: bold;">ISS Report For: </font>';
    if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']==$val)
	{
		$select="selected='selected'";
	}
    //control option
    $br_disable_status='';
    $ao_disable_status='';
    $do_disable_status='';
    
    if($login_office_status==4){$br_disable_status='disabled="disabled"';}
    if($login_office_status==3){$ao_disable_status='disabled="disabled"';}
    if($login_office_status==2){$do_disable_status='disabled="disabled"';}
    
    echo '<select name="report_option_selector" id="report_option_selector" onchange="control_iss_report_form(this.value)">';
    echo '<option value="0">Select ISS report option</option>';
    echo '<option value="1">My Office Report</option>';
    echo '<option value="2">Branch Report</option>';
   // echo '<option value="3" '.$br_disable_status.'>Area Office Report</option>';
    //echo '<option value="4" '.$br_disable_status.' '.$ao_disable_status.'>Divisional Office Report</option>';
    echo '<option value="5" '.$br_disable_status.' '.$ao_disable_status.' '.$do_disable_status.'>Whole Bank Report</option>';
	echo '</select>';
    echo '</div>';
	?>
    <table border="1" style="margin-top: 50px;display: none;" id="search_form_table">
    <tr>
        <th COLSPAN="2">
         <h3 style="color: green;">FILL FORM FOR REPORT</h3>
    </th>
    </tr>

    <tr id="report_of_year_div">
    <td>Report Of The Date</td>
    <td>
    <?php
        echo '<select name="report_of_date" id="report_of_date">';
        echo '<option value="">Select Date</option>';
    	foreach($records3 as $row)
    	{
    		$select='';
    		if(isset($_POST['report_of_date']) && $_POST['report_of_date']==$row->ISSEntryDate)
    		{
    			$select="selected='selected'";
    		}
    	  echo '<option value="'.$row->ISSEntryDate.'" '.$select.'>'.$row->ISSEntryDate.'</option>';
    
    	}
    	echo '</select>';
        ?>
    </td>
    </tr>
    
    <tr id="report_of_br_ao_do_div_box">
    <td>Search Required Office</td>
    <td><input type="text" name="search_text" id="search_text" value="" onkeyup="fetch_br_ao_do_iss(this.value)"/></td>
    </tr>
    
    <tr id="report_of_br_ao_do_div_msg">
    <td COLSPAN="2"><h6 style="color: red;">Type on search box to get desired office </h6></td>
    </tr>
    
    <tr id="report_of_br_ao_do_div">
    <td COLSPAN="2">
    <input type="button" name="view_report" id="view_report" value="View Report" style="background-color: #FF9900;" onclick="check_search_form_iss_4(this.value)"/>
    <!--<input type="button" name="missing_list" id="missing_list" value="Missing List" style="background-color: #FF9900;" onclick="check_search_form_iss(this.value)"/>
    <input type="button" name="completed_list" id="completed_list" value="Completed List" style="background-color: #FF9900;" onclick="check_search_form_iss(this.value)"/>-->
    </td>
    </tr>
    
    </table>
    <input type="hidden" name="login_office_status" id="login_office_status" value="<?php echo $login_office_status; ?>" />
    <input type="hidden" name="report_click_btn" id="report_click_btn" value="0" />
    <?php echo '</form>'; ?>
    
 