   	<?php

	$attribute='';
    if(isset($login_office_status) && $login_office_status ==4)
    {
        $attribute='disabled="disabled"';
    }
    echo "<table align =center id=\"tbldesgTarget\"><tr><th>ISS Form-1 Data Entry Form System</th></tr></table>";
   	?>


	<?php
    if(isset($login_office_status) && $login_office_status ==4)
    {
		echo form_open('');
    }
    else
    {
        //echo form_open('iss/iss_1_entry_view_details','id="iss_data_form_1"');
        echo form_open('iss/iss_1_deptt_enrty_date_check','id="iss_data_form_1"');
    }

    echo "<br/>";
   	if($this->session->flashdata('success_iss1'))
    {
        echo "<div id='flashdata'>";
        echo '<font style="background-color:yellow;font-weight: bold;color: green;">'.$this->session->flashdata('success_iss1').'</font>';
    	echo "</div>";
    }

   	if($this->session->flashdata('error_iss1'))
    {
        echo "<div id='flashdata'>";
        echo '<font style="background-color:yellow;font-weight: bold;color: red;">'.$this->session->flashdata('error_iss1').'</font>';
    	echo "</div>";
        echo "<br/>";
    }
	if($this->session->flashdata('error_iss1_2'))
    {
        echo "<div id='flashdata'>";
        echo '<font style="background-color:yellow;font-weight: bold;color: red;">'.$this->session->flashdata('error_iss1_2').'</font>';
    	echo "</div>";
        echo "<br/>";
    }

    if($this->session->flashdata('notsuccess_deptt_view'))
    {
        echo "<div id='flashdata'>";
        echo '<font style="background-color:yellow;font-weight: bold;color: red;">'.$this->session->flashdata('notsuccess_deptt_view').'</font>';
    	echo "</div>";
        echo "<br/>";
    }

    if($login_office_status ==4)
    {
        echo '<table align=center><tr><td style="color:#FF0000;font-family:Arial, Helvetica, sans-serif;font-size:15px;font-weight:bold;">You are not allowed to Fetch ISS Data.</td></tr></table>';
        echo "<br/>";
    }

	echo "<table  border=\"1\" align=\"center\">";
	echo "<tr>";
	echo "<td>";
	echo "Select Date for ISS";
	echo "</td>";
	echo "<td>";
	echo '<select id="fetched_date" name="fetched_date" '.$attribute.'>';
    echo '<option value="">Select Date</option>';
	foreach($records3 as $row)
	{
		$select='';
		if(isset($_POST['fetched_date']) && $_POST['fetched_date']==$row->ISSEntryDate)
		{
			$select="selected='selected'";
		}
	  echo '<option value="'.$row->ISSEntryDate.'" '.$select.'>'.$row->ISSEntryDate.'</option>';
	}
	echo '</select>';
	echo "</td>";
	echo "</tr>";
	/*
	echo "<tr>";
	echo "<td>";
	echo "Select Department for ISS";
	echo "</td>";



	echo "<td>";
	echo '<select id="fetched_deptt" name="fetched_deptt" '.$attribute.'>';
    echo '<option value="">Select Department</option>';
	foreach($dept_list as $row_list)
	{
		$select='';
		if(isset($_POST['fetched_deptt']) && $_POST['fetched_deptt']==$row_list->office_name)
		{
			$select="selected='selected'";
		}
	  echo '<option value="'.$row_list->Office_code.'" '.$select.'>'.$row_list->office_name.'</option>';
	}
	echo '</select>';
	echo "</td>";
	echo "</tr>";
	*/
	echo "<tr>";
	echo "<td COLSPAN='2'>";
    ?>
	<input type="button" name="fetch_iss_data" id="fetch_iss_data" value="Fetch ISS Entry Form" style="background-color: #FF9900;" <?php echo $attribute; ?> onclick="if((jQuery('#fetched_date').val() != '') && (jQuery('#fetched_deptt').val() != '')){jQuery('#iss_data_form_1').submit();;}else{alert('First Select Date and Department..')}"/>
	<!--<input type="button" name="fetch_iss_data" id="fetch_iss_data" value="Fetch ISS Entry Form" style="background-color: #FF9900;" <?php echo $attribute; ?> onclick="check_iss_form_1_view(this.value)"/>-->
	<input type="hidden" name="iss_deptt_code" id="iss_deptt_code" value="<?php echo $office_id; ?>" >

	<?php
	echo "</td></tr>";
	echo "</table>";
	echo form_close();
	?>

