<p>
   	<?php
    $attribute='';
    if(isset($login_office_status) && $login_office_status !=4)
    {
       // $attribute='disabled="disabled"';
    }
    
    echo "<table align =center id=\"tbldesgTarget\"><tr><th>ISS Form-2 Data Certificate System</th></tr></table>"; 
   	
    echo form_open('iss/iss_2_report_certificate_detail','id="iss_data_certificate_form"');   
    echo "<br/>";
   	if($this->session->flashdata('success_wp'))
    {
        echo "<div id='flashdata'>";
        echo '<font style="background-color:yellow;font-weight: bold;color: green;">'.$this->session->flashdata('success_wp').'</font>'; 
    	echo "</div>";
    }
    
   	if($this->session->flashdata('error_wp'))
    {
        echo "<div id='flashdata'>";
        echo '<font style="background-color:yellow;font-weight: bold;color: red;">'.$this->session->flashdata('error_wp').'</font>'; 
    	echo "</div>";
        echo "<br/>";
    }
	
	    
   
	echo "<table  border=\"1\" align=\"center\">"; 
	echo "<tr>";
	echo "<td>";
	echo "Select Date for ISS Data";
	echo "</td>";
	echo "<td>";
	echo '<select id="report_of_date" name="report_of_date">';
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
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>";
    ?>
	<!--<input type="button" name="iss_data_certificate" id="iss_data_certificate" value="Fetch ISS Data for Certificate" style="background-color: #FF9900;" <?php echo $attribute; ?> onclick="if(jQuery('#fetched_date').val()==''){alert('First Select Date.');}else{jQuery('#iss_data_certificate_form').submit();}"/>-->
	<input type="button" name="iss_data_certificate" id="iss_data_certificate" value="Fetch ISS Data for Certificate" style="background-color: #FF9900;" onclick="check_search_form_iss_cer(this.value)"/>
	<?php echo "</td> ";?>
	
	<?php if(isset($login_office_status) && $login_office_status !=4)
    {
		echo "<td> "; ?>
		<input type="button" name="iss_certificate" id="iss_certificate" value="Certificate Info." style="background-color: #FF9900;" onclick="check_search_form_iss_cer(this.value)"/>
		<?php
		echo "</td>";
	}
	else
	{
		echo "</td> ";
		echo "</td>";
	}
   	echo "<tr>";
	echo "</table>";
	?>
	<input type="hidden" name="login_office_status" id="login_office_status" value="<?php echo $login_office_status; ?>" />
    <input type="hidden" name="report_click_btn" id="report_click_btn" value="1" />
	<input type="hidden" name="report_option_selector" id="report_option_selector" value="1" />
	<?php
	
	echo form_close();
	?>
	<br /><br /><br />
	
 
 