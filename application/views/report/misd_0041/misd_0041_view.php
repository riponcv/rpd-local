   	<script type="text/javascript">
    jQuery(document).ready(function() {
        var report_option_selector = jQuery('#report_option_selector').val();
        if(report_option_selector>0)
        {
            control_misd_0041_report_form(report_option_selector);
        }
    })
    </script>
       
    <?php 
    echo "<table align =center id=\"tbldesgTarget\"><tr><th>Head Account/Single Account Report</th></tr></table>";
    echo "</table>";  

    ?>
    <table  align="right">
    <tr align="right"><th><a href="javascript:history.back();">Back</a></th></tr>
    </table>
    <?php
    echo form_open('report/misd_0041_report_details','id="misd_0041_search_form"');
	echo '<div id="report_option_div" style="margin-top:50px">';
    echo '<font style="color:brown;font-weight: bold;">Head Account/Single Account Report For: </font>';
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
    
    echo '<select name="report_option_selector" id="report_option_selector" onchange="control_misd_0041_report_form(this.value)">';
    echo '<option value="0">Select option</option>';
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

    <tr id="report_of_year_div">
    <td>Report Of :</td>
    <td>
        <?php
        echo '<select name="report_of_date" id="report_of_date" >';
        echo '<option value="">Select Date</option>';
        if(isset($wp_date) && !empty($wp_date))
        {
             foreach($wp_date as $row)
        	{
        		$select='';
        		if(isset($_POST['report_of_date']) && $_POST['report_of_date']==$row->weekly_date)
        		{
        			$select="selected='selected'";
        		}
        	  echo '<option  value="'.$row->weekly_date.'" '.$select.'>'.$row->weekly_date.'</option>';
        
        	}   
        }
    	echo '</select>';
        ?>
    </td>
    </tr>
    
    <tr id="report_of_br_ao_do_div_box">
    <td>Search Required Office</td>
    <td COLSPAN="3"><input type="text" size="37px" name="search_text" id="search_text" value="" onkeyup="fetch_br_ao_do_report(this.value)"/></td>
    </tr>
    
    <tr id="report_of_br_ao_do_div_msg">
    <td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>
    </tr>
    
    <tr id="radio_head_single_account">
    <td COLSPAN="3"><input type="radio" name="head_account_radio" value="1" onchange="manage_group_subgroup_option(1)" />Head Account&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="head_account_radio" value="2" onchange="manage_group_subgroup_option(2)" />Single Account</td>
    </tr>
    
    <tr id="head_account_div" style="display: none;">
    <td colspan="3">
    Select Head Account :
    <select name="head_account" id="head_account">
    <option value="">Select Head Account</option>
    <?php 
    if(isset($wp_group) && !empty($wp_group))
    {
        foreach($wp_group as $key=>$row)
        {
            if($row->weekly_position_group_code !=39)
            {
            ?><option value="<?php echo $row->weekly_position_group_code; ?>"><?php echo $row->weekly_position_group_text; ?></option><?php
            }
        }
    }
    ?>
    </select>
    </td>
    </tr>
    
    <tr id="single_account_div" style="display: none;">
    <td colspan="3">
    Select Single Account :
    <select name="single_account" id="single_account">
    <option value="">Select Single Account</option>
    <?php 
    if(isset($wp_subgroup) && !empty($wp_subgroup))
    {
        foreach($wp_subgroup as $key=>$row)
        {
            ?><option value="<?php echo $row->weekly_position_subgroup_code; ?>"><?php echo $row->weekly_position_subgroup_text; ?></option><?php
        }
    }
    ?>
    </select>
    </td>
    </tr>
    
    <tr id="report_of_br_ao_do_div">
    <td COLSPAN="3">
    <input type="button" name="view_report" id="view_report" value="View Report" style="background-color: #FF9900;" onclick="check_search_form_misd_0041(this.value)"/>
    <input type="button" name="save_report_as_pdf" id="save_report_as_pdf" value="Save Report As PDF" style="background-color: #FF9900;" onclick="check_search_form_misd_0041(this.value)"/>
    </td>
    </tr>
    
    </table>
    <input type="hidden" name="login_office_status" id="login_office_status" value="<?php echo $login_office_status; ?>" />
    <input type="hidden" name="report_click_btn" id="report_click_btn" value="0" />
    <input type="hidden" name="head_text" id="head_text" value="" />
    <input type="hidden" name="single_text" id="single_text" value="" />
    <?php echo '</form>'; ?>
    
 