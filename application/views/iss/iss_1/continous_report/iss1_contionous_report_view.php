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
    echo "<table align =center id=\"tbldesgTarget\"><tr><th>Integrated Supervision System ISS-1 Continous Report</th></tr></table>";
	echo form_open('iss/iss_form_1_continous_report_details','id="iss1_con_report_search_form"');
   /*
	echo "</table>";  
    echo form_open('iss/iss_form_1_continous_report_details','id="iss1_con_report_search_form"');
	echo '<div id="report_option_div" style="margin-top:50px">';
    echo '<font style="color:brown;font-weight: bold;">ISS Report For: </font>';
    if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']==$val)
	{
		$select="selected='selected'";
	}
    $br_disable_status='';
    $ao_disable_status='';
    $do_disable_status='';
    
    if($login_office_status==4){$br_disable_status='disabled="disabled"';}
    if($login_office_status==3){$ao_disable_status='disabled="disabled"';}
    if($login_office_status==2){$do_disable_status='disabled="disabled"';}
    
    echo '<select name="report_option_selector" id="report_option_selector" onchange="control_iss_continous_report_form(this.value)">';
    echo '<option value="0">Select ISS report option</option>';
    echo '<option value="1">My Office Report</option>';
    echo '<option value="2">Branch Report</option>';
    echo '<option value="3" '.$br_disable_status.'>Area Office Report</option>';
    echo '<option value="4" '.$br_disable_status.' '.$ao_disable_status.'>Divisional Office Report</option>';
    echo '<option value="5" '.$br_disable_status.' '.$ao_disable_status.' '.$do_disable_status.'>Whole Bank Report</option>';
	echo '</select>';
    echo '</div>';*/
	?>
    <!--<table border="1" style="margin-top: 50px;display: none;" id="search_form_table">-->
    <table border="1" style="margin-top: 50px;" id="">
    <tr>
        <th COLSPAN="4">
         <h3 style="color: green;">SELECT YEAR FOR ISS-1 CONTINOUS REPORT</h3>
    </th>
    </tr>

    <!--<tr id="report_of_year_div">-->
    <tr id="">
    <td>Select Year</td>
    <td>
    <?php
	
        echo '<select name="report_of_date_con_year" id="report_of_date_con_year">';
        echo '<option value="">Select a Year</option>';
    	foreach($records3 as $row)
    	{
			$select='';
    		if(isset($_POST['report_of_date_con_year']) && $_POST['report_of_date_con_year']==$row->ISS_Year)
    		{
    			$select="selected='selected'";
    		}
    	  echo '<option value="'.$row->ISS_Year.'" '.$select.'>'.$row->ISS_Year.'</option>';
    
    	}
    	echo '</select>';
        ?>
    </td>
    </tr>
          
    <tr id="report_of_br_ao_do_div">
    <td COLSPAN="4">
    <input type="button" name="view_report" id="view_report" value="View Report" style="background-color: #FF9900;" onclick="check_search_form_iss_1_continous(this.value)"/>
    
    </td>
    </tr>
    
    </table>
	<input type="hidden" name="report_click_btn" id="report_click_btn" value="0" />
    <?php echo '</form>'; ?>
    
 