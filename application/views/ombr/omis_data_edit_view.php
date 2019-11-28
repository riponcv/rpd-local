
<p>
   	<?php
       
    $attribute='';
    if(isset($login_office_status) && $login_office_status !=4)
    {
        $attribute='disabled="disabled"';
    }
    
    echo "<table align =center id=\"tbldesgTarget\"><tr><th>OMIS Data Editing Form</th></tr></table>"; 
   	
    if(isset($login_office_status) && $login_office_status ==4)
    {
     echo form_open('rpd/omis_data_edit','id="omis_data_edit_form"');   
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
        echo '<table align=center><tr><td style="color:#FF0000;font-family:Arial, Helvetica, sans-serif;font-size:15px;font-weight:bold;">You are not allowed to edit OMIS Data.</td></tr></table>';
        echo "<br/>";   
    }
	
	echo "<table  border=\"1\" align=\"center\">"; 
	echo "<tr>";
	echo "<td>";
	echo "Date Of Editing Data";
	echo "</td>";
	echo "<td>";
	
	echo '<select name="datdate_edit" id="datdate_edit" '.$attribute.'>';
    echo '<option value="">Select date</option>';

    foreach($records3 as $row)
	{
              
	  echo '<option  value="'.$row->om_dat_date.'" >'.$row->om_dat_date.'</option>';
	}
	echo '</select>';
	echo "</td>";
		
	echo "</tr>";

	echo "<tr>";

	echo "<td COLSPAN='2'>";
    ?><input type="button" name="fetch_omis_data" id="fetch_omis_data" value="Fetch OMIS Data" style="background-color: #FF9900;" <?php echo $attribute; ?> onclick="if(jQuery('#datdate_edit').val()==''){alert('First Select Date.');}else{jQuery('#omis_data_edit_form').submit();}"/><?php
	echo "</td></tr>";
	
	echo "</table>";
	echo form_close();
	?>
 
 