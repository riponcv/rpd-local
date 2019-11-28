   	<script type="text/javascript">
    jQuery(document).ready(function() {
        var report_option_selector = jQuery('#report_option_selector').val();
        var report_of_pl = jQuery('#report_of_pl').val();
        if(report_option_selector>0)
        {
            control_misd_0022_report_form(report_option_selector);
            my_range_show(report_of_pl);
        }
    })
    </script>
       
    <?php 
    echo "<table align =center id=\"tbldesgTarget\"><tr><th>Business Indicator Monitoring</th></tr></table>";
    echo "</table>";  

    ?>
    <table  align="right">
    <tr align="right"><th><a href="javascript:history.back();">Back</a></th></tr>
    </table>
    <?php
    echo form_open('report/misd_0022_report_details','id="misd_0022_search_form"');
	echo '<div id="report_option_div" style="margin-top:50px">';
    echo '<font style="color:brown;font-weight: bold;">Report For: </font>';
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
    
    echo '<select name="report_option_selector" id="report_option_selector" onchange="control_misd_0022_report_form(this.value)">';
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
        echo "Year";
        //$year_array=array('2012','2013','2014');
		$this->load->helper('base');
        $year_array=get_common_year();
        echo '<select name="report_of_year" id="report_of_year">';
        echo '<option value="">Select</option>';
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
    </tr>

    <!--
    <tr id="my_range_box">
    <td>Lower Range :</td>
    <td>
    <input type="text" name="range1" id="range1" value="" style="background-color: #FFFFCC ;"/>
    <span >Upper Range</span>
    <input type="text" name="range2" id="range2" value="" style="background-color: #FFFFCC ;"/>
    </td>
    </tr>
    -->
    <tr id="report_of_br_ao_do_div_box">
    <td>Search Required Office</td>
    <td COLSPAN="3"><input type="text" size="59px" name="search_text" id="search_text" value="" onkeyup="fetch_br_ao_do_report(this.value)"/></td>
    </tr>
    
    <tr id="report_of_br_ao_do_div_msg">
    <td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>
    </tr>
    
    <tr id="report_of_br_ao_do_div">
    <td COLSPAN="3">
		<input type="button" name="lcd" id="lcd" value="LCD" style="background-color: #FF9900;" onclick="check_search_form_misd_0022(1)"/>
		<input type="button" name="hcd" id="hcd" value="HCD" style="background-color: #FF9900;" onclick="check_search_form_misd_0022(2)"/>
		<input type="button" name="deposit" id="deposit" value="Deposit" style="background-color: #FF9900;" onclick="check_search_form_misd_0022(3)"/>
		<input type="button" name="adv" id="adv" value="Advance" style="background-color: #FF9900;" onclick="check_search_form_misd_0022(4)"/>
		<input type="button" name="cl" id="cl" value="CL Amount" style="background-color: #FF9900;" onclick="check_search_form_misd_0022(5)"/>
		<input type="button" name="pl" id="pl" value="PL" style="background-color: #FF9900;" onclick="check_search_form_misd_0022(6)"/>
		<input type="button" name="lcd_per" id="lcd_per" value="LCD%" style="background-color: #FF9900;" onclick="check_search_form_misd_0022(7)"/>
		<input type="button" name="hcd_per" id="hcd_per" value="HCD%" style="background-color: #FF9900;" onclick="check_search_form_misd_0022(8)"/>
		<input type="button" name="cl_per" id="cl_per" value="CL%" style="background-color: #FF9900;" onclick="check_search_form_misd_0022(9)"/>
   </td>
    </tr>

    
    </table>
    <input type="hidden" name="login_office_status" id="login_office_status" value="<?php echo $login_office_status; ?>" />
    <input type="hidden" name="report_click_btn" id="report_click_btn" value="0" />
    <?php echo '</form>'; ?>
    
 