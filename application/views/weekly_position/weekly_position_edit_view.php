<p>
   	<?php
       
    $attribute='';
    if(isset($login_office_status) && $login_office_status !=4)
    {
        $attribute='disabled="disabled"';
    }
    
    echo "<table align =center id=\"tbldesgTarget\"><tr><th>Weekly Position Data Editing Form</th></tr></table>"; 
   	
    if(isset($login_office_status) && $login_office_status ==4)
    {
     echo form_open('weekly_position/weekly_position_edit_save','id="weekly_position_data_edit_form"');   
    }
    else
    {
        echo form_open('');
    }
    
    echo "<br/>";
   	if($this->session->flashdata('success'))
    {
        echo "<div id='flashdata'>";
        echo '<font style="background-color:yellow;font-weight: bold;color: green;">'.$this->session->flashdata('success').'</font>'; 
    	echo "</div>";
    }
    
   	if($this->session->flashdata('error'))
    {
        echo "<div id='flashdata'>";
        echo '<font style="background-color:yellow;font-weight: bold;color: red;">'.$this->session->flashdata('error').'</font>'; 
    	echo "</div>";
        echo "<br/>";
    }
    
    if($login_office_status !=4)
    {
        echo '<table align=center><tr><td style="color:#FF0000;font-family:Arial, Helvetica, sans-serif;font-size:15px;font-weight:bold;">You are not allowed to edit Weekly Position Data.</td></tr></table>';
        echo "<br/>";   
    }
	
	echo "<table  border=\"1\" align=\"center\">"; 
	echo "<tr>";
	echo "<td>";
	echo "Editing Data";
	echo "</td>";
	echo "<td>";
	
	echo '<select id="selected_date" name="selected_date" '.$attribute.'>';
    echo '<option value="">Select Date</option>';
	foreach($records3 as $row)
	{
		$select='';
		if(isset($_POST['selected_date']) && $_POST['selected_date']==$row->weekly_date)
		{
			$select="selected='selected'";
		}
	  echo '<option value="'.$row->weekly_date.'" '.$select.'>'.$row->weekly_date.'</option>';
	}
	echo '</select>';
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td COLSPAN='2'>";
    ?><input type="button" name="fetch_weekly_pos_data" id="fetch_weekly_pos_data" value="Fetch Weekly Position Data" style="background-color: #FF9900;" <?php echo $attribute; ?> onclick="if(jQuery('#selected_date').val()==''){alert('First Select Year.');}else{jQuery('#weekly_position_data_edit_form').submit();}"/><?php
	echo "</td></tr>";
	echo "</table>";
	echo form_close();
	?>
 
 