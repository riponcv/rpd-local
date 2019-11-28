   	<script type="text/javascript">
    jQuery(document).ready(function() {
        var report_option_selector = jQuery('#report_option_selector').val();
        if(report_option_selector>0)
        {
            control_misd_0040_report_form(report_option_selector);
        }
    })
    </script>
       
    <?php 
    echo "<table align =center id=\"tbldesgTarget\"><tr><th>Weekly Position Comparison Report</th></tr></table>";
    echo "</table>";  

    ?>
	
	<?php 
    $notice=$this->session->flashdata('notice'); 
    if(isset($notice) && $notice !='')
    {
        ?>
        <br />
        <table>
        <tr><td style="color: red;font-weight: bold;"><?php echo $notice; ?></td></tr>
        </table>
        <?php
    }
	
    ?>
	
    <table  align="right">
    <tr align="right"><th><a href="javascript:history.back();">Back</a></th></tr>
    </table>
    <?php
    echo form_open('report/misd_0040_report_details','id="misd_0040_search_form"');
	echo '<div id="report_option_div" style="margin-top:50px">';
    echo '<font style="color:brown;font-weight: bold;">Weekly Position Comparison For: </font>';
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
    
    echo '<select name="report_option_selector" id="report_option_selector" onchange="control_misd_0040_report_form(this.value)">';
    echo '<option value="0">Weekly Position Comparison report option</option>';
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
    <th COLSPAN="4">
         <h3 style="color: green;">FILL FORM FOR REPORT</h3>
    </th>
    </tr>

     <tr id="report_of_date_div">
    <td>Weekly Position Comparison Of :</td>
    <td>
    <?php
        echo '<select name="report_of_date1" id="report_of_date1" >';
        echo '<option value="">Select Date</option>';
    	foreach($records3 as $row)
    	{
    		$select='';
    		if(isset($_POST['report_of_date1']) && $_POST['report_of_date1']==$row->weekly_date)
    		{
    			$select="selected='selected'";
    		}
            echo '<option  value="'.$row->weekly_date.'" '.$select.'>'.$row->weekly_date.'</option>';
    
    	}
    	echo '</select>';
        ?>
    </td>
    <td>and/to</td>
    <td>
    <?php
        echo '<select name="report_of_date2" id="report_of_date2" >';
        echo '<option value="">Select Date</option>';
    	foreach($records3 as $row)
    	{
    		$select='';
    		if(isset($_POST['report_of_date2']) && $_POST['report_of_date2']==$row->weekly_date)
    		{
    			$select="selected='selected'";
    		}
            echo '<option  value="'.$row->weekly_date.'" '.$select.'>'.$row->weekly_date.'</option>';
    
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
    <td COLSPAN="4"><h6 style="color: red;">Type on search box to get desired office </h6></td>
    </tr>
    
    <tr id="report_of_br_ao_do_div">
    <td COLSPAN="4">
    <input type="button" name="view_report" id="view_report" value="View Report" style="background-color: #FF9900;" onclick="check_search_form_misd_0040(this.value)"/>
    <input type="button" name="save_report_as_pdf" id="save_report_as_pdf" value="Save Report As PDF" style="background-color: #FF9900;" onclick="check_search_form_misd_0040(this.value)"/>
    </td>
    </tr>
    
    </table>
    <input type="hidden" name="login_office_status" id="login_office_status" value="<?php echo $login_office_status; ?>" />
    <input type="hidden" name="report_click_btn" id="report_click_btn" value="0" />
    <?php echo '</form>'; ?>
    
 