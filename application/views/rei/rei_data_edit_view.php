
<p>
   	<?php
       
    $attribute='';
    if(isset($login_office_status) && $login_office_status !=4)
    {
        $attribute='disabled="disabled"';
    }
    
    echo "<table align =center id=\"tbldesgTarget\"><tr><th>Real Estate Index Data Edit</th></tr></table>"; 
   	
    if(isset($login_office_status) && $login_office_status ==4)
    {
     echo form_open('rei/rei_target_edit_save','id="rei_data_edit_form"');   
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
    
    if(isset($login_office_status) && $login_office_status !=4)
    {
        echo '<table align=center><tr><td style="color:#FF0000;font-family:Arial, Helvetica, sans-serif;font-size:15px;font-weight:bold;">You are not allowed to edit Real Estate Index Data. Only branch\'s user allowed to edit.</td></tr></table>';
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
		if(isset($_POST['selected_year']) && $_POST['selected_year']==$row->rei_yr)
		{
			$select="selected='selected'";
		}
	  echo '<option value="'.$row->rei_yr.'" '.$select.'>'.$row->rei_yr.'</option>';

	}
	echo '</select>';
	echo "</td>";
		
	echo "</tr>";

    echo "<tr>";
	echo "<td COLSPAN='2'>";
    ?><input type="button" name="fetch_rei_data" id="fetch_rei_data" value="Fetch Data" style="background-color: #FF9900;" <?php echo $attribute; ?> onclick="if(jQuery('#selected_year').val()==''){alert('First select year.');}else{jQuery('#rei_data_edit_form').submit();}"/><?php
	echo "</td></tr>";
	
	echo "</table>";
	echo form_close();
	?>
 
 