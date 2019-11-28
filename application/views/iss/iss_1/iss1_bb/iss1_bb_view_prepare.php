<?php
    $attribute='';
    if(isset($login_office_status) && $login_office_status ==4)
    {
        $attribute='disabled="disabled"';
    }

    echo "<table align =center id=\"tbldesgTarget\"><tr><th>ISS Form-1 Data Entry System</th></tr></table>";
   	?>

	<?php
    if(isset($login_office_status) && $login_office_status ==4)
    {
		echo form_open('');
    }
    else
    {
        echo form_open('iss/iss1_bb_prepare_details','id="iss1_bb_prepare_form"');
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

	echo "<tr>";
	echo "<td COLSPAN='2'>";
    ?>
	<input type="button" name="fetch_iss_data" id="fetch_iss_data" value="View ISS Prepare Data" style="background-color: #FF9900;" <?php echo $attribute; ?> onclick="if((jQuery('#fetched_date').val() != '')){jQuery('#iss1_bb_prepare_form').submit();}else{alert('First Select Date and Department..')}"/>
	<?php
	echo "</td></tr>";
	echo "</table>";
	echo form_close();
	?>