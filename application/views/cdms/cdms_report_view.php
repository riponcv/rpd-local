   	<script type="text/javascript">
    jQuery(document).ready(function() {
        var report_option_selector = jQuery('#report_option_selector').val();
        if(report_option_selector>0)
        {
            control_cdms_report_form(report_option_selector);
        }
    })
    </script>

   	<?php 
    echo "<table align =center id=\"tbldesgTarget\"><tr><th>Core Deposit Monitoring System Report</th></tr></table>";
    echo "</table>";  


    echo form_open('rpd/cdms_report_details','id="cdms_search_form"');
	echo '<div id="report_option_div" style="margin-top:50px">';
    echo '<font style="color:brown;font-weight: bold;">CDMS Report For: </font>';
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
    
    echo '<select name="report_option_selector" id="report_option_selector" onchange="control_cdms_report_form(this.value)">';
    echo '<option value="0">Select CDMS report option</option>';
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
        echo "Year";
        //$year_array=array('2013','2014');
		$this->load->helper('base');
        $year_array=get_common_year();
        echo '<select name="report_of_year" id="report_of_year">';
        echo '<option value="">Select Year</option>';
    	foreach($year_array as $key=>$val)
    	{
    		$select='';
    		if(isset($_POST['report_of_year']) && $_POST['report_of_year']==$val)
    		{
    			$select="selected='selected'";
    		}
    	  echo '<option value="'.$val.'" '.$select.'>'.$val.'</option>';
    
    	}
    	echo '</select>';
        ?>
    </td>
    <td>
    <?php
        echo "Month";
        $month_array=array('01'=>'JANUARY','02'=>'FEBRUARY','03'=>'MARCH','04'=>'APRIL','05'=>'MAY','06'=>'JUNE','07'=>'JULY','08'=>'AUGUST','09'=>'SEPTEMBER','10'=>'OCTOBER','11'=>'NOVEMBER','12'=>'DECEMBER');
        echo '<select name="report_of_month" id="report_of_month">';
        echo '<option value="">Select Month</option>';
    	foreach($month_array as $key=>$val)
    	{
    		$select='';
    		if(isset($_POST['report_of_month']) && $_POST['report_of_month']==$key)
    		{
    			$select="selected='selected'";
    		}
    	  echo '<option value="'.$key.'" '.$select.'>'.$val.'</option>';
    
    	}
    	echo '</select>';
        ?>
    </td>
    </tr>
    
    <tr id="report_of_br_ao_do_div_box">
    <td>Search Required Office</td>
    <td COLSPAN="2"><input type="text" size="50px" name="search_text" id="search_text" value="" onkeyup="fetch_br_ao_do_cdms(this.value)"/></td>
    </tr>
    
    <tr id="report_of_br_ao_do_div_msg">
    <td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>
    </tr>
    
    <tr id="report_of_br_ao_do_div">
    <td COLSPAN="3">
    <input type="button" name="view_report" id="view_report" value="View Report" style="background-color: #FF9900;" onclick="check_search_form_cdms(this.value)"/>
    <input type="button" name="missing_list" id="missing_list" value="Missing List" style="background-color: #FF9900;" onclick="check_search_form_cdms(this.value)"/>
    <input type="button" name="completed_list" id="completed_list" value="Completed List" style="background-color: #FF9900;" onclick="check_search_form_cdms(this.value)"/>
    </td>
    </tr>
    
    </table>
    <input type="hidden" name="login_office_status" id="login_office_status" value="<?php echo $login_office_status; ?>" />
    <input type="hidden" name="report_click_btn" id="report_click_btn" value="0" />
    <?php echo '</form>'; ?>
    
 