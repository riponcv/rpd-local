
<p>
   	<?php
       
    $attribute='';
    if(isset($enable_status) && $enable_status !=1)
    {
        $attribute='disabled="disabled"';
    }
    
    echo "<table align =center id=\"tbldesgTarget\"><tr><th>TMS Data Editing Form</th></tr></table>"; 
   	
    if(isset($enable_status) && $enable_status ==1)
    {
     echo form_open('tms/tms_target_edit_save','id="tms_data_edit_form"');   
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
    
    if(isset($enable_status) && $enable_status !=1)
    {
        echo '<table align=center><tr><td style="color:#FF0000;font-family:Arial, Helvetica, sans-serif;font-size:15px;font-weight:bold;">You are not allowed to edit TMS Data.</td></tr></table>';
        echo "<br/>";   
    }
	
	echo "<table  border=\"1\" align=\"center\">"; 
	echo "<tr>";
	echo "<td>";
	echo "Year Of Editing Data";
	echo "</td>";
	echo "<td>";
	
	echo '<select id="selected_year" name="selected_year" '.$attribute.'>';
    echo '<option value="">Year</option>';
	foreach($records3 as $row)
	{
		$select='';
		if(isset($_POST['selected_year']) && $_POST['selected_year']==$row->tms_yr)
		{
			$select="selected='selected'";
		}
	  echo '<option value="'.$row->tms_yr.'" '.$select.'>'.$row->tms_yr.'</option>';

	}
	echo '</select>';
	echo "</td>";
		
	echo "</tr>";

    if(!empty($own_br_arr))
    {
    	echo "<tr>";
    	echo "<td>";
    	echo "Select Branch";
    	echo "</td>";
    	echo "<td>";
    	
    	echo '<select id="selected_branch" name="selected_branch" '.$attribute.'>';
        echo '<option value="">Select Branch</option>';
    	foreach($own_br_arr as $row)
    	{
    		$select='';
    		if(isset($_POST['selected_branch']) && $_POST['selected_branch']==$row->brcode)
    		{
    			$select="selected='selected'";
    		}
    	  echo '<option value="'.$row->brcode.'" '.$select.'>'.$row->branchname.'('.$row->brcode.')'.'</option>';
    
    	}
    	echo '</select>';
    	echo "</td>";		
    	echo "</tr>";
    }
    echo "<tr>";
	echo "<td COLSPAN='2'>";
    ?><input type="button" name="fetch_tms_data" id="fetch_tms_data" value="Fetch TMS Data" style="background-color: #FF9900;" <?php echo $attribute; ?> onclick="if(jQuery('#selected_year').val()=='' || jQuery('#selected_branch').val()==''){alert('First select year and branch.');}else{jQuery('#tms_data_edit_form').submit();}"/><?php
	echo "</td></tr>";
	
	echo "</table>";
	echo form_close();
	?>
 
 