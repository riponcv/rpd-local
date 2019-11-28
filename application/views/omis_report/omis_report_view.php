   	<script type="text/javascript">
    jQuery(document).ready(function() {
        var report_option_selector = jQuery('#report_option_selector').val();
        if(report_option_selector>0)
        {
            control_omis_report_form(report_option_selector);
        }
    })
    </script>

   	<?php 
    echo "<table align =center id=\"tbldesgTarget\"><tr><th>Overview Management Information System Report</th></tr></table>";
    echo "</table>";  


    echo form_open('rpd/omis_report_details','id="omis_search_form"');
	echo '<div id="report_option_div" style="margin-top:50px">';
    echo '<font style="color:brown;font-weight: bold;">OMIS Report For: </font>';
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
    
    echo '<select name="report_option_selector" id="report_option_selector" onchange="control_omis_report_form(this.value)">';
    echo '<option value="0">Select OMIS report option</option>';
    echo '<option value="1">My Office Report</option>';
    echo '<option value="2">Branch Report</option>';
    echo '<option value="3" '.$br_disable_status.'>Area Office Report</option>';
    echo '<option value="4" '.$br_disable_status.' '.$ao_disable_status.'>Divisional Office Report</option>';
    echo '<option value="6" '.$br_disable_status.' '.$ao_disable_status.'>Divisional Office Corporate Report</option>';
    echo '<option value="5" '.$br_disable_status.' '.$ao_disable_status.' '.$do_disable_status.'>Whole Bank Report</option>';
	echo '</select>';
    echo '</div>';
	?>
    
    

    <table border="1" style="margin-top: 50px;display: none;" id="search_form_table">
    <tr>
    <th COLSPAN="3">
         <h3 style="color: green;">FILL FORM FOR REPORT</h3>
    </th>
    </tr>

    <tr id="report_of_date_div">
    <td>Report Of :</td>
    <td>
    <?php
        echo '<select name="report_of_date" id="report_of_date" >';
        echo '<option value="">Select Date</option>';
    	foreach($records3 as $row)
    	{
    		$select='';
            $pre_selected=0;
    		if(isset($_POST['report_of_date']) && $_POST['report_of_date']==$row->om_dat_date)
    		{
    			$select="selected='selected'";
                $pre_selected=$row->om_is_month_last;
    		}
            else
            {
                $selected_date=$this->session->userdata('last_month_date'); 
                if(isset($selected_date) && $selected_date==$row->om_dat_date)
                {
                   $select="selected='selected'";
                   $pre_selected=$row->om_is_month_last; 
                }
            }
    	  echo '<option id="'.$row->om_is_month_last.'" value="'.$row->om_dat_date.'" '.$select.'>'.$row->om_dat_date.'</option>';
    
    	}
    	echo '</select>';
        echo '<input type="hidden" name="pre_selected_date_decider" id="pre_selected_date_decider" value="'.$pre_selected.'" />';
        
     //jack
     /*
	echo '<select name="datdate" onchange="om_is_month_last_report(this)">';

	$pre_selected=0;
    foreach($records3 as $row)
	{
	
		$select='';
		if(isset($_POST['datdate']) && $_POST['datdate']==$row->om_dat_date)
		{
			$select="selected='selected'";
            $pre_selected=$row->om_is_month_last;
		}
        else
        {
            $selected_date=$this->session->userdata('last_month_date'); 
            if(isset($selected_date) && $selected_date==$row->om_dat_date)
            {
               $select="selected='selected'";
               $pre_selected=$row->om_is_month_last; 
            }
        }
        
      
	  echo '<option id="'.$row->om_is_month_last.'" value="'.$row->om_dat_date.'" '.$select.'>'.$row->om_dat_date.'</option>';
	}
	echo '</select>';
    echo '<input type="hidden" name="pre_selected_date_decider" id="pre_selected_date_decider" value="'.$pre_selected.'" />';*/
    
    //jack
        ?>
    </td>
    </tr>
    
    <tr id="report_of_br_ao_do_div_box">
    <td>Search Required Office</td>
    <td><input type="text" name="search_text" id="search_text" value="" onkeyup="fetch_br_ao_do_omis(this.value)"/></td>
    </tr>
    
    <tr id="report_of_br_ao_do_div_msg">
    <td COLSPAN="2"><h6 style="color: red;">Type on search box to get desired office </h6></td>
    </tr>
    
    <tr id="report_of_br_ao_do_div">
    <td COLSPAN="2">
    <input type="button" name="detail_report" id="detail_report" value="Detail Report" style="background-color: #FF9900;" onclick="check_search_form_omis(this.value)"/>
    <input type="button" name="summary_report" id="summary_report" value="Summary Report" style="background-color: #FF9900;" onclick="check_search_form_omis(this.value)"/>
    <input type="button" name="missing_list" id="missing_list" value="Missing List" style="background-color: #FF9900;" onclick="check_search_form_omis(this.value)"/>
    <input type="button" name="completed_list" id="completed_list" value="Completed List" style="background-color: #FF9900;" onclick="check_search_form_omis(this.value)"/>
    </td>
    </tr>
    
    </table>
    <input type="hidden" name="login_office_status" id="login_office_status" value="<?php echo $login_office_status; ?>" />
    <input type="hidden" name="report_click_btn" id="report_click_btn" value="0" />
    <?php echo '</form>'; ?>
    
 