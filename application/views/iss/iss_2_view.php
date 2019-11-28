<p>
   	<?php
    $attribute='';
    if(isset($login_office_status) && $login_office_status !=4)
    {
        $attribute='disabled="disabled"';
    }
    
    echo "<table align =center id=\"tbldesgTarget\"><tr><th>ISS Data Upload System</th></tr></table>"; 
   	
    if(isset($login_office_status) && $login_office_status ==4)
    {
     echo form_open('iss/iss_form_2_entry','id="iss_data_form"');   
    }
    else
    {
        echo form_open('');
    }
    
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
	
	    
    if($login_office_status !=4)
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
    ?><input type="button" name="fetch_iss_data" id="fetch_iss_data" value="Fetch ISS Entry Form" style="background-color: #FF9900;" <?php echo $attribute; ?> onclick="if(jQuery('#fetched_date').val()==''){alert('First Select Date.');}else{jQuery('#iss_data_form').submit();}"/><?php
	echo "</td></tr>";
	echo "</table>";
	echo form_close();
	?>
	<br /><br /><br /><br /><br />
	<table border="1" align="center" width="325">
		<tr>
			<td BGCOLOR="#99CCFF" style="font-weight: bold;text-align: center;">Rules for ISS Data Entry</td>
		</tr>
	</table>