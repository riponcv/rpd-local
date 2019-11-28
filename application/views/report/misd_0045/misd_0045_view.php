   	<script type="text/javascript">
    jQuery(document).ready(function() {
        var report_option_selector = jQuery('#report_option_selector').val();
        //var report_of_pl = jQuery('#report_of_pl').val();
        if(report_option_selector>0)
        {
            control_misd_0045_report_form(report_option_selector);
            //my_range_show(report_of_pl);
        }
    })
    </script>
       
    <?php 
    echo "<table align =center id=\"tbldesgTarget\"><tr><th>Indicator's Graphical Analysis</th></tr></table>";
    echo "</table>";  

    ?>
    <table  align="right">
    <tr align="right"><th><a href="javascript:history.back();">Back</a></th></tr>
    </table>
    <?php
    echo form_open('report/misd_0045_report_details','id="misd_0045_search_form"');
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
    
    echo '<select name="report_option_selector" id="report_option_selector" onchange="control_misd_0045_report_form(this.value)">';
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
    <th COLSPAN="2">
         <h3 style="color: green;">FILL FORM FOR REPORT</h3>
    </th>
    </tr>

    <tr id="report_of_date_div">
    <td>Graph Of :</td>
    <td>
    <?php
        echo '<select name="report_of_date1" id="report_of_date1" >';
        echo '<option value="">Select Date</option>';
    	foreach($records3 as $row)
    	{
    		$select='';
    		if(isset($_POST['report_of_date1']) && $_POST['report_of_date1']==$row->om_dat_date)
    		{
    			$select="selected='selected'";
    		}
            echo '<option  value="'.$row->om_dat_date.'" '.$select.'>'.$row->om_dat_date.'</option>';
    
    	}
    	echo '</select>';
        ?>
    
    &nbsp;&nbsp;&nbsp;&nbsp; to &nbsp;&nbsp;&nbsp;&nbsp;
   
    <?php
        echo '<select name="report_of_date2" id="report_of_date2" >';
        echo '<option value="">Select Date</option>';
    	foreach($records3 as $row)
    	{
    		$select='';
    		if(isset($_POST['report_of_date2']) && $_POST['report_of_date2']==$row->om_dat_date)
    		{
    			$select="selected='selected'";
    		}
            echo '<option  value="'.$row->om_dat_date.'" '.$select.'>'.$row->om_dat_date.'</option>';
    
    	}
    	echo '</select>';
        ?>
    </td>
    </tr>
    
    <tr id="report_of_br_ao_do_div_box">
    <td>Search Required Office</td>
    <td><input type="text" size="80px" name="search_text" id="search_text" value="" onkeyup="fetch_br_ao_do_report(this.value)"/></td>
    </tr>
    
    <tr id="report_of_br_ao_do_div_msg">
    <td COLSPAN="2"><h6 style="color: red;">Type on search box to get desired office </h6></td>
    </tr>
    
    <tr id="report_of_br_ao_do_div">
    <td COLSPAN="2">
    <input type="button" name="dp" id="dp" value="Deposit" style="background-color: #FF9900;" onclick="check_search_form_misd_0045(1)"/>
    <input type="button" name="hcd" id="hcd" value="HCD" style="background-color: #FF9900;" onclick="check_search_form_misd_0045(2)"/>
    <input type="button" name="hcd_%" id="hcd_%" value="HCD(%)" style="background-color: #FF9900;" onclick="check_search_form_misd_0045(3)"/>
    <input type="button" name="lcd" id="lcd" value="LCD" style="background-color: #FF9900;" onclick="check_search_form_misd_0045(4)"/>
    <input type="button" name="lcd_%" id="lcd_%" value="LCD(%)" style="background-color: #FF9900;" onclick="check_search_form_misd_0045(5)"/>
    <input type="button" name="adv" id="adv" value="Advance" style="background-color: #FF9900;" onclick="check_search_form_misd_0045(6)"/>
    <input type="button" name="adr_including_lya" id="adr_including_lya" value="ADR including LYA" style="background-color: #FF9900;" onclick="check_search_form_misd_0045(7)"/>
	<input type="button" name="adr_excluding_lya" id="adr_excluding_lya" value="ADR excluding LYA" style="background-color: #FF9900;" onclick="check_search_form_misd_0045(12)"/>
    <input type="button" name="pl" id="pl" value="PL" style="background-color: #FF9900;" onclick="check_search_form_misd_0045(8)"/>
    <input type="button" name="uc" id="uc" value="UC" style="background-color: #FF9900;" onclick="check_search_form_misd_0045(9)"/>
    <input type="button" name="cl" id="cl" value="CL" style="background-color: #FF9900;" onclick="check_search_form_misd_0045(10)"/>
    <input type="button" name="cl_%" id="cl_%" value="CL(%)" style="background-color: #FF9900;" onclick="check_search_form_misd_0045(11)"/>
    </td>
    </tr>

    
    </table>
    <input type="hidden" name="login_office_status" id="login_office_status" value="<?php echo $login_office_status; ?>" />
    <input type="hidden" name="report_click_btn" id="report_click_btn" value="0" />
    <?php echo '</form>'; ?>
    
 