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
    echo "<table align =center id=\"tbldesgTarget\"><tr><th>Integrated Supervision System Form-3 Report</th></tr></table>";
    echo "</table>";  

	  if($this->session->flashdata('success_wp'))
		{
			echo "<div id='flashdata'>";
			echo '<font style="background-color:yellow;font-weight: bold;color: green;">'.$this->session->flashdata('success_wp').'</font>'; 
			echo "</div>";
		}
	
    echo form_open('iss/iss_form_3_report_details','id="iss_form_3_search_form"');
	echo '<div id="report_option_div" style="margin-top:50px">';
    
	?>
    <table border="1" style="margin-top: 50px;" id="">
    <tr>
        <th COLSPAN="2">
         <h3 style="color: green;">FILL FORM FOR REPORT</h3>
    </th>
    </tr>

    <tr id="report_of_year_div">
    <td>Report Of The Date</td>
    <td>
    <?php
        echo '<select name="report_of_date_iss3" id="report_of_date_iss3">';
        echo '<option value="">Select Date</option>';
    	foreach($records3 as $row)
    	{
    		$select='';
    		if(isset($_POST['report_of_date_iss3']) && $_POST['report_of_date_iss3']==$row->ISSEntryDate)
    		{
    			$select="selected='selected'";
    		}
    	  echo '<option value="'.$row->ISSEntryDate.'" '.$select.'>'.$row->ISSEntryDate.'</option>';
    
    	}
    	echo '</select>';
        ?>
    </td>
    </tr>
    
       
    <tr id="report_of_br_ao_do_div">
    <td COLSPAN="2">
    <input type="button" name="view_report" id="view_report" value="View Report" style="background-color: #FF9900;" onclick="check_search_form_iss_3(this.value)"/>
    </td>
    </tr>
    
    </table>
    <input type="hidden" name="login_office_status" id="login_office_status" value="<?php echo $login_office_status; ?>" />
    <input type="hidden" name="report_click_btn" id="report_click_btn" value="0" />
    <?php echo '</form>'; ?>
    
 